<?php
/**
 * Analytics module self-check (CLI only). Exits with code 1 when any check fails.
 * Usage: php modules/analytics/tools/verify.php
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$root = dirname(__DIR__, 3);
require_once $root . '/core/Autoloader.php';
require_once $root . '/core/helpers.php';

use Core\Database;

Database::loadEnv($root . '/.env');
$moduleDir = dirname(__DIR__);
$failures = 0;

function check(string $label, bool $ok, string $detail = ''): void
{
    global $failures;
    echo ($ok ? '  [PASS] ' : '  [FAIL] ') . $label . ($detail !== '' ? " — {$detail}" : '') . PHP_EOL;
    if (!$ok) {
        $failures++;
    }
}

function moduleFiles(string $dir, string $ext = 'php'): array
{
    $out = [];
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
    foreach ($it as $f) {
        if ($f->isFile() && strtolower($f->getExtension()) === $ext && !str_contains($f->getPathname(), DIRECTORY_SEPARATOR . 'tools' . DIRECTORY_SEPARATOR)) {
            $out[] = $f->getPathname();
        }
    }
    return $out;
}

echo "Academic Analytics module verification" . PHP_EOL;

// 1. Every ana_* table referenced in PHP exists
echo PHP_EOL . "1. Tables" . PHP_EOL;
$referenced = [];
foreach (moduleFiles($moduleDir) as $file) {
    // Migrations describe the schema history, including tables that were later dropped
    if (str_contains($file, DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)) {
        continue;
    }
    if (preg_match_all('/[`\'"](ana_[a-z_]+)[`\'"]/', (string) file_get_contents($file), $m)) {
        foreach ($m[1] as $t) {
            $referenced[$t] = true;
        }
    }
}
$existing = array_column(Database::fetchAll("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME LIKE 'ana\\_%'"), 'TABLE_NAME');
foreach (array_keys($referenced) as $t) {
    check("table {$t} exists", in_array($t, $existing, true));
}

// 2. Forbidden patterns
echo PHP_EOL . "2. Forbidden patterns" . PHP_EOL;
$patterns = [
    '/\b' . 'ret' . '_[a-z_]+/'                                   => 'retention module table',
    '/\b' . 'ra' . 'nd\(|mt_' . 'rand|array_' . 'rand|crc' . '32/' => 'random / hashed fake data',
    '/seed' . 'Factor|\$se' . 'ed\b/'                              => 'seeded fake values',
    '/faculty' . '_classes|ana_' . 'risk_logs/'                    => 'non-existent table',
];
foreach (moduleFiles($moduleDir) as $file) {
    $src = (string) file_get_contents($file);
    foreach ($patterns as $re => $label) {
        if (preg_match($re, $src, $m)) {
            check("no {$label} in " . substr($file, strlen($moduleDir) + 1), false, $m[0]);
        }
    }
}
foreach (moduleFiles($moduleDir . '/Views') as $file) {
    $src = (string) file_get_contents($file);
    foreach (['/\balert\(/' => 'alert()', '/cdn\./i' => 'CDN link', '/jquery/i' => 'jQuery', '/data-toggle=/' => 'Bootstrap 4 attribute'] as $re => $label) {
        if (preg_match($re, $src)) {
            check("no {$label} in " . substr($file, strlen($moduleDir) + 1), false);
        }
    }
}
check('forbidden pattern scan finished', true);

// 3. Permissions declared in module.json exist
echo PHP_EOL . "3. Permissions" . PHP_EOL;
$json = json_decode((string) file_get_contents($moduleDir . '/module.json'), true);
$declared = array_keys($json['permissions'] ?? []);
$permNames = array_column(Database::fetchAll("SELECT name FROM `permissions`"), 'name');
foreach ($declared as $p) {
    check("permission {$p} registered", in_array($p, $permNames, true));
}
$menuPerms = [];
foreach (($json['menu']['items'] ?? []) as $item) {
    $menuPerms[] = $item['permission'] ?? null;
    foreach ($item['children'] ?? [] as $c) {
        $menuPerms[] = $c['permission'] ?? null;
    }
}
foreach (array_unique(array_filter($menuPerms)) as $p) {
    check("menu permission {$p} is declared", in_array($p, $declared, true));
}

// 4. Grant matrix
echo PHP_EOL . "4. Grant matrix" . PHP_EOL;
$matrix = [
    'student'      => ['analytics.student.portal'],
    'faculty'      => ['analytics.faculty.classes', 'analytics.faculty.attendance', 'analytics.faculty.behavior'],
    'registrar'    => ['analytics.registrar.enrollment', 'analytics.registrar.view'],
    'program_head' => ['analytics.view', 'analytics.export'],
    'lead_analytics' => $declared,
];
foreach ($matrix as $role => $perms) {
    $granted = array_column(Database::fetchAll(
        "SELECT p.name FROM `role_permissions` rp JOIN `roles` r ON r.id = rp.role_id JOIN `permissions` p ON p.id = rp.permission_id WHERE r.slug = :r",
        ['r' => $role]
    ), 'name');
    $missing = array_diff($perms, $granted);
    check("role {$role} has its analytics grants", empty($missing), $missing ? 'missing ' . implode(', ', $missing) : '');
}
$leaks = Database::fetchAll(
    "SELECT r.slug, p.name FROM `role_permissions` rp JOIN `roles` r ON r.id = rp.role_id JOIN `permissions` p ON p.id = rp.permission_id
     WHERE r.slug IN ('student', 'program_head', 'registrar') AND p.name LIKE 'analytics.admin.%'"
);
check('no admin analytics permission granted to student / program head / registrar', empty($leaks),
    implode(', ', array_map(fn($l) => $l['slug'] . ':' . $l['name'], $leaks)));

// 5. Demo accounts
echo PHP_EOL . "5. Demo accounts" . PHP_EOL;
$accounts = ['registrar' => 'registrar', 'programhead' => 'program_head', 'faculty' => 'faculty', 'student' => 'student', 'admin' => 'super_admin', 'group8a_lead' => 'lead_analytics'];
foreach ($accounts as $username => $role) {
    $row = Database::fetchOne(
        "SELECT u.id FROM `users` u JOIN `user_roles` ur ON ur.user_id = u.id JOIN `roles` r ON r.id = ur.role_id WHERE u.username = :u AND r.slug = :r",
        ['u' => $username, 'r' => $role]
    );
    check("account {$username} has role {$role}", $row !== null);
}
$ph = Database::fetchOne(
    "SELECT p.code FROM `ana_program_heads` m JOIN `users` u ON u.id = m.user_id JOIN `programs` p ON p.id = m.program_id WHERE u.username = 'programhead' AND p.code = 'BSIS'"
);
check('programhead is mapped to BSIS', $ph !== null);
$studentLink = Database::fetchOne("SELECT s.student_number FROM `students` s JOIN `users` u ON u.id = s.user_id WHERE u.username = 'student'");
echo '  [INFO] demo account "student" is linked to ' . ($studentLink ? $studentLink['student_number'] : 'no student record') . PHP_EOL;

// 6. Seeders only write configuration tables
echo PHP_EOL . "6. Seeders" . PHP_EOL;
$allowed = ['ana_grading_templates', 'ana_program_heads'];
foreach (glob($moduleDir . '/database/seeders/*.php') as $file) {
    preg_match_all('/(?:INSERT\s+(?:IGNORE\s+)?INTO\s+`?|insert\(\s*[\'"])(ana_[a-z_]+)/i', (string) file_get_contents($file), $m);
    $bad = array_diff(array_unique($m[1]), $allowed);
    check('seeder ' . basename($file) . ' writes only configuration tables', empty($bad), implode(', ', $bad));
}

// 7. No table or column repeats what a core table already holds
echo PHP_EOL . "7. Core tables are the source" . PHP_EOL;
$dropped = ['ana_student_profiles' => 'students', 'ana_settings' => 'settings', 'ana_change_log' => 'audit_logs', 'ana_records' => 'audit_logs / ana_dashboard_notes'];
foreach ($dropped as $table => $core) {
    $exists = (int) Database::fetchColumn("SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t", ['t' => $table]) > 0;
    check("{$table} is gone (data lives in {$core})", !$exists);
}
$copied = [
    'ana_classes'            => ['subject_code', 'subject_title', 'units', 'section_name', 'academic_year_id', 'room'],
    'ana_attendance_records' => ['subject_code'],
    'ana_enrollments'        => ['program_id', 'academic_year_id'],
];
foreach ($copied as $table => $columns) {
    foreach ($columns as $column) {
        $exists = (int) Database::fetchColumn(
            "SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND COLUMN_NAME = :c",
            ['t' => $table, 'c' => $column]
        ) > 0;
        check("{$table}.{$column} is not stored (read from the core table)", !$exists);
    }
}

echo PHP_EOL . ($failures === 0 ? 'All checks passed.' : "{$failures} check(s) failed.") . PHP_EOL;
exit($failures === 0 ? 0 : 1);

<?php
/**
 * Seeder: Academic Analytics roles, permission grants, demo accounts and program-head mapping.
 *
 * Idempotent and insert-only on core tables (roles, permissions, role_permissions,
 * users, user_roles). It never creates student, grade, score, attendance or
 * enrollment records.
 */

use Core\Database;
use Core\ModuleLoader;
use Modules\Analytics\Support\DemoAccountsBootstrapper;

return new class {
    private const ALL_ANALYTICS = '*';

    public function run(): void {
        require_once dirname(__DIR__, 2) . '/Support/DemoAccountsBootstrapper.php';
        DemoAccountsBootstrapper::bootstrap();

        $now = date('Y-m-d H:i:s');

        if (class_exists(ModuleLoader::class) && method_exists(ModuleLoader::class, 'syncPermissions')) {
            ModuleLoader::syncPermissions();
        }

        // 1. Module roles
        $moduleRoles = [
            'registrar'    => ['Registrar', 'Manages official term enrollment, masterlists and registration forms.'],
            'program_head' => ['Program Head', 'Read-only academic oversight for the programs mapped to this account.'],
        ];
        foreach ($moduleRoles as $slug => [$name, $description]) {
            Database::query(
                "INSERT IGNORE INTO `roles` (`name`, `slug`, `description`, `created_at`) VALUES (?, ?, ?, ?)",
                [$name, $slug, $description, $now]
            );
        }

        // 2. Grant matrix (role slug => permission keys)
        $coreRegistrarPerms = [
            'core.dashboard.view', 'core.students.view', 'core.students.create', 'core.students.edit',
            'core.students.import', 'core.students.export', 'core.programs.view', 'core.subjects.view',
            'core.academics.view',
        ];
        $grants = [
            'student'        => ['analytics.student.portal', 'core.dashboard.view'],
            'faculty'        => ['analytics.faculty.classes', 'analytics.faculty.attendance', 'analytics.faculty.behavior', 'analytics.view', 'core.dashboard.view'],
            'registrar'      => array_merge(['analytics.registrar.enrollment', 'analytics.registrar.view'], $coreRegistrarPerms),
            'program_head'   => ['analytics.view', 'analytics.export', 'core.dashboard.view'],
            'lead_analytics' => [self::ALL_ANALYTICS],
            'admin'          => [self::ALL_ANALYTICS],
        ];

        $permIds = [];
        foreach (Database::fetchAll("SELECT `id`, `name` FROM `permissions`") as $p) {
            $permIds[$p['name']] = (int) $p['id'];
        }
        $declared = $this->declaredPermissions();

        $roleIds = [];
        foreach (Database::fetchAll("SELECT `id`, `slug` FROM `roles`") as $r) {
            $roleIds[$r['slug']] = (int) $r['id'];
        }

        foreach ($grants as $roleSlug => $keys) {
            if (!isset($roleIds[$roleSlug])) {
                continue;
            }
            if ($keys === [self::ALL_ANALYTICS]) {
                $keys = $declared;
            }
            foreach ($keys as $key) {
                if (!isset($permIds[$key])) {
                    echo "  ! permission '{$key}' not found; grant to '{$roleSlug}' skipped\n";
                    continue;
                }
                Database::query(
                    "INSERT IGNORE INTO `role_permissions` (`role_id`, `permission_id`) VALUES (?, ?)",
                    [$roleIds[$roleSlug], $permIds[$key]]
                );
            }
        }

        // 3. Demo login accounts (accounts only, no academic records)
        $password = password_hash('Password123!', PASSWORD_BCRYPT, ['cost' => 12]);
        $accounts = [
            ['username' => 'registrar',   'email' => 'registrar@marsu.edu.ph',   'first_name' => 'Rosa',   'last_name' => 'Villanueva', 'role' => 'registrar'],
            ['username' => 'programhead', 'email' => 'programhead@marsu.edu.ph', 'first_name' => 'Ramon',  'last_name' => 'Castillo',   'role' => 'program_head'],
        ];
        foreach ($accounts as $acc) {
            $user = Database::fetchOne("SELECT `id` FROM `users` WHERE `username` = :u", ['u' => $acc['username']]);
            if (!$user) {
                $emailTaken = Database::fetchOne("SELECT `id` FROM `users` WHERE `email` = :e", ['e' => $acc['email']]);
                if ($emailTaken) {
                    echo "  ! demo account '{$acc['username']}' skipped: email {$acc['email']} already belongs to another user\n";
                    continue;
                }
                $userId = Database::insert('users', [
                    'username'   => $acc['username'],
                    'email'      => $acc['email'],
                    'password'   => $password,
                    'first_name' => $acc['first_name'],
                    'last_name'  => $acc['last_name'],
                    'avatar'     => 'public/assets/img/undraw_profile.svg',
                    'role'       => $acc['role'],
                    'status'     => 'active',
                    'created_at' => $now,
                ]);
            } else {
                $userId = (int) $user['id'];
            }
            if (isset($roleIds[$acc['role']])) {
                Database::query("INSERT IGNORE INTO `user_roles` (`user_id`, `role_id`) VALUES (?, ?)", [$userId, $roleIds[$acc['role']]]);
            }
        }

        // 4. Program head mapping (configuration): programhead -> BSIS
        $ph = Database::fetchOne("SELECT `id` FROM `users` WHERE `username` = 'programhead'");
        $bsis = Database::fetchOne("SELECT `id` FROM `programs` WHERE `code` = 'BSIS' AND `deleted_at` IS NULL");
        if (!$bsis) {
            echo "  ! program BSIS not found; 'programhead' was not mapped to any program\n";
        } elseif ($ph) {
            Database::query(
                "INSERT IGNORE INTO `ana_program_heads` (`user_id`, `program_id`, `created_at`) VALUES (?, ?, ?)",
                [(int) $ph['id'], (int) $bsis['id'], $now]
            );
        }
    }

    private function declaredPermissions(): array {
        $json = json_decode((string) file_get_contents(dirname(__DIR__, 2) . '/module.json'), true);
        return array_keys($json['permissions'] ?? []);
    }
};

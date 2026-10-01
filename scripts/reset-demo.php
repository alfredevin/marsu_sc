<?php
/**
 * MarSU Centralized ERP - Demo Data Seeder & System Reset Tool
 * 
 * Generates 500+ realistic Filipino student records, 60+ faculty/staff,
 * 35+ curriculum subjects, 20+ rooms, 8+ student orgs, academic years,
 * and pre-created demo accounts for all roles and student groups.
 * 
 * Usage:
 *   CLI: php scripts/reset-demo.php
 *   Web: Accessible by super_admin or via localhost with confirmation
 */

declare(strict_types=1);

// Prevent timeout for large datasets
set_time_limit(300);
ini_set('memory_limit', '512M');

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/helpers.php';

use Core\Database;
use Core\Migration;
use Core\Seeder;
use Core\ModuleLoader;
use Core\Auth;

Database::loadEnv(__DIR__ . '/../.env');

$isCli = (php_sapi_name() === 'cli');

if (!$isCli) {
    // If accessed via web, verify authorization
    \Core\Session::start();
    $user = Auth::user();
    $token = $_GET['token'] ?? '';
    $allowed = false;

    // Check if logged in as super_admin
    if ($user && in_array($user['role'] ?? '', ['super_admin', 'admin'])) {
        $allowed = true;
    }
    // Or check if running on localhost with explicit confirmation
    $remoteIp = $_SERVER['REMOTE_ADDR'] ?? '';
    if (in_array($remoteIp, ['127.0.0.1', '::1']) && $token === 'reset-marsu-demo-confirm') {
        $allowed = true;
    }

    if (!$allowed) {
        http_response_code(403);
        echo "<h2>403 Forbidden</h2><p>Only Super Administrators or authorized localhost requests can reset the demo environment.</p>";
        echo "<p>To reset via browser locally, visit: <code>?token=reset-marsu-demo-confirm</code></p>";
        exit;
    }
    header('Content-Type: text/plain; charset=utf-8');
}

function out(string $message): void {
    echo $message . "\n";
    if (ob_get_level() > 0) {
        ob_flush();
    }
    flush();
}

out("====================================================================");
out("       MARSU CENTRALIZED ERP - DEMO DATA GENERATION SUITE          ");
out("       College of Information and Computing Sciences (CICS)        ");
out("====================================================================");
out("Starting clean environment reset and data generation...");

$startTime = microtime(true);
$pdo = Database::pdo();

try {
    // -------------------------------------------------------------------------
    // STEP 1: DROP ALL EXISTING TABLES CLEANLY
    // -------------------------------------------------------------------------
    out("\n[Step 1/8] Dropping existing database tables...");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

    $tables = [
        'audit_logs', 'password_resets', 'settings', 'modules',
        'organizations', 'students', 'employees', 'rooms', 'buildings',
        'sections', 'subjects', 'semesters', 'academic_years', 'programs',
        'departments', 'user_roles', 'role_permissions', 'permissions',
        'users', 'roles', 'migrations'
    ];

    foreach ($tables as $tbl) {
        $pdo->exec("DROP TABLE IF EXISTS `{$tbl}`;");
    }
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
    out("  ✔ Core tables dropped cleanly.");

    // -------------------------------------------------------------------------
    // STEP 2: RUN CORE MIGRATIONS & PERMISSION SYNC
    // -------------------------------------------------------------------------
    out("\n[Step 2/8] Executing core migrations...");
    Migration::runAll('core');
    out("  ✔ Database schema created successfully.");

    // -------------------------------------------------------------------------
    // STEP 3: BASE SEEDING (Roles, Permissions, Settings)
    // -------------------------------------------------------------------------
    out("\n[Step 3/8] Seeding security roles, permissions, and institutional settings...");
    Seeder::runAll('core');
    out("  ✔ Default roles and permissions established.");

    // -------------------------------------------------------------------------
    // STEP 4: PRE-CREATED DEMO USER ACCOUNTS
    // -------------------------------------------------------------------------
    out("\n[Step 4/8] Generating pre-created demo user accounts...");
    $defaultPassHash = password_hash('Password123!', PASSWORD_BCRYPT);
    $now = date('Y-m-d H:i:s');

    // Create 11 student group lead accounts
    $groupAccounts = [
        ['username' => 'group1_lead',  'email' => 'group1.lead@marsu.edu.ph',  'fname' => 'Althea',   'lname' => 'Ramos',      'role' => 'student', 'desc' => 'Group 1: 4Ps Expense Tracker'],
        ['username' => 'group2_lead',  'email' => 'group2.lead@marsu.edu.ph',  'fname' => 'Mark',     'lname' => 'Lacierda',   'role' => 'student', 'desc' => 'Group 2: IRIMKMS Research'],
        ['username' => 'group3_lead',  'email' => 'group3.lead@marsu.edu.ph',  'fname' => 'Joshua',   'lname' => 'Mabute',     'role' => 'faculty', 'desc' => 'Group 3: Faculty Workload'],
        ['username' => 'group4_lead',  'email' => 'group4.lead@marsu.edu.ph',  'fname' => 'Nicole',   'lname' => 'Mercene',    'role' => 'staff',   'desc' => 'Group 4: Health Services'],
        ['username' => 'group5_lead',  'email' => 'group5.lead@marsu.edu.ph',  'fname' => 'Christian','lname' => 'Paras',      'role' => 'student', 'desc' => 'Group 5: Student Org Finance'],
        ['username' => 'group6_lead',  'email' => 'group6.lead@marsu.edu.ph',  'fname' => 'Kimberly', 'lname' => 'Malabanan',  'role' => 'student', 'desc' => 'Group 6: Org Leadership & Evaluation'],
        ['username' => 'group7_lead',  'email' => 'group7.lead@marsu.edu.ph',  'fname' => 'Angelo',   'lname' => 'Alcantara',  'role' => 'student', 'desc' => 'Group 7: Boarding House & Housing'],
        ['username' => 'group8_lead',  'email' => 'group8.lead@marsu.edu.ph',  'fname' => 'Bea',      'lname' => 'Manalo',     'role' => 'faculty', 'desc' => 'Group 8: Student Retention & Analytics'],
        ['username' => 'group9_lead',  'email' => 'group9.lead@marsu.edu.ph',  'fname' => 'Vincent',  'lname' => 'Dimaculangan','role' => 'staff',  'desc' => 'Group 9: University Asset Tracker'],
        ['username' => 'group10_lead', 'email' => 'group10.lead@marsu.edu.ph', 'fname' => 'Kristine', 'lname' => 'Dela Cruz',  'role' => 'staff',   'desc' => 'Group 10: Student Welfare Services'],
        ['username' => 'group11_lead', 'email' => 'group11.lead@marsu.edu.ph', 'fname' => 'Daniel',   'lname' => 'Bautista',   'role' => 'staff',   'desc' => 'Group 11: Guidance & Counseling'],
    ];

    $roleRows = Database::fetchAll("SELECT id, slug, name FROM roles");
    $roleMap = array_column($roleRows, 'id', 'slug');

    $stmtUser = $pdo->prepare("INSERT INTO users (username, email, password, first_name, last_name, status, created_at) VALUES (?, ?, ?, ?, ?, 'active', ?)");
    $stmtUserRole = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");

    foreach ($groupAccounts as $g) {
        $stmtUser->execute([$g['username'], $g['email'], $defaultPassHash, $g['fname'], $g['lname'], $now]);
        $uid = (int)$pdo->lastInsertId();
        $rid = $roleMap[$g['role']] ?? $roleMap['student'];
        $stmtUserRole->execute([$uid, $rid]);
    }
    out("  ✔ Pre-created 11 student group lead accounts (group1_lead to group11_lead / Password123!).");

    // -------------------------------------------------------------------------
    // STEP 5: ACADEMIC CALENDAR, DEPARTMENTS, PROGRAMS, SECTIONS, SUBJECTS, ROOMS
    // -------------------------------------------------------------------------
    out("\n[Step 5/8] Seeding expanded academic hierarchy, subjects, buildings, and rooms...");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

    // Academic Years: 2024-2025, 2025-2026, 2026-2027
    $pdo->exec("TRUNCATE TABLE semesters;");
    $pdo->exec("TRUNCATE TABLE sections;");
    $pdo->exec("TRUNCATE TABLE subjects;");
    $pdo->exec("TRUNCATE TABLE rooms;");
    $pdo->exec("TRUNCATE TABLE buildings;");
    $pdo->exec("TRUNCATE TABLE programs;");
    $pdo->exec("TRUNCATE TABLE departments;");
    $pdo->exec("TRUNCATE TABLE academic_years;");
    $stmtAY = $pdo->prepare("INSERT INTO academic_years (code, label, start_date, end_date, is_active, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtAY->execute(['2024-2025', 'Academic Year 2024-2025', '2024-08-12', '2025-06-30', 0, $now]);
    $ay1Id = (int)$pdo->lastInsertId();
    $stmtAY->execute(['2025-2026', 'Academic Year 2025-2026', '2025-08-11', '2026-06-28', 0, $now]);
    $ay2Id = (int)$pdo->lastInsertId();
    $stmtAY->execute(['2026-2027', 'Academic Year 2026-2027', '2026-08-17', '2027-06-30', 1, $now]);
    $ayCurrentId = (int)$pdo->lastInsertId();

    // Semesters
    $stmtSem = $pdo->prepare("INSERT INTO semesters (academic_year_id, code, name, is_active, created_at) VALUES (?, ?, ?, ?, ?)");
    // 2024-2025
    $stmtSem->execute([$ay1Id, '1', '1st Semester 2024-2025', 0, $now]);
    $stmtSem->execute([$ay1Id, '2', '2nd Semester 2024-2025', 0, $now]);
    $stmtSem->execute([$ay1Id, 'summer', 'Summer 2025', 0, $now]);
    // 2025-2026
    $stmtSem->execute([$ay2Id, '1', '1st Semester 2025-2026', 0, $now]);
    $stmtSem->execute([$ay2Id, '2', '2nd Semester 2025-2026', 0, $now]);
    $stmtSem->execute([$ay2Id, 'summer', 'Summer 2026', 0, $now]);
    // 2026-2027 (Active)
    $stmtSem->execute([$ayCurrentId, '1', '1st Semester 2026-2027', 1, $now]);
    $currentSemId = (int)$pdo->lastInsertId();
    $stmtSem->execute([$ayCurrentId, '2', '2nd Semester 2026-2027', 0, $now]);
    $stmtSem->execute([$ayCurrentId, 'summer', 'Summer 2027', 0, $now]);

    // Authentic MarSU Departments based on Student Programs & Employee Groups
    $departmentsData = [
        6 => [
            'code' => 'DICT',
            'name' => 'Department of Information and Communications Technology',
            'type' => 'department',
            'desc' => 'Department administering the Bachelor of Science in Information Systems (BSIS) program.',
            'head' => 'Carlo Magno Malvar Castro'
        ],
        7 => [
            'code' => 'DTHM',
            'name' => 'Department of Tourism and Hospitality Management',
            'type' => 'department',
            'desc' => 'Department administering the Bachelor of Science in Tourism Management (BSTM) program.',
            'head' => 'Hilarion Redugerio Elegado'
        ],
        8 => [
            'code' => 'DPSS',
            'name' => 'Department of Political and Social Sciences',
            'type' => 'department',
            'desc' => 'Department administering the Bachelor of Arts in Political Science (BAPoS) program.',
            'head' => 'Loriebenn Bañez Madriño'
        ],
        9 => [
            'code' => 'DETE',
            'name' => 'Department of Elementary Teacher Education',
            'type' => 'department',
            'desc' => 'Department administering the Bachelor of Elementary Education (BEED) program.',
            'head' => 'Annalyn Jawili Decena'
        ],
        10 => [
            'code' => 'ADMIN',
            'name' => 'Administrative and Support Services Division',
            'type' => 'office',
            'desc' => 'Campus Executive Administration, Registrar, Library, Facilities, and Technical Support.',
            'head' => 'Joefel Nabos Pabeloña'
        ]
    ];

    $stmtDept = $pdo->prepare("INSERT INTO departments (id, code, name, type, description, head_name, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $deptMap = [];
    foreach ($departmentsData as $dId => $d) {
        $stmtDept->execute([$dId, $d['code'], $d['name'], $d['type'], $d['desc'], $d['head'], $now]);
        $deptMap[$d['code']] = $dId;
    }

    // Degree Programs based on students info
    $programsData = [
        ['code' => 'BSIS',  'name' => 'Bachelor of Science in Information Systems', 'dept' => 6, 'years' => 4],
        ['code' => 'BSTM',  'name' => 'BS in Tourism Management',                   'dept' => 7, 'years' => 4],
        ['code' => 'BAPoS', 'name' => 'BA in Political Science',                     'dept' => 8, 'years' => 4],
        ['code' => 'BEED',  'name' => 'Bachelor of Elementary Education',            'dept' => 9, 'years' => 4],
    ];

    $stmtProg = $pdo->prepare("INSERT INTO programs (department_id, code, name, major, years, status, created_at) VALUES (?, ?, ?, NULL, ?, 'active', ?)");
    $progMap = [];
    foreach ($programsData as $p) {
        $stmtProg->execute([$p['dept'], $p['code'], $p['name'], $p['years'], $now]);
        $progMap[$p['code']] = (int)$pdo->lastInsertId();
    }

    // Class Sections (Exact 16 sections matching students.sql)
    $sectionsData = [
        ['name' => 'BSTM 1st Year', 'prog' => 'BSTM', 'year' => 1],
        ['name' => 'BSTM 2nd Year', 'prog' => 'BSTM', 'year' => 2],
        ['name' => 'BSTM 3rd Year', 'prog' => 'BSTM', 'year' => 3],
        ['name' => 'BSTM 4th Year', 'prog' => 'BSTM', 'year' => 4],
        ['name' => 'BSIS 1st Year', 'prog' => 'BSIS', 'year' => 1],
        ['name' => 'BSIS 2nd Year', 'prog' => 'BSIS', 'year' => 2],
        ['name' => 'BSIS 3rd Year', 'prog' => 'BSIS', 'year' => 3],
        ['name' => 'BSIS 4th Year', 'prog' => 'BSIS', 'year' => 4],
        ['name' => 'BAPoS 1st Year', 'prog' => 'BAPoS', 'year' => 1],
        ['name' => 'BAPoS 2nd Year', 'prog' => 'BAPoS', 'year' => 2],
        ['name' => 'BAPoS 3rd Year', 'prog' => 'BAPoS', 'year' => 3],
        ['name' => 'BAPoS 4th Year', 'prog' => 'BAPoS', 'year' => 4],
        ['name' => 'BEED 1st Year', 'prog' => 'BEED', 'year' => 1],
        ['name' => 'BEED 2nd Year', 'prog' => 'BEED', 'year' => 2],
        ['name' => 'BEED 3rd Year', 'prog' => 'BEED', 'year' => 3],
        ['name' => 'BEED 4th Year', 'prog' => 'BEED', 'year' => 4],
    ];

    $stmtSec = $pdo->prepare("INSERT INTO sections (program_id, academic_year_id, year_level, name, created_at) VALUES (?, ?, ?, ?, ?)");
    $secMap = [];
    foreach ($sectionsData as $s) {
        $stmtSec->execute([$progMap[$s['prog']], $ayCurrentId, $s['year'], $s['name'], $now]);
        $secMap[$s['name']] = (int)$pdo->lastInsertId();
    }

    // 80 Curriculum Course Subjects (Imported from data/subjects.sql)
    $subjSql = file_get_contents(__DIR__ . '/../data/subjects.sql');
    $sPattern = "/\((\d+),\s*'([^']*)',\s*'([^']*)',\s*'([^']*)',\s*'([^']*)',\s*([0-9.]+),\s*([0-9.]+),\s*'([^']*)',\s*(?:'([^']*)'|NULL),\s*(?:'([^']*)'|NULL),\s*(?:'([^']*)'|NULL)/";
    preg_match_all($sPattern, $subjSql, $subjMatches, PREG_SET_ORDER);

    $stmtSub = $pdo->prepare("INSERT INTO subjects (id, program_id, code, title, lecture_hours, lab_hours, units, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'active', ?)");
    $bsisProgId = $progMap['BSIS'];
    $subjectsDataCount = 0;
    foreach ($subjMatches as $sub) {
        $sId       = (int)$sub[1];
        $code      = trim($sub[2]);
        $title     = trim($sub[3]);
        $category  = trim($sub[5]);
        $units     = (float)$sub[6];
        $reqHours  = (float)$sub[7];
        $lecHours  = ($category === 'laboratory') ? 2.0 : $reqHours;
        $labHours  = ($category === 'laboratory') ? 3.0 : 0.0;

        $stmtSub->execute([
            $sId, $bsisProgId, $code, $title, $lecHours, $labHours, $units, $now
        ]);
        $subjectsDataCount++;
    }

    // Buildings & Rooms
    $buildingsData = [
        ['code' => 'CICS-BLDG', 'name' => 'College of Information & Computing Sciences Building', 'loc' => 'North Campus Complex'],
        ['code' => 'ENG-BLDG',  'name' => 'College of Engineering Building', 'loc' => 'East Campus Engineering Grounds'],
        ['code' => 'ST-BLDG',   'name' => 'Science and Technology Complex', 'loc' => 'Central Research Plaza'],
        ['code' => 'ACAD-BLDG', 'name' => 'Main Academic Hall & Auditorium', 'loc' => 'South Campus Academic Quad'],
    ];

    $stmtBldg = $pdo->prepare("INSERT INTO buildings (code, name, location, created_at) VALUES (?, ?, ?, ?)");
    $bldgMap = [];
    foreach ($buildingsData as $b) {
        $stmtBldg->execute([$b['code'], $b['name'], $b['loc'], $now]);
        $bldgMap[$b['code']] = (int)$pdo->lastInsertId();
    }

    $roomsData = [
        ['number' => 'CICS-LAB-1', 'name' => 'Software Engineering Computer Lab 1', 'type' => 'laboratory', 'bldg' => 'CICS-BLDG', 'cap' => 45],
        ['number' => 'CICS-LAB-2', 'name' => 'Database & Networking Lab 2', 'type' => 'laboratory', 'bldg' => 'CICS-BLDG', 'cap' => 45],
        ['number' => 'CICS-LAB-3', 'name' => 'Multimedia & Web Technologies Lab 3', 'type' => 'laboratory', 'bldg' => 'CICS-BLDG', 'cap' => 40],
        ['number' => 'CICS-201',   'name' => 'Lecture Room 201', 'type' => 'lecture', 'bldg' => 'CICS-BLDG', 'cap' => 50],
        ['number' => 'CICS-202',   'name' => 'Lecture Room 202', 'type' => 'lecture', 'bldg' => 'CICS-BLDG', 'cap' => 50],
        ['number' => 'CICS-AVR',   'name' => 'CICS Audio-Visual Multimedia Room', 'type' => 'auditorium', 'bldg' => 'CICS-BLDG', 'cap' => 120],
        ['number' => 'CICS-FL',    'name' => 'CICS Faculty Consultation Lounge', 'type' => 'office', 'bldg' => 'CICS-BLDG', 'cap' => 30],
        ['number' => 'ACAD-101',   'name' => 'General Education Hall 101', 'type' => 'lecture', 'bldg' => 'ACAD-BLDG', 'cap' => 50],
        ['number' => 'ACAD-102',   'name' => 'General Education Hall 102', 'type' => 'lecture', 'bldg' => 'ACAD-BLDG', 'cap' => 50],
        ['number' => 'ACAD-201',   'name' => 'Social Sciences Lecture Room 201', 'type' => 'lecture', 'bldg' => 'ACAD-BLDG', 'cap' => 50],
        ['number' => 'ACAD-AUD',   'name' => 'MarSU Main University Auditorium', 'type' => 'auditorium', 'bldg' => 'ACAD-BLDG', 'cap' => 500],
    ];

    $stmtRoom = $pdo->prepare("INSERT INTO rooms (building_id, room_number, name, type, capacity, status, created_at) VALUES (?, ?, ?, ?, ?, 'available', ?)");
    foreach ($roomsData as $r) {
        $stmtRoom->execute([$bldgMap[$r['bldg']], $r['number'], $r['name'], $r['type'], $r['cap'], $now]);
    }
    out("  ✔ Created 3 academic years, 9 semesters, 5 departments, 4 programs, 16 sections, {$subjectsDataCount} subjects, and " . count($roomsData) . " rooms.");

    // -------------------------------------------------------------------------
    // STEP 6: 42 REAL FACULTY & STAFF (from data/employee_tbl.sql)
    // -------------------------------------------------------------------------
    out("\n[Step 6/8] Importing 42 authentic Faculty and Staff personnel from data/employee_tbl.sql...");

    $empSql = file_get_contents(__DIR__ . '/../data/employee_tbl.sql');
    $ePattern = "/\((\d+),\s*'([^']*)',\s*'([^']*)',\s*'([^']*)',\s*(?:'([^']*)'|NULL),\s*(\d+),\s*'([^']*)',\s*'([^']*)',\s*(?:'([^']*)'|NULL),\s*(\d+),\s*'([^']*)',\s*'([^']*)'\)/";
    preg_match_all($ePattern, $empSql, $empMatches, PREG_SET_ORDER);

    $pdo->exec("DELETE FROM employees;");
    $stmtEmp = $pdo->prepare("INSERT INTO employees (
        id, user_id, employee_number, first_name, middle_name, last_name, suffix,
        gender, email, contact_number, type, position, `rank`, department_id, status, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, NULL, ?, ?, ?, ?, ?, ?, ?, 'active', ?)");

    $stmtEmpUser = $pdo->prepare("INSERT INTO users (
        username, email, password, first_name, last_name, role, status, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, 'active', ?)
    ON DUPLICATE KEY UPDATE first_name = VALUES(first_name), last_name = VALUES(last_name), role = VALUES(role), updated_at = VALUES(created_at)");

    $facultyRoleId = (int)Database::fetchColumn("SELECT id FROM roles WHERE slug = 'faculty'");
    $deanRoleId    = (int)Database::fetchColumn("SELECT id FROM roles WHERE slug = 'dean'");
    $femaleIndicators = ['annalyn', 'charissa', 'jeanie', 'joy', 'mergiecelyn', 'glynis', 'jeimyleen', 'lean', 'rechille', 'marian', 'mel', 'mheryl', 'khristine', 'aira', 'sharmaine', 'jean'];

    $createdEmpIds = [];
    foreach ($empMatches as $em) {
        $empId      = (int)$em[1];
        $empNo      = trim($em[2]);
        $firstRaw   = trim($em[3]);
        $lastRaw    = trim($em[4]);
        $posRaw     = trim($em[5] ?? 'Staff');
        $deptId     = (int)$em[6];
        $contactRaw = trim($em[7]);
        $createdRaw = trim($em[11] ?? $now);

        $nameParts = preg_split('/\s+/', $firstRaw);
        if (count($nameParts) > 1) {
            $middle = array_pop($nameParts);
            $first  = implode(' ', $nameParts);
        } else {
            $first  = $firstRaw;
            $middle = null;
        }

        $firstLower = strtolower(explode(' ', $first)[0]);
        $gender = in_array($firstLower, $femaleIndicators) ? 'female' : 'male';

        $cleanFirst = strtolower(preg_replace('/[^a-zA-Z]/', '', $firstRaw));
        $cleanLast  = strtolower(preg_replace('/[^a-zA-Z]/', '', $lastRaw));
        $instEmail  = $cleanFirst . '.' . $cleanLast . '@marsu.edu.ph';

        $contact = (empty($contactRaw) || $contactRaw === 'TBA') 
            ? ('09' . [17, 18, 19, 20, 21, 28, 77][($empId % 7)] . str_pad((string)(2000000 + $empId * 137), 7, '0', STR_PAD_LEFT))
            : $contactRaw;

        $isDir   = (strpos(strtoupper($posRaw), 'DIRECTOR') !== false);
        $isHead  = (strpos(strtoupper($posRaw), 'HEAD') !== false);
        $isProf  = (preg_match('/(Professor|Instructor|Lecturer)/i', $posRaw) === 1);

        if ($isDir) {
            $type = 'admin';
            $userRole = 'dean';
            $rank = 'Campus Director';
        } elseif ($isHead) {
            $type = 'faculty';
            $userRole = 'dean';
            $rank = 'Department Chairperson';
        } elseif ($isProf) {
            $type = 'faculty';
            $userRole = 'faculty';
            $rank = $posRaw;
        } else {
            $type = 'staff';
            $userRole = 'faculty';
            $rank = null;
        }

        $username = 'emp_' . strtolower(str_replace(['-', ' '], '_', $empNo));
        $stmtEmpUser->execute([
            $username, $instEmail, $defaultPassHash, $first, $lastRaw, $userRole, $now
        ]);
        $userId = (int)Database::fetchColumn("SELECT id FROM users WHERE username = ?", [$username]);

        $roleIdToAssign = ($userRole === 'dean') ? $deanRoleId : $facultyRoleId;
        if ($userId && $roleIdToAssign) {
            Database::query("INSERT IGNORE INTO user_roles (user_id, role_id) VALUES (?, ?)", [$userId, $roleIdToAssign]);
        }

        $stmtEmp->execute([
            $empId, $userId, $empNo, $first, $middle, $lastRaw,
            $gender, $instEmail, $contact, $type, $posRaw, $rank, $deptId, $createdRaw
        ]);
        $createdEmpIds[$empId] = $empId;
    }
    out("  ✔ Created " . count($createdEmpIds) . " faculty and staff records from employee_tbl.sql.");

    // -------------------------------------------------------------------------
    // STEP 7: STUDENT ORGANIZATIONS WITH REAL FACULTY ADVISERS
    // -------------------------------------------------------------------------
    out("\n[Step 7/8] Seeding recognized student organizations with faculty advisers...");
    $orgsData = [
        ['code' => 'ACIS',       'name' => 'Association of Computing and Information Systems', 'type' => 'academic',   'desc' => 'Premier official student organization of the Department of Information and Communications Technology.', 'adviser' => 4],  // Carlo Magno Castro
        ['code' => 'JPCS-MARSU', 'name' => 'Junior Philippine Computer Society - MarSU Chapter', 'type' => 'academic', 'desc' => 'Nationally affiliated student computing society fostering programming and IT excellence.',                     'adviser' => 15], // Glynis Karen Raza
        ['code' => 'TOURSOC',    'name' => 'Tourism and Hospitality Management Society',        'type' => 'academic',   'desc' => 'Academic guild for BS in Tourism Management students.',                                                    'adviser' => 6],  // Hilarion Elegado
        ['code' => 'PSS-GUILD',  'name' => 'Political Science Students Guild',                 'type' => 'academic',   'desc' => 'Academic and leadership council of BA in Political Science majors.',                                      'adviser' => 9],  // Loriebenn Madriño
        ['code' => 'EDUC-GUILD', 'name' => 'Elementary Educators Guild of MarSU',               'type' => 'academic',   'desc' => 'Student association of aspiring elementary educators.',                                                   'adviser' => 5],  // Annalyn Decena
        ['code' => 'SSC',        'name' => 'Supreme Student Council - Santa Cruz Campus',       'type' => 'socio_civic','desc' => 'Apex student government of Marinduque State University Santa Cruz Campus.',                              'adviser' => 16], // Randell Reginio (Campus Director)
        ['code' => 'RCY',        'name' => 'Philippine Red Cross Youth - MarSU Council',        'type' => 'socio_civic','desc' => 'Youth humanitarian volunteers delivering first-aid, disaster response, and community health.',           'adviser' => 8],  // Wilmer Imperio
    ];

    $pdo->exec("DELETE FROM organizations;");
    $stmtOrg = $pdo->prepare("INSERT INTO organizations (code, name, type, description, adviser_id, status, created_at) VALUES (?, ?, ?, ?, ?, 'accredited', ?)");
    foreach ($orgsData as $org) {
        $stmtOrg->execute([$org['code'], $org['name'], $org['type'], $org['desc'], $org['adviser'], $now]);
    }
    out("  ✔ Registered " . count($orgsData) . " recognized student organizations with real faculty advisers.");

    // -------------------------------------------------------------------------
    // STEP 8: 866 REAL STUDENT RECORDS (from data/students.sql)
    // -------------------------------------------------------------------------
    out("\n[Step 8/8] Importing 866 authentic student records from data/students.sql...");

    $studSql = file_get_contents(__DIR__ . '/../data/students.sql');
    $studPattern = "/\((\d+),\s*'([^']*)',\s*'([^']*)',\s*'([^']*)',\s*'([^']*)',\s*'([^']*)',\s*(?:'([^']*)'|NULL),\s*(?:'([^']*)'|NULL),\s*'([^']*)',\s*(\d+),\s*(\d+),\s*(?:'([^']*)'|NULL),\s*'([^']*)',\s*'([^']*)'\)/";
    preg_match_all($studPattern, $studSql, $studMatches, PREG_SET_ORDER);

    $pdo->exec("DELETE FROM students;");

    $progStringToCode = [
        'BS in Tourism Management'         => 'BSTM',
        'BS in Information Systems'        => 'BSIS',
        'BA in Political Science'          => 'BAPoS',
        'Bachelor of Elementary Education' => 'BEED'
    ];

    $yearStringToNum = [
        '1st Year' => 1,
        '2nd Year' => 2,
        '3rd Year' => 3,
        '4th Year' => 4
    ];

    $marinduqueAddresses = [
        'Brgy. Murallon, Boac, Marinduque',
        'Brgy. San Miguel, Boac, Marinduque',
        'Brgy. Santol, Boac, Marinduque',
        'Brgy. Poras, Boac, Marinduque',
        'Brgy. Baluarte, Boac, Marinduque',
        'Brgy. Laylay, Boac, Marinduque',
        'Brgy. Malusak, Boac, Marinduque',
        'Brgy. Tampus, Boac, Marinduque',
        'Brgy. Amoingon, Boac, Marinduque',
        'Brgy. Balanacan, Mogpog, Marinduque',
        'Brgy. Market Site, Mogpog, Marinduque',
        'Brgy. Capayang, Mogpog, Marinduque',
        'Brgy. Poblacion, Gasan, Marinduque',
        'Brgy. Bahi, Gasan, Marinduque',
        'Brgy. Dawis, Gasan, Marinduque',
        'Brgy. Pinggan, Gasan, Marinduque',
        'Brgy. Poblacion, Santa Cruz, Marinduque',
        'Brgy. Buyabod, Santa Cruz, Marinduque',
        'Brgy. Balogo, Santa Cruz, Marinduque',
        'Brgy. Masaguisi, Santa Cruz, Marinduque',
        'Brgy. Morales, Santa Cruz, Marinduque',
        'Brgy. Malbog, Buenavista, Marinduque',
        'Brgy. Bagacay, Buenavista, Marinduque',
        'Brgy. Poblacion, Torrijos, Marinduque',
        'Brgy. Marlanga, Torrijos, Marinduque',
        'Brgy. Poctoy, Torrijos, Marinduque'
    ];

    $guardiansRelations = ['Mother', 'Father', 'Guardian', 'Auntie', 'Uncle', 'Grandmother'];

    $studentInsertSql = "INSERT INTO students (
        id, user_id, student_number, first_name, middle_name, last_name, suffix,
        gender, birthdate, email, contact_number, address, program_id, year_level, section_id,
        enrollment_status, guardian_name, guardian_contact, created_at, updated_at
    ) VALUES ";

    function parseResetStudentName(string $fullName): array {
        $parts = explode(',', $fullName, 2);
        $lastName = trim($parts[0]);
        $firstAndMiddle = isset($parts[1]) ? trim($parts[1]) : '';
        
        $fmParts = preg_split('/\s+/', $firstAndMiddle);
        $middleName = null;
        $firstName = $firstAndMiddle;
        
        if (count($fmParts) > 1) {
            $lastWord = end($fmParts);
            if (strcasecmp($lastWord, 'None') === 0) {
                array_pop($fmParts);
                $firstName = implode(' ', $fmParts);
                $middleName = null;
            } elseif (strlen(rtrim($lastWord, '.')) <= 2 || strlen($lastWord) === 1) {
                $middleName = array_pop($fmParts);
                $firstName = implode(' ', $fmParts);
            }
        }
        
        return [
            'first_name'  => $firstName ?: $lastName,
            'middle_name' => $middleName,
            'last_name'   => $lastName
        ];
    }

    $values = [];
    $params = [];
    $batchSize = 100;
    $studentCount = 0;

    foreach ($studMatches as $stm) {
        $sId         = (int)$stm[1];
        $studentNo   = trim($stm[2]);
        $fullName    = trim($stm[3]);
        $yearStr     = trim($stm[4]);
        $sectionStr  = trim($stm[5]);
        $progStr     = trim($stm[6]);
        $createdDate = trim($stm[13] ?? $now);

        $parsedName = parseResetStudentName($fullName);
        $progCode   = $progStringToCode[$progStr] ?? 'BSIS';
        $programId  = $progMap[$progCode] ?? $progMap['BSIS'];
        $yearLevel  = $yearStringToNum[$yearStr] ?? 1;
        $sectionId  = $secMap[$sectionStr] ?? null;

        $firstWord = strtolower(explode(' ', $parsedName['first_name'])[0]);
        $isFemale = in_array($firstWord, $femaleIndicators) || (substr($firstWord, -1) === 'a' && !in_array($firstWord, ['joshua', 'joma', 'kuya']));
        $gender = $isFemale ? 'female' : 'male';

        $birthYear = 2008 - $yearLevel;
        $birthMonth = str_pad((string)(($sId % 12) + 1), 2, '0', STR_PAD_LEFT);
        $birthDay = str_pad((string)(($sId % 28) + 1), 2, '0', STR_PAD_LEFT);
        $birthdate = "{$birthYear}-{$birthMonth}-{$birthDay}";

        $cleanFirst = strtolower(preg_replace('/[^a-zA-Z]/', '', $parsedName['first_name']));
        $cleanLast  = strtolower(preg_replace('/[^a-zA-Z]/', '', $parsedName['last_name']));
        $cleanSno   = strtolower(str_replace(['-', ' '], '', $studentNo));
        $email      = $cleanFirst . '.' . $cleanLast . '.' . $cleanSno . '@marsu.edu.ph';

        $contact = '09' . [17, 18, 19, 20, 21, 28, 77][($sId % 7)] . str_pad((string)(4000000 + $sId * 243), 7, '0', STR_PAD_LEFT);
        $address = $marinduqueAddresses[$sId % count($marinduqueAddresses)];

        $rel = $guardiansRelations[$sId % count($guardiansRelations)];
        $gFirst = ($rel === 'Father' || $rel === 'Uncle') ? 'Reynaldo' : 'Carmelita';
        $guardianName = $gFirst . ' ' . $parsedName['last_name'] . ' (' . $rel . ')';
        $guardianContact = '09' . [17, 18, 19, 20, 21, 28, 77][($sId + 3) % 7] . str_pad((string)(5000000 + $sId * 311), 7, '0', STR_PAD_LEFT);

        $values[] = "(?, NULL, ?, ?, ?, ?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, 'enrolled', ?, ?, ?, ?)";
        $params[] = $sId;
        $params[] = $studentNo;
        $params[] = $parsedName['first_name'];
        $params[] = $parsedName['middle_name'];
        $params[] = $parsedName['last_name'];
        $params[] = $gender;
        $params[] = $birthdate;
        $params[] = $email;
        $params[] = $contact;
        $params[] = $address;
        $params[] = $programId;
        $params[] = $yearLevel;
        $params[] = $sectionId;
        $params[] = $guardianName;
        $params[] = $guardianContact;
        $params[] = $createdDate;
        $params[] = $now;

        $studentCount++;

        if (count($values) >= $batchSize) {
            $sql = $studentInsertSql . implode(', ', $values);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $values = [];
            $params = [];
        }
    }

    if (!empty($values)) {
        $sql = $studentInsertSql . implode(', ', $values);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }
    out("  ✔ Successfully generated and inserted {$studentCount} authentic MarSU student records.");

    // Link demo student user account to first BSIS student
    $firstStudent = Database::fetchOne("SELECT id FROM students WHERE program_id = ? ORDER BY id ASC LIMIT 1", [$progMap['BSIS']]);
    if ($firstStudent) {
        $studentUser = Database::fetchOne("SELECT id FROM users WHERE username = 'student' LIMIT 1");
        if ($studentUser) {
            $pdo->prepare("UPDATE students SET user_id = ? WHERE id = ?")->execute([$studentUser['id'], $firstStudent['id']]);
        }
    }

    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // Record system audit log entry
    $adminUser = Database::fetchOne("SELECT id FROM users WHERE username = 'admin' LIMIT 1");
    $adminId = $adminUser['id'] ?? 1;
    $stmtAudit = $pdo->prepare("INSERT INTO audit_logs (user_id, action, entity, entity_id, ip_address, user_agent, details, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtAudit->execute([
        $adminId,
        'SYSTEM_RESET',
        'database',
        null,
        $isCli ? '127.0.0.1 (CLI)' : ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'),
        $isCli ? 'CLI/Runner' : ($_SERVER['HTTP_USER_AGENT'] ?? 'Web/Browser'),
        json_encode([
            'message' => 'Complete clean reset and demo data generation',
            'students_count' => $studentCount,
            'employees_count' => count($createdEmpIds),
            'subjects_count' => $subjectsDataCount,
            'rooms_count' => count($roomsData),
            'organizations_count' => count($orgsData)
        ]),
        $now
    ]);

    $elapsed = round(microtime(true) - $startTime, 2);

    out("\n====================================================================");
    out("                  DEMO DATA GENERATION SUMMARY                      ");
    out("====================================================================");
    out(" Execution Time       : {$elapsed} seconds");
    out(" Security Roles       : " . count($roleRows) . " system roles");
    out(" User Accounts        : " . Database::fetchColumn("SELECT COUNT(*) FROM users") . " accounts (admin, dean, faculty, student, group1..11, employee accounts)");
    out(" Academic Years       : 3 (2024-2025, 2025-2026, 2026-2027 active)");
    out(" Semesters            : 9 semesters (1st Sem 2026-2027 active)");
    out(" Colleges/Departments : " . count($departmentsData) . " academic & administrative units (DICT, DTHM, DPSS, DETE, ADMIN)");
    out(" Academic Programs    : " . count($programsData) . " programs (BSIS, BSTM, BAPoS, BEED)");
    out(" Class Sections       : " . count($sectionsData) . " sections across year levels");
    out(" Course Subjects      : {$subjectsDataCount} curriculum subjects (data/subjects.sql)");
    out(" Buildings & Rooms    : " . count($buildingsData) . " buildings, " . count($roomsData) . " rooms");
    out(" Faculty & Staff      : " . count($createdEmpIds) . " personnel with ranks & designations (data/employee_tbl.sql)");
    out(" Student Orgs         : " . count($orgsData) . " accredited organizations with faculty advisers");
    out(" Students Registered  : {$studentCount} authentic MarSU students (data/students.sql)");
    out(" Audit Log Entry      : Logged to audit_logs");
    out("====================================================================");
    out("✔ DEMO ENVIRONMENT READY AND FULLY POPULATED!\n");

} catch (Exception $e) {
    out("\n❌ ERROR DURING RESET: " . $e->getMessage());
    out("Line: " . $e->getLine() . " in " . $e->getFile());
    if ($isCli) {
        exit(1);
    }
}

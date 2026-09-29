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

    // Colleges and Departments
    $departmentsData = [
        ['code' => 'CICS-DIS', 'name' => 'Department of Information Systems', 'type' => 'department', 'desc' => 'College of Information and Computing Sciences', 'head' => 'Prof. Marites Mercene'],
        ['code' => 'CICS-DCS', 'name' => 'Department of Computer Science', 'type' => 'department', 'desc' => 'College of Information and Computing Sciences', 'head' => 'Prof. Danilo Mabute'],
        ['code' => 'CICS-DIT', 'name' => 'Department of Information Technology', 'type' => 'department', 'desc' => 'College of Information and Computing Sciences', 'head' => 'Prof. Cynthia Paras'],
        ['code' => 'COE-DCE',  'name' => 'Department of Civil Engineering', 'type' => 'department', 'desc' => 'College of Engineering', 'head' => 'Engr. Rogelio Lacierda'],
        ['code' => 'COE-DEE',  'name' => 'Department of Electrical Engineering', 'type' => 'department', 'desc' => 'College of Engineering', 'head' => 'Engr. Carlos Torres'],
        ['code' => 'CED-DSE',  'name' => 'Department of Secondary Education', 'type' => 'department', 'desc' => 'College of Education', 'head' => 'Dr. Rowena Manalo'],
        ['code' => 'CED-DEEd', 'name' => 'Department of Elementary Education', 'type' => 'department', 'desc' => 'College of Education', 'head' => 'Dr. Elena Soberano'],
        ['code' => 'CAS-DLH',  'name' => 'Department of Languages and Humanities', 'type' => 'department', 'desc' => 'College of Arts and Sciences', 'head' => 'Prof. Carmelita Santos'],
        ['code' => 'CAS-DNS',  'name' => 'Department of Natural Sciences', 'type' => 'department', 'desc' => 'College of Arts and Sciences', 'head' => 'Prof. Jaime Hernandez'],
        ['code' => 'CBA-DBA',  'name' => 'Department of Business Administration', 'type' => 'department', 'desc' => 'College of Business and Accountancy', 'head' => 'Prof. Corazon Flores'],
        ['code' => 'CBA-DA',   'name' => 'Department of Accountancy', 'type' => 'department', 'desc' => 'College of Business and Accountancy', 'head' => 'Prof. Fernando Diaz'],
        ['code' => 'CA-DAT',   'name' => 'Department of Agricultural Technology', 'type' => 'department', 'desc' => 'College of Agriculture', 'head' => 'Prof. Manuel Ramos'],
        ['code' => 'ADMIN-REG','name' => 'Office of the University Registrar', 'type' => 'office', 'desc' => 'Central Student Records', 'head' => 'Rowena Manalo'],
        ['code' => 'ADMIN-SAS','name' => 'Office of Student Affairs and Services (OSAS)', 'type' => 'office', 'desc' => 'Student Welfare & Development', 'head' => 'Ernesto Malabanan'],
        ['code' => 'ADMIN-GCO','name' => 'Guidance and Counseling Center', 'type' => 'office', 'desc' => 'Mental Health & Guidance', 'head' => 'Elena Soberano'],
        ['code' => 'ADMIN-MED','name' => 'University Health and Medical Services', 'type' => 'office', 'desc' => 'University Infirmary & Clinic', 'head' => 'Dr. Carlos Montenegro'],
    ];

    $stmtDept = $pdo->prepare("INSERT INTO departments (code, name, type, description, head_name, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $deptMap = [];
    foreach ($departmentsData as $d) {
        $stmtDept->execute([$d['code'], $d['name'], $d['type'], $d['desc'], $d['head'], $now]);
        $deptMap[$d['code']] = (int)$pdo->lastInsertId();
    }

    // Degree Programs
    $programsData = [
        ['code' => 'BSIS', 'name' => 'Bachelor of Science in Information Systems', 'dept' => 'CICS-DIS', 'years' => 4],
        ['code' => 'BSCS', 'name' => 'Bachelor of Science in Computer Science', 'dept' => 'CICS-DCS', 'years' => 4],
        ['code' => 'ACT',  'name' => 'Associate in Computer Technology', 'dept' => 'CICS-DIT', 'years' => 2],
        ['code' => 'BSIT', 'name' => 'Bachelor of Science in Information Technology', 'dept' => 'CICS-DIT', 'years' => 4],
        ['code' => 'BSCE', 'name' => 'Bachelor of Science in Civil Engineering', 'dept' => 'COE-DCE', 'years' => 4],
        ['code' => 'BSEd', 'name' => 'Bachelor of Secondary Education', 'dept' => 'CED-DSE', 'years' => 4],
        ['code' => 'BSBA', 'name' => 'Bachelor of Science in Business Administration', 'dept' => 'CBA-DBA', 'years' => 4],
    ];

    $stmtProg = $pdo->prepare("INSERT INTO programs (department_id, code, name, major, years, status, created_at) VALUES (?, ?, ?, NULL, ?, 'active', ?)");
    $progMap = [];
    foreach ($programsData as $p) {
        $stmtProg->execute([$deptMap[$p['dept']], $p['code'], $p['name'], $p['years'], $now]);
        $progMap[$p['code']] = (int)$pdo->lastInsertId();
    }

    // Class Sections
    $sectionsData = [
        ['name' => 'BSIS 1A', 'prog' => 'BSIS', 'year' => 1],
        ['name' => 'BSIS 1B', 'prog' => 'BSIS', 'year' => 1],
        ['name' => 'BSIS 2A', 'prog' => 'BSIS', 'year' => 2],
        ['name' => 'BSIS 2B', 'prog' => 'BSIS', 'year' => 2],
        ['name' => 'BSIS 3A', 'prog' => 'BSIS', 'year' => 3],
        ['name' => 'BSIS 3B', 'prog' => 'BSIS', 'year' => 3],
        ['name' => 'BSIS 4A', 'prog' => 'BSIS', 'year' => 4],
        ['name' => 'BSIS 4B', 'prog' => 'BSIS', 'year' => 4],
        ['name' => 'BSCS 1A', 'prog' => 'BSCS', 'year' => 1],
        ['name' => 'BSCS 2A', 'prog' => 'BSCS', 'year' => 2],
        ['name' => 'BSCS 3A', 'prog' => 'BSCS', 'year' => 3],
        ['name' => 'BSCS 4A', 'prog' => 'BSCS', 'year' => 4],
        ['name' => 'ACT 1A',  'prog' => 'ACT',  'year' => 1],
        ['name' => 'ACT 2A',  'prog' => 'ACT',  'year' => 2],
        ['name' => 'BSIT 1A', 'prog' => 'BSIT', 'year' => 1],
        ['name' => 'BSIT 2A', 'prog' => 'BSIT', 'year' => 2],
        ['name' => 'BSIT 3A', 'prog' => 'BSIT', 'year' => 3],
        ['name' => 'BSCE 1A', 'prog' => 'BSCE', 'year' => 1],
        ['name' => 'BSCE 2A', 'prog' => 'BSCE', 'year' => 2],
        ['name' => 'BSCE 3A', 'prog' => 'BSCE', 'year' => 3],
        ['name' => 'BSEd 1A', 'prog' => 'BSEd', 'year' => 1],
        ['name' => 'BSEd 2A', 'prog' => 'BSEd', 'year' => 2],
        ['name' => 'BSBA 1A', 'prog' => 'BSBA', 'year' => 1],
        ['name' => 'BSBA 2A', 'prog' => 'BSBA', 'year' => 2],
    ];

    $stmtSec = $pdo->prepare("INSERT INTO sections (program_id, academic_year_id, year_level, name, created_at) VALUES (?, ?, ?, ?, ?)");
    $secMap = [];
    foreach ($sectionsData as $s) {
        $stmtSec->execute([$progMap[$s['prog']], $ayCurrentId, $s['year'], $s['name'], $now]);
        $secMap[$s['name']] = (int)$pdo->lastInsertId();
    }

    // 35+ Curriculum Course Subjects
    $subjectsData = [
        ['code' => 'CC101', 'title' => 'Introduction to Computing', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'CC102', 'title' => 'Fundamentals of Programming', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'CC103', 'title' => 'Intermediate Programming', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'CC104', 'title' => 'Data Structures and Algorithms', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'IS201', 'title' => 'Information Management', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'IS202', 'title' => 'Systems Analysis and Design', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS203', 'title' => 'Enterprise Architecture', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS204', 'title' => 'Business Process Modeling & Design', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'IS301', 'title' => 'IS Strategy, Management & Acquisition', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS302', 'title' => 'Enterprise Systems & Cloud ERP', 'lec' => 2, 'lab' => 3, 'prog' => 'BSIS'],
        ['code' => 'IS303', 'title' => 'Evaluation of Business Performance & Analytics', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS304', 'title' => 'IT Audit and Internal Controls', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS401', 'title' => 'IS Project Management & Quality Assurance', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS402', 'title' => 'Capstone Project 1 (Research & Design)', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'IS403', 'title' => 'Capstone Project 2 (Implementation & Defense)', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'CS201', 'title' => 'Discrete Structures', 'lec' => 3, 'lab' => 0, 'prog' => 'BSCS'],
        ['code' => 'CS202', 'title' => 'Object-Oriented Programming', 'lec' => 2, 'lab' => 3, 'prog' => 'BSCS'],
        ['code' => 'CS301', 'title' => 'Automata Theory and Formal Languages', 'lec' => 3, 'lab' => 0, 'prog' => 'BSCS'],
        ['code' => 'CS302', 'title' => 'Software Engineering', 'lec' => 2, 'lab' => 3, 'prog' => 'BSCS'],
        ['code' => 'CS303', 'title' => 'Operating Systems & Architecture', 'lec' => 2, 'lab' => 3, 'prog' => 'BSCS'],
        ['code' => 'CS304', 'title' => 'Database Systems & SQL Optimization', 'lec' => 2, 'lab' => 3, 'prog' => 'BSCS'],
        ['code' => 'CS401', 'title' => 'Artificial Intelligence & Machine Learning', 'lec' => 2, 'lab' => 3, 'prog' => 'BSCS'],
        ['code' => 'CS402', 'title' => 'Network and Information Security', 'lec' => 2, 'lab' => 3, 'prog' => 'BSCS'],
        ['code' => 'CS403', 'title' => 'Design & Implementation of Compilers', 'lec' => 3, 'lab' => 0, 'prog' => 'BSCS'],
        ['code' => 'ACT101', 'title' => 'Keyboarding and Document Processing', 'lec' => 1, 'lab' => 3, 'prog' => 'ACT'],
        ['code' => 'ACT102', 'title' => 'Computer Systems Servicing & Repair', 'lec' => 1, 'lab' => 3, 'prog' => 'ACT'],
        ['code' => 'GE101', 'title' => 'Purposive Communication', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE102', 'title' => 'Understanding the Self', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE103', 'title' => 'Readings in Philippine History', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE104', 'title' => 'Mathematics in the Modern World', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE105', 'title' => 'The Contemporary World', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE106', 'title' => 'Art Appreciation', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE107', 'title' => 'Ethics', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'GE108', 'title' => 'The Life, Works, and Writings of Jose Rizal', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'PE101', 'title' => 'Physical Fitness and Gymnastics', 'lec' => 2, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'NSTP1', 'title' => 'National Service Training Program 1', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
        ['code' => 'NSTP2', 'title' => 'National Service Training Program 2', 'lec' => 3, 'lab' => 0, 'prog' => 'BSIS'],
    ];

    $stmtSub = $pdo->prepare("INSERT INTO subjects (program_id, code, title, lecture_hours, lab_hours, units, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'active', ?)");
    foreach ($subjectsData as $sub) {
        $units = $sub['lec'] + ($sub['lab'] > 0 ? 1 : 0);
        $stmtSub->execute([
            $progMap[$sub['prog']], $sub['code'], $sub['title'], $sub['lec'], $sub['lab'], $units, $now
        ]);
    }

    // Buildings & 20+ Rooms
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
        // CICS
        ['number' => 'CICS-LAB-1', 'name' => 'Software Engineering Computer Lab 1', 'type' => 'laboratory', 'bldg' => 'CICS-BLDG', 'cap' => 45],
        ['number' => 'CICS-LAB-2', 'name' => 'Database & Networking Lab 2', 'type' => 'laboratory', 'bldg' => 'CICS-BLDG', 'cap' => 45],
        ['number' => 'CICS-LAB-3', 'name' => 'Multimedia & Web Technologies Lab 3', 'type' => 'laboratory', 'bldg' => 'CICS-BLDG', 'cap' => 40],
        ['number' => 'CICS-201',   'name' => 'Lecture Room 201', 'type' => 'lecture', 'bldg' => 'CICS-BLDG', 'cap' => 50],
        ['number' => 'CICS-202',   'name' => 'Lecture Room 202', 'type' => 'lecture', 'bldg' => 'CICS-BLDG', 'cap' => 50],
        ['number' => 'CICS-203',   'name' => 'Lecture Room 203', 'type' => 'lecture', 'bldg' => 'CICS-BLDG', 'cap' => 50],
        ['number' => 'CICS-AVR',   'name' => 'CICS Audio-Visual Multimedia Room', 'type' => 'auditorium', 'bldg' => 'CICS-BLDG', 'cap' => 120],
        ['number' => 'CICS-FL',    'name' => 'CICS Faculty Consultation Lounge', 'type' => 'office', 'bldg' => 'CICS-BLDG', 'cap' => 30],
        // ENG
        ['number' => 'ENG-LAB-1',  'name' => 'Materials & Surveying Testing Lab', 'type' => 'laboratory', 'bldg' => 'ENG-BLDG', 'cap' => 40],
        ['number' => 'ENG-LAB-2',  'name' => 'CAD & Engineering Computing Lab', 'type' => 'laboratory', 'bldg' => 'ENG-BLDG', 'cap' => 45],
        ['number' => 'ENG-101',    'name' => 'Engineering Lecture Room 101', 'type' => 'lecture', 'bldg' => 'ENG-BLDG', 'cap' => 50],
        ['number' => 'ENG-102',    'name' => 'Engineering Lecture Room 102', 'type' => 'lecture', 'bldg' => 'ENG-BLDG', 'cap' => 50],
        ['number' => 'ENG-201',    'name' => 'Engineering Lecture Room 201', 'type' => 'lecture', 'bldg' => 'ENG-BLDG', 'cap' => 50],
        ['number' => 'ENG-DRAW',   'name' => 'Architectural & Engineering Drafting Hall', 'type' => 'lecture', 'bldg' => 'ENG-BLDG', 'cap' => 60],
        // Science & Tech
        ['number' => 'ST-101',     'name' => 'General Science Lecture Room 101', 'type' => 'lecture', 'bldg' => 'ST-BLDG', 'cap' => 50],
        ['number' => 'ST-102',     'name' => 'Physics & Electronics Lab', 'type' => 'laboratory', 'bldg' => 'ST-BLDG', 'cap' => 45],
        ['number' => 'ST-201',     'name' => 'Advanced Computing Lecture 201', 'type' => 'lecture', 'bldg' => 'ST-BLDG', 'cap' => 45],
        ['number' => 'ST-202',     'name' => 'Statistics & Data Science Room 202', 'type' => 'lecture', 'bldg' => 'ST-BLDG', 'cap' => 45],
        ['number' => 'ST-CONF',    'name' => 'Science & Tech Conference Hall', 'type' => 'lecture', 'bldg' => 'ST-BLDG', 'cap' => 100],
        // Academic Hall
        ['number' => 'ACAD-101',   'name' => 'General Education Hall 101', 'type' => 'lecture', 'bldg' => 'ACAD-BLDG', 'cap' => 50],
        ['number' => 'ACAD-102',   'name' => 'General Education Hall 102', 'type' => 'lecture', 'bldg' => 'ACAD-BLDG', 'cap' => 50],
        ['number' => 'ACAD-201',   'name' => 'Social Sciences Lecture Room 201', 'type' => 'lecture', 'bldg' => 'ACAD-BLDG', 'cap' => 50],
        ['number' => 'ACAD-AUD',   'name' => 'MarSU Main University Auditorium', 'type' => 'auditorium', 'bldg' => 'ACAD-BLDG', 'cap' => 500],
    ];

    $stmtRoom = $pdo->prepare("INSERT INTO rooms (building_id, room_number, name, type, capacity, status, created_at) VALUES (?, ?, ?, ?, ?, 'available', ?)");
    foreach ($roomsData as $r) {
        $stmtRoom->execute([$bldgMap[$r['bldg']], $r['number'], $r['name'], $r['type'], $r['cap'], $now]);
    }
    out("  ✔ Created 3 academic years, 9 semesters, 16 departments, 7 programs, 24 sections, 37 subjects, 4 buildings, and 23 rooms.");

    // -------------------------------------------------------------------------
    // STEP 6: 60+ REALISTIC FACULTY & STAFF EMPLOYEES
    // -------------------------------------------------------------------------
    out("\n[Step 6/8] Generating 60+ realistic Faculty and Staff personnel...");

    $firstNamesM = ['Antonio', 'Carlos', 'Danilo', 'Eduardo', 'Fernando', 'Gerardo', 'Jaime', 'Manuel', 'Nestor', 'Orlando', 'Ramon', 'Reynaldo', 'Rodolfo', 'Vicente', 'Wilfredo', 'Rogelio', 'Ernesto', 'Renato', 'Ferdinand', 'Rolando', 'Arnel', 'Edgar', 'Gilbert', 'Noel', 'Rommel'];
    $firstNamesF = ['Carmelita', 'Corazon', 'Elena', 'Evelyn', 'Gloria', 'Josefina', 'Leticia', 'Lorna', 'Luzviminda', 'Marites', 'Nenita', 'Norma', 'Rosario', 'Rowena', 'Teresita', 'Vilma', 'Virginia', 'Zenaida', 'Cynthia', 'Lourdes', 'Divina', 'Fe', 'Imelda', 'Marilou', 'Rosalinda'];
    $surnames    = ['Santos', 'Reyes', 'Cruz', 'Bautista', 'Ocampo', 'Garcia', 'Mendoza', 'Ramos', 'Flores', 'Gonzales', 'Lopez', 'Hernandez', 'Perez', 'Sanchez', 'Ramirez', 'Torres', 'Diaz', 'Morales', 'Castillo', 'Tolentino', 'Lacierda', 'Mercene', 'Mabute', 'Paras', 'Malabanan', 'Alcantara', 'Manalo', 'Dimaculangan', 'De Chavez', 'Soberano', 'Montenegro', 'Villanueva'];

    $ranks = [
        'Professor VI', 'Professor IV', 'Professor I',
        'Associate Professor V', 'Associate Professor III', 'Associate Professor I',
        'Assistant Professor IV', 'Assistant Professor III', 'Assistant Professor II', 'Assistant Professor I',
        'Instructor III', 'Instructor II', 'Instructor I'
    ];

    $pdo->exec("DELETE FROM employees;");
    $stmtEmp = $pdo->prepare("INSERT INTO employees (employee_number, first_name, middle_name, last_name, gender, email, contact_number, type, position, `rank`, department_id, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active', ?)");

    // Key designated administrative and faculty leaders
    $keyEmployees = [
        ['emp_no' => 'EMP-2015-001', 'fname' => 'Rogelio',   'mname' => 'Santos',     'lname' => 'Lacierda',  'gender' => 'male',   'dept' => 'CICS-DIS', 'pos' => 'Dean, CICS', 'rank' => 'Professor IV', 'type' => 'admin'],
        ['emp_no' => 'EMP-2016-012', 'fname' => 'Marites',   'mname' => 'Flores',     'lname' => 'Mercene',   'gender' => 'female', 'dept' => 'CICS-DIS', 'pos' => 'Chairperson, Dept. of Information Systems', 'rank' => 'Associate Professor III', 'type' => 'faculty'],
        ['emp_no' => 'EMP-2017-023', 'fname' => 'Danilo',    'mname' => 'Mendoza',    'lname' => 'Mabute',    'gender' => 'male',   'dept' => 'CICS-DCS', 'pos' => 'Chairperson, Dept. of Computer Science', 'rank' => 'Associate Professor II', 'type' => 'faculty'],
        ['emp_no' => 'EMP-2018-034', 'fname' => 'Cynthia',   'mname' => 'Ramos',      'lname' => 'Paras',     'gender' => 'female', 'dept' => 'CICS-DIT', 'pos' => 'Chairperson, Dept. of Information Technology', 'rank' => 'Assistant Professor IV', 'type' => 'faculty'],
        ['emp_no' => 'EMP-2019-045', 'fname' => 'Ernesto',   'mname' => 'Bautista',   'lname' => 'Malabanan', 'gender' => 'male',   'dept' => 'ADMIN-SAS', 'pos' => 'Director, Office of Student Affairs', 'rank' => 'Associate Professor I', 'type' => 'admin'],
        ['emp_no' => 'EMP-2020-056', 'fname' => 'Rowena',    'mname' => 'Alcantara',  'lname' => 'Manalo',    'gender' => 'female', 'dept' => 'ADMIN-REG', 'pos' => 'University Registrar', 'rank' => 'Assistant Professor III', 'type' => 'admin'],
        ['emp_no' => 'EMP-2021-067', 'fname' => 'Elena',     'mname' => 'Castillo',   'lname' => 'Soberano',  'gender' => 'female', 'dept' => 'ADMIN-GCO', 'pos' => 'Head Guidance Counselor', 'rank' => 'Assistant Professor II', 'type' => 'staff'],
        ['emp_no' => 'EMP-2021-078', 'fname' => 'Carlos',    'mname' => 'Torres',     'lname' => 'Montenegro','gender' => 'male',   'dept' => 'ADMIN-MED', 'pos' => 'University Medical Officer', 'rank' => 'Medical Officer IV', 'type' => 'staff'],
    ];

    $createdEmpIds = [];
    foreach ($keyEmployees as $ke) {
        $email = strtolower($ke['fname'] . '.' . $ke['lname']) . '@marsu.edu.ph';
        $contact = '0917' . rand(1000000, 9999999);
        $stmtEmp->execute([
            $ke['emp_no'], $ke['fname'], $ke['mname'], $ke['lname'], $ke['gender'],
            $email, $contact, $ke['type'], $ke['pos'], $ke['rank'], $deptMap[$ke['dept']], $now
        ]);
        $createdEmpIds[] = (int)$pdo->lastInsertId();
    }

    // Generate remaining 54 employees to total 62
    $deptCodesList = array_keys($deptMap);
    for ($i = 9; $i <= 62; $i++) {
        $isMale = ($i % 2 === 0);
        $fname = $isMale ? $firstNamesM[array_rand($firstNamesM)] : $firstNamesF[array_rand($firstNamesF)];
        $mname = $surnames[array_rand($surnames)];
        $lname = $surnames[array_rand($surnames)];
        $empNo = sprintf('EMP-2026-%04d', 100 + $i);
        $email = strtolower($fname . '.' . $lname . $i) . '@marsu.edu.ph';
        $contact = '09' . [17, 18, 19, 20, 21, 28, 77][array_rand([17, 18, 19, 20, 21, 28, 77])] . rand(1000000, 9999999);
        
        $type = ($i <= 45) ? 'faculty' : 'staff';
        $rank = ($type === 'faculty') ? $ranks[array_rand($ranks)] : null;
        $pos = ($type === 'faculty') ? ($rank . ' of Computing') : (['Administrative Assistant II', 'Records Officer I', 'Laboratory Custodian', 'IT Support Technician', 'Registration Officer'][array_rand(['Administrative Assistant II', 'Records Officer I', 'Laboratory Custodian', 'IT Support Technician', 'Registration Officer'])]);
        
        // CICS gets majority of faculty
        $deptCode = ($i <= 35) ? (['CICS-DIS', 'CICS-DCS', 'CICS-DIT'][array_rand(['CICS-DIS', 'CICS-DCS', 'CICS-DIT'])]) : $deptCodesList[array_rand($deptCodesList)];

        $stmtEmp->execute([
            $empNo, $fname, $mname, $lname, $isMale ? 'male' : 'female',
            $email, $contact, $type, $pos, $rank, $deptMap[$deptCode], $now
        ]);
        $createdEmpIds[] = (int)$pdo->lastInsertId();
    }
    out("  ✔ Created " . count($createdEmpIds) . " faculty and staff records with ranks, departments, and contacts.");

    // -------------------------------------------------------------------------
    // STEP 7: STUDENT ORGANIZATIONS WITH ADVISERS
    // -------------------------------------------------------------------------
    out("\n[Step 7/8] Seeding 8+ recognized student organizations with faculty advisers...");
    $orgsData = [
        ['code' => 'ACIS',  'name' => 'Association of Computing and Information Systems', 'type' => 'academic', 'desc' => 'Premier official student organization of the College of Information and Computing Sciences.', 'adviser' => $createdEmpIds[1]],
        ['code' => 'JPCS',  'name' => 'Junior Philippine Computer Society - MarSU Chapter', 'type' => 'academic', 'desc' => 'Nationally affiliated student computing society fostering programming competitions and open-source software.', 'adviser' => $createdEmpIds[2]],
        ['code' => 'CICS-SC','name' => 'CICS College Student Council', 'type' => 'academic', 'desc' => 'Highest student governing body of the College of Information and Computing Sciences.', 'adviser' => $createdEmpIds[0]],
        ['code' => 'USC',   'name' => 'University Student Council', 'type' => 'socio_civic', 'desc' => 'Apex student government of Marinduque State University across all colleges and campuses.', 'adviser' => $createdEmpIds[4]],
        ['code' => 'COES',  'name' => 'College of Engineering Society', 'type' => 'academic', 'desc' => 'Academic student guild for civil and electrical engineering majors.', 'adviser' => $createdEmpIds[6]],
        ['code' => 'EDUC',  'name' => 'Educators of Tomorrow Guild', 'type' => 'academic', 'desc' => 'Student association of aspiring secondary and elementary educators.', 'adviser' => $createdEmpIds[7]],
        ['code' => 'SIKAP', 'name' => 'Socio-Civic and Cultural Arts Guild (SIKAP)', 'type' => 'socio_civic', 'desc' => 'Promoting traditional Marinduque Moriones cultural arts, dance, and civic community outreach.', 'adviser' => $createdEmpIds[3]],
        ['code' => 'RCY',   'name' => 'Philippine Red Cross Youth - MarSU Council', 'type' => 'socio_civic', 'desc' => 'Youth humanitarian volunteers delivering first-aid, health response, and disaster mitigation.', 'adviser' => $createdEmpIds[5]],
    ];

    $pdo->exec("DELETE FROM organizations;");
    $stmtOrg = $pdo->prepare("INSERT INTO organizations (code, name, type, description, adviser_id, status, created_at) VALUES (?, ?, ?, ?, ?, 'accredited', ?)");
    foreach ($orgsData as $org) {
        $stmtOrg->execute([$org['code'], $org['name'], $org['type'], $org['desc'], $org['adviser'], $now]);
    }
    out("  ✔ Registered 8 recognized student organizations with faculty advisers.");

    // -------------------------------------------------------------------------
    // STEP 8: 520+ REALISTIC FILIPINO STUDENT RECORDS
    // -------------------------------------------------------------------------
    out("\n[Step 8/8] Generating 520+ realistic Filipino student records across year levels and sections...");

    $stuFirstM = [
        'Juan', 'Jose', 'Angelo', 'Mark', 'Joshua', 'Christian', 'Daniel', 'Gabriel', 'John Mark',
        'Kevin', 'Kyle', 'Mark Anthony', 'Nathaniel', 'Paulo', 'Rafael', 'Sean', 'Vincent', 'Justine',
        'Alden', 'Kenneth', 'Miguel', 'Dominic', 'Jerome', 'Adrian', 'Francis', 'Patrick', 'Jericho',
        'Matthew', 'Karl', 'Cedric', 'Russel', 'Bryan', 'Jomar', 'Renz', 'Marvin', 'Jayson', 'Kobe'
    ];

    $stuFirstF = [
        'Maria', 'Alyssa', 'Bea', 'Camille', 'Diane', 'Ella', 'Francesca', 'Joyce', 'Kimberly',
        'Kristine', 'Nicole', 'Patricia', 'Princess', 'Samantha', 'Stephanie', 'Trisha', 'Angelica',
        'Andrea', 'Katrina', 'Hannah', 'Vanessa', 'Rica', 'Clarisse', 'Danielle', 'Eunice', 'Kaye',
        'Mariel', 'Paula', 'Rochelle', 'Sofia', 'Abigail', 'Hazel', 'Janine', 'Princess Joy', 'Mae'
    ];

    $middleNames = [
        'Dela Cruz', 'Santos', 'Garcia', 'Mendoza', 'Ramos', 'Bautista', 'Flores', 'Perez', 'Rivera',
        'Gonzales', 'Aquino', 'Valenzuela', 'Castro', 'Navarro', 'Soriano', 'Villanueva', 'Cortez',
        'Salazar', 'Mercado', 'Reyes', 'Torres', 'De Guzman', 'Castillo', 'Santiago', 'Domingo'
    ];

    $surnamesList = [
        'Dela Cruz', 'Santos', 'Reyes', 'Cruz', 'Bautista', 'Ocampo', 'Garcia', 'Mendoza', 'Ramos',
        'Flores', 'Gonzales', 'Lopez', 'Hernandez', 'Perez', 'Sanchez', 'Ramirez', 'Torres', 'Diaz',
        'Morales', 'Mercado', 'Castillo', 'Tolentino', 'Lacierda', 'Mercene', 'Mabute', 'Paras',
        'Malabanan', 'Alcantara', 'Manalo', 'Dimaculangan', 'De Chavez', 'Soberano', 'Montenegro',
        'Villanueva', 'Lagran', 'Lozano', 'Madregalejo', 'Marquez', 'Montiano', 'Naling', 'Pascua',
        'Quinto', 'Rey', 'Rioflorido', 'Sadiwa', 'Salazar', 'Tan', 'Zulueta', 'Padolina', 'Ornedo'
    ];

    // Authentic Marinduque addresses by municipality & barangay
    $marinduqueAddresses = [
        'Brgy. Murallon, Boac, Marinduque',
        'Brgy. San Miguel, Boac, Marinduque',
        'Brgy. Santol, Boac, Marinduque',
        'Brgy. Poras, Boac, Marinduque',
        'Brgy. Baluarte, Boac, Marinduque',
        'Brgy. Laylay, Boac, Marinduque',
        'Brgy. Malusak, Boac, Marinduque',
        'Brgy. Tampus, Boac, Marinduque',
        'Brgy. Bunganay, Boac, Marinduque',
        'Brgy. Amoingon, Boac, Marinduque',
        'Brgy. Dulong Bayan, Mogpog, Marinduque',
        'Brgy. Market Site, Mogpog, Marinduque',
        'Brgy. Balanacan, Mogpog, Marinduque',
        'Brgy. Silangan, Mogpog, Marinduque',
        'Brgy. Capayang, Mogpog, Marinduque',
        'Brgy. Guisian, Mogpog, Marinduque',
        'Brgy. Gitnang Bayan, Mogpog, Marinduque',
        'Brgy. Poblacion, Gasan, Marinduque',
        'Brgy. Bahi, Gasan, Marinduque',
        'Brgy. Dawis, Gasan, Marinduque',
        'Brgy. Pinggan, Gasan, Marinduque',
        'Brgy. Mahunig, Gasan, Marinduque',
        'Brgy. Libtangin, Gasan, Marinduque',
        'Brgy. Antipolo, Gasan, Marinduque',
        'Brgy. Poblacion, Santa Cruz, Marinduque',
        'Brgy. Buyabod, Santa Cruz, Marinduque',
        'Brgy. Balogo, Santa Cruz, Marinduque',
        'Brgy. Masaguisi, Santa Cruz, Marinduque',
        'Brgy. Morales, Santa Cruz, Marinduque',
        'Brgy. Maniwaya, Santa Cruz, Marinduque',
        'Brgy. Dolores, Santa Cruz, Marinduque',
        'Brgy. Malbog, Buenavista, Marinduque',
        'Brgy. Bagacay, Buenavista, Marinduque',
        'Brgy. Daykitin, Buenavista, Marinduque',
        'Brgy. Lipata, Buenavista, Marinduque',
        'Brgy. Caigangan, Buenavista, Marinduque',
        'Brgy. Poblacion, Torrijos, Marinduque',
        'Brgy. Marlanga, Torrijos, Marinduque',
        'Brgy. Poctoy, Torrijos, Marinduque',
        'Brgy. Dampulan, Torrijos, Marinduque',
        'Brgy. Bonliw, Torrijos, Marinduque',
    ];

    $guardiansRelations = ['Mother', 'Father', 'Guardian', 'Auntie', 'Uncle', 'Elder Sister', 'Grandmother'];

    $pdo->exec("DELETE FROM students;");

    $batchSize = 100;
    $totalStudents = 525;
    $studentInsertSql = "INSERT INTO students (
        student_number, first_name, middle_name, last_name, gender, birthdate,
        email, contact_number, address, program_id, year_level, section_id,
        enrollment_status, guardian_name, guardian_contact, created_at
    ) VALUES ";

    $values = [];
    $params = [];
    $studentCount = 0;

    for ($i = 1; $i <= $totalStudents; $i++) {
        $isMale = (mt_rand(0, 100) < 48); // ~48% male, 52% female
        $fname = $isMale ? $stuFirstM[array_rand($stuFirstM)] : $stuFirstF[array_rand($stuFirstF)];
        $mname = $middleNames[array_rand($middleNames)];
        $lname = $surnamesList[array_rand($surnamesList)];
        
        // Year level distribution: 1st (28%), 2nd (27%), 3rd (27%), 4th (18%)
        $randY = mt_rand(1, 100);
        if ($randY <= 28) {
            $yearLevel = 1;
            $entryYear = 26;
            $birthYear = 2007;
        } elseif ($randY <= 55) {
            $yearLevel = 2;
            $entryYear = 25;
            $birthYear = 2006;
        } elseif ($randY <= 82) {
            $yearLevel = 3;
            $entryYear = 24;
            $birthYear = 2005;
        } else {
            $yearLevel = 4;
            $entryYear = 23;
            $birthYear = 2004;
        }

        // Program distribution: ~58% BSIS (primary modules target), 22% BSCS, 10% ACT, 10% BSIT
        $randP = mt_rand(1, 100);
        if ($randP <= 58) {
            $progCode = 'BSIS';
        } elseif ($randP <= 80) {
            $progCode = 'BSCS';
        } elseif ($randP <= 90) {
            $progCode = 'ACT';
            if ($yearLevel > 2) $yearLevel = 2; // ACT is 2-year
        } else {
            $progCode = 'BSIT';
        }
        $progId = $progMap[$progCode];

        // Section assignment
        $secSuffix = ($i % 2 === 0) ? 'A' : 'B';
        $targetSecName = $progCode . ' ' . $yearLevel . $secSuffix;
        if (!isset($secMap[$targetSecName])) {
            $targetSecName = $progCode . ' ' . $yearLevel . 'A';
        }
        $sectionId = $secMap[$targetSecName] ?? null;

        // Student Number: e.g. 24-0342
        $studentNumber = sprintf('%02d-%04d', $entryYear, $i);

        // Institutional Email: e.g. juan.delacruz240342@marsu.edu.ph
        $cleanFirst = strtolower(preg_replace('/[^a-zA-Z]/', '', $fname));
        $cleanLast  = strtolower(preg_replace('/[^a-zA-Z]/', '', $lname));
        $email = $cleanFirst . '.' . $cleanLast . str_replace('-', '', $studentNumber) . '@marsu.edu.ph';

        $birthMonth = str_pad((string)mt_rand(1, 12), 2, '0', STR_PAD_LEFT);
        $birthDay   = str_pad((string)mt_rand(1, 28), 2, '0', STR_PAD_LEFT);
        $birthdate  = "{$birthYear}-{$birthMonth}-{$birthDay}";

        $phonePrefixes = ['0917', '0918', '0919', '0920', '0921', '0928', '0977', '0995', '0945'];
        $contactNumber = $phonePrefixes[array_rand($phonePrefixes)] . mt_rand(1000000, 9999999);
        $address = $marinduqueAddresses[array_rand($marinduqueAddresses)];

        // Enrollment status: 86% enrolled regular, 8% irregular, 4% on_leave, 2% dropped
        $randStat = mt_rand(1, 100);
        if ($randStat <= 86) {
            $enrollmentStatus = 'enrolled';
        } elseif ($randStat <= 94) {
            $enrollmentStatus = 'irregular';
        } elseif ($randStat <= 98) {
            $enrollmentStatus = 'on_leave';
        } else {
            $enrollmentStatus = 'dropped';
        }

        $rel = $guardiansRelations[array_rand($guardiansRelations)];
        $gFirst = ($rel === 'Father' || $rel === 'Uncle') ? $stuFirstM[array_rand($stuFirstM)] : $stuFirstF[array_rand($stuFirstF)];
        $guardianName = $gFirst . ' ' . $lname . ' (' . $rel . ')';
        $guardianContact = $phonePrefixes[array_rand($phonePrefixes)] . mt_rand(1000000, 9999999);

        $values[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params[] = $studentNumber;
        $params[] = $fname;
        $params[] = $mname;
        $params[] = $lname;
        $params[] = $isMale ? 'male' : 'female';
        $params[] = $birthdate;
        $params[] = $email;
        $params[] = $contactNumber;
        $params[] = $address;
        $params[] = $progId;
        $params[] = $yearLevel;
        $params[] = $sectionId;
        $params[] = $enrollmentStatus;
        $params[] = $guardianName;
        $params[] = $guardianContact;
        $params[] = $now;

        $studentCount++;

        // Batch execution every 100 records
        if (count($values) >= $batchSize) {
            $sql = $studentInsertSql . implode(', ', $values);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $values = [];
            $params = [];
        }
    }

    // Flush remaining students
    if (!empty($values)) {
        $sql = $studentInsertSql . implode(', ', $values);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    out("  ✔ Successfully generated and inserted {$studentCount} realistic Filipino student records.");

    // Link a few student accounts to their user records
    $firstStudent = Database::fetchOne("SELECT id FROM students WHERE student_number = '24-0004' LIMIT 1");
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
            'subjects_count' => count($subjectsData),
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
    out(" User Accounts        : " . Database::fetchColumn("SELECT COUNT(*) FROM users") . " accounts (admin, dean, faculty, student, group1..11)");
    out(" Academic Years       : 3 (2024-2025, 2025-2026, 2026-2027 active)");
    out(" Semesters            : 9 semesters (1st Sem 2026-2027 active)");
    out(" Colleges/Departments : " . count($departmentsData) . " academic & administrative units");
    out(" Academic Programs    : " . count($programsData) . " programs (BSIS, BSCS, ACT, BSIT, BSCE, BSEd, BSBA)");
    out(" Class Sections       : " . count($sectionsData) . " sections across year levels");
    out(" Course Subjects      : " . count($subjectsData) . " curriculum subjects");
    out(" Buildings & Rooms    : " . count($buildingsData) . " buildings, " . count($roomsData) . " rooms");
    out(" Faculty & Staff      : " . count($createdEmpIds) . " personnel with ranks & designations");
    out(" Student Orgs         : " . count($orgsData) . " accredited organizations with advisers");
    out(" Students Registered  : {$studentCount} realistic Filipino records");
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

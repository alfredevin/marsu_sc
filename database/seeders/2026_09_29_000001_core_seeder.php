<?php
use Core\Database;

return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');

        // 1. Roles
        $roles = [
            ['name' => 'Super Administrator', 'slug' => 'super_admin', 'description' => 'Unrestricted universal access across all modules and core settings.'],
            ['name' => 'College Dean', 'slug' => 'dean', 'description' => 'College executive oversight and high-level analytics.'],
            ['name' => 'VP Academic Affairs', 'slug' => 'vpaa', 'description' => 'University-wide academic oversight and reporting.'],
            ['name' => 'Faculty Member', 'slug' => 'faculty', 'description' => 'Instructional management, grading, and advising.'],
            ['name' => 'Student', 'slug' => 'student', 'description' => 'Student self-service portal access.'],
            ['name' => 'Module Lead', 'slug' => 'module_lead', 'description' => 'BSIS student development team lead.']
        ];

        $roleIds = [];
        foreach ($roles as $r) {
            $existing = Database::fetchOne("SELECT id FROM roles WHERE slug = :slug", ['slug' => $r['slug']]);
            if ($existing) {
                $roleIds[$r['slug']] = (int)$existing['id'];
            } else {
                $roleIds[$r['slug']] = Database::insert('roles', [
                    'name'        => $r['name'],
                    'slug'        => $r['slug'],
                    'description' => $r['description'],
                    'created_at'  => $now
                ]);
            }
        }

        // 2. Core Permissions
        $corePermissions = [
            'core.dashboard.view'     => 'View Executive & Core Dashboards',
            'core.roles.view'          => 'View Roles and Permissions',
            'core.roles.create'        => 'Create New System Roles',
            'core.roles.edit'          => 'Modify Roles & Privileges',
            'core.roles.delete'        => 'Delete System Roles',
            'core.users.view'          => 'View User Accounts',
            'core.users.create'        => 'Create User Accounts',
            'core.users.edit'          => 'Edit User Profiles',
            'core.users.delete'        => 'Deactivate/Delete User Accounts',
            'core.students.view'       => 'View Student Registry',
            'core.students.create'     => 'Enroll / Register Students',
            'core.students.edit'       => 'Update Student Profiles',
            'core.students.delete'     => 'Archive / Remove Students',
            'core.students.import'     => 'Bulk CSV Import Students',
            'core.students.export'     => 'Export Student Records',
            'core.employees.view'      => 'View Employee Registry',
            'core.employees.create'    => 'Add Faculty & Staff Records',
            'core.employees.edit'      => 'Update Employee Profiles',
            'core.employees.delete'    => 'Remove Employee Records',
            'core.employees.import'    => 'Bulk CSV Import Employees',
            'core.employees.export'    => 'Export Employee Directory',
            'core.departments.view'    => 'View Colleges & Departments',
            'core.departments.create'  => 'Create Departments',
            'core.departments.edit'    => 'Modify Department Details',
            'core.departments.delete'  => 'Delete Departments',
            'core.programs.view'       => 'View Academic Programs',
            'core.programs.create'     => 'Create Academic Programs',
            'core.programs.edit'       => 'Modify Academic Programs',
            'core.programs.delete'     => 'Delete Academic Programs',
            'core.subjects.view'       => 'View Course Curriculum',
            'core.subjects.create'     => 'Add Curriculum Subjects',
            'core.subjects.edit'       => 'Edit Subject Details',
            'core.subjects.delete'     => 'Delete Subjects',
            'core.subjects.import'     => 'Bulk CSV Import Subjects',
            'core.subjects.export'     => 'Export Subjects',
            'core.academics.view'      => 'View Academic Years & Semesters',
            'core.academics.manage'    => 'Manage Academic Calendars & Sections',
            'core.facilities.view'     => 'View Campus Buildings & Rooms',
            'core.facilities.manage'   => 'Manage Buildings & Room Inventory',
            'core.organizations.view'  => 'View Student Organizations Registry',
            'core.organizations.manage'=> 'Manage Accredited Organizations',
            'core.audit.view'          => 'Inspect System Audit Logs',
            'core.settings.view'       => 'View System Settings',
            'core.settings.edit'       => 'Modify System & Theme Settings',
            'core.modules.view'        => 'View Discovered Modules',
            'core.modules.manage'      => 'Enable/Disable System Modules'
        ];

        $permIds = [];
        foreach ($corePermissions as $pKey => $pDesc) {
            $existing = Database::fetchOne("SELECT id FROM permissions WHERE name = :name", ['name' => $pKey]);
            if ($existing) {
                $permIds[$pKey] = (int)$existing['id'];
            } else {
                $permIds[$pKey] = Database::insert('permissions', [
                    'name'        => $pKey,
                    'module'      => 'core',
                    'description' => $pDesc,
                    'created_at'  => $now
                ]);
            }
        }

        // Assign all permissions to Super Admin role
        foreach ($permIds as $pId) {
            Database::query("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [
                $roleIds['super_admin'],
                $pId
            ]);
        }

        // Assign read and executive permissions to Dean and VPAA
        $deanPerms = [
            'core.dashboard.view', 'core.students.view', 'core.students.export',
            'core.employees.view', 'core.employees.export', 'core.departments.view',
            'core.programs.view', 'core.subjects.view', 'core.academics.view',
            'core.facilities.view', 'core.organizations.view', 'core.audit.view'
        ];
        foreach ($deanPerms as $dp) {
            if (isset($permIds[$dp])) {
                Database::query("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [
                    $roleIds['dean'],
                    $permIds[$dp]
                ]);
                Database::query("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [
                    $roleIds['vpaa'],
                    $permIds[$dp]
                ]);
            }
        }

        // 3. Default Users
        $defaultPassword = password_hash('Password123!', PASSWORD_BCRYPT, ['cost' => 12]);

        $users = [
            [
                'username'   => 'admin',
                'email'      => 'admin@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'System',
                'last_name'  => 'Administrator',
                'role'       => 'super_admin',
                'role_slug'  => 'super_admin'
            ],
            [
                'username'   => 'dean',
                'email'      => 'dean.cics@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Dr. Arnel',
                'last_name'  => 'Lacierda',
                'role'       => 'dean',
                'role_slug'  => 'dean'
            ],
            [
                'username'   => 'faculty',
                'email'      => 'faculty@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Prof. Juan',
                'last_name'  => 'Dela Cruz',
                'role'       => 'faculty',
                'role_slug'  => 'faculty'
            ],
            [
                'username'   => 'student',
                'email'      => 'student@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Maria',
                'last_name'  => 'Santos',
                'role'       => 'student',
                'role_slug'  => 'student'
            ]
        ];

        foreach ($users as $u) {
            $existing = Database::fetchOne("SELECT id FROM users WHERE username = :username", ['username' => $u['username']]);
            $uId = null;
            if ($existing) {
                $uId = (int)$existing['id'];
            } else {
                $uId = Database::insert('users', [
                    'username'   => $u['username'],
                    'email'      => $u['email'],
                    'password'   => $u['password'],
                    'first_name' => $u['first_name'],
                    'last_name'  => $u['last_name'],
                    'avatar'     => 'public/assets/img/undraw_profile.svg',
                    'role'       => $u['role'],
                    'status'     => 'active',
                    'created_at' => $now
                ]);
            }

            // Link in user_roles
            if (isset($roleIds[$u['role_slug']])) {
                Database::query("INSERT IGNORE INTO user_roles (user_id, role_id) VALUES (?, ?)", [
                    $uId,
                    $roleIds[$u['role_slug']]
                ]);
            }
        }

        // 4. System Settings
        $settings = [
            'system_name'          => ['MarSU Centralized ERP', 'general'],
            'university_name'      => ['Marinduque State University', 'general'],
            'college_name'         => ['College of Information and Computing Sciences', 'general'],
            'tagline'              => ['Empowering Minds, Transforming Lives, and Advancing Opportunities with HEART', 'general'],
            'school_address'       => ['Panfilo M. Manguera Sr. Rd., Brgy. Tanza, Boac, Marinduque 4900', 'general'],
            'system_logo'          => ['public/assets/img/marsu.png', 'appearance'],
            'active_academic_year' => ['2026-2027', 'academic'],
            'active_semester'      => ['1', 'academic'],
            'theme_accent'         => ['#D4AF37', 'appearance']
        ];

        foreach ($settings as $key => [$val, $grp]) {
            Database::query("INSERT INTO settings (`key`, `value`, `group`, created_at) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)", [
                $key, $val, $grp, $now
            ]);
        }

        // 5. Academic Year & Semester
        $ay = Database::fetchOne("SELECT id FROM academic_years WHERE code = '2026-2027'");
        $ayId = null;
        if ($ay) {
            $ayId = (int)$ay['id'];
        } else {
            $ayId = Database::insert('academic_years', [
                'code'       => '2026-2027',
                'label'      => 'A.Y. 2026-2027',
                'start_date' => '2026-08-01',
                'end_date'   => '2027-06-30',
                'is_active'  => 1,
                'created_at' => $now
            ]);
        }

        // Semesters
        $semesters = [
            ['code' => '1', 'name' => '1st Semester', 'is_active' => 1],
            ['code' => '2', 'name' => '2nd Semester', 'is_active' => 0],
            ['code' => 'summer', 'name' => 'Summer Term', 'is_active' => 0]
        ];
        foreach ($semesters as $s) {
            Database::query("INSERT IGNORE INTO semesters (academic_year_id, code, name, is_active, created_at) VALUES (?, ?, ?, ?, ?)", [
                $ayId, $s['code'], $s['name'], $s['is_active'], $now
            ]);
        }

        // 6. Colleges & Departments
        $departments = [
            ['code' => 'CICS', 'name' => 'College of Information and Computing Sciences', 'type' => 'college', 'head_name' => 'Dr. Arnel Lacierda'],
            ['code' => 'CAS', 'name' => 'College of Arts and Sciences', 'type' => 'college', 'head_name' => 'Dr. Victoria M. Sotto'],
            ['code' => 'COE', 'name' => 'College of Engineering', 'type' => 'college', 'head_name' => 'Engr. Michael L. Tan'],
            ['code' => 'COED', 'name' => 'College of Education', 'type' => 'college', 'head_name' => 'Dr. Elena P. Ramos'],
            ['code' => 'MIS', 'name' => 'Management Information Systems Office', 'type' => 'office', 'head_name' => 'Engr. Roberto Gomez']
        ];
        $deptIds = [];
        foreach ($departments as $d) {
            $existing = Database::fetchOne("SELECT id FROM departments WHERE code = :code", ['code' => $d['code']]);
            if ($existing) {
                $deptIds[$d['code']] = (int)$existing['id'];
            } else {
                $deptIds[$d['code']] = Database::insert('departments', [
                    'code'       => $d['code'],
                    'name'       => $d['name'],
                    'type'       => $d['type'],
                    'head_name'  => $d['head_name'],
                    'created_at' => $now
                ]);
            }
        }

        // 7. Academic Programs
        $cicsId = $deptIds['CICS'] ?? 1;
        $programs = [
            ['code' => 'BSIS', 'name' => 'Bachelor of Science in Information Systems', 'years' => 4, 'dept' => $cicsId],
            ['code' => 'BSCS', 'name' => 'Bachelor of Science in Computer Science', 'years' => 4, 'dept' => $cicsId],
            ['code' => 'ACT', 'name' => 'Associate in Computer Technology', 'years' => 2, 'dept' => $cicsId]
        ];
        $progIds = [];
        foreach ($programs as $p) {
            $existing = Database::fetchOne("SELECT id FROM programs WHERE code = :code", ['code' => $p['code']]);
            if ($existing) {
                $progIds[$p['code']] = (int)$existing['id'];
            } else {
                $progIds[$p['code']] = Database::insert('programs', [
                    'department_id' => $p['dept'],
                    'code'          => $p['code'],
                    'name'          => $p['name'],
                    'years'         => $p['years'],
                    'status'        => 'active',
                    'created_at'    => $now
                ]);
            }
        }

        // 8. Sections (BSIS 3A, BSIS 3B)
        $bsisId = $progIds['BSIS'] ?? 1;
        $sections = [
            ['name' => 'BSIS 3A', 'year_level' => 3],
            ['name' => 'BSIS 3B', 'year_level' => 3],
            ['name' => 'BSIS 1A', 'year_level' => 1],
            ['name' => 'BSIS 2A', 'year_level' => 2],
            ['name' => 'BSIS 4A', 'year_level' => 4]
        ];
        foreach ($sections as $sec) {
            Database::query("INSERT IGNORE INTO sections (program_id, academic_year_id, year_level, name, created_at) VALUES (?, ?, ?, ?, ?)", [
                $bsisId, $ayId, $sec['year_level'], $sec['name'], $now
            ]);
        }

        // 9. Buildings & Rooms
        $bldg = Database::fetchOne("SELECT id FROM buildings WHERE code = 'CICS-BLDG'");
        $bldgId = null;
        if ($bldg) {
            $bldgId = (int)$bldg['id'];
        } else {
            $bldgId = Database::insert('buildings', [
                'code'       => 'CICS-BLDG',
                'name'       => 'CICS Academic Building',
                'location'   => 'Main Campus, Boac',
                'created_at' => $now
            ]);
        }

        $rooms = [
            ['room_number' => 'CL-101', 'name' => 'Computer Laboratory 1', 'type' => 'laboratory', 'capacity' => 45],
            ['room_number' => 'CL-102', 'name' => 'Computer Laboratory 2', 'type' => 'laboratory', 'capacity' => 45],
            ['room_number' => 'LEC-201', 'name' => 'Multimedia Lecture Hall 1', 'type' => 'lecture', 'capacity' => 50],
            ['room_number' => 'LEC-202', 'name' => 'Instructional Room 202', 'type' => 'lecture', 'capacity' => 40],
            ['room_number' => 'OFF-101', 'name' => 'Dean\'s Office & Faculty Lounge', 'type' => 'office', 'capacity' => 15]
        ];
        foreach ($rooms as $rm) {
            Database::query("INSERT IGNORE INTO rooms (building_id, room_number, name, type, capacity, created_at) VALUES (?, ?, ?, ?, ?, ?)", [
                $bldgId, $rm['room_number'], $rm['name'], $rm['type'], $rm['capacity'], $now
            ]);
        }

        // 10. Student Organizations Registry
        $orgs = [
            ['code' => 'ACIS', 'name' => 'Association of Computing and Information Students', 'type' => 'academic'],
            ['code' => 'JPCS-MARSU', 'name' => 'Junior Philippine Computer Society - MarSU Chapter', 'type' => 'academic'],
            ['code' => 'SSC', 'name' => 'Supreme Student Council', 'type' => 'socio_civic'],
            ['code' => 'CICS-SPORTS', 'name' => 'CICS Cyber Athletics & Esports Guild', 'type' => 'sports']
        ];
        foreach ($orgs as $org) {
            Database::query("INSERT IGNORE INTO organizations (code, name, type, created_at) VALUES (?, ?, ?, ?)", [
                $org['code'], $org['name'], $org['type'], $now
            ]);
        }
    }
};

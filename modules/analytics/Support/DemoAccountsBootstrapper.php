<?php
namespace Modules\Analytics\Support;

use Core\Database;
use Core\Session;
use Core\ModuleLoader;

/**
 * Ensures demo accounts and RBAC access from modules/analytics/env are
 * always present in the database across all development laptops.
 *
 * Runs automatically on routes boot, migrations, or seeders.
 */
class DemoAccountsBootstrapper
{
    private static bool $bootstrappedInRequest = false;

    /**
     * Fast non-blocking check. If demo accounts are already verified in the current session,
     * it returns immediately with zero database overhead.
     */
    public static function ensure(bool $force = false): void
    {
        if (self::$bootstrappedInRequest) {
            return;
        }
        self::$bootstrappedInRequest = true;

        if (!$force && PHP_SAPI !== 'cli') {
            try {
                if (class_exists(Session::class) && Session::has('ana_demo_accounts_ready')) {
                    return;
                }
            } catch (\Throwable $e) {
                // Ignore session exceptions
            }
        }

        try {
            // Quick check: does the programhead user exist and has mapped programs?
            $ph = Database::fetchOne(
                "SELECT u.id, ur.role_id 
                 FROM `users` u 
                 LEFT JOIN `user_roles` ur ON ur.user_id = u.id 
                 WHERE u.username = 'programhead' AND u.deleted_at IS NULL LIMIT 1"
            );

            if ($ph && !empty($ph['role_id'])) {
                $mapped = Database::fetchOne(
                    "SELECT id FROM `ana_program_heads` WHERE user_id = :uid LIMIT 1",
                    ['uid' => (int)$ph['id']]
                );
                if ($mapped) {
                    if (PHP_SAPI !== 'cli' && class_exists(Session::class)) {
                        Session::set('ana_demo_accounts_ready', true);
                    }
                    return;
                }
            }
        } catch (\Throwable $e) {
            // Table might be missing or DB not yet ready; proceed to bootstrap
        }

        self::bootstrap();
    }

    /**
     * Provisions the schema tables, roles, permissions, accounts and links.
     */
    public static function bootstrap(): array
    {
        $log = [];
        $now = date('Y-m-d H:i:s');

        try {
            $db = Database::pdo();
        } catch (\Throwable $e) {
            return ['error' => 'Database connection failed: ' . $e->getMessage()];
        }

        // 1. Ensure `ana_program_heads` table exists
        try {
            $db->exec("CREATE TABLE IF NOT EXISTS `ana_program_heads` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `user_id` INT NOT NULL,
                `program_id` INT NOT NULL,
                `created_by` INT NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL,
                UNIQUE KEY `uq_ana_ph` (`user_id`, `program_id`),
                CONSTRAINT `fk_ana_ph_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
                CONSTRAINT `fk_ana_ph_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
                CONSTRAINT `fk_ana_ph_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
            $log[] = 'Verified table: ana_program_heads';
        } catch (\Throwable $e) {
            // Table may already exist or foreign key format differing
        }

        // 2. Ensure Roles exist
        $rolesToEnsure = [
            'program_head' => ['Program Head', 'Read-only academic oversight for the programs mapped to this account.'],
            'registrar'    => ['Registrar', 'Manages official term enrollment, masterlists and registration forms.'],
            'faculty'      => ['Faculty Member', 'Faculty instructor managing class records and grades.'],
            'student'      => ['Student', 'Enrolled student viewing own academic portal.'],
        ];

        foreach ($rolesToEnsure as $slug => [$name, $desc]) {
            try {
                $existing = Database::fetchOne("SELECT id FROM `roles` WHERE slug = :s", ['s' => $slug]);
                if (!$existing) {
                    Database::insert('roles', [
                        'name'        => $name,
                        'slug'        => $slug,
                        'description' => $desc,
                        'created_at'  => $now,
                    ]);
                }
            } catch (\Throwable $e) {}
        }

        // 3. Sync permissions from module.json
        if (class_exists(ModuleLoader::class) && method_exists(ModuleLoader::class, 'syncPermissions')) {
            try {
                ModuleLoader::syncPermissions();
            } catch (\Throwable $e) {}
        }

        // 4. Role Permissions Mapping
        $coreRegistrarPerms = [
            'core.dashboard.view', 'core.students.view', 'core.students.create', 'core.students.edit',
            'core.students.import', 'core.students.export', 'core.programs.view', 'core.subjects.view',
            'core.academics.view',
        ];

        $declaredPerms = self::declaredPermissions();

        $grants = [
            'student'        => ['analytics.student.portal', 'core.dashboard.view'],
            'faculty'        => ['analytics.faculty.classes', 'analytics.faculty.attendance', 'analytics.faculty.behavior', 'analytics.view', 'core.dashboard.view'],
            'registrar'      => array_merge(['analytics.registrar.enrollment', 'analytics.registrar.view'], $coreRegistrarPerms),
            'program_head'   => ['analytics.view', 'analytics.export', 'core.dashboard.view'],
            'lead_analytics' => $declaredPerms,
            'super_admin'    => $declaredPerms,
        ];

        try {
            $permRows = Database::fetchAll("SELECT id, name FROM `permissions`");
            $permIds = [];
            foreach ($permRows as $p) {
                $permIds[$p['name']] = (int)$p['id'];
            }

            $roleRows = Database::fetchAll("SELECT id, slug FROM `roles`");
            $roleIds = [];
            foreach ($roleRows as $r) {
                $roleIds[$r['slug']] = (int)$r['id'];
            }

            foreach ($grants as $roleSlug => $keys) {
                if (!isset($roleIds[$roleSlug])) {
                    continue;
                }
                $rId = $roleIds[$roleSlug];
                foreach ($keys as $k) {
                    if (isset($permIds[$k])) {
                        Database::query(
                            "INSERT IGNORE INTO `role_permissions` (`role_id`, `permission_id`) VALUES (?, ?)",
                            [$rId, $permIds[$k]]
                        );
                    }
                }
            }
        } catch (\Throwable $e) {}

        // 5. Ensure Demo Accounts from modules/analytics/env
        $defaultPassword = password_hash('Password123!', PASSWORD_BCRYPT, ['cost' => 12]);

        $accounts = [
            [
                'username'   => 'programhead',
                'email'      => 'programhead@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Ramon',
                'last_name'  => 'Castillo',
                'role'       => 'program_head',
            ],
            [
                'username'   => 'registrar',
                'email'      => 'registrar@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Rosa',
                'last_name'  => 'Villanueva',
                'role'       => 'registrar',
            ],
            [
                'username'   => 'faculty',
                'email'      => 'faculty@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Prof. Juan',
                'last_name'  => 'Dela Cruz',
                'role'       => 'faculty',
            ],
            [
                'username'   => 'student',
                'email'      => 'student@marsu.edu.ph',
                'password'   => $defaultPassword,
                'first_name' => 'Jake Louis',
                'last_name'  => 'Almonte',
                'role'       => 'student',
            ],
        ];

        $userIds = [];
        foreach ($accounts as $acc) {
            try {
                $user = Database::fetchOne("SELECT id FROM `users` WHERE `username` = :u", ['u' => $acc['username']]);
                $uId = null;

                if ($user) {
                    $uId = (int)$user['id'];
                    // Ensure password and role are active
                    Database::update(
                        'users',
                        [
                            'password'   => $acc['password'],
                            'role'       => $acc['role'],
                            'status'     => 'active',
                            'deleted_at' => null,
                        ],
                        'id = :id',
                        ['id' => $uId]
                    );
                } else {
                    // Check if email taken
                    $emailUser = Database::fetchOne("SELECT id FROM `users` WHERE `email` = :e", ['e' => $acc['email']]);
                    if ($emailUser) {
                        $uId = (int)$emailUser['id'];
                        Database::update(
                            'users',
                            [
                                'username'   => $acc['username'],
                                'password'   => $acc['password'],
                                'role'       => $acc['role'],
                                'status'     => 'active',
                                'deleted_at' => null,
                            ],
                            'id = :id',
                            ['id' => $uId]
                        );
                    } else {
                        $uId = Database::insert('users', [
                            'username'   => $acc['username'],
                            'email'      => $acc['email'],
                            'password'   => $acc['password'],
                            'first_name' => $acc['first_name'],
                            'last_name'  => $acc['last_name'],
                            'avatar'     => 'public/assets/img/undraw_profile.svg',
                            'role'       => $acc['role'],
                            'status'     => 'active',
                            'created_at' => $now,
                        ]);
                    }
                }

                $userIds[$acc['username']] = $uId;

                // Ensure linked in user_roles
                $roleRow = Database::fetchOne("SELECT id FROM `roles` WHERE slug = :s", ['s' => $acc['role']]);
                if ($roleRow && $uId) {
                    Database::query(
                        "INSERT IGNORE INTO `user_roles` (`user_id`, `role_id`) VALUES (?, ?)",
                        [$uId, (int)$roleRow['id']]
                    );
                }
            } catch (\Throwable $e) {}
        }

        // 6. Map programhead -> BSIS and ACT programs
        if (!empty($userIds['programhead'])) {
            try {
                $phId = (int)$userIds['programhead'];
                $progs = Database::fetchAll("SELECT id FROM `programs` WHERE code IN ('BSIS', 'ACT') AND deleted_at IS NULL");
                foreach ($progs as $p) {
                    Database::query(
                        "INSERT IGNORE INTO `ana_program_heads` (`user_id`, `program_id`, `created_at`) VALUES (?, ?, ?)",
                        [$phId, (int)$p['id'], $now]
                    );
                }
            } catch (\Throwable $e) {}
        }

        // 7. Link student user -> Student record 26S0227 (Jake Louis Almonte, BSIS)
        if (!empty($userIds['student'])) {
            try {
                $stUid = (int)$userIds['student'];
                Database::query(
                    "UPDATE `students` SET `user_id` = :uid WHERE `student_number` = '26S0227' LIMIT 1",
                    ['uid' => $stUid]
                );
            } catch (\Throwable $e) {}
        }

        if (PHP_SAPI !== 'cli' && class_exists(Session::class)) {
            try {
                Session::set('ana_demo_accounts_ready', true);
            } catch (\Throwable $e) {}
        }

        return ['success' => true];
    }

    private static function declaredPermissions(): array
    {
        $jsonFile = dirname(__DIR__) . '/module.json';
        if (!file_exists($jsonFile)) {
            return [];
        }
        $json = json_decode((string)file_get_contents($jsonFile), true);
        return array_keys($json['permissions'] ?? []);
    }
}

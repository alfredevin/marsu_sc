<?php
/**
 * Seeder: Retention Module Role Permissions
 * Synchronizes module.json declared permissions and idempotently grants them to target roles.
 */

use Core\Database;
use Core\ModuleLoader;

return new class {
    public function run(): void {
        // 1. Sync declared permissions from module.json into permissions table
        if (class_exists(ModuleLoader::class) && method_exists(ModuleLoader::class, 'syncPermissions')) {
            ModuleLoader::syncPermissions();
        }

        $pdo = Database::pdo();

        // 2. Map role slugs to desired retention permission keys
        $rolePermissionMap = [
            'student' => [
                'retention.student.portal',
            ],
            'faculty' => [
                'retention.faculty.classes',
                'retention.faculty.attendance',
                'retention.faculty.behavior',
            ],
            'dean' => [
                'retention.view',
                'retention.export',
            ],
            'vpaa' => [
                'retention.view',
                'retention.export',
            ],
            'lead_retention' => [
                'retention.student.portal',
                'retention.faculty.classes',
                'retention.faculty.attendance',
                'retention.faculty.behavior',
                'retention.view',
                'retention.export',
                'retention.admin.settings',
                'retention.admin.classes',
                'retention.admin.grades',
                'retention.admin.attendance',
                'retention.admin.conduct',
                'retention.admin.profiles',
                'retention.analyze',
                'retention.intervene',
            ],
        ];

        // 3. Load all permissions for mapping
        $allPermissions = Database::fetchAll("SELECT id, name FROM `permissions` WHERE `module` = 'retention'");
        $permissionIdByName = [];
        foreach ($allPermissions as $p) {
            $permissionIdByName[$p['name']] = (int) $p['id'];
        }

        // 4. Fetch available roles
        $roles = Database::fetchAll("SELECT id, slug FROM `roles`");
        $roleIdBySlug = [];
        foreach ($roles as $r) {
            $roleIdBySlug[$r['slug']] = (int) $r['id'];
        }

        // 5. Idempotently insert into role_permissions
        $stmt = $pdo->prepare("INSERT IGNORE INTO `role_permissions` (`role_id`, `permission_id`) VALUES (?, ?)");

        foreach ($rolePermissionMap as $roleSlug => $permKeys) {
            if (!isset($roleIdBySlug[$roleSlug])) {
                continue; // Skip any missing role
            }
            $roleId = $roleIdBySlug[$roleSlug];

            foreach ($permKeys as $permKey) {
                if (!isset($permissionIdByName[$permKey])) {
                    continue;
                }
                $permId = $permissionIdByName[$permKey];
                $stmt->execute([$roleId, $permId]);
            }
        }
    }
};

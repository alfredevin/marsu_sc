<?php
/**
 * Seeder: Academic Analytics Module Role Permissions
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

        // 2. Map role slugs to desired analytics permission keys
        $rolePermissionMap = [
            'faculty' => [
                'analytics.faculty.classes',
                'analytics.faculty.attendance',
                'analytics.faculty.behavior',
            ],
            'dean' => [
                'analytics.view',
                'analytics.export',
            ],
            'vpaa' => [
                'analytics.view',
                'analytics.export',
            ],
            'lead_analytics' => [
                'analytics.faculty.classes',
                'analytics.faculty.attendance',
                'analytics.faculty.behavior',
                'analytics.view',
                'analytics.create',
                'analytics.edit',
                'analytics.export',
                'analytics.admin.settings',
                'analytics.admin.classes',
                'analytics.admin.grades',
                'analytics.admin.attendance',
                'analytics.admin.conduct',
                'analytics.admin.profiles',
            ],
            'admin' => [
                'analytics.faculty.classes',
                'analytics.faculty.attendance',
                'analytics.faculty.behavior',
                'analytics.view',
                'analytics.create',
                'analytics.edit',
                'analytics.export',
                'analytics.admin.settings',
                'analytics.admin.classes',
                'analytics.admin.grades',
                'analytics.admin.attendance',
                'analytics.admin.conduct',
                'analytics.admin.profiles',
            ],
        ];

        // 3. Load all permissions for mapping
        $allPermissions = Database::fetchAll("SELECT id, name FROM `permissions` WHERE `module` = 'analytics'");
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
                continue;
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

<?php
namespace Core;

/**
 * MarSU Centralized ERP - Dynamic Multi-Module Auto-Discovery Engine
 * Discovers modules from /modules/*\/module.json with zero core file edits.
 */
class ModuleLoader {
    private static ?array $modules = null;
    private static ?array $enabledModules = null;

    /**
     * Discover all modules present in /modules/
     */
    public static function discover(): array {
        if (self::$modules !== null) {
            return self::$modules;
        }

        $baseDir = dirname(__DIR__) . '/modules';
        self::$modules = [];

        if (!is_dir($baseDir)) {
            return [];
        }

        $dirs = glob($baseDir . '/*', GLOB_ONLYDIR);
        foreach ($dirs as $dir) {
            $jsonFile = $dir . '/module.json';
            if (file_exists($jsonFile)) {
                $content = file_get_contents($jsonFile);
                $meta = json_decode($content, true);
                if (is_array($meta) && isset($meta['slug'])) {
                    $slug = strtolower($meta['slug']);
                    $meta['dir'] = $dir;
                    $meta['enabled'] = self::checkModuleEnabled($slug, $meta['default_enabled'] ?? true);
                    self::$modules[$slug] = $meta;
                }
            }
        }

        return self::$modules;
    }

    /**
     * Get all discovered modules
     */
    public static function getModules(): array {
        return self::discover();
    }

    /**
     * Get only enabled modules
     */
    public static function getEnabledModules(): array {
        $all = self::discover();
        return array_filter($all, fn($m) => !empty($m['enabled']));
    }

    /**
     * Check if a specific module is enabled
     */
    public static function isModuleEnabled(string $slug): bool {
        $modules = self::discover();
        return isset($modules[$slug]) && !empty($modules[$slug]['enabled']);
    }

    /**
     * Toggle module enabled state in database
     */
    public static function setModuleEnabled(string $slug, bool $enabled): void {
        try {
            $existing = Database::fetchOne("SELECT id FROM modules WHERE slug = :slug", ['slug' => $slug]);
            if ($existing) {
                Database::update('modules', ['is_enabled' => $enabled ? 1 : 0], 'slug = :slug', ['slug' => $slug]);
            } else {
                Database::insert('modules', [
                    'slug'        => $slug,
                    'name'        => self::$modules[$slug]['name'] ?? ucfirst($slug),
                    'is_enabled'  => $enabled ? 1 : 0,
                    'created_at'  => date('Y-m-d H:i:s')
                ]);
            }
            self::$modules = null; // flush cache
        } catch (\Exception $e) {
            // ignore if DB is not installed yet
        }
    }

    private static function checkModuleEnabled(string $slug, bool $default = true): bool {
        try {
            $row = Database::fetchOne("SELECT is_enabled FROM modules WHERE slug = :slug LIMIT 1", ['slug' => $slug]);
            if ($row !== null) {
                return (bool)$row['is_enabled'];
            }
        } catch (\Exception $e) {
            // DB table might not exist yet during installation
        }
        return $default;
    }

    /**
     * Register routes from all enabled modules into the router
     */
    public static function registerRoutes(Router $router): void {
        $enabled = self::getEnabledModules();
        foreach ($enabled as $slug => $meta) {
            $routesFile = $meta['dir'] . '/routes.php';
            if (file_exists($routesFile)) {
                // Pass $router and $slug to routes.php
                (function ($router, $slug) use ($routesFile) {
                    require $routesFile;
                })($router, $slug);
            }
        }
    }

    /**
     * Retrieve aggregated navigation items from enabled modules filtered by user permissions
     */
    public static function getNavItems(): array {
        $enabled = self::getEnabledModules();
        $navGroups = [];

        foreach ($enabled as $slug => $meta) {
            $menu = $meta['menu'] ?? [];
            if (empty($menu)) continue;

            $groupTitle = $meta['section'] ?? ($meta['name'] ?? ucfirst($slug));
            $accessibleItems = [];

            // If menu has sub-items
            if (isset($menu['items']) && is_array($menu['items'])) {
                foreach ($menu['items'] as $item) {
                    $requiredPerm = $item['permission'] ?? null;
                    if (!$requiredPerm || Permission::can($requiredPerm)) {
                        if (!empty($item['children']) && is_array($item['children'])) {
                            $validChildren = [];
                            foreach ($item['children'] as $child) {
                                $childPerm = $child['permission'] ?? null;
                                if (!$childPerm || Permission::can($childPerm)) {
                                    $validChildren[] = $child;
                                }
                            }
                            $item['children'] = $validChildren;
                        }
                        $accessibleItems[] = $item;
                    }
                }
                if (!empty($accessibleItems)) {
                    $navGroups[] = [
                        'title' => $groupTitle,
                        'slug'  => $slug,
                        'icon'  => $menu['icon'] ?? 'bi-folder',
                        'items' => $accessibleItems
                    ];
                }
            } else {
                // Single menu item
                $requiredPerm = $menu['permission'] ?? null;
                if (!$requiredPerm || Permission::can($requiredPerm)) {
                    $navGroups[] = [
                        'title' => $meta['name'],
                        'slug'  => $slug,
                        'icon'  => $menu['icon'] ?? 'bi-app',
                        'route' => $menu['route'] ?? ($slug . '/index'),
                        'items' => []
                    ];
                }
            }
        }

        return $navGroups;
    }

    /**
     * Aggregate executive dashboard widgets from all enabled modules
     */
    public static function getWidgets(): array {
        $enabled = self::getEnabledModules();
        $widgets = [];

        foreach ($enabled as $slug => $meta) {
            $widgetsFile = $meta['dir'] . '/widgets.php';
            if (file_exists($widgetsFile)) {
                $moduleWidgets = require $widgetsFile;
                if (is_array($moduleWidgets)) {
                    foreach ($moduleWidgets as $w) {
                        $requiredPerm = $w['permission'] ?? null;
                        if (!$requiredPerm || Permission::can($requiredPerm)) {
                            $w['module_slug'] = $slug;
                            $w['module_name'] = $meta['name'];
                            $widgets[] = $w;
                        }
                    }
                }
            }
        }

        return $widgets;
    }

    /**
     * Synchronize permissions declared in module.json into the permissions table
     */
    public static function syncPermissions(): void {
        $all = self::discover();
        foreach ($all as $slug => $meta) {
            $perms = $meta['permissions'] ?? [];
            foreach ($perms as $permKey => $desc) {
                Permission::register($permKey, $slug, is_string($desc) ? $desc : '');
            }
        }
    }
}

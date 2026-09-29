<?php
namespace Core;

/**
 * MarSU Centralized ERP - Forward-Only Migration Engine
 * Module-namespaced migration tracker preventing merge collisions between student groups.
 */
class Migration {
    public static function initTable(): void {
        $sql = "CREATE TABLE IF NOT EXISTS `migrations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `module` VARCHAR(64) NOT NULL DEFAULT 'core',
            `migration` VARCHAR(255) NOT NULL,
            `batch` INT NOT NULL DEFAULT 1,
            `executed_at` DATETIME NOT NULL,
            UNIQUE KEY `unique_module_migration` (`module`, `migration`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        Database::query($sql);
    }

    public static function getNextBatch(): int {
        self::initTable();
        $batch = (int)Database::fetchColumn("SELECT MAX(batch) FROM migrations");
        return $batch + 1;
    }

    public static function getExecutedMigrations(?string $module = null): array {
        self::initTable();
        $sql = "SELECT migration FROM migrations";
        $params = [];
        if ($module !== null) {
            $sql .= " WHERE module = :module";
            $params['module'] = $module;
        }
        $rows = Database::fetchAll($sql, $params);
        return array_column($rows, 'migration');
    }

    /**
     * Run all pending migrations for core and enabled modules
     */
    public static function runAll(?string $targetModule = null): array {
        self::initTable();
        $batch = self::getNextBatch();
        $executed = [];

        // 1. Run Core Migrations
        if ($targetModule === null || $targetModule === 'core') {
            $coreDir = dirname(__DIR__) . '/database/migrations';
            $executed = array_merge($executed, self::runDirectory($coreDir, 'core', $batch));
        }

        // 2. Run Module Migrations
        $modules = ModuleLoader::getEnabledModules();
        foreach ($modules as $slug => $meta) {
            if ($targetModule !== null && $targetModule !== $slug) {
                continue;
            }
            $modDir = $meta['dir'] . '/database/migrations';
            if (is_dir($modDir)) {
                $executed = array_merge($executed, self::runDirectory($modDir, $slug, $batch));
            }
        }

        return $executed;
    }

    private static function runDirectory(string $dir, string $module, int $batch): array {
        if (!is_dir($dir)) {
            return [];
        }

        $files = glob($dir . '/*.php');
        sort($files); // sort chronologically by timestamp
        $alreadyRun = self::getExecutedMigrations($module);
        $ran = [];

        foreach ($files as $file) {
            $filename = basename($file, '.php');
            if (in_array($filename, $alreadyRun, true)) {
                continue;
            }

            // Require migration class
            require_once $file;
            
            // Expected class name: extract from filename e.g. 2026_09_29_000001_create_core_tables.php -> CreateCoreTables
            // Or if migration returns an anonymous class / instance
            $migrationObj = self::resolveMigrationInstance($file, $filename);

            if ($migrationObj && method_exists($migrationObj, 'up')) {
                $migrationObj->up();

                Database::insert('migrations', [
                    'module'      => $module,
                    'migration'   => $filename,
                    'batch'       => $batch,
                    'executed_at' => date('Y-m-d H:i:s')
                ]);

                $ran[] = "[{$module}] {$filename}";
            }
        }

        return $ran;
    }

    private static function resolveMigrationInstance(string $filePath, string $filename) {
        $content = file_get_contents($filePath);
        
        // Check for return new class ...
        if (str_contains($content, 'return new class')) {
            return include $filePath;
        }

        // Otherwise extract class name
        if (preg_match('/class\s+([a-zA-Z0-9_]+)/', $content, $matches)) {
            $className = $matches[1];
            return new $className();
        }

        return null;
    }
}

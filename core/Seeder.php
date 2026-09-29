<?php
namespace Core;

/**
 * MarSU Centralized ERP - Database Seeder Engine
 */
class Seeder {
    public static function runAll(?string $targetModule = null): array {
        $executed = [];

        // 1. Run Core Seeders
        if ($targetModule === null || $targetModule === 'core') {
            $coreDir = dirname(__DIR__) . '/database/seeders';
            $executed = array_merge($executed, self::runDirectory($coreDir, 'core'));
        }

        // 2. Run Module Seeders
        $modules = ModuleLoader::getEnabledModules();
        foreach ($modules as $slug => $meta) {
            if ($targetModule !== null && $targetModule !== $slug) {
                continue;
            }
            $modDir = $meta['dir'] . '/database/seeders';
            if (is_dir($modDir)) {
                $executed = array_merge($executed, self::runDirectory($modDir, $slug));
            }
        }

        return $executed;
    }

    private static function runDirectory(string $dir, string $module): array {
        if (!is_dir($dir)) {
            return [];
        }

        $files = glob($dir . '/*.php');
        sort($files);
        $ran = [];

        foreach ($files as $file) {
            $filename = basename($file, '.php');
            require_once $file;

            $seederObj = self::resolveSeederInstance($file, $filename);
            if ($seederObj && method_exists($seederObj, 'run')) {
                $seederObj->run();
                $ran[] = "[{$module}] {$filename}";
            }
        }

        return $ran;
    }

    private static function resolveSeederInstance(string $filePath, string $filename) {
        $content = file_get_contents($filePath);
        if (str_contains($content, 'return new class')) {
            return include $filePath;
        }
        if (preg_match('/class\s+([a-zA-Z0-9_]+)/', $content, $matches)) {
            $className = $matches[1];
            return new $className();
        }
        return null;
    }
}

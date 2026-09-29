<?php
/**
 * MarSU Centralized ERP - Handwritten PSR-4 Autoloader
 * Zero Composer or external dependencies required.
 */

spl_autoload_register(function ($class) {
    // Prefix mappings
    $prefixes = [
        'Core\\'    => __DIR__ . '/',
        'App\\'     => dirname(__DIR__) . '/app/',
        'Modules\\' => dirname(__DIR__) . '/modules/'
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        $relativeClass = substr($class, $len);
        
        // Handle Modules/<Slug>/... mapping
        // e.g. Modules\Housing\Controllers\HomeController -> modules/housing/Controllers/HomeController.php
        if ($prefix === 'Modules\\') {
            $parts = explode('\\', $relativeClass);
            $parts[0] = strtolower($parts[0]); // lowercase module slug directory
            $file = $baseDir . implode('/', $parts) . '.php';
        } else {
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        }

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

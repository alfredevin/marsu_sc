<?php
/**
 * MarSU Centralized ERP - CLI Seeder Runner
 * Usage: php scripts/seed.php [module_slug]
 */

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/helpers.php';

use Core\Database;
use Core\Seeder;

Database::loadEnv(__DIR__ . '/../.env');

$targetModule = $argv[1] ?? null;

echo "=========================================================\n";
echo " MarSU Centralized ERP - Database Seeder Tool\n";
echo "=========================================================\n";

try {
    echo "Connecting to MySQL server...\n";
    $pdo = Database::pdo();
    echo "Connected successfully.\n";

    echo "Running seeders " . ($targetModule ? "for module [{$targetModule}]" : "for all modules") . "...\n";
    $executed = Seeder::runAll($targetModule);

    if (empty($executed)) {
        echo "No seeders executed.\n";
    } else {
        echo "Executed " . count($executed) . " seeder(s):\n";
        foreach ($executed as $s) {
            echo "  ✔ " . $s . "\n";
        }
    }

    // Automatically check and import real MarSU student and employee datasets if students table is empty
    if ($targetModule === null || $targetModule === 'core') {
        $studentCount = (int)Database::fetchColumn("SELECT COUNT(*) FROM students");
        if ($studentCount === 0 && file_exists(__DIR__ . '/import_real_data.php')) {
            echo "\n---------------------------------------------------------\n";
            echo " Populating authentic MarSU students & employees...\n";
            echo "---------------------------------------------------------\n";
            require_once __DIR__ . '/import_real_data.php';
        }
    }

    echo "\n✔ Seeding completed successfully.\n";
} catch (Exception $e) {
    echo "\n❌ Seeding Failed: " . $e->getMessage() . "\n";
    exit(1);
}

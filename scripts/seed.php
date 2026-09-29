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

    echo "\n✔ Seeding completed successfully.\n";
} catch (Exception $e) {
    echo "\n❌ Seeding Failed: " . $e->getMessage() . "\n";
    exit(1);
}

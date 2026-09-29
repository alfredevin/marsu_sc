<?php
/**
 * MarSU Centralized ERP - CLI Migration Runner
 * Usage: php scripts/migrate.php [module_slug]
 */

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/helpers.php';

use Core\Database;
use Core\Migration;
use Core\ModuleLoader;

Database::loadEnv(__DIR__ . '/../.env');

$targetModule = $argv[1] ?? null;

echo "=========================================================\n";
echo " MarSU Centralized ERP - Database Migration Tool\n";
echo "=========================================================\n";

try {
    echo "Connecting to MySQL server...\n";
    $pdo = Database::pdo();
    echo "Connected successfully.\n";

    echo "Running migrations " . ($targetModule ? "for module [{$targetModule}]" : "for all modules") . "...\n";
    $executed = Migration::runAll($targetModule);

    if (empty($executed)) {
        echo "Nothing to migrate. All database migrations are up to date.\n";
    } else {
        echo "Executed " . count($executed) . " migration(s):\n";
        foreach ($executed as $m) {
            echo "  ✔ " . $m . "\n";
        }
    }

    // Sync module permissions
    echo "Synchronizing module permissions...\n";
    ModuleLoader::syncPermissions();
    echo "Permissions synchronized.\n";

    echo "\n✔ Migration completed successfully.\n";
} catch (Exception $e) {
    echo "\n❌ Migration Failed: " . $e->getMessage() . "\n";
    exit(1);
}

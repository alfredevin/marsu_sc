<?php
/**
 * Module Migration: Ensure demo accounts from modules/analytics/env are
 * seeded and ready in the database on all development machines.
 *
 * Accounts ensured:
 *  - programhead (Program Head mapped to BSIS and ACT)
 *  - registrar   (Registrar for official term enrollments)
 *  - faculty     (Faculty member Prof. Juan Dela Cruz)
 *  - student     (Student Jake Louis Almonte 26S0227)
 */

use Core\Database;
use Modules\Analytics\Support\DemoAccountsBootstrapper;

return new class {
    public function up(): void {
        require_once dirname(__DIR__, 2) . '/Support/DemoAccountsBootstrapper.php';
        DemoAccountsBootstrapper::bootstrap();
    }

    public function down(): void {
        // Non-destructive: preserves existing user accounts
    }
};

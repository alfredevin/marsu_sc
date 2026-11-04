<?php

use Core\Database;

return new class {
    private const TABLES = [
        'organization_classifications',
        'leadership_positions',
        'venues',
        'organization_accreditations',
        'organization_memberships',
        'officers',
        'leadership_terms',
        'officer_appointments',
        'leadership_trainings',
        'activity_proposals',
        'event_approvals',
        'activity_calendar',
        'event_documentations',
        'activity_attendances',
        'student_participations',
        'engagement_credits',
        'student_recognitions',
        'announcements',
        'organization_performance_snapshots',
    ];

    public function up(): void
    {
        $db = Database::pdo();
        $tableCheck = $db->prepare(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table_name'
        );
        $columnCheck = $db->prepare(
            'SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = :table_name AND column_name = :column_name'
        );

        foreach (self::TABLES as $table) {
            $tableCheck->execute(['table_name' => $table]);
            if ((int)$tableCheck->fetchColumn() === 0) {
                continue;
            }

            $columnCheck->execute(['table_name' => $table, 'column_name' => 'deleted_at']);
            if ((int)$columnCheck->fetchColumn() === 0) {
                $db->exec("ALTER TABLE `{$table}` ADD COLUMN `deleted_at` DATETIME NULL DEFAULT NULL");
            }
        }
    }

    public function down(): void
    {
        // Keep archive metadata and imported records intact when rolling back.
    }
};

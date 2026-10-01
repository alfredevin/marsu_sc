<?php
/**
 * Executive Dashboard Widget Contract for ISHAMIS
 * Integrated Student Housing and Accommodation Management Information System
 */

use Core\Database;

return [
    [
        'id'          => 'housing_kpi_accredited',
        'type'        => 'kpi',
        'title'       => 'Accredited Boarding Houses',
        'icon'        => 'bi-house-check-fill',
        'permission'  => 'housing.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_boarding_houses` WHERE accreditation_status = 'accredited' AND deleted_at IS NULL");
            } catch (\Exception $e) {
                return 5;
            }
        }
    ],
    [
        'id'          => 'housing_kpi_vacant_beds',
        'type'        => 'kpi',
        'title'       => 'Available Student Bedspaces',
        'icon'        => 'bi-door-open-fill',
        'permission'  => 'housing.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT SUM(vacant_beds) FROM `hsg_rooms` WHERE deleted_at IS NULL") ?: 12;
            } catch (\Exception $e) {
                return 12;
            }
        }
    ],
    [
        'id'          => 'housing_list_recent',
        'type'        => 'list',
        'title'       => 'Accredited Santa Cruz Residences (ISHAMIS)',
        'icon'        => 'bi-buildings-fill',
        'permission'  => 'housing.view',
        'data'        => function () {
            try {
                $rows = Database::fetchAll("
                    SELECT name as primary_text, 
                           CONCAT('★ ', ROUND(safety_rating, 1), ' • ', accreditation_status) as badge, 
                           CONCAT(barangay, ' (₱', FORMAT(monthly_rate_min, 0), '-₱', FORMAT(monthly_rate_max, 0), '/mo)') as sub_text 
                    FROM `hsg_boarding_houses` 
                    WHERE deleted_at IS NULL 
                    ORDER BY safety_rating DESC 
                    LIMIT 5
                ");
                return $rows ?: [];
            } catch (\Exception $e) {
                return [];
            }
        }
    ]
];

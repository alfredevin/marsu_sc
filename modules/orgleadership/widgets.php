<?php
/**
 * Executive Dashboard Widget Contract for the orgleadership module.
 * Widget queries read the imported organization schema directly.
 */

use Core\Database;

return [
    [
        'id' => 'orgleadership_kpi_total',
        'type' => 'kpi',
        'title' => 'Registered Organizations',
        'icon' => 'bi-building',
        'permission' => 'orgleadership.view',
        'data' => static function () {
            return (int)Database::fetchColumn(
                'SELECT COUNT(*) FROM `organization_tbl` WHERE deleted_at IS NULL'
            );
        },
    ],
    [
        'id' => 'orgleadership_kpi_pending',
        'type' => 'kpi',
        'title' => 'Pending Accreditation',
        'icon' => 'bi-hourglass-split',
        'permission' => 'orgleadership.view',
        'data' => static function () {
            return (int)Database::fetchColumn(
                "SELECT COUNT(*) FROM `organization_tbl` WHERE status IN ('Pending', 'Pending Accreditation') AND deleted_at IS NULL"
            );
        },
    ],
    [
        'id' => 'orgleadership_list_recent',
        'type' => 'list',
        'title' => 'Recently Registered Organizations',
        'icon' => 'bi-building-check',
        'permission' => 'orgleadership.view',
        'data' => static function () {
            $rows = Database::fetchAll(
                "SELECT organization_name AS primary_text,
                        status AS badge,
                        CONCAT(COALESCE(school_year, 'School year not set'), ' · ', DATE_FORMAT(created_at, '%b %d, %Y')) AS sub_text
                 FROM `organization_tbl`
                 WHERE deleted_at IS NULL
                 ORDER BY created_at DESC
                 LIMIT 5"
            );
            return $rows ?: [];
        },
    ],
];

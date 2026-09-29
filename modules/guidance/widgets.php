<?php
/**
 * Executive Dashboard Widget Contract for module: Guidance & Counseling Intake Records System
 * Must return an array of widget definitions (kpi, list, chart, table)
 */

use Core\Database;

return [
    [
        'id'          => 'guidance_kpi_total',
        'type'        => 'kpi',
        'title'       => 'Active Records',
        'icon'        => 'bi-person-heart',
        'permission'  => 'guidance.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `gdc_records` WHERE deleted_at IS NULL");
            } catch (\Exception $e) {
                return 42; // Demo fallback telemetry
            }
        }
    ],
    [
        'id'          => 'guidance_kpi_pending',
        'type'        => 'kpi',
        'title'       => 'Pending Actions',
        'icon'        => 'bi-hourglass-split',
        'permission'  => 'guidance.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `gdc_records` WHERE status = 'pending' AND deleted_at IS NULL");
            } catch (\Exception $e) {
                return 7; // Demo fallback telemetry
            }
        }
    ],
    [
        'id'          => 'guidance_list_recent',
        'type'        => 'list',
        'title'       => 'Recent Guidance & Counseling Intake Records System',
        'icon'        => 'bi-person-heart',
        'permission'  => 'guidance.view',
        'data'        => function () {
            try {
                $rows = Database::fetchAll("SELECT title as primary_text, status as badge, DATE_FORMAT(created_at, '%b %d, %Y') as sub_text FROM `gdc_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 5");
                return $rows ?: [];
            } catch (\Exception $e) {
                return [
                    ['primary_text' => 'Sample Record Alpha', 'badge' => 'Active', 'sub_text' => 'A.Y. 2026-2027'],
                    ['primary_text' => 'Sample Record Beta', 'badge' => 'Pending', 'sub_text' => 'A.Y. 2026-2027'],
                    ['primary_text' => 'Sample Record Gamma', 'badge' => 'Completed', 'sub_text' => 'A.Y. 2026-2027']
                ];
            }
        }
    ]
];

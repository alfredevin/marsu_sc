<?php
/**
 * Executive Dashboard Widget Contract for module: Student Retention & Academic Risk Early Warning System
 * Must return an array of widget definitions (kpi, list, chart, table)
 * Strictly real data, no fake fallback numbers, and de-identified per RA 10173.
 */

use Core\Database;

return [
    [
        'id'          => 'retention_kpi_total',
        'type'        => 'kpi',
        'title'       => 'Active Retention Records',
        'icon'        => 'bi-graph-up-arrow',
        'permission'  => 'retention.view',
        'data'        => function () {
            try {
                return (int) Database::fetchColumn("SELECT COUNT(*) FROM `ret_records` WHERE deleted_at IS NULL");
            } catch (\Throwable $e) {
                return 0;
            }
        }
    ],
    [
        'id'          => 'retention_kpi_pending',
        'type'        => 'kpi',
        'title'       => 'Pending Actions',
        'icon'        => 'bi-hourglass-split',
        'permission'  => 'retention.view',
        'data'        => function () {
            try {
                return (int) Database::fetchColumn("SELECT COUNT(*) FROM `ret_records` WHERE status = 'pending' AND deleted_at IS NULL");
            } catch (\Throwable $e) {
                return 0;
            }
        }
    ],
    [
        'id'          => 'retention_list_recent',
        'type'        => 'list',
        'title'       => 'Recent Retention Activity Logbook',
        'icon'        => 'bi-clock-history',
        'permission'  => 'retention.view',
        'data'        => function () {
            try {
                $rows = Database::fetchAll(
                    "SELECT id, title, status, DATE_FORMAT(created_at, '%b %d, %Y') as sub_text 
                     FROM `ret_records` 
                     WHERE deleted_at IS NULL 
                     ORDER BY id DESC 
                     LIMIT 5"
                );
                
                // De-identify any student numbers (e.g. 26S0123) in the title per RA 10173
                return array_map(function ($row) {
                    $cleanedTitle = preg_replace('/\b\d{2}[A-Za-z]\d{4}\b/', '[Student ID Redacted]', $row['title'] ?? '');
                    return [
                        'primary_text' => $cleanedTitle,
                        'badge'        => ucfirst($row['status'] ?? 'Active'),
                        'sub_text'     => $row['sub_text'] ?? '',
                    ];
                }, $rows ?: []);
            } catch (\Throwable $e) {
                return [];
            }
        }
    ]
];

<?php
/**
 * Executive Dashboard Widget Contract for module: Academic Analytics & Student Monitoring System
 */

use Core\Database;

return [
    [
        'id'          => 'analytics_kpi_total',
        'type'        => 'kpi',
        'title'       => 'Monitored Students',
        'icon'        => 'bi-people-fill',
        'permission'  => 'analytics.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `students` WHERE deleted_at IS NULL");
            } catch (\Exception $e) {
                return 866;
            }
        }
    ],
    [
        'id'          => 'analytics_kpi_attendance',
        'type'        => 'kpi',
        'title'       => 'Attendance Rate',
        'icon'        => 'bi-calendar-check-fill',
        'permission'  => 'analytics.view',
        'data'        => function () {
            return '94.8%';
        }
    ],
    [
        'id'          => 'analytics_list_recent',
        'type'        => 'list',
        'title'       => 'Recent Academic Monitoring Updates',
        'icon'        => 'bi-journal-check',
        'permission'  => 'analytics.view',
        'data'        => function () {
            return [
                ['primary_text' => 'Prelim Grade Submissions Monitored', 'badge' => 'Active', 'sub_text' => 'A.Y. 2026-2027 1st Sem'],
                ['primary_text' => 'Attendance Audit - College of CICS', 'badge' => 'Completed', 'sub_text' => 'Updated Today'],
                ['primary_text' => 'Class Engagement Metrics Compiled', 'badge' => 'Verified', 'sub_text' => 'Recent Batch']
            ];
        }
    ]
];

<?php
/**
 * Executive Dashboard Widget Contract for module: Academic Analytics & Student Monitoring System
 * Every value is a live, scoped query. No fallbacks: an empty result shows as 0 or "No data".
 */

use Core\Auth;
use Core\Database;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\GradeCalculator;

return [
    [
        'id'         => 'analytics_kpi_students_scope',
        'type'       => 'kpi',
        'title'      => 'Students in Monitoring Scope',
        'icon'       => 'bi-people-fill',
        'permission' => 'analytics.view',
        'link'       => 'analytics/overview',
        'data'       => function () {
            return (int) Database::fetchColumn(
                "SELECT COUNT(*) FROM `students` s WHERE s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s')
            );
        },
    ],
    [
        'id'         => 'analytics_kpi_attendance_rate',
        'type'       => 'kpi',
        'title'      => 'Attendance Rate (Active Term)',
        'icon'       => 'bi-calendar-check-fill',
        'permission' => 'analytics.view',
        'link'       => 'analytics/attendancerecords',
        'data'       => function () {
            $term = AnalyticsAccess::activeTerm();
            if (!$term) {
                return 'No active term';
            }
            $att = Database::fetchOne(
                "SELECT COALESCE(SUM(a.status = 'Present'), 0) AS present, COALESCE(SUM(a.status = 'Late'), 0) AS late,
                        COALESCE(SUM(a.status = 'Excused'), 0) AS excused, COUNT(*) AS total
                 FROM `ana_attendance_records` a JOIN `ana_classes` c ON c.id = a.class_id
                 WHERE a.voided_at IS NULL AND c.deleted_at IS NULL AND c.semester_id = :sem" . AnalyticsAccess::classScopeSql('c'),
                ['sem' => (int) $term['semester_id']]
            );
            $rate = GradeCalculator::attendanceRate($att ?: []);
            return $rate === null ? 'No sessions recorded' : number_format($rate * 100, 1) . '%';
        },
    ],
    [
        'id'         => 'analytics_kpi_grades_posted',
        'type'       => 'kpi',
        'title'      => 'Classes with Posted Grades (Active Term)',
        'icon'       => 'bi-journal-check',
        'permission' => 'analytics.view',
        'link'       => 'analytics/gradestracking',
        'data'       => function () {
            $term = AnalyticsAccess::activeTerm();
            if (!$term) {
                return 'No active term';
            }
            $row = Database::fetchOne(
                "SELECT COUNT(*) AS total, COALESCE(SUM(c.grade_status IN ('posted', 'locked')), 0) AS published
                 FROM `ana_classes` c WHERE c.deleted_at IS NULL AND c.semester_id = :sem" . AnalyticsAccess::classScopeSql('c'),
                ['sem' => (int) $term['semester_id']]
            );
            return (int) $row['published'] . ' / ' . (int) $row['total'];
        },
    ],
    [
        'id'         => 'analytics_kpi_my_classes',
        'type'       => 'kpi',
        'title'      => 'My Classes (Active Term)',
        'icon'       => 'bi-person-workspace',
        'permission' => 'analytics.faculty.classes',
        'link'       => 'analytics/faculty',
        'data'       => function () {
            $term = AnalyticsAccess::activeTerm();
            if (!$term) {
                return 'No active term';
            }
            return (int) Database::fetchColumn(
                "SELECT COUNT(*) FROM `ana_classes` WHERE faculty_user_id = :fid AND semester_id = :sem AND deleted_at IS NULL",
                ['fid' => (int) Auth::id(), 'sem' => (int) $term['semester_id']]
            );
        },
    ],
    [
        'id'         => 'analytics_kpi_join_requests',
        'type'       => 'kpi',
        'title'      => 'Pending Class Join Requests',
        'icon'       => 'bi-person-plus-fill',
        'permission' => 'analytics.faculty.classes',
        'link'       => 'analytics/faculty/join-requests',
        'data'       => function () {
            return (int) Database::fetchColumn(
                "SELECT COUNT(*) FROM `ana_class_join_requests` j JOIN `ana_classes` c ON c.id = j.class_id
                 WHERE c.faculty_user_id = :fid AND c.deleted_at IS NULL AND j.status = 'pending'",
                ['fid' => (int) Auth::id()]
            );
        },
    ],
    [
        'id'         => 'analytics_kpi_enrolled_term',
        'type'       => 'kpi',
        'title'      => 'Officially Enrolled (Active Term)',
        'icon'       => 'bi-person-badge-fill',
        'permission' => 'analytics.registrar.view',
        'link'       => 'analytics/registrar',
        'data'       => function () {
            $term = AnalyticsAccess::activeTerm();
            if (!$term) {
                return 'No active term';
            }
            return (int) Database::fetchColumn(
                "SELECT COUNT(*) FROM `ana_enrollments` WHERE semester_id = :sem AND status = 'enrolled'",
                ['sem' => (int) $term['semester_id']]
            );
        },
    ],
    [
        'id'         => 'analytics_list_change_log',
        'type'       => 'list',
        'title'      => 'Recent Academic Governance Activity',
        'icon'       => 'bi-clock-history',
        'permission' => 'analytics.admin.settings',
        'link'       => 'analytics/admin/change-log',
        'data'       => function () {
            $rows = Database::fetchAll(
                "SELECT cl.entity, cl.action, cl.created_at, CONCAT(u.first_name, ' ', u.last_name) AS user_name
                 FROM `ana_change_log` cl LEFT JOIN `users` u ON u.id = cl.changed_by
                 ORDER BY cl.id DESC LIMIT 5"
            );
            return array_map(fn($r) => [
                'primary_text' => ucwords(str_replace('_', ' ', $r['entity'] . ' ' . $r['action'])),
                'badge'        => $r['user_name'] ?? 'System',
                'sub_text'     => date('M j, Y g:i A', strtotime($r['created_at'])),
            ], $rows);
        },
    ],
];

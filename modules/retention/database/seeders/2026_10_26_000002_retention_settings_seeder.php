<?php
/**
 * Seeder: Retention Module Policy Settings & Default Grading Template
 * Idempotently populates ret_settings and ret_grading_templates.
 */

use Core\Database;

return new class {
    public function run(): void {
        $pdo = Database::pdo();
        $now = date('Y-m-d H:i:s');

        // 1. Policy Settings (Part E1)
        $settings = [
            [
                'key'         => 'attendance.max_absence_ratio',
                'value'       => '0.20',
                'type'        => 'decimal',
                'label'       => 'Maximum Absence Ratio',
                'description' => 'Ratio of total sessions determining allowable cuts (e.g. 0.20 = 20% of class meetings)',
                'min_value'   => 0.05,
                'max_value'   => 0.50,
            ],
            [
                'key'         => 'attendance.min_allowable_cuts',
                'value'       => '3',
                'type'        => 'int',
                'label'       => 'Minimum Allowable Cuts',
                'description' => 'Absolute minimum allowable unexcused absences before critical absence risk',
                'min_value'   => 1.0,
                'max_value'   => 10.0,
            ],
            [
                'key'         => 'attendance.late_weight',
                'value'       => '0.75',
                'type'        => 'decimal',
                'label'       => 'Late Attendance Credit Weight',
                'description' => 'Proportionate attendance credit awarded for a Late status (0.00 to 1.00)',
                'min_value'   => 0.00,
                'max_value'   => 1.00,
            ],
            [
                'key'         => 'attendance.critical_rate',
                'value'       => '80.0',
                'type'        => 'decimal',
                'label'       => 'Critical Attendance Rate (%)',
                'description' => 'Attendance percentage threshold below which a student is flagged as Critical Risk',
                'min_value'   => 50.0,
                'max_value'   => 100.0,
            ],
            [
                'key'         => 'attendance.monitored_rate',
                'value'       => '88.0',
                'type'        => 'decimal',
                'label'       => 'Monitored Attendance Rate (%)',
                'description' => 'Attendance percentage threshold below which a student is placed on Monitored status',
                'min_value'   => 50.0,
                'max_value'   => 100.0,
            ],
            [
                'key'         => 'attendance.absence_warning_count',
                'value'       => '4',
                'type'        => 'int',
                'label'       => 'Absence Warning Cutoff Count',
                'description' => 'Unexcused absence count that triggers an automated formal notice to adviser',
                'min_value'   => 1.0,
                'max_value'   => 20.0,
            ],
            [
                'key'         => 'grading.default_passing_cutoff',
                'value'       => '3.04',
                'type'        => 'decimal',
                'label'       => 'Default Passing Grade Cutoff',
                'description' => 'Maximum numerical grade considered passing (Philippine 1.00 - 5.00 grading scale)',
                'min_value'   => 1.00,
                'max_value'   => 5.00,
            ],
            [
                'key'         => 'grading.allow_faculty_custom_weights',
                'value'       => '1',
                'type'        => 'bool',
                'label'       => 'Allow Faculty Weight Customization',
                'description' => 'Permits faculty members to adjust category percentage weights when creating or configuring classes',
                'min_value'   => 0.0,
                'max_value'   => 1.0,
            ],
            [
                'key'         => 'grading.inc_removal_days',
                'value'       => '365',
                'type'        => 'int',
                'label'       => 'Incomplete (INC) Removal Period (Days)',
                'description' => 'Calendar days allowed for students to complete requirements and resolve an INC mark',
                'min_value'   => 30.0,
                'max_value'   => 730.0,
            ],
            [
                'key'         => 'analytics.bottleneck_passing_rate',
                'value'       => '85.0',
                'type'        => 'decimal',
                'label'       => 'Bottleneck Subject Passing Rate (%)',
                'description' => 'Course passing rate threshold below which a subject is categorized as an institutional bottleneck',
                'min_value'   => 50.0,
                'max_value'   => 100.0,
            ],
        ];

        $stmt = $pdo->prepare("INSERT INTO `ret_settings` (`key`, `value`, `type`, `label`, `description`, `min_value`, `max_value`, `created_at`) 
            VALUES (:key, :value, :type, :label, :description, :min_value, :max_value, :created_at)
            ON DUPLICATE KEY UPDATE 
                `label` = VALUES(`label`),
                `description` = VALUES(`description`),
                `min_value` = VALUES(`min_value`),
                `max_value` = VALUES(`max_value`);");

        foreach ($settings as $s) {
            $stmt->execute([
                'key'         => $s['key'],
                'value'       => $s['value'],
                'type'        => $s['type'],
                'label'       => $s['label'],
                'description' => $s['description'],
                'min_value'   => $s['min_value'],
                'max_value'   => $s['max_value'],
                'created_at'  => $now,
            ]);
        }

        // 2. Default Grading Template (Part E2, C7)
        $defaultScheme = [
            'name'          => 'Default Grading System (30-30-40)',
            'passingCutoff' => 3.04,
            'groups'        => [
                [
                    'id'              => 'g_lec',
                    'title'           => 'Lecture / Quizzes & Classwork',
                    'weight'          => 30,
                    'hasAttendance'   => true,
                    'attendanceDates' => [],
                    'items'           => [
                        ['code' => 'Q1', 'title' => 'Quiz 1', 'type' => 'Quiz', 'maxScore' => 50],
                        ['code' => 'Q2', 'title' => 'Quiz 2', 'type' => 'Quiz', 'maxScore' => 50],
                        ['code' => 'CW1', 'title' => 'Classwork 1', 'type' => 'Classwork', 'maxScore' => 30],
                    ],
                ],
                [
                    'id'              => 'g_lab',
                    'title'           => 'Laboratory / Skills & Projects',
                    'weight'          => 30,
                    'hasAttendance'   => false,
                    'attendanceDates' => [],
                    'items'           => [
                        ['code' => 'LAB1', 'title' => 'Lab Exercise 1', 'type' => 'Lab', 'maxScore' => 100],
                        ['code' => 'PRJ1', 'title' => 'Mini Project', 'type' => 'Project', 'maxScore' => 100],
                    ],
                ],
                [
                    'id'              => 'g_exam',
                    'title'           => 'Major Examinations',
                    'weight'          => 40,
                    'hasAttendance'   => false,
                    'attendanceDates' => [],
                    'items'           => [
                        ['code' => 'MID', 'title' => 'Midterm Examination', 'type' => 'Exam', 'maxScore' => 100],
                        ['code' => 'FIN', 'title' => 'Final Examination', 'type' => 'Exam', 'maxScore' => 100],
                    ],
                ],
            ],
        ];

        $templateCount = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ret_grading_templates` WHERE `name` = 'Default Grading System (30-30-40)'");
        if ($templateCount === 0) {
            Database::insert('ret_grading_templates', [
                'name'           => 'Default Grading System (30-30-40)',
                'scheme'         => json_encode($defaultScheme, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'passing_cutoff' => 3.04,
                'is_default'     => 1,
                'is_active'      => 1,
                'created_by'     => null,
                'created_at'     => $now,
            ]);
        }
    }
};

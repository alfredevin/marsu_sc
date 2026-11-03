<?php
/**
 * Seeder: Academic Analytics Module Policy Settings & Default Grading Template
 * Idempotently populates ana_settings and ana_grading_templates.
 */

use Core\Database;

return new class {
    public function run(): void {
        $pdo = Database::pdo();
        $now = date('Y-m-d H:i:s');

        // 1. Policy Settings
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
                'label'       => 'Curricular Bottleneck Threshold (%)',
                'description' => 'Course passing rate below which a subject is tagged as a prerequisite bottleneck',
                'min_value'   => 50.0,
                'max_value'   => 95.0,
            ],
        ];

        $stmt = $pdo->prepare("
            INSERT INTO `ana_settings` (`key`, `value`, `type`, `label`, `description`, `min_value`, `max_value`, `created_at`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
                `label` = VALUES(`label`), 
                `description` = VALUES(`description`),
                `min_value` = VALUES(`min_value`),
                `max_value` = VALUES(`max_value`)
        ");

        foreach ($settings as $s) {
            $stmt->execute([
                $s['key'],
                $s['value'],
                $s['type'],
                $s['label'],
                $s['description'],
                $s['min_value'],
                $s['max_value'],
                $now,
            ]);
        }

        // 2. Default Institutional Grading Template
        $defaultScheme = [
            'passingCutoff' => 3.04,
            'groups' => [
                [
                    'id'            => 'attendance_grp',
                    'name'          => 'Attendance & Participation',
                    'weight'        => 10,
                    'hasAttendance' => true,
                    'items'         => [],
                ],
                [
                    'id'            => 'quizzes_grp',
                    'name'          => 'Quizzes & Exercises',
                    'weight'        => 20,
                    'hasAttendance' => false,
                    'items'         => [
                        ['code' => 'Q1', 'label' => 'Quiz 1', 'maxScore' => 50],
                        ['code' => 'Q2', 'label' => 'Quiz 2', 'maxScore' => 50],
                    ],
                ],
                [
                    'id'            => 'projects_grp',
                    'name'          => 'Laboratory Activities & Projects',
                    'weight'        => 30,
                    'hasAttendance' => false,
                    'items'         => [
                        ['code' => 'ACT1', 'label' => 'Lab Machine Problem 1', 'maxScore' => 100],
                        ['code' => 'ACT2', 'label' => 'Lab Machine Problem 2', 'maxScore' => 100],
                    ],
                ],
                [
                    'id'            => 'midterm_grp',
                    'name'          => 'Midterm Major Examination',
                    'weight'        => 20,
                    'hasAttendance' => false,
                    'items'         => [
                        ['code' => 'MID', 'label' => 'Midterm Exam Paper', 'maxScore' => 100],
                    ],
                ],
                [
                    'id'            => 'final_grp',
                    'name'          => 'Final Major Examination',
                    'weight'        => 20,
                    'hasAttendance' => false,
                    'items'         => [
                        ['code' => 'FIN', 'label' => 'Final Exam Paper', 'maxScore' => 100],
                    ],
                ],
            ],
        ];

        $tplCount = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_grading_templates` WHERE `name` = 'MarSU Standard Lecture + Laboratory 2026'");
        if ($tplCount === 0) {
            Database::insert('ana_grading_templates', [
                'name'           => 'MarSU Standard Lecture + Laboratory 2026',
                'scheme'         => json_encode($defaultScheme),
                'passing_cutoff' => 3.04,
                'is_default'     => 1,
                'is_active'      => 1,
                'created_by'     => null,
                'created_at'     => $now,
            ]);
        }
    }
};

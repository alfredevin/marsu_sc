<?php
/**
 * Seeder: Academic Analytics Module Policy Settings & Default Grading Template
 * Idempotently populates the analytics rows of the core `settings` table and ana_grading_templates.
 */

use Core\Database;
use Modules\Analytics\Support\AnalyticsSettings;

return new class {
    public function run(): void {
        $pdo = Database::pdo();
        $now = date('Y-m-d H:i:s');

        // 1. Policy Settings: default values in the core `settings` table (group `analytics`).
        //    Labels, types and ranges are defined in Support/AnalyticsSettings.php; a value an
        //    administrator already changed is never overwritten.
        $stmt = $pdo->prepare("INSERT IGNORE INTO `settings` (`key`, `value`, `group`, `created_at`) VALUES (?, ?, ?, ?)");
        foreach (AnalyticsSettings::DEFINITIONS as $key => $def) {
            $stmt->execute([AnalyticsSettings::storageKey($key), $def['default'], AnalyticsSettings::GROUP, $now]);
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

        // 3. Faculty presets: attendance dates are added as columns in the class record,
        //    and every non-exam component can get more columns (Q3, A2, ...).
        $presets = [
            'MarSU CICS Standard (30-30-40)' => [
                'passingCutoff' => 3.04,
                'groups' => [
                    [
                        'id' => 'cics_att_quiz', 'title' => 'ATTENDANCE AND QUIZZES', 'weight' => 30, 'hasAttendance' => true, 'isExam' => false,
                        'items' => [
                            ['code' => 'Q1', 'title' => 'Quiz 1', 'maxScore' => 20],
                            ['code' => 'Q2', 'title' => 'Quiz 2', 'maxScore' => 20],
                        ],
                    ],
                    [
                        'id' => 'cics_activities', 'title' => 'ACTIVITIES, RECITATION, AND EXERCISES', 'weight' => 30, 'hasAttendance' => false, 'isExam' => false,
                        'items' => [
                            ['code' => 'A1', 'title' => 'Activity 1', 'maxScore' => 100],
                            ['code' => 'G1', 'title' => 'Group Activity 1', 'maxScore' => 100],
                            ['code' => 'R1', 'title' => 'Recitation 1', 'maxScore' => 100],
                            ['code' => 'P', 'title' => 'Project', 'maxScore' => 100],
                        ],
                    ],
                    [
                        'id' => 'cics_exams', 'title' => 'MAJOR EXAMS', 'weight' => 40, 'hasAttendance' => false, 'isExam' => true,
                        'items' => [
                            ['code' => 'Midterm', 'title' => 'Midterm Examination', 'maxScore' => 100],
                            ['code' => 'Finals', 'title' => 'Final Examination', 'maxScore' => 100],
                        ],
                    ],
                ],
            ],
            'Ogbac 6-Component Model (5-30-15-10-20-20)' => [
                'passingCutoff' => 3.04,
                'groups' => [
                    ['id' => 'ogb_att', 'title' => 'ATTENDANCE', 'weight' => 5, 'hasAttendance' => true, 'isExam' => false, 'items' => []],
                    [
                        'id' => 'ogb_written', 'title' => 'WRITTEN', 'weight' => 30, 'hasAttendance' => false, 'isExam' => false,
                        'items' => [
                            ['code' => 'QUIZ1', 'title' => 'Quiz 1', 'maxScore' => 10],
                            ['code' => 'QUIZ2', 'title' => 'Quiz 2', 'maxScore' => 10],
                        ],
                    ],
                    [
                        'id' => 'ogb_participation', 'title' => 'PARTICIPATION', 'weight' => 15, 'hasAttendance' => false, 'isExam' => false,
                        'items' => array_map(fn($n) => ['code' => 'ACT' . $n, 'title' => 'Activity ' . $n, 'maxScore' => 10], range(1, 6)),
                    ],
                    [
                        'id' => 'ogb_project', 'title' => 'PROJECT', 'weight' => 10, 'hasAttendance' => false, 'isExam' => false,
                        'items' => [['code' => 'PROJ1', 'title' => 'Project 1', 'maxScore' => 100]],
                    ],
                    [
                        'id' => 'ogb_exam1', 'title' => 'EXAM 1', 'weight' => 20, 'hasAttendance' => false, 'isExam' => true,
                        'items' => [['code' => 'Midterm', 'title' => 'Midterm Examination', 'maxScore' => 100]],
                    ],
                    [
                        'id' => 'ogb_exam2', 'title' => 'EXAM 2', 'weight' => 20, 'hasAttendance' => false, 'isExam' => true,
                        'items' => [['code' => 'Finals', 'title' => 'Final Examination', 'maxScore' => 100]],
                    ],
                ],
            ],
        ];
        foreach ($presets as $name => $scheme) {
            $exists = (int) Database::fetchColumn("SELECT COUNT(*) FROM `ana_grading_templates` WHERE `name` = :n", ['n' => $name]);
            if ($exists === 0) {
                Database::insert('ana_grading_templates', [
                    'name'           => $name,
                    'scheme'         => json_encode(['name' => $name] + $scheme),
                    'passing_cutoff' => $scheme['passingCutoff'],
                    'is_default'     => 0,
                    'is_active'      => 1,
                    'created_by'     => null,
                    'created_at'     => $now,
                ]);
            }
        }
    }
};

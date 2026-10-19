<?php

use Core\Database;

return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');
        $admin = Database::fetchOne(
            'SELECT id FROM `users` WHERE username = :username LIMIT 1',
            ['username' => 'admin']
        );
        $adminId = (int)($admin['id'] ?? 1);

        $organizations = [
            [
                'name' => 'MarSU Association of Information Technology Students',
                'acronym' => 'MAITS',
                'category' => 'Academic',
                'description' => 'A student organization supporting information technology learning, collaboration, and professional development.',
                'adviser' => 'Prof. Maria Santos',
                'status' => 'Active',
                'accreditation_date' => '2026-08-15',
            ],
            [
                'name' => 'MarSU Environmental Advocates',
                'acronym' => 'MEA',
                'category' => 'Special interest',
                'description' => 'A campus organization promoting environmental awareness and community sustainability initiatives.',
                'adviser' => 'Prof. Jose Reyes',
                'status' => 'Pending Accreditation',
                'accreditation_date' => null,
            ],
            [
                'name' => 'MarSU Student Events Council',
                'acronym' => 'MSEC',
                'category' => 'Student governance',
                'description' => 'Coordinates student-led activities and supports inclusive campus engagement.',
                'adviser' => 'Prof. Ana Cruz',
                'status' => 'Probationary',
                'accreditation_date' => null,
            ],
        ];

        foreach ($organizations as $organization) {
            $existing = Database::fetchOne(
                'SELECT id FROM `sld_organizations` WHERE acronym = :acronym LIMIT 1',
                ['acronym' => $organization['acronym']]
            );

            if ($existing) {
                $organizationId = (int)$existing['id'];
            } else {
                $organizationId = Database::insert('sld_organizations', [
                    'name' => $organization['name'],
                    'acronym' => $organization['acronym'],
                    'category' => $organization['category'],
                    'description' => $organization['description'],
                    'adviser' => $organization['adviser'],
                    'status' => $organization['status'],
                    'accreditation_date' => $organization['accreditation_date'],
                    'created_by' => $adminId,
                    'created_at' => $now,
                ]);
            }

            if ($organization['acronym'] === 'MAITS') {
                $members = [
                    ['name' => 'Juan Dela Cruz', 'student_number' => '2023-00124', 'role' => 'President', 'joined_at' => '2026-08-20'],
                    ['name' => 'Angela Mendoza', 'student_number' => '2024-00318', 'role' => 'Member', 'joined_at' => '2026-08-22'],
                    ['name' => 'Carlo Navarro', 'student_number' => '2022-00741', 'role' => 'Committee Head', 'joined_at' => '2026-08-25'],
                ];

                foreach ($members as $member) {
                    $memberExists = Database::fetchOne(
                        'SELECT id FROM `sld_members` WHERE organization_id = :organization_id AND student_number = :student_number LIMIT 1',
                        [
                            'organization_id' => $organizationId,
                            'student_number' => $member['student_number'],
                        ]
                    );

                    if (!$memberExists) {
                        Database::insert('sld_members', [
                            'organization_id' => $organizationId,
                            'member_name' => $member['name'],
                            'student_number' => $member['student_number'],
                            'role' => $member['role'],
                            'joined_at' => $member['joined_at'],
                            'status' => 'Active',
                            'created_at' => $now,
                        ]);
                    }
                }
            }
        }
    }
};

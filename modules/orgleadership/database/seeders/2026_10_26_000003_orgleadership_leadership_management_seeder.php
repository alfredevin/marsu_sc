<?php

use Core\Database;

/**
 * Seeder for Leadership Management submenus:
 * - Leadership Positions
 * - Terms
 * - Officers
 * - Appointments (History)
 * - Trainings
 */
return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');

        // 1. Seed Leadership Positions
        $positions = [
            ['name' => 'President', 'description' => 'Executive head of the organization; presides over all executive sessions and directs organizational projects.'],
            ['name' => 'Vice President', 'description' => 'Assists the President, coordinates committee operations, and assumes presidential duties when absent.'],
            ['name' => 'Secretary', 'description' => 'Maintains official minutes, correspondences, member archives, and accredited documentation.'],
            ['name' => 'Treasurer', 'description' => 'Oversees budgeting, collections, disbursement logs, and official financial reports.'],
            ['name' => 'Auditor', 'description' => 'Inspects and audits financial logs, receipts, inventories, and procurement compliance.'],
            ['name' => 'Public Information Officer', 'description' => 'Manages university press communications, event promotions, bulletin updates, and social channels.'],
            ['name' => 'Business Manager', 'description' => 'Coordinates event venues, logistical assets, sponsor liaisons, and partnership contracts.'],
            ['name' => 'Peace Officer', 'description' => 'Maintains order and decorum during general assemblies, official meetings, and campus gatherings.']
        ];

        $posMap = [];
        foreach ($positions as $pos) {
            $existing = Database::fetchOne(
                "SELECT id FROM `sld_leadership_positions` WHERE position_name = :name LIMIT 1",
                ['name' => $pos['name']]
            );
            if ($existing) {
                $posMap[$pos['name']] = (int)$existing['id'];
            } else {
                $id = Database::insert('sld_leadership_positions', [
                    'position_name' => $pos['name'],
                    'description'   => $pos['description'],
                    'created_at'    => $now
                ]);
                $posMap[$pos['name']] = (int)$id;
            }
        }

        // Get organizations
        $orgs = Database::fetchAll("SELECT id, acronym FROM `sld_organizations` WHERE deleted_at IS NULL");
        if (empty($orgs)) {
            return;
        }

        $orgMap = [];
        foreach ($orgs as $org) {
            $orgMap[$org['acronym']] = (int)$org['id'];
        }

        // 2. Seed Leadership Terms
        $termsData = [
            ['org' => 'MAITS', 'name' => 'A.Y. 2025-2026 Term', 'start' => '2025-08-01', 'end' => '2026-06-30', 'status' => 'Completed'],
            ['org' => 'MAITS', 'name' => 'A.Y. 2026-2027 Term', 'start' => '2026-08-01', 'end' => '2027-06-30', 'status' => 'Current'],
            ['org' => 'MAITS', 'name' => 'A.Y. 2027-2028 Term', 'start' => '2027-08-01', 'end' => '2028-06-30', 'status' => 'Upcoming'],
            ['org' => 'MEA',   'name' => 'A.Y. 2025-2026 Term', 'start' => '2025-08-01', 'end' => '2026-06-30', 'status' => 'Completed'],
            ['org' => 'MEA',   'name' => 'A.Y. 2026-2027 Term', 'start' => '2026-08-01', 'end' => '2027-06-30', 'status' => 'Current'],
            ['org' => 'MSEC',  'name' => 'A.Y. 2026-2027 Term', 'start' => '2026-08-01', 'end' => '2027-06-30', 'status' => 'Current'],
        ];

        $termMap = [];
        foreach ($termsData as $td) {
            $orgId = $orgMap[$td['org']] ?? array_values($orgMap)[0];
            $existing = Database::fetchOne(
                "SELECT id FROM `sld_leadership_terms` WHERE organization_id = :org_id AND term_name = :name LIMIT 1",
                ['org_id' => $orgId, 'name' => $td['name']]
            );
            $key = $td['org'] . '_' . $td['name'];
            if ($existing) {
                $termMap[$key] = (int)$existing['id'];
            } else {
                $id = Database::insert('sld_leadership_terms', [
                    'organization_id' => $orgId,
                    'term_name'       => $td['name'],
                    'start_date'      => $td['start'],
                    'end_date'        => $td['end'],
                    'term_status'     => $td['status'],
                    'created_at'      => $now
                ]);
                $termMap[$key] = (int)$id;
            }
        }

        // 3. Seed Officers
        $officersData = [
            [
                'student_id' => '26S0041',
                'org'        => 'MAITS',
                'position'   => 'President',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Dean’s Lister in BS Information Technology; advocate for open-source development and peer mentoring programs.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0087',
                'org'        => 'MAITS',
                'position'   => 'Vice President',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Student developer passionate about community hackathons and technical symposium logistics.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0095',
                'org'        => 'MAITS',
                'position'   => 'Secretary',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Experienced in organizational correspondence, documentation standards, and student council liaison tasks.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0227',
                'org'        => 'MAITS',
                'position'   => 'Treasurer',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Focuses on transparent financial reporting, digital audit tracking, and student fee stewardship.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0081',
                'org'        => 'MEA',
                'position'   => 'President',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Leads campus ecological cleanups, mangrove planting programs, and recycling drives.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0169',
                'org'        => 'MEA',
                'position'   => 'Vice President',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Coordinates volunteer teams across regional environmental advocacies and botanical projects.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0024',
                'org'        => 'MSEC',
                'position'   => 'President',
                'term'       => 'A.Y. 2026-2027 Term',
                'summary'    => 'Oversees university-wide collegiate intramurals, cultural nights, and talent showcases.',
                'status'     => 'Active'
            ],
            [
                'student_id' => '26S0174',
                'org'        => 'MAITS',
                'position'   => 'President',
                'term'       => 'A.Y. 2025-2026 Term',
                'summary'    => 'Former MAITS President; led the 2025 MarSU Regional Tech Conclave; currently graduating senior.',
                'status'     => 'Graduated'
            ],
        ];

        $officerIds = [];
        foreach ($officersData as $od) {
            $orgId = $orgMap[$od['org']] ?? array_values($orgMap)[0];
            $posId = $posMap[$od['position']] ?? array_values($posMap)[0];
            $termKey = $od['org'] . '_' . $od['term'];
            $termId = $termMap[$termKey] ?? array_values($termMap)[0];

            $existing = Database::fetchOne(
                "SELECT id FROM `sld_officers` WHERE student_id = :sid AND organization_id = :oid LIMIT 1",
                ['sid' => $od['student_id'], 'oid' => $orgId]
            );

            if ($existing) {
                $officerId = (int)$existing['id'];
            } else {
                $officerId = Database::insert('sld_officers', [
                    'student_id'       => $od['student_id'],
                    'organization_id'  => $orgId,
                    'profile_summary'  => $od['summary'],
                    'officers_status'  => $od['status'],
                    'created_at'       => $now
                ]);
            }
            $officerIds[] = (int)$officerId;

            // 4. Seed Appointment History Record
            $existingApp = Database::fetchOne(
                "SELECT id FROM `sld_officer_appointments` WHERE officer_id = :off_id AND term_id = :term_id LIMIT 1",
                ['off_id' => $officerId, 'term_id' => $termId]
            );

            if (!$existingApp) {
                Database::insert('sld_officer_appointments', [
                    'officer_id'      => $officerId,
                    'position_id'     => $posId,
                    'organization_id' => $orgId,
                    'term_id'         => $termId,
                    'start_date'      => $od['term'] === 'A.Y. 2025-2026 Term' ? '2025-08-01' : '2026-08-01',
                    'end_date'        => $od['term'] === 'A.Y. 2025-2026 Term' ? '2026-06-30' : null,
                    'created_at'      => $now
                ]);
            }
        }

        // 5. Seed Leadership Training & Development Logs
        $trainings = [
            [
                'officer_index' => 0, // Mariedhen
                'title'         => 'OSAS Student Leaders Executive Bootcamp 2026',
                'date'          => '2026-08-20',
                'provider'      => 'MarSU Office of Student Affairs & Services',
                'status'        => 'Completed'
            ],
            [
                'officer_index' => 0, // Mariedhen
                'title'         => 'Parliamentary Procedures & Resolution Drafting Workshop',
                'date'          => '2026-09-12',
                'provider'      => 'University Student Council Advisory Board',
                'status'        => 'Completed'
            ],
            [
                'officer_index' => 1, // Kyla Diane
                'title'         => 'Conflict Resolution & Inclusive Team Dynamics',
                'date'          => '2026-09-15',
                'provider'      => 'Guidance & Counseling Center',
                'status'        => 'Completed'
            ],
            [
                'officer_index' => 3, // Jake Louis (Treasurer)
                'title'         => 'Financial Stewardship and Digital Accounting Workshop',
                'date'          => '2026-09-28',
                'provider'      => 'MarSU Internal Audit Office',
                'status'        => 'Completed'
            ],
            [
                'officer_index' => 4, // Emmanuelsantino (MEA)
                'title'         => 'Regional Youth Environmental Leadership Conference',
                'date'          => '2026-10-05',
                'provider'      => 'DENR & MIMAROPA Youth Green Coalition',
                'status'        => 'Attended'
            ],
            [
                'officer_index' => 6, // Ysah Viktoria (MSEC)
                'title'         => 'Campus Event Safety & Mass Gathering Protocol Summit',
                'date'          => '2026-11-10',
                'provider'      => 'Disaster Risk Reduction and Management Office',
                'status'        => 'Registered'
            ],
        ];

        foreach ($trainings as $tr) {
            $offId = $officerIds[$tr['officer_index']] ?? $officerIds[0];
            $existingTr = Database::fetchOne(
                "SELECT id FROM `sld_leadership_trainings` WHERE officer_id = :oid AND training_title = :title LIMIT 1",
                ['oid' => $offId, 'title' => $tr['title']]
            );

            if (!$existingTr) {
                Database::insert('sld_leadership_trainings', [
                    'officer_id'        => $offId,
                    'training_title'    => $tr['title'],
                    'training_date'     => $tr['date'],
                    'provider'          => $tr['provider'],
                    'completion_status' => $tr['status'],
                    'created_at'        => $now
                ]);
            }
        }
    }
};

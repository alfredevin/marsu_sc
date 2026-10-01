<?php
/**
 * ISHAMIS - Integrated Student Housing and Accommodation Management Information System Seeder
 * Populates authentic Santa Cruz, Marinduque boarding houses, rooms, student resident bookings, and safety audits.
 */

use Core\Database;

return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');
        $adminUser = Database::fetchOne("SELECT id FROM users WHERE username = 'admin' LIMIT 1");
        $adminId = $adminUser['id'] ?? 1;

        // Fetch sample authentic students from MarSU database
        $students = Database::fetchAll("SELECT id, student_number, first_name, last_name FROM students ORDER BY id ASC LIMIT 12");
        if (empty($students)) {
            $students = [['id' => 1, 'first_name' => 'Juan', 'last_name' => 'Dela Cruz']];
        }

        // 1. Seed Accredited Boarding Houses around MarSU Santa Cruz Campus
        $houses = [
            [
                'code' => 'HSG-BH-001',
                'name' => 'Villa Marinduque Student Residence',
                'landlord' => 'Maria Carmela Alvarez',
                'contact' => '0917-845-2190',
                'email' => 'villamarinduque.hsg@gmail.com',
                'address' => 'Panfilo M. Manguera Sr. Rd., Brgy. Maharlika, Santa Cruz',
                'barangay' => 'Maharlika',
                'distance' => '150 meters (3 min walk from Gate 1)',
                'gender' => 'coed',
                'rooms' => 6,
                'capacity' => 18,
                'rate_min' => 1800.00,
                'rate_max' => 3200.00,
                'curfew' => '10:00 PM',
                'amenities' => 'High-Speed Wi-Fi, 24/7 CCTV, Filtered Drinking Water, Individual Study Desks, Common Kitchen, Washing Area',
                'status' => 'accredited',
                'rating' => 4.8,
                'remarks' => 'Premier accredited student facility with full fire alarm system and sanitary compliance.'
            ],
            [
                'code' => 'HSG-BH-002',
                'name' => 'Sta. Cruz Scholars Executive Dormitory',
                'landlord' => 'Engr. Rodolfo L. Macatangay',
                'contact' => '0928-552-8711',
                'email' => 'stacruz.scholars@dormmail.ph',
                'address' => 'Sitio Riverside, Brgy. Lapu-Lapu, Santa Cruz',
                'barangay' => 'Lapu-Lapu',
                'distance' => '300 meters (5 min walk from CICS Building)',
                'gender' => 'coed',
                'rooms' => 8,
                'capacity' => 24,
                'rate_min' => 1600.00,
                'rate_max' => 2800.00,
                'curfew' => '09:30 PM',
                'amenities' => 'Wi-Fi, Water Included, Sub-metered Electricity, Gated Perimeter, Emergency Lights, Fire Extinguishers',
                'status' => 'accredited',
                'rating' => 4.6,
                'remarks' => 'Highly recommended for CICS IT & IS computing students with quiet study curfew.'
            ],
            [
                'code' => 'HSG-BH-003',
                'name' => 'Damaso Female Student Home',
                'landlord' => 'Lourdes Damaso-Reyes',
                'contact' => '0995-124-7833',
                'email' => 'damaso.home@yahoo.com',
                'address' => 'National Highway, Brgy. Poblacion I, Santa Cruz',
                'barangay' => 'Poblacion I',
                'distance' => '450 meters from Campus Quadrangle',
                'gender' => 'female_only',
                'rooms' => 4,
                'capacity' => 12,
                'rate_min' => 2000.00,
                'rate_max' => 3500.00,
                'curfew' => '09:00 PM',
                'amenities' => 'Airconditioned Rooms Available, Strict Curfew Logbook, Biometric Entry, Wi-Fi, Refrigerator Access',
                'status' => 'accredited',
                'rating' => 4.9,
                'remarks' => 'Exclusive female student residence with strict visitor screening and in-house matron.'
            ],
            [
                'code' => 'HSG-BH-004',
                'name' => 'CICS Haven Bedspace & Lodge',
                'landlord' => 'Kapitan Bernardo Morales',
                'contact' => '0947-331-9082',
                'email' => 'cics.haven.bh@gmail.com',
                'address' => 'Purok 3, Brgy. Tamayo, Santa Cruz',
                'barangay' => 'Tamayo',
                'distance' => '200 meters from Back Gate',
                'gender' => 'male_only',
                'rooms' => 5,
                'capacity' => 16,
                'rate_min' => 1400.00,
                'rate_max' => 2200.00,
                'curfew' => '10:30 PM',
                'amenities' => 'Wi-Fi Fiber 100Mbps, Motorcycle Parking, Free Mineral Water, Motorcycle Wash Area',
                'status' => 'accredited',
                'rating' => 4.4,
                'remarks' => 'Budget-friendly male boarding lodge with secure motor vehicle parking.'
            ],
            [
                'code' => 'HSG-BH-005',
                'name' => 'St. Anthony Student Flats',
                'landlord' => 'Elena Santos-Tan',
                'contact' => '0939-664-1029',
                'email' => 'stanthony.flats@gmail.com',
                'address' => 'Brgy. Pag-asa, Santa Cruz',
                'barangay' => 'Pag-asa',
                'distance' => '500 meters from University Library',
                'gender' => 'coed',
                'rooms' => 6,
                'capacity' => 18,
                'rate_min' => 1500.00,
                'rate_max' => 2600.00,
                'curfew' => '10:00 PM',
                'amenities' => 'Spacious Balcony, Individual Locker Cabinets, Wi-Fi, Water Tank, CCTV',
                'status' => 'probationary',
                'rating' => 3.9,
                'remarks' => 'Under conditional accreditation pending renewal of emergency fire lighting.'
            ]
        ];

        $houseIds = [];
        foreach ($houses as $h) {
            $existing = Database::fetchOne("SELECT id FROM hsg_boarding_houses WHERE code = :code", ['code' => $h['code']]);
            if ($existing) {
                $houseIds[] = $existing['id'];
            } else {
                Database::insert('hsg_boarding_houses', [
                    'code' => $h['code'],
                    'name' => $h['name'],
                    'landlord_name' => $h['landlord'],
                    'landlord_contact' => $h['contact'],
                    'landlord_email' => $h['email'],
                    'address' => $h['address'],
                    'barangay' => $h['barangay'],
                    'distance_campus' => $h['distance'],
                    'gender_type' => $h['gender'],
                    'total_rooms' => $h['rooms'],
                    'total_bed_capacity' => $h['capacity'],
                    'monthly_rate_min' => $h['rate_min'],
                    'monthly_rate_max' => $h['rate_max'],
                    'curfew_time' => $h['curfew'],
                    'amenities' => $h['amenities'],
                    'accreditation_status' => $h['status'],
                    'safety_rating' => $h['rating'],
                    'remarks' => $h['remarks'],
                    'created_by' => $adminId,
                    'created_at' => $now
                ]);
                $houseIds[] = (int)Database::pdo()->lastInsertId();
            }
        }

        // 2. Seed Rooms for each Boarding House
        $roomTypes = [
            ['type' => 'solo', 'beds' => 1, 'rate' => 3000.00, 'aircon' => 1, 'cr' => 1],
            ['type' => 'shared_2', 'beds' => 2, 'rate' => 2200.00, 'aircon' => 0, 'cr' => 1],
            ['type' => 'shared_4', 'beds' => 4, 'rate' => 1600.00, 'aircon' => 0, 'cr' => 0],
            ['type' => 'bedspace', 'beds' => 4, 'rate' => 1400.00, 'aircon' => 0, 'cr' => 0]
        ];

        $roomIds = [];
        foreach ($houseIds as $bhIndex => $bhId) {
            for ($rNum = 101; $rNum <= 104; $rNum++) {
                $preset = $roomTypes[($bhIndex + $rNum) % count($roomTypes)];
                $occupied = ($rNum % 2 == 0) ? 1 : 0;
                $vacant = max(0, $preset['beds'] - $occupied);
                $status = ($vacant == 0) ? 'full' : 'available';

                $existingRoom = Database::fetchOne("SELECT id FROM hsg_rooms WHERE boarding_house_id = :bhid AND room_number = :rn", [
                    'bhid' => $bhId,
                    'rn' => 'Room ' . $rNum
                ]);

                if ($existingRoom) {
                    $roomIds[] = $existingRoom['id'];
                } else {
                    Database::insert('hsg_rooms', [
                        'boarding_house_id' => $bhId,
                        'room_number' => 'Room ' . $rNum,
                        'room_type' => $preset['type'],
                        'capacity_beds' => $preset['beds'],
                        'occupied_beds' => $occupied,
                        'vacant_beds' => $vacant,
                        'rate_per_month' => $preset['rate'],
                        'has_aircon' => $preset['aircon'],
                        'has_private_cr' => $preset['cr'],
                        'has_study_desk' => 1,
                        'status' => $status,
                        'created_at' => $now
                    ]);
                    $roomIds[] = (int)Database::pdo()->lastInsertId();
                }
            }
        }

        // 3. Seed Student Resident Accommodations
        if (!empty($students) && !empty($roomIds)) {
            foreach (array_slice($students, 0, 6) as $idx => $st) {
                $bhId = $houseIds[$idx % count($houseIds)];
                $rmId = $roomIds[$idx % count($roomIds)];

                $exists = Database::fetchOne("SELECT id FROM hsg_accommodations WHERE student_id = :sid", ['sid' => $st['id']]);
                if (!$exists) {
                    Database::insert('hsg_accommodations', [
                        'boarding_house_id' => $bhId,
                        'room_id' => $rmId,
                        'student_id' => $st['id'],
                        'start_date' => '2026-08-15',
                        'end_date' => '2026-12-20',
                        'agreed_rate' => 2000.00,
                        'payment_status' => ($idx % 3 == 0) ? 'pending' : 'paid',
                        'guardian_contact' => '0919-555-' . str_pad((string)($idx + 1000), 4, '0', STR_PAD_LEFT),
                        'status' => 'active',
                        'created_at' => $now
                    ]);
                }
            }
        }

        // 4. Seed Safety and Sanitation Inspections
        foreach ($houseIds as $idx => $bhId) {
            $existingInsp = Database::fetchOne("SELECT id FROM hsg_inspections WHERE boarding_house_id = :bhid", ['bhid' => $bhId]);
            if (!$existingInsp) {
                $score = 90 + ($idx % 9);
                $grade = ($score >= 95) ? 'A' : (($score >= 85) ? 'B' : 'C');
                Database::insert('hsg_inspections', [
                    'boarding_house_id' => $bhId,
                    'inspector_id' => $adminId,
                    'inspector_name' => 'Office of Student Affairs & Housing Accreditation Committee',
                    'inspection_date' => date('Y-m-d', strtotime('-' . ($idx * 7) . ' days')),
                    'fire_safety_passed' => 1,
                    'sanitary_permit_valid' => 1,
                    'building_permit_valid' => 1,
                    'cctv_functioning' => 1,
                    'compliance_score' => $score,
                    'rating_grade' => $grade,
                    'findings' => 'Passed full sanitation audit and fire evacuation compliance test. Perimeter well-lit.',
                    'recommendations' => 'Maintain quarterly fire drill log and ensure hallway emergency lights are tested weekly.',
                    'next_inspection_date' => date('Y-m-d', strtotime('+3 months')),
                    'created_at' => $now
                ]);
            }
        }
    }
};

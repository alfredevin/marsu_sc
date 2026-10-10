<?php
namespace Modules\Housing\Database\Seeders;

use Core\Database;

class HousingSeeder {
    public static function run(): void {
        $db = Database::pdo();

        // 1. Boarding Houses
        $houses = [
            [
                'name' => 'Villa Marinduque Student Dormitory',
                'owner_name' => 'Engr. Rogelio Maglacas',
                'contact_number' => '0917-882-1402',
                'address' => 'Purok 3, Panfilo M. Manguera Sr. Rd',
                'barangay' => 'Brgy. Santol, Boac',
                'accreditation_status' => 'Accredited',
                'safety_rating' => 'A+',
                'total_rooms' => 12,
                'total_capacity' => 36,
                'current_occupancy' => 28,
                'monthly_rate_min' => 1400.00,
                'monthly_rate_max' => 2200.00,
                'amenities' => 'High-Speed Wi-Fi, CCTV 24/7, Gated Security, Study Hall, Kitchen Access, Water Dispenser',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Greenview Residence & Bed Space',
                'owner_name' => 'Mrs. Remedios Montemar',
                'contact_number' => '0928-334-9011',
                'address' => 'Sitio Riverside, Near MarSU East Gate',
                'barangay' => 'Brgy. Tanza, Boac',
                'accreditation_status' => 'Accredited',
                'safety_rating' => 'A',
                'total_rooms' => 8,
                'total_capacity' => 24,
                'current_occupancy' => 20,
                'monthly_rate_min' => 1200.00,
                'monthly_rate_max' => 1800.00,
                'amenities' => 'Fiber Wi-Fi, Fire Extinguishers, Emergency Lighting, Sub-meter Electricity, Laundry Area',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sunrise Ladies Dormitory',
                'owner_name' => 'Dr. Carmela Villaster',
                'contact_number' => '0919-672-4455',
                'address' => 'Cor. Mabini & Rizal Streets',
                'barangay' => 'Brgy. Murallon, Boac',
                'accreditation_status' => 'Accredited',
                'safety_rating' => 'A+',
                'total_rooms' => 10,
                'total_capacity' => 20,
                'current_occupancy' => 18,
                'monthly_rate_min' => 1800.00,
                'monthly_rate_max' => 2500.00,
                'amenities' => 'Biometric Gate Access, Air-conditioned Rooms, Free Purified Water, In-house Matron',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Boac Pines Boarding House',
                'owner_name' => 'Mr. Danilo Larracas',
                'contact_number' => '0939-112-9988',
                'address' => 'Hillside Ave, Near Provincial Capitol',
                'barangay' => 'Brgy. San Miguel, Boac',
                'accreditation_status' => 'Pending Accreditation',
                'safety_rating' => 'B',
                'total_rooms' => 6,
                'total_capacity' => 18,
                'current_occupancy' => 12,
                'monthly_rate_min' => 1100.00,
                'monthly_rate_max' => 1600.00,
                'amenities' => 'Spacious Yard, Motorcycle Parking, Common Lounge, Backup Water Tank',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($houses as $h) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_boarding_houses` WHERE `name` = :name", ['name' => $h['name']]);
            if (!$existing) {
                Database::insert('hsg_boarding_houses', $h);
            }
        }

        $bh1 = Database::fetchOne("SELECT id FROM `hsg_boarding_houses` WHERE `name` LIKE '%Villa Marinduque%'")['id'] ?? 1;
        $bh2 = Database::fetchOne("SELECT id FROM `hsg_boarding_houses` WHERE `name` LIKE '%Greenview%'")['id'] ?? 2;
        $bh3 = Database::fetchOne("SELECT id FROM `hsg_boarding_houses` WHERE `name` LIKE '%Sunrise Ladies%'")['id'] ?? 3;

        // 2. Rooms
        $rooms = [
            ['boarding_house_id' => $bh1, 'room_number' => 'Room 101', 'room_type' => 'Single', 'capacity' => 1, 'occupied_beds' => 1, 'monthly_rate' => 2200.00, 'floor' => '1st Floor', 'status' => 'Full', 'amenities' => 'Aircon, Ensuite Bath, Study Desk', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh1, 'room_number' => 'Room 102', 'room_type' => 'Double', 'capacity' => 2, 'occupied_beds' => 1, 'monthly_rate' => 1600.00, 'floor' => '1st Floor', 'status' => 'Partially Occupied', 'amenities' => 'Wall Fan, 2 Study Desks, Individual Lockers', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh1, 'room_number' => 'Room 103', 'room_type' => 'Quad', 'capacity' => 4, 'occupied_beds' => 4, 'monthly_rate' => 1400.00, 'floor' => '1st Floor', 'status' => 'Full', 'amenities' => 'Double Bunk Beds, Ceiling Fan, Lockers', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh1, 'room_number' => 'Room 201', 'room_type' => 'Double', 'capacity' => 2, 'occupied_beds' => 0, 'monthly_rate' => 1500.00, 'floor' => '2nd Floor', 'status' => 'Available', 'amenities' => 'Window Balcony, Fan, Study Nook', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh1, 'room_number' => 'Room 202', 'room_type' => 'Double', 'capacity' => 2, 'occupied_beds' => 2, 'monthly_rate' => 1500.00, 'floor' => '2nd Floor', 'status' => 'Full', 'amenities' => 'Fan, Lockers, Free WiFi', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh2, 'room_number' => 'Room A-1', 'room_type' => 'Double', 'capacity' => 2, 'occupied_beds' => 1, 'monthly_rate' => 1300.00, 'floor' => 'Ground Floor', 'status' => 'Partially Occupied', 'amenities' => 'Exhaust Fan, Shared Bath, Cabinet', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh2, 'room_number' => 'Room A-2', 'room_type' => 'Triple', 'capacity' => 3, 'occupied_beds' => 0, 'monthly_rate' => 1200.00, 'floor' => 'Ground Floor', 'status' => 'Available', 'amenities' => 'Ceiling Fan, Balcony View', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh3, 'room_number' => 'Suite 1', 'room_type' => 'Single', 'capacity' => 1, 'occupied_beds' => 1, 'monthly_rate' => 2500.00, 'floor' => '1st Floor', 'status' => 'Full', 'amenities' => 'Aircon, Private Shower, Wardrobe', 'created_at' => date('Y-m-d H:i:s')],
            ['boarding_house_id' => $bh3, 'room_number' => 'Room 204', 'room_type' => 'Double', 'capacity' => 2, 'occupied_beds' => 0, 'monthly_rate' => 1800.00, 'floor' => '2nd Floor', 'status' => 'Available', 'amenities' => 'Fan, Individual Lockers, Study Table', 'created_at' => date('Y-m-d H:i:s')]
        ];

        foreach ($rooms as $r) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_rooms` WHERE `boarding_house_id` = :bhid AND `room_number` = :rn", [
                'bhid' => $r['boarding_house_id'],
                'rn' => $r['room_number']
            ]);
            if (!$existing) {
                Database::insert('hsg_rooms', $r);
            }
        }

        // 3. Resident Tenants
        $tenants = [
            [
                'student_no' => '22-0145',
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'gender' => 'Female',
                'email' => 'santos.maria@marsu.edu.ph',
                'contact_number' => '0917-123-4567',
                'college' => 'CICS',
                'program' => 'BS Information Technology',
                'year_level' => '3rd Year',
                'boarding_house_id' => $bh1,
                'room_id' => 2,
                'bed_number' => 'Bed A',
                'move_in_date' => '2026-08-15',
                'monthly_rent' => 1600.00,
                'balance' => 0.00,
                'emergency_contact_name' => 'Elena Santos (Mother)',
                'emergency_contact_phone' => '0917-999-1122',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'student_no' => '23-0891',
                'first_name' => 'John Rey',
                'last_name' => 'Reyes',
                'gender' => 'Male',
                'email' => 'reyes.johnrey@marsu.edu.ph',
                'contact_number' => '0918-987-6543',
                'college' => 'CICS',
                'program' => 'BS Computer Science',
                'year_level' => '2nd Year',
                'boarding_house_id' => $bh2,
                'room_id' => 6,
                'bed_number' => 'Bed B',
                'move_in_date' => '2026-09-01',
                'monthly_rent' => 1300.00,
                'balance' => 0.00,
                'emergency_contact_name' => 'Ricardo Reyes (Father)',
                'emergency_contact_phone' => '0918-222-3344',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'student_no' => '21-0322',
                'first_name' => 'Angelica',
                'last_name' => 'Ramos',
                'gender' => 'Female',
                'email' => 'ramos.angelica@marsu.edu.ph',
                'contact_number' => '0920-555-8888',
                'college' => 'CE',
                'program' => 'BS Civil Engineering',
                'year_level' => '4th Year',
                'boarding_house_id' => $bh3,
                'room_id' => 8,
                'bed_number' => 'Bed A',
                'move_in_date' => '2026-08-20',
                'monthly_rent' => 2500.00,
                'balance' => 2500.00,
                'emergency_contact_name' => 'Grace Ramos (Mother)',
                'emergency_contact_phone' => '0920-111-4455',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'student_no' => '24-1102',
                'first_name' => 'Mark Joseph',
                'last_name' => 'Alcantara',
                'gender' => 'Male',
                'email' => 'alcantara.mark@marsu.edu.ph',
                'contact_number' => '0919-444-2233',
                'college' => 'CHAM',
                'program' => 'BS Hospitality Management',
                'year_level' => '1st Year',
                'boarding_house_id' => $bh1,
                'room_id' => 3,
                'bed_number' => 'Bed C',
                'move_in_date' => '2026-09-10',
                'monthly_rent' => 1400.00,
                'balance' => 0.00,
                'emergency_contact_name' => 'Joseph Alcantara (Father)',
                'emergency_contact_phone' => '0919-333-8899',
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($tenants as $t) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_tenants` WHERE `student_no` = :sn", ['sn' => $t['student_no']]);
            if (!$existing) {
                Database::insert('hsg_tenants', $t);
            }
        }

        // 4. Applications
        $apps = [
            [
                'student_no' => '24-1590',
                'full_name' => 'Kyla Marie Del Mundo',
                'gender' => 'Female',
                'college' => 'CICS',
                'program' => 'BS Information Systems',
                'year_level' => '1st Year',
                'preferred_house' => 'Villa Marinduque Student Dormitory',
                'preferred_room_type' => 'Double',
                'target_move_in' => '2026-10-15',
                'monthly_budget' => 1600.00,
                'guardian_name' => 'Teresa Del Mundo',
                'guardian_contact' => '0921-889-0012',
                'status' => 'Pending Review',
                'remarks' => 'Freshman student from Torrijos requesting accommodation close to CICS building.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'student_no' => '23-0441',
                'full_name' => 'Christian Dave Morales',
                'gender' => 'Male',
                'college' => 'CAS',
                'program' => 'BA Communication',
                'year_level' => '2nd Year',
                'preferred_house' => 'Greenview Residence & Bed Space',
                'preferred_room_type' => 'Triple',
                'target_move_in' => '2026-10-18',
                'monthly_budget' => 1300.00,
                'guardian_name' => 'Edgar Morales',
                'guardian_contact' => '0919-332-1144',
                'status' => 'Waitlisted',
                'remarks' => 'Priority slot requested for November semester intake.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($apps as $a) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_applications` WHERE `student_no` = :sn", ['sn' => $a['student_no']]);
            if (!$existing) {
                Database::insert('hsg_applications', $a);
            }
        }

        // 5. Payments
        $payments = [
            [
                'tenant_id' => 1,
                'student_no' => '22-0145',
                'student_name' => 'Maria Santos',
                'boarding_house_id' => $bh1,
                'or_number' => 'OR-2026-0089',
                'payment_type' => 'Monthly Rent',
                'amount' => 1600.00,
                'payment_method' => 'GCash',
                'payment_date' => '2026-10-01',
                'period_covered' => 'October 2026',
                'status' => 'Verified',
                'remarks' => 'Paid via GCash Ref# 102938475',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'tenant_id' => 2,
                'student_no' => '23-0891',
                'student_name' => 'John Rey Reyes',
                'boarding_house_id' => $bh2,
                'or_number' => 'OR-2026-0090',
                'payment_type' => 'Monthly Rent',
                'amount' => 1300.00,
                'payment_method' => 'Cash',
                'payment_date' => '2026-10-02',
                'period_covered' => 'October 2026',
                'status' => 'Verified',
                'remarks' => 'Cash payment at Admin Office',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'tenant_id' => 4,
                'student_no' => '24-1102',
                'student_name' => 'Mark Joseph Alcantara',
                'boarding_house_id' => $bh1,
                'or_number' => 'OR-2026-0091',
                'payment_type' => 'Monthly Rent',
                'amount' => 1400.00,
                'payment_method' => 'Maya',
                'payment_date' => '2026-10-03',
                'period_covered' => 'October 2026',
                'status' => 'Verified',
                'remarks' => 'Maya payment Ref# 99482103',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($payments as $p) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_payments` WHERE `or_number` = :or", ['or' => $p['or_number']]);
            if (!$existing) {
                Database::insert('hsg_payments', $p);
            }
        }

        // 6. Maintenance Tickets
        $tickets = [
            [
                'ticket_number' => 'MNT-2026-101',
                'boarding_house_id' => $bh1,
                'room_number' => 'Room 102',
                'reported_by' => 'Maria Santos',
                'issue_category' => 'Plumbing',
                'issue_title' => 'Bathroom faucet leak',
                'description' => 'The faucet in the shared bathroom is dripping continuously since yesterday evening.',
                'priority' => 'Medium',
                'status' => 'In Progress',
                'assigned_staff' => 'Mang Pedring (Maintenance Staff)',
                'estimated_cost' => 350.00,
                'reported_at' => '2026-10-07 08:30:00',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'ticket_number' => 'MNT-2026-102',
                'boarding_house_id' => $bh2,
                'room_number' => 'Room A-1',
                'reported_by' => 'John Rey Reyes',
                'issue_category' => 'Electrical',
                'issue_title' => 'Flickering fluorescent ceiling lamp',
                'description' => 'Fluorescent light tube blinks intermittently, needs starter or bulb replacement.',
                'priority' => 'Low',
                'status' => 'Open',
                'assigned_staff' => 'Unassigned',
                'estimated_cost' => 180.00,
                'reported_at' => '2026-10-08 14:15:00',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($tickets as $tk) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_maintenance` WHERE `ticket_number` = :tn", ['tn' => $tk['ticket_number']]);
            if (!$existing) {
                Database::insert('hsg_maintenance', $tk);
            }
        }

        // 7. Announcements
        $news = [
            [
                'title' => 'Quarterly Fire Safety & Sanitation Inspection Schedule',
                'category' => 'Inspection Schedule',
                'priority' => 'Important',
                'content' => 'BFP Boac together with the MarSU ISHAMIS Inspectorate Team will conduct annual compliance inspections across all accredited boarding facilities from October 15-20, 2026. Landlords are advised to prepare fire extinguishers and emergency exit clearings.',
                'target_audience' => 'All Landlords & Residents',
                'published_by' => 'ISHAMIS Office',
                'status' => 'Published',
                'pinned' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Standard Campus Curfew & Quiet Hours Reminder',
                'category' => 'Curfew Reminder',
                'priority' => 'Normal',
                'content' => 'All resident students are reminded that university quiet hours begin at 10:00 PM on weeknights. Visitors must sign the logbook at the front desk and vacate premises by 8:00 PM.',
                'target_audience' => 'All Residents',
                'published_by' => 'OSAS Student Housing Unit',
                'status' => 'Published',
                'pinned' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($news as $n) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_announcements` WHERE `title` = :t", ['t' => $n['title']]);
            if (!$existing) {
                Database::insert('hsg_announcements', $n);
            }
        }

        // 8. Incidents
        $incidents = [
            [
                'incident_no' => 'INC-2026-004',
                'incident_type' => 'Noise Disturbance',
                'location' => 'Villa Marinduque Dormitory, 2nd Floor Veranda',
                'incident_date' => '2026-10-04',
                'incident_time' => '23:45:00',
                'parties_involved' => 'Room 202 occupants and 2 external visitors',
                'narrative' => 'Loud speaker playback during quiet hours reported by neighbor. Matron addressed the situation calmly, visitors were escorted out.',
                'severity' => 'Minor',
                'status' => 'Resolved',
                'reported_by' => 'Mrs. Maglacas (House Matron)',
                'action_taken' => '1st Verbal warning issued to occupants as per ISHAMIS Code of Conduct.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($incidents as $inc) {
            $existing = Database::fetchOne("SELECT id FROM `hsg_incidents` WHERE `incident_no` = :no", ['no' => $inc['incident_no']]);
            if (!$existing) {
                Database::insert('hsg_incidents', $inc);
            }
        }
    }
}

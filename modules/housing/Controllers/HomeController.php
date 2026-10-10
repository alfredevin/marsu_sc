<?php

namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Accredited Boarding House Management & Directory (ISHAMIS)
 * Full database-backed operations with interactive CRUD handlers.
 */
class HomeController
{
    public function index(): void
    {
        $user = Auth::user();

        // Live KPI statistics
        $stats = [
            'total_houses'     => (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_boarding_houses` WHERE deleted_at IS NULL"),
            'total_rooms'      => (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_rooms` WHERE deleted_at IS NULL"),
            'total_tenants'    => (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_tenants` WHERE status = 'Active' AND deleted_at IS NULL"),
            'total_apps'       => (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_applications` WHERE status = 'Pending Review' AND deleted_at IS NULL"),
            'open_maintenance' => (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_maintenance` WHERE status IN ('Open', 'In Progress')"),
            'recent_payments'  => (float)Database::fetchColumn("SELECT COALESCE(SUM(amount), 0) FROM `hsg_payments` WHERE MONTH(payment_date) = MONTH(CURRENT_DATE())")
        ];

        // Recent Activity feeds
        $recentTenants = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number 
            FROM `hsg_tenants` t 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            LEFT JOIN `hsg_rooms` r ON t.room_id = r.id 
            WHERE t.deleted_at IS NULL ORDER BY t.id DESC LIMIT 5");

        $recentTickets = Database::fetchAll("SELECT * FROM `hsg_maintenance` ORDER BY id DESC LIMIT 5");
        $announcements = Database::fetchAll("SELECT * FROM `hsg_announcements` WHERE status = 'Published' ORDER BY pinned DESC, id DESC LIMIT 3");

        View::render('housing/Views/index', [
            'title'          => 'Accredited Boarding House Management & Directory',
            'moduleName'     => 'Accredited Boarding House Management & Directory',
            'slug'           => 'housing',
            'stats'          => $stats,
            'recentTenants'  => $recentTenants,
            'recentTickets'  => $recentTickets,
            'announcements'  => $announcements,
            'user'           => $user,
            'crumbs'         => [
                'Student Services' => '',
                'Accredited Boarding House Management & Directory' => ''
            ]
        ]);
    }

    public function show(): void
    {
        $this->index();
    }

    public function store(): void
    {
        redirect(url('housing'), 'success', 'Record updated successfully.');
    }

    /* -------------------------------------------------------------
     * 1. Tenant Management
     * ------------------------------------------------------------- */

    public function tenants(): void
    {
        $user = Auth::user();

        $tenants = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number 
            FROM `hsg_tenants` t 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            LEFT JOIN `hsg_rooms` r ON t.room_id = r.id 
            WHERE t.deleted_at IS NULL 
            ORDER BY t.id DESC");

        $boardingHouses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");
        $rooms = Database::fetchAll("SELECT id, room_number, boarding_house_id, monthly_rate FROM `hsg_rooms` WHERE deleted_at IS NULL ORDER BY room_number ASC");

        View::render('housing/Views/tenants', [
            'title'          => 'Tenant Profiles & Directory',
            'slug'           => 'housing',
            'user'           => $user,
            'tenants'        => $tenants,
            'boardingHouses' => $boardingHouses,
            'rooms'          => $rooms
        ]);
    }

    public function storeTenant(): void
    {
        $studentNo = trim($_POST['student_no'] ?? '');
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName  = trim($_POST['last_name'] ?? '');

        if (empty($studentNo) || empty($firstName) || empty($lastName)) {
            redirect(url('housing/tenants'), 'error', 'Student number, first name, and last name are required.');
        }

        $houseId = !empty($_POST['boarding_house_id']) ? (int)$_POST['boarding_house_id'] : null;
        $roomId  = !empty($_POST['room_id']) ? (int)$_POST['room_id'] : null;

        Database::insert('hsg_tenants', [
            'student_no'              => $studentNo,
            'first_name'              => $firstName,
            'last_name'               => $lastName,
            'gender'                  => $_POST['gender'] ?? 'Female',
            'email'                   => trim($_POST['email'] ?? ''),
            'contact_number'          => trim($_POST['contact_number'] ?? ''),
            'college'                 => trim($_POST['college'] ?? 'CICS'),
            'program'                 => trim($_POST['program'] ?? 'BSIT'),
            'year_level'              => trim($_POST['year_level'] ?? '1st Year'),
            'boarding_house_id'       => $houseId,
            'room_id'                 => $roomId,
            'bed_number'              => trim($_POST['bed_number'] ?? 'Bed A'),
            'move_in_date'            => !empty($_POST['move_in_date']) ? $_POST['move_in_date'] : date('Y-m-d'),
            'monthly_rent'            => (float)($_POST['monthly_rent'] ?? 1500.00),
            'balance'                 => 0.00,
            'emergency_contact_name'  => trim($_POST['emergency_contact_name'] ?? ''),
            'emergency_contact_phone' => trim($_POST['emergency_contact_phone'] ?? ''),
            'status'                  => 'Active',
            'created_at'              => date('Y-m-d H:i:s')
        ]);

        if ($roomId) {
            Database::query("UPDATE `hsg_rooms` SET occupied_beds = occupied_beds + 1 WHERE id = :id", ['id' => $roomId]);
        }

        redirect(url('housing/tenants'), 'success', "Tenant {$firstName} {$lastName} ({$studentNo}) registered successfully!");
    }

    public function deleteTenant(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $tenant = Database::fetchOne("SELECT * FROM `hsg_tenants` WHERE id = :id", ['id' => $id]);
            if ($tenant && !empty($tenant['room_id'])) {
                Database::query("UPDATE `hsg_rooms` SET occupied_beds = GREATEST(0, occupied_beds - 1) WHERE id = :id", ['id' => $tenant['room_id']]);
            }
            Database::update('hsg_tenants', ['status' => 'Checked Out', 'updated_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
            redirect(url('housing/tenants'), 'success', 'Tenant marked as checked out successfully.');
        }
        redirect(url('housing/tenants'), 'error', 'Invalid tenant record.');
    }

    public function residencyhistory(): void
    {
        $user = Auth::user();

        $history = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number 
            FROM `hsg_tenants` t 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            LEFT JOIN `hsg_rooms` r ON t.room_id = r.id 
            ORDER BY t.move_in_date DESC");

        View::render('housing/Views/residencyhistory', [
            'title'   => 'Student Residency History & Logs',
            'slug'    => 'housing',
            'user'    => $user,
            'history' => $history
        ]);
    }

    public function history(): void
    {
        $this->residencyhistory();
    }

    /* -------------------------------------------------------------
     * 2. Room & Accommodation
     * ------------------------------------------------------------- */

    public function roomandinventory(): void
    {
        $user = Auth::user();

        $rooms = Database::fetchAll("SELECT r.*, b.name as house_name, b.address as house_address 
            FROM `hsg_rooms` r 
            LEFT JOIN `hsg_boarding_houses` b ON r.boarding_house_id = b.id 
            WHERE r.deleted_at IS NULL 
            ORDER BY r.id ASC");

        $boardingHouses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        $stats = [
            'total_rooms'      => count($rooms),
            'available_rooms'  => (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_rooms` WHERE status = 'Available' AND deleted_at IS NULL"),
            'occupied_beds'    => (int)Database::fetchColumn("SELECT COALESCE(SUM(occupied_beds), 0) FROM `hsg_rooms` WHERE deleted_at IS NULL"),
            'total_capacity'   => (int)Database::fetchColumn("SELECT COALESCE(SUM(capacity), 0) FROM `hsg_rooms` WHERE deleted_at IS NULL")
        ];

        View::render('housing/Views/roomandinventory', [
            'title'          => 'Room & Property Inventory',
            'slug'           => 'housing',
            'user'           => $user,
            'rooms'          => $rooms,
            'boardingHouses' => $boardingHouses,
            'stats'          => $stats
        ]);
    }

    public function storeRoom(): void
    {
        $roomNumber = trim($_POST['room_number'] ?? '');
        $houseId    = (int)($_POST['boarding_house_id'] ?? 0);

        if (empty($roomNumber) || $houseId <= 0) {
            redirect(url('housing/roomandinventory'), 'error', 'Boarding house and room number are required.');
        }

        $capacity = (int)($_POST['capacity'] ?? 2);
        Database::insert('hsg_rooms', [
            'boarding_house_id' => $houseId,
            'room_number'       => $roomNumber,
            'room_type'         => $_POST['room_type'] ?? 'Double',
            'capacity'          => $capacity,
            'occupied_beds'     => 0,
            'monthly_rate'      => (float)($_POST['monthly_rate'] ?? 1500.00),
            'floor'             => trim($_POST['floor'] ?? '1st Floor'),
            'status'            => 'Available',
            'amenities'         => trim($_POST['amenities'] ?? 'Wi-Fi, Study Desk, Locker'),
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/roomandinventory'), 'success', "Room {$roomNumber} added to inventory successfully!");
    }

    public function deleteRoom(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('hsg_rooms', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
            redirect(url('housing/roomandinventory'), 'success', 'Room deleted from inventory.');
        }
        redirect(url('housing/roomandinventory'), 'error', 'Invalid room record.');
    }

    public function availabilitytracking(): void
    {
        $user = Auth::user();

        $rooms = Database::fetchAll("SELECT r.*, b.name as house_name, (r.capacity - r.occupied_beds) as vacant_beds 
            FROM `hsg_rooms` r 
            LEFT JOIN `hsg_boarding_houses` b ON r.boarding_house_id = b.id 
            WHERE r.deleted_at IS NULL 
            ORDER BY r.boarding_house_id ASC, r.room_number ASC");

        View::render('housing/Views/availabilitytracking', [
            'title' => 'Real-Time Bed Space & Room Availability',
            'slug'  => 'housing',
            'user'  => $user,
            'rooms' => $rooms
        ]);
    }

    public function roomassignment(): void
    {
        $user = Auth::user();

        $assignments = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number, r.room_type, r.capacity, r.occupied_beds 
            FROM `hsg_tenants` t 
            INNER JOIN `hsg_rooms` r ON t.room_id = r.id 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            WHERE t.status = 'Active' AND t.deleted_at IS NULL 
            ORDER BY b.name ASC, r.room_number ASC");

        $boardingHouses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");
        $rooms = Database::fetchAll("SELECT id, room_number, boarding_house_id FROM `hsg_rooms` WHERE deleted_at IS NULL ORDER BY room_number ASC");

        View::render('housing/Views/roomassignment', [
            'title'          => 'Student Room & Bed Assignment Matrix',
            'slug'           => 'housing',
            'user'           => $user,
            'assignments'    => $assignments,
            'boardingHouses' => $boardingHouses,
            'rooms'          => $rooms
        ]);
    }

    public function roomassignments(): void
    {
        $this->roomassignment();
    }

    public function occupancymonitoring(): void
    {
        $user = Auth::user();

        $houses = Database::fetchAll("SELECT b.*, 
            COUNT(r.id) as registered_rooms, 
            COALESCE(SUM(r.capacity), 0) as total_beds, 
            COALESCE(SUM(r.occupied_beds), 0) as filled_beds 
            FROM `hsg_boarding_houses` b 
            LEFT JOIN `hsg_rooms` r ON b.id = r.boarding_house_id AND r.deleted_at IS NULL 
            WHERE b.deleted_at IS NULL 
            GROUP BY b.id");

        View::render('housing/Views/occupancymonitoring', [
            'title'  => 'Boarding House Occupancy Monitoring',
            'slug'   => 'housing',
            'user'   => $user,
            'houses' => $houses
        ]);
    }

    public function bedallocation(): void
    {
        $user = Auth::user();

        $rooms = Database::fetchAll("SELECT r.*, b.name as house_name 
            FROM `hsg_rooms` r 
            LEFT JOIN `hsg_boarding_houses` b ON r.boarding_house_id = b.id 
            WHERE r.deleted_at IS NULL");

        $tenants = Database::fetchAll("SELECT * FROM `hsg_tenants` WHERE status = 'Active' AND deleted_at IS NULL");

        View::render('housing/Views/bedallocation', [
            'title'   => 'Bed Space Allocation & Slots',
            'slug'    => 'housing',
            'user'    => $user,
            'rooms'   => $rooms,
            'tenants' => $tenants
        ]);
    }

    public function rooms(): void
    {
        $this->roomandinventory();
    }

    /* -------------------------------------------------------------
     * 3. Reservation & Application
     * ------------------------------------------------------------- */

    public function housingapplication(): void
    {
        $user = Auth::user();

        $applications = Database::fetchAll("SELECT * FROM `hsg_applications` WHERE deleted_at IS NULL ORDER BY id DESC");
        $houses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/housingapplication', [
            'title'        => 'Housing & Dormitory Applications',
            'slug'         => 'housing',
            'user'         => $user,
            'applications' => $applications,
            'houses'       => $houses
        ]);
    }

    public function housingapplications(): void
    {
        $this->housingapplication();
    }

    public function storeApplication(): void
    {
        $studentNo = trim($_POST['student_no'] ?? '');
        $fullName  = trim($_POST['full_name'] ?? '');

        if (empty($studentNo) || empty($fullName)) {
            redirect(url('housing/housingapplication'), 'error', 'Student number and full name are required.');
        }

        Database::insert('hsg_applications', [
            'student_no'          => $studentNo,
            'full_name'           => $fullName,
            'gender'              => $_POST['gender'] ?? 'Female',
            'college'             => trim($_POST['college'] ?? 'CICS'),
            'program'             => trim($_POST['program'] ?? 'BS Information Technology'),
            'year_level'          => trim($_POST['year_level'] ?? '1st Year'),
            'preferred_house'     => trim($_POST['preferred_house'] ?? 'Villa Marinduque Student Dormitory'),
            'preferred_room_type' => $_POST['preferred_room_type'] ?? 'Double',
            'target_move_in'      => !empty($_POST['target_move_in']) ? $_POST['target_move_in'] : date('Y-m-d', strtotime('+3 days')),
            'monthly_budget'      => (float)($_POST['monthly_budget'] ?? 1500.00),
            'guardian_name'       => trim($_POST['guardian_name'] ?? ''),
            'guardian_contact'    => trim($_POST['guardian_contact'] ?? ''),
            'status'              => 'Pending Review',
            'remarks'             => trim($_POST['remarks'] ?? 'Application submitted online.'),
            'created_at'          => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/housingapplication'), 'success', "Housing application for {$fullName} ({$studentNo}) submitted successfully!");
    }

    public function updateApplicationStatus(): void
    {
        $id     = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');

        if ($id > 0 && in_array($status, ['Approved', 'Rejected', 'Waitlisted', 'Allocated', 'Pending Review'], true)) {
            Database::update('hsg_applications', [
                'status'     => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            redirect(url('housing/approvalworkflow'), 'success', "Application status changed to {$status}.");
        }

        redirect(url('housing/approvalworkflow'), 'error', 'Invalid status update request.');
    }

    public function approvalworkflow(): void
    {
        $user = Auth::user();

        $pending = Database::fetchAll("SELECT * FROM `hsg_applications` WHERE status = 'Pending Review' ORDER BY id ASC");
        $processed = Database::fetchAll("SELECT * FROM `hsg_applications` WHERE status != 'Pending Review' ORDER BY updated_at DESC LIMIT 20");

        View::render('housing/Views/approvalworkflow', [
            'title'     => 'Housing Application Approval Workflow',
            'slug'      => 'housing',
            'user'      => $user,
            'pending'   => $pending,
            'processed' => $processed
        ]);
    }

    public function reservationmanagement(): void
    {
        $user = Auth::user();

        $reservations = Database::fetchAll("SELECT * FROM `hsg_applications` WHERE status IN ('Approved', 'Allocated') ORDER BY target_move_in ASC");

        View::render('housing/Views/reservationmanagement', [
            'title'        => 'Slot & Room Reservation Management',
            'slug'         => 'housing',
            'user'         => $user,
            'reservations' => $reservations
        ]);
    }

    public function waitinglist(): void
    {
        $user = Auth::user();

        $waitlist = Database::fetchAll("SELECT * FROM `hsg_applications` WHERE status = 'Waitlisted' ORDER BY id ASC");

        View::render('housing/Views/waitinglist', [
            'title'    => 'Student Housing Priority Waiting List',
            'slug'     => 'housing',
            'user'     => $user,
            'waitlist' => $waitlist
        ]);
    }

    /* -------------------------------------------------------------
     * 4. Payment & Billing
     * ------------------------------------------------------------- */

    public function boardingfees(): void
    {
        $user = Auth::user();

        $tenants = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number 
            FROM `hsg_tenants` t 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            LEFT JOIN `hsg_rooms` r ON t.room_id = r.id 
            WHERE t.status = 'Active' AND t.deleted_at IS NULL");

        View::render('housing/Views/boardingfees', [
            'title'   => 'Monthly Boarding & Accommodation Fees',
            'slug'    => 'housing',
            'user'    => $user,
            'tenants' => $tenants
        ]);
    }

    public function paymentrecords(): void
    {
        $user = Auth::user();

        $payments = Database::fetchAll("SELECT p.*, b.name as house_name 
            FROM `hsg_payments` p 
            LEFT JOIN `hsg_boarding_houses` b ON p.boarding_house_id = b.id 
            ORDER BY p.id DESC");

        $tenants = Database::fetchAll("SELECT id, student_no, first_name, last_name, boarding_house_id, monthly_rent FROM `hsg_tenants` WHERE status = 'Active'");
        $houses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/paymentrecords', [
            'title'    => 'Official Payment Receipts & Billing Ledger',
            'slug'     => 'housing',
            'user'     => $user,
            'payments' => $payments,
            'tenants'  => $tenants,
            'houses'   => $houses
        ]);
    }

    public function storePayment(): void
    {
        $studentNo   = trim($_POST['student_no'] ?? '');
        $studentName = trim($_POST['student_name'] ?? '');
        $amount      = (float)($_POST['amount'] ?? 0.00);

        if (empty($studentNo) || $amount <= 0) {
            redirect(url('housing/paymentrecords'), 'error', 'Student number and a valid payment amount are required.');
        }

        $orNumber = trim($_POST['or_number'] ?? '');
        if (empty($orNumber)) {
            $orNumber = 'OR-' . date('Y') . '-' . str_pad((string)rand(100, 9999), 5, '0', STR_PAD_LEFT);
        }

        $houseId = !empty($_POST['boarding_house_id']) ? (int)$_POST['boarding_house_id'] : null;

        Database::insert('hsg_payments', [
            'tenant_id'         => !empty($_POST['tenant_id']) ? (int)$_POST['tenant_id'] : null,
            'student_no'        => $studentNo,
            'student_name'      => $studentName,
            'boarding_house_id' => $houseId,
            'or_number'         => $orNumber,
            'payment_type'      => $_POST['payment_type'] ?? 'Monthly Rent',
            'amount'            => $amount,
            'payment_method'    => $_POST['payment_method'] ?? 'Cash',
            'payment_date'      => !empty($_POST['payment_date']) ? $_POST['payment_date'] : date('Y-m-d'),
            'period_covered'    => trim($_POST['period_covered'] ?? date('F Y')),
            'status'            => 'Verified',
            'remarks'           => trim($_POST['remarks'] ?? 'Payment verified at cashier/housing office'),
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        // Reduce tenant balance if tenant exists
        if (!empty($_POST['tenant_id'])) {
            Database::query("UPDATE `hsg_tenants` SET balance = GREATEST(0, balance - :amt) WHERE id = :id", [
                'amt' => $amount,
                'id'  => (int)$_POST['tenant_id']
            ]);
        }

        redirect(url('housing/paymentrecords'), 'success', "Payment receipt {$orNumber} for ₱" . number_format($amount, 2) . " recorded successfully!");
    }

    public function balancemonitoring(): void
    {
        $user = Auth::user();

        $debtors = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number 
            FROM `hsg_tenants` t 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            LEFT JOIN `hsg_rooms` r ON t.room_id = r.id 
            WHERE t.balance > 0 AND t.status = 'Active' 
            ORDER BY t.balance DESC");

        View::render('housing/Views/balancemonitoring', [
            'title'   => 'Outstanding Balance & Accounts Receivable',
            'slug'    => 'housing',
            'user'    => $user,
            'debtors' => $debtors
        ]);
    }

    public function receiptgeneration(): void
    {
        $user = Auth::user();

        $receipts = Database::fetchAll("SELECT p.*, b.name as house_name, b.address as house_address 
            FROM `hsg_payments` p 
            LEFT JOIN `hsg_boarding_houses` b ON p.boarding_house_id = b.id 
            ORDER BY p.id DESC");

        View::render('housing/Views/receiptgeneration', [
            'title'    => 'Official Electronic Receipts (e-OR)',
            'slug'     => 'housing',
            'user'     => $user,
            'receipts' => $receipts
        ]);
    }

    /* -------------------------------------------------------------
     * 5. Maintenance & Facilities
     * ------------------------------------------------------------- */

    public function maintenancerequest(): void
    {
        $user = Auth::user();

        $tickets = Database::fetchAll("SELECT m.*, b.name as house_name 
            FROM `hsg_maintenance` m 
            LEFT JOIN `hsg_boarding_houses` b ON m.boarding_house_id = b.id 
            ORDER BY m.id DESC");

        $houses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/maintenancerequest', [
            'title'   => 'Facility Maintenance Work Orders',
            'slug'    => 'housing',
            'user'    => $user,
            'tickets' => $tickets,
            'houses'  => $houses
        ]);
    }

    public function maintenancerequests(): void
    {
        $this->maintenancerequest();
    }

    public function storeMaintenance(): void
    {
        $issueTitle = trim($_POST['issue_title'] ?? '');
        $reportedBy = trim($_POST['reported_by'] ?? '');

        if (empty($issueTitle) || empty($reportedBy)) {
            redirect(url('housing/maintenancerequest'), 'error', 'Issue title and reporter name are required.');
        }

        $ticketNo = 'MNT-' . date('Y') . '-' . rand(100, 999);
        $houseId  = !empty($_POST['boarding_house_id']) ? (int)$_POST['boarding_house_id'] : null;

        Database::insert('hsg_maintenance', [
            'ticket_number'     => $ticketNo,
            'boarding_house_id' => $houseId,
            'room_number'       => trim($_POST['room_number'] ?? 'Common Area'),
            'reported_by'       => $reportedBy,
            'issue_category'    => $_POST['issue_category'] ?? 'Plumbing',
            'issue_title'       => $issueTitle,
            'description'       => trim($_POST['description'] ?? 'Facility issue reported by resident.'),
            'priority'          => $_POST['priority'] ?? 'Medium',
            'status'            => 'Open',
            'assigned_staff'    => 'Pending Assignment',
            'estimated_cost'    => (float)($_POST['estimated_cost'] ?? 0.00),
            'reported_at'       => date('Y-m-d H:i:s'),
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/maintenancerequest'), 'success', "Maintenance ticket {$ticketNo} logged successfully!");
    }

    public function updateMaintenanceStatus(): void
    {
        $id     = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');

        if ($id > 0 && in_array($status, ['Open', 'In Progress', 'Under Review', 'Resolved', 'Cancelled'], true)) {
            $data = [
                'status'     => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if (!empty($_POST['assigned_staff'])) {
                $data['assigned_staff'] = trim($_POST['assigned_staff']);
            }
            if (!empty($_POST['resolution_notes'])) {
                $data['resolution_notes'] = trim($_POST['resolution_notes']);
            }
            if ($status === 'Resolved') {
                $data['resolved_at'] = date('Y-m-d H:i:s');
            }

            Database::update('hsg_maintenance', $data, 'id = :id', ['id' => $id]);
            redirect(url('housing/repairmonitoring'), 'success', "Ticket status updated to {$status}.");
        }

        redirect(url('housing/repairmonitoring'), 'error', 'Invalid status update request.');
    }

    public function repairmonitoring(): void
    {
        $user = Auth::user();

        $repairs = Database::fetchAll("SELECT m.*, b.name as house_name 
            FROM `hsg_maintenance` m 
            LEFT JOIN `hsg_boarding_houses` b ON m.boarding_house_id = b.id 
            ORDER BY FIELD(m.status, 'In Progress', 'Open', 'Under Review', 'Resolved', 'Cancelled'), m.id DESC");

        View::render('housing/Views/repairmonitoring', [
            'title'   => 'Repair Execution & Contractor Monitoring',
            'slug'    => 'housing',
            'user'    => $user,
            'repairs' => $repairs
        ]);
    }

    public function conditionreports(): void
    {
        $user = Auth::user();

        $houses = Database::fetchAll("SELECT * FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/conditionreports', [
            'title'  => 'Safety & Sanitary Inspection Condition Reports',
            'slug'   => 'housing',
            'user'   => $user,
            'houses' => $houses
        ]);
    }

    public function servicehistory(): void
    {
        $user = Auth::user();

        $completedTickets = Database::fetchAll("SELECT m.*, b.name as house_name 
            FROM `hsg_maintenance` m 
            LEFT JOIN `hsg_boarding_houses` b ON m.boarding_house_id = b.id 
            WHERE m.status = 'Resolved' 
            ORDER BY m.resolved_at DESC");

        View::render('housing/Views/servicehistory', [
            'title'            => 'Historical Facility Service Records',
            'slug'             => 'housing',
            'user'             => $user,
            'completedTickets' => $completedTickets
        ]);
    }

    /* -------------------------------------------------------------
     * 6. Communication & Incidents
     * ------------------------------------------------------------- */

    public function announcements(): void
    {
        $user = Auth::user();

        $announcements = Database::fetchAll("SELECT * FROM `hsg_announcements` ORDER BY pinned DESC, id DESC");

        View::render('housing/Views/announcements', [
            'title'         => 'Housing Bulletins & Announcements',
            'slug'          => 'housing',
            'user'          => $user,
            'announcements' => $announcements
        ]);
    }

    public function storeAnnouncement(): void
    {
        $title   = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if (empty($title) || empty($content)) {
            redirect(url('housing/announcements'), 'error', 'Title and announcement content are required.');
        }

        Database::insert('hsg_announcements', [
            'title'           => $title,
            'category'        => $_POST['category'] ?? 'General Notice',
            'priority'        => $_POST['priority'] ?? 'Normal',
            'content'         => $content,
            'target_audience' => trim($_POST['target_audience'] ?? 'All Residents'),
            'published_by'    => Auth::user()['first_name'] ?? 'Housing Admin',
            'status'          => 'Published',
            'pinned'          => !empty($_POST['pinned']) ? 1 : 0,
            'created_at'      => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/announcements'), 'success', 'Announcement published successfully!');
    }

    public function deleteAnnouncement(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Database::delete('hsg_announcements', 'id = :id', ['id' => $id]);
            redirect(url('housing/announcements'), 'success', 'Announcement deleted successfully.');
        }
        redirect(url('housing/announcements'), 'error', 'Invalid announcement record.');
    }

    public function residentsnotifications(): void
    {
        $user = Auth::user();

        $notifications = Database::fetchAll("SELECT * FROM `hsg_announcements` WHERE status = 'Published' ORDER BY id DESC LIMIT 10");

        View::render('housing/Views/residentsnotifications', [
            'title'         => 'Resident Alerts & Notification Dispatch',
            'slug'          => 'housing',
            'user'          => $user,
            'notifications' => $notifications
        ]);
    }

    public function rulesandpolicies(): void
    {
        $user = Auth::user();

        View::render('housing/Views/rulesandpolicies', [
            'title' => 'Accredited Housing Rules, Curfew & Standards',
            'slug'  => 'housing',
            'user'  => $user
        ]);
    }

    public function incidentreporting(): void
    {
        $user = Auth::user();

        $incidents = Database::fetchAll("SELECT * FROM `hsg_incidents` ORDER BY id DESC");

        View::render('housing/Views/incidentreporting', [
            'title'     => 'Security & Disciplinary Incident Logs',
            'slug'      => 'housing',
            'user'      => $user,
            'incidents' => $incidents
        ]);
    }

    public function storeIncident(): void
    {
        $location = trim($_POST['location'] ?? '');
        $narrative = trim($_POST['narrative'] ?? '');

        if (empty($location) || empty($narrative)) {
            redirect(url('housing/incidentreporting'), 'error', 'Incident location and narrative are required.');
        }

        $incidentNo = 'INC-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT);

        Database::insert('hsg_incidents', [
            'incident_no'      => $incidentNo,
            'incident_type'    => $_POST['incident_type'] ?? 'Curfew Violation',
            'location'         => $location,
            'incident_date'    => !empty($_POST['incident_date']) ? $_POST['incident_date'] : date('Y-m-d'),
            'incident_time'    => !empty($_POST['incident_time']) ? $_POST['incident_time'] : date('H:i:s'),
            'parties_involved' => trim($_POST['parties_involved'] ?? 'Unidentified'),
            'narrative'        => $narrative,
            'severity'         => $_POST['severity'] ?? 'Minor',
            'status'           => 'Under Investigation',
            'reported_by'      => trim($_POST['reported_by'] ?? (Auth::user()['first_name'] ?? 'Staff')),
            'action_taken'     => trim($_POST['action_taken'] ?? 'Report logged for review.'),
            'created_at'       => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/incidentreporting'), 'success', "Incident log {$incidentNo} filed securely.");
    }

    public function updateIncidentStatus(): void
    {
        $id     = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');

        if ($id > 0 && in_array($status, ['Under Investigation', 'Resolved', 'Referred to OSAS', 'Warning Issued'], true)) {
            Database::update('hsg_incidents', [
                'status'       => $status,
                'action_taken' => trim($_POST['action_taken'] ?? 'Updated'),
                'updated_at'   => date('Y-m-d H:i:s')
            ], 'id = :id', ['id' => $id]);
            redirect(url('housing/incidentreporting'), 'success', "Incident status updated to {$status}.");
        }

        redirect(url('housing/incidentreporting'), 'error', 'Invalid status update.');
    }

    /* -------------------------------------------------------------
     * 7. Reports & Analytics
     * ------------------------------------------------------------- */

    public function occupancyreports(): void
    {
        $user = Auth::user();

        $houses = Database::fetchAll("SELECT b.*, 
            COUNT(r.id) as total_rooms, 
            COALESCE(SUM(r.capacity), 0) as total_capacity, 
            COALESCE(SUM(r.occupied_beds), 0) as occupied_beds 
            FROM `hsg_boarding_houses` b 
            LEFT JOIN `hsg_rooms` r ON b.id = r.boarding_house_id AND r.deleted_at IS NULL 
            WHERE b.deleted_at IS NULL 
            GROUP BY b.id");

        View::render('housing/Views/occupancyreports', [
            'title'  => 'Accredited Housing Occupancy Telemetry',
            'slug'   => 'housing',
            'user'   => $user,
            'houses' => $houses
        ]);
    }

    public function revenuereports(): void
    {
        $user = Auth::user();

        $monthlyRevenue = Database::fetchAll("SELECT period_covered, COUNT(*) as transactions, SUM(amount) as total_amount 
            FROM `hsg_payments` 
            WHERE status = 'Verified' 
            GROUP BY period_covered 
            ORDER BY id DESC");

        View::render('housing/Views/revenuereports', [
            'title'          => 'Boarding House Revenue & Financial Analytics',
            'slug'           => 'housing',
            'user'           => $user,
            'monthlyRevenue' => $monthlyRevenue
        ]);
    }

    public function residentstatistics(): void
    {
        $user = Auth::user();

        $byCollege = Database::fetchAll("SELECT college, COUNT(*) as count FROM `hsg_tenants` WHERE status = 'Active' GROUP BY college");
        $byGender  = Database::fetchAll("SELECT gender, COUNT(*) as count FROM `hsg_tenants` WHERE status = 'Active' GROUP BY gender");
        $byYear    = Database::fetchAll("SELECT year_level, COUNT(*) as count FROM `hsg_tenants` WHERE status = 'Active' GROUP BY year_level");

        View::render('housing/Views/residentstatistics', [
            'title'     => 'Demographic & Academic Profile of Residents',
            'slug'      => 'housing',
            'user'      => $user,
            'byCollege' => $byCollege,
            'byGender'  => $byGender,
            'byYear'    => $byYear
        ]);
    }

    public function facilityutilization(): void
    {
        $user = Auth::user();

        $byType = Database::fetchAll("SELECT room_type, COUNT(*) as room_count, SUM(capacity) as total_beds, SUM(occupied_beds) as filled_beds 
            FROM `hsg_rooms` 
            WHERE deleted_at IS NULL 
            GROUP BY room_type");

        View::render('housing/Views/facilityutilization', [
            'title'  => 'Physical Facility Utilization Metrics',
            'slug'   => 'housing',
            'user'   => $user,
            'byType' => $byType
        ]);
    }

    public function facilityutilizations(): void
    {
        $this->facilityutilization();
    }

    public function reports(): void
    {
        $this->occupancyreports();
    }

    public function accreditation(): void
    {
        $this->index();
    }
}

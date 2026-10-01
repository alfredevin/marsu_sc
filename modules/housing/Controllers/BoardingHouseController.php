<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

class BoardingHouseController {
    public function index(): void {
        $user = Auth::user();
        $search = trim($_GET['q'] ?? '');
        $barangay = trim($_GET['barangay'] ?? '');
        $gender = trim($_GET['gender'] ?? '');
        $status = trim($_GET['status'] ?? '');

        $sql = "SELECT bh.*, 
                (SELECT COUNT(*) FROM hsg_rooms r WHERE r.boarding_house_id = bh.id AND r.deleted_at IS NULL) as room_count,
                (SELECT SUM(vacant_beds) FROM hsg_rooms r WHERE r.boarding_house_id = bh.id AND r.deleted_at IS NULL) as vacant_beds_total
                FROM `hsg_boarding_houses` bh 
                WHERE bh.deleted_at IS NULL";
        $params = [];

        if ($search !== '') {
            $sql .= " AND (bh.name LIKE :search OR bh.code LIKE :search OR bh.landlord_name LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        if ($barangay !== '') {
            $sql .= " AND bh.barangay = :barangay";
            $params['barangay'] = $barangay;
        }
        if ($gender !== '') {
            $sql .= " AND bh.gender_type = :gender";
            $params['gender'] = $gender;
        }
        if ($status !== '') {
            $sql .= " AND bh.accreditation_status = :status";
            $params['status'] = $status;
        }

        $sql .= " ORDER BY bh.accreditation_status ASC, bh.safety_rating DESC, bh.id DESC";
        $houses = Database::fetchAll($sql, $params);

        // Fetch distinct Santa Cruz barangays
        $barangays = Database::fetchAll("SELECT DISTINCT barangay FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY barangay ASC");

        View::render('housing/Views/boarding_houses', [
            'title'       => 'Accredited Boarding Houses Directory - ISHAMIS',
            'houses'      => $houses,
            'barangays'   => array_column($barangays, 'barangay'),
            'search'      => $search,
            'barangay'    => $barangay,
            'gender'      => $gender,
            'status'      => $status,
            'user'        => $user,
            'crumbs'      => [
                'ISHAMIS' => url('housing'),
                'Accredited Boarding Houses' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $house = Database::fetchOne("SELECT * FROM `hsg_boarding_houses` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);

        if (!$house) {
            Session::flash('error', 'Boarding house record not found.');
            redirect(url('housing/boarding-houses'));
        }

        // Fetch rooms for this house
        $rooms = Database::fetchAll("SELECT * FROM `hsg_rooms` WHERE boarding_house_id = :id AND deleted_at IS NULL ORDER BY room_number ASC", ['id' => $id]);

        // Fetch current student occupants
        $occupants = Database::fetchAll("
            SELECT a.*, s.student_number, s.first_name, s.last_name, s.email, r.room_number 
            FROM `hsg_accommodations` a 
            JOIN `students` s ON a.student_id = s.id 
            JOIN `hsg_rooms` r ON a.room_id = r.id 
            WHERE a.boarding_house_id = :id AND a.status = 'active' AND a.deleted_at IS NULL
        ", ['id' => $id]);

        // Fetch inspections
        $inspections = Database::fetchAll("SELECT * FROM `hsg_inspections` WHERE boarding_house_id = :id AND deleted_at IS NULL ORDER BY inspection_date DESC", ['id' => $id]);

        View::render('housing/Views/boarding_house_view', [
            'title'       => e($house['name']) . ' - ISHAMIS Accreditation Profile',
            'house'       => $house,
            'rooms'       => $rooms,
            'occupants'   => $occupants,
            'inspections' => $inspections,
            'crumbs'      => [
                'ISHAMIS' => url('housing'),
                'Boarding Houses' => url('housing/boarding-houses'),
                $house['name'] => ''
            ]
        ]);
    }

    public function store(): void {
        $name = trim($_POST['name'] ?? '');
        $landlord = trim($_POST['landlord_name'] ?? '');
        $contact = trim($_POST['landlord_contact'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $barangay = trim($_POST['barangay'] ?? 'Santa Cruz');
        $gender = in_array($_POST['gender_type'] ?? '', ['coed', 'male_only', 'female_only']) ? $_POST['gender_type'] : 'coed';
        $rooms = max(1, (int)($_POST['total_rooms'] ?? 1));
        $capacity = max(1, (int)($_POST['total_bed_capacity'] ?? 4));
        $rateMin = (float)($_POST['monthly_rate_min'] ?? 1500);
        $rateMax = (float)($_POST['monthly_rate_max'] ?? 3000);
        $curfew = trim($_POST['curfew_time'] ?? '10:00 PM');
        $amenities = trim($_POST['amenities'] ?? '');
        $status = in_array($_POST['accreditation_status'] ?? '', ['accredited', 'pending', 'probationary', 'expired']) ? $_POST['accreditation_status'] : 'pending';

        if (!$name || !$landlord || !$contact || !$address) {
            Session::flash('error', 'Please fill in all required boarding house details.');
            redirect(url('housing/boarding-houses'));
        }

        $code = 'HSG-BH-' . str_pad((string)mt_rand(10, 999), 3, '0', STR_PAD_LEFT);
        $userId = Auth::user()['id'] ?? null;

        Database::insert('hsg_boarding_houses', [
            'code'                 => $code,
            'name'                 => $name,
            'landlord_name'        => $landlord,
            'landlord_contact'     => $contact,
            'landlord_email'       => trim($_POST['landlord_email'] ?? ''),
            'address'              => $address,
            'barangay'             => $barangay,
            'distance_campus'      => trim($_POST['distance_campus'] ?? ''),
            'gender_type'          => $gender,
            'total_rooms'          => $rooms,
            'total_bed_capacity'   => $capacity,
            'monthly_rate_min'     => $rateMin,
            'monthly_rate_max'     => $rateMax,
            'curfew_time'          => $curfew,
            'amenities'            => $amenities,
            'accreditation_status' => $status,
            'safety_rating'        => 4.5,
            'remarks'              => trim($_POST['remarks'] ?? ''),
            'created_by'           => $userId,
            'created_at'           => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', "Boarding House [{$name}] successfully registered under code {$code}!");
        redirect(url('housing/boarding-houses'));
    }
}

<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

class RoomController {
    public function index(): void {
        $user = Auth::user();
        $houseFilter = (int)($_GET['house_id'] ?? 0);
        $typeFilter = trim($_GET['room_type'] ?? '');
        $statusFilter = trim($_GET['status'] ?? '');

        $sql = "
            SELECT r.*, bh.name as house_name, bh.code as house_code, bh.address as house_address, bh.barangay 
            FROM `hsg_rooms` r 
            JOIN `hsg_boarding_houses` bh ON r.boarding_house_id = bh.id 
            WHERE r.deleted_at IS NULL
        ";
        $params = [];

        if ($houseFilter > 0) {
            $sql .= " AND r.boarding_house_id = :house_id";
            $params['house_id'] = $houseFilter;
        }
        if ($typeFilter !== '') {
            $sql .= " AND r.room_type = :room_type";
            $params['room_type'] = $typeFilter;
        }
        if ($statusFilter !== '') {
            $sql .= " AND r.status = :status";
            $params['status'] = $statusFilter;
        }

        $sql .= " ORDER BY r.status ASC, r.vacant_beds DESC, r.id DESC";
        $rooms = Database::fetchAll($sql, $params);

        // Fetch houses for dropdown
        $houses = Database::fetchAll("SELECT id, name, code FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/rooms', [
            'title'        => 'Room & Bed Vacancies Directory - ISHAMIS',
            'rooms'        => $rooms,
            'houses'       => $houses,
            'houseFilter'  => $houseFilter,
            'typeFilter'   => $typeFilter,
            'statusFilter' => $statusFilter,
            'user'         => $user,
            'crumbs'       => [
                'ISHAMIS' => url('housing'),
                'Room & Bed Vacancies' => ''
            ]
        ]);
    }

    public function store(): void {
        $houseId = (int)($_POST['boarding_house_id'] ?? 0);
        $roomNumber = trim($_POST['room_number'] ?? '');
        $roomType = in_array($_POST['room_type'] ?? '', ['solo', 'shared_2', 'shared_4', 'bedspace']) ? $_POST['room_type'] : 'shared_2';
        $beds = max(1, (int)($_POST['capacity_beds'] ?? 2));
        $rate = (float)($_POST['rate_per_month'] ?? 2000);
        $hasAircon = !empty($_POST['has_aircon']) ? 1 : 0;
        $hasCr = !empty($_POST['has_private_cr']) ? 1 : 0;

        if ($houseId <= 0 || !$roomNumber) {
            Session::flash('error', 'Please specify the boarding house and room number.');
            redirect(url('housing/rooms'));
        }

        Database::insert('hsg_rooms', [
            'boarding_house_id' => $houseId,
            'room_number'       => $roomNumber,
            'room_type'         => $roomType,
            'capacity_beds'     => $beds,
            'occupied_beds'     => 0,
            'vacant_beds'       => $beds,
            'rate_per_month'    => $rate,
            'has_aircon'        => $hasAircon,
            'has_private_cr'    => $hasCr,
            'has_study_desk'    => 1,
            'status'            => 'available',
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', "Room [{$roomNumber}] added successfully!");
        redirect(url('housing/rooms'));
    }
}

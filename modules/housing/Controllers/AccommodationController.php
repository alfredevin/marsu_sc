<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

class AccommodationController {
    public function index(): void {
        $user = Auth::user();
        $search = trim($_GET['q'] ?? '');
        $status = trim($_GET['status'] ?? '');

        $sql = "
            SELECT a.*, s.student_number, s.first_name, s.last_name, s.email, s.gender,
                   bh.name as house_name, bh.code as house_code, bh.landlord_name, bh.landlord_contact,
                   r.room_number, r.room_type, r.rate_per_month
            FROM `hsg_accommodations` a
            JOIN `students` s ON a.student_id = s.id
            JOIN `hsg_boarding_houses` bh ON a.boarding_house_id = bh.id
            JOIN `hsg_rooms` r ON a.room_id = r.id
            WHERE a.deleted_at IS NULL
        ";
        $params = [];

        if ($search !== '') {
            $sql .= " AND (s.student_number LIKE :search OR s.first_name LIKE :search OR s.last_name LIKE :search OR bh.name LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        if ($status !== '') {
            $sql .= " AND a.status = :status";
            $params['status'] = $status;
        }

        $sql .= " ORDER BY a.id DESC";
        $accommodations = Database::fetchAll($sql, $params);

        // Fetch students and available rooms for booking modal
        $students = Database::fetchAll("SELECT id, student_number, first_name, last_name FROM students ORDER BY last_name ASC LIMIT 100");
        $availableRooms = Database::fetchAll("
            SELECT r.id, r.room_number, r.rate_per_month, r.vacant_beds, bh.id as house_id, bh.name as house_name 
            FROM hsg_rooms r 
            JOIN hsg_boarding_houses bh ON r.boarding_house_id = bh.id 
            WHERE r.status = 'available' AND r.vacant_beds > 0 AND r.deleted_at IS NULL
            ORDER BY bh.name ASC, r.room_number ASC
        ");

        View::render('housing/Views/accommodations', [
            'title'          => 'Student Residents & Accommodations - ISHAMIS',
            'accommodations' => $accommodations,
            'students'       => $students,
            'availableRooms' => $availableRooms,
            'search'         => $search,
            'status'         => $status,
            'user'           => $user,
            'crumbs'         => [
                'ISHAMIS' => url('housing'),
                'Student Residents' => ''
            ]
        ]);
    }

    public function store(): void {
        $studentId = (int)($_POST['student_id'] ?? 0);
        $roomId = (int)($_POST['room_id'] ?? 0);
        $startDate = trim($_POST['start_date'] ?? date('Y-m-d'));
        $guardian = trim($_POST['guardian_contact'] ?? '');

        if ($studentId <= 0 || $roomId <= 0) {
            Session::flash('error', 'Please select both an enrolled student and an available room.');
            redirect(url('housing/accommodations'));
        }

        $room = Database::fetchOne("SELECT * FROM hsg_rooms WHERE id = :id AND deleted_at IS NULL", ['id' => $roomId]);
        if (!$room || $room['vacant_beds'] <= 0) {
            Session::flash('error', 'Selected room has no available bed vacancies.');
            redirect(url('housing/accommodations'));
        }

        // Check if student already has active housing
        $active = Database::fetchOne("SELECT id FROM hsg_accommodations WHERE student_id = :sid AND status = 'active' AND deleted_at IS NULL", ['sid' => $studentId]);
        if ($active) {
            Session::flash('error', 'Student is already registered in an active accommodation.');
            redirect(url('housing/accommodations'));
        }

        // Insert accommodation
        Database::insert('hsg_accommodations', [
            'boarding_house_id' => $room['boarding_house_id'],
            'room_id'           => $roomId,
            'student_id'        => $studentId,
            'start_date'        => $startDate,
            'agreed_rate'       => $room['rate_per_month'],
            'payment_status'    => 'paid',
            'guardian_contact'  => $guardian,
            'status'            => 'active',
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        // Update room vacant and occupied beds
        $newOccupied = $room['occupied_beds'] + 1;
        $newVacant = max(0, $room['capacity_beds'] - $newOccupied);
        $newStatus = ($newVacant == 0) ? 'full' : 'available';

        Database::update('hsg_rooms', [
            'occupied_beds' => $newOccupied,
            'vacant_beds'   => $newVacant,
            'status'        => $newStatus
        ], 'id = :id', ['id' => $roomId]);

        Session::flash('success', 'Student resident accommodation successfully registered!');
        redirect(url('housing/accommodations'));
    }
}

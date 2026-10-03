<?php

namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Accredited Boarding House Management & Directory
 */
class HomeController
{
    /**
     * Display the Housing page and list all rooms
     */
    public function index(): void
    {
        // Kunin lahat ng rooms mula sa database
        $rooms = Database::fetchAll("SELECT * FROM hsg_rooms WHERE deleted_at IS NULL ORDER BY id DESC");

        View::render('housing::index', [
            'moduleName' => 'Student Housing & Accommodation (ISHAMIS)',
            'slug'       => 'housing',
            'rooms'      => $rooms,
            'crumbs'     => ['Housing' => url('housing'), 'Rooms Directory' => '']
        ]);
    }

    /**
     * Saluhin ang form at i-save ang bagong Room
     */
    public function store(): void
    {
        // 1. Saluhin ang inputs mula sa form
        $roomNumber  = trim($_POST['room_number'] ?? '');
        $capacity    = (int)($_POST['capacity'] ?? 1);
        $monthlyRate = (float)($_POST['monthly_rate'] ?? 0);

        if (!$roomNumber) {
            Session::flash('error', 'Room number is required.');
            redirect(url('housing'));
        }

        // 2. I-save sa database gamit ang Database::insert
        try {
            Database::insert('hsg_rooms', [
                'room_number'  => $roomNumber,
                'capacity'     => $capacity,
                'monthly_rate' => $monthlyRate,
                'status'       => 'available',
                'created_at'   => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', "Room '{$roomNumber}' added successfully!");
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to add room: ' . $e->getMessage());
        }

        // 3. I-refresh pabalik sa housing page
        redirect(url('housing'));
    }
}

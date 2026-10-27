<?php

namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * SAMPLE CONTROLLER PARA SA MGA ESTUDYANTE
 * 
 * Ipinapakita rito ang pinakasimpleng paraan ng:
 * 1. Pag-INSERT ng data mula sa form papuntang MySQL table (`hsg_rooms`)
 * 2. Pag-FETCH ng data mula sa MySQL table para ma-display sa View
 */
class SampleRoomController
{
    /**
     * Isang function lang para sa parehong Display (GET) at Save (POST)!
     */
    public function index(): void
    {
        $user = Auth::user();

        // -------------------------------------------------------------
        // HAKBANG 1: INSERT LOGIC (Kapag may nag-click ng "Save Room" button)
        // -------------------------------------------------------------
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['room_name'])) {
            $roomName = trim($_POST['room_name'] ?? '');
            $price    = (float)($_POST['price'] ?? 0);

            // Validation: Siguraduhing may laman
            if ($roomName === '') {
                Session::flash('error', 'Kailangan ilagay ang Room Name!');
                redirect(url('housing/sample-room'));
            }

            try {
                // I-insert sa table gamit ang MarSU Database::insert helper
                Database::insert('hsg_rooms', [
                    'room_name'  => $roomName,
                    'price'      => $price,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                // Mag-iwan ng success alert message
                Session::flash('success', "Matagumpay na na-save ang {$roomName}!");
            } catch (\Exception $e) {
                // Halimbawa: kung hindi pa nagagawa ang table sa database
                Session::flash('error', 'Error sa pag-save: ' . $e->getMessage());
            }

            // I-refresh / i-redirect pabalik sa page pagkatapos mag-save
            redirect(url('housing/sample-room'));
        }

        // -------------------------------------------------------------
        // HAKBANG 2: FETCH LOGIC (Kukunin lahat ng records mula sa table)
        // -------------------------------------------------------------
        $rooms = [];
        try {
            $rooms = Database::fetchAll("SELECT * FROM `hsg_rooms` WHERE deleted_at IS NULL ORDER BY id DESC");
        } catch (\Exception $e) {
            // Kung wala pa ang table, blank array muna para hindi mag-crash ang page
            $rooms = [];
        }

        // -------------------------------------------------------------
        // HAKBANG 3: RENDER VIEW (Ipadadala ang data sa view template)
        // -------------------------------------------------------------
        View::render('housing/Views/sampleroom', [
            'title'      => 'Sample Room CRUD Demo',
            'moduleName' => 'Housing (ISHAMIS)',
            'slug'       => 'housing',
            'user'       => $user,
            'rooms'      => $rooms, // <-- DITO IPINAPASA ANG NAFETCH NA DATA
            'crumbs'     => [
                'Housing (ISHAMIS)' => url('housing'),
                'Room & Accomodation' => '',
                'Sample Room CRUD' => ''
            ]
        ]);
    }
}

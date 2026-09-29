<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Building;
use App\Models\Room;

class FacilityController {
    public function index(): void {
        $buildings = Building::all();
        $rooms = Room::all();

        View::render('facilities/index', [
            'title'     => 'Buildings & Rooms Registry',
            'buildings' => $buildings,
            'rooms'     => $rooms,
            'crumbs'    => ['Master Data' => '', 'Buildings & Rooms' => '']
        ]);
    }

    public function storeBuilding(): void {
        $validator = Validator::make($_POST, [
            'code' => 'required|max:32|unique:buildings,code',
            'name' => 'required|max:150'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('facilities'));
        }

        $id = Building::create([
            'code'     => strtoupper(trim($_POST['code'])),
            'name'     => trim($_POST['name']),
            'location' => trim($_POST['location'] ?? '')
        ]);

        Logger::audit('building.create', 'buildings', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Building '{$_POST['code']}' added.");
        redirect(url('facilities'));
    }

    public function storeRoom(): void {
        $validator = Validator::make($_POST, [
            'building_id' => 'required|integer',
            'room_number' => 'required|max:32',
            'name'        => 'required|max:150',
            'capacity'    => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('facilities'));
        }

        $id = Room::create([
            'building_id' => (int)$_POST['building_id'],
            'room_number' => trim($_POST['room_number']),
            'name'        => trim($_POST['name']),
            'type'        => $_POST['type'] ?? 'lecture',
            'capacity'    => (int)$_POST['capacity'],
            'status'      => $_POST['status'] ?? 'available'
        ]);

        Logger::audit('room.create', 'rooms', $id, ['room_number' => $_POST['room_number']]);
        Session::flash('success', "Room '{$_POST['room_number']}' added.");
        redirect(url('facilities'));
    }

    public function deleteRoom(): void {
        $id = (int)($_POST['id'] ?? 0);
        Room::softDelete($id);
        Logger::audit('room.delete', 'rooms', $id, []);
        Session::flash('success', "Room archived.");
        redirect(url('facilities'));
    }
}

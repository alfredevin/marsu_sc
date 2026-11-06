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
        $rooms = Database::fetchAll("SELECT id, room_number, boarding_house_id, monthly_rate, room_type, capacity, occupied_beds FROM `hsg_rooms` WHERE deleted_at IS NULL ORDER BY room_number ASC");

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

    public function updateTenant(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            redirect(url('housing/tenants'), 'error', 'Invalid tenant record.');
            return;
        }

        $existing = Database::fetchOne("SELECT * FROM `hsg_tenants` WHERE id = :id", ['id' => $id]);
        if (!$existing) {
            redirect(url('housing/tenants'), 'error', 'Tenant record not found.');
            return;
        }

        $studentNo = trim($_POST['student_no'] ?? '');
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName  = trim($_POST['last_name'] ?? '');

        if (empty($studentNo) || empty($firstName) || empty($lastName)) {
            redirect(url('housing/tenants'), 'error', 'Student number, first name, and last name are required.');
            return;
        }

        $houseId    = !empty($_POST['boarding_house_id']) ? (int)$_POST['boarding_house_id'] : null;
        $roomId     = !empty($_POST['room_id']) ? (int)$_POST['room_id'] : null;
        $status     = trim($_POST['status'] ?? 'Active');
        $oldRoomId  = !empty($existing['room_id']) ? (int)$existing['room_id'] : null;
        $oldStatus  = $existing['status'] ?? 'Active';

        $moveInDate  = !empty($_POST['move_in_date']) ? $_POST['move_in_date'] : $existing['move_in_date'];
        $moveOutDate = !empty($_POST['move_out_date']) ? $_POST['move_out_date'] : null;

        if ($status === 'Checked Out' && empty($moveOutDate)) {
            $moveOutDate = date('Y-m-d');
        } elseif ($status === 'Active') {
            $moveOutDate = null;
        }

        Database::update('hsg_tenants', [
            'student_no'              => $studentNo,
            'first_name'              => $firstName,
            'last_name'               => $lastName,
            'gender'                  => $_POST['gender'] ?? ($existing['gender'] ?? 'Female'),
            'email'                   => trim($_POST['email'] ?? ''),
            'contact_number'          => trim($_POST['contact_number'] ?? ''),
            'college'                 => trim($_POST['college'] ?? ($existing['college'] ?? 'CICS')),
            'program'                 => trim($_POST['program'] ?? ($existing['program'] ?? 'BSIT')),
            'year_level'              => trim($_POST['year_level'] ?? ($existing['year_level'] ?? '1st Year')),
            'boarding_house_id'       => $houseId,
            'room_id'                 => $roomId,
            'bed_number'              => trim($_POST['bed_number'] ?? 'Bed A'),
            'move_in_date'            => $moveInDate,
            'move_out_date'           => $moveOutDate,
            'monthly_rent'            => (float)($_POST['monthly_rent'] ?? ($existing['monthly_rent'] ?? 1500.00)),
            'emergency_contact_name'  => trim($_POST['emergency_contact_name'] ?? ''),
            'emergency_contact_phone' => trim($_POST['emergency_contact_phone'] ?? ''),
            'status'                  => $status,
            'updated_at'              => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $id]);

        // Bed occupancy adjustments if room changed or status changed
        if ($oldStatus === 'Active' && $status === 'Active') {
            if ($oldRoomId !== $roomId) {
                if ($oldRoomId) {
                    Database::query("UPDATE `hsg_rooms` SET occupied_beds = GREATEST(0, occupied_beds - 1) WHERE id = :id", ['id' => $oldRoomId]);
                }
                if ($roomId) {
                    Database::query("UPDATE `hsg_rooms` SET occupied_beds = occupied_beds + 1 WHERE id = :id", ['id' => $roomId]);
                }
            }
        } elseif ($oldStatus === 'Active' && $status !== 'Active') {
            // Became inactive/checked out
            if ($oldRoomId) {
                Database::query("UPDATE `hsg_rooms` SET occupied_beds = GREATEST(0, occupied_beds - 1) WHERE id = :id", ['id' => $oldRoomId]);
            }
        } elseif ($oldStatus !== 'Active' && $status === 'Active') {
            // Reactivated
            if ($roomId) {
                Database::query("UPDATE `hsg_rooms` SET occupied_beds = occupied_beds + 1 WHERE id = :id", ['id' => $roomId]);
            }
        }

        redirect(url('housing/tenants'), 'success', "Tenant {$firstName} {$lastName} updated successfully!");
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

    public function reports(): void {
        $user = Auth::user();
        View::render('housing/Views/reports', [
            'title'       => 'Reports',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }

    public function residencyhistory(): void {
        $user = Auth::user();

        $history = Database::fetchAll("SELECT t.*, b.name as house_name, r.room_number 
            FROM `hsg_tenants` t 
            LEFT JOIN `hsg_boarding_houses` b ON t.boarding_house_id = b.id 
            LEFT JOIN `hsg_rooms` r ON t.room_id = r.id 
            ORDER BY t.move_in_date DESC");

        View::render('housing/Views/residencyhistory', [
            'title'       => 'Student Residency History & Logs',
            'moduleName'  => 'Housing (ISHAMIS)',
            'slug'        => 'housing',
            'user'        => $user,
            'history'     => $history,
            'crumbs'      => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
        ]);
    }

    public function rooms(): void {
        $user = Auth::user();
        $rooms = Database::fetchAll("SELECT r.*, b.name as house_name, b.address as house_address 
            FROM `hsg_rooms` r 
            LEFT JOIN `hsg_boarding_houses` b ON r.boarding_house_id = b.id 
            WHERE r.deleted_at IS NULL 
            ORDER BY r.id ASC");
        $boardingHouses = Database::fetchAll("SELECT id, name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/rooms', [
            'title'          => 'Rooms',
            'moduleName'     => 'Housing (ISHAMIS)',
            'slug'           => 'housing',
            'user'           => $user,
            'rooms'          => $rooms,
            'boardingHouses' => $boardingHouses,
            'crumbs'         => [
                'Housing (ISHAMIS)' => url('housing'),
                'Occupancy & Rooming'  => '',
                'Occupancy Monitoring'  => ''
            ]
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

        // Real photos uploaded by the housing admin, grouped by room id
        $this->ensureRoomPhotosTable();
        $photosByRoom = [];
        $photoRows = Database::fetchAll("SELECT id, room_id, category, caption, file_path, original_name, created_at
            FROM `hsg_room_photos` WHERE deleted_at IS NULL ORDER BY id DESC");
        foreach ($photoRows as $row) {
            $photosByRoom[(int)$row['room_id']][] = [
                'id'       => (int)$row['id'],
                'category' => $row['category'],
                'caption'  => $row['caption'] ?? '',
                'url'      => asset($row['file_path']),
                'name'     => $row['original_name'] ?? '',
                'date'     => date('M d, Y', strtotime($row['created_at'])),
            ];
        }

        View::render('housing/Views/roomandinventory', [
            'title'          => 'Room & Property Inventory',
            'slug'           => 'housing',
            'user'           => $user,
            'rooms'          => $rooms,
            'boardingHouses' => $boardingHouses,
            'stats'          => $stats,
            'photosByRoom'   => $photosByRoom,
            'canManagePhotos' => can('housing.register')
        ]);
    }

    /* -------------------------------------------------------------
     * Room photo gallery (real uploads, stored in public/uploads/housing/rooms)
     * ------------------------------------------------------------- */

    private const PHOTO_CATEGORIES = ['bed', 'study', 'bath', 'plan', 'safety'];
    private const PHOTO_MAX_BYTES  = 5 * 1024 * 1024; // 5 MB per photo
    private const PHOTO_MIME_EXT   = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

    private function ensureRoomPhotosTable(): void
    {
        Database::pdo()->exec("CREATE TABLE IF NOT EXISTS `hsg_room_photos` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `room_id` INT NOT NULL,
            `category` VARCHAR(20) NOT NULL DEFAULT 'bed',
            `caption` VARCHAR(255) NULL,
            `file_path` VARCHAR(255) NOT NULL,
            `original_name` VARCHAR(191) NULL,
            `file_size` INT NULL,
            `uploaded_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `deleted_at` DATETIME NULL,
            INDEX (`room_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function storeRoomPhoto(): void
    {
        $back   = url('housing/roomandinventory');
        $roomId = (int)($_POST['room_id'] ?? 0);
        $cat    = $_POST['category'] ?? 'bed';
        $caption = mb_substr(trim($_POST['caption'] ?? ''), 0, 255);

        $room = $roomId > 0
            ? Database::fetchOne("SELECT id FROM `hsg_rooms` WHERE id = :id AND deleted_at IS NULL", ['id' => $roomId])
            : null;
        if (!$room) {
            redirect($back, 'error', 'Please choose a valid room unit for the photo.');
        }
        if (!in_array($cat, self::PHOTO_CATEGORIES, true)) {
            $cat = 'bed';
        }

        // Normalize $_FILES['photos'] (multiple) into a flat list
        $files = [];
        if (!empty($_FILES['photos']['name'])) {
            $names = (array)$_FILES['photos']['name'];
            foreach ($names as $i => $n) {
                if (($_FILES['photos']['error'][$i] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) { continue; }
                $files[] = [
                    'name'  => $n,
                    'tmp'   => $_FILES['photos']['tmp_name'][$i],
                    'error' => $_FILES['photos']['error'][$i],
                    'size'  => (int)$_FILES['photos']['size'][$i],
                ];
            }
        }
        if (empty($files)) {
            redirect($back, 'error', 'Please select at least one photo to upload (the file may exceed the server upload limit).');
        }
        $files = array_slice($files, 0, 10);

        $this->ensureRoomPhotosTable();
        $dir = dirname(__DIR__, 3) . '/public/uploads/housing/rooms/';
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            redirect($back, 'error', 'Could not create the upload folder on the server.');
        }

        $saved = 0; $problems = [];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        foreach ($files as $f) {
            if ($f['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($f['tmp'])) {
                $problems[] = "{$f['name']}: upload failed";
                continue;
            }
            if ($f['size'] > self::PHOTO_MAX_BYTES) {
                $problems[] = "{$f['name']}: larger than 5 MB";
                continue;
            }
            $mime = $finfo->file($f['tmp']);
            if (!isset(self::PHOTO_MIME_EXT[$mime]) || @getimagesize($f['tmp']) === false) {
                $problems[] = "{$f['name']}: only JPG, PNG or WEBP images are allowed";
                continue;
            }
            $filename = 'room' . $roomId . '_' . bin2hex(random_bytes(8)) . '.' . self::PHOTO_MIME_EXT[$mime];
            if (!move_uploaded_file($f['tmp'], $dir . $filename)) {
                $problems[] = "{$f['name']}: could not be saved";
                continue;
            }
            Database::insert('hsg_room_photos', [
                'room_id'       => $roomId,
                'category'      => $cat,
                'caption'       => $caption !== '' ? $caption : null,
                'file_path'     => 'uploads/housing/rooms/' . $filename,
                'original_name' => mb_substr(basename($f['name']), 0, 191),
                'file_size'     => $f['size'],
                'uploaded_by'   => Auth::id(),
                'created_at'    => date('Y-m-d H:i:s'),
            ]);
            $saved++;
        }

        $target = url('housing/roomandinventory', ['open_room' => $roomId]);
        if ($saved > 0) {
            $msg = "{$saved} photo(s) added to the room gallery.";
            if ($problems) { $msg .= ' Skipped: ' . implode('; ', $problems); }
            redirect($target, 'success', $msg);
        }
        redirect($back, 'error', 'No photo was saved. ' . implode('; ', $problems));
    }

    public function deleteRoomPhoto(): void
    {
        $id    = (int)($_POST['id'] ?? 0);
        $photo = $id > 0 ? Database::fetchOne("SELECT * FROM `hsg_room_photos` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]) : null;
        if (!$photo) {
            redirect(url('housing/roomandinventory'), 'error', 'Photo not found.');
        }
        Database::update('hsg_room_photos', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
        $file = dirname(__DIR__, 3) . '/public/' . $photo['file_path'];
        if (str_starts_with($photo['file_path'], 'uploads/housing/rooms/') && is_file($file)) {
            @unlink($file);
        }
        redirect(url('housing/roomandinventory', ['open_room' => (int)$photo['room_id']]), 'success', 'Photo removed from the room gallery.');
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

    public function storeBoardingHouse(): void
    {
        $name          = trim($_POST['name'] ?? '');
        $ownerName     = trim($_POST['owner_name'] ?? '');
        $contactNumber = trim($_POST['contact_number'] ?? '');

        if (empty($name) || empty($ownerName) || empty($contactNumber)) {
            redirect(url('housing/roomandinventory'), 'error', 'Facility name, owner name, and contact number are required.');
            return;
        }

        $validStatus = ['Accredited', 'Pending', 'Under Inspection', 'Expired', 'Revoked'];
        $status = in_array($_POST['accreditation_status'] ?? '', $validStatus)
            ? $_POST['accreditation_status']
            : 'Pending';

        $validRating = ['A', 'B', 'C'];
        $rating = in_array($_POST['safety_rating'] ?? '', $validRating)
            ? $_POST['safety_rating']
            : 'A';

        $rateMin = max(0, (float)($_POST['monthly_rate_min'] ?? 1200));
        $rateMax = max(0, (float)($_POST['monthly_rate_max'] ?? 2500));
        if ($rateMax < $rateMin) {
            $rateMax = $rateMin;
        }

        Database::insert('hsg_boarding_houses', [
            'name'                 => $name,
            'owner_name'           => $ownerName,
            'contact_number'       => $contactNumber,
            'address'              => trim($_POST['address'] ?? ''),
            'barangay'             => trim($_POST['barangay'] ?? 'Brgy. Santol, Boac'),
            'accreditation_status' => $status,
            'safety_rating'        => $rating,
            'total_rooms'          => max(1, (int)($_POST['total_rooms'] ?? 10)),
            'total_capacity'       => max(1, (int)($_POST['total_capacity'] ?? 30)),
            'current_occupancy'    => 0,
            'monthly_rate_min'     => $rateMin,
            'monthly_rate_max'     => $rateMax,
            'amenities'            => trim($_POST['amenities'] ?? ''),
            'created_at'           => date('Y-m-d H:i:s'),
            'updated_at'           => date('Y-m-d H:i:s'),
        ]);

        redirect(url('housing/roomandinventory'), 'success', "Boarding facility \"{$name}\" has been registered successfully!");
    }

    public function deleteBoardingHouse(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Database::update('hsg_boarding_houses', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
            redirect(url('housing/roomandinventory'), 'success', 'Boarding facility removed from directory.');
            return;
        }
        redirect(url('housing/roomandinventory'), 'error', 'Invalid facility record.');
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

        // Ensure table exists
        Database::pdo()->exec("CREATE TABLE IF NOT EXISTS `hsg_condition_reports` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `audit_ref` VARCHAR(50) NOT NULL UNIQUE,
            `boarding_house_id` INT NULL,
            `facility_name` VARCHAR(191) NOT NULL,
            `room_unit` VARCHAR(50) NOT NULL,
            `inspection_stage` VARCHAR(100) NOT NULL DEFAULT 'Pre-Move-in Intake',
            `inspector_name` VARCHAR(100) NOT NULL,
            `score_rating` VARCHAR(100) NOT NULL DEFAULT '95% Satisfactory',
            `inspection_date` DATE NOT NULL,
            `submeter_electric` VARCHAR(50) DEFAULT '00124.5 kWh',
            `submeter_water` VARCHAR(50) DEFAULT '0045.2 m³',
            `key_surrender_status` VARCHAR(100) DEFAULT 'Keys Accounted',
            `checklist_data` LONGTEXT NULL,
            `remarks` TEXT NULL,
            `status` VARCHAR(50) DEFAULT 'Completed',
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Seed default records if empty
        $count = (int)Database::fetchColumn("SELECT COUNT(*) FROM `hsg_condition_reports`");
        if ($count === 0) {
            $baseItems = [
                'electrical' => [
                    ['item' => 'Light switches and ceiling fixtures', 'status' => 'Passed', 'notes' => 'Tested and functional, clean LED diffusers'],
                    ['item' => 'Power convenience outlets', 'status' => 'Passed', 'notes' => 'Ground pin intact, safe 220V voltage'],
                    ['item' => 'Ceiling fan & speed controller', 'status' => 'Passed', 'notes' => 'All 3 speed levels operating quietly'],
                    ['item' => 'Main sub-breaker switch', 'status' => 'Passed', 'notes' => 'Proper 20A breaker label, dry panel']
                ],
                'doors_windows' => [
                    ['item' => 'Main entrance door & heavy deadbolt', 'status' => 'Passed', 'notes' => 'Deadbolt aligns smoothly, 2 keys tested'],
                    ['item' => 'Window glass, frames & security grilles', 'status' => 'Passed', 'notes' => 'Glass clean, steel grilles firmly anchored'],
                    ['item' => 'Insect screen mesh', 'status' => 'Passed', 'notes' => 'Tear-free, tight weather-seal']
                ],
                'walls_floors' => [
                    ['item' => 'Interior wall paint & surface finish', 'status' => 'Passed', 'notes' => 'Freshly painted beige, no scuff marks'],
                    ['item' => 'Floor tiles & grout', 'status' => 'Passed', 'notes' => 'No broken tiles, grout intact, non-slip'],
                    ['item' => 'Ceiling panels & water leak check', 'status' => 'Passed', 'notes' => 'Dry surface, zero water marks or stains']
                ],
                'furniture' => [
                    ['item' => 'Bed frame & structural foundation', 'status' => 'Passed', 'notes' => 'Solid hardwood/steel frame, sturdy legs'],
                    ['item' => 'Upholstered foam mattress', 'status' => 'Passed', 'notes' => 'Sanitized with protective zippered cover'],
                    ['item' => 'Study desk and chair', 'status' => 'Passed', 'notes' => 'Level surface, varnish in good order'],
                    ['item' => 'Clothing wardrobe cabinet & lock', 'status' => 'Passed', 'notes' => 'Smooth hinges, lock with key functional']
                ],
                'plumbing' => [
                    ['item' => 'Bathroom sink & stainless faucet', 'status' => 'Passed', 'notes' => 'Steady water pressure, no leak at P-trap'],
                    ['item' => 'Water closet & flush tank', 'status' => 'Passed', 'notes' => 'Dual-flush system rapid refill, no running water'],
                    ['item' => 'Shower fixture & drainage flow', 'status' => 'Passed', 'notes' => 'Immediate drain flow, hair strainer clean']
                ],
                'safety' => [
                    ['item' => 'Room photoelectric smoke detector', 'status' => 'Passed', 'notes' => 'Test button chirps, green standby LED'],
                    ['item' => 'Corridor fire extinguisher proximity', 'status' => 'Passed', 'notes' => '10 lbs ABC dry chemical unit within 5 meters'],
                    ['item' => 'Emergency evacuation route signage', 'status' => 'Passed', 'notes' => 'Laminated floor plan posted on door rear']
                ]
            ];

            // AUD-2026-081
            Database::insert('hsg_condition_reports', [
                'audit_ref'            => 'AUD-2026-081',
                'boarding_house_id'    => 1,
                'facility_name'        => 'Villa Marinduque Dorm',
                'room_unit'            => 'Room 102',
                'inspection_stage'     => 'Pre-Move-in Intake',
                'inspector_name'       => 'Engr. R. Santos (Landlord)',
                'score_rating'         => '98% Pristine',
                'inspection_date'      => '2026-08-15',
                'submeter_electric'    => '00214.8 kWh',
                'submeter_water'       => '0068.3 m³',
                'key_surrender_status' => '2 Room Keys Issued & Acknowledged',
                'checklist_data'       => json_encode($baseItems),
                'remarks'              => 'Pre-move-in comprehensive condition audit for incoming semester resident. All furniture, electrical outlets, plumbing fixtures, and smoke alarms verified in pristine condition. Resident acknowledged initial meter readings.',
                'status'               => 'Completed',
                'created_at'           => '2026-08-15 09:30:00'
            ]);

            // AUD-2026-082
            $items2 = $baseItems;
            $items2['furniture'][2]['status'] = 'Minor Wear';
            $items2['furniture'][2]['notes'] = 'Light surface scratch on desk edge from laptop usage; structurally 100% stable.';
            Database::insert('hsg_condition_reports', [
                'audit_ref'            => 'AUD-2026-082',
                'boarding_house_id'    => 2,
                'facility_name'        => 'Greenview Boarding House',
                'room_unit'            => 'Room 204',
                'inspection_stage'     => 'Midterm Safety Audit',
                'inspector_name'       => 'MarSU OSAS Safety Inspector',
                'score_rating'         => '92% Satisfactory',
                'inspection_date'      => '2026-09-20',
                'submeter_electric'    => '00482.1 kWh',
                'submeter_water'       => '0142.9 m³',
                'key_surrender_status' => 'Keys Verified in Resident Custody',
                'checklist_data'       => json_encode($items2),
                'remarks'              => 'Midterm campus safety and sanitary audit conducted by OSAS. Extension cords properly routed with surge protectors. BFP fire exit signs clearly illuminated. Room condition satisfactory.',
                'status'               => 'Completed',
                'created_at'           => '2026-09-20 14:15:00'
            ]);

            // AUD-2026-083 (Minor Window Screen Tear)
            $items3 = $baseItems;
            $items3['doors_windows'][2]['status'] = 'Needs Attention';
            $items3['doors_windows'][2]['notes'] = 'Minor 2-inch tear observed near bottom-left window latch. Frame intact; scheduled for mesh screen patch.';
            Database::insert('hsg_condition_reports', [
                'audit_ref'            => 'AUD-2026-083',
                'boarding_house_id'    => 3,
                'facility_name'        => 'Sunrise Ladies Dorm',
                'room_unit'            => 'Room 104',
                'inspection_stage'     => 'Checkout Clearance',
                'inspector_name'       => 'Mrs. A. Ramos',
                'score_rating'         => 'Minor Window Screen Tear',
                'inspection_date'      => '2026-09-30',
                'submeter_electric'    => '00790.4 kWh',
                'submeter_water'       => '0210.0 m³',
                'key_surrender_status' => '2 Keys Surrendered & Returned',
                'checklist_data'       => json_encode($items3),
                'remarks'              => 'End-of-stay checkout clearance. Room keys surrendered to matron. Final utility sub-meters read and settled. Minor window screen tear logged under regular maintenance wear-and-tear. Full deposit cleared.',
                'status'               => 'Completed',
                'created_at'           => '2026-09-30 16:45:00'
            ]);
        }

        $reports = Database::fetchAll("SELECT * FROM `hsg_condition_reports` ORDER BY id DESC");
        $houses  = Database::fetchAll("SELECT * FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");
        $rooms   = Database::fetchAll("SELECT r.*, b.name as house_name FROM `hsg_rooms` r LEFT JOIN `hsg_boarding_houses` b ON r.boarding_house_id = b.id WHERE r.deleted_at IS NULL ORDER BY r.room_number ASC");

        View::render('housing/Views/conditionreports', [
            'title'   => 'Safety & Sanitary Inspection Condition Reports',
            'slug'    => 'housing',
            'user'    => $user,
            'reports' => $reports,
            'houses'  => $houses,
            'rooms'   => $rooms
        ]);
    }

    public function storeConditionReport(): void
    {
        $facilityName    = trim($_POST['facility_name'] ?? '');
        $roomUnit        = trim($_POST['room_unit'] ?? '');
        $inspectionStage = trim($_POST['inspection_stage'] ?? 'Pre-Move-in Intake');
        $inspectorName   = trim($_POST['inspector_name'] ?? 'Housing Inspector');
        $rating          = trim($_POST['score_rating'] ?? '95% Satisfactory');
        $inspectionDate  = !empty($_POST['inspection_date']) ? $_POST['inspection_date'] : date('Y-m-d');
        $remarks         = trim($_POST['remarks'] ?? '');

        // Generate Audit Reference Number
        $lastId = (int)Database::fetchColumn("SELECT MAX(id) FROM `hsg_condition_reports`");
        $nextNum = str_pad((string)($lastId + 84), 3, '0', STR_PAD_LEFT);
        $auditRef = 'AUD-' . date('Y') . '-' . $nextNum;

        $checklist = [
            'electrical' => [
                ['item' => 'Light switches and ceiling fixtures', 'status' => 'Passed', 'notes' => 'Tested and functional, clean LED diffusers'],
                ['item' => 'Power convenience outlets', 'status' => 'Passed', 'notes' => 'Ground pin intact, safe 220V voltage'],
                ['item' => 'Ceiling fan & speed controller', 'status' => 'Passed', 'notes' => 'All 3 speed levels operating quietly'],
                ['item' => 'Main sub-breaker switch', 'status' => 'Passed', 'notes' => 'Proper 20A breaker label, dry panel']
            ],
            'doors_windows' => [
                ['item' => 'Main entrance door & heavy deadbolt', 'status' => 'Passed', 'notes' => 'Deadbolt aligns smoothly, 2 keys tested'],
                ['item' => 'Window glass, frames & security grilles', 'status' => 'Passed', 'notes' => 'Glass clean, steel grilles firmly anchored'],
                ['item' => 'Insect screen mesh', 'status' => 'Passed', 'notes' => 'Tear-free, tight weather-seal']
            ],
            'walls_floors' => [
                ['item' => 'Interior wall paint & surface finish', 'status' => 'Passed', 'notes' => 'Freshly painted beige, no scuff marks'],
                ['item' => 'Floor tiles & grout', 'status' => 'Passed', 'notes' => 'No broken tiles, grout intact, non-slip'],
                ['item' => 'Ceiling panels & water leak check', 'status' => 'Passed', 'notes' => 'Dry surface, zero water marks or stains']
            ],
            'furniture' => [
                ['item' => 'Bed frame & structural foundation', 'status' => 'Passed', 'notes' => 'Solid hardwood/steel frame, sturdy legs'],
                ['item' => 'Upholstered foam mattress', 'status' => 'Passed', 'notes' => 'Sanitized with protective zippered cover'],
                ['item' => 'Study desk and chair', 'status' => 'Passed', 'notes' => 'Level surface, varnish in good order'],
                ['item' => 'Clothing wardrobe cabinet & lock', 'status' => 'Passed', 'notes' => 'Smooth hinges, lock with key functional']
            ],
            'plumbing' => [
                ['item' => 'Bathroom sink & stainless faucet', 'status' => 'Passed', 'notes' => 'Steady water pressure, no leak at P-trap'],
                ['item' => 'Water closet & flush tank', 'status' => 'Passed', 'notes' => 'Dual-flush system rapid refill, no running water'],
                ['item' => 'Shower fixture & drainage flow', 'status' => 'Passed', 'notes' => 'Immediate drain flow, hair strainer clean']
            ],
            'safety' => [
                ['item' => 'Room photoelectric smoke detector', 'status' => 'Passed', 'notes' => 'Test button chirps, green standby LED'],
                ['item' => 'Corridor fire extinguisher proximity', 'status' => 'Passed', 'notes' => '10 lbs ABC dry chemical unit within 5 meters'],
                ['item' => 'Emergency evacuation route signage', 'status' => 'Passed', 'notes' => 'Laminated floor plan posted on door rear']
            ]
        ];

        Database::insert('hsg_condition_reports', [
            'audit_ref'            => $auditRef,
            'boarding_house_id'    => !empty($_POST['boarding_house_id']) ? (int)$_POST['boarding_house_id'] : null,
            'facility_name'        => $facilityName ?: 'Villa Marinduque Dorm',
            'room_unit'            => $roomUnit ?: 'Rm 101',
            'inspection_stage'     => $inspectionStage,
            'inspector_name'       => $inspectorName,
            'score_rating'         => $rating,
            'inspection_date'      => $inspectionDate,
            'submeter_electric'    => trim($_POST['submeter_electric'] ?? '00120.0 kWh'),
            'submeter_water'       => trim($_POST['submeter_water'] ?? '0040.0 m³'),
            'key_surrender_status' => trim($_POST['key_surrender_status'] ?? 'Keys Issued & Tested'),
            'checklist_data'       => json_encode($checklist),
            'remarks'              => $remarks ?: 'Standard room handover inspection completed.',
            'status'               => 'Completed',
            'created_at'           => date('Y-m-d H:i:s')
        ]);

        redirect(url('housing/conditionreports'), 'success', "Inspection checklist {$auditRef} logged successfully!");
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

    public function accreditation(): void
    {
        $this->index();
    }
}

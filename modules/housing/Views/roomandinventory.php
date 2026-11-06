<!-- Room & Inventory Management View with Floor & Room Gallery Folders -->
<?php include __DIR__ . '/partials/nav_styles.php'; ?>

<style>
/* ==========================================================================
   FLOOR & ROOM GALLERY FOLDER SYSTEM STYLING
   MarSU Brand Guidelines: Burgundy (#800020), Gold (#D4AF37)
   ========================================================================== */

/* View Mode Switcher Pills */
.view-mode-pill-group {
    background: #f1f5f9;
    padding: 4px;
    border-radius: 30px;
    display: inline-flex;
    border: 1px solid #e2e8f0;
}

.view-mode-pill-group .btn {
    border-radius: 24px;
    font-size: 0.85rem;
    padding: 0.35rem 1.15rem;
    font-weight: 600;
    color: #475569;
    border: none;
    transition: all 0.2s ease;
}

.view-mode-pill-group .btn.active {
    background: #800020 !important;
    color: #ffffff !important;
    box-shadow: 0 2px 6px rgba(128, 0, 32, 0.28);
}

.view-mode-pill-group .btn.active i {
    color: #D4AF37 !important;
}

/* Floor Gallery Folders */
.folder-card {
    position: relative;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    padding: 1.1rem 1rem;
    cursor: pointer;
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    user-select: none;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.folder-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: transparent;
    transition: background 0.2s ease;
}

.folder-card:hover {
    transform: translateY(-3px);
    border-color: #D4AF37;
    box-shadow: 0 8px 18px rgba(212, 175, 55, 0.16);
}

.folder-card:hover::before {
    background: #D4AF37;
}

.folder-card.active {
    border-color: #800020;
    background: linear-gradient(145deg, #fffcf7 0%, #ffffff 100%);
    box-shadow: 0 8px 22px rgba(128, 0, 32, 0.12);
}

.folder-card.active::before {
    background: #800020;
}

.folder-card .folder-icon i {
    font-size: 1.85rem;
    transition: transform 0.2s ease;
}

.folder-card:hover .folder-icon i {
    transform: scale(1.08);
}

.folder-card.active .folder-icon i {
    color: #800020 !important;
}

/* Room Gallery Cards */
.room-gallery-card {
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    background: #ffffff;
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.room-gallery-card:hover {
    transform: translateY(-4px);
    border-color: rgba(212, 175, 55, 0.7);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.09);
}

.room-preview-stage {
    position: relative;
    height: 165px;
    background: #1f2937;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.room-cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.room-gallery-card:hover .room-cover-img {
    transform: scale(1.04);
}

.room-cover-empty {
    color: #cbd5e1;
}

.room-preview-stage .preview-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.room-preview-stage:hover .preview-overlay {
    opacity: 1;
}

/* Modal Gallery Stage */
.gallery-stage-box {
    background: #090d16;
    border-radius: 12px;
    min-height: 360px;
    max-height: 440px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.gallery-stage-img {
    max-width: 100%;
    max-height: 440px;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
}

.gallery-thumb-btn {
    width: 74px;
    height: 54px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid #334155;
    background: #1e293b;
    padding: 2px;
    opacity: 0.65;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.gallery-thumb-btn:hover,
.gallery-thumb-btn.active {
    opacity: 1;
    border-color: #D4AF37;
    transform: scale(1.06);
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.35);
}

.gallery-thumb-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px;
    display: block;
}
</style>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-box-seam me-2 text-gold"></i>Room Inventory & Furniture Assets
        </h1>
        <p class="text-muted small mb-0">Track fixtures, beds, room capacity, floor plan blueprints, and photo galleries across accredited boarding houses.</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Inventory
        </button>
        <button class="btn btn-outline-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
            <i class="bi bi-camera me-1"></i>Upload Photo
        </button>
        <button class="btn btn-outline-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newBoardingHouseModal">
            <i class="bi bi-buildings me-1"></i>Add Boarding Facility
        </button>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newRoomModal">
            <i class="bi bi-plus-lg me-1"></i>Add Room Unit
        </button>
    </div>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Sub-navigation Pills -->
<div class="custom-nav-pills-wrapper mb-4">
    <ul class="nav nav-pills custom-nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-box-seam me-1"></i>Room & Inventory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/availabilitytracking') ?>">
                <i class="bi bi-calendar-check me-1"></i>Availability Tracking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/roomassignment') ?>">
                <i class="bi bi-door-open me-1"></i>Room Assignments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/occupancymonitoring') ?>">
                <i class="bi bi-pie-chart me-1"></i>Occupancy Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('housing/bedallocation') ?>">
                <i class="bi bi-grid-3x3 me-1"></i>Bed Allocation
            </a>
        </li>
    </ul>
</div>

<?php
// Default fallback rooms if database is fresh / unseeded
$defaultSampleRooms = [
    [
        'id' => 1,
        'room_number' => 'Room 101',
        'house_name' => 'Villa Marinduque Dorm',
        'house_address' => 'Boac, Marinduque',
        'room_type' => 'Single',
        'floor' => '1st Floor',
        'capacity' => 1,
        'occupied_beds' => 1,
        'monthly_rate' => 2200.00,
        'status' => 'Full',
        'amenities' => 'Aircon, Ensuite Bath, Study Desk, Locker, Wi-Fi',
        'photo_count' => 5
    ],
    [
        'id' => 2,
        'room_number' => 'Room 102',
        'house_name' => 'Villa Marinduque Dorm',
        'house_address' => 'Boac, Marinduque',
        'room_type' => 'Double',
        'floor' => '1st Floor',
        'capacity' => 2,
        'occupied_beds' => 1,
        'monthly_rate' => 1600.00,
        'status' => 'Available',
        'amenities' => 'Wall Fan, 2 Study Desks, Lockers, Free WiFi',
        'photo_count' => 4
    ],
    [
        'id' => 3,
        'room_number' => 'Room 103',
        'house_name' => 'Villa Marinduque Dorm',
        'house_address' => 'Boac, Marinduque',
        'room_type' => 'Quad',
        'floor' => '1st Floor',
        'capacity' => 4,
        'occupied_beds' => 4,
        'monthly_rate' => 1400.00,
        'status' => 'Full',
        'amenities' => 'Double Bunk Beds, Ceiling Fan, Lockers, Shared Bath',
        'photo_count' => 6
    ],
    [
        'id' => 4,
        'room_number' => 'Room 201',
        'house_name' => 'Villa Marinduque Dorm',
        'house_address' => 'Boac, Marinduque',
        'room_type' => 'Double',
        'floor' => '2nd Floor',
        'capacity' => 2,
        'occupied_beds' => 0,
        'monthly_rate' => 1500.00,
        'status' => 'Available',
        'amenities' => 'Window Balcony, Fan, Study Nook, Free Wi-Fi',
        'photo_count' => 5
    ],
    [
        'id' => 5,
        'room_number' => 'Room 202',
        'house_name' => 'Greenview Boarding House',
        'house_address' => 'Brgy. Santol, Boac',
        'room_type' => 'Double',
        'floor' => '2nd Floor',
        'capacity' => 2,
        'occupied_beds' => 2,
        'monthly_rate' => 1500.00,
        'status' => 'Full',
        'amenities' => 'Ceiling Fan, Lockers, Purified Water, Wi-Fi',
        'photo_count' => 4
    ],
    [
        'id' => 6,
        'room_number' => 'Room 204',
        'house_name' => 'Sunrise Ladies Dormitory',
        'house_address' => 'Boac, Marinduque',
        'room_type' => 'Double',
        'floor' => '2nd Floor',
        'capacity' => 2,
        'occupied_beds' => 1,
        'monthly_rate' => 1800.00,
        'status' => 'Available',
        'amenities' => 'Aircon, Hot Shower, 2 Lockers, Study Lamps',
        'photo_count' => 6
    ],
    [
        'id' => 7,
        'room_number' => 'Room 301',
        'house_name' => 'Villa Marinduque Dorm',
        'house_address' => 'Boac, Marinduque',
        'room_type' => 'Single',
        'floor' => '3rd Floor',
        'capacity' => 1,
        'occupied_beds' => 0,
        'monthly_rate' => 2500.00,
        'status' => 'Available',
        'amenities' => 'Solo Aircon, Panoramic Balcony, Private Bath, Desk',
        'photo_count' => 7
    ],
    [
        'id' => 8,
        'room_number' => 'Room 302',
        'house_name' => 'Greenview Boarding House',
        'house_address' => 'Brgy. Santol, Boac',
        'room_type' => 'Triple',
        'floor' => '3rd Floor',
        'capacity' => 3,
        'occupied_beds' => 2,
        'monthly_rate' => 1350.00,
        'status' => 'Available',
        'amenities' => 'Upper Deck Bunks, 3 Lockers, Skylight View',
        'photo_count' => 4
    ]
];

$activeRooms = !empty($rooms) ? $rooms : $defaultSampleRooms;
$photosByRoom = $photosByRoom ?? [];

// Calculate stats for floors
$floorStats = [];
foreach ($activeRooms as $rm) {
    $fl = trim($rm['floor'] ?? '1st Floor');
    if (!isset($floorStats[$fl])) {
        $floorStats[$fl] = ['count' => 0, 'capacity' => 0, 'occupied' => 0];
    }
    $floorStats[$fl]['count']++;
    $floorStats[$fl]['capacity'] += (int)($rm['capacity'] ?? 2);
    $floorStats[$fl]['occupied'] += (int)($rm['occupied_beds'] ?? 0);
}
?>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Total Room Units</div>
                    <div class="kpi-value text-marsu-burgundy">
                        <?= count($activeRooms) ?>
                        <span class="kpi-unit">Units</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-burgundy" title="Total Room Units">
                    <i class="bi bi-door-closed-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-buildings text-marsu-burgundy"></i>
                <span>Across <?= count($floorStats) ?> floor levels</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Total Bed Capacity</div>
                    <div class="kpi-value text-gold">
                        <?= array_sum(array_column($activeRooms, 'capacity')) ?>
                        <span class="kpi-unit">Beds</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Total Bed Capacity">
                    <i class="bi bi-layers-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-people-fill text-gold-dark"></i>
                <span>Maximum student capacity</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Occupied Beds</div>
                    <div class="kpi-value text-gold">
                        <?= array_sum(array_column($activeRooms, 'occupied_beds')) ?>
                        <span class="kpi-unit">Beds</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold" title="Occupied Bed Spaces">
                    <i class="bi bi-person-check-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-pie-chart-fill text-gold-dark"></i>
                <span>Currently residing students</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-success h-100 shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="kpi-label">Vacant Beds Available</div>
                    <div class="kpi-value text-success">
                        <?= max(0, array_sum(array_column($activeRooms, 'capacity')) - array_sum(array_column($activeRooms, 'occupied_beds'))) ?>
                        <span class="kpi-unit">Vacancies</span>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-success" title="Vacant Beds">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
            <div class="kpi-subtext">
                <i class="bi bi-shield-check text-success"></i>
                <span>Ready for student occupancy</span>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- SECTION: VIEW TOGGLE & FILTER BAR                                         -->
<!-- ========================================================================= -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <!-- View Switcher (Inventory Table First, Gallery Folders Second) -->
    <div class="view-mode-pill-group shadow-sm">
        <button type="button" class="btn active" id="btnShowTableView">
            <i class="bi bi-table me-1"></i>Inventory Table Directory
        </button>
        <button type="button" class="btn" id="btnShowGalleryView">
            <i class="bi bi-folder2-open me-1"></i>Floor & Room Gallery Folders
        </button>
    </div>

    <!-- Live Search & Filter -->
    <div class="d-flex gap-2 align-items-center">
        <div class="input-group input-group-sm" style="width: 280px;">
            <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" id="roomSearchInput" class="form-control border-start-0 ps-0" placeholder="Search room, house, floor, amenities...">
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- VIEW 1: INVENTORY ASSET DIRECTORY (TABLE VIEW - ACTIVE BY DEFAULT)        -->
<!-- ========================================================================= -->
<div id="tableViewContainer">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="mb-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-list-check me-2 text-gold"></i>Room Units & Inventory Directory Table
            </h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Print Ledger
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="roomTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Room Unit</th>
                            <th>Boarding Facility</th>
                            <th>Room Type & Floor</th>
                            <th>Capacity / Occupied</th>
                            <th>Monthly Rate</th>
                            <th>Status</th>
                            <th>Amenities & Equipment</th>
                            <th class="text-end pe-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activeRooms as $r): ?>
                            <?php 
                                $vacant = max(0, (int)$r['capacity'] - (int)$r['occupied_beds']);
                                $statusBadge = ($vacant === 0) 
                                    ? '<span class="badge bg-danger-subtle text-danger border border-danger">Full</span>'
                                    : '<span class="badge bg-success-subtle text-success border border-success">Available (' . $vacant . ' vacant)</span>';
                                $floor = trim($r['floor'] ?? '1st Floor');
                            ?>
                            <tr data-floor="<?= e($floor) ?>">
                                <td class="ps-3 fw-bold text-dark">
                                    <i class="bi bi-door-closed text-gold me-1"></i><?= e($r['room_number']) ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?></div>
                                    <div class="small text-muted"><?= e($r['house_address'] ?? 'Boac, Marinduque') ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis me-1"><?= e($r['room_type']) ?></span>
                                    <small class="text-muted d-block"><?= e($floor) ?></small>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= (int)$r['occupied_beds'] ?> / <?= (int)$r['capacity'] ?> Beds</div>
                                    <div class="progress mt-1" style="height: 6px; width: 100px;">
                                        <?php $pct = $r['capacity'] > 0 ? round(($r['occupied_beds'] / $r['capacity']) * 100) : 0; ?>
                                        <div class="progress-bar <?= $pct >= 100 ? 'bg-danger' : 'progress-bar-gold' ?>" style="width: <?= $pct ?>%"></div>
                                    </div>
                                </td>
                                <td class="fw-bold text-marsu-burgundy">
                                    ₱<?= number_format((float)$r['monthly_rate'], 2) ?>
                                </td>
                                <td>
                                    <?= $statusBadge ?>
                                </td>
                                <td>
                                    <small class="text-muted"><?= e($r['amenities'] ?? 'Wi-Fi, Study Desk, Locker') ?></small>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-primary py-0 px-2 btn-open-gallery" 
                                            title="View Room & Floor Gallery" 
                                            data-room-id="<?= (int)$r['id'] ?>"
                                            data-room-number="<?= e($r['room_number']) ?>"
                                            data-house="<?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?>"
                                            data-floor="<?= e($floor) ?>"
                                            data-type="<?= e($r['room_type']) ?>"
                                            data-rent="<?= number_format((float)$r['monthly_rate'], 2) ?>"
                                            data-capacity="<?= (int)$r['capacity'] ?>"
                                            data-occupied="<?= (int)$r['occupied_beds'] ?>"
                                            data-amenities="<?= e($r['amenities'] ?? 'Wi-Fi, Study Desk, Locker') ?>"
                                        >
                                            <i class="bi bi-images"></i>
                                        </button>
                                        <form action="<?= url('housing/rooms/delete') ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this room unit from inventory?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                            <button type="submit" class="btn btn-outline-danger py-0 px-2" title="Delete Room">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- VIEW 2: FLOOR & ROOM GALLERY FOLDERS (ACCESSIBLE VIA TAB)                 -->
<!-- ========================================================================= -->
<div id="galleryViewContainer" style="display: none;">
    <!-- Floor Folder Navigation Tabs (Card-Style Folders) -->
    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="mb-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-folder-fill me-2 text-gold"></i>Floor Gallery Folders
            </h6>
            <span class="small text-muted" id="activeFolderBreadcrumb">Showing: <strong>All Floors & Wings</strong> (<?= count($activeRooms) ?> Units)</span>
        </div>

        <div class="row g-3" id="floorFoldersRow">
            <!-- Folder: All Floors -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="folder-card active" data-floor="all">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="folder-icon text-gold">
                                <i class="bi bi-folder-fill"></i>
                            </div>
                            <span class="badge bg-gold-subtle text-dark border">All Floors</span>
                        </div>
                        <div class="fw-bold text-dark fs-6">Complete Facility</div>
                        <div class="small text-muted"><?= count($activeRooms) ?> Rooms • <?= array_sum(array_column($activeRooms, 'capacity')) ?> Beds</div>
                    </div>
                    <div class="mt-2 pt-2 border-top d-flex justify-content-between align-items-center small">
                        <span class="text-success fw-semibold">
                            <i class="bi bi-check2-circle me-1"></i><?= max(0, array_sum(array_column($activeRooms, 'capacity')) - array_sum(array_column($activeRooms, 'occupied_beds'))) ?> Vacancies
                        </span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </div>
                </div>
            </div>

            <!-- Dynamic Floor Folders -->
            <?php 
            $floorColorClasses = ['badge-burgundy', 'badge-gold', 'badge-info', 'badge-success'];
            $ci = 0;
            foreach ($floorStats as $flName => $fstat): 
                $fVacant = max(0, $fstat['capacity'] - $fstat['occupied']);
            ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="folder-card" data-floor="<?= e($flName) ?>">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="folder-icon text-gold">
                                    <i class="bi bi-folder-fill"></i>
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis border">Wing Folder</span>
                            </div>
                            <div class="fw-bold text-dark fs-6"><?= e($flName) ?></div>
                            <div class="small text-muted"><?= $fstat['count'] ?> Units • <?= $fstat['capacity'] ?> Beds</div>
                        </div>
                        <div class="mt-2 pt-2 border-top d-flex justify-content-between align-items-center small">
                            <span class="<?= $fVacant > 0 ? 'text-success' : 'text-danger' ?> fw-semibold">
                                <i class="bi <?= $fVacant > 0 ? 'bi-check2-circle' : 'bi-x-circle' ?> me-1"></i><?= $fVacant ?> Vacant
                            </span>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Active Floor Room Gallery Cards Grid -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-images me-2 text-gold"></i>Room Units Photo & Floor Plan Gallery
                </h6>
                <small class="text-muted" id="galleryCountSubtitle">Showing <?= count($activeRooms) ?> room units with verified blueprints and photography</small>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                    <i class="bi bi-cloud-arrow-up me-1"></i>Add Room Photos
                </button>
            </div>
        </div>
        <div class="card-body p-4 bg-light">
            <div class="row g-4" id="roomGalleryGrid">
                <?php foreach ($activeRooms as $r): ?>
                    <?php 
                        $vacant = max(0, (int)$r['capacity'] - (int)$r['occupied_beds']);
                        $isFull = ($vacant === 0);
                        $floor = trim($r['floor'] ?? '1st Floor');
                        $photoCount = count($photosByRoom[(int)$r['id']] ?? []);
                        $roomType = $r['room_type'] ?? 'Double';
                    ?>
                    <div class="col-md-6 col-lg-4 room-card-wrapper" 
                         data-floor="<?= e($floor) ?>"
                         data-room="<?= e($r['room_number']) ?>"
                         data-house="<?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?>"
                         data-amenities="<?= e($r['amenities'] ?? '') ?>"
                    >
                        <div class="room-gallery-card">
                            <!-- Room Architectural / Photo Preview Stage -->
                            <div class="room-preview-stage btn-open-gallery" 
                                 title="Click to explore Room & Floor Gallery"
                                 data-room-id="<?= (int)$r['id'] ?>"
                                 data-room-number="<?= e($r['room_number']) ?>"
                                 data-house="<?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?>"
                                 data-floor="<?= e($floor) ?>"
                                 data-type="<?= e($roomType) ?>"
                                 data-rent="<?= number_format((float)$r['monthly_rate'], 2) ?>"
                                 data-capacity="<?= (int)$r['capacity'] ?>"
                                 data-occupied="<?= (int)$r['occupied_beds'] ?>"
                                 data-amenities="<?= e($r['amenities'] ?? 'Wi-Fi, Study Desk, Locker') ?>"
                            >
                                <?php $roomPhotos = $photosByRoom[(int)$r['id']] ?? []; $cover = $roomPhotos[0]['url'] ?? null; ?>
                                <?php if ($cover): ?>
                                    <img src="<?= e($cover) ?>" alt="<?= e($r['room_number']) ?> photo" class="room-cover-img" loading="lazy">
                                <?php else: ?>
                                    <div class="room-cover-empty text-center">
                                        <i class="bi bi-image fs-1 d-block"></i>
                                        <div class="small fw-semibold">No photo uploaded yet</div>
                                    </div>
                                <?php endif; ?>

                                <!-- Badge Top Left: Floor -->
                                <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75 text-white border border-secondary">
                                    <i class="bi bi-layers me-1 text-gold"></i><?= e($floor) ?>
                                </span>

                                <!-- Badge Top Right: Vacancy Status -->
                                <span class="position-absolute top-0 end-0 m-2 badge <?= $isFull ? 'bg-danger' : 'bg-success' ?> shadow-sm">
                                    <?= $isFull ? 'Full Occupancy' : ($vacant . ' Bed Vacant') ?>
                                </span>

                                <!-- Badge Bottom Left: Real Photo Count -->
                                <span class="position-absolute bottom-0 start-0 m-2 badge bg-black bg-opacity-70 text-white">
                                    <i class="bi bi-camera me-1 text-gold"></i><?= $photoCount ?> Photo<?= $photoCount === 1 ? '' : 's' ?>
                                </span>

                                <!-- Hover Overlay Prompt -->
                                <div class="preview-overlay">
                                    <span class="btn btn-sm btn-light shadow-sm fw-bold">
                                        <i class="bi bi-eye me-1 text-marsu-burgundy"></i>Open Gallery
                                    </span>
                                </div>
                            </div>

                            <!-- Room Details Body -->
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0">
                                            <i class="bi bi-door-closed text-gold me-1"></i><?= e($r['room_number']) ?>
                                        </h5>
                                        <span class="small text-muted">
                                            <i class="bi bi-building me-1"></i><?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?>
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-marsu-burgundy fs-6">₱<?= number_format((float)$r['monthly_rate'], 2) ?></div>
                                        <small class="text-muted" style="font-size: 11px;">/ month per head</small>
                                    </div>
                                </div>

                                <!-- Bed Capacity Progress -->
                                <div class="my-2 p-2 rounded bg-light border">
                                    <div class="d-flex justify-content-between align-items-center small mb-1">
                                        <span class="text-muted">Capacity & Beds:</span>
                                        <span class="fw-bold text-dark"><?= (int)$r['occupied_beds'] ?> / <?= (int)$r['capacity'] ?> Beds Occupied</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <?php $pct = $r['capacity'] > 0 ? round(($r['occupied_beds'] / $r['capacity']) * 100) : 0; ?>
                                        <div class="progress-bar <?= $pct >= 100 ? 'bg-danger' : 'progress-bar-gold' ?>" style="width: <?= $pct ?>%"></div>
                                    </div>
                                </div>

                                <!-- Amenities Chips -->
                                <div class="mb-3">
                                    <div class="small text-muted mb-1 fw-semibold" style="font-size: 11px;">FIXTURES & AMENITIES:</div>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php 
                                            $amenityList = explode(',', $r['amenities'] ?? 'Wi-Fi, Study Desk, Locker');
                                            foreach (array_slice($amenityList, 0, 3) as $am): 
                                        ?>
                                            <span class="badge bg-light text-dark border" style="font-size: 10px;">
                                                <i class="bi bi-check2 text-success me-1"></i><?= e(trim($am)) ?>
                                            </span>
                                        <?php endforeach; ?>
                                        <?php if (count($amenityList) > 3): ?>
                                            <span class="badge bg-secondary-subtle text-secondary" style="font-size: 10px;">+<?= count($amenityList) - 3 ?> more</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-auto pt-2 border-top d-flex gap-2">
                                    <button type="button" class="btn btn-marsu btn-sm flex-grow-1 btn-open-gallery"
                                        data-room-id="<?= (int)$r['id'] ?>"
                                        data-room-number="<?= e($r['room_number']) ?>"
                                        data-house="<?= e($r['house_name'] ?? 'Villa Marinduque Dorm') ?>"
                                        data-floor="<?= e($floor) ?>"
                                        data-type="<?= e($roomType) ?>"
                                        data-rent="<?= number_format((float)$r['monthly_rate'], 2) ?>"
                                        data-capacity="<?= (int)$r['capacity'] ?>"
                                        data-occupied="<?= (int)$r['occupied_beds'] ?>"
                                        data-amenities="<?= e($r['amenities'] ?? 'Wi-Fi, Study Desk, Locker') ?>"
                                    >
                                        <i class="bi bi-images me-1"></i>Open Gallery
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-quick-upload" 
                                        title="Attach Photo to Room"
                                        data-bs-toggle="modal"
                                        data-bs-target="#uploadPhotoModal"
                                        data-room-id="<?= (int)$r['id'] ?>"
                                        data-room-number="<?= e($r['room_number']) ?>"
                                    >
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: ROOM & FLOOR PHOTO & BLUEPRINT GALLERY VIEWER                      -->
<!-- ========================================================================= -->
<div class="modal fade" id="roomGalleryModal" tabindex="-1" aria-labelledby="roomGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <div class="modal-header py-3 text-white" style="background-color:#800020;">
                <div>
                    <h5 class="modal-title font-weight-bold mb-0" id="galleryModalTitle">
                        <i class="bi bi-images text-gold me-2"></i>Room 101 Photo Gallery & Floor Plan
                    </h5>
                    <small class="text-white d-block mt-1" style="opacity:.9;" id="galleryModalSubtitle">Villa Marinduque Dorm • 1st Floor • Double Occupancy</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="row g-3">
                    <!-- Left Column: Gallery Stage & Photo Switcher -->
                    <div class="col-lg-8">
                        <!-- Category Switcher Tabs -->
                        <!-- Main Photo Display Stage (real uploaded photo) -->
                        <div class="gallery-stage-box shadow-sm mb-2" id="galleryMainStage"></div>

                        <!-- Photo Caption Bar -->
                        <div class="p-2 px-3 rounded bg-white border d-flex justify-content-between align-items-center flex-wrap gap-2 small mb-3">
                            <div>
                                <span class="fw-bold text-dark" id="stagePhotoTitle">No photo selected</span>
                                <span class="text-muted ms-2" id="stagePhotoDesc"></span>
                            </div>
                            <?php if (!empty($canManagePhotos)): ?>
                                <form id="stageDeleteWrap" class="d-none" action="<?= url('housing/rooms/photos/delete') ?>" method="POST" onsubmit="return confirm('Remove this photo from the room gallery?');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" id="deletePhotoId" value="">
                                    <button type="submit" class="btn btn-outline-danger btn-sm py-0">
                                        <i class="bi bi-trash me-1"></i>Remove Photo
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <!-- Thumbnails Selector Strip -->
                        <div>
                            <div class="small fw-semibold text-muted text-uppercase mb-1" style="font-size: 11px;">PHOTOS (CLICK A THUMBNAIL TO PREVIEW):</div>
                            <div class="d-flex gap-2 overflow-auto py-1" id="galleryThumbnailsRow"></div>
                        </div>
                    </div>

                    <!-- Right Column: Room Specs, Utilities & Safety Checklist -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                            <div class="card-header bg-white py-2 border-bottom fw-bold text-marsu-burgundy small text-uppercase">
                                <i class="bi bi-clipboard-data me-1 text-gold-dark"></i> Room Specifications & Inspection
                            </div>
                            <div class="card-body p-3">
                                <!-- Rent & Occupancy Banner -->
                                <div class="p-3 rounded bg-light border mb-3">
                                    <div class="small text-muted text-uppercase fw-bold" style="font-size: 11px;">MONTHLY ACCREDITED RATE</div>
                                    <div class="h3 fw-bold text-success mb-1" id="modalRoomRent">₱1,600.00</div>
                                    <div class="small text-muted" id="modalRoomCapacity">Double Occupancy (2 Beds Capacity)</div>
                                </div>

                                <!-- Detail List -->
                                <ul class="list-unstyled small mb-3">
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                        <span class="text-muted">Floor & Wing:</span>
                                        <span class="fw-bold text-dark text-end" id="modalRoomFloor">1st Floor (East Wing)</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                        <span class="text-muted">Room Classification:</span>
                                        <span class="badge bg-secondary-subtle text-dark text-end" id="modalRoomType">Double</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom">
                                        <span class="text-muted d-block mb-1">Included Amenities:</span>
                                        <div class="d-flex flex-wrap gap-1" id="modalRoomAmenities">
                                            <span class="badge bg-light text-dark border">Aircon</span>
                                            <span class="badge bg-light text-dark border">Study Desk</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                                    <i class="bi bi-printer me-1"></i>Print Dossier
                                </button>
                                <?php if (!empty($canManagePhotos)): ?>
                                <button type="button" class="btn btn-marsu btn-sm" id="galleryUploadBtn">
                                    <i class="bi bi-camera me-1"></i>Upload Photo
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-2 px-3 border-top">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close Gallery</button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: UPLOAD ROOM PHOTO / ATTACH TO GALLERY                               -->
<!-- ========================================================================= -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header py-3 text-white" style="background-color:#800020;">
                <h5 class="modal-title font-weight-bold mb-0" id="uploadPhotoModalLabel">
                    <i class="bi bi-camera-fill text-gold me-2"></i>Upload Room & Floor Photo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadPhotoForm" action="<?= url('housing/rooms/photos/upload') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <?php if (empty($canManagePhotos)): ?>
                        <div class="alert alert-warning small mb-0">
                            <i class="bi bi-lock-fill me-1"></i>You do not have permission to upload room photos (requires <strong>housing.register</strong>).
                        </div>
                    <?php elseif (empty($rooms)): ?>
                        <div class="alert alert-info small mb-0">
                            <i class="bi bi-info-circle me-1"></i>Add a room unit first, then you can upload its photos.
                        </div>
                    <?php else: ?>
                    <div class="mb-3">
                        <label class="form-label small fw-bold" for="uploadTargetRoom">Target Room Unit <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="uploadTargetRoom" name="room_id" required>
                            <?php foreach ($rooms as $rm): ?>
                                <option value="<?= (int)$rm['id'] ?>">
                                    <?= e($rm['room_number']) ?> (<?= e($rm['floor'] ?? '1st Floor') ?> • <?= e($rm['house_name'] ?? 'No boarding house') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold" for="uploadPhotoCategory">Photo Angle / Category <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="uploadPhotoCategory" name="category" required>
                            <option value="bed">Bed Space & Room Interior</option>
                            <option value="study">Study Desk & Storage Lockers</option>
                            <option value="bath">Restroom & Fixtures</option>
                            <option value="plan">2D Floor Plan & Evacuation Route</option>
                            <option value="safety">Electric Submeter & Safety Equipment</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold" for="uploadFileInput">Select Photo File(s) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm" id="uploadFileInput" name="photos[]" accept="image/jpeg,image/png,image/webp" multiple required>
                        <div class="form-text">JPG, PNG or WEBP only, up to 5 MB each (maximum 10 photos at a time).</div>
                    </div>

                    <!-- Local Image Preview Area -->
                    <div id="uploadPreviewContainer" class="p-2 border rounded bg-light text-center mb-3" style="display: none;">
                        <img id="uploadImagePreview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 180px;">
                        <div class="small text-muted mt-1" id="uploadFileInfo"></div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label small fw-bold" for="uploadPhotoCaption">Caption (optional)</label>
                        <input type="text" class="form-control form-control-sm" id="uploadPhotoCaption" name="caption" maxlength="255" placeholder="e.g. Double deck bed with new mattress">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer bg-light py-2 px-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <?php if (!empty($canManagePhotos) && !empty($rooms)): ?>
                    <button type="submit" id="uploadSubmitBtn" class="btn btn-marsu btn-sm px-3 shadow-sm">
                        <i class="bi bi-cloud-arrow-up me-1"></i>Save to Room Gallery
                    </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: ADD BOARDING FACILITY / HOUSE                                       -->
<!-- ========================================================================= -->
<div class="modal fade" id="newBoardingHouseModal" tabindex="-1" aria-labelledby="newBoardingHouseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white" style="background: linear-gradient(135deg,#800020 0%,#4e0013 100%); border-bottom: 3.5px solid #D4AF37;">
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle d-flex align-items-center justify-content-center" style="width:38px;height:38px;background:rgba(255,255,255,0.15);">
                        <i class="bi bi-buildings-fill fs-5 text-gold"></i>
                    </span>
                    <div>
                        <h5 class="modal-title fw-bold mb-0" id="newBoardingHouseModalLabel">Register New Boarding Facility</h5>
                        <small class="opacity-75" style="font-size:.78rem;">Add a new accredited boarding house or dormitory to the housing directory</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= url('housing/boardinghouses/create') ?>" method="POST" id="newBoardingHouseForm" novalidate
                  class="d-flex flex-column" style="min-height:0;overflow:hidden;max-height:calc(100vh - 3.5rem - 90px);">
                <?= csrf_field() ?>
                <div class="modal-body px-4 py-3" style="overflow-y:auto;min-height:0;">

                    <!-- Section: Basic Information -->
                    <div class="mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="badge text-white fw-semibold px-3 py-2" style="background:#800020;font-size:.8rem;border-radius:20px;">
                            <i class="bi bi-info-circle me-1"></i>Facility Information
                        </span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhName">
                                <i class="bi bi-building me-1"></i>Boarding House / Facility Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="bhName" name="name"
                                placeholder="e.g. Villa Marinduque Student Dormitory"
                                required maxlength="200" autocomplete="off">
                            <div class="invalid-feedback">Facility name is required.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhOwner">
                                <i class="bi bi-person-fill me-1"></i>Owner / Landlord Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="bhOwner" name="owner_name"
                                placeholder="e.g. Juan dela Cruz" required maxlength="150">
                            <div class="invalid-feedback">Owner name is required.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhContact">
                                <i class="bi bi-telephone-fill me-1"></i>Contact Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="bhContact" name="contact_number"
                                placeholder="e.g. 0917-123-4567" required maxlength="30">
                            <div class="invalid-feedback">Contact number is required.</div>
                        </div>
                    </div>

                    <!-- Section: Address -->
                    <div class="mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="badge text-white fw-semibold px-3 py-2" style="background:#800020;font-size:.8rem;border-radius:20px;">
                            <i class="bi bi-geo-alt me-1"></i>Location & Address
                        </span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhAddress">
                                <i class="bi bi-map me-1"></i>Full Street Address
                            </label>
                            <input type="text" class="form-control" id="bhAddress" name="address"
                                placeholder="e.g. Purok 3, Panfilo M. Manguera Sr. Rd." maxlength="300">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhBarangay">
                                <i class="bi bi-signpost me-1"></i>Barangay
                            </label>
                            <input type="text" class="form-control" id="bhBarangay" name="barangay"
                                value="Brgy. Santol, Boac" maxlength="100">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhSafetyRating">
                                <i class="bi bi-shield-check me-1"></i>Safety Rating
                            </label>
                            <select class="form-select" id="bhSafetyRating" name="safety_rating">
                                <option value="A">A — Excellent</option>
                                <option value="B">B — Good</option>
                                <option value="C">C — Fair</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section: Accreditation & Capacity -->
                    <div class="mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="badge text-white fw-semibold px-3 py-2" style="background:#800020;font-size:.8rem;border-radius:20px;">
                            <i class="bi bi-patch-check me-1"></i>Accreditation & Capacity
                        </span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhAccreditation">
                                <i class="bi bi-award me-1"></i>Accreditation Status
                            </label>
                            <select class="form-select" id="bhAccreditation" name="accreditation_status">
                                <option value="Accredited" selected>✅ Accredited</option>
                                <option value="Pending">⏳ Pending</option>
                                <option value="Under Inspection">🔍 Under Inspection</option>
                                <option value="Expired">❌ Expired</option>
                                <option value="Revoked">🚫 Revoked</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhTotalRooms">
                                <i class="bi bi-door-closed me-1"></i>Total Rooms
                            </label>
                            <input type="number" class="form-control" id="bhTotalRooms" name="total_rooms"
                                value="10" min="1" max="999">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhTotalCapacity">
                                <i class="bi bi-people me-1"></i>Total Capacity
                            </label>
                            <input type="number" class="form-control" id="bhTotalCapacity" name="total_capacity"
                                value="30" min="1" max="9999">
                        </div>
                    </div>

                    <!-- Section: Monthly Rate -->
                    <div class="mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="badge text-white fw-semibold px-3 py-2" style="background:#800020;font-size:.8rem;border-radius:20px;">
                            <i class="bi bi-cash-coin me-1"></i>Monthly Rate Range
                        </span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhRateMin">
                                <i class="bi bi-currency-exchange me-1"></i>Minimum Rate (₱/month)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold" style="background:#f8f0f3;color:#800020;border-color:#dee2e6;">₱</span>
                                <input type="number" class="form-control" id="bhRateMin" name="monthly_rate_min"
                                    value="1200" min="0" step="50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-marsu-burgundy" for="bhRateMax">
                                <i class="bi bi-currency-exchange me-1"></i>Maximum Rate (₱/month)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold" style="background:#f8f0f3;color:#800020;border-color:#dee2e6;">₱</span>
                                <input type="number" class="form-control" id="bhRateMax" name="monthly_rate_max"
                                    value="2500" min="0" step="50">
                            </div>
                        </div>

                        <!-- Live Rate Preview -->
                        <div class="col-12">
                            <div class="rounded-3 p-3 d-flex align-items-center gap-3" style="background:linear-gradient(90deg,#fff8f0 0%,#fff3f5 100%);border:1.5px dashed #D4AF37;">
                                <i class="bi bi-tags-fill fs-4 text-gold"></i>
                                <div>
                                    <div class="small text-muted mb-1">Live Rate Preview</div>
                                    <span class="fw-bold" style="color:#800020;font-size:1.1rem;" id="bhRatePreview">₱1,200.00 — ₱2,500.00 / month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Amenities -->
                    <div class="mb-3 pb-2 border-bottom d-flex align-items-center gap-2">
                        <span class="badge text-white fw-semibold px-3 py-2" style="background:#800020;font-size:.8rem;border-radius:20px;">
                            <i class="bi bi-stars me-1"></i>Amenities & Facilities
                        </span>
                    </div>

                    <!-- Amenity Quick Toggles -->
                    <div class="mb-2">
                        <small class="text-muted">Quick add amenities:</small>
                        <div class="d-flex flex-wrap gap-2 mt-2" id="amenityChips">
                            <?php
                            $amenityOptions = ['Aircon','WiFi','Hot Shower','CCTV','Study Room','Laundry Area',
                                'Parking','Canteen','Common Sala','Fire Extinguisher','Water Heater','Generator'];
                            foreach ($amenityOptions as $am):
                            ?>
                            <button type="button" class="btn btn-outline-secondary btn-sm amenity-chip rounded-pill"
                                data-amenity="<?= e($am) ?>"
                                onclick="toggleAmenityChip(this)">
                                <?= e($am) ?>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-marsu-burgundy" for="bhAmenities">
                            <i class="bi bi-list-check me-1"></i>Amenities (comma-separated or free text)
                        </label>
                        <textarea class="form-control" id="bhAmenities" name="amenities" rows="2"
                            placeholder="e.g. Aircon, WiFi, Hot Shower, CCTV..."></textarea>
                    </div>

                </div><!-- /modal-body -->

                <div class="modal-footer border-0 px-4 pb-4 pt-2" style="background:#fdf7f8;">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-sm px-4 fw-semibold shadow-sm text-white" style="background:linear-gradient(135deg,#800020,#4e0013);">
                        <i class="bi bi-buildings-fill me-1"></i>Register Facility
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
.amenity-chip.active {
    background: #800020 !important;
    color: #fff !important;
    border-color: #800020 !important;
}
</style>
<script>
(function () {
    // Live rate preview
    function updateBhRatePreview() {
        var min = parseFloat(document.getElementById('bhRateMin').value) || 0;
        var max = parseFloat(document.getElementById('bhRateMax').value) || 0;
        document.getElementById('bhRatePreview').textContent =
            '₱' + min.toLocaleString('en-PH', {minimumFractionDigits:2}) +
            ' — ₱' + max.toLocaleString('en-PH', {minimumFractionDigits:2}) + ' / month';
    }
    var rMin = document.getElementById('bhRateMin');
    var rMax = document.getElementById('bhRateMax');
    if (rMin) rMin.addEventListener('input', updateBhRatePreview);
    if (rMax) rMax.addEventListener('input', updateBhRatePreview);

    // Bootstrap 5 form validation
    var form = document.getElementById('newBoardingHouseForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    }
})();

function toggleAmenityChip(btn) {
    btn.classList.toggle('active');
    var ta = document.getElementById('bhAmenities');
    var amenity = btn.getAttribute('data-amenity');
    var items = ta.value ? ta.value.split(',').map(function(s){return s.trim();}).filter(Boolean) : [];
    var idx = items.indexOf(amenity);
    if (btn.classList.contains('active')) {
        if (idx === -1) items.push(amenity);
    } else {
        if (idx !== -1) items.splice(idx, 1);
    }
    ta.value = items.join(', ');
}
</script>

<!-- ========================================================================= -->
<!-- MODAL: ADD ROOM UNIT TO INVENTORY                                          -->
<!-- ========================================================================= -->
<div class="modal fade" id="newRoomModal" tabindex="-1" aria-labelledby="newRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color:#800020;">
                <h5 class="modal-title font-weight-bold" id="newRoomModalLabel">
                    <i class="bi bi-door-open-fill me-2 text-gold"></i>Add Room Unit to Inventory
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= url('housing/rooms/create') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Boarding House Facility <span class="text-danger">*</span></label>
                        <select name="boarding_house_id" class="form-select form-select-sm" required>
                            <option value="">-- Select Boarding House --</option>
                            <?php foreach ($boardingHouses ?? [] as $bh): ?>
                                <option value="<?= (int)$bh['id'] ?>"><?= e($bh['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room Number / Tag <span class="text-danger">*</span></label>
                            <input type="text" name="room_number" class="form-control form-control-sm" required placeholder="e.g. Room 205">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Room Classification</label>
                            <select name="room_type" class="form-select form-select-sm">
                                <option value="Single">Single (1 Bed)</option>
                                <option value="Double" selected>Double (2 Beds)</option>
                                <option value="Triple">Triple (3 Beds)</option>
                                <option value="Quad">Quad (4 Beds)</option>
                                <option value="Dormitory">Dormitory (6+ Beds)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Bed Capacity</label>
                            <input type="number" name="capacity" min="1" max="10" value="2" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Floor Level</label>
                            <input type="text" name="floor" value="1st Floor" class="form-control form-control-sm" placeholder="e.g. 2nd Floor">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Monthly Rate (₱)</label>
                            <input type="number" step="0.01" name="monthly_rate" value="1500.00" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Amenities & Room Inclusions</label>
                        <input type="text" name="amenities" class="form-control form-control-sm" value="Wall Fan, Study Desk, Locker, Foam Mattress" placeholder="e.g. Aircon, Fan, Balcony">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-save me-1"></i>Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- JAVASCRIPT LOGIC (Native JS - Zero jQuery - MarSU Standard)               -->
<!-- ========================================================================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. View Mode Switcher: Gallery Folders vs. Table View
    const btnGalleryView = document.getElementById('btnShowGalleryView');
    const btnTableView = document.getElementById('btnShowTableView');
    const galleryViewContainer = document.getElementById('galleryViewContainer');
    const tableViewContainer = document.getElementById('tableViewContainer');

    if (btnGalleryView && btnTableView) {
        btnGalleryView.addEventListener('click', function () {
            btnGalleryView.classList.add('active');
            btnTableView.classList.remove('active');
            galleryViewContainer.style.display = 'block';
            tableViewContainer.style.display = 'none';
        });

        btnTableView.addEventListener('click', function () {
            btnTableView.classList.add('active');
            btnGalleryView.classList.remove('active');
            galleryViewContainer.style.display = 'none';
            tableViewContainer.style.display = 'block';
        });
    }

    // 2. Floor Gallery Folder Selection
    const folderCards = document.querySelectorAll('.folder-card');
    const roomWrappers = document.querySelectorAll('.room-card-wrapper');
    const breadcrumb = document.getElementById('activeFolderBreadcrumb');
    const subtitle = document.getElementById('galleryCountSubtitle');

    folderCards.forEach(function (card) {
        card.addEventListener('click', function () {
            folderCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            const selectedFloor = this.dataset.floor.toLowerCase().trim();
            let visibleCount = 0;

            roomWrappers.forEach(function (wrapper) {
                const wrapperFloor = wrapper.dataset.floor.toLowerCase().trim();
                if (selectedFloor === 'all' || wrapperFloor.includes(selectedFloor) || selectedFloor.includes(wrapperFloor)) {
                    wrapper.style.display = '';
                    visibleCount++;
                } else {
                    wrapper.style.display = 'none';
                }
            });

            if (breadcrumb) {
                const folderName = this.querySelector('.fw-bold') ? this.querySelector('.fw-bold').textContent : 'Floor';
                breadcrumb.innerHTML = `Showing: <strong>${folderName}</strong> (${visibleCount} Units)`;
            }
            if (subtitle) {
                subtitle.textContent = `Showing ${visibleCount} room units with verified blueprints and photography`;
            }
        });
    });

    // 3. Live Search Filtering (Works for both Gallery and Table)
    const searchInput = document.getElementById('roomSearchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();

            // Filter Gallery Cards
            let galleryCount = 0;
            roomWrappers.forEach(function (wrapper) {
                const text = wrapper.textContent.toLowerCase();
                if (!term || text.includes(term)) {
                    wrapper.style.display = '';
                    galleryCount++;
                } else {
                    wrapper.style.display = 'none';
                }
            });
            if (subtitle) {
                subtitle.textContent = `Search results: ${galleryCount} room units matching "${term}"`;
            }

            // Filter Table Rows
            const tableRows = document.querySelectorAll('#roomTable tbody tr');
            tableRows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = (!term || text.includes(term)) ? '' : 'none';
            });
        });
    }

    // 4. Room Photo Gallery (real photos uploaded by the housing admin)
    const galleryModalEl = document.getElementById('roomGalleryModal');
    const galleryModal = galleryModalEl ? new bootstrap.Modal(galleryModalEl) : null;
    const uploadModalEl = document.getElementById('uploadPhotoModal');
    const ROOM_PHOTOS = <?= json_encode($photosByRoom ?: new \stdClass(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES) ?>;
    const CAT_LABELS = {
        bed: 'Bed Space & Room Interior',
        study: 'Study Desk & Lockers',
        bath: 'Restroom & Fixtures',
        plan: '2D Floor Plan & Evacuation Route',
        safety: 'Electric Submeter & Safety Equipment'
    };
    const MAX_PHOTO_BYTES = 5 * 1024 * 1024;

    const stage = document.getElementById('galleryMainStage');
    const thumbsRow = document.getElementById('galleryThumbnailsRow');
    const titleEl = document.getElementById('stagePhotoTitle');
    const descEl = document.getElementById('stagePhotoDesc');
    const deleteForm = document.getElementById('stageDeleteWrap');
    const deleteIdInput = document.getElementById('deletePhotoId');
    const state = { roomId: null, cat: 'all', photos: [], index: 0 };

    function visiblePhotos() {
        return state.photos.filter(function (p) { return state.cat === 'all' || p.category === state.cat; });
    }

    function renderTabCounts() {
        document.querySelectorAll('.gallery-cat-btn').forEach(function (b) {
            const c = b.dataset.cat;
            const n = c === 'all' ? state.photos.length : state.photos.filter(function (p) { return p.category === c; }).length;
            let badge = b.querySelector('.cat-count');
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'cat-count badge rounded-pill bg-secondary ms-1';
                b.appendChild(badge);
            }
            badge.textContent = n;
        });
    }

    function renderGallery() {
        const list = visiblePhotos();
        if (state.index >= list.length) state.index = 0;
        stage.innerHTML = '';
        thumbsRow.innerHTML = '';

        if (!list.length) {
            stage.innerHTML = '<div class="text-center text-white-50 p-4"><i class="bi bi-image fs-1 d-block mb-2"></i>' +
                '<div class="fw-bold text-white">No photos yet</div>' +
                '<div class="small">' + (state.photos.length ? 'There are no photos in this category.' : 'No photo has been uploaded for this room yet.') + '</div></div>';
            titleEl.textContent = 'No photo selected';
            descEl.textContent = '';
            if (deleteForm) deleteForm.classList.add('d-none');
            thumbsRow.innerHTML = '<span class="small text-muted">Uploaded photos will appear here.</span>';
            return;
        }

        const cur = list[state.index];
        const img = document.createElement('img');
        img.src = cur.url;
        img.alt = cur.caption || CAT_LABELS[cur.category] || 'Room photo';
        img.className = 'gallery-stage-img';
        stage.appendChild(img);

        titleEl.textContent = CAT_LABELS[cur.category] || 'Room photo';
        descEl.textContent = (cur.caption ? '• ' + cur.caption + '  ' : '') + '• Uploaded ' + cur.date;
        if (deleteForm && deleteIdInput) {
            deleteIdInput.value = cur.id;
            deleteForm.classList.remove('d-none');
        }

        list.forEach(function (p, idx) {
            const t = document.createElement('button');
            t.type = 'button';
            t.className = 'gallery-thumb-btn' + (idx === state.index ? ' active' : '');
            t.title = CAT_LABELS[p.category] || '';
            const ti = document.createElement('img');
            ti.src = p.url;
            ti.alt = '';
            t.appendChild(ti);
            t.addEventListener('click', function () { state.index = idx; renderGallery(); });
            thumbsRow.appendChild(t);
        });
    }

    function setActiveTab(cat) {
        document.querySelectorAll('.gallery-cat-btn').forEach(function (b) {
            const on = b.dataset.cat === cat;
            b.classList.toggle('btn-dark', on);
            b.classList.toggle('active', on);
            b.classList.toggle('btn-outline-dark', !on);
        });
    }

    function openGallery(btn) {
        const d = btn.dataset;
        const roomNumber = d.roomNumber || 'Room Unit';
        const house = d.house || '';
        const floor = d.floor || '';
        const type = d.type || '';

        const titleHolder = document.getElementById('galleryModalTitle');
        titleHolder.textContent = '';
        const icon = document.createElement('i');
        icon.className = 'bi bi-images text-gold me-2';
        titleHolder.appendChild(icon);
        titleHolder.appendChild(document.createTextNode(roomNumber + ' Photo Gallery'));
        document.getElementById('galleryModalSubtitle').textContent = house + ' • ' + floor + ' • ' + type + ' Occupancy';
        document.getElementById('modalRoomRent').textContent = '₱' + (d.rent || '0.00');
        document.getElementById('modalRoomCapacity').textContent = type + ' Occupancy (' + (d.capacity || 0) + ' Beds Total • ' + (d.occupied || 0) + ' Residing)';
        document.getElementById('modalRoomFloor').textContent = floor;
        document.getElementById('modalRoomType').textContent = type;

        const amContainer = document.getElementById('modalRoomAmenities');
        amContainer.innerHTML = '';
        (d.amenities || '').split(',').forEach(function (am) {
            if (am.trim()) {
                const sp = document.createElement('span');
                sp.className = 'badge bg-light text-dark border';
                sp.textContent = am.trim();
                amContainer.appendChild(sp);
            }
        });

        state.roomId = parseInt(d.roomId, 10);
        state.photos = ROOM_PHOTOS[state.roomId] || [];
        state.cat = 'all';
        state.index = 0;
        setActiveTab('all');
        renderTabCounts();
        renderGallery();

        const targetSelect = document.getElementById('uploadTargetRoom');
        if (targetSelect) targetSelect.value = String(state.roomId);

        if (galleryModal) galleryModal.show();
    }

    document.querySelectorAll('.btn-open-gallery').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            openGallery(this);
        });
    });

    // 5. Category tabs inside the gallery modal
    document.querySelectorAll('.gallery-cat-btn').forEach(function (catBtn) {
        catBtn.addEventListener('click', function () {
            state.cat = this.dataset.cat;
            state.index = 0;
            setActiveTab(state.cat);
            renderGallery();
        });
    });

    // 6. Upload: pre-select the room, preview the chosen photo, validate size, then post for real
    document.querySelectorAll('.btn-quick-upload').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const targetSelect = document.getElementById('uploadTargetRoom');
            if (targetSelect && this.dataset.roomId) targetSelect.value = this.dataset.roomId;
        });
    });

    const galleryUploadBtn = document.getElementById('galleryUploadBtn');
    if (galleryUploadBtn && galleryModalEl && uploadModalEl) {
        galleryUploadBtn.addEventListener('click', function () {
            const targetSelect = document.getElementById('uploadTargetRoom');
            if (targetSelect && state.roomId) targetSelect.value = String(state.roomId);
            galleryModalEl.addEventListener('hidden.bs.modal', function () {
                bootstrap.Modal.getOrCreateInstance(uploadModalEl).show();
            }, { once: true });
            galleryModal.hide();
        });
    }

    const uploadInput = document.getElementById('uploadFileInput');
    const previewContainer = document.getElementById('uploadPreviewContainer');
    const imagePreview = document.getElementById('uploadImagePreview');
    const fileInfo = document.getElementById('uploadFileInfo');
    const uploadForm = document.getElementById('uploadPhotoForm');
    const uploadSubmit = document.getElementById('uploadSubmitBtn');

    if (uploadInput) {
        uploadInput.addEventListener('change', function () {
            const files = Array.from(this.files || []);
            if (!files.length) {
                previewContainer.style.display = 'none';
                return;
            }
            const first = files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(first);
            const tooBig = files.filter(function (f) { return f.size > MAX_PHOTO_BYTES; });
            fileInfo.className = 'small mt-1 ' + (tooBig.length ? 'text-danger' : 'text-muted');
            fileInfo.textContent = files.length + ' photo(s) selected • ' + first.name + ' (' + (first.size / 1024).toFixed(0) + ' KB)' +
                (tooBig.length ? ' — ' + tooBig.length + ' file(s) exceed the 5 MB limit' : '');
        });
    }

    if (uploadForm) {
        uploadForm.addEventListener('submit', function (e) {
            const files = Array.from(uploadInput && uploadInput.files ? uploadInput.files : []);
            if (!files.length || files.some(function (f) { return f.size > MAX_PHOTO_BYTES; })) {
                e.preventDefault();
                fileInfo.className = 'small mt-1 text-danger';
                fileInfo.textContent = files.length ? 'Each photo must be 5 MB or smaller.' : 'Please choose at least one photo.';
                previewContainer.style.display = 'block';
                return;
            }
            if (uploadSubmit) {
                uploadSubmit.disabled = true;
                uploadSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Uploading...';
            }
        });
    }

    // 7. After an upload/removal the server redirects with ?open_room=ID: re-open that room's gallery
    const openRoomParam = new URLSearchParams(window.location.search).get('open_room');
    if (openRoomParam) {
        const target = document.querySelector('.btn-open-gallery[data-room-id="' + openRoomParam.replace(/[^0-9]/g, '') + '"]');
        if (target) openGallery(target);
    }
});
</script>

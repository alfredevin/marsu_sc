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
    background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.room-preview-stage svg {
    width: 100%;
    height: 100%;
    transition: transform 0.3s ease;
}

.room-gallery-card:hover .room-preview-stage svg {
    transform: scale(1.04);
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

.gallery-stage-box svg {
    max-height: 420px;
    width: 100%;
    height: 100%;
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

.gallery-thumb-btn svg {
    width: 100%;
    height: 100%;
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
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Inventory
        </button>
        <button class="btn btn-outline-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
            <i class="bi bi-camera me-1"></i>Upload Photo
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
                        $photoCount = $r['photo_count'] ?? 5;
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
                                <!-- Interactive SVG Vector Blueprint / Room Illustration -->
                                <svg viewBox="0 0 320 180" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="bgGrad_<?= (int)$r['id'] ?>" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#1e1b4b"/>
                                            <stop offset="100%" stop-color="#0f172a"/>
                                        </linearGradient>
                                        <linearGradient id="bedGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#D4AF37"/>
                                            <stop offset="100%" stop-color="#f59e0b"/>
                                        </linearGradient>
                                    </defs>
                                    <!-- Room Boundary Outline -->
                                    <rect width="320" height="180" fill="url(#bgGrad_<?= (int)$r['id'] ?>)"/>
                                    <!-- Architectural Grid Lines -->
                                    <path d="M 0 45 L 320 45 M 0 90 L 320 90 M 0 135 L 320 135 M 80 0 L 80 180 M 160 0 L 160 180 M 240 0 L 240 180" stroke="#334155" stroke-width="0.5" stroke-dasharray="3,3" opacity="0.4"/>
                                    <!-- Outer Room Walls -->
                                    <rect x="20" y="15" width="280" height="150" fill="#0f172a" stroke="#800020" stroke-width="2.5" rx="6"/>
                                    <!-- Window / Light Glow -->
                                    <rect x="110" y="15" width="100" height="4" fill="#38bdf8"/>
                                    <path d="M 110 19 L 90 90 L 230 90 L 210 19 Z" fill="#38bdf8" opacity="0.08"/>
                                    <!-- Door Swing Arc -->
                                    <path d="M 20 135 A 30 30 0 0 1 50 165" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-dasharray="2,2"/>
                                    <line x1="20" y1="135" x2="20" y2="165" stroke="#D4AF37" stroke-width="2"/>
                                    
                                    <!-- Furniture Layout depending on Room Type -->
                                    <?php if ($roomType === 'Single'): ?>
                                        <!-- Single Bed -->
                                        <rect x="35" y="30" width="85" height="55" rx="4" fill="#1e293b" stroke="#D4AF37" stroke-width="1.5"/>
                                        <rect x="38" y="33" width="22" height="49" rx="3" fill="#cbd5e1" opacity="0.8"/>
                                        <rect x="65" y="33" width="52" height="49" rx="2" fill="url(#bedGrad)" opacity="0.85"/>
                                        <!-- Study Desk & Chair -->
                                        <rect x="190" y="30" width="90" height="40" rx="3" fill="#334155" stroke="#94a3b8" stroke-width="1"/>
                                        <circle cx="235" cy="85" r="12" fill="#475569" stroke="#cbd5e1" stroke-width="1"/>
                                        <text x="235" y="55" fill="#f8fafc" font-size="10" font-family="sans-serif" text-anchor="middle">Study Hub</text>
                                    <?php elseif ($roomType === 'Double'): ?>
                                        <!-- Twin Bed 1 -->
                                        <rect x="35" y="30" width="75" height="48" rx="4" fill="#1e293b" stroke="#D4AF37" stroke-width="1.5"/>
                                        <rect x="38" y="33" width="18" height="42" rx="2" fill="#cbd5e1" opacity="0.8"/>
                                        <rect x="60" y="33" width="47" height="42" rx="2" fill="url(#bedGrad)" opacity="0.85"/>
                                        <!-- Twin Bed 2 -->
                                        <rect x="35" y="95" width="75" height="48" rx="4" fill="#1e293b" stroke="#D4AF37" stroke-width="1.5"/>
                                        <rect x="38" y="98" width="18" height="42" rx="2" fill="#cbd5e1" opacity="0.8"/>
                                        <rect x="60" y="98" width="47" height="42" rx="2" fill="url(#bedGrad)" opacity="0.85"/>
                                        <!-- Study Desks Row -->
                                        <rect x="200" y="35" width="80" height="35" rx="3" fill="#334155" stroke="#94a3b8" stroke-width="1"/>
                                        <rect x="200" y="90" width="80" height="35" rx="3" fill="#334155" stroke="#94a3b8" stroke-width="1"/>
                                        <text x="240" y="56" fill="#f8fafc" font-size="9" font-family="sans-serif" text-anchor="middle">Desk A</text>
                                        <text x="240" y="112" fill="#f8fafc" font-size="9" font-family="sans-serif" text-anchor="middle">Desk B</text>
                                    <?php else: ?>
                                        <!-- Quad Bunk 1 -->
                                        <rect x="35" y="28" width="85" height="46" rx="4" fill="#1e293b" stroke="#D4AF37" stroke-width="1.5"/>
                                        <text x="77" y="55" fill="#f8fafc" font-size="9" font-family="sans-serif" text-anchor="middle">Bunk A (1 & 2)</text>
                                        <!-- Quad Bunk 2 -->
                                        <rect x="35" y="100" width="85" height="46" rx="4" fill="#1e293b" stroke="#D4AF37" stroke-width="1.5"/>
                                        <text x="77" y="127" fill="#f8fafc" font-size="9" font-family="sans-serif" text-anchor="middle">Bunk B (3 & 4)</text>
                                        <!-- Individual Lockers Row -->
                                        <rect x="195" y="35" width="85" height="95" rx="3" fill="#334155" stroke="#94a3b8" stroke-width="1"/>
                                        <text x="237" y="85" fill="#f8fafc" font-size="9" font-family="sans-serif" text-anchor="middle">4 Lockers</text>
                                    <?php endif; ?>

                                    <!-- Room Badge Tag -->
                                    <rect x="115" y="145" width="90" height="16" rx="3" fill="#800020" opacity="0.9"/>
                                    <text x="160" y="157" fill="#ffffff" font-size="9" font-weight="bold" font-family="sans-serif" text-anchor="middle"><?= e($r['room_number']) ?> Plan</text>
                                </svg>

                                <!-- Badge Top Left: Floor -->
                                <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75 text-white border border-secondary">
                                    <i class="bi bi-layers me-1 text-gold"></i><?= e($floor) ?>
                                </span>

                                <!-- Badge Top Right: Vacancy Status -->
                                <span class="position-absolute top-0 end-0 m-2 badge <?= $isFull ? 'bg-danger' : 'bg-success' ?> shadow-sm">
                                    <?= $isFull ? 'Full Occupancy' : ($vacant . ' Bed Vacant') ?>
                                </span>

                                <!-- Badge Bottom Left: Photo Gallery Count -->
                                <span class="position-absolute bottom-0 start-0 m-2 badge bg-black bg-opacity-70 text-white">
                                    <i class="bi bi-camera me-1 text-gold"></i><?= $photoCount ?> Photos
                                </span>

                                <!-- Badge Bottom Right: Blueprint Ready -->
                                <span class="position-absolute bottom-0 end-0 m-2 badge bg-black bg-opacity-70 text-info">
                                    <i class="bi bi-compass me-1"></i>2D Blueprint
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
            <div class="modal-header bg-marsu text-white py-3">
                <div>
                    <h5 class="modal-title font-weight-bold mb-0" id="galleryModalTitle">
                        <i class="bi bi-images text-gold me-2"></i>Room 101 Photo Gallery & Floor Plan
                    </h5>
                    <small class="text-white-50" id="galleryModalSubtitle">Villa Marinduque Dorm • 1st Floor • Double Occupancy</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="row g-3">
                    <!-- Left Column: Gallery Stage & Photo Switcher -->
                    <div class="col-lg-8">
                        <!-- Category Switcher Tabs -->
                        <div class="d-flex flex-wrap gap-2 mb-2" id="galleryCategoryTabs">
                            <button type="button" class="btn btn-sm btn-dark active gallery-cat-btn" data-cat="all">
                                <i class="bi bi-grid-fill me-1 text-gold"></i>All Angles
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark gallery-cat-btn" data-cat="bed">
                                <i class="bi bi-door-open me-1"></i>Bed & Room
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark gallery-cat-btn" data-cat="study">
                                <i class="bi bi-book me-1"></i>Study Hub
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark gallery-cat-btn" data-cat="bath">
                                <i class="bi bi-droplet me-1"></i>Restroom
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark gallery-cat-btn" data-cat="plan">
                                <i class="bi bi-compass me-1 text-info"></i>2D Blueprint
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark gallery-cat-btn" data-cat="safety">
                                <i class="bi bi-shield-check me-1 text-success"></i>Submeter & Safety
                            </button>
                        </div>

                        <!-- Main Interactive Photo Display Stage -->
                        <div class="gallery-stage-box shadow-sm mb-2" id="galleryMainStage">
                            <!-- Injected SVG / Canvas -->
                        </div>

                        <!-- Photo Caption Bar -->
                        <div class="p-2 px-3 rounded bg-white border d-flex justify-content-between align-items-center flex-wrap gap-2 small mb-3">
                            <div>
                                <span class="fw-bold text-dark" id="stagePhotoTitle">Bed Space & Layout Perspective</span>
                                <span class="text-muted ms-2" id="stagePhotoDesc">• 4-inch Uratex foam mattress, individual reading light, locker</span>
                            </div>
                            <span class="badge bg-success-subtle text-success border">
                                <i class="bi bi-patch-check-fill me-1"></i>OSAS Verified Photo
                            </span>
                        </div>

                        <!-- Thumbnails Selector Strip -->
                        <div>
                            <div class="small fw-semibold text-muted text-uppercase mb-1" style="font-size: 11px;">GALLERY THUMBNAILS & ANGLES (CLICK TO PREVIEW):</div>
                            <div class="d-flex gap-2 overflow-auto py-1" id="galleryThumbnailsRow">
                                <!-- Thumbnails injected via JS -->
                            </div>
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
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                        <span class="text-muted">Dedicated Submeter:</span>
                                        <span class="fw-bold text-dark text-end" id="modalRoomSubmeter">Verified (ID: MSU-SUB-01)</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                        <span class="text-muted">Safety Inspection:</span>
                                        <span class="badge bg-success-subtle text-success text-end">Grade A+ (Certified)</span>
                                    </li>
                                    <li class="mb-2 pb-2 border-bottom">
                                        <span class="text-muted d-block mb-1">Included Amenities:</span>
                                        <div class="d-flex flex-wrap gap-1" id="modalRoomAmenities">
                                            <span class="badge bg-light text-dark border">Aircon</span>
                                            <span class="badge bg-light text-dark border">Study Desk</span>
                                        </div>
                                    </li>
                                </ul>

                                <!-- Safety Compliance Box -->
                                <div class="p-2 px-3 rounded bg-light border small text-muted">
                                    <div class="fw-semibold text-dark mb-1">
                                        <i class="bi bi-shield-check text-success me-1"></i>CHED & OSAS Housing Compliance
                                    </div>
                                    <div style="font-size: 11px;">
                                        Equipped with working smoke detector, emergency egress window, and 10-lb dry chemical fire extinguisher within 5 meters.
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                                    <i class="bi bi-printer me-1"></i>Print Dossier
                                </button>
                                <button type="button" class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                                    <i class="bi bi-camera me-1"></i>Upload Photo
                                </button>
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
            <div class="modal-header bg-marsu text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0" id="uploadPhotoModalLabel">
                    <i class="bi bi-camera-fill text-gold me-2"></i>Upload Room & Floor Photo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadPhotoForm">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Target Room Unit <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="uploadTargetRoom" required>
                            <?php foreach ($activeRooms as $rm): ?>
                                <option value="<?= e($rm['room_number']) ?>">
                                    <?= e($rm['room_number']) ?> (<?= e($rm['floor'] ?? '1st Floor') ?> • <?= e($rm['house_name'] ?? 'Villa Marinduque') ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Photo Angle / Category <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="uploadPhotoCategory" required>
                            <option value="Bed Space & Living Layout">🛏️ Bed Space & Room Interior</option>
                            <option value="Study Desk & Workstation">📚 Study Desk & Storage Lockers</option>
                            <option value="Ensuite Bathroom / Restroom">🚿 Ensuite Restroom & Fixtures</option>
                            <option value="2D Floor Plan Blueprint">🗺️ 2D Floor Plan & Evacuation Route</option>
                            <option value="Electric Submeter & Safety Equipment">🔌 Electric Submeter & Safety Gear</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Photo File (JPG, PNG) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm" id="uploadFileInput" accept="image/*" required>
                        <div class="form-text">Choose a photo from your local files to attach to this room's gallery folder.</div>
                    </div>

                    <!-- Local Image Preview Area -->
                    <div id="uploadPreviewContainer" class="p-2 border rounded bg-light text-center mb-3" style="display: none;">
                        <img id="uploadImagePreview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 180px;">
                        <div class="small text-muted mt-1" id="uploadFileInfo"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Caption / Verification Notes</label>
                        <input type="text" class="form-control form-control-sm" id="uploadPhotoCaption" placeholder="e.g. Clean double deck with sanitized mattress, verified 2026">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm px-3 shadow-sm">
                        <i class="bi bi-cloud-arrow-up me-1"></i>Save to Room Gallery
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: ADD ROOM UNIT TO INVENTORY                                          -->
<!-- ========================================================================= -->
<div class="modal fade" id="newRoomModal" tabindex="-1" aria-labelledby="newRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-marsu text-white">
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

    // 4. Room Photo & Blueprint Gallery Modal Data Generator
    const galleryModalEl = document.getElementById('roomGalleryModal');
    const galleryModal = galleryModalEl ? new bootstrap.Modal(galleryModalEl) : null;

    // SVG Generators for Room Angles & Blueprints
    function getGallerySVG(category, roomNumber, roomType) {
        if (category === 'plan') {
            // 2D Architectural Blueprint
            return `
                <svg viewBox="0 0 540 320" xmlns="http://www.w3.org/2000/svg">
                    <rect width="540" height="320" fill="#0f172a"/>
                    <!-- Blueprint Grid -->
                    <defs>
                        <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                            <path d="M 20 0 L 0 0 0 20" fill="none" stroke="#1e293b" stroke-width="0.8"/>
                        </pattern>
                    </defs>
                    <rect width="540" height="320" fill="url(#grid)" />
                    <!-- Room Boundaries -->
                    <rect x="40" y="30" width="460" height="260" fill="none" stroke="#38bdf8" stroke-width="3" rx="4"/>
                    <!-- Hallway -->
                    <rect x="40" y="250" width="460" height="40" fill="#1e293b" opacity="0.6"/>
                    <text x="270" y="275" fill="#94a3b8" font-size="12" font-family="monospace" text-anchor="middle">MAIN CORRIDOR / EGRESS ROUTE</text>
                    <!-- Door & Swing Arc -->
                    <path d="M 240 250 A 40 40 0 0 1 280 290" fill="none" stroke="#f59e0b" stroke-width="2" stroke-dasharray="3,3"/>
                    <line x1="240" y1="250" x2="240" y2="290" stroke="#f59e0b" stroke-width="3"/>
                    <!-- Window Wall -->
                    <rect x="180" y="27" width="180" height="6" fill="#38bdf8"/>
                    <!-- Beds -->
                    <rect x="60" y="50" width="130" height="75" rx="4" fill="#1e293b" stroke="#38bdf8" stroke-width="1.5"/>
                    <rect x="65" y="55" width="28" height="65" rx="3" fill="#cbd5e1" opacity="0.8"/>
                    <text x="135" y="93" fill="#38bdf8" font-size="12" font-family="monospace" text-anchor="middle">BED A (LOWER/UPPER)</text>
                    
                    <rect x="60" y="150" width="130" height="75" rx="4" fill="#1e293b" stroke="#38bdf8" stroke-width="1.5"/>
                    <rect x="65" y="155" width="28" height="65" rx="3" fill="#cbd5e1" opacity="0.8"/>
                    <text x="135" y="193" fill="#38bdf8" font-size="12" font-family="monospace" text-anchor="middle">BED B (LOWER/UPPER)</text>

                    <!-- Workstations -->
                    <rect x="360" y="50" width="120" height="60" rx="3" fill="#1e293b" stroke="#38bdf8" stroke-width="1.5"/>
                    <text x="420" y="85" fill="#94a3b8" font-size="11" font-family="monospace" text-anchor="middle">STUDY WORKSPACE</text>
                    <!-- Wardrobes -->
                    <rect x="360" y="135" width="120" height="85" rx="3" fill="#1e293b" stroke="#38bdf8" stroke-width="1.5"/>
                    <text x="420" y="180" fill="#94a3b8" font-size="11" font-family="monospace" text-anchor="middle">LOCKERS & STORAGE</text>

                    <!-- Fire Exit Route -->
                    <path d="M 260 210 L 260 260" stroke="#22c55e" stroke-width="3" stroke-dasharray="4,4"/>
                    <text x="260" y="200" fill="#22c55e" font-size="11" font-family="monospace" font-weight="bold" text-anchor="middle">EXIT ➔</text>
                    
                    <!-- Title Block -->
                    <rect x="340" y="235" width="155" height="45" fill="#0f172a" stroke="#38bdf8" stroke-width="1"/>
                    <text x="350" y="252" fill="#38bdf8" font-size="10" font-family="monospace" font-weight="bold">${roomNumber} BLUEPRINT</text>
                    <text x="350" y="268" fill="#94a3b8" font-size="9" font-family="monospace">SCALE: 1:50 • OSAS APPROVED</text>
                </svg>
            `;
        } else if (category === 'study') {
            // Study Hub Perspective
            return `
                <svg viewBox="0 0 540 320" xmlns="http://www.w3.org/2000/svg">
                    <rect width="540" height="320" fill="#18181b"/>
                    <!-- Wooden Floor & Wall -->
                    <rect x="0" y="230" width="540" height="90" fill="#78350f" opacity="0.35"/>
                    <line x1="0" y1="230" x2="540" y2="230" stroke="#a16207" stroke-width="2"/>
                    <!-- Desk Table Surface -->
                    <rect x="100" y="150" width="340" height="18" rx="3" fill="#d97706"/>
                    <rect x="120" y="168" width="14" height="110" fill="#b45309"/>
                    <rect x="406" y="168" width="14" height="110" fill="#b45309"/>
                    <!-- Laptop on Desk -->
                    <rect x="230" y="105" width="80" height="45" rx="3" fill="#334155" stroke="#94a3b8" stroke-width="1.5"/>
                    <rect x="240" y="112" width="60" height="32" rx="1" fill="#38bdf8" opacity="0.85"/>
                    <rect x="220" y="148" width="100" height="4" rx="1" fill="#475569"/>
                    <!-- LED Study Lamp -->
                    <path d="M 140 150 L 140 85 L 180 75" fill="none" stroke="#f59e0b" stroke-width="4"/>
                    <path d="M 175 70 L 195 80 L 175 90 Z" fill="#d97706"/>
                    <path d="M 185 80 L 260 160 L 140 160 Z" fill="#fef08a" opacity="0.25"/>
                    <!-- Bookshelf on Wall -->
                    <rect x="130" y="40" width="280" height="10" fill="#b45309"/>
                    <rect x="145" y="18" width="16" height="22" fill="#ef4444"/>
                    <rect x="165" y="12" width="18" height="28" fill="#3b82f6"/>
                    <rect x="187" y="15" width="20" height="25" fill="#22c55e"/>
                    <text x="270" y="270" fill="#ffffff" font-size="14" font-weight="bold" font-family="sans-serif" text-anchor="middle">Dedicated Individual Study Station • High-Speed Fiber Wi-Fi</text>
                </svg>
            `;
        } else if (category === 'bath') {
            // Ensuite Bathroom
            return `
                <svg viewBox="0 0 540 320" xmlns="http://www.w3.org/2000/svg">
                    <rect width="540" height="320" fill="#0c4a6e"/>
                    <!-- Tiled Wall Pattern -->
                    <defs>
                        <pattern id="tile" width="25" height="25" patternUnits="userSpaceOnUse">
                            <rect width="25" height="25" fill="#0284c7" stroke="#38bdf8" stroke-width="0.7" opacity="0.3"/>
                        </pattern>
                    </defs>
                    <rect width="540" height="260" fill="url(#tile)"/>
                    <rect x="0" y="260" width="540" height="60" fill="#0369a1"/>
                    <!-- Shower Head with Water Spray -->
                    <path d="M 120 40 L 180 40 L 180 80" fill="none" stroke="#cbd5e1" stroke-width="6"/>
                    <ellipse cx="180" cy="80" rx="24" ry="10" fill="#94a3b8"/>
                    <!-- Water droplets -->
                    <path d="M 170 95 L 160 210 M 180 95 L 180 230 M 190 95 L 200 210" stroke="#bae6fd" stroke-width="2" stroke-dasharray="5,5"/>
                    <!-- Mirror & Sink Counter -->
                    <rect x="300" y="50" width="100" height="110" rx="8" fill="#e0f2fe" stroke="#38bdf8" stroke-width="3"/>
                    <rect x="270" y="180" width="160" height="25" rx="5" fill="#ffffff" stroke="#94a3b8" stroke-width="2"/>
                    <path d="M 335 180 A 15 15 0 0 0 365 180 Z" fill="#cbd5e1"/>
                    <text x="270" y="300" fill="#ffffff" font-size="14" font-weight="bold" font-family="sans-serif" text-anchor="middle">Private / Semi-Private Ensuite Bathroom Fixtures</text>
                </svg>
            `;
        } else if (category === 'safety') {
            // Electric Submeter & Fire Safety Gear
            return `
                <svg viewBox="0 0 540 320" xmlns="http://www.w3.org/2000/svg">
                    <rect width="540" height="320" fill="#18181b"/>
                    <!-- Panel Board Box -->
                    <rect x="80" y="50" width="180" height="220" rx="8" fill="#27272a" stroke="#71717a" stroke-width="3"/>
                    <!-- Digital Submeter Display -->
                    <rect x="105" y="80" width="130" height="50" rx="4" fill="#042f2e" stroke="#14b8a6" stroke-width="2"/>
                    <text x="170" y="112" fill="#2dd4bf" font-size="20" font-family="monospace" font-weight="bold" text-anchor="middle">0248.6 kWh</text>
                    <!-- Circuit Breakers -->
                    <rect x="110" y="150" width="30" height="50" rx="3" fill="#dc2626"/>
                    <rect x="155" y="150" width="30" height="50" rx="3" fill="#16a34a"/>
                    <rect x="200" y="150" width="30" height="50" rx="3" fill="#16a34a"/>
                    <text x="170" y="240" fill="#e4e4e7" font-size="11" font-weight="bold" font-family="sans-serif" text-anchor="middle">SUBMETER: ${roomNumber}</text>

                    <!-- Fire Extinguisher (Right) -->
                    <rect x="360" y="90" width="45" height="150" rx="20" fill="#dc2626" stroke="#991b1b" stroke-width="2"/>
                    <rect x="376" y="65" width="14" height="25" fill="#475569"/>
                    <path d="M 370 65 L 410 50 M 370 65 L 410 70" stroke="#1e293b" stroke-width="4"/>
                    <rect x="366" y="125" width="33" height="50" fill="#ffffff"/>
                    <text x="382" y="155" fill="#dc2626" font-size="11" font-weight="bold" font-family="sans-serif" text-anchor="middle">ABC</text>
                    <!-- Smoke Alarm -->
                    <circle cx="382" cy="270" r="22" fill="#f4f4f5" stroke="#a1a1aa" stroke-width="2"/>
                    <circle cx="382" cy="270" r="6" fill="#16a34a"/>
                    <text x="270" y="305" fill="#ffffff" font-size="13" font-weight="bold" font-family="sans-serif" text-anchor="middle">Calibrated Submeter & Certified Fire Safety Protection</text>
                </svg>
            `;
        } else {
            // Default: Bed Space & Room Interior
            return `
                <svg viewBox="0 0 540 320" xmlns="http://www.w3.org/2000/svg">
                    <rect width="540" height="320" fill="#0f172a"/>
                    <!-- Room Flooring -->
                    <rect x="0" y="210" width="540" height="110" fill="#334155" opacity="0.6"/>
                    <line x1="0" y1="210" x2="540" y2="210" stroke="#64748b" stroke-width="2"/>
                    <!-- Mahogany Bunk Bed Frame -->
                    <rect x="60" y="50" width="220" height="190" rx="6" fill="#78350f" stroke="#451a03" stroke-width="4"/>
                    <!-- Upper Deck Bed -->
                    <rect x="75" y="70" width="190" height="40" rx="3" fill="#cbd5e1"/>
                    <rect x="75" y="70" width="40" height="40" rx="3" fill="#94a3b8"/>
                    <rect x="120" y="75" width="140" height="30" rx="2" fill="#D4AF37"/>
                    <!-- Lower Deck Bed -->
                    <rect x="75" y="150" width="190" height="40" rx="3" fill="#cbd5e1"/>
                    <rect x="75" y="150" width="40" height="40" rx="3" fill="#94a3b8"/>
                    <rect x="120" y="155" width="140" height="30" rx="2" fill="#800020"/>
                    <!-- Bunk Ladder -->
                    <line x1="260" y1="50" x2="260" y2="240" stroke="#f59e0b" stroke-width="5"/>
                    <line x1="240" y1="90" x2="265" y2="90" stroke="#f59e0b" stroke-width="3"/>
                    <line x1="240" y1="130" x2="265" y2="130" stroke="#f59e0b" stroke-width="3"/>
                    <line x1="240" y1="170" x2="265" y2="170" stroke="#f59e0b" stroke-width="3"/>

                    <!-- Wardrobe Lockers on right -->
                    <rect x="340" y="60" width="140" height="180" rx="4" fill="#1e293b" stroke="#64748b" stroke-width="2"/>
                    <line x1="410" y1="60" x2="410" y2="240" stroke="#64748b" stroke-width="2"/>
                    <circle cx="400" cy="140" r="4" fill="#D4AF37"/>
                    <circle cx="420" cy="140" r="4" fill="#D4AF37"/>

                    <text x="270" y="280" fill="#ffffff" font-size="14" font-weight="bold" font-family="sans-serif" text-anchor="middle">${roomNumber} Interior • Sanitized Uratex Foam Mattress & Steel Lockers</text>
                </svg>
            `;
        }
    }

    // Bind Gallery Buttons
    document.querySelectorAll('.btn-open-gallery').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const d = this.dataset;

            const roomNumber = d.roomNumber || 'Room Unit';
            const house = d.house || 'Villa Marinduque Dorm';
            const floor = d.floor || '1st Floor';
            const type = d.type || 'Double';
            const rent = d.rent || '1,500.00';
            const capacity = d.capacity || '2';
            const occupied = d.occupied || '0';
            const amenities = d.amenities || 'Wi-Fi, Study Desk';

            // Populate Modal Header & Specs
            document.getElementById('galleryModalTitle').innerHTML = `<i class="bi bi-images text-gold me-2"></i>${roomNumber} Photo Gallery & Floor Plan`;
            document.getElementById('galleryModalSubtitle').textContent = `${house} • ${floor} • ${type} Occupancy`;
            document.getElementById('modalRoomRent').textContent = `₱${rent}`;
            document.getElementById('modalRoomCapacity').textContent = `${type} Occupancy (${capacity} Beds Total • ${occupied} Residing)`;
            document.getElementById('modalRoomFloor').textContent = floor;
            document.getElementById('modalRoomType').textContent = type;
            document.getElementById('modalRoomSubmeter').textContent = `MSU-SUB-${roomNumber.replace(/[^0-9]/g, '') || '01'} (Active)`;

            // Amenities Tags
            const amContainer = document.getElementById('modalRoomAmenities');
            amContainer.innerHTML = '';
            amenities.split(',').forEach(function (am) {
                if (am.trim()) {
                    const sp = document.createElement('span');
                    sp.className = 'badge bg-light text-dark border';
                    sp.textContent = am.trim();
                    amContainer.appendChild(sp);
                }
            });

            // Set Initial Stage Display
            const stage = document.getElementById('galleryMainStage');
            stage.innerHTML = getGallerySVG('bed', roomNumber, type);

            // Populate Thumbnails
            const thumbsContainer = document.getElementById('galleryThumbnailsRow');
            thumbsContainer.innerHTML = '';

            const angles = [
                { cat: 'bed', title: 'Bed Space & Room Interior' },
                { cat: 'study', title: 'Study Hub & Desk' },
                { cat: 'bath', title: 'Bathroom & Restroom' },
                { cat: 'plan', title: '2D Architectural Blueprint' },
                { cat: 'safety', title: 'Submeter & Safety Gear' }
            ];

            angles.forEach(function (ang, idx) {
                const thumbBtn = document.createElement('div');
                thumbBtn.className = 'gallery-thumb-btn ' + (idx === 0 ? 'active' : '');
                thumbBtn.dataset.cat = ang.cat;
                thumbBtn.dataset.title = ang.title;
                thumbBtn.title = ang.title;
                thumbBtn.innerHTML = getGallerySVG(ang.cat, roomNumber, type);

                thumbBtn.addEventListener('click', function () {
                    document.querySelectorAll('.gallery-thumb-btn').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    stage.innerHTML = getGallerySVG(ang.cat, roomNumber, type);
                    document.getElementById('stagePhotoTitle').textContent = ang.title;
                });

                thumbsContainer.appendChild(thumbBtn);
            });

            // Pre-select target room in Upload Modal as convenience
            const targetSelect = document.getElementById('uploadTargetRoom');
            if (targetSelect) {
                for (let i = 0; i < targetSelect.options.length; i++) {
                    if (targetSelect.options[i].value === roomNumber) {
                        targetSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            if (galleryModal) galleryModal.show();
        });
    });

    // 5. Category Tab Filtering inside Gallery Modal
    document.querySelectorAll('.gallery-cat-btn').forEach(function (catBtn) {
        catBtn.addEventListener('click', function () {
            document.querySelectorAll('.gallery-cat-btn').forEach(b => {
                b.classList.remove('btn-dark', 'active');
                b.classList.add('btn-outline-dark');
            });
            this.classList.remove('btn-outline-dark');
            this.classList.add('btn-dark', 'active');

            const cat = this.dataset.cat;
            const targetThumb = document.querySelector(`.gallery-thumb-btn[data-cat="${cat === 'all' ? 'bed' : cat}"]`);
            if (targetThumb) targetThumb.click();
        });
    });

    // 6. Photo Upload Preview & Simulated Upload
    const uploadInput = document.getElementById('uploadFileInput');
    const previewContainer = document.getElementById('uploadPreviewContainer');
    const imagePreview = document.getElementById('uploadImagePreview');
    const fileInfo = document.getElementById('uploadFileInfo');

    if (uploadInput) {
        uploadInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                    fileInfo.textContent = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    }

    const uploadForm = document.getElementById('uploadPhotoForm');
    if (uploadForm) {
        uploadForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const roomNum = document.getElementById('uploadTargetRoom').value;
            const category = document.getElementById('uploadPhotoCategory').value;

            // Find matching card and bump photo count
            const card = document.querySelector(`.room-card-wrapper[data-room="${roomNum}"]`);
            if (card) {
                const photoBadge = card.querySelector('.bi-camera');
                if (photoBadge && photoBadge.parentElement) {
                    const currentText = photoBadge.parentElement.textContent;
                    const num = parseInt(currentText.replace(/[^0-9]/g, '')) || 4;
                    photoBadge.parentElement.innerHTML = `<i class="bi bi-camera me-1 text-gold"></i>${num + 1} Photos`;
                }
            }

            // Close upload modal
            const uploadModalEl = document.getElementById('uploadPhotoModal');
            const uploadModal = bootstrap.Modal.getInstance(uploadModalEl);
            if (uploadModal) uploadModal.hide();

            // Success alert
            alert(`Photo for ${roomNum} (${category}) has been successfully attached to the Room Gallery folder!`);
            uploadForm.reset();
            if (previewContainer) previewContainer.style.display = 'none';
        });
    }
});
</script>

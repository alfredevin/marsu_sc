<!-- Room & Inventory Management View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-box-seam me-2 text-gold"></i>Room Inventory & Furniture Assets
        </h1>
        <p class="text-muted small mb-0">Track fixtures, beds, study desks, electric meters, and safety equipment assigned per room unit across boarding houses.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/rooms') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-door-open me-1"></i>Room Units
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newInventoryModal">
            <i class="bi bi-plus-lg me-1"></i>Add Inventory Item
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/rooms') ?>">
                <i class="bi bi-door-open me-1"></i>Rooms Directory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/roomandinventory') ?>">
                <i class="bi bi-box-seam me-1 text-gold"></i>Room & Inventory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/availabilitytracking') ?>">
                <i class="bi bi-calendar-check me-1"></i>Availability Tracking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/occupancymonitoring') ?>">
                <i class="bi bi-pie-chart me-1"></i>Occupancy Monitoring
            </a>
        </li>
    </ul>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Total Cataloged Items</div>
            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">186</div>
            <div class="small text-muted mt-1">Beds, desks, cabinets, appliances</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Good Condition</div>
            <div class="h3 font-weight-bold mb-0 text-success">168 Items</div>
            <div class="small text-muted mt-1">90.3% fully functional</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Needs Maintenance</div>
            <div class="h3 font-weight-bold mb-0 text-warning">14 Items</div>
            <div class="small text-muted mt-1">Pending repair or replacement</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Fire Extinguishers / Safety</div>
            <div class="h3 font-weight-bold mb-0 text-danger">12 Units</div>
            <div class="small text-muted mt-1">Inspected for BFP accreditation</div>
        </div>
    </div>
</div>

<!-- Inventory Table Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-list-check me-2 text-gold"></i>Room Property Inventory Registry
        </h6>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Filter inventory...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Item Tag / Code</th>
                        <th>Facility & Room</th>
                        <th>Item Classification</th>
                        <th>Quantity & Specs</th>
                        <th>Condition Status</th>
                        <th>Last Inspected</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">FUR-VM-102-01</td>
                        <td>
                            <div class="fw-semibold">Villa Marinduque Dorm</div>
                            <div class="small text-muted">Room 102</div>
                        </td>
                        <td>Double Deck Steel Bed Frame</td>
                        <td>1 Unit • 36x75 with URATEX foam</td>
                        <td><span class="badge bg-success-subtle text-success border border-success">Good Condition</span></td>
                        <td>Aug 12, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">FUR-VM-102-02</td>
                        <td>
                            <div class="fw-semibold">Villa Marinduque Dorm</div>
                            <div class="small text-muted">Room 102</div>
                        </td>
                        <td>Individual Study Desks & Chairs</td>
                        <td>2 Sets • Wood & Metal</td>
                        <td><span class="badge bg-success-subtle text-success border border-success">Good Condition</span></td>
                        <td>Aug 12, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">APP-GV-204-01</td>
                        <td>
                            <div class="fw-semibold">Greenview Boarding House</div>
                            <div class="small text-muted">Room 204</div>
                        </td>
                        <td>Wall Fan 16-inch</td>
                        <td>1 Unit • Standard 3-speed</td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning">Noisy Motor (Scheduled Repair)</span></td>
                        <td>Sep 05, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">SAF-SR-FL1-01</td>
                        <td>
                            <div class="fw-semibold">Sunrise Ladies Dormitory</div>
                            <div class="small text-muted">Hallway Ground Floor</div>
                        </td>
                        <td>Dry Chemical Fire Extinguisher (10 lbs)</td>
                        <td>1 Cylinder • BFP Compliant</td>
                        <td><span class="badge bg-success-subtle text-success border border-success">Inspected & Charged</span></td>
                        <td>Aug 28, 2026</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Inventory -->
<div class="modal fade" id="newInventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Register Room Inventory Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item Tag / Serial</label>
                        <input type="text" class="form-control" placeholder="e.g. FUR-101-BED" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Boarding House & Room</label>
                        <select class="form-select" required>
                            <option value="">Select Room...</option>
                            <option>Villa Marinduque - Room 101</option>
                            <option>Villa Marinduque - Room 102</option>
                            <option>Greenview - Room 204</option>
                            <option>Sunrise Dorm - Room 105</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item Category & Description</label>
                        <input type="text" class="form-control" placeholder="e.g. Steel Bunk Bed with Foam" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Condition Assessment</label>
                        <select class="form-select">
                            <option value="good">Brand New / Good Condition</option>
                            <option value="fair">Fair (Normal Wear)</option>
                            <option value="repair">Needs Repair</option>
                            <option value="condemned">Unusable / Replace</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Save Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

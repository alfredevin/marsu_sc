<!-- Housing Reports & Analytics View -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-file-earmark-bar-graph-fill me-2 text-gold"></i><?= e($title) ?>
        </h1>
        <p class="text-muted small mb-0">Comprehensive analytics, occupancy metrics, and LGU / BFP fire & safety accreditation records.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Directory
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Report
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing') ?>">
                <i class="bi bi-building me-1"></i>Boarding Houses
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/rooms') ?>">
                <i class="bi bi-door-open me-1"></i>Room Inventory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/tenants') ?>">
                <i class="bi bi-people me-1"></i>Tenant Profiles
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/reports') ?>">
                <i class="bi bi-file-earmark-bar-graph me-1 text-gold"></i>Reports & Stats
            </a>
        </li>
    </ul>
</div>

<!-- Report Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Overall Occupancy</div>
            <div class="h2 font-weight-bold mb-0 text-marsu-burgundy">85.4%</div>
            <div class="small text-muted mt-1">32/40 beds currently taken</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Safety Compliance</div>
            <div class="h2 font-weight-bold mb-0 text-success">100%</div>
            <div class="small text-muted mt-1">All passed BFP fire audit</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Active Facilities</div>
            <div class="h2 font-weight-bold mb-0 text-secondary">3 Units</div>
            <div class="small text-muted mt-1">Accredited by MarSU OSAS</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3 h-100 shadow-sm">
            <div class="text-muted small text-uppercase fw-bold">Avg Monthly Rent</div>
            <div class="h2 font-weight-bold mb-0 text-dark">₱1,650</div>
            <div class="small text-muted mt-1">Student-friendly ceiling</div>
        </div>
    </div>
</div>

<!-- Compliance Table -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 text-marsu-burgundy font-weight-bold">
            <i class="bi bi-shield-check me-2 text-gold"></i>Boarding House Safety & Accreditation Audit Table
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7 text-muted">
                <tr>
                    <th class="ps-3">Boarding Facility</th>
                    <th>Landlord / Operator</th>
                    <th>Barangay / Location</th>
                    <th>Fire Safety Permit</th>
                    <th>Sanitary Permit</th>
                    <th>Accreditation Rating</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="ps-3 fw-bold text-dark">Villa Marinduque Student Dorm</td>
                    <td>Maria Santos</td>
                    <td>Brgy. Mamarirlo, Santa Cruz</td>
                    <td><span class="badge bg-success"><i class="bi bi-check me-1"></i>BFP-2026-091</span></td>
                    <td><span class="badge bg-success"><i class="bi bi-check me-1"></i>Valid (LGU)</span></td>
                    <td><span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Grade A (5.0)</span></td>
                </tr>
                <tr>
                    <td class="ps-3 fw-bold text-dark">Greenview Boarding House</td>
                    <td>Pedro Reyes</td>
                    <td>Brgy. Maharlika, Santa Cruz</td>
                    <td><span class="badge bg-success"><i class="bi bi-check me-1"></i>BFP-2026-114</span></td>
                    <td><span class="badge bg-success"><i class="bi bi-check me-1"></i>Valid (LGU)</span></td>
                    <td><span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Grade A (4.8)</span></td>
                </tr>
                <tr>
                    <td class="ps-3 fw-bold text-dark">Sunrise Ladies Dormitory</td>
                    <td>Elena Ramos</td>
                    <td>Brgy. Poblacion, Santa Cruz</td>
                    <td><span class="badge bg-success"><i class="bi bi-check me-1"></i>BFP-2026-088</span></td>
                    <td><span class="badge bg-success"><i class="bi bi-check me-1"></i>Valid (LGU)</span></td>
                    <td><span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Grade A (4.9)</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

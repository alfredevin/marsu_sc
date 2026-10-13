<!-- Boarding Fees Tracking View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-cash-coin me-2 text-gold"></i>Boarding House Fee Schedule & Rates
        </h1>
        <p class="text-muted small mb-0">Standardized rental price ceilings, utility bills (water & electricity submetering), and university-accredited rate schedules.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/paymentrecords') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-receipt me-1"></i>Payment Records
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#newFeeModal">
            <i class="bi bi-plus-lg me-1"></i>Add Fee Rate
        </button>
    </div>
</div>

<!-- Sub-navigation Pills -->
<div class="mb-4">
    <ul class="nav nav-pills custom-nav-pills gap-1">
        <li class="nav-item">
            <a class="nav-link px-3 py-1 active bg-marsu text-white fw-semibold" href="<?= url('housing/boardingfees') ?>">
                <i class="bi bi-cash-coin me-1 text-gold"></i>Fee Schedule
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/paymentrecords') ?>">
                <i class="bi bi-wallet2 me-1"></i>Payment Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/balancemonitoring') ?>">
                <i class="bi bi-exclamation-diamond me-1"></i>Balance Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 py-1 text-muted" href="<?= url('housing/receiptgeneration') ?>">
                <i class="bi bi-printer me-1"></i>Receipt Generation
            </a>
        </li>
    </ul>
</div>

<!-- Fee Rate Cards by Facility -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-marsu-burgundy">
            <i class="bi bi-table me-2 text-gold"></i>Accredited Monthly Rental Rates & Utility Caps
        </h6>
        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i>Download Rate Sheet</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Boarding House</th>
                        <th>Room Configuration</th>
                        <th>Monthly Rent (Per Head)</th>
                        <th>Water Utility</th>
                        <th>Electricity Submeter</th>
                        <th>Wi-Fi / Internet</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Villa Marinduque Dorm</td>
                        <td>4-Pax Bed Space (Aircon)</td>
                        <td><span class="fw-bold text-success">₱1,800.00</span></td>
                        <td>Free (Deep Well + Filtered)</td>
                        <td>Submetered (₱18/kWh)</td>
                        <td><span class="badge bg-success-subtle text-success">Free Fiber Wi-Fi</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Villa Marinduque Dorm</td>
                        <td>4-Pax Bed Space (Fan Room)</td>
                        <td><span class="fw-bold text-success">₱1,500.00</span></td>
                        <td>Free</td>
                        <td>Inclusive (Standard Load)</td>
                        <td><span class="badge bg-success-subtle text-success">Free Fiber Wi-Fi</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Greenview Boarding House</td>
                        <td>2-Pax Room Studio</td>
                        <td><span class="fw-bold text-success">₱2,200.00</span></td>
                        <td>₱100/mo flat fee</td>
                        <td>Submetered</td>
                        <td><span class="badge bg-secondary">₱150/mo add-on</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-dark">Sunrise Ladies Dormitory</td>
                        <td>Single Solo Room</td>
                        <td><span class="fw-bold text-success">₱3,000.00</span></td>
                        <td>Inclusive</td>
                        <td>Inclusive (Max 50kWh)</td>
                        <td><span class="badge bg-success-subtle text-success">Free Wi-Fi</span></td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Fee Rate -->
<div class="modal fade" id="newFeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Configure Fee Rate Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility Name</label>
                        <select class="form-select" required>
                            <option>Villa Marinduque Student Dorm</option>
                            <option>Greenview Boarding House</option>
                            <option>Sunrise Ladies Dormitory</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Room Configuration</label>
                        <input type="text" class="form-control" placeholder="e.g. 4-Pax Aircon Room" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Monthly Rent per Student (₱)</label>
                        <input type="number" step="0.01" class="form-control" placeholder="e.g. 1800.00" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu">Save Rate</button>
                </div>
            </form>
        </div>
    </div>
</div>

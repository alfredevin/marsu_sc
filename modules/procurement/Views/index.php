<!-- Supply and Property Management System (SPMS) — Dashboard View -->
<div class="mb-4">
    <h3 class="fw-bold mb-1 spms-page-title">Dashboard</h3>
    <p class="text-muted mb-0 spms-page-subtitle">Overview of Supply and Property Management System</p>
</div>

<!-- Flash feedback alerts -->
<?php if (\Core\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('success')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (\Core\Session::has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center py-2 mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div><?= e(\Core\Session::flash('error')) ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 4 Top Stat Cards -->
<div class="row g-3 mb-4">
    <!-- 1. Pending PPMPs -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm spms-stat-card spms-card-blue">
            <div class="card-body p-3">
                <div class="spms-card-title">Pending PPMPs</div>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <div class="spms-icon-circle spms-icon-blue">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <div class="spms-stat-value"><?= e((string)($pendingPpmps ?? 0)) ?></div>
                        <div class="spms-stat-label">To Approve</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Incoming Delivery -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm spms-stat-card spms-card-green">
            <div class="card-body p-3">
                <div class="spms-card-title">Incoming Delivery</div>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <div class="spms-icon-circle spms-icon-green">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div>
                        <div class="spms-stat-value"><?= e((string)($incomingDelivery ?? 0)) ?></div>
                        <div class="spms-stat-label">POs Sent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Low Stock Items -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm spms-stat-card spms-card-amber">
            <div class="card-body p-3">
                <div class="spms-card-title">Low Stock Items</div>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <div class="spms-icon-circle spms-icon-amber">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div>
                        <div class="spms-stat-value"><?= e((string)($lowStockItems ?? 0)) ?></div>
                        <div class="spms-stat-label">Need Reorder</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Total Asset Value -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-0 shadow-sm spms-stat-card spms-card-cyan">
            <div class="card-body p-3">
                <div class="spms-card-title">Total Asset Value</div>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <div class="spms-icon-circle spms-icon-cyan">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <div class="spms-stat-value"><?= e($totalAssetValue ?? '₱0.0M') ?></div>
                        <div class="spms-stat-label">Current Inventory</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2 Main Analytics Charts -->
<div class="row g-4 mb-4">
    <!-- Left: Asset Condition Overview -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white spms-chart-card">
            <div class="card-body p-3 p-md-4">
                <h6 class="fw-bold mb-3 spms-chart-title">Asset Condition Overview</h6>
                <div class="spms-canvas-wrapper">
                    <canvas id="assetConditionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Top 5 Depts with Most Equipment -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white spms-chart-card">
            <div class="card-body p-3 p-md-4">
                <h6 class="fw-bold mb-3 spms-chart-title">Top 5 Depts with Most Equipment</h6>
                <div class="spms-canvas-wrapper">
                    <canvas id="topDeptsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SPMS Live Operational Tables -->
<div class="row g-4 mb-4">
    <!-- Pending PPMPs Table -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-file-earmark-text text-primary me-2"></i>Pending PPMP Submissions
                </h6>
                <a href="<?= url('procurement/approval-worlkflow') ?>" class="btn btn-sm btn-outline-primary">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3">PPMP Code</th>
                                <th>Department</th>
                                <th>Grand Total</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (!empty($recentPpmps)): ?>
                                <?php foreach ($recentPpmps as $p): ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold text-primary"><?= e($p['ppmp_code']) ?></td>
                                        <td><?= e($p['department_name']) ?></td>
                                        <td class="fw-bold">&#8369;<?= number_format((float)$p['grand_total'], 2) ?></td>
                                        <td class="text-end pe-3">
                                            <a href="<?= url('procurement/approval-worlkflow') ?>" class="btn btn-xs btn-outline-success py-1 px-2">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No pending PPMPs recorded.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Deliveries Table -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-truck text-success me-2"></i>Incoming Deliveries (Pending)
                </h6>
                <a href="<?= url('procurement/delivery-tracker') ?>" class="btn btn-sm btn-outline-success">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3">PO Number</th>
                                <th>Supplier</th>
                                <th>Contract Total</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php if (!empty($pendingDeliveries)): ?>
                                <?php foreach ($pendingDeliveries as $d): ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold text-dark"><?= e($d['po_number']) ?></td>
                                        <td><?= e($d['supplier_name'] ?? 'Accredited Supplier') ?></td>
                                        <td class="fw-bold text-success">&#8369;<?= number_format((float)$d['total_amount'], 2) ?></td>
                                        <td class="text-end pe-3">
                                            <a href="<?= url('procurement/delivery-tracker') ?>" class="btn btn-xs btn-success py-1 px-2 text-white">
                                                Receive
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No incoming deliveries at this time.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Procurement Modules Quick Access (Collapsible Drawer) -->
<div class="card border-0 shadow-sm rounded-3 bg-white mt-4">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center cursor-pointer" 
         data-bs-toggle="collapse" 
         data-bs-target="#procurementQuickNav" 
         aria-expanded="false" 
         style="cursor: pointer;">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-grid-3x3-gap-fill text-marsu-burgundy"></i>
            <span class="fw-semibold text-dark small">Procurement Operations & Modules Quick Access</span>
        </div>
        <button class="btn btn-sm btn-light border py-0 px-2 text-muted" type="button">
            <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div class="collapse" id="procurementQuickNav">
        <div class="card-body pt-0 pb-3 border-top">
            <div class="row g-2 mt-2">
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="<?= url('procurement/pr-filling') ?>" class="btn btn-outline-light text-dark border w-100 text-start p-2 small d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-plus text-primary"></i>
                        <span>PR Filling</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="<?= url('procurement/resquisition-and-issue-slip') ?>" class="btn btn-outline-light text-dark border w-100 text-start p-2 small d-flex align-items-center gap-2">
                        <i class="bi bi-receipt text-warning"></i>
                        <span>RIS</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="<?= url('procurement/approval-worlkflow') ?>" class="btn btn-outline-light text-dark border w-100 text-start p-2 small d-flex align-items-center gap-2">
                        <i class="bi bi-check2-circle text-success"></i>
                        <span>Approvals</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="<?= url('procurement/project-procurement-management-plan') ?>" class="btn btn-outline-light text-dark border w-100 text-start p-2 small d-flex align-items-center gap-2">
                        <i class="bi bi-diagram-3 text-info"></i>
                        <span>PPMP</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="<?= url('procurement/po-generation') ?>" class="btn btn-outline-light text-dark border w-100 text-start p-2 small d-flex align-items-center gap-2">
                        <i class="bi bi-bag-check text-marsu-burgundy"></i>
                        <span>PO Generation</span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="<?= url('procurement/iar-processing') ?>" class="btn btn-outline-light text-dark border w-100 text-start p-2 small d-flex align-items-center gap-2">
                        <i class="bi bi-clipboard2-check text-secondary"></i>
                        <span>IAR Processing</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* SPMS Clean Dashboard Typography & Layout */
.spms-page-title {
    color: #1e3a8a;
    font-size: 1.55rem;
    font-weight: 700;
    letter-spacing: -0.2px;
}
.spms-page-subtitle {
    font-size: 0.86rem;
    color: #64748b !important;
}

/* Stat Cards */
.spms-stat-card {
    background: #ffffff;
    border: 1px solid #edf2f7 !important;
    border-radius: 8px !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.spms-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06) !important;
}
.spms-card-blue {
    border-bottom: 3.5px solid #38bdf8 !important;
}
.spms-card-green {
    border-bottom: 3.5px solid #22c55e !important;
}
.spms-card-amber {
    border-bottom: 3.5px solid #f59e0b !important;
}
.spms-card-cyan {
    border-bottom: 3.5px solid #06b6d4 !important;
}

.spms-card-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1e3a8a;
}
.spms-icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    flex-shrink: 0;
}
.spms-icon-blue {
    background-color: #e0f2fe;
    color: #0284c7;
}
.spms-icon-green {
    background-color: #dcfce7;
    color: #16a34a;
}
.spms-icon-amber {
    background-color: #fef3c7;
    color: #d97706;
}
.spms-icon-cyan {
    background-color: #cffafe;
    color: #0891b2;
}
.spms-stat-value {
    font-size: 1.65rem;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.1;
}
.spms-stat-label {
    font-size: 0.78rem;
    color: #64748b;
    margin-top: 2px;
}

/* Charts */
.spms-chart-card {
    border: 1px solid #edf2f7 !important;
}
.spms-chart-title {
    color: #1e3a8a;
    font-size: 0.98rem;
}
.spms-canvas-wrapper {
    position: relative;
    height: 310px;
    width: 100%;
}

/* Dark Mode Tokens */
[data-bs-theme="dark"] .spms-stat-card,
[data-bs-theme="dark"] .spms-chart-card {
    background: #1e293b !important;
    border-color: #334155 !important;
}
[data-bs-theme="dark"] .spms-page-title,
[data-bs-theme="dark"] .spms-card-title,
[data-bs-theme="dark"] .spms-chart-title {
    color: #93c5fd !important;
}
[data-bs-theme="dark"] .spms-stat-value {
    color: #f8fafc !important;
}
[data-bs-theme="dark"] .spms-stat-label,
[data-bs-theme="dark"] .spms-page-subtitle {
    color: #94a3b8 !important;
}
</style>

<!-- Chart.js Scripts Initialization -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js is not loaded.');
        return;
    }

    // 1. Asset Condition Overview (Donut Chart)
    const ctxAsset = document.getElementById('assetConditionChart');
    if (ctxAsset) {
        new Chart(ctxAsset, {
            type: 'doughnut',
            data: {
                labels: ['Missing', 'Serviceable'],
                datasets: [{
                    data: [<?= (int)($missingCount ?? 38) ?>, <?= (int)($serviceableCount ?? 62) ?>],
                    backgroundColor: [
                        '#1e7e34', // Missing: green as shown in the screenshot
                        '#dc3545'  // Serviceable: red as shown in the screenshot
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'center',
                        labels: {
                            usePointStyle: false,
                            boxWidth: 26,
                            boxHeight: 12,
                            padding: 18,
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return ' ' + label + ': ' + value + '%';
                            }
                        }
                    }
                },
                cutout: '62%'
            }
        });
    }

    // 2. Top 5 Depts with Most Equipment (Bar Chart)
    const ctxDepts = document.getElementById('topDeptsChart');
    if (ctxDepts) {
        const deptLabels = <?= json_encode($deptLabels ?? ['CICS', 'CAS', 'CET', 'CBA', 'CTE']) ?>;
        const deptValues = <?= json_encode($deptValues ?? [0, 0, 0, 0, 0]) ?>;

        const maxVal = Math.max(...deptValues, 0);
        const yMax = maxVal <= 1 ? 1.0 : Math.ceil(maxVal * 1.2);
        const step = maxVal <= 1 ? 0.1 : undefined;

        new Chart(ctxDepts, {
            type: 'bar',
            data: {
                labels: deptLabels,
                datasets: [{
                    label: 'Issued Items',
                    data: deptValues,
                    backgroundColor: '#0d6efd',
                    borderColor: '#0d6efd',
                    borderRadius: 2,
                    barThickness: 34,
                    maxBarThickness: 44
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'center',
                        labels: {
                            boxWidth: 26,
                            boxHeight: 12,
                            padding: 16,
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#475569'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: yMax,
                        ticks: {
                            stepSize: step,
                            font: { size: 11 },
                            color: '#64748b'
                        },
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: { size: 11 },
                            color: '#64748b'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
});
</script>

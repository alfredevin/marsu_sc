<!-- Student Concern Types Maintenance (MarSU Welfare Services Standard) -->
<div class="p-3 p-md-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .btn-marsu-primary {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 7px 16px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .btn-marsu-primary:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
        }

        .table-responsive-spaced {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.75rem;
            border: 1px solid #dee2e6;
        }

        .metric-card-enhanced {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .metric-card-enhanced:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.06);
        }

        .metric-card-enhanced::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .accent-maroon::before { background-color: #58111a; }
        .accent-success::before { background-color: #198754; }
        .accent-warning::before { background-color: #ffc107; }
        .accent-danger::before { background-color: #dc3545; }

        .icon-wrapper-soft {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bg-soft-maroon { background-color: rgba(88, 17, 26, 0.08); color: #58111a; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.15); color: #856404; }
        .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }

        .search-pill-wrapper-short {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 50rem !important;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            width: 260px;
        }

        .search-pill-wrapper-short input {
            border: none;
            outline: none;
            font-size: 0.85rem;
            width: 100%;
        }

        .badge-severity-critical {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .badge-severity-high {
            background-color: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
        }

        .badge-severity-medium {
            background-color: #cff4fc;
            color: #055160;
            border: 1px solid #b6effb;
        }

        .badge-severity-low {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
    </style>

    <!-- Breadcrumb Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="<?= url('welfare') ?>" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center px-3 py-1.5">
                <i class="bi bi-house me-1.5"></i> Home
            </a>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">STUDENT WELFARE</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold text-secondary">MAINTENANCE</span>
            <span class="text-muted opacity-50">/</span>
            <span class="small fw-bold marsu-maroon-text">CONCERN TYPES</span>
        </div>
    </div>

    <!-- Page Title & Overview -->
    <div class="mb-4">
        <h3 class="fw-bold marsu-maroon-text mb-1">Student Concern Types Maintenance</h3>
        <p class="text-muted small mb-0">
            Define, classify, and configure standard student welfare concern categories, severity matrices, and case intervention routing.
        </p>
    </div>

    <?php
    $items = $concernTypes ?? [];
    $totalCount = count($items);
    $activeCount = count(array_filter($items, fn($c) => ($c['status'] ?? 'active') === 'active'));
    $criticalCount = count(array_filter($items, fn($c) => in_array($c['severity_level'] ?? '', ['critical', 'high'])));
    ?>

    <!-- Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-maroon d-flex align-items-center justify-content-between">
                <div>
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">Total Classifications</div>
                    <div class="fs-2 fw-bold marsu-maroon-text lh-1"><?= $totalCount ?></div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Defined in Registry</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-maroon">
                    <i class="bi bi-tag-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-success d-flex align-items-center justify-content-between">
                <div>
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">Active Concern Types</div>
                    <div class="fs-2 fw-bold text-success lh-1"><?= $activeCount ?></div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Available for Intake</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-success">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-danger d-flex align-items-center justify-content-between">
                <div>
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">High / Critical Severity</div>
                    <div class="fs-2 fw-bold text-danger lh-1"><?= $criticalCount ?></div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">Immediate Escalation</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-danger">
                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="metric-card-enhanced accent-warning d-flex align-items-center justify-content-between">
                <div>
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.75rem;">System Status</div>
                    <div class="fs-4 fw-bold text-dark lh-1">Operational</div>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">OSAS Standard Compliant</div>
                </div>
                <div class="icon-wrapper-soft bg-soft-warning">
                    <i class="bi bi-shield-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Action Toolbar -->
    <div class="card border-0 bg-light p-3 rounded-3 mb-3">
        <div class="d-flex flex-wrap gap-2.5 align-items-center justify-content-between">
            <div class="search-pill-wrapper-short">
                <i class="bi bi-search text-muted me-2"></i>
                <input type="search" id="concernSearch" placeholder="Search code, name, category..." oninput="filterConcernTable()">
            </div>

            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-marsu-primary d-inline-flex align-items-center gap-1.5" data-bs-toggle="modal" data-bs-target="#addConcernTypeModal">
                    <i class="bi bi-plus-circle"></i> Add Concern Type
                </button>
            </div>
        </div>
    </div>

    <!-- Table of Concern Types -->
    <div class="table-responsive-spaced bg-white border">
        <table class="table table-hover align-middle mb-0" id="concernTypesTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3" style="width: 12%;">Code</th>
                    <th class="py-3" style="width: 25%;">Concern Name</th>
                    <th class="py-3" style="width: 20%;">Category</th>
                    <th class="py-3 text-center" style="width: 15%;">Severity</th>
                    <th class="py-3 text-center" style="width: 13%;">Status</th>
                    <th class="py-3 text-center pe-3" style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody class="small" id="concernTableBody">
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <div class="fw-semibold">No Concern Types Defined Yet</div>
                            <div class="small">Click "Add Concern Type" above to create standard classification entries.</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($items as $c): ?>
                        <?php
                        $sev = strtolower($c['severity_level'] ?? 'medium');
                        $sevBadge = 'badge-severity-medium';
                        if ($sev === 'critical') $sevBadge = 'badge-severity-critical';
                        elseif ($sev === 'high') $sevBadge = 'badge-severity-high';
                        elseif ($sev === 'low') $sevBadge = 'badge-severity-low';
                        ?>
                        <tr class="concern-row" data-code="<?= strtolower(e($c['code'] ?? '')) ?>" data-name="<?= strtolower(e($c['name'] ?? '')) ?>" data-category="<?= strtolower(e($c['category'] ?? '')) ?>">
                            <td class="ps-3 fw-bold text-secondary"><?= e($c['code'] ?? '') ?></td>
                            <td>
                                <div class="fw-semibold text-dark"><?= e($c['name'] ?? '') ?></div>
                                <?php if (!empty($c['description'])): ?>
                                    <div class="text-muted small text-truncate" style="max-width: 320px;"><?= e($c['description']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= e($c['category'] ?? 'General') ?></span></td>
                            <td class="text-center">
                                <span class="badge <?= $sevBadge ?> px-2.5 py-1 text-uppercase fw-semibold" style="font-size: 0.75rem;">
                                    <?= e($c['severity_level'] ?? 'medium') ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if (($c['status'] ?? 'active') === 'active'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border px-2.5 py-1">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-3">
                                <form method="POST" action="<?= url('welfare/concern-types') ?>" class="d-inline" onsubmit="return confirm('Archive this concern type classification? It can be restored if needed.');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="archive">
                                    <input type="hidden" name="id" value="<?= (int)($c['id'] ?? 0) ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-2.5" title="Archive Classification">
                                        <i class="bi bi-archive me-1"></i> Archive
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Modal: Add Concern Type -->
<div class="modal fade" id="addConcernTypeModal" tabindex="-1" aria-labelledby="addConcernTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg text-white py-2.5">
                <h6 class="modal-title fw-bold d-flex align-items-center gap-2" id="addConcernTypeModalLabel">
                    <i class="bi bi-plus-circle me-1"></i> Add Student Concern Type
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="<?= url('welfare/concern-types') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="store">

                <div class="modal-body p-4 bg-white" style="font-size: 0.875rem;">
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <label class="form-label fw-semibold text-dark small">Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control form-control-sm text-uppercase" placeholder="e.g. FIN-01" required>
                        </div>
                        <div class="col-8">
                            <label class="form-label fw-semibold text-dark small">Concern Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Tuition & Financial Insecurity" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Category</label>
                            <select name="category" class="form-select form-select-sm" required>
                                <option value="Financial">Financial Aid & Grants</option>
                                <option value="Academic">Academic Distress & Standing</option>
                                <option value="Health & Wellness">Health & Medical Wellness</option>
                                <option value="Psychological">Mental Health & Psychological</option>
                                <option value="Family & Personal">Family & Personal Crisis</option>
                                <option value="Housing & Boarding">Housing & Boarding Subsistence</option>
                                <option value="General Welfare">General Student Welfare</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Severity Level</label>
                            <select name="severity_level" class="form-select form-select-sm" required>
                                <option value="low">Low (General Inquiry)</option>
                                <option value="medium" selected>Medium (Standard Intervention)</option>
                                <option value="high">High (Urgent Attention)</option>
                                <option value="critical">Critical (Immediate Crisis)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Description & Scope</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Provide operational criteria and routing guidelines for this concern classification..."></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-semibold text-dark small">Initial Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="active" selected>Active (Available for case logging & assessment)</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-marsu-primary">Save Concern Type</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function filterConcernTable() {
        const query = document.getElementById('concernSearch').value.toLowerCase().trim();
        const rows = document.querySelectorAll('.concern-row');

        rows.forEach(row => {
            const code = row.getAttribute('data-code') || '';
            const name = row.getAttribute('data-name') || '';
            const category = row.getAttribute('data-category') || '';

            if (code.includes(query) || name.includes(query) || category.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>


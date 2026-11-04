<!-- APCPI Tracker & Suppliers Directory — Procurement Management Information System (SPMS Supplier & Catalog Management) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
            <i class="bi bi-shield-check me-2 text-gold"></i>APCPI Compliance, Suppliers &amp; Price Catalog
        </h1>
        <p class="text-muted small mb-0">Manage accredited government suppliers, PhilGEPS compliance ratings, and standard university equipment price references.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('procurement') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
        </a>
        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddCatalog">
            <i class="bi bi-plus-circle me-1"></i>Add Catalog Item
        </button>
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddSupplier">
            <i class="bi bi-building-add me-1"></i>Add Supplier
        </button>
    </div>
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

<!-- Tabs -->
<ul class="nav nav-tabs nav-tabs-bordered mb-4" id="apcpiTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active fw-semibold" data-bs-toggle="tab" data-bs-target="#tabSuppliers" type="button">
            <i class="bi bi-building-check me-1 text-primary"></i>Accredited Suppliers Directory (<?= count($suppliers ?? []) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tabCatalog" type="button">
            <i class="bi bi-card-checklist me-1 text-marsu-burgundy"></i>Standard Equipment Price Catalog (<?= count($catalog ?? []) ?>)
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- Tab 1: Suppliers Directory -->
    <div class="tab-pane fade show active" id="tabSuppliers">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-building me-2 text-primary"></i>PhilGEPS-Registered Supplier Registry
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Supplier Code</th>
                                <th>Company / Business Name</th>
                                <th>Contact Person & Phone</th>
                                <th>Classification</th>
                                <th>PhilGEPS Reg. No.</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($suppliers)): ?>
                                <?php foreach ($suppliers as $s): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-primary"><?= e($s['supplier_code']) ?></td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= e($s['company_name']) ?></div>
                                            <small class="text-muted"><i class="bi bi-geo-alt me-1"></i><?= e($s['address']) ?></small>
                                        </td>
                                        <td>
                                            <div><?= e($s['contact_person']) ?></div>
                                            <small class="text-muted"><i class="bi bi-telephone me-1"></i><?= e($s['contact_phone']) ?></small>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?= e($s['classification']) ?></span></td>
                                        <td><small class="text-dark fw-semibold"><?= e($s['philgeps_reg_number'] ?? 'PHILGEPS-ACTIVE') ?></small></td>
                                        <td class="text-center text-warning fw-bold">
                                            <i class="bi bi-star-fill text-gold me-1"></i><?= number_format((float)$s['rating'], 1) ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success"><?= e($s['status']) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">No suppliers registered.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Standard Equipment Price Catalog -->
    <div class="tab-pane fade" id="tabCatalog">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-card-checklist me-2 text-gold"></i>Standard Unit Price Reference Catalog
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Equipment / Supply Description</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th class="text-end">Standard Unit Price</th>
                                <th>Technical Specifications / Notes</th>
                                <th class="text-center">Catalog Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($catalog)): ?>
                                <?php foreach ($catalog as $c): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= e($c['equipment_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= e($c['category']) ?></span></td>
                                        <td><?= e($c['unit']) ?></td>
                                        <td class="text-end fw-bold text-success">&#8369;<?= number_format((float)$c['price'], 2) ?></td>
                                        <td><small class="text-muted"><?= e($c['description'] ?? 'Standard institutional grade') ?></small></td>
                                        <td class="text-center"><span class="badge bg-success">Active</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">No catalog items found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Add Supplier -->
<div class="modal fade" id="modalAddSupplier" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-marsu-burgundy">
                    <i class="bi bi-building-add me-2 text-gold"></i>Register Accredited Supplier
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/apcpi-tracker/supplier-store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Company Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="company_name" placeholder="e.g. Island Tech Solutions Corp." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_person" placeholder="e.g. Maria Santos" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Contact Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_phone" placeholder="e.g. 0917-555-8821" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="sales@company.com.ph" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">TIN Number</label>
                            <input type="text" class="form-control" name="tin_number" placeholder="204-889-112-000">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Classification</label>
                            <select class="form-select" name="classification">
                                <option value="IT Equipment">IT Equipment</option>
                                <option value="Office Supplies">Office Supplies</option>
                                <option value="Laboratory Equipment">Laboratory Equipment</option>
                                <option value="Furniture & Fixtures">Furniture & Fixtures</option>
                                <option value="General Services">General Services</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Business Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Street, Barangay, Municipality, Province" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu"><i class="bi bi-save me-1"></i>Save Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Catalog Item -->
<div class="modal fade" id="modalAddCatalog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-plus-circle me-2 text-primary"></i>Add Equipment to Price Catalog
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('procurement/apcpi-tracker/catalog-store') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Equipment / Supply Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="equipment_name" placeholder="e.g. 4K Ultra-HD Document Camera" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Unit Reference Price (&#8369;) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="1" class="form-control" name="price" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Unit of Measure</label>
                            <select class="form-select" name="unit">
                                <option value="unit">unit</option>
                                <option value="pcs">pcs</option>
                                <option value="set">set</option>
                                <option value="box">box</option>
                                <option value="ream">ream</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Classification Category</label>
                        <select class="form-select" name="category">
                            <option value="IT Equipment">IT Equipment</option>
                            <option value="Laboratory Equipment">Laboratory Equipment</option>
                            <option value="Office Supplies">Office Supplies</option>
                            <option value="Furniture & Fixtures">Furniture & Fixtures</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Technical Specifications</label>
                        <textarea class="form-control" name="description" rows="2" placeholder="Specifications, warranty requirements, and features..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Add to Catalog</button>
                </div>
            </form>
        </div>
    </div>
</div>

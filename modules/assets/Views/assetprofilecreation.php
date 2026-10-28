<?php
/*
 * Asset Profile Creation & Master Registry — PHP view
 *
 * Integration assumptions:
 * - The parent controller provides $records (array), $moduleName, and $slug.
 * - Your application provides e(), url(), and csrf_field() helpers, as in your example.
 * - This is a Bootstrap 5 view. The page's main layout/index.php should load Bootstrap 5
 *   and Bootstrap Icons, and define the existing MarSU theme classes/colors.
 * - The form posts to assets/create. Make sure your controller validates and saves these fields.
 */

$records = isset($records) && is_array($records) ? $records : [];
$moduleName = $moduleName ?? 'Asset Profile Creation & Master Registry';
$slug = $slug ?? 'asset-profile';
$money = static function ($value): string {
    return '₱' . number_format((float)($value ?? 0), 2);
};
$sumCost = 0.0;
$sumNetBook = 0.0;
$activeCount = 0;
$maintenanceCount = 0;
foreach ($records as $record) {
    $sumCost += (float)($record['acquisition_cost'] ?? $record['cost'] ?? 0);
    $sumNetBook += (float)($record['net_book_value'] ?? $record['book_value'] ?? 0);
    $condition = strtolower((string)($record['condition'] ?? $record['status'] ?? ''));
    if (in_array($condition, ['serviceable', 'active', 'operational'], true)) {
        $activeCount++;
    } else {
        $maintenanceCount++;
    }
}
$totalRecords = count($records);
$serviceablePercent = $totalRecords > 0 ? round(($activeCount / $totalRecords) * 100, 1) : 0;
?>

<div class="container-fluid py-3 asset-registry-page">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <div class="small fw-bold text-uppercase text-gold mb-1" style="letter-spacing:.1em">
                <i class="bi bi-box-seam me-1" aria-hidden="true"></i>
                Property &amp; Asset Registration <span class="text-muted">/ Sub-module 1</span>
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1" id="assetPageHeading">
                <?= e($moduleName) ?>
            </h1>
            <p class="small text-muted mb-0">
                Comprehensive lifecycle records, technical specifications, and status tracking for campus assets.
            </p>
        </div>
        <span class="badge rounded-pill border px-3 py-2 campus-badge">
            <i class="bi bi-building me-2" aria-hidden="true"></i>Sta. Cruz Campus
        </span>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-burgundy p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted text-uppercase fw-bold">Total Registered Assets</div>
                        <div class="h3 fw-bold text-marsu-burgundy mb-1"><?= number_format($totalRecords) ?></div>
                        <div class="small text-muted">Records in the current registry</div>
                    </div>
                    <span class="kpi-icon-badge"><i class="bi bi-boxes" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-gold p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted text-uppercase fw-bold">Total Acquisition Cost</div>
                        <div class="h5 fw-bold text-marsu-burgundy mb-1"><?= e($money($sumCost)) ?></div>
                        <div class="small text-muted">Combined recorded cost</div>
                    </div>
                    <span class="kpi-icon-badge badge-gold"><i class="bi bi-cash-coin" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted text-uppercase fw-bold">Serviceable Condition</div>
                        <div class="h3 fw-bold text-success mb-1"><?= e((string)$serviceablePercent) ?>%</div>
                        <div class="small text-muted">
                            <span class="text-success fw-semibold"><?= number_format($activeCount) ?> serviceable</span>
                            · <?= number_format($maintenanceCount) ?> other
                        </div>
                    </div>
                    <span class="kpi-icon-badge text-success"><i class="bi bi-shield-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-muted text-uppercase fw-bold">Net Book Value</div>
                        <div class="h5 fw-bold text-marsu-burgundy mb-1"><?= e($money($sumNetBook)) ?></div>
                        <div class="small text-muted">Based on values supplied in records</div>
                    </div>
                    <span class="kpi-icon-badge"><i class="bi bi-graph-up-arrow" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Toolbar -->
    <div class="card mb-3">
        <div class="card-body d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            <div>
                <h2 class="h6 fw-bold text-marsu-burgundy mb-1">
                    <i class="bi bi-clipboard-plus me-2 text-gold" aria-hidden="true"></i>Asset Registration &amp; Master Intake
                </h2>
                <p class="small text-muted mb-0">Create an asset record and maintain its classification, value, location, and custodian details.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newAssetModal">
                    <i class="bi bi-plus-circle me-1" aria-hidden="true"></i>Register Asset
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" id="exportAssetsBtn">
                    <i class="bi bi-file-earmark-spreadsheet me-1 text-success" aria-hidden="true"></i>Export CSV
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1 text-gold" aria-hidden="true"></i>Print Registry
                </button>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-lg-4">
                    <label for="assetSearchInput" class="form-label small fw-bold">Search assets</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search" aria-hidden="true"></i></span>
                        <input type="search" id="assetSearchInput" class="form-control"
                               placeholder="Property no., description, brand, serial..." autocomplete="off">
                        <button class="btn btn-outline-secondary" type="button" id="assetSearchClear" aria-label="Clear search">
                            <i class="bi bi-x-lg" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="filterCategory" class="form-label small fw-bold">Category</label>
                    <select id="filterCategory" class="form-select">
                        <option value="">All categories</option>
                        <option>IT &amp; Computing</option><option>Office Equipment</option>
                        <option>Air Conditioning / HVAC</option><option>Science &amp; Laboratory</option>
                        <option>Motor Vehicle &amp; Transport</option><option>Health &amp; Medical</option>
                        <option>Athletic &amp; Sports</option><option>General / Other Equipment</option>
                        <option>Semi-Expendable</option><option>Heavy Equipment</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="filterBuilding" class="form-label small fw-bold">Building</label>
                    <select id="filterBuilding" class="form-select">
                        <option value="">All buildings</option>
                        <option>BLD-ADM</option><option>BLD-IS</option><option>BLD-EDU</option>
                        <option>BLD-SCI</option><option>BLD-LIB</option><option>BLD-GYM</option><option>BLD-GSD</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label for="filterCondition" class="form-label small fw-bold">Condition</label>
                    <select id="filterCondition" class="form-select">
                        <option value="">All conditions</option>
                        <option>Serviceable</option><option>Needs Repair</option>
                        <option>Under Repair</option><option>Unserviceable</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 d-flex justify-content-between align-items-end gap-2">
                    <div class="small text-muted">Showing <strong id="filteredCountBadge" class="text-marsu-burgundy"><?= $totalRecords ?></strong> / <span id="totalCountBadge"><?= $totalRecords ?></span></div>
                    <button type="button" id="resetAssetFilters" class="btn btn-outline-secondary btn-sm" title="Reset filters">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Asset Table -->
    <div class="card mb-4">
        <div class="card-header card-header-accent d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
            <h2 class="h6 m-0 fw-bold text-marsu-burgundy">
                <i class="bi bi-table me-2" aria-hidden="true"></i>Asset Master Registry
            </h2>
            <span class="small text-muted">Campus: Sta. Cruz</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="assetMasterTable">
                    <thead class="table-marsu">
                        <tr>
                            <th>Property No.</th><th>Asset Description</th><th>Category</th>
                            <th>Acquisition Cost</th><th>Net Book Value</th><th>Building / Room</th>
                            <th>Custodian</th><th>Condition</th><th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="assetTableBody">
                    <?php if (empty($records)): ?>
                        <tr id="assetEmptyRow">
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-gold" aria-hidden="true"></i>
                                <div class="fw-semibold">No asset records yet</div>
                                <div class="small mb-3">Register the first asset to populate the master registry.</div>
                                <button type="button" class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newAssetModal">
                                    <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Register First Asset
                                </button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r):
                            $propertyNo = $r['property_no'] ?? $r['property_number'] ?? $r['pin'] ?? '—';
                            $description = $r['description'] ?? $r['title'] ?? 'Untitled asset';
                            $category = $r['category'] ?? $r['classification'] ?? 'Unclassified';
                            $building = $r['building'] ?? $r['building_code'] ?? '—';
                            $room = $r['room'] ?? $r['location'] ?? '—';
                            $custodian = $r['custodian'] ?? $r['accountable_custodian'] ?? 'Unassigned';
                            $condition = $r['condition'] ?? $r['status'] ?? 'Pending';
                            $cost = $r['acquisition_cost'] ?? $r['cost'] ?? 0;
                            $netBook = $r['net_book_value'] ?? $r['book_value'] ?? 0;
                            $searchText = strtolower(implode(' ', array_map('strval', [
                                $propertyNo, $description, $category, $r['brand'] ?? '', $r['model'] ?? '',
                                $r['serial_number'] ?? $r['serial'] ?? '', $building, $room, $custodian, $condition
                            ])));
                            $conditionClass = strtolower($condition) === 'serviceable' || strtolower($condition) === 'active'
                                ? 'bg-success' : (str_contains(strtolower($condition), 'repair') ? 'bg-warning text-dark' : 'bg-secondary');
                        ?>
                            <tr data-search="<?= e($searchText) ?>"
                                data-category="<?= e((string)$category) ?>"
                                data-building="<?= e((string)$building) ?>"
                                data-condition="<?= e((string)$condition) ?>">
                                <td class="small fw-bold text-marsu-burgundy text-nowrap"><?= e((string)$propertyNo) ?></td>
                                <td>
                                    <div class="fw-semibold"><?= e((string)$description) ?></div>
                                    <div class="small text-muted">
                                        <?= e((string)($r['brand'] ?? '')) ?>
                                        <?= !empty($r['model']) ? ' · ' . e((string)$r['model']) : '' ?>
                                        <?= !empty($r['serial_number']) ? ' · SN: ' . e((string)$r['serial_number']) : '' ?>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= e((string)$category) ?></span></td>
                                <td class="text-nowrap"><?= e($money($cost)) ?></td>
                                <td class="text-nowrap"><?= e($money($netBook)) ?></td>
                                <td><div><?= e((string)$building) ?></div><div class="small text-muted"><?= e((string)$room) ?></div></td>
                                <td><?= e((string)$custodian) ?></td>
                                <td><span class="badge <?= e($conditionClass) ?>"><?= e((string)$condition) ?></span></td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-outline-secondary view-asset-btn"
                                            title="View asset" aria-label="View asset"
                                            data-property="<?= e((string)$propertyNo) ?>"
                                            data-description="<?= e((string)$description) ?>"
                                            data-category="<?= e((string)$category) ?>"
                                            data-cost="<?= e($money($cost)) ?>"
                                            data-building="<?= e((string)$building) ?>"
                                            data-room="<?= e((string)$room) ?>"
                                            data-custodian="<?= e((string)$custodian) ?>"
                                            data-condition="<?= e((string)$condition) ?>">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <tr id="assetNoFilterResults" style="display:none">
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="bi bi-search d-block fs-4 mb-1"></i>No assets match your filters.
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <span class="small text-muted">Asset information displayed here depends on the fields returned by your controller.</span>
            <span class="small text-muted">Module: <code><?= e($slug) ?></code></span>
        </div>
    </div>
</div>

<!-- Modal: Register Asset -->
<div class="modal fade" id="newAssetModal" tabindex="-1" aria-labelledby="newAssetModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-marsu-burgundy text-white">
                <div>
                    <h2 class="modal-title h5 fw-bold mb-1" id="newAssetModalTitle">
                        <i class="bi bi-box-seam me-2 text-gold" aria-hidden="true"></i>Register Campus Asset
                    </h2>
                    <div class="small text-white-50">Sta. Cruz Campus · Asset Profile Creation</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= e(url('assets/create')) ?>" id="newAssetForm">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="alert alert-info py-2 small">
                        <i class="bi bi-info-circle me-2" aria-hidden="true"></i>
                        Enter details from the acquisition documents. Fields marked <span class="text-danger">*</span> are required.
                    </div>
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="modalClassification" class="form-label small fw-bold">Classification <span class="text-danger">*</span></label>
                            <select name="classification" id="modalClassification" class="form-select" required>
                                <option value="Property, Plant & Equipment (PPE)">Property, Plant &amp; Equipment (PPE)</option>
                                <option value="Semi-Expendable Property">Semi-Expendable Property</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="modalCategory" class="form-label small fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category" id="modalCategory" class="form-select" required>
                                <option value="">Select category</option>
                                <option>IT &amp; Computing</option><option>Office Equipment</option>
                                <option>Air Conditioning / HVAC</option><option>Science &amp; Laboratory</option>
                                <option>Motor Vehicle &amp; Transport</option><option>Health &amp; Medical</option>
                                <option>Athletic &amp; Sports</option><option>General / Other Equipment</option>
                                <option>Semi-Expendable</option><option>Heavy Equipment</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="modalDescription" class="form-label small fw-bold">Full Item Description <span class="text-danger">*</span></label>
                            <input type="text" name="description" id="modalDescription" class="form-control" required maxlength="255"
                                   placeholder="e.g. Dell desktop computer, office chair, projector">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalBrand" class="form-label small fw-bold">Brand</label>
                            <input type="text" name="brand" id="modalBrand" class="form-control" maxlength="100" placeholder="e.g. Dell">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalModel" class="form-label small fw-bold">Model / Type</label>
                            <input type="text" name="model" id="modalModel" class="form-control" maxlength="100" placeholder="Optional">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalSerial" class="form-label small fw-bold">Serial Number</label>
                            <input type="text" name="serial_number" id="modalSerial" class="form-control" maxlength="100" placeholder="Optional">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalCost" class="form-label small fw-bold">Acquisition Cost (₱) <span class="text-danger">*</span></label>
                            <input type="number" name="acquisition_cost" id="modalCost" class="form-control" min="0.01" step="0.01" required placeholder="0.00">
                            <div class="form-text" id="costValidationNotice">Enter a positive amount.</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalAcqDate" class="form-label small fw-bold">Acquisition Date <span class="text-danger">*</span></label>
                            <input type="date" name="acquisition_date" id="modalAcqDate" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalUsefulLifeYears" class="form-label small fw-bold">Useful Life (Years)</label>
                            <select name="useful_life_years" id="modalUsefulLifeYears" class="form-select">
                                <option value="2">2 years</option><option value="3">3 years</option>
                                <option value="5" selected>5 years</option><option value="7">7 years</option>
                                <option value="10">10 years</option><option value="15">15 years</option><option value="30">30 years</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="modalSalvageValue" class="form-label small fw-bold">Estimated Salvage Value (₱)</label>
                            <input type="number" name="salvage_value" id="modalSalvageValue" class="form-control" min="0" step="0.01" value="0.00">
                            <div class="form-text">Suggested value: 5% for PPE; ₱0.00 for semi-expendable items. Verify applicable policy.</div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="modalFundCluster" class="form-label small fw-bold">Fund Cluster</label>
                            <select name="fund_cluster" id="modalFundCluster" class="form-select">
                                <option value="01 - Regular Agency Fund">01 - Regular Agency Fund</option>
                                <option value="05 - Internally Generated Funds">05 - Internally Generated Funds</option>
                                <option value="06 - Business Related Funds">06 - Business Related Funds</option>
                                <option value="07 - Trust Receipts">07 - Trust Receipts</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalBuilding" class="form-label small fw-bold">Building / Code <span class="text-danger">*</span></label>
                            <select name="building" id="modalBuilding" class="form-select" required>
                                <option value="">Select building</option>
                                <option value="BLD-ADM">BLD-ADM - Administration</option>
                                <option value="BLD-IS">BLD-IS - Information Systems</option>
                                <option value="BLD-EDU">BLD-EDU - Education Building</option>
                                <option value="BLD-SCI">BLD-SCI - Science Research</option>
                                <option value="BLD-LIB">BLD-LIB - Campus Library</option>
                                <option value="BLD-GYM">BLD-GYM - Gymnasium Complex</option>
                                <option value="BLD-GSD">BLD-GSD - General Services</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalRoom" class="form-label small fw-bold">Room / Specific Space <span class="text-danger">*</span></label>
                            <input type="text" name="room" id="modalRoom" class="form-control" required maxlength="150" placeholder="e.g. Computer Laboratory 1">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="modalCustodian" class="form-label small fw-bold">Accountable Custodian <span class="text-danger">*</span></label>
                            <input type="text" name="custodian" id="modalCustodian" class="form-control" required maxlength="150" placeholder="Personnel name">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="modalCondition" class="form-label small fw-bold">Operational Condition</label>
                            <select name="condition" id="modalCondition" class="form-select">
                                <option value="Serviceable">Serviceable</option><option value="Needs Repair">Needs Repair</option>
                                <option value="Under Repair">Under Repair</option><option value="Unserviceable">Unserviceable</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="modalNotes" class="form-label small fw-bold">Reference / Purchase Order Notes</label>
                            <input type="text" name="notes" id="modalNotes" class="form-control" maxlength="255" placeholder="Receipt, PO, or delivery reference">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm">
                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Save Asset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: View Asset -->
<div class="modal fade" id="viewAssetModal" tabindex="-1" aria-labelledby="viewAssetModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h2 class="modal-title h6 fw-bold" id="viewAssetModalTitle"><i class="bi bi-eye me-2 text-gold"></i>Asset Details</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0 small">
                    <dt class="col-5 text-muted">Property No.</dt><dd class="col-7 fw-bold" id="viewProperty"></dd>
                    <dt class="col-5 text-muted">Description</dt><dd class="col-7" id="viewDescription"></dd>
                    <dt class="col-5 text-muted">Category</dt><dd class="col-7" id="viewCategory"></dd>
                    <dt class="col-5 text-muted">Acquisition Cost</dt><dd class="col-7" id="viewCost"></dd>
                    <dt class="col-5 text-muted">Building</dt><dd class="col-7" id="viewBuilding"></dd>
                    <dt class="col-5 text-muted">Room</dt><dd class="col-7" id="viewRoom"></dd>
                    <dt class="col-5 text-muted">Custodian</dt><dd class="col-7" id="viewCustodian"></dd>
                    <dt class="col-5 text-muted">Condition</dt><dd class="col-7" id="viewCondition"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Uses your index.php theme classes where available; these are safe fallbacks. */
.asset-registry-page .campus-badge { color: var(--bs-body-color, #4b5563); border-color: var(--border-color, #e5e7eb) !important; background: var(--bg-surface, #fff); }
.asset-registry-page .text-gold, .asset-registry-page .text-gold-light { color: var(--gold-500, #c6a23a) !important; }
.asset-registry-page .text-marsu-burgundy { color: var(--marsu-burgundy, #641b32) !important; }
.asset-registry-page .card-kpi { border-radius: .85rem; box-shadow: 0 2px 12px rgba(30, 20, 25, .045); }
.asset-registry-page .border-burgundy { border-top: 3px solid var(--marsu-burgundy, #641b32) !important; }
.asset-registry-page .border-gold { border-top: 3px solid var(--gold-500, #c6a23a) !important; }
.asset-registry-page .kpi-icon-badge { display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:12px; background:rgba(100,27,50,.08); color:var(--marsu-burgundy,#641b32); font-size:1.25rem; flex-shrink:0; }
.asset-registry-page .badge-gold { background:rgba(198,162,58,.16); color:#94751d; }
.asset-registry-page .table-marsu { background:var(--marsu-burgundy,#641b32); color:#fff; }
.asset-registry-page .table-marsu th { white-space:nowrap; font-size:.75rem; text-transform:uppercase; letter-spacing:.025em; padding:.85rem .75rem; }
.asset-registry-page .table td { padding:.8rem .75rem; }
.asset-registry-page .card-header-accent { background:var(--bg-surface,#fff); border-bottom:1px solid var(--border-color,#e5e7eb); }
.asset-registry-page .btn-marsu { background:var(--marsu-burgundy,#641b32); color:#fff; border-color:var(--marsu-burgundy,#641b32); }
.asset-registry-page .btn-marsu:hover, .asset-registry-page .btn-marsu:focus { background:#4f1427; color:#fff; }
.asset-registry-page .modal-content { border:1px solid var(--border-color,#e5e7eb); border-radius:.85rem; overflow:hidden; }
.asset-registry-page .form-control:focus, .asset-registry-page .form-select:focus { border-color:var(--gold-500,#c6a23a); box-shadow:0 0 0 .2rem rgba(198,162,58,.18); }
@media print {
    body * { visibility:hidden; }
    .asset-registry-page, .asset-registry-page * { visibility:visible; }
    .asset-registry-page { position:absolute; inset:0; width:100%; }
    .asset-registry-page button, .asset-registry-page input, .asset-registry-page select,
    .asset-registry-page .card-footer, .asset-registry-page .campus-badge { display:none !important; }
    .asset-registry-page .card { box-shadow:none !important; break-inside:avoid; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('assetMasterTable');
    const tbody = document.getElementById('assetTableBody');
    const search = document.getElementById('assetSearchInput');
    const clear = document.getElementById('assetSearchClear');
    const category = document.getElementById('filterCategory');
    const building = document.getElementById('filterBuilding');
    const condition = document.getElementById('filterCondition');
    const count = document.getElementById('filteredCountBadge');
    const total = document.getElementById('totalCountBadge');
    const noResults = document.getElementById('assetNoFilterResults');

    function applyFilters() {
        if (!tbody) return;
        const query = (search?.value || '').trim().toLowerCase();
        const selectedCategory = (category?.value || '').toLowerCase();
        const selectedBuilding = (building?.value || '').toLowerCase();
        const selectedCondition = (condition?.value || '').toLowerCase();
        const rows = Array.from(tbody.querySelectorAll('tr[data-search]'));
        let visible = 0;

        rows.forEach(function (row) {
            const matches = (row.dataset.search || '').includes(query)
                && (!selectedCategory || (row.dataset.category || '').toLowerCase() === selectedCategory)
                && (!selectedBuilding || (row.dataset.building || '').toLowerCase().includes(selectedBuilding))
                && (!selectedCondition || (row.dataset.condition || '').toLowerCase() === selectedCondition);
            row.style.display = matches ? '' : 'none';
            if (matches) visible++;
        });

        if (count) count.textContent = String(visible);
        if (total) total.textContent = String(rows.length);
        if (clear) clear.hidden = !query;
        if (noResults) noResults.style.display = rows.length > 0 && visible === 0 ? '' : 'none';
    }

    [search, category, building, condition].forEach(function (element) {
        if (element) element.addEventListener(element === search ? 'input' : 'change', applyFilters);
    });
    clear?.addEventListener('click', function () {
        if (search) search.value = '';
        applyFilters();
        search?.focus();
    });
    document.getElementById('resetAssetFilters')?.addEventListener('click', function () {
        if (search) search.value = '';
        if (category) category.value = '';
        if (building) building.value = '';
        if (condition) condition.value = '';
        applyFilters();
    });

    // Suggest salvage value for PPE (5% of acquisition cost); semi-expendable defaults to zero.
    const classification = document.getElementById('modalClassification');
    const cost = document.getElementById('modalCost');
    const salvage = document.getElementById('modalSalvageValue');
    const notice = document.getElementById('costValidationNotice');

    function updateCostFields() {
        const amount = Math.max(0, Number(cost?.value || 0));
        const isPpe = classification?.value === 'Property, Plant & Equipment (PPE)';
        if (salvage && (salvage.dataset.userEdited !== '1' || !salvage.value)) {
            salvage.value = isPpe ? (amount * 0.05).toFixed(2) : '0.00';
        }
        if (notice) {
            if (amount <= 0 && cost?.value) {
                notice.textContent = 'Enter an amount greater than ₱0.00.';
                notice.className = 'form-text text-danger';
            } else if (amount > 0 && isPpe && amount < 50000) {
                notice.textContent = 'Check classification: this amount is below ₱50,000.';
                notice.className = 'form-text text-warning';
            } else if (amount >= 50000 && !isPpe) {
                notice.textContent = 'Check classification: this amount is ₱50,000 or more.';
                notice.className = 'form-text text-warning';
            } else {
                notice.textContent = 'Suggested salvage value updates to 5% for PPE.';
                notice.className = 'form-text text-muted';
            }
        }
    }
    cost?.addEventListener('input', updateCostFields);
    classification?.addEventListener('change', function () {
        if (salvage) salvage.dataset.userEdited = '';
        updateCostFields();
    });
    salvage?.addEventListener('input', function () { salvage.dataset.userEdited = '1'; });
    updateCostFields();

    // View-details modal uses Bootstrap 5's modal API.
    document.querySelectorAll('.view-asset-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const fields = {
                viewProperty: 'property', viewDescription: 'description', viewCategory: 'category',
                viewCost: 'cost', viewBuilding: 'building', viewRoom: 'room',
                viewCustodian: 'custodian', viewCondition: 'condition'
            };
            Object.keys(fields).forEach(function (id) {
                const target = document.getElementById(id);
                if (target) target.textContent = button.dataset[fields[id]] || '—';
            });
            const modalElement = document.getElementById('viewAssetModal');
            if (modalElement && window.bootstrap?.Modal) {
                window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
            }
        });
    });

    // Export the currently visible table rows as a CSV file.
    document.getElementById('exportAssetsBtn')?.addEventListener('click', function () {
        if (!table) return;
        const visibleRows = Array.from(table.querySelectorAll('tr'))
            .filter(row => row.style.display !== 'none' && !row.id.includes('assetNoFilterResults'));
        const csvEscape = value => '"' + String(value ?? '').replace(/"/g, '""').trim() + '"';
        const csv = visibleRows.map(row =>
            Array.from(row.querySelectorAll('th,td')).slice(0, 8)
                .map(cell => csvEscape(cell.innerText.replace(/\s+/g, ' '))).join(',')
        ).join('\r\n');
        const blob = new Blob(['\uFEFF' + csv], {type: 'text/csv;charset=utf-8;'});
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'marSU_asset_registry.csv';
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    });

    // Set the acquisition date to today when the modal is opened and the field is empty.
    document.getElementById('newAssetModal')?.addEventListener('show.bs.modal', function () {
        const dateInput = document.getElementById('modalAcqDate');
        if (dateInput && !dateInput.value) {
            const now = new Date();
            dateInput.value = [
                now.getFullYear(),
                String(now.getMonth() + 1).padStart(2, '0'),
                String(now.getDate()).padStart(2, '0')
            ].join('-');
        }
    });

    applyFilters();
});
</script>

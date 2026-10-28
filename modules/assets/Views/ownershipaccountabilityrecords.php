<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-boxes me-1"></i>PROPERTY & ASSET REGISTRATION &bull; SUB-MODULE 5
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Ownership, Accountability &amp; Custodianship Tracking') ?>
            </h1>
            <p class="text-muted small mb-0">
                PAR (Capitalized PPE &ge; ₱50k) and ICS (Semi-Expendable &lt; ₱50k) assignments, custodian sign-offs, and inter-office transfer workflows.
            </p>
        </div>
    </div>

    <!-- Asset module content -->
    <div id="assetModuleContent" data-asset-module="accountability">

        <!-- Custodianship KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-gold p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Accountable Personnel</div>
                    <div class="h3 fw-bold text-gold font-monospace my-1">
                        <?= e($accountableOfficersCount ?? '9 Officers') ?>
                    </div>
                    <div class="small text-muted">Faculty &amp; Unit Heads with Custody</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-burgundy p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Active PAR Slips</div>
                    <div class="h3 fw-bold font-monospace my-1 text-marsu-burgundy">
                        <?= e($activeParCount ?? '78 Assets') ?>
                    </div>
                    <div class="small text-primary fw-semibold"><i class="bi bi-award-fill me-1"></i>COA Appendix 71 Active</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-success p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Active ICS Slips</div>
                    <div class="h3 fw-bold font-monospace my-1 text-dark">
                        <?= e($activeIcsCount ?? '52 Assets') ?>
                    </div>
                    <div class="small text-success fw-semibold"><i class="bi bi-file-earmark-check-fill me-1"></i>COA Appendix 59 Active</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-kpi border-info p-3 h-100 shadow-sm">
                    <div class="text-muted small text-uppercase fw-bold">Custody Verification</div>
                    <div class="h3 fw-bold text-success font-monospace my-1">100.0%</div>
                    <div class="small text-muted">Zero Unassigned Property</div>
                </div>
            </div>
        </div>

        <!-- Campus Department Custodianship Overview Cards -->
        <div class="row g-3 mb-4">
            <?php 
            $departments = $departmentSummaries ?? [
                ['code' => 'OFF-DIR', 'name' => 'Campus Director', 'initials' => 'CD', 'assets' => '18 Assets', 'value' => '₱1,850,000'],
                ['code' => 'OFF-BSIS', 'name' => 'Info Systems / ICT', 'initials' => 'IS', 'assets' => '45 Assets', 'value' => '₱4,200,000'],
                ['code' => 'OFF-EDUC', 'name' => 'College of Education', 'initials' => 'ED', 'assets' => '26 Assets', 'value' => '₱2,150,000'],
                ['code' => 'OFF-SCI', 'name' => 'Science Research', 'initials' => 'SC', 'assets' => '22 Assets', 'value' => '₱1,800,000'],
                ['code' => 'OFF-GSD', 'name' => 'General Services / SPMU', 'initials' => 'GS', 'assets' => '19 Assets', 'value' => '₱740,170']
            ];
            foreach ($departments as $dept): 
            ?>
                <div class="col-md">
                    <div class="card h-100 shadow-sm border-0 p-3 custody-unit-card cursor-pointer" onclick="window.filterByOffice('<?= e($dept['code']) ?>')">
                        <div class="d-flex align-items-center mb-2">
                            <span class="avatar-circle me-2 bg-marsu-burgundy text-white fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                <?= e($dept['initials']) ?>
                            </span>
                            <div>
                                <div class="fw-bold text-dark small mb-0"><?= e($dept['name']) ?></div>
                                <div class="small text-muted" style="font-size: 0.75rem;"><?= e($dept['code']) ?></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end pt-2 border-top">
                            <span class="small font-monospace text-gold fw-bold"><?= e($dept['assets']) ?></span>
                            <span class="small font-monospace text-muted"><?= e($dept['value']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Accountability Search Toolbar -->
        <div class="card shadow-sm p-3 mb-4 border-0">
            <!-- Row 1: Search Input & Office Select Filter -->
            <div class="row align-items-center g-2">
                <div class="col-lg-7 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                        <input type="search" id="accountabilitySearchInput" class="form-control border-start-0 ps-0" aria-label="Search accountability records by custodian, office, or PAR/ICS number" placeholder="Search custodian, designation, office or PAR/ICS slip...">
                        <button type="button" id="accountabilitySearchClear" class="btn btn-outline-secondary border-start-0 bg-white" aria-label="Clear accountability search" title="Clear search" hidden>
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="d-flex align-items-center">
                        <span class="small fw-bold text-muted me-2 text-nowrap d-none d-sm-inline">
                            <i class="bi bi-funnel text-gold me-1"></i>Office:
                        </span>
                        <select id="accountabilityFilterOffice" class="form-select">
                            <option value="ALL">All Offices / Departments</option>
                            <option value="OFF-DIR">OFF-DIR (Campus Director)</option>
                            <option value="OFF-BSIS">OFF-BSIS (ICT / Info Systems)</option>
                            <option value="OFF-EDUC">OFF-EDUC (College of Education)</option>
                            <option value="OFF-SCI">OFF-SCI (Science Research)</option>
                            <option value="OFF-LIB">OFF-LIB (Library Services)</option>
                            <option value="OFF-SPMU">OFF-SPMU (Supply &amp; Property)</option>
                            <option value="OFF-ACCT">OFF-ACCT (Accounting)</option>
                            <option value="OFF-GSD">OFF-GSD (General Services)</option>
                            <option value="OFF-SEC">OFF-SEC (Campus Security)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Row 2: Action Controls Bar -->
            <div class="d-flex flex-wrap align-items-center justify-content-between pt-3 mt-3 border-top gap-2">
                <div class="small text-muted d-flex align-items-center">
                    <i class="bi bi-shield-check text-gold me-2 fs-6"></i>
                    <span class="fw-bold text-dark me-1">Custodianship Registry:</span>
                    <span>Official COA Bindings &bull; Sta. Cruz Campus</span>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <a href="forms-par.php" class="btn btn-outline-warning text-dark btn-sm fw-bold" title="Issue Property Acknowledgment Receipt">
                        <i class="bi bi-award text-gold me-1"></i>Issue PAR
                    </a>
                    <a href="forms-ics.php" class="btn btn-outline-warning text-dark btn-sm fw-bold" title="Issue Inventory Custodian Slip">
                        <i class="bi bi-file-earmark-text text-gold me-1"></i>Issue ICS
                    </a>
                    <button class="btn btn-outline-success btn-sm fw-bold" onclick="window.exportAccountabilityCSV()" title="Export Custody CSV">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i>CSV
                    </button>
                    <button class="btn btn-outline-secondary btn-sm fw-bold" onclick="window.printAccountabilityMasterlist()" title="Print Accountability Masterlist">
                        <i class="bi bi-printer text-gold me-1"></i>Print Masterlist
                    </button>
                </div>
            </div>
        </div>

        <!-- Accountability Data Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="accountabilityMasterTable">
                        <thead class="table-marsu bg-marsu-burgundy text-white">
                            <tr>
                                <th class="py-3">Property No / Asset</th>
                                <th class="py-3">Accountable Custodian</th>
                                <th class="py-3">Designation / Office</th>
                                <th class="py-3">Form Type &amp; Slip No</th>
                                <th class="py-3">Date Assigned</th>
                                <th class="py-3">Acquisition Cost</th>
                                <th class="py-3">Custody Status</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="accountabilityTableBody">
                            <?php if (!empty($accountabilities)): ?>
                                <?php foreach ($accountabilities as $acc): ?>
                                    <tr>
                                        <td>
                                            <div class="font-monospace fw-bold text-marsu-burgundy"><?= e($acc['property_number']) ?></div>
                                            <div class="small text-muted"><?= e($acc['asset_description']) ?></div>
                                        </td>
                                        <td class="fw-semibold text-dark"><?= e($acc['custodian_name']) ?></td>
                                        <td>
                                            <div><?= e($acc['designation']) ?></div>
                                            <span class="badge bg-light text-dark border"><?= e($acc['office_code']) ?></span>
                                        </td>
                                        <td>
                                            <?php if (($acc['form_type'] ?? '') === 'PAR'): ?>
                                                <span class="badge bg-primary">PAR</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">ICS</span>
                                            <?php endif; ?>
                                            <span class="font-monospace small ms-1"><?= e($acc['slip_number']) ?></span>
                                        </td>
                                        <td class="small text-muted"><?= e(date('M d, Y', strtotime($acc['date_assigned']))) ?></td>
                                        <td class="font-monospace fw-bold">₱<?= number_format($acc['acquisition_cost'], 2) ?></td>
                                        <td>
                                            <?php if (($acc['custody_status'] ?? '') === 'Active Custody'): ?>
                                                <span class="badge bg-success">Active Custody</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><?= e($acc['custody_status']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing custody details for #<?= $acc['id'] ?>')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                        No custodianship records loaded. Data populated dynamically via SPMU accountability engine.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2 px-3 d-flex justify-content-between align-items-center bg-white border-top">
                <span class="small text-muted">All custodians are legally accountable under COA Circular 2020-006 and the Revised Administrative Code.</span>
                <span class="small font-monospace text-warning fw-bold" id="accountabilityTableCount">Showing <?= count($accountabilities ?? []) ?> records</span>
            </div>
        </div>

    </div>
    <!-- /.asset-module-content -->
</div>
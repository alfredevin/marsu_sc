<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .kpi-border-warning {
            border-left: 4px solid #ffc107 !important;
        }

        .kpi-border-danger {
            border-left: 4px solid #dc3545 !important;
        }

        .kpi-border-success {
            border-left: 4px solid #198754 !important;
        }

        .kpi-border-primary {
            border-left: 4px solid #0d6efd !important;
        }
    </style>

    <!-- Header & Single-Row Filter / Search Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">Demographic Risk & Geographic Vulnerability
                Monitoring</h6>
            <small class="text-muted">Macro institutional tracking of commuting distances, boarding house housing
                vulnerability, and guardian outreach.</small>
        </div>

        <form method="GET" action="" id="demoSearchForm" class="d-flex gap-2 align-items-center flex-wrap ms-auto">
            <div class="input-group input-group-sm" style="width: 220px;">
                <input type="search" id="demoSearchInput" name="q" class="form-control"
                    placeholder="Search ID / Name / Brgy..." value="<?= htmlspecialchars($search ?? '') ?>"
                    autocomplete="off">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
            </div>

            <!-- Program Filter -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">PROGRAM:</label>
            <select name="department" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Programs</option>
                <?php if (!empty($departments)): ?>
                    <?php foreach ($departments as $dItem): ?>
                        <?php $dCode = is_array($dItem) ? ($dItem['code'] ?? '') : $dItem; ?>
                        <option value="<?= htmlspecialchars($dCode) ?>" <?= ($department === $dCode) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dCode) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- Year Level Filter -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">YEAR:</label>
            <select name="year_level" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Years</option>
                <option value="1" <?= ($yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                <option value="2" <?= ($yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                <option value="3" <?= ($yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                <option value="4" <?= ($yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
            </select>

            <!-- Section Filter from Database -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SECTION:</label>
            <select name="section" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Sections</option>
                <?php if (!empty($sections)): ?>
                    <?php foreach ($sections as $sItem): ?>
                        <?php $sName = is_array($sItem) ? ($sItem['name'] ?? '') : $sItem; ?>
                        <option value="<?= htmlspecialchars($sName) ?>" <?= ($section === $sName) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sName) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- Municipality Filter -->
            <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">MUNICIPALITY:</label>
            <select name="municipality" class="form-select form-select-sm" style="width: auto;"
                onchange="this.form.submit()">
                <option value="">All Municipalities</option>
                <?php if (!empty($municipalities)): ?>
                    <?php foreach ($municipalities as $mun): ?>
                        <option value="<?= htmlspecialchars($mun) ?>" <?= ($municipality === $mun) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($mun) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <?php if (!empty($department) || !empty($yearLevel) || !empty($section) || !empty($municipality) || !empty($search)): ?>
                <a href="demographicinfo" class="btn btn-sm btn-outline-danger" title="Clear Filters">
                    <i class="bi bi-x-circle"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>


    <!-- DEMOGRAPHIC VULNERABILITY & GUARDIAN REACHABILITY LEDGER -->
    <div class="table-responsive bg-white rounded border shadow-sm">
        <table class="table table-hover align-middle mb-0" id="demoTable">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3">Student ID</th>
                    <th class="py-3">Student Name</th>
                    <th class="py-3">Program & Section</th>
                    <th class="py-3">Permanent Residence</th>
                    <th class="py-3">Living Arrangement</th>
                    <th class="py-3">Commuting / Distance Risk</th>
                    <th class="py-3">Guardian Reachability</th>
                    <th class="py-3 text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($demographicList)): ?>
                    <?php foreach ($demographicList as $row): ?>
                        <?php
                        $riskBadge = 'bg-success-subtle text-success border border-success-subtle';
                        if (stripos($row['commute_risk_level'], 'High') !== false) {
                            $riskBadge = 'bg-danger-subtle text-danger border border-danger-subtle';
                        } elseif (stripos($row['commute_risk_level'], 'Moderate') !== false) {
                            $riskBadge = 'bg-warning-subtle text-dark border border-warning-subtle';
                        }
                        ?>
                        <tr class="demo-student-row">
                            <td class="ps-3 fw-semibold text-secondary">
                                <?= htmlspecialchars($row['student_number']) ?>
                            </td>
                            <td class="fw-semibold text-dark">
                                <?= htmlspecialchars($row['full_name']) ?>
                            </td>
                            <td>
                                <span
                                    class="badge bg-light text-dark border"><?= htmlspecialchars($row['program_code']) ?></span>
                                <small class="text-muted d-block"><?= htmlspecialchars($row['section_name']) ?></small>
                            </td>
                            <td>
                                <i class="bi bi-geo-alt text-danger me-1"></i>
                                <?= htmlspecialchars($row['address']) ?>
                            </td>
                            <td>
                                <span
                                    class="badge <?= $row['living_arrangement'] === 'Boarding House' ? 'bg-warning-subtle text-dark border border-warning-subtle' : 'bg-light text-secondary border' ?>">
                                    <?= htmlspecialchars($row['living_arrangement']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?= $riskBadge ?>">
                                    <?= htmlspecialchars($row['commute_risk_level']) ?>
                                </span>
                            </td>
                            <td class="small">
                                <div class="fw-semibold text-dark">
                                    <?= htmlspecialchars($row['guardian_name'] ?? 'Not Recorded') ?></div>
                                <span class="text-muted"><i
                                        class="bi bi-telephone me-1"></i><?= htmlspecialchars($row['guardian_contact'] ?? 'No Contact') ?></span>
                            </td>
                            <td class="text-end pe-3">
                                <!-- Tumalon papunta sa Student Profile Dossier -->
                                <a href="profile?student_id=<?= urlencode($row['student_number']) ?>"
                                    class="btn btn-sm btn-outline-primary" title="View Full 360 Profile">
                                    View Dossier
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <p class="mb-0 fw-semibold">No demographic records found</p>
                            <small>No students matched the selected filters.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Server-Side Table Pagination -->
    <?= $pagination['html'] ?? '' ?>

</div>
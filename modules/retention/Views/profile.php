<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .btn-marsu {
            background-color: #58111a !important;
            color: #fff !important;
            border-color: #58111a !important;
        }

        .btn-marsu:hover {
            background-color: #420d13 !important;
            color: #fff !important;
        }

        .avatar-circle {
            width: 72px;
            height: 72px;
            background-color: #58111a;
            color: #ffffff;
            font-size: 26px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .nav-pills .nav-link {
            border-radius: 6px;
            padding: 10px 16px;
            color: #495057;
            transition: all 0.2s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #58111a !important;
            color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(88, 17, 26, 0.25);
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
            color: #58111a;
        }
    </style>

    <?php if (!empty($selectedStudent)): ?>
        <!-- ===================================================================== -->
        <!-- STATE 2: STUDENT 360° PROFILE DOSSIER (PINAGSAMANG 3 SUB-MODULES)    -->
        <!-- ===================================================================== -->

        <!-- Top Navigation Bar -->
        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="profile" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Student Directory
                </a>
                <span class="text-muted">|</span>
                <span class="small fw-bold text-secondary">Student 360° Comprehensive Dossier</span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print Dossier
                </button>
            </div>
        </div>

        <!-- Student Main Identity Banner Card -->
        <div class="card border rounded-3 shadow-sm mb-3 bg-white">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-circle shadow-sm">
                            <?= strtoupper(substr($selectedStudent['first_name'] ?? 'S', 0, 1) . substr($selectedStudent['last_name'] ?? 'M', 0, 1)) ?>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($selectedStudent['full_name']) ?></h4>
                            <div class="d-flex flex-wrap align-items-center gap-2 small text-muted">
                                <span class="badge bg-light text-secondary border px-2 py-1">
                                    <i class="bi bi-person-badge me-1"></i>
                                    <?= htmlspecialchars($selectedStudent['student_number']) ?>
                                </span>
                                <span>•</span>
                                <span class="fw-semibold text-dark">
                                    <?= htmlspecialchars($selectedStudent['program_name']) ?> (<?= htmlspecialchars($selectedStudent['program_code']) ?>)
                                </span>
                                <span>•</span>
                                <span>Year <?= htmlspecialchars((string) ($selectedStudent['year_level'] ?? 1)) ?> - Section: <strong class="text-dark"><?= htmlspecialchars($selectedStudent['section_name'] ?? '-') ?></strong></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-7 text-uppercase">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            <?= htmlspecialchars($selectedStudent['enrollment_status'] ?? 'Enrolled') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 SUB-MODULES NAVIGATOR TABS -->
        <ul class="nav nav-pills nav-fill bg-white p-2 rounded-3 border shadow-sm mb-4 gap-2" id="studentSubModuleTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold d-flex align-items-center justify-content-center gap-2 <?= ($activeTab === 'demographics') ? 'active' : '' ?>"
                        id="demographics-tab" data-bs-toggle="pill" data-bs-target="#pane-demographics" type="button" role="tab"
                        aria-controls="pane-demographics" aria-selected="<?= ($activeTab === 'demographics') ? 'true' : 'false' ?>">
                    <i class="bi bi-person-lines-fill fs-5"></i>
                    <span>Demographic Information</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold d-flex align-items-center justify-content-center gap-2 <?= ($activeTab === 'academic') ? 'active' : '' ?>"
                        id="academic-tab" data-bs-toggle="pill" data-bs-target="#pane-academic" type="button" role="tab"
                        aria-controls="pane-academic" aria-selected="<?= ($activeTab === 'academic') ? 'true' : 'false' ?>">
                    <i class="bi bi-clock-history fs-5"></i>
                    <span>Academic History & Transcript</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold d-flex align-items-center justify-content-center gap-2 <?= ($activeTab === 'enrollment') ? 'active' : '' ?>"
                        id="enrollment-tab" data-bs-toggle="pill" data-bs-target="#pane-enrollment" type="button" role="tab"
                        aria-controls="pane-enrollment" aria-selected="<?= ($activeTab === 'enrollment') ? 'true' : 'false' ?>">
                    <i class="bi bi-file-earmark-medical fs-5"></i>
                    <span>Program & Enrollment Records</span>
                </button>
            </li>
        </ul>

        <!-- TAB CONTENT CONTAINER -->
        <div class="tab-content" id="studentSubModuleContent">

            <!-- ================================================================= -->
            <!-- SUB-MODULE 1: DEMOGRAPHIC INFORMATION PANE                       -->
            <!-- ================================================================= -->
            <div class="tab-pane fade <?= ($activeTab === 'demographics') ? 'show active' : '' ?>" id="pane-demographics" role="tabpanel" aria-labelledby="demographics-tab">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <!-- Personal & Contact Identity -->
                        <div class="card border rounded-3 shadow-sm bg-white mb-3">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="fw-bold marsu-maroon-text mb-0">
                                    <i class="bi bi-person-lines-fill me-2"></i>Personal & Contact Identity
                                </h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Student Number:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($selectedStudent['student_number']) ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Gender:</span>
                                        <strong class="text-dark text-capitalize"><?= htmlspecialchars($selectedStudent['gender'] ?? 'Not Specified') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Date of Birth:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($selectedStudent['birthdate'] ?? 'N/A') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Institutional Email:</span>
                                        <strong class="text-primary"><?= htmlspecialchars($selectedStudent['email'] ?? 'N/A') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Mobile / Contact:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($selectedStudent['contact_number'] ?? 'N/A') ?></strong>
                                    </li>
                                    <li class="list-group-item px-0 py-2">
                                        <span class="text-muted d-block mb-1">Permanent Residence:</span>
                                        <strong class="text-dark">
                                            <i class="bi bi-geo-alt text-danger me-1"></i><?= htmlspecialchars($demographics['address'] ?? 'Marinduque') ?>
                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Retention Intervention Shortcuts -->
                        <div class="card border rounded-3 shadow-sm bg-white">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="fw-bold marsu-maroon-text mb-0">
                                    <i class="bi bi-lightning-charge-fill me-2"></i>Demographic Retention Actions
                                </h6>
                            </div>
                            <div class="card-body p-3">
                                <small class="text-muted d-block mb-2">Institutional outreach and retention interventions:</small>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="guidancereferrals?student_id=<?= urlencode($selectedStudent['student_number']) ?>" class="btn btn-sm btn-outline-warning text-dark">
                                        <i class="bi bi-person-heart me-1"></i> Refer to Guidance
                                    </a>
                                    <a href="atriskstudents?flag_student=<?= urlencode($selectedStudent['student_number']) ?>" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-shield-exclamation me-1"></i> Flag as At-Risk
                                    </a>
                                    <a href="advisingrecords?student_id=<?= urlencode($selectedStudent['student_number']) ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-journal-check me-1"></i> Log Advising Session
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- Guardian & Emergency Contact -->
                        <div class="card border rounded-3 shadow-sm bg-white mb-3">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="fw-bold marsu-maroon-text mb-0">
                                    <i class="bi bi-people-fill me-2"></i>Guardian & Emergency Contact
                                </h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Parent / Guardian:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($demographics['guardian_name'] ?? 'Not Recorded') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Guardian Contact:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($demographics['guardian_contact'] ?? 'Not Recorded') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Reachability Status:</span>
                                        <?php if (!empty($demographics['is_reachable'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">Reachable (Direct Mobile)</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning-subtle text-dark border border-warning-subtle">Unverified / No Contact</span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Housing & Geographic Vulnerability -->
                        <div class="card border rounded-3 shadow-sm bg-white">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="fw-bold marsu-maroon-text mb-0">
                                    <i class="bi bi-houses-fill me-2"></i>Housing & Commuting Vulnerability Assessment
                                </h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Living Arrangement:</span>
                                        <span class="badge <?= ($demographics['living_arrangement'] === 'Boarding House') ? 'bg-warning-subtle text-dark border' : 'bg-light text-secondary border' ?>">
                                            <i class="bi <?= ($demographics['living_arrangement'] === 'Boarding House') ? 'bi-building' : 'bi-house-heart' ?> me-1"></i>
                                            <?= htmlspecialchars($demographics['living_arrangement'] ?? 'With Family') ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Commute Risk Level:</span>
                                        <?php
                                        $cRisk = $demographics['commute_risk_level'] ?? 'Low (Local Resident)';
                                        $cBadge = (strpos($cRisk, 'High') !== false) ? 'bg-danger-subtle text-danger border-danger-subtle' :
                                                  ((strpos($cRisk, 'Moderate') !== false) ? 'bg-warning-subtle text-dark border-warning-subtle' : 'bg-success-subtle text-success border-success-subtle');
                                        ?>
                                        <span class="badge <?= $cBadge ?> border">
                                            <?= htmlspecialchars($cRisk) ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item px-0 py-2">
                                        <small class="text-muted d-block mb-1">Retention Risk Assessment:</small>
                                        <p class="mb-0 text-secondary">
                                            <?= (strpos($cRisk, 'High') !== false) 
                                                ? 'Student commutes from a distant municipality. Higher risk of absenteeism due to travel time and commute expenses.' 
                                                : (($demographics['living_arrangement'] === 'Boarding House') 
                                                    ? 'Staying in a boarding house near campus. Moderate risk due to living expenses and distance from family.' 
                                                    : 'Living with family near campus. Low demographic vulnerability risk.') ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================================================================= -->
            <!-- SUB-MODULE 2: ACADEMIC HISTORY & TRANSCRIPT PANE                 -->
            <!-- ================================================================= -->
            <div class="tab-pane fade <?= ($activeTab === 'academic') ? 'show active' : '' ?>" id="pane-academic" role="tabpanel" aria-labelledby="academic-tab">
                <!-- Academic Summary KPI Banner Card -->
                <div class="card border rounded-3 shadow-sm mb-3 bg-white">
                    <div class="card-body p-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <h6 class="fw-bold marsu-maroon-text mb-1">
                                    <i class="bi bi-mortarboard-fill me-2"></i>Scholastic Standing & Cumulative Performance
                                </h6>
                                <small class="text-muted">Permanent academic trajectory, GWA tracking, and prerequisite block audit.</small>
                            </div>
                            <div>
                                <?php
                                $cumGwa = $academicHistory['cumulativeGwa'] ?? 2.00;
                                $failUnits = $academicHistory['totalFailedUnits'] ?? 0;
                                ?>
                                <?php if ($cumGwa <= 1.75 && $failUnits == 0): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-7">
                                        <i class="bi bi-award-fill me-1"></i> Dean's Lister Tier (Honor)
                                    </span>
                                <?php elseif ($failUnits > 0 || $cumGwa > 3.00): ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 fs-7">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Scholastic Deficiency / Probation
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 fs-7">
                                        <i class="bi bi-check-circle-fill me-1"></i> Good Academic Standing
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 4 Stat Boxes -->
                        <div class="row g-2 mt-3 pt-3 border-top">
                            <div class="col-sm-3 col-6">
                                <small class="text-muted d-block">Cumulative GWA</small>
                                <h4 class="fw-bold mb-0 <?= ($cumGwa > 3.00) ? 'text-danger' : 'text-primary' ?>">
                                    <?= number_format($cumGwa, 2) ?>
                                </h4>
                            </div>
                            <div class="col-sm-3 col-6">
                                <small class="text-muted d-block">Credited Units Passed</small>
                                <h4 class="fw-bold mb-0 text-success"><?= number_format($academicHistory['totalEarnedUnits'] ?? 0, 1) ?></h4>
                            </div>
                            <div class="col-sm-3 col-6">
                                <small class="text-muted d-block">Deficiency / Failed Units</small>
                                <h4 class="fw-bold mb-0 <?= ($failUnits > 0) ? 'text-danger' : 'text-muted' ?>">
                                    <?= number_format($failUnits, 1) ?>
                                </h4>
                            </div>
                            <div class="col-sm-3 col-6">
                                <small class="text-muted d-block">Endorsement</small>
                                <div class="d-flex gap-1 mt-1">
                                    <a href="academicsupportprograms?student_id=<?= urlencode($selectedStudent['student_number']) ?>" class="btn btn-sm btn-outline-primary" title="Endorse to Peer Tutoring">
                                        <i class="bi bi-mortarboard me-1"></i> Peer Tutoring
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Term Breakdown Ledger -->
                <?php if (!empty($academicHistory['groupedRecords'])): ?>
                    <?php foreach ($academicHistory['groupedRecords'] as $term): ?>
                        <div class="card border rounded-3 shadow-sm mb-3 bg-white">
                            <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <span class="fw-bold text-dark"><i class="bi bi-calendar-check me-1 text-primary"></i> <?= htmlspecialchars($term['term_label']) ?></span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small">
                                    <span class="badge bg-white text-dark border">Term Units: <strong><?= number_format($term['term_units'], 1) ?></strong></span>
                                    <span class="badge bg-white text-dark border">Passed: <strong><?= number_format($term['passed_units'], 1) ?></strong></span>
                                    <span class="badge <?= ($term['term_gpa'] > 3.00) ? 'bg-danger text-white' : 'bg-primary text-white' ?>">
                                        Term GPA: <strong><?= ($term['term_gpa'] > 0) ? number_format($term['term_gpa'], 2) : 'N/A' ?></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                    <thead class="table-light text-uppercase small text-muted">
                                        <tr>
                                            <th class="ps-3 py-2">Course Code</th>
                                            <th class="py-2">Course Title</th>
                                            <th class="py-2 text-center">Units</th>
                                            <th class="py-2 text-center">Final Grade</th>
                                            <th class="py-2 text-center">Remarks</th>
                                            <th class="py-2 text-end pe-3">Curricular Flag</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($term['records'] as $rec): ?>
                                            <?php
                                            $isFailed = ($rec['remarks'] === 'FAILED');
                                            $isInc = ($rec['remarks'] === 'INCOMPLETE');
                                            ?>
                                            <tr>
                                                <td class="ps-3 fw-bold text-secondary"><?= htmlspecialchars($rec['course_code']) ?></td>
                                                <td class="fw-semibold text-dark"><?= htmlspecialchars($rec['course_title']) ?></td>
                                                <td class="text-center"><?= number_format($rec['units'], 1) ?></td>
                                                <td class="text-center fw-bold fs-6 <?= $isFailed ? 'text-danger' : ($isInc ? 'text-warning' : 'text-primary') ?>">
                                                    <?= htmlspecialchars($rec['grade']) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($isFailed): ?>
                                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">FAILED</span>
                                                    <?php elseif ($isInc): ?>
                                                        <span class="badge bg-warning-subtle text-dark border border-warning-subtle">INCOMPLETE</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle">PASSED</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end pe-3">
                                                    <?php if ($isFailed): ?>
                                                        <span class="badge bg-danger text-white">Prerequisite Blocked</span>
                                                    <?php elseif ($isInc): ?>
                                                        <span class="badge bg-warning text-dark">Removal Required</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-light text-secondary border">Credited</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card border rounded-3 p-4 text-center bg-white">
                        <i class="bi bi-journal-x fs-1 text-muted mb-2"></i>
                        <h6 class="fw-bold text-secondary">No Transcript Records Found</h6>
                        <small class="text-muted">No academic history records currently encoded for this student in the curriculum database.</small>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ================================================================= -->
            <!-- SUB-MODULE 3: PROGRAM & ENROLLMENT RECORDS PANE                   -->
            <!-- ================================================================= -->
            <div class="tab-pane fade <?= ($activeTab === 'enrollment') ? 'show active' : '' ?>" id="pane-enrollment" role="tabpanel" aria-labelledby="enrollment-tab">
                <div class="row g-3 mb-3">
                    <!-- Degree Program Dossier -->
                    <div class="col-lg-6">
                        <div class="card border rounded-3 shadow-sm bg-white h-100">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="fw-bold marsu-maroon-text mb-0">
                                    <i class="bi bi-mortarboard-fill me-2"></i>Degree Program & Academic Department
                                </h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Degree Program:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($enrollmentRecord['program_name'] ?? 'N/A') ?> (<?= htmlspecialchars($enrollmentRecord['program_code'] ?? 'N/A') ?>)</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Department / College:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($enrollmentRecord['department_name'] ?? 'N/A') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Department Chairperson:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($enrollmentRecord['department_head'] ?? 'N/A') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Curricular Duration:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($enrollmentRecord['program_years'] ?? '4 Years') ?></strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment & Registration Standing -->
                    <div class="col-lg-6">
                        <div class="card border rounded-3 shadow-sm bg-white h-100">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="fw-bold marsu-maroon-text mb-0">
                                    <i class="bi bi-card-checklist me-2"></i>Registration & Matriculation Details
                                </h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Active Academic Year:</span>
                                        <strong class="text-primary"><?= htmlspecialchars($enrollmentRecord['academic_year'] ?? 'A.Y. 2026-2027') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Active Semester:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($enrollmentRecord['semester'] ?? '1st Semester') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Year Level & Section:</span>
                                        <strong class="text-dark"><?= htmlspecialchars($enrollmentRecord['year_level'] ?? '1st Year') ?> - <?= htmlspecialchars($enrollmentRecord['section_name'] ?? '-') ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Registration Status:</span>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            <?= htmlspecialchars($enrollmentRecord['enrollment_status'] ?? 'Enrolled') ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                        <span class="text-muted">Admission Date:</span>
                                        <strong class="text-secondary"><?= htmlspecialchars($enrollmentRecord['admission_date'] ?? 'N/A') ?></strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Term Enrolled Subjects -->
                <div class="card border rounded-3 shadow-sm bg-white">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h6 class="fw-bold marsu-maroon-text mb-0">
                                <i class="bi bi-book-half me-2"></i>Active Term Enrolled Course Load
                            </h6>
                            <small class="text-muted">Officially matriculated subjects for the current semester.</small>
                        </div>
                        <div>
                            <span class="badge marsu-maroon-bg px-3 py-2 fs-7">
                                Total Enrolled Load: <?= number_format($enrollmentRecord['total_enrolled_units'] ?? 0, 1) ?> Units
                            </span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                            <thead class="table-light text-uppercase small text-muted">
                                <tr>
                                    <th class="ps-3 py-3">Course Code</th>
                                    <th class="py-3">Course Title</th>
                                    <th class="py-3 text-center">Lec Hours</th>
                                    <th class="py-3 text-center">Lab Hours</th>
                                    <th class="py-3 text-center">Credit Units</th>
                                    <th class="py-3">Prerequisites</th>
                                    <th class="py-3 text-end pe-3">Enrollment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($enrollmentRecord['enrolled_subjects'])): ?>
                                    <?php foreach ($enrollmentRecord['enrolled_subjects'] as $sub): ?>
                                        <tr>
                                            <td class="ps-3 fw-bold text-secondary"><?= htmlspecialchars($sub['code']) ?></td>
                                            <td class="fw-semibold text-dark"><?= htmlspecialchars($sub['title']) ?></td>
                                            <td class="text-center"><?= number_format($sub['lecture_hours'] ?? 3.0, 1) ?></td>
                                            <td class="text-center"><?= number_format($sub['lab_hours'] ?? 0.0, 1) ?></td>
                                            <td class="text-center fw-bold text-primary"><?= number_format($sub['units'] ?? 3.0, 1) ?></td>
                                            <td class="small text-muted"><?= htmlspecialchars($sub['prerequisites'] ?: 'None') ?></td>
                                            <td class="text-end pe-3">
                                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                    Official Enrolled
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">No active enrolled subjects recorded for this term.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    <?php else: ?>
        <!-- ===================================================================== -->
        <!-- STATE 1: STUDENT MASTER DIRECTORY ROSTER (DIRECTORY VIEW)            -->
        <!-- ===================================================================== -->

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">Institutional Student Identity Directory</h6>
                <small class="text-muted">Master authenticated directory with Demographics, Academic History, and Enrollment dossiers.</small>
            </div>

            <form method="GET" action="" id="searchForm" class="d-flex gap-2 align-items-center flex-wrap ms-auto">
                <!-- Search Input na may Instant Filter & Clear Support -->
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="search" id="searchInput" name="q" class="form-control" placeholder="Search ID / Name..."
                        value="<?= htmlspecialchars($search ?? '') ?>" oninput="handleSearchInput(this)" autocomplete="off">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>

                <!-- Program Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">PROGRAM:</label>
                <select name="department" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Programs</option>
                    <?php foreach ($departments as $d): ?>
                        <?php $dCode = is_array($d) ? ($d['code'] ?? '') : $d; ?>
                        <option value="<?= htmlspecialchars($dCode) ?>" <?= ($department === $dCode) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dCode) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Year Level Filter -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">YEAR LEVEL:</label>
                <select name="year_level" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Year Levels</option>
                    <option value="1" <?= ($yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                    <option value="2" <?= ($yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                    <option value="3" <?= ($yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                    <option value="4" <?= ($yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
                </select>

                <!-- Dynamic Section Filter from Database -->
                <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">SECTION:</label>
                <select name="section" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="">All Sections</option>
                    <?php foreach ($sections as $sItem): ?>
                        <?php
                        $secName = is_array($sItem) ? ($sItem['name'] ?? '') : $sItem;
                        ?>
                        <option value="<?= htmlspecialchars($secName) ?>" <?= ($section === $secName) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($secName) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($department) || !empty($yearLevel) || !empty($section) || !empty($search)): ?>
                    <a href="profile" class="btn btn-sm btn-outline-danger" title="Clear Filters & Search">
                        <i class="bi bi-x-circle"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-responsive bg-white rounded-3 border shadow-sm">
            <table class="table table-hover align-middle mb-0" id="rosterTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name & Identity</th>
                        <th class="py-3">Degree Program</th>
                        <th class="py-3 text-center">Section</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-center">Demographics</th>
                        <th class="py-3 text-center">Academic History</th>
                        <th class="py-3 text-end pe-3">Program & Enrollment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($studentList)): ?>
                        <?php foreach ($studentList as $row): ?>
                            <?php $sKey = $row['student_number'] ?? $row['id']; ?>
                            <tr class="student-row">
                                <td class="ps-3 fw-semibold text-secondary col-id">
                                    <?= htmlspecialchars($sKey) ?>
                                </td>
                                <td class="col-name">
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1 text-danger"></i><?= htmlspecialchars($row['address'] ?? 'Marinduque') ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= htmlspecialchars($row['program_code'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-bold fs-7">
                                        <?= htmlspecialchars($row['section_name'] ?? '-') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle text-capitalize">
                                        <?= htmlspecialchars($row['enrollment_status'] ?? 'Enrolled') ?>
                                    </span>
                                </td>
                                <!-- SUBMODULE 1: DEMOGRAPHICS BUTTON -->
                                <td class="text-center">
                                    <a href="profile?student_id=<?= urlencode($sKey) ?>&tab=demographics"
                                       class="btn btn-sm btn-outline-primary fw-semibold" title="View Student Demographics">
                                        <i class="bi bi-person-lines-fill me-1"></i> Demographics
                                    </a>
                                </td>
                                <!-- SUBMODULE 2: ACADEMIC HISTORY BUTTON -->
                                <td class="text-center">
                                    <a href="profile?student_id=<?= urlencode($sKey) ?>&tab=academic"
                                       class="btn btn-sm btn-outline-info text-dark fw-semibold" title="View Academic Transcript">
                                        <i class="bi bi-clock-history me-1"></i> Academic History
                                    </a>
                                </td>
                                <!-- SUBMODULE 3: PROGRAM & ENROLLMENT RECORDS BUTTON -->
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($sKey) ?>&tab=enrollment"
                                       class="btn btn-sm btn-outline-success fw-semibold" title="View Program & Enrollment Records">
                                        <i class="bi bi-file-earmark-medical me-1"></i> Enrollment Records
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No student records found</p>
                                <small>No records matched your search query or selected filters.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <script>
            const hadServerQuery = <?= !empty($search) ? 'true' : 'false' ?>;

            function handleSearchInput(input) {
                const query = input.value.trim().toLowerCase();
                const rows = document.querySelectorAll('.student-row');

                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = (query === '' || text.includes(query)) ? '' : 'none';
                });

                if (query === '' && hadServerQuery) {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('q');
                    window.location.href = url.toString();
                }
            }

            const searchBox = document.getElementById('searchInput');
            if (searchBox) {
                searchBox.addEventListener('search', function () {
                    if (this.value === '' && hadServerQuery) {
                        const url = new URL(window.location.href);
                        url.searchParams.delete('q');
                        window.location.href = url.toString();
                    }
                });
            }
        </script>

    <?php endif; ?>

</div>
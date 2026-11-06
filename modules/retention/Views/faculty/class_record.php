<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Faculty Class Record & Evaluation Matrix (class_record.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-table-header {
            background-color: #58111a !important;
            color: #ffffff !important;
            font-weight: 700;
            vertical-align: middle;
            border-color: #6d1b26 !important;
        }

        .marsu-sub-header {
            background-color: #480c14 !important;
            color: #ffffff !important;
            font-size: 11px;
            font-weight: 600;
            border-color: #5a121c !important;
            padding: 4px 6px !important;
        }

        .score-input-matrix {
            width: 52px;
            height: 28px;
            font-size: 11.5px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            color: #1e40af;
            background-color: #f8fafc;
        }

        .score-input-matrix:focus {
            background-color: #fff;
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .score-input-matrix:disabled, .score-input-matrix[readonly] {
            background-color: #f1f5f9;
            color: #475569;
            border-color: #e2e8f0;
            cursor: not-allowed;
        }

        .badge-att-p {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
            font-weight: 700;
            padding: 2px 5px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10.5px;
        }

        .badge-att-a {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            font-weight: 700;
            padding: 2px 5px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10.5px;
        }

        .badge-att-l {
            background-color: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
            font-weight: 700;
            padding: 2px 5px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10.5px;
        }

        .badge-att-e {
            background-color: #cff4fc;
            color: #055160;
            border: 1px solid #b6effb;
            font-weight: 700;
            padding: 2px 5px;
            border-radius: 4px;
            display: inline-block;
            font-size: 10.5px;
        }

        .trans-grade-text {
            color: #2563eb;
            font-weight: 700;
            font-size: 11.5px;
        }

        .comp-total-text {
            color: #7f1d1d;
            font-weight: 800;
            font-size: 12px;
        }
    </style>

    <!-- Top Navigation & Information Card -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="<?= url('retention/faculty/classes') ?>" class="btn btn-sm btn-outline-secondary me-1">
                        <i class="bi bi-arrow-left me-1"></i> Back to Classes
                    </a>
                    <div class="rounded p-2 d-flex align-items-center justify-content-center text-white" 
                         style="background-color: #800020; width: 38px; height: 38px;">
                        <i class="bi bi-file-earmark-spreadsheet-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">
                            <?= e($class['subject_code']) ?>: <?= e($class['subject_title']) ?>
                        </h6>
                        <small class="text-muted" style="font-size: 11.5px;">
                            Section: <strong class="text-dark"><?= e($class['section_name']) ?></strong> • 
                            <?= e($class['semester_name'] ?? 'Current Term') ?> • 
                            Linear Transmutation: <span class="text-danger fw-semibold">5 - 4*(Score/Total)</span>
                        </small>
                    </div>
                </div>

                <!-- Status & Action Toolbar -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <!-- Autosave Indicator -->
                    <span id="autosaveStatus" class="badge bg-light text-muted border px-2 py-1 small">
                        <i class="bi bi-cloud-check text-success me-1"></i> All scores saved
                    </span>

                    <!-- Filter Badges -->
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary active filter-status-btn" data-filter="all">All</button>
                        <button type="button" class="btn btn-outline-success filter-status-btn" data-filter="passed">Passed</button>
                        <button type="button" class="btn btn-outline-danger filter-status-btn" data-filter="failed">Failed</button>
                    </div>

                    <?php if ($class['grade_status'] === 'draft'): ?>
                        <?php if ($allowCustomWeights): ?>
                            <button type="button" class="btn btn-sm btn-outline-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#customizeSchemeModal">
                                <i class="bi bi-sliders me-1"></i> Customize Weights
                            </button>
                        <?php endif; ?>

                        <button type="button" class="btn btn-sm btn-outline-primary fw-semibold" onclick="manualSaveScores()">
                            <i class="bi bi-floppy me-1"></i> Save Scores
                        </button>

                        <button type="button" class="btn btn-sm text-white fw-semibold px-3" style="background-color: #800020;" data-bs-toggle="modal" data-bs-target="#postGradesModal">
                            <i class="bi bi-check2-circle me-1"></i> Post Final Grades
                        </button>
                    <?php elseif ($class['grade_status'] === 'posted'): ?>
                        <span class="badge bg-success-subtle text-success border border-success px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i> Grades Officially Posted
                        </span>
                        <?php if (empty($pendingCorrection)): ?>
                            <button type="button" class="btn btn-sm btn-outline-warning text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#correctionRequestModal">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Request Correction
                            </button>
                        <?php else: ?>
                            <span class="badge bg-warning-subtle text-warning border border-warning px-2 py-1">
                                <i class="bi bi-hourglass-split me-1"></i> Correction Pending Review
                            </span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="badge bg-secondary-subtle text-secondary border border-secondary px-3 py-2">
                            <i class="bi bi-lock-fill me-1"></i> Term Closed & Locked
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sub Metadata Info Bar -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap small">
                    <span class="badge bg-light text-dark border px-2 py-1">
                        <i class="bi bi-diagram-3 me-1 text-primary"></i> Scheme: <strong><?= e($scheme['name'] ?? 'Custom Scheme') ?></strong>
                    </span>
                    <span class="badge px-2 py-1" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171;">
                        Passing Threshold: ≤ <strong><?= number_format((float) ($scheme['passingCutoff'] ?? 3.04), 2) ?></strong>
                    </span>
                    <span class="badge bg-light text-secondary border px-2 py-1">
                        <i class="bi bi-calendar-event me-1"></i> Attendance Sessions: <strong><?= count($recordedDates) ?></strong>
                    </span>
                </div>
                <div class="text-muted small">
                    Enrolled Students: <span class="fw-bold text-dark"><?= count($students) ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- ROSTER INTAKE BAR (Available only in Draft status) -->
    <?php if ($class['grade_status'] === 'draft'): ?>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-2 bg-light rounded d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="small fw-bold text-secondary text-uppercase ms-1">Roster Intake:</span>

                    <!-- Pull Students from Central Section Masterlist -->
                    <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/roster/pull-section') ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-outline-primary" onclick="return confirm('Synchronize students registered in <?= e($class['section_name']) ?> from central records?');">
                            <i class="bi bi-cloud-arrow-down me-1"></i> Pull Section Masterlist
                        </button>
                    </form>

                    <!-- Upload CSV File -->
                    <label class="btn btn-sm btn-outline-success mb-0" style="cursor: pointer;">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Upload CSV Roster
                        <input type="file" id="csvFileInput" accept=".csv, .txt" hidden onchange="handleCsvUpload(this)">
                    </label>
                </div>

                <!-- Quick Add Student -->
                <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/roster/add') ?>" class="d-flex align-items-center gap-1">
                    <?= csrf_field() ?>
                    <input type="text" name="student_search" class="form-control form-control-sm" placeholder="Student ID or Name" style="width: 200px;" required>
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="bi bi-person-plus me-1"></i> Add
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- DYNAMIC MATRIX TABLE -->
    <div class="table-responsive bg-white rounded border shadow-sm" style="max-height: 72vh;">
        <table class="table table-bordered table-hover align-middle mb-0 text-center" id="matrixTable" style="font-size: 11.5px;">
            <thead class="sticky-top">
                <!-- Group Headers Row -->
                <tr>
                    <th rowspan="2" class="marsu-table-header" style="width: 35px;">#</th>
                    <th rowspan="2" class="marsu-table-header text-start ps-3" style="min-width: 180px;">Student Name</th>
                    
                    <?php 
                    $groups = $scheme['groups'] ?? [];
                    foreach ($groups as $grp): 
                        $grpItems = $grp['items'] ?? [];
                        $hasAtt = !empty($grp['hasAttendance']) && !empty($recordedDates);
                        $colSpan = (count($grpItems) * 2) + ($hasAtt ? (count($recordedDates) + 2) : 0) + 1;
                    ?>
                        <th colspan="<?= $colSpan ?>" class="marsu-table-header text-uppercase py-2 border-start border-end">
                            <?= e($grp['title'] ?? 'Assessment Group') ?> (<?= (float) ($grp['weight'] ?? 0) ?>%)
                        </th>
                    <?php endforeach; ?>

                    <th rowspan="2" class="marsu-table-header" style="min-width: 85px;">FINAL GRADE</th>
                    <th rowspan="2" class="marsu-table-header" style="min-width: 95px;">REMARKS</th>
                    <th rowspan="2" class="marsu-table-header" style="width: 75px;">ACTIONS</th>
                </tr>

                <!-- Sub Headers Row -->
                <tr>
                    <?php foreach ($groups as $grp): 
                        $grpItems = $grp['items'] ?? [];
                        $hasAtt = !empty($grp['hasAttendance']) && !empty($recordedDates);
                    ?>
                        <?php foreach ($grpItems as $it): ?>
                            <th class="marsu-sub-header text-center" style="min-width: 52px;">
                                <div style="font-size: 10px; opacity: 0.85;"><?= (float) ($it['maxScore'] ?? 100) ?> pts</div>
                                <div class="fw-bold"><?= e($it['code']) ?></div>
                            </th>
                            <th class="marsu-sub-header text-center" style="min-width: 55px; opacity: 0.9;">
                                <?= e($it['code']) ?> Trans
                            </th>
                        <?php endforeach; ?>

                        <?php if ($hasAtt): ?>
                            <?php foreach ($recordedDates as $d): ?>
                                <th class="marsu-sub-header text-center" style="min-width: 45px; font-size: 10px;">
                                    <?= date('m/d', strtotime($d)) ?>
                                </th>
                            <?php endforeach; ?>
                            <th class="marsu-sub-header text-center" style="min-width: 42px;">ATT</th>
                            <th class="marsu-sub-header text-center" style="min-width: 55px;">ATT Trans</th>
                        <?php endif; ?>

                        <th class="marsu-sub-header text-center bg-danger-subtle text-dark fw-bold" style="min-width: 65px;">
                            TOTAL (<?= (float) ($grp['weight'] ?? 0) ?>%)
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody id="matrixTableBody">
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="50" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <p class="mb-0 fw-semibold">No students enrolled in this class record yet</p>
                            <small>Click "Pull Section Masterlist" or "Upload CSV Roster" above to enroll students.</small>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $isEditable = ($class['grade_status'] === 'draft');
                    $passingThreshold = (float) ($scheme['passingCutoff'] ?? 3.04);
                    foreach ($students as $idx => $std): 
                        $sid = (int) $std['student_id'];
                        $stdScores = $scoresMap[$sid] ?? [];
                        $stdAtt = $attendanceMap[$sid] ?? ['present' => 0, 'late' => 0, 'excused' => 0, 'absent' => 0, 'total' => 0, 'dates' => []];
                        $postedEntry = $postedGradesMap[$sid] ?? null;
                    ?>
                        <tr id="row_<?= $sid ?>" class="student-row align-middle" data-student-id="<?= $sid ?>">
                            <td class="fw-bold text-muted"><?= $idx + 1 ?></td>
                            <td class="text-start ps-3">
                                <a href="<?= url('retention/faculty/students/' . $sid) ?>" class="text-decoration-none fw-bold text-dark hover-primary" style="font-size: 12.5px;">
                                    <?= e($std['last_name'] . ', ' . $std['first_name']) ?>
                                </a>
                                <div class="text-muted" style="font-size: 10px;">
                                    <?= e($std['student_number']) ?> • <?= e($std['program_code'] ?? 'BSIS') ?>
                                </div>
                            </td>

                            <?php 
                            $overallComputedGrade = 0.0;
                            foreach ($groups as $grp): 
                                $grpWeight = (float) ($grp['weight'] ?? 0);
                                $grpItems = $grp['items'] ?? [];
                                $hasAtt = !empty($grp['hasAttendance']) && !empty($recordedDates);
                                $groupTransSum = 0.0;
                                $componentCount = 0;
                            ?>
                                <?php foreach ($grpItems as $it): 
                                    $itCode = $it['code'];
                                    $maxScore = (float) ($it['maxScore'] ?? 100);
                                    $scoreData = $stdScores[$itCode] ?? ['score' => 0.0, 'submission_status' => 'regular', 'notes' => ''];
                                    $rawVal = (float) ($scoreData['score'] ?? 0.0);
                                    
                                    // Formula: 5 - 4*(score/maxScore)
                                    $ratio = ($maxScore > 0) ? max(0.0, min(1.0, $rawVal / $maxScore)) : 0.0;
                                    $trans = round(5.00 - (4.00 * $ratio), 2);
                                    $groupTransSum += $trans;
                                    $componentCount++;
                                ?>
                                    <td>
                                        <input type="number" step="any" min="0" max="<?= $maxScore ?>"
                                               class="score-input-matrix"
                                               value="<?= $rawVal ?>"
                                               data-student-id="<?= $sid ?>"
                                               data-item-code="<?= e($itCode) ?>"
                                               data-max-score="<?= $maxScore ?>"
                                               <?= !$isEditable ? 'disabled' : '' ?>
                                               onchange="handleScoreChange(<?= $sid ?>, '<?= e($itCode) ?>', <?= $maxScore ?>, this.value)">
                                    </td>
                                    <td class="trans-grade-text" id="trans_<?= $sid ?>_<?= e($itCode) ?>">
                                        <?= number_format($trans, 2) ?>
                                    </td>
                                <?php endforeach; ?>

                                <?php if ($hasAtt): 
                                    $totalAttSessions = count($recordedDates);
                                    $pCount = (int) ($stdAtt['present'] ?? 0);
                                    $lCount = (int) ($stdAtt['late'] ?? 0);
                                    $eCount = (int) ($stdAtt['excused'] ?? 0);
                                    $lateWeight = (float) RetentionSettings::get('attendance.late_weight', 0.75);
                                    $effectivePresent = $pCount + ($lCount * $lateWeight) + $eCount;
                                    $attRatio = ($totalAttSessions > 0) ? max(0.0, min(1.0, $effectivePresent / $totalAttSessions)) : 1.0;
                                    $attTrans = round(5.00 - (4.00 * $attRatio), 2);
                                    $groupTransSum += $attTrans;
                                    $componentCount++;
                                ?>
                                    <?php foreach ($recordedDates as $d): 
                                        $dStatus = $stdAtt['dates'][$d] ?? 'Absent';
                                        $badgeClass = ($dStatus === 'Present') ? 'badge-att-p' : (($dStatus === 'Late') ? 'badge-att-l' : (($dStatus === 'Excused') ? 'badge-att-e' : 'badge-att-a'));
                                    ?>
                                        <td>
                                            <span class="<?= $badgeClass ?>" title="<?= e($dStatus) ?> on <?= e($d) ?>">
                                                <?= substr($dStatus, 0, 1) ?>
                                            </span>
                                        </td>
                                    <?php endforeach; ?>
                                    <td class="fw-bold text-dark" id="att_count_<?= $sid ?>"><?= $pCount ?></td>
                                    <td class="trans-grade-text" id="att_trans_<?= $sid ?>"><?= number_format($attTrans, 2) ?></td>
                                <?php endif; ?>

                                <?php 
                                $avgTrans = ($componentCount > 0) ? ($groupTransSum / $componentCount) : 5.00;
                                $grpShare = round($avgTrans * ($grpWeight / 100.0), 2);
                                $overallComputedGrade += $grpShare;
                                ?>
                                <td class="comp-total-text" id="grp_total_<?= $sid ?>_<?= e($grp['id'] ?? 'g') ?>">
                                    <?= number_format($grpShare, 2) ?>
                                </td>
                            <?php endforeach; ?>

                            <?php 
                            $finalComputed = round($overallComputedGrade, 2);
                            $isPassed = ($finalComputed <= $passingThreshold);
                            
                            // If posted, show official posted values
                            if ($postedEntry) {
                                $displayGrade = $postedEntry['final_grade'];
                                $displayRemarks = $postedEntry['remarks'];
                                $isPassed = ($displayRemarks === 'Passed');
                            } else {
                                $displayGrade = number_format($finalComputed, 2);
                                $displayRemarks = $isPassed ? 'PASSED' : 'FAILED';
                            }
                            ?>
                            <td class="fw-bold fs-6 text-primary" id="final_grade_<?= $sid ?>">
                                <?= e($displayGrade) ?>
                            </td>
                            <td id="remarks_<?= $sid ?>">
                                <?php if ($displayGrade === 'INC' || $displayRemarks === 'Incomplete'): ?>
                                    <span class="badge bg-warning text-dark border border-warning">INCOMPLETE</span>
                                <?php elseif ($isPassed): ?>
                                    <span class="badge bg-success">PASSED</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">FAILED</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-xs btn-outline-secondary py-0 px-1" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm small">
                                        <li>
                                            <a class="dropdown-item" href="<?= url('retention/faculty/students/' . $sid) ?>">
                                                <i class="bi bi-person me-2"></i>View Academic Record
                                            </a>
                                        </li>
                                        <?php if ($isEditable): ?>
                                            <li>
                                                <button class="dropdown-item" type="button" onclick="openTaskExceptionModal(<?= $sid ?>, '<?= e($std['last_name'] . ', ' . $std['first_name']) ?>')">
                                                    <i class="bi bi-flag me-2 text-warning"></i>Log Task Exception
                                                </button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/roster/remove') ?>">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="student_id" value="<?= $sid ?>">
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Remove student from class roster?');">
                                                        <i class="bi bi-trash me-2"></i>Remove from Roster
                                                    </button>
                                                </form>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($class['grade_status'] === 'posted' && ($displayGrade === 'INC' || $displayRemarks === 'Incomplete')): ?>
                                            <li>
                                                <button class="dropdown-item text-primary" type="button" onclick="openResolveIncModal(<?= $sid ?>, '<?= e($std['last_name'] . ', ' . $std['first_name']) ?>')">
                                                    <i class="bi bi-check2-square me-2"></i>Resolve Incomplete (INC)
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- MODAL 1: POST FINAL GRADES CONFIRMATION -->
<div class="modal fade" id="postGradesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #800020;">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-shield-check me-2"></i>Confirm Final Grade Posting
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/post') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <p class="text-dark fw-semibold mb-2">
                        Are you sure you want to officially compute and post final grades for this class?
                    </p>
                    <div class="alert alert-warning small mb-3">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        <strong>Important:</strong> Posting saves an immutable academic snapshot to student portals. 
                        Once posted, score inputs will be locked. Further changes will require a formal Grade Correction Request approved by the administrator.
                    </div>
                    <ul class="small text-muted mb-0">
                        <li>Subject: <strong><?= e($class['subject_code']) ?> (<?= e($class['subject_title']) ?>)</strong></li>
                        <li>Section: <strong><?= e($class['section_name']) ?></strong></li>
                        <li>Enrolled Roster: <strong><?= count($students) ?> Students</strong></li>
                        <li>Transmutation: <strong>Linear Formula 5 - 4*(Score/Total)</strong></li>
                    </ul>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white fw-semibold px-4" style="background-color: #800020;">
                        <i class="bi bi-check-lg me-1"></i> Post Final Grades Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL 2: GRADE CORRECTION REQUEST -->
<div class="modal fade" id="correctionRequestModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning-subtle text-dark border-bottom">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-arrow-counterclockwise me-2"></i>Submit Grade Correction Request
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/correction-request') ?>">
                <?= csrf_field() ?>
                <div class="modal-body p-4">
                    <p class="small text-muted mb-3">
                        Per institutional governance policy, grade corrections for posted offerings require review and approval by the module administrator before the scoring matrix is unlocked.
                    </p>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">JUSTIFICATION & REASON FOR CORRECTION *</label>
                        <textarea name="reason" class="form-control form-control-sm" rows="4" placeholder="Detail the specific clerical error, missing requirement, or scoring discrepancy that necessitates unlocking this class..." required minlength="10"></textarea>
                        <div class="form-text small">Minimum 10 characters required. Logged to immutable audit trail.</div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark fw-semibold px-3">
                        Submit Request to Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL 3: RESOLVE INC REQUIREMENT -->
<div class="modal fade" id="resolveIncModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #800020;">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-check2-square me-2"></i>Resolve Incomplete (INC) Mark
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/inc/resolve') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="student_id" id="incModalStudentId" value="">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">STUDENT</label>
                        <input type="text" id="incModalStudentName" class="form-control form-control-sm bg-light" readonly>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">RESOLVED GRADE (1.00 - 5.00) *</label>
                            <input type="number" step="0.01" min="1.00" max="5.00" name="resolved_grade" class="form-control form-control-sm" placeholder="e.g. 2.25" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">REMARKS *</label>
                            <select name="remarks" class="form-select form-select-sm" required>
                                <option value="Passed">Passed</option>
                                <option value="Failed">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">FACULTY COMPLETION NOTES</label>
                        <input type="text" name="notes" class="form-control form-control-sm" placeholder="e.g. Final project submitted and defended">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm text-white fw-semibold px-3" style="background-color: #800020;">
                        Submit Resolved Grade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL 4: TASK EXCEPTION -->
<div class="modal fade" id="taskExceptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-bottom">
                <h6 class="modal-title fw-bold text-dark mb-0">
                    <i class="bi bi-flag me-2 text-warning"></i>Log Assessment Task Exception
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= url('retention/faculty/classes/' . (int) $class['id'] . '/task-exception') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="student_id" id="taskModalStudentId" value="">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">STUDENT</label>
                        <input type="text" id="taskModalStudentName" class="form-control form-control-sm bg-light" readonly>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">ASSESSMENT ITEM *</label>
                            <select name="item_code" class="form-select form-select-sm" required>
                                <?php foreach ($groups as $grp): ?>
                                    <?php foreach ($grp['items'] ?? [] as $it): ?>
                                        <option value="<?= e($it['code']) ?>"><?= e($it['code']) ?> - <?= e($it['title']) ?></option>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">SUBMISSION STATUS *</label>
                            <select name="submission_status" class="form-select form-select-sm" required>
                                <option value="regular">Regular</option>
                                <option value="late">Late Submission</option>
                                <option value="missing">Missing / Unsubmitted</option>
                                <option value="excused">Excused Absence</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">REASON / NOTES</label>
                        <input type="text" name="notes" class="form-control form-control-sm" placeholder="e.g. Medical excuse letter presented">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold px-3">
                        Save Exception
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CLIENT JAVASCRIPT: FORMULA, DEBOUNCED AUTOSAVE & CSV IMPORT -->
<script>
    const classId = <?= (int) $class['id'] ?>;
    const csrfToken = '<?= csrf_token() ?>';
    const activeScheme = <?= json_encode($scheme) ?>;
    const passingCutoff = <?= (float) ($scheme['passingCutoff'] ?? 3.04) ?>;
    const isClassEditable = <?= ($class['grade_status'] === 'draft') ? 'true' : 'false' ?>;

    let pendingScoresSave = {};
    let saveTimeout = null;

    function handleScoreChange(studentId, itemCode, maxScore, rawVal) {
        const numericVal = parseFloat(rawVal) || 0.0;
        
        // 1. Client-side linear transmutation: 5 - 4*(score/maxScore)
        let ratio = maxScore > 0 ? Math.max(0.0, Math.min(1.0, numericVal / maxScore)) : 0.0;
        let transVal = (5.00 - (4.00 * ratio)).toFixed(2);
        
        const transElem = document.getElementById(`trans_${studentId}_${itemCode}`);
        if (transElem) transElem.innerText = transVal;

        // 2. Recompute row
        recomputeRow(studentId);

        // 3. Queue autosave
        queueScoreSave(studentId, itemCode, numericVal);
    }

    function recomputeRow(studentId) {
        const row = document.getElementById(`row_${studentId}`);
        if (!row) return;

        let overallFinal = 0.0;
        const groups = activeScheme.groups || [];

        groups.forEach(grp => {
            const grpWeight = parseFloat(grp.weight) || 0;
            const items = grp.items || [];
            let groupTransTotal = 0.0;
            let componentCount = 0;

            items.forEach(it => {
                const transEl = document.getElementById(`trans_${studentId}_${it.code}`);
                if (transEl) {
                    groupTransTotal += parseFloat(transEl.innerText) || 5.00;
                    componentCount++;
                }
            });

            const attTransEl = document.getElementById(`att_trans_${studentId}`);
            if (grp.hasAttendance && attTransEl) {
                groupTransTotal += parseFloat(attTransEl.innerText) || 5.00;
                componentCount++;
            }

            const avgTrans = componentCount > 0 ? (groupTransTotal / componentCount) : 5.00;
            const share = avgTrans * (grpWeight / 100.0);
            overallFinal += share;

            const grpTotEl = document.getElementById(`grp_total_${studentId}_${grp.id}`);
            if (grpTotEl) grpTotEl.innerText = share.toFixed(2);
        });

        const finalGradeEl = document.getElementById(`final_grade_${studentId}`);
        const remarksEl = document.getElementById(`remarks_${studentId}`);
        const isPassed = overallFinal <= passingCutoff;

        if (finalGradeEl) finalGradeEl.innerText = overallFinal.toFixed(2);
        if (remarksEl) {
            remarksEl.innerHTML = `<span class="badge ${isPassed ? 'bg-success' : 'bg-danger'}">${isPassed ? 'PASSED' : 'FAILED'}</span>`;
        }
        row.dataset.status = isPassed ? 'passed' : 'failed';
    }

    function queueScoreSave(studentId, itemCode, score) {
        if (!isClassEditable) return;

        const key = `${studentId}_${itemCode}`;
        pendingScoresSave[key] = {
            student_id: studentId,
            item_code: itemCode,
            score: score,
            submission_status: 'regular'
        };

        const statusEl = document.getElementById('autosaveStatus');
        if (statusEl) {
            statusEl.className = 'badge bg-warning-subtle text-warning border border-warning px-2 py-1 small';
            statusEl.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Saving scores...';
        }

        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(sendAutosaveBatch, 1000);
    }

    function sendAutosaveBatch() {
        const scoresList = Object.values(pendingScoresSave);
        if (scoresList.length === 0) return;

        fetch(`<?= url('retention/faculty/classes/' . (int) $class['id'] . '/scores') ?>`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ scores: scoresList })
        })
        .then(res => res.json())
        .then(data => {
            const statusEl = document.getElementById('autosaveStatus');
            if (data.status === 'success') {
                pendingScoresSave = {};
                if (statusEl) {
                    statusEl.className = 'badge bg-light text-muted border px-2 py-1 small';
                    statusEl.innerHTML = '<i class="bi bi-cloud-check text-success me-1"></i> All scores saved';
                }
            } else {
                if (statusEl) {
                    statusEl.className = 'badge bg-danger-subtle text-danger border border-danger px-2 py-1 small';
                    statusEl.innerHTML = '<i class="bi bi-exclamation-circle text-danger me-1"></i> ' + (data.message || 'Save error');
                }
            }
        })
        .catch(err => {
            const statusEl = document.getElementById('autosaveStatus');
            if (statusEl) {
                statusEl.className = 'badge bg-danger-subtle text-danger border border-danger px-2 py-1 small';
                statusEl.innerHTML = '<i class="bi bi-wifi-off text-danger me-1"></i> Connection error';
            }
        });
    }

    function manualSaveScores() {
        sendAutosaveBatch();
    }

    function handleCsvUpload(inputElem) {
        const file = inputElem.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const text = e.target.result;
            const lines = text.split(/\r\n|\n/);
            let importedStudents = [];

            lines.forEach((line, idx) => {
                if (!line.trim() || (idx === 0 && line.toLowerCase().includes('id'))) return;
                const cols = line.includes('\t') ? line.split('\t') : line.split(',');
                if (cols.length >= 1) {
                    const sid = cols[0].replace(/"/g, '').trim();
                    if (sid) importedStudents.push(sid);
                }
            });

            if (importedStudents.length > 0) {
                alert(`Found ${importedStudents.length} student entries in CSV. Use the 'Quick Add' box or 'Pull Section' button to link to institutional records.`);
            }
            inputElem.value = '';
        };
        reader.readAsText(file);
    }

    function openResolveIncModal(studentId, studentName) {
        document.getElementById('incModalStudentId').value = studentId;
        document.getElementById('incModalStudentName').value = studentName;
        new bootstrap.Modal(document.getElementById('resolveIncModal')).show();
    }

    function openTaskExceptionModal(studentId, studentName) {
        document.getElementById('taskModalStudentId').value = studentId;
        document.getElementById('taskModalStudentName').value = studentName;
        new bootstrap.Modal(document.getElementById('taskExceptionModal')).show();
    }

    // Filter Passed/Failed rows
    document.querySelectorAll('.filter-status-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-status-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('#matrixTableBody tr.student-row').forEach(row => {
                if (filter === 'all' || row.dataset.status === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

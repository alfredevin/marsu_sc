<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Faculty Roll-Call Attendance (attendance.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="container-fluid px-3 py-4">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 mb-4 border-bottom gap-2">
        <div>
            <h4 class="fw-bold mb-1" style="color: #800020;">
                <i class="bi bi-calendar-check-fill me-2"></i>Daily Roll-Call Attendance
            </h4>
            <div class="text-muted small">
                Record and manage daily session attendance for your assigned class rosters. Attendance feeds directly into grading matrices.
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= url('retention/faculty/classes') ?>" class="btn btn-sm btn-outline-dark fw-semibold">
                <i class="bi bi-grid-3x3-gap me-1"></i> My Classes
            </a>
        </div>
    </div>

    <?php if (empty($classes)): ?>
        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body">
                <i class="bi bi-calendar-x fs-1 d-block mb-3 text-secondary"></i>
                <h5 class="fw-bold text-dark">No Teaching Classes Assigned</h5>
                <p class="text-muted small mb-0">You need an assigned teaching offering to record roll-call attendance.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <!-- Left: Attendance Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <form method="GET" action="<?= url('retention/faculty/attendance') ?>" class="row g-2 align-items-center">
                            <div class="col-md-7">
                                <label class="form-label small fw-semibold text-secondary mb-1">SELECT TEACHING CLASS</label>
                                <select name="class_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <?php foreach ($classes as $c): ?>
                                        <option value="<?= (int) $c['id'] ?>" <?= ((int) $c['id'] === (int) $selectedClassId) ? 'selected' : '' ?>>
                                            <?= e($c['subject_code']) ?> - <?= e($c['subject_title']) ?> (<?= e($c['section_name']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-semibold text-secondary mb-1">SESSION DATE</label>
                                <input type="date" name="date" class="form-control form-control-sm" 
                                       value="<?= e($sessionDate) ?>" max="<?= date('Y-m-d') ?>" onchange="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    <div class="card-body p-0">
                        <?php if (empty($roster)): ?>
                            <div class="p-5 text-center text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 text-secondary"></i>
                                <h6 class="fw-semibold mb-1">No enrolled students on class roster</h6>
                                <p class="small mb-3">Open the class record to pull your section masterlist or add students.</p>
                                <?php if ($selectedClassId > 0): ?>
                                    <a href="<?= url('retention/faculty/classes/' . (int) $selectedClassId) ?>" class="btn btn-sm btn-primary">
                                        Open Class Record →
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <form method="POST" action="<?= url('retention/faculty/attendance/store') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="class_id" value="<?= (int) $selectedClassId ?>">
                                <input type="hidden" name="session_date" value="<?= e($sessionDate) ?>">

                                <div class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <span class="small text-muted">
                                        Roster: <strong class="text-dark"><?= count($roster) ?></strong> students for <strong><?= e($sessionDate) ?></strong>
                                    </span>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-xs btn-outline-success py-1 px-2" style="font-size: 11.5px;" onclick="markAll('Present')">
                                            <i class="bi bi-check-all me-1"></i> Mark All Present
                                        </button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary py-1 px-2" style="font-size: 11.5px;" onclick="markAll('Absent')">
                                            Mark All Absent
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3" style="width: 40px;">#</th>
                                                <th style="min-width: 170px;">Student Name</th>
                                                <th style="min-width: 250px;">Attendance Status</th>
                                                <th class="pe-3" style="min-width: 180px;">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($roster as $idx => $st): 
                                                $snum = $st['student_number'];
                                                $curr = $existingAttendance[$snum]['status'] ?? 'Present';
                                                $currRem = $existingAttendance[$snum]['remarks'] ?? '';
                                            ?>
                                                <tr>
                                                    <td class="ps-3 text-muted fw-bold"><?= $idx + 1 ?></td>
                                                    <td>
                                                        <div class="fw-semibold text-dark"><?= e($st['last_name'] . ', ' . $st['first_name']) ?></div>
                                                        <small class="text-muted"><?= e($snum) ?> • <?= e($st['program_code'] ?? 'BSIS') ?></small>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <input type="radio" class="btn-check" name="status[<?= e($snum) ?>]" id="att_p_<?= $idx ?>" value="Present" <?= ($curr === 'Present') ? 'checked' : '' ?>>
                                                            <label class="btn btn-outline-success" for="att_p_<?= $idx ?>">P</label>

                                                            <input type="radio" class="btn-check" name="status[<?= e($snum) ?>]" id="att_l_<?= $idx ?>" value="Late" <?= ($curr === 'Late') ? 'checked' : '' ?>>
                                                            <label class="btn btn-outline-warning" for="att_l_<?= $idx ?>">L</label>

                                                            <input type="radio" class="btn-check" name="status[<?= e($snum) ?>]" id="att_e_<?= $idx ?>" value="Excused" <?= ($curr === 'Excused') ? 'checked' : '' ?>>
                                                            <label class="btn btn-outline-info" for="att_e_<?= $idx ?>">E</label>

                                                            <input type="radio" class="btn-check" name="status[<?= e($snum) ?>]" id="att_a_<?= $idx ?>" value="Absent" <?= ($curr === 'Absent') ? 'checked' : '' ?>>
                                                            <label class="btn btn-outline-danger" for="att_a_<?= $idx ?>">A</label>
                                                        </div>
                                                    </td>
                                                    <td class="pe-3">
                                                        <input type="text" name="remarks[<?= e($snum) ?>]" class="form-control form-control-sm" 
                                                               placeholder="Optional note" value="<?= e($currRem) ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="p-3 bg-white border-top text-end">
                                    <button type="submit" class="btn btn-sm text-white fw-semibold px-4" style="background-color: #800020;">
                                        <i class="bi bi-floppy me-1"></i> Save Roll-Call Attendance
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right: Session History -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-clock-history me-2 text-primary"></i>Session History for this Class
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($sessionHistory)): ?>
                            <div class="p-4 text-center text-muted small">
                                <i class="bi bi-calendar-x fs-2 d-block mb-2 text-secondary"></i>
                                No attendance sessions recorded yet for this class offering.
                            </div>
                        <?php else: ?>
                            <div class="list-group list-group-flush small">
                                <?php foreach ($sessionHistory as $sh): 
                                    $isCurrent = ($sh['session_date'] === $sessionDate);
                                ?>
                                    <a href="<?= url('retention/faculty/attendance?class_id=' . (int) $selectedClassId . '&date=' . e($sh['session_date'])) ?>" 
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $isCurrent ? 'bg-light fw-bold' : '' ?>">
                                        <div>
                                            <div class="text-dark">
                                                <i class="bi bi-calendar-event me-1 text-secondary"></i>
                                                <?= e($sh['session_date']) ?>
                                                <?php if ($isCurrent): ?>
                                                    <span class="badge bg-primary-subtle text-primary ms-1" style="font-size: 10px;">Viewing</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-muted" style="font-size: 11px;">
                                                <?= (int) $sh['total_logged'] ?> students logged
                                            </div>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <span class="badge bg-success" title="Present"><?= (int) $sh['present_count'] ?></span>
                                            <span class="badge bg-warning text-dark" title="Late"><?= (int) $sh['late_count'] ?></span>
                                            <span class="badge bg-danger" title="Absent"><?= (int) $sh['absent_count'] ?></span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<script>
    function markAll(status) {
        document.querySelectorAll(`input[type="radio"][value="${status}"]`).forEach(radio => {
            radio.checked = true;
        });
    }
</script>

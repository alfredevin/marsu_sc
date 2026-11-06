<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Faculty Conduct Incident Reporting (conduct.php)
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
                <i class="bi bi-shield-exclamation me-2"></i>Student Conduct Incident Reports
            </h4>
            <div class="text-muted small">
                Report classroom behavioral infractions, academic integrity concerns, and conduct issues for students enrolled on your rosters.
            </div>
        </div>
        <div>
            <span class="badge bg-light text-dark border px-3 py-2 small">
                <i class="bi bi-info-circle text-primary me-1"></i> Reports Routed to Administration
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Incident Reporting Form -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-pencil-square me-2 text-danger"></i>File Incident Report
                    </h6>
                </div>
                <div class="card-body p-4">
                    <?php if (empty($classes)): ?>
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                            You have no assigned teaching classes to report student incidents for.
                        </div>
                    <?php elseif (empty($students)): ?>
                        <div class="text-center py-4 text-muted small">
                            <i class="bi bi-people fs-2 d-block mb-2 text-secondary"></i>
                            No enrolled students found on your class rosters.
                        </div>
                    <?php else: ?>
                        <form method="POST" action="<?= url('retention/faculty/conduct/store') ?>">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">TEACHING CLASS OFFERING *</label>
                                <select name="class_id" class="form-select form-select-sm" required>
                                    <option value="">Select Class Offering</option>
                                    <?php foreach ($classes as $c): ?>
                                        <option value="<?= (int) $c['id'] ?>">
                                            <?= e($c['subject_code']) ?> - <?= e($c['subject_title']) ?> (<?= e($c['section_name']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">ENROLLED STUDENT *</label>
                                <select name="student_number" class="form-select form-select-sm" required>
                                    <option value="">Select Student</option>
                                    <?php foreach ($students as $s): ?>
                                        <option value="<?= e($s['student_number']) ?>">
                                            <?= e($s['last_name'] . ', ' . $s['first_name']) ?> (<?= e($s['student_number']) ?> - <?= e($s['section_name']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold text-secondary">INCIDENT DATE *</label>
                                    <input type="date" name="incident_date" class="form-control form-control-sm" 
                                           value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold text-secondary">SEVERITY *</label>
                                    <select name="severity" class="form-select form-select-sm" required>
                                        <option value="Minor">Minor</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Severe">Severe</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">INCIDENT TYPE *</label>
                                <select name="incident_type" class="form-select form-select-sm" required>
                                    <option value="">Select Incident Category</option>
                                    <option value="Academic Dishonesty">Academic Dishonesty / Plagiarism</option>
                                    <option value="Disruptive Behavior">Classroom Disruption / Misbehavior</option>
                                    <option value="Attendance Irregularity">Chronic Unexcused Absences / Cutting</option>
                                    <option value="Policy Non-Compliance">Laboratory / Safety Policy Violation</option>
                                    <option value="Interpersonal Conflict">Interpersonal Conflict / Harassment</option>
                                    <option value="Other">Other Conduct Violation</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">FACTUAL NARRATIVE & DETAILS *</label>
                                <textarea name="description" class="form-control form-control-sm" rows="4" 
                                          placeholder="Provide a factual, objective description of the observed conduct, date, and specific circumstance..." 
                                          required minlength="10"></textarea>
                                <div class="form-text small">Minimum 10 characters. Once submitted, narrative remains immutable.</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-sm text-white fw-semibold" style="background-color: #800020;">
                                    <i class="bi bi-send me-1"></i> File Incident Report
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right: Reports History Filed by this Faculty -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-clock-history me-2 text-primary"></i>Reports Filed by You
                    </h6>
                    <span class="badge bg-light text-dark border"><?= count($reports) ?> Reports</span>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($reports)): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-clipboard2-check fs-1 d-block mb-2 text-secondary"></i>
                            <h6 class="fw-semibold mb-1">No conduct reports filed</h6>
                            <p class="small mb-0">Reports you submit will appear here with administrative investigation status updates.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Date</th>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Incident & Severity</th>
                                        <th class="text-center">Status</th>
                                        <th class="pe-3">Resolution Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reports as $r): ?>
                                        <tr>
                                            <td class="ps-3 text-muted"><?= e($r['incident_date']) ?></td>
                                            <td>
                                                <div class="fw-bold text-dark"><?= e($r['last_name'] . ', ' . $r['first_name']) ?></div>
                                                <small class="text-muted"><?= e($r['student_id']) ?></small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border"><?= e($r['subject_code'] ?? 'Class') ?></span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark"><?= e($r['incident_type']) ?></div>
                                                <span class="badge <?= $r['severity'] === 'Severe' ? 'bg-danger' : ($r['severity'] === 'Moderate' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                                    <?= e($r['severity']) ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($r['status'] === 'Resolved'): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success">Resolved</span>
                                                <?php elseif ($r['status'] === 'Under Investigation'): ?>
                                                    <span class="badge bg-primary-subtle text-primary border border-primary">Investigating</span>
                                                <?php elseif ($r['status'] === 'Dismissed'): ?>
                                                    <span class="badge bg-secondary-subtle text-secondary border">Dismissed</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning-subtle text-warning border border-warning">Reported</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="pe-3 text-muted small">
                                                <?= e($r['resolution_notes'] ?: 'Pending administrative review') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>

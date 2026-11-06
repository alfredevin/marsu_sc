<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Faculty Enrolled Students Directory (students.php)
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
                <i class="bi bi-people-fill me-2"></i>My Enrolled Students Directory
            </h4>
            <div class="text-muted small">
                Roster-scoped student directory for your assigned classes. In accordance with the Data Privacy Act of 2012 (RA 10173), contact, address, and guardian information are redacted.
            </div>
        </div>
        <div>
            <span class="badge bg-light text-dark border px-3 py-2 small">
                <i class="bi bi-shield-check text-success me-1"></i> Roster-Scoped Access
            </span>
        </div>
    </div>

    <?php if (empty($students)): ?>
        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body">
                <i class="bi bi-person-x fs-1 d-block mb-3 text-secondary"></i>
                <h5 class="fw-bold text-dark">No Students Enrolled</h5>
                <p class="text-muted small mb-0">
                    No students are currently enrolled in any of your assigned class offerings.<br>
                    Open your class records to pull section masterlists or register students.
                </p>
                <a href="<?= url('retention/faculty/classes') ?>" class="btn btn-sm btn-primary mt-3">
                    Go to My Classes →
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="small fw-bold text-dark">Total Enrolled:</span>
                    <span class="badge text-white" style="background-color: #800020;"><?= count($students) ?> Students</span>
                </div>
                <div style="width: 260px;">
                    <input type="text" id="studentSearchInput" class="form-control form-control-sm" placeholder="Search student name or ID..." onkeyup="filterStudentsTable()">
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="studentsTable" style="font-size: 13px;">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3" style="width: 45px;">#</th>
                                <th style="min-width: 120px;">Student Number</th>
                                <th style="min-width: 180px;">Student Name</th>
                                <th>Program & Year</th>
                                <th>Section</th>
                                <th style="min-width: 200px;">Enrolled Classes with You</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $idx => $s): ?>
                                <tr class="student-row">
                                    <td class="ps-3 text-muted fw-bold"><?= $idx + 1 ?></td>
                                    <td>
                                        <code class="fw-bold text-dark"><?= e($s['student_number']) ?></code>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            <?= e($s['last_name'] . ', ' . $s['first_name'] . ' ' . ($s['middle_name'] ? substr($s['middle_name'], 0, 1) . '.' : '')) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?= e($s['program_code'] ?? 'BSIS') ?> - <?= (int) $s['year_level'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary"><?= e($s['section_name'] ?? 'Section') ?></span>
                                    </td>
                                    <td>
                                        <small class="text-dark fw-semibold"><?= e($s['enrolled_classes'] ?? 'N/A') ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success border border-success">
                                            <?= e($s['enrollment_status'] ?? 'Enrolled') ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <a href="<?= url('retention/faculty/students/' . (int) $s['id']) ?>" 
                                           class="btn btn-sm btn-outline-primary fw-semibold px-2 py-1" style="font-size: 11.5px;">
                                            <i class="bi bi-eye me-1"></i> Academic Record
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<script>
    function filterStudentsTable() {
        const query = (document.getElementById('studentSearchInput').value || '').toLowerCase();
        document.querySelectorAll('#studentsTable tbody tr.student-row').forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    }
</script>

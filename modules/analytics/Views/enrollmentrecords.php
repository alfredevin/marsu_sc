<div class="p-3">

    <!-- Header Title & Inline Auto-submit Filter Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-maroon mb-0">Program and Enrollment Registry</h6>

        <form method="GET" action="" class="d-flex gap-2 align-items-center">
            
            <!-- Program Dropdown -->
            <label class="small fw-semibold text-muted mb-0">PROGRAM:</label>
            <select name="department" class="form-select form-select-sm" style="min-width: 140px;" onchange="this.form.submit()">
                <option value="">All Programs</option>
                <?php if (!empty($departments)): ?>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= htmlspecialchars($dept) ?>" <?= (isset($department) && $department === $dept) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- Year Level Dropdown -->
            <label class="small fw-semibold text-muted mb-0 ms-1">YEAR LEVEL:</label>
            <select name="year_level" class="form-select form-select-sm" style="min-width: 120px;" onchange="this.form.submit()">
                <option value="">All Year Levels</option>
                <option value="1" <?= (isset($yearLevel) && $yearLevel === '1') ? 'selected' : '' ?>>1st Year</option>
                <option value="2" <?= (isset($yearLevel) && $yearLevel === '2') ? 'selected' : '' ?>>2nd Year</option>
                <option value="3" <?= (isset($yearLevel) && $yearLevel === '3') ? 'selected' : '' ?>>3rd Year</option>
                <option value="4" <?= (isset($yearLevel) && $yearLevel === '4') ? 'selected' : '' ?>>4th Year</option>
            </select>

            <!-- Section Dropdown -->
            <label class="small fw-semibold text-muted mb-0 ms-1">SECTION:</label>
            <select name="section" class="form-select form-select-sm" style="min-width: 110px;" onchange="this.form.submit()">
                <option value="">All Sections</option>
                <?php if (!empty($sections)): ?>
                    <?php foreach ($sections as $sec): ?>
                        <option value="<?= htmlspecialchars($sec) ?>" <?= (isset($section) && $section === $sec) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sec) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- School Year Dropdown -->
            <label class="small fw-semibold text-muted mb-0 ms-1">SCHOOL YEAR:</label>
            <select name="school_year" class="form-select form-select-sm" style="min-width: 130px;" onchange="this.form.submit()">
                <option value="">All School Years</option>
                <?php if (!empty($schoolYears)): ?>
                    <?php foreach ($schoolYears as $sy): ?>
                        <option value="<?= htmlspecialchars($sy) ?>" <?= (isset($schoolYear) && $schoolYear === $sy) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sy) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- Semester Dropdown -->
            <label class="small fw-semibold text-muted mb-0 ms-1">SEMESTER:</label>
            <select name="semester" class="form-select form-select-sm" style="min-width: 125px;" onchange="this.form.submit()">
                <option value="">All Semesters</option>
                <?php foreach ($semesters as $sem): ?>
                    <option value="<?= htmlspecialchars($sem) ?>" <?= (isset($semester) && $semester === $sem) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sem) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Classification Dropdown -->
            <label class="small fw-semibold text-muted mb-0 ms-1">STATUS:</label>
            <select name="enrollment_status" class="form-select form-select-sm" style="min-width: 120px;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <?php if (!empty($enrollmentStatuses)): ?>
                    <?php foreach ($enrollmentStatuses as $st): ?>
                        <option value="<?= htmlspecialchars($st) ?>" <?= (isset($enrollmentStatus) && $enrollmentStatus === $st) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($st) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

        </form>
    </div>

    <!-- Roster Table Display -->
    <div class="table-responsive bg-white rounded border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-3 py-3">Student ID</th>
                    <th class="py-3">Student Name & Identity</th>
                    <th class="py-3">Degree Program</th>
                    <th class="py-3">Year & Section</th>
                    <th class="py-3">Enrollment Classification</th>
                    <th class="py-3">Registration Status</th>
                    <th class="py-3 text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($enrollmentList)): ?>
                    <?php foreach ($enrollmentList as $row): ?>
                        <tr>
                            <td class="ps-3 fw-semibold text-secondary">
                                <?= htmlspecialchars($row['student_id'] ?? $row['id']) ?>
                            </td>
                            <td class="fw-semibold text-dark">
                                <?= htmlspecialchars($row['full_name'] ?? $row['name'] ?? 'N/A') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($row['department'] ?? $row['program'] ?? 'N/A') ?>
                            </td>
                            <td>
                                Year <?= htmlspecialchars($row['year_level'] ?? '-') ?> - <?= htmlspecialchars($row['section'] ?? '-') ?>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    <?= htmlspecialchars($row['enrollment_type'] ?? 'Regular') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border">
                                    <?= htmlspecialchars($row['status'] ?? 'Officially Enrolled') ?>
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <a href="academichistory?student_id=<?= urlencode($row['student_id'] ?? $row['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Standard MarSU Empty State Box -->
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <p class="mb-0 fw-semibold">No enrollment records found</p>
                            <small>Run the database seeder or sync with the central registrar.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
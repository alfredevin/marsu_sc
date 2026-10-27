<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
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
    </style>

    <?php if (!empty($selectedStudent)): ?>
        <!-- ===================================================================== -->
        <!-- STATE 2: STUDENT 360° PROFILE DOSSIER                                 -->
        <!-- ===================================================================== -->

        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="profile" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Student Directory
                </a>
                <span class="text-muted">|</span>
                <span class="small fw-bold text-secondary">Student 360° Profile Dossier</span>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print Dossier
                </button>
            </div>
        </div>

        <!-- Student Main Identity Banner Card -->
        <div class="card border rounded-3 shadow-sm mb-4 bg-white">
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
                                <span
                                    class="fw-semibold text-dark"><?= htmlspecialchars($selectedStudent['program_name']) ?>
                                    (<?= htmlspecialchars($selectedStudent['program_code']) ?>)</span>
                                <span>•</span>
                                <span>Section: <strong
                                        class="text-dark"><?= htmlspecialchars($selectedStudent['section_name'] ?? '-') ?></strong></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span
                            class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-7 text-uppercase">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            <?= htmlspecialchars($selectedStudent['enrollment_status'] ?? 'Enrolled') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card border rounded-3 shadow-sm bg-white h-100">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold marsu-maroon-text mb-0">
                            <i class="bi bi-person-lines-fill me-2"></i>Personal & Contact Identity
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Student Number:</span>
                                <strong
                                    class="text-dark"><?= htmlspecialchars($selectedStudent['student_number']) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Gender:</span>
                                <strong
                                    class="text-dark text-capitalize"><?= htmlspecialchars($selectedStudent['gender'] ?? 'Not Specified') ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Date of Birth:</span>
                                <strong
                                    class="text-dark"><?= htmlspecialchars($selectedStudent['birthdate'] ?? 'N/A') ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Institutional Email:</span>
                                <strong
                                    class="text-primary"><?= htmlspecialchars($selectedStudent['email'] ?? 'N/A') ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Mobile / Contact:</span>
                                <strong
                                    class="text-dark"><?= htmlspecialchars($selectedStudent['contact_number'] ?? 'N/A') ?></strong>
                            </li>
                            <li class="list-group-item px-0 py-2">
                                <span class="text-muted d-block mb-1">Permanent Residence:</span>
                                <strong class="text-dark"><i
                                        class="bi bi-geo-alt text-danger me-1"></i><?= htmlspecialchars($selectedStudent['address'] ?? 'Marinduque') ?></strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex flex-column gap-3">
                <div class="card border rounded-3 shadow-sm bg-white">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold marsu-maroon-text mb-0">
                            <i class="bi bi-people-fill me-2"></i>Guardian & Emergency Contact
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Parent / Guardian:</span>
                                <strong
                                    class="text-dark"><?= htmlspecialchars($selectedStudent['guardian_name'] ?? 'Not Recorded') ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                                <span class="text-muted">Guardian Contact:</span>
                                <strong
                                    class="text-dark"><?= htmlspecialchars($selectedStudent['guardian_contact'] ?? 'Not Recorded') ?></strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card border rounded-3 shadow-sm bg-white mt-auto">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold marsu-maroon-text mb-0">
                            <i class="bi bi-lightning-charge-fill me-2"></i>Retention Intervention Shortcuts
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <small class="text-muted d-block mb-2">Immediate academic & advisory actions available for this
                            student:</small>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="academichistory?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-clock-history me-1"></i> Academic History
                            </a>
                            <a href="guidancereferrals?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                class="btn btn-sm btn-outline-warning text-dark">
                                <i class="bi bi-person-heart me-1"></i> Refer to Guidance
                            </a>
                            <a href="atriskstudents?flag_student=<?= urlencode($selectedStudent['student_number']) ?>"
                                class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-shield-exclamation me-1"></i> Flag as At-Risk
                            </a>
                            <a href="advisingrecords?student_id=<?= urlencode($selectedStudent['student_number']) ?>"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-journal-check me-1"></i> Log Advising
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- ===================================================================== -->
        <!-- STATE 1: STUDENT MASTER IDENTITY ROSTER (UNANG SCREEN)               -->
        <!-- ===================================================================== -->

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">Institutional Student Identity Directory</h6>
                <small class="text-muted">Official MarSU authenticated student master identity records.</small>
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

                <!-- Dynamic Section Filter mula sa Database -->
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

        <div class="table-responsive bg-white rounded border shadow-sm">
            <table class="table table-hover align-middle mb-0" id="rosterTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student ID</th>
                        <th class="py-3">Student Name & Identity</th>
                        <th class="py-3">Degree Program</th>
                        <th class="py-3 text-center">Section</th>
                        <th class="py-3">Institutional Email</th>
                        <th class="py-3 text-center">Enrollment Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($studentList)): ?>
                        <?php foreach ($studentList as $row): ?>
                            <tr class="student-row">
                                <td class="ps-3 fw-semibold text-secondary col-id">
                                    <?= htmlspecialchars($row['student_number'] ?? $row['id']) ?>
                                </td>
                                <td class="col-name">
                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($row['full_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><i
                                            class="bi bi-geo-alt me-1 text-danger"></i><?= htmlspecialchars($row['address'] ?? 'Marinduque') ?></small>
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
                                <td class="small text-muted col-email">
                                    <?= htmlspecialchars($row['email'] ?? 'N/A') ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle text-capitalize">
                                        <?= htmlspecialchars($row['enrollment_status'] ?? 'Enrolled') ?>
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="profile?student_id=<?= urlencode($row['student_number'] ?? $row['id']) ?>"
                                        class="btn btn-sm btn-outline-primary fw-semibold">
                                        View Profile
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
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
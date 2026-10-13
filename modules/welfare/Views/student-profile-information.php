 <!-- Student Profile Management -->

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

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .filter-select {
            width: auto !important;
            min-width: 130px;
            max-width: 150px;
        }


        .fixed-table {
            table-layout: fixed !important;
            width: 100% !important;
        }

        .fixed-table td, .fixed-table th {
            vertical-align: middle;
            white-space: nowrap;
        }

        .fixed-table td.truncate-cell {
            overflow: hidden;
            text-overflow: ellipsis;
        }

       
        .search-pill-wrapper {
            background-color: #fcfcfd;
            border: 1px solid #ebdede;
            border-radius: 50rem !important;
            padding: 4px 16px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }

        .search-pill-wrapper:focus-within {
            border-color: #58111a;
            box-shadow: 0 0 0 0.15rem rgba(88, 17, 26, 0.15);
            background-color: #ffffff;
        }

        .search-pill-input {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-size: 0.875rem;
            color: #495057;
            width: 100%;
        }

        
        .program-badge-custom {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            padding: 5px 0 !important;
            min-width: 78px !important;
            text-align: center !important;
            border-radius: 6px !important;
            background-color: #f8f9fa !important;
            color: #212529 !important;
            border: 1.5px solid #dcdcdc !important;
            display: inline-block !important;
            letter-spacing: 0.3px;
        }

       
        .status-badge-enrolled {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            padding: 5px 14px !important;
            border-radius: 50rem !important;
            background-color: #d4edda !important;
            color: #0f5132 !important;
            border: 1.5px solid #198754 !important;
            display: inline-block !important;
        }

        .status-badge-graduating {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            padding: 5px 14px !important;
            border-radius: 50rem !important;
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1.5px solid #ffc107 !important;
            display: inline-block !important;
        }

        
        .btn-view-maroon {
            color: #58111a !important;
            border: 1.5px solid #58111a !important;
            background-color: #ffffff !important;
            font-weight: 600;
            padding: 4px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-view-maroon:hover {
            color: #ffffff !important;
            background-color: #58111a !important;
        }

        
        .btn-clear-burgundy {
            background-color: #58111a !important;
            color: #ffffff !important;
            border: 1.5px solid #3b0b11 !important;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 4px 14px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .btn-clear-burgundy:hover {
            background-color: #3b0b11 !important;
            color: #ffffff !important;
            border-color: #24060a !important;
        }
    </style>

    <?php 
        $programVal   = $program ?? '';
        $yearLevelVal = $yearLevel ?? '';
        $statusVal    = $status ?? '';
        $searchVal    = $search ?? '';

       
        $formatYearLevel = function($yr) {
            $yrStr = (string)$yr;
            if (str_contains($yrStr, '1')) return '1st Year';
            if (str_contains($yrStr, '2')) return '2nd Year';
            if (str_contains($yrStr, '3')) return '3rd Year';
            if (str_contains($yrStr, '4')) return '4th Year';
            return !empty($yrStr) && $yrStr !== 'N/A' ? $yrStr : 'N/A';
        };
    ?>

    <?php if (!empty($selectedStudent)): ?>
        <!-- ===================================================================== -->
        <!-- STATE 2: STUDENT PROFILE VIEW                                         -->
        <!-- ===================================================================== -->

        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="<?= function_exists('url') ? url('guidance/student-profile') : 'student-profile' ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Student Directory
                </a>
                <span class="text-muted">|</span>
                <span class="small fw-bold text-secondary">STUDENT INFORMATION MANAGEMENT / STUDENT PROFILE / VIEW</span>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print Profile
                </button>
            </div>
        </div>

        <!-- Header Card / Profile Banner -->
        <div class="card border rounded-3 shadow-sm mb-4 bg-white">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
                    
                    <!-- Student Information -->
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar-circle shadow-sm flex-shrink-0" style="width: 80px; height: 80px; font-size: 30px;">
                            <?= strtoupper(substr($selectedStudent['full_name'] ?? ($selectedStudent['first_name'] ?? 'S'), 0, 1)) ?>
                        </div>
                        <div>
                           
                            <h3 class="fw-bold mb-3 text-dark"><?= htmlspecialchars($selectedStudent['full_name'] ?? '') ?></h3>
                            
                            <div class="d-flex flex-column gap-2 text-dark" style="font-size: 0.95rem;">
                                <div>
                                    <span class="text-muted fw-semibold" style="min-width: 150px; display: inline-block;">Student ID:</span>
                                    <strong class="text-dark fs-6"><?= htmlspecialchars($selectedStudent['student_id'] ?? '') ?></strong>
                                </div>
                                <div>
                                    <span class="text-muted fw-semibold" style="min-width: 150px; display: inline-block;">Institutional Email:</span>
                                    <span class="text-primary fw-semibold fs-6"><?= htmlspecialchars($selectedStudent['email'] ?? '') ?></span>
                                </div>
                                <div>
                                    <span class="text-muted fw-semibold" style="min-width: 150px; display: inline-block;">Program:</span>
                                    <strong class="text-dark fs-6"><?= htmlspecialchars($selectedStudent['program'] ?? '') ?></strong>
                                </div>
                                <div>
                                    <span class="text-muted fw-semibold" style="min-width: 150px; display: inline-block;">Year Level:</span>
                                    <span class="fw-bold text-dark fs-6"><?= htmlspecialchars($formatYearLevel($selectedStudent['year_level'] ?? '')) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $rawStatus = $selectedStudent['status'] ?? 'N/A';
                        $displayStatus = ucwords(strtolower(trim($rawStatus)));
                    ?>
                    <div class="ms-auto align-self-start">
                        <span class="<?= (strtolower($displayStatus) === 'graduating') ? 'status-badge-graduating' : 'status-badge-enrolled' ?> fs-6 px-3 py-2">
                            <?= htmlspecialchars($displayStatus) ?>
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- 1. Academic Information -->
        <div class="card border rounded-3 shadow-sm bg-white mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="fw-bold marsu-maroon-text mb-0">1. Academic Information</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th style="width: 30%;">Field</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <tr>
                                <td class="fw-semibold text-muted">Student ID</td>
                                <td><?= htmlspecialchars($selectedStudent['student_id'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Institutional Email</td>
                                <td><?= htmlspecialchars($selectedStudent['email'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Campus</td>
                                <td><?= htmlspecialchars($selectedStudent['campus'] ?? 'Santa Cruz Campus') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Program</td>
                                <td><?= htmlspecialchars($selectedStudent['program_full'] ?? $selectedStudent['program'] ?? '') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Year Level</td>
                                <td><?= htmlspecialchars($formatYearLevel($selectedStudent['year_level'] ?? '')) ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Academic Year</td>
                                <td><?= htmlspecialchars($selectedStudent['academic_year'] ?? '2026–2027') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Enrollment Status</td>
                                <td><?= htmlspecialchars($displayStatus) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 2. Personal Background -->
        <div class="card border rounded-3 shadow-sm bg-white mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="fw-bold marsu-maroon-text mb-0">2. Personal Background</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th style="width: 30%;">Field</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <tr>
                                <td class="fw-semibold text-muted">Date of Birth</td>
                                <td><?= htmlspecialchars($selectedStudent['birthdate'] ?? $selectedStudent['dob'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Sex / Gender</td>
                                <td><?= htmlspecialchars($selectedStudent['gender'] ?? $selectedStudent['sex'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Home Address</td>
                                <td><?= htmlspecialchars($selectedStudent['address'] ?? $selectedStudent['home_address'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Parent/Guardian</td>
                                <td><?= htmlspecialchars($selectedStudent['guardian_name'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Guardian Contact Number</td>
                                <td><?= htmlspecialchars($selectedStudent['guardian_contact'] ?? 'N/A') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 3. Health Information -->
        <div class="card border rounded-3 shadow-sm bg-white mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="fw-bold marsu-maroon-text mb-0">3. Health Information</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th style="width: 30%;">Field</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <tr>
                                <td class="fw-semibold text-muted">Allergies</td>
                                <td><?= htmlspecialchars($selectedStudent['allergies'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Medical Conditions</td>
                                <td><?= htmlspecialchars($selectedStudent['medical_conditions'] ?? $selectedStudent['health_condition'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Current Medications</td>
                                <td><?= htmlspecialchars($selectedStudent['current_medications'] ?? $selectedStudent['medication'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Special Assistance Needs</td>
                                <td><?= htmlspecialchars($selectedStudent['special_assistance_needs'] ?? $selectedStudent['support_needs'] ?? 'N/A') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- ===================================================================== -->
        <!-- STATE 1: MASTER DIRECTORY TABLE LIST VIEW                            -->
        <!-- ===================================================================== -->

        <div class="mb-4">
            <h4 class="fw-bold marsu-maroon-text mb-1">Student Profile Management</h4>
            <p class="text-muted small mb-0">Manage student academic directory profiles, search records, and filter by program or year level.</p>
        </div>

        <!-- Filter and Search Toolbar -->
        <div class="card border-0 bg-light p-3 rounded-3 mb-3">
            <form method="GET" action="" id="searchForm" class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                
                <!-- Pill Search Bar -->
                <div class="search-pill-wrapper" style="width: 320px;">
                    <i class="bi bi-search text-muted me-2"></i>
                    <input type="search" id="searchInput" name="q" class="search-pill-input" placeholder="Search students, program..." value="<?= htmlspecialchars($searchVal) ?>" autocomplete="off" onchange="this.form.submit()">
                </div>

                <!-- Server-Side Dropdown Filters -->
                <div class="d-flex flex-wrap gap-2 align-items-center ms-auto">
                    <div class="d-flex align-items-center gap-1">
                        <label class="small fw-semibold text-muted mb-0 text-nowrap">Program:</label>
                        <select name="program" class="form-select form-select-sm filter-select" onchange="this.form.submit()">
                            <option value="">All Programs</option>
                            <option value="BSTM" <?= ($programVal === 'BSTM') ? 'selected' : '' ?>>BSTM</option>
                            <option value="BSIS" <?= ($programVal === 'BSIS') ? 'selected' : '' ?>>BSIS</option>
                            <option value="BEED" <?= ($programVal === 'BEED') ? 'selected' : '' ?>>BEED</option>
                            <option value="BAPoS" <?= ($programVal === 'BAPoS' || $programVal === 'BAPOS') ? 'selected' : '' ?>>BAPoS</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Year Level:</label>
                        <select name="year_level" class="form-select form-select-sm filter-select" onchange="this.form.submit()">
                            <option value="">All Year Levels</option>
                            <option value="1st Year" <?= ($yearLevelVal === '1' || $yearLevelVal === '1st Year') ? 'selected' : '' ?>>1st Year</option>
                            <option value="2nd Year" <?= ($yearLevelVal === '2' || $yearLevelVal === '2nd Year') ? 'selected' : '' ?>>2nd Year</option>
                            <option value="3rd Year" <?= ($yearLevelVal === '3' || $yearLevelVal === '3rd Year') ? 'selected' : '' ?>>3rd Year</option>
                            <option value="4th Year" <?= ($yearLevelVal === '4' || $yearLevelVal === '4th Year' || $yearLevelVal === '4rth Year') ? 'selected' : '' ?>>4th Year</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <label class="small fw-semibold text-muted mb-0 text-nowrap ms-1">Status:</label>
                        <select name="status" class="form-select form-select-sm filter-select" onchange="this.form.submit()">
                            <option value="">All Statuses</option>
                            <option value="Enrolled" <?= ($statusVal === 'Enrolled') ? 'selected' : '' ?>>Enrolled</option>
                            <option value="Graduating" <?= ($statusVal === 'Graduating') ? 'selected' : '' ?>>Graduating</option>
                        </select>
                    </div>

                    <?php if (!empty($programVal) || !empty($yearLevelVal) || !empty($statusVal) || !empty($searchVal)): ?>
                        <a href="<?= function_exists('url') ? url('guidance/student-profile') : 'student-profile' ?>" class="btn btn-sm btn-clear-burgundy ms-1" title="Clear Filters & Search">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Master Directory Table -->
        <div class="table-responsive bg-white rounded border shadow-sm">
            <table class="table table-hover align-middle mb-0 fixed-table" id="rosterTable">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3" style="width: 14%;">Student ID</th>
                        <th class="py-3" style="width: 21%;">Full Name</th>
                        <th class="py-3" style="width: 23%;">Institutional Email</th>
                        <th class="py-3" style="width: 12%;">Program</th>
                        <th class="py-3" style="width: 11%;">Year Level</th>
                        <th class="py-3" style="width: 12%;">Status</th>
                        <th class="py-3 text-center pe-3" style="width: 7%;">Action</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (!empty($studentList)): ?>
                        <?php foreach ($studentList as $row): ?>
                            <?php 
                                $rowStatus = $row['status'] ?? 'N/A';
                                $formattedStatus = ucwords(strtolower(trim($rowStatus))); 
                            ?>
                            <tr>
                                <td class="ps-3 fw-semibold text-secondary">
                                    <?= htmlspecialchars($row['student_id'] ?? $row['id']) ?>
                                </td>
                                <td class="fw-semibold text-dark truncate-cell">
                                    <?= htmlspecialchars($row['full_name'] ?? 'N/A') ?>
                                </td>
                                <td class="text-muted truncate-cell">
                                    <?= htmlspecialchars($row['email'] ?? 'N/A') ?>
                                </td>
                                <td>
                                    <span class="program-badge-custom">
                                        <?= htmlspecialchars($row['program'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td>
                                    <?= htmlspecialchars($formatYearLevel($row['year_level'] ?? '')) ?>
                                </td>
                                <td>
                                    <span class="<?= (strtolower($formattedStatus) === 'graduating') ? 'status-badge-graduating' : 'status-badge-enrolled' ?>">
                                        <?= htmlspecialchars($formattedStatus) ?>
                                    </span>
                                </td>
                                <td class="text-center pe-3">
                                    <a href="<?= function_exists('url') ? url('guidance/student-profile') : 'student-profile' ?>?student_id=<?= urlencode($row['student_id'] ?? $row['id']) ?>" class="btn btn-sm btn-view-maroon">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                <p class="mb-0 fw-semibold">No student records found</p>
                                <small>No database records matched your search query or selected filters.</small>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</div>
 
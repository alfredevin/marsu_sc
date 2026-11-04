<?php
include './../config.php';
include '../template/header.php';


?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>
    <?php

    // --- 1. HANDLE FILTERS ---
    $filter_emp = isset($_GET['emp_id']) ? $_GET['emp_id'] : '';
    $filter_stat = isset($_GET['status']) ? $_GET['status'] : '';

    // Build WHERE clause base (Always restrict to Dean's Department)
    $where_clause = "WHERE emp.department_id = '$dept_id'";

    if (!empty($filter_emp)) {
        $where_clause .= " AND emp.employee_id = '$filter_emp'";
    }
    if (!empty($filter_stat)) {
        $where_clause .= " AND ii.status = '$filter_stat'";
    }

    // --- 2. GET SUMMARY STATS (Based on Filter) ---
    // Helper function to count based on current filter
    function countStatus($conn, $where, $status_check)
    {
        $sql = "SELECT COUNT(*) as c 
            FROM issuance_items_tbl ii
            JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
            JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
            $where";

        if ($status_check != 'All') {
            $sql .= " AND ii.status = '$status_check'";
        }

        $res = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($res)['c'];
    }

    $count_total = countStatus($conn, $where_clause, 'All');
    $count_good  = countStatus($conn, $where_clause, 'Serviceable');
    $count_issue = countStatus($conn, $where_clause, 'Missing'); // Or add 'For Condemn' logic
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Department Equipment Status</h1>
            <p class="text-muted">Monitor the condition and accountability of assets in your department.</p>
        </div>

        <section class="section">

            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <form method="GET" class="row g-3 align-items-end">

                        <div class="col-md-5">
                            <label class="fw-bold small text-secondary mb-1">Filter by Employee</label>
                            <select name="emp_id" class="form-select" onchange="this.form.submit()">
                                <option value="">-- All Department Staff --</option>
                                <?php
                                // Fetch ONLY employees from this Department
                                $q_emp = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE department_id = '$dept_id' ORDER BY last_name ASC");
                                while ($e = mysqli_fetch_assoc($q_emp)) {
                                    $sel = ($e['employee_id'] == $filter_emp) ? 'selected' : '';
                                    echo "<option value='{$e['employee_id']}' $sel>{$e['last_name']}, {$e['first_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="fw-bold small text-secondary mb-1">Filter by Status</label>
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">-- All Statuses --</option>
                                <option value="Serviceable" <?= $filter_stat == 'Serviceable' ? 'selected' : '' ?>>Serviceable (Good)</option>
                                <option value="Missing" <?= $filter_stat == 'Missing' ? 'selected' : '' ?>>Missing (Lost)</option>
                                <option value="For Condemn" <?= $filter_stat == 'For Condemn' ? 'selected' : '' ?>>For Condemn (Damaged)</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <a href="dean_equipment_status.php" class="btn btn-light border w-100 text-muted">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-start border-primary border-4 shadow-sm">
                        <div class="card-body p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-muted text-uppercase fw-bold">Total Items</div>
                                <h3 class="fw-bold text-primary mb-0"><?= $count_total ?></h3>
                            </div>
                            <i class="bi bi-boxes fs-1 text-primary opacity-25"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-start border-success border-4 shadow-sm">
                        <div class="card-body p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-muted text-uppercase fw-bold">Serviceable</div>
                                <h3 class="fw-bold text-success mb-0"><?= $count_good ?></h3>
                            </div>
                            <i class="bi bi-check-circle fs-1 text-success opacity-25"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-start border-danger border-4 shadow-sm">
                        <div class="card-body p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-muted text-uppercase fw-bold">Issues (Missing/Condemn)</div>
                                <h3 class="fw-bold text-danger mb-0"><?= $count_issue ?></h3>
                            </div>
                            <i class="bi bi-exclamation-triangle fs-1 text-danger opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-primary m-0">Equipment List</h5>
                        <button onclick="window.print()" class="btn btn-sm btn-secondary"><i class="bi bi-printer"></i> Print Report</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Property No.</th>
                                    <th>Item Description</th>
                                    <th>Accountable Officer</th>
                                    <th>Date Issued</th>
                                    <th class="text-center">Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // MAIN QUERY
                                $query = "
                                    SELECT 
                                        ii.property_number, ii.status, ii.remarks,
                                        e.equipment_name, u.unit_name,
                                        emp.first_name, emp.last_name,
                                        i.issue_date
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    $where_clause
                                    ORDER BY emp.last_name ASC, ii.property_number ASC
                                ";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Status Badge Logic
                                        $stat = $row['status'] ?? 'Serviceable';
                                        if ($stat == 'Serviceable') {
                                            $badge = '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Serviceable</span>';
                                        } elseif ($stat == 'Missing') {
                                            $badge = '<span class="badge bg-danger"><i class="bi bi-question-circle"></i> Missing</span>';
                                        } elseif ($stat == 'For Condemn') {
                                            $badge = '<span class="badge bg-warning text-dark"><i class="bi bi-tools"></i> For Condemn</span>';
                                        } else {
                                            $badge = '<span class="badge bg-secondary">' . $stat . '</span>';
                                        }
                                ?>
                                        <tr>
                                            <td class="fw-bold text-dark"><?= $row['property_number'] ?></td>
                                            <td>
                                                <strong><?= $row['equipment_name'] ?></strong><br>
                                                <small class="text-muted"><?= $row['unit_name'] ?></small>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle me-2 p-1 small text-center" style="width:30px;">
                                                        <?= substr($row['first_name'], 0, 1) ?>
                                                    </div>
                                                    <?= $row['last_name'] . ', ' . $row['first_name'] ?>
                                                </div>
                                            </td>
                                            <td><?= date("M d, Y", strtotime($row['issue_date'])) ?></td>
                                            <td class="text-center"><?= $badge ?></td>
                                            <td>
                                                <small class="text-danger fst-italic">
                                                    <?= !empty($row['remarks']) ? $row['remarks'] : '' ?>
                                                </small>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center p-5 text-muted'>No records found for this filter.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <style>
        /* Print Styles to clean up report */
        @media print {

            header,
            aside,
            .pagetitle,
            .card-header,
            form,
            .btn,
            .breadcrumb {
                display: none !important;
            }

            #main {
                margin: 0;
                padding: 0;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            td,
            th {
                border: 1px solid black !important;
            }
        }
    </style>
</body>

</html>
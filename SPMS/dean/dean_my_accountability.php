<?php
include './../config.php';
include '../template/header.php';


?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>
    <?php
    // Assume Session Variables
    $user_id = 0; // Dean's ID 

    // --- 1. GET DEPARTMENT STATS ---
    $q_stats = mysqli_query($conn, "
    SELECT 
        COUNT(ii.id) as total_items,
        SUM(inv.unit_cost * ii.quantity) as total_value
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    WHERE emp.department_id = '$dept_id'
");
    $stats = mysqli_fetch_assoc($q_stats);
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Department Property Monitoring</h1>
            <p class="text-muted">Master list of all equipment issued within your department.</p>
        </div>

        <section class="section">

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-start border-primary border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold">Total Department Assets (Qty)</small>
                            <div class="d-flex align-items-center mt-2">
                                <div class="card-icon rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width:50px; height:50px;">
                                    <i class="bi bi-boxes fs-3"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0"><?= number_format($stats['total_items']) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-success border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold">Total Asset Value</small>
                            <div class="d-flex align-items-center mt-2">
                                <div class="card-icon rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" style="width:50px; height:50px;">
                                    <i class="bi bi-currency-peso fs-3"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">₱<?= number_format($stats['total_value'], 2) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-list-ul"></i> Issued Equipment List</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Property No.</th>
                                    <th>Item Description</th>
                                    <th>Accountable Officer</th>
                                    <th>Date Issued</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query ALL items issued to ANYONE in this department
                                $query = "
                                    SELECT 
                                        ii.property_number, ii.status,
                                        e.equipment_name, u.unit_name,
                                        emp.first_name, emp.last_name, emp.employee_id,
                                        i.issue_date
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id
                                    WHERE emp.department_id = '$dept_id'
                                    ORDER BY emp.last_name ASC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Status Badge Logic
                                    $stat = $row['status'] ?? 'Serviceable';
                                    if ($stat == 'Serviceable') {
                                        $badge = '<span class="badge bg-success">Serviceable</span>';
                                    } elseif ($stat == 'Missing') {
                                        $badge = '<span class="badge bg-danger">Missing</span>';
                                    } elseif ($stat == 'For Condemn') {
                                        $badge = '<span class="badge bg-warning text-dark">For Condemn</span>';
                                    } else {
                                        $badge = '<span class="badge bg-secondary">' . $stat . '</span>';
                                    }

                                    // Check if current user owns this item (Highlight it)
                                    $is_mine = ($row['employee_id'] == $user_id);
                                    $row_style = $is_mine ? 'background-color: #e8f4ff;' : '';
                                ?>
                                    <tr style="<?= $row_style ?>">
                                        <td class="fw-bold text-dark"><?= $row['property_number'] ?></td>

                                        <td>
                                            <strong><?= $row['equipment_name'] ?></strong><br>
                                            <small class="text-muted"><?= $row['unit_name'] ?></small>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded-circle me-2 p-1 small text-primary text-center" style="width:30px;">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div>
                                                    <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                                    <?php if ($is_mine): ?>
                                                        <span class="badge bg-primary ms-1" style="font-size: 0.6em;">YOU</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>

                                        <td><?= date("M d, Y", strtotime($row['issue_date'])) ?></td>
                                        <td class="text-center"><?= $badge ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
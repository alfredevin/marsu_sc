<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Issuance (PPMP Based)</h1>
            <p>Select a Department to view their approved items and proceed with issuance.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-building"></i> Department List</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Department / Office</th>
                                    <th>Dean / Head</th>
                                    <th class="text-center">PPMP Year</th>
                                    <th class="text-end">Total Budget</th>
                                    <th class="text-center">Issuance Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Get Deans with Approved PPMPs (Status = 2)
                                $query = "
                                    SELECT DISTINCT p.ppmp_id, p.year, d.first_name, d.last_name, dept.department_name, p.grand_total
                                    FROM ppmp_tbl p
                                    JOIN dean_tbl d ON p.dean_id = d.dean_id
                                    JOIN department_tbl dept ON d.department_id = dept.department_id
                                    WHERE p.status IN (4,5)
                                    ORDER BY p.date_created DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $ppmp_id = $row['ppmp_id'];

                                    // CHECK IF FULLY ISSUED
                                    // Count total items
                                    $q_total = mysqli_query($conn, "SELECT COUNT(*) as c FROM ppmp_items_tbl WHERE ppmp_id='$ppmp_id'");
                                    $r_total = mysqli_fetch_assoc($q_total);
                                    $total_items = $r_total['c'];

                                    // Count issued items
                                    $q_issued = mysqli_query($conn, "SELECT COUNT(*) as c FROM ppmp_items_tbl WHERE ppmp_id='$ppmp_id' AND is_issued=1");
                                    $r_issued = mysqli_fetch_assoc($q_issued);
                                    $issued_items = $r_issued['c'];

                                    // Logic for Status
                                    if ($issued_items == 0) {
                                        $status_badge = '<span class="badge bg-secondary">Pending</span>';
                                        $btn_text = 'Start Issuance';
                                        $btn_class = 'btn-primary';
                                        $row_class = '';
                                    } elseif ($issued_items < $total_items) {
                                        $status_badge = '<span class="badge bg-warning text-dark">Partially Issued (' . $issued_items . '/' . $total_items . ')</span>';
                                        $btn_text = 'Continue Issuance';
                                        $btn_class = 'btn-warning';
                                        $row_class = '';
                                    } else {
                                        $status_badge = '<span class="badge bg-success"><i class="bi bi-check-all"></i> Fully Issued</span>';
                                        $btn_text = 'View Details';
                                        $btn_class = 'btn-outline-success';
                                        $row_class = 'table-light text-muted'; // Gray out completed rows
                                    }
                                ?>
                                    <tr class="<?= $row_class ?>">
                                        <td>
                                            <span class="fw-bold text-dark"><?= $row['department_name'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded-circle me-2 p-1 text-primary small">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border"><?= $row['year'] ?></span>
                                        </td>
                                        <td class="text-end fw-bold text-success">
                                            ₱<?= number_format($row['grand_total'], 2) ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $status_badge ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="admin_issue_ppmp.php?ppmp_id=<?= $row['ppmp_id'] ?>" class="btn btn-sm <?= $btn_class ?> shadow-sm">
                                                <i class="bi bi-box-seam me-1"></i> <?= $btn_text ?>
                                            </a>
                                        </td>
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
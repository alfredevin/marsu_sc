<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Issued Semi-Expendable Supplies</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Supplies Monitoring</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-warning border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title text-warning m-0"><i class="bi bi-box-seam"></i> Issued Supplies (ICS)</h5>
                            <small class="text-muted">List of Low-Value items issued via Inventory Custodian Slip.</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>ICS / Tracking No.</th>
                                    <th>Item Description</th>
                                    <th>Custodian (Receiver)</th>
                                    <th class="text-center">Qty Issued</th>
                                    <th class="text-end">Total Value</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // FILTER: WHERE type = 'ICS'
                                $query = "
                                    SELECT 
                                        i.tracking_no,
                                        e.equipment_name,
                                        emp.first_name, emp.last_name,
                                        i.issue_date, i.issuance_id,
                                        ii.quantity,
                                        (ii.quantity * inv.unit_cost) as total_val
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    WHERE i.type = 'ICS'
                                    ORDER BY i.issue_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td class="fw-bold text-secondary"><?= $row['tracking_no'] ?></td>
                                        <td><?= $row['equipment_name'] ?></td>
                                        <td>
                                            <i class="bi bi-person-badge text-warning"></i>
                                            <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary rounded-pill"><?= $row['quantity'] ?></span>
                                        </td>
                                        <td class="text-end">₱<?= number_format($row['total_val'], 2) ?></td>
                                        <td class="text-center">
                                            <a href="print_par.php?id=<?= $row['issuance_id'] ?>" target="_blank" class="btn btn-sm btn-outline-warning text-dark" title="Reprint ICS">
                                                <i class="bi bi-printer-fill"></i>
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
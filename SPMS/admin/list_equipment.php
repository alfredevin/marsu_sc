<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Issued Equipment (PPE)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Equipment Monitoring</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title text-primary m-0"><i class="bi bi-pc-display"></i> Issued Property (PAR)</h5>
                            <small class="text-muted">List of High-Value Items issued via Property Acknowledgment Receipt.</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Property No.</th>
                                    <th>Description</th>
                                    <th>Accountable Officer</th>
                                    <th>Date Issued</th>
                                    <th class="text-end">Value</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // FILTER: WHERE type = 'PAR'
                                $query = "
                                    SELECT 
                                        ii.property_number,
                                        e.equipment_name,
                                        emp.first_name, emp.last_name,
                                        i.issue_date, i.issuance_id,
                                        inv.unit_cost
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    WHERE i.type = 'PAR'
                                    ORDER BY i.issue_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><span class="badge bg-dark"><?= $row['property_number'] ?></span></td>
                                        <td class="fw-bold"><?= $row['equipment_name'] ?></td>
                                        <td>
                                            <i class="bi bi-person-circle text-primary"></i>
                                            <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                        </td>
                                        <td><?= date("M d, Y", strtotime($row['issue_date'])) ?></td>
                                        <td class="text-end">₱<?= number_format($row['unit_cost'], 2) ?></td>
                                        <td class="text-center"><span class="badge bg-success">Serviceable</span></td>
                                        <td class="text-center">
                                            <a href="print_par.php?id=<?= $row['issuance_id'] ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="Reprint PAR">
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
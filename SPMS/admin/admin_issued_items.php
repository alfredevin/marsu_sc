<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Issued Property Monitoring</h1>
            <p>Master list of all equipment issued to employees and officials.</p>
        </div>

        <section class="section">

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-start border-primary border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase">Total Items Issued</small>
                            <?php
                            $q1 = mysqli_query($conn, "SELECT COUNT(*) as c FROM issuance_items_tbl");
                            $r1 = mysqli_fetch_assoc($q1);
                            ?>
                            <h3 class="fw-bold text-primary"><?= $r1['c'] ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-start border-info border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase">Issued via PAR (High Value)</small>
                            <?php
                            $q2 = mysqli_query($conn, "SELECT COUNT(*) as c FROM issuance_items_tbl ii JOIN issuance_tbl i ON ii.issuance_id=i.issuance_id WHERE i.type='PAR'");
                            $r2 = mysqli_fetch_assoc($q2);
                            ?>
                            <h3 class="fw-bold text-info"><?= $r2['c'] ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-start border-warning border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase">Issued via ICS (Low Value)</small>
                            <?php
                            $q3 = mysqli_query($conn, "SELECT COUNT(*) as c FROM issuance_items_tbl ii JOIN issuance_tbl i ON ii.issuance_id=i.issuance_id WHERE i.type='ICS'");
                            $r3 = mysqli_fetch_assoc($q3);
                            ?>
                            <h3 class="fw-bold text-warning"><?= $r3['c'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title">List of Issued Items</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Property No.</th>
                                    <th>Item Description</th>
                                    <th>Accountable Person (Receiver)</th>
                                    <th>Date Issued</th>
                                    <th class="text-center">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // JOIN 4 TABLES: Issuance Items -> Issuance Header -> Inventory -> Equipment -> Employee
                                $query = "
                                    SELECT 
                                        ii.property_number,
                                        e.equipment_name,
                                        emp.first_name, emp.last_name, emp.department_id,
                                        i.issue_date, i.type, i.tracking_no, i.issuance_id,
                                        dept.department_name
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    LEFT JOIN department_tbl dept ON emp.department_id = dept.department_id
                                    ORDER BY i.issue_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Badge Color
                                    $badge_class = ($row['type'] == 'PAR') ? 'bg-info text-dark' : 'bg-warning text-dark';
                                ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-dark"><?= $row['property_number'] ?></span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark"><?= $row['equipment_name'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-light rounded-circle me-2 p-2 text-primary small">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div>
                                                    <?= $row['first_name'] . ' ' . $row['last_name'] ?><br>
                                                    <small class="text-muted"><?= $row['department_name'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?= date("M d, Y", strtotime($row['issue_date'])) ?><br>
                                            <small class="text-muted"><?= $row['tracking_no'] ?></small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $badge_class ?>"><?= $row['type'] ?></span>
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
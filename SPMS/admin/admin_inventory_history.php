<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Inventory Conduct History</h1>
            <p>Records of past physical inventory activities per department.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-secondary"><i class="bi bi-clock-history"></i> Inventory Logs</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Date Conducted</th>
                                    <th>Department</th>
                                    <th>Conducted By</th>
                                    <th class="text-center">Total Items Checked</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query the History Header table
                                $query = "
                                    SELECT h.*, d.department_name,
                                    (SELECT COUNT(*) FROM inventory_conduct_items_tbl WHERE conduct_id = h.conduct_id) as total_items
                                    FROM inventory_conduct_tbl h
                                    JOIN department_tbl d ON h.department_id = d.department_id
                                    ORDER BY h.date_conducted DESC, h.created_at DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-dark">
                                                <?= date("F d, Y", strtotime($row['date_conducted'])) ?>
                                            </span><br>
                                            <small class="text-muted"><?= date("h:i A", strtotime($row['created_at'])) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <?= $row['department_name'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <i class="bi bi-person-check"></i> <?= $row['conducted_by'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill"><?= $row['total_items'] ?> items</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="admin_view_inventory_details.php?id=<?= $row['conduct_id'] ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye-fill me-1"></i> View Details
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
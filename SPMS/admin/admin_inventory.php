<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Inventory Monitoring</h1>
            <p>Current stocks available in the Supply Office.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-boxes"></i> Warehouse Stocks</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Item Description</th>
                                    <th class="text-center">Stocks On Hand</th>
                                    <th class="text-end">Unit Cost</th>
                                    <th class="text-end">Total Value</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Group by equipment to sum up stocks
                                $q_inv = mysqli_query($conn, "
                                    SELECT e.equipment_name, i.unit_cost, SUM(i.qty_on_hand) as total_qty
                                    FROM inventory_tbl i
                                    JOIN equipment_tbl e ON i.equipment_id = e.equipment_id
                                    GROUP BY i.equipment_id
                                ");
                                while ($row = mysqli_fetch_assoc($q_inv)) {
                                    $status = ($row['total_qty'] > 0) ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Out of Stock</span>';
                                    $total_val = $row['total_qty'] * $row['unit_cost'];
                                ?>
                                    <tr>
                                        <td class="fw-bold"><?= $row['equipment_name'] ?></td>
                                        <td class="text-center fs-5"><?= $row['total_qty'] ?></td>
                                        <td class="text-end">₱<?= number_format($row['unit_cost'], 2) ?></td>
                                        <td class="text-end text-muted">₱<?= number_format($total_val, 2) ?></td>
                                        <td class="text-center"><?= $status ?></td>
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
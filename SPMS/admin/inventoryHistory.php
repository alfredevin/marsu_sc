<?php
include './../config.php';
include '../template/header.php';

// --- GET SUMMARY STATS ---
$q_stats = mysqli_query($conn, "
    SELECT 
        COUNT(*) as total_skus,
        SUM(qty_on_hand) as total_items,
        SUM(qty_on_hand * unit_cost) as total_value
    FROM inventory_tbl
");
$stats = mysqli_fetch_assoc($q_stats);
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Inventory Master List</h1>
                <p class="text-muted">Overview of current stocks and asset value.</p>
            </div>
            <a href="print_inventory.php" target="_blank" class="btn btn-secondary">
                <i class="bi bi-printer-fill me-2"></i> Print Report
            </a>
        </div>

        <section class="section">

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-start border-primary border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold">Total Items (Qty)</small>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-boxes fs-3"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0"><?= number_format($stats['total_items']) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-start border-success border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold">Total Asset Value</small>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-cash-coin fs-3"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">₱<?= number_format($stats['total_value'], 2) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-start border-warning border-4 shadow-sm">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold">Low Stock Items</small>
                            <?php
                            // Count items with less than 5 qty
                            $q_low = mysqli_query($conn, "SELECT COUNT(*) as c FROM inventory_tbl WHERE qty_on_hand <= 5 AND qty_on_hand > 0");
                            $low = mysqli_fetch_assoc($q_low);
                            ?>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-exclamation-triangle fs-3"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0"><?= $low['c'] ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary">Stock List</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Item Description</th>
                                    <th class="text-end">Unit Cost</th>
                                    <th class="text-center">Stock Level</th>
                                    <th class="text-end">Total Value</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "
                                    SELECT i.*, e.equipment_name, u.unit_name
                                    FROM inventory_tbl i
                                    JOIN equipment_tbl e ON i.equipment_id = e.equipment_id
                                    LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id
                                    ORDER BY e.equipment_name ASC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $qty = $row['qty_on_hand'];
                                    $total_val = $qty * $row['unit_cost'];

                                    // Logic for Status Badge
                                    if ($qty == 0) {
                                        $badge = '<span class="badge bg-danger">Out of Stock</span>';
                                        $stock_color = 'text-danger';
                                    } elseif ($qty <= 5) {
                                        $badge = '<span class="badge bg-warning text-dark">Low Stock</span>';
                                        $stock_color = 'text-warning';
                                    } else {
                                        $badge = '<span class="badge bg-success">In Stock</span>';
                                        $stock_color = 'text-success';
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-dark"><?= $row['equipment_name'] ?></span><br>
                                            <small class="text-muted">Unit: <?= $row['unit_name'] ?></small>
                                        </td>
                                        <td class="text-end">₱<?= number_format($row['unit_cost'], 2) ?></td>
                                        <td class="text-center">
                                            <span class="fs-5 fw-bold <?= $stock_color ?>"><?= $qty ?></span>
                                        </td>
                                        <td class="text-end fw-bold text-secondary">₱<?= number_format($total_val, 2) ?></td>
                                        <td class="text-center"><?= $badge ?></td>
                                        <td class="text-center small text-muted">
                                            <?= date("M d, Y", strtotime($row['date_added'])) ?>
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
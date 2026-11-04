<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Issuance & Accountability</h1>
            <p>Select items from inventory to issue to End-Users.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-box-seam"></i> Available Stocks</h5>

                    <form action="admin_issue_form.php" method="GET">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">Select</th>
                                        <th>Item Description</th>
                                        <th class="text-center">Stocks Available</th>
                                        <th class="text-end">Unit Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get items from Inventory that have stocks > 0
                                    $q_inv = mysqli_query($conn, "
                                        SELECT i.*, e.equipment_name 
                                        FROM inventory_tbl i
                                        JOIN equipment_tbl e ON i.equipment_id = e.equipment_id
                                        WHERE i.qty_on_hand > 0
                                    ");
                                    while ($row = mysqli_fetch_assoc($q_inv)) {
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="selected_items[]" value="<?= $row['inventory_id'] ?>" class="form-check-input" style="transform: scale(1.3); cursor: pointer;">
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark"><?= $row['equipment_name'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success fs-6 rounded-pill"><?= $row['qty_on_hand'] ?> units</span>
                                            </td>
                                            <td class="text-end">₱<?= number_format($row['unit_cost'], 2) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary btn-lg shadow">
                                <i class="bi bi-arrow-right-circle me-2"></i> Proceed to Issue
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
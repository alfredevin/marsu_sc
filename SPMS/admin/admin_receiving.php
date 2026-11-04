<?php 

include './../config.php';
include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Receiving Module</h1>
            <p>Monitor incoming deliveries from suppliers.</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-warning border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-warning"><i class="bi bi-truck"></i> Pending Deliveries</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>PO Number</th>
                                    <th>Supplier</th>
                                    <th>Total Amount</th>
                                    <th>Date PO Generated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Get only POs that are "Pending Delivery"
                                $query = "
                                    SELECT po.*, s.supplier_name 
                                    FROM purchase_order_tbl po
                                    JOIN supplier_tbl s ON po.supplier_id = s.supplier_id
                                    WHERE po.status = 'Pending Delivery'
                                    ORDER BY po.po_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td class="fw-bold text-primary"><?= $row['po_number'] ?></td>
                                            <td><?= $row['supplier_name'] ?></td>
                                            <td>₱<?= number_format($row['total_amount'], 2) ?></td>
                                            <td><?= date("M d, Y", strtotime($row['po_date'])) ?></td>
                                            <td class="text-center">
                                                <a href="admin_receive_form?po_id=<?= $row['po_id'] ?>" class="btn btn-sm btn-success shadow-sm">
                                                    <i class="bi bi-box-seam me-1"></i> Receive Items
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
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
</body>

</html>
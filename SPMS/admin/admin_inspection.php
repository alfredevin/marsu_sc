<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Inspection & Acceptance</h1>
        </div>

        <section class="section">

            <ul class="nav nav-tabs nav-tabs-bordered mb-3">
                <li class="nav-item">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending">
                        <i class="bi bi-hourglass-split me-2"></i> For Inspection
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history">
                        <i class="bi bi-journal-check me-2"></i> Inspection History
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-2">

                <div class="tab-pane fade show active" id="pending">
                    <div class="card shadow-sm border-top border-info border-4">
                        <div class="card-body p-4">
                            <h5 class="card-title text-info">Pending Inspection</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>PO Number</th>
                                            <th>Supplier</th>
                                            <th>Date Received</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q_pend = mysqli_query($conn, "SELECT po.*, s.supplier_name FROM purchase_order_tbl po JOIN supplier_tbl s ON po.supplier_id = s.supplier_id WHERE po.status = 'Ready for Inspection'");
                                        while ($row = mysqli_fetch_assoc($q_pend)) {
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-primary"><?= $row['po_number'] ?></td>
                                                <td><?= $row['supplier_name'] ?></td>
                                                <td><?= date("M d, Y", strtotime($row['date_received'])) ?></td>
                                                <td class="text-center">
                                                    <a href="admin_inspection_form.php?po_id=<?= $row['po_id'] ?>" class="btn btn-sm btn-info text-white">
                                                        <i class="bi bi-pencil-square"></i> Inspect
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="history">
                    <div class="card shadow-sm border-top border-success border-4">
                        <div class="card-body p-4">
                            <h5 class="card-title text-success">Completed Inspections (IAR)</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>IAR ID</th>
                                            <th>PO Number</th>
                                            <th>Inspection Date</th>
                                            <th>Inspected By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Get Completed Inspections
                                        $q_hist = mysqli_query($conn, "
                                            SELECT iar.*, po.po_number 
                                            FROM inspection_report_tbl iar
                                            JOIN purchase_order_tbl po ON iar.po_id = po.po_id
                                            ORDER BY iar.inspection_date DESC
                                        ");
                                        while ($row = mysqli_fetch_assoc($q_hist)) {
                                        ?>
                                            <tr>
                                                <td class="fw-bold">IAR-<?= str_pad($row['iar_id'], 4, '0', STR_PAD_LEFT) ?></td>
                                                <td><?= $row['po_number'] ?></td>
                                                <td><?= date("M d, Y", strtotime($row['inspection_date'])) ?></td>
                                                <td><?= $row['inspection_officer'] ?></td>
                                                <td class="text-center">
                                                    <a href="print_iar.php?id=<?= $row['iar_id'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-printer"></i> View IAR
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
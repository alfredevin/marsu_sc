<?php
include './../config.php';
include '../template/header.php';

$my_id = 1; // Hardcoded for demo
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle mb-4">
            <h1>My Issuance History</h1>
            <p class="text-muted">Digital archive of your signed documents (PAR & ICS).</p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-secondary border-4">
                <div class="card-body p-4">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Document Reference</th>
                                    <th>Type</th>
                                    <th>Date Issued</th>
                                    <th class="text-center">Items</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "
                                    SELECT i.*, 
                                    (SELECT COUNT(*) FROM issuance_items_tbl WHERE issuance_id = i.issuance_id) as item_count
                                    FROM issuance_tbl i
                                    WHERE i.issued_to_user_id = '$my_id'
                                    ORDER BY i.issue_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Document Visuals
                                    if ($row['type'] == 'PAR') {
                                        $icon = '<i class="bi bi-file-earmark-richtext text-primary fs-5"></i>';
                                        $badge = '<span class="badge bg-primary bg-opacity-10 text-primary border border-primary">PAR (High Value)</span>';
                                    } else {
                                        $icon = '<i class="bi bi-file-earmark-text text-warning fs-5"></i>';
                                        $badge = '<span class="badge bg-warning bg-opacity-10 text-dark border border-warning">ICS (Low Value)</span>';
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3"><?= $icon ?></div>
                                                <div>
                                                    <div class="fw-bold text-dark"><?= $row['tracking_no'] ?></div>
                                                    <small class="text-muted">Official Receipt</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $badge ?></td>
                                        <td>
                                            <span class="text-muted small"><i class="bi bi-calendar-event"></i> <?= date("F d, Y", strtotime($row['issue_date'])) ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border rounded-pill px-3"><?= $row['item_count'] ?> items</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_<?= $row['issuance_id'] ?>" title="View Content">
                                                    <i class="bi bi-eye"></i> View
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal_<?= $row['issuance_id'] ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h6 class="modal-title fw-bold text-primary">
                                                        <i class="bi bi-box-seam me-2"></i> Items under <?= $row['tracking_no'] ?>
                                                    </h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <table class="table table-striped mb-0">
                                                        <thead class="table-dark small">
                                                            <tr>
                                                                <th class="ps-4">Property No.</th>
                                                                <th>Description</th>
                                                                <th class="text-center">Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $iid = $row['issuance_id'];
                                                            $q_items = mysqli_query($conn, "
                                                            SELECT ii.property_number, ii.quantity, e.equipment_name 
                                                            FROM issuance_items_tbl ii 
                                                            JOIN inventory_tbl inv ON ii.inventory_id=inv.inventory_id 
                                                            JOIN equipment_tbl e ON inv.equipment_id=e.equipment_id 
                                                            WHERE ii.issuance_id='$iid'");

                                                            while ($item = mysqli_fetch_assoc($q_items)) {
                                                                echo "<tr>
                                                                <td class='ps-4 font-monospace small'>{$item['property_number']}</td>
                                                                <td class='fw-bold text-secondary'>{$item['equipment_name']}</td>
                                                                <td class='text-center'>{$item['quantity']}</td>
                                                            </tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer py-1 bg-light">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
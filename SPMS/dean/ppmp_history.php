<?php
include './../config.php';
// Siguraduhin na ang $dean_id ay galing sa session logic mo
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>


<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <style>
        /* TIMELINE STYLES */
        .tracking-detail {
            padding: 3rem 0;
            position: relative;
        }

        .tracking-item {
            border-left: 3px solid #e9ecef;
            position: relative;
            padding: 0 0 2rem 2rem;
            margin-left: 1rem;
        }

        .tracking-item:last-child {
            padding-bottom: 0;
            border-left: 3px solid transparent;
        }

        .tracking-item .tracking-icon {
            position: absolute;
            left: -11px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid #e9ecef;
            z-index: 1;
        }

        .tracking-item.completed {
            border-left-color: #198754;
        }

        .tracking-item.completed .tracking-icon {
            background: #198754;
            border-color: #198754;
            box-shadow: 0 0 0 4px #d1e7dd;
        }

        .tracking-item.active {
            border-left-color: #0d6efd;
        }

        .tracking-item.active .tracking-icon {
            background: #0d6efd;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px #cfe2ff;
        }

        .tracking-item.rejected {
            border-left-color: #dc3545;
        }

        .tracking-item.rejected .tracking-icon {
            background: #dc3545;
            border-color: #dc3545;
            box-shadow: 0 0 0 4px #f8d7da;
        }

        .tracking-date {
            font-size: 0.85rem;
            color: #888;
            display: block;
        }

        .tracking-title {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .tracking-content {
            font-size: 0.9rem;
            color: #555;
        }

        /* BADGE STYLES */
        .badge-pending {
            background-color: #fd7e14;
            color: white;
        }

        .badge-approved {
            background-color: #198754;
            color: white;
        }

        .badge-rfq {
            background-color: #0dcaf0;
            color: white;
        }

        .badge-procurement {
            background-color: #0d6efd;
            color: white;
        }
    </style>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>PPMP Tracking</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title">Submission History</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tracking ID</th>
                                            <th>Year</th>
                                            <th>Date Submitted</th>
                                            <th class="text-end">Total Budget</th>
                                            <th class="text-center">Current Stage</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM ppmp_tbl WHERE dean_id = '$dean_id' ORDER BY date_created DESC";
                                        $result = mysqli_query($conn, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $ppmp_id = $row['ppmp_id'];
                                            $status = $row['status'];

                                            // Status Badge Logic
                                            if ($status == 1) {
                                                $s_text = "Pending";
                                                $s_badge = "badge-pending";
                                            } elseif ($status == 2) {
                                                $s_text = "Approved";
                                                $s_badge = "badge-approved";
                                            } elseif ($status == 3) {
                                                $s_text = "Consolidated";
                                                $s_badge = "badge-rfq";
                                            } elseif ($status == 4) {
                                                $s_text = "Procurement";
                                                $s_badge = "badge-procurement";
                                            } elseif ($status == 10) {
                                                $s_text = "Rejected";
                                                $s_badge = "bg-danger";
                                            } else {
                                                $s_text = "Completed";
                                                $s_badge = "bg-secondary";
                                            }
                                        ?>
                                            <tr>
                                                <td class="fw-bold text-primary">#<?= str_pad($ppmp_id, 4, '0', STR_PAD_LEFT); ?></td>
                                                <td><?= $row['year'] ?></td>
                                                <td><?= date("M d, Y", strtotime($row['date_created'])) ?></td>
                                                <td class="text-end fw-bold">₱<?= number_format($row['grand_total'], 2) ?></td>
                                                <td class="text-center">
                                                    <span class="badge rounded-pill <?= $s_badge ?> px-3"><?= $s_text ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#view_<?= $ppmp_id ?>"><i class="bi bi-file-text"></i></button>
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#track_<?= $ppmp_id ?>"><i class="bi bi-geo-alt-fill"></i> Track</button>
                                                    </div>
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

    <?php
    mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_assoc($result)) {
        $ppmp_id = $row['ppmp_id'];
        $status = $row['status'];
        $remarks = $row['remarks'];
        $reason = $row['reason'];
        $created_at = date("F d, Y h:i A", strtotime($row['date_created']));

        $steps = [
            1 => ['title' => 'Submitted to Admin', 'desc' => 'PPMP has been submitted and is pending review.'],
            2 => ['title' => 'Approved by Budget Office', 'desc' => 'Budget verified and items merged.'],
            3 => ['title' => 'Consolidated (APP)', 'desc' => 'Items are included in the Annual Procurement Plan.'],
            4 => ['title' => 'RFQ Process', 'desc' => 'Request for Quotations sent to suppliers.'],
            5 => ['title' => 'Delivered / Closed', 'desc' => 'Items received. Transaction complete.']
        ];
    ?>
        <div class="modal fade" id="track_<?= $ppmp_id ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold <?= ($status == 10) ? 'text-danger' : 'text-primary' ?>">
                            <i class="bi bi-geo-alt me-2"></i>Tracker #<?= str_pad($ppmp_id, 4, '0', STR_PAD_LEFT); ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php if ($status == 10): ?>
                            <div class="alert alert-danger border-0 shadow-sm mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-x-circle-fill fs-4 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">Your PPMP was Rejected</h6>
                                        <p class="mb-2 small">Reason: <strong><?= !empty($remarks) ? $remarks : 'No specific reason provided.' ?></strong></p>
                                        <a href="create_ppmp.php" class="btn btn-sm btn-danger rounded-pill px-3">Revise Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="tracking-detail py-0">
                            <?php foreach ($steps as $key => $step):
                                $is_completed = ($status > $key && $status != 10);
                                $is_active = ($status == $key);
                                $css_class = $is_completed ? "completed" : ($is_active ? "active" : "");
                                if ($status == 10 && $key == 1) $css_class = "completed";
                                $time_display = ($key == 1) ? $created_at : ($is_completed || $is_active ? "Updated" : "Pending");
                            ?>
                                <div class="tracking-item <?= $css_class ?>">
                                    <div class="tracking-icon"></div>
                                    <span class="tracking-date"><?= $time_display ?></span>
                                    <div class="tracking-title"><?= $step['title'] ?></div>
                                    <p class="tracking-content small"><?= $step['desc'] ?></p>
                                </div>
                                <?php if ($status == 10 && $key == 1): ?>
                                    <div class="tracking-item rejected">
                                        <div class="tracking-icon"></div>
                                        <span class="tracking-date text-danger fw-bold">Rejected</span>
                                        <div class="tracking-title text-danger">Returned to Department</div>
                                        <p class="tracking-content text-danger small">Please check the reason and resubmit.</p>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="view_<?= $ppmp_id ?>" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">PPMP Items - FY <?= $row['year'] ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="p-3 bg-light border-bottom">
                            <label class="small fw-bold text-muted text-uppercase d-block">Justification / Reason:</label>
                            <span class="text-dark small italic">"<?= !empty($reason) ? htmlspecialchars($reason) : 'No justification provided.' ?>"</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="table-dark small">
                                    <tr>
                                        <th class="ps-4">Item Name</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Gagamit ng LEFT JOIN para lumabas ang custom_item_name kung NULL ang equipment_id
                                    $q_items = mysqli_query($conn, "SELECT pi.*, e.equipment_name 
                                                                   FROM ppmp_items_tbl pi 
                                                                   LEFT JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id 
                                                                   WHERE pi.ppmp_id = '$ppmp_id'");
                                    while ($item = mysqli_fetch_assoc($q_items)) {
                                        $display_name = !empty($item['equipment_name']) ? $item['equipment_name'] : $item['custom_item_name'];
                                        $is_custom = empty($item['equipment_id']) ? ' <span class="badge bg-info" style="font-size: 10px;">New Item</span>' : '';
                                    ?>
                                        <tr>
                                            <td class="ps-4"><?= $display_name . $is_custom ?></td>
                                            <td class="text-center"><?= $item['quantity'] ?></td>
                                            <td class="text-end">₱<?= number_format($item['price'], 2) ?></td>
                                            <td class="text-end pe-4">₱<?= number_format($item['total_amount'], 2) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <a href="print_ppmp.php?id=<?= $ppmp_id ?>" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> Print</a>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
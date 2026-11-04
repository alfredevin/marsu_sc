<?php
include './../config.php';

// --- PHPMailer Setup ---
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './../mailer/src/Exception.php';
require './../mailer/src/PHPMailer.php';
require './../mailer/src/SMTP.php';

function sendCustomEmail($to, $name, $subject, $bodyContent)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'onlineorderingandinventory@gmail.com';
        $mail->Password = 'kdikvnkzmzrcvylc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('onlineorderingandinventory@gmail.com', 'MarSU BAC Secretariat');
        $mail->addAddress($to, $name);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $bodyContent;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

include '../template/header.php';

// --- HANDLE AWARDING LOGIC ---
if (isset($_POST['award_supplier_lot'])) {
    $winner_supp_id = $_POST['supplier_id'];
    $remarks = mysqli_real_escape_string($conn, $_POST['award_remarks']);
    $items_list = $_POST['items_list'];

    foreach ($items_list as $equip_id) {
        $q_price = mysqli_query($conn, "SELECT ri.offered_price FROM rfq_items_tbl ri 
                                        JOIN rfq_tokens_tbl rt ON ri.token_id = rt.id 
                                        WHERE ri.equipment_id = '$equip_id' AND rt.supplier_id = '$winner_supp_id'");
        $p_row = mysqli_fetch_assoc($q_price);
        $final_price = $p_row['offered_price'] ?? 0;

        mysqli_query($conn, "INSERT INTO awarded_items_tbl (equipment_id, supplier_id, awarded_price, remarks, date_awarded) 
                             VALUES ('$equip_id', '$winner_supp_id', '$final_price', '$remarks', NOW())");

        mysqli_query($conn, "UPDATE ppmp_items_tbl SET status = 4 WHERE equipment_id = '$equip_id'");
    }
    mysqli_query($conn, "UPDATE ppmp_tbl SET rfq = 'OK' WHERE status = 4 AND rfq IS NULL");

    $win_q = mysqli_query($conn, "SELECT * FROM supplier_tbl WHERE supplier_id = '$winner_supp_id'");
    $winner = mysqli_fetch_assoc($win_q);

    if ($winner['email']) {
        $bodyWinner = '
            <div style="font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd;">
                <h2 style="color: #198754; border-bottom: 2px solid #198754; padding-bottom: 10px;">NOTICE OF AWARD</h2>
                <p>Dear <strong>' . $winner['supplier_name'] . '</strong>,</p>
                <p>We are pleased to inform you that the procurement project has been awarded to your company.</p>
                <div style="background: #f4f4f4; padding: 15px; border-left: 5px solid #198754; margin: 20px 0;">
                    <strong>BAC Remarks/Justification:</strong><br>
                    <em>' . nl2br($remarks) . '</em>
                </div>
                <p>Please coordinate with the BAC Secretariat for the processing of the Purchase Order.</p>
                <br>
                <p>Best regards,<br><strong>MarSU Bids and Awards Committee</strong></p>
            </div>';
        sendCustomEmail($winner['email'], $winner['supplier_name'], "Notice of Award - MarSU", $bodyWinner);
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({ icon: 'success', title: 'Award Finalized!', text: 'Project moved to history and email sent.', confirmButtonColor: '#198754' })
            .then(() => { window.location.href = 'supplier_rfq'; });
        });
    </script>";
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Abstract of Bids & Awards</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Awarding</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <ul class="nav nav-tabs nav-tabs-bordered mb-4" id="awardTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                        type="button" role="tab">
                        <i class="bi bi-hammer me-2"></i> Active Bidding
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history"
                        type="button" role="tab">
                        <i class="bi bi-clock-history me-2"></i> Award History
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-2">

                <div class="tab-pane fade show active" id="active" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <?php
                            $q_rfq = mysqli_query($conn, "SELECT DISTINCT rfq_no FROM ppmp_tbl WHERE status = 4 AND rfq IS NULL");
                            $row_rfq = mysqli_fetch_assoc($q_rfq);
                            $selected_rfq = $row_rfq['rfq_no'] ?? 'NO ACTIVE RFQ';
                            ?>

                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <div>
                                    <h5 class="card-title text-primary mb-0">Bid Comparison Matrix</h5>
                                    <small class="text-muted">RFQ Ref: <span
                                            class="fw-bold text-dark"><?= $selected_rfq ?></span></small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-light text-dark border p-2">
                                        <i class="bi bi-calendar-check me-1 text-primary"></i> <?= date('F d, Y') ?>
                                    </span>
                                </div>
                            </div>

                            <?php
                            $q_check = mysqli_query($conn, "SELECT * FROM ppmp_items_tbl WHERE status = 2");
                            if (mysqli_num_rows($q_check) > 0) {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-center table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-start">Item Description</th>
                                                <th width="80px">Qty</th>
                                                <?php
                                                $sup_ids = [];
                                                $grand_totals = [];
                                                $q_sups = mysqli_query($conn, "SELECT DISTINCT s.supplier_name, s.supplier_id 
                                                                               FROM rfq_tokens_tbl rt 
                                                                               JOIN supplier_tbl s ON rt.supplier_id = s.supplier_id 
                                                                               WHERE rt.status = 'Submitted' LIMIT 3");
                                                while ($s = mysqli_fetch_assoc($q_sups)) {
                                                    $sup_ids[$s['supplier_id']] = $s['supplier_name'];
                                                    $grand_totals[$s['supplier_id']] = 0;
                                                    echo "<th>{$s['supplier_name']}<br><small class='fw-light' style='font-size:10px;'>Supplier Quote</small></th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $q_items = mysqli_query($conn, "SELECT DISTINCT ri.equipment_id, e.equipment_name FROM rfq_items_tbl ri JOIN equipment_tbl e ON ri.equipment_id = e.equipment_id JOIN ppmp_items_tbl pi ON ri.equipment_id = pi.equipment_id WHERE pi.status = 2");
                                            $item_ids_array = [];
                                            while ($item = mysqli_fetch_assoc($q_items)) {
                                                $eid = $item['equipment_id'];
                                                $item_ids_array[] = $eid;

                                                $q_qty = mysqli_query($conn, "SELECT quantity FROM rfq_items_tbl WHERE equipment_id='$eid' LIMIT 1");
                                                $r_qty = mysqli_fetch_assoc($q_qty);
                                                $qty = $r_qty['quantity'] ?? 0;
                                                ?>
                                                <tr>
                                                    <td class="text-start fw-bold"><?= $item['equipment_name'] ?></td>
                                                    <td><span class="badge bg-secondary"><?= $qty ?></span></td>
                                                    <?php foreach ($sup_ids as $sid => $sname):
                                                        $q_p = mysqli_query($conn, "SELECT offered_price FROM rfq_items_tbl ri JOIN rfq_tokens_tbl rt ON ri.token_id = rt.id WHERE ri.equipment_id = '$eid' AND rt.supplier_id = '$sid'");
                                                        $p_row = mysqli_fetch_assoc($q_p);
                                                        $price = $p_row['offered_price'] ?? 0;
                                                        $total_row = $price * $qty;
                                                        $grand_totals[$sid] += $total_row;
                                                        ?>
                                                        <td>
                                                            <?php if ($price > 0): ?>
                                                                <div class="fw-bold text-primary">₱<?= number_format($price, 2) ?></div>
                                                                <div class="text-muted small">Total:
                                                                    ₱<?= number_format($total_row, 2) ?></div>
                                                            <?php else:
                                                                echo "-"; endif; ?>
                                                        </td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr class="align-middle">
                                                <td colspan="2" class="text-end fw-bold">GRAND TOTAL BID:</td>
                                                <?php
                                                $valid_bids = array_filter($grand_totals);
                                                $lowest_bid = (count($valid_bids) > 0) ? min($valid_bids) : 0;
                                                foreach ($grand_totals as $sid => $total):
                                                    $is_lowest = ($total == $lowest_bid && $total > 0);
                                                    ?>
                                                    <td class="<?= $is_lowest ? 'bg-success bg-opacity-10' : '' ?>">
                                                        <h5
                                                            class="fw-bold mb-1 <?= $is_lowest ? 'text-success' : 'text-dark' ?>">
                                                            ₱<?= number_format($total, 2) ?></h5>
                                                        <?php if ($is_lowest): ?><span class="badge bg-success mb-2">Lowest
                                                                Bid</span><br><?php endif; ?>
                                                        <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm"
                                                            onclick="prepareAward('<?= $sid ?>', '<?= $sup_ids[$sid] ?>', '<?= number_format($total, 2) ?>')">Award
                                                            Lot</button>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            <?php } else {
                                echo "<div class='text-center py-5'><i class='bi bi-check2-circle fs-1 text-success'></i><h5 class='mt-3 text-muted'>All items have been awarded.</h5></div>";
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="history" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title text-secondary mb-4"><i class="bi bi-archive me-2"></i>Awarded Records
                                History</h5>

                            <div class="accordion accordion-flush" id="historyAccordion">
                                <?php
                                $years_q = mysqli_query($conn, "SELECT DISTINCT YEAR(date_awarded) as yr FROM awarded_items_tbl ORDER BY yr DESC");
                                if (mysqli_num_rows($years_q) > 0) {
                                    while ($yr_row = mysqli_fetch_assoc($years_q)) {
                                        $yr = $yr_row['yr'];
                                        $collapse_id = "collapse" . $yr;
                                        ?>
                                        <div class="accordion-item border rounded mb-3 shadow-sm">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button fw-bold text-primary bg-light" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#<?= $collapse_id ?>">
                                                    <i class="bi bi-calendar3 me-2"></i> Fiscal Year <?= $yr ?>
                                                </button>
                                            </h2>

                                            <div id="<?= $collapse_id ?>" class="accordion-collapse collapse show"
                                                data-bs-parent="#historyAccordion">
                                                <div class="accordion-body bg-white">
                                                    <div class="row">
                                                        <?php
                                                        // Updated Query to include supplier_id for the print button
                                                        $hist_sql = "SELECT 
                                                                        a.supplier_id,
                                                                        s.supplier_name, 
                                                                        a.remarks, 
                                                                        a.date_awarded, 
                                                                        GROUP_CONCAT(CONCAT('• ', e.equipment_name, ' (₱', FORMAT(a.awarded_price, 2), ')') SEPARATOR '<br>') as item_details, 
                                                                        SUM(a.awarded_price) as total_batch_price 
                                                                     FROM awarded_items_tbl a 
                                                                     JOIN equipment_tbl e ON a.equipment_id = e.equipment_id 
                                                                     JOIN supplier_tbl s ON a.supplier_id = s.supplier_id 
                                                                     WHERE YEAR(a.date_awarded) = '$yr'
                                                                     GROUP BY a.supplier_id, s.supplier_name, a.date_awarded, a.remarks
                                                                     ORDER BY a.date_awarded DESC";

                                                        $hist_res = mysqli_query($conn, $hist_sql);
                                                        while ($h = mysqli_fetch_assoc($hist_res)) {
                                                            ?>
                                                            <div class="col-md-12 mb-3">
                                                                <div
                                                                    class="card border-0 border-start border-success border-4 shadow-sm bg-white">
                                                                    <div class="card-body p-3">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-start mb-2">
                                                                            <div>
                                                                                <h6 class="fw-bold text-success mb-0">
                                                                                    <?= $h['supplier_name'] ?></h6>
                                                                                <small class="text-muted"><i
                                                                                        class="bi bi-clock-history"></i>
                                                                                    <?= date("M d, Y h:i A", strtotime($h['date_awarded'])) ?></small>
                                                                            </div>
                                                                            <div class="text-end">
                                                                                <span class="text-muted small d-block">Total
                                                                                    Awarded</span>
                                                                                <span
                                                                                    class="fw-bold text-dark">₱<?= number_format($h['total_batch_price'], 2) ?></span>

                                                                                <div class="mt-2">
                                                                                    <a href="print_awarded_rfq.php?sid=<?= $h['supplier_id'] ?>&date=<?= urlencode($h['date_awarded']) ?>"
                                                                                        target="_blank"
                                                                                        class="btn btn-sm btn-outline-danger shadow-sm">
                                                                                        <i class="bi bi-printer me-1"></i> Print RFQ
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-2 bg-light rounded border mb-2">
                                                                            <div class="small fw-bold text-secondary mb-1">Items
                                                                                Awarded:</div>
                                                                            <div class="small text-dark lh-sm">
                                                                                <?= $h['item_details'] ?></div>
                                                                        </div>
                                                                        <div class="small">
                                                                            <span class="fw-bold text-secondary"><i
                                                                                    class="bi bi-chat-left-text me-1"></i> BAC
                                                                                Remarks:</span>
                                                                            <p class="fst-italic text-muted mb-0">
                                                                                <?= $h['remarks'] ?: 'No justification provided.' ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo "<div class='text-center py-5'><img src='../assets/img/not-found.svg' style='width:120px; opacity:0.5;'><p class='text-muted mt-3'>No awarded records found.</p></div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <div class="modal fade" id="awardModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-check2-square me-2"></i>Finalize Awarding</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="supplier_id" id="modal_supplier_id">
                        <?php foreach ($item_ids_array as $id)
                            echo "<input type='hidden' name='items_list[]' value='$id'>"; ?>

                        <div class="alert alert-info border-0 shadow-sm">
                            <p class="mb-1 small">Winner Supplier:</p>
                            <h5 class="fw-bold mb-0 text-primary" id="modal_supplier_name"></h5>
                            <p class="mb-0 mt-2">Total Project Cost: <strong id="modal_total_amount"
                                    class="text-dark"></strong></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Awarding Remarks / Justification:</label>
                            <textarea name="award_remarks" class="form-control" rows="4"
                                placeholder="Explain why this supplier was chosen..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="award_supplier_lot" class="btn btn-success px-4 fw-bold">
                            <i class="bi bi-send me-2"></i>Confirm & Send Notice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        function prepareAward(id, name, total) {
            document.getElementById('modal_supplier_id').value = id;
            document.getElementById('modal_supplier_name').innerText = name;
            document.getElementById('modal_total_amount').innerText = "₱" + total;
            var myModal = new bootstrap.Modal(document.getElementById('awardModal'));
            myModal.show();
        }
    </script>
</body>

</html>
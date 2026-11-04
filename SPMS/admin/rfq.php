<?php
include './../config.php';
$generated_rfq_no = 'RFQ-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './../mailer/src/Exception.php';
require './../mailer/src/PHPMailer.php';
require './../mailer/src/SMTP.php';

include '../template/header.php';

// --- EMAIL SENDING & STATUS UPDATE LOGIC ---
if (isset($_POST['send_emails'])) {

    // 1. Validate Selection
    if (!isset($_POST['items']) || empty($_POST['items'])) {
        echo "<script>document.addEventListener('DOMContentLoaded', () => Swal.fire('Error', 'Please select at least one item.', 'error'));</script>";
    } else {
        $items = $_POST['items'];

        // Filter valid suppliers
        $suppliers = array_filter([
            $_POST['supplier_1'],
            $_POST['supplier_2'],
            $_POST['supplier_3']
        ]);

        if (empty($suppliers)) {
            echo "<script>document.addEventListener('DOMContentLoaded', () => Swal.fire('Error', 'Please select at least one supplier.', 'error'));</script>";
        } else {

            // 2. Initialize Mailer
            $sent_count = 0;
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'onlineorderingandinventory@gmail.com';
                $mail->Password   = 'kdikvnkzmzrcvylc'; // Your App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465; 
                $mail->setFrom('onlineorderingandinventory@gmail.com', 'MarSU BAC Secretariat');
                $mail->isHTML(true);
                $mail->Subject = 'Request for Quotation (RFQ) - Marinduque State University';
            } catch (Exception $e) { /* Connection Fail */
            }

            // 3. Process Emails per Supplier
            foreach ($suppliers as $supplier_name) {
                // Get Supplier Details
                $sup_q = mysqli_query($conn, "SELECT * FROM supplier_tbl WHERE supplier_name = '$supplier_name'");
                $sup_data = mysqli_fetch_assoc($sup_q);

                if (!$sup_data || empty($sup_data['email'])) continue;

                $supplier_id = $sup_data['supplier_id'];
                $supplier_email = $sup_data['email'];

                // Generate Token & Save to DB
                $token = bin2hex(random_bytes(32));
                mysqli_query($conn, "INSERT INTO rfq_tokens_tbl (token, supplier_id) VALUES ('$token', '$supplier_id')");
                $token_id = mysqli_insert_id($conn);

                // Link Items to Token
                foreach ($items as $equip_id) {
                    $qty = $_POST['qty_' . $equip_id];
                    mysqli_query($conn, "INSERT INTO rfq_items_tbl (token_id, equipment_id, quantity) VALUES ('$token_id', '$equip_id', '$qty')");
                }

                // Send Email
                $link = "http://localhost/boac/spms/supplier/supplier_input.php?t=" . $token; // UPDATE DOMAIN IF LIVE

                try {
                    $mail->clearAddresses();
                    $mail->addAddress($supplier_email, $supplier_name);
                    $mail->Body = '
                        <div style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px;">
                            <div style="text-align: center; border-bottom: 2px solid #800000; padding-bottom: 10px;">
                                <h2 style="color: #800000; margin: 0;">MARINDUQUE STATE UNIVERSITY</h2>
                                <p style="margin: 5px 0;">Bids and Awards Committee (BAC)</p>
                            </div>
                            <p>Dear <strong>' . $supplier_name . '</strong>,</p>
                            <p>You are invited to submit your price quotation for the procurement of various items.</p>
                            <div style="text-align: center; margin: 30px 0;">
                                <a href="' . $link . '" style="background-color: #800000; color: white; padding: 12px 25px; text-decoration: none; font-weight: bold; border-radius: 5px;">Submit Quotation Now</a>
                            </div>
                            <p style="font-size: 12px; color: #666;">Or copy this link: <a href="' . $link . '">' . $link . '</a></p>
                        </div>';

                    $mail->send();
                    $sent_count++;
                } catch (Exception $e) { /* Send Fail */
                }
            }

            // 4. UPDATE STATUS LOGIC (Item & Parent)

            $affected_ppmp_ids = [];

            foreach ($items as $equip_id) {
                // A. Update Items (pi.status = 2 -> "RFQ Sent")
                // Only update items that are currently Pending (1) inside Approved PPMPs (3)
                $update_item_sql = "UPDATE ppmp_items_tbl pi 
                                    INNER JOIN ppmp_tbl p ON pi.ppmp_id = p.ppmp_id
                                    SET pi.status = 2 
                                    WHERE pi.equipment_id = '$equip_id' 
                                    AND p.status = 3 
                                    AND pi.status = 1";
                mysqli_query($conn, $update_item_sql);

                // B. Find affected Parent PPMPs to update them later
                $find_ppmp_sql = "SELECT DISTINCT pi.ppmp_id 
                                  FROM ppmp_items_tbl pi 
                                  WHERE pi.equipment_id = '$equip_id' AND pi.status = 2";
                $res = mysqli_query($conn, $find_ppmp_sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $affected_ppmp_ids[] = $row['ppmp_id'];
                }
            }

            // C. Update Parent PPMP (p.status = 4 -> "RFQ Sent / In Progress")
            if (!empty($affected_ppmp_ids)) {
                $unique_ids = array_unique($affected_ppmp_ids);
                $ids_string = implode(',', $unique_ids);

                $update_parent = "UPDATE ppmp_tbl 
                      SET status = 4, rfq_no = '$generated_rfq_no' 
                      WHERE ppmp_id IN ($ids_string) AND status = 3";
                mysqli_query($conn, $update_parent);
            }


            // 5. Success Message
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'RFQ Processed!',
                        text: 'Emails sent successfully. Items have been updated to RFQ Sent status.',
                        confirmButtonColor: '#800000'
                    }).then(() => {
                        window.location.href = 'rfq'; // Reload to clear list
                    });
                });
            </script>";
        }
    }
}
?>

<style>
    .sticky-panel {
        position: -webkit-sticky;
        position: sticky;
        top: 80px;
        z-index: 100;
    }

    .clickable-row {
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .clickable-row:hover {
        background-color: #f8f9fa;
    }

    .form-check-input {
        cursor: pointer;
        transform: scale(1.2);
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Create Request for Quotation</h1>
                <nav>
                    <ol class="breadcrumb"></ol>
                </nav>
            </div>
            <div class="text-end">
                <div class="badge bg-white text-dark border p-2 shadow-sm">
                    <span class="text-muted small d-block">Document Reference:</span>
                    <h5 class="fw-bold text-primary mb-0"><?= $generated_rfq_no ?></h5>
                </div>
            </div>
        </div>

        <section class="section">
            <form method="POST" id="rfqForm">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card shadow-sm border-top border-primary border-3">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title m-0 text-primary">1. Select Approved Items</h5>
                                    <span class="badge bg-primary fs-6"><span id="count_display">0</span> Selected</span>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%" class="text-center"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                                                <th>Item Description</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">ABC (Est. Price)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // QUERY: Select only Status 3 (Ready for RFQ) AND Item Status 1 (Pending)
                                            $query = "SELECT e.equipment_id, e.equipment_name, e.price, SUM(pi.quantity) as total_qty
                                                      FROM ppmp_items_tbl pi
                                                      JOIN ppmp_tbl p ON pi.ppmp_id = p.ppmp_id
                                                      JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id
                                                      WHERE p.status = 3 
                                                      AND pi.status = 1 
                                                      GROUP BY pi.equipment_id";

                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <tr class="clickable-row" onclick="toggleRow(this)">
                                                        <td class="text-center">
                                                            <input type="checkbox" name="items[]" value="<?= $row['equipment_id'] ?>" class="form-check-input item-check" onclick="event.stopPropagation(); updateCount();">
                                                            <input type="hidden" name="qty_<?= $row['equipment_id'] ?>" value="<?= $row['total_qty'] ?>">
                                                        </td>
                                                        <td class="fw-bold text-dark"><?= $row['equipment_name'] ?></td>
                                                        <td class="text-center"><span class="badge bg-secondary"><?= $row['total_qty'] ?></span></td>
                                                        <td class="text-end">₱<?= number_format($row['price'], 2) ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center p-5 text-muted'>No items pending for RFQ.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow border-top border-success border-3 sticky-panel">
                            <div class="card-body p-4">
                                <h5 class="card-title text-success">2. Select Suppliers</h5>
                                <p class="small text-muted mb-3">Choose 3 distinct suppliers.</p>

                                <?php
                                // QUERY: Naka-alphabetical order na rito
                                $sup_q = mysqli_query($conn, "SELECT * FROM supplier_tbl ORDER BY supplier_name ASC");
                                $suppliers_list = [];
                                while ($s = mysqli_fetch_assoc($sup_q)) {
                                    $suppliers_list[] = $s['supplier_name'];
                                }
                                ?>

                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                    <div class="form-floating mb-3">
                                        <select name="supplier_<?= $i ?>" id="sup_<?= $i ?>" class="form-select supplier-select">
                                            <option value="">-- Choose Supplier --</option>
                                            <?php foreach ($suppliers_list as $sup_name): ?>
                                                <option value="<?= htmlspecialchars($sup_name) ?>"><?= htmlspecialchars($sup_name) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label>Supplier <?= $i ?></label>
                                    </div>
                                <?php endfor; ?>

                                <hr>

                                <div class="d-grid gap-2">
                                    <button type="submit" formaction="print_rfq.php" formtarget="_blank" class="btn btn-outline-dark fw-bold">
                                        <i class="bi bi-printer me-2"></i> Print Forms
                                    </button>

                                    <button type="button" class="btn btn-success fw-bold" onclick="confirmSend()">
                                        <i class="bi bi-send-fill me-2"></i> Send Emails
                                    </button>

                                    <button type="submit" name="send_emails" id="realSubmitBtn" style="display:none;"></button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>

    <script>
        // --- UI LOGIC ---
        function toggleRow(row) {
            const checkbox = row.querySelector('.item-check');
            checkbox.checked = !checkbox.checked;
            updateCount();
        }

        document.getElementById('checkAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.item-check');
            for (var checkbox of checkboxes) checkbox.checked = this.checked;
            updateCount();
        });

        function updateCount() {
            document.getElementById('count_display').innerText = document.querySelectorAll('.item-check:checked').length;
        }

        // --- SMART DROPDOWN LOGIC ---
        const selects = document.querySelectorAll('.supplier-select');
        selects.forEach(select => {
            select.addEventListener('change', updateSupplierOptions);
        });

        function updateSupplierOptions() {
            const selectedValues = Array.from(selects).map(s => s.value).filter(val => val !== "");
            selects.forEach(select => {
                const currentVal = select.value;
                Array.from(select.options).forEach(opt => {
                    if (opt.value === "") return;
                    opt.disabled = selectedValues.includes(opt.value) && opt.value !== currentVal;
                });
            });
        }

        // --- CONFIRMATION & LOADING LOGIC ---
        function confirmSend() {
            const checkedBoxes = document.querySelectorAll('.item-check:checked');
            const sup1 = document.getElementById('sup_1').value;
            const sup2 = document.getElementById('sup_2').value;
            const sup3 = document.getElementById('sup_3').value;

            // Client-side Validation
            if (checkedBoxes.length === 0) {
                Swal.fire('Oops...', 'Please select items to include in the RFQ.', 'warning');
                return;
            }
            if (sup1 === "" && sup2 === "" && sup3 === "") {
                Swal.fire('Oops...', 'Please select at least one supplier.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Send RFQ Emails?',
                text: "This will send emails and update the status of selected items.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send Emails'
            }).then((result) => {
                if (result.isConfirmed) {

                    // Show Loading Spinner
                    Swal.fire({
                        title: 'Sending Emails...',
                        html: 'Please wait while we process your request.<br><b>Do not close this window.</b>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Trigger PHP Submit
                    document.getElementById('realSubmitBtn').click();
                }
            });
        }
    </script>
</body>

</html>
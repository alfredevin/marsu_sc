<?php
include '../config.php';

// 1. CHECK TOKEN
if (!isset($_GET['t'])) {
    die("<div style='text-align:center; padding:50px; font-family:sans-serif;'><h3>Invalid Access Link.</h3></div>");
}
$token = $_GET['t'];

// 2. VALIDATE TOKEN & FETCH SUPPLIER INFO
// I-join natin ang supplier_tbl para makuha ang Name at Address
$q = mysqli_query($conn, "
    SELECT t.*, s.supplier_name, s.address 
    FROM rfq_tokens_tbl t 
    JOIN supplier_tbl s ON t.supplier_id = s.supplier_id 
    WHERE t.token='$token' AND t.status='Pending'
");

if (mysqli_num_rows($q) == 0) {
    die("<div style='text-align:center; padding:50px; font-family:sans-serif; color: #dc3545;'><h3>Link Expired or Quotation Already Submitted.</h3><p>Please contact the BAC Secretariat if this is an error.</p></div>");
}
$token_data = mysqli_fetch_assoc($q);
$token_id = $token_data['id'];
$supplier_name = $token_data['supplier_name'];
$supplier_address = $token_data['address'];
// 3. HANDLE SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prices = $_POST['price'];
    $ids = $_POST['item_id'];
    
    // Kunin ang mga bagong input
    $tin = mysqli_real_escape_string($conn, $_POST['tin']);
    $philgeps = mysqli_real_escape_string($conn, $_POST['philgeps']);

    // I-save ang mga prices per item
    for ($i = 0; $i < count($ids); $i++) {
        $price = $prices[$i];
        $id = $ids[$i];
        mysqli_query($conn, "UPDATE rfq_items_tbl SET offered_price='$price' WHERE id='$id'");
    }

    // I-update ang token table: Isama ang status, TIN, at PhilGEPS
    $update_token = "UPDATE rfq_tokens_tbl 
                     SET status='Submitted', 
                         tin='$tin', 
                         philgeps_no='$philgeps', 
                         date_sent=NOW() 
                     WHERE id='$token_id'";
    
    mysqli_query($conn, $update_token);

    // Success Screen Redirect...
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Quotation Submitted!',
                text: 'Thank you for your participation.',
                confirmButtonColor: '#800000',
                allowOutsideClick: false
            }).then(() => {
                window.location.href='https://www.mscmarinduque.edu.ph/'; 
            });
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Quotation - MarSU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .header-bg {
            background: linear-gradient(135deg, #800000 0%, #a00000 100%);
            color: white;
            padding: 30px 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            padding: 5px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 900px;
            margin: 40px auto;
            background: white;
        }

        .table thead {
            background-color: #f8f9fa;
            color: #555;
        }

        .price-input {
            border: 2px solid #e9ecef;
            border-radius: 6px;
            font-weight: 600;
            color: #333;
            transition: all 0.3s;
        }

        .price-input:focus {
            border-color: #800000;
            box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
        }

        .total-display {
            font-weight: bold;
            color: #198754;
        }

        .grand-total-box {
            background-color: #fff3cd;
            border: 1px solid #ffecb5;
            padding: 15px;
            border-radius: 8px;
            text-align: right;
            margin-top: 20px;
        }

        .btn-submit {
            background-color: #800000;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn-submit:hover {
            background-color: #600000;
            transform: translateY(-2px);
        }

        /* Custom Styles for Form Content */
        .text-justify {
            text-align: justify;
        }

        .sig-line {
            border-top: 1px solid #000;
            padding-top: 5px;
            display: inline-block;
            width: 250px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card form-card">

            <div class="header-bg">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/Marinduque_State_College_Logo.png/1200px-Marinduque_State_College_Logo.png"
                    class="logo-img" alt="MarSU Logo">
                <h4 class="fw-bold mb-0">MARINDUQUE STATE UNIVERSITY</h4>
                <p class="mb-0 opacity-75">PROCUREMENT UNIT</p>
                <hr style="border-color: rgba(255,255,255,0.3); width: 50%; margin: 15px auto;">
                <h5 class="mb-0 text-uppercase text-decoration-underline">Request for Quotation</h5>
            </div>

            <div class="card-body p-4 p-md-5">

                <form method="POST" id="quotationForm">

                    <div class="row mb-4">
                        <div class="col-md-7">
                            <p class="mb-1 small"><strong>Name of Supplier/Company:</strong>
                                <?= htmlspecialchars($supplier_name) ?></p>
                            <p class="mb-3 small"><strong>Address:</strong> <?= htmlspecialchars($supplier_address) ?>
                            </p>

                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text fw-bold bg-light">TIN:</span>
                                <input type="text" name="tin" class="form-control" placeholder="123-456-789-000"
                                    required>
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text fw-bold bg-light">PhilGEPS Registration No.:</span>
                                <input type="text" name="philgeps" class="form-control" placeholder="(Required)"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-5 text-md-end mt-3 mt-md-0">
                            <p class="mb-1 small"><strong>Date:</strong> <?= date('F d, Y') ?></p>
                            <p class="mb-1 small"><strong>Quotation No:</strong> <span
                                    class="text-primary fw-bold">RFQ-<?= date('Y') ?>-XXX</span></p>
                            <p class="mb-1 small"><strong>PR No:</strong> PR-<?= date('Y') ?>-XXX</p>
                        </div>
                    </div>

                    <p class="text-justify small text-muted mb-4">
                        The MARINDUQUE STATE UNIVERSITY through its Bids and Awards Committee/Procurement Unit invites
                        suppliers/manufacturers/distributors/contractors to apply for eligibility and to bid for the
                        hereunder project/s for CY <?= date('Y') ?> in accordance with Section 53.9 (Small-Value
                        Procurement) of the 2016 Revised Implementing Rules and Regulation of Republic Act 9184.
                    </p>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th width="25%">Description</th>
                                    <th width="10%" class="text-center">Qty</th>
                                    <th width="20%" class="text-center">ABC (Total)</th>
                                    <th width="25%">Unit Price (₱)</th>
                                    <th width="20%" class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Added `e.price` to compute the ABC
                                $items_q = mysqli_query($conn, "
                                SELECT ri.id, ri.quantity, e.equipment_name, e.description, e.price as abc_price
                                FROM rfq_items_tbl ri
                                JOIN equipment_tbl e ON ri.equipment_id = e.equipment_id
                                WHERE ri.token_id = '$token_id'
                                ");

                                while ($row = mysqli_fetch_assoc($items_q)) {
                                    $total_abc = $row['quantity'] * $row['abc_price'];
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-dark d-block"><?= $row['equipment_name'] ?></span>
                                            <small class="text-muted"><?= $row['description'] ?></small>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-secondary rounded-pill px-3"><?= $row['quantity'] ?></span>
                                            <input type="hidden" class="qty-val" value="<?= $row['quantity'] ?>">
                                            <input type="hidden" name="item_id[]" value="<?= $row['id'] ?>">
                                        </td>
                                        <td class="text-center text-muted fw-bold">
                                            ₱<?= number_format($total_abc, 2) ?>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-end-0">₱</span>
                                                <input type="number" step="0.01" min="0" name="price[]"
                                                    class="form-control price-input border-start-0" placeholder="0.00"
                                                    required oninput="calculateRow(this)">
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span class="total-display">₱0.00</span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="grand-total-box">
                        <span class="text-muted text-uppercase small">Total Bid Amount</span>
                        <h2 class="fw-bold text-dark mb-0" id="grandTotal">₱0.00</h2>
                    </div>

                    <div class="mt-4 small text-muted text-justify">
                        <p>Please quote your best offer for the item/s described herein provided. Submit your quotation
                            price on the item/s listed below stating the shortest time of delivery and submit your
                            quotation duly signed by your representative not later than <strong>March 20,
                                <?= date('Y') ?> / 2:00 PM</strong> in a sealed envelope at the Procurement Unit, 2nd
                            Floor, New Administration Building, Marinduque State University, Tanza, Boac, Marinduque.
                            Quotations may also be submitted through the email indicated below.</p>

                        <p>A complete set of eligibility requirements is required to be submitted along with your
                            quotation/proposal. A valid certificate of PhilGEPS Registration (Platinum Membership) may
                            be submitted in lieu of Mayor's/Business Permit.</p>

                        <p>The Omnibus Sworn Statement (GPPB-prescribed forms), Income/Business Tax Return (for ABC's
                            above P50k) will also be required to be submitted prior to award.</p>

                        <p>For inquiries/clarifications, please email us at <u>procurement@mscmarinduque.edu.ph</u> or
                            call the BAC Secretariat at 09542890254.</p>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6 offset-md-6 text-center">
                            <p class="small text-muted mb-5">Approved by:</p>
                            <span class="sig-line">ATTY. CRISPIN FRANCIS M. JANDUSAY</span>
                            <p class="small text-muted mt-1">Chairperson, Bids and Awards Committee</p>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-light border rounded">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" required id="certify"
                                style="transform: scale(1.2);">
                            <label class="form-check-label ms-2 text-dark small fw-bold" for="certify">
                                I hereby certify that the prices quoted above are true and correct, and I have the
                                authority to submit this quotation.
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-submit text-white btn-lg shadow">
                            Submit Official Quotation
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center text-muted small pb-4">
            &copy; <?= date('Y') ?> Marinduque State University Supply & Property Management System
        </div>
    </div>

    <script>
        function calculateRow(input) {
            const row = input.closest('tr');
            const qty = parseFloat(row.querySelector('.qty-val').value) || 0;
            const price = parseFloat(input.value) || 0;
            const total = qty * price;

            row.querySelector('.total-display').innerText = '₱' + total.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.price-input').forEach(input => {
                const row = input.closest('tr');
                const qty = parseFloat(row.querySelector('.qty-val').value) || 0;
                const price = parseFloat(input.value) || 0;
                grandTotal += (qty * price);
            });

            document.getElementById('grandTotal').innerText = '₱' + grandTotal.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>
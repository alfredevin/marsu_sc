<?php
include './../config.php';

// Check if posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['items'])) {
    $selected_items = $_POST['items'];

    // Get Selected Suppliers
    // Filter out empty selections just in case
    $suppliers = array_filter([
        $_POST['supplier_1'],
        $_POST['supplier_2'],
        $_POST['supplier_3']
    ]);
} else {
    echo "No items selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Request for Quotation (RFQ)</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 11pt;
            color: black;
            background: white;
        }

        .page-break {
            page-break-after: always;
        }

        .rfq-container {
            padding: 40px;
            margin: auto;
            max-width: 800px;
        }

        .header-text {
            text-align: center;
            line-height: 1.3;
        }

        .univ-name {
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .rfq-title {
            text-align: center;
            font-weight: bold;
            font-size: 16pt;
            margin: 20px 0;
            text-decoration: underline;
        }

        .table-rfq {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-rfq th,
        .table-rfq td {
            border: 1px solid black;
            padding: 8px;
        }

        .table-rfq th {
            background-color: #eee !important;
            text-align: center;
            font-weight: bold;
        }

        /* Helpers */
        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .row {
            display: flex;
            width: 100%;
        }

        .col-6 {
            width: 50%;
        }

        .col-8 {
            width: 66.66%;
        }

        .col-4 {
            width: 33.33%;
        }

        @media print {
            @page {
                margin: 10mm;
            }

            body {
                padding: 0;
            }

            .rfq-container {
                width: 100%;
                max-width: none;
                padding: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <?php foreach ($suppliers as $supplier_name):
        if (empty($supplier_name)) continue;
    ?>

        <div class="rfq-container">

            <div class="header-text">
                <div>Republic of the Philippines</div>
                <div class="univ-name">Marinduque State University</div>
                <div>Tanza, Boac, Marinduque</div>
                <div class="fw-bold" style="margin-top: 10px;">BIDS AND AWARDS COMMITTEE</div>
            </div>

            <div class="rfq-title">REQUEST FOR QUOTATION</div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-8">
                    <strong>TO: </strong> <span style="text-decoration: underline; font-weight:bold;"><?= $supplier_name ?></span><br>
                    <span style="font-size: 10pt; font-style: italic;">(Name of Supplier)</span>
                </div>
                <div class="col-4 text-end">
                    <strong>Date:</strong> <?= date("F d, Y") ?><br>
                    <strong>RFQ No.:</strong> <?= date("Y") ?>-<?= rand(1000, 9999) ?>
                </div>
            </div>

            <p style="text-align: justify; font-size: 11pt;">
                Gentlemen/Ladies:<br><br>
                Please quote your lowest price on the item/s listed below, subject to the General Conditions, stating the shortest time of delivery and submit your quotation duly signed by your representative not later than <u><?= date("F d, Y", strtotime("+7 days")) ?></u>.
            </p>

            <table class="table-rfq">
                <thead>
                    <tr>
                        <th width="10%">Qty</th>
                        <th width="10%">Unit</th>
                        <th width="40%">Item Description</th>
                        <th width="20%">Unit Price</th>
                        <th width="20%">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through selected items
                    foreach ($selected_items as $equip_id):
                        // 1. Get Quantity from POST
                        $qty = isset($_POST['qty_' . $equip_id]) ? $_POST['qty_' . $equip_id] : 0;

                        // 2. FIXED: Get Item Name from Database (Not from POST)
                        $item_query = mysqli_query($conn, "SELECT equipment_name, unit_id FROM equipment_tbl WHERE equipment_id = '$equip_id'");
                        $item_data = mysqli_fetch_assoc($item_query);
                        $name = $item_data['equipment_name'];

                        // Optional: Get Unit Name (e.g., pcs, box)
                        $u_query = mysqli_query($conn, "SELECT unit_name FROM unit_tbl WHERE unit_id = '{$item_data['unit_id']}'");
                        $u_data = mysqli_fetch_assoc($u_query);
                        $unit_name = $u_data['unit_name'] ?? 'unit';
                    ?>
                        <tr>
                            <td class="text-center"><?= $qty ?></td>
                            <td class="text-center"><?= $unit_name ?></td>
                            <td><?= $name ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="5" style="height: 25px;"></td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 50px;">
                <div class="row">
                    <div class="col-6">
                        <div>Canvassed by:</div>
                        <br><br>
                        <div style="border-top: 1px solid black; width: 80%; padding-top: 5px;">Authorized Canvasser</div>
                    </div>
                    <div class="col-6 text-center">
                        <div>Very truly yours,</div>
                        <br><br>
                        <div style="font-weight: bold; text-decoration: underline;">BAC CHAIRMAN</div>
                        <div>Chairman, Bids and Awards Committee</div>
                    </div>
                </div>
            </div>

            <hr style="border-top: 2px dashed black; margin: 40px 0;">

            <div style="font-size: 10pt;">
                <strong>SUPPLIER'S CERTIFICATION:</strong><br>
                This is to certify that I have personally conducted the canvass and the price/s quoted above are true and correct.
                <br><br><br>
                <div class="row">
                    <div class="col-6">
                        <div style="border-top: 1px solid black; width: 90%; margin-top: 20px; padding-top:5px;">Signature over Printed Name of Supplier</div>
                    </div>
                    <div class="col-6">
                        <div>Contact No: _________________</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="page-break"></div>

    <?php endforeach; ?>

</body>

</html>
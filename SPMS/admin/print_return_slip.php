<?php
include './../config.php';

if (!isset($_GET['iar_id'])) exit("No Inspection Report Selected.");
$iar_id = $_GET['iar_id'];

// Get Report Details
$q_header = mysqli_query($conn, "
    SELECT ir.*, po.po_number, s.supplier_name, s.address
    FROM inspection_report_tbl ir
    JOIN purchase_order_tbl po ON ir.po_id = po.po_id
    JOIN supplier_tbl s ON po.supplier_id = s.supplier_id
    WHERE ir.iar_id = '$iar_id'
");
$header = mysqli_fetch_assoc($q_header);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Return Slip - <?= $header['po_number'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-weight: bold;
            font-size: 16pt;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        .items-table th {
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .sign-box {
            text-align: center;
            width: 45%;
        }

        .line {
            border-top: 1px solid black;
            margin-top: 30px;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <h3>MARINDUQUE STATE UNIVERSITY</h3>
        <p>Supply and Property Management Office</p>
    </div>

    <div class="header">
        <div class="title">RETURN SLIP (DEFECTIVE / WRONG ITEMS)</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>Supplier:</strong></td>
            <td><?= $header['supplier_name'] ?></td>
            <td width="15%"><strong>Date:</strong></td>
            <td><?= date("F d, Y") ?></td>
        </tr>
        <tr>
            <td><strong>Ref PO #:</strong></td>
            <td><?= $header['po_number'] ?></td>
            <td><strong>IAR #:</strong></td>
            <td><?= str_pad($iar_id, 5, '0', STR_PAD_LEFT) ?></td>
        </tr>
    </table>

    <p><strong>Subject:</strong> Return of items due to defects, damage, or non-conformity to specifications.</p>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Rejected Qty</th>
                <th>Reason for Rejection</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Get ONLY rejected items for this specific report
            $q_items = mysqli_query($conn, "
                SELECT ii.*, e.equipment_name 
                FROM inspection_items_tbl ii
                JOIN equipment_tbl e ON ii.equipment_id = e.equipment_id
                WHERE ii.iar_id = '$iar_id' AND ii.rejected_qty > 0
            ");

            while ($item = mysqli_fetch_assoc($q_items)) {
            ?>
                <tr>
                    <td style="text-align: left;"><?= $item['equipment_name'] ?></td>
                    <td style="font-weight: bold;"><?= $item['rejected_qty'] ?></td>
                    <td style="text-align: left;"><?= $item['remarks'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <p>Please facilitate the immediate replacement of the items listed above.</p>

    <div class="footer">
        <div class="sign-box">
            Prepared by:
            <div class="line"></div>
            <strong><?= $header['inspection_officer'] ?></strong><br>
            Inspection Officer
        </div>
        <div class="sign-box">
            Received by Supplier:
            <div class="line"></div>
            Signature over Printed Name / Date
        </div>
    </div>

</body>

</html>
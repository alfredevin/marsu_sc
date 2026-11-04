<?php
include './../config.php';

if (!isset($_GET['id'])) {
    echo "No ID provided.";
    exit;
}
$id = $_GET['id'];

// Get Header Data
$q_head = mysqli_query($conn, "
    SELECT iar.*, po.po_number, po.date_received, po.delivery_receipt_no, s.supplier_name, s.address 
    FROM inspection_report_tbl iar
    JOIN purchase_order_tbl po ON iar.po_id = po.po_id
    JOIN supplier_tbl s ON po.supplier_id = s.supplier_id
    WHERE iar.iar_id = '$id'
");
$head = mysqli_fetch_assoc($q_head);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IAR Report - <?= $head['po_number'] ?></title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 11pt;
            margin: 0;
            padding: 40px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .univ-name {
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .title {
            font-weight: bold;
            font-size: 16pt;
            margin: 30px 0;
            text-align: center;
            border: 1px solid #000;
            padding: 10px;
            background: #eee;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        /* Main Item Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        /* Footer / Signatures */
        .footer-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            border: 1px solid black;
        }

        .sig-box {
            width: 50%;
            padding: 15px;
            box-sizing: border-box;
        }

        .sig-box:first-child {
            border-right: 1px solid black;
        }

        .sign-line {
            margin-top: 50px;
            border-top: 1px solid black;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            padding-top: 5px;
        }

        /* Checkbox Style for Status */
        .checkbox-container {
            display: flex;
            gap: 20px;
            margin-top: 10px;
            font-size: 10pt;
        }

        .box {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid black;
            margin-right: 5px;
        }

        .checked {
            background-color: black;
        }

        /* Simple fill for print */

        @media print {
            @page {
                margin: 10mm;
            }

            body {
                padding: 0;
            }

            .title {
                background: #eee !important;
                -webkit-print-color-adjust: exact;
            }

            .items-table th {
                background: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header">
        <div class="univ-name">Marinduque State University</div>
        <div>Tanza, Boac, Marinduque</div>
        <div style="margin-top: 5px; font-weight: bold;">SUPPLY AND PROPERTY MANAGEMENT OFFICE</div>
    </div>

    <div class="title">INSPECTION AND ACCEPTANCE REPORT</div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>Supplier:</strong></td>
            <td width="45%" style="border-bottom: 1px solid black;"><?= $head['supplier_name'] ?></td>
            <td width="15%" style="padding-left: 20px;"><strong>IAR No.:</strong></td>
            <td width="25%" style="border-bottom: 1px solid black; font-weight: bold;">
                <?= date("Y") ?>-<?= str_pad($head['iar_id'], 4, '0', STR_PAD_LEFT) ?>
            </td>
        </tr>
        <tr>
            <td><strong>Address:</strong></td>
            <td style="border-bottom: 1px solid black;"><?= $head['address'] ?? 'N/A' ?></td>
            <td style="padding-left: 20px;"><strong>Date:</strong></td>
            <td style="border-bottom: 1px solid black;">
                <?= date("F d, Y", strtotime($head['inspection_date'])) ?>
            </td>
        </tr>
        <tr>
            <td><strong>PO No.:</strong></td>
            <td style="border-bottom: 1px solid black;"><?= $head['po_number'] ?></td>
            <td style="padding-left: 20px;"><strong>Invoice No.:</strong></td>
            <td style="border-bottom: 1px solid black;">_________________</td>
        </tr>
        <tr>
            <td><strong>Date Received:</strong></td>
            <td style="border-bottom: 1px solid black;">
                <?= date("F d, Y", strtotime($head['date_received'])) ?>
            </td>
            <td style="padding-left: 20px;"><strong>Requisitioning Office:</strong></td>
            <td style="border-bottom: 1px solid black;">_________________</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th width="10%">Unit</th>
                <th width="40%">Description</th>
                <th width="15%">Accepted Qty</th>
                <th width="15%">Rejected Qty</th>
                <th width="20%">Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $q_items = mysqli_query($conn, "
                SELECT ii.*, e.equipment_name 
                FROM inspection_items_tbl ii
                JOIN equipment_tbl e ON ii.equipment_id = e.equipment_id
                WHERE ii.iar_id = '$id'
            ");

            $has_rejects = false; // Flag for checkbox logic later

            while ($row = mysqli_fetch_assoc($q_items)) {
                if ($row['rejected_qty'] > 0) $has_rejects = true;
            ?>
                <tr>
                    <td>unit</td>
                    <td class="text-left">
                        <strong><?= $row['equipment_name'] ?></strong>
                        <?php if (!empty($row['condition_status']) && $row['rejected_qty'] > 0): ?>
                            <br><span style="font-size: 9pt; font-style:italic;">Issue: <?= $row['condition_status'] ?></span>
                        <?php endif; ?>
                    </td>
                    <td style="font-weight: bold;"><?= $row['accepted_qty'] > 0 ? $row['accepted_qty'] : '-' ?></td>
                    <td style="font-weight: bold; color: <?= $row['rejected_qty'] > 0 ? 'red' : 'black' ?>">
                        <?= $row['rejected_qty'] > 0 ? $row['rejected_qty'] : '-' ?>
                    </td>
                    <td class="text-left" style="font-size: 10pt;">
                        <?= !empty($row['remarks']) ? $row['remarks'] : 'Good Condition' ?>
                    </td>
                </tr>
            <?php } ?>

            <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <td style="height: 25px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <div class="footer-section">

        <div class="sig-box">
            <strong>INSPECTION</strong>
            <br><br>
            <div style="font-size: 10pt;">Date Inspected: <u><?= date("F d, Y", strtotime($head['inspection_date'])) ?></u></div>

            <div class="checkbox-container">
                <div>
                    <span class="box <?= !$has_rejects ? 'checked' : '' ?>"></span> Inspected, verified and found in order as to quantity and specifications.
                </div>
            </div>
            <div class="checkbox-container">
                <div>
                    <span class="box <?= $has_rejects ? 'checked' : '' ?>"></span> Noted damaged/missing items (see remarks).
                </div>
            </div>

            <div class="sign-line">
                <?= $head['inspection_officer'] ?>
            </div>
            <div style="text-align: center; font-size: 10pt;">Inspection Officer / Committee</div>
        </div>

        <div class="sig-box">
            <strong>ACCEPTANCE</strong>
            <br><br>
            <div style="font-size: 10pt;">Date Accepted: ___________________</div>

            <div class="checkbox-container">
                <div><span class="box <?= !$has_rejects ? 'checked' : '' ?>"></span> Complete</div>
                <div style="margin-left: 20px;"><span class="box <?= $has_rejects ? 'checked' : '' ?>"></span> Partial</div>
            </div>

            <div class="sign-line">
                <?= $head['supply_officer'] ?>
            </div>
            <div style="text-align: center; font-size: 10pt;">Supply Officer / Property Custodian</div>
        </div>

    </div>

</body>

</html>
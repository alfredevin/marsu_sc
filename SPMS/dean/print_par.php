<?php
include './../config.php';

// Security Check
if (!isset($_GET['emp_id'])) {
    die("Error: No Employee Selected.");
}
$emp_id = $_GET['emp_id'];

// 1. GET EMPLOYEE & DEPARTMENT DATA
$q_emp = mysqli_query($conn, "
    SELECT e.*, d.department_name, e.position_name 
    FROM employee_tbl e 
    JOIN department_tbl d ON e.department_id = d.department_id 
    WHERE e.employee_id = '$emp_id'
");
$emp = mysqli_fetch_assoc($q_emp);

// 2. GET ACTIVE ITEMS (Serviceable Only)
$q_items = mysqli_query($conn, "
    SELECT 
        ii.property_number, 
        e.equipment_name, e.description,
        inv.unit_cost,
        i.issue_date
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
    WHERE i.issued_to_user_id = '$emp_id' 
    AND (ii.status = 'Serviceable' OR ii.status IS NULL)
    ORDER BY i.issue_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PAR - <?= strtoupper($emp['last_name']) ?></title>
    <style>
        @media print {
            @page {
                margin: 10mm;
                size: landscape;
            }

            /* Landscape fits descriptions better */
            .no-print {
                display: none !important;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }

        body {
            font-family: "Arial", sans-serif;
            font-size: 11pt;
            margin: 40px;
            color: #000;
        }

        /* HEADER */
        .header-title {
            text-align: center;
            font-weight: bold;
            font-size: 16pt;
            margin-bottom: 20px;
        }

        .header-info {
            width: 100%;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* TABLE */
        .par-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .par-table th,
        .par-table td {
            border: 1px solid black;
            padding: 8px 5px;
            vertical-align: middle;
        }

        .par-table th {
            background-color: #e0e0e0;
            text-align: center;
            text-transform: uppercase;
            font-size: 10pt;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        /* FOOTER / SIGNATORIES */
        .footer-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            border: 1px solid black;
            /* Box container for signatures */
            padding: 10px;
        }

        .sign-col {
            width: 48%;
            padding: 10px;
        }

        .sign-line {
            border-bottom: 1px solid black;
            margin-top: 40px;
            margin-bottom: 5px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        .sign-label {
            text-align: center;
            font-size: 10pt;
        }

        /* UTILS */
        .btn-print {
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-print:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <a href="javascript:window.print()" class="btn-print">Print Form</a>
        <a href="javascript:window.close()" style="color: #666; text-decoration: none; margin-left: 15px;">Close Window</a>
    </div>

    <div class="header-title">PROPERTY ACKNOWLEDGMENT RECEIPT</div>

    <table class="header-info" style="border:none;">
        <tr>
            <td width="15%">Entity Name:</td>
            <td width="45%" style="border-bottom: 1px solid black;">Marinduque State University</td>
            <td width="15%" align="right">PAR No.:</td>
            <td width="25%" style="border-bottom: 1px solid black;">
                <?= date("Y") ?>-<?= str_pad($emp['employee_id'], 4, '0', STR_PAD_LEFT) ?>
            </td>
        </tr>
        <tr>
            <td>Fund Cluster:</td>
            <td style="border-bottom: 1px solid black;">General Fund</td>
            <td colspan="2"></td>
        </tr>
    </table>

    <table class="par-table">
        <thead>
            <tr>
                <th width="8%">Qty</th>
                <th width="8%">Unit</th>
                <th width="40%">Description</th>
                <th width="15%">Property No.</th>
                <th width="14%">Date Acquired</th>
                <th width="15%">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            $row_count = 0;

            if (mysqli_num_rows($q_items) > 0) {
                while ($row = mysqli_fetch_assoc($q_items)) {
                    $grand_total += $row['unit_cost'];
                    $row_count++;
            ?>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">unit</td>
                        <td class="text-left">
                            <strong><?= $row['equipment_name'] ?></strong>
                            <?php if (!empty($row['description'])): ?>
                                <br><span style="font-size: 9pt; font-style: italic;"><?= $row['description'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= $row['property_number'] ?></td>
                        <td class="text-center"><?= date("M d, Y", strtotime($row['issue_date'])) ?></td>
                        <td class="text-right">P <?= number_format($row['unit_cost'], 2) ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='text-center' style='padding: 30px;'>No active accountability found.</td></tr>";
            }

            // Fill empty rows to make the form look standard (min 5 rows)
            $min_rows = 5;
            for ($i = $row_count; $i < $min_rows; $i++) {
                echo "<tr>
                    <td style='height: 30px;'></td>
                    <td></td><td></td><td></td><td></td><td></td>
                </tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right" style="padding-right: 15px;"><strong>TOTAL</strong></td>
                <td class="text-right"><strong>P <?= number_format($grand_total, 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer-container">

        <div class="sign-col" style="border-right: 1px solid black;">
            <div>Received by:</div>
            <div class="sign-line">
                <?= strtoupper($emp['first_name'] . ' ' . $emp['last_name']) ?>
            </div>
            <div class="sign-label">
                <?= $emp['position_name'] ?><br>
                <?= $emp['department_name'] ?>
            </div>
            <div style="margin-top: 20px;">Date: ____________________</div>
        </div>

        <div class="sign-col">
            <div>Issued by:</div>

            <div class="sign-line">JUAN DELA CRUZ</div>

            <div class="sign-label">
                Supply Officer / Property Custodian
            </div>
            <div style="margin-top: 20px;">Date: ____________________</div>
        </div>

    </div>

</body>

</html>
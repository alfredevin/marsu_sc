<?php
include './../config.php';

if (!isset($_GET['id']))
    die("Invalid Request");
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch PR Data (Tinanggal ang dn.position_name para iwas error)
$q = mysqli_query($conn, "SELECT p.*, d.department_name, dn.first_name, dn.last_name 
                          FROM ppmp_tbl p 
                          JOIN dean_tbl dn ON p.dean_id = dn.dean_id 
                          JOIN department_tbl d ON dn.department_id = d.department_id 
                          WHERE p.ppmp_id = '$id'");
$data = mysqli_fetch_assoc($q);
$pr_no = "FID-" . date('Y', strtotime($data['date_created'])) . "-" . str_pad($data['ppmp_id'], 3, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Request - <?= $pr_no ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 20px;
            background-color: #525659;
        }

        .paper {
            background: white;
            width: 210mm;
            min-height: 297mm;
            padding: 15mm;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .header {
            text-align: center;
            border: 1px solid black;
            padding: 10px;
            font-weight: bold;
        }

        .header div {
            font-size: 12pt;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }

        .info-table td {
            border: 1px solid black;
            padding: 5px;
            vertical-align: top;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
            min-height: 400px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .main-table th {
            background-color: #f2f2f2;
            font-size: 9pt;
        }

        .main-table td {
            height: 25px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }

        .footer-table td {
            border: 1px solid black;
            padding: 10px;
            width: 50%;
            vertical-align: top;
        }

        .sig-box {
            text-align: center;
            margin-top: 20px;
        }

        .sig-line {
            border-bottom: 1px solid black;
            width: 80%;
            margin: auto;
            font-weight: bold;
            padding-top: 10px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .paper {
                box-shadow: none;
                margin: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="paper">
        <div class="header">
            <div>PURCHASE REQUEST</div>
            <div style="font-size: 10pt; font-weight: normal;">MARINDUQUE STATE UNIVERSITY</div>
            <div style="font-size: 9pt; font-weight: normal;">Agency</div>
        </div>

        <table class="info-table">
            <tr>
                <td width="50%">Department: <strong><?= $data['department_name'] ?></strong><br>Section:
                    <strong><?= $data['department_name'] ?></strong>
                </td>
                <td width="50%">PR No.: <strong><?= $pr_no ?></strong><br>Date:
                    <strong><?= date("M d, Y", strtotime($data['date_created'])) ?></strong>
                </td>
            </tr>
        </table>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="10%">Stock No.</th>
                    <th width="10%">Unit</th>
                    <th width="45%">Item Description</th>
                    <th width="10%">Qty</th>
                    <th width="12%">Unit Cost</th>
                    <th width="13%">Total Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $items = mysqli_query($conn, "SELECT pi.*, e.equipment_name, e.description FROM ppmp_items_tbl pi 
                                              LEFT JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id 
                                              WHERE pi.ppmp_id = '$id'");
                $total_items = 0;
                while ($it = mysqli_fetch_assoc($items)) {
                    $name = $it['equipment_name'] ?: $it['custom_item_name'];
                    $total_items++;
                    ?>
                    <tr>
                        <td></td>
                        <td>pcs</td>
                        <td style="text-align: left;">
                            <strong><?= strtoupper($name) ?></strong><br><small><?= $it['description'] ?></small>
                        </td>
                        <td><?= $it['quantity'] ?></td>
                        <td style="text-align: right;"><?= number_format($it['price'], 2) ?></td>
                        <td style="text-align: right;"><?= number_format($it['total_amount'], 2) ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><br><i>*** NOTHING FOLLOWS ***</i><br><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                // Pad the remaining rows so the table is relatively long
                $padding = 5 - $total_items;
                if ($padding < 0)
                    $padding = 1;
                for ($i = 0; $i < $padding; $i++) {
                    echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr style="font-weight: bold;">
                    <td colspan="5" style="text-align: right;">Total</td>
                    <td style="text-align: right;">₱<?= number_format($data['grand_total'], 2) ?></td>
                </tr>
            </tfoot>
        </table>

        <div style="border: 1px solid black; border-top: none; padding: 10px;">
            Purpose: <strong><?= $data['reason'] ?></strong>
        </div>

        <table class="footer-table">
            <tr>
                <td>Requested by:<br>
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper($data['first_name'] . ' ' . $data['last_name']) ?></div>
                        Department Head
                    </div>
                </td>
                <td>Certified by:<br>
                    <div class="sig-box">
                        <div class="sig-line">MARVIN P. PLATA, MAN, RN, RM</div>
                        VP, Student Academic Affairs & Services
                    </div>
                </td>
            </tr>
            <tr>
                <td>Funds Available:<br>
                    <div class="sig-box">
                        <div class="sig-line">CARMELO JOMEL A. LEAL, MPA</div>
                        Admin Officer V
                    </div>
                </td>
                <td>Approved by:<br>
                    <div class="sig-box">
                        <div class="sig-line">PROF. DIOSDADO P. ZULUETA, DPA</div>
                        University President
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
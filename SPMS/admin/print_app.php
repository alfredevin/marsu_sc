<?php
include './../config.php';
$year = date("Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Annual Procurement Plan (APP) FY <?= $year ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* PRINT STYLING */
        body {
            font-family: "Times New Roman", serif;
            font-size: 10pt;
            background: white;
            padding: 20px;
            color: black;
        }

        .header-container {
            text-align: center;
            position: relative;
            margin-bottom: 20px;
        }

        .republic {
            font-size: 11pt;
        }

        .univ-name {
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .address {
            font-size: 11pt;
        }

        .doc-title {
            font-weight: bold;
            font-size: 16pt;
            margin: 30px 0;
            text-align: center;
        }

        .app-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .app-table th,
        .app-table td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: middle;
        }

        .app-table th {
            background-color: #d1d1d1 !important;
            text-align: center;
            font-weight: bold;
            font-size: 9pt;
            -webkit-print-color-adjust: exact;
        }

        .sig-section {
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .sig-box {
            text-align: center;
        }

        .sig-line {
            border-top: 1px solid black;
            width: 80%;
            margin: 40px auto 5px auto;
        }

        .sig-name {
            font-weight: bold;
            text-transform: uppercase;
        }

        @media print {
            .no-print {
                display: none;
            }

            @page {
                size: A4 landscape;
                margin: 10mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="header-container">
        <div class="republic">Republic of the Philippines</div>
        <div class="univ-name">Marinduque State University</div>
        <div class="address">Tanza, Boac, Marinduque</div>
    </div>

    <div class="doc-title">ANNUAL PROCUREMENT PLAN (APP) FOR FY <?= $year ?></div>

    <table class="app-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="30%">Procurement Project / Item Description</th>
                <th width="15%">PMO / End-User</th>
                <th width="10%">Mode of Procurement</th>
                <th width="10%">Total Qty</th>
                <th width="15%">Est. Unit Price</th>
                <th width="15%">Total Estimated Budget</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // --- UPDATED QUERY ---
            // Ngayon, kukunin lang natin ang mga items na APPROVED (status = 2)
            // Ito yung mga in-approve mo galing sa Pending Tab.
            $query = "
                SELECT 
                    e.equipment_id,
                    e.equipment_name, 
                    e.price,
                    SUM(pi.quantity) as total_qty, 
                    SUM(pi.total_amount) as total_cost
                FROM ppmp_items_tbl pi
                JOIN ppmp_tbl p ON pi.ppmp_id = p.ppmp_id
                JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id
                WHERE p.status = 2  
                GROUP BY pi.equipment_id
                ORDER BY e.equipment_name ASC
            ";
            // Note: WHERE p.status = 2 ang susi dito.

            $result = mysqli_query($conn, $query);
            $ctr = 1;
            $grand_total = 0;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $grand_total += $row['total_cost'];
            ?>
                    <tr>
                        <td class="text-center"><?= $ctr++ ?></td>
                        <td><?= $row['equipment_name'] ?></td>
                        <td class="text-center">Various Colleges</td>
                        <td class="text-center">Small Value / Public Bidding</td>
                        <td class="text-center"><?= $row['total_qty'] ?></td>
                        <td class="text-end">P<?= number_format($row['price'], 2) ?></td>
                        <td class="text-end fw-bold">P<?= number_format($row['total_cost'], 2) ?></td>
                    </tr>
            <?php
                }
                // Optional: Magdagdag ng blank rows kung masyadong maikli ang listahan
                if ($ctr < 5) {
                    for ($i = 0; $i < 3; $i++) {
                        echo "<tr><td style='height:25px'></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='7' class='text-center p-3'>No approved items found in the Master List. Please approve pending PPMPs first.</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-end fw-bold p-2" style="font-size: 12pt;">GRAND TOTAL:</td>
                <td class="text-end fw-bold p-2" style="font-size: 12pt;">P<?= number_format($grand_total, 2) ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="row sig-section">
        <div class="col-4 sig-box">
            <div>Prepared By:</div>
            <div class="sig-line"></div>
            <div class="sig-name">BAC SECRETARIAT</div>
            <div>Head, BAC Secretariat</div>
        </div>

        <div class="col-4 sig-box">
            <div>Certified Funds Available:</div>
            <div class="sig-line"></div>
            <div class="sig-name">BUDGET OFFICER</div>
            <div>University Budget Officer</div>
        </div>

        <div class="col-4 sig-box">
            <div>Approved By:</div>
            <div class="sig-line"></div>
            <div class="sig-name">DIOSDADO P. ZULUETA, DPA</div>
            <div>SUC President III</div>
        </div>
    </div>

    <div class="text-center mt-5 no-print">
        <button onclick="window.close()" class="btn btn-secondary">Close Window</button>
    </div>

</body>

</html>
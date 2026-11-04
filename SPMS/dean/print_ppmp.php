<?php
include './../config.php';

// Check if ID exists
if (isset($_GET['id'])) {
    $ppmp_id = $_GET['id'];

    // Get Data
    $header_query = "
        SELECT p.*, d.first_name, dept.department_name 
        FROM ppmp_tbl p
        JOIN dean_tbl d ON p.dean_id = d.dean_id
        JOIN department_tbl dept ON d.department_id = dept.department_id
        WHERE p.ppmp_id = '$ppmp_id'
    ";
    $header_res = mysqli_query($conn, $header_query);
    $header = mysqli_fetch_assoc($header_res);

    $items_query = "
        SELECT pi.*, e.equipment_name, emp.first_name, emp.last_name 
        FROM ppmp_items_tbl pi
        JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id
        LEFT JOIN employee_tbl emp ON pi.employee_id = emp.employee_id
        WHERE pi.ppmp_id = '$ppmp_id'
    ";
    $items_res = mysqli_query($conn, $items_query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPMP - MarSU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 11pt;
            /* Standard form size */
            background: white;
            padding: 20px;
            color: black;
        }

        /* Header Layout */
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
        }

        .logo-left {
            position: absolute;
            left: 50px;
            top: 0;
            width: 80px;
            /* Adjust size of logo */
        }

        .header-text {
            text-align: center;
            line-height: 1.3;
        }

        .university-name {
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .form-title {
            font-weight: bold;
            font-size: 16pt;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        /* Official Table Styling */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .print-table th,
        .print-table td {
            border: 1px solid black;
            padding: 5px 8px;
            vertical-align: middle;
        }

        .print-table th {
            background-color: #e0e0e0 !important;
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
            -webkit-print-color-adjust: exact;
        }

        .signature-section {
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .sig-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .sig-line {
            border-top: 1px solid black;
            width: 80%;
            margin: 40px auto 5px auto;
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
        <div class="header-text">
            <div>Republic of the Philippines</div>
            <div class="university-name">Marinduque State University</div>
            <div>Tanza, Boac, Marinduque</div>
            <div class="small fw-bold mt-1">OFFICE OF THE DEAN - <?= strtoupper($header['department_name']) ?></div>
        </div>
    </div>

    <hr style="border-top: 2px solid black;">

    <div class="form-title">PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP) <br> FY <?= $header['year'] ?></div>

    <table class="table table-borderless table-sm mb-3">
        <tr>
            <td width="15%"><strong>END-USER/UNIT:</strong></td>
            <td width="45%" style="border-bottom: 1px solid black;"><?= $header['department_name'] ?></td>
            <td width="15%" class="text-end"><strong>Date Prepared:</strong></td>
            <td width="25%" style="border-bottom: 1px solid black;"><?= date("F d, Y", strtotime($header['date_created'])) ?></td>
        </tr>
        <tr>
            <td><strong>Charged to:</strong></td>
            <td style="border-bottom: 1px solid black;">GAA / Fiduciary Fund</td>
            <td class="text-end"><strong>Control No:</strong></td>
            <td style="border-bottom: 1px solid black;">PPMP-<?= $header['year'] ?>-<?= str_pad($header['ppmp_id'], 4, '0', STR_PAD_LEFT) ?></td>
        </tr>
    </table>

    <table class="print-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">General Description / Item / Specification</th>
                <th width="20%">End User</th>
                <th width="10%">Qty / Unit</th>
                <th width="15%">Estimated Unit Price</th>
                <th width="15%">Estimated Total Budget</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            $ctr = 1;
            if (mysqli_num_rows($items_res) > 0) {
                while ($row = mysqli_fetch_assoc($items_res)) {
                    $grand_total += $row['total_amount'];
            ?>
                    <tr>
                        <td class="text-center"><?= $ctr++ ?></td>
                        <td><?= $row['equipment_name'] ?></td>
                        <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                        <td class="text-center"><?= $row['quantity'] ?> units</td>
                        <td class="text-end">P <?= number_format($row['price'], 2) ?></td>
                        <td class="text-end fw-bold">P <?= number_format($row['total_amount'], 2) ?></td>
                    </tr>
            <?php
                }
                // Fill empty rows for neatness (Optional)
                for ($i = 0; $i < 3; $i++) {
                    echo "<tr><td style='height:25px'></td><td></td><td></td><td></td><td></td><td></td></tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center p-3'>No items requested.</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end fw-bold p-2" style="font-size: 12pt;">TOTAL ESTIMATED BUDGET:</td>
                <td class="text-end fw-bold p-2" style="font-size: 12pt;">P <?= number_format($grand_total, 2) ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="signature-section row">
        <div class="col-4 sig-box">
            <div>Prepared By:</div>
            <div class="sig-line"></div>
            <div class="fw-bold text-uppercase"><?= $header['first_name'] ?></div>
            <div class="small">Dean / Head of Unit</div>
        </div>

        <div class="col-4 sig-box">
            <div>Recommending Approval:</div>
            <div class="sig-line"></div>
            <div class="fw-bold text-uppercase">_______________________</div>
            <div class="small">VP for Administration & Finance</div>
        </div>

        <div class="col-4 sig-box">
            <div>Approved By:</div>
            <div class="sig-line"></div>
            <div class="fw-bold text-uppercase">DIOSDADO P. ZULUETA, DPA</div>
            <div class="small">SUC President III</div>
        </div>
    </div>

    <div style="font-size: 8pt; margin-top: 30px; font-style: italic;">
        Note: This is a system-generated report from the MarSU Procurement System.
    </div>

</body>

</html>
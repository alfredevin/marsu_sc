<?php
include '../config.php';

if (!isset($_GET['ids'])) {
    die("<div style='text-align:center; padding: 50px; font-family: Arial;'><h3>No Issuance ID provided.</h3><a href='admin_issuance_list.php'>Go Back</a></div>");
}
$ids = explode(',', $_GET['ids']);

// Loop through each ID in case of bulk issuance
foreach ($ids as $issue_id) {
    $issue_id = mysqli_real_escape_string($conn, $issue_id);

    // Get Issuance Header
    $q_head = mysqli_query($conn, "SELECT i.*, e.first_name, e.last_name, dept.department_name, e.position_name 
                                   FROM issuance_tbl i 
                                   JOIN employee_tbl e ON i.issued_to_user_id = e.employee_id 
                                   JOIN department_tbl dept ON e.department_id = dept.department_id 
                                   WHERE i.issuance_id = '$issue_id'");
    $head = mysqli_fetch_assoc($q_head);
    $type_label = ($head['type'] == 'PAR') ? 'PROPERTY ACKNOWLEDGEMENT RECEIPT' : 'INVENTORY CUSTODIAN SLIP';
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Print <?= $head['type'] ?> - <?= $head['tracking_no'] ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <style>
            body {
                background: #525659;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }

            /* Floating Toolbar (Interactive & User Friendly) */
            .no-print-toolbar {
                background: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                max-width: 210mm;
                margin: 0 auto 20px auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .paper {
                background: white;
                width: 210mm;
                min-height: 297mm;
                /* A4 Size */
                margin: 0 auto 20px auto;
                padding: 10mm;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                box-sizing: border-box;
                position: relative;
            }

            /* Strict Boxed Layout based on Image */
            .doc-wrapper {
                border: 2px solid #000;
                width: 100%;
                height: 275mm;
                box-sizing: border-box;
                position: relative;
            }

            /* Header Area */
            .doc-header {
                text-align: center;
                border-bottom: 2px solid #000;
                padding: 15px 10px;
                position: relative;
            }

            .doc-header h2 {
                margin: 0;
                font-size: 14pt;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .doc-header h3 {
                margin: 5px 0 2px 0;
                font-size: 11pt;
                font-weight: normal;
            }

            .doc-header p {
                margin: 0;
                font-size: 9pt;
            }

            /* Information Table */
            .info-table {
                width: 100%;
                border-collapse: collapse;
                border-bottom: 2px solid #000;
            }

            .info-table td {
                border-right: 1px solid #000;
                border-bottom: 1px solid #000;
                padding: 6px 10px;
                font-size: 9.5pt;
                vertical-align: top;
            }

            .info-table td:last-child {
                border-right: none;
            }

            .info-table tr:last-child td {
                border-bottom: none;
            }

            /* Main Items Table */
            .main-table {
                width: 100%;
                border-collapse: collapse;
            }

            .main-table th {
                border-bottom: 1px solid #000;
                border-right: 1px solid #000;
                padding: 8px;
                font-size: 9pt;
                font-weight: normal;
                text-align: center;
            }

            .main-table th:last-child {
                border-right: none;
            }

            .main-table td {
                border-right: 1px solid #000;
                padding: 8px 10px;
                vertical-align: top;
                font-size: 9.5pt;
                height: 25px;
                /* Minimum height for rows */
            }

            .main-table td:last-child {
                border-right: none;
            }

            /* Signatures Section */
            .sig-table {
                width: 100%;
                border-collapse: collapse;
                border-top: 2px solid #000;
                position: absolute;
                bottom: 0;
                left: 0;
            }

            .sig-table td {
                border-right: 1px solid #000;
                padding: 10px 15px;
                width: 50%;
                vertical-align: top;
                font-size: 9pt;
            }

            .sig-table td:last-child {
                border-right: none;
            }

            .sig-label {
                margin-bottom: 25px;
            }

            .sig-box {
                text-align: center;
            }

            .sig-line {
                border-bottom: 1px solid #000;
                width: 80%;
                margin: 0 auto 3px auto;
                font-weight: bold;
                font-size: 10pt;
                text-transform: uppercase;
            }

            /* Print Settings */
            @media print {
                body {
                    background: white;
                    padding: 0;
                }

                .no-print-toolbar {
                    display: none;
                }

                .paper {
                    margin: 0;
                    box-shadow: none;
                    border: none;
                    width: 100%;
                    padding: 0;
                    page-break-after: always;
                }
            }
        </style>
    </head>

    <body>
        <div class="no-print-toolbar">
            <div>
                <h5 class="mb-0 text-dark fw-bold"><i class="bi bi-file-earmark-text text-primary"></i> Issuance Document
                </h5>
                <small class="text-muted">Click print when ready or go back to the list.</small>
            </div>
            <div>
                <button class="btn btn-outline-secondary me-2 fw-bold"
                    onclick="window.location.href='admin_issuance_list.php'">
                    <i class="bi bi-arrow-left"></i> Go Back
                </button>
                <button class="btn btn-primary fw-bold px-4 shadow-sm" onclick="window.print()">
                    <i class="bi bi-printer-fill"></i> Print Form
                </button>
            </div>
        </div>

        <div class="paper">
            <div class="doc-wrapper">

                <div class="doc-header">
                    <h2><?= $type_label ?></h2>
                    <h3>MARINDUQUE STATE UNIVERSITY</h3>
                    <p>Agency</p>
                </div>

                <table class="info-table">
                    <tr>
                        <td width="60%">Entity Name: <strong>Marinduque State University</strong></td>
                        <td width="40%">Fund Cluster: <strong>01</strong></td>
                    </tr>
                    <tr>
                        <td>Issued to / Received by:
                            <strong><?= strtoupper($head['first_name'] . ' ' . $head['last_name']) ?></strong></td>
                        <td>PAR/ICS No.: <strong
                                style="font-family: monospace; font-size: 11pt;"><?= $head['tracking_no'] ?></strong></td>
                    </tr>
                </table>

                <table class="main-table">
                    <thead>
                        <tr>
                            <th width="10%">Qty</th>
                            <th width="10%">Unit</th>
                            <th width="45%">Item Description</th>
                            <th width="20%">Property No.</th>
                            <th width="15%">Unit Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $items_q = mysqli_query($conn, "SELECT ii.*, e.equipment_name, e.price, e.description 
                                                    FROM issuance_items_tbl ii 
                                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id 
                                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id 
                                                    WHERE ii.issuance_id = '$issue_id'");
                        $count = 0;
                        while ($item = mysqli_fetch_assoc($items_q)) {
                            $count++;
                            ?>
                            <tr>
                                <td align="center"><?= $item['quantity'] ?></td>
                                <td align="center">pcs</td>
                                <td>
                                    <strong><?= strtoupper($item['equipment_name']) ?></strong><br>
                                    <div style="font-size: 8pt; color: #333; margin-top: 3px;"><?= $item['description'] ?></div>
                                </td>
                                <td align="center" style="font-family: monospace; font-weight: bold;">
                                    <?= $item['property_number'] ?></td>
                                <td align="right"><?= number_format($item['price'], 2) ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td align="center" style="padding-top: 20px; font-style: italic;">- NOTHING FOLLOWS -</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <?php for ($i = $count; $i < 15; $i++)
                            echo "<tr><td></td><td></td><td></td><td></td><td></td></tr>"; ?>
                    </tbody>
                </table>

                <table class="sig-table">
                    <tr>
                        <td>
                            <div class="sig-label">Received by:</div>
                            <div class="sig-box">
                                <div class="sig-line"><?= strtoupper($head['first_name'] . ' ' . $head['last_name']) ?>
                                </div>
                                <div>Signature over Printed Name</div>
                                <div style="margin-top: 5px;"><?= $head['position_name'] ?: 'End-User' ?></div>
                                <div style="font-style: italic; margin-top: 3px; font-size: 8pt;">Designation</div>
                            </div>
                        </td>
                        <td>
                            <div class="sig-label">Issued by:</div>
                            <div class="sig-box">
                                <div class="sig-line">CARMELO JOMEL A. LEAL, MPA</div>
                                <div>Signature over Printed Name</div>
                                <div style="margin-top: 5px;">Admin. Officer V</div>
                                <div style="font-style: italic; margin-top: 3px; font-size: 8pt;">Designation</div>
                            </div>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    <?php } // End Foreach loop ?>

    <script>
        window.onload = function () {
            setTimeout(() => {
                window.print();
            }, 500);
        };
    </script>
</body>

</html>
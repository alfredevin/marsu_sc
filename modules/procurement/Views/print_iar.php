<?php
// Standalone Official Inspection and Acceptance Report (IAR) Print View
$iarNo = $iar['iar_number'] ?? ('IAR-' . date('Y') . '-001');
$poNo = $iar['po_number'] ?? ('PO-' . date('Y-m') . '-001');
$supplier = $iar['company_name'] ?? 'Accredited Supplier';
$invoiceNo = $iar['invoice_number'] ?? 'DR-Pending';
$insDate = $iar['inspection_date'] ?? date('Y-m-d');
$insOfficer = $iar['inspection_officer'] ?? 'Engr. Kenneth P. Lim (Inspection Chair)';
$supOfficer = $iar['supply_officer'] ?? 'Maria Luisa D. Cruz (Supply Officer III)';
$status = $iar['inspection_status'] ?? 'Inspected & Accepted';
$remarks = $iar['remarks'] ?? 'Compliant with technical specifications.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAR - <?= e($iarNo) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @page {
            size: A4 portrait;
            margin: 8mm 12mm;
        }
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9.5pt;
            color: #000;
            margin: 0;
            padding: 20px;
            background: #525659;
        }
        .no-print-toolbar {
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.25);
            max-width: 210mm;
            margin: 0 auto 16px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-print {
            background: #800020;
            color: #ffffff;
            border: none;
            padding: 8px 18px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-close-win {
            background: #e2e8f0;
            color: #1e293b;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            margin-left: 8px;
        }
        .paper {
            background: #ffffff;
            width: 210mm;
            min-height: 285mm;
            margin: 0 auto;
            padding: 12mm 15mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }
        .header .agency-name {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header .form-title {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 4px;
            color: #800020;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: -1px;
        }
        .info-table td {
            border: 1px solid #000;
            padding: 5px 8px;
            font-size: 9pt;
            vertical-align: top;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }
        .main-table th {
            border: 1px solid #000;
            background: #f1f5f9;
            padding: 6px 4px;
            font-size: 8.5pt;
            text-transform: uppercase;
            text-align: center;
        }
        .main-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 9pt;
            vertical-align: top;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }
        .footer-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 8.5pt;
            vertical-align: top;
            width: 50%;
        }
        .sig-box {
            text-align: center;
            margin-top: 24px;
        }
        .sig-line {
            border-bottom: 1px solid #000;
            width: 85%;
            margin: 0 auto 3px auto;
            font-weight: bold;
            text-transform: uppercase;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print-toolbar {
                display: none !important;
            }
            .paper {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 10mm 12mm !important;
            }
        }
    </style>
</head>
<body>

    <div class="no-print-toolbar">
        <div>
            <strong style="color:#800020;">Official Inspection &amp; Acceptance Report (IAR)</strong>
            <span style="color:#64748b; font-size:12px; margin-left:8px;">(Appendix 62 - Government Accounting Manual)</span>
        </div>
        <div>
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer-fill" style="margin-right:5px;"></i>Print Document
            </button>
            <button class="btn-close-win" onclick="window.close()">Close</button>
        </div>
    </div>

    <div class="paper">
        <div class="header">
            <div class="agency-name">MARINDUQUE STATE UNIVERSITY</div>
            <div style="font-size:9pt; color:#333;">Panambo, Boac, Marinduque, Philippines</div>
            <div class="form-title">INSPECTION AND ACCEPTANCE REPORT (IAR)</div>
        </div>

        <table class="info-table">
            <tr>
                <td width="60%">
                    Supplier: <strong><?= e($supplier) ?></strong><br>
                    PO No. / Date: <strong><?= e($poNo) ?></strong><br>
                    Invoice / DR No.: <strong><?= e($invoiceNo) ?></strong>
                </td>
                <td width="40%">
                    IAR No.: <strong><?= e($iarNo) ?></strong><br>
                    Inspection Date: <strong><?= date("F d, Y", strtotime($insDate)) ?></strong><br>
                    Status: <strong><?= e($status) ?></strong>
                </td>
            </tr>
        </table>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="8%">Item #</th>
                    <th width="10%">Unit</th>
                    <th width="50%">Description</th>
                    <th width="16%">Accepted Qty</th>
                    <th width="16%">Rejected Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php $idx = 1; foreach ($items as $it): ?>
                        <tr>
                            <td class="text-center"><?= $idx++ ?></td>
                            <td class="text-center">unit</td>
                            <td>
                                <strong><?= e($it['item_description']) ?></strong><br>
                                <small class="text-muted"><?= e($it['remarks'] ?? 'Inspected compliant') ?></small>
                            </td>
                            <td class="text-center fw-bold text-success"><?= (int)$it['accepted_qty'] ?></td>
                            <td class="text-center fw-bold text-danger"><?= (int)$it['rejected_qty'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">lot</td>
                        <td><strong>Institutional Equipment and Goods Delivery</strong></td>
                        <td class="text-center fw-bold text-success">1</td>
                        <td class="text-center fw-bold text-danger">0</td>
                    </tr>
                <?php endif; ?>

                <tr>
                    <td class="text-center text-muted">—</td>
                    <td class="text-center text-muted">—</td>
                    <td class="text-center" style="padding: 16px 0; font-style: italic; color: #555;">
                        *** NOTHING FOLLOWS ***
                    </td>
                    <td class="text-center text-muted">—</td>
                    <td class="text-center text-muted">—</td>
                </tr>

                <?php for ($i = 0; $i < 4; $i++): ?>
                    <tr style="height: 22px;"><td></td><td></td><td></td><td></td><td></td></tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div style="border: 1px solid #000; border-top: none; padding: 8px 10px; font-size: 8.5pt;">
            Observations &amp; Technical Verification: <strong><?= e($remarks) ?></strong>
        </div>

        <table class="footer-table">
            <tr>
                <td>
                    <strong>INSPECTION:</strong><br>
                    <small>Date Inspected: <?= date("M d, Y", strtotime($insDate)) ?></small><br>
                    <small>Inspected, verified and found in order as to quantity and specifications.</small>
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($insOfficer)) ?></div>
                        <div style="font-size:8pt;">Inspection Committee Chairperson</div>
                    </div>
                </td>
                <td>
                    <strong>ACCEPTANCE:</strong><br>
                    <small>Date Received: <?= date("M d, Y", strtotime($insDate)) ?></small><br>
                    <small>Complete delivery received and recorded in inventory ledger.</small>
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($supOfficer)) ?></div>
                        <div style="font-size:8pt;">Supply and Property Officer III</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>


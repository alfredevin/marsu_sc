<?php
// Standalone Official Return to Supplier Slip (MarSU PMIS / SPMS)
$poNo = $item['po_number'] ?? 'PO-2026-001';
$iarNo = $item['iar_number'] ?? 'IAR-2026-001';
$supplier = $item['company_name'] ?? 'Accredited Supplier';
$address = $item['supplier_address'] ?? 'Marinduque Commercial Hub';
$phone = $item['contact_phone'] ?? '—';
$desc = $item['item_description'] ?? 'Equipment item';
$qty = (int)($item['rejected_qty'] ?? 1);
$remarks = $item['remarks'] ?? 'Defective on delivery / Failed technical specifications';
$date = date('F d, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Return Slip - <?= e($poNo) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm 14mm;
        }
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
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
            padding: 14mm 16mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }
        .univ-name {
            font-weight: bold;
            font-size: 13pt;
            text-transform: uppercase;
            color: #800020;
        }
        .agency-sub {
            font-size: 9pt;
        }
        .doc-title {
            font-weight: bold;
            font-size: 14pt;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .info-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            font-size: 9.5pt;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .main-table th, .main-table td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 9.5pt;
        }
        .main-table th {
            background: #f1f5f9;
            text-align: center;
            text-transform: uppercase;
        }
        .sig-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .sig-box {
            text-align: center;
            width: 45%;
        }
        .sig-line {
            border-bottom: 1px solid #000;
            width: 85%;
            margin: 36px auto 4px auto;
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
            <strong style="color:#800020;">Official Return to Supplier Slip</strong>
            <span style="color:#64748b; font-size:12px; margin-left:8px;">(Defective or Discrepant Delivery Notice)</span>
        </div>
        <div>
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer-fill" style="margin-right:5px;"></i>Print Return Slip
            </button>
            <button class="btn-close-win" onclick="window.close()">Close</button>
        </div>
    </div>

    <div class="paper">
        <div class="header">
            <div class="univ-name">MARINDUQUE STATE UNIVERSITY</div>
            <div class="agency-sub">Supply and Property Management Unit / Inspection Committee</div>
            <div class="agency-sub">Panambo, Boac, Marinduque 4900</div>
            <div class="doc-title">NOTICE OF REJECTION &amp; RETURN SLIP</div>
        </div>

        <table class="info-table">
            <tr>
                <td width="55%">
                    To Supplier: <strong><?= e($supplier) ?></strong><br>
                    Address: <?= e($address) ?><br>
                    Contact: <?= e($phone) ?>
                </td>
                <td width="45%">
                    Date Issued: <strong><?= $date ?></strong><br>
                    PO Reference: <strong><?= e($poNo) ?></strong><br>
                    IAR Reference: <strong><?= e($iarNo) ?></strong>
                </td>
            </tr>
        </table>

        <p style="margin: 14px 0 8px 0; font-size: 9.5pt;">
            Please be formally advised that upon technical inspection and verification by the MarSU Inspection and Acceptance Committee, the following delivered items were found defective, non-compliant, or sub-standard and are hereby rejected for replacement:
        </p>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="8%">#</th>
                    <th width="44%">Item Description</th>
                    <th width="12%">Qty Returned</th>
                    <th width="36%">Reason for Rejection / Inspection Findings</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td><strong><?= e($desc) ?></strong></td>
                    <td style="text-align: center; font-weight: bold; color: #dc2626;"><?= $qty ?> unit(s)</td>
                    <td><?= e($remarks) ?></td>
                </tr>
                <?php for ($r = 0; $r < 4; $r++): ?>
                    <tr style="height: 24px;"><td></td><td></td><td></td><td></td></tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div style="margin-top: 18px; padding: 10px; border: 1px dashed #475569; font-size: 9pt; background: #f8fafc;">
            <strong>Immediate Action Required:</strong> In accordance with Republic Act No. 9184 and government procurement guidelines, the supplier is requested to replace the rejected items with conforming brand-new units within <strong>seven (7) calendar days</strong> from receipt of this notice.
        </div>

        <div class="sig-section">
            <div class="sig-box">
                <div>Inspected &amp; Returned by:</div>
                <div class="sig-line">ENGR. ROBERTO GOMEZ</div>
                <div>Chairman, Inspection &amp; Acceptance Committee</div>
            </div>

            <div class="sig-box">
                <div>Conforme / Received by:</div>
                <div class="sig-line">&nbsp;</div>
                <div>Authorized Supplier Representative / Date</div>
            </div>
        </div>
    </div>

</body>
</html>


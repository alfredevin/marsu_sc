<?php
// Standalone Official Purchase Order Print View (MarSU PMIS / SPMS)
$poNo = $order['po_number'] ?? ('PO-' . date('Y-m') . '-001');
$supplierName = $order['company_name'] ?? 'Accredited University Supplier';
$address = $order['address'] ?? 'Boac Commercial Complex, Boac, Marinduque';
$poDate = $order['po_date'] ?? date('Y-m-d');
$mode = $order['mode_of_procurement'] ?? 'Small Value Procurement (Sec. 53.9)';
$deliveryTerm = $order['delivery_term'] ?? '15 Calendar Days upon receipt of Notice to Proceed';
$paymentTerm = $order['payment_term'] ?? 'Government Terms (Check / LDDAP-ADA)';
$totalAmount = (float)($order['total_amount'] ?? 0.00);
$tin = $order['tin_number'] ?? '204-889-112-000';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order - <?= e($poNo) ?></title>
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
            padding: 10mm 14mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            margin-bottom: 8px;
        }
        .header .agency-name {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header .agency-sub {
            font-size: 8.5pt;
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
            padding: 4px 8px;
            font-size: 8.5pt;
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
            padding: 5px 4px;
            font-size: 8.5pt;
            text-transform: uppercase;
            text-align: center;
        }
        .main-table td {
            border: 1px solid #000;
            padding: 5px 8px;
            font-size: 8.5pt;
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
                padding: 8mm 10mm !important;
            }
        }
    </style>
</head>
<body>

    <div class="no-print-toolbar">
        <div>
            <strong style="color:#800020;">Official Purchase Order Document</strong>
            <span style="color:#64748b; font-size:12px; margin-left:8px;">(Government Procurement Standard)</span>
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
            <div class="agency-sub">Panambo, Boac, Marinduque, Philippines 4900</div>
            <div class="agency-sub">Supply & Property Management Office</div>
            <div class="form-title">PURCHASE ORDER</div>
        </div>

        <table class="info-table">
            <tr>
                <td width="55%">
                    Supplier: <strong><?= e($supplierName) ?></strong><br>
                    Address: <?= e($address) ?><br>
                    TIN: <?= e($tin) ?>
                </td>
                <td width="45%">
                    PO No.: <strong><?= e($poNo) ?></strong><br>
                    Date: <strong><?= date("F d, Y", strtotime($poDate)) ?></strong><br>
                    Mode of Procurement: <strong><?= e($mode) ?></strong>
                </td>
            </tr>
            <tr>
                <td>
                    Place of Delivery: <strong>MarSU Central Supply Warehouse, Boac</strong><br>
                    Date of Delivery: <strong>Within <?= e($deliveryTerm) ?></strong>
                </td>
                <td>
                    Delivery Term: <strong><?= e($deliveryTerm) ?></strong><br>
                    Payment Term: <strong><?= e($paymentTerm) ?></strong>
                </td>
            </tr>
        </table>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="8%">Item #</th>
                    <th width="10%">Unit</th>
                    <th width="48%">Description</th>
                    <th width="8%">Qty</th>
                    <th width="12%">Unit Cost</th>
                    <th width="14%">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">lot</td>
                    <td>
                        <strong>Contract Delivery for University Supplies & Equipment</strong><br>
                        <small class="text-muted">In accordance with approved PR specifications and purchase contract.</small>
                    </td>
                    <td class="text-center">1</td>
                    <td class="text-end">&#8369;<?= number_format($totalAmount, 2) ?></td>
                    <td class="text-end fw-bold">&#8369;<?= number_format($totalAmount, 2) ?></td>
                </tr>
                <tr>
                    <td class="text-center text-muted">—</td>
                    <td class="text-center text-muted">—</td>
                    <td class="text-center" style="padding: 14px 0; font-style: italic; color: #555;">
                        *** NOTHING FOLLOWS ***
                    </td>
                    <td class="text-center text-muted">—</td>
                    <td class="text-end text-muted">—</td>
                    <td class="text-end text-muted">—</td>
                </tr>
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <tr style="height: 22px;"><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                <?php endfor; ?>
                <tr style="font-weight: bold; background: #fafafa;">
                    <td colspan="5" class="text-end" style="padding: 8px;">TOTAL CONTRACT AMOUNT:</td>
                    <td class="text-end" style="padding: 8px; font-size: 10pt; color: #800020;">
                        &#8369;<?= number_format($totalAmount, 2) ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="border: 1px solid #000; border-top: none; padding: 6px 8px; font-size: 8pt; line-height: 1.3;">
            In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day of delay shall be imposed on the undelivered item/s.
        </div>

        <table class="footer-table">
            <tr>
                <td>
                    Conforme:
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($supplierName)) ?></div>
                        <div class="sig-title">Signature over Printed Name of Supplier / Date</div>
                    </div>
                </td>
                <td>
                    Very truly yours,
                    <div class="sig-box">
                        <div class="sig-line">DR. DIOSDADO P. ZULUETA</div>
                        <div class="sig-title">University President</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Funds Available:
                    <div class="sig-box">
                        <div class="sig-line">CARMELO JOMEL A. LEAL, MPA</div>
                        <div class="sig-title">Administrative Officer V</div>
                    </div>
                </td>
                <td>
                    ALOBS No.: <strong>02-101101-2026-<?= rand(10,99) ?></strong><br>
                    Amount: <strong>&#8369;<?= number_format($totalAmount, 2) ?></strong>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>


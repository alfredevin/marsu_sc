<?php
// Standalone Official Annual Procurement Plan (APP) Print View (MarSU PMIS / SPMS)
$currentYear = $year ?? date('Y');
$grandTotal = 0.00;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annual Procurement Plan (APP) FY <?= e((string)$currentYear) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @page {
            size: A4 landscape;
            margin: 8mm 10mm;
        }
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body {
            font-family: Arial, "Times New Roman", serif;
            font-size: 9pt;
            color: #000;
            margin: 0;
            padding: 16px;
            background: #525659;
        }
        .no-print-toolbar {
            background: #ffffff;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.25);
            max-width: 285mm;
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
        .btn-print:hover {
            background: #600018;
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
            width: 285mm;
            min-height: 195mm;
            margin: 0 auto;
            padding: 10mm 12mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            margin-bottom: 12px;
        }
        .republic {
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .univ-name {
            font-weight: bold;
            font-size: 14pt;
            text-transform: uppercase;
            color: #800020;
            margin: 2px 0;
        }
        .address {
            font-size: 8.5pt;
            color: #333;
        }
        .doc-title {
            font-weight: bold;
            font-size: 13pt;
            margin-top: 10px;
            text-align: center;
            text-transform: uppercase;
            border-top: 2px solid #800020;
            border-bottom: 1px solid #000;
            padding: 6px 0;
        }
        .app-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .app-table th,
        .app-table td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: middle;
            font-size: 8.5pt;
        }
        .app-table th {
            background-color: #f1f5f9;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .sig-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .sig-box {
            text-align: center;
            width: 30%;
        }
        .sig-line {
            border-bottom: 1px solid #000;
            width: 80%;
            margin: 32px auto 4px auto;
            font-weight: bold;
            text-transform: uppercase;
        }
        .sig-name {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
        }
        .sig-title {
            font-size: 8pt;
            color: #444;
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
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 5mm 8mm !important;
            }
        }
    </style>
</head>
<body>

    <div class="no-print-toolbar">
        <div>
            <strong style="color:#800020;">Official Annual Procurement Plan (APP)</strong>
            <span style="color:#64748b; font-size:12px; margin-left:8px;">(A4 Landscape Consolidated Masterplan)</span>
        </div>
        <div>
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer-fill" style="margin-right:5px;"></i>Print APP Masterplan
            </button>
            <button class="btn-close-win" onclick="window.close()">Close</button>
        </div>
    </div>

    <div class="paper">
        <div class="header">
            <div class="republic">Republic of the Philippines</div>
            <div class="univ-name">Marinduque State University</div>
            <div class="address">Panambo, Boac, Marinduque, Philippines 4900</div>
            <div class="doc-title">ANNUAL PROCUREMENT PLAN (APP) FOR FISCAL YEAR <?= e((string)$currentYear) ?></div>
        </div>

        <table class="app-table">
            <thead>
                <tr>
                    <th width="4%">No.</th>
                    <th width="32%">Procurement Project / Item Description</th>
                    <th width="18%">End-User / PMO</th>
                    <th width="14%">Mode of Procurement</th>
                    <th width="8%">Total Qty</th>
                    <th width="11%">Est. Unit Cost</th>
                    <th width="13%">Total Estimated Budget</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php $ctr = 1; foreach ($items as $row): 
                        $grandTotal += (float)$row['total_cost'];
                    ?>
                        <tr>
                            <td class="text-center"><?= $ctr++ ?></td>
                            <td><strong><?= e($row['item_name']) ?></strong></td>
                            <td class="text-center"><?= e($row['department_name'] ?? 'Various Academic Colleges') ?></td>
                            <td class="text-center">Small Value / Public Bidding</td>
                            <td class="text-center fw-bold"><?= (int)$row['total_qty'] ?></td>
                            <td class="text-end">&#8369;<?= number_format((float)$row['price'], 2) ?></td>
                            <td class="text-end fw-bold">&#8369;<?= number_format((float)$row['total_cost'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            No approved procurement plan items found for FY <?= e((string)$currentYear) ?>.
                        </td>
                    </tr>
                <?php endif; ?>

                <?php 
                $pad = 6 - count($items ?? []);
                for ($p = 0; $p < max(2, $pad); $p++): ?>
                    <tr style="height: 20px;">
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
            <tfoot>
                <tr style="font-weight: bold; background: #fafafa;">
                    <td colspan="6" class="text-end" style="font-size: 10pt; padding: 7px 10px;">GRAND TOTAL ESTIMATED BUDGET:</td>
                    <td class="text-end" style="font-size: 10pt; color: #800020; padding: 7px 10px;">
                        &#8369;<?= number_format($grandTotal, 2) ?>
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="sig-section">
            <div class="sig-box">
                <div>Prepared by:</div>
                <div class="sig-line">BAC SECRETARIAT</div>
                <div class="sig-title">Head, BAC Secretariat &amp; Procurement Unit</div>
            </div>

            <div class="sig-box">
                <div>Certified Funds Available:</div>
                <div class="sig-line">CARMELO JOMEL A. LEAL, MPA</div>
                <div class="sig-title">Administrative Officer V / Budget Officer</div>
            </div>

            <div class="sig-box">
                <div>Approved by:</div>
                <div class="sig-line">PROF. DIOSDADO P. ZULUETA, DPA</div>
                <div class="sig-title">University President / HOPE</div>
            </div>
        </div>
    </div>

</body>
</html>


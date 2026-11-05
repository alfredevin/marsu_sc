<?php
// Standalone Official Purchase Request Print View (MarSU PMIS / SPMS)
$prNo = $pr['pr_number'] ?? ('PR-' . date('Y-m') . '-001');
$dept = $pr['requesting_office'] ?? 'College of Information & Computing Sciences';
$dateCreated = $pr['created_at'] ?? date('Y-m-d');
$fundSource = $pr['fund_source'] ?? 'General Fund (GAA)';
$purpose = $pr['purpose'] ?? 'Official departmental procurement';
$requestedBy = $pr['requested_by'] ?? 'Department Head';
$totalAmount = (float)($pr['estimated_total'] ?? 0.00);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request - <?= e($prNo) ?></title>
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
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .header .agency-name {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header .agency-sub {
            font-size: 9pt;
            color: #222;
        }
        .header .form-title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 6px;
            letter-spacing: 1px;
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
            font-size: 9pt;
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
            margin-top: 28px;
        }
        .sig-line {
            border-bottom: 1px solid #000;
            width: 85%;
            margin: 0 auto 4px auto;
            font-weight: bold;
            text-transform: uppercase;
        }
        .sig-title {
            font-size: 8pt;
            color: #333;
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

    <!-- Floating Action Toolbar -->
    <div class="no-print-toolbar">
        <div>
            <strong style="color:#800020;">Official Purchase Request Document</strong>
            <span style="color:#64748b; font-size:12px; margin-left:8px;">(Ready for printing or PDF export)</span>
        </div>
        <div>
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer-fill" style="margin-right:5px;"></i>Print Document
            </button>
            <button class="btn-close-win" onclick="window.close()">Close</button>
        </div>
    </div>

    <!-- Printable Paper Area -->
    <div class="paper">
        <!-- Header -->
        <div class="header">
            <div class="agency-name">MARINDUQUE STATE UNIVERSITY</div>
            <div class="agency-sub">Panambo, Boac, Marinduque, Philippines 4900</div>
            <div class="agency-sub">Supply and Property Management Office / Procurement Unit</div>
            <div class="form-title">PURCHASE REQUEST</div>
        </div>

        <!-- Info Block -->
        <table class="info-table">
            <tr>
                <td width="55%">
                    Department / College: <strong><?= e($dept) ?></strong><br>
                    Section / Unit: <strong>Academic Instruction & Laboratory</strong>
                </td>
                <td width="45%">
                    PR No.: <strong><?= e($prNo) ?></strong><br>
                    Date: <strong><?= date("F d, Y", strtotime($dateCreated)) ?></strong><br>
                    Fund Source: <strong><?= e($fundSource) ?></strong>
                </td>
            </tr>
        </table>

        <!-- Line Items Table -->
        <table class="main-table">
            <thead>
                <tr>
                    <th width="8%">Item #</th>
                    <th width="10%">Unit</th>
                    <th width="48%">Item Description & Technical Specifications</th>
                    <th width="8%">Qty</th>
                    <th width="12%">Unit Cost</th>
                    <th width="14%">Total Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php $idx = 1; foreach ($items as $it): ?>
                        <tr>
                            <td class="text-center"><?= $idx++ ?></td>
                            <td class="text-center"><?= e($it['unit'] ?? 'unit') ?></td>
                            <td>
                                <strong><?= e($it['item_description']) ?></strong>
                            </td>
                            <td class="text-center fw-bold"><?= (int)$it['quantity'] ?></td>
                            <td class="text-end">&#8369;<?= number_format((float)$it['estimated_unit_cost'], 2) ?></td>
                            <td class="text-end fw-bold">&#8369;<?= number_format((float)$it['total_cost'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">lot</td>
                        <td>
                            <strong><?= e($pr['purpose'] ?? 'General procurement specifications') ?></strong>
                        </td>
                        <td class="text-center">1</td>
                        <td class="text-end">&#8369;<?= number_format($totalAmount, 2) ?></td>
                        <td class="text-end fw-bold">&#8369;<?= number_format($totalAmount, 2) ?></td>
                    </tr>
                <?php endif; ?>

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

                <!-- Minimum spacing rows -->
                <?php for ($r = 0; $r < 4; $r++): ?>
                    <tr style="height: 22px;">
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                <?php endfor; ?>

                <!-- Total Row -->
                <tr style="font-weight: bold; background: #fafafa;">
                    <td colspan="5" class="text-end" style="padding: 8px;">TOTAL ESTIMATED COST:</td>
                    <td class="text-end" style="padding: 8px; font-size: 10pt; color: #800020;">
                        &#8369;<?= number_format($totalAmount, 2) ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Purpose Block -->
        <div style="border: 1px solid #000; border-top: none; padding: 8px 10px; font-size: 9pt;">
            Purpose / Project Activity: <strong><?= e($purpose) ?></strong>
        </div>

        <!-- 4-Signatory Standard MarSU Block -->
        <table class="footer-table">
            <tr>
                <td>
                    <strong>Requested by:</strong>
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($requestedBy)) ?></div>
                        <div class="sig-title">Dean / Department Head</div>
                    </div>
                </td>
                <td>
                    <strong>Funds Available / Certified:</strong>
                    <div class="sig-box">
                        <div class="sig-line">CARMELO JOMEL A. LEAL, MPA</div>
                        <div class="sig-title">Administrative Officer V / Budget Officer</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Recommending Approval:</strong>
                    <div class="sig-box">
                        <div class="sig-line">DR. MARISSA C. MINGOA</div>
                        <div class="sig-title">VP for Administration and Finance</div>
                    </div>
                </td>
                <td>
                    <strong>Approved by:</strong>
                    <div class="sig-box">
                        <div class="sig-line">DR. DIOSDADO P. ZULUETA</div>
                        <div class="sig-title">University President</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>


<?php
// Standalone Official Requisition and Issue Slip (RIS) Print View
$trackingNo = $issuance['tracking_no'] ?? ('RIS-' . date('Y') . '-001');
$recipient = $issuance['issued_to_name'] ?? 'Faculty Requester';
$dept = $issuance['department_name'] ?? 'College of Information & Computing Sciences';
$issueDate = $issuance['issue_date'] ?? date('Y-m-d');
$issuedBy = $issuance['issued_by'] ?? 'Maria Luisa D. Cruz';
$purpose = $issuance['purpose'] ?? 'Classroom & Office Supplies';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIS - <?= e($trackingNo) ?></title>
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
            <strong style="color:#800020;">Official Requisition &amp; Issue Slip (RIS)</strong>
            <span style="color:#64748b; font-size:12px; margin-left:8px;">(Appendix 63 - Government Accounting Manual)</span>
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
            <div style="font-size:9pt; color:#333;">Panambo, Boac, Marinduque</div>
            <div class="form-title">REQUISITION AND ISSUE SLIP (RIS)</div>
        </div>

        <table class="info-table">
            <tr>
                <td width="60%">
                    Division: <strong>Academic Affairs / Operations</strong><br>
                    Office: <strong><?= e($dept) ?></strong>
                </td>
                <td width="40%">
                    RIS No.: <strong><?= e($trackingNo) ?></strong><br>
                    Date: <strong><?= date("F d, Y", strtotime($issueDate)) ?></strong>
                </td>
            </tr>
        </table>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="10%">Stock #</th>
                    <th width="12%">Unit</th>
                    <th width="48%">Description of Supplies</th>
                    <th width="15%">Qty Requested</th>
                    <th width="15%">Qty Issued</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $it): ?>
                        <tr>
                            <td class="text-center"><?= e($it['property_number']) ?></td>
                            <td class="text-center">pcs</td>
                            <td><strong><?= e($it['item_name']) ?></strong></td>
                            <td class="text-center"><?= (int)$it['quantity'] ?></td>
                            <td class="text-center fw-bold text-success"><?= (int)$it['quantity'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center">RIS-001</td>
                        <td class="text-center">ream</td>
                        <td><strong>A4 Multipurpose Copy Paper 80gsm</strong></td>
                        <td class="text-center">5</td>
                        <td class="text-center fw-bold text-success">5</td>
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
            Purpose: <strong><?= e($purpose) ?></strong>
        </div>

        <table class="footer-table">
            <tr>
                <td>
                    Requested by:
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($recipient)) ?></div>
                        <div style="font-size:8pt;">Requisitioning Officer</div>
                    </div>
                </td>
                <td>
                    Approved by:
                    <div class="sig-box">
                        <div class="sig-line">DR. MARISSA C. MINGOA</div>
                        <div style="font-size:8pt;">VP for Administration</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Issued by:
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($issuedBy)) ?></div>
                        <div style="font-size:8pt;">Supply Officer III</div>
                    </div>
                </td>
                <td>
                    Received by:
                    <div class="sig-box">
                        <div class="sig-line"><?= strtoupper(e($recipient)) ?></div>
                        <div style="font-size:8pt;">Signature of End-User</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>


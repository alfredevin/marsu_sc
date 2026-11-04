<?php
include '../config.php';

if (!isset($_GET['sid']) || !isset($_GET['date'])) {
    die("Invalid Access.");
}

$supplier_id = mysqli_real_escape_string($conn, $_GET['sid']);
$date_awarded = mysqli_real_escape_string($conn, $_GET['date']);

// 1. Fetch Supplier Info
$sup_q = mysqli_query($conn, "SELECT s.*, rt.tin, rt.philgeps_no 
                              FROM supplier_tbl s 
                              LEFT JOIN rfq_tokens_tbl rt ON s.supplier_id = rt.supplier_id 
                              WHERE s.supplier_id = '$supplier_id' LIMIT 1");
$supplier = mysqli_fetch_assoc($sup_q);

// 2. Fetch Awarded Items
$items_q = mysqli_query($conn, "
    SELECT a.*, e.equipment_name, e.description, e.price as abc_price
    FROM awarded_items_tbl a
    JOIN equipment_tbl e ON a.equipment_id = e.equipment_id
    WHERE a.supplier_id = '$supplier_id' AND a.date_awarded = '$date_awarded'
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Awarded RFQ - MarSU</title>
    <style>
        body {
            background-color: #525659;
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px;
        }

        .paper {
            background: white;
            width: 210mm;
            min-height: 297mm;
            /* A4 Size */
            padding: 20mm;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            /* Para laging nasa baba ang footer */
            box-sizing: border-box;
        }

        /* Header Section */
        .rfq-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .logo {
            width: 90px;
            height: auto;
            margin-bottom: 10px;
        }

        .u-name {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }

        .u-unit {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 2px;
            margin-top: 5px;
        }

        .rfq-title {
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin: 25px 0;
            text-align: center;
        }

        /* Information Grid */
        .info-grid {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .info-left {
            width: 65%;
            line-height: 1.8;
        }

        .info-right {
            width: 35%;
            line-height: 1.8;
            text-align: right;
        }

        .line-field {
            border-bottom: 1px solid #000;
            display: inline-block;
            padding: 0 5px;
            font-weight: bold;
        }

        /* Legal Text */
        .legal-text {
            font-size: 13px;
            text-align: justify;
            margin-bottom: 15px;
            line-height: 1.4;
            text-indent: 40px;
        }

        /* Table Style */
        .rfq-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .rfq-table th,
        .rfq-table td {
            border: 1px solid black;
            padding: 10px;
        }

        .rfq-table th {
            background-color: #f2f2f2;
        }

        /* Signatures */
        .approved-by-section {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }

        .approved-by-box {
            text-align: center;
            width: 300px;
        }

        .sig-line {
            border-top: 1.5px solid black;
            margin-top: 50px;
            font-weight: bold;
            padding-top: 5px;
            font-size: 14px;
        }

        /* Fixed Footer */
        .footer-note {
            margin-top: auto;
            /* Pinu-push nito ang footer sa pinakababa ng flex container */
            font-size: 11px;
            color: #444;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .paper {
                margin: 0;
                box-shadow: none;
                border: none;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="paper">
        <div class="rfq-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/MarSu_Logo.jpg/250px-MarSu_Logo.jpg"
                class="logo" alt="MarSU Logo">
            <div class="u-name">MARINDUQUE STATE UNIVERSITY</div>
            <div class="u-unit">PROCUREMENT UNIT</div>
        </div>

        <div class="rfq-title">REQUEST FOR QUOTATION</div>

        <div class="info-grid">
            <div class="info-left">
                <div>Name of Supplier/Company: <span class="line-field"
                        style="min-width: 250px;"><?= htmlspecialchars($supplier['supplier_name']) ?></span></div>
                <div>Address: <span class="line-field"
                        style="min-width: 300px;"><?= htmlspecialchars($supplier['address']) ?></span></div>
                <div>TIN: <span class="line-field"
                        style="min-width: 200px;"><?= htmlspecialchars($supplier['tin'] ?? '____________________') ?></span>
                </div>
                <div>PhilGEPS Reg. Number: <span class="line-field"
                        style="min-width: 200px;"><?= htmlspecialchars($supplier['philgeps_no'] ?? '____________________') ?></span>
                </div>
            </div>
            <div class="info-right">
                Date: <span class="line-field"
                    style="width: 120px; text-align: center;"><?= date('F d, Y', strtotime($date_awarded)) ?></span><br>
                Quotation No: <span class="line-field" style="width: 120px;">_______________</span><br>
                PR No: <span class="line-field" style="width: 120px;">_______________</span>
            </div>
        </div>

        <div class="legal-text">
            The MARINDUQUE STATE UNIVERSITY through its Bids and Awards Committee/Procurement Unit invites
            suppliers/manufacturers/distributors/contractors to apply for eligibility and to bid for the hereunder
            project/s for CY <?= date('Y') ?> in accordance with Section 53.9 (Small-Value Procurement) of the 2016
            Revised Implementing Rules and Regulation of Republic Act 9184.
        </div>

        <table class="rfq-table">
            <thead>
                <tr>
                    <th style="width: 60%;">Description / Specification</th>
                    <th style="width: 40%;">ABC (Approved Budget)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($items_q)) {
                    ?>
                    <tr>
                        <td>
                            <div style="font-weight: bold;"><?= strtoupper($row['equipment_name']) ?></div>
                            <div style="font-size: 11px; margin-top: 5px;"><?= $row['description'] ?></div>
                            <div style="font-size: 11px; font-style: italic; color: green; margin-top: 5px;">
                                *Awarded Bid Price: ₱<?= number_format($row['awarded_price'], 2) ?>*
                            </div>
                        </td>
                        <td style="text-align: center; font-weight: bold; vertical-align: top;">
                            ₱<?= number_format($row['abc_price'], 2) ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="legal-text" style="text-indent: 0;">
            Please quote your best offer for the item/s described herein provided. Submit your quotation price on the
            item/s listed below stating the shortest time of delivery and submit your quotation duly signed by your
            representative not later than <strong>______________ / 2:00 PM</strong> in a sealed envelope at the
            Procurement Unit, 2nd Floor, New Administration Building, Marinduque State University, Tanza, Boac,
            Marinduque.
        </div>

        <div class="legal-text">
            A complete set of eligibility requirements is required to be submitted along with your quotation/proposal. A
            valid certificate of PhilGEPS Registration (Platinum Membership) may be submitted in lieu of
            Mayor's/Business Permit.
        </div>

        <div class="approved-by-section">
            <div class="approved-by-box">
                <p style="text-align: left; margin-bottom: 30px;">Approved by:</p>
                <div class="sig-line">ATTY. CRISPIN FRANCIS M. JANDUSAY</div>
                <div style="font-size: 12px; margin-top: 2px;">Chairperson, Bids and Awards Committee</div>
            </div>
        </div>

        <div class="footer-note">
            Panfilo M. Manguera Sr. Rd., Tanza, Boac, Marinduque 4900 Philippines |
            www.marinduquestateuniversity.edu.ph<br>
            Email: procurement@mscmarinduque.edu.ph | Contact: 09542890254
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>
<?php
include './../config.php';

// Check ID
if (!isset($_GET['supplier_id'])) die("Supplier ID missing.");
$supp_id = mysqli_real_escape_string($conn, $_GET['supplier_id']);

// Get Winner Data & RFQ Details (Tinanggal ang rt.rfq_no para iwas error)
$q_winner = mysqli_query($conn, "SELECT s.*, rt.tin 
                                 FROM supplier_tbl s 
                                 LEFT JOIN rfq_tokens_tbl rt ON s.supplier_id = rt.supplier_id 
                                 WHERE s.supplier_id = '$supp_id' LIMIT 1");
$supplier = mysqli_fetch_assoc($q_winner);

// PO Number logic (Example based on the image)
$po_number = date("Y-m") . "-" . str_pad($supplier['supplier_id'], 3, '0', STR_PAD_LEFT) . " FID";

// --- FUNCTION TO CONVERT NUMBER TO WORDS ---
function numberToWords($num) {
    $ones = array(
        0 => "ZERO", 1 => "ONE", 2 => "TWO", 3 => "THREE", 4 => "FOUR", 
        5 => "FIVE", 6 => "SIX", 7 => "SEVEN", 8 => "EIGHT", 9 => "NINE", 
        10 => "TEN", 11 => "ELEVEN", 12 => "TWELVE", 13 => "THIRTEEN", 
        14 => "FOURTEEN", 15 => "FIFTEEN", 16 => "SIXTEEN", 17 => "SEVENTEEN", 
        18 => "EIGHTEEN", 19 => "NINETEEN"
    );
    $tens = array(
        0 => "ZERO", 1 => "TEN", 2 => "TWENTY", 3 => "THIRTY", 4 => "FORTY", 
        5 => "FIFTY", 6 => "SIXTY", 7 => "SEVENTY", 8 => "EIGHTY", 9 => "NINETY"
    );
    $hundreds = array("HUNDRED", "THOUSAND", "MILLION", "BILLION");

    $num = number_format($num, 2, ".", "");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(str_split($wholenum, 3));
    $ret = "";

    foreach ($whole_arr as $key => $i) {
        if ($i < 20) {
            $rettxt = @$ones[intval($i)];
        } elseif ($i < 100) {
            $rettxt = $tens[substr($i, 0, 1)];
            $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            $rettxt = $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            $remainder = substr($i, 1);
            if ($remainder < 20) {
                $rettxt .= " " . @$ones[intval($remainder)];
            } else {
                $rettxt .= " " . $tens[substr($i, 1, 1)] . " " . $ones[substr($i, 2, 1)];
            }
        }
        if ($key > 0) {
            $ret = $rettxt . " " . $hundreds[$key] . " " . $ret;
        } else {
            $ret = $rettxt;
        }
    }

    // Tanggalin ang "ZERO" kung may kasama na itong ibang words
    $ret = str_replace(" ZERO", "", $ret);
    
    return trim($ret);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Order - <?= $supplier['supplier_name'] ?></title>
    <style>
        @page { size: A4; margin: 10mm; }
        body { font-family: Arial, sans-serif; font-size: 9pt; color: #000; line-height: 1.2; margin: 0; padding: 0; }
        .wrapper { border: 2px solid #000; padding: 0; min-height: 275mm; position: relative; }
        
        /* Header */
        .header-table { width: 100%; border-bottom: 1px solid #000; }
        .logo-box { width: 70px; text-align: center; padding: 5px; }
        .univ-text { text-align: center; font-family: "Times New Roman", serif; }
        .univ-name { font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .proc-unit { font-size: 11pt; font-weight: bold; }

        .po-title { text-align: center; font-size: 13pt; font-weight: bold; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 5px; background: #fff; position: relative; }
        .appendix { position: absolute; right: 5px; top: 2px; font-size: 7pt; font-weight: normal; }

        /* Information Sections */
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { border: 1px solid #000; padding: 4px 8px; vertical-align: top; }
        
        /* Items Table */
        .main-table { width: 100%; border-collapse: collapse; margin-top: -1px; }
        .main-table th { border: 1px solid #000; padding: 5px; background: #f2f2f2; text-transform: uppercase; font-size: 8pt; text-align: center; }
        .main-table td { border-left: 1px solid #000; border-right: 1px solid #000; padding: 4px 8px; vertical-align: top; }
        .item-row { height: 30px; }
        .total-row td { border-top: 1px solid #000; border-bottom: 1px solid #000; font-weight: bold; padding: 8px; }

        /* Footer/Signatures */
        .sig-table { width: 100%; border-collapse: collapse; margin-top: -1px; }
        .sig-table td { border: 1px solid #000; padding: 8px; width: 50%; vertical-align: top; }
        .sig-line { border-bottom: 1px solid #000; width: 85%; margin: 25px auto 2px; text-align: center; font-weight: bold; text-transform: uppercase; min-height: 15px; }
        
        .footer-note { font-size: 7pt; text-align: center; padding: 5px; position: absolute; bottom: 0; width: 100%; border-top: 1px solid #000; box-sizing: border-box; }
        .amount-words { font-weight: bold; text-decoration: underline; font-style: italic; }
        .penalty { font-size: 7.5pt; border-bottom: 1px solid #000; padding: 5px; text-align: justify; }
    </style>
</head>
<body onload="window.print()">

<div class="wrapper">
    <table class="header-table">
        <tr>
            <td class="logo-box">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSSk-yVcvIRAtJBTCh_-RQD8ky5I-f5_XAsg&s" width="50" alt="Gov Logo">
            </td>
            <td class="univ-text">
                <div class="univ-name">MARINDUQUE STATE UNIVERSITY</div>
                <div class="proc-unit">PROCUREMENT UNIT</div>
            </td>
            <td class="logo-box">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoPqt8ih8Y_eeQeHEArWyjJEOuJpWOAltWmg&s" width="55" alt="MarSU Logo">
            </td>
        </tr>
    </table>

    <div class="po-title">
        PURCHASE ORDER
        <div class="appendix">Appendix 61</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="55%">
                Supplier: <strong><?= strtoupper($supplier['supplier_name']) ?></strong><br>
                Address: <?= $supplier['address'] ?><br>
                TIN: <?= $supplier['tin'] ?: '000-000-000-000' ?>
            </td>
            <td width="45%">
                P.O. No.: <strong><?= $po_number ?></strong><br>
                Date: <?= date("F d, Y") ?><br>
                Mode of Procurement: Small Value Procurement
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Gentlemen:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please furnish this Office the following articles subject to the terms and conditions contained herein:
            </td>
        </tr>
        <tr>
            <td>
                Place of Delivery: Marinduque State University - MAIN CAMPUS<br>
                Date of Delivery: Thirty (30) Calendar Days
            </td>
            <td>
                Delivery Term: FOB Destination<br>
                Payment Term: Ten (10) working days
            </td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th width="10%">Unit</th>
                <th width="45%">Description</th>
                <th width="10%">Quantity</th>
                <th width="15%">Unit Cost</th>
                <th width="20%">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $q_items = mysqli_query($conn, "
                SELECT e.equipment_name, e.description, aw.awarded_price,
                (SELECT SUM(quantity) FROM ppmp_items_tbl WHERE equipment_id = aw.equipment_id) as total_qty
                FROM awarded_items_tbl aw
                JOIN equipment_tbl e ON aw.equipment_id = e.equipment_id
                WHERE aw.supplier_id = '$supp_id'
            ");
            $grand_total = 0;
            $count = 0;
            while ($row = mysqli_fetch_assoc($q_items)) {
                $subtotal = $row['awarded_price'] * $row['total_qty'];
                $grand_total += $subtotal;
                $count++;
            ?>
                <tr class="item-row">
                    <td align="center">pcs</td>
                    <td>
                        <strong><?= strtoupper($row['equipment_name']) ?></strong><br>
                        <span style="font-size: 8pt;"><?= $row['description'] ?></span>
                    </td>
                    <td align="center"><?= $row['total_qty'] ?></td>
                    <td align="right"><?= number_format($row['awarded_price'], 2) ?></td>
                    <td align="right"><?= number_format($subtotal, 2) ?></td>
                </tr>
            <?php } ?>
            
            <tr class="item-row">
                <td></td>
                <td align="center"><i>*** NOTHING FOLLOWS ***</i></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <?php for($i=$count; $i<8; $i++) echo "<tr style='height:35px;'><td></td><td></td><td></td><td></td><td></td></tr>"; ?>

            <tr class="total-row">
                <td colspan="4">
                    <span style="font-size: 8pt;">(Total Amount in Words):</span> 
                    <span class="amount-words"><?= numberToWords($grand_total) ?> PESOS ONLY</span>
                </td>
                <td align="right" style="font-size: 11pt;">₱ <?= number_format($grand_total, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="penalty">
        In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day of delay shall be imposed on the undelivered item/s.
    </div>

    <table class="sig-table">
        <tr>
            <td>
                Conforme:<br>
                <div class="sig-line"><?= strtoupper($supplier['supplier_name']) ?></div>
                <center>Signature over Printed Name of Supplier</center>
                <div class="sig-line" style="width: 40%; margin-top: 15px;"><?= date("m/d/Y") ?></div>
                <center>Date</center>
            </td>
            <td>
                Very truly yours,<br>
                <div class="sig-line">PROF. DIOSDADO P. ZULUETA, DPA</div>
                <center>SUC President III</center>
            </td>
        </tr>
        <tr>
            <td>
                Fund Cluster: <strong>05</strong><br>
                Funds Available:<br><br>
                <div class="sig-line">MAE KRISTINE L. MORTARON, CPA</div>
                <center>Accountant III / Authorized Representative</center>
            </td>
            <td>
                ORS/BURS No.: ____________________<br>
                Date of the ORS/BURS: _____________<br>
                Amount: <strong style="font-size: 10pt;">₱ <?= number_format($grand_total, 2) ?></strong>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        Panfilo M. Manguera Sr. Rd., Tanza, Boac, Marinduque 4900 Philippines | www.marinduquestateuniversity.edu.ph | procurement@marinduque.edu.ph | (042) 332-2028
    </div>
</div>

</body>
</html>
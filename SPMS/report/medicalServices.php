<?php



include './../config.php';

$appointment_id = $_GET['appointment_id'];
$query = "SELECT a.*, 
        p.full_name, 
        p.date_of_birth, 
        d.first_name AS doctor_first, 
        d.last_name AS doctor_last,
        pay.payment_type,
        pay.reference_number,
        pay.amount,
        ds.doctor_id,
        pay.screenshot
FROM appointment_tbl a
INNER JOIN patients_tbl p ON p.patient_id = a.patient_id
LEFT JOIN doctor_schedule_tbl ds ON ds.appointment_id = a.appointment_id
LEFT JOIN doctor_tbl d ON d.doctor_id = ds.doctor_id
LEFT JOIN payment_tbl pay ON pay.appointment_id = a.appointment_id
WHERE   a.appointment_id = '$appointment_id'";
$result_query = mysqli_query($conn, $query);
$row_res = mysqli_fetch_assoc($result_query);

$name = $row_res['full_name'];
$service = $row_res['service_name'];
$date = date("F d, Y", strtotime($row_res['appointment_date']));
$time = date("h:i:A", strtotime($row_res['appointment_time']));
$birth_date = $row_res['date_of_birth'];
$date_today = date('Y-m-d');
$birth = new DateTime($birth_date);
$today = new DateTime($date_today);
$age = $birth->diff($today)->y;

$location = "Bagong Silang, Santa Cruz Marinduque";



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Medical Certificate </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 17px;
        }

        .report-header h2 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .report-header h3 {
            font-size: 16px;
            margin: 0;
        }

        .report-header h4 {
            font-size: 14px;
            margin: 0;
        }

        .report-header p {
            font-size: 13px;
            margin: 5px 0;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th,
        .report-table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
            font-size: 8px;
        }

        .bg-success {
            background: #28a745;
            color: #fff;
        }

        .bg-danger {
            background: #dc3545;
            color: #fff;
        }

        .bg-warning {
            background: #ffc107;
            color: #212529;
        }

        @media print {
            .bg-success {
                background-color: #28a745 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .bg-danger {
                background-color: #dc3545 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .bg-warning {
                background-color: #ffc107 !important;
                color: #212529 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
    <style>
        .line {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 300px;
        }

        .section {
            margin: 20px 0;
            text-align: justify;
        }

        .doctors {
            margin-top: 40px;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="report-header">
        <table width="100%">
            <tr>
                <td style="width: 15%; text-align: center;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvMKlc668CaDlMINpHSEg5Hrf2xvPAWWt7TA&s" alt=" " width="80">
                </td>
                <td style="text-align: center;">
                    <h3 style="margin: 0;">MIRACULOUS MEDAL MATERNITY AND MEDICAL CLINIC </h3>
                    <h4 style="margin: 0;">Panamitan St, Isok I, Boac Marinduque</h4>
                </td>
                <td style="width: 15%; text-align: center; border-radius: 50%;">
                    <img src="./../img/clinic.jpg" alt=" " width="100">
                </td>
            </tr>
        </table>
        <h2 class="center" style="text-transform:uppercase;">Medical Certificate</h2>
    </div>





    <div class="section">
        <p style="float: right;">Date: <span style="text-decoration: underline;text-transform:uppercase;font-weight:bolder;letter-spacing:1px;"><?php echo $date_today; ?></span></p>

        <p style="float:left;">
            This is to certify that Mr./Ms. <span style="text-decoration: underline;text-transform:uppercase;font-weight:bolder;letter-spacing:1px;"><?php echo $name; ?></span> ,
            <span style="text-decoration: underline;text-transform:uppercase;font-weight:bolder;letter-spacing:1px;"><?php echo $age; ?></span> years old, male/female, residing at <span style="text-decoration: underline;text-transform:uppercase;font-weight:bolder;letter-spacing:1px;"><?php echo $location; ?></span>,
            was seen and examined last <span style="text-decoration: underline;text-transform:uppercase;font-weight:bolder;letter-spacing:1px;"><?php echo $date; ?> </span> at our clinic with findings/diagnosis of:
        </p>

        <p style="float:left;text-align:center;">____________________________________________________</p>
    </div>

    <div class="section" style="float:left;">
        <p><strong>Recommendation/Advice/Remarks:</strong></p>
        <p>____________________________________________________</p>
        <p>____________________________________________________</p>
    </div>

    <div class="section" style="float:left;">
        <p>
            This is issued for maternity leave / sick leave / reinstatement / SSS / employment / enrollment / travel purposes /
            <u>per patient’s request</u>.
        </p>
    </div>

    <!-- Doctor Section -->
    <div class="doctors " style="float:right;text-align:center;">
        <p><strong>DR. RICARDO M. MACAYAON, DPBA, FPSA</strong><br>
            Lic. No.: 0083759<br>
            Anesthesiologist / General Medicine<br>
            Fellow – Phil. Society of Anesthesiologists, Inc.</p>

        <br>

        <p><strong>DR. ANNETTE MAGNO-MACAYAON, FPOGS, FPSUOG</strong><br>
            Lic. No.: 0083711<br>
            Obstetrician-Gynecologist-Sonologist<br>
            Fellow – Philippine Society of Obstetrics & Gynecology, Inc.<br>
            Fellow – Philippine Society of Ultrasound in Obstetrics and Gynecology</p>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>
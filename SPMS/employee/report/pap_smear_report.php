<?php
include './../../config.php';



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pap Smear </title>
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

        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
            /* para maliit lahat */
        }

        .report-table th,
        .report-table td {
            border: 1px solid #333;
            padding: 4px;
            text-align: left;
            font-size: 12px;
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
                    <img src="./../../img/clinic.jpg" alt=" " width="100">
                </td>
            </tr>
        </table>
        <h2 class="center" style="text-transform:uppercase;">Pap Smear Report List </h2>
    </div>





    <div class="section">
        <div class="section">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Service</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Doctor Assigned</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT a.*, 
                                p.full_name, 
                                d.first_name AS doctor_first, 
                                d.last_name AS doctor_last,
                                pay.payment_type,
                                pay.reference_number,
                                pay.amount,
                                pay.screenshot,
                                l.login_time,
                                l.logout_time
                        FROM appointment_tbl a
                        INNER JOIN patients_tbl p ON p.patient_id = a.patient_id
                        LEFT JOIN doctor_schedule_tbl ds ON ds.appointment_id = a.appointment_id
                        LEFT JOIN doctor_tbl d ON d.doctor_id = ds.doctor_id
                        LEFT JOIN payment_tbl pay ON pay.appointment_id = a.appointment_id
                        LEFT JOIN patient_login_tbl l ON l.appointment_id = a.appointment_id
                        WHERE a.status = 6 AND service_name = 'Pap Smear'
                        ORDER BY a.appointment_date ASC, a.appointment_time ASC";

                    $appointments = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($appointments)) {
                    ?>
                        <tr>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['service_name']; ?></td>
                            <td><?php echo date("F d, Y", strtotime($row['appointment_date'])); ?></td>
                            <td><?php echo date("h:i A", strtotime($row['appointment_time'])); ?></td>
                            <td>
                                <?php
                                if (!empty($row['doctor_first']) && !empty($row['doctor_last'])) {
                                    echo $row['doctor_first'] . ' ' . $row['doctor_last'];
                                } else {
                                    echo "<span class='text-muted'>Not Assigned</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Doctor Section -->
    <div class="doctors " style="float:right;text-align:center;">

        <?php

        $select_doctor = mysqli_query($conn, 'SELECT * FROM doctor_tbl');
        while ($doc = mysqli_fetch_assoc($select_doctor)) {

        ?>
            <p><strong>
                    <?php
                    echo $doc['first_name'] . ' ' . $doc['last_name'];
                    ?>
                </strong><br>
                Lic. No.:
                <?php
                echo $doc['doc_id'];
                ?><br>
                <?php
                echo $doc['specialty'];
                ?><br>
                <?php
                echo $doc['email'] . ' / ' . $doc['contact_number'];
                ?>.</p>

            <br>
        <?php
        }
        ?>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>
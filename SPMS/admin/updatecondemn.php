<?php
include './../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header('Content-Type: application/json'); 
    $pr_id = mysqli_real_escape_string($conn, $_POST['pr_id']);
    $condemned_by = mysqli_real_escape_string($conn, $_POST['condemned_by']);
    $date_condemned = date('Y-m-d H:i:s');

    $sql = "UPDATE pr_tbl SET status = 4 WHERE pr_property_id = '$pr_id'";
    if (mysqli_query($conn, $sql)) {
        $insert = "INSERT INTO condemned_tbl (condemned_pr_id, condemned_by, date_condemned)
                   VALUES ('$pr_id', '$condemned_by', '$date_condemned')";
        if (mysqli_query($conn, $insert)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
    }
}

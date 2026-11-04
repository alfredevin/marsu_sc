<?php
include './../config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Kunin ang lahat ng items ng lumang PPMP
    $query = "SELECT * FROM ppmp_items_tbl WHERE ppmp_id = '$id'";
    $result = mysqli_query($conn, $query);
    
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    
    echo json_encode($items);
}
?>
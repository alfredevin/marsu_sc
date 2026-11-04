<?php
include './../config.php';



$sql = "SELECT pr.*,
            COUNT(pri.item_id) AS total_items,
            SUM(pri.total) AS combined_total
        FROM purchase_request_tbl pr
        LEFT JOIN purchase_request_items_tbl pri ON pr.pr_id = pri.pr_id
        WHERE pr.status = 3
        GROUP BY pr.status";

$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle mb-3">
            <h1>For Inspection Items</h1>
            <p>List of all purchase requests. You can view details of items requested.</p>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Purchase Request</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th></th> 
                                <th>Grand Total (₱)</th>
                                <th>No. of Items</th>
                                <th>Received by</th>
                                <th>Date Received</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-warning">For Inspection</span>
                                    </td> 
                                    <td>₱<?php echo number_format($row['combined_total'], 2); ?></td>
                                    <td><?php echo $row['total_items']; ?></td>
                                    <td><?php echo $row['received_by']; ?></td>
                                    <td><?php echo $row['received_date']; ?></td>
                                    <td>
                                        <a href="view_item_for_inspection" class="btn btn-primary btn-sm">View Items</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
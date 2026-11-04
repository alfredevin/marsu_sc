<?php
include './../config.php';

// Get all PRs
$sql = "SELECT pr.*, COUNT(pri.item_id) as item_count 
        FROM purchase_request_tbl pr
        LEFT JOIN purchase_request_items_tbl pri ON pr.pr_id = pri.pr_id
         WHERE status = 2
        GROUP BY pr.pr_id
        ORDER BY pr.pr_id DESC";
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
                    <h5 class="card-title">List of  Purchase Request</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tracking Number</th>
                                <th>Request Date</th>
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
                                    <td><?php echo $row['tracking_number']; ?></td>
                                    <td><?php echo $row['request_date']; ?></td>
                                    <td>₱<?php echo number_format($row['grand_total'], 2); ?></td>
                                    <td><?php echo $row['item_count']; ?></td>
                                    <td><?php echo $row['received_by']; ?></td>
                                    <td><?php echo $row['received_date']; ?></td>
                                    <td>
                                        <a href="view_item_for_inspection?id=<?php echo $row['pr_id']; ?>" class="btn btn-primary btn-sm">View Items</a>
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
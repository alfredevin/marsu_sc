<?php
include './../config.php';



$sql = "SELECT pr.*,
            COUNT(pri.item_id) AS total_items,
            SUM(pri.total) AS combined_total
        FROM purchase_request_tbl pr
        LEFT JOIN purchase_request_items_tbl pri ON pr.pr_id = pri.pr_id
        WHERE pr.status IN (4,5)
        GROUP BY pr.tracking_number";

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
            <h1>Completed Purchase Order</h1>
            <p class="text-success">Below is the list of completed purchase orders.</p>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Completed Purchase</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No. of Items</th>
                                <th>Grand Total (₱)</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                   
                                    <td><?php echo $row['total_items']; ?></td>
                                    <td>₱<?php echo number_format($row['combined_total'], 2); ?></td> 
                                    <td>
                                        <a href="view_completed_purchase_order?tracking_number=<?= $row['tracking_number']?>" class="btn btn-primary btn-sm">View Items</a>
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
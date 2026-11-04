<?php
include './../config.php';

// Get all PRs
$sql = "SELECT pr.*,
            COUNT(pri.item_id) AS total_items,
            SUM(pri.total) AS combined_total
        FROM purchase_request_tbl pr
        LEFT JOIN purchase_request_items_tbl pri ON pr.pr_id = pri.pr_id
        WHERE pr.status = 2
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
        <div class="pagetitle">
            <h1>For Received Purchase Order</h1>
            <p class="text-muted">This page displays all purchase requests that are pending receipt of their purchase orders.</p>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of For Received Purchase Order</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No. of Items</th>
                                <th>Grand Total (₱)</th>
                                <th>Supplier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">For Received</span>
                                    </td>
                                    <td><?php echo $row['total_items']; ?></td>
                                    <td>₱<?php echo number_format($row['combined_total'], 2); ?></td>
                                    <td><?php echo $row['supplier']; ?></td>
                                    <td>
                                        <a href="view_items_for_recieve" class="btn btn-primary btn-sm">View Items</a>
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
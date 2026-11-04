<?php
include './../config.php';

$pr_id = $_GET['id'] ?? 0;

// Get PR info
$pr_sql = "SELECT * FROM purchase_request_tbl WHERE pr_id = ?";
$stmt = mysqli_prepare($conn, $pr_sql);
mysqli_stmt_bind_param($stmt, "i", $pr_id);
mysqli_stmt_execute($stmt);
$pr_result = mysqli_stmt_get_result($stmt);
$pr = mysqli_fetch_assoc($pr_result);

// Get PR items
$item_sql = "SELECT pri.*, e.equipment_name 
             FROM purchase_request_items_tbl pri
             LEFT JOIN equipment_tbl e ON pri.equipment_id = e.equipment_id
             WHERE pri.pr_id = ?";
$stmt2 = mysqli_prepare($conn, $item_sql);
mysqli_stmt_bind_param($stmt2, "i", $pr_id);
mysqli_stmt_execute($stmt2);
$items_result = mysqli_stmt_get_result($stmt2);

?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>List of Items For Issued #<?php echo $pr['pr_id']; ?></h1>
            <p>
                This page displays the list of items that have been issued for the selected Purchase Request (PR).
                Review the issued quantities, item details, and related information for this PR.
            </p>
            <a href="for_issuance_item" class="btn btn-secondary">← Back to List</a>

        </div>


        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Issued Items</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity Request</th>
                                <th>Price (₱)</th>
                                <th>Total (₱)</th>
                                <th>Issued Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                                <tr>
                                    <td><?php echo $item['equipment_name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td>₱<?php echo number_format($item['price'], 2); ?></td>
                                    <td>₱<?php echo number_format($item['total'], 2); ?></td>
                                    <td><?php echo $item['issued_qty']; ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Grand Total</strong></td>
                                <td>₱<?php echo number_format($pr['grand_total'], 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </section>
    </main>
     

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
    

</body>

</html>
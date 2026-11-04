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

// When inspecting
if (isset($_POST['inspect_submit'])) {
    $delivered_qtys = $_POST['delivered_qty'] ?? [];
    $pr_id = $_POST['pr_id'];
    $inspected_by = $_POST['inspected_by'];
    $inspected_date = $_POST['inspected_date'];

    // Update each item
    foreach ($delivered_qtys as $item_id => $qty) {
        $sql_item = "UPDATE purchase_request_items_tbl 
                     SET delivered_qty = ? 
                     WHERE item_id = ? AND pr_id = ?";
        $stmt_item = mysqli_prepare($conn, $sql_item);
        mysqli_stmt_bind_param($stmt_item, "iii", $qty, $item_id, $pr_id);
        mysqli_stmt_execute($stmt_item);
    }

    // Update PR inspection info
    $sql_pr = "UPDATE purchase_request_tbl 
               SET inspected_by = ?, inspected_date = ?, status = '3'
               WHERE pr_id = ?";
    $stmt_pr = mysqli_prepare($conn, $sql_pr);
    mysqli_stmt_bind_param($stmt_pr, "ssi", $inspected_by, $inspected_date, $pr_id);
    mysqli_stmt_execute($stmt_pr);

    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Purchase Request Inspected!",
                showConfirmButton: true
            }).then(() => {
                window.location.href = "for_inspection"; 
            });
        });
    </script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase Request #<?php echo $pr['pr_id']; ?></h1>
            <p>Details of all items requested in this PR.</p>
            <a href="for_inspection" class="btn btn-secondary">← Back to List</a>

        </div>


        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Items in this Request</h5>
                    <form method="POST">
                        <input type="hidden" name="pr_id" value="<?php echo $pr['pr_id']; ?>">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Requested Qty</th>
                                    <th>Delivered Qty</th>
                                    <th>Price (₱)</th>
                                    <th>Total (₱)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                                    <tr>
                                        <td><?php echo $item['equipment_name']; ?></td>
                                        <td class="requested-qty"><?php echo $item['quantity']; ?></td>
                                        <td>
                                            <input type="number"
                                                name="delivered_qty[<?php echo $item['item_id']; ?>]"
                                                class="form-control delivered-qty"
                                                min="0"
                                                max="<?php echo $item['quantity']; ?>"
                                                value="<?php echo $item['delivered_qty']; ?>"
                                                required>
                                            <small class="text-danger error-msg" style="display:none;">Quantity exceeds requested amount</small>
                                        </td>
                                        <td>₱<?php echo number_format($item['price'], 2); ?></td>
                                        <td>₱<?php echo number_format($item['total'], 2); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const inputs = document.querySelectorAll(".delivered-qty");

                                inputs.forEach(input => {
                                    input.addEventListener("input", function() {
                                        const row = input.closest("tr");
                                        const requestedQty = parseInt(row.querySelector(".requested-qty").textContent);
                                        const errorMsg = row.querySelector(".error-msg");

                                        if (parseInt(input.value) > requestedQty) {
                                            input.classList.add("is-invalid");
                                            errorMsg.style.display = "block";
                                        } else {
                                            input.classList.remove("is-invalid");
                                            errorMsg.style.display = "none";
                                        }
                                    });
                                });
                            });
                        </script>


                        <!-- Inspector Info -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="inspected_by" class="form-label">Inspected By</label>
                                <input type="text" name="inspected_by" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inspected_date" class="form-label">Inspection Date</label>
                                <input type="date" name="inspected_date" class="form-control"
                                    value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" name="inspect_submit" class="btn btn-primary">
                                Save Inspection
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
<?php
include './../config.php';

$pr_id = $_GET['id'] ?? 0;

// Get PR info
$pr_sql = "SELECT * FROM purchase_request_tbl WHERE status = 3";
$pr_result = mysqli_query($conn, $pr_sql);
$pr = mysqli_fetch_assoc($pr_result);

// Get PR items
$item_sql = "SELECT pri.*, e.equipment_name 
             FROM purchase_request_items_tbl pri
             LEFT JOIN equipment_tbl e ON pri.equipment_id = e.equipment_id
             INNER JOIN purchase_request_tbl prt ON prt.pr_id = pri.pr_id
             WHERE prt.status = 3";
$items_result = mysqli_query($conn, $item_sql);
// When inspecting

if (isset($_POST['inspect_submit'])) {
    $delivered_qtys = $_POST['delivered_qty'] ?? [];
    $inspected_by = $_POST['inspected_by'];
    $inspected_date = $_POST['inspected_date'];
    $tracking_number = rand(10000000, 99999999);

    // Update each item
    foreach ($delivered_qtys as $item_id => $qty) {
        $sql_item = "UPDATE purchase_request_items_tbl 
                     SET delivered_qty = ? ,pr_item_status = 2, tracking_number = ?
                     WHERE item_id = ? AND pr_item_status = 1";
        $stmt_item = mysqli_prepare($conn, $sql_item);
        mysqli_stmt_bind_param($stmt_item, "isi", $qty, $tracking_number, $item_id);
        mysqli_stmt_execute($stmt_item);
    }

    // Update PR inspection info
    $sql_pr = "UPDATE purchase_request_tbl 
               SET inspected_by = ?, inspected_date = ?, status = '4',tracking_number = ?
               WHERE status ='3'";
    $stmt_pr = mysqli_prepare($conn, $sql_pr);
    mysqli_stmt_bind_param($stmt_pr, "sss", $inspected_by, $inspected_date, $tracking_number);
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
            <h1>Item For Request </h1>
            <p>Details of all items requested in this PR.</p>
            <a href="for_inspection" class="btn btn-secondary">← Back to List</a>

        </div>


        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Items For Inspection</h5>
                    <form method="POST">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Requested Qty</th>
                                    <th>Delivered Qty</th>
                                    <th>Remaining Qty</th>
                                    <th>Price (₱)</th>
                                    <th>Total Requested (₱)</th>
                                    <th>Total Delivered (₱)</th>
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
                                        <td class="remaining-qty">0</td>
                                        <td class="price"><?php echo number_format($item['price'], 2); ?></td>
                                        <td class="total-requested">₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                        <td class="total-delivered">₱0.00</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="1" class="text-end">Totals:</td>
                                    <td id="sum-requested">0</td>
                                    <td id="sum-delivered">0</td>
                                    <td id="sum-remaining">0</td>
                                    <td></td>
                                    <td id="sum-total-requested">₱0.00</td>
                                    <td id="sum-total-delivered">₱0.00</td>
                                </tr>
                            </tfoot>
                        </table>


                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const inputs = document.querySelectorAll(".delivered-qty");

                                function updateTotals() {
                                    let sumRequested = 0,
                                        sumDelivered = 0,
                                        sumRemaining = 0;
                                    let sumTotalRequested = 0,
                                        sumTotalDelivered = 0;

                                    document.querySelectorAll("tbody tr").forEach(row => {
                                        const requested = parseInt(row.querySelector(".requested-qty").textContent) || 0;
                                        const delivered = parseInt(row.querySelector(".delivered-qty").value) || 0;
                                        const price = parseFloat(row.querySelector(".price").textContent.replace(/,/g, '')) || 0;

                                        const remaining = requested - delivered;
                                        const totalRequested = requested * price;
                                        const totalDelivered = delivered * price;

                                        row.querySelector(".remaining-qty").textContent = remaining;
                                        row.querySelector(".total-delivered").textContent = "₱" + totalDelivered.toLocaleString(undefined, {
                                            minimumFractionDigits: 2
                                        });
                                        sumRequested += requested;
                                        sumDelivered += delivered;
                                        sumRemaining += remaining;
                                        sumTotalRequested += totalRequested;
                                        sumTotalDelivered += totalDelivered;
                                    });

                                    document.getElementById("sum-requested").textContent = sumRequested;
                                    document.getElementById("sum-delivered").textContent = sumDelivered;
                                    document.getElementById("sum-remaining").textContent = sumRemaining;
                                    document.getElementById("sum-total-requested").textContent = "₱" + sumTotalRequested.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    });
                                    document.getElementById("sum-total-delivered").textContent = "₱" + sumTotalDelivered.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    });
                                }
                                updateTotals();
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

                                        updateTotals();
                                    });
                                });
                            });
                        </script>



                        <!-- Inspector Info -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="inspected_by" class="form-label">Inspected By</label>
                                <select name="inspected_by" class="form-control" required>
                                    <option value="">-- Select Inspector --</option>
                                    <?php
                                    $inspectors = mysqli_query($conn, "SELECT employee_id, first_name, last_name FROM employee_tbl WHERE position_name = 'INSPECTOR' AND status = 1");
                                    while ($ins = mysqli_fetch_assoc($inspectors)) {
                                        echo "<option value='{$ins['first_name']} {$ins['last_name']}'>{$ins['first_name']} {$ins['last_name']}</option>";
                                    }
                                    ?>
                                </select>
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
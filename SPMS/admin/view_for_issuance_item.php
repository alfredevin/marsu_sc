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
$item_sql = "SELECT pri.item_id, pri.quantity, pri.price, pri.total, pri.delivered_qty, pri.employee_id,
                    e.equipment_name, e.category
             FROM purchase_request_items_tbl pri
             LEFT JOIN equipment_tbl e ON pri.equipment_id = e.equipment_id
             WHERE pri.pr_id = ?";

$stmt2 = mysqli_prepare($conn, $item_sql);
mysqli_stmt_bind_param($stmt2, "i", $pr_id);
mysqli_stmt_execute($stmt2);
$items_result = mysqli_stmt_get_result($stmt2);

if (isset($_POST['save_issue'])) {
    $pr_id = $_POST['pr_id'] ?? 0;
    $issued_by = $_POST['issued_by'];
    $issued_date = $_POST['issued_date'];
    $issue_qtys = $_POST['issue_qty'] ?? [];
    $ics_no = $_POST['ics_no'];


    foreach ($issue_qtys as $item_id => $qty) {

        $emp_sql = "SELECT employee_id FROM purchase_request_items_tbl WHERE item_id = ?";
        $stmt_emp = mysqli_prepare($conn, $emp_sql);
        mysqli_stmt_bind_param($stmt_emp, "i", $item_id);
        mysqli_stmt_execute($stmt_emp);
        $result_emp = mysqli_stmt_get_result($stmt_emp);
        $row_emp = mysqli_fetch_assoc($result_emp);
        $employee_id = $row_emp['employee_id'] ?? null;

        // if (!$employee_id) {
        //     continue; 
        // }

        $sql_item = "UPDATE purchase_request_items_tbl 
                 SET issued_qty = ?, pr_item_status = 3
                 WHERE item_id = ? AND pr_id = ?";
        $stmt_item = mysqli_prepare($conn, $sql_item);
        mysqli_stmt_bind_param($stmt_item, "iii", $qty, $item_id, $pr_id);
        mysqli_stmt_execute($stmt_item);

        $equip_sql = "SELECT e.category 
                  FROM purchase_request_items_tbl pri
                  LEFT JOIN equipment_tbl e ON pri.equipment_id = e.equipment_id
                  WHERE pri.item_id = ?";
        $stmt_eq = mysqli_prepare($conn, $equip_sql);
        mysqli_stmt_bind_param($stmt_eq, "i", $item_id);
        mysqli_stmt_execute($stmt_eq);
        $result_eq = mysqli_stmt_get_result($stmt_eq);
        $equip = mysqli_fetch_assoc($result_eq);

        if ($equip && $equip['category'] === 'Equipment') {
            for ($i = 1; $i <= $qty; $i++) {

                $year = date("Y");
                $sql_count = "SELECT COUNT(*) as total 
              FROM pr_tbl 
              WHERE YEAR(issued_date) = ?";
                $stmt_count = mysqli_prepare($conn, $sql_count);
                mysqli_stmt_bind_param($stmt_count, "i", $year);
                mysqli_stmt_execute($stmt_count);
                $result_count = mysqli_stmt_get_result($stmt_count);
                $row_count = mysqli_fetch_assoc($result_count);
                $count = $row_count['total'] + 1;

                $property_number = $year . '-' . $ics_no . '-' . str_pad($count, 4, "0", STR_PAD_LEFT);




                $insert_pr = "INSERT INTO pr_tbl (property_number, item_id, employee_id) 
                          VALUES (?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $insert_pr);
                mysqli_stmt_bind_param($stmt_insert, "sii", $property_number, $item_id, $employee_id);
                mysqli_stmt_execute($stmt_insert);
            }
        }
    }


    $sql_pr = "UPDATE purchase_request_tbl 
               SET issued_by = ?, issued_date = ?, status = 5
               WHERE pr_id = ?";
    $stmt_pr = mysqli_prepare($conn, $sql_pr);
    mysqli_stmt_bind_param($stmt_pr, "ssi", $issued_by, $issued_date, $pr_id);
    mysqli_stmt_execute($stmt_pr);

    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Issuance Saved!",
                showConfirmButton: true
            }).then(() => {
                window.location.href = "for_issuance_item"; 
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
            <h1>List of Items For Issuance #<?php echo $pr['pr_id']; ?></h1>
            <p>
                This page displays the details and status of all items included in the selected Purchase Request (PR) for issuance.
                Review the list of requested items, their quantities, and prices. You can approve the PR or confirm receipt of items as needed.
            </p>
            <a href="for_issuance_item" class="btn btn-secondary">← Back to List</a>

        </div>


        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Items in this Request</h5>
                    <form method="POST">
                        <input type="hidden" name="pr_id" value="<?= $pr_id; ?>" id="">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity Request</th>
                                    <th>Price (₱)</th>
                                    <th>Total (₱)</th>
                                    <th>Quantity Available</th>
                                    <th>Issue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                                    <tr>


                                        <td><?php echo $item['equipment_name']; ?></td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td>₱<?php echo number_format($item['price'], 2); ?></td>
                                        <td>₱<?php echo number_format($item['total'], 2); ?></td>
                                        <td><?php echo $item['delivered_qty']; ?></td>
                                        <td>
                                            <input type="number"
                                                name="issue_qty[<?php echo $item['item_id']; ?>]"
                                                class="form-control issue-qty"
                                                min="0"
                                                max="<?php echo $item['delivered_qty']; ?>"
                                                required>
                                            <small class="text-danger error-msg" style="display:none;">Exceeds available qty!</small>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const inputs = document.querySelectorAll(".issue-qty");

                                                    inputs.forEach(input => {
                                                        input.addEventListener("input", function() {
                                                            const max = parseInt(input.max);
                                                            const errorMsg = input.nextElementSibling;

                                                            if (parseInt(input.value) > max) {
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
                                        </td>
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
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="issued_by" class="form-label">ICS-NO</label>
                                <input type="number" name="ics_no" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="issued_by" class="form-label">Issued By</label>
                                <input type="text" name="issued_by" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="issued_date" class="form-label">Issued Date</label>
                                <input type="date" name="issued_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" name="save_issue" class="btn btn-success">Save Issuance</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
    <script>
        function confirmApprove(pr_id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to approve this Purchase Request?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, approve it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gumamit ng hidden form submit
                    let form = document.createElement("form");
                    form.method = "POST";
                    form.style.display = "none";

                    let inputId = document.createElement("input");
                    inputId.type = "hidden";
                    inputId.name = "pr_id";
                    inputId.value = pr_id;
                    form.appendChild(inputId);

                    let inputAction = document.createElement("input");
                    inputAction.type = "hidden";
                    inputAction.name = "approve";
                    inputAction.value = "1";
                    form.appendChild(inputAction);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

</body>

</html>
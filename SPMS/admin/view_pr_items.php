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

if (isset($_POST['submit'])) {
    $pr_id = $_POST['pr_id'];
    $received_by = $_POST['received_by'];
    $received_date = $_POST['received_date'];

    $sql = "UPDATE purchase_request_tbl 
            SET received_by = ?, received_date = ? , status = '2'
            WHERE pr_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $received_by, $received_date, $pr_id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Purchase Request Recieved!",
                showConfirmButton: true
            }).then(() => {
                window.location.href = "pending_purchase_request"; 
            });
        });
    </script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


if (isset($_POST['approve'])) {
    $pr_id = $_POST['pr_id'];

    $sql = "UPDATE purchase_request_tbl SET status = 2 WHERE pr_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $pr_id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Approved!",
                text: "The Purchase Request has been approved successfully.",
                showConfirmButton: true
            }).then(() => {
                window.location.href = "pending_purchase_request"; 
            });
        });
        </script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
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
            <a href="pending_purchase_request" class="btn btn-secondary">← Back to List</a>

        </div>


        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Items in this Request</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price (₱)</th>
                                <th>Total (₱)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($item = mysqli_fetch_assoc($items_result)) { ?>
                                <tr>
                                    <td><?php echo $item['equipment_name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td>₱<?php echo number_format($item['price'], 2); ?></td>
                                    <td>₱<?php echo number_format($item['total'], 2); ?></td>
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
                    <?php if ($pr['status'] == 1) { ?>
                        <button type="button" class="btn btn-primary mt-3" onclick="confirmApprove(<?php echo $pr['pr_id']; ?>)">
                            Approve
                        </button>
                    <?php } ?>

                    <?php if (empty($pr['received_by']) && $pr['status'] == 2) { ?>
                        <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            Confirm Received
                        </button>
                    <?php } else if (empty($pr['received_by']) && $pr['status'] == 3) { ?>
                        <div class="alert alert-success mt-3">
                            ✅ Received by <strong><?php echo $pr['received_by']; ?></strong> on
                            <strong><?php echo date("F d, Y", strtotime($pr['received_date'])); ?></strong>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirm Purchase Request Received</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="pr_id" value="<?php echo $pr['pr_id']; ?>">

                        <div class="mb-3">
                            <label for="received_by" class="form-label">Received By</label>
                            <input type="text" name="received_by" id="received_by" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="received_date" class="form-label">Date Received</label>
                            <input type="date" name="received_date" id="received_date" class="form-control"
                                value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-success">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
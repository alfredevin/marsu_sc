<?php
include './../config.php';
include '../template/header.php';

if (!isset($_GET['po_id'])) echo "<script>window.location='admin_receiving.php'</script>";
$po_id = $_GET['po_id'];

// Get PO Details
$q_po = mysqli_query($conn, "
    SELECT po.*, s.supplier_name 
    FROM purchase_order_tbl po
    JOIN supplier_tbl s ON po.supplier_id = s.supplier_id
    WHERE po.po_id = '$po_id'
");
$po = mysqli_fetch_assoc($q_po);

// --- SAVE RECEIVING ---
if (isset($_POST['save_receive'])) {
    $dr_no = $_POST['dr_no'];
    $received_by = $_POST['received_by'];
    $date_received = $_POST['date_received'];

    $update = "UPDATE purchase_order_tbl SET 
               delivery_receipt_no = '$dr_no',
               received_by = '$received_by',
               date_received = '$date_received',
               status = 'Ready for Inspection' 
               WHERE po_id = '$po_id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Received Successfully!',
                    text: 'Delivery recorded. Proceeding to Inspection Module.',
                    confirmButtonColor: '#198754'
                }).then(() => {
                    window.location.href = 'admin_inspection.php'; 
                });
            });
        </script>";
    }
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Receiving Process</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_receiving.php">Pending Deliveries</a></li>
                    <li class="breadcrumb-item active"><?= $po['po_number'] ?></li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <form method="POST">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-box-seam me-2"></i> Items Expected in this Delivery</h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                                    <i class="bi bi-exclamation-circle-fill flex-shrink-0 me-2"></i>
                                    <small>Verify that these items are present in the delivery truck/package.</small>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Item Description</th>
                                                <th class="text-center" width="20%">Qty Ordered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $supp_id = $po['supplier_id'];
                                            $q_items = mysqli_query($conn, "
                                                SELECT e.equipment_name, 
                                                (SELECT SUM(quantity) FROM ppmp_items_tbl WHERE equipment_id = aw.equipment_id) as total_qty
                                                FROM awarded_items_tbl aw
                                                JOIN equipment_tbl e ON aw.equipment_id = e.equipment_id
                                                WHERE aw.supplier_id = '$supp_id'
                                            ");
                                            while ($item = mysqli_fetch_assoc($q_items)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <span class="fw-bold text-dark"><?= $item['equipment_name'] ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-secondary text-white rounded-pill px-3"><?= $item['total_qty'] ?> units</span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow border-top border-success border-4 h-100 sticky-top" style="top: 80px;">
                            <div class="card-body p-4">
                                <h5 class="card-title text-success mb-3"><i class="bi bi-receipt me-2"></i> Receipt Details</h5>

                                <div class="mb-3 p-3 bg-light rounded border text-center">
                                    <small class="text-muted text-uppercase">Supplier</small>
                                    <div class="fw-bold text-dark"><?= $po['supplier_name'] ?></div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" name="dr_no" class="form-control" id="drInput" placeholder="DR No" required>
                                    <label for="drInput">Delivery Receipt (DR) No. <span class="text-danger">*</span></label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="datetime-local" name="date_received" class="form-control" id="dateInput" value="<?= date('Y-m-d\TH:i') ?>" required>
                                    <label for="dateInput">Date & Time Received</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <select name="received_by" class="form-control" id="receiverInput" required>
                                        <option value="" selected disabled>SELECT OFFICER</option>
                                        <?php
                                        $select_employee = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE position_name = 'SUPPLY OFFICER'");
                                        while ($employee = mysqli_fetch_assoc($select_employee)) {
                                        ?>
                                            <option value="<?= $employee['first_name'] . '' . $employee['last_name'] ?>"><?= $employee['first_name'] . ' ' . $employee['last_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="receiverInput">Received By (Supply Officer)</label>
                                </div>

                                <button type="submit" name="save_receive" class="btn btn-success w-100 py-2 fw-bold shadow-sm">
                                    <i class="bi bi-box-arrow-in-down me-2"></i> Confirm Receipt
                                </button>

                                <div class="text-center mt-3">
                                    <a href="admin_receiving.php" class="text-secondary text-decoration-none small">
                                        <i class="bi bi-arrow-left"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
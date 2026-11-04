<?php
include './../config.php';
include '../template/header.php';

if (!isset($_GET['supplier_id'])) {
    echo "<script>window.location.href='admin_po_list.php';</script>";
}
$supp_id = $_GET['supplier_id'];

// --- 1. CHECK IF PO ALREADY EXISTS ---
$check_po = mysqli_query($conn, "SELECT po_number, po_date FROM purchase_order_tbl WHERE supplier_id = '$supp_id'");
$po_exists = false;
$existing_po_number = "";
$existing_po_date = "";

if (mysqli_num_rows($check_po) > 0) {
    $po_row = mysqli_fetch_assoc($check_po);
    $po_exists = true;
    $existing_po_number = $po_row['po_number'];
    $existing_po_date = date("F d, Y h:i A", strtotime($po_row['po_date']));
}

// Get Supplier Info
$s_query = mysqli_query($conn, "SELECT * FROM supplier_tbl WHERE supplier_id='$supp_id'");
$supplier = mysqli_fetch_assoc($s_query);

// --- SAVE PO LOGIC (Only run if not yet exists) ---
if (isset($_POST['save_po']) && !$po_exists) {

    // Recalculate Grand Total
    $grand_total = 0;
    $q_calc = mysqli_query($conn, "
        SELECT aw.awarded_price, (SELECT SUM(quantity) FROM ppmp_items_tbl WHERE equipment_id = aw.equipment_id) as total_qty
        FROM awarded_items_tbl aw
        WHERE aw.supplier_id = '$supp_id'
    ");
    while ($r = mysqli_fetch_assoc($q_calc)) {
        $grand_total += ($r['awarded_price'] * $r['total_qty']);
    }

    $po_number = "PO-" . date("Ymd") . "-" . rand(1000, 9999);

    $stmt = mysqli_prepare($conn, "INSERT INTO purchase_order_tbl (po_number, supplier_id, total_amount, status) VALUES (?, ?, ?, 'Pending Delivery')");
    mysqli_stmt_bind_param($stmt, "sid", $po_number, $supp_id, $grand_total);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'PO Generated Successfully!',
                    text: 'This transaction is now in the Pending Delivery list.',
                    confirmButtonColor: '#198754'
                }).then(() => {
                    window.location.href = 'admin_view_po.php?supplier_id=$supp_id'; 
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
            <h1>Purchase Order Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="admin_po_list.php">PO List</a></li>
                    <li class="breadcrumb-item active"><?= $supplier['supplier_name'] ?></li>
                </ol>
            </nav>
        </div>

        <section class="section">

            <?php if ($po_exists): ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill flex-shrink-0 me-3 fs-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Official PO Generated</h5>
                        <p class="mb-0">PO Number: <strong><?= $existing_po_number ?></strong> &nbsp;|&nbsp; Date Generated: <strong><?= $existing_po_date ?></strong></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-3 fs-4"></i>
                    <div>
                        <strong>Draft Mode:</strong> This Purchase Order is not yet official. Please verify items below then click <strong>"Save & Generate PO"</strong>.
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title">Items Awarded to this Supplier</h5>

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Item Description</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Awarded Unit Cost</th>
                                                <th class="text-end">Total Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $grand_total = 0;
                                            $q_items = mysqli_query($conn, "
                                                SELECT 
                                                    e.equipment_name, 
                                                    aw.awarded_price,
                                                    (SELECT SUM(quantity) FROM ppmp_items_tbl WHERE equipment_id = aw.equipment_id) as total_qty
                                                FROM awarded_items_tbl aw
                                                JOIN equipment_tbl e ON aw.equipment_id = e.equipment_id
                                                WHERE aw.supplier_id = '$supp_id'
                                            ");

                                            if (mysqli_num_rows($q_items) > 0) {
                                                while ($row = mysqli_fetch_assoc($q_items)) {
                                                    $subtotal = $row['awarded_price'] * $row['total_qty'];
                                                    $grand_total += $subtotal;
                                            ?>
                                                    <tr>
                                                        <td><?= $row['equipment_name'] ?></td>
                                                        <td class="text-center"><?= $row['total_qty'] ?></td>
                                                        <td class="text-end">₱<?= number_format($row['awarded_price'], 2) ?></td>
                                                        <td class="text-end fw-bold">₱<?= number_format($subtotal, 2) ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center p-3'>No items found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-secondary border-top border-dark">
                                                <td colspan="3" class="text-end fw-bold">GRAND TOTAL AMOUNT:</td>
                                                <td class="text-end fw-bold text-success fs-5">₱<?= number_format($grand_total, 2) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow border-top border-primary border-4 sticky-top" style="top: 80px;">
                            <div class="card-body p-4">
                                <h5 class="card-title">Supplier Details</h5>

                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item px-0">
                                        <small class="text-muted">Supplier Name</small><br>
                                        <strong><?= $supplier['supplier_name'] ?></strong>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <small class="text-muted">Address</small><br>
                                        <strong><?= $supplier['address'] ?></strong>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <small class="text-muted">Contact Info</small><br>
                                        <strong><?= $supplier['contact_number'] ?? 'N/A' ?></strong><br>
                                        <small><?= $supplier['email'] ?? 'N/A' ?></small>
                                    </li>
                                </ul>

                                <h6 class="fw-bold mt-4 mb-3">Actions</h6>
                                <div class="d-grid gap-2">
                                    <a href="print_po.php?supplier_id=<?= $supp_id ?>" target="_blank" class="btn btn-outline-primary btn-lg">
                                        <i class="bi bi-printer-fill me-2"></i> Print PO Form
                                    </a>

                                    <?php if ($po_exists): ?>
                                        <button type="button" class="btn btn-secondary btn-lg" disabled>
                                            <i class="bi bi-check2-all me-2"></i> PO Generated
                                        </button>
                                        <small class="text-center text-success fw-bold mt-1">
                                            <i class="bi bi-info-circle"></i> Already forwarded to Receiving
                                        </small>
                                    <?php else: ?>
                                        <button type="submit" name="save_po" class="btn btn-success btn-lg" onclick="return confirm('Generate Official Purchase Order? This will be forwarded to Receiving.');">
                                            <i class="bi bi-check-circle-fill me-2"></i> Save & Generate PO
                                        </button>
                                    <?php endif; ?>

                                    <hr>
                                    <a href="admin_po" class="btn btn-light text-secondary">
                                        <i class="bi bi-arrow-left me-2"></i> Back to List
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
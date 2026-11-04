<?php
include './../config.php';
include '../template/header.php';

// Check selected items
if (!isset($_GET['selected_items'])) {
    echo "<script>alert('Please select items first!'); window.location='admin_issuance.php';</script>";
}
$inventory_ids = $_GET['selected_items'];

// --- PROCESS ISSUANCE ---
if (isset($_POST['save_issuance'])) {
    $issued_to = $_POST['issued_to']; // Employee/Dean ID
    $type = $_POST['type']; // PAR or ICS
    $issue_date = date('Y-m-d H:i:s');

    // Generate Tracking No (e.g., PAR-2025-1001)
    $tracking_no = $type . "-" . date('Y') . "-" . rand(1000, 9999);

    // 1. Insert Header
    $stmt = mysqli_prepare($conn, "INSERT INTO issuance_tbl (tracking_no, issued_to_user_id, type, issue_date) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "siss", $tracking_no, $issued_to, $type, $issue_date);
    mysqli_stmt_execute($stmt);
    $issuance_id = mysqli_insert_id($conn);

    // 2. Process Items
    $qtys = $_POST['qty'];
    $props = $_POST['property_no'];
    $inv_ids = $_POST['inv_id'];

    for ($i = 0; $i < count($inv_ids); $i++) {
        $inv_id = $inv_ids[$i];
        $qty_issue = $qtys[$i];
        $prop_no = $props[$i];

        // Insert Item Record
        mysqli_query($conn, "INSERT INTO issuance_items_tbl (issuance_id, inventory_id, quantity, property_number) VALUES ('$issuance_id', '$inv_id', '$qty_issue', '$prop_no')");

        // DEDUCT FROM INVENTORY (Important!)
        mysqli_query($conn, "UPDATE inventory_tbl SET qty_on_hand = qty_on_hand - $qty_issue WHERE inventory_id = '$inv_id'");
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Issuance Successful!',
                text: 'Items have been assigned. Generating $type...',
                confirmButtonColor: '#0d6efd'
            }).then(() => {
                window.open('print_par.php?id=$issuance_id', '_blank'); // Open Print Page
                window.location = 'admin_issuance.php';
            });
        });
    </script>";
}
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Issuance Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_issuance.php">Inventory</a></li>
                    <li class="breadcrumb-item active">Assign Items</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <form method="POST">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title text-primary">Selected Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Item Description</th>
                                                <th width="15%">Qty to Issue</th>
                                                <th width="35%">Property No. / Serial No.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($inventory_ids as $inv_id) {
                                                // Fetch Item Details
                                                $q = mysqli_query($conn, "SELECT i.*, e.equipment_name FROM inventory_tbl i JOIN equipment_tbl e ON i.equipment_id=e.equipment_id WHERE i.inventory_id='$inv_id'");
                                                $row = mysqli_fetch_assoc($q);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= $row['equipment_name'] ?></strong><br>
                                                        <small class="text-muted">Available: <?= $row['qty_on_hand'] ?></small>
                                                        <input type="hidden" name="inv_id[]" value="<?= $inv_id ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="qty[]" class="form-control text-center fw-bold"
                                                            min="1" max="<?= $row['qty_on_hand'] ?>" value="1" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="property_no[]" class="form-control"
                                                            placeholder="Ex. 2025-<?= rand(100, 999) ?>" required>
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
                        <div class="card shadow border-top border-primary border-4 sticky-top" style="top: 80px;">
                            <div class="card-body p-4">
                                <h5 class="card-title">Receiver Information</h5>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Issue To (End-User)</label>
                                    <select name="issued_to" class="form-select" required>
                                        <option value="">-- Select Personnel --</option>
                                        <?php
                                        // Fetch Employees/Deans (Combine tables or select from employee_tbl)
                                        $emp_q = mysqli_query($conn, "SELECT * FROM employee_tbl");
                                        while ($e = mysqli_fetch_assoc($emp_q)) {
                                            echo "<option value='{$e['employee_id']}'>{$e['first_name']} {$e['last_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Form Type</label>
                                    <select name="type" class="form-select">
                                        <option value="PAR">PAR (Property Acknowledgment Receipt)</option>
                                        <option value="ICS">ICS (Inventory Custodian Slip)</option>
                                    </select>
                                    <div class="form-text text-muted small">
                                        Use <strong>PAR</strong> for items > ₱50,000.<br>
                                        Use <strong>ICS</strong> for items < ₱50,000.
                                            </div>
                                    </div>

                                    <hr>
                                    <button type="submit" name="save_issuance" class="btn btn-primary w-100 btn-lg shadow">
                                        <i class="bi bi-printer-fill me-2"></i> Issue & Print
                                    </button>
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
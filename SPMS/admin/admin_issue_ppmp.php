<?php
include './../config.php';
include '../template/header.php';

if (!isset($_GET['ppmp_id'])) echo "<script>window.location='admin_issuance_list.php'</script>";
$ppmp_id = $_GET['ppmp_id'];

// Get Dept Info
$q_head = mysqli_query($conn, "SELECT dept.department_name, p.year FROM ppmp_tbl p JOIN dean_tbl d ON p.dean_id=d.dean_id JOIN department_tbl dept ON d.department_id=dept.department_id WHERE p.ppmp_id='$ppmp_id'");
$dept = mysqli_fetch_assoc($q_head);
// --- HANDLE BULK ISSUANCE ---
if (isset($_POST['bulk_issue'])) {
    if (!isset($_POST['selected_items'])) {
        echo "<script>alert('Please select at least one item to issue.');</script>";
    } else {
        $selected_indices = $_POST['selected_items']; // Indices of selected checkboxes

        // 1. Group items by Employee & Form Type (Para isang PAR lang per tao)
        $grouped_items = [];

        foreach ($selected_indices as $index) {
            $emp_id = $_POST['employee_id'][$index];
            $type = $_POST['type'][$index];
            $key = $emp_id . '_' . $type; // Unique Group Key

            if (!isset($grouped_items[$key])) {
                $grouped_items[$key] = [];
            }

            $grouped_items[$key][] = [
                'inv_id' => $_POST['inventory_id'][$index],
                'qty' => intval($_POST['qty'][$index]), // Get quantity entered by user
                'ppmp_item_id' => $_POST['ppmp_item_id'][$index]
            ];
        }

        $print_ids = []; // Store IDs for printing later

        // 2. Process Each Group
        foreach ($grouped_items as $key => $items) {
            list($emp_id, $type) = explode('_', $key);

            // A. Create ONE Issuance Header per Group (PAR/ICS)
            $track = $type . "-" . date('Y') . "-" . rand(1000, 9999);
            mysqli_query($conn, "INSERT INTO issuance_tbl (tracking_no, issued_to_user_id, type) VALUES ('$track', '$emp_id', '$type')");
            $issue_id = mysqli_insert_id($conn);
            $print_ids[] = $issue_id;

            // B. Get Last Property Number Count (For the year)
            $year = date('Y');
            $q_count = mysqli_query($conn, "SELECT COUNT(*) as c FROM issuance_items_tbl WHERE property_number LIKE '$year-%'");
            $r_count = mysqli_fetch_assoc($q_count);
            $current_count = $r_count['c'] + 1; // Start counter

            // C. Loop through items in this group
            foreach ($items as $item) {
                $inv_id = $item['inv_id'];
                $qty = $item['qty']; // The quantity input by user (e.g., 2)
                $pid = $item['ppmp_item_id'];

                // LOOP X TIMES based on Quantity
                // Example: If Qty = 2, loop runs twice.
                for ($i = 0; $i < $qty; $i++) {
                    // Generate Unique Property No.
                    $prop_no = $year . "-" . str_pad($current_count, 4, "0", STR_PAD_LEFT);
                    // Example: 2025-0001, 2025-0002

                    // Insert Individual Record
                    mysqli_query($conn, "INSERT INTO issuance_items_tbl (issuance_id, inventory_id, quantity, property_number) VALUES ('$issue_id', '$inv_id', '1', '$prop_no')");

                    // Increment counter for next item
                    $current_count++;
                }

                // D. Update Inventory (Deduct Total Qty)
                mysqli_query($conn, "UPDATE inventory_tbl SET qty_on_hand = qty_on_hand - $qty WHERE inventory_id='$inv_id'");

                // E. Mark PPMP Item as Issued
                mysqli_query($conn, "UPDATE ppmp_items_tbl SET is_issued = 1 WHERE id = '$pid'");
            }
        }
        $q_check = mysqli_query($conn, "
            SELECT 
                (SELECT COUNT(*) FROM ppmp_items_tbl WHERE ppmp_id = '$ppmp_id') as total_items,
                (SELECT COUNT(*) FROM ppmp_items_tbl WHERE ppmp_id = '$ppmp_id' AND is_issued = 1) as issued_items
        ");
        $chk = mysqli_fetch_assoc($q_check);

       // --- HANAPIN ANG DULONG PART NG IYONG BULK ISSUE LOGIC (Pagkatapos ng loop) ---
// ... (iyong existing queries) ...

        if ($chk['total_items'] > 0 && $chk['total_items'] == $chk['issued_items']) {
            mysqli_query($conn, "UPDATE ppmp_tbl SET status = 5 WHERE ppmp_id = '$ppmp_id'");
            $msg_suffix = " PPMP is now fully completed.";
        } else {
            $msg_suffix = "";
        }

        // BAGONG KODA: I-convert ang array ng IDs into string para sa URL
        $ids_to_print = implode(',', $print_ids);

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ 
                    icon: 'success', 
                    title: 'Issuance Successful!', 
                    text: 'Items issued and property numbers generated.', 
                    showCancelButton: true,
                    confirmButtonText: 'Print Forms Now',
                    cancelButtonText: 'Later',
                    confirmButtonColor: '#198754'
                }).then((result) => { 
                    if (result.isConfirmed) {
                        // Magbubukas ng bagong tab para sa mga form
                        window.open('print_issuance_form.php?ids=$ids_to_print', '_blank');
                        window.location.href = 'admin_issuance_list.php'; 
                    } else {
                        window.location.href = 'admin_issuance_list.php'; 
                    }
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
            <h1>Bulk Issuance</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_issuance_list.php">List</a></li>
                    <li class="breadcrumb-item active"><?= $dept['department_name'] ?></li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary">Items Requested (PPMP <?= $dept['year'] ?>)</h5>

                    <form method="POST">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle border">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%"><input type="checkbox" id="checkAll" class="form-check-input" style="transform: scale(1.2);"></th>
                                        <th>Item Requested</th>
                                        <th>End-User</th>
                                        <th class="text-center">Stock</th>
                                        <th width="10%">Qty</th>
                                        <th width="15%">Form Type</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "
                                        SELECT pi.id as ppmp_item_id, pi.quantity as qty_needed, pi.is_issued,
                                               e.equipment_name, e.equipment_id,
                                               emp.first_name, emp.last_name, emp.employee_id,
                                               (SELECT SUM(qty_on_hand) FROM inventory_tbl WHERE equipment_id = pi.equipment_id) as current_stock,
                                               (SELECT inventory_id FROM inventory_tbl WHERE equipment_id = pi.equipment_id AND qty_on_hand > 0 LIMIT 1) as inv_id_ref
                                        FROM ppmp_items_tbl pi
                                        JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id
                                        JOIN employee_tbl emp ON pi.employee_id = emp.employee_id
                                        WHERE pi.ppmp_id = '$ppmp_id'
                                    ";
                                    $result = mysqli_query($conn, $query);
                                    $index = 0;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $has_stock = ($row['current_stock'] > 0);
                                        $is_issued = ($row['is_issued'] == 1);
                                        $inv_id = $row['inv_id_ref'];

                                        // Row State: Gray out if issued or no stock
                                        $row_class = ($is_issued) ? 'table-success text-muted' : (($has_stock) ? '' : 'table-secondary text-muted');
                                        $disabled = ($is_issued || !$has_stock) ? 'disabled' : '';
                                    ?>
                                        <tr class="<?= $row_class ?>">
                                            <td class="text-center">
                                                <?php if (!$is_issued && $has_stock): ?>
                                                    <input type="checkbox" name="selected_items[]" value="<?= $index ?>" class="form-check-input item-chk" style="transform: scale(1.2);">
                                                <?php elseif ($is_issued): ?>
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                <?php else: ?>
                                                    <i class="bi bi-dash-circle text-muted"></i>
                                                <?php endif; ?>

                                                <input type="hidden" name="ppmp_item_id[<?= $index ?>]" value="<?= $row['ppmp_item_id'] ?>">
                                                <input type="hidden" name="inventory_id[<?= $index ?>]" value="<?= $inv_id ?>">
                                                <input type="hidden" name="employee_id[<?= $index ?>]" value="<?= $row['employee_id'] ?>">
                                            </td>

                                            <td>
                                                <span class="fw-bold"><?= $row['equipment_name'] ?></span><br>
                                                <small>Requested: <?= $row['qty_needed'] ?></small>
                                            </td>

                                            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>

                                            <td class="text-center">
                                                <?php if ($has_stock): ?>
                                                    <span class="badge bg-primary rounded-pill"><?= $row['current_stock'] ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">0</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <input type="number" name="qty[<?= $index ?>]" class="form-control form-control-sm text-center fw-bold"
                                                    min="1" max="<?= min($row['qty_needed'], $row['current_stock']) ?>"
                                                    value="<?= min($row['qty_needed'], $row['current_stock']) ?>" <?= $disabled ?>>
                                            </td>

                                            <td>
                                                <select name="type[<?= $index ?>]" class="form-select form-select-sm" <?= $disabled ?>>
                                                    <option value="PAR">PAR</option>
                                                    <option value="ICS">ICS</option>
                                                </select>
                                            </td>

                                            <td class="text-center">
                                                <?php if ($is_issued): ?>
                                                    <span class="badge bg-success"><i class="bi bi-check2-all"></i> Issued</span>
                                                <?php elseif (!$has_stock): ?>
                                                    <span class="badge bg-danger">No Stock</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php $index++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded border">
                            <small class="text-muted"><i class="bi bi-info-circle-fill"></i> Property Numbers generated automatically.</small>
                            <button type="submit" name="bulk_issue" class="btn btn-primary px-5 shadow" onclick="return confirm('Generate Issuance?');">
                                <i class="bi bi-check-circle-fill me-2"></i> Issue Selected
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('.item-chk').forEach(chk => {
                if (!chk.disabled) chk.checked = this.checked;
            });
        });
    </script>
</body>

</html>
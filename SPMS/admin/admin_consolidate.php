<?php
include './../config.php';
include '../template/header.php';

// --- 1. UNIFIED DECISION LOGIC (Approve or Reject) ---
if (isset($_POST['submit_decision'])) {
    $ppmp_id = $_POST['ppmp_id'];
    $action = $_POST['action_type'];
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    if ($action === 'approve') {
        // I-process muna ang mga Custom Items para pumasok sa Equipment Table
        $q_custom = mysqli_query($conn, "SELECT * FROM ppmp_items_tbl WHERE ppmp_id = '$ppmp_id' AND equipment_id IS NULL");
        while ($custom = mysqli_fetch_assoc($q_custom)) {
            $item_entry_id = $custom['id'];
            $custom_name = mysqli_real_escape_string($conn, $custom['custom_item_name']);
            $custom_price = $custom['price'];

            $insert_eq = "INSERT INTO equipment_tbl (equipment_name, price, unit_id, description, status, category) 
                          VALUES ('$custom_name', '$custom_price', 1, 'Added via PPMP Approval', 1, 'Uncategorized')";
            
            if (mysqli_query($conn, $insert_eq)) {
                $new_id = mysqli_insert_id($conn);
                // I-link ang item sa bagong gawang equipment ID
                mysqli_query($conn, "UPDATE ppmp_items_tbl SET equipment_id = '$new_id', custom_item_name = NULL WHERE id = '$item_entry_id'");
            }
        }

        // I-update ang PPMP Status sa 2 (Approved/Consolidated)
        $stmt = $conn->prepare("UPDATE ppmp_tbl SET status = 2, remarks = ? WHERE ppmp_id = ?");
        $icon = 'success';
        $title = 'PPMP Approved!';
        $redirect = 'admin_consolidate.php';
    } else {
        // I-update ang PPMP Status sa 10 (Rejected)
        $stmt = $conn->prepare("UPDATE ppmp_tbl SET status = 10, remarks = ? WHERE ppmp_id = ?");
        $icon = 'error';
        $title = 'PPMP Rejected';
        $redirect = 'admin_consolidate.php';
    }

    $stmt->bind_param("si", $remarks, $ppmp_id);
    if ($stmt->execute()) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', () => { 
                Swal.fire({ icon: '$icon', title: '$title', timer: 2000, showConfirmButton: false })
                .then(() => window.location.href='$redirect'); 
            });
        </script>";
    }
}

// --- 2. HANDLE FINALIZE FOR RFQ (Status 3) ---
if (isset($_POST['save_all_rfq'])) {
    if (mysqli_query($conn, "UPDATE ppmp_tbl SET status = 3 WHERE status = 2")) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', () => { 
                Swal.fire({ icon: 'success', title: 'APP Finalized!', text: 'Items are now ready for RFQ.', timer: 2000, showConfirmButton: false })
                .then(() => window.location.href='admin_consolidate.php'); 
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
            <h1>Procurement Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">Consolidation</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <ul class="nav nav-tabs nav-tabs-bordered mb-4" id="ppmpTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">
                        <i class="bi bi-clock-history me-2"></i>Pending Requests
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#consolidated">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>APP Master List
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rejected">
                        <i class="bi bi-x-circle me-2 text-danger"></i>Rejected
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-2">
                
                <div class="tab-pane fade show active" id="pending">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="card-title">Pending Submissions</h5>
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Department</th>
                                        <th>Date Submitted</th>
                                        <th class="text-end">Grand Total</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $all_ppmp = []; 
                                    $q = mysqli_query($conn, "SELECT p.*, d.department_name FROM ppmp_tbl p 
                                                              JOIN dean_tbl dn ON p.dean_id = dn.dean_id 
                                                              JOIN department_tbl d ON dn.department_id = d.department_id 
                                                              WHERE p.status = 1 ORDER BY p.date_created DESC");
                                    while ($row = mysqli_fetch_assoc($q)) {
                                        $all_ppmp[] = $row;
                                    ?>
                                        <tr>
                                            <td class="fw-bold text-primary"><?= $row['department_name'] ?></td>
                                            <td><?= date("M d, Y", strtotime($row['date_created'])) ?></td>
                                            <td class="text-end">₱<?= number_format($row['grand_total'], 2) ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#view_<?= $row['ppmp_id'] ?>">Review Items</button>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#decision_<?= $row['ppmp_id'] ?>">Take Action</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="consolidated">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Annual Procurement Plan (APP)</h5>
                                <form method="POST">
                                    <button type="submit" name="save_all_rfq" class="btn btn-primary shadow-sm" onclick="return confirm('Finalize APP? This will move items to the RFQ phase.')">Finalize & Generate RFQ</button>
                                </form>
                            </div>
                            <table class="table table-bordered align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Item Description</th>
                                        <th class="text-center">Total Qty</th>
                                        <th class="text-end">Total Estimated Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q_con = mysqli_query($conn, "SELECT e.equipment_name, SUM(pi.quantity) as total_qty, SUM(pi.total_amount) as total_cost 
                                                                  FROM ppmp_items_tbl pi 
                                                                  JOIN ppmp_tbl p ON pi.ppmp_id = p.ppmp_id 
                                                                  JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id 
                                                                  WHERE p.status = 2 GROUP BY e.equipment_id");
                                    while ($con = mysqli_fetch_assoc($q_con)) { ?>
                                        <tr>
                                            <td><?= $con['equipment_name'] ?></td>
                                            <td class="text-center fw-bold"><?= $con['total_qty'] ?></td>
                                            <td class="text-end fw-bold text-primary">₱<?= number_format($con['total_cost'], 2) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="rejected">
                    <div class="card shadow-sm border-0 border-top border-danger border-3">
                        <div class="card-body p-4">
                            <h5 class="card-title text-danger">Returned Submissions</h5>
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Department</th>
                                        <th>Reason for Rejection</th>
                                        <th class="text-end">Budget</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q_rej = mysqli_query($conn, "SELECT p.*, d.department_name FROM ppmp_tbl p 
                                                                  JOIN dean_tbl dn ON p.dean_id = dn.dean_id 
                                                                  JOIN department_tbl d ON dn.department_id = d.department_id 
                                                                  WHERE p.status = 10 ORDER BY p.date_created DESC");
                                    while ($rej = mysqli_fetch_assoc($q_rej)) {
                                        $all_ppmp[] = $rej; 
                                    ?>
                                        <tr>
                                            <td class="fw-bold"><?= $rej['department_name'] ?></td>
                                            <td class="text-danger small italic"><?= $rej['remarks'] ?></td>
                                            <td class="text-end">₱<?= number_format($rej['grand_total'], 2) ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#view_<?= $rej['ppmp_id'] ?>">View History</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php foreach ($all_ppmp as $p): ?>

        <div class="modal fade" id="view_<?= $p['ppmp_id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PPMP Details: <?= $p['department_name'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="p-3 bg-light border-bottom">
                            <small class="text-muted fw-bold">DEAN'S JUSTIFICATION:</small>
                            <p class="mb-0 small">"<?= $p['reason'] ?>"</p>
                        </div>
                        <table class="table table-sm mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3">Item Name</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end pe-3">Unit Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pid = $p['ppmp_id'];
                                $q_it = mysqli_query($conn, "SELECT pi.*, e.equipment_name FROM ppmp_items_tbl pi LEFT JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id WHERE pi.ppmp_id = '$pid'");
                                while ($it = mysqli_fetch_assoc($q_it)) {
                                    $name = empty($it['equipment_id']) ? $it['custom_item_name'] : $it['equipment_name'];
                                    echo "<tr>
                                            <td class='ps-3'>$name</td>
                                            <td class='text-center'>{$it['quantity']}</td>
                                            <td class='text-end pe-3'>₱" . number_format($it['price'], 2) . "</td>
                                          </tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="decision_<?= $p['ppmp_id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-secondary text-white transition-all" id="header_<?= $p['ppmp_id'] ?>">
                        <h5 class="modal-title">Action for <?= $p['department_name'] ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="ppmp_id" value="<?= $p['ppmp_id'] ?>">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Choose Decision:</label>
                                <select name="action_type" class="form-select form-select-lg" required onchange="updateModalUI(this, '<?= $p['ppmp_id'] ?>')">
                                    <option value="" selected disabled>-- Select Action --</option>
                                    <option value="approve">Approve & Consolidate</option>
                                    <option value="reject">Reject & Return to Dean</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold" id="label_remarks_<?= $p['ppmp_id'] ?>">Remarks:</label>
                                <textarea name="remarks" id="remarks_<?= $p['ppmp_id'] ?>" class="form-control" rows="3" placeholder="Enter instructions or reason for rejection..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit_decision" id="btn_<?= $p['ppmp_id'] ?>" class="btn btn-primary" disabled>Confirm Action</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
    function updateModalUI(select, id) {
        const header = document.getElementById('header_' + id);
        const btn = document.getElementById('btn_' + id);
        const remarks = document.getElementById('remarks_' + id);
        const label = document.getElementById('label_remarks_' + id);

        btn.disabled = false;

        if (select.value === 'approve') {
            // Change UI to Green (Success)
            header.className = "modal-header bg-success text-white";
            btn.className = "btn btn-success w-100";
            btn.innerText = "Confirm Approval";
            remarks.required = false;
            label.innerText = "Remarks (Optional):";
            remarks.placeholder = "Add a note for the department (e.g. 'Priority for Q1')...";
        } else if (select.value === 'reject') {
            // Change UI to Red (Danger)
            header.className = "modal-header bg-danger text-white";
            btn.className = "btn btn-danger w-100";
            btn.innerText = "Confirm Rejection";
            remarks.required = true;
            label.innerText = "Reason for Rejection (Required):";
            remarks.placeholder = "Explain why this was rejected so the Dean can fix it...";
        }
    }
    </script>
</body>
</html>
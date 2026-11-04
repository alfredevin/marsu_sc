<?php
include './../config.php';
include '../template/header.php';

// GET LOGGED IN EMPLOYEE ID (Mock ID for demo)
// $my_id = $_SESSION['employee_id']; 
$my_id = 1;

// --- GET STATS ---
$q_val = mysqli_query($conn, "
    SELECT 
        COUNT(ii.id) as item_count,
        SUM(inv.unit_cost * ii.quantity) as total_val 
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    WHERE i.issued_to_user_id = '$my_id' AND i.type = 'PAR'
");
$stats = mysqli_fetch_assoc($q_val);
?>

<style>
    /* Custom Status Styles */
    .status-good {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    .status-bad {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    /* Card hover effect */
    .info-card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle mb-4">
            <div class="row">
                <div class="col">
                    <h1>My Equipment (PPE)</h1>
                    <p class="text-muted">Manage high-value properties (PAR) assigned to your custody.</p>

                </div>

            </div>

        </div>

        <section class="section">

            <div class="row mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card info-card border-start border-primary border-4 shadow-sm">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 me-3">
                                <i class="bi bi-box-seam fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Total Items</small>
                                <h4 class="fw-bold text-dark mb-0"><?= $stats['item_count'] ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card info-card border-start border-danger border-4 shadow-sm">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 me-3">
                                <i class="bi bi-wallet2 fs-3"></i>
                            </div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Total Liability</small>
                                <h4 class="fw-bold text-dark mb-0">₱<?= number_format($stats['total_val'], 2) ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-primary m-0"><i class="bi bi-list-check me-2"></i> Accountability List</h5>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-end  ">
                                <a href="employee_report_form.php" class="btn btn-danger shadow-sm">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Report Lost or Damaged Items
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Property No.</th>
                                    <th>Item Description</th>
                                    <th>Date Acquired</th>
                                    <th class="text-end">Value</th>
                                    <th class="text-center">Condition</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch items
                                $query = "
                                    SELECT ii.id, ii.property_number, ii.status, ii.remarks,
                                           e.equipment_name, u.unit_name, inv.unit_cost,
                                           i.issue_date
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    LEFT JOIN unit_tbl u ON e.unit_id = u.unit_id
                                    WHERE i.issued_to_user_id = '$my_id' AND i.type = 'PAR'
                                    ORDER BY i.issue_date DESC
                                ";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $status = $row['status'] ?? 'Serviceable';

                                        // Visual Logic
                                        if ($status == 'Serviceable') {
                                            $badge = '<span class="badge status-good"><i class="bi bi-check-circle-fill me-1"></i> Good</span>';
                                            $row_opacity = "";
                                        } else {
                                            $badge = '<span class="badge status-bad"><i class="bi bi-exclamation-triangle-fill me-1"></i> ' . $status . '</span>';
                                            $row_opacity = "opacity-75 bg-light"; // Dim row if lost/damaged
                                        }
                                ?>
                                        <tr class="<?= $row_opacity ?>">
                                            <td class="ps-4 fw-bold text-dark">
                                                <i class="bi bi-qr-code text-secondary me-2"></i> <?= $row['property_number'] ?>
                                            </td>
                                            <td>
                                                <span class="fw-bold"><?= $row['equipment_name'] ?></span><br>
                                                <small class="text-muted"><?= $row['unit_name'] ?></small>
                                            </td>
                                            <td>
                                                <div class="small text-muted"><i class="bi bi-calendar3"></i> <?= date("M d, Y", strtotime($row['issue_date'])) ?></div>
                                            </td>
                                            <td class="text-end fw-bold text-secondary">₱<?= number_format($row['unit_cost'], 2) ?></td>
                                            <td class="text-center"><?= $badge ?></td>

                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center p-5 text-muted'>You have no equipment accountabilities.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function reportIssue(propNo, itemName) {
            Swal.fire({
                title: 'Report Issue',
                html: `Reporting: <strong>${itemName}</strong> <br> Property No: <span class="text-primary">${propNo}</span>`,
                icon: 'warning',
                input: 'select',
                inputOptions: {
                    'Damaged': 'Item is Damaged / Broken',
                    'Lost': 'Item is Lost / Missing',
                    'Return': 'Request to Return / Surrender'
                },
                inputPlaceholder: 'Select the problem...',
                showCancelButton: true,
                confirmButtonText: 'Submit Report',
                confirmButtonColor: '#dc3545',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    return !value && 'You need to select an issue type!'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you would typically send an AJAX request to save the report
                    Swal.fire({
                        title: 'Report Submitted!',
                        text: 'The Supply Office has been notified.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
</body>

</html>
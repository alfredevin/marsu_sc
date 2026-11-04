<?php
include './../config.php';

// Validate Employee ID
if (!isset($_GET['employee_id'])) {
    echo "<script>window.location='admin_issued_items.php';</script>";
    exit;
}
$employee_id = $_GET['employee_id'];

// 1. GET EMPLOYEE INFO
$q_emp = mysqli_query($conn, "
    SELECT e.*, d.department_name, e.position_name 
    FROM employee_tbl e 
    JOIN department_tbl d ON e.department_id = d.department_id 
    WHERE e.employee_id = '$employee_id'
");
$employee = mysqli_fetch_assoc($q_emp);
$employee_name = $employee['first_name'] . ' ' . $employee['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1>Property Accountability</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin_issued_items.php">Issued Items</a></li>
                        <li class="breadcrumb-item active"><?= $employee_name ?></li>
                    </ol>
                </nav>
            </div>

            <div>
                <a href="print_par.php?emp_id=<?= $employee_id ?>" target="_blank" class="btn btn-primary btn-sm shadow-sm me-2">
                    <i class="bi bi-printer-fill me-1"></i> Print PAR Form
                </a>
                <a href="admin_issued_items.php" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <section class="section">

            <div class="card mb-4 border-top border-primary border-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-md bg-light rounded-circle p-3 text-primary me-3">
                            <i class="bi bi-person-vcard fs-1"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0"><?= $employee_name ?></h4>
                            <p class="text-muted mb-0"><?= $employee['position_name'] ?> | <?= $employee['department_name'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-pc-display-horizontal"></i> Issued Equipment List</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Property No.</th>
                                    <th>Description</th>
                                    <th>Date Issued</th>
                                    <th>PAR / ICS No.</th>
                                    <th class="text-end">Unit Value</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "
                                    SELECT 
                                        ii.id as item_id,
                                        ii.property_number, 
                                        ii.status as item_status,
                                        i.issue_date, i.type, i.tracking_no,
                                        e.equipment_name,
                                        inv.unit_cost
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    WHERE i.issued_to_user_id = '$employee_id'
                                    ORDER BY i.issue_date DESC
                                ";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Status Badge Logic
                                    $status = $row['item_status'] ?? 'Serviceable';

                                    if ($status == 'Serviceable') $badge = '<span class="badge bg-success">Serviceable</span>';
                                    elseif ($status == 'Missing') $badge = '<span class="badge bg-danger">Missing</span>';
                                    elseif ($status == 'Returned') $badge = '<span class="badge bg-secondary">Returned</span>';
                                    else $badge = '<span class="badge bg-warning text-dark">' . $status . '</span>';
                                ?>
                                    <tr>
                                        <td><span class="badge bg-dark bg-opacity-75"><?= $row['property_number'] ?></span></td>
                                        <td><span class="fw-bold text-dark"><?= $row['equipment_name'] ?></span></td>
                                        <td><?= date("M d, Y", strtotime($row['issue_date'])) ?></td>
                                        <td><span class="badge border text-dark"><?= $row['tracking_no'] ?></span></td>
                                        <td class="text-end">₱<?= number_format($row['unit_cost'], 2) ?></td>
                                        <td class="text-center"><?= $badge ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
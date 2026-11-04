<?php
include './../config.php';

// Fetch employees and join department info
$sql = "SELECT e.*, d.department_name 
        FROM employee_tbl e
        JOIN department_tbl d ON e.department_id = d.department_id
        ORDER BY e.last_name ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<style>
    /* Profile Image Style */
    .profile-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #dee2e6;
    }

    /* Hover effect for rows */
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle mb-4">
            <h1>Property Accountability Monitoring</h1>
            <p class="text-muted">
                List of employees and their current equipment accountability status.
            </p>
        </div>

        <section class="section">
            <div class="card shadow-sm border-top border-primary border-4">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary"><i class="bi bi-people-fill"></i> Employee List</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center">Photo</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th class="text-center">Equipment Count</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    $employee_id = $row['employee_id'];

                                    // Count Issued Items (Using the new table issuance_tbl logic)
                                    // Assuming issuance_items_tbl links to issuance_tbl which links to employee
                                    $count_sql = "
                                        SELECT COUNT(*) as total 
                                        FROM issuance_items_tbl ii
                                        JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                        WHERE i.issued_to_user_id = '$employee_id'
                                    ";
                                    $count_res = mysqli_query($conn, $count_sql);
                                    $count_row = mysqli_fetch_assoc($count_res);
                                    $total_equip = $count_row['total'];

                                    // Profile Pic Logic
                                    $photo = !empty($row['photo']) ? "./uploads/" . $row['photo'] : "https://ui-avatars.com/api/?name=" . urlencode($row['first_name']) . "&background=random";
                                ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= $photo ?>" class="profile-img" alt="Profile">
                                        </td>

                                        <td>
                                            <div class="fw-bold text-dark">
                                                <?= $row['last_name'] . ', ' . $row['first_name'] ?>
                                            </div>
                                            <div class="small text-muted">ID: <?= $row['employee_no'] ?></div>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <?= $row['department_name'] ?>
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <?php if ($total_equip > 0): ?>
                                                <span class="badge bg-primary rounded-pill px-3"><?= $total_equip ?> items</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary rounded-pill px-3">None</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="view_par.php?employee_id=<?= $employee_id; ?>" class="btn btn-sm btn-outline-primary shadow-sm">
                                                <i class="bi bi-eye"></i> View Accountability
                                            </a>
                                        </td>
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
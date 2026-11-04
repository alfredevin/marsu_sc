<?php
include './../config.php';

// Select specific columns to avoid ambiguity and improve performance
$sql = "SELECT employee_tbl.*, department_tbl.department_name 
        FROM employee_tbl
        INNER JOIN department_tbl ON department_tbl.department_id = employee_tbl.department_id
        ORDER BY employee_tbl.employee_no ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<style>
    /* Custom style for the profile picture to ensure it stays a perfect circle */
    .profile-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #e9ecef;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1>Employee Management</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Employee List</li>
                    </ol>
                </nav>
            </div>
            
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">All Employees</h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-borderless datatable align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Contact Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    // Logic for Default Image if photo is empty
                                    $photo = !empty($row['photo']) ? "./uploads/" . $row['photo'] : "https://ui-avatars.com/api/?name=" . urlencode($row['first_name']) . "&background=random";
                                ?>
                                    <tr>
                                        <td width="60">
                                            <img src="<?php echo htmlspecialchars($photo); ?>" class="profile-img" alt="Profile">
                                        </td>

                                        <td>
                                            <div class="fw-bold text-dark">
                                                <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?>
                                            </div>
                                            <div class="small text-muted">
                                                ID: <?php echo htmlspecialchars($row['employee_no']); ?>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <?php echo htmlspecialchars($row['department_name']); ?>
                                            </span>
                                        </td>

                                        <td><?php echo htmlspecialchars($row['position_name']); ?></td>

                                        <td>
                                            <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" class="text-primary text-decoration-none">
                                                <i class="bi bi-envelope"></i> <?php echo htmlspecialchars($row['email']); ?>
                                            </a>
                                            <div class="small text-muted mt-1">
                                                <i class="bi bi-phone"></i> <?php echo htmlspecialchars($row['contact_number']); ?>
                                            </div>
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
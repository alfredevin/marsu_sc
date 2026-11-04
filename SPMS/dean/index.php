<?php
include './../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>
    <?php

    // Assume Session Variables
    $user_id = 0; // Dean's ID

    // --- 1. FETCH METRICS ---

    // A. Personal Accountability
    $q_personal = mysqli_query($conn, "
    SELECT COUNT(ii.id) as total_items, SUM(inv.unit_cost * ii.quantity) as total_value
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    WHERE i.issued_to_user_id = '$user_id'
");
    $personal = mysqli_fetch_assoc($q_personal);

    // B. Department-wide Accountability
    $q_dept = mysqli_query($conn, "
    SELECT COUNT(ii.id) as total_items, SUM(inv.unit_cost * ii.quantity) as total_value
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    WHERE emp.department_id = '$dept_id'
");
    $dept_stats = mysqli_fetch_assoc($q_dept);

    // C. Pending PPMPs (If any)
    $q_ppmp = mysqli_query($conn, "SELECT COUNT(*) as total FROM ppmp_tbl WHERE dean_id = '$user_id' AND status = 0"); // 0 = Draft
    $pending_ppmp = mysqli_fetch_assoc($q_ppmp)['total'];

    // --- 2. DATA FOR CHARTS ---
    $status_labels = [];
    $status_data = [];
    $q_status = mysqli_query($conn, "
    SELECT ii.status, COUNT(*) as count 
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
    WHERE emp.department_id = '$dept_id'
    GROUP BY ii.status
");
    while ($row = mysqli_fetch_assoc($q_status)) {
        $status_labels[] = $row['status'] ? $row['status'] : 'Serviceable';
        $status_data[] = $row['count'];
    }
    ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dean's Dashboard</h1>
            <p class="text-muted">Overview of your personal accountability and department assets.</p>
        </div>

        <section class="section dashboard">

            <div class="row">

                <!-- <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card border-bottom border-primary border-4">
                        <div class="card-body">
                            <h5 class="card-title">My Accountability</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $personal['total_items'] ?> Items</h6>
                                    <span class="text-muted small pt-2 ps-1">Total Value: ₱<?= number_format($personal['total_value']) ?></span>
                                </div>
                            </div>
                            <a href="dean_my_accountability.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div> -->

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card border-bottom border-success border-4">
                        <div class="card-body">
                            <h5 class="card-title">Department Assets</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-building-check"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $dept_stats['total_items'] ?> Items</h6>
                                    <span class="text-muted small pt-2 ps-1">Total Value: ₱<?= number_format($dept_stats['total_value']) ?></span>
                                </div>
                            </div>
                            <a href="dean_my_accountability.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card customers-card border-bottom border-warning border-4">
                        <div class="card-body">
                            <h5 class="card-title">Draft PPMPs</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $pending_ppmp ?> Pending</h6>
                                    <span class="text-muted small pt-2 ps-1">Drafts to Submit</span>
                                </div>
                            </div>
                            <a href="create_ppmp.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Department Equipment Status</h5>
                            <div style="height: 300px; display: flex; justify-content: center;">
                                <canvas id="deptChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Recent Items Received</h5>
                            <div class="activity">
                                <?php
                                $q_recent = mysqli_query($conn, "
                                    SELECT ii.property_number, e.equipment_name, emp.first_name, emp.last_name, i.issue_date
                                    FROM issuance_items_tbl ii
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    WHERE emp.department_id = '$dept_id'
                                    ORDER BY i.issue_date DESC
                                    LIMIT 5
                                ");

                                if (mysqli_num_rows($q_recent) > 0) {
                                    echo '<div class="list-group list-group-flush">';
                                    while ($row = mysqli_fetch_assoc($q_recent)) {
                                        echo '
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-bold text-dark">' . $row['equipment_name'] . '</div>
                                                <small class="text-muted">Issued to: ' . $row['first_name'] . ' ' . $row['last_name'] . '</small>
                                            </div>
                                            <span class="badge bg-light text-secondary">' . date("M d", strtotime($row['issue_date'])) . '</span>
                                        </div>';
                                    }
                                    echo '</div>';
                                } else {
                                    echo '<p class="text-muted text-center my-4">No recent issuances found.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#deptChart'), {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($status_labels); ?>,
                    datasets: [{
                        label: 'Count',
                        data: <?php echo json_encode($status_data); ?>,
                        backgroundColor: ['#198754', '#dc3545', '#ffc107', '#6c757d'],
                        hoverOffset: 4
                    }]
                }
            });
        });
    </script>
</body>

</html>
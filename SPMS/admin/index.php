<?php
include './../config.php';

// --- 1. FETCH KEY METRICS ---

// A. Pending PPMPs (For Approval)
$q_ppmp = mysqli_query($conn, "SELECT COUNT(*) as total FROM ppmp_tbl WHERE status = 1");
$ppmp_count = mysqli_fetch_assoc($q_ppmp)['total'];

// B. Pending Deliveries (For Receiving)
$q_po = mysqli_query($conn, "SELECT COUNT(*) as total FROM purchase_order_tbl WHERE status = 'Pending Delivery'");
$po_count = mysqli_fetch_assoc($q_po)['total'];

// C. Low Stock Items (Critical)
$q_low = mysqli_query($conn, "SELECT COUNT(*) as total FROM inventory_tbl WHERE qty_on_hand <= 5 AND qty_on_hand > 0");
$low_stock_count = mysqli_fetch_assoc($q_low)['total'];

// D. Total Asset Value (Monetary)
$q_value = mysqli_query($conn, "SELECT SUM(qty_on_hand * unit_cost) as total FROM inventory_tbl");
$total_value = mysqli_fetch_assoc($q_value)['total'];

// --- 2. DATA FOR CHARTS ---

// Chart 1: Property Status Breakdown (Serviceable, Missing, etc.)
$status_labels = [];
$status_data = [];
$q_status = mysqli_query($conn, "SELECT status, COUNT(*) as count FROM issuance_items_tbl GROUP BY status");
while ($row = mysqli_fetch_assoc($q_status)) {
    $status_labels[] = $row['status'] ? $row['status'] : 'Serviceable'; // Default if null
    $status_data[] = $row['count'];
}

// Chart 2: Top 5 Departments by Equipment Count
$dept_labels = [];
$dept_data = [];
$q_dept = mysqli_query($conn, "
    SELECT d.department_name, COUNT(ii.id) as equip_count
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN employee_tbl e ON i.issued_to_user_id = e.employee_id
    JOIN department_tbl d ON e.department_id = d.department_id
    GROUP BY d.department_id
    ORDER BY equip_count DESC
    LIMIT 5
");
while ($row = mysqli_fetch_assoc($q_dept)) {
    $dept_labels[] = $row['department_name'];
    $dept_data[] = $row['equip_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <p class="text-muted">Overview of Supply and Property Management System</p>
        </div>

        <section class="section dashboard">

            <div class="row">

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card border-bottom border-primary border-4">
                        <div class="card-body">
                            <h5 class="card-title">Pending PPMPs</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $ppmp_count ?></h6>
                                    <span class="text-muted small pt-2 ps-1">To Approve</span>
                                </div>
                            </div>
                            <a href="admin_consolidate.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card revenue-card border-bottom border-success border-4">
                        <div class="card-body">
                            <h5 class="card-title">Incoming Delivery</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $po_count ?></h6>
                                    <span class="text-muted small pt-2 ps-1">POs Sent</span>
                                </div>
                            </div>
                            <a href="admin_receiving.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card customers-card border-bottom border-warning border-4">
                        <div class="card-body">
                            <h5 class="card-title">Low Stock Items</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $low_stock_count ?></h6>
                                    <span class="text-muted small pt-2 ps-1">Need Reorder</span>
                                </div>
                            </div>
                            <a href="admin_inventory_list.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card border-bottom border-info border-4">
                        <div class="card-body">
                            <h5 class="card-title">Total Asset Value</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>₱<?= number_format($total_value / 1000000, 1) ?>M</h6>
                                    <span class="text-muted small pt-2 ps-1">Current Inventory</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Asset Condition Overview</h5>
                            <canvas id="statusChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Top 5 Depts with Most Equipment</h5>
                            <canvas id="deptChart" style="max-height: 300px;"></canvas>
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

            // --- CHART 1: STATUS PIE CHART ---
            new Chart(document.querySelector('#statusChart'), {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($status_labels); ?>,
                    datasets: [{
                        label: 'Count',
                        data: <?php echo json_encode($status_data); ?>,
                        backgroundColor: [
                            '#198754', // Green (Serviceable)
                            '#dc3545', // Red (Missing)
                            '#ffc107', // Yellow (For Condemn)
                            '#6c757d' // Gray (Condemned)
                        ],
                        hoverOffset: 4
                    }]
                }
            });

            // --- CHART 2: DEPARTMENT BAR CHART ---
            new Chart(document.querySelector('#deptChart'), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($dept_labels); ?>,
                    datasets: [{
                        label: 'Issued Items',
                        data: <?php echo json_encode($dept_data); ?>,
                        backgroundColor: '#0d6efd',
                        borderColor: '#0d6efd',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>

</body>

</html>
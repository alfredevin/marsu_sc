<?php
include './../config.php';
include '../template/header.php'; 

// GET LOGGED IN EMPLOYEE ID
// $my_id = $_SESSION['employee_id']; 
$my_id = 1; 

// --- 1. GET ACCOUNTABILITY STATS ---
// Total Items & Value (PAR + ICS)
$q_stats = mysqli_query($conn, "
    SELECT 
        COUNT(ii.id) as total_items,
        SUM(inv.unit_cost * ii.quantity) as total_liability
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    WHERE i.issued_to_user_id = '$my_id'
");
$stats = mysqli_fetch_assoc($q_stats);

// Count Pending Reports (Issues reported but not yet resolved)
$q_rep = mysqli_query($conn, "SELECT COUNT(*) as c FROM property_issue_reports_tbl WHERE reported_by_id = '$my_id' AND report_status = 'Pending'");
$pending_reports = mysqli_fetch_assoc($q_rep)['c'];

// Recent Issuances (Last 5 items received)
$q_recent = mysqli_query($conn, "
    SELECT e.equipment_name, i.issue_date, i.type 
    FROM issuance_items_tbl ii
    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
    WHERE i.issued_to_user_id = '$my_id'
    ORDER BY i.issue_date DESC LIMIT 5
");
?>

<style>
    .card-welcome {
        background: linear-gradient(45deg, #0d6efd, #0a58ca);
        color: white;
    }
    .card-icon-white {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <p class="text-muted">Welcome back! Here is the summary of your property accountabilities.</p>
        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-8">
                    
                    <div class="card card-welcome shadow-sm mb-4 border-0">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold mb-1">Hello, User!</h3>
                                <p class="mb-0 opacity-75">You are currently accountable for <strong><?= $stats['total_items'] ?> items</strong>.</p>
                            </div>
                            <i class="bi bi-shield-check display-1 opacity-25"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card info-card border-start border-danger border-4 shadow-sm">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 me-3">
                                        <i class="bi bi-wallet2 fs-3"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted text-uppercase fw-bold">Total Liability</small>
                                        <h4 class="fw-bold text-dark mb-0">₱<?= number_format($stats['total_liability'], 2) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card info-card border-start border-warning border-4 shadow-sm">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 me-3">
                                        <i class="bi bi-exclamation-circle fs-3"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted text-uppercase fw-bold">Pending Reports</small>
                                        <h4 class="fw-bold text-dark mb-0"><?= $pending_reports ?></h4>
                                        <small class="text-muted">Issues under review</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <h5 class="text-primary fw-bold mb-3">Quick Actions</h5>
                        </div>
                        <div class="col-md-4">
                            <a href="employee_equipment.php" class="card text-decoration-none hover-card shadow-sm text-center p-4 border-0">
                                <i class="bi bi-pc-display text-primary fs-1 mb-2"></i>
                                <h6 class="fw-bold text-dark">Check Equipment</h6>
                                <small class="text-muted">View PAR Items</small>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="employee_issuance_history.php" class="card text-decoration-none hover-card shadow-sm text-center p-4 border-0">
                                <i class="bi bi-file-earmark-text text-success fs-1 mb-2"></i>
                                <h6 class="fw-bold text-dark">My Documents</h6>
                                <small class="text-muted">Print ICS/PAR</small>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="employee_report_form.php" class="card text-decoration-none hover-card shadow-sm text-center p-4 border-0">
                                <i class="bi bi-flag text-danger fs-1 mb-2"></i>
                                <h6 class="fw-bold text-dark">Report Issue</h6>
                                <small class="text-muted">Lost or Damaged?</small>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h6 class="m-0 fw-bold text-secondary">Recent Acquisitions</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <?php if(mysqli_num_rows($q_recent) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($q_recent)): 
                                        $badge = ($row['type'] == 'PAR') ? 'bg-primary' : 'bg-warning text-dark';    
                                    ?>
                                    <div class="list-group-item py-3">
                                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                            <span class="badge <?= $badge ?> rounded-pill" style="font-size: 0.65rem;"><?= $row['type'] ?></span>
                                            <small class="text-muted"><?= date("M d, Y", strtotime($row['issue_date'])) ?></small>
                                        </div>
                                        <p class="mb-1 fw-bold text-dark"><?= $row['equipment_name'] ?></p>
                                        <small class="text-success"><i class="bi bi-check-circle-fill"></i> Received</small>
                                    </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="text-center p-5 text-muted">
                                        <i class="bi bi-box-seam fs-1 opacity-25"></i>
                                        <p class="mt-2">No items issued recently.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center py-3">
                            <a href="employee_issuance_history.php" class="text-primary text-decoration-none small fw-bold">View All History <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>
</html>
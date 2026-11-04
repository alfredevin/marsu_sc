<?php
include './../config.php';
include '../template/header.php';
?>

<style>
    /* Modern Stepper (Read-Only) */
    .track-container {
        padding: 20px 0;
    }

    .stepper-horizontal {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px;
    }

    .stepper-horizontal::before {
        content: "";
        position: absolute;
        top: 25px;
        left: 5%;
        width: 90%;
        height: 2px;
        background-color: #e9ecef;
        z-index: 0;
    }

    .step {
        position: relative;
        z-index: 1;
        text-align: center;
        flex: 1;
    }

    .step-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #fff;
        border: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        color: #adb5bd;
    }

    .step.active .step-icon {
        border-color: #0d6efd;
        color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
    }

    .step.completed .step-icon {
        background-color: #198754;
        border-color: #198754;
        color: #fff;
    }

    .step-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
    }

    .step.active .step-label {
        color: #0d6efd;
    }

    .step.completed .step-label {
        color: #198754;
    }

    /* Card Styling */
    .app-card {
        transition: transform 0.2s;
        border-radius: 12px;
        overflow: hidden;
    }

    .app-card:hover {
        transform: translateY(-5px);
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Procurement Tracker</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">APP Status</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <?php
                // Kinukuha ang data per year/batch
                $query = "SELECT year, 
                                 COUNT(ppmp_id) as dept_count, 
                                 SUM(grand_total) as total_budget, 
                                 MAX(status) as current_status 
                          FROM ppmp_tbl 
                          WHERE status >= 3 
                          GROUP BY year 
                          ORDER BY year DESC";
                $res = mysqli_query($conn, $query);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $status = $row['current_status'];
                        $year = $row['year'];

                        // Kalkulasyon para sa Progress Bar (%)
                        $progress = 25; // Default for RFQ
                        if ($status == 4) $progress = 50;
                        if ($status == 5) $progress = 75;
                        if ($status == 6) $progress = 100;
                ?>
                        <div class="col-md-12 mb-4">
                            <div class="card shadow-sm app-card border-0">
                                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="fw-bold mb-0 text-dark">Batch Year: <?= $year ?></h4>
                                        <small class="text-muted"><?= $row['dept_count'] ?> Departments Consolidated</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="text-muted small d-block">Total APP Budget</span>
                                        <h4 class="fw-bold text-success mb-0">₱<?= number_format($row['total_budget'], 2) ?></h4>
                                    </div>
                                </div>

                                <div class="card-body px-4 pb-4">
                                    <div class="progress mb-4" style="height: 8px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated <?= ($status == 6) ? 'bg-success' : 'bg-primary' ?>"
                                            role="progressbar" style="width: <?= $progress ?>%"></div>
                                    </div>

                                    <div class="track-container">
                                        <div class="stepper-horizontal">
                                            <div class="step <?= ($status >= 3) ? 'completed' : '' ?> <?= ($status == 3) ? 'active' : '' ?>">
                                                <div class="step-icon"><i class="bi bi-file-earmark-spreadsheet"></i></div>
                                                <div class="step-label">RFQ Process</div>
                                            </div>
                                            <div class="step <?= ($status >= 4) ? 'completed' : '' ?> <?= ($status == 4) ? 'active' : '' ?>">
                                                <div class="step-icon"><i class="bi bi-people"></i></div>
                                                <div class="step-label">Bidding</div>
                                            </div>
                                            <div class="step <?= ($status >= 5) ? 'completed' : '' ?> <?= ($status == 5) ? 'active' : '' ?>">
                                                <div class="step-icon"><i class="bi bi-truck"></i></div>
                                                <div class="step-label">Delivery</div>
                                            </div>
                                            <div class="step <?= ($status >= 6) ? 'completed' : '' ?> <?= ($status == 6) ? 'active' : '' ?>">
                                                <div class="step-icon"><i class="bi bi-check-all"></i></div>
                                                <div class="step-label">Completed</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Status: <strong><?= ($status == 6) ? 'Items successfully delivered and recorded.' : 'Procurement is currently in progress.' ?></strong>
                                        </span>
                                        <a href="view_app_details?year=<?= $year ?>" class="btn btn-sm btn-outline-secondary">
                                            View Breakdown <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-12 text-center py-5">
                        <img src="../assets/img/empty-box.png" alt="No data" style="width: 100px; opacity: 0.5;">
                        <h5 class="text-muted mt-3">No active procurement tracking found.</h5>
                        <p class="small text-secondary">Consolidate approved PPMPs to start tracking.</p>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>



    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
</body>

</html>
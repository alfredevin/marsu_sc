<?php
include './../config.php';
include '../template/header.php';

// Kunin ang year mula sa URL
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Query para sa Summary Cards
$summary_query = "SELECT 
                    COUNT(DISTINCT p.dean_id) as total_depts,
                    SUM(pi.total_amount) as total_budget,
                    COUNT(pi.id) as total_items
                  FROM ppmp_tbl p
                  JOIN ppmp_items_tbl pi ON p.ppmp_id = pi.ppmp_id
                  WHERE p.year = '$year' AND p.status >= 3";
$summary_res = mysqli_query($conn, $summary_query);
$summary = mysqli_fetch_assoc($summary_res);
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>APP Details for <?= $year ?></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item"><a href="admin_app_tracking">APP Tracker</a></li>
                        <li class="breadcrumb-item active">Breakdown</li>
                    </ol>
                </nav>
            </div>
            <div class="btn-group">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-printer"></i> Print Report
                </button>
                <a href="admin_app_tracking" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to Tracker
                </a>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card info-card sales-card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Total Budget <span>| <?= $year ?></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light">
                                    <i class="bi bi-currency-dollar text-success"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-success">₱<?= number_format($summary['total_budget'], 2) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card info-card revenue-card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Departments <span>| Consolidated</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light">
                                    <i class="bi bi-building text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $summary['total_depts'] ?> Units</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card info-card customers-card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Item Lines <span>| Total</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning-light">
                                    <i class="bi bi-list-check text-warning"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $summary['total_items'] ?> Items</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-body p-4">
                    <h5 class="card-title"><i class="bi bi-collection-fill me-2"></i> Consolidated Items List</h5>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Item Description</th>
                                    <th class="text-center">Total Quantity</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Total Estimated Cost</th>
                                    <th class="text-center">Department Breakdown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_items = "SELECT 
                                                    e.equipment_id, e.equipment_name, e.price,
                                                    SUM(pi.quantity) as total_qty, 
                                                    SUM(pi.total_amount) as total_cost
                                                FROM ppmp_items_tbl pi
                                                JOIN ppmp_tbl p ON pi.ppmp_id = p.ppmp_id
                                                JOIN equipment_tbl e ON pi.equipment_id = e.equipment_id
                                                WHERE p.year = '$year' AND p.status >= 3
                                                GROUP BY pi.equipment_id
                                                ORDER BY e.equipment_name ASC";
                                $res_items = mysqli_query($conn, $query_items);
                                $count = 1;

                                while ($item = mysqli_fetch_assoc($res_items)) {
                                    $eid = $item['equipment_id'];
                                ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td class="fw-bold"><?= $item['equipment_name'] ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill"><?= $item['total_qty'] ?></span>
                                        </td>
                                        <td class="text-end text-muted small">₱<?= number_format($item['price'], 2) ?></td>
                                        <td class="text-end fw-bold text-dark">₱<?= number_format($item['total_cost'], 2) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="collapse" data-bs-target="#dept_<?= $eid ?>">
                                                <i class="bi bi-chevron-down"></i> Details
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="dept_<?= $eid ?>">
                                        <td colspan="6" class="bg-light p-0">
                                            <div class="px-5 py-3">
                                                <h6 class="small fw-bold">Requested by:</h6>
                                                <table class="table table-sm table-borderless mb-0 small">
                                                    <?php
                                                    $q_dept = "SELECT dept.department_name, pi.quantity
                                                           FROM ppmp_items_tbl pi
                                                           JOIN ppmp_tbl p ON pi.ppmp_id = p.ppmp_id
                                                           JOIN dean_tbl d ON p.dean_id = d.dean_id
                                                           JOIN department_tbl dept ON d.department_id = dept.department_id
                                                           WHERE pi.equipment_id = '$eid' AND p.year = '$year'";
                                                    $res_dept = mysqli_query($conn, $q_dept);
                                                    while ($d = mysqli_fetch_assoc($res_dept)) {
                                                        echo "<tr>
                                                            <td><i class='bi bi-arrow-return-right me-2 text-secondary'></i> {$d['department_name']}</td>
                                                            <td class='fw-bold' width='20%'>{$d['quantity']} pcs</td>
                                                          </tr>";
                                                    }
                                                    ?>
                                                </table>
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
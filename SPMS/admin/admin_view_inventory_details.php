<?php
include './../config.php';
include '../template/header.php';

if (!isset($_GET['id'])) echo "<script>window.location='admin_inventory_history.php'</script>";
$conduct_id = $_GET['id'];

// 1. Get Header Info
$q_header = mysqli_query($conn, "
    SELECT h.*, d.department_name 
    FROM inventory_conduct_tbl h
    JOIN department_tbl d ON h.department_id = d.department_id
    WHERE h.conduct_id = '$conduct_id'
");
$header = mysqli_fetch_assoc($q_header);
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Inventory Details</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin_inventory_history.php">History</a></li>
                        <li class="breadcrumb-item active"><?= $header['department_name'] ?></li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="admin_inventory_history.php" class="btn btn-light btn-sm border"><i class="bi bi-arrow-left"></i> Back</a>
            </div>
        </div>

        <section class="section">

            <div class="card mb-3">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted text-uppercase">Department</small>
                            <h5 class="fw-bold text-primary"><?= $header['department_name'] ?></h5>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted text-uppercase">Date Conducted</small>
                            <h5 class="fw-bold text-dark"><?= date("F d, Y", strtotime($header['date_conducted'])) ?></h5>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted text-uppercase">Conducted By</small>
                            <h5 class="fw-bold text-dark"><?= $header['conducted_by'] ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title">Inventory Findings</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Property No.</th>
                                    <th>Item Description</th>
                                    <th>Accountable Officer</th>
                                    <th class="text-center">Status (As of Date)</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // 2. Get Items Snapshot
                                // Join with Issuance Items to get Property No & Name details
                                // BUT get the STATUS from inventory_conduct_items_tbl (History)
                                $q_items = "
                                    SELECT log.recorded_status, log.recorded_remarks,
                                           ii.property_number,
                                           e.equipment_name,
                                           emp.first_name, emp.last_name
                                    FROM inventory_conduct_items_tbl log
                                    JOIN issuance_items_tbl ii ON log.issuance_item_id = ii.id
                                    JOIN issuance_tbl i ON ii.issuance_id = i.issuance_id
                                    JOIN inventory_tbl inv ON ii.inventory_id = inv.inventory_id
                                    JOIN equipment_tbl e ON inv.equipment_id = e.equipment_id
                                    JOIN employee_tbl emp ON i.issued_to_user_id = emp.employee_id
                                    WHERE log.conduct_id = '$conduct_id'
                                    ORDER BY emp.last_name ASC
                                ";
                                $result = mysqli_query($conn, $q_items);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Color coding based on recorded status
                                    $stat = $row['recorded_status'];
                                    $badge_class = "bg-secondary";
                                    if ($stat == 'Serviceable') $badge_class = "bg-success";
                                    if ($stat == 'Missing') $badge_class = "bg-danger";
                                    if ($stat == 'For Condemn') $badge_class = "bg-warning text-dark";
                                ?>
                                    <tr>
                                        <td class="fw-bold"><?= $row['property_number'] ?></td>
                                        <td><?= $row['equipment_name'] ?></td>
                                        <td>
                                            <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $badge_class ?>"><?= $stat ?></span>
                                        </td>
                                        <td>
                                            <small class="text-muted"><?= $row['recorded_remarks'] ?></small>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-muted small fst-italic">
                        This is a generated report based on the physical inventory count conducted on the date specified above.
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <style>
        /* Print Styles */
        @media print {

            header,
            aside,
            .btn,
            .pagetitle nav {
                display: none !important;
            }

            #main {
                margin-left: 0;
                padding: 0;
            }

            .card {
                border: none !important;
                shadow: none !important;
            }
        }
    </style>
</body>

</html>
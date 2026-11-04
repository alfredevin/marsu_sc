<?php
include './../config.php';
include '../template/header.php';
?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase Request Records</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">PR History</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title">Departmental Purchase Requests</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>PR Number</th>
                                    <th>Department</th>
                                    <th>Date Requested</th>
                                    <th class="text-end">Total Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Kunin lahat ng PPMP na status 2 pataas (Approved)
                                $q = mysqli_query($conn, "SELECT p.*, d.department_name, dn.first_name, dn.last_name 
                                                          FROM ppmp_tbl p 
                                                          JOIN dean_tbl dn ON p.dean_id = dn.dean_id 
                                                          JOIN department_tbl d ON dn.department_id = d.department_id 
                                                          WHERE p.status >= 2 ORDER BY p.date_created DESC");
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $pr_no = "PR-" . date('Y', strtotime($row['date_created'])) . "-" . str_pad($row['ppmp_id'], 4, '0', STR_PAD_LEFT);
                                    ?>
                                    <tr>
                                        <td class="fw-bold text-primary"><?= $pr_no ?></td>
                                        <td><?= $row['department_name'] ?></td>
                                        <td><?= date("M d, Y", strtotime($row['date_created'])) ?></td>
                                        <td class="text-end fw-bold">₱<?= number_format($row['grand_total'], 2) ?></td>
                                        <td class="text-center">
                                            <a href="print_pr.php?id=<?= $row['ppmp_id'] ?>" target="_blank"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-printer me-1"></i> Print PR
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
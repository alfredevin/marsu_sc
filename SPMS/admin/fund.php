<?php
include './../config.php';

// --- HELPER: SweetAlert ---
function showAlert($icon, $title)
{
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            });
            Toast.fire({ icon: "' . $icon . '", title: "' . $title . '" });
        });
    </script>';
}

// --- BATCH ADD ALLOCATION ---
if (isset($_POST['save_allocations'])) {
    $year = $_POST['year'];
    $dean_ids = $_POST['dean_id'];
    $amounts = $_POST['amount'];

    if (!empty($dean_ids) && !empty($amounts)) {
        $successCount = 0;

        // Prepare statements outside loop for performance
        $check = $conn->prepare("SELECT allocation_id FROM allocated_funds_tbl WHERE year = ? AND dean_id = ?");
        $stmt = $conn->prepare("INSERT INTO allocated_funds_tbl (year, dean_id, amount) VALUES (?, ?, ?)");

        for ($i = 0; $i < count($dean_ids); $i++) {
            $d_id = $dean_ids[$i];
            $amt = $amounts[$i];

            // Check duplicate
            $check->bind_param("si", $year, $d_id);
            $check->execute();
            $check->store_result();

            if ($check->num_rows == 0 && $amt > 0) {
                // Insert
                $stmt->bind_param("sid", $year, $d_id, $amt);
                if ($stmt->execute()) {
                    $successCount++;
                }
            }
        }
        $check->close();
        $stmt->close();

        if ($successCount > 0) {
            showAlert('success', "Successfully allocated funds for Year $year!");
        } else {
            showAlert('warning', 'No new records added (Duplicates or Zero amount).');
        }
    }
}

// --- UPDATE SINGLE ALLOCATION ---
if (isset($_POST['update_allocation'])) {
    $id = $_POST['allocation_id'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("UPDATE allocated_funds_tbl SET amount = ? WHERE allocation_id = ?");
    $stmt->bind_param("di", $amount, $id);

    if ($stmt->execute()) {
        showAlert('success', 'Budget Updated Successfully!');
    } else {
        showAlert('error', 'Update Failed.');
    }
}

// --- FETCH ALL RAW DATA FOR JS ---
// We fetch all details now and store in a JS variable to make the "View" button instant
$all_data_query = "
    SELECT f.allocation_id, f.year, f.amount, 
           d.first_name, d.last_name, 
           dept.department_name 
    FROM allocated_funds_tbl f
    JOIN dean_tbl d ON f.dean_id = d.dean_id
    LEFT JOIN department_tbl dept ON d.department_id = dept.department_id
    ORDER BY dept.department_name ASC
";
$all_data_result = mysqli_query($conn, $all_data_query);
$json_data = [];
while ($row = mysqli_fetch_assoc($all_data_result)) {
    $json_data[] = $row;
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
            <h1>Fund Allocation</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Budget Years</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-12 mb-4">
                    <div class="card shadow border-0">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h4 class="card-title m-0 text-primary fw-bold">Fiscal Year Management</h4>
                                <p class="text-muted m-0">Create new budget years and assign allocations to departments.</p>
                            </div>
                            <button class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#addAllocationModal">
                                <i class="bi bi-plus-lg me-2"></i>New Fiscal Year
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Budget Overview</h5>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="15%">Fiscal Year</th>
                                            <th class="text-center">Total Deans Funded</th>
                                            <th class="text-end" width="25%">Total Budget Allocated</th>
                                            <th class="text-center" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Group Query: Sums up the total money per year
                                        $group_query = "
                                            SELECT year, SUM(amount) as total_budget, COUNT(dean_id) as total_deans 
                                            FROM allocated_funds_tbl 
                                            GROUP BY year 
                                            ORDER BY year DESC
                                        ";
                                        $group_result = mysqli_query($conn, $group_query);

                                        if (mysqli_num_rows($group_result) > 0) {
                                            while ($row = mysqli_fetch_assoc($group_result)) {
                                        ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <span class="badge bg-primary fs-6"><?php echo $row['year']; ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="fw-bold text-dark"><?php echo $row['total_deans']; ?></span> Departments
                                                    </td>
                                                    <td class="text-end">
                                                        <h6 class="m-0 fw-bold text-success">₱ <?php echo number_format($row['total_budget'], 2); ?></h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                                            onclick="viewYearDetails('<?php echo $row['year']; ?>')">
                                                            <i class="bi bi-eye me-1"></i> View Details
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="4" class="text-center py-4 text-muted">No budget allocations found.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <div class="modal fade" id="addAllocationModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-wallet2 me-2"></i>Create New Budget Year</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body bg-light">

                        <div class="bg-white p-3 rounded shadow-sm mb-3">
                            <label class="form-label fw-bold text-secondary text-uppercase small">Fiscal Year</label>
                            <input type="number" name="year" class="form-control fw-bold text-primary fs-4" value="<?php echo date('Y'); ?>" min="2020" max="2099" required>
                        </div>

                        <h6 class="fw-bold mb-3 mt-4 text-secondary">Department Allocations</h6>

                        <?php
                        $deans = mysqli_query($conn, "SELECT d.*, dept.department_name FROM dean_tbl d LEFT JOIN department_tbl dept ON d.department_id = dept.department_id WHERE d.d_status = 1 ORDER BY dept.department_name ASC");

                        if (mysqli_num_rows($deans) > 0) {
                            while ($d = mysqli_fetch_assoc($deans)) {
                        ?>
                                <div class="card mb-2 border-0 shadow-sm">
                                    <div class="card-body p-2 d-flex align-items-center">
                                        <div class="flex-grow-1 ps-2">
                                            <input type="hidden" name="dean_id[]" value="<?php echo $d['dean_id']; ?>">
                                            <span class="badge bg-light text-dark border mb-1"><?php echo $d['department_name']; ?></span>
                                            <div class="fw-bold small"><?php echo $d['first_name'] . ' ' . $d['last_name']; ?></div>
                                        </div>

                                        <div class="input-group w-50">
                                            <span class="input-group-text bg-white border-end-0">₱</span>
                                            <input type="number" name="amount[]" class="form-control text-end fw-bold border-start-0" placeholder="0.00" step="0.01" min="0">
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<div class="alert alert-warning">No Active Deans found.</div>';
                        }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save_allocations" class="btn btn-primary px-4">Save Allocations</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold" id="viewModalTitle">Year Details</h5>
                        <small class="text-muted">Breakdown of allocated funds per department</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 align-middle">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th class="ps-4">Department / Dean</th>
                                    <th class="text-end pe-4">Allocated Budget</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="viewModalBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" style="z-index: 1060;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-warning text-dark py-2">
                    <h6 class="modal-title fw-bold">Update Amount</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="allocation_id" id="edit_id">
                        <div class="mb-2">
                            <label class="small text-muted mb-1" id="edit_dean_name">Dean Name</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" name="amount" id="edit_amount" class="form-control fw-bold text-end" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="submit" name="update_allocation" class="btn btn-warning btn-sm w-100">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>

    <script>
        // Store PHP array into JavaScript Constant
        const allData = <?php echo json_encode($json_data); ?>;

        function viewYearDetails(year) {
            // 1. Update Title
            document.getElementById('viewModalTitle').innerText = "Fiscal Year " + year + " Breakdown";

            // 2. Filter Data for specific year
            const yearData = allData.filter(item => item.year == year);
            const tbody = document.getElementById('viewModalBody');
            tbody.innerHTML = ''; // Clear previous data

            if (yearData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3" class="text-center py-3">No data available</td></tr>';
            } else {
                let total = 0;
                // 3. Build Rows
                yearData.forEach(item => {
                    total += parseFloat(item.amount);
                    const row = `
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">${item.department_name}</div>
                                <div class="small text-muted">${item.first_name} ${item.last_name}</div>
                            </td>
                            <td class="text-end pe-4 fw-bold text-success">
                                ₱ ${parseFloat(item.amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-light btn-sm border" onclick="openEditModal(${item.allocation_id}, '${item.first_name} ${item.last_name}', ${item.amount})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });

                // Add Total Row
                tbody.innerHTML += `
                    <tr class="table-primary border-top border-primary">
                        <td class="ps-4 fw-bold text-end">TOTAL ALLOCATION:</td>
                        <td class="text-end pe-4 fw-bold">₱ ${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                        <td></td>
                    </tr>
                `;
            }

            // 4. Show Modal
            new bootstrap.Modal(document.getElementById('viewDetailsModal')).show();
        }

        function openEditModal(id, name, amount) {
            // Hide View Modal temporarily (optional, or just stack them)
            // bootstrap.Modal.getInstance(document.getElementById('viewDetailsModal')).hide();

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_dean_name').innerText = name;
            document.getElementById('edit_amount').value = amount;

            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>
</body>

</html>
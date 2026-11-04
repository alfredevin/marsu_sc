<?php
include './../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle mb-3">
            <h1>List of My Equipment </h1>
            <p>This page displays the list of equipment assigned to you.</p>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Equipment</h5>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>

                                <th>Status</th>
                                <th>Property No</th>
                                <th>Equipment Name</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            $sql = "SELECT *, pr_tbl.status AS pStatus
                            FROM pr_tbl
                            LEFT JOIN purchase_request_items_tbl ON purchase_request_items_tbl.item_id = pr_tbl.item_id
                            LEFT JOIN equipment_tbl ON equipment_tbl.equipment_id = purchase_request_items_tbl.equipment_id
                            LEFT JOIN unit_tbl ON unit_tbl.unit_id = equipment_tbl.unit_id 
                            WHERE pr_tbl.employee_id = '$employee_id'";

                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Map status code to label
                                $status = '';
                                switch ($row['pStatus']) {
                                    case 1:
                                        $status = 'Serviceable';
                                        break;
                                    case 2:
                                        $status = 'Missing';
                                        break;
                                    case 3:
                                        $status = 'For Condemned';
                                        break;
                                    case 4:
                                        $status = 'Condemned';
                                        break;
                                    default:
                                        $status = 'Unknown';
                                }
                            ?>
                                <tr>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $row['property_number']; ?></td>
                                    <td><?php echo $row['equipment_name']; ?></td>
                                    <td><?php echo $row['unit_name']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td>
                                        <?php
                                        if ($row['pStatus'] == 1) {
                                            echo ' <a href="#"
                                            class="btn btn-danger btn-sm report-btn"
                                            data-id=' . $row['item_id'] . '>
                                            REPORT
                                        </a>';
                                        } elseif ($row['pStatus'] == 2) {
                                            echo 'This Equipment is Missing';
                                        } elseif ($row['pStatus'] == 3) {
                                            echo 'This Equipment is <br>For Condemned';
                                        } elseif ($row['pStatus'] == 4) {
                                            echo 'This Equipment is  <br> Already Condemned';
                                        }
                                        ?>

                                    </td>
                                </tr>
                            <?php
                            }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <?php include '../template/script.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reportButtons = document.querySelectorAll(".report-btn");

            reportButtons.forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    const itemId = this.getAttribute("data-id");

                    Swal.fire({
                        title: 'Update Status',
                        input: 'select',
                        inputOptions: {
                            2: 'Missing',
                            3: 'For Condemned'
                        },
                        inputPlaceholder: 'Select status',
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        preConfirm: (status) => {
                            return fetch('update_status.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: `item_id=${itemId}&status=${status}`
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (!data.success) {
                                        throw new Error(data.message || 'Update failed');
                                    }
                                    return data;
                                })
                                .catch(error => {
                                    Swal.showValidationMessage(error.message);
                                });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('Updated!', 'The status has been updated.', 'success')
                                .then(() => location.reload());
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
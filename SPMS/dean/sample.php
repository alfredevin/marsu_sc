<?php
include './../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipment_ids = $_POST['equipment_id'];
    $employee_ids = $_POST['employee_id'];
    $prices = $_POST['price'];
    $quantities = $_POST['quantity'];
    $dean_id = $_POST['dean_id'];
    $totals = $_POST['total'];
    $grand_total = array_sum($totals);

    $year = date("Y");
    $trackingNumbers = "PR-" . $year . "-" . str_pad(4, "0", STR_PAD_LEFT);

    $stmt = mysqli_prepare($conn, "INSERT INTO purchase_request_tbl (request_date, grand_total,tracking_number,dean_id) VALUES (NOW(), ?,?,?)");
    mysqli_stmt_bind_param($stmt, "dss", $grand_total, $trackingNumbers, $dean_id);
    mysqli_stmt_execute($stmt);
    $pr_id = mysqli_insert_id($conn);
    $item_stmt = mysqli_prepare($conn, "INSERT INTO purchase_request_items_tbl (pr_id, equipment_id, quantity, price, total,tracking_number,dean_id,employee_id) VALUES (?, ?, ?, ?, ?,?,?,?)");

    for ($i = 0; $i < count($equipment_ids); $i++) {
        $equip_id = $equipment_ids[$i];
        $price = $prices[$i];
        $employee_id = $employee_ids[$i];
        $qty = $quantities[$i];
        $total = $totals[$i];

        mysqli_stmt_bind_param($item_stmt, "iiiddsss", $pr_id, $equip_id, $qty, $price, $total, $trackingNumbers, $dean_id, $employee_id);
        mysqli_stmt_execute($item_stmt);
    }

    mysqli_stmt_close($item_stmt);

    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Purchase Request Saved!",
                showConfirmButton: true
            }).then(() => {
                window.location.href = "pending_purchase_request"; 
            });
        });
    </script>';
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
            <h1>Create Purchase Request</h1>
            <p>
                This section allows administrators or staff to create a purchase request.
                You can select equipment or supplies, specify the quantity needed, and add multiple items in a single request.
            </p>
        </div>
        <section class="section">
            <div class="row">
                <!-- Add Equipment Form -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Purchase Request</h5>

                            <form method="POST">
                                <input type="hidden" class="form-control" name="dean_id" value="<?= $dean_id; ?>">
                                <table class="table" id="pr_table">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            <th>Equipment/Supply</th>
                                            <th>Price (₱)</th>
                                            <th>Quantity</th>
                                            <th>Total (₱)</th>
                                            <th><button type="button" class="btn btn-success" onclick="addRow()">+</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="employee_id[]" class="form-control" onchange="updatePreview()" required>
                                                    <option value="">Select</option>
                                                    <?php
                                                    $result = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE department_id = (SELECT department_id FROM dean_tbl WHERE dean_id = '$dean_id')");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='{$row['employee_id']}'  >{$row['first_name']} {$row['last_name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="equipment_id[]" class="form-control" onchange="updatePrice(this)" required>
                                                    <option value="">Select</option>
                                                    <?php
                                                    $result = mysqli_query($conn, "SELECT equipment_id, equipment_name, price FROM equipment_tbl");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='{$row['equipment_id']}' data-price='{$row['price']}'>{$row['equipment_name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control price" name="price[]" readonly>

                                            </td>
                                            <td><input type="number" class="form-control qty" name="quantity[]" min="1" oninput="computeRow(this)" required></td>
                                            <td><input type="number" class="form-control total" name="total[]" readonly></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" onclick="removeRow(this)">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Grand Total (₱):</strong></td>
                                            <td><input type="number" class="form-control" id="grand_total" readonly></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </form>


                            <script>
                                function updatePrice(select) {
                                    let row = select.closest("tr");
                                    let priceField = row.querySelector(".price");
                                    let qtyField = row.querySelector(".qty");
                                    let totalField = row.querySelector(".total");

                                    let price = select.options[select.selectedIndex].getAttribute("data-price");
                                    priceField.value = price ? parseFloat(price).toFixed(2) : "";

                                    if (qtyField.value) {
                                        totalField.value = (qtyField.value * price).toFixed(2);
                                    }

                                    computeGrandTotal();
                                    updatePreview(); // refresh right side preview
                                }

                                function computeRow(input) {
                                    let row = input.closest("tr");
                                    let price = parseFloat(row.querySelector(".price").value) || 0;
                                    let qty = parseInt(input.value) || 0;
                                    let totalField = row.querySelector(".total");

                                    totalField.value = (price * qty).toFixed(2);

                                    computeGrandTotal();
                                    updatePreview(); // refresh right side preview
                                }


                                function computeGrandTotal() {
                                    let totals = document.querySelectorAll(".total");
                                    let sum = 0;
                                    totals.forEach(t => {
                                        sum += parseFloat(t.value) || 0;
                                    });
                                    document.getElementById("grand_total").value = sum.toFixed(2);
                                }

                                function addRow() {
                                    let table = document.getElementById("pr_table").getElementsByTagName("tbody")[0];
                                    let newRow = table.rows[0].cloneNode(true);

                                    newRow.querySelectorAll("input").forEach(el => el.value = "");
                                    newRow.querySelector("select").selectedIndex = 0;

                                    table.appendChild(newRow);
                                }

                                function removeRow(btn) {
                                    let row = btn.closest("tr");
                                    let table = document.getElementById("pr_table").getElementsByTagName("tbody")[0];
                                    if (table.rows.length > 1) {
                                        row.remove();
                                        computeGrandTotal();
                                    }
                                }
                            </script>


                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body" style="overflow-x: auto;">
                            <h5 class="card-title">Preview of Current PR</h5>

                            <table class="table table-bordered" id="preview_table">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Equipment/Supply</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Grand Total (₱):</strong></td>
                                        <td id="preview_grand_total">0.00</td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

                <script>
                    function updatePreview() {
                        let tableBody = document.querySelector("#preview_table tbody");
                        tableBody.innerHTML = ""; // clear previous preview

                        let rows = document.querySelectorAll("#pr_table tbody tr");
                        let grandTotal = 0;

                        rows.forEach(row => {
                            let employeeSelect = row.querySelector("select[name='employee_id[]']");
                            let equipmentSelect = row.querySelector("select[name='equipment_id[]']");

                            let employee = employeeSelect ? employeeSelect.options[employeeSelect.selectedIndex].textContent : "";
                            let equipment = equipmentSelect ? equipmentSelect.options[equipmentSelect.selectedIndex].textContent : "";

                            let price = parseFloat(row.querySelector(".price").value) || 0;
                            let qty = parseInt(row.querySelector(".qty").value) || 0;
                            let total = parseFloat(row.querySelector(".total").value) || 0;

                            if (equipment !== "Select" && qty > 0) {
                                let newRow = `
                <tr>
                    <td>${employee}</td>
                    <td>${equipment}</td>
                    <td>₱${price.toFixed(2)}</td>
                    <td>${qty}</td>
                    <td>₱${total.toFixed(2)}</td>
                </tr>
            `;
                                tableBody.innerHTML += newRow;
                                grandTotal += total;
                            }
                        });

                        document.getElementById("preview_grand_total").textContent = grandTotal.toFixed(2);
                    }



                    function updatePrice(select) {
                        let row = select.closest("tr");
                        let priceField = row.querySelector(".price");
                        let qtyField = row.querySelector(".qty");
                        let totalField = row.querySelector(".total");

                        let price = select.options[select.selectedIndex].getAttribute("data-price");
                        priceField.value = price ? parseFloat(price).toFixed(2) : "";

                        if (qtyField.value) {
                            totalField.value = (qtyField.value * price).toFixed(2);
                        }

                        computeGrandTotal();
                        updatePreview(); // refresh right side preview
                    }

                    function computeRow(input) {
                        let row = input.closest("tr");
                        let price = parseFloat(row.querySelector(".price").value) || 0;
                        let qty = parseInt(input.value) || 0;
                        let totalField = row.querySelector(".total");

                        totalField.value = (price * qty).toFixed(2);

                        computeGrandTotal();
                        updatePreview(); // refresh right side preview
                    }

                    function addRow() {
                        let table = document.getElementById("pr_table").getElementsByTagName("tbody")[0];
                        let newRow = table.rows[0].cloneNode(true);

                        newRow.querySelectorAll("input").forEach(el => el.value = "");
                        newRow.querySelector("select").selectedIndex = 0;

                        table.appendChild(newRow);
                        updatePreview(); // refresh after adding row
                    }

                    function removeRow(btn) {
                        let row = btn.closest("tr");
                        let table = document.getElementById("pr_table").getElementsByTagName("tbody")[0];
                        if (table.rows.length > 1) {
                            row.remove();
                            computeGrandTotal();
                            updatePreview(); // refresh after removing row
                        }
                    }
                </script>

            </div>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>
</body>

</html>
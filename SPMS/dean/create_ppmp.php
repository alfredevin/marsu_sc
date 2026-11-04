<?php
include './../config.php';
include '../template/header.php';

// Kunin ang dean_id mula sa session (fallback to 1 for testing)
$dean_id = $_SESSION['dean_id'] ?? 1;
?>

<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<style>
    .table-input {
        border: 1px solid transparent;
        background: transparent;
        width: 100%;
        outline: none;
        padding: 5px;
        border-radius: 4px;
        transition: 0.2s;
    }

    .table-input:focus {
        background: #fff;
        border: 1px solid #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .1);
    }

    #ppmp_creation_view {
        display: none;
    }

    .fund-card {
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .fund-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .sticky-budget {
        position: sticky;
        top: 80px;
        z-index: 10;
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <?php
    // --- HANDLING SUBMISSION ---
    if (isset($_POST['submit_ppmp'])) {
        $equipment_ids = $_POST['equipment_id'];
        $employee_ids = $_POST['employee_id'];
        $prices = $_POST['price'];
        $quantities = $_POST['quantity'];
        $totals = $_POST['total'];
        $selected_year = $_POST['selected_year'];
        $allocation_limit = $_POST['allocation_limit'];
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);
        $is_revision_id = !empty($_POST['revision_ppmp_id']) ? $_POST['revision_ppmp_id'] : null;

        $grand_total = array_sum($totals);

        if ($grand_total > $allocation_limit) {
            echo "<script>Swal.fire('Budget Error', 'Grand total exceeds your allocation!', 'error');</script>";
        } else {
            if ($is_revision_id) {
                // Update rejected plan back to Pending
                $stmt = mysqli_prepare($conn, "UPDATE ppmp_tbl SET grand_total = ?, reason = ?, status = 1, remarks = NULL WHERE ppmp_id = ?");
                mysqli_stmt_bind_param($stmt, "dsi", $grand_total, $reason, $is_revision_id);
                mysqli_stmt_execute($stmt);
                $ppmp_id = $is_revision_id;
                mysqli_query($conn, "DELETE FROM ppmp_items_tbl WHERE ppmp_id = '$ppmp_id'");
            } else {
                // Insert new plan
                $stmt = mysqli_prepare($conn, "INSERT INTO ppmp_tbl (year, grand_total, dean_id, status, reason) VALUES (?, ?, ?, 1, ?)");
                mysqli_stmt_bind_param($stmt, "sdis", $selected_year, $grand_total, $dean_id, $reason);
                mysqli_stmt_execute($stmt);
                $ppmp_id = mysqli_insert_id($conn);
            }

            // Insert Items
            $item_stmt = mysqli_prepare($conn, "INSERT INTO ppmp_items_tbl (ppmp_id, equipment_id, custom_item_name, employee_id, quantity, price, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
            for ($i = 0; $i < count($equipment_ids); $i++) {
                if (empty($equipment_ids[$i]))
                    continue;
                $val = $equipment_ids[$i];
                $final_eq_id = is_numeric($val) ? $val : null;
                $custom_name = is_numeric($val) ? null : $val;
                mysqli_stmt_bind_param($item_stmt, "iisiidd", $ppmp_id, $final_eq_id, $custom_name, $employee_ids[$i], $quantities[$i], $prices[$i], $totals[$i]);
                mysqli_stmt_execute($item_stmt);
            }

            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({ icon: "success", title: "Plan Submitted", text: "PPMP is now pending for review.", timer: 2500, showConfirmButton: false })
                    .then(() => { window.location.href = "create_ppmp.php"; });
                });
            </script>';
        }
    }
    ?>

    <main id="main" class="main">
        <div id="fund_selection_view" class="animate__animated animate__fadeIn">
            <div class="pagetitle">
                <h1>PPMP Budgeting</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Department Head</li>
                        <li class="breadcrumb-item active">PPMP Creation</li>
                    </ol>
                </nav>
            </div>

            <section class="section">
                <div class="row">
                    <?php
                    $q_fund = "SELECT f.*, p.ppmp_id, p.status as ppmp_status, p.reason as prev_reason 
                               FROM allocated_funds_tbl f 
                               LEFT JOIN ppmp_tbl p ON f.year = p.year AND f.dean_id = p.dean_id
                               WHERE f.dean_id = ? AND (p.ppmp_id IS NULL OR p.status = 10) 
                               ORDER BY f.year DESC";
                    $stmt_f = $conn->prepare($q_fund);
                    $stmt_f->bind_param("i", $dean_id);
                    $stmt_f->execute();
                    $funds = $stmt_f->get_result();

                    if ($funds->num_rows == 0)
                        echo '<div class="col-12 text-center p-5 text-muted"><h5>No available allocations for budgeting.</h5></div>';

                    while ($f = $funds->fetch_assoc()) {
                        $is_rej = ($f['ppmp_status'] == 10);
                        $theme = $is_rej ? 'danger' : 'primary';
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm fund-card border-start border-<?= $theme ?> border-5"
                                onclick="preparePPMP('<?= $f['year'] ?>', <?= $f['amount'] ?>, <?= $is_rej ? $f['ppmp_id'] : 'null' ?>, '<?= $is_rej ? addslashes($f['prev_reason']) : '' ?>')">
                                <div class="card-body p-4">
                                    <h5 class="card-title text-<?= $theme ?> fw-bold">FY <?= $f['year'] ?>
                                        <?= $is_rej ? '<span class="badge bg-danger ms-2">REJECTED</span>' : '' ?></h5>
                                    <h2 class="fw-bold">₱<?= number_format($f['amount'], 2) ?></h2>
                                    <button
                                        class="btn btn-<?= $theme ?> w-100 rounded-pill mt-3"><?= $is_rej ? 'Revise Plan' : 'Start Budgeting' ?></button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </div>

        <div id="ppmp_creation_view" class="animate__animated animate__fadeIn">
            <div class="pagetitle d-flex justify-content-between">
                <div>
                    <h1 id="form_header">PPMP Form</h1>
                    <p>Items are clustered by category for easier organization.</p>
                </div>
                <button class="btn btn-light btn-sm border h-100" onclick="location.reload()"><i class="bi bi-x-lg"></i>
                    Cancel</button>
            </div>

            <form method="POST" id="ppmp_form">
                <input type="hidden" name="revision_ppmp_id" id="revision_id">
                <input type="hidden" name="selected_year" id="input_year">
                <input type="hidden" name="allocation_limit" id="input_limit">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title text-primary m-0">Itemized List</h5>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow()"><i
                                            class="bi bi-plus-lg"></i> Add Row</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="ppmp_table">
                                        <thead class="table-light small">
                                            <tr>
                                                <th width="35%">Item (Clustered)</th>
                                                <th width="25%">End User</th>
                                                <th width="15%" class="text-end">Price</th>
                                                <th width="10%" class="text-center">Qty</th>
                                                <th width="15%" class="text-end">Total</th>
                                                <th width="5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div id="empty_state" class="text-center py-4 text-muted border-top">No items added.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow border-0 sticky-budget">
                            <div class="card-body p-4">
                                <label class="fw-bold text-muted small mb-2">JUSTIFICATION / PURPOSE</label>
                                <textarea name="reason" id="form_reason" class="form-control mb-3" rows="3"
                                    required></textarea>
                                <hr>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" id="budget_progress"></div>
                                </div>
                                <div class="d-flex justify-content-between small mb-3">
                                    <span id="percent_text" class="fw-bold">0% Used</span>
                                    <span>Limit: ₱<span id="limit_display">0.00</span></span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Total Amount:</span>
                                    <span class="fw-bold text-primary">₱ <span
                                            id="grand_total_display">0.00</span></span>
                                </div>
                                <div class="d-flex justify-content-between mb-4 pt-2 border-top">
                                    <span class="fw-bold">Remaining:</span>
                                    <span class="fw-bold text-success" id="balance_container">₱ <span
                                            id="remaining_balance_display">0.00</span></span>
                                </div>
                                <div id="budget_alert" class="alert alert-danger d-none small text-center fw-bold">TOTAL
                                    EXCEEDS BUDGET LIMIT</div>
                                <button type="submit" name="submit_ppmp"
                                    class="btn btn-success w-100 fw-bold py-2 shadow-sm" id="submit_btn" disabled>Submit
                                    Plan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php include '../template/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let CURRENT_LIMIT = 0;

        // FETCH EMPLOYEES (Filtered by Dept)
        const employees = [<?php
        $eq = mysqli_query($conn, "SELECT * FROM employee_tbl WHERE department_id = (SELECT department_id FROM dean_tbl WHERE dean_id = '$dean_id')");
        while ($e = mysqli_fetch_assoc($eq))
            echo "{id:'{$e['employee_id']}', text:'" . addslashes($e['first_name'] . ' ' . $e['last_name']) . "'},";
        ?>];

        // FETCH CLUSTERED ITEMS
        const clusteredItems = <?php
        $iq = mysqli_query($conn, "SELECT * FROM equipment_tbl ORDER BY category ASC, equipment_name ASC");
        $groups = [];
        while ($i = mysqli_fetch_assoc($iq)) {
            $cat = empty($i['category']) ? 'Uncategorized' : $i['category'];
            $groups[$cat][] = ['id' => $i['equipment_id'], 'text' => $i['equipment_name'], 'price' => $i['price']];
        }
        echo json_encode($groups);
        ?>;

        function preparePPMP(year, amount, ppmpId, reason) {
            CURRENT_LIMIT = parseFloat(amount);
            $('#revision_id').val(ppmpId);
            $('#input_year').val(year);
            $('#input_limit').val(amount);
            $('#limit_display').text(amount.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            $('#form_reason').val(reason);
            $('#ppmp_table tbody').empty();

            if (ppmpId) {
                $('#form_header').text("Revising PPMP FY " + year);
                fetchOldItems(ppmpId);
            } else {
                $('#form_header').text("New PPMP FY " + year);
            }

            $('#fund_selection_view').hide();
            $('#ppmp_creation_view').show();
            updateSum();
        }

        function addRow(selectedItem = '', selectedEmp = '', priceVal = '', qtyVal = 1) {
            $('#empty_state').hide();
            const rowId = Math.floor(Math.random() * 1000000);

            // Build optgroup dropdown
            let options = '<option value="">Search Item...</option>';
            let isFound = false;
            for (const category in clusteredItems) {
                options += `<optgroup label="${category}">`;
                clusteredItems[category].forEach(item => {
                    let sel = (selectedItem == item.id) ? 'selected' : '';
                    if (sel) isFound = true;
                    options += `<option value="${item.id}" data-price="${item.price}" ${sel}>${item.text}</option>`;
                });
                options += `</optgroup>`;
            }
            // Custom item handling
            if (selectedItem && !isFound) options += `<optgroup label="Custom"><option value="${selectedItem}" selected>${selectedItem}</option></optgroup>`;

            const tr = `
            <tr id="row_${rowId}" class="animate__animated animate__fadeIn">
                <td><select name="equipment_id[]" class="form-select item-select" onchange="setPrice(this)" required>${options}</select></td>
                <td><select name="employee_id[]" class="form-select emp-select" required><option value="">Assign To...</option>${employees.map(e => `<option value="${e.id}" ${selectedEmp == e.id ? 'selected' : ''}>${e.text}</option>`).join('')}</select></td>
                <td><input type="number" step="0.01" name="price[]" class="table-input text-end price-val" value="${priceVal}" oninput="calc(this)"></td>
                <td><input type="number" name="quantity[]" class="table-input text-center qty" value="${qtyVal}" min="1" oninput="calc(this)"></td>
                <td><input type="text" class="table-input text-end total fw-bold" readonly placeholder="0.00"><input type="hidden" name="total[]" class="total-val"></td>
                <td class="text-center"><i class="bi bi-trash text-danger" style="cursor:pointer" onclick="delRow('${rowId}')"></i></td>
            </tr>`;

            $('#ppmp_table tbody').append(tr);
            $(`#row_${rowId} .item-select, #row_${rowId} .emp-select`).select2({ theme: 'bootstrap-5', tags: true, dropdownParent: $('#ppmp_creation_view') });
            calc($(`#row_${rowId} .qty`)[0]);
        }

        function setPrice(select) {
            const price = $(select).find(':selected').data('price') || 0;
            if (price > 0) $(select).closest('tr').find('.price-val').val(price);
            calc(select);
        }

        function calc(input) {
            const row = $(input).closest('tr');
            const p = parseFloat(row.find('.price-val').val()) || 0;
            const q = parseInt(row.find('.qty').val()) || 0;
            const t = p * q;
            row.find('.total').val(t.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            row.find('.total-val').val(t);
            updateSum();
        }

        function updateSum() {
            let total = 0;
            $('.total-val').each(function () { total += parseFloat($(this).val()) || 0; });
            $('#grand_total_display').text(total.toLocaleString(undefined, { minimumFractionDigits: 2 }));

            // Remaining Logic
            let rem = CURRENT_LIMIT - total;
            $('#remaining_balance_display').text(rem.toLocaleString(undefined, { minimumFractionDigits: 2 }));
            $('#balance_container').toggleClass('text-danger', rem < 0).toggleClass('text-success', rem >= 0);

            // Progress Bar Logic
            let pct = (total / CURRENT_LIMIT) * 100;
            $('#budget_progress').css('width', Math.min(pct, 100) + "%").toggleClass('bg-danger', pct > 100).toggleClass('bg-success', pct <= 100);
            $('#percent_text').text(pct.toFixed(1) + "% Used").toggleClass('text-danger', pct > 100);

            $('#submit_btn').prop('disabled', total <= 0 || pct > 100);
            $('#budget_alert').toggleClass('d-none', pct <= 100);
        }

        function delRow(id) { $(`#row_${id}`).remove(); if ($('#ppmp_table tbody tr').length === 0) $('#empty_state').show(); updateSum(); }

        function fetchOldItems(ppmpId) {
            $.ajax({
                url: 'get_ppmp_items.php', method: 'GET', data: { id: ppmpId },
                success: function (res) {
                    JSON.parse(res).forEach(i => {
                        addRow(i.equipment_id ? i.equipment_id : i.custom_item_name, i.employee_id, i.price, i.quantity);
                    });
                }
            });
        }
    </script>
</body>

</html>
<?php
include './../config.php';

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipment_ids = $_POST['equipment_id'];
    $prices        = $_POST['price'];
    $quantities    = $_POST['quantity'];
    $totals        = $_POST['total'];
    $supplier      = $_POST['supplier'];

    // Recalculate grand total on backend for security
    $grand_total   = array_sum($totals);

    $year = date("Y");
    // Generate a unique tracking number (You might want a more robust sequence generator in production)
    $trackingNumbers = "PR-" . $year . "-" . uniqid();

    // Insert Parent Record
    $stmt = mysqli_prepare($conn, "INSERT INTO purchase_request_tbl (request_date, grand_total, tracking_number, status, supplier) VALUES (NOW(), ?, ?, 2, ?)");
    mysqli_stmt_bind_param($stmt, "dss", $grand_total, $trackingNumbers, $supplier);

    if (mysqli_stmt_execute($stmt)) {
        $pr_id = mysqli_insert_id($conn);
        $item_stmt = mysqli_prepare($conn, "INSERT INTO purchase_request_items_tbl (pr_id, equipment_id, quantity, price, total, tracking_number) VALUES (?, ?, ?, ?, ?, ?)");

        for ($i = 0; $i < count($equipment_ids); $i++) {
            $equip_id = $equipment_ids[$i];

            // Skip empty rows if any
            if (empty($equip_id)) continue;

            $price = $prices[$i];
            $qty   = $quantities[$i];
            $total = $totals[$i];

            mysqli_stmt_bind_param($item_stmt, "iiidds", $pr_id, $equip_id, $qty, $price, $total, $trackingNumbers);
            mysqli_stmt_execute($item_stmt);
        }
        mysqli_stmt_close($item_stmt);

        // Success Message
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Purchase Request generated successfully.",
                    confirmButtonColor: "#0d6efd"
                }).then(() => {
                    window.location.href = "pending_purchase_request"; 
                });
            });
        </script>';
    } else {
        // Error Message
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({ icon: "error", title: "Error", text: "Something went wrong. Please try again." });
            });
        </script>';
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../template/header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<style>
    /* Custom Styles for better UX */
    .table-input {
        border: none;
        background: transparent;
        width: 100%;
        outline: none;
    }

    .table-input:focus {
        border-bottom: 2px solid #0d6efd;
        background: #f8f9fa;
    }

    .remove-row {
        cursor: pointer;
        color: #dc3545;
        transition: 0.3s;
    }

    .remove-row:hover {
        color: #bb2d3b;
        transform: scale(1.1);
    }

    .summary-card {
        position: sticky;
        top: 20px;
        border-left: 5px solid #0d6efd;
    }

    .select2-container .select2-selection--single {
        height: 38px;
        border: 1px solid #dee2e6;
    }

    .select2-container--bootstrap-5 .select2-selection {
        border-radius: 0.375rem;
    }
</style>

<body>
    <?php include '../template/navbar.php'; ?>
    <?php include '../template/sidebar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Purchase Request</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">New Request</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <form method="POST" id="pr_form" autocomplete="off">
                <div class="row">

                    <div class="col-lg-8">

                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h5 class="card-title"><i class="bi bi-shop"></i> Select Supplier</h5>
                                <div class="form-group">
                                    <label class="text-muted mb-2">Choose the supplier for this request:</label>
                                    <select id="supplier_select" class="form-select select2" name="supplier" required>
                                        <option value="">-- Search Supplier --</option>
                                        <?php
                                        $suppliers = mysqli_query($conn, "SELECT supplier_id, supplier_name FROM supplier_tbl WHERE status=1");
                                        while ($sup = mysqli_fetch_assoc($suppliers)) {
                                            echo "<option value='{$sup['supplier_name']}'>{$sup['supplier_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="items_card" style="display:none;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title m-0"><i class="bi bi-cart"></i> Order Items</h5>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRow()">
                                        <i class="bi bi-plus-lg"></i> Add Item
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="pr_table">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="40%">Item / Equipment</th>
                                                <th width="20%" class="text-end">Price (₱)</th>
                                                <th width="15%" class="text-center">Qty</th>
                                                <th width="20%" class="text-end">Total (₱)</th>
                                                <th width="5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center mt-3" id="empty_msg">
                                    <p class="text-muted fst-italic">Click "Add Item" to start your list.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card summary-card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title">Request Summary</h5>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Total Items:</span>
                                    <span id="summary_count" class="fw-bold">0</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="h5 m-0">Grand Total:</span>
                                    <span class="h4 text-primary fw-bold m-0">₱<span id="grand_total_display">0.00</span></span>
                                    <input type="hidden" name="grand_total_input" id="grand_total_input">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submit_btn" disabled>
                                        <i class="bi bi-check-circle-fill"></i> Submit Request
                                    </button>
                                    <button type="button" class="btn btn-light text-danger" onclick="resetForm()">
                                        Reset Form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </section>
    </main>

    <?php include '../template/footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include '../template/script.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Database data passed to JS for dynamic rows
        const equipmentData = [
            <?php
            $result = mysqli_query($conn, "SELECT equipment_id, equipment_name, price FROM equipment_tbl");
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Sanitize for JS
                $name = addslashes($row['equipment_name']);
                echo "{ id: '{$row['equipment_id']}', text: '{$name}', price: {$row['price']} },";
            }
            ?>
        ];

        $(document).ready(function() {
            // Initialize Supplier Select2
            $('#supplier_select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Search for a supplier...',
                width: '100%'
            });

            // Show items card when supplier is selected
            $('#supplier_select').on('change', function() {
                if ($(this).val()) {
                    $('#items_card').fadeIn();
                    if ($('#pr_table tbody tr').length === 0) {
                        addRow(); // Auto add first row
                    }
                    validateForm();
                } else {
                    $('#items_card').hide();
                }
            });
        });

        function addRow() {
            $('#empty_msg').hide();

            let rowId = Date.now(); // Unique ID for the row
            let html = `
                <tr id="row_${rowId}">
                    <td>
                        <select name="equipment_id[]" class="form-select item-select" onchange="itemSelected(this)" required>
                            <option value="">Select Item...</option>
                            ${equipmentData.map(item => `<option value="${item.id}" data-price="${item.price}">${item.text}</option>`).join('')}
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control text-end price-input" name="price[]" readonly placeholder="0.00">
                    </td>
                    <td>
                        <input type="number" class="form-control text-center qty-input" name="quantity[]" min="1" value="1" oninput="calculateRow(this)" required>
                    </td>
                    <td>
                        <input type="number" class="form-control text-end total-input" name="total[]" readonly placeholder="0.00">
                    </td>
                    <td class="text-center">
                        <i class="bi bi-trash remove-row" onclick="removeRow('${rowId}')" title="Remove Item"></i>
                    </td>
                </tr>
            `;

            $('#pr_table tbody').append(html);

            // Initialize Select2 for the new dropdown
            $(`#row_${rowId} .item-select`).select2({
                theme: 'bootstrap-5',
                dropdownParent: $(`#row_${rowId} td:first-child`), // Fix for Select2 inside table
                width: '100%'
            });

            filterOptions(); // Prevent selecting same item twice
            validateForm();
        }

        function removeRow(rowId) {
            $(`#row_${rowId}`).remove();
            calculateGrandTotal();
            filterOptions();
            validateForm();

            if ($('#pr_table tbody tr').length === 0) {
                $('#empty_msg').show();
            }
        }

        function itemSelected(selectElement) {
            let row = $(selectElement).closest('tr');
            let price = $(selectElement).find(':selected').data('price');

            // Set Price
            row.find('.price-input').val(price ? parseFloat(price).toFixed(2) : '');

            // Trigger calculation
            calculateRow(row.find('.qty-input')[0]);
            filterOptions();
        }

        function calculateRow(inputElement) {
            let row = $(inputElement).closest('tr');
            let price = parseFloat(row.find('.price-input').val()) || 0;
            let qty = parseInt(row.find('.qty-input').val()) || 0;
            let total = price * qty;

            row.find('.total-input').val(total.toFixed(2));
            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let grandTotal = 0;
            let count = 0;

            $('.total-input').each(function() {
                let val = parseFloat($(this).val()) || 0;
                grandTotal += val;
                if (val > 0) count++;
            });

            // Update UI
            $('#grand_total_display').text(grandTotal.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            $('#grand_total_input').val(grandTotal);
            $('#summary_count').text(count);

            validateForm();
        }

        function filterOptions() {
            // Get all currently selected values
            let selected = [];
            $('.item-select').each(function() {
                if ($(this).val()) selected.push($(this).val());
            });

            // Loop through all selects and disable already selected options
            $('.item-select').each(function() {
                let currentVal = $(this).val();
                $(this).find('option').each(function() {
                    // Disable if in array AND not the current value of this select
                    if (selected.includes($(this).val()) && $(this).val() != currentVal) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
                // Refresh Select2 to show disabled state
                $(this).trigger('change.select2');
            });
        }

        function validateForm() {
            let supplier = $('#supplier_select').val();
            let total = parseFloat($('#grand_total_input').val()) || 0;

            // Enable button only if Supplier exists and Total > 0
            if (supplier && total > 0) {
                $('#submit_btn').prop('disabled', false);
            } else {
                $('#submit_btn').prop('disabled', true);
            }
        }

        function resetForm() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will clear all items.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            })
        }
    </script>
</body>

</html>
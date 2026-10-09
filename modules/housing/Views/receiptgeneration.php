<!-- Receipt Generation View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-printer-fill me-2 text-gold"></i>Official Receipt & Statement of Account
        </h1>
        <p class="text-muted small mb-0">Printable official rent payment receipt and statement of account with MarSU accreditation seal.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('housing/paymentrecords') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Records
        </a>
        <button class="btn btn-marsu btn-sm shadow-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Official Receipt
        </button>
    </div>
</div>

<!-- Receipt Paper Card (Print Styled) -->
<div class="row justify-content-center mb-4">
    <div class="col-md-8">
        <div class="card border shadow-sm p-4 bg-white" id="printableReceipt">
            <!-- Header with MarSU Branding -->
            <div class="text-center border-bottom pb-3 mb-3">
                <div class="fw-bold text-marsu-burgundy fs-5 text-uppercase">Marinduque State University</div>
                <div class="small text-muted">Office of Student Affairs & Services • Student Housing Section (ISHAMIS)</div>
                <div class="fw-bold text-dark mt-2 fs-6">OFFICIAL ACCREDITED BOARDING HOUSE RECEIPT</div>
                <div class="text-muted small">Receipt No: <strong>OR-2026-1001</strong> • Date: <strong><?= date('F d, Y') ?></strong></div>
            </div>

            <!-- Receipt Metadata Grid -->
            <div class="row g-3 small mb-4">
                <div class="col-6">
                    <div class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Resident Information:</div>
                    <div class="fw-bold fs-6 text-dark">Maria Santos</div>
                    <div>Student ID: 22-0145</div>
                    <div>Program: BS Information Technology - 3A</div>
                </div>
                <div class="col-6 text-end">
                    <div class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Accredited Facility:</div>
                    <div class="fw-bold fs-6 text-dark">Villa Marinduque Student Dorm</div>
                    <div>Room 102 • Bed Space A</div>
                    <div>Landlord: Engr. Roberto M. Santos</div>
                </div>
            </div>

            <!-- Payment Breakdown Table -->
            <div class="table-responsive mb-3">
                <table class="table table-bordered align-middle">
                    <thead class="table-light small">
                        <tr>
                            <th>Item Description</th>
                            <th>Billing Period</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-bold">Monthly Bed Space Rental</div>
                                <div class="small text-muted">Inclusive of basic water & high-speed Wi-Fi</div>
                            </td>
                            <td>October 01 — October 31, 2026</td>
                            <td class="text-end fw-semibold">₱1,500.00</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold">Electricity Submeter Consumption</div>
                                <div class="small text-muted">Reading: 124 kWh to 134 kWh (10 kWh used)</div>
                            </td>
                            <td>September 2026 Consumption</td>
                            <td class="text-end fw-semibold">₱180.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Subtotal:</th>
                            <td class="text-end fw-bold">₱1,680.00</td>
                        </tr>
                        <tr class="table-light">
                            <th colspan="2" class="text-end fs-6 text-marsu-burgundy">TOTAL AMOUNT PAID:</th>
                            <td class="text-end fw-bold fs-5 text-success">₱1,680.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Mode and Signature -->
            <div class="row g-3 small mt-3 pt-3 border-top">
                <div class="col-6">
                    <div>Payment Method: <strong>GCash E-Wallet</strong></div>
                    <div>Ref / Transaction ID: <strong>GC-991204812</strong></div>
                    <div class="text-success mt-1"><i class="bi bi-patch-check-fill me-1"></i>Verified University Accreditation Record</div>
                </div>
                <div class="col-6 text-center">
                    <div class="mt-4 border-top pt-1 w-75 mx-auto fw-bold">Authorized Landlord / Cashier Signature</div>
                    <div class="small text-muted">Villa Marinduque Management</div>
                </div>
            </div>
        </div>
    </div>
</div>

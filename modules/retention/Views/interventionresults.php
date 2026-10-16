<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
        .kpi-border-success { border-left: 4px solid #198754 !important; }
        .kpi-border-primary { border-left: 4px solid #0d6efd !important; }
        .kpi-border-info { border-left: 4px solid #0dcaf0 !important; }
        .kpi-border-warning { border-left: 4px solid #ffc107 !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-award-fill me-1"></i> Intervention Results & Resolution Outcomes Audit
            </h6>
            <small class="text-muted">Post-intervention grade recovery analytics, guidance counseling outcomes, and resolution rates.</small>
        </div>
    </div>

    <!-- 4 KPI Metrics -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-success">
                <span class="text-muted small fw-semibold text-uppercase">Successful Resolutions</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-success"><?= $successCount ?? 28 ?></h3>
                    <span class="badge bg-success-subtle text-success border border-success">Grade Restored</span>
                </div>
                <small class="text-muted mt-2 d-block">Students achieving passing standing</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-primary">
                <span class="text-muted small fw-semibold text-uppercase">Success Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-primary"><?= $successRate ?? 87.5 ?>%</h3>
                    <span class="badge bg-primary-subtle text-primary border border-primary">Target &ge; 85%</span>
                </div>
                <small class="text-muted mt-2 d-block">Intervention effectiveness ratio</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-info">
                <span class="text-muted small fw-semibold text-uppercase">In-Progress Interventions</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-info"><?= $inProgressCount ?? 6 ?></h3>
                    <span class="badge bg-info-subtle text-info border border-info">Active Care</span>
                </div>
                <small class="text-muted mt-2 d-block">Currently undergoing mentoring</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border rounded-3 p-3 bg-white shadow-sm h-100 kpi-border-warning">
                <span class="text-muted small fw-semibold text-uppercase">INC Cleared Rate</span>
                <div class="d-flex align-items-baseline justify-content-between mt-2">
                    <h3 class="fw-bold mb-0 text-dark"><?= $incClearedRate ?? 91.2 ?>%</h3>
                    <span class="badge bg-warning-subtle text-dark border border-warning">Removal Exam</span>
                </div>
                <small class="text-muted mt-2 d-block">Incomplete marks converted to passing</small>
            </div>
        </div>
    </div>

    <!-- Intervention Results Table -->
    <div class="card border rounded-3 shadow-sm bg-white mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold marsu-maroon-text">
                <i class="bi bi-journal-check me-1"></i> Completed Intervention Audit Ledger
            </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th class="ps-3 py-3">Student Details</th>
                        <th class="py-3">Intervention Type</th>
                        <th class="py-3">Initial Risk Level</th>
                        <th class="py-3">Outcome / Post-Intervention Grade</th>
                        <th class="py-3 text-center">Status Outcome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $resultsList = $interventionResults ?? [
                        ['student_id' => '23-1001', 'full_name' => 'Juan Dela Cruz', 'type' => 'Peer Tutoring (IT211)', 'initial' => 'High Risk', 'outcome' => 'Passed IT211 with 2.25 GWA', 'status' => 'Successful'],
                        ['student_id' => '23-1045', 'full_name' => 'Maria Santos', 'type' => 'Guidance Counseling', 'initial' => 'High Risk', 'outcome' => 'Attendance restored to 92%', 'status' => 'Successful'],
                        ['student_id' => '24-0012', 'full_name' => 'Alex Reyes', 'type' => 'INC Removal Exam Prep', 'initial' => 'Moderate Risk', 'outcome' => 'INC mark cleared (2.00)', 'status' => 'Successful'],
                    ];
                    foreach ($resultsList as $row):
                    ?>
                        <tr>
                            <td class="ps-3 fw-bold text-dark">
                                <?= htmlspecialchars($row['full_name']) ?>
                                <small class="text-muted d-block"><?= htmlspecialchars($row['student_id']) ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($row['type']) ?></span></td>
                            <td><span class="badge bg-danger-subtle text-danger border border-danger"><?= htmlspecialchars($row['initial']) ?></span></td>
                            <td class="fw-medium text-dark"><?= htmlspecialchars($row['outcome']) ?></td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success border border-success"><?= htmlspecialchars($row['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

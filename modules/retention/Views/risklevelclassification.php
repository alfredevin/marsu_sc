<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg { background-color: #58111a !important; color: #fff !important; }
        .marsu-maroon-text { color: #58111a !important; }
    </style>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom">
        <div>
            <h6 class="fw-bold marsu-maroon-text mb-0 text-nowrap">
                <i class="bi bi-diagram-3-fill me-1"></i> Institutional Risk Level Classification Matrix
            </h6>
            <small class="text-muted">Rubric thresholds, algorithmic indicators, and automated intervention triggers.</small>
        </div>
    </div>

    <!-- 3 Tier Cards -->
    <div class="row g-4 mb-4">
        <!-- Tier 1: High Risk -->
        <div class="col-md-4">
            <div class="card border-danger rounded-3 shadow-sm bg-white h-100">
                <div class="card-header bg-danger text-white py-3 fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> TIER 1: HIGH RISK (CRITICAL)
                </div>
                <div class="card-body p-3">
                    <h5 class="fw-bold text-danger">Risk Score &ge; 75%</h5>
                    <p class="small text-muted mb-3">Students facing immediate academic dismissal, multiple failing marks (5.00), or severe non-attendance.</p>

                    <h6 class="fw-bold small text-dark mb-2">Automated Triggers:</h6>
                    <ul class="small text-secondary ps-3 mb-3">
                        <li>GWA &gt; 3.00 or Failed &ge; 6 units</li>
                        <li>Unexcused absences &ge; 20% of contact hours</li>
                        <li>Non-compliance with INC removal deadline</li>
                    </ul>

                    <h6 class="fw-bold small text-dark mb-2">Mandatory Intervention Protocol:</h6>
                    <span class="badge bg-danger-subtle text-danger border border-danger mb-1 d-inline-block">Immediate Guidance Intake</span>
                    <span class="badge bg-danger-subtle text-danger border border-danger d-inline-block">Parent/Guardian Notification</span>
                </div>
            </div>
        </div>

        <!-- Tier 2: Moderate Risk -->
        <div class="col-md-4">
            <div class="card border-warning rounded-3 shadow-sm bg-white h-100">
                <div class="card-header bg-warning text-dark py-3 fw-bold">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i> TIER 2: MODERATE RISK (MONITORED)
                </div>
                <div class="card-body p-3">
                    <h5 class="fw-bold text-dark">Risk Score 40% - 74%</h5>
                    <p class="small text-muted mb-3">Students exhibiting preliminary indicators of academic decline, minor tardiness, or course INC marks.</p>

                    <h6 class="fw-bold small text-dark mb-2">Automated Triggers:</h6>
                    <ul class="small text-secondary ps-3 mb-3">
                        <li>GPA between 2.50 and 3.00</li>
                        <li>Unexcused absences 10% - 19%</li>
                        <li>1 Pending INC grade</li>
                    </ul>

                    <h6 class="fw-bold small text-dark mb-2">Mandatory Intervention Protocol:</h6>
                    <span class="badge bg-warning-subtle text-dark border border-warning mb-1 d-inline-block">Faculty Advising Session</span>
                    <span class="badge bg-warning-subtle text-dark border border-warning d-inline-block">Endorse to Peer Tutoring</span>
                </div>
            </div>
        </div>

        <!-- Tier 3: Low Risk -->
        <div class="col-md-4">
            <div class="card border-success rounded-3 shadow-sm bg-white h-100">
                <div class="card-header bg-success text-white py-3 fw-bold">
                    <i class="bi bi-check-circle-fill me-2"></i> TIER 3: LOW RISK (GOOD STANDING)
                </div>
                <div class="card-body p-3">
                    <h5 class="fw-bold text-success">Risk Score &lt; 40%</h5>
                    <p class="small text-muted mb-3">Students progressing on-track according to curriculum benchmarks with satisfactory grades.</p>

                    <h6 class="fw-bold small text-dark mb-2">Automated Triggers:</h6>
                    <ul class="small text-secondary ps-3 mb-3">
                        <li>GWA &le; 2.25</li>
                        <li>Attendance rate &ge; 90%</li>
                        <li>0 failing or incomplete marks</li>
                    </ul>

                    <h6 class="fw-bold small text-dark mb-2">Mandatory Intervention Protocol:</h6>
                    <span class="badge bg-success-subtle text-success border border-success mb-1 d-inline-block">Standard Cohort Monitoring</span>
                    <span class="badge bg-success-subtle text-success border border-success d-inline-block">Dean's List / Peer Mentor Candidate</span>
                </div>
            </div>
        </div>
    </div>
</div>

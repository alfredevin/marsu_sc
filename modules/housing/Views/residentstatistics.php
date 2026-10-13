<!-- Resident Statistics View -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi bi-people-fill me-2 text-gold"></i>Student Boarder Demographics & Analytics
        </h1>
        <p class="text-muted small mb-0">Academic college representation, year-level distribution, gender ratio, and geographic origin of university boarding house residents.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Demographics
        </button>
    </div>
</div>

<!-- Demographic Distribution Cards -->
<div class="row g-4 mb-4">
    <!-- Origin by Municipality -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-geo-alt-fill me-2 text-gold"></i>Resident Distribution by Home Municipality
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Torrijos (Remote South)</span>
                        <span class="fw-bold">24 Students (37.5%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-marsu" style="width: 37.5%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Santa Cruz (Northeast)</span>
                        <span class="fw-bold">18 Students (28.1%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 28.1%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Buenavista (South Coast)</span>
                        <span class="fw-bold">12 Students (18.8%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: 18.8%;"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Out-of-Province (Mindoro, Batangas, Quezon)</span>
                        <span class="fw-bold">10 Students (15.6%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 15.6%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- College Representation -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="mb-0 fw-bold text-marsu-burgundy">
                    <i class="bi bi-mortarboard-fill me-2 text-gold"></i>Distribution by Academic College
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>College of Information and Computing Sciences (CICS)</span>
                        <span class="fw-bold">28 Students (43.8%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-marsu" style="width: 43.8%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>College of Engineering (COE)</span>
                        <span class="fw-bold">16 Students (25.0%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 25.0%;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>College of Business and Accountancy (CBA)</span>
                        <span class="fw-bold">12 Students (18.8%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: 18.8%;"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span>College of Allied Health Sciences (CAHS)</span>
                        <span class="fw-bold">8 Students (12.4%)</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 12.4%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

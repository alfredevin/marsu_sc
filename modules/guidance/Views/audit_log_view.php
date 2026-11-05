<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: USER ACTIVITY LOG VIEW               -->
<!-- ==================================================================== -->

<style>
    .btn-outline-marsu {
        color: #800020;
        border-color: #800020;
    }

    .btn-outline-marsu:hover {
        background-color: #800020;
        color: #ffffff;
    }
</style>

<!-- 1. BREADCRUMB & PAGE HEADER -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <!-- Breadcrumb Trail -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb mb-0"
                style="font-size: 14.5px; background: transparent; padding: 0; line-height: 1.5;">
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/audit_security_logs') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Activity &amp; Audit Logs
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    View Log
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Activity Log Details
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Recorded user activity details showing user name, IP address, and date of event.
                </p>
            </div>
            <div>
                <a href="<?= url('guidance/audit_security_logs') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center"
                    style="height: 38px; border-radius: 6px; font-size: 14px; font-weight: 500; padding: 0 16px;">
                    <i class="bi bi-arrow-left me-2"></i>Back to Activity Logs
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 2. ACTIVITY LOG DETAILS (NAME, IP ADDRESS, DATE ONLY) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-header bg-white py-3 px-4" style="border-bottom: 1px solid #E2E8F0;">
        <h6 class="fw-bold mb-0 text-dark" style="font-size: 15px;">
            Log Record Information
        </h6>
    </div>

    <div class="card-body p-4">
        <div class="row g-4" style="font-size: 14px;">
            <!-- Name -->
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">User Name:</span>
                <div class="p-3 bg-light rounded border">
                    <strong class="text-dark fs-6" id="viewLogName">-</strong>
                </div>
            </div>

            <!-- IP Address -->
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">IP Address:</span>
                <div class="p-3 bg-light rounded border">
                    <strong class="text-primary font-monospace fs-6" id="viewLogIp">-</strong>
                </div>
            </div>

            <!-- Date -->
            <div class="col-md-4 col-12">
                <span class="text-muted d-block small mb-1">Date:</span>
                <div class="p-3 bg-light rounded border">
                    <strong class="text-dark fs-6" id="viewLogDate">-</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   VANILLA JAVASCRIPT: LOAD LOG DETAILS                               -->
<!-- ==================================================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadLogRecordDetails();
    });

    /**
     * Load Log Record Details from URL query params or localStorage
     */
    function loadLogRecordDetails() {
        const urlParams = new URLSearchParams(window.location.search);
        const paramId = parseInt(urlParams.get('id') || '1');
        const paramName = urlParams.get('name');
        const paramIp = urlParams.get('ip');
        const paramDate = urlParams.get('date');

        if (paramName && paramIp && paramDate) {
            document.getElementById('viewLogName').textContent = paramName;
            document.getElementById('viewLogIp').textContent = paramIp;
            document.getElementById('viewLogDate').textContent = paramDate;
            return;
        }

        let logs = [];
        try {
            logs = JSON.parse(localStorage.getItem('marsu_audit_logs') || '[]');
        } catch (e) {
            console.error(e);
        }

        const log = logs.find(l => l.id === paramId) || {
            name: "SANTOS, MARIA C.",
            ip: "192.168.1.45",
            date: "2026-10-30"
        };

        document.getElementById('viewLogName').textContent = log.name || 'SANTOS, MARIA C.';
        document.getElementById('viewLogIp').textContent = log.ip || '192.168.1.45';
        document.getElementById('viewLogDate').textContent = log.date || '2026-10-30';
    }
</script>
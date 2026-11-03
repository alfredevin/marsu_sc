<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: USER ACTIVITY & AUDIT LOGS           -->
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

    .report-summary-strip {
        background-color: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        padding: 12px 18px;
        margin-bottom: 16px;
        font-size: 13.5px;
    }
</style>

<!-- 1. PAGE HEADER (Without Print or Export CSV) -->
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
                    <span class="text-muted">User Management</span>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Activity &amp; Audit Logs
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    User Activity &amp; Audit Logs
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Chronological activity log tracking user logins, logouts, and record modifications by students and
                    faculty.
                </p>
            </div>
            <div>
                <span class="badge" id="auditLogCountBadge"
                    style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 13px; font-weight: 600; padding: 8px 14px; border-radius: 6px;">
                    Showing 13 of 13 Records
                </span>
            </div>
        </div>
    </div>
</div>

<!-- 2. SEARCH & FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <!-- Search by Name, User ID, IP, or Activity -->
            <div class="col-lg-5 col-md-5 col-12">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="auditSearchInput" class="form-control border-start-0 shadow-none ps-2"
                        placeholder="Search by Name, User ID, IP Address, or Activity..."
                        oninput="filterAuditLogsTable()" style="height: 38px; font-size: 13.5px;">
                </div>
            </div>

            <!-- Filter by User Type (Student / Faculty) -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                <select id="userTypeFilter" class="form-select shadow-none" onchange="filterAuditLogsTable()"
                    style="height: 38px; font-size: 13.5px;">
                    <option value="all">All User Types (Student &amp; Faculty)</option>
                    <option value="Student">Students Only</option>
                    <option value="Faculty">Faculty &amp; Staff Only</option>
                </select>
            </div>

            <!-- Filter by Activity Type (Login/Logout, Record Input) -->
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                <select id="activityTypeFilter" class="form-select shadow-none" onchange="filterAuditLogsTable()"
                    style="height: 38px; font-size: 13.5px;">
                    <option value="all">All Activities</option>
                    <option value="login">Log In / Log Out Only</option>
                    <option value="input">Data Input &amp; Submissions</option>
                </select>
            </div>

            <!-- Reset Button -->
            <div class="col-lg-2 col-md-2 col-12 text-end">
                <button type="button" onclick="resetAuditFilters()"
                    class="btn w-100 shadow-none d-flex align-items-center justify-content-center"
                    style="border: 1px solid #ced4da; background-color: #f8f9fa; color: #495057; font-size: 13.5px; height: 38px; font-weight: 500; border-radius: 6px;">
                    <i class="bi bi-arrow-counterclockwise me-1.5"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 3. ACTIVITY & AUDIT LOG MASTER TABLE -->
<!-- Note: Column renamed to 'Activity' (strictly no icons). Action button has eye icon only linking to another page -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white" id="auditLogsMasterTable"
                style="font-size: 14px;">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Date
                            &amp; Time</th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">User Name
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">User ID
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">User Type
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">Activity
                        </th>
                        <th class="text-nowrap" style="padding: 14px 16px; color: #2D3748; font-weight: 600;">IP Address
                        </th>
                        <th class="text-center pe-4 text-nowrap col-action"
                            style="padding: 14px 16px; color: #2D3748; font-weight: 600; width: 70px;">Action</th>
                    </tr>
                </thead>
                <tbody id="auditLogsTableBody">
                    <!-- Populated dynamically via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   VANILLA JAVASCRIPT: LOGS ENGINE                                    -->
<!-- ==================================================================== -->
<script>
    // Master Activity & Audit Database (Student & Faculty Logins, Logouts, and Inputs)
    const auditLogsData = [
        {
            id: 1,
            log_id: "LOG-2026-001",
            date: "2026-10-30",
            time: "09:30 AM",
            name: "SANTOS, MARIA C.",
            user_id: "2023-01042",
            type: "Student",
            activity: "User Log In",
            is_login: true,
            ip: "192.168.1.45"
        },
        {
            id: 2,
            log_id: "LOG-2026-002",
            date: "2026-10-30",
            time: "09:42 AM",
            name: "SANTOS, MARIA C.",
            user_id: "2023-01042",
            type: "Student",
            activity: "Submitted Student Feedback",
            is_login: false,
            ip: "192.168.1.45"
        },
        {
            id: 3,
            log_id: "LOG-2026-003",
            date: "2026-10-30",
            time: "09:55 AM",
            name: "SANTOS, MARIA C.",
            user_id: "2023-01042",
            type: "Student",
            activity: "User Log Out",
            is_login: true,
            ip: "192.168.1.45"
        },
        {
            id: 4,
            log_id: "LOG-2026-004",
            date: "2026-10-30",
            time: "08:15 AM",
            name: "DR. MARIA RAMOS",
            user_id: "FAC-2018-04",
            type: "Faculty",
            activity: "User Log In",
            is_login: true,
            ip: "192.168.10.12"
        },
        {
            id: 5,
            log_id: "LOG-2026-005",
            date: "2026-10-30",
            time: "08:35 AM",
            name: "DR. MARIA RAMOS",
            user_id: "FAC-2018-04",
            type: "Faculty",
            activity: "Submitted Faculty Referral",
            is_login: false,
            ip: "192.168.10.12"
        },
        {
            id: 6,
            log_id: "LOG-2026-006",
            date: "2026-10-29",
            time: "02:10 PM",
            name: "RAMOS, CARLOS M.",
            user_id: "2023-01089",
            type: "Student",
            activity: "User Log In",
            is_login: true,
            ip: "192.168.1.88"
        },
        {
            id: 7,
            log_id: "LOG-2026-007",
            date: "2026-10-29",
            time: "02:25 PM",
            name: "RAMOS, CARLOS M.",
            user_id: "2023-01089",
            type: "Student",
            activity: "Requested Appointment",
            is_login: false,
            ip: "192.168.1.88"
        },
        {
            id: 8,
            log_id: "LOG-2026-008",
            date: "2026-10-29",
            time: "02:40 PM",
            name: "RAMOS, CARLOS M.",
            user_id: "2023-01089",
            type: "Student",
            activity: "User Log Out",
            is_login: true,
            ip: "192.168.1.88"
        },
        {
            id: 9,
            log_id: "LOG-2026-009",
            date: "2026-10-29",
            time: "11:20 AM",
            name: "ENGR. ALLAN BAUTISTA",
            user_id: "FAC-2019-11",
            type: "Faculty",
            activity: "User Log In",
            is_login: true,
            ip: "192.168.10.35"
        },
        {
            id: 10,
            log_id: "LOG-2026-010",
            date: "2026-10-29",
            time: "11:45 AM",
            name: "ENGR. ALLAN BAUTISTA",
            user_id: "FAC-2019-11",
            type: "Faculty",
            activity: "Submitted Case Registration",
            is_login: false,
            ip: "192.168.10.35"
        },
        {
            id: 11,
            log_id: "LOG-2026-011",
            date: "2026-10-29",
            time: "12:05 PM",
            name: "ENGR. ALLAN BAUTISTA",
            user_id: "FAC-2019-11",
            type: "Faculty",
            activity: "User Log Out",
            is_login: true,
            ip: "192.168.10.35"
        },
        {
            id: 12,
            log_id: "LOG-2026-012",
            date: "2026-10-28",
            time: "04:30 PM",
            name: "REYES, MARK ANTHONY",
            user_id: "2023-02194",
            type: "Student",
            activity: "User Log In",
            is_login: true,
            ip: "192.168.1.102"
        },
        {
            id: 13,
            log_id: "LOG-2026-013",
            date: "2026-10-28",
            time: "05:00 PM",
            name: "REYES, MARK ANTHONY",
            user_id: "2023-02194",
            type: "Student",
            activity: "User Log Out",
            is_login: true,
            ip: "192.168.1.102"
        }
    ];

    let currentFilteredAuditLogs = [...auditLogsData];

    document.addEventListener('DOMContentLoaded', function () {
        // Persist audit logs to localStorage so audit_log_view can load them
        try {
            localStorage.setItem('marsu_audit_logs', JSON.stringify(auditLogsData));
        } catch (e) {
            console.error('Storage error:', e);
        }

        renderAuditLogsTable(auditLogsData);
    });

    /**
     * Filter Audit Logs
     */
    function filterAuditLogsTable() {
        const q = (document.getElementById('auditSearchInput').value || '').toLowerCase().trim();
        const userTypeFilter = document.getElementById('userTypeFilter').value;
        const activityFilter = document.getElementById('activityTypeFilter').value;

        currentFilteredAuditLogs = auditLogsData.filter(item => {
            const matchesQuery = !q ||
                item.name.toLowerCase().includes(q) ||
                item.user_id.toLowerCase().includes(q) ||
                item.ip.toLowerCase().includes(q) ||
                item.activity.toLowerCase().includes(q);

            const matchesUserType = (userTypeFilter === 'all') || (item.type === userTypeFilter);

            let matchesActivity = true;
            if (activityFilter === 'login') {
                matchesActivity = item.is_login === true;
            } else if (activityFilter === 'input') {
                matchesActivity = item.is_login === false;
            }

            return matchesQuery && matchesUserType && matchesActivity;
        });

        renderAuditLogsTable(currentFilteredAuditLogs);
    }

    /**
     * Reset Filters
     */
    function resetAuditFilters() {
        document.getElementById('auditSearchInput').value = '';
        document.getElementById('userTypeFilter').value = 'all';
        document.getElementById('activityTypeFilter').value = 'all';
        currentFilteredAuditLogs = [...auditLogsData];
        renderAuditLogsTable(currentFilteredAuditLogs);
    }

    /**
     * Render Table Rows
     * Activity column has strictly NO ICONS
     * Action button has eye icon ONLY linking to another view page
     */
    function renderAuditLogsTable(list) {
        const tbody = document.getElementById('auditLogsTableBody');
        const badge = document.getElementById('auditLogCountBadge');
        if (badge) badge.textContent = `Showing ${list.length} of ${auditLogsData.length} Records`;

        if (!tbody) return;
        tbody.innerHTML = '';

        if (!list.length) {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center py-5 text-muted">No activity logs found matching the filters.</td></tr>`;
            return;
        }

        list.forEach(item => {
            const tr = document.createElement('tr');
            tr.className = 'align-middle';

            // User type badge styling
            const typeBadge = item.type === 'Student'
                ? '<span class="badge" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">Student</span>'
                : '<span class="badge" style="background-color: #FDF2F4; color: #800020; border: 1px solid #f8d7da; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">Faculty</span>';

            // Activity styling - STRICTLY NO ICONS as requested
            let activityBadge = '';
            if (item.activity === 'User Log In') {
                activityBadge = '<span class="badge" style="background-color: #F0FDF4; color: #166534; border: 1px solid #BBF7D0; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">User Log In</span>';
            } else if (item.activity === 'User Log Out') {
                activityBadge = '<span class="badge" style="background-color: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">User Log Out</span>';
            } else {
                activityBadge = '<span class="badge" style="background-color: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 4px;">' + item.activity + '</span>';
            }

            tr.innerHTML = `
                <td class="ps-4 text-nowrap" style="padding: 13px 16px;">
                    <span class="text-dark fw-medium">${item.date}</span>
                    <span class="text-muted small d-block">${item.time}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="fw-bold text-dark">${item.name}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <span class="fw-bold text-dark font-monospace">${item.user_id}</span>
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    ${typeBadge}
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    ${activityBadge}
                </td>
                <td class="text-nowrap" style="padding: 13px 16px;">
                    <code class="text-primary font-monospace">${item.ip}</code>
                </td>
                <td class="text-center pe-4 text-nowrap col-action" style="padding: 13px 16px;">
                    <a href="<?= url('guidance/audit_log_view') ?>?id=${item.id}&name=${encodeURIComponent(item.name)}&ip=${encodeURIComponent(item.ip)}&date=${encodeURIComponent(item.date)}"
                       class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                       title="View Log Details" aria-label="View Log Details"
                       style="width: 34px; height: 34px; border-radius: 6px; font-size: 15px; padding: 0;">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }
</script>
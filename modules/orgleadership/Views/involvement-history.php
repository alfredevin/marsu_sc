<?php
/**
 * Student Involvement History View
 * Read-only aggregated view of student involvement across organizations.
 *
 * Variables passed by the controller:
 *   $title, $moduleName, $slug, $user
 *   $involvements (array) - aggregated student involvement data
 *   $searchQuery (string) - current search filter text
 */

$involvements = $involvements ?? [];
$searchQuery  = $searchQuery ?? '';
?>

<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 mb-1 text-marsu-burgundy fw-bold">
            <i class="bi bi-clock-history me-2"></i><?= e($title ?? 'Student Involvement History') ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="<?= url('orgleadership/dashboard') ?>" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Involvement History</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Search & Filter Bar -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-3">
        <form method="GET" action="<?= url('orgleadership/involvement-history') ?>" class="row g-2 align-items-end">
            <div class="col-12 col-md-6 col-lg-5">
                <label for="searchInput" class="form-label small fw-semibold mb-1">Search Student</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input
                        type="text"
                        id="searchInput"
                        name="q"
                        class="form-control"
                        placeholder="Search by name or student ID..."
                        value="<?= e($searchQuery) ?>"
                        autocomplete="off"
                    >
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-marsu">
                    <i class="bi bi-search me-1"></i>Search
                </button>
            </div>
            <?php if ($searchQuery !== ''): ?>
                <div class="col-auto">
                    <a href="<?= url('orgleadership/involvement-history') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i>Clear
                    </a>
                </div>
            <?php endif; ?>
        </form>

        <?php if ($searchQuery !== ''): ?>
            <div class="mt-2">
                <span class="badge badge-gold fs-6 fw-normal">
                    <i class="bi bi-funnel-fill me-1"></i>Showing results for: <strong><?= e($searchQuery) ?></strong>
                </span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Summary Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center py-3">
                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Students</div>
                <div class="h4 fw-bold text-marsu-burgundy mb-0"><?= number_format(count($involvements)) ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center py-3">
                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Activities</div>
                <div class="h4 fw-bold text-marsu-burgundy mb-0">
                    <?php
                    $sumActivities = 0;
                    foreach ($involvements as $inv) {
                        $sumActivities += (int)($inv['total_activities'] ?? 0);
                    }
                    echo number_format($sumActivities);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center py-3">
                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Participations</div>
                <div class="h4 fw-bold text-marsu-burgundy mb-0">
                    <?php
                    $sumParticipations = 0;
                    foreach ($involvements as $inv) {
                        $sumParticipations += (int)($inv['total_participations'] ?? 0);
                    }
                    echo number_format($sumParticipations);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center py-3">
                <div class="text-muted small fw-semibold text-uppercase mb-1">Total Credits</div>
                <div class="h4 fw-bold text-marsu-burgundy mb-0">
                    <?php
                    $sumCredits = 0;
                    foreach ($involvements as $inv) {
                        $sumCredits += (float)($inv['total_credits'] ?? 0);
                    }
                    echo number_format($sumCredits, 1);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold text-marsu-burgundy">
            <i class="bi bi-table me-2"></i>Involvement Records
        </h5>
        <div class="d-flex align-items-center gap-2">
            <label for="tableFilter" class="form-label mb-0 small text-muted d-none d-md-inline">Quick filter:</label>
            <input
                type="text"
                id="tableFilter"
                class="form-control form-control-sm"
                placeholder="Filter table..."
                style="max-width: 220px;"
            >
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0" id="involvementTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Organizations</th>
                        <th class="text-center">Activities Attended</th>
                        <th class="text-center">Participations</th>
                        <th class="text-center">Total Credits</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($involvements)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <?php if ($searchQuery !== ''): ?>
                                        No results found for "<strong><?= e($searchQuery) ?></strong>".
                                    <?php else: ?>
                                        No involvement records found.
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($involvements as $index => $inv): ?>
                            <?php
                            $lastName   = e($inv['last_name'] ?? '');
                            $firstName  = e($inv['first_name'] ?? '');
                            $studentId  = e($inv['student_id'] ?? '');
                            $orgsList   = $inv['organizations_list'] ?? '';
                            $activities = (int)($inv['total_activities'] ?? 0);
                            $participations = (int)($inv['total_participations'] ?? 0);
                            $attendance = (int)($inv['total_attendance'] ?? 0);
                            $credits    = (float)($inv['total_credits'] ?? 0);
                            ?>
                            <tr>
                                <td class="text-center text-muted"><?= $index + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= $lastName ?>, <?= $firstName ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace"><?= $studentId ?></span>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($orgsList)) {
                                        $orgs = array_map('trim', explode(',', $orgsList));
                                        foreach ($orgs as $org):
                                    ?>
                                        <span class="badge badge-gold me-1 mb-1"><?= e($org) ?></span>
                                    <?php
                                        endforeach;
                                    } else {
                                        echo '<span class="text-muted fst-italic">None</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <span class="fw-semibold"><?= number_format($activities) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-semibold"><?= number_format($participations) ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if ($credits > 0): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-2 py-1">
                                            <?= number_format($credits, 1) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">0.0</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (!empty($involvements)): ?>
        <div class="card-footer bg-white text-muted small py-2">
            Showing <?= number_format(count($involvements)) ?> student<?= count($involvements) !== 1 ? 's' : '' ?>
        </div>
    <?php endif; ?>
</div>

<!-- Client-side table filter -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterInput = document.getElementById('tableFilter');
    const table = document.getElementById('involvementTable');

    if (!filterInput || !table) return;

    const tbody = table.querySelector('tbody');

    filterInput.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(function (row) {
            // Skip the "no results" row
            if (row.querySelector('td[colspan]')) return;

            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
});
</script>

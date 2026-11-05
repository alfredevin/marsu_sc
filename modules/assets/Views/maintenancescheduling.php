<?php
/**
 * Facilities Management - Sub-Module 3: Maintenance Scheduling & Job Orders
 * @var string $moduleName
 * @var array  $kpis             Summary metrics array
 * @var array  $schedules        Array of preventive maintenance schedules
 * @var array  $kanbanGroups     Grouped array of job orders by status (scheduled, due, in_progress, completed)
 * @var array  $masterRecords    Array of all maintenance job order records
 */
?>
<main class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-buildings-fill me-1"></i>FACILITIES MANAGEMENT &bull; SUB-MODULE 3
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                <?= e($moduleName ?? 'Maintenance Scheduling & Job Orders') ?>
            </h1>
            <p class="text-muted small mb-0">
                Preventive and corrective job orders across equipment, HVAC, laboratory instruments, and network infrastructure.
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-warning text-dark btn-sm fw-bold shadow-sm" onclick="window.switchMaintenanceSubmodule('repairs');">
                <i class="bi bi-wrench text-warning me-1"></i>New Repair Request
            </button>
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm" onclick="window.openJobOrderModal()">
                <i class="bi bi-plus-circle me-1"></i>Create Job Order
            </button>
        </div>
    </div>

    <!-- Facilities KPI Row -->
    <section class="row g-3 mb-4" aria-label="Facilities key indicators">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-warning p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Buildings &amp; Rooms</div>
                        <div class="h3 fw-bold text-dark font-monospace my-1">
                            <?= e($kpis['active_buildings'] ?? 0) ?> / <?= e($kpis['total_rooms'] ?? 0) ?>
                        </div>
                    </div>
                    <div class="p-2 rounded bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-city fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Complete campus coverage</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-success p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Facility Health Index</div>
                        <div class="h3 fw-bold text-success font-monospace my-1"><?= e($kpis['health_index'] ?? '0') ?>%</div>
                    </div>
                    <div class="p-2 rounded bg-success bg-opacity-10 text-success">
                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Optimized operational state</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-info p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold">Open Job Orders</div>
                        <div class="h3 fw-bold text-info font-monospace my-1"><?= e($kpis['open_jobs'] ?? 0) ?></div>
                    </div>
                    <div class="p-2 rounded bg-info bg-opacity-10 text-info">
                        <i class="bi bi-clipboard-check-fill fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">In progress by maintenance unit</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-danger p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold text-danger">Open Repair Queue</div>
                        <div class="h3 fw-bold text-danger font-monospace my-1"><?= e($kpis['repair_queue'] ?? 0) ?></div>
                    </div>
                    <div class="p-2 rounded bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                </div>
                <div class="small text-muted mt-2">Requires technical review</div>
            </div>
        </div>
    </section>

    <!-- Module Content -->
    <div id="moduleContent" data-module="scheduling">
        
        <!-- Preventive Maintenance Schedule Section -->
        <div class="card shadow-sm mb-4 border-0 p-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <div>
                    <h2 class="h5 fw-bold text-marsu-burgundy m-0">
                        <i class="bi bi-calendar-check-fill text-warning me-2"></i>Preventive Maintenance Schedule
                    </h2>
                    <p class="small text-muted mb-0">Recurring inspections and preventive service plans across campus infrastructure.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input type="search" id="scheduleSearch" class="form-control form-control-sm" placeholder="Search schedule...">
                    <select id="scheduleStatusFilter" class="form-select form-select-sm">
                        <option value="ALL">All Statuses</option>
                        <option value="Scheduled">Scheduled</option>
                        <option value="Due">Due / Overdue</option>
                    </select>
                </div>
            </div>

            <!-- Schedule Cards Grid -->
            <div class="row g-3" id="scheduleCardsGrid">
                <?php if (empty($schedules)): ?>
                    <div class="col-12">
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-x fs-2 d-block mb-1 text-warning"></i>
                            No preventive maintenance schedules found.
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($schedules as $sch): ?>
                        <?php 
                            $status = strtolower($sch['status'] ?? 'scheduled');
                            $borderCol = str_contains($status, 'due') || str_contains($status, 'overdue') ? 'border-danger' : (str_contains($status, 'success') ? 'border-success' : 'border-warning');
                            $badgeBg = str_contains($status, 'due') ? 'bg-danger text-white' : (str_contains($status, 'success') ? 'bg-success text-white' : 'bg-warning text-dark');
                        ?>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light p-3 h-100 border-start border-4 <?= $borderCol ?>">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge <?= $badgeBg ?> font-monospace"><?= e($sch['category']) ?></span>
                                    <span class="small text-muted"><?= e($sch['frequency']) ?></span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1"><?= e($sch['task_title']) ?></h6>
                                <p class="small text-muted mb-2"><?= e($sch['location']) ?></p>
                                <div class="small text-dark mt-auto pt-2 border-top">
                                    <i class="bi bi-person-fill me-1 text-secondary"></i><?= e($sch['assigned_personnel']) ?>
                                    <div class="text-muted font-monospace mt-1">Due: <?= e($sch['due_date']) ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Job Order Pipeline Section -->
        <div class="fm-job-order-tracking">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <h2 class="h5 fw-bold text-marsu-burgundy m-0">
                    <i class="bi bi-kanban-fill text-warning me-2"></i>Job Order Pipeline
                </h2>
                <div class="d-flex flex-wrap gap-2">
                    <input type="search" id="jobSearch" class="form-control form-control-sm" placeholder="Search job ref...">
                    <select id="jobStatusFilter" class="form-select form-select-sm">
                        <option value="ALL">All Statuses</option>
                    </select>
                </div>
            </div>

            <!-- Kanban Pipeline Columns -->
            <div class="row g-3 mb-4">
                <?php 
                    $columns = [
                        'scheduled'   => ['title' => 'Scheduled', 'border' => 'border-secondary', 'badge' => 'bg-secondary'],
                        'due'         => ['title' => 'Due / Overdue', 'border' => 'border-danger', 'badge' => 'bg-danger'],
                        'in_progress' => ['title' => 'In Progress', 'border' => 'border-info', 'badge' => 'bg-info text-dark'],
                        'completed'   => ['title' => 'Completed', 'border' => 'border-success', 'badge' => 'bg-success']
                    ];
                    foreach ($columns as $key => $col):
                        $items = $kanbanGroups[$key] ?? [];
                ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 border-top border-4 <?= $col['border'] ?> p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-bold text-uppercase"><?= e($col['title']) ?></span>
                                <span class="badge <?= $col['badge'] ?>"><?= count($items) ?></span>
                            </div>
                            <?php if (empty($items)): ?>
                                <div class="text-muted small text-center py-3 fst-italic">No items in queue</div>
                            <?php else: ?>
                                <?php foreach ($items as $job): ?>
                                    <div class="p-2 bg-light rounded border small mb-2">
                                        <div class="fw-bold text-marsu-burgundy font-monospace"><?= e($job['job_ref']) ?></div>
                                        <div class="text-dark"><?= e($job['task_title']) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Maintenance Master Records Table -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h3 class="m-0 fw-bold fs-6 text-marsu-burgundy">
                        <i class="bi bi-table text-warning me-2"></i>Sta. Cruz Campus Maintenance Master Records
                    </h3>
                    <span class="badge bg-warning text-dark font-monospace"><?= count($masterRecords ?? []) ?> records</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-marsu bg-marsu-burgundy text-white">
                                <tr>
                                    <th class="py-3">Job Ref</th>
                                    <th class="py-3">Target Asset / Facility</th>
                                    <th class="py-3">Maintenance Task</th>
                                    <th class="py-3">Category</th>
                                    <th class="py-3">Frequency</th>
                                    <th class="py-3">Assigned Personnel</th>
                                    <th class="py-3">Due Date</th>
                                    <th class="py-3">Est. Cost</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($masterRecords)): ?>
                                    <tr>
                                        <td colspan="10" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-1 text-warning"></i>
                                            No maintenance records found in the master registry.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($masterRecords as $rec): ?>
                                        <?php 
                                            $statusText = $rec['status'] ?? 'Scheduled';
                                            $statusBadge = (str_contains(strtolower($statusText), 'progress')) ? 'bg-info text-dark' : ((str_contains(strtolower($statusText), 'due') || str_contains(strtolower($statusText), 'overdue')) ? 'bg-danger' : 'bg-secondary');
                                        ?>
                                        <tr>
                                            <td class="font-monospace fw-bold text-marsu-burgundy"><?= e($rec['job_ref']) ?></td>
                                            <td class="fw-semibold text-dark"><?= e($rec['target_asset']) ?></td>
                                            <td><?= e($rec['maintenance_task']) ?></td>
                                            <td><span class="badge bg-light text-dark border"><?= e($rec['category']) ?></span></td>
                                            <td class="small text-muted"><?= e($rec['frequency']) ?></td>
                                            <td class="small"><?= e($rec['assigned_personnel']) ?></td>
                                            <td class="font-monospace small text-muted"><?= e($rec['due_date']) ?></td>
                                            <td class="font-monospace">&#8369;<?= number_format($rec['est_cost'] ?? 0, 2) ?></td>
                                            <td><span class="badge <?= $statusBadge ?>"><?= e($statusText) ?></span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing <?= e($rec['job_ref']) ?>')">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
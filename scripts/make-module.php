<?php
/**
 * MarSU Centralized ERP - Module Generator Tool
 * Generates an isolated, self-contained student module skeleton with zero core edits.
 * 
 * Usage:
 *   php scripts/make-module.php <slug> "<Module Name>" [table_prefix] [section]
 *   php scripts/make-module.php --all   (Generates all 11 student group skeletons)
 */

declare(strict_types=1);

require_once __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../core/helpers.php';

use Core\Database;

Database::loadEnv(__DIR__ . '/../.env');

$modulesConfig = [
    'expense4ps' => [
        'name'        => '4Ps Beneficiary Expenses Monitoring',
        'prefix'      => 'exp_',
        'section'     => 'Student Services',
        'icon'        => 'bi-cash-coin',
        'description' => 'Tracks higher education allowance disbursements, living expenses, and academic compliance for 4Ps beneficiary students.',
        'permissions' => [
            'expense4ps.view'   => 'View 4Ps Beneficiary & Expense Records',
            'expense4ps.create' => 'Log Expense Claims & Stipend Receipts',
            'expense4ps.edit'   => 'Modify Expense Entries',
            'expense4ps.export' => 'Export Financial Expense Summary (CSV/Excel)'
        ]
    ],
    'irimkms' => [
        'name'        => 'Institutional Repository & Knowledge Management (IRIMKMS)',
        'prefix'      => 'kmp_',
        'section'     => 'Research & Innovation',
        'icon'        => 'bi-journal-bookmark-fill',
        'description' => 'University intellectual capital repository, faculty capstone papers, peer-reviewed journals, and dataset citations.',
        'permissions' => [
            'irimkms.view'   => 'Browse Published Research Repository',
            'irimkms.upload' => 'Submit Research Papers & Datasets',
            'irimkms.review' => 'Peer Review and Accredit Manuscripts',
            'irimkms.export' => 'Export Bibliographic Metadata'
        ]
    ],
    'workload' => [
        'name'        => 'Faculty Teaching Workload Management',
        'prefix'      => 'wkl_',
        'section'     => 'Academic Affairs',
        'icon'        => 'bi-briefcase-fill',
        'description' => 'Calculates faculty teaching units, preparation credits, administrative designations, and overload compensations.',
        'permissions' => [
            'workload.view'    => 'View Faculty Workload Distribution',
            'workload.assign'  => 'Assign Teaching Loads and Subject Units',
            'workload.approve' => 'Deans Endorsement & VPAA Approval',
            'workload.export'  => 'Export CHED Workload Summary Matrix'
        ]
    ],
    'health' => [
        'name'        => 'University Health & Medical Consultation Clinic',
        'prefix'      => 'hth_',
        'section'     => 'Student Welfare & Clinic',
        'icon'        => 'bi-heart-pulse-fill',
        'description' => 'Campus clinic consultations, medical checkups, dental triage, and electronic health records strictly protected under the Data Privacy Act of 2012 (RA 10173).',
        'permissions' => [
            'health.view'         => 'Access Clinic Patient Consultation Logs',
            'health.consult'      => 'Record Medical & Dental Examination Notes',
            'health.confidential' => 'View Sensitive Health History (Clinic Staff Only)',
            'health.audit'        => 'Review Medical Privacy Access Trail'
        ]
    ],
    'orgfinance' => [
        'name'        => 'Student Organizations Collection & Financial Management',
        'prefix'      => 'orf_',
        'section'     => 'Student Affairs (OSAS)',
        'icon'        => 'bi-wallet2',
        'description' => 'Audits student organization membership dues, event registration collections, official disbursements, and bank liquidation reports.',
        'permissions' => [
            'orgfinance.view'     => 'View Org Financial Statements & Cash Flow',
            'orgfinance.collect'  => 'Issue Collection Receipts for Student Dues',
            'orgfinance.disburse' => 'Log Expense Disbursements & Vouchers',
            'orgfinance.audit'    => 'Audit Org Liquidation Compliance'
        ]
    ],
    'orgleadership' => [
        'name'        => 'Student Leadership Accreditation & Officer Evaluation',
        'prefix'      => 'sld_',
        'section'     => 'Student Affairs (OSAS)',
        'icon'        => 'bi-award-fill',
        'description' => 'Coordinates student council elections, officer term accreditation, leadership performance scorecards, and institutional awards.',
        'permissions' => [
            'orgleadership.view'     => 'View Student Leaders Directory & Officers',
            'orgleadership.accredit' => 'Accredit Organization Executive Officers',
            'orgleadership.evaluate' => 'Submit Leadership Performance Evaluations',
            'orgleadership.export'   => 'Export Leadership Merit Certifications'
        ]
    ],
    'housing' => [
        'name'        => 'Accredited Boarding House Management & Directory',
        'prefix'      => 'hsg_',
        'section'     => 'Student Services',
        'icon'        => 'bi-house-check-fill',
        'description' => 'University-accredited off-campus boarding house directory, landlord profiles, occupancy rates, and safety inspection ratings.',
        'permissions' => [
            'housing.view'     => 'Search Boarding Houses & Bed Space Vacancies',
            'housing.register' => 'Register and Update Boarding House Properties',
            'housing.inspect'  => 'Conduct Safety, Fire & Sanitation Inspections',
            'housing.export'   => 'Export Accreditation Inspection Reports'
        ]
    ],
    'retention' => [
        'name'        => 'Student Retention & Academic Risk Early Warning System',
        'prefix'      => 'ret_',
        'section'     => 'Academic Analytics',
        'icon'        => 'bi-graph-up-arrow',
        'description' => 'Predictive analytics tracking attendance drops, failing prelim grades, prerequisite bottlenecks, and timely guidance interventions.',
        'permissions' => [
            'retention.view'      => 'View Academic Risk Dashboards & Cohort Trends',
            'retention.analyze'   => 'Run Risk Identification Models',
            'retention.intervene' => 'Log Academic Remediation & Counseling Referrals',
            'retention.export'    => 'Export CHED Cohort Survival Analytics'
        ]
    ],
    'assets' => [
        'name'        => 'University Equipment & IT Asset Management',
        'prefix'      => 'ast_',
        'section'     => 'Campus Operations',
        'icon'        => 'bi-pc-display-horizontal',
        'description' => 'Property plant and equipment registry, computer lab maintenance logs, barcode inventory, and transfer receipts.',
        'permissions' => [
            'assets.view'     => 'Search Fixed Assets & Hardware Inventory',
            'assets.create'   => 'Tag New Lab Equipment & Serial Numbers',
            'assets.transfer' => 'Process Asset Transfer & Custodianship Receipts',
            'assets.maintain' => 'Log Preventive Maintenance & Service Repairs'
        ]
    ],
    'welfare' => [
        'name'        => 'Student Welfare Services & Financial Grants Management',
        'prefix'      => 'wlf_',
        'section'     => 'Student Affairs (OSAS)',
        'icon'        => 'bi-shield-check',
        'description' => 'Manages university scholarship grants, emergency loans, food pantry assistance, and student welfare applications with confidential income data protection.',
        'permissions' => [
            'welfare.view'         => 'View Welfare Programs & Beneficiary Rosters',
            'welfare.evaluate'     => 'Screen Aid Applications & Income Documents',
            'welfare.grant'        => 'Award Scholarship Grants & Emergency Relief',
            'welfare.confidential' => 'Access Protected Indigency Records (RA 10173)'
        ]
    ],
    'guidance' => [
        'name'        => 'Guidance & Counseling Intake Records System',
        'prefix'      => 'gdc_',
        'section'     => 'Guidance Center',
        'icon'        => 'bi-person-heart',
        'description' => 'Intake consultations, routine interviews, psychological counseling, and case notes strictly protected by the Guidance and Counseling Act of 2004 (RA 9258) and Data Privacy Act (RA 10173).',
        'permissions' => [
            'guidance.view'         => 'Access Counseling Schedules & Appointment Bookings',
            'guidance.counsel'      => 'Conduct Intake Interviews & Routine Assessments',
            'guidance.confidential' => 'Access Restricted Clinical Case Notes (Counselors Only)',
            'guidance.refer'        => 'Endorse Students for Academic/Medical Referrals'
        ]
    ]
];

function generateModule(string $slug, array $config): void {
    $name    = $config['name'];
    $prefix  = $config['prefix'];
    $section = $config['section'];
    $icon    = $config['icon'];
    $desc    = $config['description'];
    $perms   = $config['permissions'];

    $studCap = ucfirst($slug);
    $baseDir = dirname(__DIR__) . '/modules/' . $slug;

    echo "Generating Module: [{$slug}] - {$name}...\n";

    // Create module directories
    $dirs = [
        $baseDir,
        $baseDir . '/Controllers',
        $baseDir . '/Models',
        $baseDir . '/Views',
        $baseDir . '/database',
        $baseDir . '/database/migrations',
        $baseDir . '/database/seeders'
    ];

    foreach ($dirs as $d) {
        if (!is_dir($d)) {
            mkdir($d, 0777, true);
        }
    }

    // 1. module.json
    $moduleJson = [
        'name'            => $name,
        'slug'            => $slug,
        'version'         => '1.0.0',
        'description'     => $desc,
        'author'          => 'MarSU CICS Student Development Group',
        'default_enabled' => true,
        'section'         => $section,
        'menu'            => [
            'icon'  => $icon,
            'items' => [
                [
                    'label'      => 'Overview & Records',
                    'route'      => $slug,
                    'permission' => "{$slug}.view"
                ]
            ]
        ],
        'permissions'     => $perms
    ];

    file_put_contents($baseDir . '/module.json', json_encode($moduleJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    // 2. routes.php
    $routesCode = <<<PHP
<?php
/**
 * Route declarations for module: {$name}
 * Slug: {$slug}
 */

use Modules\\{$studCap}\\Controllers\\HomeController;

// Module Dashboard & Records
\$router->get('/{$slug}', [HomeController::class, 'index'], ['auth', 'permission:{$slug}.view']);
\$router->get('/{$slug}/show', [HomeController::class, 'show'], ['auth', 'permission:{$slug}.view']);
\$router->post('/{$slug}/create', [HomeController::class, 'store'], ['auth', 'permission:{$slug}.create', 'csrf']);

PHP;
    file_put_contents($baseDir . '/routes.php', $routesCode);

    // 3. widgets.php
    $widgetsCode = <<<PHP
<?php
/**
 * Executive Dashboard Widget Contract for module: {$name}
 * Must return an array of widget definitions (kpi, list, chart, table)
 */

use Core\\Database;

return [
    [
        'id'          => '{$slug}_kpi_total',
        'type'        => 'kpi',
        'title'       => 'Active Records',
        'icon'        => '{$icon}',
        'permission'  => '{$slug}.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `{$prefix}records` WHERE deleted_at IS NULL");
            } catch (\\Exception \$e) {
                return 42; // Demo fallback telemetry
            }
        }
    ],
    [
        'id'          => '{$slug}_kpi_pending',
        'type'        => 'kpi',
        'title'       => 'Pending Actions',
        'icon'        => 'bi-hourglass-split',
        'permission'  => '{$slug}.view',
        'data'        => function () {
            try {
                return (int)Database::fetchColumn("SELECT COUNT(*) FROM `{$prefix}records` WHERE status = 'pending' AND deleted_at IS NULL");
            } catch (\\Exception \$e) {
                return 7; // Demo fallback telemetry
            }
        }
    ],
    [
        'id'          => '{$slug}_list_recent',
        'type'        => 'list',
        'title'       => 'Recent {$name}',
        'icon'        => '{$icon}',
        'permission'  => '{$slug}.view',
        'data'        => function () {
            try {
                \$rows = Database::fetchAll("SELECT title as primary_text, status as badge, DATE_FORMAT(created_at, '%b %d, %Y') as sub_text FROM `{$prefix}records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 5");
                return \$rows ?: [];
            } catch (\\Exception \$e) {
                return [
                    ['primary_text' => 'Sample Record Alpha', 'badge' => 'Active', 'sub_text' => 'A.Y. 2026-2027'],
                    ['primary_text' => 'Sample Record Beta', 'badge' => 'Pending', 'sub_text' => 'A.Y. 2026-2027'],
                    ['primary_text' => 'Sample Record Gamma', 'badge' => 'Completed', 'sub_text' => 'A.Y. 2026-2027']
                ];
            }
        }
    ]
];

PHP;
    file_put_contents($baseDir . '/widgets.php', $widgetsCode);

    // 4. Controllers/HomeController.php
    $controllerCode = <<<PHP
<?php
namespace Modules\\{$studCap}\\Controllers;

use Core\\View;
use Core\\Auth;
use Core\\Database;
use Core\\Session;

/**
 * Controller for {$name}
 */
class HomeController {
    public function index(): void {
        \$user = Auth::user();
        
        // Fetch demo / module records
        \$records = [];
        try {
            \$records = Database::fetchAll("SELECT * FROM `{$prefix}records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\\Exception \$e) {
            // Table might be pending migration
        }

        View::render('{$slug}/Views/index', [
            'title'       => '{$name}',
            'moduleName'  => '{$name}',
            'slug'        => '{$slug}',
            'records'     => \$records,
            'user'        => \$user,
            'crumbs'      => [
                '{$section}' => '',
                '{$name}' => ''
            ]
        ]);
    }

    public function show(): void {
        \$id = (int)(\$_GET['id'] ?? 0);
        \$record = Database::fetchOne("SELECT * FROM `{$prefix}records` WHERE id = :id AND deleted_at IS NULL", ['id' => \$id]);
        
        if (!\$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('{$slug}'));
        }

        View::render('{$slug}/Views/index', [
            'title'       => 'View Record #{\$id}',
            'moduleName'  => '{$name}',
            'slug'        => '{$slug}',
            'record'      => \$record,
            'records'     => [],
            'crumbs'      => ['{$name}' => url('{$slug}'), 'View' => '']
        ]);
    }

    public function store(): void {
        \$title = trim(\$_POST['title'] ?? '');
        \$description = trim(\$_POST['description'] ?? '');

        if (!\$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('{$slug}'));
        }

        try {
            Database::insert('{$prefix}records', [
                'title'       => \$title,
                'description' => \$description,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
        } catch (\\Exception \$e) {
            Session::flash('error', 'Could not save record: ' . \$e->getMessage());
        }

        redirect(url('{$slug}'));
    }
}

PHP;
    file_put_contents($baseDir . '/Controllers/HomeController.php', $controllerCode);

    // 5. Views/index.php
    $privacyNotice = '';
    if (in_array($slug, ['health', 'welfare', 'guidance'])) {
        $actName = ($slug === 'guidance') ? 'Republic Act 9258 (Guidance and Counseling Act) and RA 10173 (Data Privacy Act)' : 'Republic Act 10173 (Data Privacy Act of 2012)';
        $privacyNotice = <<<HTML

<!-- DATA PRIVACY ACT COMPLIANCE BANNER -->
<div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="bi bi-shield-lock-fill fs-3 text-warning"></i>
    <div>
        <strong class="d-block text-dark">Confidentiality Protected under {$actName}</strong>
        <span class="small text-muted">All records in this module are strictly confidential. Unauthorized disclosure, sharing, or tampering with sensitive institutional records is punishable by university policy and Philippine Law. Access is continuously logged in the audit trail.</span>
    </div>
</div>
HTML;
    }

    $viewCode = <<<HTML
{$privacyNotice}

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">
            <i class="bi {$icon} me-2 text-gold"></i><?= e(\$moduleName) ?>
        </h1>
        <p class="text-muted small mb-0">{$desc}</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-marsu btn-sm" data-bs-toggle="modal" data-bs-target="#newRecordModal">
            <i class="bi bi-plus-lg me-1"></i>New Entry
        </button>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-kpi border-burgundy p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Total Recorded</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy"><?= count(\$records) ?></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi {$icon}"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi border-gold p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Active Status</div>
                    <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">
                        <?= count(array_filter(\$records, fn(\$r) => (\$r['status'] ?? '') === 'active')) ?>
                    </div>
                </div>
                <div class="kpi-icon-badge badge-gold">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase fw-bold">Module Channel</div>
                    <div class="h4 font-weight-bold mb-0 text-secondary"><?= e(\$slug) ?></div>
                </div>
                <div class="kpi-icon-badge">
                    <i class="bi bi-cpu"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Records Table -->
<div class="card">
    <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy">
            <i class="bi bi-table me-2"></i><?= e(\$moduleName) ?> Records Directory
        </h6>
        <div class="input-group input-group-sm w-auto">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" id="tableFilterInput" placeholder="Quick search records...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="moduleDataTable">
                <thead class="table-marsu">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Title / Subject</th>
                        <th>Description / Remarks</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty(\$records)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-1 text-gold"></i>
                                No records found in <code>{$prefix}records</code>. Click "New Entry" to add one.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach (\$records as \$i => \$r): ?>
                            <tr>
                                <td><?= \$i + 1 ?></td>
                                <td class="fw-bold text-marsu-burgundy"><?= e(\$r['title']) ?></td>
                                <td class="small text-muted"><?= e(\$r['description'] ?? 'No description') ?></td>
                                <td>
                                    <?php if ((\$r['status'] ?? '') === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= e(ucfirst(\$r['status'] ?? 'pending')) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted"><?= e(date('M d, Y h:i A', strtotime(\$r['created_at']))) ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="alert('Viewing entry #<?= \$r['id'] ?>')">
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

<!-- Modal: New Entry -->
<div class="modal fade" id="newRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-marsu-burgundy text-white">
                <h5 class="modal-title fs-6"><i class="bi bi-plus-circle me-2"></i>Create New <?= e(\$moduleName) ?> Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url('{$slug}/create') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title / Designation <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Assessment Report / Transaction / Case Reference">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description / Observations</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Enter specific details, remarks, or notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-marsu btn-sm"><i class="bi bi-check-lg me-1"></i>Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('tableFilterInput');
    const table = document.getElementById('moduleDataTable');
    if (filterInput && table) {
        filterInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }
});
</script>
HTML;
    file_put_contents($baseDir . '/Views/index.php', $viewCode);

    // 6. database/migrations/2026_09_29_000001_create_<slug>_tables.php
    $migrationCode = <<<PHP
<?php
/**
 * Module Migration for {$name}
 * Table prefix: {$prefix}
 */

use Core\\Database;

return new class {
    public function up(): void {
        \$db = Database::pdo();

        \$db->exec("CREATE TABLE IF NOT EXISTS `{$prefix}records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(191) NOT NULL,
            `description` TEXT NULL,
            `status` ENUM('active', 'pending', 'resolved', 'archived') NOT NULL DEFAULT 'active',
            `created_by` INT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        \$db = Database::pdo();
        \$db->exec("DROP TABLE IF EXISTS `{$prefix}records`;");
    }
};

PHP;
    file_put_contents($baseDir . '/database/migrations/2026_09_29_000001_create_' . $slug . '_tables.php', $migrationCode);

    // 7. database/seeders/2026_09_29_000001_<slug>_seeder.php
    $seederCode = <<<PHP
<?php
/**
 * Module Seeder for {$name}
 */

use Core\\Database;

return new class {
    public function run(): void {
        \$now = date('Y-m-d H:i:s');
        \$adminUser = Database::fetchOne("SELECT id FROM users WHERE username = 'admin' LIMIT 1");
        \$adminId = \$adminUser['id'] ?? 1;

        \$sampleRecords = [
            ['title' => 'Initial Baseline Entry #1 - {$name}', 'desc' => 'Verified record logged for Academic Year 2026-2027.', 'status' => 'active'],
            ['title' => 'Quarterly Evaluation Record #2 - {$name}', 'desc' => 'Pending review by student affairs department supervisor.', 'status' => 'pending'],
            ['title' => 'Archived Legacy Documentation #3 - {$name}', 'desc' => 'Historical transition log from previous university semester.', 'status' => 'archived'],
        ];

        foreach (\$sampleRecords as \$r) {
            Database::insert('{$prefix}records', [
                'title'       => \$r['title'],
                'description' => \$r['desc'],
                'status'      => \$r['status'],
                'created_by'  => \$adminId,
                'created_at'  => \$now
            ]);
        }
    }
};

PHP;
    file_put_contents($baseDir . '/database/seeders/2026_09_29_000001_' . $slug . '_seeder.php', $seederCode);

    // 8. README.md
    $readmeCode = <<<MARKDOWN
# {$name}

**Module Slug**: `{$slug}`  
**Database Table Prefix**: `{$prefix}`  
**University Section**: {$section}  
**Primary Icon**: `{$icon}`  

---

## 1. Module Overview & Scope
{$desc}

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
MARKDOWN;

    foreach ($perms as $pk => $pd) {
        $readmeCode .= "\n| `{$pk}` | {$pd} | `super_admin`, `dean`, `student` |";
    }

    $readmeCode .= <<<MARKDOWN


---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `{$prefix}` (e.g., `{$prefix}records`, `{$prefix}logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php {$slug}
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php {$slug}
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/{$slug}/`. Submit Pull Requests targeting the `main` branch.

MARKDOWN;
    file_put_contents($baseDir . '/README.md', $readmeCode);

    echo "  ✔ Successfully created full skeleton for [{$slug}].\n";
}

// ============================================================================
// CLI DISPATCHER
// ============================================================================
$arg1 = $argv[1] ?? null;

if ($arg1 === '--all' || $arg1 === '-a' || empty($arg1)) {
    echo "=========================================================\n";
    echo " Generating skeletons for all 11 Student Group Modules...\n";
    echo "=========================================================\n";
    foreach ($modulesConfig as $slug => $config) {
        generateModule($slug, $config);
    }
    echo "\nSynchronizing permissions in database...\n";
    \Core\ModuleLoader::syncPermissions();
    echo "\n✔ All 11 module skeletons created and permissions synchronized!\n";
    exit(0);
}

// Generate single custom module
$slug = strtolower($arg1);
$name = $argv[2] ?? ucfirst($slug);
$prefix = $argv[3] ?? (substr($slug, 0, 3) . '_');
$section = $argv[4] ?? 'Student Modules';

$config = $modulesConfig[$slug] ?? [
    'name'        => $name,
    'prefix'      => $prefix,
    'section'     => $section,
    'icon'        => 'bi-box',
    'description' => "Student module {$name} for MarSU Centralized ERP.",
    'permissions' => [
        "{$slug}.view"   => "View {$name} Records",
        "{$slug}.create" => "Create {$name} Records",
        "{$slug}.edit"   => "Modify {$name} Records"
    ]
];

generateModule($slug, $config);
\Core\ModuleLoader::syncPermissions();
echo "\n✔ Module [{$slug}] generated successfully.\n";

PHP;

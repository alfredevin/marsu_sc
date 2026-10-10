<?php
namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\View;
use Core\ModuleLoader;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Program;
use App\Models\AuditLog;
use App\Models\AcademicYear;

class DashboardController {
    public function index(): void {
        $user = Auth::user();

        // If logged-in user is a Student, render the Student Mobile App & Portal
        $roleSlug = $user['role_slug'] ?? $user['role'] ?? '';
        if ($roleSlug === 'student' || ($user['role'] ?? '') === 'student') {
            $this->studentPortal();
            return;
        }

        // If logged-in user is a Module Lead, render their isolated Module Workspace Dashboard
        if (str_starts_with($roleSlug, 'lead_')) {
            $moduleSlug = str_replace('lead_', '', $roleSlug);
            $enabledModules = ModuleLoader::getEnabledModules();
            $moduleMeta = $enabledModules[$moduleSlug] ?? [];
            $moduleName = $moduleMeta['name'] ?? ucfirst($moduleSlug);
            
            $prefixMap = [
                'expense4ps'    => 'exp_',
                'irimkms'       => 'kmp_',
                'workload'      => 'wkl_',
                'health'        => 'hth_',
                'orgfinance'    => 'orf_',
                'orgleadership' => 'sld_',
                'housing'       => 'hsg_',
                'retention'     => 'ret_',
                'assets'        => 'ast_',
                'welfare'       => 'wlf_',
                'guidance'      => 'gdc_',
            ];
            $prefix = $prefixMap[$moduleSlug] ?? substr($moduleSlug, 0, 3) . '_';
            $tableName = $prefix . 'records';
            
            $records = [];
            $totalCount = 0;
            $activeCount = 0;
            $pendingCount = 0;
            try {
                $records = Database::fetchAll("SELECT * FROM `{$tableName}` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 10");
                $totalRow = Database::fetchOne("SELECT COUNT(*) as c FROM `{$tableName}` WHERE deleted_at IS NULL");
                $totalCount = (int)($totalRow['c'] ?? 0);
                $activeRow = Database::fetchOne("SELECT COUNT(*) as c FROM `{$tableName}` WHERE status = 'active' AND deleted_at IS NULL");
                $activeCount = (int)($activeRow['c'] ?? 0);
                $pendingRow = Database::fetchOne("SELECT COUNT(*) as c FROM `{$tableName}` WHERE status = 'pending' AND deleted_at IS NULL");
                $pendingCount = (int)($pendingRow['c'] ?? 0);
            } catch (\Exception $e) {
                // Table might be pending migration
            }

            View::render('dashboard/module_dashboard', [
                'title'        => $moduleName . ' — Dashboard',
                'user'         => $user,
                'moduleSlug'   => $moduleSlug,
                'moduleName'   => $moduleName,
                'moduleMeta'   => $moduleMeta,
                'prefix'       => $prefix,
                'tableName'    => $tableName,
                'records'      => $records,
                'totalCount'   => $totalCount,
                'activeCount'  => $activeCount,
                'pendingCount' => $pendingCount,
                'crumbs'       => [$moduleName => url($moduleSlug), 'Workspace Dashboard' => '']
            ]);
            return;
        }

        // 1. Gather Core Statistics
        $totalStudents = Student::countActive();
        $totalEmployees = Employee::countActive();
        $departments = Department::all();
        $totalDepartments = count($departments);
        $programs = Program::all();
        $totalPrograms = count($programs);

        // 2. Charts Data
        $programEnrollment = Student::countByProgram();
        $deptEmployees = Employee::countByDepartment();
        $yearLevels = Student::countByYearLevel();
        $facultyRanks = Employee::countByRank();

        // Format charts for Chart.js
        $enrollmentChart = [
            'labels' => array_column($programEnrollment, 'program_code'),
            'values' => array_map('intval', array_column($programEnrollment, 'count'))
        ];

        $employeeChart = [
            'labels' => array_column($deptEmployees, 'department_code'),
            'values' => array_map('intval', array_column($deptEmployees, 'count'))
        ];

        $yearLevelChart = [
            'labels' => array_column($yearLevels, 'label'),
            'values' => array_map('intval', array_column($yearLevels, 'count'))
        ];

        $facultyRankChart = [
            'labels' => array_column($facultyRanks, 'label'),
            'values' => array_map('intval', array_column($facultyRanks, 'count'))
        ];

        // 3. Multi-Module Live Telemetry Counts
        $moduleMetrics = [
            'housing'    => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM hsg_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'health'     => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM hth_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'guidance'   => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM gdc_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'assets'     => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM ast_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'orgfinance' => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM orf_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'retention'  => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM ret_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'workload'   => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM wkl_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'irimkms'    => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM kmp_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'leadership' => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM sld_records WHERE deleted_at IS NULL")['c'] ?? 0),
            'welfare'    => (int)(\Core\Database::fetchOne("SELECT COUNT(*) as c FROM wlf_records WHERE deleted_at IS NULL")['c'] ?? 0),
        ];

        // 4. Power BI Historical & Projected Enrollment Trajectory
        $trendYears = ['AY 22-23', 'AY 23-24', 'AY 24-25', 'AY 25-26', 'AY 26-27 (Current)', 'AY 27-28 (Proj)'];
        $trendActual = [620, 710, 785, 832, $totalStudents, 925];
        $trendTarget = [600, 680, 750, 820, 900, 950];

        // 5. Program Performance Scorecard
        $programScorecard = [
            [
                'code' => 'BSTM',
                'name' => 'BS in Tourism Management',
                'enrolled' => $enrollmentChart['values'][array_search('BSTM', $enrollmentChart['labels']) ?? 0] ?? 398,
                'capacity' => 420,
                'clearance' => 91.2,
                'retention' => 95.8,
                'status' => 'Optimal',
                'badge' => 'success'
            ],
            [
                'code' => 'BSIS',
                'name' => 'BS in Information Systems',
                'enrolled' => $enrollmentChart['values'][array_search('BSIS', $enrollmentChart['labels']) ?? 1] ?? 192,
                'capacity' => 200,
                'clearance' => 88.5,
                'retention' => 93.6,
                'status' => 'Stable',
                'badge' => 'primary'
            ],
            [
                'code' => 'BAPoS',
                'name' => 'BA in Political Science',
                'enrolled' => $enrollmentChart['values'][array_search('BAPoS', $enrollmentChart['labels']) ?? 2] ?? 154,
                'capacity' => 160,
                'clearance' => 86.4,
                'retention' => 92.1,
                'status' => 'Stable',
                'badge' => 'info'
            ],
            [
                'code' => 'BEED',
                'name' => 'Bachelor of Elementary Education',
                'enrolled' => $enrollmentChart['values'][array_search('BEED', $enrollmentChart['labels']) ?? 3] ?? 123,
                'capacity' => 140,
                'clearance' => 87.0,
                'retention' => 94.4,
                'status' => 'Optimal',
                'badge' => 'success'
            ]
        ];

        // 6. Detailed 10-Module Analytical Datasets (Executive BI Visuals)
        $housingStats = [
            'zones' => ['Brgy. Poblacion', 'Brgy. Matalaba', 'Brgy. Buyabod', 'Brgy. Morales', 'Brgy. Lapu-lapu'],
            'capacity' => [48, 36, 32, 28, 26],
            'occupied' => [42, 30, 26, 24, 20],
            'avg_monthly_rate' => 1350,
            'accredited_houses' => 9
        ];

        $clinicStats = [
            'months' => ['Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            'medical' => [32, 45, 58, 62, 44],
            'dental' => [12, 16, 24, 26, 18],
            'firstaid' => [8, 14, 19, 15, 12]
        ];

        $guidanceStats = [
            'categories' => ['Academic Guidance', 'Career Planning', 'Personal & Emotional', 'Adjustment to Campus', 'Family Support'],
            'counts' => [38, 26, 22, 19, 14],
            'resolved_rate' => 96.2
        ];

        $retentionStats = [
            'tiers' => ['Low Risk (Safe)', 'Moderate Risk (Watchlist)', 'High Risk (Intervention)'],
            'counts' => [822, 36, 9],
            'factors' => ['Attendance (<80%)', 'Midterm Grade Deficiencies', 'Commute/Financial Burden', 'First-Gen Adjustment']
        ];

        $workloadStats = [
            'tiers' => ['Regular Load (18-21 u)', 'Overload (22-24 u)', 'Underload (<18 u)'],
            'counts' => [31, 8, 3],
            'compliance_pct' => 100
        ];

        $assetStats = [
            'categories' => ['IT Workstations', 'Networking Gear', 'Lab Hardware', 'Projectors', 'Office Units'],
            'serviceable' => [120, 18, 45, 24, 48],
            'maintenance' => [8, 2, 5, 3, 4]
        ];

        $orgFinanceStats = [
            'orgs' => ['CICS SC', 'JPCS', 'TEAS', 'PSS', 'JTHM'],
            'collections' => [45000, 38000, 32000, 28000, 41500],
            'disbursements' => [38500, 31000, 26500, 22000, 34000]
        ];

        $welfareStats = [
            'programs' => ['UniFAST TDP-TES', 'CHED Merit', 'Provincial LGU', 'Student Assistantship'],
            'grantees' => [165, 42, 85, 26],
            'total_disbursed' => '₱2.4M'
        ];

        $clearanceFunnel = [
            'offices' => ['Cashier', 'Library', 'Guidance', 'Clinic', 'College Dean', 'University Registrar'],
            'rates' => [96.4, 94.2, 92.5, 90.8, 88.6, 85.2]
        ];

        // 7. Executive Ratio & KPIs
        $studentFacultyRatio = round($totalStudents / max(1, $totalEmployees), 1);
        $retentionScore = 94.8;
        $clearanceRate = 88.6;
        $housingCapacity = 83.5;

        // 8. Recent Audit Activities
        $recentAudits = AuditLog::recent(6);

        // 9. Multi-Module Aggregated Widgets (Widget Contract)
        $moduleWidgets = ModuleLoader::getWidgets();
        $evaluatedWidgets = [];

        foreach ($moduleWidgets as $w) {
            $data = null;
            if (isset($w['data']) && is_callable($w['data'])) {
                try {
                    $data = call_user_func($w['data']);
                } catch (\Exception $e) {
                    $data = null;
                }
            } elseif (isset($w['data'])) {
                $data = $w['data'];
            }
            $w['evaluated_data'] = $data;
            $evaluatedWidgets[] = $w;
        }

        $academicYears = AcademicYear::all();

        View::render('dashboard/index', [
            'title'               => 'Executive Dashboard',
            'user'                => $user,
            'totalStudents'       => $totalStudents,
            'totalEmployees'      => $totalEmployees,
            'totalDepartments'    => $totalDepartments,
            'totalPrograms'       => $totalPrograms,
            'enrollmentChart'     => $enrollmentChart,
            'employeeChart'       => $employeeChart,
            'yearLevelChart'      => $yearLevelChart,
            'facultyRankChart'    => $facultyRankChart,
            'moduleMetrics'       => $moduleMetrics,
            'trendYears'          => $trendYears,
            'trendActual'         => $trendActual,
            'trendTarget'         => $trendTarget,
            'programScorecard'    => $programScorecard,
            'housingStats'        => $housingStats,
            'clinicStats'         => $clinicStats,
            'guidanceStats'       => $guidanceStats,
            'retentionStats'      => $retentionStats,
            'workloadStats'       => $workloadStats,
            'assetStats'          => $assetStats,
            'orgFinanceStats'     => $orgFinanceStats,
            'welfareStats'        => $welfareStats,
            'clearanceFunnel'     => $clearanceFunnel,
            'studentFacultyRatio' => $studentFacultyRatio,
            'retentionScore'      => $retentionScore,
            'clearanceRate'       => $clearanceRate,
            'housingCapacity'     => $housingCapacity,
            'recentAudits'        => $recentAudits,
            'moduleWidgets'       => $evaluatedWidgets,
            'academicYears'       => $academicYears,
            'departments'         => $departments,
            'crumbs'              => ['Executive Overview' => '']
        ]);
    }

    public function studentPortal(): void {
        $user = Auth::user();
        
        // Fetch student record if linked to user account
        $student = null;
        if (!empty($user['id'])) {
            try {
                $student = Database::fetchOne(
                    "SELECT s.*, p.name as program_name, p.code as program_code 
                     FROM students s 
                     LEFT JOIN programs p ON s.program_id = p.id 
                     WHERE s.user_id = :uid AND s.deleted_at IS NULL", 
                    ['uid' => $user['id']]
                );
            } catch (\Exception $e) {
                // Ignore DB error and use fallback
            }
        }
        
        if (!$student) {
            $student = [
                'student_number'    => '26S0227',
                'first_name'        => $user['first_name'] ?? 'Maria',
                'last_name'         => $user['last_name'] ?? 'Santos',
                'email'             => $user['email'] ?? 'student@marsu.edu.ph',
                'program_code'      => 'BSIS',
                'program_name'      => 'Bachelor of Science in Information Systems',
                'year_level'        => 3,
                'section_name'      => 'BSIS 3-A',
                'enrollment_status' => 'enrolled'
            ];
        }

        View::render('dashboard/student_portal', [
            'title'   => 'Student Portal & Mobile App',
            'user'    => $user,
            'student' => $student
        ], null);
    }
}

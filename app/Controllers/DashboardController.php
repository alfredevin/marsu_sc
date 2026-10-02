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

        // If logged-in user is a Module Lead, render their isolated Module Workspace Dashboard
        $roleSlug = $user['role_slug'] ?? $user['role'] ?? '';
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

        // 3. Recent Audit Activities
        $recentAudits = AuditLog::recent(6);

        // 4. Multi-Module Aggregated Widgets (Widget Contract)
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
            'title'             => 'Executive Dashboard',
            'user'              => $user,
            'totalStudents'     => $totalStudents,
            'totalEmployees'    => $totalEmployees,
            'totalDepartments'  => $totalDepartments,
            'totalPrograms'     => $totalPrograms,
            'enrollmentChart'   => $enrollmentChart,
            'employeeChart'     => $employeeChart,
            'yearLevelChart'    => $yearLevelChart,
            'facultyRankChart'  => $facultyRankChart,
            'recentAudits'      => $recentAudits,
            'moduleWidgets'     => $evaluatedWidgets,
            'academicYears'     => $academicYears,
            'departments'       => $departments,
            'crumbs'            => ['Executive Overview' => '']
        ]);
    }
}

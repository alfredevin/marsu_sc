<?php
namespace Modules\Retention\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Student Retention & Academic Risk Early Warning System
 */
class HomeController
{
    public function index(): void
    {
        $user = Auth::user();

        // Fetch demo / module records
        $records = [];
        try {
            $records = Database::fetchAll("SELECT * FROM `ret_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('retention/Views/index', [
            'title' => 'Student Retention & Academic Risk Early Warning System',
            'moduleName' => 'Student Retention & Academic Risk Early Warning System',
            'slug' => 'retention',
            'records' => $records,
            'user' => $user,
            'crumbs' => [
                'Academic Analytics' => '',
                'Student Retention & Academic Risk Early Warning System' => ''
            ]
        ]);
    }

    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `ret_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('retention'));
        }

        View::render('retention/Views/index', [
            'title' => 'View Record #{$id}',
            'moduleName' => 'Student Retention & Academic Risk Early Warning System',
            'slug' => 'retention',
            'record' => $record,
            'records' => [],
            'crumbs' => ['Student Retention & Academic Risk Early Warning System' => url('retention'), 'View' => '']
        ]);
    }

    public function store(): void
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('retention'));
        }

        try {
            Database::insert('ret_records', [
                'title' => $title,
                'description' => $description,
                'status' => 'active',
                'created_by' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('retention'));
    }
    public function profile(): void
    {
        $user = Auth::user();

        $studentIdParam = trim($_GET['student_id'] ?? '');
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        // Dynamic na kunin ang Programs at Sections mula sa Database
        $departments = [];
        $sections = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');

            $secRows = Database::fetchAll("SELECT DISTINCT `name` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `name` ASC");
            $sections = array_column($secRows, 'name');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS'];
            $sections = [];
        }

        $selectedStudent = null;
        $studentList = [];

        // 1. DETAIL VIEW: Kapag pinindot ang "View Profile" (360° Profile Dossier)
        if (!empty($studentIdParam)) {
            try {
                $sql = "SELECT 
                            s.*,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program_code,
                            COALESCE(p.name, 'N/A') AS program_name,
                            COALESCE(sec.name, '-') AS section_name
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE (s.student_number = ? OR s.id = ?)
                        LIMIT 1";

                $selectedStudent = Database::fetchOne($sql, [
                    $studentIdParam,
                    is_numeric($studentIdParam) ? (int) $studentIdParam : 0
                ]);
            } catch (\Throwable $e) {
                $selectedStudent = null;
            }
        }

        // 2. MASTER DIRECTORY ROSTER: 100% Fixed Search gamit ang positional (?) parameters
        if (!$selectedStudent) {
            try {
                $sql = "SELECT 
                            s.id,
                            s.student_number,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program_code,
                            COALESCE(p.name, 'N/A') AS program_name,
                            s.year_level,
                            COALESCE(sec.name, '-') AS section_name,
                            s.address,
                            s.email,
                            s.contact_number,
                            s.enrollment_status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE s.deleted_at IS NULL";

                $params = [];

                if (!empty($search)) {
                    $sql .= " AND (s.student_number LIKE ? 
                               OR s.first_name LIKE ? 
                               OR s.last_name LIKE ? 
                               OR CONCAT(s.first_name, ' ', s.last_name) LIKE ? 
                               OR CONCAT(s.last_name, ', ', s.first_name) LIKE ? 
                               OR s.email LIKE ?)";
                    $qTerm = '\%' . $search . '%';
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                }

                if (!empty($department)) {
                    $sql .= " AND p.code = ?";
                    $params[] = $department;
                }

                if (!empty($yearLevel)) {
                    $sql .= " AND s.year_level = ?";
                    $params[] = (int) $yearLevel;
                }

                if (!empty($section)) {
                    $sql .= " AND sec.name = ?";
                    $params[] = $section;
                }

                $sql .= " ORDER BY s.id ASC LIMIT 100";

                $studentList = Database::fetchAll($sql, $params);
            } catch (\Throwable $e) {
                $studentList = [];
            }
        }

        View::render('retention/Views/profile', [
            'title' => !empty($selectedStudent) ? 'Student Profile: ' . htmlspecialchars($selectedStudent['full_name']) : 'Student Profiles',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management' => '',
                'Student Profiles' => ''
            ],
            'selectedStudent' => $selectedStudent,
            'studentList' => $studentList,
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'search' => $search,
            'departments' => $departments,
            'sections' => $sections
        ]);
    }

    public function academichistory(): void
    {
        $user = Auth::user();

        // 1. Saluhin ang student_id at filter parameters mula sa URL ($_GET)
        $studentIdParam = trim($_GET['student_id'] ?? '');
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        // Dynamic Programs at Sections
        $departments = [];
        $sections = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');

            $secRows = Database::fetchAll("SELECT DISTINCT `name` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `name` ASC");
            $sections = array_column($secRows, 'name');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS'];
            $sections = [];
        }

        $selectedStudent = null;
        $groupedRecords = [];
        $cumulativeGwa = 0.00;
        $totalEarnedUnits = 0.0;
        $totalFailedUnits = 0.0;
        $studentList = [];

        // 2. STATE 2: DETAIL VIEW (Kapag may napiling estudyante)
        if (!empty($studentIdParam)) {
            try {
                // Kunin ang profile info ng napiling estudyante
                $selectedStudent = Database::fetchOne(
                    "SELECT 
                        s.*,
                        CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                        COALESCE(p.code, 'N/A') AS program_code,
                        COALESCE(p.name, 'N/A') AS program_name,
                        COALESCE(sec.name, '-') AS section_name
                     FROM `students` s
                     LEFT JOIN `programs` p ON s.program_id = p.id
                     LEFT JOIN `sections` sec ON s.section_id = sec.id
                     WHERE (s.student_number = ? OR s.id = ?)
                     LIMIT 1",
                    [$studentIdParam, is_numeric($studentIdParam) ? (int) $studentIdParam : 0]
                );

                if ($selectedStudent) {
                    $sNum = $selectedStudent['student_number'];

                    // Kunin ang academic records mula sa database
                    $rawRecords = Database::fetchAll(
                        "SELECT * FROM `academic_records` WHERE `student_id` = ? ORDER BY `school_year` DESC, `semester` DESC, `course_code` ASC",
                        [$sNum]
                    );

                    // I-group ang subjects bawat Semestre / School Year
                    $totalQualityPoints = 0;
                    $totalCreditedUnits = 0;

                    foreach ($rawRecords as $rec) {
                        $termKey = ($rec['school_year'] ?? 'A.Y. 2026-2027') . ' • ' . ($rec['semester'] ?? '1st Semester');
                        if (!isset($groupedRecords[$termKey])) {
                            $groupedRecords[$termKey] = [
                                'term_label' => $termKey,
                                'records' => [],
                                'term_units' => 0,
                                'term_points' => 0,
                                'term_gpa' => 0.00,
                                'passed_units' => 0
                            ];
                        }

                        $units = (float) ($rec['units'] ?? 3.0);
                        $grade = is_numeric($rec['grade']) ? (float) $rec['grade'] : null;

                        $groupedRecords[$termKey]['records'][] = $rec;
                        $groupedRecords[$termKey]['term_units'] += $units;

                        if ($grade !== null && $grade > 0) {
                            $groupedRecords[$termKey]['term_points'] += ($grade * $units);
                            $totalQualityPoints += ($grade * $units);
                            $totalCreditedUnits += $units;

                            if ($grade <= 3.00) {
                                $totalEarnedUnits += $units;
                                $groupedRecords[$termKey]['passed_units'] += $units;
                            } else {
                                $totalFailedUnits += $units;
                            }
                        }
                    }

                    // Kalkulahin ang GPA bawat termino
                    foreach ($groupedRecords as &$term) {
                        if ($term['term_units'] > 0 && $term['term_points'] > 0) {
                            $term['term_gpa'] = round($term['term_points'] / $term['term_units'], 2);
                        } else {
                            $term['term_gpa'] = 0.00;
                        }
                    }
                    unset($term);

                    // All-time Cumulative GWA
                    if ($totalCreditedUnits > 0) {
                        $cumulativeGwa = round($totalQualityPoints / $totalCreditedUnits, 2);
                    }
                }
            } catch (\Throwable $e) {
                $selectedStudent = null;
                $groupedRecords = [];
            }
        }

        // 3. STATE 1: COHORT OVERVIEW ROSTER (Kapag nasa listahan)
        if (!$selectedStudent) {
            try {
                $sql = "SELECT 
                            s.id,
                            s.student_number,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program_code,
                            s.year_level,
                            COALESCE(sec.name, '-') AS section_name,
                            s.enrollment_status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE s.deleted_at IS NULL";

                $params = [];

                if (!empty($search)) {
                    $sql .= " AND (s.student_number LIKE ? 
                               OR s.first_name LIKE ? 
                               OR s.last_name LIKE ? 
                               OR CONCAT(s.first_name, ' ', s.last_name) LIKE ? 
                               OR CONCAT(s.last_name, ', ', s.first_name) LIKE ?)";
                    $qTerm = '\%' . $search . '%';
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                    $params[] = $qTerm;
                }

                if (!empty($department)) {
                    $sql .= " AND p.code = ?";
                    $params[] = $department;
                }

                if (!empty($yearLevel)) {
                    $sql .= " AND s.year_level = ?";
                    $params[] = (int) $yearLevel;
                }

                if (!empty($section)) {
                    $sql .= " AND sec.name = ?";
                    $params[] = $section;
                }

                $sql .= " ORDER BY s.id ASC LIMIT 100";

                $studentList = Database::fetchAll($sql, $params);
            } catch (\Throwable $e) {
                $studentList = [];
            }
        }

        View::render('retention/Views/academichistory', [
            'title' => !empty($selectedStudent) ? 'Academic Transcript: ' . htmlspecialchars($selectedStudent['full_name']) : 'Academic History Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management' => '',
                'Academic History' => ''
            ],
            'selectedStudent' => $selectedStudent,
            'groupedRecords' => $groupedRecords,
            'cumulativeGwa' => $cumulativeGwa,
            'totalEarnedUnits' => $totalEarnedUnits,
            'totalFailedUnits' => $totalFailedUnits,
            'studentList' => $studentList,
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'search' => $search,
            'departments' => $departments,
            'sections' => $sections
        ]);
    }
    public function enrollmentrecords(): void
    {
        $user = Auth::user();

        // 1. Saluhin ang mga active filter parameters mula sa URL ($_GET)
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $schoolYear = trim($_GET['school_year'] ?? '');
        $semester = trim($_GET['semester'] ?? '');
        $enrollmentStatus = trim($_GET['enrollment_status'] ?? '');

        // 2. Filter Options para sa dropdowns
        $departments = ['BSIS', 'BEED', 'BSTM', 'POLSCI'];
        $sections = ['Section A', 'Section B', 'Section C'];
        $schoolYears = ['2026-2027', '2025-2026'];
        $semesters = ['1st Semester', '2nd Semester', 'Midyear'];
        $enrollmentStatuses = ['Regular', 'Irregular', 'Shifter', 'Transferee'];

        // 3. PURE FETCHING: Kunin lamang ang data mula sa inyong database
        $enrollmentList = [];

        try {
            $sql = "SELECT * FROM `students` WHERE 1=1";
            $params = [];
            if (!empty($department)) {
                $sql .= " AND `department` = :dept";
                $params['dept'] = $department;
            }
            if (!empty($yearLevel)) {
                $sql .= " AND `year_level` = :yl";
                $params['yl'] = $yearLevel;
            }
            if (!empty($section)) {
                $sql .= " AND `section` = :sec";
                $params['sec'] = $section;
            }
            $enrollmentList = Database::fetchAll($sql, $params);
        } catch (\Throwable $e) {
            $enrollmentList = [];
        }

        // 4. I-render ang view gamit ang View::render para buo ang MarSU ERP Layout
        View::render('retention/Views/enrollmentrecords', [
            'title' => 'Program & Enrollment Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management' => '',
                'Program & Enrollment Records' => ''
            ],
            // Active filters
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'schoolYear' => $schoolYear,
            'semester' => $semester,
            'enrollmentStatus' => $enrollmentStatus,
            // Dropdown options
            'departments' => $departments,
            'sections' => $sections,
            'schoolYears' => $schoolYears,
            'semesters' => $semesters,
            'enrollmentStatuses' => $enrollmentStatuses,
            // Fetched records
            'enrollmentList' => $enrollmentList
        ]);
    }

    public function demographicinfo(): void
    {
        $user = Auth::user();

        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $municipality = trim($_GET['municipality'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS'];
        $municipalities = ['Boac', 'Gasan', 'Mogpog', 'Santa Cruz', 'Torrijos', 'Buenavista'];

        $demographicList = [];
        $totalStudents = 0;
        $boardingCount = 0;
        $distantCount = 0;
        $localCount = 0;

        try {
            $sql = "SELECT 
                        s.id,
                        s.student_number,
                        CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                        COALESCE(p.code, 'N/A') AS program_code,
                        s.year_level,
                        COALESCE(sec.name, '-') AS section_name,
                        s.address,
                        s.guardian_name,
                        s.guardian_contact
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL";

            $params = [];

            if (!empty($search)) {
                $sql .= " AND (s.student_number LIKE ? OR s.first_name LIKE ? OR s.last_name LIKE ? OR s.address LIKE ?)";
                $qTerm = '\%' . $search . '%';
                $params[] = $qTerm;
                $params[] = $qTerm;
                $params[] = $qTerm;
                $params[] = $qTerm;
            }

            if (!empty($department)) {
                $sql .= " AND p.code = ?";
                $params[] = $department;
            }

            if (!empty($yearLevel)) {
                $sql .= " AND s.year_level = ?";
                $params[] = (int) $yearLevel;
            }

            if (!empty($municipality)) {
                $sql .= " AND s.address LIKE ?";
                $params[] = '\%' . $municipality . '%';
            }

            $sql .= " ORDER BY s.id ASC LIMIT 100";

            $rawList = Database::fetchAll($sql, $params);

            // Pagsusuri sa Geographic at Housing Risk Factors
            foreach ($rawList as $row) {
                $addr = $row['address'] ?? '';

                $isBoarding = (stripos($addr, 'Boarding') !== false) || (stripos($addr, 'Dorm') !== false);
                if ($isBoarding) {
                    $boardingCount++;
                    $setup = 'Boarding House';
                } else {
                    $localCount++;
                    $setup = 'With Family';
                }

                $isDistant = (stripos($addr, 'Torrijos') !== false) || (stripos($addr, 'Buenavista') !== false) || (stripos($addr, 'Santa Cruz') !== false);
                if ($isDistant) {
                    $distantCount++;
                    $riskLevel = 'High (Distant Commute)';
                } else {
                    $riskLevel = $isBoarding ? 'Moderate (Relocated)' : 'Low (Local Resident)';
                }

                $row['living_arrangement'] = $setup;
                $row['commute_risk_level'] = $riskLevel;
                $demographicList[] = $row;
            }

            $totalStudents = count($demographicList);

        } catch (\Throwable $e) {
            $demographicList = [];
        }

        View::render('retention/Views/demographicinfo', [
            'title' => 'Demographic Risk & Geographic Analytics',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Student Information Management' => '',
                'Demographic Information' => ''
            ],
            'department' => $department,
            'yearLevel' => $yearLevel,
            'municipality' => $municipality,
            'search' => $search,
            'departments' => $departments,
            'municipalities' => $municipalities,
            'demographicList' => $demographicList,
            'totalStudents' => $totalStudents,
            'boardingCount' => $boardingCount,
            'distantCount' => $distantCount,
            'localCount' => $localCount
        ]);
    }

    public function gradestracking(): void
    {
        $user = Auth::user();
        $facultyId = $user->id ?? null;
        $selectedClassId = trim($_GET['class_id'] ?? '');

        $facultyClasses = [];
        $allStudentsMasterlist = [];

        // PURE DATABASE FETCHING
        try {
            if (!empty($facultyId)) {
                $facultyClasses = Database::fetchAll("SELECT * FROM `faculty_classes` WHERE `faculty_id` = :fid", ['fid' => $facultyId]);
            }
            $allStudentsMasterlist = Database::fetchAll("SELECT `student_id`, `full_name`, `department`, `year_level`, `section` FROM `students`");
        } catch (\Throwable $e) {
            $facultyClasses = [];
            $allStudentsMasterlist = [];
        }

        // I-render gamit ang View::render para buo ang MarSU ERP Layout
        View::render('retention/Views/gradestracking', [
            'title' => 'Grades Tracking & Class Record',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Grades Tracking' => ''
            ],
            'facultyClasses' => $facultyClasses,
            'allStudentsMasterlist' => $allStudentsMasterlist,
            'selectedClassId' => $selectedClassId
        ]);
    }
    public function subjectperformance(): void
    {
        $user = Auth::user();

        // 1. Saluhin ang mga active filter parameters mula sa URL ($_GET)
        $department = trim($_GET['department'] ?? '');
        $schoolYear = trim($_GET['school_year'] ?? '2026-2027');
        $semester = trim($_GET['semester'] ?? '1st Semester');

        // Dropdown Filter Options
        $departments = ['BSIS', 'BEED', 'BSTM', 'POLSCI'];
        $schoolYears = ['2026-2027', '2025-2026'];
        $semesters = ['1st Semester', '2nd Semester', 'Midyear'];

        // 2. Pure Database Fetching (Walang dummy o sample data)
        $coursePerformanceList = [];

        try {
            $sql = "SELECT course_code, course_title,
                        COUNT(*) as total_enrolled,
                        AVG(CAST(grade AS DECIMAL(4,2))) as avg_gpa,
                        SUM(CASE WHEN CAST(grade AS DECIMAL(4,2)) <= 3.00 THEN 1 ELSE 0 END) as passed_count,
                        SUM(CASE WHEN CAST(grade AS DECIMAL(4,2)) <= 2.00 THEN 1 ELSE 0 END) as honor_count,
                        SUM(CASE WHEN CAST(grade AS DECIMAL(4,2)) > 3.00 THEN 1 ELSE 0 END) as fail_count
                    FROM `academic_records`
                    WHERE 1=1";
            $params = [];
            if (!empty($schoolYear)) {
                $sql .= " AND `school_year` = :sy";
                $params['sy'] = $schoolYear;
            }
            if (!empty($semester)) {
                $sql .= " AND `semester` = :sem";
                $params['sem'] = $semester;
            }
            $sql .= " GROUP BY course_code, course_title";
            $records = Database::fetchAll($sql, $params);

            foreach ($records as $row) {
                $enrolled = (int) ($row['total_enrolled'] ?? 0);
                $passed = (int) ($row['passed_count'] ?? 0);
                $rate = $enrolled > 0 ? round(($passed / $enrolled) * 100, 1) : 0;

                $coursePerformanceList[] = [
                    'course_code' => $row['course_code'] ?? '',
                    'course_title' => $row['course_title'] ?? '',
                    'department' => 'CICS',
                    'units' => 3.0,
                    'enrolled' => $enrolled,
                    'mean_gpa' => round((float) ($row['avg_gpa'] ?? 0), 2),
                    'passing_rate' => $rate,
                    'instructor' => 'Assigned Faculty',
                    'honor_count' => (int) ($row['honor_count'] ?? 0),
                    'pass_count' => $passed,
                    'risk_count' => 0,
                    'fail_count' => (int) ($row['fail_count'] ?? 0)
                ];
            }
        } catch (\Throwable $e) {
            $coursePerformanceList = [];
        }

        // 3. Filter ayon sa piniling Department (kung may naka-set)
        if (!empty($department) && !empty($coursePerformanceList)) {
            $coursePerformanceList = array_values(array_filter($coursePerformanceList, function ($c) use ($department) {
                return ($c['department'] ?? '') === $department;
            }));
        }

        // 4. Kalkulahin ang Macro Institutional KPIs
        $totalCourses = count($coursePerformanceList);
        $totalEnrolledSum = 0;
        $weightedGpaSum = 0;
        $totalPassedSum = 0;
        $bottleneckCount = 0;

        $totalHonor = 0;
        $totalPass = 0;
        $totalRisk = 0;
        $totalFail = 0;

        foreach ($coursePerformanceList as &$c) {
            $totalEnrolledSum += $c['enrolled'];
            $weightedGpaSum += ($c['mean_gpa'] * $c['enrolled']);
            $totalPassedSum += (($c['passing_rate'] / 100) * $c['enrolled']);

            $isBottleneck = $c['passing_rate'] < 85.0;
            $c['is_bottleneck'] = $isBottleneck;
            if ($isBottleneck) {
                $bottleneckCount++;
            }

            $totalHonor += $c['honor_count'] ?? 0;
            $totalPass += $c['pass_count'] ?? 0;
            $totalRisk += $c['risk_count'] ?? 0;
            $totalFail += $c['fail_count'] ?? 0;
        }
        unset($c);

        $overallPassingRate = $totalEnrolledSum > 0 ? round(($totalPassedSum / $totalEnrolledSum) * 100, 1) : 0;
        $overallMeanGpa = $totalEnrolledSum > 0 ? round($weightedGpaSum / $totalEnrolledSum, 2) : 0;

        // 5. I-render ang view gamit ang View::render para buo ang MarSU ERP Layout
        View::render('retention/Views/subjectperformance', [
            'title' => 'Subject Performance',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Subject Performance' => ''
            ],
            // Filters
            'department' => $department,
            'schoolYear' => $schoolYear,
            'semester' => $semester,
            'departments' => $departments,
            'schoolYears' => $schoolYears,
            'semesters' => $semesters,
            // Computed Metrics
            'overallPassingRate' => $overallPassingRate,
            'overallMeanGpa' => $overallMeanGpa,
            'bottleneckCount' => $bottleneckCount,
            'totalCourses' => $totalCourses,
            'coursePerformanceList' => $coursePerformanceList,
            'gradeDistribution' => [
                'honor' => $totalHonor,
                'pass' => $totalPass,
                'risk' => $totalRisk,
                'fail' => $totalFail
            ]
        ]);
    }
    public function progressreports(): void
    {
        $user = Auth::user();

        // 1. Saluhin ang active filters mula sa URL ($_GET)
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $status = trim($_GET['status'] ?? '');

        // Dropdown Filter Options
        $departments = ['BSIS', 'BEED', 'BSTM', 'POLSCI'];
        $sections = ['Section A', 'Section B', 'Section C'];
        $statusOptions = ['On-Track', 'Delayed', 'Critical / MRR Risk', 'Graduating Candidate'];

        // 2. Pure Database Fetching (Walang dummy/mock data)
        $progressList = [];

        try {
            $sql = "SELECT * FROM `students` WHERE 1=1";
            $params = [];
            if (!empty($department)) {
                $sql .= " AND `department` = :dept";
                $params['dept'] = $department;
            }
            if (!empty($yearLevel)) {
                $sql .= " AND `year_level` = :yl";
                $params['yl'] = $yearLevel;
            }
            if (!empty($section)) {
                $sql .= " AND `section` = :sec";
                $params['sec'] = $section;
            }
            $rawStudents = Database::fetchAll($sql, $params);

            // Kurikulum Benchmark para sa bawat Year Level (e.g. 146 total curriculum units)
            $totalRequiredUnits = 146;

            foreach ($rawStudents as $std) {
                $yLevel = (int) ($std['year_level'] ?? 1);

                // Kunin ang units_earned kung nasa database; kung wala pa, tantiyahin ayon sa standing
                $earnedUnits = isset($std['units_earned']) ? (int) $std['units_earned'] : ($yLevel * 36);
                $percentProgress = min(100, round(($earnedUnits / $totalRequiredUnits) * 100, 1));

                // Pagtukoy sa Curricular Milestone Status
                $stdStatus = 'On-Track';
                if ($yLevel === 4 && $percentProgress >= 85) {
                    $stdStatus = 'Graduating Candidate';
                } elseif ($percentProgress < ($yLevel * 20)) {
                    $stdStatus = 'Critical / MRR Risk';
                } elseif ($percentProgress < ($yLevel * 23)) {
                    $stdStatus = 'Delayed';
                }

                // Target Graduation Year projection
                $currentYear = (int) date('Y');
                $remainingYears = max(0, 4 - $yLevel);
                if ($stdStatus === 'Delayed' || $stdStatus === 'Critical / MRR Risk') {
                    $remainingYears += 1; // Extended projection
                }
                $targetGradYear = $currentYear + $remainingYears;

                $record = [
                    'student_id' => $std['student_id'] ?? $std['id'] ?? '',
                    'full_name' => $std['full_name'] ?? $std['name'] ?? 'N/A',
                    'department' => $std['department'] ?? 'BSIS',
                    'year_level' => $yLevel,
                    'section' => $std['section'] ?? '-',
                    'units_earned' => $earnedUnits,
                    'total_units' => $totalRequiredUnits,
                    'percent_progress' => $percentProgress,
                    'milestone_status' => $stdStatus,
                    'target_grad_year' => $targetGradYear
                ];

                if (empty($status) || $stdStatus === $status) {
                    $progressList[] = $record;
                }
            }
        } catch (\Throwable $e) {
            $progressList = [];
        }

        // 3. Kalkulahin ang KPI Metrics
        $totalCohorts = count($progressList);
        $onTrackCount = 0;
        $delayedCount = 0;
        $graduatingCount = 0;
        $totalProgressSum = 0;

        foreach ($progressList as $item) {
            $totalProgressSum += $item['percent_progress'];
            if ($item['milestone_status'] === 'On-Track')
                $onTrackCount++;
            if ($item['milestone_status'] === 'Delayed' || $item['milestone_status'] === 'Critical / MRR Risk')
                $delayedCount++;
            if ($item['milestone_status'] === 'Graduating Candidate')
                $graduatingCount++;
        }

        $onTrackRate = $totalCohorts > 0 ? round(($onTrackCount / $totalCohorts) * 100, 1) : 0;
        $avgProgress = $totalCohorts > 0 ? round($totalProgressSum / $totalCohorts, 1) : 0;

        // 4. I-render gamit ang View::render para buo ang MarSU ERP Layout
        View::render('retention/Views/progressreports', [
            'title' => 'Academic Progress Reports',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Progress Reports' => ''
            ],
            // Active filters
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'status' => $status,
            'departments' => $departments,
            'sections' => $sections,
            'statusOptions' => $statusOptions,
            // Processed Data
            'progressList' => $progressList,
            'totalCohorts' => $totalCohorts,
            'onTrackRate' => $onTrackRate,
            'avgProgress' => $avgProgress,
            'delayedCount' => $delayedCount,
            'graduatingCount' => $graduatingCount
        ]);
    }
    public function failedincompletemonitoring(): void
    {
        $user = Auth::user();

        // 1. Saluhin ang mga active filter parameters mula sa URL ($_GET)
        $department = trim($_GET['department'] ?? '');
        $schoolYear = trim($_GET['school_year'] ?? '2026-2027');
        $semester = trim($_GET['semester'] ?? '');
        $deficiencyType = trim($_GET['deficiency_type'] ?? '');
        $courseFilter = trim($_GET['course_code'] ?? '');

        // Dropdown Filter Options
        $departments = ['BSIS', 'BEED', 'BSTM', 'POLSCI'];
        $schoolYears = ['2026-2027', '2025-2026'];
        $semesters = ['1st Semester', '2nd Semester', 'Midyear'];
        $deficiencyTypes = ['Failed (5.00)', 'Incomplete (INC)', 'Dropped (DRP)'];

        // 2. Pure Database Fetching (Walang dummy/mock data)
        $deficienciesList = [];

        try {
            $sql = "SELECT academic_records.*, students.full_name, students.department as student_dept, students.year_level, students.section
                    FROM `academic_records`
                    INNER JOIN `students` ON academic_records.student_id = students.student_id
                    WHERE (academic_records.grade = '5.00' OR academic_records.grade = '5.0' OR academic_records.grade = 'INC' OR academic_records.grade = 'DRP' OR academic_records.grade > '3.00')";
            $params = [];
            if (!empty($department)) {
                $sql .= " AND students.department = :dept";
                $params['dept'] = $department;
            }
            if (!empty($schoolYear)) {
                $sql .= " AND academic_records.school_year = :sy";
                $params['sy'] = $schoolYear;
            }
            if (!empty($semester)) {
                $sql .= " AND academic_records.semester = :sem";
                $params['sem'] = $semester;
            }
            if (!empty($courseFilter)) {
                $sql .= " AND academic_records.course_code = :course";
                $params['course'] = $courseFilter;
            }
            if (!empty($deficiencyType)) {
                if ($deficiencyType === 'Failed (5.00)') {
                    $sql .= " AND (academic_records.grade = '5.00' OR academic_records.grade = '5.0')";
                } elseif ($deficiencyType === 'Incomplete (INC)') {
                    $sql .= " AND academic_records.grade = 'INC'";
                } elseif ($deficiencyType === 'Dropped (DRP)') {
                    $sql .= " AND academic_records.grade = 'DRP'";
                }
            }

            $rawRecords = Database::fetchAll($sql, $params);

            foreach ($rawRecords as $rec) {
                $gradeVal = strtoupper(trim((string) ($rec['grade'] ?? '5.00')));
                $type = 'Failed (5.00)';
                if ($gradeVal === 'INC') {
                    $type = 'Incomplete (INC)';
                } elseif ($gradeVal === 'DRP') {
                    $type = 'Dropped (DRP)';
                }

                $deficienciesList[] = [
                    'student_id' => $rec['student_id'],
                    'full_name' => $rec['full_name'] ?? 'N/A',
                    'department' => $rec['student_dept'] ?? $rec['department'] ?? 'BSIS',
                    'year_level' => $rec['year_level'] ?? 1,
                    'section' => $rec['section'] ?? '-',
                    'course_code' => $rec['course_code'],
                    'course_title' => $rec['course_title'] ?? 'Course Title',
                    'units' => $rec['units'] ?? 3.0,
                    'instructor' => $rec['instructor'] ?? 'Assigned Faculty',
                    'grade' => $gradeVal,
                    'deficiency_type' => $type,
                    'term_recorded' => ($rec['semester'] ?? '1st Sem') . ' ' . ($rec['school_year'] ?? 'AY 2026-2027'),
                    'resolution_status' => $rec['resolution_status'] ?? ($gradeVal === 'INC' ? 'Pending Requirement' : 'Mandatory Retake'),
                    'removal_deadline' => $rec['removal_deadline'] ?? '1 Year Prescriptive Period'
                ];
            }
        } catch (\Throwable $e) {
            $deficienciesList = [];
        }

        // 3. Kalkulahin ang Strategic KPI Metrics
        $totalDeficiencies = count($deficienciesList);
        $totalInc = 0;
        $totalFailed = 0;
        $totalPendingRem = 0;

        foreach ($deficienciesList as $def) {
            if ($def['deficiency_type'] === 'Incomplete (INC)')
                $totalInc++;
            if ($def['deficiency_type'] === 'Failed (5.00)')
                $totalFailed++;
            if (stripos($def['resolution_status'], 'Pending') !== false)
                $totalPendingRem++;
        }

        // 4. I-render gamit ang View::render para buo ang MarSU ERP Layout
        View::render('retention/Views/failedincompletemonitoring', [
            'title' => 'Failed & Incomplete Monitoring',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Failed Incomplete Monitoring' => ''
            ],
            // Filters
            'department' => $department,
            'schoolYear' => $schoolYear,
            'semester' => $semester,
            'deficiencyType' => $deficiencyType,
            'courseFilter' => $courseFilter,
            'departments' => $departments,
            'schoolYears' => $schoolYears,
            'semesters' => $semesters,
            'deficiencyTypes' => $deficiencyTypes,
            // Computed Data
            'deficienciesList' => $deficienciesList,
            'totalDeficiencies' => $totalDeficiencies,
            'totalInc' => $totalInc,
            'totalFailed' => $totalFailed,
            'totalPendingRem' => $totalPendingRem
        ]);
    }
    public function attendancerecords(): void
    {
        $user = Auth::user();
        View::render('retention/Views/attendancerecords', [
            'title' => 'Attendance Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Attendance Records' => ''
            ]
        ]);
    }
    public function participationtracking(): void
    {
        $user = Auth::user();
        View::render('retention/Views/participationtracking', [
            'title' => 'Participation Tracking',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Participation Tracking' => ''
            ]
        ]);
    }
    public function studentengagement(): void
    {
        $user = Auth::user();
        View::render('retention/Views/studentengagement', [
            'title' => 'Student Engagement',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Student Engagement' => ''
            ]
        ]);
    }
    public function behaviorrecords(): void
    {
        $user = Auth::user();
        View::render('retention/Views/behaviorrecords', [
            'title' => 'Behavior Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Academic Monitoring' => '',
                'Behavioral Records' => ''
            ]
        ]);
    }
    public function atriskstudents(): void
    {
        $user = Auth::user();
        View::render('retention/Views/atriskstudents', [
            'title' => 'At-Risk Students',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Early Warning System' => '',
                'At-Risk Students' => ''
            ]
        ]);
    }
    public function risklevelclassification(): void
    {
        $user = Auth::user();
        View::render('retention/Views/risklevelclassification', [
            'title' => 'Risk Level Classification',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Risk Management' => '',
                'Risk Level Classification' => ''
            ]
        ]);
    }
    public function systemalerts(): void
    {
        $user = Auth::user();
        View::render('retention/Views/systemalerts', [
            'title' => 'System Alerts',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Alerts and Notifications' => '',
                'System Alerts' => ''
            ]
        ]);
    }
    public function riskoverview(): void
    {
        $user = Auth::user();
        View::render('retention/Views/riskoverview', [
            'title' => 'Risk Overview',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Risk Management' => '',
                'Risk Overview' => ''
            ]
        ]);
    }
    public function advisingrecords(): void
    {
        $user = Auth::user();
        View::render('retention/Views/advisingrecords', [
            'title' => 'Advising Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management' => '',
                'Advising Records' => ''
            ]
        ]);
    }
    public function guidancereferrals(): void
    {
        $user = Auth::user();
        View::render('retention/Views/guidancereferrals', [
            'title' => 'Guidance Referrals',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management' => '',
                'Guidance Referrals' => ''
            ]
        ]);
    }
    public function academicsupportprograms(): void
    {
        $user = Auth::user();
        View::render('retention/Views/academicsupportprograms', [
            'title' => 'Academic Support Programs',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management' => '',
                'Academic Support Programs' => ''
            ]
        ]);
    }
    public function interventionresults(): void
    {
        $user = Auth::user();
        View::render('retention/Views/interventionresults', [
            'title' => 'Intervention Results',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Intervention Management' => '',
                'Intervention Results' => ''
            ]
        ]);
    }
    public function retentionratereports(): void
    {
        $user = Auth::user();
        View::render('retention/Views/retentionratereports', [
            'title' => 'Retention Rate Reports',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics' => '',
                'Retention Rate Reports' => ''
            ]
        ]);
    }
    public function atriskstudentreports(): void
    {
        $user = Auth::user();
        View::render('retention/Views/atriskstudentreports', [
            'title' => 'At-Risk Student Reports',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics' => '',
                'At-Risk Student Reports' => ''
            ]
        ]);
    }
    public function studentsuccessreports(): void
    {
        $user = Auth::user();
        View::render('retention/Views/studentsuccessreports', [
            'title' => 'Student Success Reports',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics' => '',
                'Student Success Reports' => ''
            ]
        ]);
    }
    public function trendsovertime(): void
    {
        $user = Auth::user();
        View::render('retention/Views/trendsovertime', [
            'title' => 'Trends Over Time',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('retention'),
                'Reports and Analytics' => '',
                'Trends Over Time' => ''
            ]
        ]);
    }
}

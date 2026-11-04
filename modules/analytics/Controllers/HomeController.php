<?php
namespace Modules\Analytics\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;
use Modules\Analytics\Support\AnalyticsAccess;
use Modules\Analytics\Support\AnalyticsSettings;
use Modules\Analytics\Support\ChangeLog;
use Modules\Analytics\Support\ClassRecord;
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\RiskSignals;

/**
 * Controller for Student Retention & Academic Risk Early Warning System
 */
class HomeController
{
    public function index(): void
    {
        // Role-Based Smart Router: each persona lands on its own workspace
        $persona = AnalyticsAccess::persona();
        $personas = AnalyticsAccess::personas();
        if ($persona === null || !isset($personas[$persona])) {
            AnalyticsAccess::forbidden('analytics.view');
        }
        if (!in_array($persona, ['admin', 'program_head'], true)) {
            redirect(url($personas[$persona]['url']));
            return;
        }

        $user = Auth::user();
        $term = AnalyticsAccess::activeTerm();
        $termIds = $this->activeTermIds();

        // 1. Logbook entries (ana_records)
        $records = Database::fetchAll("SELECT * FROM `ana_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 15");

        // 2. Risk tiers derived from posted grades and attendance in the active term
        $recentAlerts = [];
        $risk = RiskSignals::classify($term ? (int) $term['semester_id'] : null);
        $highRiskCount = $risk['counts']['High'];
        $moderateRiskCount = $risk['counts']['Moderate'];
        $lowRiskCount = $risk['counts']['Low'];

        // 3. Total Students Monitored (program scope applied)
        $totalStudents = (int) Database::fetchColumn("SELECT COUNT(*) FROM `students` s WHERE s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s'));

        // 4. Interventions are recorded by the partner modules (4–6); no data source here
        $activeInterventions = null;

        // 5. Subject Performance Analytics from posted grades of the active term
        $courseRows = $this->subjectGradeRows($termIds, null, null);
        $coursePassingList = [];
        $totalHonor = $totalPass = $totalRisk = $totalFail = 0;
        $bottleneckCount = 0;
        $gradedSum = 0;
        $passedSum = 0;
        $gpaSum = 0.0;
        $gpaCount = 0;
        foreach ($courseRows as $row) {
            $coursePassingList[] = [
                'code' => $row['course_code'],
                'title' => $row['course_title'],
                'rate' => $row['passing_rate'],
                'is_bottleneck' => $row['is_bottleneck'],
            ];
            $bottleneckCount += $row['is_bottleneck'] ? 1 : 0;
            $totalHonor += $row['honor_count'];
            $totalPass += $row['pass_count'];
            $totalRisk += $row['risk_count'];
            $totalFail += $row['fail_count'];
            $gradedSum += $row['enrolled'];
            $passedSum += $row['passed'];
            $gpaSum += $row['gpa_sum'];
            $gpaCount += $row['gpa_count'];
        }
        $totalCourses = count($courseRows);
        $overallPassingRate = $gradedSum > 0 ? round($passedSum / $gradedSum * 100, 1) : 0;
        $overallMeanGpa = $gpaCount > 0 ? round($gpaSum / $gpaCount, 2) : 0;

        // Select top 12 representative subjects for the dashboard bar chart (a mix of high performing and bottleneck subjects)
        $dashboardChartSubjects = [];
        if (!empty($coursePassingList)) {
            $bottlenecks = array_values(array_filter($coursePassingList, fn($c) => $c['is_bottleneck']));
            $normalCourses = array_values(array_filter($coursePassingList, fn($c) => !$c['is_bottleneck']));
            $dashboardChartSubjects = array_merge(array_slice($bottlenecks, 0, 6), array_slice($normalCourses, 0, 6));
        }

        // 6. Longitudinal retention from official term enrollment
        $longitudinalTrends = RiskSignals::retentionTrend();
        $overallRetentionRate = $longitudinalTrends['retention'] ? end($longitudinalTrends['retention']) : null;

        // 7. Program-level risk distribution data
        $programRiskDistribution = [
            'labels' => array_keys($risk['byProgram']),
            'low' => array_values(array_map(fn($p) => $p['Low'], $risk['byProgram'])),
            'moderate' => array_values(array_map(fn($p) => $p['Moderate'], $risk['byProgram'])),
            'high' => array_values(array_map(fn($p) => $p['High'], $risk['byProgram'])),
        ];

        View::render('analytics/Views/index', [
            'title' => 'Student Retention & Academic Risk Early Warning System — Dashboard',
            'moduleName' => 'Student Retention & Academic Risk Early Warning System',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Academic Analytics' => '',
                'Student Retention & Academic Risk Early Warning System' => ''
            ],
            'termLabel' => $term ? $term['academic_year_label'] . ' • ' . $term['semester_name'] : 'No active term',
            // KPI Metrics
            'overallRetentionRate' => $overallRetentionRate,
            'overallPassingRate' => $overallPassingRate,
            'overallMeanGpa' => $overallMeanGpa,
            'highRiskCount' => $highRiskCount,
            'moderateRiskCount' => $moderateRiskCount,
            'lowRiskCount' => $lowRiskCount,
            'totalStudents' => $totalStudents,
            'totalCourses' => $totalCourses,
            'bottleneckCount' => $bottleneckCount,
            'activeInterventions' => $activeInterventions,
            // Chart Telemetry
            'dashboardChartSubjects' => $dashboardChartSubjects,
            'gradeDistribution' => [
                'honor' => $totalHonor,
                'pass' => $totalPass,
                'deficient' => ($totalRisk + $totalFail)
            ],
            'longitudinalTrends' => $longitudinalTrends,
            'programRiskDistribution' => $programRiskDistribution,
            // Records and alerts
            'records' => $records,
            'recentAlerts' => $recentAlerts
        ]);
    }

    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $record = Database::fetchOne("SELECT * FROM `ana_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('analytics'));
        }

        Session::flash('info', $record['title'] . ($record['description'] ? ' — ' . $record['description'] : ''));
        redirect(url('analytics'));
    }

    public function store(): void
    {
        $type = trim($_POST['type'] ?? 'record');
        $userId = Auth::id();
        if (!$userId) {
            Session::flash('error', 'Authentication required.');
            redirect(url('analytics'));
            return;
        }
        $userId = (int) $userId;

        // Resolve a student by student number within the viewer's program scope
        $findStudent = function (string $number): ?array {
            return Database::fetchOne(
                "SELECT s.* FROM `students` s WHERE s.student_number = :n AND s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s'),
                ['n' => $number]
            );
        };
        $termIds = $this->activeTermIds();

        try {
            if ($type === 'attendance') {
                // Faculty may log attendance only for their own classes
                $ownOnly = !can('analytics.admin.attendance');
                if ($ownOnly && !can('analytics.faculty.attendance')) {
                    AnalyticsAccess::forbidden('analytics.admin.attendance');
                }
                $studentNumber = trim($_POST['student_id'] ?? '');
                $sessionDate = trim($_POST['session_date'] ?? date('Y-m-d'));
                $subjectCode = trim($_POST['subject_code'] ?? '');
                $status = trim($_POST['status'] ?? 'Present');
                $remarks = trim($_POST['remarks'] ?? '');

                $student = $findStudent($studentNumber);
                $validDate = \DateTime::createFromFormat('Y-m-d', $sessionDate);
                if (!$student || !$validDate || $validDate->format('Y-m-d') !== $sessionDate || $sessionDate > date('Y-m-d')
                    || !in_array($status, ['Present', 'Late', 'Absent', 'Excused'], true)) {
                    Session::flash('error', 'Enter an existing student number, a past or current date and a valid status.');
                    redirect(url('analytics/attendancerecords'));
                    return;
                }

                // Attendance belongs to the class roster the student is on for this subject in the active term
                $class = $termIds ? Database::fetchOne(
                    "SELECT c.id, c.subject_code FROM `ana_classes` c
                     JOIN `ana_class_students` cs ON cs.class_id = c.id AND cs.student_id = :sid AND cs.status = 'enrolled'
                     WHERE c.subject_code = :code AND c.deleted_at IS NULL AND c.grade_status <> 'locked'
                       AND c.semester_id IN (" . implode(',', $termIds) . ")" . ($ownOnly ? " AND c.faculty_user_id = " . $userId : '') . "
                     LIMIT 1",
                    ['sid' => (int) $student['id'], 'code' => $subjectCode]
                ) : null;
                if (!$class) {
                    Session::flash('error', "{$studentNumber} is not on an open {$subjectCode} class roster for the active term.");
                    redirect(url('analytics/attendancerecords'));
                    return;
                }

                Database::insert('ana_attendance_records', [
                    'class_id'     => (int) $class['id'],
                    'student_id'   => (int) $student['id'],
                    'subject_code' => $subjectCode,
                    'session_date' => $sessionDate,
                    'status'       => $status,
                    'remarks'      => $remarks !== '' ? mb_substr($remarks, 0, 255) : null,
                    'recorded_by'  => $userId,
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s'),
                ]);
                Database::insert('ana_records', [
                    'title' => "Attendance: {$subjectCode} - {$status} for Student {$studentNumber}",
                    'description' => "Date: {$sessionDate} | Status: {$status} | Notes: {$remarks}",
                    'status' => 'active',
                    'created_by' => $userId,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                Session::flash('success', 'Attendance record saved successfully.');
                redirect(url('analytics/attendancerecords'));
                return;
            }

            if ($type === 'task_exception') {
                $studentNumber = trim($_POST['student_id'] ?? '');
                $subjectCode = trim($_POST['subject_code'] ?? '');
                $assessmentType = trim($_POST['assessment_type'] ?? 'Assignment');
                $exceptionStatus = trim($_POST['exception_status'] ?? 'Late Submission');
                $remediationNotes = trim($_POST['remediation_notes'] ?? '');

                if (!$findStudent($studentNumber)) {
                    Session::flash('error', "No student {$studentNumber} in your scope.");
                    redirect(url('analytics/participationtracking'));
                    return;
                }

                Database::insert('ana_records', [
                    'title' => "Task Exception: " . ($subjectCode ?: 'Coursework') . " - {$assessmentType} ({$exceptionStatus}) for Student {$studentNumber}",
                    'description' => "Remediation & Reason: {$remediationNotes}",
                    'status' => 'active',
                    'created_by' => $userId,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Assessment task exception logged successfully.');
                redirect(url('analytics/participationtracking'));
                return;
            }

            if ($type === 'behavior') {
                // Faculty may report incidents only for students on their own class rosters
                $ownOnly = !can('analytics.admin.conduct');
                if ($ownOnly && !can('analytics.faculty.behavior')) {
                    AnalyticsAccess::forbidden('analytics.admin.conduct');
                }
                $studentNumber = trim($_POST['student_id'] ?? '');
                $incidentDate = trim($_POST['incident_date'] ?? date('Y-m-d'));
                $incidentType = trim($_POST['incident_type'] ?? 'Classroom Conduct');
                $severity = trim($_POST['severity'] ?? 'Minor');
                $description = trim($_POST['description'] ?? '');

                $student = $findStudent($studentNumber);
                $validDate = \DateTime::createFromFormat('Y-m-d', $incidentDate);
                if (!$student || !$validDate || $validDate->format('Y-m-d') !== $incidentDate || $incidentDate > date('Y-m-d')
                    || !in_array($severity, ['Minor', 'Moderate', 'Severe'], true) || $incidentType === '' || $description === '') {
                    Session::flash('error', 'Enter an existing student number, a past or current date, a type, severity and description.');
                    redirect(url('analytics/behaviorrecords'));
                    return;
                }

                $ownClass = $ownOnly ? Database::fetchColumn(
                    "SELECT c.id FROM `ana_classes` c JOIN `ana_class_students` cs ON cs.class_id = c.id AND cs.student_id = ? AND cs.status = 'enrolled'
                     WHERE c.faculty_user_id = ? AND c.deleted_at IS NULL ORDER BY c.semester_id DESC LIMIT 1",
                    [(int) $student['id'], $userId]
                ) : null;
                if ($ownOnly && !$ownClass) {
                    Session::flash('error', "{$studentNumber} is not on any of your class rosters.");
                    redirect(url('analytics/behaviorrecords'));
                    return;
                }

                $id = Database::insert('ana_behavior_records', [
                    'class_id' => $ownClass ? (int) $ownClass : null,
                    'student_id' => (int) $student['id'],
                    'reported_by' => $userId,
                    'incident_date' => $incidentDate,
                    'incident_type' => mb_substr($incidentType, 0, 100),
                    'severity' => $severity,
                    'description' => $description,
                    'status' => 'Reported',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                ChangeLog::record('conduct', $id, 'report_incident', 'status', null, 'Reported', "{$severity} incident logged");
                Session::flash('success', 'Student behavior incident log recorded.');
                redirect(url('analytics/behaviorrecords'));
                return;
            }

            // Default: logbook entry in ana_records
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!$title) {
                Session::flash('error', 'Title is required.');
                redirect(url('analytics'));
                return;
            }

            Database::insert('ana_records', [
                'title' => mb_substr($title, 0, 191),
                'description' => $description,
                'status' => 'active',
                'created_by' => $userId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
            redirect(url('analytics'));
        } catch (\PDOException $e) {
            Session::flash('error', 'Could not save record.');
            redirect(url('analytics'));
        }
    }

    public function profile(): void
    {
        $user = Auth::user();

        $studentIdParam = trim($_GET['student_id'] ?? '');
        $activeTab = trim($_GET['tab'] ?? $_GET['view'] ?? 'demographics');
        if (!in_array($activeTab, ['demographics', 'academic', 'enrollment'])) {
            $activeTab = 'demographics';
        }

        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        // Dynamic fetch of programs and sections from database
        $departments = [];
        $sections = [];
        try {
            // Dropdowns follow the students visible on this page
            $visible = "SELECT vs.%s FROM `students` vs WHERE vs.deleted_at IS NULL" . AnalyticsAccess::profileStudentScopeSql('vs');
            $departments = Database::fetchAll("SELECT DISTINCT p.`code`, p.`name` FROM `programs` p WHERE p.`deleted_at` IS NULL AND p.id IN (" . sprintf($visible, 'program_id') . ") ORDER BY p.`code` ASC");
            $sections = Database::fetchAll("SELECT DISTINCT sx.`id`, sx.`name`, sx.`year_level` FROM `sections` sx WHERE sx.`deleted_at` IS NULL AND sx.id IN (" . sprintf($visible, 'section_id') . ") ORDER BY sx.`year_level` ASC, sx.`name` ASC");
        } catch (\Throwable $e) {
            $departments = [];
            $sections = [];
        }

        $selectedStudent = null;
        $studentList = [];
        $demographics = [];
        $academicHistory = [];
        $enrollmentRecord = [];

        // 1. DETAIL VIEW: When student_id is selected (Combined Sub-Modules)
        if (!empty($studentIdParam)) {
            try {
                $sql = "SELECT 
                            s.*,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program_code,
                            COALESCE(p.name, 'N/A') AS program_name,
                            COALESCE(p.years, 4) AS program_years,
                            COALESCE(d.name, 'N/A') AS department_name,
                            COALESCE(d.code, 'N/A') AS department_code,
                            COALESCE(d.head_name, 'N/A') AS department_head,
                            COALESCE(sec.name, '-') AS section_name
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `departments` d ON p.department_id = d.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE (s.student_number = ? OR s.id = ?) AND s.deleted_at IS NULL" . AnalyticsAccess::profileStudentScopeSql('s') . "
                        LIMIT 1";

                $selectedStudent = Database::fetchOne($sql, [
                    $studentIdParam,
                    is_numeric($studentIdParam) ? (int) $studentIdParam : 0
                ]);

                if (!empty($selectedStudent)) {
                    // SUB-MODULE 1: DEMOGRAPHIC INFORMATION (master record + supplementary profile)
                    $supp = Database::fetchOne("SELECT * FROM `ana_student_profiles` WHERE `student_id` = ?", [(int) $selectedStudent['id']]);
                    $livingLabels = ['with_family' => 'With Family', 'boarding' => 'Boarding House', 'dormitory' => 'Boarding House', 'relatives' => 'With Relatives', 'other' => 'Other Arrangement'];
                    $commuteLabels = ['distant' => 'High (Distant Commute)', 'moderate' => 'Moderate (Relocated)', 'local' => 'Low (Local Resident)'];

                    $demographics = [
                        'living_arrangement' => $supp ? ($livingLabels[$supp['living_arrangement']] ?? 'Other Arrangement') : 'Not Recorded',
                        'commute_risk_level' => $supp ? ($commuteLabels[$supp['commute_category']] ?? 'Not Recorded') : 'Not Recorded',
                        'address' => $selectedStudent['address'] ?: 'Not Recorded',
                        'guardian_name' => $selectedStudent['guardian_name'] ?: 'Not Recorded',
                        'guardian_contact' => $selectedStudent['guardian_contact'] ?: 'Not Recorded',
                        'is_reachable' => !empty($selectedStudent['guardian_contact'])
                    ];

                    // SUB-MODULE 2: ACADEMIC HISTORY & TRANSCRIPT (posted / locked grades only)
                    $gradeRows = Database::fetchAll(
                        "SELECT g.final_grade, g.remarks, g.inc_resolved_at, c.subject_code, c.subject_title, c.units,
                                c.semester_id, sem.name AS semester_name, ay.label AS ay_label
                         FROM `ana_class_grades` g
                         JOIN `ana_classes` c ON c.id = g.class_id AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
                         LEFT JOIN `semesters` sem ON sem.id = c.semester_id
                         LEFT JOIN `academic_years` ay ON ay.id = c.academic_year_id
                         WHERE g.student_id = ?" . AnalyticsAccess::facultyClassSql('c') . "
                         ORDER BY ay.start_date DESC, c.semester_id DESC, c.subject_code ASC",
                        [(int) $selectedStudent['id']]
                    );
                    $groupedRecords = [];
                    $totalQualityPoints = 0;
                    $totalCreditedUnits = 0;
                    $totalEarnedUnits = 0;
                    $totalFailedUnits = 0;
                    $terms = [];
                    foreach ($gradeRows as $g) {
                        $termLabel = trim(($g['ay_label'] ?? 'No Academic Year') . ' • ' . ($g['semester_name'] ?? 'No Semester'));
                        $terms[$termLabel][] = $g;
                    }
                    foreach ($terms as $termLabel => $rows) {
                        $termUnits = 0;
                        $termPoints = 0;
                        $termCredited = 0;
                        $passedUnits = 0;
                        $recList = [];
                        foreach ($rows as $g) {
                            $u = (float) $g['units'];
                            $termUnits += $u;
                            $rem = $g['remarks'];
                            if ($rem === 'PASSED' || $rem === 'FAILED') {
                                $termPoints += (float) $g['final_grade'] * $u;
                                $termCredited += $u;
                                $totalQualityPoints += (float) $g['final_grade'] * $u;
                                $totalCreditedUnits += $u;
                            }
                            if ($rem === 'PASSED') {
                                $totalEarnedUnits += $u;
                                $passedUnits += $u;
                                $remarks = 'PASSED';
                                $flag = 'Credited';
                            } elseif ($rem === 'FAILED') {
                                $totalFailedUnits += $u;
                                $remarks = 'FAILED';
                                $flag = 'Prerequisite Blocked';
                            } else {
                                $remarks = 'INCOMPLETE';
                                $flag = 'Removal Required';
                            }
                            $recList[] = [
                                'course_code' => $g['subject_code'],
                                'course_title' => $g['subject_title'],
                                'units' => $u,
                                'grade' => $g['final_grade'],
                                'remarks' => $remarks,
                                'flag' => $flag
                            ];
                        }
                        $groupedRecords[] = [
                            'term_label' => $termLabel,
                            'records' => $recList,
                            'term_units' => $termUnits,
                            'term_gpa' => $termCredited > 0 ? round($termPoints / $termCredited, 2) : 0.00,
                            'passed_units' => $passedUnits
                        ];
                    }

                    $cumulativeGwa = ($totalCreditedUnits > 0) ? round($totalQualityPoints / $totalCreditedUnits, 2) : null;

                    $academicHistory = [
                        'cumulativeGwa' => $cumulativeGwa,
                        'totalEarnedUnits' => $totalEarnedUnits,
                        'totalFailedUnits' => $totalFailedUnits,
                        'groupedRecords' => $groupedRecords,
                        'academicStanding' => $cumulativeGwa === null ? 'No Posted Grades Yet' : (($cumulativeGwa <= 1.75 && $totalFailedUnits == 0) ? 'Dean\'s Lister Tier (Honor)' : (($totalFailedUnits > 0 || $cumulativeGwa > 3.00) ? 'Scholastic Deficiency / Probation' : 'Good Academic Standing'))
                    ];

                    // SUB-MODULE 3: PROGRAM AND ENROLLMENT RECORDS (official term enrollment)
                    $term = AnalyticsAccess::activeTerm();
                    $enrollment = $term ? Database::fetchOne(
                        "SELECT e.*, sec.name AS enr_section FROM `ana_enrollments` e LEFT JOIN `sections` sec ON sec.id = e.section_id
                         WHERE e.student_id = ? AND e.semester_id = ?",
                        [(int) $selectedStudent['id'], (int) $term['semester_id']]
                    ) : null;
                    $enrolledLoad = $enrollment ? Database::fetchAll(
                        "SELECT sub.* FROM `ana_enrollment_subjects` es JOIN `subjects` sub ON sub.id = es.subject_id
                         WHERE es.enrollment_id = ? AND es.status = 'enrolled' ORDER BY sub.code",
                        [(int) $enrollment['id']]
                    ) : [];
                    $totalEnrolledUnits = 0;
                    foreach ($enrolledLoad as $sub) {
                        $totalEnrolledUnits += (float) $sub['units'];
                    }
                    $yl = (int) ($enrollment['year_level'] ?? $selectedStudent['year_level'] ?? 1);
                    $ordinal = [1 => '1st', 2 => '2nd', 3 => '3rd'][$yl] ?? ($yl . 'th');

                    $enrollmentRecord = [
                        'academic_year' => $term['academic_year_label'] ?? 'No active academic year',
                        'semester' => $term['semester_name'] ?? 'No active semester',
                        'program_code' => $selectedStudent['program_code'],
                        'program_name' => $selectedStudent['program_name'],
                        'department_name' => $selectedStudent['department_name'],
                        'department_code' => $selectedStudent['department_code'],
                        'department_head' => $selectedStudent['department_head'],
                        'program_years' => $selectedStudent['program_years'] . ' Years',
                        'enrollment_status' => $enrollment ? ucfirst($enrollment['status']) : 'Not Enrolled This Term',
                        'year_level' => $ordinal . ' Year',
                        'section_name' => $enrollment['enr_section'] ?? $selectedStudent['section_name'],
                        'admission_date' => !empty($selectedStudent['created_at']) ? date('F d, Y', strtotime($selectedStudent['created_at'])) : 'N/A',
                        'enrolled_subjects' => $enrolledLoad,
                        'total_enrolled_units' => $totalEnrolledUnits
                    ];
                }
            } catch (\Throwable $e) {
                $selectedStudent = null;
            }
        }

        // 2. MASTER DIRECTORY ROSTER: Default list view
        if (!$selectedStudent) {
            try {
                $sql = "SELECT 
                            s.id,
                            s.student_number,
                            CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                            COALESCE(p.code, 'N/A') AS program_code,
                            s.year_level,
                            COALESCE(sec.name, '-') AS section_name,
                            s.address,
                            s.email,
                            s.contact_number,
                            s.enrollment_status
                        FROM `students` s
                        LEFT JOIN `programs` p ON s.program_id = p.id
                        LEFT JOIN `sections` sec ON s.section_id = sec.id
                        WHERE s.deleted_at IS NULL" . AnalyticsAccess::profileStudentScopeSql('s');

                $params = [];

                if (!empty($search)) {
                    $sql .= " AND (s.student_number LIKE ?
                               OR s.first_name LIKE ?
                               OR s.last_name LIKE ? 
                               OR CONCAT(s.first_name, ' ', s.last_name) LIKE ? 
                               OR CONCAT(s.last_name, ', ', s.first_name) LIKE ? 
                               OR s.email LIKE ?)";
                    $qTerm = '%' . $search . '%';
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
                    $sql .= " AND (sec.name = ? OR s.section_id = ?)";
                    $params[] = $section;
                    $params[] = is_numeric($section) ? (int) $section : 0;
                }

                $page = max(1, (int) ($_GET['page'] ?? 1));
                $perPage = 20;

                $countSql = "SELECT COUNT(*) " . substr($sql, strpos($sql, "FROM `students`"));
                $totalRecords = (int) (Database::fetchColumn($countSql, $params) ?: 0);
                $pagination = $this->buildPagination($totalRecords, $perPage, $page, $_GET);

                $sql .= " ORDER BY s.id ASC LIMIT {$perPage} OFFSET {$pagination['offset']}";

                $studentList = Database::fetchAll($sql, $params);
            } catch (\Throwable $e) {
                $studentList = [];
                $pagination = $this->buildPagination(0, 20, 1, $_GET);
            }
        }

        View::render('analytics/Views/profile', [
            'title' => !empty($selectedStudent) ? 'Student Profile: ' . htmlspecialchars($selectedStudent['full_name']) : 'Student Profiles',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Student Information Management' => '',
                'Student Profiles' => ''
            ],
            'activeTab' => $activeTab,
            'selectedStudent' => $selectedStudent,
            'demographics' => $demographics,
            'academicHistory' => $academicHistory,
            'enrollmentRecord' => $enrollmentRecord,
            'studentList' => $studentList,
            'pagination' => $pagination ?? $this->buildPagination(0, 20, 1, $_GET),
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
        $studentId = trim($_GET['student_id'] ?? '');
        header('Location: ' . url('analytics/profile' . (!empty($studentId) ? '?student_id=' . urlencode($studentId) . '&tab=academic' : '')));
        exit;
    }

    public function enrollmentrecords(): void
    {
        $studentId = trim($_GET['student_id'] ?? '');
        header('Location: ' . url('analytics/profile' . (!empty($studentId) ? '?student_id=' . urlencode($studentId) . '&tab=enrollment' : '')));
        exit;
    }

    public function demographicinfo(): void
    {
        $studentId = trim($_GET['student_id'] ?? '');
        header('Location: ' . url('analytics/profile' . (!empty($studentId) ? '?student_id=' . urlencode($studentId) . '&tab=demographics' : '')));
        exit;
    }

    public function gradestracking(): void
    {
        $user = Auth::user();
        $facultyId = $user['id'] ?? (int) Auth::id();
        $selectedClassId = trim($_GET['class_id'] ?? '');

        $facultyClasses = [];
        $allStudentsMasterlist = [];
        $sections = [];

        try {
            // Real class records in scope (faculty: only their own classes), preloaded for the matrix
            $classRows = Database::fetchAll(
                "SELECT c.id FROM `ana_classes` c
                 WHERE c.deleted_at IS NULL" . AnalyticsAccess::classScopeSql('c') . "
                 ORDER BY c.semester_id DESC, c.subject_code ASC"
            );
            foreach ($classRows as $cr) {
                $cls = ClassRecord::details((int) $cr['id']);
                if ($cls) {
                    $facultyClasses[] = ClassRecord::matrixPayload($cls);
                }
            }
        } catch (\Throwable $e) {
            $facultyClasses = [];
        }
        // Fetch list of all sections from database (faculty may open a class for any section)
        try {
            $sectionScope = AnalyticsAccess::isFacultyScope() ? '' : AnalyticsAccess::programScopeSql('sx.program_id');
            $sections = Database::fetchAll("SELECT sx.`id`, sx.`name`, sx.`year_level` FROM `sections` sx WHERE sx.`deleted_at` IS NULL" . $sectionScope . " ORDER BY sx.`year_level` ASC, sx.`name` ASC");
        } catch (\Throwable $e) {
            $sections = [];
        }
        $gradingTemplates = Database::fetchAll("SELECT id, name, scheme, passing_cutoff, is_default FROM `ana_grading_templates` WHERE is_active = 1 AND deleted_at IS NULL ORDER BY is_default DESC, name");
        foreach ($gradingTemplates as &$tpl) {
            $tpl['scheme'] = GradeCalculator::normalizeScheme(json_decode((string) $tpl['scheme'], true), (float) $tpl['passing_cutoff']);
        }
        unset($tpl);
        $activeTerm = AnalyticsAccess::activeTerm();
        // Fetch student masterlist including section_name and section_id from database
        try {
            $allStudentsMasterlist = Database::fetchAll(
                "SELECT 
                    s.student_number as student_id, 
                    CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) as full_name, 
                    p.code as department, 
                    s.year_level, 
                    s.section_id,
                    COALESCE(sec.name, '') as section_name
                 FROM `students` s
                 LEFT JOIN `programs` p ON s.program_id = p.id
                 LEFT JOIN `sections` sec ON s.section_id = sec.id
                 WHERE s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s') . "
                 ORDER BY s.last_name ASC, s.first_name ASC"
            );
        } catch (\Throwable $e) {
            $allStudentsMasterlist = [];
        }

        View::render('analytics/Views/gradestracking', [
            'title' => 'Grades Tracking & Class Record',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Grades Tracking' => ''
            ],
            'facultyClasses' => $facultyClasses,
            'allStudentsMasterlist' => $allStudentsMasterlist,
            'sections' => $sections,
            'selectedClassId' => $selectedClassId,
            'gradingTemplates' => $gradingTemplates,
            'activeTermLabel' => $activeTerm['label'] ?? null,
            'canCreateClass' => AnalyticsAccess::isFaculty() && $activeTerm !== null,
        ]);
    }

    public function subjectperformance(): void
    {
        $user = Auth::user();

        $department = trim($_GET['department'] ?? '');
        [$schoolYears, $semesters, $defaultYear, $defaultSem] = $this->termFilterOptions();
        $schoolYear = trim($_GET['school_year'] ?? $defaultYear);
        $semester = trim($_GET['semester'] ?? $defaultSem);
        $search = trim($_GET['q'] ?? '');

        // 1. Dynamic Dropdown Data from Database (programs in the viewer's scope)
        $departments = $this->scopedProgramCodes();

        // 2. Per-subject results from posted / locked class grades of the selected term
        $termIds = $this->termIdsFor($schoolYear, $semester);
        $coursePerformanceList = $this->subjectGradeRows($termIds, $department ?: null, $search ?: null);

        $totalCourses = count($coursePerformanceList);
        $gradedSum = 0;
        $passedSum = 0;
        $gpaSum = 0.0;
        $gpaCount = 0;
        $bottleneckCount = 0;
        $totalHonor = 0;
        $totalPass = 0;
        $totalRisk = 0;
        $totalFail = 0;

        foreach ($coursePerformanceList as $c) {
            $gradedSum += $c['enrolled'];
            $passedSum += $c['passed'];
            $gpaSum += $c['gpa_sum'];
            $gpaCount += $c['gpa_count'];

            if ($c['is_bottleneck']) {
                $bottleneckCount++;
            }

            $totalHonor += $c['honor_count'];
            $totalPass += $c['pass_count'];
            $totalRisk += $c['risk_count'];
            $totalFail += $c['fail_count'];
        }

        $overallPassingRate = $gradedSum > 0 ? round(($passedSum / $gradedSum) * 100, 1) : 0;
        $overallMeanGpa = $gpaCount > 0 ? round($gpaSum / $gpaCount, 2) : 0;
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalCourses, $perPage, $page, $_GET);
        $paginatedCourses = array_slice($coursePerformanceList, $pagination['offset'], $perPage);

        View::render('analytics/Views/subjectperformance', [
            'title' => 'Course & Subject Performance Analytics',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Subject Performance' => ''
            ],
            'department' => $department,
            'schoolYear' => $schoolYear,
            'semester' => $semester,
            'search' => $search,
            'departments' => $departments,
            'schoolYears' => $schoolYears,
            'semesters' => $semesters,
            'overallPassingRate' => $overallPassingRate,
            'overallMeanGpa' => $overallMeanGpa,
            'bottleneckCount' => $bottleneckCount,
            'totalCourses' => $totalCourses,
            'coursePerformanceList' => $paginatedCourses,
            'pagination' => $pagination,
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

        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $status = trim($_GET['status'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = $this->scopedProgramCodes();
        $sections = $this->scopedSectionNames();

        $statusOptions = ['On-Track', 'Delayed', 'Critical / MRR Risk', 'Graduating Candidate', 'No Posted Grades'];
        $progressList = [];

        try {
            // Direct query from students table joined with programs and sections
            $sql = "SELECT
                        s.id,
                        s.student_number,
                        CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) as full_name,
                        s.program_id,
                        COALESCE(p.code, 'N/A') as program_code,
                        COALESCE(p.name, 'N/A') as program_name,
                        COALESCE(p.years, 4) as program_years,
                        s.year_level,
                        COALESCE(sec.name, '-') as section_name
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s');
            $params = [];

            if (!empty($department)) {
                $sql .= " AND p.code = ?";
                $params[] = $department;
            }
            if (!empty($yearLevel)) {
                $sql .= " AND s.year_level = ?";
                $params[] = (int) $yearLevel;
            }
            if (!empty($section)) {
                $sql .= " AND (sec.name = ? OR s.section_id = ?)";
                $params[] = $section;
                $params[] = is_numeric($section) ? (int) $section : 0;
            }
            if (!empty($search)) {
                $sql .= " AND (s.student_number LIKE ? OR s.first_name LIKE ? OR s.last_name LIKE ? OR CONCAT(s.first_name, ' ', s.last_name) LIKE ?)";
                $q = '%' . $search . '%';
                $params[] = $q;
                $params[] = $q;
                $params[] = $q;
                $params[] = $q;
            }

            $sql .= " ORDER BY s.last_name ASC";
            $rawStudents = Database::fetchAll($sql, $params);

            // Posted grade totals per student (all terms)
            $gradeTotals = [];
            foreach (Database::fetchAll(
                "SELECT g.student_id,
                        COUNT(*) AS graded,
                        SUM(CASE WHEN g.remarks = 'PASSED' THEN c.units ELSE 0 END) AS earned_units,
                        SUM(CASE WHEN g.remarks = 'FAILED' THEN c.units ELSE 0 END) AS failed_units,
                        SUM(g.remarks = 'INC' AND g.inc_resolved_at IS NULL) AS open_inc
                 FROM `ana_class_grades` g
                 JOIN `ana_classes` c ON c.id = g.class_id AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
                 GROUP BY g.student_id"
            ) as $gt) {
                $gradeTotals[(int) $gt['student_id']] = $gt;
            }

            // Curriculum units per program from the subjects catalog
            $curriculumUnits = [];
            foreach (Database::fetchAll("SELECT program_id, SUM(units) AS total FROM `subjects` WHERE deleted_at IS NULL AND program_id IS NOT NULL GROUP BY program_id") as $cu) {
                $curriculumUnits[(int) $cu['program_id']] = (float) $cu['total'];
            }

            $activeTerm = AnalyticsAccess::activeTerm();
            $baseYear = $activeTerm ? (int) substr((string) Database::fetchColumn("SELECT start_date FROM `academic_years` WHERE id = ?", [(int) $activeTerm['academic_year_id']]), 0, 4) : null;

            foreach ($rawStudents as $std) {
                $yLevel = (int) ($std['year_level'] ?? 1);
                $progYears = (int) ($std['program_years'] ?? 4);
                $totalRequiredUnits = $curriculumUnits[(int) $std['program_id']] ?? 0.0;
                $gt = $gradeTotals[(int) $std['id']] ?? null;

                $earnedUnits = $gt ? (float) $gt['earned_units'] : 0.0;
                $failedUnits = $gt ? (float) $gt['failed_units'] : 0.0;
                $openInc = $gt ? (int) $gt['open_inc'] : 0;
                $percentProgress = $totalRequiredUnits > 0 ? min(100.0, round(($earnedUnits / $totalRequiredUnits) * 100, 1)) : 0.0;

                if (!$gt) {
                    $stdStatus = 'No Posted Grades';
                } elseif ($failedUnits >= 9 || ($failedUnits > 0 && $yLevel >= 3)) {
                    $stdStatus = 'Critical / MRR Risk';
                } elseif ($failedUnits > 0 || $openInc > 0) {
                    $stdStatus = 'Delayed';
                } elseif ($yLevel >= $progYears && $percentProgress >= 87.5) {
                    $stdStatus = 'Graduating Candidate';
                } else {
                    $stdStatus = 'On-Track';
                }

                $remainingYears = max(0, $progYears - $yLevel);
                if ($stdStatus === 'Delayed' || $stdStatus === 'Critical / MRR Risk') {
                    $remainingYears += 1;
                }
                $targetGradYear = $baseYear !== null ? $baseYear + 1 + $remainingYears : '—';

                $record = [
                    'student_id' => $std['student_number'],
                    'full_name' => $std['full_name'],
                    'department' => $std['program_code'],
                    'year_level' => $yLevel,
                    'section' => $std['section_name'],
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
        $totalCohorts = count($progressList);
        $onTrackCount = 0;
        $delayedCount = 0;
        $graduatingCount = 0;
        $totalProgressSum = 0;

        foreach ($progressList as $item) {
            $totalProgressSum += $item['percent_progress'];
            if ($item['milestone_status'] === 'On-Track') $onTrackCount++;
            if ($item['milestone_status'] === 'Delayed' || $item['milestone_status'] === 'Critical / MRR Risk') $delayedCount++;
            if ($item['milestone_status'] === 'Graduating Candidate') $graduatingCount++;
        }

        $onTrackRate = $totalCohorts > 0 ? round(($onTrackCount / $totalCohorts) * 100, 1) : 0;
        $avgProgress = $totalCohorts > 0 ? round($totalProgressSum / $totalCohorts, 1) : 0;

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalCohorts, $perPage, $page, $_GET);
        $paginatedProgress = array_slice($progressList, $pagination['offset'], $perPage);

        View::render('analytics/Views/progressreports', [
            'title' => 'Academic Progress Reports',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Progress Reports' => ''
            ],
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'status' => $status,
            'search' => $search,
            'departments' => $departments,
            'sections' => $sections,
            'statusOptions' => $statusOptions,
            'progressList' => $paginatedProgress,
            'pagination' => $pagination,
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

        [$schoolYears, $semesters, $defaultYear] = $this->termFilterOptions();
        $department = trim($_GET['department'] ?? '');
        $schoolYear = trim($_GET['school_year'] ?? $defaultYear);
        $semester = trim($_GET['semester'] ?? '');
        $deficiencyType = trim($_GET['deficiency_type'] ?? '');
        $courseFilter = trim($_GET['course_code'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = $this->scopedProgramCodes();
        $deficiencyTypes = ['Failed (5.00)', 'Incomplete (INC)', 'Dropped (DRP)'];

        $deficienciesList = [];

        try {
            // Posted FAILED / INC / DRP grades from ana_class_grades in the viewer's scope
            $termIds = $this->termIdsFor($schoolYear, $semester !== '' ? $semester : null);
            $termSql = $termIds ? ' AND c.semester_id IN (' . implode(',', $termIds) . ')' : ' AND 1 = 0';
            $realGrades = Database::fetchAll("
                SELECT g.id AS grade_id, g.remarks, g.inc_deadline, g.inc_resolved_at, g.final_grade,
                       st.student_number, CONCAT(st.last_name, ', ', st.first_name) AS full_name,
                       COALESCE(p.code, 'N/A') AS department, st.year_level, COALESCE(sec.name, '-') AS section,
                       c.subject_code AS course_code,
                       c.subject_title AS course_title,
                       c.units AS units,
                       CONCAT(u.first_name, ' ', u.last_name) AS instructor,
                       sem.name AS semester_name, ay.label AS academic_year_label
                FROM `ana_class_grades` g
                JOIN `students` st ON g.student_id = st.id
                LEFT JOIN `programs` p ON st.program_id = p.id
                LEFT JOIN `sections` sec ON st.section_id = sec.id
                JOIN `ana_classes` c ON g.class_id = c.id AND c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
                LEFT JOIN `users` u ON c.faculty_user_id = u.id
                LEFT JOIN `semesters` sem ON c.semester_id = sem.id
                LEFT JOIN `academic_years` ay ON c.academic_year_id = ay.id
                WHERE g.remarks IN ('INC', 'FAILED', 'DRP'){$termSql}" . AnalyticsAccess::classScopeSql('c') . "
                ORDER BY g.id DESC
            ");

            foreach ($realGrades as $rg) {
                $rem = strtoupper($rg['remarks']);
                $type = ($rem === 'INC') ? 'Incomplete (INC)' : (($rem === 'FAILED') ? 'Failed (5.00)' : 'Dropped (DRP)');
                $gradeVal = ($rem === 'INC') ? 'INC' : (($rem === 'FAILED') ? $rg['final_grade'] : 'DRP');
                if ($rem === 'INC') {
                    if (!empty($rg['inc_resolved_at'])) {
                        $resStatus = 'Resolved';
                    } elseif (!empty($rg['inc_deadline']) && $rg['inc_deadline'] < date('Y-m-d')) {
                        $resStatus = 'Overdue Requirements';
                    } else {
                        $resStatus = 'Pending Requirements';
                    }
                } else {
                    $resStatus = ($rem === 'FAILED') ? 'Mandatory Retake' : 'Requires Re-enrollment';
                }
                $deadline = !empty($rg['inc_deadline']) ? date('F d, Y', strtotime($rg['inc_deadline'])) : ($rem === 'INC' ? 'Not Configured' : '—');

                if (!empty($deficiencyType) && $type !== $deficiencyType) continue;
                if (!empty($department) && $rg['department'] !== $department) continue;
                if (!empty($courseFilter) && $rg['course_code'] !== $courseFilter) continue;
                if (!empty($search)) {
                    $q = strtolower($search);
                    $m = (strpos(strtolower($rg['student_number']), $q) !== false)
                      || (strpos(strtolower($rg['full_name']), $q) !== false)
                      || (strpos(strtolower($rg['course_code']), $q) !== false);
                    if (!$m) continue;
                }

                $deficienciesList[] = [
                    'grade_id'          => (int) $rg['grade_id'],
                    'student_id'        => $rg['student_number'],
                    'full_name'         => $rg['full_name'],
                    'department'        => $rg['department'],
                    'year_level'        => $rg['year_level'] ?? 1,
                    'section'           => $rg['section'],
                    'course_code'       => $rg['course_code'],
                    'course_title'      => $rg['course_title'],
                    'units'             => (float) $rg['units'],
                    'instructor'        => $rg['instructor'] ?: 'Unassigned',
                    'grade'             => $gradeVal,
                    'deficiency_type'   => $type,
                    'term_recorded'     => ($rg['semester_name'] ?? '-') . ' • ' . ($rg['academic_year_label'] ?? '-'),
                    'resolution_status' => $resStatus,
                    'removal_deadline'  => $deadline,
                ];
            }
        } catch (\Throwable $e) {
            $deficienciesList = [];
        }
        $totalDeficiencies = count($deficienciesList);
        $totalInc = 0;
        $totalFailed = 0;
        $totalPendingRem = 0;

        foreach ($deficienciesList as $def) {
            if ($def['deficiency_type'] === 'Incomplete (INC)') $totalInc++;
            if ($def['deficiency_type'] === 'Failed (5.00)') $totalFailed++;
            if (stripos($def['resolution_status'], 'Pending') !== false || stripos($def['resolution_status'], 'Exam') !== false) {
                $totalPendingRem++;
            }
        }

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalDeficiencies, $perPage, $page, $_GET);
        $paginatedDeficiencies = array_slice($deficienciesList, $pagination['offset'], $perPage);

        View::render('analytics/Views/failedincompletemonitoring', [
            'title' => 'Failed & Incomplete Subject Watchlist',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Failed Incomplete Monitoring' => ''
            ],
            'department' => $department,
            'schoolYear' => $schoolYear,
            'semester' => $semester,
            'deficiencyType' => $deficiencyType,
            'courseFilter' => $courseFilter,
            'search' => $search,
            'departments' => $departments,
            'schoolYears' => $schoolYears,
            'semesters' => $semesters,
            'deficiencyTypes' => $deficiencyTypes,
            'deficienciesList' => $paginatedDeficiencies,
            'pagination' => $pagination,
            'totalDeficiencies' => $totalDeficiencies,
            'totalInc' => $totalInc,
            'totalFailed' => $totalFailed,
            'totalPendingRem' => $totalPendingRem
        ]);
    }

    public function attendancerecords(): void
    {
        $user = Auth::user();
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $subjectCode = trim($_GET['subject_code'] ?? '');
        $complianceFilter = trim($_GET['compliance'] ?? '');
        $search = trim($_GET['q'] ?? '');

        // 1. Active Academic Year & Semester
        $activeTerm = AnalyticsAccess::activeTerm();
        $ayLabel = $activeTerm['academic_year_label'] ?? 'No active academic year';
        $semName = $activeTerm['semester_name'] ?? 'No active semester';
        $termIds = $this->activeTermIds();

        // 2. Reference Programs, Sections, and Subjects
        $departments = $this->scopedProgramCodes();
        $sections = $this->scopedSectionNames();
        $subjects = Database::fetchAll("SELECT id, code, title FROM `subjects` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");

        // Policy thresholds (unset values are skipped, never assumed)
        $lateWeight = GradeCalculator::lateWeight();
        $criticalRate = AnalyticsSettings::get('attendance.critical_rate');
        $monitoredRate = AnalyticsSettings::get('attendance.monitored_rate');
        $minCuts = AnalyticsSettings::get('attendance.min_allowable_cuts');

        // 3. Query Real Student Attendance Records (voided entries excluded)
        $attendanceList = [];
        try {
            $termSql = $termIds ? 'c.semester_id IN (' . implode(',', $termIds) . ')' : '1 = 0';
            $sql = "SELECT s.id, s.student_number,
                           CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                           COALESCE(p.code, 'N/A') AS program_code,
                           s.year_level,
                           COALESCE(sec.name, '-') AS section_name,
                           COUNT(att.id) AS total_sessions,
                           SUM(CASE WHEN att.status = 'Present' THEN 1 ELSE 0 END) AS present_count,
                           SUM(CASE WHEN att.status = 'Absent' THEN 1 ELSE 0 END) AS absent_count,
                           SUM(CASE WHEN att.status = 'Excused' THEN 1 ELSE 0 END) AS excused_count,
                           SUM(CASE WHEN att.status = 'Late' THEN 1 ELSE 0 END) AS late_count,
                           COUNT(DISTINCT att.subject_code) AS enrolled_courses_count
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    LEFT JOIN (`ana_attendance_records` att JOIN `ana_classes` c ON c.id = att.class_id AND c.deleted_at IS NULL AND {$termSql}" . AnalyticsAccess::facultyClassSql('c') . ")
                        ON att.student_id = s.id AND att.voided_at IS NULL";
            $params = [];

            if (!empty($subjectCode)) {
                $sql .= " AND att.subject_code = ?";
                $params[] = $subjectCode;
            }

            $sql .= " WHERE s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s');

            if (!empty($search)) {
                $sql .= " AND (s.student_number LIKE ? OR s.first_name LIKE ? OR s.last_name LIKE ? OR CONCAT(s.first_name, ' ', s.last_name) LIKE ?)";
                $qTerm = '%' . $search . '%';
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

            $sql .= " GROUP BY s.id ORDER BY absent_count DESC, s.last_name ASC";
            $rawStudents = Database::fetchAll($sql, $params);

            foreach ($rawStudents as $std) {
                $totalSessions = (int) ($std['total_sessions'] ?? 0);
                $presentCount = (int) ($std['present_count'] ?? 0);
                $absentCount = (int) ($std['absent_count'] ?? 0);
                $excusedCount = (int) ($std['excused_count'] ?? 0);
                $lateCount = (int) ($std['late_count'] ?? 0);
                $coursesCount = (int) ($std['enrolled_courses_count'] ?? 0);

                if ($totalSessions > 0) {
                    $attendanceRate = round((($presentCount + ($lateCount * $lateWeight) + $excusedCount) / $totalSessions) * 100, 1);
                    $termAllowableCuts = AnalyticsSettings::allowedAbsences($totalSessions);
                    if ($termAllowableCuts !== null && $minCuts !== null) {
                        $termAllowableCuts = max((int) $minCuts, $termAllowableCuts);
                    }
                    $remainingCuts = $termAllowableCuts !== null ? max(0, $termAllowableCuts - $absentCount) : null;

                    if (($termAllowableCuts !== null && $absentCount >= $termAllowableCuts) || ($criticalRate !== null && $attendanceRate < (float) $criticalRate)) {
                        $complianceStatus = 'Critical Risk';
                        $complianceBadge = 'bg-danger-subtle text-danger border border-danger';
                        $chedNote = 'Policy Exceeded (Allowable Cuts)';
                    } elseif (($termAllowableCuts !== null && $absentCount >= ($termAllowableCuts - 1)) || ($monitoredRate !== null && $attendanceRate < (float) $monitoredRate)) {
                        $complianceStatus = 'Monitored';
                        $complianceBadge = 'bg-warning-subtle text-dark border border-warning';
                        $chedNote = $remainingCuts !== null ? $remainingCuts . ' cut' . ($remainingCuts == 1 ? '' : 's') . ' remaining' : 'Below monitored rate';
                    } elseif ($termAllowableCuts === null && $criticalRate === null && $monitoredRate === null) {
                        $complianceStatus = 'Not Configured';
                        $complianceBadge = 'bg-light text-secondary border';
                        $chedNote = 'Attendance policy not configured';
                    } else {
                        $complianceStatus = 'Compliant';
                        $complianceBadge = 'bg-success-subtle text-success border border-success';
                        $chedNote = 'In Good Standing';
                    }
                } else {
                    $attendanceRate = null;
                    $complianceStatus = 'No Logs Yet';
                    $complianceBadge = 'bg-light text-secondary border';
                    $chedNote = 'No sessions recorded';
                }

                $std['total_sessions'] = $totalSessions;
                $std['present_count'] = $presentCount;
                $std['absent_count'] = $absentCount;
                $std['excused_count'] = $excusedCount;
                $std['late_count'] = $lateCount;
                $std['attendance_rate'] = $attendanceRate;
                $std['enrolled_courses_count'] = $coursesCount;
                $std['compliance_status'] = $complianceStatus;
                $std['compliance_badge'] = $complianceBadge;
                $std['ched_note'] = $chedNote;

                if (!empty($complianceFilter)) {
                    if ($complianceFilter === 'chronic' && $complianceStatus !== 'Critical Risk') continue;
                    if ($complianceFilter === 'monitored' && $complianceStatus !== 'Monitored') continue;
                    if ($complianceFilter === 'compliant' && $complianceStatus !== 'Compliant') continue;
                }

                $attendanceList[] = $std;
            }
        } catch (\Throwable $e) {
            $attendanceList = [];
        }
        $totalStudents = count($attendanceList);
        $activeWithLogs = array_filter($attendanceList, fn($s) => ($s['total_sessions'] ?? 0) > 0);
        $cohortRate = count($activeWithLogs) > 0 ? round(array_sum(array_column($activeWithLogs, 'attendance_rate')) / count($activeWithLogs), 1) : 0.0;
        $criticalCount = count(array_filter($attendanceList, fn($s) => ($s['compliance_status'] ?? '') === 'Critical Risk'));
        $monitoredCount = count(array_filter($attendanceList, fn($s) => ($s['compliance_status'] ?? '') === 'Monitored'));
        $compliantCount = count(array_filter($attendanceList, fn($s) => ($s['compliance_status'] ?? '') === 'Compliant'));

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalStudents, $perPage, $page, $_GET);
        $paginatedAttendance = array_slice($attendanceList, $pagination['offset'], $perPage);

        $recentSessions = [];
        try {
            $recentSessions = Database::fetchAll("
                SELECT att.*,
                       st.first_name, st.last_name, st.student_number,
                       COALESCE(c.subject_code, att.subject_code) AS display_subject_code,
                       COALESCE(c.section_name, '-') AS section_name,
                       CONCAT(u.first_name, ' ', u.last_name) AS recorded_by_name
                FROM `ana_attendance_records` att
                JOIN `students` st ON att.student_id = st.id
                JOIN `ana_classes` c ON att.class_id = c.id AND c.deleted_at IS NULL
                LEFT JOIN `users` u ON att.recorded_by = u.id
                WHERE att.voided_at IS NULL" . AnalyticsAccess::studentScopeSql('st') . AnalyticsAccess::facultyClassSql('c') . "
                ORDER BY att.session_date DESC, att.id DESC
                LIMIT 50
            ");
        } catch (\Throwable $e) {
            $recentSessions = [];
        }
        View::render('analytics/Views/attendancerecords', [
            'title' => 'Student Attendance Records & Roll-Call Monitoring',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Attendance & Engagement' => '',
                'Attendance Records' => ''
            ],
            'attendanceList' => $paginatedAttendance,
            'recentSessions' => $recentSessions,
            'pagination' => $pagination,
            'departments' => $departments,
            'sections' => $sections,
            'subjects' => $subjects,
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'subjectCode' => $subjectCode,
            'complianceFilter' => $complianceFilter,
            'search' => $search,
            'cohortRate' => $cohortRate,
            'criticalCount' => $criticalCount,
            'monitoredCount' => $monitoredCount,
            'compliantCount' => $compliantCount,
            'totalStudents' => $totalStudents,
            'ayLabel' => $ayLabel,
            'semName' => $semName
        ]);
    }

    public function participationtracking(): void
    {
        $user = Auth::user();
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = $this->scopedProgramCodes();
        $sections = $this->scopedSectionNames();

        $participationList = [];
        try {
            $stats = $this->studentTaskStats($this->activeTermIds());
            foreach ($this->filteredStudents($department, $yearLevel, $section, $search) as $std) {
                $st = $stats[(int) $std['id']] ?? null;
                if (!$st || $st['compliance'] === null) {
                    continue;
                }
                $std['quizzes_done'] = $st['quizzes_done'];
                $std['total_quizzes'] = $st['total_quizzes'];
                $std['activities_done'] = $st['activities_done'];
                $std['total_activities'] = $st['total_activities'];
                $std['missed_tasks'] = $st['missing'];
                $std['compliance_rate'] = round($st['compliance'] * 100, 1);
                $participationList[] = $std;
            }
        } catch (\Throwable $e) {
            $participationList = [];
        }
        $totalStudents = count($participationList);
        $zeroMissedCount = count(array_filter($participationList, fn($p) => ($p['missed_tasks'] ?? 0) === 0));
        $minorMissedCount = count(array_filter($participationList, fn($p) => ($p['missed_tasks'] ?? 0) >= 1 && ($p['missed_tasks'] ?? 0) <= 2));
        $criticalMissedCount = count(array_filter($participationList, fn($p) => ($p['missed_tasks'] ?? 0) >= 3));
        $avgAssessmentRate = $totalStudents > 0 ? round(array_sum(array_column($participationList, 'compliance_rate')) / $totalStudents, 1) : 0;

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalStudents, $perPage, $page, $_GET);
        $paginatedParticipation = array_slice($participationList, $pagination['offset'], $perPage);

        View::render('analytics/Views/participationtracking', [
            'title' => 'Class Record Participation & Task Submission Tracking',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Participation Tracking' => ''
            ],
            'participationList' => $paginatedParticipation,
            'pagination' => $pagination,
            'departments' => $departments,
            'sections' => $sections,
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'search' => $search,
            'zeroMissedCount' => $zeroMissedCount,
            'minorMissedCount' => $minorMissedCount,
            'criticalMissedCount' => $criticalMissedCount,
            'avgAssessmentRate' => $avgAssessmentRate
        ]);
    }

    public function studentengagement(): void
    {
        $user = Auth::user();
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = $this->scopedProgramCodes();
        $sections = $this->scopedSectionNames();

        $engagementList = [];
        try {
            // Engagement = average of the available components: attendance rate and task submission compliance
            $termIds = $this->activeTermIds();
            $stats = $this->studentTaskStats($termIds);
            $attendance = $this->studentAttendanceStats($termIds);

            foreach ($this->filteredStudents($department, $yearLevel, $section, $search) as $std) {
                $sid = (int) $std['id'];
                $st = $stats[$sid] ?? null;
                $att = $attendance[$sid] ?? null;
                $parts = array_values(array_filter([$att['rate'] ?? null, $st['compliance'] ?? null], fn($v) => $v !== null));
                if (!$parts) {
                    continue;
                }
                $late = (int) ($st['late'] ?? 0);
                $done = (int) ($st['done'] ?? 0);
                $lastTs = max((int) ($st['last_ts'] ?? 0), (int) ($att['last_ts'] ?? 0));

                $std['turnaround_speed'] = $late > 0 ? 'Late (' . $late . ' task' . ($late === 1 ? '' : 's') . ')' : ($done > 0 ? 'On-Time' : 'No Submissions');
                $std['engagement_score'] = round(array_sum($parts) / count($parts) * 100, 1);
                $std['last_activity'] = $lastTs > 0 ? $this->humanizeAgo($lastTs) : 'No activity';
                $engagementList[] = $std;
            }
        } catch (\Throwable $e) {
            $engagementList = [];
        }
        $totalStudents = count($engagementList);
        $submitRate = $totalStudents > 0 ? round(array_sum(array_column($engagementList, 'engagement_score')) / $totalStudents, 1) : 0;
        $highComplianceCount = count(array_filter($engagementList, fn($e) => ($e['engagement_score'] ?? 0) >= 90.0));
        $deficitCount = count(array_filter($engagementList, fn($e) => ($e['engagement_score'] ?? 0) < 75.0));

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalStudents, $perPage, $page, $_GET);
        $paginatedEngagement = array_slice($engagementList, $pagination['offset'], $perPage);

        View::render('analytics/Views/studentengagement', [
            'title' => 'Coursework Submission Compliance & Engagement Audit',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Student Engagement' => ''
            ],
            'engagementList' => $paginatedEngagement,
            'pagination' => $pagination,
            'departments' => $departments,
            'sections' => $sections,
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'search' => $search,
            'submitRate' => $submitRate,
            'highComplianceCount' => $highComplianceCount,
            'deficitCount' => $deficitCount,
            'totalStudents' => $totalStudents
        ]);
    }

    public function behaviorrecords(): void
    {
        $user = Auth::user();
        $department = trim($_GET['department'] ?? '');
        $severity = trim($_GET['severity'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = $this->scopedProgramCodes();

        $behaviorList = [];
        try {
            $sql = "SELECT b.*,
                           CONCAT(s.last_name, ', ', s.first_name) AS full_name,
                           CONCAT(s.last_name, ', ', s.first_name) AS student_name,
                           s.student_number,
                           COALESCE(p.code, 'N/A') AS program_code,
                           s.year_level
                    FROM `ana_behavior_records` b
                    JOIN `students` s ON b.student_id = s.id
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    WHERE b.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s')
                        . (AnalyticsAccess::isFacultyScope() ? " AND (b.reported_by = " . (int) Auth::id() . " OR b.class_id IN (SELECT fbc.id FROM `ana_classes` fbc WHERE fbc.faculty_user_id = " . (int) Auth::id() . "))" : '');
            $params = [];

            if (!empty($search)) {
                $sql .= " AND (s.student_number LIKE ? OR s.first_name LIKE ? OR s.last_name LIKE ? OR b.incident_type LIKE ? OR b.description LIKE ?)";
                $qTerm = '%' . $search . '%';
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
            if (!empty($severity)) {
                $sql .= " AND b.severity = ?";
                $params[] = $severity;
            }

            $sql .= " ORDER BY b.id DESC";
            $behaviorList = Database::fetchAll($sql, $params);
            foreach ($behaviorList as &$row) {
                if ($row['status'] === 'Investigating') {
                    $row['status'] = 'Under Investigation';
                }
            }
            unset($row);
        } catch (\Throwable $e) {
            $behaviorList = [];
        }

        $totalIncidents = count($behaviorList);
        $minorCount = 0;
        $majorCount = 0;
        $severeCount = 0;
        $investigationCount = 0;
        $resolvedCount = 0;

        foreach ($behaviorList as $row) {
            $sev = $row['severity'] ?? 'Minor';
            $st = $row['status'] ?? 'Reported';
            if ($sev === 'Minor')
                $minorCount++;
            if ($sev === 'Moderate')
                $majorCount++;
            if ($sev === 'Severe')
                $severeCount++;
            if ($st === 'Under Investigation' || $st === 'Reported')
                $investigationCount++;
            if ($st === 'Resolved' || $st === 'Dismissed')
                $resolvedCount++;
        }

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $pagination = $this->buildPagination($totalIncidents, $perPage, $page, $_GET);
        $paginatedBehavior = array_slice($behaviorList, $pagination['offset'], $perPage);

        View::render('analytics/Views/behaviorrecords', [
            'title' => 'Student Behavior & Discipline Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'retention',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Behavioral Records' => ''
            ],
            'department' => $department,
            'severity' => $severity,
            'search' => $search,
            'departments' => $departments,
            'behaviorList' => $paginatedBehavior,
            'pagination' => $pagination,
            'totalIncidents' => $totalIncidents,
            'minorCount' => $minorCount,
            'majorCount' => $majorCount,
            'severeCount' => $severeCount,
            'investigationCount' => $investigationCount,
            'resolvedCount' => $resolvedCount,
            'resolvedBehaviorCount' => $resolvedCount
        ]);
    }

    public function switchPersona(): void
    {
        $key = (string) ($_POST['persona'] ?? '');
        if (!AnalyticsAccess::setPersona($key)) {
            redirect(url('analytics'), 'error', 'That workspace is not available to your account.');
        }
        redirect(url(AnalyticsAccess::personas()[$key]['url']));
    }

    // ------------------------------------------------------------------
    // Shared data helpers (all queries apply the viewer's program scope)
    // ------------------------------------------------------------------

    /**
     * Semester ids of the active term (the core calendar can hold duplicate semester rows).
     */
    private function activeTermIds(): array
    {
        $term = AnalyticsAccess::activeTerm();
        if (!$term) {
            return [];
        }
        return array_map('intval', array_column(Database::fetchAll(
            "SELECT id FROM `semesters` WHERE academic_year_id = ? AND code = ?",
            [(int) $term['academic_year_id'], $term['semester_code']]
        ), 'id'));
    }

    /**
     * [school year codes, semester names, default year code, default semester name] from the academic calendar.
     */
    private function termFilterOptions(): array
    {
        $years = array_column(Database::fetchAll("SELECT code FROM `academic_years` ORDER BY start_date DESC, id DESC"), 'code');
        $sems = array_column(Database::fetchAll("SELECT name FROM `semesters` GROUP BY name ORDER BY MIN(code)"), 'name');
        $term = AnalyticsAccess::activeTerm();
        $defaultYear = $term ? (string) Database::fetchColumn("SELECT code FROM `academic_years` WHERE id = ?", [(int) $term['academic_year_id']]) : ($years[0] ?? '');
        $defaultSem = $term['semester_name'] ?? ($sems[0] ?? '');
        return [$years, $sems, $defaultYear, $defaultSem];
    }

    private function termIdsFor(string $yearCode, ?string $semesterName): array
    {
        $sql = "SELECT sem.id FROM `semesters` sem JOIN `academic_years` ay ON ay.id = sem.academic_year_id WHERE ay.code = ?";
        $params = [$yearCode];
        if ($semesterName !== null && $semesterName !== '') {
            $sql .= " AND sem.name = ?";
            $params[] = $semesterName;
        }
        return array_map('intval', array_column(Database::fetchAll($sql, $params), 'id'));
    }

    private function scopedProgramCodes(): array
    {
        return array_column(Database::fetchAll(
            "SELECT DISTINCT p.code FROM `programs` p WHERE p.deleted_at IS NULL" . AnalyticsAccess::programScopeSql('p.id') . " ORDER BY p.code ASC"
        ), 'code');
    }

    private function scopedSectionNames(): array
    {
        return array_column(Database::fetchAll(
            "SELECT DISTINCT sx.name FROM `sections` sx WHERE sx.deleted_at IS NULL" . AnalyticsAccess::sectionScopeSql('sx') . " ORDER BY sx.name ASC"
        ), 'name');
    }

    /**
     * Per-subject results from posted / locked class grades.
     */
    private function subjectGradeRows(array $termIds, ?string $department, ?string $search): array
    {
        if (!$termIds) {
            return [];
        }
        $params = [];
        $sql = "SELECT c.subject_code, MAX(c.subject_title) AS subject_title, MAX(c.section_name) AS section_name, MAX(c.units) AS units,
                       COALESCE(MAX(p.code), 'General') AS department,
                       GROUP_CONCAT(DISTINCT CONCAT(u.first_name, ' ', u.last_name) ORDER BY u.last_name SEPARATOR ', ') AS instructors,
                       COUNT(g.id) AS graded,
                       SUM(g.remarks = 'PASSED') AS passed,
                       SUM(g.remarks = 'PASSED' AND CAST(g.final_grade AS DECIMAL(5,2)) <= 1.75) AS honors,
                       SUM(g.remarks = 'INC') AS inc,
                       SUM(g.remarks IN ('FAILED', 'DRP')) AS fails,
                       SUM(CASE WHEN g.remarks IN ('PASSED', 'FAILED') THEN CAST(g.final_grade AS DECIMAL(5,2)) END) AS gpa_sum,
                       SUM(g.remarks IN ('PASSED', 'FAILED')) AS gpa_count
                FROM `ana_classes` c
                JOIN `ana_class_grades` g ON g.class_id = c.id
                LEFT JOIN `subjects` sub ON sub.id = c.subject_id
                LEFT JOIN `programs` p ON p.id = sub.program_id
                LEFT JOIN `users` u ON u.id = c.faculty_user_id
                WHERE c.deleted_at IS NULL AND c.grade_status IN ('posted', 'locked')
                  AND c.semester_id IN (" . implode(',', array_map('intval', $termIds)) . ")" . AnalyticsAccess::classScopeSql('c');
        if ($department) {
            $sql .= " AND p.code = ?";
            $params[] = $department;
        }
        if ($search) {
            $sql .= " AND (c.subject_code LIKE ? OR c.subject_title LIKE ?)";
            $params[] = '%' . $search . '%';
            $params[] = '%' . $search . '%';
        }
        // Faculty see one row per class (subject + section) so sections are never combined
        $perClass = AnalyticsAccess::isFacultyScope();
        $sql .= $perClass ? " GROUP BY c.id, c.subject_code ORDER BY c.subject_code ASC, section_name ASC" : " GROUP BY c.subject_code ORDER BY c.subject_code ASC";

        $threshold = AnalyticsSettings::get('analytics.bottleneck_passing_rate');
        $rows = [];
        foreach (Database::fetchAll($sql, $params) as $r) {
            $graded = (int) $r['graded'];
            $passed = (int) $r['passed'];
            $rate = $graded > 0 ? round($passed / $graded * 100, 1) : 0.0;
            $rows[] = [
                'course_code' => $r['subject_code'],
                'course_title' => $perClass ? $r['subject_title'] . ' — ' . $r['section_name'] : $r['subject_title'],
                'department' => $r['department'],
                'units' => (float) $r['units'],
                'enrolled' => $graded,
                'mean_gpa' => (int) $r['gpa_count'] > 0 ? round((float) $r['gpa_sum'] / (int) $r['gpa_count'], 2) : 0,
                'passing_rate' => $rate,
                'instructor' => $r['instructors'] ?: 'Unassigned',
                'honor_count' => (int) $r['honors'],
                'pass_count' => $passed - (int) $r['honors'],
                'risk_count' => (int) $r['inc'],
                'fail_count' => (int) $r['fails'],
                'is_bottleneck' => $threshold !== null && $graded > 0 && $rate < (float) $threshold,
                'passed' => $passed,
                'gpa_sum' => (float) $r['gpa_sum'],
                'gpa_count' => (int) $r['gpa_count'],
            ];
        }
        return $rows;
    }

    private function filteredStudents(string $department, string $yearLevel, string $section, string $search): array
    {
        $sql = "SELECT s.id, s.student_number,
                       CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                       COALESCE(p.code, 'N/A') AS program_code,
                       s.year_level,
                       COALESCE(sec.name, '-') AS section_name
                FROM `students` s
                LEFT JOIN `programs` p ON s.program_id = p.id
                LEFT JOIN `sections` sec ON s.section_id = sec.id
                WHERE s.deleted_at IS NULL" . AnalyticsAccess::studentScopeSql('s');
        $params = [];
        if ($search !== '') {
            $sql .= " AND (s.student_number LIKE ? OR s.first_name LIKE ? OR s.last_name LIKE ? OR CONCAT(s.first_name, ' ', s.last_name) LIKE ?)";
            array_push($params, '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%');
        }
        if ($department !== '') {
            $sql .= " AND p.code = ?";
            $params[] = $department;
        }
        if ($yearLevel !== '') {
            $sql .= " AND s.year_level = ?";
            $params[] = (int) $yearLevel;
        }
        if ($section !== '') {
            $sql .= " AND sec.name = ?";
            $params[] = $section;
        }
        return Database::fetchAll($sql . " ORDER BY s.last_name ASC, s.first_name ASC", $params);
    }

    /**
     * Task submission statistics per student from ana_class_scores of rostered classes.
     * Quizzes are tasks in a component or with a title mentioning "quiz"; exams are left out;
     * every other task counts as an activity.
     */
    private function studentTaskStats(array $termIds): array
    {
        if (!$termIds) {
            return [];
        }
        $classes = Database::fetchAll(
            "SELECT c.* FROM `ana_classes` c WHERE c.deleted_at IS NULL AND c.semester_id IN (" . implode(',', array_map('intval', $termIds)) . ")" . AnalyticsAccess::classScopeSql('c')
        );
        $stats = [];
        foreach ($classes as $cls) {
            $scheme = ClassRecord::scheme($cls);
            $kinds = [];
            foreach ($scheme['groups'] as $g) {
                foreach ($g['items'] as $it) {
                    $text = strtolower($g['title'] . ' ' . $it['title'] . ' ' . $it['code']);
                    $kinds[$it['code']] = str_contains($text, 'exam') ? 'exam' : (str_contains($text, 'quiz') ? 'quiz' : 'activity');
                }
            }
            $quizTotal = count(array_filter($kinds, fn($k) => $k === 'quiz'));
            $actTotal = count(array_filter($kinds, fn($k) => $k === 'activity'));

            foreach (ClassRecord::roster((int) $cls['id']) as $r) {
                $sid = (int) $r['student_id'];
                $stats[$sid] ??= ['quizzes_done' => 0, 'total_quizzes' => 0, 'activities_done' => 0, 'total_activities' => 0,
                                  'done' => 0, 'late' => 0, 'missing' => 0, 'excused' => 0, 'last_ts' => 0, 'compliance' => null];
                $stats[$sid]['total_quizzes'] += $quizTotal;
                $stats[$sid]['total_activities'] += $actTotal;
            }
            foreach (Database::fetchAll(
                "SELECT sc.student_id, sc.item_code, sc.score, sc.submission_status, COALESCE(sc.updated_at, sc.created_at) AS ts
                 FROM `ana_class_scores` sc
                 JOIN `ana_class_students` cs ON cs.class_id = sc.class_id AND cs.student_id = sc.student_id AND cs.status = 'enrolled'
                 WHERE sc.class_id = ?",
                [(int) $cls['id']]
            ) as $sc) {
                $sid = (int) $sc['student_id'];
                if (!isset($stats[$sid]) || !isset($kinds[$sc['item_code']])) {
                    continue;
                }
                $kind = $kinds[$sc['item_code']];
                $status = $sc['submission_status'];
                $isDone = in_array($status, ['submitted', 'late'], true) && $sc['score'] !== null;
                if ($isDone) {
                    $stats[$sid]['done']++;
                    if ($kind === 'quiz') {
                        $stats[$sid]['quizzes_done']++;
                    } elseif ($kind === 'activity') {
                        $stats[$sid]['activities_done']++;
                    }
                }
                if ($status === 'late') {
                    $stats[$sid]['late']++;
                } elseif ($status === 'missing') {
                    $stats[$sid]['missing']++;
                } elseif ($status === 'excused') {
                    $stats[$sid]['excused']++;
                }
                $stats[$sid]['last_ts'] = max($stats[$sid]['last_ts'], (int) strtotime((string) $sc['ts']));
            }
        }
        foreach ($stats as &$s) {
            $denom = $s['done'] + $s['missing'];
            $s['compliance'] = $denom > 0 ? $s['done'] / $denom : null;
        }
        return $stats;
    }

    private function studentAttendanceStats(array $termIds): array
    {
        if (!$termIds) {
            return [];
        }
        $out = [];
        foreach (Database::fetchAll(
            "SELECT a.student_id, SUM(a.status = 'Present') AS present, SUM(a.status = 'Late') AS late,
                    SUM(a.status = 'Excused') AS excused, COUNT(*) AS total, MAX(a.session_date) AS last_date
             FROM `ana_attendance_records` a JOIN `ana_classes` c ON c.id = a.class_id AND c.deleted_at IS NULL
             WHERE a.voided_at IS NULL AND c.semester_id IN (" . implode(',', array_map('intval', $termIds)) . ")" . AnalyticsAccess::classScopeSql('c') . "
             GROUP BY a.student_id"
        ) as $r) {
            $out[(int) $r['student_id']] = ['rate' => GradeCalculator::attendanceRate($r), 'last_ts' => (int) strtotime((string) $r['last_date'])];
        }
        return $out;
    }

    private function humanizeAgo(int $ts): string
    {
        $diff = time() - $ts;
        if ($diff < 3600) {
            return max(1, (int) floor($diff / 60)) . ' min ago';
        }
        if ($diff < 86400) {
            return (int) floor($diff / 3600) . ' hrs ago';
        }
        $days = (int) floor($diff / 86400);
        return $days === 1 ? 'Yesterday' : $days . ' days ago';
    }

    /**
     * Build server-side pagination metadata and HTML links.

     *
     * @param int $totalRecords Total count of matching items in DB
     * @param int $perPage Items per page (default 20)
     * @param int $currentPage Current page number
     * @param array $queryParams Existing $_GET parameters to retain
     * @return array
     */
    private function buildPagination(int $totalRecords, int $perPage, int $currentPage, array $queryParams = []): array
    {
        $perPage = max(1, $perPage);
        $totalPages = max(1, (int) ceil($totalRecords / $perPage));
        $currentPage = max(1, min($currentPage, $totalPages));
        $offset = ($currentPage - 1) * $perPage;
        $from = $totalRecords > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $totalRecords);

        unset($queryParams['page']);

        $buildUrl = function (int $p) use ($queryParams): string {
            $params = array_merge($queryParams, ['page' => $p]);
            return '?' . http_build_query($params);
        };

        $html = '<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pt-3 mt-3 border-top px-3 pb-3">';
        $html .= '<div class="text-muted small">';
        if ($totalRecords > 0) {
            $html .= 'Showing <span class="fw-bold text-dark">' . $from . '</span> to <span class="fw-bold text-dark">' . $to . '</span> of <span class="fw-bold text-dark">' . number_format($totalRecords) . '</span> entries';
        } else {
            $html .= 'No entries found';
        }
        $html .= '</div>';

        if ($totalPages > 1) {
            $html .= '<nav aria-label="Table navigation">';
            $html .= '<ul class="pagination pagination-sm mb-0">';

            // Prev Button
            if ($currentPage > 1) {
                $html .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($buildUrl($currentPage - 1)) . '" aria-label="Previous"><i class="bi bi-chevron-left me-1"></i>Prev</a></li>';
            } else {
                $html .= '<li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left me-1"></i>Prev</span></li>';
            }

            // Numbered Page Buttons
            $range = 2;
            $start = max(1, $currentPage - $range);
            $end = min($totalPages, $currentPage + $range);

            if ($start > 1) {
                $html .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($buildUrl(1)) . '">1</a></li>';
                if ($start > 2) {
                    $html .= '<li class="page-item disabled"><span class="page-link text-muted">...</span></li>';
                }
            }

            for ($p = $start; $p <= $end; $p++) {
                if ($p === $currentPage) {
                    $html .= '<li class="page-item active" aria-current="page"><span class="page-link" style="background-color: #800020; border-color: #800020; color: #fff;">' . $p . '</span></li>';
                } else {
                    $html .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($buildUrl($p)) . '">' . $p . '</a></li>';
                }
            }

            if ($end < $totalPages) {
                if ($end < $totalPages - 1) {
                    $html .= '<li class="page-item disabled"><span class="page-link text-muted">...</span></li>';
                }
                $html .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($buildUrl($totalPages)) . '">' . $totalPages . '</a></li>';
            }

            // Next Button
            if ($currentPage < $totalPages) {
                $html .= '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($buildUrl($currentPage + 1)) . '" aria-label="Next">Next <i class="bi bi-chevron-right ms-1"></i></a></li>';
            } else {
                $html .= '<li class="page-item disabled"><span class="page-link">Next <i class="bi bi-chevron-right ms-1"></i></span></li>';
            }

            $html .= '</ul>';
            $html .= '</nav>';
        }

        $html .= '</div>';

        return [
            'page' => $currentPage,
            'per_page' => $perPage,
            'total' => $totalRecords,
            'total_pages' => $totalPages,
            'offset' => $offset,
            'from' => $from,
            'to' => $to,
            'html' => $html
        ];
    }
}
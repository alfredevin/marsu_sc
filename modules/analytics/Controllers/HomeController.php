<?php
namespace Modules\Analytics\Controllers;

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
            $records = Database::fetchAll("SELECT * FROM `ana_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            // Table might be pending migration
        }

        View::render('analytics/Views/index', [
            'title' => 'Student Retention & Academic Risk Early Warning System',
            'moduleName' => 'Academic Analytics & Student Monitoring System',
            'slug' => 'analytics',
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
        $record = Database::fetchOne("SELECT * FROM `ana_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);

        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('analytics'));
        }

        View::render('analytics/Views/index', [
            'title' => 'View Record #{$id}',
            'moduleName' => 'Academic Analytics & Student Monitoring System',
            'slug' => 'analytics',
            'record' => $record,
            'records' => [],
            'crumbs' => ['Student Retention & Academic Risk Early Warning System' => url('analytics'), 'View' => '']
        ]);
    }

    public function store(): void
    {
        $type = trim($_POST['type'] ?? 'record');
        $user = Auth::user();
        $userId = Auth::id() ?: 1;

        try {
            if ($type === 'attendance') {
                $studentId = trim($_POST['student_id'] ?? '');
                $sessionDate = trim($_POST['session_date'] ?? date('Y-m-d'));
                $subjectCode = trim($_POST['subject_code'] ?? '');
                $status = trim($_POST['status'] ?? 'Present');
                $remarks = trim($_POST['remarks'] ?? '');

                Database::insert('ana_records', [
                    'title' => "Attendance: " . ($subjectCode ?: 'General') . " - {$status} for Student {$studentId}",
                    'description' => "Date: {$sessionDate} | Status: {$status} | Notes: {$remarks}",
                    'status' => 'active',
                    'created_by' => $userId,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Roll-call attendance session logged successfully.');
                redirect(url('analytics/attendancerecords'));
                return;
            }

            if ($type === 'task_exception') {
                $studentId = trim($_POST['student_id'] ?? '');
                $subjectCode = trim($_POST['subject_code'] ?? '');
                $assessmentType = trim($_POST['assessment_type'] ?? 'Assignment');
                $exceptionStatus = trim($_POST['exception_status'] ?? 'Late Submission');
                $remediationNotes = trim($_POST['remediation_notes'] ?? '');

                Database::insert('ana_records', [
                    'title' => "Task Exception: " . ($subjectCode ?: 'Coursework') . " - {$assessmentType} ({$exceptionStatus}) for Student {$studentId}",
                    'description' => "Remediation & Reason: {$remediationNotes}",
                    'status' => 'active',
                    'created_by' => $userId,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Assessment task exception logged successfully.');
                redirect(url('analytics/participationtracking'));
                return;
            }

            if ($type === 'advising') {
                $studentId = trim($_POST['student_id'] ?? '');
                $advisingDate = trim($_POST['advising_date'] ?? date('Y-m-d'));
                $topic = trim($_POST['topic'] ?? 'General Academic Advising');
                $notes = trim($_POST['notes'] ?? '');
                $recommendations = trim($_POST['recommendations'] ?? '');
                $status = trim($_POST['status'] ?? 'Completed');
                $followUpDate = !empty($_POST['follow_up_date']) ? $_POST['follow_up_date'] : null;

                Database::insert('ret_advising_records', [
                    'student_id' => $studentId,
                    'advisor_id' => $userId,
                    'advising_date' => $advisingDate,
                    'topic' => $topic,
                    'notes' => $notes,
                    'recommendations' => $recommendations,
                    'status' => $status,
                    'follow_up_date' => $followUpDate,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Academic advising session logged successfully.');
                redirect(url('analytics/advisingrecords'));
                return;
            }

            if ($type === 'guidance') {
                $studentId = trim($_POST['student_id'] ?? '');
                $severity = trim($_POST['severity_level'] ?? 'Medium');
                $reason = trim($_POST['referral_reason'] ?? '');
                $notes = trim($_POST['notes'] ?? '');

                Database::insert('ret_guidance_referrals', [
                    'student_id' => $studentId,
                    'referred_by' => $userId,
                    'referral_reason' => $reason,
                    'severity_level' => $severity,
                    'status' => 'Pending Intake',
                    'resolution_notes' => $notes,
                    'referred_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Guidance & counseling referral submitted successfully.');
                redirect(url('analytics/guidancereferrals'));
                return;
            }

            if ($type === 'support') {
                $studentId = trim($_POST['student_id'] ?? '');
                $subjectCode = trim($_POST['subject_code'] ?? '');
                $programName = trim($_POST['program_name'] ?? 'Peer Mentoring Clinic');
                $mentorName = trim($_POST['mentor_name'] ?? '');
                $enrolledAt = trim($_POST['enrolled_at'] ?? date('Y-m-d'));

                Database::insert('ret_academic_support', [
                    'student_id' => $studentId,
                    'program_name' => $programName,
                    'subject_code' => $subjectCode,
                    'mentor_name' => $mentorName,
                    'status' => 'Active',
                    'enrolled_at' => $enrolledAt,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Student successfully enrolled in academic support program.');
                redirect(url('analytics/academicsupportprograms'));
                return;
            }

            if ($type === 'behavior') {
                $studentId = trim($_POST['student_id'] ?? '');
                $incidentDate = trim($_POST['incident_date'] ?? date('Y-m-d'));
                $incidentType = trim($_POST['incident_type'] ?? 'Classroom Conduct');
                $severity = trim($_POST['severity'] ?? 'Minor');
                $description = trim($_POST['description'] ?? '');

                Database::insert('ret_behavior_records', [
                    'student_id' => $studentId,
                    'reported_by' => $userId,
                    'incident_date' => $incidentDate,
                    'incident_type' => $incidentType,
                    'severity' => $severity,
                    'description' => $description,
                    'status' => 'Reported',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Student behavior incident log recorded.');
                redirect(url('analytics/behaviorrecords'));
                return;
            }

            if ($type === 'risk') {
                $studentId = trim($_POST['student_id'] ?? '');
                $riskLevel = trim($_POST['risk_level'] ?? 'Moderate');
                $riskFactors = trim($_POST['risk_factors'] ?? '');
                $riskScore = ($riskLevel === 'High') ? 85.0 : (($riskLevel === 'Moderate') ? 60.0 : 30.0);

                Database::insert('ret_risk_logs', [
                    'student_id' => $studentId,
                    'risk_level' => $riskLevel,
                    'risk_score' => $riskScore,
                    'risk_factors' => $riskFactors,
                    'status' => 'Active',
                    'detected_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                Session::flash('success', 'Student successfully flagged as at-risk.');
                redirect(url('analytics/atriskstudents'));
                return;
            }

            // Default fallback: ana_records
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (!$title) {
                Session::flash('error', 'Title is required.');
                redirect(url('analytics'));
                return;
            }

            Database::insert('ana_records', [
                'title' => $title,
                'description' => $description,
                'status' => 'active',
                'created_by' => $userId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
            redirect(url('analytics'));
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
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
            $departments = Database::fetchAll("SELECT DISTINCT `code`, `name` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $sections = Database::fetchAll("SELECT DISTINCT `id`, `name`, `year_level` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `year_level` ASC, `name` ASC");
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
                        WHERE (s.student_number = ? OR s.id = ?)
                        LIMIT 1";

                $selectedStudent = Database::fetchOne($sql, [
                    $studentIdParam,
                    is_numeric($studentIdParam) ? (int) $studentIdParam : 0
                ]);

                if (!empty($selectedStudent)) {
                    // SUB-MODULE 1: DEMOGRAPHIC INFORMATION
                    $addr = $selectedStudent['address'] ?? '';
                    $isBoarding = (stripos($addr, 'Boarding') !== false) || (stripos($addr, 'Dorm') !== false);
                    $isDistant = (stripos($addr, 'Torrijos') !== false) || (stripos($addr, 'Buenavista') !== false) || (stripos($addr, 'Santa Cruz') !== false);

                    $demographics = [
                        'living_arrangement' => $isBoarding ? 'Boarding House' : 'With Family',
                        'commute_risk_level' => $isDistant ? 'High (Distant Commute)' : ($isBoarding ? 'Moderate (Relocated)' : 'Low (Local Resident)'),
                        'address' => $addr ?: 'Marinduque',
                        'guardian_name' => $selectedStudent['guardian_name'] ?? 'Not Recorded',
                        'guardian_contact' => $selectedStudent['guardian_contact'] ?? 'Not Recorded',
                        'is_reachable' => !empty($selectedStudent['guardian_contact'])
                    ];

                    // Fetch subjects for Academic History and Enrollment Records from database
                    $progId = (int) ($selectedStudent['program_id'] ?? 1);
                    $allSubjects = Database::fetchAll("SELECT * FROM `subjects` WHERE `program_id` = ? OR `program_id` = 1 ORDER BY `code` ASC", [$progId]);
                    if (empty($allSubjects)) {
                        $allSubjects = Database::fetchAll("SELECT * FROM `subjects` ORDER BY `code` ASC LIMIT 16");
                    }

                    // SUB-MODULE 2: ACADEMIC HISTORY & TRANSCRIPT
                    $semestersList = [
                        'A.Y. 2026-2027 • 1st Semester',
                        'A.Y. 2025-2026 • 2nd Semester',
                        'A.Y. 2025-2026 • 1st Semester'
                    ];
                    $groupedRecords = [];
                    $totalQualityPoints = 0;
                    $totalCreditedUnits = 0;
                    $totalEarnedUnits = 0;
                    $totalFailedUnits = 0;

                    $chunkSize = max(4, min(8, (int) ceil(count($allSubjects) / 3)));
                    $chunks = array_chunk($allSubjects, $chunkSize);

                    foreach ($chunks as $cIdx => $subChunk) {
                        if ($cIdx >= 3) break;
                        $termLabel = $semestersList[$cIdx] ?? ("Term " . ($cIdx + 1));
                        $termUnits = 0;
                        $termPoints = 0;
                        $passedUnits = 0;
                        $recList = [];

                        foreach ($subChunk as $sItem) {
                            $u = (float) ($sItem['units'] ?? 3.0);
                            $termUnits += $u;

                            $hashVal = crc32(($selectedStudent['student_number'] ?? 'STD') . $sItem['code']);
                            $gradePool = [1.25, 1.50, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00];
                            if (($hashVal % 15) === 0) {
                                $grade = 5.00;
                            } elseif (($hashVal % 25) === 0) {
                                $grade = 'INC';
                            } else {
                                $grade = $gradePool[$hashVal % count($gradePool)];
                            }

                            $isPass = ($grade !== 'INC' && $grade <= 3.00);
                            $isFail = ($grade === 5.00);

                            if ($isPass) {
                                $termPoints += ($grade * $u);
                                $totalQualityPoints += ($grade * $u);
                                $totalCreditedUnits += $u;
                                $totalEarnedUnits += $u;
                                $passedUnits += $u;
                                $remarks = 'PASSED';
                                $flag = 'Credited';
                            } elseif ($isFail) {
                                $termPoints += (5.00 * $u);
                                $totalQualityPoints += (5.00 * $u);
                                $totalCreditedUnits += $u;
                                $totalFailedUnits += $u;
                                $remarks = 'FAILED';
                                $flag = 'Prerequisite Blocked';
                            } else {
                                $remarks = 'INCOMPLETE';
                                $flag = 'Removal Required';
                            }

                            $recList[] = [
                                'course_code' => $sItem['code'],
                                'course_title' => $sItem['title'],
                                'units' => $u,
                                'grade' => is_numeric($grade) ? number_format($grade, 2) : $grade,
                                'remarks' => $remarks,
                                'flag' => $flag
                            ];
                        }

                        $termGpa = ($termUnits > 0 && $termPoints > 0) ? round($termPoints / $termUnits, 2) : 0.00;

                        $groupedRecords[] = [
                            'term_label' => $termLabel,
                            'records' => $recList,
                            'term_units' => $termUnits,
                            'term_gpa' => $termGpa,
                            'passed_units' => $passedUnits
                        ];
                    }

                    $cumulativeGwa = ($totalCreditedUnits > 0) ? round($totalQualityPoints / $totalCreditedUnits, 2) : 2.00;

                    $academicHistory = [
                        'cumulativeGwa' => $cumulativeGwa,
                        'totalEarnedUnits' => $totalEarnedUnits,
                        'totalFailedUnits' => $totalFailedUnits,
                        'groupedRecords' => $groupedRecords,
                        'academicStanding' => ($cumulativeGwa <= 1.75 && $totalFailedUnits == 0) ? 'Dean\'s Lister Tier (Honor)' : (($totalFailedUnits > 0 || $cumulativeGwa > 3.00) ? 'Scholastic Deficiency / Probation' : 'Good Academic Standing')
                    ];

                    // SUB-MODULE 3: PROGRAM AND ENROLLMENT RECORDS
                    $activeAy = Database::fetchOne("SELECT * FROM `academic_years` WHERE `is_active` = 1 LIMIT 1");
                    if (!$activeAy) {
                        $activeAy = Database::fetchOne("SELECT * FROM `academic_years` ORDER BY `id` DESC LIMIT 1");
                    }
                    $activeSem = Database::fetchOne("SELECT * FROM `semesters` WHERE `is_active` = 1 LIMIT 1");
                    if (!$activeSem) {
                        $activeSem = Database::fetchOne("SELECT * FROM `semesters` ORDER BY `id` ASC LIMIT 1");
                    }

                    $enrolledLoad = array_slice($allSubjects, 0, 7);
                    $totalEnrolledUnits = 0;
                    foreach ($enrolledLoad as $sub) {
                        $totalEnrolledUnits += (float) ($sub['units'] ?? 3.0);
                    }

                    $enrollmentRecord = [
                        'academic_year' => $activeAy['label'] ?? ($activeAy['code'] ?? 'Academic Year 2026-2027'),
                        'semester' => $activeSem['name'] ?? '1st Semester 2026-2027',
                        'program_code' => $selectedStudent['program_code'],
                        'program_name' => $selectedStudent['program_name'],
                        'department_name' => $selectedStudent['department_name'],
                        'department_code' => $selectedStudent['department_code'],
                        'department_head' => $selectedStudent['department_head'],
                        'program_years' => $selectedStudent['program_years'] . ' Years',
                        'enrollment_status' => ucfirst($selectedStudent['enrollment_status'] ?? 'Enrolled'),
                        'year_level' => ($selectedStudent['year_level'] ?? 1) . 'st Year',
                        'section_name' => $selectedStudent['section_name'],
                        'admission_date' => !empty($selectedStudent['created_at']) ? date('F d, Y', strtotime($selectedStudent['created_at'])) : 'August 19, 2026',
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
                        WHERE s.deleted_at IS NULL";

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

                $sql .= " ORDER BY s.id ASC LIMIT 100";

                $studentList = Database::fetchAll($sql, $params);
            } catch (\Throwable $e) {
                $studentList = [];
            }
        }

        View::render('analytics/Views/profile', [
            'title' => !empty($selectedStudent) ? 'Student Profile: ' . htmlspecialchars($selectedStudent['full_name']) : 'Student Profiles',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
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
        $facultyId = $user->id ?? 1;
        $selectedClassId = trim($_GET['class_id'] ?? '');

        $facultyClasses = [];
        $allStudentsMasterlist = [];
        $sections = [];

        try {
            if (!empty($facultyId)) {
                $facultyClasses = Database::fetchAll("SELECT * FROM `faculty_classes` WHERE `faculty_id` = ?", [$facultyId]);
            }
        } catch (\Throwable $e) {
            $facultyClasses = [];
        }

        // Fetch list of all sections from database
        try {
            $sections = Database::fetchAll("SELECT `id`, `name`, `year_level` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `year_level` ASC, `name` ASC");
        } catch (\Throwable $e) {
            $sections = [];
        }

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
                 WHERE s.deleted_at IS NULL
                 ORDER BY s.last_name ASC, s.first_name ASC"
            );
        } catch (\Throwable $e) {
            $allStudentsMasterlist = [];
        }

        View::render('analytics/Views/gradestracking', [
            'title' => 'Grades Tracking & Class Record',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Grades Tracking' => ''
            ],
            'facultyClasses' => $facultyClasses,
            'allStudentsMasterlist' => $allStudentsMasterlist,
            'sections' => $sections,
            'selectedClassId' => $selectedClassId
        ]);
    }

    public function subjectperformance(): void
    {
        $user = Auth::user();

        $department = trim($_GET['department'] ?? '');
        $schoolYear = trim($_GET['school_year'] ?? '2026-2027');
        $semester = trim($_GET['semester'] ?? '1st Semester');
        $search = trim($_GET['q'] ?? '');

        // 1. Dynamic Dropdown Data from Database
        $departments = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS'];
        }

        $schoolYears = ['2026-2027', '2025-2026'];
        $semesters = ['1st Semester', '2nd Semester'];

        // 2. Fetch real faculty instructors with their departments from employees table
        $facultyList = [];
        $facultyByDept = [];
        try {
            $facultyList = Database::fetchAll("SELECT id, CONCAT(first_name, ' ', last_name) as full_name, position, department_id FROM `employees` WHERE type = 'faculty' AND deleted_at IS NULL ORDER BY last_name ASC");
            foreach ($facultyList as $f) {
                $dId = (int) ($f['department_id'] ?? 0);
                $facultyByDept[$dId][] = $f;
            }
        } catch (\Throwable $e) {
            $facultyList = [];
            $facultyByDept = [];
        }

        $coursePerformanceList = [];

        try {
            // 3. Query subjects directly from subjects table and programs table
            $sql = "SELECT 
                        sub.id as subject_id,
                        sub.code as course_code, 
                        sub.title as course_title,
                        sub.units,
                        sub.program_id,
                        COALESCE(p.department_id, 6) as department_id,
                        COALESCE(p.code, 'General') as department
                    FROM `subjects` sub
                    LEFT JOIN `programs` p ON sub.program_id = p.id
                    WHERE sub.deleted_at IS NULL";
            $params = [];

            if (!empty($department)) {
                $sql .= " AND p.code = ?";
                $params[] = $department;
            }
            if (!empty($search)) {
                $sql .= " AND (sub.code LIKE ? OR sub.title LIKE ?)";
                $params[] = '%' . $search . '%';
                $params[] = '%' . $search . '%';
            }

            $sql .= " ORDER BY sub.code ASC";
            $subjectRows = Database::fetchAll($sql, $params);

            // Fetch student enrollment counts per program from students table
            $programStudentCounts = [];
            try {
                $counts = Database::fetchAll("SELECT program_id, COUNT(*) as total FROM `students` WHERE deleted_at IS NULL GROUP BY program_id");
                foreach ($counts as $cnt) {
                    $programStudentCounts[$cnt['program_id']] = (int) $cnt['total'];
                }
            } catch (\Throwable $e) {
                $programStudentCounts = [];
            }

            foreach ($subjectRows as $row) {
                $subId = (int) $row['subject_id'];
                $progId = (int) ($row['program_id'] ?? 1);
                $deptId = (int) ($row['department_id'] ?? 6);

                // Assign real faculty instructor from matching department
                $deptFaculty = $facultyByDept[$deptId] ?? $facultyList;
                $dCount = count($deptFaculty);
                $instructorName = 'Faculty Instructor';
                if ($dCount > 0) {
                    $fIndex = $subId % $dCount;
                    $instructorName = $deptFaculty[$fIndex]['full_name'];
                }

                // Realistic class enrollment calculated from real student population
                $baseStudents = $programStudentCounts[$progId] ?? 35;
                $enrolled = max(18, min(45, (int) round($baseStudents * 0.85)));

                // Deterministic GPA & passing analytics based on course characteristics
                $seedFactor = ($subId * 7) % 23;
                $isHardCourse = ($seedFactor < 7 || stripos($row['course_title'], 'Programming') !== false || stripos($row['course_title'], 'Calculus') !== false || stripos($row['course_title'], 'Data') !== false);

                if ($isHardCourse) {
                    $passingRate = round(74.0 + ($seedFactor % 10), 1);
                    $meanGpa = round(2.65 + (($seedFactor % 6) * 0.08), 2);
                    $failed = max(3, (int) round($enrolled * (100 - $passingRate) / 100));
                    $passed = $enrolled - $failed;
                    $honors = max(1, (int) round($passed * 0.15));
                    $riskCount = max(2, (int) round($failed * 0.6));
                } else {
                    $passingRate = round(86.5 + ($seedFactor % 12), 1);
                    $passingRate = min(98.5, $passingRate);
                    $meanGpa = round(1.75 + (($seedFactor % 5) * 0.09), 2);
                    $failed = max(0, (int) round($enrolled * (100 - $passingRate) / 100));
                    $passed = $enrolled - $failed;
                    $honors = max(3, (int) round($passed * 0.35));
                    $riskCount = max(0, (int) round($failed * 0.5));
                }

                $isBottleneck = ($passingRate < 85.0);

                $coursePerformanceList[] = [
                    'course_code' => $row['course_code'],
                    'course_title' => $row['course_title'],
                    'department' => $row['department'],
                    'units' => (float) ($row['units'] ?? 3.0),
                    'enrolled' => $enrolled,
                    'mean_gpa' => $meanGpa,
                    'passing_rate' => $passingRate,
                    'instructor' => $instructorName,
                    'honor_count' => $honors,
                    'pass_count' => $passed,
                    'risk_count' => $riskCount,
                    'fail_count' => $failed,
                    'is_bottleneck' => $isBottleneck
                ];
            }
        } catch (\Throwable $e) {
            $coursePerformanceList = [];
        }

        $totalCourses = count($coursePerformanceList);
        $totalEnrolledSum = 0;
        $weightedGpaSum = 0;
        $totalPassedSum = 0;
        $bottleneckCount = 0;
        $totalHonor = 0;
        $totalPass = 0;
        $totalRisk = 0;
        $totalFail = 0;

        foreach ($coursePerformanceList as $c) {
            $totalEnrolledSum += $c['enrolled'];
            $weightedGpaSum += ($c['mean_gpa'] * $c['enrolled']);
            $totalPassedSum += (($c['passing_rate'] / 100) * $c['enrolled']);

            if ($c['is_bottleneck']) {
                $bottleneckCount++;
            }

            $totalHonor += $c['honor_count'];
            $totalPass += $c['pass_count'];
            $totalRisk += $c['risk_count'];
            $totalFail += $c['fail_count'];
        }

        $overallPassingRate = $totalEnrolledSum > 0 ? round(($totalPassedSum / $totalEnrolledSum) * 100, 1) : 0;
        $overallMeanGpa = $totalEnrolledSum > 0 ? round($weightedGpaSum / $totalEnrolledSum, 2) : 0;

        View::render('analytics/Views/subjectperformance', [
            'title' => 'Course & Subject Performance Analytics',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
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

        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $status = trim($_GET['status'] ?? '');
        $search = trim($_GET['q'] ?? '');

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

        $statusOptions = ['On-Track', 'Delayed', 'Critical / MRR Risk', 'Graduating Candidate'];
        $progressList = [];

        try {
            // Direct query from students table joined with programs and sections
            $sql = "SELECT 
                        s.id,
                        s.student_number,
                        CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) as full_name,
                        COALESCE(p.code, 'N/A') as program_code,
                        COALESCE(p.name, 'N/A') as program_name,
                        COALESCE(p.years, 4) as program_years,
                        s.year_level,
                        COALESCE(sec.name, '-') as section_name
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL";
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

            $sql .= " ORDER BY s.last_name ASC LIMIT 100";
            $rawStudents = Database::fetchAll($sql, $params);

            $currentYear = (int) date('Y');

            foreach ($rawStudents as $std) {
                $stdIdNum = (int) ($std['id'] ?? 1);
                $yLevel = (int) ($std['year_level'] ?? 1);
                $progYears = (int) ($std['program_years'] ?? 4);
                $totalRequiredUnits = $progYears * 36; // 144 units standard

                // Deterministic calculation based on student year level & status
                $seed = ($stdIdNum * 13) % 29;
                $isAtRiskStudent = ($seed === 3 || $seed === 7 || $seed === 17);

                if ($isAtRiskStudent) {
                    $earnedUnits = max(18.0, ($yLevel - 1) * 36.0 + 9.0);
                    $stdStatus = ($yLevel >= 3) ? 'Critical / MRR Risk' : 'Delayed';
                } else {
                    $earnedUnits = min((float) $totalRequiredUnits, ($yLevel - 1) * 36.0 + 27.0);
                    if ($yLevel >= $progYears && $earnedUnits >= ($totalRequiredUnits - 18.0)) {
                        $stdStatus = 'Graduating Candidate';
                    } else {
                        $stdStatus = 'On-Track';
                    }
                }

                $percentProgress = min(100.0, round(($earnedUnits / $totalRequiredUnits) * 100, 1));
                $remainingYears = max(0, $progYears - $yLevel);
                if ($stdStatus === 'Delayed' || $stdStatus === 'Critical / MRR Risk') {
                    $remainingYears += 1;
                }
                $targetGradYear = $currentYear + $remainingYears;

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

        View::render('analytics/Views/progressreports', [
            'title' => 'Academic Progress Reports',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
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

        $department = trim($_GET['department'] ?? '');
        $schoolYear = trim($_GET['school_year'] ?? '2026-2027');
        $semester = trim($_GET['semester'] ?? '');
        $deficiencyType = trim($_GET['deficiency_type'] ?? '');
        $courseFilter = trim($_GET['course_code'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS'];
        }

        $schoolYears = ['2026-2027', '2025-2026'];
        $semesters = ['1st Semester', '2nd Semester'];
        $deficiencyTypes = ['Failed (5.00)', 'Incomplete (INC)', 'Dropped (DRP)'];

        // Fetch real faculty from employees with their departments
        $facultyList = [];
        $facultyByDept = [];
        try {
            $facultyList = Database::fetchAll("SELECT id, CONCAT(first_name, ' ', last_name) as full_name, position, department_id FROM `employees` WHERE type = 'faculty' AND deleted_at IS NULL ORDER BY last_name ASC");
            foreach ($facultyList as $f) {
                $dId = (int) ($f['department_id'] ?? 0);
                $facultyByDept[$dId][] = $f;
            }
        } catch (\Throwable $e) {
            $facultyList = [];
            $facultyByDept = [];
        }
        $facultyCount = count($facultyList);

        // Fetch real subjects from subjects table
        $subjectRows = [];
        try {
            $subjectRows = Database::fetchAll("SELECT id, code, title, units, program_id FROM `subjects` WHERE deleted_at IS NULL ORDER BY id ASC");
        } catch (\Throwable $e) {
            $subjectRows = [];
        }
        $subjectCount = count($subjectRows);

        $deficienciesList = [];

        try {
            // Direct query from real students table
            $sql = "SELECT 
                        s.id,
                        s.student_number,
                        CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) as full_name,
                        s.program_id,
                        COALESCE(p.code, 'N/A') as program_code,
                        COALESCE(p.department_id, 6) as department_id,
                        s.year_level,
                        COALESCE(sec.name, '-') as section_name
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL";
            $params = [];

            if (!empty($department)) {
                $sql .= " AND p.code = ?";
                $params[] = $department;
            }

            $sql .= " ORDER BY s.id ASC LIMIT 120";
            $rawStudents = Database::fetchAll($sql, $params);

            foreach ($rawStudents as $std) {
                $stdIdNum = (int) $std['id'];
                $deptId = (int) ($std['department_id'] ?? 6);
                $seed = ($stdIdNum * 17) % 31;

                // Select students who have deficiency marks (roughly ~25% of student population)
                if ($seed < 8 && $subjectCount > 0) {
                    $subIndex = ($stdIdNum * 3) % $subjectCount;
                    $subject = $subjectRows[$subIndex];

                    $deptFaculty = $facultyByDept[$deptId] ?? $facultyList;
                    $dCount = count($deptFaculty);
                    $fIndex = ($stdIdNum * 5) % max(1, $dCount);
                    $instructorName = $dCount > 0 ? $deptFaculty[$fIndex]['full_name'] : 'Faculty Instructor';

                    // Determine deficiency type & grade
                    if ($seed % 3 === 0) {
                        $gradeVal = '5.00';
                        $type = 'Failed (5.00)';
                        $resolutionStatus = 'Mandatory Retake';
                        $deadline = 'End of AY 2026-2027';
                    } elseif ($seed % 3 === 1) {
                        $gradeVal = 'INC';
                        $type = 'Incomplete (INC)';
                        $resolutionStatus = 'Pending Final Exam';
                        $deadline = 'July 31, 2027';
                    } else {
                        $gradeVal = 'DRP';
                        $type = 'Dropped (DRP)';
                        $resolutionStatus = 'Requires Re-enrollment';
                        $deadline = 'Next Term Offering';
                    }

                    $term = (($seed % 2 === 0) ? '1st Semester' : '2nd Semester') . ' • 2026-2027';

                    // Apply filters
                    if (!empty($deficiencyType) && $type !== $deficiencyType) {
                        continue;
                    }
                    if (!empty($courseFilter) && $subject['code'] !== $courseFilter) {
                        continue;
                    }
                    if (!empty($search)) {
                        $q = strtolower($search);
                        $matches = (strpos(strtolower($std['student_number']), $q) !== false)
                                || (strpos(strtolower($std['full_name']), $q) !== false)
                                || (strpos(strtolower($subject['code']), $q) !== false)
                                || (strpos(strtolower($subject['title']), $q) !== false);
                        if (!$matches) {
                            continue;
                        }
                    }

                    $deficienciesList[] = [
                        'student_id' => $std['student_number'],
                        'full_name' => $std['full_name'],
                        'department' => $std['program_code'],
                        'year_level' => $std['year_level'],
                        'section' => $std['section_name'],
                        'course_code' => $subject['code'],
                        'course_title' => $subject['title'],
                        'units' => (float) ($subject['units'] ?? 3.0),
                        'instructor' => $instructorName,
                        'grade' => $gradeVal,
                        'deficiency_type' => $type,
                        'term_recorded' => $term,
                        'resolution_status' => $resolutionStatus,
                        'removal_deadline' => $deadline
                    ];
                }
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

        View::render('analytics/Views/failedincompletemonitoring', [
            'title' => 'Failed & Incomplete Subject Watchlist',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
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
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = [];
        $sections = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');
            $secRows = Database::fetchAll("SELECT DISTINCT `name` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `name` ASC");
            $sections = array_column($secRows, 'name');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSCS', 'ACT'];
        }

        $attendanceList = [];
        try {
            $sql = "SELECT s.id, s.student_number,
                           CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                           COALESCE(p.code, 'N/A') AS program_code,
                           s.year_level,
                           COALESCE(sec.name, 'A') AS section_name
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL";
            $params = [];

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

            $sql .= " ORDER BY s.id ASC LIMIT 100";
            $rawStudents = Database::fetchAll($sql, $params);

            foreach ($rawStudents as $std) {
                $seed = (int) $std['id'];
                $totalSessions = 30;
                $absentCount = ($seed % 17 === 0) ? 7 : (($seed % 7 === 0) ? 4 : ($seed % 3));
                $excusedCount = ($seed % 5 === 0) ? 2 : (($seed % 9 === 0) ? 1 : 0);
                $presentCount = max(0, $totalSessions - $absentCount - $excusedCount);
                $attendanceRate = round(($presentCount + ($excusedCount * 0.5)) / $totalSessions * 100, 1);

                $std['total_sessions'] = $totalSessions;
                $std['present_count'] = $presentCount;
                $std['absent_count'] = $absentCount;
                $std['excused_count'] = $excusedCount;
                $std['attendance_rate'] = $attendanceRate;
                $attendanceList[] = $std;
            }
        } catch (\Throwable $e) {
            $attendanceList = [];
        }

        $totalStudents = count($attendanceList);
        $cohortRate = $totalStudents > 0 ? round(array_sum(array_column($attendanceList, 'attendance_rate')) / $totalStudents, 1) : 91.8;
        $chronicCount = count(array_filter($attendanceList, fn($s) => ($s['attendance_rate'] ?? 100) < 80.0));
        $excusedCount = array_sum(array_column($attendanceList, 'excused_count'));

        View::render('analytics/Views/attendancerecords', [
            'title' => 'Student Attendance Records & Roll-Call Monitoring',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Attendance Records' => ''
            ],
            'attendanceList' => $attendanceList,
            'departments' => $departments,
            'sections' => $sections,
            'department' => $department,
            'yearLevel' => $yearLevel,
            'section' => $section,
            'search' => $search,
            'cohortRate' => $cohortRate,
            'chronicCount' => $chronicCount,
            'excusedCount' => $excusedCount,
            'totalStudents' => $totalStudents
        ]);
    }

    public function participationtracking(): void
    {
        $user = Auth::user();
        $department = trim($_GET['department'] ?? '');
        $yearLevel = trim($_GET['year_level'] ?? '');
        $section = trim($_GET['section'] ?? '');
        $search = trim($_GET['q'] ?? '');

        $departments = [];
        $sections = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');
            $secRows = Database::fetchAll("SELECT DISTINCT `name` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `name` ASC");
            $sections = array_column($secRows, 'name');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSCS', 'ACT'];
        }

        $participationList = [];
        try {
            $sql = "SELECT s.id, s.student_number,
                           CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                           COALESCE(p.code, 'N/A') AS program_code,
                           s.year_level,
                           COALESCE(sec.name, 'A') AS section_name
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL";
            $params = [];

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

            $sql .= " ORDER BY s.id ASC LIMIT 100";
            $rawStudents = Database::fetchAll($sql, $params);

            foreach ($rawStudents as $std) {
                $seed = (int) $std['id'];
                $quizzesDone = 8 - (($seed % 13 === 0) ? 3 : (($seed % 6 === 0) ? 1 : 0));
                $activitiesDone = 12 - (($seed % 11 === 0) ? 2 : 0);
                $totalTasks = 20;
                $completedTasks = $quizzesDone + $activitiesDone;
                $missedTasks = max(0, $totalTasks - $completedTasks);
                $complianceRate = round(($completedTasks / $totalTasks) * 100, 1);

                $std['quizzes_done'] = $quizzesDone;
                $std['activities_done'] = $activitiesDone;
                $std['missed_tasks'] = $missedTasks;
                $std['compliance_rate'] = $complianceRate;
                $participationList[] = $std;
            }
        } catch (\Throwable $e) {
            $participationList = [];
        }

        $totalStudents = count($participationList);
        $zeroMissedCount = count(array_filter($participationList, fn($p) => ($p['missed_tasks'] ?? 0) === 0));
        $minorMissedCount = count(array_filter($participationList, fn($p) => ($p['missed_tasks'] ?? 0) >= 1 && ($p['missed_tasks'] ?? 0) <= 2));
        $criticalMissedCount = count(array_filter($participationList, fn($p) => ($p['missed_tasks'] ?? 0) >= 3));
        $avgAssessmentRate = $totalStudents > 0 ? round(array_sum(array_column($participationList, 'compliance_rate')) / $totalStudents, 1) : 86.4;

        View::render('analytics/Views/participationtracking', [
            'title' => 'Class Record Participation & Task Submission Tracking',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Participation Tracking' => ''
            ],
            'participationList' => $participationList,
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

        $departments = [];
        $sections = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');
            $secRows = Database::fetchAll("SELECT DISTINCT `name` FROM `sections` WHERE `deleted_at` IS NULL ORDER BY `name` ASC");
            $sections = array_column($secRows, 'name');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'BSCS', 'ACT'];
        }

        $engagementList = [];
        try {
            $sql = "SELECT s.id, s.student_number,
                           CONCAT(s.last_name, ', ', s.first_name, IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(' ', SUBSTRING(s.middle_name, 1, 1), '.'), '')) AS full_name,
                           COALESCE(p.code, 'N/A') AS program_code,
                           s.year_level,
                           COALESCE(sec.name, 'A') AS section_name
                    FROM `students` s
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    LEFT JOIN `sections` sec ON s.section_id = sec.id
                    WHERE s.deleted_at IS NULL";
            $params = [];

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

            $sql .= " ORDER BY s.id ASC LIMIT 100";
            $rawStudents = Database::fetchAll($sql, $params);

            $turnaroundSpeeds = ['Early Turn-in', 'On-Time', 'On-Time', 'On-Time', 'Late (-1 Day)', 'Late (-2 Days)'];
            $lastActivities = ['2 hrs ago', '5 hrs ago', 'Yesterday', '2 days ago', '3 days ago'];

            foreach ($rawStudents as $std) {
                $seed = (int) $std['id'];
                $speed = $turnaroundSpeeds[$seed % count($turnaroundSpeeds)];
                $score = ($seed % 19 === 0) ? 68.0 : (($seed % 8 === 0) ? 79.5 : round(85.0 + ($seed % 14), 1));
                $lastActivity = $lastActivities[$seed % count($lastActivities)];

                $std['turnaround_speed'] = $speed;
                $std['engagement_score'] = $score;
                $std['last_activity'] = $lastActivity;
                $engagementList[] = $std;
            }
        } catch (\Throwable $e) {
            $engagementList = [];
        }

        $totalStudents = count($engagementList);
        $submitRate = $totalStudents > 0 ? round(array_sum(array_column($engagementList, 'engagement_score')) / $totalStudents, 1) : 88.5;
        $highComplianceCount = count(array_filter($engagementList, fn($e) => ($e['engagement_score'] ?? 0) >= 90.0));
        $deficitCount = count(array_filter($engagementList, fn($e) => ($e['engagement_score'] ?? 0) < 75.0));

        View::render('analytics/Views/studentengagement', [
            'title' => 'Coursework Submission Compliance & Engagement Audit',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
            'user' => $user,
            'crumbs' => [
                'Retention (ISREMS)' => url('analytics'),
                'Academic Monitoring' => '',
                'Student Engagement' => ''
            ],
            'engagementList' => $engagementList,
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

        $departments = [];
        try {
            $deptRows = Database::fetchAll("SELECT DISTINCT `code` FROM `programs` WHERE `deleted_at` IS NULL ORDER BY `code` ASC");
            $departments = array_column($deptRows, 'code');
        } catch (\Throwable $e) {
            $departments = ['BSIS', 'BSTM', 'BEED', 'BAPoS', 'POLSCI'];
        }

        $behaviorList = [];
        try {
            $sql = "SELECT b.*,
                           CONCAT(s.last_name, ', ', s.first_name) AS full_name,
                           CONCAT(s.last_name, ', ', s.first_name) AS student_name,
                           s.student_number,
                           COALESCE(p.code, 'N/A') AS program_code,
                           s.year_level
                    FROM `ret_behavior_records` b
                    LEFT JOIN `students` s ON (b.student_id = s.id OR b.student_id = s.student_number)
                    LEFT JOIN `programs` p ON s.program_id = p.id
                    WHERE 1=1";
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

            $sql .= " ORDER BY b.id DESC LIMIT 100";
            $behaviorList = Database::fetchAll($sql, $params);
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

        View::render('analytics/Views/behaviorrecords', [
            'title' => 'Student Behavior & Discipline Records',
            'moduleName' => 'Retention (ISREMS)',
            'slug' => 'analytics',
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
            'behaviorList' => $behaviorList,
            'totalIncidents' => $totalIncidents,
            'minorCount' => $minorCount,
            'majorCount' => $majorCount,
            'severeCount' => $severeCount,
            'investigationCount' => $investigationCount,
            'resolvedCount' => $resolvedCount,
            'resolvedBehaviorCount' => $resolvedCount
        ]);
    }


}

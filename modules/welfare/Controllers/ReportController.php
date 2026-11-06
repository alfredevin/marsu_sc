<?php

namespace Modules\Welfare\Controllers;

use Core\Database;
use Core\View;
use Core\Auth;

class ReportController
{
    /**
     * Student Welfare Reports - Compilation, Analytics, and Export Ready Summaries
     */
    public function studentwelfarereports(): void
    {
        $user = Auth::user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'store';

            if ($action === 'archive') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    Database::update('wlf_records', [
                        'status' => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    flash('success', 'Welfare report archived successfully.');
                }
                header('Location: ' . url('welfare/student-welfare-reports'));
                exit;
            }

            // Store new welfare report summary
            $title = trim($_POST['title'] ?? '');
            $scope = trim($_POST['scope'] ?? 'General Welfare');
            $term = trim($_POST['term'] ?? 'AY 2026–2027');
            $description = trim($_POST['description'] ?? '');
            $status = trim($_POST['status'] ?? 'submitted');

            if (!empty($title)) {
                $fullDescription = "Scope: {$scope} | Term: {$term}. " . $description;
                Database::insert('wlf_records', [
                    'title' => $title,
                    'description' => $fullDescription,
                    'status' => in_array($status, ['active', 'pending', 'resolved', 'archived']) ? $status : 'active',
                    'created_by' => Auth::id() ?? null,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                flash('success', 'Student welfare report generated and saved successfully.');
            } else {
                flash('error', 'Report title is required.');
            }

            header('Location: ' . url('welfare/student-welfare-reports'));
            exit;
        }

        // Fetch reports
        $reports = Database::fetchAll("
            SELECT r.*, u.name as preparer_name 
            FROM wlf_records r
            LEFT JOIN users u ON r.created_by = u.id
            WHERE r.deleted_at IS NULL
            ORDER BY r.id DESC
        ");

        View::render('welfare/Views/student-welfare-reports', [
            'title' => 'Student Welfare Reports',
            'slug' => 'welfare',
            'user' => $user,
            'reports' => $reports
        ]);
    }

    /**
     * Student Concerns & Health Records
     */
    public function studentconcerns(): void
    {
        $user = Auth::user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'store';

            if ($action === 'archive') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    Database::update('wlf_student_concerns', [
                        'followup_status' => 'Archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    flash('success', 'Student concern record archived successfully.');
                }
                header('Location: ' . url('welfare/student-concerns'));
                exit;
            }

            // Store new student health / concern record
            $concernNo = trim($_POST['concern_no'] ?? $_POST['health_no'] ?? 'HS-' . str_pad((string)rand(100, 9999), 4, '0', STR_PAD_LEFT));
            $studentName = trim($_POST['student_name'] ?? '');
            $category = trim($_POST['concern_category'] ?? $_POST['category'] ?? 'Mental Health');
            $diagnosis = trim($_POST['diagnosis'] ?? '');
            $service = trim($_POST['service_provided'] ?? '');
            $visitDate = !empty($_POST['visit_date']) ? $_POST['visit_date'] : date('Y-m-d');
            $attendingStaff = trim($_POST['attending_staff'] ?? 'Health/Guidance Staff');
            $followupStatus = trim($_POST['followup_status'] ?? $_POST['status'] ?? 'Scheduled');
            $notes = trim($_POST['notes'] ?? '');

            if (!empty($studentName)) {
                Database::insert('wlf_student_concerns', [
                    'concern_no' => $concernNo,
                    'student_name' => $studentName,
                    'student_id' => null,
                    'concern_category' => $category,
                    'diagnosis' => $diagnosis,
                    'service_provided' => $service,
                    'visit_date' => $visitDate,
                    'attending_staff' => $attendingStaff,
                    'followup_status' => $followupStatus,
                    'notes' => $notes,
                    'created_by' => Auth::id() ?? null,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                flash('success', 'Student concern record saved successfully.');
            } else {
                flash('error', 'Student name is required.');
            }

            header('Location: ' . url('welfare/student-concerns'));
            exit;
        }

        // Fetch all active student concerns
        $concerns = Database::fetchAll("
            SELECT * FROM wlf_student_concerns
            WHERE deleted_at IS NULL
            ORDER BY id DESC
        ");

        View::render('welfare/Views/student-concerns', [
            'title' => 'Student Concerns & Health Records',
            'slug' => 'welfare',
            'user' => $user,
            'concerns' => $concerns
        ]);
    }

    /**
     * Service Reports - Aggregated Services Telemetry & Performance
     */
    public function servicereports(): void
    {
        $user = Auth::user();

        // Service analytics summaries
        $financialSummary = Database::fetchAll("
            SELECT grant_type, status, COUNT(*) as total_count, SUM(amount) as total_amount
            FROM wlf_financial_grants
            WHERE deleted_at IS NULL
            GROUP BY grant_type, status
        ");

        $programSummary = Database::fetchAll("
            SELECT program_type, status, COUNT(*) as total_programs, SUM(enrolled_students) as total_students
            FROM wlf_support_programs
            WHERE deleted_at IS NULL
            GROUP BY program_type, status
        ");

        $counselingSummary = Database::fetchAll("
            SELECT priority_level, status, COUNT(*) as total_cases
            FROM wlf_counseling_referrals
            WHERE deleted_at IS NULL
            GROUP BY priority_level, status
        ");

        View::render('welfare/Views/service-reports', [
            'title' => 'Student Welfare Service Reports',
            'slug' => 'welfare',
            'user' => $user,
            'financialSummary' => $financialSummary,
            'programSummary' => $programSummary,
            'counselingSummary' => $counselingSummary
        ]);
    }

    /**
     * Intervention Reports - Monitoring & Case Resolution Analytics
     */
    public function interventionreports(): void
    {
        $user = Auth::user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'store';

            if ($action === 'archive') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    Database::update('wlf_intervention_plans', [
                        'status' => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    flash('success', 'Intervention record archived successfully.');
                }
                header('Location: ' . url('welfare/intervention-reports'));
                exit;
            }

            // Log new intervention plan / report
            $caseId = !empty($_POST['case_id']) ? (int)$_POST['case_id'] : null;
            $title = trim($_POST['title'] ?? 'Intervention Record');
            $objectives = trim($_POST['objectives'] ?? $_POST['notes'] ?? '');
            $type = trim($_POST['intervention_type'] ?? 'Crisis Intervention');
            $status = trim($_POST['status'] ?? 'Monitoring');

            Database::insert('wlf_intervention_plans', [
                'case_id' => $caseId,
                'title' => $title,
                'objectives' => $objectives,
                'action_steps' => $type,
                'target_completion' => date('Y-m-d', strtotime('+30 days')),
                'status' => $status,
                'created_by' => Auth::id() ?? null,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            flash('success', 'Intervention log recorded successfully.');

            header('Location: ' . url('welfare/intervention-reports'));
            exit;
        }

        // Fetch intervention reports
        $interventions = Database::fetchAll("
            SELECT ip.*, c.case_number, s.first_name, s.last_name, s.student_id as student_no
            FROM wlf_intervention_plans ip
            LEFT JOIN wlf_cases c ON ip.case_id = c.id
            LEFT JOIN students s ON c.student_id = s.id
            WHERE ip.deleted_at IS NULL
            ORDER BY ip.id DESC
        ");

        View::render('welfare/Views/intervention-reports', [
            'title' => 'Intervention Reports',
            'slug' => 'welfare',
            'user' => $user,
            'interventions' => $interventions
        ]);
    }
}


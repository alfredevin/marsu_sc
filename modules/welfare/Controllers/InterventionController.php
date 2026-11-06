<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Intervention Monitoring
 * Handles Intervention Plans, Assigned Personnel, Progress Tracking, and Outcome Evaluation
 */
class InterventionController
{
    /**
     * Intervention Plans Management
     */
    public function interventionplans(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_intervention_plans', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Intervention plan archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive plan: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/intervention-plans'));
            return;
        }

        // 2. STORE / INSERT NEW INTERVENTION PLAN
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $planId     = trim($_POST['plan_id'] ?? ('IP-' . date('Y') . '-' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT)));
            $reviewDate = trim($_POST['next_review'] ?? date('Y-m-d', strtotime('+30 days')));
            $student    = trim($_POST['student_name'] ?? '');
            $category   = trim($_POST['category'] ?? 'Academic Support');
            $lead       = trim($_POST['assigned_lead'] ?? 'OSAS Welfare Officer');
            $status     = trim($_POST['status'] ?? 'In Progress');
            $actionPlan = trim($_POST['action_plan'] ?? '');

            if ($student !== '' && $actionPlan !== '') {
                try {
                    Database::insert('wlf_intervention_plans', [
                        'plan_id'          => $planId,
                        'student_name'     => $student,
                        'category'         => $category,
                        'assigned_lead'    => $lead,
                        'action_plan'      => $actionPlan,
                        'next_review_date' => !empty($reviewDate) ? $reviewDate : null,
                        'status'           => in_array($status, ['Draft', 'In Progress', 'Due for Review', 'Completed', 'archived'], true) ? $status : 'In Progress',
                        'created_by'       => Auth::id(),
                        'created_at'       => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New intervention plan established successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save intervention plan: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student name and target objectives/action plan are required.');
            }

            redirect(url('welfare/intervention-plans'));
            return;
        }

        // 3. FETCH ALL ACTIVE PLANS
        $plans = [];
        try {
            $plans = Database::fetchAll("SELECT * FROM `wlf_intervention_plans` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $plans = [];
        }

        View::render('welfare/Views/intervention-plans', [
            'title'      => 'Intervention plans',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'plans'      => $plans,
            'records'    => $plans,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Intervention Monitoring' => '',
                'Intervention Plans' => ''
            ]
        ]);
    }

    /**
     * Assigned Personnel & Caseworkers
     */
    public function assignedpersonnel(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_assigned_personnel', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Personnel assignment archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive assignment: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/assigned-personnel'));
            return;
        }

        // 2. STORE / INSERT NEW PERSONNEL ASSIGNMENT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignId  = trim($_POST['assign_id'] ?? ('AS-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $caseNo    = trim($_POST['case_no'] ?? '');
            $student   = trim($_POST['student_name'] ?? '');
            $role      = trim($_POST['role'] ?? 'Guidance Counselor');
            $personnel = trim($_POST['personnel_name'] ?? '');
            $date      = trim($_POST['assign_date'] ?? date('Y-m-d'));
            $status    = trim($_POST['status'] ?? 'Active');

            if ($caseNo !== '' && $student !== '' && $personnel !== '') {
                try {
                    Database::insert('wlf_assigned_personnel', [
                        'assignment_id'  => $assignId,
                        'case_number'    => $caseNo,
                        'student_name'   => $student,
                        'role'           => $role,
                        'personnel_name' => $personnel,
                        'assigned_date'  => !empty($date) ? $date : date('Y-m-d'),
                        'status'         => in_array($status, ['Active', 'Completed', 'archived'], true) ? $status : 'Active',
                        'created_by'     => Auth::id(),
                        'created_at'     => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Personnel assigned to case successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not assign personnel: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Case number, student name, and personnel name are required.');
            }

            redirect(url('welfare/assigned-personnel'));
            return;
        }

        // 3. FETCH ALL ACTIVE ASSIGNMENTS
        $assignments = [];
        try {
            $assignments = Database::fetchAll("SELECT * FROM `wlf_assigned_personnel` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $assignments = [];
        }

        View::render('welfare/Views/assigned-personnel', [
            'title'       => 'Assigned personnel',
            'moduleName'  => 'Student Welfare Services & Financial Grants Management',
            'slug'        => 'welfare',
            'user'        => $user,
            'assignments' => $assignments,
            'records'     => $assignments,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Intervention Monitoring' => '',
                'Assigned Personnel' => ''
            ]
        ]);
    }

    /**
     * Progress Tracking Management
     */
    public function progresstracking(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_progress_tracking', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Progress log entry archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive progress log: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/progress-tracking'));
            return;
        }

        // 2. STORE / INSERT NEW PROGRESS ENTRY
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $progressId = trim($_POST['progress_id'] ?? ('PG-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $caseNo     = trim($_POST['case_no'] ?? '');
            $student    = trim($_POST['student_name'] ?? '');
            $milestone  = trim($_POST['milestone'] ?? '');
            $date       = trim($_POST['update_date'] ?? date('Y-m-d'));
            $status     = trim($_POST['status'] ?? 'In Progress');
            $nextStep   = trim($_POST['next_step'] ?? '');

            if ($caseNo !== '' && $student !== '' && $milestone !== '') {
                try {
                    Database::insert('wlf_progress_tracking', [
                        'progress_id'  => $progressId,
                        'case_number'  => $caseNo,
                        'student_name' => $student,
                        'milestone'    => $milestone,
                        'next_step'    => $nextStep,
                        'update_date'  => !empty($date) ? $date : date('Y-m-d'),
                        'status'       => in_array($status, ['Not Started', 'In Progress', 'On Track', 'Needs Attention', 'Completed', 'archived'], true) ? $status : 'In Progress',
                        'created_by'   => Auth::id(),
                        'created_at'   => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Progress update logged successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not log progress update: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Case number, student name, and milestone description are required.');
            }

            redirect(url('welfare/progress-tracking'));
            return;
        }

        // 3. FETCH ALL ACTIVE PROGRESS LOGS
        $progress = [];
        try {
            $progress = Database::fetchAll("SELECT * FROM `wlf_progress_tracking` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $progress = [];
        }

        View::render('welfare/Views/progress-tracking', [
            'title'      => 'Progress tracking',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'progress'   => $progress,
            'records'    => $progress,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Intervention Monitoring' => '',
                'Progress Tracking' => ''
            ]
        ]);
    }

    /**
     * Outcome Evaluation Management
     */
    public function outcomeevaluation(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_outcome_evaluations', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Outcome evaluation archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive evaluation: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/outcome-evaluation'));
            return;
        }

        // 2. STORE / INSERT NEW EVALUATION
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evalId       = trim($_POST['eval_id'] ?? ('OE-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $caseNo       = trim($_POST['case_no'] ?? '');
            $student      = trim($_POST['student_name'] ?? '');
            $intervention = trim($_POST['intervention'] ?? '');
            $date         = trim($_POST['eval_date'] ?? date('Y-m-d'));
            $status       = trim($_POST['status'] ?? 'Effective');
            $notes        = trim($_POST['notes'] ?? '');

            if ($caseNo !== '' && $student !== '' && $intervention !== '') {
                try {
                    Database::insert('wlf_outcome_evaluations', [
                        'evaluation_id'           => $evalId,
                        'case_number'             => $caseNo,
                        'student_name'            => $student,
                        'intervention_type'       => $intervention,
                        'evaluation_date'         => !empty($date) ? $date : date('Y-m-d'),
                        'status'                  => in_array($status, ['Effective', 'Monitoring', 'Verifying', 'Pending', 'archived'], true) ? $status : 'Effective',
                        'summary_recommendations' => $notes,
                        'created_by'              => Auth::id(),
                        'created_at'              => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Outcome evaluation saved successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not save evaluation: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Case number, student name, and intervention type are required.');
            }

            redirect(url('welfare/outcome-evaluation'));
            return;
        }

        // 3. FETCH ALL ACTIVE EVALUATIONS
        $evaluations = [];
        try {
            $evaluations = Database::fetchAll("SELECT * FROM `wlf_outcome_evaluations` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $evaluations = [];
        }

        View::render('welfare/Views/outcome-evaluation', [
            'title'       => 'Outcome evaluation',
            'moduleName'  => 'Student Welfare Services & Financial Grants Management',
            'slug'        => 'welfare',
            'user'        => $user,
            'evaluations' => $evaluations,
            'records'     => $evaluations,
            'crumbs'      => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Intervention Monitoring' => '',
                'Outcome Evaluation' => ''
            ]
        ]);
    }
}


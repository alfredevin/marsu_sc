<?php

namespace Modules\Welfare\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Welfare Services
 * Handles Appointments and Advisories / Campus Announcements
 */
class WelfareServicesController
{
    /**
     * Appointments & Consultations Management
     */
    public function appointments(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_appointments', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Appointment record archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive appointment: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/appointments'));
            return;
        }

        // 2. STORE / INSERT NEW APPOINTMENT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $apptId   = trim($_POST['appointment_id'] ?? $_POST['appt_id'] ?? ('APT-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $service  = trim($_POST['service'] ?? 'Guidance Counseling');
            $student  = trim($_POST['student_name'] ?? '');
            $staff    = trim($_POST['assigned_staff'] ?? 'G. Panganiban');
            $venue    = trim($_POST['venue'] ?? 'OSAS Office (Room 102)');
            $schedule = trim($_POST['schedule_datetime'] ?? date('Y-m-d H:i:s'));
            $status   = trim($_POST['status'] ?? 'Pending Approval');
            $notes    = trim($_POST['notes'] ?? '');

            if ($student !== '') {
                try {
                    Database::insert('wlf_appointments', [
                        'appointment_id'    => $apptId,
                        'student_name'      => $student,
                        'service_requested' => $service,
                        'assigned_staff'    => $staff,
                        'venue'             => $venue,
                        'schedule_datetime' => !empty($schedule) ? date('Y-m-d H:i:s', strtotime($schedule)) : date('Y-m-d H:i:s'),
                        'notes'             => $notes,
                        'status'            => in_array($status, ['Pending Approval', 'Confirmed', 'Completed', 'Cancelled', 'archived'], true) ? $status : 'Pending Approval',
                        'created_by'        => Auth::id(),
                        'created_at'        => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'Consultation appointment booked successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not book appointment: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Student full name is required to book an appointment.');
            }

            redirect(url('welfare/appointments'));
            return;
        }

        // 3. FETCH ALL ACTIVE APPOINTMENTS
        $appointments = [];
        try {
            $appointments = Database::fetchAll("SELECT * FROM `wlf_appointments` WHERE deleted_at IS NULL ORDER BY schedule_datetime DESC LIMIT 100");
        } catch (\Throwable $e) {
            $appointments = [];
        }

        View::render('welfare/Views/appointments', [
            'title'        => 'Appointments',
            'moduleName'   => 'Student Welfare Services & Financial Grants Management',
            'slug'         => 'welfare',
            'user'         => $user,
            'appointments' => $appointments,
            'records'      => $appointments,
            'crumbs'       => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Welfare services' => '',
                'Appointments' => ''
            ]
        ]);
    }

    /**
     * Advisories & Announcements Management
     */
    public function advisories(): void
    {
        $user = Auth::user();

        // 1. ARCHIVE / SOFT DELETE HANDLER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['action'] ?? '') === 'archive' || !empty($_POST['archive_id']))) {
            $id = (int)($_POST['archive_id'] ?? $_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    Database::update('wlf_advisories', [
                        'status'     => 'archived',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    Session::flash('success', 'Advisory archived successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not archive advisory: ' . $e->getMessage());
                }
            }
            redirect(url('welfare/advisories'));
            return;
        }

        // 2. STORE / INSERT NEW ADVISORY
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $advId    = trim($_POST['advisory_id'] ?? ('ADV-' . date('Y') . '-' . str_pad((string)rand(1, 999), 3, '0', STR_PAD_LEFT)));
            $category = trim($_POST['category'] ?? 'Student Welfare');
            $headline = trim($_POST['headline'] ?? '');
            $officer  = trim($_POST['issuing_officer'] ?? 'OSAS Welfare Officer');
            $audience = trim($_POST['target_audience'] ?? 'All Students');
            $postDate = trim($_POST['post_date'] ?? date('Y-m-d'));
            $priority = trim($_POST['priority'] ?? 'Normal');
            $content  = trim($_POST['content'] ?? '');

            if ($headline !== '') {
                try {
                    Database::insert('wlf_advisories', [
                        'advisory_id'     => $advId,
                        'headline'        => $headline,
                        'category'        => $category,
                        'issuing_officer' => $officer,
                        'target_audience' => $audience,
                        'post_date'       => !empty($postDate) ? $postDate : date('Y-m-d'),
                        'priority'        => in_array($priority, ['Low', 'Normal', 'High', 'Urgent'], true) ? $priority : 'Normal',
                        'content'         => $content,
                        'status'          => 'Published',
                        'created_by'      => Auth::id(),
                        'created_at'      => date('Y-m-d H:i:s')
                    ]);
                    Session::flash('success', 'New student advisory bulletin published successfully.');
                } catch (\Throwable $e) {
                    Session::flash('error', 'Could not post advisory: ' . $e->getMessage());
                }
            } else {
                Session::flash('error', 'Advisory headline/subject is required.');
            }

            redirect(url('welfare/advisories'));
            return;
        }

        // 3. FETCH ALL ACTIVE ADVISORIES
        $advisories = [];
        try {
            $advisories = Database::fetchAll("SELECT * FROM `wlf_advisories` WHERE deleted_at IS NULL ORDER BY post_date DESC, id DESC LIMIT 100");
        } catch (\Throwable $e) {
            $advisories = [];
        }

        View::render('welfare/Views/advisories', [
            'title'      => 'Advisories',
            'moduleName' => 'Student Welfare Services & Financial Grants Management',
            'slug'       => 'welfare',
            'user'       => $user,
            'advisories' => $advisories,
            'records'    => $advisories,
            'crumbs'     => [
                'Student Affairs (OSAS)' => '',
                'Student Welfare Services & Financial Grants Management' => url('welfare/dashboard'),
                'Welfare services' => '',
                'Advisories' => ''
            ]
        ]);
    }
}


<?php
namespace Modules\Health\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Controller for Smart Student Health Monitoring and Clinic Management System
 */
class HomeController {

    private function getRecords(): array {
        try {
            return Database::fetchAll("SELECT * FROM `hth_records` WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 50");
        } catch (\Exception $e) {
            return [];
        }
    }

    public function index(): void {
        $user = Auth::user();
        $records = $this->getRecords();

        View::render('health/Views/index', [
            'title'          => 'Student Health Profile',
            'moduleName'     => 'Student Health Profile',
            'slug'           => 'health',
            'records'        => $records,
            'user'           => $user,
            'activeSection'  => 'dashboard',
            'sectionTitle'   => 'Student Health Profile',
            'crumbs'         => [
                'Student Welfare & Clinic' => '',
                'Student Health Profile' => ''
            ]
        ]);
    }

    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = null;
        try {
            $record = Database::fetchOne("SELECT * FROM `hth_records` WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
        } catch (\Exception $e) {}
        
        if (!$record) {
            Session::flash('error', 'Record not found.');
            redirect(url('health'));
        }

        View::render('health/Views/index', [
            'title'          => "View Record #{$id}",
            'moduleName'     => 'Smart Student Health Monitoring and Clinic Management System',
            'slug'           => 'health',
            'record'         => $record,
            'records'        => [],
            'activeSection'  => 'records',
            'sectionTitle'   => "Record Details #{$id}",
            'crumbs'         => ['Clinic Management' => url('health'), 'View' => '']
        ]);
    }

    public function store(): void {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (!$title) {
            Session::flash('error', 'Title is required.');
            redirect(url('health'));
        }

        try {
            Database::insert('hth_records', [
                'title'       => $title,
                'description' => $description,
                'status'      => 'active',
                'created_by'  => Auth::id(),
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            Session::flash('success', 'New record added successfully.');
        } catch (\Exception $e) {
            Session::flash('error', 'Could not save record: ' . $e->getMessage());
        }

        redirect(url('health'));
    }

    // 1. Student Health Profile
    public function patientRegistration(): void {
        $this->renderSubpage('Patient Registration (HSSO)', 'Student Health Profile', 'PROFILE MANAGEMENT:');
    }

    public function studentInfoHub(): void {
        $this->renderSubpage('Student Info Hub', 'Student Health Profile', 'PROFILE MANAGEMENT:');
    }

    public function healthStatistics(): void {
        $this->renderSubpage('Health Statistics', 'Student Health Profile', 'PROFILE MANAGEMENT:');
    }

    // 2. Consultation Mgmt
    public function medicalAssessment(): void {
        $this->renderSubpage('Medical Assessment', 'Consultation Mgmt', 'CONSULTATIONS:');
    }

    public function treatmentRecords(): void {
        $this->renderSubpage('Treatment Records', 'Consultation Mgmt', 'CONSULTATIONS:');
    }

    // 3. Appointment & Schedule
    public function consultationRequests(): void {
        $this->renderSubpage('Consultation Requests', 'Appointment & Schedule', 'APPOINTMENTS:');
    }

    public function appointmentsList(): void {
        $this->renderSubpage('List of Appointments', 'Appointment & Schedule', 'APPOINTMENTS:');
    }

    public function queueManagement(): void {
        $this->renderSubpage('Queue Management', 'Appointment & Schedule', 'APPOINTMENTS:');
    }

    public function reminders(): void {
        $this->renderSubpage('Reminders', 'Appointment & Schedule', 'APPOINTMENTS:');
    }

    // 4. Health Monitoring
    public function vitalSigns(): void {
        $this->renderSubpage('Vital Signs Recording', 'Health Monitoring', 'MONITORING:');
    }

    public function screeningResults(): void {
        $this->renderSubpage('Screening Results', 'Health Monitoring', 'MONITORING:');
    }

    public function immunizationTracking(): void {
        $this->renderSubpage('Immunization Tracking', 'Health Monitoring', 'MONITORING:');
    }

    public function healthRiskMonitoring(): void {
        $this->renderSubpage('Health Risk Monitoring', 'Health Monitoring', 'MONITORING:');
    }

    // 5. Reports & Analytics
    public function commonHealthConcerns(): void {
        $this->renderSubpage('Common Health Concerns', 'Reports & Analytics', 'REPORTS & ANALYTICS:');
    }

    public function clinicUtilization(): void {
        $this->renderSubpage('Clinic Utilization', 'Reports & Analytics', 'REPORTS & ANALYTICS:');
    }

    public function programEvaluation(): void {
        $this->renderSubpage('Program Evaluation', 'Reports & Analytics', 'REPORTS & ANALYTICS:');
    }

    // 6. Health Services Mgmt
    public function inventorySupplies(): void {
        $this->renderSubpage('Inventory & Medical Supplies', 'Health Services Mgmt', 'SERVICES MANAGEMENT:');
    }

    public function medicineDispensing(): void {
        $this->renderSubpage('Medicine Dispensing', 'Health Services Mgmt', 'SERVICES MANAGEMENT:');
    }

    public function staffSchedule(): void {
        $this->renderSubpage('Clinic Staff Schedule', 'Health Services Mgmt', 'SERVICES MANAGEMENT:');
    }

    private function renderSubpage(string $title, string $category, string $headerTag): void {
        $user = Auth::user();
        $records = $this->getRecords();

        View::render('health/Views/index', [
            'title'          => $title . ' - Student Health Profile',
            'moduleName'     => 'Student Health Profile',
            'slug'           => 'health',
            'records'        => $records,
            'user'           => $user,
            'activeSection'  => strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title)),
            'sectionTitle'   => $title,
            'sectionCategory'=> $category,
            'headerTag'      => $headerTag,
            'crumbs'         => [
                'Clinic Management' => url('health'),
                $category           => '',
                $title              => ''
            ]
        ]);
    }
}

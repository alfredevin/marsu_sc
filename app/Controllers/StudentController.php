<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Student;
use App\Models\Program;
use App\Models\Section;

class StudentController {
    public function index(): void {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = trim($_GET['q'] ?? '');
        $programFilter = trim($_GET['program'] ?? '');
        $yearFilter = trim($_GET['year'] ?? '');
        $statusFilter = trim($_GET['status'] ?? '');

        $result = Student::paginate($page, 15, $search, $programFilter, $yearFilter, $statusFilter);
        $programs = Program::all();
        $sections = Section::all();

        View::render('students/index', [
            'title'         => 'Student Master Registry',
            'students'      => $result['data'],
            'pagination'    => $result,
            'programs'      => $programs,
            'sections'      => $sections,
            'search'        => $search,
            'programFilter' => $programFilter,
            'yearFilter'    => $yearFilter,
            'statusFilter'  => $statusFilter,
            'crumbs'        => ['Master Data' => '', 'Students' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'student_number' => 'required|max:32|unique:students,student_number',
            'first_name'     => 'required|max:100',
            'last_name'      => 'required|max:100',
            'email'          => 'required|email|max:128|unique:students,email',
            'program_id'     => 'required|integer',
            'year_level'     => 'required|integer',
            'gender'         => 'required|in:male,female'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('students'));
        }

        $id = Student::create([
            'student_number'    => trim($_POST['student_number']),
            'first_name'        => trim($_POST['first_name']),
            'middle_name'       => trim($_POST['middle_name'] ?? ''),
            'last_name'         => trim($_POST['last_name']),
            'suffix'            => trim($_POST['suffix'] ?? ''),
            'gender'            => $_POST['gender'],
            'birthdate'         => !empty($_POST['birthdate']) ? $_POST['birthdate'] : null,
            'email'             => trim($_POST['email']),
            'contact_number'    => trim($_POST['contact_number'] ?? ''),
            'address'           => trim($_POST['address'] ?? ''),
            'program_id'        => (int)$_POST['program_id'],
            'year_level'        => (int)$_POST['year_level'],
            'section_id'        => !empty($_POST['section_id']) ? (int)$_POST['section_id'] : null,
            'enrollment_status' => $_POST['enrollment_status'] ?? 'enrolled',
            'guardian_name'     => trim($_POST['guardian_name'] ?? ''),
            'guardian_contact'  => trim($_POST['guardian_contact'] ?? '')
        ]);

        Logger::audit('student.create', 'students', $id, ['student_number' => $_POST['student_number']]);
        Session::flash('success', "Student '{$_POST['student_number']}' enrolled successfully.");
        redirect(url('students'));
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $validator = Validator::make($_POST, [
            'student_number' => "required|max:32|unique:students,student_number,{$id}",
            'first_name'     => 'required|max:100',
            'last_name'      => 'required|max:100',
            'email'          => "required|email|max:128|unique:students,email,{$id}",
            'program_id'     => 'required|integer',
            'year_level'     => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('students'));
        }

        Student::update($id, [
            'student_number'    => trim($_POST['student_number']),
            'first_name'        => trim($_POST['first_name']),
            'middle_name'       => trim($_POST['middle_name'] ?? ''),
            'last_name'         => trim($_POST['last_name']),
            'suffix'            => trim($_POST['suffix'] ?? ''),
            'gender'            => $_POST['gender'] ?? 'male',
            'birthdate'         => !empty($_POST['birthdate']) ? $_POST['birthdate'] : null,
            'email'             => trim($_POST['email']),
            'contact_number'    => trim($_POST['contact_number'] ?? ''),
            'address'           => trim($_POST['address'] ?? ''),
            'program_id'        => (int)$_POST['program_id'],
            'year_level'        => (int)$_POST['year_level'],
            'section_id'        => !empty($_POST['section_id']) ? (int)$_POST['section_id'] : null,
            'enrollment_status' => $_POST['enrollment_status'] ?? 'enrolled',
            'guardian_name'     => trim($_POST['guardian_name'] ?? ''),
            'guardian_contact'  => trim($_POST['guardian_contact'] ?? '')
        ]);

        Logger::audit('student.update', 'students', $id, ['student_number' => $_POST['student_number']]);
        Session::flash('success', "Student record updated successfully.");
        redirect(url('students'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        Student::softDelete($id);
        Logger::audit('student.delete', 'students', $id, []);
        Session::flash('success', "Student record archived.");
        redirect(url('students'));
    }

    public function showImport(): void {
        View::render('students/import', [
            'title'  => 'Bulk CSV Student Import',
            'crumbs' => ['Students' => url('students'), 'Bulk Import' => '']
        ]);
    }

    public function processImport(): void {
        if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Please select a valid CSV file to upload.');
            redirect(url('students/import'));
        }

        $tmpFile = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($tmpFile, 'r');
        if (!$handle) {
            Session::flash('error', 'Could not open uploaded file.');
            redirect(url('students/import'));
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            Session::flash('error', 'The uploaded CSV file is empty.');
            redirect(url('students/import'));
        }

        // Clean headers
        $header = array_map(fn($h) => strtolower(trim(str_replace([' ', '-'], '_', $h))), $header);

        $rows = [];
        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) === count($header)) {
                $rows[] = array_combine($header, $data);
            }
        }
        fclose($handle);

        $result = Student::bulkImport($rows);

        Logger::audit('student.bulk_import', 'students', null, ['count' => $result['imported'], 'errors' => count($result['errors'])]);

        if (!empty($result['errors'])) {
            Session::flash('error', "Imported {$result['imported']} students with " . count($result['errors']) . " error(s). First error: " . $result['errors'][0]);
        } else {
            Session::flash('success', "Successfully imported all {$result['imported']} students!");
        }

        redirect(url('students'));
    }

    public function downloadTemplate(): void {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="students_import_template.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, [
            'student_number', 'first_name', 'middle_name', 'last_name', 'suffix', 
            'gender', 'birthdate', 'email', 'contact_number', 'address', 
            'program_code', 'year_level', 'section_name', 'enrollment_status', 
            'guardian_name', 'guardian_contact'
        ]);
        fputcsv($out, [
            '23-01001', 'Juan', 'Protacio', 'Dela Cruz', '', 
            'male', '2004-06-19', 'juan.delacruz@marsu.edu.ph', '09181234567', 'Brgy. Murallon, Boac, Marinduque', 
            'BSIS', '3', 'BSIS 3A', 'enrolled', 
            'Maria Dela Cruz', '09191234567'
        ]);
        fclose($out);
        exit;
    }

    public function exportCsv(): void {
        $result = Student::paginate(1, 10000);
        $students = $result['data'];

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="marsu_students_' . date('Ymd_His') . '.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Student Number', 'Full Name', 'Gender', 'Email', 'Program', 'Year', 'Section', 'Status']);

        foreach ($students as $s) {
            fputcsv($out, [
                $s['id'],
                $s['student_number'],
                $s['last_name'] . ', ' . $s['first_name'] . ' ' . $s['middle_name'],
                ucfirst($s['gender']),
                $s['email'],
                $s['program_code'],
                $s['year_level'],
                $s['section_name'] ?? 'N/A',
                ucfirst($s['enrollment_status'])
            ]);
        }

        fclose($out);
        exit;
    }
}

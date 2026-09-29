<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController {
    public function index(): void {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = trim($_GET['q'] ?? '');
        $deptFilter = trim($_GET['department'] ?? '');
        $typeFilter = trim($_GET['type'] ?? '');
        $statusFilter = trim($_GET['status'] ?? '');

        $result = Employee::paginate($page, 15, $search, $deptFilter, $typeFilter, $statusFilter);
        $departments = Department::all();

        View::render('employees/index', [
            'title'        => 'Faculty & Staff Directory',
            'employees'    => $result['data'],
            'pagination'   => $result,
            'departments'  => $departments,
            'search'       => $search,
            'deptFilter'   => $deptFilter,
            'typeFilter'   => $typeFilter,
            'statusFilter' => $statusFilter,
            'crumbs'       => ['Master Data' => '', 'Employees' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'employee_number' => 'required|max:32|unique:employees,employee_number',
            'first_name'      => 'required|max:100',
            'last_name'       => 'required|max:100',
            'email'           => 'required|email|max:128|unique:employees,email',
            'type'            => 'required|in:faculty,staff,admin',
            'position'        => 'required|max:100',
            'department_id'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('employees'));
        }

        $id = Employee::create([
            'employee_number' => trim($_POST['employee_number']),
            'first_name'      => trim($_POST['first_name']),
            'middle_name'     => trim($_POST['middle_name'] ?? ''),
            'last_name'       => trim($_POST['last_name']),
            'suffix'          => trim($_POST['suffix'] ?? ''),
            'gender'          => $_POST['gender'] ?? 'male',
            'email'           => trim($_POST['email']),
            'contact_number'  => trim($_POST['contact_number'] ?? ''),
            'type'            => $_POST['type'],
            'position'        => trim($_POST['position']),
            'rank'            => trim($_POST['rank'] ?? ''),
            'department_id'   => (int)$_POST['department_id'],
            'status'          => $_POST['status'] ?? 'active'
        ]);

        Logger::audit('employee.create', 'employees', $id, ['employee_number' => $_POST['employee_number']]);
        Session::flash('success', "Employee '{$_POST['employee_number']}' added to directory.");
        redirect(url('employees'));
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $validator = Validator::make($_POST, [
            'employee_number' => "required|max:32|unique:employees,employee_number,{$id}",
            'first_name'      => 'required|max:100',
            'last_name'       => 'required|max:100',
            'email'           => "required|email|max:128|unique:employees,email,{$id}",
            'position'        => 'required|max:100',
            'department_id'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('employees'));
        }

        Employee::update($id, [
            'employee_number' => trim($_POST['employee_number']),
            'first_name'      => trim($_POST['first_name']),
            'middle_name'     => trim($_POST['middle_name'] ?? ''),
            'last_name'       => trim($_POST['last_name']),
            'suffix'          => trim($_POST['suffix'] ?? ''),
            'gender'          => $_POST['gender'] ?? 'male',
            'email'           => trim($_POST['email']),
            'contact_number'  => trim($_POST['contact_number'] ?? ''),
            'type'            => $_POST['type'] ?? 'faculty',
            'position'        => trim($_POST['position']),
            'rank'            => trim($_POST['rank'] ?? ''),
            'department_id'   => (int)$_POST['department_id'],
            'status'          => $_POST['status'] ?? 'active'
        ]);

        Logger::audit('employee.update', 'employees', $id, ['employee_number' => $_POST['employee_number']]);
        Session::flash('success', "Employee profile updated.");
        redirect(url('employees'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        Employee::softDelete($id);
        Logger::audit('employee.delete', 'employees', $id, []);
        Session::flash('success', "Employee record archived.");
        redirect(url('employees'));
    }

    public function showImport(): void {
        View::render('employees/import', [
            'title'  => 'Bulk CSV Employee Import',
            'crumbs' => ['Employees' => url('employees'), 'Bulk Import' => '']
        ]);
    }

    public function processImport(): void {
        if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Please select a valid CSV file to upload.');
            redirect(url('employees/import'));
        }

        $tmpFile = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($tmpFile, 'r');
        if (!$handle) {
            Session::flash('error', 'Could not open file.');
            redirect(url('employees/import'));
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            Session::flash('error', 'The uploaded CSV file is empty.');
            redirect(url('employees/import'));
        }

        $header = array_map(fn($h) => strtolower(trim(str_replace([' ', '-'], '_', $h))), $header);

        $rows = [];
        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) === count($header)) {
                $rows[] = array_combine($header, $data);
            }
        }
        fclose($handle);

        $result = Employee::bulkImport($rows);
        Logger::audit('employee.bulk_import', 'employees', null, ['count' => $result['imported']]);

        if (!empty($result['errors'])) {
            Session::flash('error', "Imported {$result['imported']} employees with errors. First error: " . $result['errors'][0]);
        } else {
            Session::flash('success', "Successfully imported {$result['imported']} employees!");
        }

        redirect(url('employees'));
    }

    public function downloadTemplate(): void {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="employees_import_template.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, [
            'employee_number', 'first_name', 'middle_name', 'last_name', 'suffix', 
            'gender', 'email', 'contact_number', 'type', 'position', 'rank', 
            'department_code', 'status'
        ]);
        fputcsv($out, [
            'EMP-2026-001', 'Arnel', 'M.', 'Lacierda', '', 
            'male', 'arnel.lacierda@marsu.edu.ph', '09171234567', 'faculty', 'Dean / Associate Professor IV', 'Permanent', 
            'CICS', 'active'
        ]);
        fclose($out);
        exit;
    }

    public function exportCsv(): void {
        $result = Employee::paginate(1, 10000);
        $employees = $result['data'];

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="marsu_employees_' . date('Ymd_His') . '.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Employee Number', 'Full Name', 'Type', 'Email', 'Position', 'Rank', 'Department', 'Status']);

        foreach ($employees as $e) {
            fputcsv($out, [
                $e['id'],
                $e['employee_number'],
                $e['last_name'] . ', ' . $e['first_name'] . ' ' . $e['middle_name'],
                ucfirst($e['type']),
                $e['email'],
                $e['position'],
                $e['rank'] ?? 'N/A',
                $e['department_code'] ?? 'N/A',
                ucfirst($e['status'])
            ]);
        }

        fclose($out);
        exit;
    }
}

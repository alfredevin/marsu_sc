<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Subject;
use App\Models\Program;

class SubjectController {
    public function index(): void {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = trim($_GET['q'] ?? '');
        $programFilter = trim($_GET['program'] ?? '');

        $result = Subject::paginate($page, 15, $search, $programFilter);
        $programs = Program::all();

        View::render('subjects/index', [
            'title'         => 'Curriculum Subjects Registry',
            'subjects'      => $result['data'],
            'pagination'    => $result,
            'programs'      => $programs,
            'search'        => $search,
            'programFilter' => $programFilter,
            'crumbs'        => ['Master Data' => '', 'Subjects' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'code'  => 'required|max:32|unique:subjects,code',
            'title' => 'required|max:191',
            'units' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('subjects'));
        }

        $id = Subject::create([
            'program_id'    => !empty($_POST['program_id']) ? (int)$_POST['program_id'] : null,
            'code'          => strtoupper(trim($_POST['code'])),
            'title'         => trim($_POST['title']),
            'lecture_hours' => floatval($_POST['lecture_hours'] ?? 3.0),
            'lab_hours'     => floatval($_POST['lab_hours'] ?? 0.0),
            'units'         => floatval($_POST['units']),
            'prerequisites' => trim($_POST['prerequisites'] ?? ''),
            'status'        => $_POST['status'] ?? 'active'
        ]);

        Logger::audit('subject.create', 'subjects', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Subject '{$_POST['code']}' added.");
        redirect(url('subjects'));
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $validator = Validator::make($_POST, [
            'code'  => "required|max:32|unique:subjects,code,{$id}",
            'title' => 'required|max:191',
            'units' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('subjects'));
        }

        Subject::update($id, [
            'program_id'    => !empty($_POST['program_id']) ? (int)$_POST['program_id'] : null,
            'code'          => strtoupper(trim($_POST['code'])),
            'title'         => trim($_POST['title']),
            'lecture_hours' => floatval($_POST['lecture_hours'] ?? 3.0),
            'lab_hours'     => floatval($_POST['lab_hours'] ?? 0.0),
            'units'         => floatval($_POST['units']),
            'prerequisites' => trim($_POST['prerequisites'] ?? ''),
            'status'        => $_POST['status'] ?? 'active'
        ]);

        Logger::audit('subject.update', 'subjects', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Subject updated successfully.");
        redirect(url('subjects'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        Subject::softDelete($id);
        Logger::audit('subject.delete', 'subjects', $id, []);
        Session::flash('success', "Subject archived.");
        redirect(url('subjects'));
    }

    public function showImport(): void {
        View::render('subjects/import', [
            'title'  => 'Bulk CSV Subject Import',
            'crumbs' => ['Subjects' => url('subjects'), 'Bulk Import' => '']
        ]);
    }

    public function processImport(): void {
        if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Please select a valid CSV file.');
            redirect(url('subjects/import'));
        }

        $tmpFile = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($tmpFile, 'r');
        if (!$handle) {
            Session::flash('error', 'Could not open CSV file.');
            redirect(url('subjects/import'));
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            Session::flash('error', 'CSV file is empty.');
            redirect(url('subjects/import'));
        }

        $header = array_map(fn($h) => strtolower(trim(str_replace([' ', '-'], '_', $h))), $header);

        $rows = [];
        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) === count($header)) {
                $rows[] = array_combine($header, $data);
            }
        }
        fclose($handle);

        $result = Subject::bulkImport($rows);
        Logger::audit('subject.bulk_import', 'subjects', null, ['count' => $result['imported']]);

        if (!empty($result['errors'])) {
            Session::flash('error', "Imported {$result['imported']} subjects with errors. First error: " . $result['errors'][0]);
        } else {
            Session::flash('success', "Successfully imported {$result['imported']} curriculum subjects!");
        }

        redirect(url('subjects'));
    }

    public function downloadTemplate(): void {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="subjects_import_template.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['code', 'title', 'units', 'lecture_hours', 'lab_hours', 'program_code']);
        fputcsv($out, ['IS 311', 'Enterprise Architecture', '3.0', '2.0', '3.0', 'BSIS']);
        fputcsv($out, ['IT 312', 'Information Assurance and Security', '3.0', '2.0', '3.0', 'BSIS']);
        fclose($out);
        exit;
    }

    public function exportCsv(): void {
        $result = Subject::paginate(1, 10000);
        $subjects = $result['data'];

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="marsu_subjects_' . date('Ymd_His') . '.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Subject Code', 'Title', 'Units', 'Lecture Hours', 'Lab Hours', 'Program', 'Status']);

        foreach ($subjects as $s) {
            fputcsv($out, [
                $s['id'],
                $s['code'],
                $s['title'],
                $s['units'],
                $s['lecture_hours'],
                $s['lab_hours'],
                $s['program_code'] ?? 'General',
                ucfirst($s['status'])
            ]);
        }

        fclose($out);
        exit;
    }
}

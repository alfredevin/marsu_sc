<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Program;
use App\Models\Department;

class ProgramController {
    public function index(): void {
        $programs = Program::all();
        $departments = Department::all();
        View::render('programs/index', [
            'title'       => 'Academic Degree Programs',
            'programs'    => $programs,
            'departments' => $departments,
            'crumbs'      => ['Master Data' => '', 'Academic Programs' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'code'          => 'required|max:32|unique:programs,code',
            'name'          => 'required|max:191',
            'department_id' => 'required|integer',
            'years'         => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('programs'));
        }

        $id = Program::create([
            'department_id' => (int)$_POST['department_id'],
            'code'          => strtoupper(trim($_POST['code'])),
            'name'          => trim($_POST['name']),
            'major'         => trim($_POST['major'] ?? ''),
            'years'         => (int)$_POST['years'],
            'status'        => $_POST['status'] ?? 'active'
        ]);

        Logger::audit('program.create', 'programs', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Program '{$_POST['code']}' registered.");
        redirect(url('programs'));
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $validator = Validator::make($_POST, [
            'code'          => "required|max:32|unique:programs,code,{$id}",
            'name'          => 'required|max:191',
            'department_id' => 'required|integer',
            'years'         => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('programs'));
        }

        Program::update($id, [
            'department_id' => (int)$_POST['department_id'],
            'code'          => strtoupper(trim($_POST['code'])),
            'name'          => trim($_POST['name']),
            'major'         => trim($_POST['major'] ?? ''),
            'years'         => (int)$_POST['years'],
            'status'        => $_POST['status'] ?? 'active'
        ]);

        Logger::audit('program.update', 'programs', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Program updated successfully.");
        redirect(url('programs'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        Program::softDelete($id);
        Logger::audit('program.delete', 'programs', $id, []);
        Session::flash('success', "Program archived.");
        redirect(url('programs'));
    }
}

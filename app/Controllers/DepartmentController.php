<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Department;

class DepartmentController {
    public function index(): void {
        $departments = Department::all();
        View::render('departments/index', [
            'title'       => 'Colleges & Departments',
            'departments' => $departments,
            'crumbs'      => ['Master Data' => '', 'Colleges & Depts' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'code' => 'required|max:32|unique:departments,code',
            'name' => 'required|max:191',
            'type' => 'required|in:college,department,office'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('departments'));
        }

        $id = Department::create([
            'code'        => strtoupper(trim($_POST['code'])),
            'name'        => trim($_POST['name']),
            'type'        => $_POST['type'],
            'description' => trim($_POST['description'] ?? ''),
            'head_name'   => trim($_POST['head_name'] ?? '')
        ]);

        Logger::audit('department.create', 'departments', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Department '{$_POST['code']}' added.");
        redirect(url('departments'));
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $validator = Validator::make($_POST, [
            'code' => "required|max:32|unique:departments,code,{$id}",
            'name' => 'required|max:191'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('departments'));
        }

        Department::update($id, [
            'code'        => strtoupper(trim($_POST['code'])),
            'name'        => trim($_POST['name']),
            'type'        => $_POST['type'] ?? 'college',
            'description' => trim($_POST['description'] ?? ''),
            'head_name'   => trim($_POST['head_name'] ?? '')
        ]);

        Logger::audit('department.update', 'departments', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Department details updated.");
        redirect(url('departments'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        Department::softDelete($id);
        Logger::audit('department.delete', 'departments', $id, []);
        Session::flash('success', "Department archived.");
        redirect(url('departments'));
    }
}

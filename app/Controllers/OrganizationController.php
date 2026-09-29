<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Organization;
use App\Models\Employee;

class OrganizationController {
    public function index(): void {
        $organizations = Organization::all();
        $employees = Employee::all();

        View::render('organizations/index', [
            'title'         => 'Student Organizations Registry',
            'organizations' => $organizations,
            'employees'     => $employees,
            'crumbs'        => ['Master Data' => '', 'Student Organizations' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'code' => 'required|max:32|unique:organizations,code',
            'name' => 'required|max:191',
            'type' => 'required|in:academic,non_academic,socio_civic,sports,religious'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('organizations'));
        }

        $id = Organization::create([
            'code'        => strtoupper(trim($_POST['code'])),
            'name'        => trim($_POST['name']),
            'type'        => $_POST['type'],
            'description' => trim($_POST['description'] ?? ''),
            'adviser_id'  => !empty($_POST['adviser_id']) ? (int)$_POST['adviser_id'] : null,
            'status'      => $_POST['status'] ?? 'accredited'
        ]);

        Logger::audit('organization.create', 'organizations', $id, ['code' => $_POST['code']]);
        Session::flash('success', "Organization '{$_POST['code']}' registered.");
        redirect(url('organizations'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        Organization::softDelete($id);
        Logger::audit('organization.delete', 'organizations', $id, []);
        Session::flash('success', "Organization archived.");
        redirect(url('organizations'));
    }
}

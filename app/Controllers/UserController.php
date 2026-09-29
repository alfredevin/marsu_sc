<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\User;
use App\Models\Role;

class UserController {
    public function index(): void {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search = trim($_GET['q'] ?? '');
        $roleFilter = trim($_GET['role'] ?? '');

        $result = User::paginate($page, 15, $search, $roleFilter);
        $roles = Role::all();

        View::render('users/index', [
            'title'      => 'User Account Management',
            'users'      => $result['data'],
            'pagination' => $result,
            'roles'      => $roles,
            'search'     => $search,
            'roleFilter' => $roleFilter,
            'crumbs'     => ['Administration' => '', 'Users' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'username'   => 'required|max:64|unique:users,username',
            'email'      => 'required|email|max:128|unique:users,email',
            'password'   => 'required|min:6',
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'role_id'    => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('users'));
        }

        $userId = User::create([
            'username'   => trim($_POST['username']),
            'email'      => trim($_POST['email']),
            'password'   => $_POST['password'],
            'first_name' => trim($_POST['first_name']),
            'last_name'  => trim($_POST['last_name']),
            'status'     => $_POST['status'] ?? 'active'
        ], (int)$_POST['role_id']);

        Logger::audit('user.create', 'users', $userId, ['username' => $_POST['username']]);
        Session::flash('success', "User account for '{$_POST['username']}' created.");
        redirect(url('users'));
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $validator = Validator::make($_POST, [
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'email'      => "required|email|max:128|unique:users,email,{$id}",
            'role_id'    => 'required|integer'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('users'));
        }

        $data = [
            'first_name' => trim($_POST['first_name']),
            'last_name'  => trim($_POST['last_name']),
            'email'      => trim($_POST['email']),
            'status'     => $_POST['status'] ?? 'active'
        ];

        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }

        User::update($id, $data, (int)$_POST['role_id']);

        Logger::audit('user.update', 'users', $id, ['email' => $data['email']]);
        Session::flash('success', 'User account updated successfully.');
        redirect(url('users'));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id === 1) {
            Session::flash('error', 'Cannot delete primary root administrator account.');
            redirect(url('users'));
        }

        User::softDelete($id);
        Logger::audit('user.delete', 'users', $id, []);
        Session::flash('success', 'User account deactivated and archived.');
        redirect(url('users'));
    }
}

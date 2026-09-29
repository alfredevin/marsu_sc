<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use Core\Validator;
use Core\Logger;
use App\Models\Role;
use App\Models\Permission;

class RoleController {
    public function index(): void {
        $roles = Role::all();
        View::render('roles/index', [
            'title'  => 'Roles & Permissions',
            'roles'  => $roles,
            'crumbs' => ['Administration' => '', 'Roles & RBAC' => '']
        ]);
    }

    public function matrix(): void {
        $roleId = isset($_GET['role_id']) ? (int)$_GET['role_id'] : 1;
        $role = Role::find($roleId) ?? Role::all()[0];
        $allRoles = Role::all();
        $groupedPermissions = Permission::allGroupedByModule();
        $assignedPermIds = Role::getPermissions((int)$role['id']);

        View::render('roles/matrix', [
            'title'              => 'RBAC Permission Matrix',
            'currentRole'        => $role,
            'allRoles'           => $allRoles,
            'groupedPermissions' => $groupedPermissions,
            'assignedPermIds'    => $assignedPermIds,
            'crumbs'             => ['Roles' => url('roles'), 'Permission Matrix' => '']
        ]);
    }

    public function store(): void {
        $validator = Validator::make($_POST, [
            'name' => 'required|max:100',
            'slug' => 'required|max:64'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->firstError());
            redirect(url('roles'));
        }

        $slug = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', trim($_POST['slug'])));

        $existing = Role::findBySlug($slug);
        if ($existing) {
            Session::flash('error', "Role slug '{$slug}' already exists.");
            redirect(url('roles'));
        }

        $roleId = Role::create([
            'name'        => trim($_POST['name']),
            'slug'        => $slug,
            'description' => trim($_POST['description'] ?? '')
        ]);

        Logger::audit('role.create', 'roles', $roleId, ['name' => $_POST['name']]);
        Session::flash('success', "Role '{$_POST['name']}' created successfully.");
        redirect(url('roles/matrix', ['role_id' => $roleId]));
    }

    public function sync(): void {
        $roleId = (int)($_POST['role_id'] ?? 0);
        $role = Role::find($roleId);

        if (!$role) {
            Session::flash('error', 'Role not found.');
            redirect(url('roles'));
        }

        $perms = $_POST['permissions'] ?? [];
        Role::syncPermissions($roleId, $perms);

        Logger::audit('role.sync_permissions', 'roles', $roleId, ['count' => count($perms)]);
        Session::flash('success', "Permissions updated for role '{$role['name']}'.");
        redirect(url('roles/matrix', ['role_id' => $roleId]));
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);
        try {
            Role::delete($id);
            Logger::audit('role.delete', 'roles', $id, []);
            Session::flash('success', 'Role removed successfully.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        redirect(url('roles'));
    }
}

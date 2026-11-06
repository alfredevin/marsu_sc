<?php

namespace Modules\Welfare\Controllers;

use Core\Database;
use Core\View;
use Core\Auth;

class MaintenanceController
{
    /**
     * Maintenance: Student Concern Types
     * Provides CRUD operations for student concern categories and classifications
     */
    public function concerntypes(): void
    {
        $user = Auth::user();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'store';

            if ($action === 'archive') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    Database::update('wlf_concern_types', [
                        'status' => 'inactive',
                        'deleted_at' => date('Y-m-d H:i:s')
                    ], 'id = :id', ['id' => $id]);
                    flash('success', 'Student concern type archived successfully.');
                }
                header('Location: ' . url('welfare/concern-types'));
                exit;
            }

            // Store new concern type
            $code = strtoupper(trim($_POST['code'] ?? ''));
            $name = trim($_POST['name'] ?? '');
            $category = trim($_POST['category'] ?? 'General Welfare');
            $severityLevel = trim($_POST['severity_level'] ?? 'medium');
            $description = trim($_POST['description'] ?? '');
            $status = trim($_POST['status'] ?? 'active');

            if (!empty($code) && !empty($name)) {
                // Check if code already exists
                $existing = Database::fetchOne(
                    "SELECT id FROM wlf_concern_types WHERE code = :code AND deleted_at IS NULL",
                    ['code' => $code]
                );

                if ($existing) {
                    flash('error', "Concern type code '{$code}' already exists.");
                } else {
                    Database::insert('wlf_concern_types', [
                        'code' => $code,
                        'name' => $name,
                        'category' => $category,
                        'severity_level' => in_array($severityLevel, ['low', 'medium', 'high', 'critical']) ? $severityLevel : 'medium',
                        'description' => $description,
                        'status' => in_array($status, ['active', 'inactive']) ? $status : 'active',
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    flash('success', "Student concern type '{$name}' created successfully.");
                }
            } else {
                flash('error', 'Both Concern Type Code and Name are required fields.');
            }

            header('Location: ' . url('welfare/concern-types'));
            exit;
        }

        // Fetch all active concern types
        $concernTypes = Database::fetchAll("
            SELECT * FROM wlf_concern_types
            WHERE deleted_at IS NULL
            ORDER BY category ASC, code ASC
        ");

        View::render('welfare/Views/concern-types', [
            'title' => 'Student Concern Types Maintenance',
            'slug' => 'welfare',
            'user' => $user,
            'concernTypes' => $concernTypes
        ]);
    }

    /**
     * Backward-compatible alias for maintenance overview
     */
    public function maintenance(): void
    {
        $this->concerntypes();
    }
}


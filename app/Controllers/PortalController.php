<?php
namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\View;

class PortalController {
    /**
     * Standalone Public Student Portal & Mobile Web App
     * Accessible outside the internal administrative ERP system.
     */
    public function index(): void {
        $user = Auth::user();
        
        // Fetch student record if linked to user account
        $student = null;
        if (!empty($user['id'])) {
            try {
                $student = Database::fetchOne(
                    "SELECT s.*, p.name as program_name, p.code as program_code 
                     FROM students s 
                     LEFT JOIN programs p ON s.program_id = p.id 
                     WHERE s.user_id = :uid AND s.deleted_at IS NULL", 
                    ['uid' => $user['id']]
                );
            } catch (\Exception $e) {
                // Ignore DB error
            }
        }
        
        // Demo student identity for interactive preview / guest browsing
        if (!$student) {
            $student = [
                'student_number'    => '26S0227',
                'first_name'        => $user['first_name'] ?? 'Maria',
                'last_name'         => $user['last_name'] ?? 'Santos',
                'email'             => $user['email'] ?? 'student@marsu.edu.ph',
                'program_code'      => 'BSIS',
                'program_name'      => 'Bachelor of Science in Information Systems',
                'year_level'        => 3,
                'section_name'      => 'BSIS 3-A',
                'enrollment_status' => 'enrolled'
            ];
        }

        View::render('portal/index', [
            'title'   => 'MarSU Student Portal | Official University Services',
            'user'    => $user,
            'student' => $student
        ], null); // Render as standalone website without internal ERP main layout
    }
}

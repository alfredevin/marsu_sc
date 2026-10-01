<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;

/**
 * ISHAMIS - Integrated Student Housing and Accommodation Management Information System
 * Executive Overview & Dashboard Controller
 */
class HomeController {
    public function index(): void {
        $user = Auth::user();

        // 1. Calculate Real-Time ISHAMIS Analytics
        $totalHouses = 0;
        $accreditedHouses = 0;
        $totalCapacity = 0;
        $availableBeds = 0;
        $activeResidents = 0;
        $avgRating = 0;

        try {
            $totalHouses = (int)(Database::fetchOne("SELECT COUNT(*) as cnt FROM `hsg_boarding_houses` WHERE deleted_at IS NULL")['cnt'] ?? 0);
            $accreditedHouses = (int)(Database::fetchOne("SELECT COUNT(*) as cnt FROM `hsg_boarding_houses` WHERE accreditation_status = 'accredited' AND deleted_at IS NULL")['cnt'] ?? 0);
            $totalCapacity = (int)(Database::fetchOne("SELECT SUM(total_bed_capacity) as total FROM `hsg_boarding_houses` WHERE deleted_at IS NULL")['total'] ?? 0);
            $availableBeds = (int)(Database::fetchOne("SELECT SUM(vacant_beds) as total FROM `hsg_rooms` WHERE deleted_at IS NULL")['total'] ?? 0);
            $activeResidents = (int)(Database::fetchOne("SELECT COUNT(*) as cnt FROM `hsg_accommodations` WHERE status = 'active' AND deleted_at IS NULL")['cnt'] ?? 0);
            $avgRating = (float)(Database::fetchOne("SELECT AVG(safety_rating) as avg_score FROM `hsg_boarding_houses` WHERE deleted_at IS NULL")['avg_score'] ?? 4.5);
            
            // Recent Boarding Houses
            $recentHouses = Database::fetchAll("SELECT * FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY safety_rating DESC, id DESC LIMIT 6");

            // Recent Inspections
            $recentInspections = Database::fetchAll("
                SELECT i.*, bh.name as house_name, bh.barangay 
                FROM `hsg_inspections` i 
                JOIN `hsg_boarding_houses` bh ON i.boarding_house_id = bh.id 
                WHERE i.deleted_at IS NULL 
                ORDER BY i.inspection_date DESC LIMIT 5
            ");

            // Recent Student Resident Placements
            $recentResidents = Database::fetchAll("
                SELECT a.*, s.student_number, s.first_name, s.last_name, s.gender, r.room_number, bh.name as house_name 
                FROM `hsg_accommodations` a 
                JOIN `students` s ON a.student_id = s.id 
                JOIN `hsg_boarding_houses` bh ON a.boarding_house_id = bh.id 
                JOIN `hsg_rooms` r ON a.room_id = r.id 
                WHERE a.deleted_at IS NULL 
                ORDER BY a.id DESC LIMIT 5
            ");
        } catch (\Exception $e) {
            $recentHouses = [];
            $recentInspections = [];
            $recentResidents = [];
        }

        View::render('housing/Views/index', [
            'title'             => 'ISHAMIS - Student Housing & Accommodation',
            'moduleName'        => 'Integrated Student Housing & Accommodation Management (ISHAMIS)',
            'slug'              => 'housing',
            'totalHouses'       => $totalHouses,
            'accreditedHouses'  => $accreditedHouses,
            'totalCapacity'     => $totalCapacity,
            'availableBeds'     => $availableBeds,
            'activeResidents'   => $activeResidents,
            'avgRating'         => round($avgRating, 1),
            'recentHouses'      => $recentHouses,
            'recentInspections' => $recentInspections,
            'recentResidents'   => $recentResidents,
            'user'              => $user,
            'crumbs'            => [
                'Student Services' => '',
                'ISHAMIS (Student Housing)' => ''
            ]
        ]);
    }
}

<?php
namespace Modules\Housing\Controllers;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

class InspectionController {
    public function index(): void {
        $user = Auth::user();

        $sql = "
            SELECT i.*, bh.name as house_name, bh.code as house_code, bh.landlord_name, bh.barangay, bh.safety_rating 
            FROM `hsg_inspections` i 
            JOIN `hsg_boarding_houses` bh ON i.boarding_house_id = bh.id 
            WHERE i.deleted_at IS NULL 
            ORDER BY i.inspection_date DESC
        ";
        $inspections = Database::fetchAll($sql);

        // Fetch houses for inspection modal
        $houses = Database::fetchAll("SELECT id, name, code, landlord_name FROM `hsg_boarding_houses` WHERE deleted_at IS NULL ORDER BY name ASC");

        View::render('housing/Views/inspections', [
            'title'       => 'Housing Safety & Sanitation Inspections - ISHAMIS',
            'inspections' => $inspections,
            'houses'      => $houses,
            'user'        => $user,
            'crumbs'      => [
                'ISHAMIS' => url('housing'),
                'Safety Inspections' => ''
            ]
        ]);
    }

    public function store(): void {
        $houseId = (int)($_POST['boarding_house_id'] ?? 0);
        $date = trim($_POST['inspection_date'] ?? date('Y-m-d'));
        $fire = !empty($_POST['fire_safety_passed']) ? 1 : 0;
        $sanitary = !empty($_POST['sanitary_permit_valid']) ? 1 : 0;
        $building = !empty($_POST['building_permit_valid']) ? 1 : 0;
        $cctv = !empty($_POST['cctv_functioning']) ? 1 : 0;
        $score = min(100, max(0, (int)($_POST['compliance_score'] ?? 85)));
        $findings = trim($_POST['findings'] ?? '');
        $recs = trim($_POST['recommendations'] ?? '');

        if ($houseId <= 0) {
            Session::flash('error', 'Please select a boarding house.');
            redirect(url('housing/inspections'));
        }

        $grade = ($score >= 95) ? 'A' : (($score >= 85) ? 'B' : (($score >= 75) ? 'C' : 'F'));
        $rating = round($score / 20, 1);
        $userId = Auth::user()['id'] ?? null;
        $userName = (Auth::user()['first_name'] ?? 'Admin') . ' ' . (Auth::user()['last_name'] ?? 'Inspector');

        Database::insert('hsg_inspections', [
            'boarding_house_id'     => $houseId,
            'inspector_id'          => $userId,
            'inspector_name'        => $userName,
            'inspection_date'       => $date,
            'fire_safety_passed'    => $fire,
            'sanitary_permit_valid' => $sanitary,
            'building_permit_valid' => $building,
            'cctv_functioning'      => $cctv,
            'compliance_score'      => $score,
            'rating_grade'          => $grade,
            'findings'              => $findings,
            'recommendations'       => $recs,
            'next_inspection_date'  => date('Y-m-d', strtotime('+3 months')),
            'created_at'            => date('Y-m-d H:i:s')
        ]);

        // Update house safety rating & accreditation status
        $status = ($score >= 80) ? 'accredited' : (($score >= 70) ? 'probationary' : 'pending');
        Database::update('hsg_boarding_houses', [
            'safety_rating'        => $rating,
            'accreditation_status' => $status
        ], 'id = :id', ['id' => $houseId]);

        Session::flash('success', "Inspection audit logged with Grade {$grade} ({$score}/100)! Property rating updated.");
        redirect(url('housing/inspections'));
    }
}

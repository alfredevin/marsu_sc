<?php
/**
 * Module Seeder for University Health & Medical Consultation Clinic
 */

use Core\Database;

return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');
        $adminUser = Database::fetchOne("SELECT id FROM users WHERE username = 'admin' LIMIT 1");
        $adminId = $adminUser['id'] ?? 1;

        $sampleRecords = [
            ['title' => 'Initial Baseline Entry #1 - University Health & Medical Consultation Clinic', 'desc' => 'Verified record logged for Academic Year 2026-2027.', 'status' => 'active'],
            ['title' => 'Quarterly Evaluation Record #2 - University Health & Medical Consultation Clinic', 'desc' => 'Pending review by student affairs department supervisor.', 'status' => 'pending'],
            ['title' => 'Archived Legacy Documentation #3 - University Health & Medical Consultation Clinic', 'desc' => 'Historical transition log from previous university semester.', 'status' => 'archived'],
        ];

        foreach ($sampleRecords as $r) {
            Database::insert('hth_records', [
                'title'       => $r['title'],
                'description' => $r['desc'],
                'status'      => $r['status'],
                'created_by'  => $adminId,
                'created_at'  => $now
            ]);
        }
    }
};

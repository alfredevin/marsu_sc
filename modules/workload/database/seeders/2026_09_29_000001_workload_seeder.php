<?php
/**
 * Module Seeder for Faculty Teaching Workload Management
 */

use Core\Database;

return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');
        $adminUser = Database::fetchOne("SELECT id FROM users WHERE username = 'admin' LIMIT 1");
        $adminId = $adminUser['id'] ?? 1;

        $sampleRecords = [
            ['title' => 'Initial Baseline Entry #1 - Faculty Teaching Workload Management', 'desc' => 'Verified record logged for Academic Year 2026-2027.', 'status' => 'active'],
            ['title' => 'Quarterly Evaluation Record #2 - Faculty Teaching Workload Management', 'desc' => 'Pending review by student affairs department supervisor.', 'status' => 'pending'],
            ['title' => 'Archived Legacy Documentation #3 - Faculty Teaching Workload Management', 'desc' => 'Historical transition log from previous university semester.', 'status' => 'archived'],
        ];

        foreach ($sampleRecords as $r) {
            Database::insert('wkl_records', [
                'title'       => $r['title'],
                'description' => $r['desc'],
                'status'      => $r['status'],
                'created_by'  => $adminId,
                'created_at'  => $now
            ]);
        }
    }
};

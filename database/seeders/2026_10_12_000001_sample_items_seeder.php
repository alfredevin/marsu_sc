<?php
use Core\Database;

/**
 * Seeder: Populate sample records for 2-Field CRUD Demo
 */
return new class {
    public function run(): void {
        $now = date('Y-m-d H:i:s');
        $count = (int)Database::fetchColumn("SELECT COUNT(*) FROM sample_items");
        if ($count === 0) {
            Database::insert('sample_items', [
                'title'      => 'HDMI to VGA Projector Cable',
                'category'   => 'Equipment',
                'created_at' => $now
            ]);
            Database::insert('sample_items', [
                'title'      => 'Curriculum Checklist Handbook',
                'category'   => 'Academic',
                'created_at' => $now
            ]);
            Database::insert('sample_items', [
                'title'      => 'RFID Tap Card Reader',
                'category'   => 'Administrative',
                'created_at' => $now
            ]);
            Database::insert('sample_items', [
                'title'      => 'Whiteboard Marker Set',
                'category'   => 'Facilities',
                'created_at' => $now
            ]);
        }
    }
};

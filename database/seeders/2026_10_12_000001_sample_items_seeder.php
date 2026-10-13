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
                'title'      => 'Sample Item 1',
                'category'   => 'Academic',
                'created_at' => $now
            ]);
            Database::insert('sample_items', [
                'title'      => 'Sample Item 2',
                'category'   => 'Administrative',
                'created_at' => $now
            ]);
        }
    }
};

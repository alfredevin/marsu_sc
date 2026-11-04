<?php

use Core\Database;

return new class {
    public function run(): void
    {
        $positions = [
            ['name' => 'President', 'description' => 'Leads the organization and presides over its executive sessions.'],
            ['name' => 'Vice President', 'description' => 'Assists the president and coordinates organization operations.'],
            ['name' => 'Secretary', 'description' => 'Maintains official minutes, correspondence, and organization records.'],
            ['name' => 'Treasurer', 'description' => 'Maintains organization budgets and financial records.'],
            ['name' => 'Auditor', 'description' => 'Reviews financial records and supporting documents.'],
            ['name' => 'Public Information Officer', 'description' => 'Coordinates organization communications and announcements.'],
            ['name' => 'Business Manager', 'description' => 'Coordinates venues, logistics, and organization partnerships.'],
            ['name' => 'Peace Officer', 'description' => 'Supports order and safety during organization activities.'],
        ];

        foreach ($positions as $position) {
            $exists = Database::fetchOne(
                'SELECT position_id FROM `leadership_positions` WHERE position_name = :name LIMIT 1',
                ['name' => $position['name']]
            );
            if (!$exists) {
                Database::insert('leadership_positions', [
                    'position_name' => $position['name'],
                    'description' => $position['description'],
                ]);
            }
        }
    }
};

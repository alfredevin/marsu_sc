<?php

use Core\Database;

return new class {
    public function run(): void
    {
        $classifications = [
            ['name' => 'Academic', 'description' => 'Organizations focused on academic programs and professional learning.'],
            ['name' => 'Student Governance', 'description' => 'Organizations that represent or support student governance.'],
            ['name' => 'Special Interest', 'description' => 'Organizations formed around shared interests and campus communities.'],
        ];

        foreach ($classifications as $classification) {
            $exists = Database::fetchOne(
                'SELECT classification_id FROM `organization_classifications` WHERE classification_name = :name LIMIT 1',
                ['name' => $classification['name']]
            );
            if (!$exists) {
                Database::insert('organization_classifications', [
                    'classification_name' => $classification['name'],
                    'description' => $classification['description'],
                ]);
            }
        }
    }
};

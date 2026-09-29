<?php
namespace App\Models;

use Core\Database;

class Subject {
    public static function paginate(int $page = 1, int $perPage = 15, string $search = '', string $programFilter = ''): array {
        $offset = ($page - 1) * $perPage;
        $where = ["sub.deleted_at IS NULL"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(sub.code LIKE :q OR sub.title LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        if (!empty($programFilter)) {
            $where[] = "sub.program_id = :prog";
            $params['prog'] = $programFilter;
        }

        $whereClause = implode(' AND ', $where);

        $total = (int)Database::fetchColumn(
            "SELECT COUNT(*) FROM subjects sub WHERE {$whereClause}",
            $params
        );

        $sql = "SELECT sub.*, p.code as program_code, p.name as program_name 
                FROM subjects sub 
                LEFT JOIN programs p ON sub.program_id = p.id 
                WHERE {$whereClause} 
                ORDER BY sub.code ASC 
                LIMIT {$perPage} OFFSET {$offset}";

        $data = Database::fetchAll($sql, $params);

        return [
            'data'         => $data,
            'total'        => $total,
            'per_page'     => $perPage,
            'current_page' => $page,
            'last_page'    => (int)ceil($total / $perPage)
        ];
    }

    public static function all(): array {
        return Database::fetchAll(
            "SELECT sub.*, p.code as program_code 
             FROM subjects sub 
             LEFT JOIN programs p ON sub.program_id = p.id 
             WHERE sub.deleted_at IS NULL 
             ORDER BY sub.code ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT sub.*, p.code as program_code 
             FROM subjects sub 
             LEFT JOIN programs p ON sub.program_id = p.id 
             WHERE sub.id = :id AND sub.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('subjects', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('subjects', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('subjects', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }

    public static function bulkImport(array $rows): array {
        $imported = 0;
        $errors = [];
        $now = date('Y-m-d H:i:s');

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2; // account for header line
            $code = trim($row['code'] ?? '');
            $title = trim($row['title'] ?? '');
            $units = floatval($row['units'] ?? 3.0);
            $lec = floatval($row['lecture_hours'] ?? 3.0);
            $lab = floatval($row['lab_hours'] ?? 0.0);
            $progCode = trim($row['program_code'] ?? '');

            if (empty($code) || empty($title)) {
                $errors[] = "Row {$rowNum}: Subject code and title are required.";
                continue;
            }

            // Check if code exists
            $existing = Database::fetchOne("SELECT id FROM subjects WHERE code = :code AND deleted_at IS NULL", ['code' => $code]);
            if ($existing) {
                $errors[] = "Row {$rowNum}: Subject code '{$code}' already exists.";
                continue;
            }

            $progId = null;
            if (!empty($progCode)) {
                $p = Database::fetchOne("SELECT id FROM programs WHERE code = :code", ['code' => $progCode]);
                if ($p) $progId = $p['id'];
            }

            Database::insert('subjects', [
                'program_id'    => $progId,
                'code'          => $code,
                'title'         => $title,
                'units'         => $units,
                'lecture_hours' => $lec,
                'lab_hours'     => $lab,
                'status'        => 'active',
                'created_at'    => $now
            ]);
            $imported++;
        }

        return ['imported' => $imported, 'errors' => $errors];
    }
}

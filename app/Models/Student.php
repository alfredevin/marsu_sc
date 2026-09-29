<?php
namespace App\Models;

use Core\Database;

class Student {
    public static function paginate(
        int $page = 1, 
        int $perPage = 15, 
        string $search = '', 
        string $programFilter = '', 
        string $yearFilter = '',
        string $statusFilter = ''
    ): array {
        $offset = ($page - 1) * $perPage;
        $where = ["s.deleted_at IS NULL"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(s.student_number LIKE :q OR s.first_name LIKE :q OR s.last_name LIKE :q OR s.email LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        if (!empty($programFilter)) {
            $where[] = "s.program_id = :prog";
            $params['prog'] = $programFilter;
        }

        if (!empty($yearFilter)) {
            $where[] = "s.year_level = :yr";
            $params['yr'] = $yearFilter;
        }

        if (!empty($statusFilter)) {
            $where[] = "s.enrollment_status = :status";
            $params['status'] = $statusFilter;
        }

        $whereClause = implode(' AND ', $where);

        $total = (int)Database::fetchColumn(
            "SELECT COUNT(*) FROM students s WHERE {$whereClause}",
            $params
        );

        $sql = "SELECT s.*, p.code as program_code, p.name as program_name, sec.name as section_name 
                FROM students s 
                LEFT JOIN programs p ON s.program_id = p.id 
                LEFT JOIN sections sec ON s.section_id = sec.id 
                WHERE {$whereClause} 
                ORDER BY s.last_name ASC, s.first_name ASC 
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

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT s.*, p.code as program_code, p.name as program_name, sec.name as section_name 
             FROM students s 
             LEFT JOIN programs p ON s.program_id = p.id 
             LEFT JOIN sections sec ON s.section_id = sec.id 
             WHERE s.id = :id AND s.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function findByNumber(string $studentNumber): ?array {
        return Database::fetchOne(
            "SELECT * FROM students WHERE student_number = :sn AND deleted_at IS NULL LIMIT 1",
            ['sn' => $studentNumber]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('students', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('students', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('students', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }

    public static function countActive(): int {
        return (int)Database::fetchColumn("SELECT COUNT(*) FROM students WHERE deleted_at IS NULL");
    }

    public static function countByProgram(): array {
        return Database::fetchAll(
            "SELECT p.code as program_code, COUNT(s.id) as count 
             FROM programs p 
             LEFT JOIN students s ON p.id = s.program_id AND s.deleted_at IS NULL 
             WHERE p.deleted_at IS NULL 
             GROUP BY p.id ORDER BY count DESC"
        );
    }

    public static function countByYearLevel(): array {
        return Database::fetchAll(
            "SELECT CONCAT('Year ', year_level) as label, COUNT(*) as count 
             FROM students 
             WHERE deleted_at IS NULL 
             GROUP BY year_level ORDER BY year_level ASC"
        );
    }

    public static function bulkImport(array $rows): array {
        $imported = 0;
        $errors = [];
        $now = date('Y-m-d H:i:s');

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2;
            $sn = trim($row['student_number'] ?? '');
            $fn = trim($row['first_name'] ?? '');
            $ln = trim($row['last_name'] ?? '');
            $email = trim($row['email'] ?? '');
            $gender = strtolower(trim($row['gender'] ?? 'male'));
            $progCode = trim($row['program_code'] ?? '');
            $year = (int)($row['year_level'] ?? 1);
            $secName = trim($row['section_name'] ?? '');

            if (empty($sn) || empty($fn) || empty($ln) || empty($email)) {
                $errors[] = "Row {$rowNum}: Student number, first name, last name, and email are required.";
                continue;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Row {$rowNum}: Invalid email '{$email}'.";
                continue;
            }

            // Check duplicate
            $existing = Database::fetchOne("SELECT id FROM students WHERE (student_number = :sn OR email = :email) AND deleted_at IS NULL", [
                'sn'    => $sn,
                'email' => $email
            ]);
            if ($existing) {
                $errors[] = "Row {$rowNum}: Student number '{$sn}' or email '{$email}' already exists.";
                continue;
            }

            // Resolve program
            $progId = 1;
            if (!empty($progCode)) {
                $p = Database::fetchOne("SELECT id FROM programs WHERE code = :c", ['c' => $progCode]);
                if ($p) $progId = (int)$p['id'];
            }

            // Resolve section
            $secId = null;
            if (!empty($secName)) {
                $sec = Database::fetchOne("SELECT id FROM sections WHERE name = :n", ['n' => $secName]);
                if ($sec) $secId = (int)$sec['id'];
            }

            Database::insert('students', [
                'student_number'    => $sn,
                'first_name'        => $fn,
                'middle_name'       => $row['middle_name'] ?? null,
                'last_name'         => $ln,
                'suffix'            => $row['suffix'] ?? null,
                'gender'            => in_array($gender, ['male', 'female'], true) ? $gender : 'male',
                'birthdate'         => !empty($row['birthdate']) ? date('Y-m-d', strtotime($row['birthdate'])) : null,
                'email'             => $email,
                'contact_number'    => $row['contact_number'] ?? null,
                'address'           => $row['address'] ?? null,
                'program_id'        => $progId,
                'year_level'        => $year,
                'section_id'        => $secId,
                'enrollment_status' => $row['enrollment_status'] ?? 'enrolled',
                'guardian_name'     => $row['guardian_name'] ?? null,
                'guardian_contact'  => $row['guardian_contact'] ?? null,
                'created_at'        => $now
            ]);

            $imported++;
        }

        return ['imported' => $imported, 'errors' => $errors];
    }
}

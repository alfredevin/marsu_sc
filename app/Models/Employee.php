<?php
namespace App\Models;

use Core\Database;

class Employee {
    public static function paginate(
        int $page = 1, 
        int $perPage = 15, 
        string $search = '', 
        string $deptFilter = '', 
        string $typeFilter = '',
        string $statusFilter = ''
    ): array {
        $offset = ($page - 1) * $perPage;
        $where = ["e.deleted_at IS NULL"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(e.employee_number LIKE :q OR e.first_name LIKE :q OR e.last_name LIKE :q OR e.email LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        if (!empty($deptFilter)) {
            $where[] = "e.department_id = :dept";
            $params['dept'] = $deptFilter;
        }

        if (!empty($typeFilter)) {
            $where[] = "e.type = :type";
            $params['type'] = $typeFilter;
        }

        if (!empty($statusFilter)) {
            $where[] = "e.status = :status";
            $params['status'] = $statusFilter;
        }

        $whereClause = implode(' AND ', $where);

        $total = (int)Database::fetchColumn(
            "SELECT COUNT(*) FROM employees e WHERE {$whereClause}",
            $params
        );

        $sql = "SELECT e.*, d.name as department_name, d.code as department_code 
                FROM employees e 
                LEFT JOIN departments d ON e.department_id = d.id 
                WHERE {$whereClause} 
                ORDER BY e.last_name ASC, e.first_name ASC 
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
            "SELECT e.*, d.name as department_name 
             FROM employees e 
             LEFT JOIN departments d ON e.department_id = d.id 
             WHERE e.deleted_at IS NULL 
             ORDER BY e.last_name ASC, e.first_name ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne(
            "SELECT e.*, d.name as department_name 
             FROM employees e 
             LEFT JOIN departments d ON e.department_id = d.id 
             WHERE e.id = :id AND e.deleted_at IS NULL LIMIT 1",
            ['id' => $id]
        );
    }

    public static function create(array $data): int {
        $data['created_at'] = date('Y-m-d H:i:s');
        return Database::insert('employees', $data);
    }

    public static function update(int $id, array $data): void {
        $data['updated_at'] = date('Y-m-d H:i:s');
        Database::update('employees', $data, 'id = :id', ['id' => $id]);
    }

    public static function softDelete(int $id): void {
        Database::update('employees', ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
    }

    public static function countActive(): int {
        return (int)Database::fetchColumn("SELECT COUNT(*) FROM employees WHERE deleted_at IS NULL");
    }

    public static function countByDepartment(): array {
        return Database::fetchAll(
            "SELECT d.code as department_code, COUNT(e.id) as count 
             FROM departments d 
             LEFT JOIN employees e ON d.id = e.department_id AND e.deleted_at IS NULL 
             WHERE d.deleted_at IS NULL 
             GROUP BY d.id ORDER BY count DESC"
        );
    }

    public static function countByRank(): array {
        return Database::fetchAll(
            "SELECT COALESCE(e.rank, 'Unranked / Staff') as label, COUNT(e.id) as count 
             FROM employees e 
             WHERE e.deleted_at IS NULL AND e.type = 'faculty'
             GROUP BY e.rank ORDER BY count DESC LIMIT 6"
        );
    }

    public static function bulkImport(array $rows): array {
        $imported = 0;
        $errors = [];
        $now = date('Y-m-d H:i:s');

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2;
            $en = trim($row['employee_number'] ?? '');
            $fn = trim($row['first_name'] ?? '');
            $ln = trim($row['last_name'] ?? '');
            $email = trim($row['email'] ?? '');
            $type = strtolower(trim($row['type'] ?? 'faculty'));
            $position = trim($row['position'] ?? 'Instructor I');
            $deptCode = trim($row['department_code'] ?? '');

            if (empty($en) || empty($fn) || empty($ln) || empty($email)) {
                $errors[] = "Row {$rowNum}: Employee number, first name, last name, and email are required.";
                continue;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Row {$rowNum}: Invalid email '{$email}'.";
                continue;
            }

            // Check duplicate
            $existing = Database::fetchOne("SELECT id FROM employees WHERE (employee_number = :en OR email = :email) AND deleted_at IS NULL", [
                'en'    => $en,
                'email' => $email
            ]);
            if ($existing) {
                $errors[] = "Row {$rowNum}: Employee number '{$en}' or email '{$email}' already exists.";
                continue;
            }

            $deptId = 1;
            if (!empty($deptCode)) {
                $d = Database::fetchOne("SELECT id FROM departments WHERE code = :c", ['c' => $deptCode]);
                if ($d) $deptId = (int)$d['id'];
            }

            Database::insert('employees', [
                'employee_number' => $en,
                'first_name'      => $fn,
                'middle_name'     => $row['middle_name'] ?? null,
                'last_name'       => $ln,
                'suffix'          => $row['suffix'] ?? null,
                'gender'          => in_array(strtolower($row['gender'] ?? ''), ['male', 'female'], true) ? strtolower($row['gender']) : 'male',
                'email'           => $email,
                'contact_number'  => $row['contact_number'] ?? null,
                'type'            => in_array($type, ['faculty', 'staff', 'admin'], true) ? $type : 'faculty',
                'position'        => $position,
                'rank'            => $row['rank'] ?? 'Permanent',
                'department_id'   => $deptId,
                'status'          => $row['status'] ?? 'active',
                'created_at'      => $now
            ]);

            $imported++;
        }

        return ['imported' => $imported, 'errors' => $errors];
    }
}

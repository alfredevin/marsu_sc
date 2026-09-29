<?php
namespace App\Models;

use Core\Database;

class AuditLog {
    public static function paginate(int $page = 1, int $perPage = 20, string $search = '', string $actionFilter = ''): array {
        $offset = ($page - 1) * $perPage;
        $where = ["1=1"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(a.action LIKE :q OR a.entity LIKE :q OR u.username LIKE :q OR a.ip_address LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        if (!empty($actionFilter)) {
            $where[] = "a.action LIKE :act";
            $params['act'] = "%{$actionFilter}%";
        }

        $whereClause = implode(' AND ', $where);

        $total = (int)Database::fetchColumn(
            "SELECT COUNT(*) FROM audit_logs a LEFT JOIN users u ON a.user_id = u.id WHERE {$whereClause}",
            $params
        );

        $sql = "SELECT a.*, u.username, u.first_name, u.last_name 
                FROM audit_logs a 
                LEFT JOIN users u ON a.user_id = u.id 
                WHERE {$whereClause} 
                ORDER BY a.created_at DESC 
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

    public static function recent(int $limit = 8): array {
        return Database::fetchAll(
            "SELECT a.*, u.username, u.first_name, u.last_name 
             FROM audit_logs a 
             LEFT JOIN users u ON a.user_id = u.id 
             ORDER BY a.created_at DESC LIMIT {$limit}"
        );
    }
}

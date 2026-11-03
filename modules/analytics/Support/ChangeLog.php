<?php
namespace Modules\Analytics\Support;

use Core\Auth;
use Core\Database;

/**
 * Audit history for the Analytics module. `ana_change_log` is the only audit table.
 */
class ChangeLog
{
    public static function record(
        string $entity,
        int $entityId,
        string $action,
        ?string $field = null,
        ?string $oldValue = null,
        ?string $newValue = null,
        ?string $reason = null
    ): int {
        $id = Database::insert('ana_change_log', [
            'entity'     => $entity,
            'entity_id'  => $entityId,
            'action'     => $action,
            'field'      => $field,
            'old_value'  => $oldValue,
            'new_value'  => $newValue,
            'reason'     => $reason,
            'changed_by' => Auth::id() ? (int) Auth::id() : null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (class_exists(\Core\Logger::class) && method_exists(\Core\Logger::class, 'audit')) {
            try {
                \Core\Logger::audit("analytics.{$action}", $entity, $entityId, [
                    'field' => $field, 'old' => $oldValue, 'new' => $newValue, 'reason' => $reason,
                ]);
            } catch (\Throwable $e) {
            }
        }

        return $id;
    }

    public static function forEntity(string $entity, int $entityId): array
    {
        return Database::fetchAll(
            "SELECT cl.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name, u.email AS user_email
             FROM `ana_change_log` cl
             LEFT JOIN `users` u ON cl.changed_by = u.id
             WHERE cl.entity = :entity AND cl.entity_id = :id
             ORDER BY cl.id DESC",
            ['entity' => $entity, 'id' => $entityId]
        );
    }

    public static function recent(int $limit = 50, ?string $entity = null): array
    {
        $limit = max(1, min(500, $limit));
        $where = '';
        $params = [];
        if ($entity !== null && $entity !== '') {
            $where = 'WHERE cl.entity = :entity';
            $params['entity'] = $entity;
        }
        return Database::fetchAll(
            "SELECT cl.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name, u.email AS user_email
             FROM `ana_change_log` cl
             LEFT JOIN `users` u ON cl.changed_by = u.id
             {$where}
             ORDER BY cl.id DESC
             LIMIT {$limit}",
            $params
        );
    }
}

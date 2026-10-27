<?php
namespace Modules\Retention\Support;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Retention Audit and Governance Change Log Helper
 * Tracks modifications to classes, grading requests, attendance voids, and conduct reclassifications.
 */
class ChangeLog
{
    /**
     * Record an administrative or faculty governance event.
     */
    public static function record(
        string $entity,
        int $entityId,
        string $action,
        ?string $field = null,
        ?string $oldValue = null,
        ?string $newValue = null,
        ?string $reason = null
    ): int {
        $userId = Auth::id() ? (int) Auth::id() : null;

        $id = Database::insert('ret_change_log', [
            'entity'     => $entity,
            'entity_id'  => $entityId,
            'action'     => $action,
            'field'      => $field,
            'old_value'  => $oldValue,
            'new_value'  => $newValue,
            'reason'     => $reason,
            'changed_by' => $userId,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Integrate with core Logger::audit if available
        if (class_exists(\Core\Logger::class) && method_exists(\Core\Logger::class, 'audit')) {
            try {
                \Core\Logger::audit(
                    "retention.{$action}",
                    $entity,
                    $entityId,
                    [
                        'field'  => $field,
                        'old'    => $oldValue,
                        'new'    => $newValue,
                        'reason' => $reason,
                    ]
                );
            } catch (\Throwable $e) {}
        }

        return (int) $id;
    }

    /**
     * Fetch change log history for a specific entity.
     */
    public static function forEntity(string $entity, int $entityId): array
    {
        try {
            return Database::fetchAll(
                "SELECT cl.*, CONCAT(u.first_name, ' ', u.last_name) as user_name, u.email as user_email 
                 FROM `ret_change_log` cl 
                 LEFT JOIN `users` u ON cl.changed_by = u.id 
                 WHERE cl.entity = :entity AND cl.entity_id = :id 
                 ORDER BY cl.id DESC",
                ['entity' => $entity, 'id' => $entityId]
            );
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Fetch recent audit change entries across all retention entities.
     */
    public static function recent(int $limit = 50): array
    {
        $limit = max(1, min(200, (int) $limit));
        try {
            return Database::fetchAll(
                "SELECT cl.*, CONCAT(u.first_name, ' ', u.last_name) as user_name, u.email as user_email 
                 FROM `ret_change_log` cl 
                 LEFT JOIN `users` u ON cl.changed_by = u.id 
                 ORDER BY cl.id DESC LIMIT {$limit}"
            );
        } catch (\Throwable $e) {
            return [];
        }
    }
}

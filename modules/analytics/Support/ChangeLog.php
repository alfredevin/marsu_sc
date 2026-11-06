<?php
namespace Modules\Analytics\Support;

use Core\Database;
use Core\Logger;

/**
 * Audit history for the Analytics module, kept in the core `audit_logs` table.
 * Actions are stored as `analytics.<action>`; field, old/new value and reason go in `details`.
 */
class ChangeLog
{
    public const ACTION_PREFIX = 'analytics.';

    public static function record(
        string $entity,
        int $entityId,
        string $action,
        ?string $field = null,
        ?string $oldValue = null,
        ?string $newValue = null,
        ?string $reason = null
    ): void {
        Logger::audit(self::ACTION_PREFIX . $action, $entity, $entityId, [
            'field' => $field, 'old' => $oldValue, 'new' => $newValue, 'reason' => $reason,
        ]);
    }

    /**
     * Columns that present an audit_logs row (alias `al`) in the shape the change-log views use.
     */
    public const COLUMNS = "al.id, al.entity, al.entity_id, SUBSTRING(al.action, 11) AS action,
        JSON_UNQUOTE(JSON_EXTRACT(al.details, '$.field')) AS field,
        JSON_UNQUOTE(JSON_EXTRACT(al.details, '$.old')) AS old_value,
        JSON_UNQUOTE(JSON_EXTRACT(al.details, '$.new')) AS new_value,
        JSON_UNQUOTE(JSON_EXTRACT(al.details, '$.reason')) AS reason,
        al.user_id AS changed_by, al.created_at,
        CONCAT(u.first_name, ' ', u.last_name) AS user_name, u.email AS user_email";

    /**
     * SQL source for analytics audit rows; append extra conditions with AND.
     */
    public const FROM = " FROM `audit_logs` al LEFT JOIN `users` u ON al.user_id = u.id WHERE al.action LIKE 'analytics.%'";

    public static function forEntity(string $entity, int $entityId): array
    {
        return self::clean(Database::fetchAll(
            "SELECT " . self::COLUMNS . self::FROM . " AND al.entity = :entity AND al.entity_id = :id ORDER BY al.id DESC",
            ['entity' => $entity, 'id' => $entityId]
        ));
    }

    public static function recent(int $limit = 50, ?string $entity = null): array
    {
        $limit = max(1, min(500, $limit));
        $where = '';
        $params = [];
        if ($entity !== null && $entity !== '') {
            $where = ' AND al.entity = :entity';
            $params['entity'] = $entity;
        }
        return self::clean(Database::fetchAll(
            "SELECT " . self::COLUMNS . self::FROM . $where . " ORDER BY al.id DESC LIMIT {$limit}",
            $params
        ));
    }

    /**
     * JSON null comes back as the text 'null'; present it as a real null.
     */
    public static function clean(array $rows): array
    {
        foreach ($rows as &$r) {
            foreach (['field', 'old_value', 'new_value', 'reason'] as $k) {
                if (($r[$k] ?? null) === 'null') {
                    $r[$k] = null;
                }
            }
        }
        return $rows;
    }
}

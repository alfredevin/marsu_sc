<?php
namespace Modules\Analytics\Support;

use Core\Auth;
use Core\Database;

/**
 * Academic Analytics policy settings, read exclusively from `ana_settings`.
 * A key that is not configured returns null; callers display "Not configured"
 * instead of assuming a value.
 */
class AnalyticsSettings
{
    private static ?array $cache = null;

    private static function loadCache(): void
    {
        if (self::$cache !== null) {
            return;
        }
        self::$cache = [];
        foreach (Database::fetchAll("SELECT `key`, `value`, `type` FROM `ana_settings`") as $row) {
            if ($row['value'] === '' || $row['value'] === null) {
                continue;
            }
            self::$cache[$row['key']] = self::castValue($row['value'], $row['type']);
        }
    }

    private static function castValue(mixed $val, string $type): mixed
    {
        return match ($type) {
            'int'     => (int) $val,
            'decimal' => (float) $val,
            'bool'    => (bool) (int) $val,
            default   => (string) $val,
        };
    }

    public static function get(string $key): mixed
    {
        self::loadCache();
        return self::$cache[$key] ?? null;
    }

    public static function isConfigured(string $key): bool
    {
        return self::get($key) !== null;
    }

    public static function all(): array
    {
        return Database::fetchAll("SELECT * FROM `ana_settings` ORDER BY `id` ASC");
    }

    /**
     * Update a setting value with min/max validation. Returns false when the key
     * is unknown or the value is out of range.
     */
    public static function set(string $key, mixed $val, ?int $updatedBy = null): bool
    {
        $row = Database::fetchOne("SELECT * FROM `ana_settings` WHERE `key` = :key LIMIT 1", ['key' => $key]);
        if (!$row) {
            return false;
        }

        if (is_numeric($val)) {
            $num = (float) $val;
            if ($row['min_value'] !== null && $num < (float) $row['min_value']) {
                return false;
            }
            if ($row['max_value'] !== null && $num > (float) $row['max_value']) {
                return false;
            }
        }

        $stored = match ($row['type']) {
            'bool'    => ($val ? '1' : '0'),
            'int'     => (string) (int) $val,
            'decimal' => (string) (float) $val,
            default   => trim((string) $val),
        };

        Database::update(
            'ana_settings',
            ['value' => $stored, 'updated_by' => $updatedBy ?? Auth::id(), 'updated_at' => date('Y-m-d H:i:s')],
            '`key` = :key',
            ['key' => $key]
        );

        if (self::$cache !== null) {
            self::$cache[$key] = self::castValue($stored, $row['type']);
        }
        return true;
    }

    /**
     * Maximum allowed absences for a class given the number of sessions held,
     * or null when the absence ratio is not configured.
     */
    public static function allowedAbsences(int $sessionsHeld): ?int
    {
        $ratio = self::get('attendance.max_absence_ratio');
        if ($ratio === null) {
            return null;
        }
        return (int) floor($sessionsHeld * (float) $ratio);
    }
}

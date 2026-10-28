<?php
namespace Modules\Retention\Support;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Retention Policy Settings Engine
 * Manages institutional policy parameters, numeric ranges, and dynamic fallbacks.
 */
class RetentionSettings
{
    private static ?array $cache = null;

    private static array $defaults = [
        'attendance.max_absence_ratio'        => 0.20,
        'attendance.min_allowable_cuts'        => 3,
        'attendance.late_weight'               => 0.75,
        'attendance.critical_rate'             => 80.0,
        'attendance.monitored_rate'            => 88.0,
        'attendance.absence_warning_count'     => 4,
        'grading.default_passing_cutoff'       => 3.04,
        'grading.allow_faculty_custom_weights' => true,
        'grading.inc_removal_days'             => 365,
        'analytics.bottleneck_passing_rate'    => 85.0,
    ];

    /**
     * Load all settings from the database and populate internal cache.
     */
    private static function loadCache(): void
    {
        if (self::$cache !== null) {
            return;
        }

        self::$cache = [];
        try {
            $rows = Database::fetchAll("SELECT * FROM `ret_settings`");
            foreach ($rows as $row) {
                self::$cache[$row['key']] = self::castValue($row['value'], $row['type']);
            }
        } catch (\Throwable $e) {
            // If table does not exist yet during initial setup, fallback to defaults
            self::$cache = [];
        }
    }

    /**
     * Cast raw string value to its specified schema type.
     */
    private static function castValue(mixed $val, string $type): mixed
    {
        return match ($type) {
            'int'     => (int) $val,
            'decimal' => (float) $val,
            'bool'    => (bool) (int) $val,
            default   => (string) $val,
        };
    }

    /**
     * Retrieve a setting value by key with safe fallback.
     */
    public static function get(string $key, mixed $fallback = null): mixed
    {
        self::loadCache();

        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        if ($fallback !== null) {
            return $fallback;
        }

        return self::$defaults[$key] ?? null;
    }

    /**
     * Fetch all setting rows for admin governance display.
     */
    public static function all(): array
    {
        try {
            return Database::fetchAll("SELECT * FROM `ret_settings` ORDER BY `id` ASC");
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Update a setting value with min/max constraint validation.
     */
    public static function set(string $key, mixed $val, ?int $updatedBy = null): bool
    {
        $row = Database::fetchOne("SELECT * FROM `ret_settings` WHERE `key` = :key LIMIT 1", ['key' => $key]);
        if (!$row) {
            return false;
        }

        $type = $row['type'];
        $numericVal = is_numeric($val) ? (float) $val : null;

        if ($numericVal !== null) {
            if ($row['min_value'] !== null && $numericVal < (float) $row['min_value']) {
                return false;
            }
            if ($row['max_value'] !== null && $numericVal > (float) $row['max_value']) {
                return false;
            }
        }

        $valToStore = match ($type) {
            'bool'    => ($val ? '1' : '0'),
            'int'     => (string) (int) $val,
            'decimal' => (string) (float) $val,
            default   => trim((string) $val),
        };

        Database::update(
            'ret_settings',
            [
                'value'      => $valToStore,
                'updated_by' => $updatedBy ?? Auth::id(),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            '`key` = :key',
            ['key' => $key]
        );

        if (self::$cache !== null) {
            self::$cache[$key] = self::castValue($valToStore, $type);
        }

        return true;
    }
}

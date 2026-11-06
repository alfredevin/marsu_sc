<?php
namespace Modules\Analytics\Support;

use Core\Database;

/**
 * Academic Analytics policy settings. Values live in the core `settings` table
 * (group `analytics`, keys prefixed `analytics.`); the type, label and allowed range
 * of each setting are defined here. A key without a stored value returns null;
 * callers display "Not configured" instead of assuming a value.
 */
class AnalyticsSettings
{
    public const GROUP = 'analytics';

    public const DEFINITIONS = [
        'attendance.max_absence_ratio' => [
            'type' => 'decimal', 'default' => '0.20', 'min' => 0.05, 'max' => 0.50,
            'label' => 'Maximum Absence Ratio',
            'description' => 'Ratio of total sessions determining allowable cuts (e.g. 0.20 = 20% of class meetings)',
        ],
        'attendance.min_allowable_cuts' => [
            'type' => 'int', 'default' => '3', 'min' => 1, 'max' => 10,
            'label' => 'Minimum Allowable Cuts',
            'description' => 'Absolute minimum allowable unexcused absences before critical absence risk',
        ],
        'attendance.late_weight' => [
            'type' => 'decimal', 'default' => '0.75', 'min' => 0.00, 'max' => 1.00,
            'label' => 'Late Attendance Credit Weight',
            'description' => 'Proportionate attendance credit awarded for a Late status (0.00 to 1.00)',
        ],
        'attendance.critical_rate' => [
            'type' => 'decimal', 'default' => '80.0', 'min' => 50, 'max' => 100,
            'label' => 'Critical Attendance Rate (%)',
            'description' => 'Attendance percentage threshold below which a student is flagged as Critical Risk',
        ],
        'attendance.monitored_rate' => [
            'type' => 'decimal', 'default' => '88.0', 'min' => 50, 'max' => 100,
            'label' => 'Monitored Attendance Rate (%)',
            'description' => 'Attendance percentage threshold below which a student is placed on Monitored status',
        ],
        'attendance.absence_warning_count' => [
            'type' => 'int', 'default' => '4', 'min' => 1, 'max' => 20,
            'label' => 'Absence Warning Cutoff Count',
            'description' => 'Unexcused absence count that sends the student an in-app absence warning',
        ],
        'grading.default_passing_cutoff' => [
            'type' => 'decimal', 'default' => '3.04', 'min' => 1.00, 'max' => 5.00,
            'label' => 'Default Passing Grade Cutoff',
            'description' => 'Maximum numerical grade considered passing (Philippine 1.00 - 5.00 grading scale)',
        ],
        'grading.allow_faculty_custom_weights' => [
            'type' => 'bool', 'default' => '1', 'min' => 0, 'max' => 1,
            'label' => 'Allow Faculty Weight Customization',
            'description' => 'Permits faculty members to adjust category percentage weights when creating or configuring classes',
        ],
        'grading.inc_removal_days' => [
            'type' => 'int', 'default' => '365', 'min' => 30, 'max' => 730,
            'label' => 'Incomplete (INC) Removal Period (Days)',
            'description' => 'Calendar days allowed for students to complete requirements and resolve an INC mark',
        ],
        'analytics.bottleneck_passing_rate' => [
            'type' => 'decimal', 'default' => '85.0', 'min' => 50, 'max' => 95,
            'label' => 'Curricular Bottleneck Threshold (%)',
            'description' => 'Course passing rate below which a subject is tagged as a prerequisite bottleneck',
        ],
    ];

    private static ?array $cache = null;

    /**
     * Key of a setting in the core `settings` table (other modules share that table).
     */
    public static function storageKey(string $key): string
    {
        return str_starts_with($key, 'analytics.') ? $key : 'analytics.' . $key;
    }

    private static function stored(): array
    {
        $rows = [];
        foreach (Database::fetchAll("SELECT `id`, `key`, `value`, `updated_at` FROM `settings` WHERE `group` = :g", ['g' => self::GROUP]) as $r) {
            $rows[$r['key']] = $r;
        }
        return $rows;
    }

    private static function loadCache(): void
    {
        if (self::$cache !== null) {
            return;
        }
        self::$cache = [];
        $stored = self::stored();
        foreach (self::DEFINITIONS as $key => $def) {
            $value = $stored[self::storageKey($key)]['value'] ?? null;
            if ($value === '' || $value === null) {
                continue;
            }
            self::$cache[$key] = self::castValue($value, $def['type']);
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

    /**
     * Every setting with its definition and stored value, in definition order.
     */
    public static function all(): array
    {
        $stored = self::stored();
        $out = [];
        foreach (self::DEFINITIONS as $key => $def) {
            $row = $stored[self::storageKey($key)] ?? null;
            $out[] = [
                'id'          => $row ? (int) $row['id'] : 0,
                'key'         => $key,
                'value'       => $row['value'] ?? '',
                'type'        => $def['type'],
                'label'       => $def['label'],
                'description' => $def['description'],
                'min_value'   => $def['min'],
                'max_value'   => $def['max'],
                'updated_at'  => $row['updated_at'] ?? null,
            ];
        }
        return $out;
    }

    /**
     * Store a setting after type and range validation. Returns false when the key
     * is unknown or the value is invalid. Who changed it is recorded by the caller through ChangeLog.
     */
    public static function set(string $key, mixed $val): bool
    {
        $def = self::DEFINITIONS[$key] ?? null;
        if (!$def) {
            return false;
        }
        // Numeric settings never store text (it would silently become 0)
        if (in_array($def['type'], ['int', 'decimal'], true) && !is_numeric($val)) {
            return false;
        }
        if (is_numeric($val) && ((float) $val < (float) $def['min'] || (float) $val > (float) $def['max'])) {
            return false;
        }

        $stored = match ($def['type']) {
            'bool'    => ($val ? '1' : '0'),
            'int'     => (string) (int) $val,
            'decimal' => (string) (float) $val,
            default   => trim((string) $val),
        };

        Database::query(
            "INSERT INTO `settings` (`key`, `value`, `group`, `created_at`) VALUES (:k, :v, :g, NOW())
             ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = NOW()",
            ['k' => self::storageKey($key), 'v' => $stored, 'g' => self::GROUP]
        );

        if (self::$cache !== null) {
            self::$cache[$key] = self::castValue($stored, $def['type']);
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

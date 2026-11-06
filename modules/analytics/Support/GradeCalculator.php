<?php
namespace Modules\Analytics\Support;

/**
 * The only place grades are computed (Philippine 1.00 - 5.00 scale).
 *
 * Item transmutation: 5.00 - 4.00 * clamp(score / maxScore, 0, 1)
 * Group share:        average(transmuted components) * weight / 100
 * Final grade:        sum of group shares, PASSED when <= passing cutoff
 * Excused items and groups with no recorded attendance sessions are left out of the average.
 * Exam groups (isExam: Midterm / Finals) keep a fixed set of columns in the Grades Tracking matrix.
 * INC / DRP are faculty-assigned marks that replace the numeric result when posting.
 */
class GradeCalculator
{
    public const MARKS = ['INC', 'DRP'];

    /**
     * Normalize template/class schemes (older ones use name/label instead of title).
     */
    public static function normalizeScheme(?array $scheme, float $fallbackCutoff): array
    {
        $scheme = is_array($scheme) ? $scheme : [];
        $groups = [];
        foreach (($scheme['groups'] ?? []) as $i => $g) {
            $items = [];
            foreach (($g['items'] ?? []) as $it) {
                $code = trim((string) ($it['code'] ?? ''));
                if ($code === '') {
                    continue;
                }
                $items[] = [
                    'code'     => $code,
                    'title'    => (string) ($it['title'] ?? $it['label'] ?? $code),
                    'maxScore' => max(0.01, (float) ($it['maxScore'] ?? 100)),
                    'dueDate'  => $it['dueDate'] ?? null,
                ];
            }
            $title = (string) ($g['title'] ?? $g['name'] ?? ('Group ' . ($i + 1)));
            $groups[] = [
                'id'            => (string) ($g['id'] ?? ('grp_' . $i)),
                'title'         => $title,
                'weight'        => (float) ($g['weight'] ?? 0),
                'hasAttendance' => !empty($g['hasAttendance']),
                'isExam'        => array_key_exists('isExam', $g) ? !empty($g['isExam']) : (bool) preg_match('/\bexam|midterm|final/i', $title),
                'items'         => $items,
            ];
        }
        return [
            'name'          => (string) ($scheme['name'] ?? 'Class Grading Scheme'),
            'passingCutoff' => (float) ($scheme['passingCutoff'] ?? $fallbackCutoff),
            'groups'        => $groups,
        ];
    }

    /**
     * Validate a submitted scheme (template, class form or Grades Tracking) before it is stored.
     * Returns ['scheme' => normalized] or ['error' => message].
     */
    public static function validateScheme(?array $raw, float $fallbackCutoff): array
    {
        $raw = is_array($raw) ? $raw : [];
        foreach (($raw['groups'] ?? []) as $g) {
            if (!is_numeric($g['weight'] ?? null) || (float) $g['weight'] <= 0 || (float) $g['weight'] > 100) {
                return ['error' => 'Every component weight must be a number above 0 and at most 100.'];
            }
            foreach (($g['items'] ?? []) as $it) {
                $max = $it['maxScore'] ?? null;
                if (!is_numeric($max) || (float) $max <= 0 || (float) $max > 1000) {
                    return ['error' => "Max score of '" . ($it['code'] ?? '?') . "' must be more than 0 and at most 1000."];
                }
            }
        }

        $scheme = self::normalizeScheme($raw, $fallbackCutoff);
        if (!$scheme['groups']) {
            return ['error' => 'Add at least one assessment component.'];
        }
        $total = array_sum(array_column($scheme['groups'], 'weight'));
        if (abs($total - 100.0) > 0.01) {
            return ['error' => "Component weights must total 100%. Current total: {$total}%."];
        }
        $attGroups = array_filter($scheme['groups'], fn($g) => $g['hasAttendance']);
        if (count($attGroups) > 1) {
            return ['error' => 'Attendance can count toward one component only.'];
        }
        if (array_filter($attGroups, fn($g) => $g['isExam'])) {
            return ['error' => 'Attendance cannot count toward an exam component.'];
        }
        $codes = [];
        foreach ($scheme['groups'] as $g) {
            if (trim($g['title']) === '' || mb_strlen($g['title']) > 100) {
                return ['error' => 'Each component needs a title of up to 100 characters.'];
            }
            if (!$g['items'] && !$g['hasAttendance']) {
                return ['error' => "{$g['title']} needs at least one task column."];
            }
            foreach ($g['items'] as $it) {
                $key = strtoupper($it['code']);
                if (!preg_match('/^[A-Za-z0-9_\-]{1,32}$/', $it['code']) || isset($codes[$key])) {
                    return ['error' => "Task code '{$it['code']}' is invalid or used twice."];
                }
                $codes[$key] = true;
            }
        }
        if ($scheme['passingCutoff'] < 1.0 || $scheme['passingCutoff'] > 5.0) {
            return ['error' => 'The passing cutoff must be between 1.00 and 5.00.'];
        }
        return ['scheme' => $scheme];
    }

    public static function items(array $scheme): array
    {
        $items = [];
        foreach ($scheme['groups'] as $g) {
            foreach ($g['items'] as $it) {
                $items[$it['code']] = $it;
            }
        }
        return $items;
    }

    public static function transmuteItem(float $score, float $maxScore): float
    {
        if ($maxScore <= 0) {
            return 5.00;
        }
        $ratio = max(0.0, min(1.0, $score / $maxScore));
        return round(5.00 - (4.00 * $ratio), 2);
    }

    /**
     * Late weight comes from settings; when it is not configured a late is counted as present.
     */
    public static function lateWeight(): float
    {
        $w = AnalyticsSettings::get('attendance.late_weight');
        return $w === null ? 1.0 : (float) $w;
    }

    public static function attendanceRate(array $att): ?float
    {
        $total = (int) ($att['total'] ?? 0);
        if ($total <= 0) {
            return null;
        }
        $effective = (int) ($att['present'] ?? 0) + ((int) ($att['late'] ?? 0) * self::lateWeight()) + (int) ($att['excused'] ?? 0);
        return max(0.0, min(1.0, $effective / $total));
    }

    public static function transmuteAttendance(array $att): ?float
    {
        $rate = self::attendanceRate($att);
        return $rate === null ? null : round(5.00 - (4.00 * $rate), 2);
    }

    /**
     * @param array $scores   [item_code => float]
     * @param array $statuses [item_code => submitted|late|missing|excused]
     * @param array $att      ['present','late','excused','absent','total']
     */
    public static function computeStudent(array $scheme, array $scores, array $statuses = [], array $att = []): array
    {
        $final = 0.0;
        $groups = [];
        $itemTrans = [];

        foreach ($scheme['groups'] as $g) {
            $sum = 0.0;
            $count = 0;
            foreach ($g['items'] as $it) {
                $code = $it['code'];
                $trans = self::transmuteItem((float) ($scores[$code] ?? 0), (float) $it['maxScore']);
                $itemTrans[$code] = $trans;
                if (($statuses[$code] ?? null) === 'excused') {
                    continue;
                }
                $sum += $trans;
                $count++;
            }
            $attTrans = null;
            if ($g['hasAttendance']) {
                $attTrans = self::transmuteAttendance($att);
                if ($attTrans !== null) {
                    $sum += $attTrans;
                    $count++;
                }
            }
            $avg = $count > 0 ? $sum / $count : 5.00;
            $share = $avg * ($g['weight'] / 100.0);
            $final += $share;
            $groups[$g['id']] = ['avg_trans' => round($avg, 2), 'share' => round($share, 2), 'att_trans' => $attTrans];
        }

        $rounded = round($final, 2);
        return [
            'computed_grade' => $rounded,
            'final_grade'    => number_format($rounded, 2, '.', ''),
            'remarks'        => $rounded <= $scheme['passingCutoff'] ? 'PASSED' : 'FAILED',
            'groups'         => $groups,
            'items'          => $itemTrans,
        ];
    }

    /**
     * Apply a faculty INC / DRP mark over the numeric result.
     */
    public static function applyMark(array $result, ?string $mark): array
    {
        if ($mark === 'INC' || $mark === 'DRP') {
            $result['final_grade'] = $mark;
            $result['remarks'] = $mark;
        }
        return $result;
    }

    /**
     * General weighted average over numeric grades only (INC / DRP excluded).
     * Rows need `final_grade` and `units`.
     */
    public static function gwa(array $rows): ?float
    {
        $weighted = 0.0;
        $units = 0.0;
        foreach ($rows as $r) {
            if (!is_numeric($r['final_grade'] ?? null)) {
                continue;
            }
            $u = (float) ($r['units'] ?? 0);
            if ($u <= 0) {
                continue;
            }
            $weighted += (float) $r['final_grade'] * $u;
            $units += $u;
        }
        return $units > 0 ? round($weighted / $units, 2) : null;
    }
}

<?php
namespace Modules\Retention\Support;

use Core\View;
use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Grade Calculator
 * Direct PHP 8 port of the institutional grading formulas and transmutation rules.
 */
class GradeCalculator
{
    /**
     * Compute transmutation grade on the Philippine 1.00 - 5.00 scale.
     * Formula: 5.00 - (4.00 * clamp(score / maxScore, 0, 1))
     */
    public static function transmuteItem(float $score, float $maxScore): float
    {
        if ($maxScore <= 0) {
            return 5.00;
        }

        $ratio = max(0.0, min(1.0, $score / $maxScore));
        $transmuted = 5.00 - (4.00 * $ratio);
        return round($transmuted, 2);
    }

    /**
     * Compute attendance component transmutation score.
     */
    public static function transmuteAttendance(int $present, int $late, int $excused, int $total): float
    {
        if ($total <= 0) {
            return 1.00; // Perfect attendance credit when no sessions yet recorded
        }

        $lateWeight = (float) RetentionSettings::get('attendance.late_weight', 0.75);
        $effectivePresent = $present + ($late * $lateWeight) + $excused;
        $ratio = max(0.0, min(1.0, $effectivePresent / $total));

        $transmuted = 5.00 - (4.00 * $ratio);
        return round($transmuted, 2);
    }

    /**
     * Compute complete class grades from scheme, raw scores, and attendance.
     *
     * @param array $scheme Grading scheme array (with groups, weights, items, passingCutoff)
     * @param array $scoresByStudent Array format: [$studentId => ['item_code' => score, ...]]
     * @param array $attendanceByStudent Array format: [$studentId => ['present' => P, 'late' => L, 'excused' => E, 'total' => T]]
     * @return array Map of student computations: [$studentId => ['computed_grade' => float, 'final_grade' => string, 'remarks' => string, 'groups' => array]]
     */
    public static function computeClassGrades(array $scheme, array $scoresByStudent, array $attendanceByStudent = []): array
    {
        $passingCutoff = (float) ($scheme['passingCutoff'] ?? RetentionSettings::get('grading.default_passing_cutoff', 3.04));
        $groups = $scheme['groups'] ?? [];
        $results = [];

        foreach ($scoresByStudent as $studentId => $rawScores) {
            $studentId = (int) $studentId;
            $overallFinalGrade = 0.0;
            $groupDetails = [];

            foreach ($groups as $grp) {
                $grpWeight = (float) ($grp['weight'] ?? 0);
                $grpItems = $grp['items'] ?? [];
                $hasAttendance = !empty($grp['hasAttendance']);

                $groupComponentsTotalTrans = 0.0;
                $componentCount = 0;

                // 1. Process items in this assessment group
                foreach ($grpItems as $item) {
                    $itemCode = $item['code'];
                    $maxScore = (float) ($item['maxScore'] ?? 100);
                    $scoreVal = isset($rawScores[$itemCode]) ? (float) $rawScores[$itemCode] : 0.0;

                    $trans = self::transmuteItem($scoreVal, $maxScore);
                    $groupComponentsTotalTrans += $trans;
                    $componentCount++;
                }

                // 2. Process attendance if attached to this group
                if ($hasAttendance) {
                    $attData = $attendanceByStudent[$studentId] ?? ['present' => 0, 'late' => 0, 'excused' => 0, 'total' => 0];
                    $attTrans = self::transmuteAttendance(
                        (int) ($attData['present'] ?? 0),
                        (int) ($attData['late'] ?? 0),
                        (int) ($attData['excused'] ?? 0),
                        (int) ($attData['total'] ?? 0)
                    );
                    $groupComponentsTotalTrans += $attTrans;
                    $componentCount++;
                }

                $avgTrans = ($componentCount > 0) ? ($groupComponentsTotalTrans / $componentCount) : 5.00;
                $share = $avgTrans * ($grpWeight / 100.0);
                $overallFinalGrade += $share;

                $groupDetails[$grp['id'] ?? 'g'] = [
                    'avg_trans' => round($avgTrans, 2),
                    'share'     => round($share, 2),
                    'weight'    => $grpWeight,
                ];
            }

            $roundedFinal = round($overallFinalGrade, 2);
            $isPassed = ($roundedFinal <= $passingCutoff);

            $results[$studentId] = [
                'computed_grade' => $roundedFinal,
                'final_grade'    => number_format($roundedFinal, 2, '.', ''),
                'remarks'        => $isPassed ? 'PASSED' : 'FAILED',
                'groups'         => $groupDetails,
            ];
        }

        return $results;
    }
}

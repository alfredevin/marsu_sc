<?php
namespace Modules\Analytics\Support;

use Core\Auth;

/**
 * Small HTML helpers shared by the Analytics views. Every dynamic value is escaped.
 */
class Ui
{
    public static function emptyState(string $title, string $message, string $icon = 'bi-inbox', ?string $actionUrl = null, ?string $actionText = null): string
    {
        $action = '';
        if ($actionUrl && $actionText) {
            $action = '<a href="' . e($actionUrl) . '" class="btn btn-marsu btn-sm mt-1"><i class="bi bi-plus-circle me-1"></i>' . e($actionText) . '</a>';
        }
        return '<div class="text-center py-5 px-3">'
            . '<i class="bi ' . e($icon) . ' text-secondary d-block mb-2" style="font-size:2.5rem"></i>'
            . '<h6 class="fw-bold mb-1">' . e($title) . '</h6>'
            . '<p class="text-secondary small mb-2 mx-auto" style="max-width:480px">' . e($message) . '</p>'
            . $action . '</div>';
    }

    public static function privacyNotice(): string
    {
        ob_start();
        include dirname(__DIR__) . '/Views/partials/privacy_notice.php';
        return (string) ob_get_clean();
    }

    public static function readonlyBanner(string $message): string
    {
        return '<div class="alert alert-info border-start border-4 border-info d-flex align-items-center py-2 px-3 mb-3" role="alert">'
            . '<i class="bi bi-eye-fill fs-5 me-3"></i><div class="small"><strong class="d-block">Read-only</strong>'
            . e($message) . '</div></div>';
    }

    public static function gradeStatusBadge(?string $status): string
    {
        return match ($status) {
            'posted' => '<span class="badge bg-success-subtle text-success-emphasis border border-success-subtle"><i class="bi bi-check-circle me-1"></i>Posted</span>',
            'locked' => '<span class="badge bg-secondary-subtle text-secondary-emphasis border border-secondary-subtle"><i class="bi bi-lock me-1"></i>Locked</span>',
            default  => '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"><i class="bi bi-pencil me-1"></i>Draft</span>',
        };
    }

    public static function remarksBadge(?string $remarks): string
    {
        return match ($remarks) {
            'PASSED' => '<span class="badge bg-success">PASSED</span>',
            'FAILED' => '<span class="badge bg-danger">FAILED</span>',
            'INC'    => '<span class="badge bg-warning text-dark">INC</span>',
            'DRP'    => '<span class="badge bg-secondary">DRP</span>',
            default  => '<span class="badge bg-light text-secondary border">—</span>',
        };
    }

    public static function enrollmentBadge(?string $status): string
    {
        return match ($status) {
            'enrolled'  => '<span class="badge bg-success-subtle text-success-emphasis border border-success-subtle">Enrolled</span>',
            'pending'   => '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Pending</span>',
            'withdrawn' => '<span class="badge bg-secondary-subtle text-secondary-emphasis border border-secondary-subtle">Withdrawn</span>',
            'cancelled' => '<span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle">Cancelled</span>',
            default     => '<span class="badge bg-light text-secondary border">Not enrolled</span>',
        };
    }

    public static function attendanceBadge(?string $status): string
    {
        return match ($status) {
            'Present' => '<span class="badge bg-success">P</span>',
            'Late'    => '<span class="badge bg-warning text-dark">L</span>',
            'Excused' => '<span class="badge bg-info text-dark">E</span>',
            'Absent'  => '<span class="badge bg-danger">A</span>',
            default   => '<span class="text-secondary">·</span>',
        };
    }

    public static function pct(?float $ratio, int $decimals = 1): string
    {
        return $ratio === null ? '—' : number_format($ratio * 100, $decimals) . '%';
    }

    public static function fullName(array $row): string
    {
        $mi = !empty($row['middle_name']) ? ' ' . mb_substr($row['middle_name'], 0, 1) . '.' : '';
        return trim(($row['last_name'] ?? '') . ', ' . ($row['first_name'] ?? '') . $mi);
    }

    /**
     * Page header with the module bar (persona switcher + notifications).
     */
    public static function header(string $title, string $subtitle = '', string $icon = 'bi-graph-up-arrow', string $actionsHtml = ''): string
    {
        return '<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 pb-3 mb-3 border-bottom">'
            . '<div><h4 class="fw-bold mb-1 text-marsu-burgundy"><i class="bi ' . e($icon) . ' me-2"></i>' . e($title) . '</h4>'
            . ($subtitle !== '' ? '<div class="text-secondary small">' . e($subtitle) . '</div>' : '')
            . '</div><div class="d-flex flex-wrap align-items-center gap-2">' . $actionsHtml . self::moduleBar() . '</div></div>';
    }

    public static function moduleBar(): string
    {
        $userId = (int) Auth::id();
        if (!$userId) {
            return '';
        }
        $personas = AnalyticsAccess::personas();
        $current = AnalyticsAccess::persona();
        $html = '';

        if (count($personas) > 1) {
            $label = $personas[$current]['label'] ?? 'Workspace';
            $html .= '<div class="dropdown"><button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">'
                . '<i class="bi bi-person-gear me-1"></i>' . e($label) . '</button><ul class="dropdown-menu dropdown-menu-end shadow-sm">';
            foreach ($personas as $key => $p) {
                $html .= '<li><form method="POST" action="' . e(url('analytics/persona')) . '">' . csrf_field()
                    . '<input type="hidden" name="persona" value="' . e($key) . '">'
                    . '<button type="submit" class="dropdown-item' . ($key === $current ? ' active' : '') . '"><i class="bi ' . e($p['icon']) . ' me-2"></i>' . e($p['label']) . '</button></form></li>';
            }
            $html .= '</ul></div>';
        }

        $unread = Notifier::unreadCount($userId);
        $html .= '<a href="' . e(url('analytics/notifications')) . '" class="btn btn-sm btn-outline-secondary position-relative" title="Notifications">'
            . '<i class="bi bi-bell"></i>'
            . ($unread > 0 ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . ($unread > 99 ? '99+' : $unread) . '</span>' : '')
            . '</a>';
        return $html;
    }

    public static function termSelect(array $terms, ?int $selected, string $name = 'term'): string
    {
        $html = '<select name="' . e($name) . '" class="form-select form-select-sm" onchange="this.form.submit()">';
        foreach ($terms as $t) {
            $sel = ((int) $t['semester_id'] === (int) $selected) ? ' selected' : '';
            $html .= '<option value="' . (int) $t['semester_id'] . '"' . $sel . '>' . e($t['label']) . '</option>';
        }
        return $html . '</select>';
    }

    /**
     * Pagination math compatible with render_pagination().
     */
    public static function paginate(int $total, int $perPage = 25): array
    {
        $last = max(1, (int) ceil($total / $perPage));
        $page = min($last, max(1, (int) ($_GET['page'] ?? 1)));
        return ['current_page' => $page, 'last_page' => $last, 'per_page' => $perPage, 'offset' => ($page - 1) * $perPage, 'total' => $total];
    }

    /**
     * Current GET parameters minus `page`, for pagination links.
     */
    public static function queryParams(array $keys): array
    {
        $out = [];
        foreach ($keys as $k) {
            if (isset($_GET[$k]) && $_GET[$k] !== '') {
                $out[$k] = (string) $_GET[$k];
            }
        }
        return $out;
    }

    public static function chartScript(string $canvasId, array $config): string
    {
        return '<script>document.addEventListener("DOMContentLoaded",function(){var el=document.getElementById(' . json_encode($canvasId) . ');'
            . 'if(el&&window.Chart){new Chart(el,' . json_encode($config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ');}});</script>';
    }

    public static function confirmScript(): string
    {
        return <<<'HTML'
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (ev) {
            if (form.dataset.confirmed === '1') { return; }
            ev.preventDefault();
            var text = form.dataset.confirm;
            var go = function () { form.dataset.confirmed = '1'; form.submit(); };
            if (window.Swal) {
                Swal.fire({ title: 'Please confirm', text: text, icon: 'question', showCancelButton: true,
                    confirmButtonColor: '#800020', confirmButtonText: 'Yes, continue' })
                    .then(function (r) { if (r.isConfirmed) { go(); } });
            } else if (window.confirm(text)) {
                go();
            }
        });
    });
});
</script>
HTML;
    }
}

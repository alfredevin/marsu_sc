<?php
use Modules\Analytics\Support\Ui;

$classId = (int) $class['id'];
$scheme = $record['scheme'];
$isDraft = $class['grade_status'] === 'draft';
$tabUrl = fn(string $t) => url('analytics/faculty/classes/' . $classId . '/classroom', ['tab' => $t]);
$base = 'analytics/faculty/classes/' . $classId;

$actions = '<a href="' . e(url('analytics/faculty/classes')) . '" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>My Classes</a>'
    . '<a href="' . e(url($base)) . '" class="btn btn-sm btn-marsu"><i class="bi bi-file-earmark-spreadsheet me-1"></i>Open class record</a>';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($class['subject_code'] . ' · ' . $class['subject_title'],
        $class['section_name'] . ' · ' . trim(($class['semester_name'] ?? '') . ' ' . ($class['academic_year_label'] ?? '')) . ($class['schedule'] ? ' · ' . $class['schedule'] : '') . ($class['room'] ? ' · ' . $class['room'] : ''),
        'bi-easel', $actions) ?>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-2 d-flex flex-wrap align-items-center gap-2 small">
            <span>Class code:</span>
            <code class="fs-6 fw-bold px-2 py-1 bg-body-tertiary rounded" id="classCode"><?= e($class['class_code'] ?? '—') ?></code>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="copyCode" title="Copy class code"><i class="bi bi-clipboard"></i></button>
            <?= Ui::gradeStatusBadge($class['grade_status']) ?>
            <span class="badge bg-light text-dark border">Task scores <?= $class['scores_visible'] ? 'visible' : 'hidden' ?> to students</span>
        </div>
    </div>

    <?= Ui::privacyNotice() ?>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link <?= $tab === 'stream' ? 'active' : '' ?>" href="<?= e($tabUrl('stream')) ?>"><i class="bi bi-megaphone me-1"></i>Stream</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab === 'roster' ? 'active' : '' ?>" href="<?= e($tabUrl('roster')) ?>"><i class="bi bi-people me-1"></i>Roster &amp; join requests <span class="badge bg-secondary"><?= count($record['roster']) ?></span><?php if ($joinRequests): ?> <span class="badge bg-danger"><?= count($joinRequests) ?></span><?php endif; ?></a></li>
        <li class="nav-item"><a class="nav-link <?= $tab === 'settings' ? 'active' : '' ?>" href="<?= e($tabUrl('settings')) ?>"><i class="bi bi-sliders me-1"></i>Settings</a></li>
    </ul>

    <?php if ($tab === 'roster'): ?>
        <?php include __DIR__ . '/partials/roster_tab.php'; ?>
    <?php elseif ($tab === 'settings'): ?>
        <?php include __DIR__ . '/partials/settings_tab.php'; ?>
    <?php else: ?>
        <?php include __DIR__ . '/partials/stream_tab.php'; ?>
    <?php endif; ?>
</div>
<?= Ui::confirmScript() ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('copyCode');
    if (btn) {
        btn.addEventListener('click', function () {
            var code = document.getElementById('classCode').textContent.trim();
            navigator.clipboard.writeText(code).then(function () {
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Class code copied', showConfirmButton: false, timer: 1500 });
            });
        });
    }
});
</script>

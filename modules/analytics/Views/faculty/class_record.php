<?php
use Modules\Analytics\Support\Ui;

$classId = (int) $class['id'];
$scheme = $record['scheme'];
$isDraft = $class['grade_status'] === 'draft';
$isPublished = in_array($class['grade_status'], ['posted', 'locked'], true);
$tabUrl = fn(string $t) => url('analytics/faculty/classes/' . $classId, ['tab' => $t]);
$base = 'analytics/faculty/classes/' . $classId;

$actions = '<a href="' . e(url('analytics/faculty/classes')) . '" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>My Classes</a>';
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header($class['subject_code'] . ' · ' . $class['subject_title'],
        $class['section_name'] . ' · ' . trim(($class['semester_name'] ?? '') . ' ' . ($class['academic_year_label'] ?? '')) . ($class['schedule'] ? ' · ' . $class['schedule'] : '') . ($class['room'] ? ' · ' . $class['room'] : ''),
        'bi-journal-text', $actions) ?>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-2 d-flex flex-wrap align-items-center gap-2 small">
            <span>Class code:</span>
            <code class="fs-6 fw-bold px-2 py-1 bg-body-tertiary rounded" id="classCode"><?= e($class['class_code'] ?? '—') ?></code>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="copyCode" title="Copy class code"><i class="bi bi-clipboard"></i></button>
            <?= Ui::gradeStatusBadge($class['grade_status']) ?>
            <span class="badge bg-light text-dark border">Passing ≤ <?= number_format($scheme['passingCutoff'], 2) ?></span>
            <span class="badge bg-light text-dark border">Task scores <?= $class['scores_visible'] ? 'visible' : 'hidden' ?> to students</span>
            <div class="ms-auto d-flex flex-wrap gap-2">
                <?php if ($isDraft): ?>
                    <form method="POST" action="<?= url($base . '/post') ?>" data-confirm="Post final grades for <?= e($class['subject_code']) ?>? Students will see them and editing will lock until a correction request is approved.">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-marsu" type="submit"><i class="bi bi-send-check me-1"></i>Post grades</button>
                    </form>
                <?php elseif ($class['grade_status'] === 'posted' && !$pendingCorrection): ?>
                    <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#correctionForm"><i class="bi bi-arrow-counterclockwise me-1"></i>Request correction</button>
                <?php elseif ($pendingCorrection): ?>
                    <span class="badge bg-warning text-dark align-self-center">Correction request pending review</span>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($class['grade_status'] === 'posted' && !$pendingCorrection): ?>
            <div class="collapse" id="correctionForm">
                <form method="POST" action="<?= url($base . '/correction-request') ?>" class="card-body border-top">
                    <?= csrf_field() ?>
                    <label class="form-label small fw-semibold">Why do posted grades need correcting? (min 10 characters)</label>
                    <textarea name="reason" class="form-control form-control-sm mb-2" rows="3" minlength="10" required></textarea>
                    <button class="btn btn-sm btn-warning" type="submit">Send to administrator</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <?= Ui::privacyNotice() ?>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link <?= $tab === 'record' ? 'active' : '' ?>" href="<?= e($tabUrl('record')) ?>"><i class="bi bi-table me-1"></i>Class record</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab === 'roster' ? 'active' : '' ?>" href="<?= e($tabUrl('roster')) ?>"><i class="bi bi-people me-1"></i>Roster <span class="badge bg-secondary"><?= count($record['roster']) ?></span><?php if ($joinRequests): ?> <span class="badge bg-danger"><?= count($joinRequests) ?></span><?php endif; ?></a></li>
        <li class="nav-item"><a class="nav-link <?= $tab === 'stream' ? 'active' : '' ?>" href="<?= e($tabUrl('stream')) ?>"><i class="bi bi-megaphone me-1"></i>Stream</a></li>
        <li class="nav-item"><a class="nav-link <?= $tab === 'settings' ? 'active' : '' ?>" href="<?= e($tabUrl('settings')) ?>"><i class="bi bi-sliders me-1"></i>Settings</a></li>
    </ul>

    <?php if ($tab === 'record'): ?>
        <?php include __DIR__ . '/partials/record_tab.php'; ?>
    <?php elseif ($tab === 'roster'): ?>
        <?php include __DIR__ . '/partials/roster_tab.php'; ?>
    <?php elseif ($tab === 'stream'): ?>
        <?php include __DIR__ . '/partials/stream_tab.php'; ?>
    <?php else: ?>
        <?php include __DIR__ . '/partials/settings_tab.php'; ?>
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
                if (window.Swal) { Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Class code copied', showConfirmButton: false, timer: 1500 }); }
            });
        });
    }
});
</script>

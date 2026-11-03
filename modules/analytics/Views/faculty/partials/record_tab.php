<?php
use Modules\Analytics\Support\GradeCalculator;
use Modules\Analytics\Support\Ui;

$dates = $record['dates'];
?>
<?php if (empty($scheme['groups'])): ?>
    <div class="card border-0 shadow-sm"><?= Ui::emptyState('No grading components', 'Define components and tasks in the Settings tab first.', 'bi-sliders', $tabUrl('settings'), 'Open settings') ?></div>
<?php elseif (empty($record['roster'])): ?>
    <div class="card border-0 shadow-sm"><?= Ui::emptyState('No students on the roster', 'Add registrar-enrolled students from the Roster tab, or share the class code.', 'bi-people', $tabUrl('roster'), 'Open roster') ?></div>
<?php else: ?>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2 small">
        <div class="text-secondary">
            Item grade = 5 − 4 × (score ÷ max). Component share = average × weight. Sessions recorded: <?= count($dates) ?>.
            <?php if ($isDraft): ?>Scores save automatically; grades below are recomputed on the server.<?php endif; ?>
        </div>
        <span id="saveStatus" class="badge bg-light text-secondary border"><i class="bi bi-cloud-check me-1"></i>Saved</span>
    </div>
    <div class="table-responsive bg-body rounded shadow-sm" style="max-height:70vh">
        <table class="table table-sm table-bordered align-middle mb-0 small text-center">
            <thead class="table-light sticky-top">
                <tr>
                    <th rowspan="2" class="text-start" style="min-width:190px">Student</th>
                    <?php foreach ($scheme['groups'] as $g): ?>
                        <th colspan="<?= count($g['items']) + ($g['hasAttendance'] ? 1 : 0) + 1 ?>"><?= e($g['title']) ?> (<?= e((string) $g['weight']) ?>%)</th>
                    <?php endforeach; ?>
                    <th rowspan="2">Grade</th><th rowspan="2">Remarks</th><th rowspan="2">Mark</th>
                </tr>
                <tr>
                    <?php foreach ($scheme['groups'] as $g): ?>
                        <?php foreach ($g['items'] as $it): ?>
                            <th title="<?= e($it['title']) ?><?= $it['dueDate'] ? ' · due ' . e($it['dueDate']) : '' ?>"><?= e($it['code']) ?><div class="fw-normal text-secondary">/<?= e((string) $it['maxScore']) ?></div></th>
                        <?php endforeach; ?>
                        <?php if ($g['hasAttendance']): ?><th>Att.</th><?php endif; ?>
                        <th>Share</th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($record['roster'] as $r):
                    $sid = (int) $r['student_id'];
                    $comp = $record['computed'][$sid];
                    $posted = $isPublished ? ($record['posted'][$sid] ?? null) : null;
                    $att = $record['attendance'][$sid] ?? null;
                ?>
                    <tr data-sid="<?= $sid ?>">
                        <td class="text-start">
                            <a href="<?= url('analytics/faculty/students/' . $sid) ?>" class="fw-semibold text-decoration-none"><?= e(Ui::fullName($r)) ?></a>
                            <div class="text-secondary"><?= e($r['student_number']) ?> · <?= e($r['program_code'] ?? '') ?></div>
                        </td>
                        <?php foreach ($scheme['groups'] as $g): ?>
                            <?php foreach ($g['items'] as $it):
                                $code = $it['code'];
                                $val = $record['scores'][$sid][$code] ?? null;
                                $st = $record['statuses'][$sid][$code] ?? null;
                            ?>
                                <td>
                                    <?php if ($isDraft): ?>
                                        <input type="number" class="form-control form-control-sm text-center score-input" style="width:68px"
                                               step="any" min="0" max="<?= e((string) $it['maxScore']) ?>"
                                               value="<?= $val === null ? '' : e((string) $val) ?>"
                                               data-sid="<?= $sid ?>" data-code="<?= e($code) ?>" aria-label="<?= e($code . ' score for ' . $r['last_name']) ?>">
                                    <?php else: ?>
                                        <?= $val === null ? '—' : e((string) $val) ?>
                                    <?php endif; ?>
                                    <?php if ($st && $st !== 'submitted'): ?><div class="text-secondary" style="font-size:10px"><?= e($st) ?></div><?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                            <?php if ($g['hasAttendance']): ?><td><?= Ui::pct($att ? GradeCalculator::attendanceRate($att) : null, 0) ?></td><?php endif; ?>
                            <td class="fw-semibold" data-share="<?= e($g['id']) ?>"><?= number_format($comp['groups'][$g['id']]['share'] ?? 0, 2) ?></td>
                        <?php endforeach; ?>
                        <?php if ($posted): ?>
                            <td class="fw-bold"><?= e($posted['final_grade']) ?></td>
                            <td><?= Ui::remarksBadge($posted['remarks']) ?>
                                <?php if ($posted['remarks'] === 'INC' && !$posted['inc_resolved_at']): ?>
                                    <div class="text-secondary" style="font-size:10px">Due <?= e($posted['inc_deadline'] ?? 'not configured') ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($posted['remarks'] === 'INC' && !$posted['inc_resolved_at']): ?>
                                    <form method="POST" action="<?= url($base . '/inc/resolve') ?>" class="d-flex gap-1 justify-content-center">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="student_id" value="<?= $sid ?>">
                                        <input type="number" name="resolved_grade" step="0.01" min="1" max="5" required class="form-control form-control-sm" style="width:72px" placeholder="Grade" aria-label="Completed grade">
                                        <button class="btn btn-sm btn-outline-success" type="submit" title="Resolve INC"><i class="bi bi-check2"></i></button>
                                    </form>
                                <?php else: ?>—<?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class="fw-bold" data-final><?= e($comp['final_grade']) ?></td>
                            <td data-remarks><?= Ui::remarksBadge($comp['remarks']) ?></td>
                            <td>
                                <?php if ($isDraft): ?>
                                    <form method="POST" action="<?= url($base . '/roster/mark') ?>">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="student_id" value="<?= $sid ?>">
                                        <select name="mark" class="form-select form-select-sm" style="width:80px" onchange="this.form.submit()" aria-label="Grade mark">
                                            <option value="">—</option>
                                            <option value="INC" <?= $r['grade_mark'] === 'INC' ? 'selected' : '' ?>>INC</option>
                                            <option value="DRP" <?= $r['grade_mark'] === 'DRP' ? 'selected' : '' ?>>DRP</option>
                                        </select>
                                    </form>
                                <?php else: ?><?= e($r['grade_mark'] ?? '—') ?><?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($isDraft): ?>
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-transparent fw-semibold small">Submission status (late / missing / excused)</div>
            <form method="POST" action="<?= url($base . '/task-exception') ?>" class="card-body row g-2 align-items-end small">
                <?= csrf_field() ?>
                <div class="col-sm-4"><label class="form-label mb-1">Student</label>
                    <select name="student_id" class="form-select form-select-sm" required>
                        <?php foreach ($record['roster'] as $r): ?><option value="<?= (int) $r['student_id'] ?>"><?= e(Ui::fullName($r)) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="col-sm-3"><label class="form-label mb-1">Task</label>
                    <select name="item_code" class="form-select form-select-sm" required>
                        <?php foreach (GradeCalculator::items($scheme) as $it): ?><option value="<?= e($it['code']) ?>"><?= e($it['code'] . ' — ' . $it['title']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="col-sm-3"><label class="form-label mb-1">Status</label>
                    <select name="submission_status" class="form-select form-select-sm">
                        <option value="submitted">Submitted</option><option value="late">Late</option><option value="missing">Missing</option><option value="excused">Excused (left out of grade)</option>
                    </select></div>
                <div class="col-sm-2"><button class="btn btn-sm btn-outline-secondary w-100" type="submit">Save status</button></div>
            </form>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var url = <?= json_encode(url($base . '/scores')) ?>;
            var token = <?= json_encode(csrf_token()) ?>;
            var pending = {};
            var timer = null;
            var status = document.getElementById('saveStatus');
            var remarks = { PASSED: '<span class="badge bg-success">PASSED</span>', FAILED: '<span class="badge bg-danger">FAILED</span>',
                            INC: '<span class="badge bg-warning text-dark">INC</span>', DRP: '<span class="badge bg-secondary">DRP</span>' };

            function setStatus(cls, html) { status.className = 'badge ' + cls; status.innerHTML = html; }

            function flush() {
                var batch = Object.values(pending);
                if (!batch.length) { return; }
                pending = {};
                setStatus('bg-warning-subtle text-warning-emphasis border', '<span class="spinner-border spinner-border-sm me-1"></span>Saving');
                fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token }, body: JSON.stringify({ scores: batch }) })
                    .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
                    .then(function (res) {
                        if (!res.ok) { throw new Error(res.d.message || 'Save failed'); }
                        Object.keys(res.d.rows || {}).forEach(function (sid) {
                            var row = document.querySelector('tr[data-sid="' + sid + '"]');
                            var data = res.d.rows[sid];
                            if (!row || !data) { return; }
                            row.querySelector('[data-final]').textContent = data.final_grade;
                            row.querySelector('[data-remarks]').innerHTML = remarks[data.remarks] || '';
                            Object.keys(data.groups).forEach(function (gid) {
                                var cell = row.querySelector('[data-share="' + CSS.escape(gid) + '"]');
                                if (cell) { cell.textContent = Number(data.groups[gid].share).toFixed(2); }
                            });
                        });
                        if (res.d.errors && res.d.errors.length) {
                            setStatus('bg-danger-subtle text-danger-emphasis border', '<i class="bi bi-exclamation-circle me-1"></i>' + res.d.errors.length + ' not saved');
                            if (window.Swal) { Swal.fire({ icon: 'warning', title: 'Some scores were not saved', text: res.d.errors.join('\n') }); }
                        } else {
                            setStatus('bg-light text-secondary border', '<i class="bi bi-cloud-check me-1"></i>Saved');
                        }
                    })
                    .catch(function (err) {
                        batch.forEach(function (b) { pending[b.student_id + ':' + b.item_code] = b; });
                        setStatus('bg-danger-subtle text-danger-emphasis border', '<i class="bi bi-wifi-off me-1"></i>Not saved');
                        if (window.Swal) { Swal.fire({ icon: 'error', title: 'Scores not saved', text: err.message }); }
                    });
            }

            document.querySelectorAll('.score-input').forEach(function (input) {
                input.addEventListener('change', function () {
                    var max = parseFloat(input.max);
                    var v = input.value.trim();
                    if (v !== '' && (isNaN(parseFloat(v)) || parseFloat(v) < 0 || parseFloat(v) > max)) {
                        input.classList.add('is-invalid');
                        return;
                    }
                    input.classList.remove('is-invalid');
                    pending[input.dataset.sid + ':' + input.dataset.code] = { student_id: Number(input.dataset.sid), item_code: input.dataset.code, score: v === '' ? null : Number(v) };
                    setStatus('bg-warning-subtle text-warning-emphasis border', 'Unsaved changes');
                    clearTimeout(timer);
                    timer = setTimeout(flush, 800);
                });
            });
            window.addEventListener('beforeunload', function (e) { if (Object.keys(pending).length) { flush(); e.preventDefault(); } });
        });
        </script>
    <?php endif; ?>
<?php endif; ?>

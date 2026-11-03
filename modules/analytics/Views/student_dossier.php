<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header(Ui::fullName($student), $student['student_number'] . ' · ' . ($student['program_code'] ?? '') . ' · Year ' . (int) $student['year_level'], 'bi-person-vcard',
        '<a href="' . e(url('analytics/students')) . '" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Students</a>') ?>
    <?= Ui::privacyNotice() ?>

    <div class="row g-3 mb-3">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Master record</div>
                <div class="card-body small">
                    <dl class="row mb-0">
                        <dt class="col-5">Student number</dt><dd class="col-7"><?= e($student['student_number']) ?></dd>
                        <dt class="col-5">Program</dt><dd class="col-7"><?= e($student['program_name'] ?? '—') ?></dd>
                        <dt class="col-5">Section</dt><dd class="col-7"><?= e($student['section_name'] ?? '—') ?></dd>
                        <dt class="col-5">Gender</dt><dd class="col-7"><?= e(ucfirst((string) $student['gender'])) ?></dd>
                        <dt class="col-5">Birthdate</dt><dd class="col-7"><?= e($student['birthdate'] ?? '—') ?></dd>
                        <dt class="col-5">Email</dt><dd class="col-7"><?= e($student['email']) ?></dd>
                        <dt class="col-5">Contact</dt><dd class="col-7"><?= e($student['contact_number'] ?? '—') ?></dd>
                        <dt class="col-5">Registry status</dt><dd class="col-7"><?= e(ucfirst(str_replace('_', ' ', (string) $student['enrollment_status']))) ?></dd>
                        <dt class="col-5">Login account</dt><dd class="col-7"><?= $student['user_id'] ? 'Linked' : '<span class="text-danger">Not linked</span>' ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold d-flex justify-content-between">
                    <span>Supplementary profile</span>
                    <?php if (can('analytics.admin.profiles')): ?>
                        <a href="<?= url('analytics/admin/profiles/' . (int) $student['id']) ?>" class="small">Edit</a>
                    <?php endif; ?>
                </div>
                <div class="card-body small">
                    <?php if (!$profile): ?>
                        <p class="text-secondary mb-0">No supplementary profile has been recorded.</p>
                    <?php else: ?>
                        <dl class="row mb-0">
                            <dt class="col-6">Living arrangement</dt><dd class="col-6"><?= e(ucwords(str_replace('_', ' ', $profile['living_arrangement']))) ?></dd>
                            <dt class="col-6">Commute</dt><dd class="col-6"><?= e(ucfirst($profile['commute_category'])) ?></dd>
                            <dt class="col-6">Working student</dt><dd class="col-6"><?= $profile['is_working_student'] ? 'Yes' : 'No' ?></dd>
                            <dt class="col-6">Scholar</dt><dd class="col-6"><?= $profile['is_scholar'] ? e($profile['scholarship_name'] ?: 'Yes') : 'No' ?></dd>
                            <dt class="col-6">First-generation</dt><dd class="col-6"><?= $profile['is_first_generation'] ? 'Yes' : 'No' ?></dd>
                        </dl>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-transparent fw-semibold">Term enrollment history</div>
        <?php if (empty($enrollments)): ?>
            <?= Ui::emptyState('No term enrollments', 'The Registrar has not enrolled this student in any term.', 'bi-calendar-x') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm mb-0 small align-middle">
                <thead class="table-light"><tr><th>Term</th><th>Program</th><th>Year</th><th>Section</th><th>Subjects</th><th>Units</th><th>Status</th><th>GWA (posted)</th></tr></thead>
                <tbody>
                <?php foreach ($enrollments as $en): $label = $en['semester_name'] . ', ' . $en['academic_year_label']; ?>
                    <tr>
                        <td><?= e($label) ?></td><td><?= e($en['program_code']) ?></td><td><?= (int) $en['year_level'] ?></td>
                        <td><?= e($en['section_name'] ?? '—') ?></td><td><?= (int) $en['subject_count'] ?></td><td><?= e($en['total_units']) ?></td>
                        <td><?= Ui::enrollmentBadge($en['status']) ?></td>
                        <td><?= isset($gwa[$label]) && $gwa[$label] !== null ? number_format($gwa[$label], 2) : '—' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table></div>
        <?php endif; ?>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-transparent fw-semibold">Classes, scores and grades</div>
        <div class="card-body">
            <?php if (empty($classes)): ?>
                <?= Ui::emptyState('Not on any class roster', 'This student has not been added to a faculty class roster.', 'bi-collection') ?>
            <?php endif; ?>
            <?php foreach ($classes as $c): $cl = $c['class']; ?>
                <div class="border rounded p-3 mb-3">
                    <div class="d-flex flex-wrap justify-content-between gap-2 mb-2">
                        <div>
                            <span class="fw-bold"><?= e($cl['subject_code']) ?></span> <?= e($cl['subject_title']) ?>
                            <div class="small text-secondary"><?= e($cl['section_name']) ?> · <?= e($cl['semester_name'] ?? '') ?> <?= e($cl['academic_year_label'] ?? '') ?> · <?= e($cl['faculty_name'] ?? 'Unassigned') ?></div>
                        </div>
                        <div class="text-end">
                            <?= Ui::gradeStatusBadge($cl['grade_status']) ?>
                            <?php if ($c['published'] && $c['posted']): ?>
                                <div class="fs-5 fw-bold"><?= e($c['posted']['final_grade']) ?> <?= Ui::remarksBadge($c['posted']['remarks']) ?></div>
                            <?php elseif ($c['computed']): ?>
                                <div class="small text-warning-emphasis">Draft — not yet posted by faculty</div>
                                <div class="fw-semibold"><?= e($c['computed']['final_grade']) ?> <span class="text-secondary small">(computed)</span></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="small mb-2">
                        Attendance: <strong><?= Ui::pct($c['attRate']) ?></strong>
                        (P <?= (int) $c['attendance']['present'] ?> · L <?= (int) $c['attendance']['late'] ?> · E <?= (int) $c['attendance']['excused'] ?> · A <?= (int) $c['attendance']['absent'] ?>)
                        <?php if (!empty($c['posted']) && $c['posted']['remarks'] === 'INC'): ?>
                            · INC deadline: <strong><?= e($c['posted']['inc_deadline'] ?? 'Not configured') ?></strong><?= $c['posted']['inc_resolved_at'] ? ' (resolved)' : '' ?>
                        <?php endif; ?>
                    </div>
                    <?php $items = []; foreach ($c['scheme']['groups'] as $g) { foreach ($g['items'] as $it) { $items[] = $it; } } ?>
                    <?php if ($items): ?>
                        <div class="table-responsive"><table class="table table-sm table-bordered small mb-0 text-center">
                            <thead class="table-light"><tr><?php foreach ($items as $it): ?><th title="<?= e($it['title']) ?>"><?= e($it['code']) ?><div class="fw-normal text-secondary">/<?= e((string) $it['maxScore']) ?></div></th><?php endforeach; ?></tr></thead>
                            <tbody><tr><?php foreach ($items as $it): $code = $it['code']; ?>
                                <td><?= isset($c['scores'][$code]) ? e((string) $c['scores'][$code]) : '—' ?>
                                    <?php if (!empty($c['statuses'][$code]) && $c['statuses'][$code] !== 'submitted'): ?><div class="text-secondary"><?= e($c['statuses'][$code]) ?></div><?php endif; ?></td>
                            <?php endforeach; ?></tr></tbody>
                        </table></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent fw-semibold">Conduct summary</div>
        <?php if (empty($conduct)): ?>
            <?= Ui::emptyState('No conduct reports', 'No incidents have been reported for this student.', 'bi-shield-check') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm mb-0 small">
                <thead class="table-light"><tr><th>Date</th><th>Type</th><th>Severity</th><th>Status</th><th>Class</th><th>Reported by</th><th>Narrative</th></tr></thead>
                <tbody><?php foreach ($conduct as $b): ?>
                    <tr><td><?= e($b['incident_date']) ?></td><td><?= e($b['incident_type']) ?></td><td><?= e($b['severity']) ?></td><td><?= e($b['status']) ?></td>
                        <td><?= e($b['subject_code'] ?? '—') ?></td><td><?= e($b['reporter'] ?? '—') ?></td><td><?= e($b['description']) ?></td></tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>

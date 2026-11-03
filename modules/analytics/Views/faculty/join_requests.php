<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('Join Requests', 'Students who used a class code. Approval requires official registrar enrollment in the subject for the term.', 'bi-person-plus') ?>
    <div class="card border-0 shadow-sm">
        <?php if (empty($rows)): ?>
            <?= Ui::emptyState('No join requests', 'Share a class code from a class page so enrolled students can request to join.', 'bi-person-plus') ?>
        <?php else: ?>
            <div class="table-responsive"><table class="table table-sm align-middle mb-0 small">
                <thead class="table-light"><tr><th>Requested</th><th>Student</th><th>Class</th><th>Enrollment check</th><th>Status</th><th></th></tr></thead>
                <tbody><?php foreach ($rows as $r): $base = 'analytics/faculty/classes/' . (int) $r['class_id']; ?>
                    <tr>
                        <td><?= e(date('M j, Y', strtotime($r['created_at']))) ?></td>
                        <td><?= e($r['last_name'] . ', ' . $r['first_name']) ?> <span class="text-secondary"><?= e($r['student_number']) ?> · <?= e($r['program_code']) ?></span></td>
                        <td><?= e($r['subject_code'] . ' — ' . $r['section_name']) ?></td>
                        <td><?= $r['officially_enrolled'] ? '<span class="text-success">Enrolled in subject</span>' : '<span class="text-danger">Not enrolled in subject</span>' ?></td>
                        <td><span class="badge bg-light text-dark border"><?= e($r['status']) ?></span></td>
                        <td class="text-end">
                            <?php if ($r['status'] === 'pending'): ?>
                                <div class="d-flex gap-1 justify-content-end">
                                    <?php if ($r['officially_enrolled']): ?>
                                        <form method="POST" action="<?= url($base . '/join-requests/' . (int) $r['id'] . '/approve') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-success" type="submit">Approve</button></form>
                                    <?php endif; ?>
                                    <form method="POST" action="<?= url($base . '/join-requests/' . (int) $r['id'] . '/reject') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" type="submit">Reject</button></form>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </div>
</div>

<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <?= Ui::header('My Profile', 'Your official student record (read-only). Ask the Registrar to correct anything.', 'bi-person-vcard') ?>
    <?= Ui::privacyNotice() ?>
    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm"><div class="card-body small">
                <dl class="row mb-0">
                    <dt class="col-5">Name</dt><dd class="col-7"><?= e(Ui::fullName($student)) ?></dd>
                    <dt class="col-5">Student number</dt><dd class="col-7"><?= e($student['student_number']) ?></dd>
                    <dt class="col-5">Program</dt><dd class="col-7"><?= e($student['program_name'] ?? '') ?></dd>
                    <dt class="col-5">Year level</dt><dd class="col-7"><?= (int) $student['year_level'] ?></dd>
                    <dt class="col-5">Section</dt><dd class="col-7"><?= e($student['section_name'] ?? '—') ?></dd>
                    <dt class="col-5">Email</dt><dd class="col-7"><?= e($student['email']) ?></dd>
                    <dt class="col-5">Contact number</dt><dd class="col-7"><?= e($student['contact_number'] ?? '—') ?></dd>
                    <dt class="col-5">Birthdate</dt><dd class="col-7"><?= e($student['birthdate'] ?? '—') ?></dd>
                    <dt class="col-5">Address</dt><dd class="col-7"><?= e($student['address'] ?? '—') ?></dd>
                    <dt class="col-5">Guardian</dt><dd class="col-7"><?= e($student['guardian_name'] ?? '—') ?></dd>
                </dl>
            </div></div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm"><div class="card-header bg-transparent fw-semibold">Enrollment — <?= e($term['label'] ?? 'no active term') ?></div>
                <div class="card-body small"><?= $enrollment ? Ui::enrollmentBadge($enrollment['status']) . ' ' . count(array_filter($enrollment['subjects'], fn($s) => $s['status'] === 'enrolled')) . ' subject(s)' : Ui::enrollmentBadge(null) ?></div>
            </div>
        </div>
    </div>
</div>

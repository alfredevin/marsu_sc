<?php
$views = [
    'academichistory.php', 'attendancerecords.php', 'behaviorrecords.php', 
    'demographicinfo.php', 'enrollmentrecords.php', 'failedincompletemonitoring.php', 
    'gradestracking.php', 'index.php', 'participationtracking.php', 
    'profile.php', 'progressreports.php', 'studentengagement.php', 'subjectperformance.php',
    'admin/change_log.php', 'admin/class_form.php', 'admin/class_record_view.php',
    'admin/classes.php', 'admin/correction_requests.php', 'admin/settings.php',
    'admin/student_profile_form.php', 'admin/template_form.php', 'admin/templates.php',
    'faculty/attendance.php', 'faculty/class_record.php', 'faculty/classes.php',
    'faculty/conduct.php', 'faculty/dashboard.php', 'faculty/student_view.php',
    'faculty/students.php', 'partials/empty_state.php', 'partials/privacy_notice.php',
    'partials/readonly_banner.php', 'partials/reason_modal.php'
];
foreach ($views as $v) {
    $diff = shell_exec('git diff -w backup/group8a-work:modules/retention/Views/' . $v . ' HEAD:modules/analytics/Views/' . $v);
    if (!empty(trim($diff ?? ''))) {
        echo "Diff in $v:\n";
        // Show summary of diff
        $lines = explode("\n", trim($diff));
        $changes = array_filter($lines, fn($l) => str_starts_with($l, '+') || str_starts_with($l, '-'));
        echo "  " . count($changes) . " changed lines (mostly retention->analytics URLs)\n";
    } else {
        echo "MATCH: $v\n";
    }
}

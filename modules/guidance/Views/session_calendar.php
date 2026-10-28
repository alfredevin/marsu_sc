<?php
// ====================================================================
//   GUIDANCE & COUNSELING SYSTEM: SESSION CALENDAR
//   MINIMALISTIC SINGLE MONTHLY CALENDAR VIEW • COUNSELOR MEETING DATES
//   DIV-BASED LAYOUT ONLY • NO STYLE/SCRIPT TAGS • 15PX FONT SIZE
//   DYNAMIC PREV/NEXT MONTH & DATE NAVIGATION VIA PHP
// ====================================================================

// Retrieve requested Year and Month from URL parameters, defaulting to October 2026
$year = isset($_GET['year']) ? (int)$_GET['year'] : 2026;
$month = isset($_GET['month']) ? (int)$_GET['month'] : 10;

// Bounds checking
if ($month < 1) {
    $month = 12;
    $year--;
} elseif ($month > 12) {
    $month = 1;
    $year++;
}

// Calculate Previous Month & Year
$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

// Calculate Next Month & Year
$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

// Month metadata
$firstDayTimestamp = mktime(0, 0, 0, $month, 1, $year);
$monthName = date('F', $firstDayTimestamp);
$daysInMonth = (int)date('t', $firstDayTimestamp);
$firstDayOfWeek = (int)date('w', $firstDayTimestamp); // 0 (Sun) to 6 (Sat)

// Previous month metadata for padding
$prevMonthTimestamp = mktime(0, 0, 0, $prevMonth, 1, $prevYear);
$daysInPrevMonth = (int)date('t', $prevMonthTimestamp);

// Current Reference Date (Today: October 23, 2026)
$todayStr = '2026-10-23';

// Counselor Meetings Database (by YYYY-MM-DD)
$meetings = [
    // October 2026
    '2026-10-02' => [
        [
            'time' => '02:00 PM - 03:00 PM',
            'student' => 'SANTOS, MARIA C.',
            'student_id' => '2024-00102',
            'program' => 'BEED - 2A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Initial Counseling Interview & Well-being Checkpoint'
        ]
    ],
    '2026-10-05' => [
        [
            'time' => '09:30 AM - 10:30 AM',
            'student' => 'DELA CRUZ, JUAN L.',
            'student_id' => '2024-00101',
            'program' => 'BSIS - 3A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Academic Coaching & Subject Retention'
        ]
    ],
    '2026-10-07' => [
        [
            'time' => '01:30 PM - 02:30 PM',
            'student' => 'MENDOZA, BEA R.',
            'student_id' => '2024-00103',
            'program' => 'BSTM - 1C',
            'counselor' => 'Prof. Mark Bautista, RPm',
            'venue' => 'Guidance Room 2',
            'concern' => 'Career Guidance & Program Orientation'
        ]
    ],
    '2026-10-09' => [
        [
            'time' => '10:00 AM - 11:00 AM',
            'student' => 'REYES, CARLO D.',
            'student_id' => '2024-00104',
            'program' => 'BSIS - 2A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Behavioral Guidance & Attendance Review'
        ]
    ],
    '2026-10-14' => [
        [
            'time' => '02:00 PM - 03:00 PM',
            'student' => 'RAMOS, CARLOS M.',
            'student_id' => '2024-00129',
            'program' => 'BSIS - 3A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Study Strategy & Exam Preparation'
        ]
    ],
    '2026-10-16' => [
        [
            'time' => '10:30 AM - 11:30 AM',
            'student' => 'AQUINO, JOSHUA E.',
            'student_id' => '2024-00105',
            'program' => 'BSTM - 2B',
            'counselor' => 'Prof. Mark Bautista, RPm',
            'venue' => 'Guidance Room 2',
            'concern' => 'Academic Coaching & Peer Interaction'
        ]
    ],
    '2026-10-20' => [
        [
            'time' => '09:00 AM - 10:00 AM',
            'student' => 'GOMEZ, PATRICIA S.',
            'student_id' => '2024-00106',
            'program' => 'BaPOS - 2A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Course Adjustment & Academic Guidance'
        ]
    ],
    '2026-10-21' => [
        [
            'time' => '01:30 PM - 02:30 PM',
            'student' => 'BAUTISTA, MARK L.',
            'student_id' => '2024-00107',
            'program' => 'BSIS - 1A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Personal Stress Alleviation & Organization'
        ]
    ],
    '2026-10-23' => [
        [
            'time' => '10:00 AM - 11:00 AM',
            'student' => 'RAMOS, CARLOS M.',
            'student_id' => '2024-00129',
            'program' => 'BSIS - 3A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Academic Follow-up & Midterm Review'
        ],
        [
            'time' => '02:00 PM - 03:00 PM',
            'student' => 'DELA CRUZ, CARLOS P.',
            'student_id' => '2024-00130',
            'program' => 'BSTM - 2B',
            'counselor' => 'Prof. Mark Bautista, RPm',
            'venue' => 'Guidance Room 2',
            'concern' => 'Academic Evaluation & Study Habits'
        ]
    ],
    '2026-10-26' => [
        [
            'time' => '01:00 PM - 02:00 PM',
            'student' => 'FLORES, ANGELA T.',
            'student_id' => '2024-00108',
            'program' => 'BEED - 3B',
            'counselor' => 'Prof. Mark Bautista, RPm',
            'venue' => 'Guidance Room 2',
            'concern' => 'Peer Consultation & Org Involvement'
        ]
    ],
    '2026-10-28' => [
        [
            'time' => '10:00 AM - 11:00 AM',
            'student' => 'CASTRO, DANIEL M.',
            'student_id' => '2024-00109',
            'program' => 'BSIS - 4A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Career Exploration & Internship Prep'
        ]
    ],
    '2026-10-30' => [
        [
            'time' => '02:30 PM - 03:30 PM',
            'student' => 'CRUZ, PATRICIA V.',
            'student_id' => '2024-00110',
            'program' => 'BSTM - 3A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Follow-up Checkpoint & Academic Feedback'
        ]
    ],
    // September 2026
    '2026-09-18' => [
        [
            'time' => '10:00 AM - 11:00 AM',
            'student' => 'ALVAREZ, JANE M.',
            'student_id' => '2024-00088',
            'program' => 'BEED - 1A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Freshman Adjustment Interview'
        ]
    ],
    '2026-09-25' => [
        [
            'time' => '01:30 PM - 02:30 PM',
            'student' => 'CRUZ, BENEDICT O.',
            'student_id' => '2024-00092',
            'program' => 'BSIS - 2A',
            'counselor' => 'Prof. Mark Bautista, RPm',
            'venue' => 'Guidance Room 2',
            'concern' => 'Career Consultation & Goals'
        ]
    ],
    // November 2026
    '2026-11-06' => [
        [
            'time' => '10:00 AM - 11:00 AM',
            'student' => 'VILLANUEVA, LORNA E.',
            'student_id' => '2024-00115',
            'program' => 'BSIS - 2B',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Midterm Grade Evaluation'
        ]
    ],
    '2026-11-13' => [
        [
            'time' => '01:30 PM - 02:30 PM',
            'student' => 'NAVARRO, KEVIN S.',
            'student_id' => '2024-00118',
            'program' => 'BSTM - 3A',
            'counselor' => 'Prof. Mark Bautista, RPm',
            'venue' => 'Guidance Room 2',
            'concern' => 'Internship Readiness Coaching'
        ]
    ],
    '2026-11-20' => [
        [
            'time' => '09:30 AM - 10:30 AM',
            'student' => 'GUTIERREZ, RONA P.',
            'student_id' => '2024-00122',
            'program' => 'BEED - 4A',
            'counselor' => 'Dr. Elena Santos, RGC',
            'venue' => 'Guidance Room 1',
            'concern' => 'Pre-Graduation Assessment'
        ]
    ]
];

// University Holidays
$holidays = [
    '2026-09-21' => 'Peace Day',
    '2026-10-12' => 'IP Day (Holiday)',
    '2026-11-01' => 'All Saints\' Day',
    '2026-11-02' => 'All Souls\' Day',
    '2026-11-30' => 'Bonifacio Day',
    '2026-12-25' => 'Christmas Day',
    '2026-12-30' => 'Rizal Day'
];

// Count meetings in the currently viewed month
$monthMeetingsCount = 0;
foreach ($meetings as $mDate => $mList) {
    $mY = (int)substr($mDate, 0, 4);
    $mM = (int)substr($mDate, 5, 2);
    if ($mY === $year && $mM === $month) {
        $monthMeetingsCount += count($mList);
    }
}

// Calculate total calendar grid cells
$totalCells = (int)(ceil(($firstDayOfWeek + $daysInMonth) / 7) * 7);
?>

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <!-- Breadcrumb Trail -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 15px;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" class="text-decoration-none fw-semibold" style="color: #800020; font-size: 15px;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" class="text-decoration-none text-muted" style="font-size: 15px;">
                    Guidance
                </a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page" style="font-size: 15px;">
                Session Calendar
            </li>
        </ol>
    </nav>

    <!-- Page Title & Header Actions -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="font-size: 22px; letter-spacing: -0.2px;">
                <i class="bi bi-calendar3 me-2" style="color: #800020;"></i>Counseling Session Calendar
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px;">
                Monthly calendar showing counselor meeting dates and scheduled student appointments.
            </p>
        </div>
        <div>
            <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#modal-schedule-session"
                style="background-color: #800020; border: none; font-size: 15px; font-weight: 500; height: 42px; border-radius: 6px; padding: 0 18px;">
                <i class="bi bi-calendar-plus" style="font-size: 16px;"></i>
                <span>Schedule New Session</span>
            </button>
        </div>
    </div>
</div>

<!-- CALENDAR TOOLBAR: DYNAMIC PREV/NEXT MONTH & MEETING SUMMARY -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; background-color: #ffffff; overflow: hidden;">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <!-- Left: Previous, Today, Next Buttons + Month & Year -->
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="btn-group" role="group">
                    <a href="<?= url('guidance/session_calendar') ?>?month=<?= $prevMonth ?>&year=<?= $prevYear ?>"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        title="Previous Month"
                        style="height: 38px; width: 44px; font-size: 15px; border-radius: 6px 0 0 6px;">
                        <i class="bi bi-chevron-left" style="font-size: 15px;"></i>
                    </a>
                    <a href="<?= url('guidance/session_calendar') ?>?month=10&year=2026"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        style="height: 38px; padding: 0 16px; font-size: 15px; font-weight: 500;">
                        Today
                    </a>
                    <a href="<?= url('guidance/session_calendar') ?>?month=<?= $nextMonth ?>&year=<?= $nextYear ?>"
                        class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                        title="Next Month"
                        style="height: 38px; width: 44px; font-size: 15px; border-radius: 0 6px 6px 0;">
                        <i class="bi bi-chevron-right" style="font-size: 15px;"></i>
                    </a>
                </div>
                <div class="ms-2">
                    <h5 class="fw-bold m-0" style="color: #800020; font-size: 20px;">
                        <i class="bi bi-calendar-event me-2" style="color: #800020;"></i><?= e($monthName . ' ' . $year) ?>
                    </h5>
                </div>
            </div>

            <!-- Right: Meeting Legend & Monthly Count Badge -->
            <div class="d-flex align-items-center gap-3 flex-wrap" style="font-size: 15px;">
                <div class="d-flex align-items-center gap-2">
                    <span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background-color: #800020;"></span>
                    <span style="font-size: 15px;">Meeting Date</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background-color: #D4AF37;"></span>
                    <span style="font-size: 15px;">Today</span>
                </div>
                <span class="badge text-white px-3 py-2" style="background-color: #800020; font-size: 15px; font-weight: 600; border-radius: 50rem;">
                    <?= $monthMeetingsCount ?> <?= $monthMeetingsCount === 1 ? 'Session' : 'Sessions' ?> Scheduled
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   SINGLE MAIN CALENDAR: DIV-BASED MONTHLY GRID ONLY                 -->
<!-- ==================================================================== -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px; overflow: hidden; background-color: #ffffff;">
    <div class="overflow-auto">
        <div style="min-width: 860px;">
            <!-- Weekday Header Row (SUN - SAT) -->
            <div class="row g-0 text-center fw-bold border-bottom" style="font-size: 15px; background-color: #F8FAFC;">
                <div class="col py-2.5 text-danger border-end" style="font-size: 15px; padding: 12px 0;">SUN</div>
                <div class="col py-2.5 text-secondary border-end" style="font-size: 15px; padding: 12px 0;">MON</div>
                <div class="col py-2.5 text-secondary border-end" style="font-size: 15px; padding: 12px 0;">TUE</div>
                <div class="col py-2.5 text-secondary border-end" style="font-size: 15px; padding: 12px 0;">WED</div>
                <div class="col py-2.5 text-secondary border-end" style="font-size: 15px; padding: 12px 0;">THU</div>
                <div class="col py-2.5 text-secondary border-end" style="font-size: 15px; padding: 12px 0;">FRI</div>
                <div class="col py-2.5 text-secondary" style="font-size: 15px; padding: 12px 0;">SAT</div>
            </div>

            <!-- Dynamic Weeks & Days Grid -->
            <?php for ($i = 0; $i < $totalCells; $i++): ?>
                <?php if ($i % 7 === 0): ?>
                    <div class="row g-0 border-bottom">
                <?php endif; ?>

                <?php if ($i < $firstDayOfWeek): ?>
                    <!-- Previous Month Day Padding -->
                    <?php $prevDayNum = $daysInPrevMonth - $firstDayOfWeek + $i + 1; ?>
                    <div class="col p-2.5 border-end bg-light opacity-50" style="min-height: 125px; font-size: 15px;">
                        <span class="text-muted fw-semibold" style="font-size: 15px;"><?= $prevDayNum ?></span>
                    </div>

                <?php elseif ($i < $firstDayOfWeek + $daysInMonth): ?>
                    <!-- Current Month Day -->
                    <?php
                    $dayNum = $i - $firstDayOfWeek + 1;
                    $dateKey = sprintf('%04d-%02d-%02d', $year, $month, $dayNum);
                    $isToday = ($dateKey === $todayStr);
                    $dayMeetings = $meetings[$dateKey] ?? [];
                    $holiday = $holidays[$dateKey] ?? null;
                    ?>
                    <div class="col p-2.5 border-end <?= $isToday ? '' : 'bg-white' ?>"
                        style="min-height: 125px; font-size: 15px; <?= $isToday ? 'background-color: #FFFDF5; border: 2px solid #D4AF37 !important;' : '' ?>">
                        
                        <div class="d-flex justify-content-between align-items-center mb-1.5">
                            <?php if ($isToday): ?>
                                <div class="d-flex align-items-center gap-1.5">
                                    <span style="width: 28px; height: 28px; border-radius: 50%; background-color: #800020; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 700;">
                                        <?= $dayNum ?>
                                    </span>
                                    <span class="badge" style="background-color: #D4AF37; color: #1A202C; font-size: 13px; font-weight: 700;">
                                        TODAY
                                    </span>
                                </div>
                            <?php else: ?>
                                <span class="fw-bold <?= $holiday ? 'text-secondary' : 'text-dark' ?>" style="font-size: 15px;">
                                    <?= $dayNum ?>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($dayMeetings)): ?>
                                <span class="badge" style="background-color: #FDF2F4; color: #800020; font-size: 13px; font-weight: 600;">
                                    <?= count($dayMeetings) ?> <?= count($dayMeetings) === 1 ? 'Meeting' : 'Meetings' ?>
                                </span>
                            <?php elseif ($holiday): ?>
                                <span class="badge bg-secondary text-white" style="font-size: 13px;">Holiday</span>
                            <?php endif; ?>
                        </div>

                        <?php if ($holiday): ?>
                            <div class="p-2 rounded text-muted mb-1" style="background-color: #EEF2F6; font-size: 14px; border-left: 4px solid #718096;">
                                <i class="bi bi-flag-fill me-1 text-secondary"></i><?= e($holiday) ?>
                            </div>
                        <?php endif; ?>

                        <?php foreach ($dayMeetings as $idx => $sess): ?>
                            <?php
                            $shortName = explode(',', $sess['student'])[0];
                            $shortTime = explode(' - ', $sess['time'])[0];
                            ?>
                            <div class="p-2 mb-1.5 rounded d-flex align-items-center gap-1.5 text-truncate <?= $isToday ? 'shadow-sm' : '' ?>"
                                data-bs-toggle="modal" data-bs-target="#modal-session-<?= e($dateKey) ?>-<?= $idx ?>"
                                style="background-color: <?= $isToday ? '#ffffff' : '#FDF2F4' ?>; border-left: 4px solid #800020; color: #800020; font-size: 15px; font-weight: 600; cursor: pointer;"
                                title="Click to view details: <?= e($sess['student']) ?>">
                                <i class="bi bi-clock-fill" style="font-size: 13px; color: #800020;"></i>
                                <span class="text-truncate"><?= e($shortTime) ?> &bull; <?= e($shortName) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <!-- Next Month Day Padding -->
                    <?php $nextDayNum = $i - ($firstDayOfWeek + $daysInMonth) + 1; ?>
                    <div class="col p-2.5 border-end bg-light opacity-50" style="min-height: 125px; font-size: 15px;">
                        <span class="text-muted fw-semibold" style="font-size: 15px;"><?= $nextDayNum ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($i % 7 === 6): ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODALS: MEETING DETAILS (FOR CURRENT MONTH SESSIONS ONLY)          -->
<!-- ==================================================================== -->
<?php foreach ($meetings as $mDate => $mList): ?>
    <?php
    $mY = (int)substr($mDate, 0, 4);
    $mM = (int)substr($mDate, 5, 2);
    if ($mY !== $year || $mM !== $month) continue;
    ?>
    <?php foreach ($mList as $idx => $sess): ?>
        <div class="modal fade" id="modal-session-<?= e($mDate) ?>-<?= $idx ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow border-0" style="border-radius: 8px; overflow: hidden; font-size: 15px;">
                    <div class="modal-header text-white px-3 py-2.5" style="background-color: #800020;">
                        <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                            <i class="bi bi-calendar-check me-2" style="color: #D4AF37;"></i>Meeting Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-3 bg-light" style="font-size: 15px;">
                        <div class="card p-3 mb-2 bg-white border shadow-none" style="border-radius: 6px;">
                            <div class="fw-bold text-dark" style="font-size: 16px;"><?= e($sess['student']) ?></div>
                            <div class="text-muted mt-1" style="font-size: 15px;">
                                Student ID: <strong><?= e($sess['student_id']) ?></strong> &bull; Program: <strong><?= e($sess['program']) ?></strong>
                            </div>
                        </div>
                        <div class="card p-3 bg-white border shadow-none" style="border-radius: 6px; font-size: 15px;">
                            <div class="mb-1.5">
                                <strong>Date &amp; Time:</strong> <?= date('l, M j, Y', strtotime($mDate)) ?> &bull; <?= e($sess['time']) ?>
                            </div>
                            <div class="mb-1.5">
                                <strong>Counselor:</strong> <?= e($sess['counselor']) ?>
                            </div>
                            <div class="mb-1.5">
                                <strong>Venue:</strong> <?= e($sess['venue']) ?>
                            </div>
                            <div>
                                <strong>Concern:</strong> <?= e($sess['concern']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-3 py-2 bg-white border-top">
                        <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                            style="font-size: 15px; height: 36px; border-radius: 4px;">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>

<!-- ==================================================================== -->
<!--   MODAL: SCHEDULE NEW SESSION                                        -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-schedule-session" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 8px; overflow: hidden; font-size: 15px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                    <i class="bi bi-calendar-plus me-2" style="color: #D4AF37;"></i>Schedule New Counseling Session
                </h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" onsubmit="event.preventDefault();">
                <div class="modal-body p-4 bg-light" style="font-size: 15px;">
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Student Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. DELA CRUZ, JUAN L." required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" placeholder="e.g. 2024-00101" required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Academic Program <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                                <option value="" selected disabled>Select program...</option>
                                <option value="BSIS - 3A">BSIS (Information Systems)</option>
                                <option value="BaPOS - 2A">BaPOS (Political Science)</option>
                                <option value="BSTM - 2B">BSTM (Tourism Management)</option>
                                <option value="BEED - 2A">BEED (Elementary Education)</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Assigned Counselor <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                                <option value="Dr. Elena Santos, RGC" selected>Dr. Elena Santos, RGC</option>
                                <option value="Prof. Mark Bautista, RPm">Prof. Mark Bautista, RPm</option>
                                <option value="Ms. Clarisse Ramos">Ms. Clarisse Ramos</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Session Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none" value="<?= sprintf('%04d-%02d-01', $year, $month) ?>" required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Time Slot <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                                <option value="09:00 AM - 10:00 AM">09:00 AM &ndash; 10:00 AM</option>
                                <option value="10:00 AM - 11:00 AM" selected>10:00 AM &ndash; 11:00 AM</option>
                                <option value="01:00 PM - 02:00 PM">01:00 PM &ndash; 02:00 PM</option>
                                <option value="02:00 PM - 03:00 PM">02:00 PM &ndash; 03:00 PM</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-1" style="font-size: 15px;">Consultation Concern <span class="text-danger">*</span></label>
                            <select class="form-select shadow-none" required
                                style="font-size: 15px; border-color: #ced4da; border-radius: 6px; height: 40px;">
                                <option value="Academic Coaching">Academic Coaching &amp; Study Strategy</option>
                                <option value="Career Guidance">Career Guidance &amp; Exploration</option>
                                <option value="Emotional Well-being">Emotional &amp; Stress Management</option>
                                <option value="Peer Consultation">Peer Consultation &amp; Adjustment</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 15px; height: 38px; border-radius: 4px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-4 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: none; font-size: 15px; font-weight: 500; height: 38px; border-radius: 4px;">
                        <i class="bi bi-calendar-check me-1.5"></i>Confirm Session
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
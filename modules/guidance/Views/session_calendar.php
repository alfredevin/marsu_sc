<?php
// Determine Year and Month from URL or Default to Current Date
$currentYear = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');
$currentMonth = isset($_GET['month']) ? (int) $_GET['month'] : (int) date('n');

// Clamp Month value between 1 and 12
if ($currentMonth < 1) {
    $currentMonth = 1;
} elseif ($currentMonth > 12) {
    $currentMonth = 12;
}

// Previous & Next Month Navigation Math
$prevMonth = $currentMonth - 1;
$prevYear = $currentYear;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

// Current Month Details
$firstDayTimestamp = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
$monthName = date('F', $firstDayTimestamp);
$daysInMonth = (int) date('t', $firstDayTimestamp);
$startDayOfWeek = (int) date('w', $firstDayTimestamp); // 0 (Sun) to 6 (Sat)

// Previous Month Days Count
$prevMonthDaysCount = (int) date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear));

// Today's Date String for active day highlight
$todayDateStr = date('Y-m-d');

// Sample Scheduled Sessions in Guidance System
$scheduledSessions = [
    '2026-10-26' => true,
    '2026-10-27' => true,
    '2026-10-28' => true,
    '2026-10-29' => true,
    '2026-10-30' => true,
    '2026-11-01' => true,
    '2026-11-03' => true,
    '2026-11-05' => true,
    '2026-11-10' => true,
    '2026-11-12' => true,
    '2026-11-18' => true,
    '2026-11-25' => true,
];

// Build Calendar Grid Cells
$calendarCells = [];

// 1. Trailing days from previous month
for ($i = $startDayOfWeek - 1; $i >= 0; $i--) {
    $prevDayNum = $prevMonthDaysCount - $i;
    $calendarCells[] = [
        'day' => $prevDayNum,
        'isCurrentMonth' => false,
        'isToday' => false,
        'hasSession' => false,
        'date' => sprintf('%04d-%02d-%02d', $prevYear, $prevMonth, $prevDayNum)
    ];
}

// 2. Active days of current month
for ($day = 1; $day <= $daysInMonth; $day++) {
    $dateStr = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
    $isToday = ($dateStr === $todayDateStr);
    $hasSession = isset($scheduledSessions[$dateStr]) || $isToday;

    $calendarCells[] = [
        'day' => $day,
        'isCurrentMonth' => true,
        'isToday' => $isToday,
        'hasSession' => $hasSession,
        'date' => $dateStr
    ];
}

// 3. Leading days of next month to complete the week
$remainingCells = 7 - (count($calendarCells) % 7);
if ($remainingCells < 7) {
    for ($nextDay = 1; $nextDay <= $remainingCells; $nextDay++) {
        $calendarCells[] = [
            'day' => $nextDay,
            'isCurrentMonth' => false,
            'isToday' => false,
            'hasSession' => false,
            'date' => sprintf('%04d-%02d-%02d', $nextYear, $nextMonth, $nextDay)
        ];
    }
}

// Group into rows of 7 days (Sunday - Saturday)
$calendarRows = array_chunk($calendarCells, 7);
?>
<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: SESSION CALENDAR               -->
<!-- ==================================================================== -->

<!-- 1. BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <!-- Breadcrumb Trail -->
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb mb-0" style="font-size: 14.5px; background: transparent; padding: 0; line-height: 2.0;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance/appointment_lists') ?>"
                    style="color: #800020; text-decoration: none; font-weight: 500;">
                    Appointments
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Session Calendar
            </li>
        </ol>
    </nav>

    <!-- Header Title & Action Row -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Counseling Session Calendar
            </h4>
            <p class="text-muted mb-0" style="font-size: 14.5px; line-height: 2.0;">
                Monthly consultation calendar showing scheduled student sessions, venues, and student schedules.
            </p>
        </div>
        <div>
            <!-- Schedule Button: Opens Schedule Modal -->
            <button type="button" class="btn text-white shadow-none d-inline-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#modal-schedule-session"
                style="background-color: #800020; border: 1px solid #800020; font-size: 14px; font-weight: 500; height: 40px; border-radius: 8px; padding: 0 18px;">
                <i class="bi bi-calendar-plus" style="font-size: 15px;"></i>
                <span>Schedule New Session</span>
            </button>
        </div>
    </div>
</div>

<!-- 2. CALENDAR NAVIGATION TOOLBAR (CLEAN, MINIMALISTIC & FILTER BY YEAR) -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <!-- Left: Month Navigation Controls -->
            <div class="btn-group" role="group">
                <a href="<?= url('guidance/session_calendar') ?>?month=<?= $prevMonth ?>&year=<?= $prevYear ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    title="Previous Month"
                    style="height: 38px; width: 44px; font-size: 14px; border-radius: 6px 0 0 6px;">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a href="<?= url('guidance/session_calendar') ?>?month=<?= (int)date('n') ?>&year=<?= (int)date('Y') ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center px-3"
                    style="height: 38px; font-size: 14px; font-weight: 500;">
                    Today
                </a>
                <a href="<?= url('guidance/session_calendar') ?>?month=<?= $nextMonth ?>&year=<?= $nextYear ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    title="Next Month" style="height: 38px; width: 44px; font-size: 14px; border-radius: 0 6px 6px 0;">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            <!-- Center: Current Month & Year Display -->
            <div>
                <h5 class="fw-bold mb-0" style="color: #800020; font-size: 20px; letter-spacing: -0.2px;">
                    <?= e($monthName) ?> <?= $currentYear ?>
                </h5>
            </div>

            <!-- Right: Filter by Year Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted fw-semibold mb-0" style="font-size: 13.5px; white-space: nowrap;">
                    <i class="bi bi-funnel me-1"></i>Filter by Year:
                </label>
                <select class="form-select form-select-sm shadow-none bg-white"
                    onchange="window.location.href='<?= url('guidance/session_calendar') ?>?year=' + this.value + '&month=<?= $currentMonth ?>';"
                    style="width: 110px; height: 38px; border-color: #CBD5E1; font-size: 14px; font-weight: 500; border-radius: 6px; cursor: pointer;">
                    <?php for ($y = 2024; $y <= 2028; $y++): ?>
                        <option value="<?= $y ?>" <?= ($currentYear === $y) ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- 3. MAIN BALANCED CALENDAR (PANTAY-PANTAY GRID • SPACING 2.0 • MINIMALISTIC) -->
<div class="card shadow-sm border-0 mb-4 bg-white"
    style="border: 1px solid #E2E8F0 !important; border-radius: 12px; overflow: hidden;">
    <div class="table-responsive m-0">
        <table class="table table-bordered mb-0" style="table-layout: fixed; width: 100%; border-color: #E2E8F0;">
            <!-- Equal-width Header Row -->
            <thead>
                <tr class="text-center" style="background-color: #F8FAFC;">
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">SUN</th>
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">MON</th>
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">TUE</th>
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">WED</th>
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">THU</th>
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">FRI</th>
                    <th class="py-3 text-secondary fw-bold"
                        style="width: 14.2857%; font-size: 13.5px; letter-spacing: 0.5px;">SAT</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calendarRows as $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <?php if (!$cell['isCurrentMonth']): ?>
                                <!-- Previous / Next Month Day -->
                                <td class="p-2 align-top" style="width: 14.2857%; height: 115px; background-color: #F8FAFC;">
                                    <div class="text-muted fw-semibold" style="font-size: 13px; opacity: 0.45; line-height: 2.0;">
                                        <?= $cell['day'] ?>
                                    </div>
                                </td>
                            <?php elseif ($cell['isToday']): ?>
                                <!-- TODAY (Active Current Date Highlight) -->
                                <td class="p-2 align-top bg-light"
                                    style="width: 14.2857%; height: 115px; line-height: 2.0; border: 2px solid #800020 !important;">
                                    <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                                        <div>
                                            <span
                                                style="width: 26px; height: 26px; border-radius: 50%; background-color: #800020; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700;">
                                                <?= $cell['day'] ?>
                                            </span>
                                        </div>
                                        <div class="mt-auto">
                                            <a href="<?= url('guidance/session_view') ?>" class="text-decoration-none"
                                                style="color: #800020; font-size: 11.5px; font-weight: 600; line-height: 2.0;">
                                                View Schedule &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            <?php elseif ($cell['hasSession']): ?>
                                <!-- Current Month Day with Scheduled Session -->
                                <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                                    <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                                        <span class="fw-bold text-dark" style="font-size: 14px;"><?= $cell['day'] ?></span>
                                        <div class="mt-auto">
                                            <a href="<?= url('guidance/session_view') ?>" class="text-decoration-none"
                                                style="color: #800020; font-size: 11.5px; font-weight: 600; line-height: 2.0;">
                                                View Schedule &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            <?php else: ?>
                                <!-- Current Month Day without Session -->
                                <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= $cell['day'] ?></div>
                                </td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 5. MODAL: SCHEDULE NEW SESSION (MINIMALISTIC & ACCESSIBLE) -->
<div class="modal fade" id="modal-schedule-session" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden; font-size: 14.5px;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div>
                    <h5 class="modal-title m-0 fw-bold" style="font-size: 18px; letter-spacing: -0.2px;">
                        Schedule New Counseling Session
                    </h5>
                    <div style="font-size: 13px; color: #FDF2F4; line-height: 1.6;">
                        Guidance and intake consultation scheduling dossier
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" onsubmit="event.preventDefault(); alert('Counseling session scheduled successfully!'); const m = bootstrap.Modal.getInstance(document.getElementById('modal-schedule-session')); if (m) m.hide();">
                <?= csrf_field() ?>
                <div class="modal-body p-4 bg-white" style="font-size: 14.5px;">

                    <div class="row g-4" style="line-height: 2.0;">
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Student Full Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none bg-white"
                                placeholder="e.g. RAMOS, CARLOS M." required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Student ID <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none bg-white" placeholder="e.g. 2023-01089"
                                required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Academic Program <span
                                    class="text-danger">*</span></label>
                            <select class="form-select shadow-none bg-white" required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                                <option value="" selected disabled>Select program...</option>
                                <option value="BSIS">BSIS (BS Information Systems)</option>
                                <option value="BaPOS">BaPOS (BA Political Science)</option>
                                <option value="BEED">BEED (Bachelor of Elementary Education)</option>
                                <option value="BSTM">BSTM (BS Tourism Management)</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Assigned Guidance Counselor</label>
                            <input type="text" class="form-control bg-light text-dark shadow-none fw-semibold"
                                value="Dr. Elena Santos, RGC" readonly
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Session Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control shadow-none bg-white"
                                value="<?= date('Y-m-d') ?>" required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Time Slot <span
                                    class="text-danger">*</span></label>
                            <select class="form-select shadow-none bg-white" required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                                <option value="08:30 AM - 09:30 AM">08:30 AM &ndash; 09:30 AM</option>
                                <option value="09:30 AM - 10:30 AM" selected>09:30 AM &ndash; 10:30 AM</option>
                                <option value="11:00 AM - 12:00 PM">11:00 AM &ndash; 12:00 PM</option>
                                <option value="01:30 PM - 02:30 PM">01:30 PM &ndash; 02:30 PM</option>
                                <option value="02:00 PM - 03:00 PM">02:00 PM &ndash; 03:00 PM</option>
                                <option value="03:00 PM - 04:00 PM">03:00 PM &ndash; 04:00 PM</option>
                                <option value="03:30 PM - 04:30 PM">03:30 PM &ndash; 04:30 PM</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Consultation Venue <span
                                    class="text-danger">*</span></label>
                            <select class="form-select shadow-none bg-white" required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                                <option value="Room 101" selected>Room 101 (Guidance Office)</option>
                                <option value="Room 102">Room 102 (Guidance Office)</option>
                                <option value="Room 103">Room 103 (Counseling Room)</option>
                                <option value="Room 104">Room 104 (Interview Room)</option>
                                <option value="Room 105">Room 105 (Consultation Office)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted fw-semibold mb-2"
                                style="font-size: 13px; letter-spacing: 0.3px;">Consultation Concern Focus <span
                                    class="text-danger">*</span></label>
                            <select class="form-select shadow-none bg-white" required
                                style="font-size: 14.5px; border-color: #CBD5E1; border-radius: 8px; height: 46px;">
                                <option value="Study habits and time management" selected>Study habits and time
                                    management</option>
                                <option value="Anxiety or excessive worry">Anxiety or excessive worry</option>
                                <option value="Course or program selection & career planning">Course or program
                                    selection &amp; career planning</option>
                                <option value="Sudden withdrawal from social interactions">Sudden withdrawal from social
                                    interactions</option>
                                <option value="Test anxiety & academic probation review">Test anxiety &amp; academic
                                    probation review</option>
                                <option value="Stress management and coping strategies">Stress management and coping
                                    strategies</option>
                                <option value="Personal adjustment and grief recovery">Personal adjustment and grief
                                    recovery</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 shadow-none"
                        data-bs-dismiss="modal"
                        style="font-size: 14px; height: 38px; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="btn text-white btn-sm px-4 shadow-none"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 14px; font-weight: 500; height: 38px; border-radius: 6px;">
                        <i class="bi bi-calendar-check me-1.5"></i>Confirm Session
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
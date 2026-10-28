<?php
$currentYear = isset($_GET['year']) ? (int) $_GET['year'] : 2026;
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
                <a href="<?= url('guidance/session_calendar') ?>?month=9&year=<?= $currentYear ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    title="Previous Month"
                    style="height: 38px; width: 44px; font-size: 14px; border-radius: 6px 0 0 6px;">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a href="<?= url('guidance/session_calendar') ?>?month=10&year=2026"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center px-3"
                    style="height: 38px; font-size: 14px; font-weight: 500;">
                    Today
                </a>
                <a href="<?= url('guidance/session_calendar') ?>?month=11&year=<?= $currentYear ?>"
                    class="btn btn-outline-secondary shadow-none d-inline-flex align-items-center justify-content-center"
                    title="Next Month" style="height: 38px; width: 44px; font-size: 14px; border-radius: 0 6px 6px 0;">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            <!-- Center: Current Month & Year Display -->
            <div>
                <h5 class="fw-bold mb-0" style="color: #800020; font-size: 20px; letter-spacing: -0.2px;">
                    October <?= $currentYear ?>
                </h5>
            </div>

            <!-- Right: Filter by Year Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted fw-semibold mb-0" style="font-size: 13.5px; white-space: nowrap;">
                    <i class="bi bi-funnel me-1"></i>Filter by Year:
                </label>
                <select class="form-select form-select-sm shadow-none bg-white"
                    onchange="window.location.href='<?= url('guidance/session_calendar') ?>?year=' + this.value + '&month=10';"
                    style="width: 110px; height: 38px; border-color: #CBD5E1; font-size: 14px; font-weight: 500; border-radius: 6px; cursor: pointer;">
                    <option value="2024" <?= ($currentYear === 2024) ? 'selected' : '' ?>>2024</option>
                    <option value="2025" <?= ($currentYear === 2025) ? 'selected' : '' ?>>2025</option>
                    <option value="2026" <?= ($currentYear === 2026) ? 'selected' : '' ?>>2026</option>
                    <option value="2027" <?= ($currentYear === 2027) ? 'selected' : '' ?>>2027</option>
                    <option value="2028" <?= ($currentYear === 2028) ? 'selected' : '' ?>>2028</option>
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
                <!-- Row 1: Sept 27 - Oct 3 -->
                <tr>
                    <td class="p-2 align-top" style="width: 14.2857%; height: 115px; background-color: #F8FAFC;">
                        <div class="text-muted fw-semibold" style="font-size: 13px; opacity: 0.45; line-height: 2.0;">27
                        </div>
                    </td>
                    <td class="p-2 align-top" style="width: 14.2857%; height: 115px; background-color: #F8FAFC;">
                        <div class="text-muted fw-semibold" style="font-size: 13px; opacity: 0.45; line-height: 2.0;">28
                        </div>
                    </td>
                    <td class="p-2 align-top" style="width: 14.2857%; height: 115px; background-color: #F8FAFC;">
                        <div class="text-muted fw-semibold" style="font-size: 13px; opacity: 0.45; line-height: 2.0;">29
                        </div>
                    </td>
                    <td class="p-2 align-top" style="width: 14.2857%; height: 115px; background-color: #F8FAFC;">
                        <div class="text-muted fw-semibold" style="font-size: 13px; opacity: 0.45; line-height: 2.0;">30
                        </div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">1</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">2</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">3</div>
                    </td>
                </tr>

                <!-- Row 2: Oct 4 - Oct 10 -->
                <tr>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">4</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">5</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">6</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">7</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">8</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">9</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">10</div>
                    </td>
                </tr>

                <!-- Row 3: Oct 11 - Oct 17 -->
                <tr>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">11</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">12</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">13</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">14</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">15</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">16</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">17</div>
                    </td>
                </tr>

                <!-- Row 4: Oct 18 - Oct 24 -->
                <tr>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">18</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">19</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">20</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">21</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">22</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">23</div>
                    </td>
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">24</div>
                    </td>
                </tr>

                <!-- Row 5: Oct 25 - Oct 31 -->
                <tr>
                    <!-- Sun Oct 25 -->
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">25</div>
                    </td>

                    <!-- Mon Oct 26 -->
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            <span class="fw-bold text-dark" style="font-size: 14px;">26</span>
                            <div class="mt-auto">
                                <a href="<?= url('guidance/session_view') ?>" class="text-decoration-none"
                                    style="color: #800020; font-size: 11.5px; font-weight: 600; line-height: 2.0;">
                                    View Schedule &rarr;
                                </a>
                            </div>
                        </div>
                    </td>

                    <!-- Tue Oct 27 -->
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            <span class="fw-bold text-dark" style="font-size: 14px;">27</span>
                            <div class="mt-auto">
                                <a href="<?= url('guidance/session_view') ?>" class="text-decoration-none"
                                    style="color: #800020; font-size: 11.5px; font-weight: 600; line-height: 2.0;">
                                    View Schedule &rarr;
                                </a>
                            </div>
                        </div>
                    </td>

                    <!-- Wed Oct 28 -->
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            <span class="fw-bold text-dark" style="font-size: 14px;">28</span>
                            <div class="mt-auto">
                                <a href="<?= url('guidance/session_view') ?>" class="text-decoration-none"
                                    style="color: #800020; font-size: 11.5px; font-weight: 600; line-height: 2.0;">
                                    View Schedule &rarr;
                                </a>
                            </div>
                        </div>
                    </td>

                    <!-- Thu Oct 29: TODAY (Active Session) -->
                    <td class="p-2 align-top bg-light"
                        style="width: 14.2857%; height: 115px; line-height: 2.0; border: 2px solid #800020 !important;">
                        <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            <div>
                                <span
                                    style="width: 26px; height: 26px; border-radius: 50%; background-color: #800020; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700;">
                                    29
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

                    <!-- Fri Oct 30 -->
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">30</div>
                    </td>

                    <!-- Sat Oct 31 -->
                    <td class="p-2 align-top bg-white" style="width: 14.2857%; height: 115px; line-height: 2.0;">
                        <div class="fw-bold text-dark" style="font-size: 14px;">31</div>
                    </td>
                </tr>
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
            <form action="" method="POST" onsubmit="event.preventDefault();">
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
                                <option value="BSIS - 3A">BSIS (Information Systems)</option>
                                <option value="BaPOS - 2A">BaPOS (Political Science)</option>
                                <option value="BSTM - 2B">BSTM (Tourism Management)</option>
                                <option value="BEED - 2A">BEED (Elementary Education)</option>
                                <option value="BSIT - 3B">BSIT (Information Technology)</option>
                                <option value="BSED - 4A">BSED (Secondary Education)</option>
                                <option value="BSN - 1A">BSN (Nursing)</option>
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
                                value="<?= sprintf('%04d-10-29', $currentYear) ?>" required
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
                    <button type="button" class="btn text-white btn-sm px-4 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 14px; font-weight: 500; height: 38px; border-radius: 6px;">
                        <i class="bi bi-calendar-check me-1.5"></i>Confirm Session
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
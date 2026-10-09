<!-- Page Content -->
<div class="container-fluid fade-in-up">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Attendance Records</h1>
            <p class="text-xs text-gray-600 mb-0">Biometric and roll-call session summaries, unexcused
                absence monitoring, and attendance compliance rates.</p>
        </div>
        <div class="mt-3 mt-sm-0">
            <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#recordAttendanceModal">
                <i class="fas fa-plus fa-sm mr-1"></i> Log Session Attendance
            </button>
            <button class="btn btn-sm btn-outline-secondary shadow-sm ml-1" id="toggleViewBtn">
                <i class="fas fa-calendar-alt fa-sm mr-1"></i> Toggle Calendar View
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-success h-100 shadow-sm">
                <div class="kpi-label text-success">Cohort Attendance Rate</div>
                <div class="kpi-number text-gray-900" id="kpiAvgAtt">88.2%</div>
                <div class="text-xs text-muted mt-1">Institutional standard: &ge; 80%</div>
                <i class="fas fa-user-check kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-danger h-100 shadow-sm">
                <div class="kpi-label text-danger">Chronic Absenteeism Flag</div>
                <div class="kpi-number text-gray-900" id="kpiChronic">0</div>
                <div class="text-xs text-muted mt-1">Breached &lt; 80% attendance limit</div>
                <i class="fas fa-user-times kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-info h-100 shadow-sm">
                <div class="kpi-label text-info">Excused Absences</div>
                <div class="kpi-number text-gray-900" id="kpiExcusedTotal">0</div>
                <div class="text-xs text-muted mt-1">Officially verified permits</div>
                <i class="fas fa-file-medical kpi-icon"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card kpi-card border-left-primary h-100 shadow-sm">
                <div class="kpi-label text-primary">Monitored Cohort Roster</div>
                <div class="kpi-number text-gray-900" id="kpiTotalStudents">0</div>
                <div class="text-xs text-muted mt-1">Filtered students matching criteria</div>
                <i class="fas fa-users kpi-icon"></i>
            </div>
        </div>
    </div>

    <!-- Attendance Rate Chart Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="color: #6B1D2F !important;">
                <i class="fas fa-chart-line mr-1"></i> Per-Student Attendance Rate Comparison
            </h6>
        </div>
        <div class="card-body">
            <div class="chart-bar" style="height: 220px;">
                <canvas id="attendanceRateChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Calendar View (Toggled) -->
    <div class="card shadow mb-4 d-none" id="calendarViewCard">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-calendar-alt mr-1"></i>
                Attendance Schedule Matrix</h6>
            <span class="badge badge-light border">Boac Main Campus</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th class="calendar-day-header">Mon</th>
                            <th class="calendar-day-header">Tue</th>
                            <th class="calendar-day-header">Wed</th>
                            <th class="calendar-day-header">Thu</th>
                            <th class="calendar-day-header">Fri</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="calendar-cell"><strong>14</strong><span
                                    class="cal-event-dot bg-success text-white">Lecture: 28
                                    Present</span></td>
                            <td class="calendar-cell"><strong>15</strong><span
                                    class="cal-event-dot bg-success text-white">Lab Session: 26
                                    Present</span></td>
                            <td class="calendar-cell"><strong>16</strong><span
                                    class="cal-event-dot bg-warning text-dark">Review: 2 Late</span>
                            </td>
                            <td class="calendar-cell"><strong>17</strong><span
                                    class="cal-event-dot bg-success text-white">Lecture: 30
                                    Present</span></td>
                            <td class="calendar-cell"><strong>18</strong><span
                                    class="cal-event-dot bg-danger text-white">Unexcused Absence</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Attendance Table Card: Student Attendance Session Summary Logs -->
    <div class="card shadow mb-4" id="tableViewCard">
        <div class="card-header py-3">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-3">
                <div>
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #6B1D2F !important;">
                        <i class="fas fa-list-alt mr-1"></i> Attendance Session Logs
                    </h6>
                    <div class="text-xs text-muted">Cumulative attendance metrics aggregated per student
                        cohort</div>
                </div>
                <!-- Search Input by Student ID or Name -->
                <div class="mt-2 mt-lg-0" style="min-width: 260px;">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i
                                    class="fas fa-search text-gray-500"></i></span>
                        </div>
                        <input type="text" id="customSearchInput" class="form-control form-control-sm border-left-0"
                            placeholder="Search Student ID or Name..." style="border-radius: 0 8px 8px 0;">
                    </div>
                </div>
            </div>

            <!-- 3 Dedicated Filters: Program, Year Level, Section -->
            <div class="d-flex align-items-center flex-wrap pt-2 border-top gap-2">
                <div class="mr-3 mb-2 mb-md-0">
                    <label class="text-xs font-weight-bold text-gray-700 text-uppercase mr-1 mb-0">DEPARTMENT
                        / PROGRAM:</label>
                    <select class="custom-select custom-select-sm font-weight-bold" id="filterProgram"
                        style="min-width: 190px; border-radius: 8px;">
                        <option value="all">All Programs</option>
                        <option value="BSIS">BSIS (Information Systems)</option>
                        <option value="BSIT">BSIT (Information Technology)</option>
                        <option value="POLSCI">POLSCI (Political Science)</option>
                        <option value="BEED">BEED (Elementary Education)</option>
                        <option value="BSTM">BSTM (Tourism Management)</option>
                        <option value="BSCS">BSCS (Computer Science)</option>
                        <option value="BSCE">BSCE (Civil Engineering)</option>
                        <option value="BSA">BSA (Accountancy)</option>
                        <option value="BSBA">BSBA (Business Administration)</option>
                        <option value="BSED">BSED (Secondary Education)</option>
                        <option value="BSNS">BSNS (Natural Sciences)</option>
                        <option value="BSAG">BSAG (Agriculture)</option>
                    </select>
                </div>

                <div class="mr-3 mb-2 mb-md-0">
                    <label class="text-xs font-weight-bold text-gray-700 text-uppercase mr-1 mb-0">YEAR
                        LEVEL:</label>
                    <select class="custom-select custom-select-sm font-weight-bold" id="filterYear"
                        style="min-width: 140px; border-radius: 8px;">
                        <option value="all">All Years</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>

                <div class="mb-2 mb-md-0">
                    <label class="text-xs font-weight-bold text-gray-700 text-uppercase mr-1 mb-0">SECTION:</label>
                    <select class="custom-select custom-select-sm font-weight-bold" id="filterSection"
                        style="min-width: 130px; border-radius: 8px;">
                        <option value="all">All Sections</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="attendanceTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 140px;">STUDENT ID</th>
                            <th>STUDENT NAME</th>
                            <th class="text-center" style="width: 150px;">TOTAL PRESENT</th>
                            <th class="text-center" style="width: 150px;">TOTAL ABSENT</th>
                            <th class="text-center" style="width: 150px;">EXCUSED</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceTableBody">
                        <!-- Rendered dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>
<div class="container-fluid watermark-container">
    <div class="watermark-content">

        <!-- Page Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Counseling Appointments</h1>
                <p class="text-gray-600 small mb-0">Schedule and monitor counseling and guidance appointments for Santa
                    Cruz Campus students.</p>
            </div>
            <div class="mt-3 mt-sm-0">
                <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#newAppointmentModal">
                    <i class="fas fa-calendar-plus fa-sm mr-1"></i> New Appointment
                </button>
            </div>
        </div>

        <!-- Metric Summary Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Scheduled
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">19</div>
                                <div class="text-xs text-muted mt-1">Santa Cruz GCO Queue</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-calendar-day fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending
                                    Confirmation</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">5</div>
                                <div class="text-xs text-muted mt-1">Requires counselor verification</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-hourglass-half fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Confirmed
                                    Sessions</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">14</div>
                                <div class="text-xs text-muted mt-1">Scheduled this week</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-check-circle fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 bg-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Completed This Term
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800">104</div>
                                <div class="text-xs text-muted mt-1">Logged into case files</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-clipboard-check fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments Table Card -->
        <div class="card shadow mb-4 bg-white">
            <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-calendar-alt mr-2"></i>Scheduled
                    Appointments</h6>
                <div class="d-flex align-items-center mt-2 mt-md-0">
                    <input type="text" class="form-control form-control-sm" placeholder="Search student, ID, service..."
                        style="width: 250px;" onkeyup="MarsuApp.filterTable(this, '#appointments-table')">
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="appointments-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Student</th>
                                <th>Service</th>
                                <th>Counselor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-001</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S0016')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Lyka Tolosa
                                    </a>
                                    <div class="text-muted small">24S0016 &bull; BSIT (3rd Year)</div>
                                </td>
                                <td>Individual Counseling</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Sept. 28, 2026</td>
                                <td>9:00 AM</td>
                                <td><span class="badge badge-success px-2 py-1">Scheduled</span></td>
                                <td>
                                    <button onclick="MarsuApp.openStudentProfile('24S0016')"
                                        class="btn btn-xs btn-outline-primary mr-1" title="View Student Profile"><i
                                            class="fas fa-user"></i></button>
                                    <button
                                        onclick="MarsuApp.showToast('Appointment AP-2026-001 completed!', 'success')"
                                        class="btn btn-xs btn-primary"><i class="fas fa-check"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-002</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S008')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Rhea Nicole Recarro
                                    </a>
                                    <div class="text-muted small">24S008 &bull; BSIT (3rd Year)</div>
                                </td>
                                <td>Career Counseling</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Sept. 28, 2026</td>
                                <td>10:30 AM</td>
                                <td><span class="badge badge-info px-2 py-1">Completed</span></td>
                                <td>
                                    <button onclick="MarsuApp.openStudentProfile('24S008')"
                                        class="btn btn-xs btn-outline-primary mr-1"><i class="fas fa-user"></i></button>
                                    <a href="career-counseling.html" class="btn btn-xs btn-light border"><i
                                            class="fas fa-folder-open"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-003</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S0013')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Anne Chesca Rey
                                    </a>
                                    <div class="text-muted small">24S0013 &bull; BSIT (3rd Year)</div>
                                </td>
                                <td>Psychological Support</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Sept. 29, 2026</td>
                                <td>1:30 PM</td>
                                <td><span class="badge badge-success px-2 py-1">Scheduled</span></td>
                                <td>
                                    <button onclick="MarsuApp.openStudentProfile('24S0013')"
                                        class="btn btn-xs btn-outline-primary mr-1"><i class="fas fa-user"></i></button>
                                    <button
                                        onclick="MarsuApp.showToast('Appointment AP-2026-003 completed!', 'success')"
                                        class="btn btn-xs btn-primary"><i class="fas fa-check"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-004</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S0015')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Princess Trozo
                                    </a>
                                    <div class="text-muted small">24S0015 &bull; BSIT (3rd Year)</div>
                                </td>
                                <td>Follow-up Counseling</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Sept. 30, 2026</td>
                                <td>2:00 PM</td>
                                <td><span class="badge badge-warning px-2 py-1">Pending</span></td>
                                <td>
                                    <button
                                        onclick="this.closest('tr').querySelector('.badge-warning').className='badge badge-success px-2 py-1'; this.closest('tr').querySelector('.badge').textContent='Scheduled'; MarsuApp.showToast('Appointment AP-2026-004 Confirmed!', 'success');"
                                        class="btn btn-xs btn-success mr-1"><i class="fas fa-check"></i></button>
                                    <button onclick="MarsuApp.openStudentProfile('24S0015')"
                                        class="btn btn-xs btn-outline-primary"><i class="fas fa-user"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-005</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S0019')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Kate Garcia
                                    </a>
                                    <div class="text-muted small">24S0019 &bull; BSEd (2nd Year)</div>
                                </td>
                                <td>Individual Counseling</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Oct. 01, 2026</td>
                                <td>10:00 AM</td>
                                <td><span class="badge badge-success px-2 py-1">Scheduled</span></td>
                                <td>
                                    <button onclick="MarsuApp.openStudentProfile('24S0019')"
                                        class="btn btn-xs btn-outline-primary mr-1"><i class="fas fa-user"></i></button>
                                    <button
                                        onclick="MarsuApp.showToast('Appointment AP-2026-005 completed!', 'success')"
                                        class="btn btn-xs btn-primary"><i class="fas fa-check"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-006</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S005')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Nicole Paunat
                                    </a>
                                    <div class="text-muted small">24S005 &bull; BSBA (4th Year)</div>
                                </td>
                                <td>Career Counseling</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Oct. 02, 2026</td>
                                <td>2:30 PM</td>
                                <td><span class="badge badge-success px-2 py-1">Scheduled</span></td>
                                <td>
                                    <button onclick="MarsuApp.openStudentProfile('24S005')"
                                        class="btn btn-xs btn-outline-primary mr-1"><i class="fas fa-user"></i></button>
                                    <button
                                        onclick="MarsuApp.showToast('Appointment AP-2026-006 completed!', 'success')"
                                        class="btn btn-xs btn-primary"><i class="fas fa-check"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-007</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S002')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Irish Catherine Ramos
                                    </a>
                                    <div class="text-muted small">24S002 &bull; BSBA (3rd Year)</div>
                                </td>
                                <td>Psychological Support</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Oct. 03, 2026</td>
                                <td>11:00 AM</td>
                                <td><span class="badge badge-info px-2 py-1">Completed</span></td>
                                <td>
                                    <button onclick="MarsuApp.openStudentProfile('24S002')"
                                        class="btn btn-xs btn-outline-primary mr-1"><i class="fas fa-user"></i></button>
                                    <a href="psychological-support.html" class="btn btn-xs btn-light border"><i
                                            class="fas fa-folder-open"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="font-weight-bold text-primary">AP-2026-008</span></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="MarsuApp.openStudentProfile('24S0010')"
                                        class="font-weight-bold text-dark text-decoration-none">
                                        Cheezka Ai Recto
                                    </a>
                                    <div class="text-muted small">24S0010 &bull; BSIT (1st Year)</div>
                                </td>
                                <td>Follow-up Session</td>
                                <td>Dr. Jellian T. Ricafrente</td>
                                <td>Oct. 04, 2026</td>
                                <td>3:00 PM</td>
                                <td><span class="badge badge-warning px-2 py-1">Pending</span></td>
                                <td>
                                    <button
                                        onclick="this.closest('tr').querySelector('.badge-warning').className='badge badge-success px-2 py-1'; this.closest('tr').querySelector('.badge').textContent='Scheduled'; MarsuApp.showToast('Appointment AP-2026-008 Confirmed!', 'success');"
                                        class="btn btn-xs btn-success mr-1"><i class="fas fa-check"></i></button>
                                    <button onclick="MarsuApp.openStudentProfile('24S0010')"
                                        class="btn btn-xs btn-outline-primary"><i class="fas fa-user"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newAppointmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white" style="background-color: var(--marsu-burgundy);">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-calendar-plus mr-2"></i>New Appointment
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form
                onsubmit="event.preventDefault(); $('#newAppointmentModal').modal('hide'); MarsuApp.showToast('New Appointment successfully scheduled!', 'success', 'Appointment Created');">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student ID *</label>
                            <input type="text" class="form-control" placeholder="e.g. 24S0016" value="24S0016" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" class="form-control" placeholder="e.g. Lyka Tolosa" value="Lyka Tolosa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Program</label>
                            <input type="text" class="form-control" placeholder="e.g. BS Information Technology"
                                value="BS Information Technology">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Year Level</label>
                            <select class="custom-select">
                                <option>1st Year</option>
                                <option>2nd Year</option>
                                <option selected>3rd Year</option>
                                <option>4th Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Service Type *</label>
                            <select class="custom-select" required>
                                <option value="" disabled>Select service...</option>
                                <option selected>Individual Counseling</option>
                                <option>Group Counseling</option>
                                <option>Career Counseling</option>
                                <option>Psychological Support</option>
                                <option>Follow-up Session</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Counselor *</label>
                            <input type="text" class="form-control" value="Dr. Jellian T. Ricafrente" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Preferred Date *</label>
                            <input type="date" class="form-control" value="2026-10-05" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Appointment Time *</label>
                            <input type="time" class="form-control" value="09:00" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Appointment Status</label>
                            <select class="custom-select">
                                <option>Pending</option>
                                <option selected>Scheduled</option>
                                <option>Completed</option>
                                <option>Cancelled</option>
                                <option>No Show</option>
                                <option>Rescheduled</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-label">Reason for Appointment</label>
                        <textarea class="form-control" rows="2"
                            placeholder="Briefly describe the purpose of appointment..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-light border" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Save Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="js/marsu-app.js"></script>
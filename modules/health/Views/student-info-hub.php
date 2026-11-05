  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet"><style>
        :root {
            --maroon-primary: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #a31c3f;
            --stem-color: #4e73df;
            --abm-color: #1cc88a;
            --humss-color: #6f42c1;
            --tvl-color: #f6c23e;
            --gas-color: #e74a3b;
        }

        /* Sidebar Custom Maroon Theme */
        .bg-maroon {
            background-color: var(--maroon-primary) !important;
        }

        .bg-maroon-dark {
            background-color: var(--maroon-dark) !important;
        }

        /* Primary Module Navigation Tabs */
        .nav-hub-pills {
            border-bottom: 2px solid #e3e6f0;
            margin-bottom: 1.5rem;
        }

        /* Custom Modern Vertical Scrollbar for Modals */
        .modal-body {
            max-height: 75vh;
            overflow-y: auto !important;
            scrollbar-width: thin;
            scrollbar-color: var(--maroon-primary) #f1f5f9;
        }

        .modal-body::-webkit-scrollbar {
            width: 10px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 8px;
            border-left: 1px solid #e2e8f0;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--maroon-primary);
            border-radius: 8px;
            border: 2px solid #f1f5f9;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: var(--maroon-dark);
        }

        .nav-hub-pills .nav-link {
            font-weight: 700;
            font-size: 0.95rem;
            color: #4a5568;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem 0.5rem 0 0;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            margin-right: 0.25rem;
            background-color: #f8f9fc;
        }

        .nav-hub-pills .nav-link:hover {
            color: var(--maroon-primary);
            background-color: #edf2f7;
        }

        .nav-hub-pills .nav-link.active {
            color: #ffffff;
            background-color: var(--maroon-primary);
            border-color: var(--maroon-primary);
            box-shadow: 0 4px 6px -1px rgba(128, 0, 32, 0.2);
        }

        /* Card Enhancements */
        .card-demographic,
        .card-medical,
        .card-allergy,
        .card-contact,
        .card-patient {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-demographic:hover,
        .card-medical:hover,
        .card-allergy:hover,
        .card-contact:hover,
        .card-patient:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
        }

        /* Patient Registration Specific Styles */
        .badge-triage-red {
            background-color: rgba(231, 74, 59, 0.15);
            color: #e74a3b;
            border: 1px solid rgba(231, 74, 59, 0.4);
            font-weight: 800;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-triage-yellow {
            background-color: rgba(246, 194, 62, 0.2);
            color: #b78103;
            border: 1px solid rgba(246, 194, 62, 0.4);
            font-weight: 800;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-triage-green {
            background-color: rgba(28, 200, 138, 0.15);
            color: #1cc88a;
            border: 1px solid rgba(28, 200, 138, 0.3);
            font-weight: 800;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-status-queue {
            background-color: #f6c23e;
            color: #4e3800;
            font-weight: 700;
        }

        .badge-status-active {
            background-color: #4e73df;
            color: #fff;
            font-weight: 700;
        }

        .badge-status-discharged {
            background-color: #1cc88a;
            color: #fff;
            font-weight: 700;
        }

        .ticket-pill {
            background-color: var(--maroon-primary);
            color: #fff;
            font-weight: 800;
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            letter-spacing: 0.5px;
        }

        .patient-banner {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: #ffffff;
            border-top-left-radius: calc(0.3rem - 1px);
            border-top-right-radius: calc(0.3rem - 1px);
            padding: 1.5rem;
        }

        .pat-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #858796;
            margin-bottom: 0.2rem;
            letter-spacing: 0.5px;
        }

        .pat-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2e59d9;
            margin-bottom: 0.8rem;
        }

        .pat-grid-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: all 0.2s ease;
        }

        .pat-grid-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
        }

        /* Strand Pill Badges */
        .badge-strand {
            padding: 0.4em 0.8em;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 50rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-stem {
            background-color: rgba(78, 115, 223, 0.15);
            color: var(--stem-color);
            border: 1px solid rgba(78, 115, 223, 0.3);
        }

        .badge-abm {
            background-color: rgba(28, 200, 138, 0.15);
            color: var(--abm-color);
            border: 1px solid rgba(28, 200, 138, 0.3);
        }

        .badge-humss {
            background-color: rgba(111, 66, 193, 0.15);
            color: var(--humss-color);
            border: 1px solid rgba(111, 66, 193, 0.3);
        }

        .badge-tvl {
            background-color: rgba(246, 194, 62, 0.2);
            color: #b78103;
            border: 1px solid rgba(246, 194, 62, 0.4);
        }

        .badge-gas {
            background-color: rgba(231, 74, 59, 0.15);
            color: var(--gas-color);
            border: 1px solid rgba(231, 74, 59, 0.3);
        }

        /* Medical & Risk Badges */
        .badge-alert-critical,
        .badge-allergy-critical {
            background-color: rgba(231, 74, 59, 0.15);
            color: #e74a3b;
            border: 1px solid rgba(231, 74, 59, 0.4);
            font-weight: 700;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-alert-moderate,
        .badge-allergy-moderate {
            background-color: rgba(246, 194, 62, 0.2);
            color: #b78103;
            border: 1px solid rgba(246, 194, 62, 0.4);
            font-weight: 700;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-alert-low,
        .badge-allergy-mild {
            background-color: rgba(28, 200, 138, 0.15);
            color: #1cc88a;
            border: 1px solid rgba(28, 200, 138, 0.3);
            font-weight: 700;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        /* Verification Status Badges */
        .badge-contact-verified {
            background-color: rgba(28, 200, 138, 0.15);
            color: #1cc88a;
            border: 1px solid rgba(28, 200, 138, 0.3);
            font-weight: 700;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-contact-flagged {
            background-color: rgba(231, 74, 59, 0.15);
            color: #e74a3b;
            border: 1px solid rgba(231, 74, 59, 0.4);
            font-weight: 700;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        .badge-contact-pending {
            background-color: rgba(246, 194, 62, 0.2);
            color: #b78103;
            border: 1px solid rgba(246, 194, 62, 0.4);
            font-weight: 700;
            padding: 0.4em 0.8em;
            border-radius: 50rem;
        }

        /* Category Tag Styling */
        .tag-category {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            display: inline-block;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .tag-respiratory {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .tag-cardio {
            background-color: #ffe4e6;
            color: #be123c;
        }

        .tag-endocrine {
            background-color: #fef3c7;
            color: #92400e;
        }

        .tag-neuro {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .tag-ortho {
            background-color: #dcfce7;
            color: #15803d;
        }

        .tag-surgical {
            background-color: #f1f5f9;
            color: #475569;
        }

        .tag-food {
            background-color: #ffedd5;
            color: #c2410c;
        }

        .tag-drug {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .tag-environmental {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .tag-insect {
            background-color: #fef3c7;
            color: #b45309;
        }

        .tag-contact {
            background-color: #f3e8ff;
            color: #7e22ce;
        }

        /* Student Avatar Circles */
        .avatar-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e3e6f0;
        }

        .avatar-circle-lg {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.15);
        }

        /* Detail Modal Header Banner */
        .profile-banner,
        .medical-banner,
        .allergy-banner,
        .contact-banner {
            background: linear-gradient(135deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: #ffffff;
            border-top-left-radius: calc(0.3rem - 1px);
            border-top-right-radius: calc(0.3rem - 1px);
            padding: 1.5rem;
        }

        /* Data Label & Value Pair */
        .demo-label,
        .med-label,
        .alg-label,
        .cnt-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #858796;
            margin-bottom: 0.2rem;
            letter-spacing: 0.5px;
        }

        .demo-value,
        .med-value,
        .alg-value,
        .cnt-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2e59d9;
            margin-bottom: 0.8rem;
        }

        /* Quick Action Buttons */
        .btn-call-quick {
            background-color: #1cc88a;
            color: white;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.2rem 0.75rem;
        }

        .btn-call-quick:hover {
            background-color: #17a673;
            color: white;
        }

        .btn-sms-quick {
            background-color: #4e73df;
            color: white;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.2rem 0.75rem;
        }

        .btn-sms-quick:hover {
            background-color: #2e59d9;
            color: white;
        }

        /* Filter Controls Styling */
        .search-box-custom {
            border-radius: 30px;
            padding-left: 2.5rem;
        }

        .search-icon-pos {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
            z-index: 10;
        }

        /* Tables Styling */
        .table-demographic th,
        .table-medical th,
        .table-allergy th,
        .table-contact th {
            background-color: #f8f9fc;
            color: #4e73df;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-top: none;
        }

        .table-demographic td,
        .table-medical td,
        .table-allergy td,
        .table-contact td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* Grid Cards */
        .student-grid-card,
        .med-grid-card,
        .alg-grid-card,
        .cnt-grid-card {
            border-radius: 0.75rem;
            border: 1px solid #e3e6f0;
            transition: all 0.2s ease-in-out;
            background: #fff;
        }

        .student-grid-card:hover,
        .med-grid-card:hover,
        .alg-grid-card:hover,
        .cnt-grid-card:hover {
            border-color: var(--maroon-primary);
            box-shadow: 0 0.5rem 1rem rgba(128, 0, 32, 0.12);
        }

        /* Custom Nav Pills for Modal */
        .nav-pills-custom .nav-link {
            color: #5a5c69;
            font-weight: 600;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.82rem;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--maroon-primary);
            color: #fff;
        }

        /* Timeline in modal */
        .timeline-item {
            position: relative;
            padding-left: 25px;
            border-left: 2px solid #e3e6f0;
            margin-bottom: 15px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: var(--maroon-primary);
        }

        /* Toast Alert */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: none;
        }
    </style>\
<div class="container-fluid">

                    <!-- Page Heading Bar -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h1 class="h3 mb-1 text-gray-800 font-weight-bold"
                                style="color: var(--maroon-primary) !important;">
                                <i class="fas fa-id-card text-maroon mr-2"></i>Student Information & Health Hub
                            </h1>
                            <p class="text-muted small mb-0">Unified Directory for Demographics, Medical History,
                                Allergies & Emergency Contacts</p>
                        </div>
                        <div class="mt-3 mt-sm-0" id="headerActionButtons">
                            <button class="btn btn-sm btn-outline-secondary shadow-sm font-weight-bold mr-2"
                                onclick="exportCurrentData()">
                                <i class="fas fa-file-export fa-sm mr-1"></i> Export Data
                            </button>
                            <button class="btn btn-sm btn-outline-info shadow-sm font-weight-bold"
                                onclick="printCurrentRoster()">
                                <i class="fas fa-print fa-sm mr-1"></i> Print Roster
                            </button>
                        </div>
                    </div>

                    <!-- PRIMARY MODULE NAVIGATION TABS -->
                    <ul class="nav nav-hub-pills" id="moduleHubTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-demographics-btn" data-toggle="tab"
                                href="#tab-demographics" role="tab" onclick="setActiveTab('demographics')">
                                <i class="fas fa-users mr-2"></i>1. Student Info & Demographics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-medical-btn" data-toggle="tab" href="#tab-medical" role="tab"
                                onclick="setActiveTab('medical')">
                                <i class="fas fa-notes-medical mr-2"></i>2. Medical History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-allergies-btn" data-toggle="tab" href="#tab-allergies"
                                role="tab" onclick="setActiveTab('allergies')">
                                <i class="fas fa-allergies mr-2"></i>3. Allergies & Conditions
                            </a>
                        </li>
                    </ul>

                    <!-- TAB CONTENTS CONTAINER -->
                    <div class="tab-content" id="moduleHubTabsContent">

                        <!-- ========================================== -->
                        <!-- MODULE TAB 1: STUDENT DEMOGRAPHICS        -->
                        <!-- ========================================== -->
                        <div class="tab-pane fade show active" id="tab-demographics" role="tabpanel">

                            <!-- Overview Demographic KPI Metric Cards -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-demographic border-left-primary h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total Active Enrolled</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                        id="statTotalStudents">1,420</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-graduation-cap mr-1"></i> Grades 11 & 12</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-demographic border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Gender Distribution</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">52% F / 48% M
                                                    </div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-venus-mars mr-1"></i> 738 Female | 682 Male
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-restroom fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-demographic border-left-info h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        SHS Strands</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">5 Strands</div>
                                                    <div class="text-xs text-muted mt-1">STEM, ABM, HUMSS, TVL, GAS
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-demographic border-left-warning h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Guardian Contacts</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">99.4%</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-shield-alt text-success mr-1"></i> 1,411
                                                        Verified</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-phone-square-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Interactive Filtering Card -->
                            <div class="card card-demographic mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 position-relative">
                                            <i class="fas fa-search search-icon-pos"></i>
                                            <input type="text" id="searchDemoInput"
                                                class="form-control search-box-custom bg-light border-0"
                                                placeholder="Search student by Name, Student ID number, Guardian..."
                                                onkeyup="filterStudents()">
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                                            <select id="gradeDemoFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterStudents()">
                                                <option value="">All Year Levels</option>
                                                <option value="1st Year">1st Year</option>
                                                <option value="2nd Year">2nd Year</option>
                                                <option value="3rd Year">3rd Year</option>
                                                <option value="4th Year">4th Year</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                                            <select id="strandDemoFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterStudents()">
                                                <option value="">All Courses</option>
                                                <option value="BS Information System">BS Information System</option>
                                                <option value="BS Tourism Management">BS Tourism Management</option>
                                                <option value="BS Education">BS Education</option>
                                                <option value="BS Political Science">BS Political Science</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-3 mb-lg-0">
                                            <select id="sexDemoFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterStudents()">
                                                <option value="">All Sexes</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-8 col-6 text-right">
                                            <div class="btn-group btn-group-toggle shadow-sm" data-toggle="buttons">
                                                <label class="btn btn-light active font-weight-bold"
                                                    id="btnDemoTableView" onclick="switchView('demographics', 'table')">
                                                    <input type="radio" checked> <i class="fas fa-list"></i>
                                                </label>
                                                <label class="btn btn-light font-weight-bold" id="btnDemoGridView"
                                                    onclick="switchView('demographics', 'grid')">
                                                    <input type="radio"> <i class="fas fa-th-large"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Container -->
                            <div id="demoTableViewContainer" class="card card-demographic mb-4">
                                <div
                                    class="card-header py-3 d-flex align-items-center justify-content-between bg-white border-0">
                                    <h6 class="m-0 font-weight-bold text-gray-800">
                                        <i class="fas fa-users text-primary mr-2"></i>Student Demographic Masterlist
                                    </h6>
                                    <span class="badge badge-light border text-muted px-3 py-2"
                                        id="demoRecordCountBadge">Showing 6 students</span>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-demographic mb-0" id="studentsTable">
                                            <thead>
                                                <tr>
                                                    <th class="pl-4">LRN / Student ID</th>
                                                    <th>Student Name</th>
                                                    <th>Grade & Strand</th>
                                                    <th>Sex / Age</th>
                                                    <th>Parent / Guardian</th>
                                                    <th>Emergency Contact</th>
                                                    <th>Residence / Address</th>
                                                    <th>Status</th>
                                                    <th class="text-center pr-4">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="studentsTableBody">
                                                <!-- Dynamic JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Grid Container -->
                            <div id="demoGridViewContainer" class="row d-none">
                                <!-- Dynamic Grid Cards -->
                            </div>

                        </div>


                        <!-- ========================================== -->
                        <!-- MODULE TAB 3: MEDICAL HISTORY              -->
                        <!-- ========================================== -->
                        <div class="tab-pane fade" id="tab-medical" role="tabpanel">

                            <!-- Overview Medical KPI Metric Cards -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-medical border-left-danger h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Total Medical Histories</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                        id="statTotalHistories">1,385</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-procedures mr-1"></i> Recorded Diagnoses</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-medical-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-medical border-left-warning h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        High Alert Conditions</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">42 Students
                                                    </div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-exclamation-triangle text-danger mr-1"></i>
                                                        Asthma, Diabetes, Epilepsy</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-medical border-left-info h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Surgical / Hospital Record</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">118 Cases</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-hospital mr-1"></i> Prior Hospital Admissions
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-md fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-medical border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        PE Activity Clearances</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">98.2% Cleared
                                                    </div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-check-circle text-success mr-1"></i> Fit for
                                                        Physical Ed</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-running fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Interactive Filtering Card -->
                            <div class="card card-medical mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 position-relative">
                                            <i class="fas fa-search search-icon-pos"></i>
                                            <input type="text" id="searchMedInput"
                                                class="form-control search-box-custom bg-light border-0"
                                                placeholder="Search diagnosis, physician, Student ID number..."
                                                onkeyup="filterMedicalRecords()">
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                                            <select id="categoryMedFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterMedicalRecords()">
                                                <option value="">All Categories</option>
                                                <option value="Respiratory">Respiratory</option>
                                                <option value="Cardiovascular">Cardiovascular</option>
                                                <option value="Endocrine">Endocrine</option>
                                                <option value="Neurological">Neurological</option>
                                                <option value="Musculoskeletal">Musculoskeletal</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                                            <select id="riskMedFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterMedicalRecords()">
                                                <option value="">All Alert Levels</option>
                                                <option value="High Alert">High Alert</option>
                                                <option value="Moderate Risk">Moderate Risk</option>
                                                <option value="Routine / Low Risk">Routine / Low Risk</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-3 mb-lg-0">
                                            <select id="gradeMedFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterMedicalRecords()">
                                                <option value="">All Year Levels</option>
                                                <option value="1st Year">1st Year</option>
                                                <option value="2nd Year">2nd Year</option>
                                                <option value="3rd Year">3rd Year</option>
                                                <option value="4th Year">4th Year</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-8 col-6 text-right">
                                            <div class="btn-group btn-group-toggle shadow-sm" data-toggle="buttons">
                                                <label class="btn btn-light active font-weight-bold"
                                                    id="btnMedTableView" onclick="switchView('medical', 'table')">
                                                    <input type="radio" checked> <i class="fas fa-list"></i>
                                                </label>
                                                <label class="btn btn-light font-weight-bold" id="btnMedGridView"
                                                    onclick="switchView('medical', 'grid')">
                                                    <input type="radio"> <i class="fas fa-th-large"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Container -->
                            <div id="medTableViewContainer" class="card card-medical mb-4">
                                <div
                                    class="card-header py-3 d-flex align-items-center justify-content-between bg-white border-0">
                                    <h6 class="m-0 font-weight-bold text-gray-800">
                                        <i class="fas fa-notes-medical text-danger mr-2"></i>Medical History Directory
                                    </h6>
                                    <span class="badge badge-light border text-muted px-3 py-2"
                                        id="medRecordCountBadge">Showing 6 records</span>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-medical mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="pl-4">LRN</th>
                                                    <th>Student Name</th>
                                                    <th>Grade & Strand</th>
                                                    <th>Primary Diagnosis</th>
                                                    <th>Surgeries / Hospital</th>
                                                    <th>Family History</th>
                                                    <th>Alert Risk Level</th>
                                                    <th>PE Clearance</th>
                                                    <th class="text-center pr-4">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="medicalTableBody">
                                                <!-- Dynamic JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Grid Container -->
                            <div id="medGridViewContainer" class="row d-none">
                                <!-- Dynamic Grid Cards -->
                            </div>

                        </div>


                        <!-- ========================================== -->
                        <!-- MODULE TAB 3: ALLERGIES & CONDITIONS      -->
                        <!-- ========================================== -->
                        <div class="tab-pane fade" id="tab-allergies" role="tabpanel">

                            <!-- Overview Allergy KPI Metric Cards -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-allergy border-left-danger h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Total Allergen Files</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                        id="statTotalAllergies">412</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-allergies mr-1"></i> Active Condition Profiles
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-shield-virus fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-allergy border-left-warning h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Anaphylactic Risk</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18 Students
                                                    </div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-syringe text-danger mr-1"></i> EpiPen
                                                        Auto-Injector On Hand</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-allergy border-left-info h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Food & Dietary Allergies</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">145 Cases</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-utensils mr-1"></i> Peanuts, Shellfish, Eggs
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-bread-slice fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                                    <div class="card card-allergy border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Canteen Alerts Flagged</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">92 Flagged</div>
                                                    <div class="text-xs text-muted mt-1"><i
                                                            class="fas fa-store text-success mr-1"></i> Cafeteria Staff
                                                        Notified</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-concierge-bell fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Interactive Filtering Card -->
                            <div class="card card-allergy mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 position-relative">
                                            <i class="fas fa-search search-icon-pos"></i>
                                            <input type="text" id="searchAlgInput"
                                                class="form-control search-box-custom bg-light border-0"
                                                placeholder="Search allergen, symptom, student..."
                                                onkeyup="filterAllergies()">
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                                            <select id="categoryAlgFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterAllergies()">
                                                <option value="">All Categories</option>
                                                <option value="Food & Dietary">Food & Dietary</option>
                                                <option value="Medication / Drug">Medication / Drug</option>
                                                <option value="Environmental">Environmental</option>
                                                <option value="Insect Stings">Insect Stings</option>
                                                <option value="Contact / Latex">Contact / Latex</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0">
                                            <select id="severityAlgFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterAllergies()">
                                                <option value="">All Severity</option>
                                                <option value="Anaphylactic / Severe">Anaphylactic / Severe</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="Mild">Mild</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-6 mb-3 mb-lg-0">
                                            <select id="gradeAlgFilter"
                                                class="form-control custom-select bg-light border-0 text-dark font-weight-semibold"
                                                onchange="filterAllergies()">
                                                <option value="">All Year Levels</option>
                                                <option value="1st Year">1st Year</option>
                                                <option value="2nd Year">2nd Year</option>
                                                <option value="3rd Year">3rd Year</option>
                                                <option value="4th Year">4th Year</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-8 col-6 text-right">
                                            <div class="btn-group btn-group-toggle shadow-sm" data-toggle="buttons">
                                                <label class="btn btn-light active font-weight-bold"
                                                    id="btnAlgTableView" onclick="switchView('allergies', 'table')">
                                                    <input type="radio" checked> <i class="fas fa-list"></i>
                                                </label>
                                                <label class="btn btn-light font-weight-bold" id="btnAlgGridView"
                                                    onclick="switchView('allergies', 'grid')">
                                                    <input type="radio"> <i class="fas fa-th-large"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Container -->
                            <div id="algTableViewContainer" class="card card-allergy mb-4">
                                <div
                                    class="card-header py-3 d-flex align-items-center justify-content-between bg-white border-0">
                                    <h6 class="m-0 font-weight-bold text-gray-800">
                                        <i class="fas fa-allergies text-warning mr-2"></i>Allergies & Special Conditions
                                        Masterlist
                                    </h6>
                                    <span class="badge badge-light border text-muted px-3 py-2"
                                        id="algRecordCountBadge">Showing 6 records</span>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-allergy mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="pl-4">LRN</th>
                                                    <th>Student Name</th>
                                                    <th>Grade & Strand</th>
                                                    <th>Allergen / Condition</th>
                                                    <th>Severity & Symptoms</th>
                                                    <th>Emergency Protocol</th>
                                                    <th>Cafeteria Flag</th>
                                                    <th class="text-center pr-4">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="allergyTableBody">
                                                <!-- Dynamic JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Grid Container -->
                            <div id="algGridViewContainer" class="row d-none">
                                <!-- Dynamic Grid Cards -->
                            </div>

                        </div>


                    </div>

                </div>



                 <!-- ========================================== -->
    <!-- MODALS SECTION                            -->
    <!-- ========================================== -->

    <!-- 1. VIEW COMPREHENSIVE STUDENT PROFILE MODAL -->
    <div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="profile-banner d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img id="viewAvatar" src="img/undraw_profile.svg" alt="Student Photo"
                            class="avatar-circle-lg mr-3 bg-white">
                        <div>
                            <h4 id="viewFullName" class="font-weight-bold mb-1 text-white">Maria Clara Santos</h4>
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <span class="badge badge-light text-dark font-weight-bold mr-2" id="viewLRN"><i
                                        class="fas fa-id-badge mr-1"></i>Student ID: 21S0011</span>
                                <span class="badge badge-strand badge-bsis mr-2" id="viewStrandBadge">BS Information
                                    System</span>
                                <span class="badge badge-success" id="viewStatusBadge">Active Enrolled</span>
                            </div>
                        </div>
                    </div>
                    <button class="close text-white opacity-75" type="button" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="bg-light px-4 pt-3 border-bottom">
                    <ul class="nav nav-pills nav-pills-custom" id="demoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personalTab"
                                role="tab"><i class="fas fa-user mr-1"></i> Identity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="academic-tab" data-toggle="tab" href="#academicTab" role="tab"><i
                                    class="fas fa-graduation-cap mr-1"></i> Academic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contactTab" role="tab"><i
                                    class="fas fa-address-book mr-1"></i> Contact & Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="guardian-tab" data-toggle="tab" href="#guardianTab" role="tab"><i
                                    class="fas fa-shield-alt mr-1"></i> Parent / Guardian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="socio-tab" data-toggle="tab" href="#socioTab" role="tab"><i
                                    class="fas fa-home mr-1"></i> Socio-Economic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="med-tab" data-toggle="tab" href="#medTab" role="tab"><i
                                    class="fas fa-notes-medical mr-1 text-danger"></i> Medical History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="alg-tab" data-toggle="tab" href="#algTab" role="tab"><i
                                    class="fas fa-allergies mr-1 text-warning"></i> Allergies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="emg-tab" data-toggle="tab" href="#emgTab" role="tab"><i
                                    class="fas fa-phone-alt mr-1 text-success"></i> Emergency Contacts</a>
                        </li>
                    </ul>
                </div>

                <div class="modal-body p-4">
                    <div class="tab-content" id="demoTabsContent">

                        <!-- TAB 1: PERSONAL IDENTITY -->
                        <div class="tab-pane fade show active" id="personalTab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Full Name</div>
                                    <div class="demo-value" id="dFullName">Maria Clara Santos</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Student ID</div>
                                    <div class="demo-value" id="dLRN">21S0011</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Date of Birth</div>
                                    <div class="demo-value" id="dDOB">August 14, 2003</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Age & Sex</div>
                                    <div class="demo-value" id="dAgeSex">21 yrs old | Female</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Civil Status</div>
                                    <div class="demo-value" id="dCivilStatus">Single</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Nationality</div>
                                    <div class="demo-value" id="dNationality">Filipino</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Blood Type</div>
                                    <div class="demo-value text-danger font-weight-bold" id="dBloodType">O+</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Religion</div>
                                    <div class="demo-value" id="dReligion">Roman Catholic</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">PhilHealth No.</div>
                                    <div class="demo-value" id="dPhilhealth">12-09823411-9</div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: ACADEMIC PROFILE -->
                        <div class="tab-pane fade" id="academicTab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Year Level</div>
                                    <div class="demo-value" id="dGradeLevel">4th Year</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Course / Program</div>
                                    <div class="demo-value" id="dStrand">BS Information System</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Class Section</div>
                                    <div class="demo-value" id="dSection">4-BSIS-A</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Class Adviser</div>
                                    <div class="demo-value" id="dAdviser">Prof. Ricardo Mercado, M.Sc.</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">School Year</div>
                                    <div class="demo-value">SY 2026 - 2027</div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: ADDRESS & CONTACT -->
                        <div class="tab-pane fade" id="contactTab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Present Home Address</div>
                                    <div class="demo-value" id="dPresentAddress">Blk 12 Lot 4, Sunrise Village, Brgy.
                                        San Jose, Quezon City</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Permanent Address</div>
                                    <div class="demo-value" id="dPermanentAddress">Blk 12 Lot 4, Sunrise Village, Brgy.
                                        San Jose, Quezon City</div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="demo-label">Student Mobile Number</div>
                                    <div class="demo-value" id="dStudentPhone">0917-823-9912</div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="demo-label">Student Email Address</div>
                                    <div class="demo-value" id="dStudentEmail">maria.santos@student.shs.edu.ph</div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: PARENT / GUARDIAN -->
                        <div class="tab-pane fade" id="guardianTab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Primary Guardian Name</div>
                                    <div class="demo-value font-weight-bold text-dark" id="dGuardianName">Elena Clara
                                        Santos</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Relationship to Student</div>
                                    <div class="demo-value" id="dGuardianRelation">Mother</div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="demo-label">Guardian Mobile / Emergency Contact</div>
                                    <div class="demo-value text-success font-weight-bold" id="dGuardianPhone"><i
                                            class="fas fa-phone-alt mr-1"></i>0918-554-3210</div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="demo-label">Guardian Occupation</div>
                                    <div class="demo-value" id="dGuardianOccupation">Public School Teacher</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Father's Full Name</div>
                                    <div class="demo-value" id="dFatherName">Roberto Santos</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Mother's Maiden Name</div>
                                    <div class="demo-value" id="dMotherName">Elena Clara Cruz</div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 5: SOCIO-ECONOMIC -->
                        <div class="tab-pane fade" id="socioTab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Household Income Bracket</div>
                                    <div class="demo-value" id="dIncome">₱20,000 - ₱40,000 / month</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">4Ps Household Beneficiary</div>
                                    <div class="demo-value" id="d4ps"><span class="badge badge-pill badge-success">Yes
                                            (Beneficiary)</span></div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="demo-label">Distance to School</div>
                                    <div class="demo-value" id="dDistance">3.2 km</div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="demo-label">Mode of Transportation</div>
                                    <div class="demo-value" id="dTransport">Public Jeepney / Tricycle</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="demo-label">Primary Household Caregiver</div>
                                    <div class="demo-value" id="dCaregiver">Parents</div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 6: MEDICAL HISTORY -->
                        <div class="tab-pane fade" id="medTab" role="tabpanel">
                            <div class="row" id="popMedContent">
                                <!-- Populated by JS -->
                            </div>
                        </div>

                        <!-- TAB 7: ALLERGIES & CONDITIONS -->
                        <div class="tab-pane fade" id="algTab" role="tabpanel">
                            <div class="row" id="popAlgContent">
                                <!-- Populated by JS -->
                            </div>
                        </div>

                        <!-- TAB 8: EMERGENCY CONTACTS -->
                        <div class="tab-pane fade" id="emgTab" role="tabpanel">
                            <div class="row" id="popEmgContent">
                                <!-- Populated by JS -->
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light d-flex justify-content-between align-items-center">
                    <button class="btn btn-outline-primary btn-sm" onclick="printCurrentRoster()">
                        <i class="fas fa-print mr-1"></i> Print Student File
                    </button>
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGOUT MODAL -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current clinic session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toastNotification" class="toast toast-notification bg-success text-white p-3 rounded shadow-lg"
        role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fa-2x mr-3"></i>
            <div>
                <strong class="d-block" id="toastTitle">Success!</strong>
                <span class="small" id="toastMessage">Record updated successfully.</span>
            </div>
        </div>
    </div>
<!-- Unified Master Script for Student Health Profile Hub -->
    <script>
        // =========================================================================
        // DATASETS & DYNAMIC STORAGE LOADING
        // =========================================================================
                const masterStudentsSeed = [
            {
                id: 1,
                lrn: "22B0023",
                idNumber: "22B0023",
                fullName: "Rex Mark Ricafranca",
                firstName: "Rex Mark",
                lastName: "Ricafranca",
                avatar: "img/undraw_profile_2.svg",
                grade: "3rd Year",
                strand: "BS Political Science",
                section: "BS Political Science - 3rd Year",
                adviser: "Engr. Fernando Gonzales",
                sex: "Male",
                dob: "2006-03-14",
                age: 20,
                civilStatus: "Single",
                nationality: "Filipino",
                bloodType: "O+",
                religion: "Roman Catholic",
                philhealth: "12-09823999-8",
                address: "Brgy. Poblacion, Sta. Cruz, Marinduque",
                studentPhone: "0917-123-4567",
                studentEmail: "rex.ricafranca@student.msu.edu.ph",
                guardianName: "Rosa Ricafranca",
                guardianRelation: "Mother",
                guardianPhone: "0919-445-8812",
                guardianOccupation: "Nurse",
                fatherName: "Rogelio Ricafranca",
                motherName: "Rosa Alvarez",
                income: "â‚±40,000 - â‚±60,000 / month",
                is4ps: false,
                distance: "2.0 km",
                transport: "Commute",
                caregiver: "Parents",
                status: "Active Enrolled"
            },
            {
                id: 2,
                lrn: "21S0011",
                idNumber: "21S0011",
                fullName: "Mica Santos",
                firstName: "Mica",
                lastName: "Santos",
                avatar: "img/undraw_profile_1.svg",
                grade: "4th Year",
                strand: "BS Information System",
                section: "BS Information System - 4th Year",
                adviser: "Prof. Ricardo Mercado, M.Sc.",
                sex: "Female",
                dob: "2005-08-14",
                age: 21,
                civilStatus: "Single",
                nationality: "Filipino",
                bloodType: "O+",
                religion: "Roman Catholic",
                philhealth: "12-09823411-9",
                address: "Blk 12 Lot 4, Sunrise Village, Brgy. San Jose, Sta. Cruz, Marinduque",
                studentPhone: "0917-823-9912",
                studentEmail: "mica.santos@student.msu.edu.ph",
                guardianName: "Elena Clara Santos",
                guardianRelation: "Mother",
                guardianPhone: "0918-554-3210",
                guardianOccupation: "Public School Teacher",
                fatherName: "Roberto Santos",
                motherName: "Elena Clara Cruz",
                income: "â‚±25,000 - â‚±45,000 / month",
                is4ps: true,
                distance: "2.5 km",
                transport: "Public Tricycle",
                caregiver: "Mother",
                status: "Active Enrolled"
            }
        ];

        const masterMedicalSeed = [
            {
                id: 1,
                lrn: "22B0023",
                fullName: "Rex Mark Ricafranca",
                avatar: "img/undraw_profile_2.svg",
                grade: "3rd Year",
                strand: "BS Political Science",
                sex: "Male",
                age: 20,
                diagnoses: "Pre-Hypertension & Tension Cephalea",
                category: "Cardiovascular",
                onsetAge: "17 years old",
                physician: "Dr. Maria Santos, MD",
                conditionStatus: "Lifestyle Modification & Vitals Monitoring",
                clinicalNotes: "Reports episodic occipital headaches during exam reviews.",
                surgeries: [],
                hospitalizations: "None",
                maternalFamily: "Hypertension",
                paternalFamily: "Type 2 Diabetes",
                familySummary: "Hypertension (Mother)",
                dailyMeds: "Omega 3 Supplement",
                rescueMeds: "Paracetamol 500mg",
                riskLevel: "Moderate Risk",
                peClearance: "Cleared for All Sports",
                clearanceExpiry: "August 20, 2027",
                peNotes: "BP check recommended before intensive athletics."
            },
            {
                id: 2,
                lrn: "21S0011",
                fullName: "Mica Santos",
                avatar: "img/undraw_profile_1.svg",
                grade: "4th Year",
                strand: "BS Information System",
                sex: "Female",
                age: 21,
                diagnoses: "Bronchial Asthma (Moderate Persistent)",
                category: "Respiratory",
                onsetAge: "8 years old",
                physician: "Dr. Fernando Bautista, MD (Pulmonologist)",
                conditionStatus: "Controlled with Inhaler",
                clinicalNotes: "Triggered by cold weather, dust, and prolonged exertion. Student carries Salbutamol rescue inhaler.",
                surgeries: [
                    { year: "2021", title: "Appendectomy", hospital: "Marinduque Provincial Hospital", details: "Admitted for appendicitis. Fully healed." }
                ],
                hospitalizations: "Appendectomy (2021)",
                maternalFamily: "Hypertension, Type 2 Diabetes Mellitus",
                paternalFamily: "Bronchial Asthma",
                familySummary: "Hypertension (Mother), Bronchial Asthma (Father)",
                dailyMeds: "Fluticasone Propionate 125mcg Inhaler - 1 puff twice daily",
                rescueMeds: "Salbutamol 100mcg Inhaler - 2 puffs as needed",
                riskLevel: "Moderate Risk",
                peClearance: "Fit for PE (With Warm-up Protocol)",
                clearanceExpiry: "June 30, 2027",
                peNotes: "Cleared for PE. Requires 10-min warm-up before intense exercise."
            }
        ];

        const masterAllergySeed = [
            {
                id: 1,
                lrn: "21S0011",
                fullName: "Mica Santos",
                avatar: "img/undraw_profile_1.svg",
                grade: "4th Year",
                strand: "BS Information System",
                sex: "Female",
                age: 21,
                allergen: "Dust Mites & Pollen",
                category: "Environmental",
                severity: "Moderate",
                symptoms: "Bronchospasm, sneezing, watery eyes, chest tightness",
                protocol: "Salbutamol 100mcg Inhaler (2 puffs) + Rest",
                epiDevice: "Salbutamol (Ventolin) Inhaler",
                storageLocation: "Student carries in bag + Clinic Cabinet #2",
                secondaryMed: "Fluticasone Spray",
                expDate: "August 2027",
                canteenFlag: "No",
                canteenNotes: "N/A",
                classPrecautions: "Keep computer labs well-ventilated and aircon regulated.",
                guardianContact: "Elena Clara Santos (Mother) - 0918-554-3210",
                physicianContact: "Dr. Maria Santos, MD",
                hospital: "Marinduque Provincial Hospital"
            }
        ];

        const masterContactSeed = [
            {
                id: 1,
                lrn: "22B0023",
                fullName: "Rex Mark Ricafranca",
                avatar: "img/undraw_profile_2.svg",
                grade: "3rd Year",
                strand: "BS Political Science",
                sex: "Male",
                primaryGuardian: "Rosa Ricafranca",
                relationship: "Mother",
                primaryPhone: "0919-445-8812",
                primaryLandline: "(042) 332-1144",
                primaryOccupation: "Nurse",
                primaryEmail: "rosa.ricafranca@gmail.com",
                secondaryGuardian: "Rogelio Ricafranca",
                secondaryRelation: "Father",
                secondaryPhone: "0917-123-4567",
                secondaryOccupation: "Civil Servant",
                address: "Brgy. Poblacion, Sta. Cruz, Marinduque",
                city: "Sta. Cruz",
                landmark: "Near Sta. Cruz Plaza",
                hospital: "Marinduque Provincial Hospital",
                hospitalPhone: "(042) 332-2111",
                doctor: "Dr. Maria Santos, MD",
                insurance: "PhilHealth ID: 12-09823999-8",
                status: "Verified",
                callProtocol: "1. Call Mother (Rosa Ricafranca) at 0919-445-8812."
            },
            {
                id: 2,
                lrn: "21S0011",
                fullName: "Mica Santos",
                avatar: "img/undraw_profile_1.svg",
                grade: "4th Year",
                strand: "BS Information System",
                sex: "Female",
                primaryGuardian: "Elena Clara Santos",
                relationship: "Mother",
                primaryPhone: "0918-554-3210",
                primaryLandline: "(042) 332-1122",
                primaryOccupation: "Public School Teacher",
                primaryEmail: "elena.santos@deped.gov.ph",
                secondaryGuardian: "Roberto Santos",
                secondaryRelation: "Father",
                secondaryPhone: "0917-334-9981",
                secondaryOccupation: "Civil Servant",
                address: "Blk 12 Lot 4, Sunrise Village, Brgy. San Jose, Sta. Cruz, Marinduque",
                city: "Sta. Cruz",
                landmark: "Near Barangay San Jose Hall",
                hospital: "Marinduque Provincial Hospital",
                hospitalPhone: "(042) 332-2111",
                doctor: "Dr. Maria Santos, MD",
                insurance: "PhilHealth ID: 12-09823411-9",
                status: "Verified",
                callProtocol: "1. Call Mother (Elena) at 0918-554-3210.\n2. Call Father (Roberto) at 0917-334-9981."
            }
        ];

        function loadDatasetFromStorage(storageKey, defaultSeed) {
            let data = [];
            try {
                if (window.SmartClinicDB && SmartClinicDB.getJson) {
                    data = SmartClinicDB.getJson(storageKey, []);
                }
                if (!Array.isArray(data) || data.length === 0) {
                    const stored = localStorage.getItem(storageKey);
                    if (stored) {
                        data = JSON.parse(stored);
                    }
                }
            } catch (e) {
                console.warn('Storage read error for key ' + storageKey, e);
            }

            if (!Array.isArray(data) || data.length === 0) {
                data = JSON.parse(JSON.stringify(defaultSeed));
            } else {
                // Merge default seeds if missing
                defaultSeed.forEach(seed => {
                    const seedKey = seed.lrn || seed.idNumber || seed.id;
                    if (!data.some(item => (item.lrn || item.idNumber || item.id) === seedKey)) {
                        data.push(seed);
                    }
                });
            }

            try {
                localStorage.setItem(storageKey, JSON.stringify(data));
            } catch (e) { }
            return data;
        }

        let studentDataset = loadDatasetFromStorage('shsms_students', masterStudentsSeed);
        let medicalDataset = loadDatasetFromStorage('shsms_medical_records', masterMedicalSeed);
        let allergyDataset = loadDatasetFromStorage('shsms_allergy_records', masterAllergySeed);
        let contactDataset = loadDatasetFromStorage('shsms_emergency_contacts', masterContactSeed);

        function reloadAllDatasets() {
            studentDataset = loadDatasetFromStorage('shsms_students', masterStudentsSeed);
            medicalDataset = loadDatasetFromStorage('shsms_medical_records', masterMedicalSeed);
            allergyDataset = loadDatasetFromStorage('shsms_allergy_records', masterAllergySeed);
            contactDataset = loadDatasetFromStorage('shsms_emergency_contacts', masterContactSeed);

            filterStudents();
            filterMedicalRecords();
            filterAllergies();
            filterContacts();

            if (document.getElementById('statTotalStudents')) {
                document.getElementById('statTotalStudents').innerText = studentDataset.length.toLocaleString();
            }
            if (document.getElementById('statTotalHistories')) {
                document.getElementById('statTotalHistories').innerText = medicalDataset.length.toLocaleString();
            }
            if (document.getElementById('statTotalAllergies')) {
                document.getElementById('statTotalAllergies').innerText = allergyDataset.length.toLocaleString();
            }
            if (document.getElementById('statTotalContacts')) {
                document.getElementById('statTotalContacts').innerText = contactDataset.length.toLocaleString();
            }
        }

        window.addEventListener('storage', function (e) {
            if (['shsms_students', 'shsms_medical_records', 'shsms_allergy_records', 'shsms_emergency_contacts', 'shsms_registered_patients', 'hssoRecords'].includes(e.key)) {
                reloadAllDatasets();
            }
        });
        window.addEventListener('smart-clinic-updated', function () {
            reloadAllDatasets();
        });


        // =========================================================================
        // HELPER UTILITIES
        // =========================================================================

        function getStrandBadgeClass(strand) {
            if (!strand) return 'badge-secondary';
            if (strand.includes('Information System') || strand.includes('BSIS')) return 'badge-stem';
            if (strand.includes('Tourism') || strand.includes('BSTM')) return 'badge-abm';
            if (strand.includes('Education') || strand.includes('BSED')) return 'badge-humss';
            if (strand.includes('Political') || strand.includes('BSPolSci') || strand.includes('POLSCI')) return 'badge-tvl';
            return 'badge-secondary';
        }

        function getCategoryTagClass(category) {
            switch (category) {
                case 'Respiratory': return 'tag-respiratory';
                case 'Cardiovascular': return 'tag-cardio';
                case 'Endocrine': return 'tag-endocrine';
                case 'Neurological': return 'tag-neuro';
                case 'Musculoskeletal': return 'tag-ortho';
                case 'Surgical': return 'tag-surgical';
                case 'Food & Dietary': return 'tag-food';
                case 'Medication / Drug': return 'tag-drug';
                case 'Environmental': return 'tag-environmental';
                case 'Insect Stings': return 'tag-insect';
                case 'Contact / Latex': return 'tag-contact';
                default: return 'tag-surgical';
            }
        }

        function getRiskBadgeClass(risk) {
            if (risk === 'High Alert' || (risk && risk.includes('Severe'))) return 'badge-alert-critical';
            if (risk === 'Moderate Risk' || (risk && risk.includes('Moderate'))) return 'badge-alert-moderate';
            return 'badge-alert-low';
        }

        function getTriageBadgeClass(triage) {
            if (!triage) return 'badge-triage-green';
            if (triage.includes('Red Tag') || triage.includes('Emergency')) return 'badge-triage-red';
            if (triage.includes('Yellow Tag') || triage.includes('Urgent')) return 'badge-triage-yellow';
            return 'badge-triage-green';
        }

        function getStatusBadgeClass(status) {
            if (status === 'Verified') return 'badge-contact-verified';
            if (status === 'Protocol Alert') return 'badge-contact-flagged';
            if (status === 'In Queue') return 'badge-status-queue';
            if (status === 'In Consultation') return 'badge-status-active';
            if (status === 'Discharged') return 'badge-status-discharged';
            return 'badge-contact-pending';
        }

        let currentActiveTab = 'demographics';

        function setActiveTab(tabKey) {
            currentActiveTab = tabKey;
            const btn = document.getElementById('btnAddRecord');
            if (!btn) return;
            if (tabKey === 'demographics') {
                btn.innerHTML = `<i class="fas fa-user-plus fa-sm text-white-50 mr-1"></i> Add Student Demographic`;
                btn.setAttribute('data-target', '#addStudentModal');
                btn.style.display = 'inline-block';
            } else if (tabKey === 'medical') {
                btn.innerHTML = `<i class="fas fa-plus-circle fa-sm text-white-50 mr-1"></i> Log Medical History`;
                btn.setAttribute('data-target', '#addMedicalModal');
                btn.style.display = 'inline-block';
            } else if (tabKey === 'allergies') {
                btn.innerHTML = `<i class="fas fa-plus-circle fa-sm text-white-50 mr-1"></i> Log Allergy Record`;
                btn.setAttribute('data-target', '#addAllergyModal');
                btn.style.display = 'inline-block';
            }
        }


        // =========================================================================
        // RENDERING & FILTERING - DEMOGRAPHICS
        // =========================================================================

        function renderStudentsTable(data) {
            const tbody = document.getElementById('studentsTableBody');
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted"><p class="font-weight-bold">No student demographic records found.</p></td></tr>`;
                return;
            }
            data.forEach(s => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="pl-4 font-weight-bold text-dark">${s.lrn}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${s.avatar}" alt="Avatar" class="avatar-circle mr-2">
                            <div>
                                <div class="font-weight-bold text-dark">${s.fullName}</div>
                                <div class="text-xs text-muted">${s.studentEmail}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="font-weight-bold text-dark">${s.grade}</span>
                        <div class="mt-1"><span class="badge badge-strand ${getStrandBadgeClass(s.strand)}">${s.strand}</span></div>
                    </td>
                    <td>
                        <span class="text-dark font-weight-semibold">${s.sex}</span>
                        <div class="text-xs text-muted">${s.age} yrs old</div>
                    </td>
                    <td>
                        <div class="font-weight-semibold text-dark">${s.guardianName}</div>
                        <div class="text-xs text-muted"><i class="fas fa-heart text-danger mr-1"></i>${s.guardianRelation}</div>
                    </td>
                    <td>
                        <div class="text-dark font-weight-bold"><i class="fas fa-phone-alt text-success mr-1"></i>${s.guardianPhone}</div>
                        <div class="text-xs text-muted"><i class="fas fa-user-shield text-primary mr-1"></i>${s.guardianName} (${s.guardianRelation})</div>
                    </td>
                    <td>
                        <div class="text-xs text-muted" style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${s.address}">
                            <i class="fas fa-map-marker-alt text-danger mr-1"></i>${s.address}
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-pill badge-success px-2 py-1">${s.status}</span>
                    </td>
                    <td class="text-center pr-4">
                        <a href="studentdetail.html?id=${s.id}" class="btn btn-sm btn-circle btn-primary mr-1" title="Tingnan ang Impormasyon / View Patient Info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="studentdetail.html?id=${s.id}#medical" class="btn btn-sm btn-circle btn-danger" title="Past History / Tingnan ang Nakaraang Medikal">
                            <i class="fas fa-history"></i>
                        </a>
                    </td>`;
                tbody.appendChild(tr);
            });
            document.getElementById('demoRecordCountBadge').innerText = `Showing ${data.length} students`;
        }

        function renderStudentsGrid(data) {
            const gridContainer = document.getElementById('demoGridViewContainer');
            gridContainer.innerHTML = '';
            if (data.length === 0) {
                gridContainer.innerHTML = `<div class="col-12 text-center py-5 text-muted"><p class="font-weight-bold">No matching student cards.</p></div>`;
                return;
            }
            data.forEach(s => {
                const col = document.createElement('div');
                col.className = 'col-xl-4 col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card student-grid-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="${s.avatar}" class="avatar-circle-lg mr-3">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">${s.fullName}</h6>
                                    <div class="text-xs text-muted mb-1">LRN: ${s.lrn}</div>
                                    <span class="badge badge-strand ${getStrandBadgeClass(s.strand)}">${s.strand}</span>
                                    <span class="badge badge-light border text-dark ml-1">${s.grade}</span>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row text-xs mb-3">
                                <div class="col-12">
                                    <span class="text-muted d-block">Guardian Contact:</span>
                                    <strong class="text-success"><i class="fas fa-phone-alt mr-1"></i>${s.guardianName} (${s.guardianPhone})</strong>
                                </div>
                            </div>
                            <div class="d-flex" style="gap: 6px;">
                                <a href="studentdetail.html?id=${s.id}" class="btn btn-sm text-white font-weight-bold flex-grow-1" style="background-color: var(--maroon-primary);">
                                    <i class="fas fa-eye mr-1"></i> View Info
                                </a>
                                <a href="studentdetail.html?id=${s.id}#medical" class="btn btn-sm btn-outline-danger font-weight-bold" title="View Past History">
                                    <i class="fas fa-history mr-1"></i> Past History
                                </a>
                            </div>
                        </div>
                    </div>`;
                gridContainer.appendChild(col);
            });
        }

        function filterStudents() {
            const query = document.getElementById('searchDemoInput').value.toLowerCase().trim();
            const grade = document.getElementById('gradeDemoFilter').value;
            const strand = document.getElementById('strandDemoFilter').value;
            const sex = document.getElementById('sexDemoFilter').value;

            const filtered = studentDataset.filter(s => {
                const matchesQuery = !query || s.fullName.toLowerCase().includes(query) || s.lrn.includes(query) || s.guardianName.toLowerCase().includes(query);
                const matchesGrade = !grade || s.grade === grade;
                const matchesStrand = !strand || s.strand === strand;
                const matchesSex = !sex || s.sex === sex;
                return matchesQuery && matchesGrade && matchesStrand && matchesSex;
            });
            renderStudentsTable(filtered);
            renderStudentsGrid(filtered);
        }


        // =========================================================================
        // RENDERING & FILTERING - PATIENT REGISTRATION
        // =========================================================================

        function renderPatientTable(data) {
            const tbody = document.getElementById('patientTableBody');
            if (!tbody) return;
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash fa-3x mb-3 text-gray-300"></i>
                            <p class="mb-0 font-weight-bold">No patient registration intake records found.</p>
                            <span class="small">Try resetting your search query or dropdown filter selection.</span>
                        </td>
                    </tr>`;
                return;
            }

            data.forEach(p => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="pl-4">
                        <span class="ticket-pill">${p.ticket}</span>
                        <div class="text-xs text-muted mt-1"><i class="fas fa-clock mr-1"></i>${p.checkinTime}</div>
                    </td>
                    <td class="font-weight-bold text-dark">${p.lrn}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${p.avatar}" alt="Avatar" class="avatar-circle mr-2">
                            <div>
                                <div class="font-weight-bold text-dark">${p.fullName}</div>
                                <div class="text-xs text-muted">${p.sex}, ${p.age} yrs</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="font-weight-bold text-dark">${p.grade}</span>
                        <div class="text-xs text-muted">${p.strand}</div>
                    </td>
                    <td>
                        <div class="font-weight-bold text-dark">${p.complaint}</div>
                        <div class="text-xs text-muted">${p.onset}</div>
                    </td>
                    <td>
                        <div class="text-xs text-dark font-weight-bold">T: <span class="text-primary">${p.temp}</span> | BP: ${p.bp}</div>
                        <div class="text-xs text-muted">Pulse: ${p.pulse} | SpO2: ${p.spO2}</div>
                    </td>
                    <td>
                        <span class="${getTriageBadgeClass(p.triage)}">${p.triage}</span>
                    </td>
                    <td>
                        <span class="badge ${getStatusBadgeClass(p.status)} px-2 py-1">${p.status}</span>
                    </td>
                    <td class="text-center pr-4">
                        <button class="btn btn-sm btn-circle btn-primary" onclick="viewPatientDetails(${p.id})" title="View Intake Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-circle btn-success ml-1" onclick="startConsultation(${p.id})" title="Start Consultation">
                            <i class="fas fa-stethoscope"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            const countBadge = document.getElementById('regRecordCountBadge');
            if (countBadge) countBadge.innerText = `Showing ${data.length} patients`;
        }

        function renderPatientGrid(data) {
            const gridContainer = document.getElementById('regGridViewContainer');
            if (!gridContainer) return;
            gridContainer.innerHTML = '';

            if (data.length === 0) {
                gridContainer.innerHTML = `<div class="col-12 text-center py-5 text-muted"><p class="font-weight-bold">No patient registration cards found.</p></div>`;
                return;
            }

            data.forEach(p => {
                const col = document.createElement('div');
                col.className = 'col-xl-4 col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card pat-grid-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="ticket-pill">${p.ticket}</span>
                                <span class="badge ${getStatusBadgeClass(p.status)}">${p.status}</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="${p.avatar}" alt="Photo" class="avatar-circle-lg mr-3">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">${p.fullName}</h6>
                                    <div class="text-xs text-muted mb-1">LRN: ${p.lrn} | ${p.grade} - ${p.strand}</div>
                                    <span class="${getTriageBadgeClass(p.triage)}">${p.triage}</span>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="mb-2">
                                <span class="text-xs text-muted d-block">Chief Complaint:</span>
                                <strong class="text-danger font-weight-bold">${p.complaint}</strong>
                            </div>
                            <div class="row text-xs mb-3">
                                <div class="col-6">
                                    <span class="text-muted d-block">Vitals:</span>
                                    <strong class="text-dark">${p.temp} | BP: ${p.bp}</strong>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted d-block">Check-In Time:</span>
                                    <strong class="text-primary">${p.checkinTime}</strong>
                                </div>
                            </div>
                            <button class="btn btn-block btn-sm text-white font-weight-bold" style="background-color: var(--maroon-primary);" onclick="viewPatientDetails(${p.id})">
                                <i class="fas fa-notes-medical mr-1"></i> View Intake File
                            </button>
                        </div>
                    </div>`;
                gridContainer.appendChild(col);
            });
        }

        function filterRegistrations() {
            const query = (document.getElementById('searchRegInput')?.value || '').toLowerCase().trim();
            const triage = document.getElementById('triageRegFilter')?.value || '';
            const status = document.getElementById('statusRegFilter')?.value || '';
            const grade = document.getElementById('gradeRegFilter')?.value || '';

            const filtered = patientDataset.filter(p => {
                const matchesQuery = !query ||
                    p.fullName.toLowerCase().includes(query) ||
                    p.lrn.includes(query) ||
                    p.complaint.toLowerCase().includes(query) ||
                    p.ticket.toLowerCase().includes(query);

                const matchesTriage = !triage || p.triage === triage;
                const matchesStatus = !status || p.status === status;
                const matchesGrade = !grade || p.grade === grade;

                return matchesQuery && matchesTriage && matchesStatus && matchesGrade;
            });

            renderPatientTable(filtered);
            renderPatientGrid(filtered);
        }

        function viewPatientDetails(id) {
            const pat = patientDataset.find(p => p.id === id);
            if (!pat) return;

            document.getElementById('pViewAvatar').src = pat.avatar;
            document.getElementById('pViewFullName').innerText = pat.fullName;
            document.getElementById('pViewTicket').innerHTML = `<i class="fas fa-ticket-alt mr-1"></i>Ticket: ${pat.ticket}`;
            document.getElementById('pViewStrand').innerText = `${pat.strand} | ${pat.grade}`;

            const trBadge = document.getElementById('pViewTriageBadge');
            trBadge.innerText = pat.triage;
            trBadge.className = getTriageBadgeClass(pat.triage);

            document.getElementById('pTicket').innerText = pat.ticket;
            document.getElementById('pCheckinTime').innerText = `${pat.checkinTime} (Today)`;
            document.getElementById('pLRN').innerText = pat.lrn;
            document.getElementById('pSexAgeBlood').innerText = `${pat.sex}, ${pat.age} yrs | Blood: ${pat.bloodType}`;
            document.getElementById('pGradeStrand').innerText = `${pat.grade} - ${pat.strand}`;
            document.getElementById('pAdviser').innerText = pat.adviser;

            document.getElementById('pComplaint').innerText = pat.complaint;
            document.getElementById('pOnset').innerText = pat.onset;
            document.getElementById('pPainScale').innerText = pat.painScale;
            document.getElementById('pAccompanying').innerText = pat.accompanying;

            document.getElementById('pTemp').innerText = pat.temp;
            document.getElementById('pBP').innerText = pat.bp;
            document.getElementById('pPulse').innerText = pat.pulse;
            document.getElementById('pSpO2').innerText = pat.spO2;

            document.getElementById('pTriageLevel').innerHTML = `<span class="${getTriageBadgeClass(pat.triage)}">${pat.triage}</span>`;
            document.getElementById('pAllergyAlert').innerText = pat.allergyAlert;
            document.getElementById('pTriageNotes').innerText = pat.triageNotes;

            document.getElementById('pAttending').innerText = pat.attending;
            document.getElementById('pRoom').innerText = pat.room;
            document.getElementById('pParentNotified').innerText = pat.parentNotified;
            document.getElementById('pClassPass').innerHTML = `<span class="badge badge-success px-3 py-2">${pat.classPass}</span>`;

            $('#viewPatientModal').modal('show');
        }

        function startConsultation(id) {
            const pat = patientDataset.find(p => p.id === id);
            if (pat) {
                pat.status = "In Consultation";
                filterRegistrations();
                showToast('Consultation Started', `Student ${pat.fullName} moved to Consultation Room.`);
            }
        }

        function registerWalkInFromDemo(lrn) {
            const student = studentDataset.find(s => s.lrn === lrn);
            if (student) {
                document.getElementById('regFormLrn').value = student.lrn;
                document.getElementById('regFormName').value = student.fullName;
                const gs = `${student.grade} - ${student.strand}`;
                const sel = document.getElementById('regFormGradeStrand');
                if (sel) {
                    for (let opt of sel.options) {
                        if (opt.value.includes(student.strand) && opt.value.includes(student.grade)) {
                            sel.value = opt.value;
                            break;
                        }
                    }
                }
            }
            $('#registerPatientModal').modal('show');
        }

        function saveNewPatientRegistration(e) {
            e.preventDefault();
            const inputs = e.target.querySelectorAll('input, select');

            const lrn = inputs[0].value;
            const fullName = inputs[1].value;
            const gradeStrand = inputs[2].value.split(' - ');
            const complaint = inputs[3].value;
            const triage = inputs[4].value;
            const temp = inputs[5].value + ' °C';
            const bp = inputs[6].value;
            const pulse = (inputs[7].value || '78') + ' bpm';
            const spO2 = (inputs[8].value || '98') + ' %';

            const newTicketNumber = `#CR-${100 + patientDataset.length + 1}`;
            const currentTimeStr = new Date().toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });

            const newPatient = {
                id: patientDataset.length + 1,
                ticket: newTicketNumber,
                checkinTime: currentTimeStr,
                lrn: lrn,
                fullName: fullName,
                avatar: 'img/undraw_profile_3.svg',
                grade: gradeStrand[0],
                strand: gradeStrand[1] || 'STEM',
                sex: 'Female',
                age: 17,
                bloodType: 'O+',
                adviser: 'Class Adviser',
                complaint: complaint,
                onset: 'Just Reported',
                painScale: '4 / 10',
                accompanying: 'Walk-in clinic registration intake.',
                temp: temp,
                bp: bp,
                pulse: pulse,
                spO2: spO2,
                triage: triage,
                allergyAlert: 'Standard Screening Performed',
                triageNotes: 'New patient intake registered at clinic reception.',
                attending: 'Nurse Administrative Officer',
                room: 'Clinic Reception / Bay 1',
                parentNotified: 'Not Required',
                classPass: 'Pending Consultation',
                status: 'In Queue'
            };

            patientDataset.unshift(newPatient);
            filterRegistrations();
            document.getElementById('statTotalToday').innerText = (42 + patientDataset.length - 6) + ' Patients';

            // AUTOMATICALLY SYNC TO LIVE QUEUE MANAGEMENT (TV DISPLAY MONITOR)
            try {
                let currentQueue = [];
                const storedQueue = localStorage.getItem('shsms_queue_dataset');
                if (storedQueue) {
                    currentQueue = JSON.parse(storedQueue);
                } else {
                    currentQueue = [
                        { id: 1, studentId: '2023001', fullName: 'Rex Mark Ricafranca', timeIn: '9:30 AM', timeOut: '—', status: 'Now Serving' },
                        { id: 2, studentId: '2023002', fullName: 'Angela Santos', timeIn: '9:32 AM', timeOut: '—', status: 'Next' },
                        { id: 3, studentId: '2023003', fullName: 'Daniel Reyes', timeIn: '9:34 AM', timeOut: '—', status: 'Next' },
                        { id: 4, studentId: '2023004', fullName: 'Maria Lopez', timeIn: '9:37 AM', timeOut: '—', status: 'Next' },
                        { id: 5, studentId: '2023005', fullName: 'John Dela Cruz', timeIn: '9:40 AM', timeOut: '—', status: 'Next' },
                        { id: 6, studentId: '2023006', fullName: 'Sophia Garcia', timeIn: '9:42 AM', timeOut: '—', status: 'Next' },
                        { id: 7, studentId: '2023007', fullName: 'Miguel Torres', timeIn: '9:45 AM', timeOut: '—', status: 'Next' },
                        { id: 8, studentId: '2023008', fullName: 'Ella Ramirez', timeIn: '9:48 AM', timeOut: '—', status: 'Next' }
                    ];
                }

                // Format student ID cleanly
                const studId = lrn ? (lrn.length > 7 ? lrn.slice(-7) : lrn) : ('20230' + String(currentQueue.length + 1).padStart(2, '0'));

                const newQueueEntry = {
                    id: Date.now(),
                    studentId: studId,
                    fullName: fullName,
                    timeIn: currentTimeStr,
                    timeOut: '—',
                    status: 'Next'
                };

                currentQueue.push(newQueueEntry);
                localStorage.setItem('shsms_queue_dataset', JSON.stringify(currentQueue));
            } catch (err) {
                console.error('Error syncing patient to queue dataset:', err);
            }

            $('#registerPatientModal').modal('hide');
            e.target.reset();
            showToast('Patient Registered & Added to Queue!', `Ticket ${newTicketNumber} issued for ${newPatient.fullName}. Automatically added to Live Queue Management.`);
        }

        function printClinicPasses() {
            window.print();
        }

        function printIndividualPass() {
            window.print();
        }

        function exportRegistrationData() {
            showToast('Export Started', 'Downloading Daily Patient Registration Log (CSV)...');
        }


        // =========================================================================
        // RENDERING & FILTERING - MEDICAL HISTORY
        // =========================================================================

        function renderMedicalTable(data) {
            const tbody = document.getElementById('medicalTableBody');
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted"><p class="font-weight-bold">No medical history records found.</p></td></tr>`;
                return;
            }
            data.forEach(m => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="pl-4 font-weight-bold text-dark">${m.lrn}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${m.avatar}" class="avatar-circle mr-2">
                            <div>
                                <div class="font-weight-bold text-dark">${m.fullName}</div>
                                <div class="text-xs text-muted">${m.sex}, ${m.age} yrs</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="font-weight-bold text-dark">${m.grade}</span>
                        <div class="text-xs text-muted">${m.strand}</div>
                    </td>
                    <td>
                        <div class="font-weight-bold text-dark">${m.diagnoses}</div>
                        <div class="mt-1"><span class="tag-category ${getCategoryTagClass(m.category)}">${m.category}</span></div>
                    </td>
                    <td>
                        <div class="text-xs text-muted" style="max-width: 170px;"><i class="fas fa-procedures text-info mr-1"></i>${m.hospitalizations}</div>
                    </td>
                    <td>
                        <div class="text-xs text-muted" style="max-width: 160px;"><i class="fas fa-dna text-purple mr-1"></i>${m.familySummary}</div>
                    </td>
                    <td>
                        <span class="${getRiskBadgeClass(m.riskLevel)}">${m.riskLevel}</span>
                    </td>
                    <td>
                        <div class="text-xs font-weight-bold text-dark"><i class="fas fa-check-circle text-success mr-1"></i>${m.peClearance}</div>
                    </td>
                    <td class="text-center pr-4">
                        <a href="studentdetail.html?lrn=${m.lrn}#tab-medical" class="btn btn-sm btn-circle btn-primary" title="View Full File"><i class="fas fa-eye"></i></a>
                    </td>`;
                tbody.appendChild(tr);
            });
            document.getElementById('medRecordCountBadge').innerText = `Showing ${data.length} records`;
        }

        function renderMedicalGrid(data) {
            const gridContainer = document.getElementById('medGridViewContainer');
            gridContainer.innerHTML = '';
            data.forEach(m => {
                const col = document.createElement('div');
                col.className = 'col-xl-4 col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card med-grid-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="${m.avatar}" class="avatar-circle-lg mr-3">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">${m.fullName}</h6>
                                    <div class="text-xs text-muted mb-1">LRN: ${m.lrn} | ${m.grade} - ${m.strand}</div>
                                    <span class="${getRiskBadgeClass(m.riskLevel)}">${m.riskLevel}</span>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="mb-2">
                                <span class="text-xs text-muted d-block">Diagnosis:</span>
                                <strong class="text-dark font-weight-bold">${m.diagnoses}</strong>
                                <div class="mt-1"><span class="tag-category ${getCategoryTagClass(m.category)}">${m.category}</span></div>
                            </div>
                            <a href="studentdetail.html?lrn=${m.lrn}#tab-medical" class="btn btn-block btn-sm text-white font-weight-bold" style="background-color: var(--maroon-primary);">
                                <i class="fas fa-file-medical mr-1"></i> View Medical File
                            </a>
                        </div>
                    </div>`;
                gridContainer.appendChild(col);
            });
        }

        function filterMedicalRecords() {
            const query = document.getElementById('searchMedInput').value.toLowerCase().trim();
            const category = document.getElementById('categoryMedFilter').value;
            const risk = document.getElementById('riskMedFilter').value;
            const grade = document.getElementById('gradeMedFilter').value;

            const filtered = medicalDataset.filter(m => {
                const matchesQuery = !query || m.fullName.toLowerCase().includes(query) || m.lrn.includes(query) || m.diagnoses.toLowerCase().includes(query);
                const matchesCategory = !category || m.category === category;
                const matchesRisk = !risk || m.riskLevel === risk;
                const matchesGrade = !grade || m.grade === grade;
                return matchesQuery && matchesCategory && matchesRisk && matchesGrade;
            });
            renderMedicalTable(filtered);
            renderMedicalGrid(filtered);
        }


        // =========================================================================
        // RENDERING & FILTERING - ALLERGIES & CONDITIONS
        // =========================================================================

        function renderAllergyTable(data) {
            const tbody = document.getElementById('allergyTableBody');
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted"><p class="font-weight-bold">No allergy records found.</p></td></tr>`;
                return;
            }
            data.forEach(a => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="pl-4 font-weight-bold text-dark">${a.lrn}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${a.avatar}" class="avatar-circle mr-2">
                            <div>
                                <div class="font-weight-bold text-dark">${a.fullName}</div>
                                <div class="text-xs text-muted">${a.sex}, ${a.age} yrs</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="font-weight-bold text-dark">${a.grade}</span>
                        <div class="text-xs text-muted">${a.strand}</div>
                    </td>
                    <td>
                        <div class="font-weight-bold text-dark">${a.allergen}</div>
                        <div class="mt-1"><span class="tag-category ${getCategoryTagClass(a.category)}">${a.category}</span></div>
                    </td>
                    <td>
                        <span class="${getRiskBadgeClass(a.severity)}">${a.severity}</span>
                    </td>
                    <td>
                        <div class="text-xs font-weight-bold text-dark"><i class="fas fa-first-aid text-danger mr-1"></i>${a.protocol}</div>
                    </td>
                    <td>
                        <span class="badge ${a.canteenFlag.includes('Yes') ? 'badge-danger' : 'badge-light border text-muted'}">${a.canteenFlag}</span>
                    </td>
                    <td class="text-center pr-4">
                        <a href="studentdetail.html?lrn=${a.lrn}#tab-allergies" class="btn btn-sm btn-circle btn-primary" title="View Emergency Protocol"><i class="fas fa-eye"></i></a>
                    </td>`;
                tbody.appendChild(tr);
            });
            document.getElementById('algRecordCountBadge').innerText = `Showing ${data.length} records`;
        }

        function renderAllergyGrid(data) {
            const gridContainer = document.getElementById('algGridViewContainer');
            gridContainer.innerHTML = '';
            data.forEach(a => {
                const col = document.createElement('div');
                col.className = 'col-xl-4 col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card alg-grid-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="${a.avatar}" class="avatar-circle-lg mr-3">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">${a.fullName}</h6>
                                    <div class="text-xs text-muted mb-1">LRN: ${a.lrn} | ${a.grade} - ${a.strand}</div>
                                    <span class="${getRiskBadgeClass(a.severity)}">${a.severity}</span>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="mb-2">
                                <span class="text-xs text-muted d-block">Allergen / Condition:</span>
                                <strong class="text-danger font-weight-bold">${a.allergen}</strong>
                                <div class="mt-1"><span class="tag-category ${getCategoryTagClass(a.category)}">${a.category}</span></div>
                            </div>
                            <a href="studentdetail.html?lrn=${a.lrn}#tab-allergies" class="btn btn-block btn-sm text-white font-weight-bold" style="background-color: var(--maroon-primary);">
                                <i class="fas fa-shield-alt mr-1"></i> View Emergency Card
                            </a>
                        </div>
                    </div>`;
                gridContainer.appendChild(col);
            });
        }

        function filterAllergies() {
            const query = document.getElementById('searchAlgInput').value.toLowerCase().trim();
            const category = document.getElementById('categoryAlgFilter').value;
            const severity = document.getElementById('severityAlgFilter').value;
            const grade = document.getElementById('gradeAlgFilter').value;

            const filtered = allergyDataset.filter(a => {
                const matchesQuery = !query || a.fullName.toLowerCase().includes(query) || a.lrn.includes(query) || a.allergen.toLowerCase().includes(query);
                const matchesCategory = !category || a.category === category;
                const matchesSeverity = !severity || a.severity === severity;
                const matchesGrade = !grade || a.grade === grade;
                return matchesQuery && matchesCategory && matchesSeverity && matchesGrade;
            });
            renderAllergyTable(filtered);
            renderAllergyGrid(filtered);
        }


        // =========================================================================
        // RENDERING & FILTERING - EMERGENCY CONTACTS
        // =========================================================================

        function renderContactTable(data) {
            const tbody = document.getElementById('contactTableBody');
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted"><p class="font-weight-bold">No emergency contact records found.</p></td></tr>`;
                return;
            }
            data.forEach(c => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="pl-4 font-weight-bold text-dark">${c.lrn}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${c.avatar}" class="avatar-circle mr-2">
                            <div>
                                <div class="font-weight-bold text-dark">${c.fullName}</div>
                                <div class="text-xs text-muted">${c.sex}, Grade ${c.grade.replace('Grade ', '')}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="font-weight-bold text-dark">${c.grade}</span>
                        <div class="text-xs text-muted">${c.strand}</div>
                    </td>
                    <td>
                        <div class="font-weight-bold text-dark">${c.primaryGuardian}</div>
                        <div class="text-xs text-primary font-weight-semibold"><i class="fas fa-user-tag mr-1"></i>${c.relationship}</div>
                    </td>
                    <td>
                        <span class="badge badge-light border text-dark font-weight-bold">${c.relationship}</span>
                    </td>
                    <td>
                        <div class="font-weight-bold text-success mb-1"><i class="fas fa-phone-alt mr-1"></i>${c.primaryPhone}</div>
                        <div>
                            <a href="tel:${c.primaryPhone}" class="btn btn-call-quick mr-1"><i class="fas fa-phone-volume mr-1"></i>Call</a>
                            <button class="btn btn-sms-quick" onclick="sendSmsModal('${c.primaryGuardian}', '${c.primaryPhone}')"><i class="fas fa-comment-alt mr-1"></i>SMS</button>
                        </div>
                    </td>
                    <td>
                        <div class="font-weight-semibold text-dark">${c.secondaryGuardian}</div>
                        <div class="text-xs text-muted"><i class="fas fa-phone-alt mr-1"></i>${c.secondaryPhone}</div>
                    </td>
                    <td>
                        <span class="${getStatusBadgeClass(c.status)}">${c.status}</span>
                    </td>
                    <td class="text-center pr-4">
                        <a href="studentdetail.html?lrn=${c.lrn}#tab-emergency" class="btn btn-sm btn-circle btn-primary" title="View Profile"><i class="fas fa-eye"></i></a>
                    </td>`;
                tbody.appendChild(tr);
            });
            document.getElementById('cntRecordCountBadge').innerText = `Showing ${data.length} records`;
        }

        function renderContactGrid(data) {
            const gridContainer = document.getElementById('cntGridViewContainer');
            gridContainer.innerHTML = '';
            data.forEach(c => {
                const col = document.createElement('div');
                col.className = 'col-xl-4 col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card cnt-grid-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="${c.avatar}" class="avatar-circle-lg mr-3">
                                <div>
                                    <h6 class="font-weight-bold mb-0 text-dark">${c.fullName}</h6>
                                    <div class="text-xs text-muted mb-1">LRN: ${c.lrn} | ${c.grade} - ${c.strand}</div>
                                    <span class="${getStatusBadgeClass(c.status)}">${c.status}</span>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="mb-2">
                                <span class="text-xs text-muted d-block">Primary Guardian (${c.relationship}):</span>
                                <strong class="text-dark font-weight-bold">${c.primaryGuardian}</strong>
                                <div class="text-success font-weight-bold mt-1"><i class="fas fa-phone-alt mr-1"></i>${c.primaryPhone}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="tel:${c.primaryPhone}" class="btn btn-sm btn-success font-weight-bold flex-grow-1 mr-2"><i class="fas fa-phone-volume mr-1"></i> Call Now</a>
                                <a href="studentdetail.html?lrn=${c.lrn}#tab-emergency" class="btn btn-sm text-white font-weight-bold" style="background-color: var(--maroon-primary);"><i class="fas fa-eye"></i> Profile</a>
                            </div>
                        </div>
                    </div>`;
                gridContainer.appendChild(col);
            });
        }

        function filterContacts() {
            const query = document.getElementById('searchCntInput').value.toLowerCase().trim();
            const relation = document.getElementById('relationCntFilter').value;
            const status = document.getElementById('statusCntFilter').value;
            const grade = document.getElementById('gradeCntFilter').value;

            const filtered = contactDataset.filter(c => {
                const matchesQuery = !query || c.fullName.toLowerCase().includes(query) || c.lrn.includes(query) || c.primaryGuardian.toLowerCase().includes(query) || c.primaryPhone.includes(query);
                const matchesRelation = !relation || c.relationship === relation;
                const matchesStatus = !status || c.status === status;
                const matchesGrade = !grade || c.grade === grade;
                return matchesQuery && matchesRelation && matchesStatus && matchesGrade;
            });
            renderContactTable(filtered);
            renderContactGrid(filtered);
        }


        // =========================================================================
        // VIEW SWITCHER & MODAL POPULATION
        // =========================================================================

        function switchView(moduleKey, type) {
            let tableCont, gridCont, btnTable, btnGrid;
            if (moduleKey === 'demographics') {
                tableCont = document.getElementById('demoTableViewContainer');
                gridCont = document.getElementById('demoGridViewContainer');
                btnTable = document.getElementById('btnDemoTableView');
                btnGrid = document.getElementById('btnDemoGridView');
            } else if (moduleKey === 'registration') {
                tableCont = document.getElementById('regTableViewContainer');
                gridCont = document.getElementById('regGridViewContainer');
                btnTable = document.getElementById('btnRegTableView');
                btnGrid = document.getElementById('btnRegGridView');
            } else if (moduleKey === 'medical') {
                tableCont = document.getElementById('medTableViewContainer');
                gridCont = document.getElementById('medGridViewContainer');
                btnTable = document.getElementById('btnMedTableView');
                btnGrid = document.getElementById('btnMedGridView');
            } else if (moduleKey === 'allergies') {
                tableCont = document.getElementById('algTableViewContainer');
                gridCont = document.getElementById('algGridViewContainer');
                btnTable = document.getElementById('btnAlgTableView');
                btnGrid = document.getElementById('btnAlgGridView');
            } else if (moduleKey === 'emergency') {
                tableCont = document.getElementById('cntTableViewContainer');
                gridCont = document.getElementById('cntGridViewContainer');
                btnTable = document.getElementById('btnCntTableView');
                btnGrid = document.getElementById('btnCntGridView');
            }

            if (type === 'table') {
                tableCont.classList.remove('d-none');
                gridCont.classList.add('d-none');
                btnTable.classList.add('active');
                btnGrid.classList.remove('active');
            } else {
                tableCont.classList.add('d-none');
                gridCont.classList.remove('d-none');
                btnGrid.classList.add('active');
                btnTable.classList.remove('active');
            }
        }

        function viewStudentDetails(studentId) {
            window.location.href = `studentdetail.html?id=${studentId}`;
        }

        function openStudentViewModal(idOrLrn) {
            const s = studentDataset.find(item => String(item.id) === String(idOrLrn) || String(item.lrn) === String(idOrLrn) || String(item.idNumber) === String(idOrLrn)) || studentDataset[0];
            if (!s) return;

            const med = medicalDataset.find(m => m.lrn === s.lrn || m.lrn === s.idNumber || String(m.id) === String(s.id)) || {};
            const alg = allergyDataset.find(a => a.lrn === s.lrn || a.lrn === s.idNumber || String(a.id) === String(s.id)) || {};
            const emg = contactDataset.find(c => c.lrn === s.lrn || c.lrn === s.idNumber || String(c.id) === String(s.id)) || {};

            // Modal Header Banner
            const avatarEl = document.getElementById('viewAvatar');
            if (avatarEl) avatarEl.src = s.avatar || (s.sex === 'Female' ? 'img/undraw_profile_1.svg' : 'img/undraw_profile_2.svg');
            
            const fnEl = document.getElementById('viewFullName');
            if (fnEl) fnEl.innerText = s.fullName || `${s.firstName || ''} ${s.lastName || ''}`.trim();

            const lrnEl = document.getElementById('viewLRN');
            if (lrnEl) lrnEl.innerHTML = `<i class="fas fa-id-badge mr-1"></i>Student ID: ${s.lrn || s.idNumber || 'N/A'}`;

            const strandEl = document.getElementById('viewStrandBadge');
            if (strandEl) {
                strandEl.innerText = s.strand || s.courseOrPos || 'BS Information System';
                strandEl.className = `badge badge-strand ${getStrandBadgeClass(s.strand || s.courseOrPos)} mr-2`;
            }

            const statusEl = document.getElementById('viewStatusBadge');
            if (statusEl) statusEl.innerText = s.status || 'Active Enrolled';

            // Tab 1: Identity
            if (document.getElementById('dFullName')) document.getElementById('dFullName').innerText = s.fullName || `${s.firstName || ''} ${s.lastName || ''}`.trim();
            if (document.getElementById('dLRN')) document.getElementById('dLRN').innerText = s.lrn || s.idNumber || 'N/A';
            if (document.getElementById('dDOB')) document.getElementById('dDOB').innerText = s.dob || '2004-05-15';
            if (document.getElementById('dAgeSex')) document.getElementById('dAgeSex').innerText = `${s.age || 20} yrs old | ${s.sex || 'Female'}`;
            if (document.getElementById('dCivilStatus')) document.getElementById('dCivilStatus').innerText = s.civilStatus || 'Single';
            if (document.getElementById('dNationality')) document.getElementById('dNationality').innerText = s.nationality || 'Filipino';
            if (document.getElementById('dBloodType')) document.getElementById('dBloodType').innerText = s.bloodType || 'O+';
            if (document.getElementById('dReligion')) document.getElementById('dReligion').innerText = s.religion || 'Roman Catholic';
            if (document.getElementById('dPhilhealth')) document.getElementById('dPhilhealth').innerText = s.philhealth || '12-09823411-9';

            // Tab 2: Academic
            if (document.getElementById('dGradeLevel')) document.getElementById('dGradeLevel').innerText = s.grade || '1st Year';
            if (document.getElementById('dStrand')) document.getElementById('dStrand').innerText = s.strand || s.courseOrPos || 'BS Information System';
            if (document.getElementById('dSection')) document.getElementById('dSection').innerText = s.section || 'Section A';
            if (document.getElementById('dAdviser')) document.getElementById('dAdviser').innerText = s.adviser || 'Assigned Academic Adviser';

            // Tab 3: Contact & Address
            const fullAddr = s.address || s.presentAddress || 'Sta. Cruz, Marinduque';
            if (document.getElementById('dPresentAddress')) document.getElementById('dPresentAddress').innerText = fullAddr;
            if (document.getElementById('dPermanentAddress')) document.getElementById('dPermanentAddress').innerText = fullAddr;
            if (document.getElementById('dStudentPhone')) document.getElementById('dStudentPhone').innerText = s.studentPhone || s.guardianPhone || s.guardianContact || '0918-000-0000';
            if (document.getElementById('dStudentEmail')) document.getElementById('dStudentEmail').innerText = s.studentEmail || s.email || `${(s.firstName || 'student').toLowerCase().replace(/[^a-z]/g, '')}@student.msu.edu.ph`;

            // Tab 4: Parent / Guardian
            if (document.getElementById('dGuardianName')) document.getElementById('dGuardianName').innerText = s.guardianName || 'Guardian';
            if (document.getElementById('dGuardianRelation')) document.getElementById('dGuardianRelation').innerText = s.guardianRelation || 'Parent';
            if (document.getElementById('dGuardianPhone')) document.getElementById('dGuardianPhone').innerText = s.guardianPhone || s.guardianContact || '0918-000-0000';
            if (document.getElementById('dGuardianOccupation')) document.getElementById('dGuardianOccupation').innerText = s.guardianOccupation || 'Employed';
            if (document.getElementById('dFatherName')) document.getElementById('dFatherName').innerText = s.fatherName || 'N/A';
            if (document.getElementById('dMotherName')) document.getElementById('dMotherName').innerText = s.motherName || s.guardianName || 'N/A';

            // Tab 5: Socio-Economic
            if (document.getElementById('dIncome')) document.getElementById('dIncome').innerText = s.income || '₱25,000 - ₱45,000 / month';
            if (document.getElementById('d4ps')) document.getElementById('d4ps').innerHTML = s.is4ps ? `<span class="badge badge-pill badge-success">Yes (4Ps Beneficiary)</span>` : `<span class="badge badge-pill badge-secondary">Non-4Ps</span>`;
            if (document.getElementById('dDistance')) document.getElementById('dDistance').innerText = s.distance || '2.5 km';
            if (document.getElementById('dTransport')) document.getElementById('dTransport').innerText = s.transport || 'Commute / Public Transit';
            if (document.getElementById('dCaregiver')) document.getElementById('dCaregiver').innerText = s.caregiver || s.guardianRelation || 'Parent';

            // Tab 6: Medical History
            const medContainer = document.getElementById('popMedContent');
            if (medContainer) {
                if (med.diagnoses) {
                    medContainer.innerHTML = `
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Primary Diagnosis</div>
                            <div class="demo-value font-weight-bold text-danger">${med.diagnoses}</div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="demo-label">Category</div>
                            <div class="demo-value"><span class="badge badge-info">${med.category || 'General'}</span></div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="demo-label">Onset</div>
                            <div class="demo-value">${med.onsetAge || 'Childhood'}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Attending Physician</div>
                            <div class="demo-value"><i class="fas fa-user-md text-primary mr-1"></i>${med.physician || 'Dr. Maria Santos, MD'}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Condition Status</div>
                            <div class="demo-value">${med.conditionStatus || 'Controlled'}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Daily Maintenance Medication</div>
                            <div class="demo-value text-primary"><i class="fas fa-pills mr-1"></i>${med.dailyMeds || 'None'}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Emergency Rescue Medication</div>
                            <div class="demo-value text-danger"><i class="fas fa-first-aid mr-1"></i>${med.rescueMeds || 'None'}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="demo-label">Clinical Notes & Precautions</div>
                            <div class="p-2 bg-light rounded text-xs text-dark border">${med.clinicalNotes || 'No specific clinical restrictions recorded.'}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="demo-label">PE & Sports Clearance</div>
                            <div class="demo-value"><span class="badge badge-success">${med.peClearance || 'Cleared for All Sports'}</span></div>
                        </div>
                        <div class="col-md-6">
                            <div class="demo-label">Clearance Expiration</div>
                            <div class="demo-value text-muted">${med.clearanceExpiry || 'Valid for Current School Year'}</div>
                        </div>
                    `;
                } else {
                    medContainer.innerHTML = `
                        <div class="col-12 text-center py-4 text-muted">
                            <i class="fas fa-notes-medical fa-2x mb-2 text-gray-300"></i>
                            <p class="font-weight-bold mb-0 text-dark">Walang Nakatalang Malalang Karamdaman / No Chronic Conditions</p>
                            <small class="text-muted">Cleared for all standard academic and physical education activities.</small>
                        </div>
                    `;
                }
            }

            // Tab 7: Allergies
            const algContainer = document.getElementById('popAlgContent');
            if (algContainer) {
                if (alg.allergen) {
                    algContainer.innerHTML = `
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Known Allergen</div>
                            <div class="demo-value font-weight-bold text-danger"><i class="fas fa-allergies mr-1"></i>${alg.allergen}</div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="demo-label">Category</div>
                            <div class="demo-value">${alg.category || 'General'}</div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="demo-label">Severity Level</div>
                            <div class="demo-value"><span class="badge badge-danger">${alg.severity || 'Moderate'}</span></div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="demo-label">Reaction Symptoms</div>
                            <div class="demo-value text-dark">${alg.symptoms || 'Urticaria, sneezing, pruritus'}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="demo-label">Emergency Action Protocol</div>
                            <div class="p-3 bg-danger-light border border-danger rounded text-xs text-danger font-weight-bold" style="background-color: #fff5f5;">
                                <i class="fas fa-exclamation-triangle mr-1"></i>${(alg.protocol || 'Administer antihistamine. Escort to clinic immediately.').replace(/\n/g, '<br>')}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Emergency Device / Auto-Injector</div>
                            <div class="demo-value text-primary"><i class="fas fa-syringe mr-1"></i>${alg.epiDevice || 'Antihistamine Oral Tablets'}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="demo-label">Medication Storage Location</div>
                            <div class="demo-value text-dark"><i class="fas fa-map-marker-alt text-danger mr-1"></i>${alg.storageLocation || 'Clinic Cabinet #2'}</div>
                        </div>
                        <div class="col-12">
                            <div class="demo-label">Canteen & Cafeteria Flag</div>
                            <div class="demo-value">${alg.canteenFlag && alg.canteenFlag.includes('Yes') ? '<span class="badge badge-danger">Active Dietary Canteen Flag</span>' : '<span class="badge badge-success">No Canteen Food Restriction</span>'}</div>
                        </div>
                    `;
                } else {
                    algContainer.innerHTML = `
                        <div class="col-12 text-center py-4 text-muted">
                            <i class="fas fa-shield-alt fa-2x mb-2 text-success"></i>
                            <p class="font-weight-bold mb-0 text-success">Walang Kilalang Allergy / No Known Allergies (NKA)</p>
                            <small class="text-muted">Walang bawal na gamot o pagkain na naitala sa clinic database.</small>
                        </div>
                    `;
                }
            }

            // Tab 8: Emergency Contacts
            const emgContainer = document.getElementById('popEmgContent');
            if (emgContainer) {
                emgContainer.innerHTML = `
                    <div class="col-md-6 mb-3">
                        <div class="card bg-light border-0 p-3 h-100">
                            <div class="font-weight-bold text-dark mb-1"><i class="fas fa-user-shield text-primary mr-1"></i>Primary Contact</div>
                            <div class="h6 font-weight-bold text-dark mb-0">${emg.primaryGuardian || s.guardianName || 'Primary Guardian'}</div>
                            <div class="text-xs text-muted mb-2">Relationship: ${emg.relationship || s.guardianRelation || 'Parent'}</div>
                            <div class="text-sm font-weight-bold text-success"><i class="fas fa-phone-alt mr-1"></i>${emg.primaryPhone || s.guardianPhone || s.guardianContact || '0918-000-0000'}</div>
                            <div class="text-xs text-muted mt-1">Occupation: ${emg.primaryOccupation || s.guardianOccupation || 'Employed'}</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card bg-light border-0 p-3 h-100">
                            <div class="font-weight-bold text-dark mb-1"><i class="fas fa-user-friends text-info mr-1"></i>Secondary Contact</div>
                            <div class="h6 font-weight-bold text-dark mb-0">${emg.secondaryGuardian || s.fatherName || 'Secondary Contact'}</div>
                            <div class="text-xs text-muted mb-2">Relationship: ${emg.secondaryRelation || 'Father / Relative'}</div>
                            <div class="text-sm font-weight-bold text-primary"><i class="fas fa-phone-alt mr-1"></i>${emg.secondaryPhone || '0919-000-0000'}</div>
                            <div class="text-xs text-muted mt-1">Occupation: ${emg.secondaryOccupation || 'Employed'}</div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="p-3 bg-white border rounded">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="font-weight-bold text-dark"><i class="fas fa-hospital text-danger mr-1"></i>Preferred Emergency Hospital</span>
                                <span class="badge badge-light border text-danger font-weight-bold">${emg.hospitalPhone || '(042) 332-2111'}</span>
                            </div>
                            <div class="text-sm font-weight-bold text-danger">${emg.hospital || 'Marinduque Provincial Hospital'}</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-user-md text-primary mr-1"></i>Attending Family Physician: ${emg.doctor || 'Dr. Maria Santos, MD'}</div>
                            <div class="text-xs text-muted mt-1"><i class="fas fa-file-invoice text-success mr-1"></i>Health Insurance / PhilHealth: ${s.philhealth || '12-09823411-9'}</div>
                        </div>
                    </div>
                `;
            }

            // Reset tab to Identity
            $('#demoTabs a[href="#personalTab"]').tab('show');

            // Show modal
            $('#viewStudentModal').modal('show');
        }

        function viewMedicalFromTable(lrn) {
            window.location.href = `studentdetail.html?lrn=${lrn}#tab-medical`;
        }

        function viewAllergyFromTable(lrn) {
            window.location.href = `studentdetail.html?lrn=${lrn}#tab-allergies`;
        }

        function viewContactFromTable(lrn) {
            window.location.href = `studentdetail.html?lrn=${lrn}#tab-emergency`;
        }


        // =========================================================================
        // SEARCH, TOASTS & EXPORT
        // =========================================================================

        function globalSearch(val) {
            if (currentActiveTab === 'demographics') {
                document.getElementById('searchDemoInput').value = val;
                filterStudents();
            } else if (currentActiveTab === 'registration') {
                const regInput = document.getElementById('searchRegInput');
                if (regInput) regInput.value = val;
                filterRegistrations();
            } else if (currentActiveTab === 'medical') {
                document.getElementById('searchMedInput').value = val;
                filterMedicalRecords();
            } else if (currentActiveTab === 'allergies') {
                document.getElementById('searchAlgInput').value = val;
                filterAllergies();
            } else if (currentActiveTab === 'emergency') {
                document.getElementById('searchCntInput').value = val;
                filterContacts();
            }
        }

        function sendSmsModal(name, phone) {
            showToast('SMS Sent', `Emergency alert SMS dispatched to ${name} (${phone}).`);
        }

        function showToast(title, msg) {
            document.getElementById('toastTitle').innerText = title;
            document.getElementById('toastMessage').innerText = msg;
            $('#toastNotification').fadeIn().delay(3500).fadeOut();
        }

        function exportCurrentData() {
            if (currentActiveTab === 'registration') {
                exportRegistrationData();
            } else {
                showToast('Export Started', `Downloading ${currentActiveTab} roster in CSV format...`);
            }
        }

        function printCurrentRoster() {
            window.print();
        }

        // Hash auto tab select
        function checkUrlHash() {
            const hash = window.location.hash.toLowerCase();
            if (hash.includes('medical')) {
                $('#moduleHubTabs a[href="#tab-medical"]').tab('show');
                setActiveTab('medical');
            } else if (hash.includes('allergy') || hash.includes('allergies')) {
                $('#moduleHubTabs a[href="#tab-allergies"]').tab('show');
                setActiveTab('allergies');
            } else {
                $('#moduleHubTabs a[href="#tab-demographics"]').tab('show');
                setActiveTab('demographics');
            }
        }

        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function () {
            reloadAllDatasets();
            checkUrlHash();
        });
    </script>\

<div class="container-fluid">

    <!-- Print-Only Official Document Header -->
    <div class="print-only-header text-center mb-4">
        <h4 class="font-weight-bold text-uppercase mb-1" style="color: #800020;">Republic of the
            Philippines · Department of Education</h4>
        <h5 class="font-weight-bold mb-1">SENIOR HIGH SCHOOL HEALTH & NUTRITION STATISTICAL REPORT</h5>
        <p class="small text-muted mb-0">Official DepEd Form 8 / School Health Monitoring System Annual
            Health Dossier</p>
        <hr style="border-top: 2px solid #800020;">
    </div>

    <!-- Page Header & Action Bar -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3 no-print">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-chart-line text-maroon mr-2"></i>Student Health Statistics
            </h1>
            <p class="text-muted small mb-0">Senior High School Nutritional Status (BMI), Morbidity
                Prevalence, Immunization Coverage & Cohort Health Analytics</p>
        </div>
        <div class="mt-3 mt-sm-0 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-secondary btn-sm shadow-sm mr-2 mb-1"
                onclick="resetAllFilters()">
                <i class="fas fa-redo-alt fa-sm mr-1"></i> Reset View
            </button>
            <button class="btn btn-outline-maroon btn-sm shadow-sm mr-2 mb-1"
                onclick="exportStatisticsCSV()">
                <i class="fas fa-file-csv fa-sm mr-1"></i> Export Dataset (CSV)
            </button>
            <button class="btn btn-maroon btn-sm shadow-sm mb-1" onclick="openDepEdReportModal()">
                <i class="fas fa-file-invoice fa-sm text-white-50 mr-1"></i> DepEd Form 8 Report
            </button>
        </div>
    </div>

    <!-- Interactive Filter Toolbar (Sticky Control Panel) -->
    <div class="filter-toolbar no-print">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="font-weight-bold text-gray-800 small">
                <i class="fas fa-filter text-maroon mr-1"></i> Dynamic Cohort & Demographic Filters
            </span>
            <span class="badge badge-light border text-muted small" id="filterCountIndicator">
                Showing <strong>2,450</strong> of <strong>2,540</strong> Students (96.5% Screened)
            </span>
        </div>

        <div class="row align-items-end">
            <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                <label class="filter-label" for="filterAcademicTerm"><i
                        class="fas fa-calendar-alt mr-1"></i> Academic Term</label>
                <select class="form-control filter-select" id="filterAcademicTerm"
                    onchange="applyFilters()">
                    <option value="AY-2026-2027-1S" selected>AY 2026–2027 · 1st Semester (Current)
                    </option>
                    <option value="AY-2025-2026-2S">AY 2025–2026 · 2nd Semester</option>
                    <option value="AY-2025-2026-1S">AY 2025–2026 · 1st Semester</option>
                    <option value="ALL-TIME">Multi-Year Trend Analysis (2024-2026)</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 mb-2">
                <label class="filter-label" for="filterGrade"><i class="fas fa-layer-group mr-1"></i>
                    Grade Level</label>
                <select class="form-control filter-select" id="filterGrade" onchange="applyFilters()">
                    <option value="ALL" selected>All Grade Levels (11 & 12)</option>
                    <option value="11">Grade 11 (1,280 Students)</option>
                    <option value="12">Grade 12 (1,170 Students)</option>
                </select>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 mb-2">
                <label class="filter-label" for="filterStrand"><i
                        class="fas fa-graduation-cap mr-1"></i> SHS Academic Strand</label>
                <select class="form-control filter-select" id="filterStrand" onchange="applyFilters()">
                    <option value="ALL" selected>All Strands (STEM, ABM, HUMSS, TVL, GAS)</option>
                    <option value="STEM">STEM (Science, Tech, Eng, Math)</option>
                    <option value="ABM">ABM (Accountancy, Business & Mgmt)</option>
                    <option value="HUMSS">HUMSS (Humanities & Social Sciences)</option>
                    <option value="TVL">TVL (Technical-Vocational Livelihood)</option>
                    <option value="GAS">GAS (General Academic Strand)</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 mb-2">
                <label class="filter-label" for="filterGender"><i class="fas fa-venus-mars mr-1"></i>
                    Biological Sex</label>
                <select class="form-control filter-select" id="filterGender" onchange="applyFilters()">
                    <option value="ALL" selected>All Sexes (Male & Female)</option>
                    <option value="Male">Male (1,190)</option>
                    <option value="Female">Female (1,260)</option>
                </select>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 mb-2">
                <label class="filter-label" for="filterBMICategory"><i
                        class="fas fa-weight-hanging mr-1"></i> Nutritional Category</label>
                <select class="form-control filter-select" id="filterBMICategory"
                    onchange="applyFilters()">
                    <option value="ALL" selected>All Nutritional Tiers</option>
                    <option value="Normal">Normal BMI (18.5 - 24.9)</option>
                    <option value="Underweight">Underweight / Wasted (&lt; 18.5)</option>
                    <option value="Overweight">Overweight (25.0 - 29.9)</option>
                    <option value="Obese">Obese Class I/II (&ge; 30.0)</option>
                </select>
            </div>
        </div>

        <!-- Quick Filter Chips -->
        <div class="d-flex align-items-center flex-wrap mt-2 pt-2 border-top">
            <span class="small font-weight-bold text-muted mr-2">Quick Presets:</span>
            <div class="preset-chip active" id="chip-all" onclick="setPreset('all')">
                <i class="fas fa-users mr-1"></i> All Cohorts
            </div>
            <div class="preset-chip" id="chip-watchlist" onclick="setPreset('watchlist')">
                <i class="fas fa-exclamation-triangle mr-1 text-warning"></i> Nutritional Watchlist
            </div>
            <div class="preset-chip" id="chip-chronic" onclick="setPreset('chronic')">
                <i class="fas fa-shield-virus mr-1 text-danger"></i> Chronic Illness Registry
            </div>
            <div class="preset-chip" id="chip-pe-exempt" onclick="setPreset('pe-exempt')">
                <i class="fas fa-running mr-1 text-info"></i> PE Restricted / Exempt
            </div>
            <div class="preset-chip" id="chip-unscreened" onclick="setPreset('unscreened')">
                <i class="fas fa-clock mr-1 text-secondary"></i> Pending Screening (90)
            </div>
        </div>
    </div>

    <!-- KPI Statistics Metric Cards Row -->
    <div class="row mb-4">

        <!-- Total Screened Students -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-maroon h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-maroon text-uppercase mb-1">
                                Total Screened Students
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="kpiTotalScreened">
                                2,450</div>
                            <div class="mt-2 small text-muted">
                                <span class="text-success font-weight-bold mr-1"><i
                                        class="fas fa-arrow-up"></i> +4.2%</span>
                                <span>96.5% of 2,540 enrolled</span>
                            </div>
                            <div class="progress progress-slim mt-2">
                                <div class="progress-bar bg-maroon" role="progressbar"
                                    style="width: 96.5%" aria-valuenow="96.5" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon-container"
                                style="background-color: var(--maroon-soft); color: var(--maroon-primary);">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Normal Nutritional Status (BMI) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Normal Nutritional Index
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="kpiNormalBMI">1,824
                                <small class="text-muted font-weight-normal"
                                    style="font-size: 0.95rem;">(74.4%)</small>
                            </div>
                            <div class="mt-2 small text-muted">
                                <span class="text-success font-weight-bold mr-1"><i
                                        class="fas fa-check"></i> +3.1%</span>
                                <span>DepEd Benchmark: &ge; 70%</span>
                            </div>
                            <div class="progress progress-slim mt-2">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: 74.4%" aria-valuenow="74.4" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon-container"
                                style="background-color: #e6f4ea; color: #137333;">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nutritional Intervention Needed (Wasted / Obese) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Nutritional Watchlist
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="kpiWatchlist">626
                                <small class="text-muted font-weight-normal"
                                    style="font-size: 0.95rem;">(25.6%)</small>
                            </div>
                            <div class="mt-2 small text-muted">
                                <span class="text-info font-weight-bold mr-1">368 Underwt</span> · <span
                                    class="text-danger font-weight-bold">258 Over/Obese</span>
                            </div>
                            <div class="progress progress-slim mt-2">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: 25.6%" aria-valuenow="25.6" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon-container"
                                style="background-color: #fef9e7; color: #b06000;">
                                <i class="fas fa-apple-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Immunization & Preventive Compliance -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Immunization Compliance
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800" id="kpiImmunization">
                                2,284 <small class="text-muted font-weight-normal"
                                    style="font-size: 0.95rem;">(93.2%)</small></div>
                            <div class="mt-2 small text-muted">
                                <span class="text-success font-weight-bold mr-1"><i
                                        class="fas fa-shield-alt"></i> 93.2%</span>
                                <span>Td, HPV & Booster targets</span>
                            </div>
                            <div class="progress progress-slim mt-2">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: 93.2%" aria-valuenow="93.2" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon-container"
                                style="background-color: #e6f7ff; color: #0070ba;">
                                <i class="fas fa-syringe"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Clinical Insights & Epidemiological Highlight Pill -->
    <div class="insight-callout d-flex align-items-center justify-content-between flex-wrap">
        <div class="d-flex align-items-center mb-1 mb-md-0">
            <span class="badge badge-danger font-weight-bold mr-3 px-3 py-2 text-uppercase">
                <i class="fas fa-bullhorn mr-1"></i> Epidemiological Brief
            </span>
            <span class="text-gray-800 small font-weight-bold" id="insightBriefText">
                Grade 11 & 12 general health screening exhibits a <strong>96.5% completion
                    rate</strong>. Asthma (4.2%) and Visual Refraction Defects (14.8%) remain the
                leading chronic non-communicable concerns. 91.2% of students are cleared for
                unconstrained physical education (PE).
            </span>
        </div>
        <div class="small text-muted font-italic">
            Updated: <strong>October 2, 2026</strong> · Clinic Surveillance Lead
        </div>
    </div>

    <!-- Charts Row 1: BMI Distribution & Chronic Morbidity Breakdown -->
    <div class="row">

        <!-- Nutritional Status (BMI) Distribution Chart -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card card-shadow h-100">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-weight text-maroon mr-2"></i>Nutritional Status & BMI
                        Classification
                    </h6>
                    <div class="dropdown no-arrow no-print">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-maroon active" id="btnBMIBar"
                                onclick="toggleBMIChartType('bar')">
                                <i class="fas fa-chart-bar"></i> Bar
                            </button>
                            <button type="button" class="btn btn-outline-maroon" id="btnBMIDoughnut"
                                onclick="toggleBMIChartType('doughnut')">
                                <i class="fas fa-chart-pie"></i> Doughnut
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="bmiDistributionChart"></canvas>
                    </div>
                    <hr>
                    <div class="row text-center mt-2" id="bmiLegendSummary">
                        <div class="col-3">
                            <div class="small text-muted font-weight-bold">Underweight</div>
                            <div class="h6 font-weight-bold text-info mb-0" id="legUnderweight">368
                                (15.0%)</div>
                        </div>
                        <div class="col-3">
                            <div class="small text-muted font-weight-bold">Normal</div>
                            <div class="h6 font-weight-bold text-success mb-0" id="legNormal">1,824
                                (74.4%)</div>
                        </div>
                        <div class="col-3">
                            <div class="small text-muted font-weight-bold">Overweight</div>
                            <div class="h6 font-weight-bold text-warning mb-0" id="legOverweight">192
                                (7.8%)</div>
                        </div>
                        <div class="col-3">
                            <div class="small text-muted font-weight-bold">Obese</div>
                            <div class="h6 font-weight-bold text-danger mb-0" id="legObese">66 (2.7%)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Chronic Illnesses & Conditions Prevalence -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card card-shadow h-100">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-stethoscope text-maroon mr-2"></i>Leading Chronic Conditions &
                        Morbidities
                    </h6>
                    <span class="badge badge-light border text-muted small">N = 2,450 Screened</span>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="chronicPrevalenceChart"></canvas>
                    </div>
                    <div class="mt-3 small text-muted d-flex justify-content-between">
                        <span><i class="fas fa-info-circle text-maroon mr-1"></i> Click any morbidity
                            bar to view affected student list</span>
                        <span class="text-maroon font-weight-bold">Total Monitored Cases: 412</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts Row 2: Monthly Morbidity Trend & Strand Comparison -->
    <div class="row">

        <!-- Monthly Clinic Morbidity Trends (School Year Calendar) -->
        <div class="col-xl-7 col-lg-7 mb-4">
            <div class="card card-shadow h-100">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-calendar-week text-maroon mr-2"></i>Monthly Clinic Morbidity &
                        Consultation Trends
                    </h6>
                    <div class="small text-muted no-print">
                        <span>AY 2026–2027 Calendar (Jun – Mar)</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper" style="min-height: 300px;">
                        <canvas id="monthlyMorbidityTrendChart"></canvas>
                    </div>
                    <div class="row text-center mt-3 small text-muted">
                        <div class="col-sm-3 col-6 mb-1">
                            <span class="dot-indicator" style="background-color: #e74a3b;"></span>
                            <strong>Fever / ILI</strong> (Peak: Aug-Sep)
                        </div>
                        <div class="col-sm-3 col-6 mb-1">
                            <span class="dot-indicator" style="background-color: #4e73df;"></span>
                            <strong>Respiratory</strong> (URTI/Asthma)
                        </div>
                        <div class="col-sm-3 col-6 mb-1">
                            <span class="dot-indicator" style="background-color: #f6c23e;"></span>
                            <strong>Gastric / Dysmenorrhea</strong>
                        </div>
                        <div class="col-sm-3 col-6 mb-1">
                            <span class="dot-indicator" style="background-color: #1cc88a;"></span>
                            <strong>Trauma / PE Injuries</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Strand-by-Strand Comparative Health Scorecard -->
        <div class="col-xl-5 col-lg-5 mb-4">
            <div class="card card-shadow h-100">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-balance-scale text-maroon mr-2"></i>Strand Health & Fitness
                        Scorecard
                    </h6>
                    <span class="badge badge-light border text-muted small">Comparative</span>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper" style="min-height: 300px;">
                        <canvas id="strandComparisonChart"></canvas>
                    </div>
                    <div class="mt-2 small text-center text-muted">
                        <span>Normal BMI % by Strand: <strong>STEM (78%)</strong> · <strong>ABM
                                (76%)</strong> · <strong>HUMSS (73%)</strong> · <strong>TVL
                                (69%)</strong> · <strong>GAS (72%)</strong></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Row 3: Immunization Coverage & Physical Education Readiness -->
    <div class="row">

        <!-- Immunization Coverage Breakdown -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card card-shadow h-100">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-syringe text-maroon mr-2"></i>Senior High Immunization &
                        Vaccine Coverage
                    </h6>
                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>
                        Target &gt;90% Met</span>
                </div>
                <div class="card-body">

                    <!-- Tetanus-Diphtheria Booster -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small font-weight-bold mb-1">
                            <span>Tetanus-Diphtheria (Td) Booster (Grade 11 & 12)</span>
                            <span class="text-gray-800">2,328 / 2,450 (95.0%)</span>
                        </div>
                        <div class="progress progress-slim">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 95%"
                                aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- HPV (Human Papillomavirus) for Grade 11/12 Females -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small font-weight-bold mb-1">
                            <span>Human Papillomavirus (HPV) (Eligible Female Students)</span>
                            <span class="text-gray-800">1,160 / 1,260 (92.1%)</span>
                        </div>
                        <div class="progress progress-slim">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 92.1%"
                                aria-valuenow="92.1" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Annual Seasonal Influenza Vaccine -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small font-weight-bold mb-1">
                            <span>Seasonal Influenza (Flu) Vaccination Drive</span>
                            <span class="text-gray-800">2,156 / 2,450 (88.0%)</span>
                        </div>
                        <div class="progress progress-slim">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 88%"
                                aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Bi-Annual Mass Deworming Program -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small font-weight-bold mb-1">
                            <span>DepEd School-Based Deworming Compliance</span>
                            <span class="text-gray-800">2,380 / 2,450 (97.1%)</span>
                        </div>
                        <div class="progress progress-slim">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 97.1%"
                                aria-valuenow="97.1" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- COVID-19 Primary & Booster Series -->
                    <div class="mb-1">
                        <div class="d-flex justify-content-between small font-weight-bold mb-1">
                            <span>COVID-19 Full Immunization & Booster</span>
                            <span class="text-gray-800">2,410 / 2,450 (98.4%)</span>
                        </div>
                        <div class="progress progress-slim">
                            <div class="progress-bar bg-purple" role="progressbar"
                                style="width: 98.4%; background-color: #6f42c1;" aria-valuenow="98.4"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Physical Education (PE) & Sports Clearance Profile -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card card-shadow h-100">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-running text-maroon mr-2"></i>Physical Education (PE) & Fitness
                        Clearance
                    </h6>
                    <span class="badge badge-light border text-muted small">AY 2026-2027</span>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <div class="chart-wrapper" style="min-height: 180px; max-height: 200px;">
                                <canvas id="peClearanceDoughnutChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-2">
                                <div
                                    class="d-flex align-items-center justify-content-between mb-2 pb-1 border-bottom">
                                    <div>
                                        <span class="dot-indicator dot-success"></span>
                                        <span class="small font-weight-bold">Fully Cleared
                                            (Regular)</span>
                                    </div>
                                    <span class="small font-weight-bold text-success">2,234
                                        (91.2%)</span>
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-between mb-2 pb-1 border-bottom">
                                    <div>
                                        <span class="dot-indicator dot-warning"></span>
                                        <span class="small font-weight-bold">Modified PE
                                            (Restricted)</span>
                                    </div>
                                    <span class="small font-weight-bold text-warning">174 (7.1%)</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div>
                                        <span class="dot-indicator dot-danger"></span>
                                        <span class="small font-weight-bold">Medical Exemption</span>
                                    </div>
                                    <span class="small font-weight-bold text-danger">42 (1.7%)</span>
                                </div>
                                <div class="alert alert-light border mt-3 mb-0 p-2 small">
                                    <i class="fas fa-info-circle text-maroon mr-1"></i> Medical
                                    exemptions are linked to chronic cardiology, severe asthma, and
                                    post-surgical protocols.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Comprehensive Section & Cohort Statistics Table -->
    <div class="card card-shadow mb-4">
        <div class="card-header-maroon d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-table mr-2"></i>Senior High School Section-by-Section Health Statistics
                Registry
            </h6>
            <div class="no-print">
                <button class="btn btn-sm btn-light font-weight-bold" onclick="exportSectionTableCSV()">
                    <i class="fas fa-file-excel text-success mr-1"></i> Export Table
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-gray-800" id="sectionStatsTable"
                    width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Grade & Section</th>
                            <th>Strand</th>
                            <th>Adviser</th>
                            <th>Enrolled</th>
                            <th>Screened %</th>
                            <th>Normal BMI</th>
                            <th>Underweight</th>
                            <th>Overweight/Obese</th>
                            <th>Chronic Cases</th>
                            <th>PE Exemption</th>
                            <th class="no-print text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sectionTableBody">
                        <!-- Row 1: 11-STEM-A -->
                        <tr data-grade="11" data-strand="STEM"
                            onclick="showSectionDrilldown('11-STEM-A')">
                            <td><strong>11-STEM-A</strong></td>
                            <td><span class="badge-strand-stem">STEM</span></td>
                            <td>Engr. Danilo Ramos</td>
                            <td>45</td>
                            <td><span class="badge badge-success">100% (45)</span></td>
                            <td><span class="badge-bmi-normal">36 (80.0%)</span></td>
                            <td><span class="badge-bmi-underweight">5 (11.1%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (8.9%)</span></td>
                            <td><span class="badge badge-danger">3 Cases</span></td>
                            <td><span class="badge badge-warning">1 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('11-STEM-A')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2: 11-STEM-B -->
                        <tr data-grade="11" data-strand="STEM"
                            onclick="showSectionDrilldown('11-STEM-B')">
                            <td><strong>11-STEM-B</strong></td>
                            <td><span class="badge-strand-stem">STEM</span></td>
                            <td>Ms. Jennifer Cruz</td>
                            <td>44</td>
                            <td><span class="badge badge-success">97.7% (43)</span></td>
                            <td><span class="badge-bmi-normal">34 (79.1%)</span></td>
                            <td><span class="badge-bmi-underweight">6 (14.0%)</span></td>
                            <td><span class="badge-bmi-overweight">3 (7.0%)</span></td>
                            <td><span class="badge badge-danger">2 Cases</span></td>
                            <td><span class="badge badge-success">0 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('11-STEM-B')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3: 11-ABM-A -->
                        <tr data-grade="11" data-strand="ABM"
                            onclick="showSectionDrilldown('11-ABM-A')">
                            <td><strong>11-ABM-A</strong></td>
                            <td><span class="badge-strand-abm">ABM</span></td>
                            <td>Mr. Richard Tan</td>
                            <td>46</td>
                            <td><span class="badge badge-success">95.7% (44)</span></td>
                            <td><span class="badge-bmi-normal">33 (75.0%)</span></td>
                            <td><span class="badge-bmi-underweight">7 (15.9%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (9.1%)</span></td>
                            <td><span class="badge badge-secondary">1 Case</span></td>
                            <td><span class="badge badge-warning">2 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('11-ABM-A')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 4: 11-HUMSS-A -->
                        <tr data-grade="11" data-strand="HUMSS"
                            onclick="showSectionDrilldown('11-HUMSS-A')">
                            <td><strong>11-HUMSS-A</strong></td>
                            <td><span class="badge-strand-humss">HUMSS</span></td>
                            <td>Mrs. Maria Teresa Lee</td>
                            <td>48</td>
                            <td><span class="badge badge-success">97.9% (47)</span></td>
                            <td><span class="badge-bmi-normal">35 (74.5%)</span></td>
                            <td><span class="badge-bmi-underweight">8 (17.0%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (8.5%)</span></td>
                            <td><span class="badge badge-danger">4 Cases</span></td>
                            <td><span class="badge badge-warning">1 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('11-HUMSS-A')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 5: 11-TVL-ICT -->
                        <tr data-grade="11" data-strand="TVL"
                            onclick="showSectionDrilldown('11-TVL-ICT')">
                            <td><strong>11-TVL-ICT</strong></td>
                            <td><span class="badge-strand-tvl">TVL</span></td>
                            <td>Mr. Jonathan Gomez</td>
                            <td>42</td>
                            <td><span class="badge badge-success">95.2% (40)</span></td>
                            <td><span class="badge-bmi-normal">27 (67.5%)</span></td>
                            <td><span class="badge-bmi-underweight">9 (22.5%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (10.0%)</span></td>
                            <td><span class="badge badge-secondary">2 Cases</span></td>
                            <td><span class="badge badge-success">0 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('11-TVL-ICT')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 6: 12-STEM-A -->
                        <tr data-grade="12" data-strand="STEM"
                            onclick="showSectionDrilldown('12-STEM-A')">
                            <td><strong>12-STEM-A</strong></td>
                            <td><span class="badge-strand-stem">STEM</span></td>
                            <td>Dr. Fernando Morales</td>
                            <td>45</td>
                            <td><span class="badge badge-success">100% (45)</span></td>
                            <td><span class="badge-bmi-normal">37 (82.2%)</span></td>
                            <td><span class="badge-bmi-underweight">4 (8.9%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (8.9%)</span></td>
                            <td><span class="badge badge-danger">3 Cases</span></td>
                            <td><span class="badge badge-warning">1 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('12-STEM-A')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 7: 12-ABM-A -->
                        <tr data-grade="12" data-strand="ABM"
                            onclick="showSectionDrilldown('12-ABM-A')">
                            <td><strong>12-ABM-A</strong></td>
                            <td><span class="badge-strand-abm">ABM</span></td>
                            <td>Mrs. Grace Villar</td>
                            <td>43</td>
                            <td><span class="badge badge-success">97.7% (42)</span></td>
                            <td><span class="badge-bmi-normal">32 (76.2%)</span></td>
                            <td><span class="badge-bmi-underweight">6 (14.3%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (9.5%)</span></td>
                            <td><span class="badge badge-secondary">1 Case</span></td>
                            <td><span class="badge badge-success">0 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('12-ABM-A')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 8: 12-HUMSS-B -->
                        <tr data-grade="12" data-strand="HUMSS"
                            onclick="showSectionDrilldown('12-HUMSS-B')">
                            <td><strong>12-HUMSS-B</strong></td>
                            <td><span class="badge-strand-humss">HUMSS</span></td>
                            <td>Mr. Carlos Navarro</td>
                            <td>44</td>
                            <td><span class="badge badge-success">95.5% (42)</span></td>
                            <td><span class="badge-bmi-normal">31 (73.8%)</span></td>
                            <td><span class="badge-bmi-underweight">7 (16.7%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (9.5%)</span></td>
                            <td><span class="badge badge-danger">3 Cases</span></td>
                            <td><span class="badge badge-warning">2 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('12-HUMSS-B')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>

                        <!-- Row 9: 12-GAS-A -->
                        <tr data-grade="12" data-strand="GAS"
                            onclick="showSectionDrilldown('12-GAS-A')">
                            <td><strong>12-GAS-A</strong></td>
                            <td><span class="badge-strand-gas">GAS</span></td>
                            <td>Ms. Andrea Bautista</td>
                            <td>41</td>
                            <td><span class="badge badge-success">95.1% (39)</span></td>
                            <td><span class="badge-bmi-normal">28 (71.8%)</span></td>
                            <td><span class="badge-bmi-underweight">7 (17.9%)</span></td>
                            <td><span class="badge-bmi-overweight">4 (10.3%)</span></td>
                            <td><span class="badge badge-secondary">2 Cases</span></td>
                            <td><span class="badge badge-success">0 Exempt</span></td>
                            <td class="text-center no-print">
                                <button class="btn btn-sm btn-outline-maroon"
                                    onclick="event.stopPropagation(); showSectionDrilldown('12-GAS-A')">
                                    <i class="fas fa-eye fa-sm"></i> Details
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sectionDrilldownModal" tabindex="-1" role="dialog" aria-labelledby="sectionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="sectionModalLabel">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>Section Health Profile: <span
                        id="modalSectionName">11-STEM-A</span>
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card bg-light border-0 p-3 text-center">
                            <div class="small text-muted font-weight-bold">Section Adviser</div>
                            <div class="font-weight-bold text-gray-800" id="modalAdviserName">Engr. Danilo Ramos
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light border-0 p-3 text-center">
                            <div class="small text-muted font-weight-bold">Total Screened</div>
                            <div class="font-weight-bold text-success" id="modalScreenedCount">45 of 45 (100%)</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light border-0 p-3 text-center">
                            <div class="small text-muted font-weight-bold">Normal BMI Rate</div>
                            <div class="font-weight-bold text-primary" id="modalNormalRate">36 Students (80.0%)
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="font-weight-bold text-gray-800 border-bottom pb-2">
                    <i class="fas fa-user-shield text-maroon mr-1"></i> Students with Monitored Health Conditions /
                    Special Needs
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>LRN</th>
                                <th>Student Name</th>
                                <th>Condition / Allergy</th>
                                <th>PE Clearance</th>
                                <th>Action Plan</th>
                            </tr>
                        </thead>
                        <tbody id="modalStudentsList">
                            <tr>
                                <td>21S0011</td>
                                <td><strong>Santos, Maria Clara</strong></td>
                                <td><span class="badge badge-danger">Severe Bronchial Asthma</span></td>
                                <td><span class="badge badge-warning">Modified PE</span></td>
                                <td>Rescue Ventolin Inhaler in Clinic Locker #04</td>
                            </tr>
                            <tr>
                                <td>22B0023</td>
                                <td><strong>Dela Cruz Jr., Juan</strong></td>
                                <td><span class="badge badge-danger">Severe Peanut Allergy (Anaphylaxis)</span></td>
                                <td><span class="badge badge-success">Cleared</span></td>
                                <td>Auto-injectable Epinephrine (EpiPen) on file</td>
                            </tr>
                            <tr>
                                <td>21S0011</td>
                                <td><strong>Santos, Mica</strong></td>
                                <td><span class="badge badge-warning">Type 1 Diabetes Mellitus</span></td>
                                <td><span class="badge badge-success">Cleared</span></td>
                                <td>Glucagon Kit in Clinic & Blood Glucose Log</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-maroon" onclick="printSectionReport()"><i class="fas fa-print mr-1"></i>
                    Print Section Dossier</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="depEdReportModal" tabindex="-1" role="dialog" aria-labelledby="depEdModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-maroon text-white">
                <h5 class="modal-title font-weight-bold" id="depEdModalLabel">
                    <i class="fas fa-file-invoice mr-2"></i>DepEd Form 8: School Health & Nutrition Assessment
                    Summary (Senior High School)
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="printableDepEdForm">
                <div class="text-center mb-4">
                    <h5 class="font-weight-bold text-uppercase mb-1" style="color: #800020;">DEPARTMENT OF EDUCATION
                        · REGION IV-A CALABARZON</h5>
                    <h6 class="font-weight-bold mb-1">DIVISION OF CITY SCHOOLS · SENIOR HIGH SCHOOL DIVISION</h6>
                    <h5 class="font-weight-bold mb-0 text-dark">DEPED FORM 8: ANNUAL SCHOOL HEALTH & NUTRITION
                        PROFILE</h5>
                    <small class="text-muted">School Year: 2026–2027 · First Semester Assessment Cycle</small>
                </div>

                <div class="row mb-3 small">
                    <div class="col-md-3"><strong>School ID:</strong> 302194</div>
                    <div class="col-md-3"><strong>Division:</strong> City Schools Division</div>
                    <div class="col-md-3"><strong>Total SHS Enrollment:</strong> 2,540</div>
                    <div class="col-md-3"><strong>Screened Baseline:</strong> 2,450 (96.5%)</div>
                </div>

                <h6 class="font-weight-bold text-gray-800 border-bottom pb-1">I. Nutritional Status (BMI for Age &
                    Sex)</h6>
                <table class="table table-bordered table-sm text-center small mb-3">
                    <thead class="thead-light">
                        <tr>
                            <th>Grade Level</th>
                            <th>Severely Wasted</th>
                            <th>Wasted / Underweight</th>
                            <th>Normal BMI</th>
                            <th>Overweight</th>
                            <th>Obese</th>
                            <th>Total Examined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Grade 11 (All Strands)</strong></td>
                            <td>14 (1.1%)</td>
                            <td>188 (14.7%)</td>
                            <td>952 (74.4%)</td>
                            <td>98 (7.7%)</td>
                            <td>28 (2.2%)</td>
                            <td><strong>1,280 (100%)</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Grade 12 (All Strands)</strong></td>
                            <td>10 (0.9%)</td>
                            <td>156 (13.3%)</td>
                            <td>872 (74.5%)</td>
                            <td>94 (8.0%)</td>
                            <td>38 (3.2%)</td>
                            <td><strong>1,170 (100%)</strong></td>
                        </tr>
                        <tr class="font-weight-bold bg-light">
                            <td>TOTAL CONSOLIDATED</td>
                            <td>24 (1.0%)</td>
                            <td>344 (14.0%)</td>
                            <td>1,824 (74.4%)</td>
                            <td>192 (7.8%)</td>
                            <td>66 (2.7%)</td>
                            <td>2,450 (100%)</td>
                        </tr>
                    </tbody>
                </table>

                <h6 class="font-weight-bold text-gray-800 border-bottom pb-1">II. Morbidities & Special Clinical
                    Findings</h6>
                <table class="table table-bordered table-sm text-center small mb-3">
                    <thead class="thead-light">
                        <tr>
                            <th>Clinical Category</th>
                            <th>Identified Cases</th>
                            <th>Prevalence %</th>
                            <th>Action & Management Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">Bronchial Asthma / Respiratory Reactive</td>
                            <td>104</td>
                            <td>4.2%</td>
                            <td class="text-left">Rescue inhalers endorsed in clinic; PE clearance updated</td>
                        </tr>
                        <tr>
                            <td class="text-left">Vision Impairment / Refraction Errors</td>
                            <td>362</td>
                            <td>14.8%</td>
                            <td class="text-left">Referred for optometry subsidy & front-row seating advisory</td>
                        </tr>
                        <tr>
                            <td class="text-left">Dental Caries / Oral Health Deficits</td>
                            <td>284</td>
                            <td>11.6%</td>
                            <td class="text-left">School dentist fluoride application & cleaning cycle initiated
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">Severe Food & Drug Allergies</td>
                            <td>76</td>
                            <td>3.1%</td>
                            <td class="text-left">School canteen red-flag list updated; EpiPens verified</td>
                        </tr>
                        <tr>
                            <td class="text-left">Congenital / Cardiovascular Watch</td>
                            <td>18</td>
                            <td>0.7%</td>
                            <td class="text-left">PE exemption and emergency contact protocols active</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row mt-4 pt-3 border-top small text-center">
                    <div class="col-4">
                        <strong>Prepared By:</strong><br><br>
                        <span class="font-weight-bold text-uppercase">Maria Santos, RN</span><br>
                        <span>School Clinic Nurse II · PRC #0892341</span>
                    </div>
                    <div class="col-4">
                        <strong>Verified By:</strong><br><br>
                        <span class="font-weight-bold text-uppercase">Dr. Arthur Valenzuela, MD</span><br>
                        <span>School Medical Officer III</span>
                    </div>
                    <div class="col-4">
                        <strong>Approved By:</strong><br><br>
                        <span class="font-weight-bold text-uppercase">Dr. Josefina Ramos, EdD</span><br>
                        <span>Senior High School Principal IV</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-print">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-maroon" onclick="window.print()"><i class="fas fa-print mr-1"></i> Print
                    Official Form 8</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-maroon" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Set Chart.js Defaults for Clean Professional UI
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Global Chart Instances
    var bmiChartInstance = null;
    var chronicChartInstance = null;
    var monthlyMorbidityChartInstance = null;
    var strandComparisonChartInstance = null;
    var peClearanceChartInstance = null;
    var currentBMIChartType = 'bar';

    // Master Dataset Schema
    var statsData = {
        totalEnrolled: 2540,
        screened: 2450,
        normalBMI: 1824,
        underweight: 368,
        overweight: 192,
        obese: 66,
        immunized: 2284,
        chronicCases: 142,
        peCleared: 2234,
        peModified: 174,
        peExempt: 42,
        byGrade: {
            '11': {
                screened: 1280,
                normal: 952,
                under: 188,
                over: 98,
                obese: 28,
                immunized: 1195
            },
            '12': {
                screened: 1170,
                normal: 872,
                under: 156,
                over: 94,
                obese: 38,
                immunized: 1089
            }
        },
        byStrand: {
            'STEM': {
                total: 680,
                normal: 530,
                under: 82,
                over: 48,
                obese: 20,
                pct: 77.9
            },
            'ABM': {
                total: 540,
                normal: 410,
                under: 76,
                over: 40,
                obese: 14,
                pct: 75.9
            },
            'HUMSS': {
                total: 580,
                normal: 423,
                under: 94,
                over: 46,
                obese: 17,
                pct: 72.9
            },
            'TVL': {
                total: 420,
                normal: 290,
                under: 84,
                over: 36,
                obese: 10,
                pct: 69.0
            },
            'GAS': {
                total: 230,
                normal: 165,
                under: 32,
                over: 22,
                obese: 5,
                pct: 71.7
            }
        }
    };

    function refreshDynamicStatistics() {
        if (typeof SmartClinicDB === 'undefined') return;
        var students = SmartClinicDB.getStudents() || [];
        var vitals = SmartClinicDB.getVitals() || [];
        var screenings = SmartClinicDB.getScreenings() || [];
        var risks = SmartClinicDB.getRiskStudents() || [];

        var totalStudents = Math.max(2540, 2540 + students.length);
        var totalScreened = 2450 + screenings.length;
        var normalCount = 1824;
        var underCount = 368;
        var overCount = 192;
        var obeseCount = 66;

        screenings.forEach(function(sc) {
            var bmiCat = (sc.bmiCategory || '').toLowerCase();
            if (bmiCat.includes('normal')) normalCount++;
            else if (bmiCat.includes('under')) underCount++;
            else if (bmiCat.includes('over')) overCount++;
            else if (bmiCat.includes('obese')) obeseCount++;
            else normalCount++;
        });

        statsData.screened = totalScreened;
        statsData.normalBMI = normalCount;
        statsData.underweight = underCount;
        statsData.overweight = overCount;
        statsData.obese = obeseCount;

        var normPct = ((normalCount / totalScreened) * 100).toFixed(1);
        var watchCount = totalScreened - normalCount;
        var watchPct = ((watchCount / totalScreened) * 100).toFixed(1);

        $('#kpiTotalScreened').text(totalScreened.toLocaleString());
        $('#kpiNormalBMI').html(normalCount.toLocaleString() + ' <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(' + normPct + '%)</small>');
        $('#kpiWatchlist').html(watchCount.toLocaleString() + ' <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(' + watchPct + '%)</small>');
    }

    $(document).ready(function() {
        refreshDynamicStatistics();

        // Initialize DataTable
        $('#sectionStatsTable').DataTable({
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ],
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search section, adviser or strand..."
            }
        });

        // Initialize Charts
        initBMIChart(currentBMIChartType);
        initChronicPrevalenceChart();
        initMonthlyMorbidityChart();
        initStrandComparisonChart();
        initPEClearanceChart();
    });

    // 1. Nutritional Status (BMI) Chart
    function initBMIChart(type) {
        var ctx = document.getElementById("bmiDistributionChart").getContext('2d');
        if (bmiChartInstance) {
            bmiChartInstance.destroy();
        }

        if (type === 'bar') {
            bmiChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Underweight (<18.5)", "Normal (18.5-24.9)", "Overweight (25-29.9)", "Obese (≥30.0)"],
                    datasets: [{
                        label: "Students Count",
                        backgroundColor: ['#36b9cc', '#1cc88a', '#f6c23e', '#e74a3b'],
                        hoverBackgroundColor: ['#2c9faf', '#17a673', '#dda20a', '#be2617'],
                        borderColor: ['#36b9cc', '#1cc88a', '#f6c23e', '#e74a3b'],
                        data: [368, 1824, 192, 66],
                        borderRadius: 6,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                fontColor: '#6e707e',
                                fontStyle: 'bold'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 2000,
                                fontColor: '#6e707e',
                                callback: function(value) {
                                    return value.toLocaleString() + ' sts';
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2]
                            }
                        }]
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var total = 2450;
                                var pct = ((tooltipItem.yLabel / total) * 100).toFixed(1);
                                return tooltipItem.yLabel.toLocaleString() + ' students (' + pct + '% of screened)';
                            }
                        }
                    }
                }
            });
        } else {
            bmiChartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Underweight", "Normal", "Overweight", "Obese"],
                    datasets: [{
                        data: [368, 1824, 192, 66],
                        backgroundColor: ['#36b9cc', '#1cc88a', '#f6c23e', '#e74a3b'],
                        hoverBackgroundColor: ['#2c9faf', '#17a673', '#dda20a', '#be2617'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: true,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var val = chart.datasets[0].data[tooltipItem.index];
                                var pct = ((val / 2450) * 100).toFixed(1);
                                return chart.labels[tooltipItem.index] + ': ' + val + ' (' + pct + '%)';
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 14,
                            fontStyle: 'bold'
                        }
                    },
                    cutoutPercentage: 65,
                }
            });
        }
    }

    function toggleBMIChartType(type) {
        currentBMIChartType = type;
        if (type === 'bar') {
            $('#btnBMIBar').addClass('active');
            $('#btnBMIDoughnut').removeClass('active');
        } else {
            $('#btnBMIDoughnut').addClass('active');
            $('#btnBMIBar').removeClass('active');
        }
        initBMIChart(type);
    }

    // 2. Chronic Morbidities Prevalence Chart
    function initChronicPrevalenceChart() {
        var ctx = document.getElementById("chronicPrevalenceChart").getContext('2d');
        if (chronicChartInstance) chronicChartInstance.destroy();

        chronicChartInstance = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [
                    "Visual Refraction Deficit",
                    "Dental Caries",
                    "Bronchial Asthma",
                    "Allergic Rhinitis / Atopy",
                    "Severe Food Allergies",
                    "Scoliosis / Postural",
                    "Type 1 Diabetes",
                    "Congenital Heart Defect"
                ],
                datasets: [{
                    label: "Identified Students",
                    backgroundColor: '#800020',
                    hoverBackgroundColor: '#5c0017',
                    data: [362, 284, 104, 92, 76, 38, 12, 6],
                    maxBarThickness: 18,
                    borderRadius: 4
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#6e707e'
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            borderDash: [2]
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontColor: '#4a5568',
                            fontStyle: 'bold'
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var val = tooltipItem.xLabel;
                            var pct = ((val / 2450) * 100).toFixed(1);
                            return val + ' affected students (' + pct + '% prevalence)';
                        }
                    }
                }
            }
        });
    }

    // 3. Monthly Morbidity & Clinic Trends Chart
    function initMonthlyMorbidityChart() {
        var ctx = document.getElementById("monthlyMorbidityTrendChart").getContext('2d');
        if (monthlyMorbidityChartInstance) monthlyMorbidityChartInstance.destroy();

        monthlyMorbidityChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"],
                datasets: [{
                        label: "Fever / ILI (Influenza-like)",
                        lineTension: 0.3,
                        backgroundColor: "rgba(231, 74, 59, 0.05)",
                        borderColor: "#e74a3b",
                        pointRadius: 4,
                        pointBackgroundColor: "#e74a3b",
                        pointHoverRadius: 6,
                        data: [28, 45, 89, 112, 74, 52, 38, 48, 42, 30]
                    },
                    {
                        label: "Respiratory (URTI & Asthma)",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "#4e73df",
                        pointRadius: 4,
                        pointBackgroundColor: "#4e73df",
                        pointHoverRadius: 6,
                        data: [35, 52, 78, 95, 68, 60, 44, 55, 49, 36]
                    },
                    {
                        label: "Gastric & Dysmenorrhea",
                        lineTension: 0.3,
                        backgroundColor: "rgba(246, 194, 62, 0.05)",
                        borderColor: "#f6c23e",
                        pointRadius: 4,
                        pointBackgroundColor: "#f6c23e",
                        pointHoverRadius: 6,
                        data: [42, 48, 55, 62, 58, 50, 41, 46, 52, 44]
                    },
                    {
                        label: "Trauma & PE Injuries",
                        lineTension: 0.3,
                        backgroundColor: "rgba(28, 200, 138, 0.05)",
                        borderColor: "#1cc88a",
                        pointRadius: 4,
                        pointBackgroundColor: "#1cc88a",
                        pointHoverRadius: 6,
                        data: [18, 24, 30, 26, 22, 19, 14, 25, 28, 20]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        fontStyle: 'bold'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 130
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            borderDash: [2]
                        }
                    }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                }
            }
        });
    }

    // 4. Strand Comparison Chart
    function initStrandComparisonChart() {
        var ctx = document.getElementById("strandComparisonChart").getContext('2d');
        if (strandComparisonChartInstance) strandComparisonChartInstance.destroy();

        strandComparisonChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["STEM", "ABM", "HUMSS", "TVL", "GAS"],
                datasets: [{
                        label: "Normal BMI (%)",
                        backgroundColor: "#1cc88a",
                        data: [77.9, 75.9, 72.9, 69.0, 71.7]
                    },
                    {
                        label: "Underweight (%)",
                        backgroundColor: "#36b9cc",
                        data: [12.1, 14.1, 16.2, 20.0, 13.9]
                    },
                    {
                        label: "Overweight/Obese (%)",
                        backgroundColor: "#f6c23e",
                        data: [10.0, 10.0, 10.9, 11.0, 14.4]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            max: 100,
                            callback: function(value) {
                                return value + "%";
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            borderDash: [2]
                        }
                    }]
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                }
            }
        });
    }

    // 5. PE Clearance Doughnut Chart
    function initPEClearanceChart() {
        var ctx = document.getElementById("peClearanceDoughnutChart").getContext('2d');
        if (peClearanceChartInstance) peClearanceChartInstance.destroy();

        peClearanceChartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Fully Cleared", "Modified PE", "Medical Exemption"],
                datasets: [{
                    data: [2234, 174, 42],
                    backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                    hoverBackgroundColor: ['#17a673', '#dda20a', '#be2617'],
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            }
        });
    }

    // Filter Handlers
    function applyFilters() {
        var grade = $('#filterGrade').val();
        var strand = $('#filterStrand').val();
        var bmi = $('#filterBMICategory').val();
        var gender = $('#filterGender').val();

        // Calculate dynamic mock adjustments
        var baseTotal = 2450;
        var multiplier = 1.0;

        if (grade === '11') multiplier *= 0.52;
        else if (grade === '12') multiplier *= 0.48;

        if (strand === 'STEM') multiplier *= 0.28;
        else if (strand === 'ABM') multiplier *= 0.22;
        else if (strand === 'HUMSS') multiplier *= 0.24;
        else if (strand === 'TVL') multiplier *= 0.17;
        else if (strand === 'GAS') multiplier *= 0.09;

        if (gender !== 'ALL') multiplier *= 0.5;

        var filteredCount = Math.round(baseTotal * multiplier);
        var filteredNormal = Math.round(filteredCount * 0.744);
        var filteredWatchlist = filteredCount - filteredNormal;
        var filteredImmunized = Math.round(filteredCount * 0.932);

        $('#kpiTotalScreened').text(filteredCount.toLocaleString());
        $('#kpiNormalBMI').html(filteredNormal.toLocaleString() + ' <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(74.4%)</small>');
        $('#kpiWatchlist').html(filteredWatchlist.toLocaleString() + ' <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(25.6%)</small>');
        $('#kpiImmunization').html(filteredImmunized.toLocaleString() + ' <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(93.2%)</small>');

        $('#filterCountIndicator').html(`Showing <strong>${filteredCount.toLocaleString()}</strong> Students filtered`);

        // Filter Table Rows
        $('#sectionTableBody tr').each(function() {
            var rowGrade = $(this).attr('data-grade');
            var rowStrand = $(this).attr('data-strand');

            var matchGrade = (grade === 'ALL' || rowGrade === grade);
            var matchStrand = (strand === 'ALL' || rowStrand === strand);

            if (matchGrade && matchStrand) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function setPreset(preset) {
        $('.preset-chip').removeClass('active');
        $('#chip-' + preset).addClass('active');

        if (preset === 'all') {
            resetAllFilters();
        } else if (preset === 'watchlist') {
            $('#filterBMICategory').val('Underweight');
            applyFilters();
        } else if (preset === 'chronic') {
            $('#filterGrade').val('ALL');
            $('#filterStrand').val('ALL');
            applyFilters();
            $('html, body').animate({
                scrollTop: $("#chronicPrevalenceChart").offset().top - 100
            }, 500);
        } else if (preset === 'pe-exempt') {
            $('html, body').animate({
                scrollTop: $("#peClearanceDoughnutChart").offset().top - 100
            }, 500);
        }
    }

    function resetAllFilters() {
        $('#filterAcademicTerm').val('AY-2026-2027-1S');
        $('#filterGrade').val('ALL');
        $('#filterStrand').val('ALL');
        $('#filterGender').val('ALL');
        $('#filterBMICategory').val('ALL');
        $('.preset-chip').removeClass('active');
        $('#chip-all').addClass('active');
        $('#topbarSearchInput').val('');

        $('#kpiTotalScreened').text('2,450');
        $('#kpiNormalBMI').html('1,824 <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(74.4%)</small>');
        $('#kpiWatchlist').html('626 <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(25.6%)</small>');
        $('#kpiImmunization').html('2,284 <small class="text-muted font-weight-normal" style="font-size: 0.95rem;">(93.2%)</small>');
        $('#filterCountIndicator').html('Showing <strong>2,450</strong> of <strong>2,540</strong> Students (96.5% Screened)');
        $('#sectionTableBody tr').show();
    }

    function handleTopbarSearch() {
        var q = $('#topbarSearchInput').val().toLowerCase().trim();
        if (!q) {
            $('#sectionTableBody tr').show();
            return;
        }
        $('#sectionTableBody tr').each(function() {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(q) > -1);
        });
        $('html, body').animate({
            scrollTop: $("#sectionStatsTable").offset().top - 100
        }, 400);
    }

    function showSectionDrilldown(sectionName) {
        $('#modalSectionName').text(sectionName);
        if (sectionName.includes('STEM')) {
            $('#modalAdviserName').text('Engr. Danilo Ramos');
            $('#modalNormalRate').text('36 Students (80.0%)');
        } else if (sectionName.includes('ABM')) {
            $('#modalAdviserName').text('Mr. Richard Tan');
            $('#modalNormalRate').text('33 Students (75.0%)');
        } else if (sectionName.includes('HUMSS')) {
            $('#modalAdviserName').text('Mrs. Maria Teresa Lee');
            $('#modalNormalRate').text('35 Students (74.5%)');
        } else {
            $('#modalAdviserName').text('Mr. Jonathan Gomez');
            $('#modalNormalRate').text('27 Students (67.5%)');
        }
        $('#sectionDrilldownModal').modal('show');
    }

    function openDepEdReportModal() {
        $('#depEdReportModal').modal('show');
    }

    function printSectionReport() {
        window.print();
    }

    // Export Statistics to CSV
    function exportStatisticsCSV() {
        var csv = 'DepEd School Health Statistics Report - AY 2026-2027\n';
        csv += 'Metric,Count,Percentage\n';
        csv += 'Total Enrolled,2540,100%\n';
        csv += 'Total Screened,2450,96.5%\n';
        csv += 'Normal BMI,1824,74.4%\n';
        csv += 'Underweight / Wasted,368,15.0%\n';
        csv += 'Overweight,192,7.8%\n';
        csv += 'Obese Class I/II,66,2.7%\n';
        csv += 'Immunization Complete,2284,93.2%\n';
        csv += 'PE Normal Clearance,2234,91.2%\n';
        csv += 'PE Modified / Medical Exemption,216,8.8%\n';

        var blob = new Blob([csv], {
            type: 'text/csv;charset=utf-8;'
        });
        var link = document.createElement("a");
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", "SHSMS_Student_Health_Statistics_2026.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportSectionTableCSV() {
        var csv = 'Grade & Section,Strand,Adviser,Enrolled,Screened,Normal BMI,Underweight,Overweight/Obese,Chronic Cases,PE Exemption\n';
        csv += '"11-STEM-A","STEM","Engr. Danilo Ramos",45,"100% (45)","36 (80.0%)","5 (11.1%)","4 (8.9%)","3 Cases","1 Exempt"\n';
        csv += '"11-STEM-B","STEM","Ms. Jennifer Cruz",44,"97.7% (43)","34 (79.1%)","6 (14.0%)","3 (7.0%)","2 Cases","0 Exempt"\n';
        csv += '"11-ABM-A","ABM","Mr. Richard Tan",46,"95.7% (44)","33 (75.0%)","7 (15.9%)","4 (9.1%)","1 Case","2 Exempt"\n';
        csv += '"11-HUMSS-A","HUMSS","Mrs. Maria Teresa Lee",48,"97.9% (47)","35 (74.5%)","8 (17.0%)","4 (8.5%)","4 Cases","1 Exempt"\n';
        csv += '"11-TVL-ICT","TVL","Mr. Jonathan Gomez",42,"95.2% (40)","27 (67.5%)","9 (22.5%)","4 (10.0%)","2 Cases","0 Exempt"\n';
        csv += '"12-STEM-A","STEM","Dr. Fernando Morales",45,"100% (45)","37 (82.2%)","4 (8.9%)","4 (8.9%)","3 Cases","1 Exempt"\n';
        csv += '"12-ABM-A","ABM","Mrs. Grace Villar",43,"97.7% (42)","32 (76.2%)","6 (14.3%)","4 (9.5%)","1 Case","0 Exempt"\n';
        csv += '"12-HUMSS-B","HUMSS","Mr. Carlos Navarro",44,"95.5% (42)","31 (73.8%)","7 (16.7%)","4 (9.5%)","3 Cases","2 Exempt"\n';
        csv += '"12-GAS-A","GAS","Ms. Andrea Bautista",41,"95.1% (39)","28 (71.8%)","7 (17.9%)","4 (10.3%)","2 Cases","0 Exempt"\n';

        var blob = new Blob([csv], {
            type: 'text/csv;charset=utf-8;'
        });
        var link = document.createElement("a");
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", "SHSMS_Section_Health_Statistics_2026.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Reactive listener for storage updates
    window.addEventListener('smart-clinic-updated', function() {
        refreshDynamicStatistics();
        initBMIChart(currentBMIChartType);
    });
    window.addEventListener('storage', function(e) {
        if (e.key && e.key.startsWith('shsms_')) {
            refreshDynamicStatistics();
            initBMIChart(currentBMIChartType);
        }
    });
</script>
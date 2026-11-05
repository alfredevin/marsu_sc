<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring
 * View: Grades Tracking & Class Records (gradestracking.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */
?>
<div class="p-3" style="font-family: system-ui, -apple-system, sans-serif;">

    <style>
        .marsu-maroon-bg {
            background-color: #58111a !important;
            color: #fff !important;
        }

        .marsu-maroon-text {
            color: #58111a !important;
        }

        .marsu-table-header {
            background-color: #58111a !important;
            color: #ffffff !important;
            font-weight: 700;
            vertical-align: middle;
            border-color: #6d1b26 !important;
        }

        .marsu-sub-header {
            background-color: #480c14 !important;
            color: #ffffff !important;
            font-size: 11px;
            font-weight: 600;
            border-color: #5a121c !important;
            padding: 4px 6px !important;
        }

        .matrix-col-max {
            font-size: 9.5px;
            font-weight: 400;
            opacity: 0.75;
        }

        /* No. and Student Name stay in place while the matrix scrolls sideways */
        #matrixTable .matrix-freeze-no,
        #matrixTable .matrix-freeze-name {
            position: sticky;
            z-index: 2;
        }

        #matrixTable .matrix-freeze-no {
            left: 0;
            width: 40px;
            min-width: 40px;
            max-width: 40px;
        }

        #matrixTable .matrix-freeze-name {
            left: 40px;
            min-width: 190px;
            max-width: 190px;
            box-shadow: inset -2px 0 0 rgba(88, 17, 26, 0.35);
        }

        #matrixTable tbody .matrix-freeze-no,
        #matrixTable tbody .matrix-freeze-name {
            background-color: var(--bs-body-bg);
        }

        #matrixTable thead .matrix-freeze-no,
        #matrixTable thead .matrix-freeze-name {
            z-index: 3;
        }

        .class-card {
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            cursor: pointer;
            border-radius: 8px;
        }

        .class-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08) !important;
            border-color: #58111a !important;
        }

        .badge-att-p {
            background-color: #d1e7dd;
            color: #0f5132;
            cursor: pointer;
            border: 1px solid #badbcc;
            font-weight: 700;
            padding: 3px 6px;
            border-radius: 4px;
            display: inline-block;
            user-select: none;
        }

        .badge-att-a {
            background-color: #f8d7da;
            color: #842029;
            cursor: pointer;
            border: 1px solid #f5c2c7;
            font-weight: 700;
            padding: 3px 6px;
            border-radius: 4px;
            display: inline-block;
            user-select: none;
        }

        .badge-att-none {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: pointer;
            border: 1px dashed #ced4da;
            font-weight: 700;
            padding: 3px 7px;
            border-radius: 4px;
            display: inline-block;
            user-select: none;
        }

        .att-locked {
            cursor: default !important;
        }

        .badge-att-e {
            background-color: #cff4fc;
            color: #055160;
            cursor: pointer;
            border: 1px solid #b6effb;
            font-weight: 700;
            padding: 3px 6px;
            border-radius: 4px;
            display: inline-block;
            user-select: none;
        }

        .badge-att-l {
            background-color: #fff3cd;
            color: #664d03;
            cursor: pointer;
            border: 1px solid #ffecb5;
            font-weight: 700;
            padding: 3px 6px;
            border-radius: 4px;
            display: inline-block;
            user-select: none;
        }

        .score-input-matrix {
            width: 50px;
            height: 28px;
            font-size: 11.5px;
            font-weight: 600;
            text-align: center;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            color: #1e40af;
            background-color: #f8fafc;
        }

        .score-input-matrix:focus {
            background-color: #fff;
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .trans-grade-text {
            color: #2563eb;
            font-weight: 700;
            font-size: 11.5px;
        }

        .comp-total-text {
            color: #7f1d1d;
            font-weight: 800;
            font-size: 12px;
        }
    </style>

    <!-- STATE 1: MY CLASSES WORKSPACE GRID -->
    <div id="viewMyClasses" class="<?= !empty($selectedClassId) ? 'd-none' : '' ?>">

        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom flex-wrap gap-2">
            <div>
                <h5 class="fw-bold marsu-maroon-text mb-0">
                    <i class="bi bi-grid-fill me-2"></i>My Teaching Classes & Subject Sections
                </h5>
                <small class="text-muted">Manage your assigned lecture & laboratory rosters, customized grading
                    policies, and evaluations.</small>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm marsu-maroon-bg fw-semibold px-3 shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#createClassModal">
                    <i class="bi bi-plus-lg me-1"></i> Create New Class
                </button>
            </div>
        </div>

        <div class="row g-3" id="classesContainer"></div>

    </div>

    <!-- STATE 2: DYNAMIC CLASS RECORD & MATRIX EVALUATION -->
    <div id="viewClassMatrix" class="<?= empty($selectedClassId) ? 'd-none' : '' ?>">

        <!-- Top Toolbar & Navigation -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-1"
                            onclick="closeClassMatrix()">
                            <i class="bi bi-arrow-left me-1"></i> Back to Classes
                        </button>
                        <div class="bg-danger text-white rounded p-2 d-flex align-items-center justify-content-center"
                            style="width: 36px; height: 36px;">
                            <i class="bi bi-file-earmark-spreadsheet-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark" id="displayClassHeaderTitle">MarSU CICS Class Record &
                                Dynamic Evaluation Matrix</h6>
                            <small class="text-muted" style="font-size: 11.5px;">
                                <span id="lblSchoolYear">-</span> • <span class="text-danger fw-semibold">Linear Formula:
                                    -4*(Score/Total)+5</span>
                            </small>
                        </div>
                    </div>

                    <!-- Filter Badges & Controls -->
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary active filter-status-btn"
                                data-filter="all">All</button>
                            <button type="button" class="btn btn-outline-success filter-status-btn"
                                data-filter="passed">Passed</button>
                            <button type="button" class="btn btn-outline-danger filter-status-btn"
                                data-filter="failed">Failed</button>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-dark fw-semibold" data-bs-toggle="modal"
                            data-bs-target="#customizeSchemeModal">
                            <i class="bi bi-sliders me-1"></i> Customize Scheme
                        </button>

                        <button type="button" class="btn btn-sm marsu-maroon-bg fw-semibold px-3"
                            onclick="saveClassGrades()">
                            <i class="bi bi-floppy me-1"></i> Save All Grades
                        </button>
                    </div>
                </div>

                <!-- Sub Metadata Info Bar -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-2 border-top">
                    <div class="d-flex align-items-center gap-2 flex-wrap small">
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="bi bi-journal-bookmark me-1 text-primary"></i> Course: <strong
                                id="lblCourse">-</strong>
                        </span>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="bi bi-people me-1 text-primary"></i> Section: <strong id="lblSection">-</strong>
                        </span>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="bi bi-diagram-3 me-1 text-primary"></i> Scheme: <strong id="lblSchemeName">Active
                                Grading Scheme</strong>
                        </span>
                        <span class="badge px-2 py-1"
                            style="background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171;">
                            Passing Cutoff: ≤<span id="lblPassingCutoff">3.04</span>
                        </span>
                    </div>
                    <div class="text-muted small">
                        Enrolled Students: <span id="lblStudentCount" class="fw-bold text-dark">0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROSTER INTAKE ACTION BAR (PULL SECTION MASTERLIST / UPLOAD CSV / QUICK ADD) -->
        <div class="card border-0 shadow-sm mb-3">
            <div
                class="card-body p-2 bg-light rounded d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="small fw-bold text-secondary text-uppercase ms-1">Roster Intake:</span>

                    <!-- 1. Pull Students from Student Information Management by Section -->
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="pullStudentsFromSectionMasterlist()">
                        <i class="bi bi-cloud-arrow-down me-1"></i> Pull Masterlist for this Section
                    </button>

                    <!-- 2. Upload CSV / Excel File -->
                    <label class="btn btn-sm btn-outline-success mb-0" style="cursor: pointer;">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Upload CSV Class List
                        <input type="file" id="csvFileInput" accept=".csv, .txt" hidden
                            onchange="handleCsvUpload(this)">
                    </label>
                </div>

                <!-- 3. Quick Add Student -->
                <div class="d-flex align-items-center gap-1">
                    <input type="text" id="quickAddId" class="form-control form-control-sm"
                        placeholder="Student ID (e.g. 26S0227)" style="width: 160px;">
                    <input type="text" id="quickAddName" class="form-control form-control-sm" placeholder="Full Name"
                        style="width: 170px;">
                    <button type="button" class="btn btn-sm btn-dark" onclick="quickAddSingleStudent()">
                        <i class="bi bi-person-plus me-1"></i> Add
                    </button>
                </div>
            </div>
        </div>

        <!-- CLASS RECORD COLUMNS ACTION BAR (ATTENDANCE DATES / ASSESSMENT COLUMNS) -->
        <div class="card border-0 shadow-sm mb-3">
            <div
                class="card-body p-2 bg-light rounded d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="small fw-bold text-secondary text-uppercase ms-1">Class Record Columns:</span>
                    <div id="columnToolsButtons" class="d-flex align-items-center gap-2 flex-wrap">
                        <button type="button" class="btn btn-sm btn-outline-dark fw-semibold" onclick="manageColumns()"
                            title="Add, edit or remove assessment columns and attendance dates of each component.">
                            <i class="bi bi-layout-three-columns me-1"></i> Manage Columns
                        </button>
                    </div>
                    <span id="columnToolsReadOnly" class="small text-muted d-none">
                        <i class="bi bi-lock me-1"></i>Read-only. Only the faculty of this class can change its columns while the record is in draft.
                    </span>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap small text-muted me-1">
                    <span><span class="badge-att-p att-locked">P</span> Present</span>
                    <span><span class="badge-att-a att-locked">A</span> Absent</span>
                    <span><span class="badge-att-e att-locked">E</span> Excused</span>
                    <span><span class="badge-att-l att-locked">L</span> Late</span>
                    <span><span class="badge-att-none att-locked">–</span> Not recorded</span>
                    <span class="ms-1"><i class="bi bi-lock-fill"></i> Exam (fixed columns)</span>
                </div>
            </div>
        </div>

        <!-- EXCEL-STYLE DYNAMIC MATRIX TABLE -->
        <div class="table-responsive bg-white rounded border shadow-sm" style="max-height: 70vh;">
            <table class="table table-bordered table-hover align-middle mb-0 text-center" id="matrixTable"
                style="font-size: 11.5px;">
                <thead class="sticky-top">
                    <tr id="matrixHeaderGroupRow"></tr>
                    <tr id="matrixHeaderSubRow"></tr>
                </thead>
                <tbody id="matrixTableBody"></tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL 1: CREATE NEW CLASS (DYNAMIC SECTIONS FROM DATABASE) -->
<div class="modal fade" id="createClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="bi bi-plus-circle me-1"></i> Create New Teaching Class
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="formCreateClass">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">COURSE CODE & SUBJECT TITLE</label>
                        <input type="text" id="newCourseCode" class="form-control form-control-sm mb-2"
                            placeholder="e.g., IS101" required>
                        <input type="text" id="newCourseTitle" class="form-control form-control-sm"
                            placeholder="e.g., Fundamentals of Information Systems" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">YEAR & SECTION</label>
                            <select id="newSection" class="form-select form-select-sm" required>
                                <option value="">Select Section</option>
                                <?php if (!empty($sections)): ?>
                                    <?php foreach ($sections as $secItem): ?>
                                        <?php $sName = is_array($secItem) ? $secItem['name'] : $secItem; ?>
                                        <option value="<?= (int) ($secItem['id'] ?? 0) ?>">
                                            <?= htmlspecialchars($sName) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>No sections recorded</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">SEMESTER</label>
                            <select id="newSemester" class="form-select form-select-sm">
                                <option value="active"><?= htmlspecialchars($activeTermLabel ?? 'No active term') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">INITIAL GRADING TEMPLATE</label>
                        <select id="newGradingTemplate" class="form-select form-select-sm">
                            <?php foreach (($gradingTemplates ?? []) as $tpl): ?>
                                <option value="<?= (int) $tpl['id'] ?>"><?= htmlspecialchars($tpl['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm marsu-maroon-bg fw-semibold px-3"
                    onclick="submitCreateClass()">Create & Open Class</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL 2: CUSTOMIZE SCHEME -->
<div class="modal fade" id="customizeSchemeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header marsu-maroon-bg">
                <div>
                    <h6 class="modal-title fw-bold mb-0"><i class="bi bi-sliders me-1"></i> Customize Grading Policy &
                        Assessment Scheme</h6>
                    <small style="font-size: 11px; opacity: 0.9;">Configure assessment component weights and passing
                        threshold.</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="row g-3 bg-white p-3 rounded border mb-4">
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">TARGET COURSE</label>
                        <input type="text" id="cfgCourseTitle" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">SECTION</label>
                        <input type="text" id="cfgYearSection" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">PRESETS</label>
                        <select id="cfgPresetSelector" class="form-select form-select-sm"
                            onchange="loadPresetScheme(this.value)">
                            <option value="">Current class scheme</option>
                            <?php foreach (($gradingTemplates ?? []) as $tpl): ?>
                                <option value="<?= (int) $tpl['id'] ?>"><?= htmlspecialchars($tpl['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">PASSING CUTOFF</label>
                        <input type="number" step="0.01" id="cfgPassingCutoff" class="form-control form-control-sm"
                            value="3.04">
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark">Component Weights Builder</h6>
                    <div id="weightsValidationBadge"
                        class="badge bg-success-subtle text-success border border-success px-3 py-2 fs-7">
                        Total: 100% (Balanced)
                    </div>
                </div>
                <div id="schemeGroupsContainer" class="d-flex flex-column gap-3"></div>
            </div>
            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm marsu-maroon-bg text-white px-4 fw-semibold"
                    onclick="saveAndApplyScheme()">Save & Apply Scheme</button>
            </div>
        </div>
    </div>
</div>

<script>
    let classesStore = <?= json_encode($facultyClasses ?? []) ?>;
    const masterStudentsDB = <?= json_encode($allStudentsMasterlist ?? []) ?>;

    let activeClass = null;
    let classStudentsStore = {};
    let classSchemes = {};
    let classScores = {};

    const defaultPresets = {
        preset_cics: {
            name: "Default Grading System (30-30-40)",
            passingCutoff: 3.04,
            groups: [
                {
                    id: "grp_att_quiz",
                    title: "ATTENDANCE AND QUIZZES",
                    weight: 30,
                    hasAttendance: true,
                    attendanceDates: [],
                    items: [
                        { code: "Q1", title: "Quiz 1", type: "Quiz (Raw)", maxScore: 20 },
                        { code: "Q2", title: "Quiz 2", type: "Quiz (Raw)", maxScore: 20 }
                    ]
                },
                {
                    id: "grp_act_perf",
                    title: "ACTIVITIES AND EXERCISES",
                    weight: 30,
                    hasAttendance: false,
                    attendanceDates: [],
                    items: [
                        { code: "A1", title: "Activity 1", type: "Activity", maxScore: 100 },
                        { code: "G1", title: "Group 1", type: "Group", maxScore: 100 }
                    ]
                },
                {
                    id: "grp_exams",
                    title: "MAJOR EXAMS",
                    weight: 40,
                    hasAttendance: false,
                    attendanceDates: [],
                    items: [
                        { code: "Midterm", title: "Midterm Exam", type: "Exam", maxScore: 100 },
                        { code: "Finals", title: "Final Exam", type: "Exam", maxScore: 100 }
                    ]
                }
            ]
        },

    };

    const canCreateOffering = <?= can('analytics.admin.classes') ? 'true' : 'false' ?>;
    const canCreateClass = <?= !empty($canCreateClass) ? 'true' : 'false' ?>;
    const csrfToken = <?= json_encode(csrf_token()) ?>;
    const matrixBaseUrl = <?= json_encode(url('analytics/faculty/classes')) ?>;
    const createClassUrl = <?= json_encode(url('analytics/faculty/gradestracking/create')) ?>;
    const templatePresets = <?= json_encode(array_column(array_map(fn($t) => ['id' => (string) $t['id'], 'scheme' => $t['scheme']], $gradingTemplates ?? []), 'scheme', 'id')) ?>;
    const todayIso = <?= json_encode(date('Y-m-d')) ?>;
    let workingScheme = null;
    let pendingScores = {};
    let scoreTimer = null;

    function readOnlyNotice() {
        const status = activeClass ? activeClass.grade_status : null;
        let text = 'Only the faculty who owns this class can change it.';
        let confirm = { confirmButtonColor: '#58111a' };
        if (activeClass && canCreateClass && status === 'posted') {
            text = 'The grades of this class are already posted, so the record is locked. To change it, file a correction request on the class record page; once the administrator approves, it returns to draft.';
            confirm = { confirmButtonColor: '#58111a', showCancelButton: true, confirmButtonText: 'Open class record', cancelButtonText: 'Close' };
        } else if (activeClass && status === 'locked') {
            text = 'This class belongs to a closed term and is permanently locked.';
        }
        Swal.fire(Object.assign({ icon: 'info', title: 'Read-only class record', text: text }, confirm)).then(r => {
            if (r.isConfirmed && confirm.confirmButtonText) {
                window.location.href = `${matrixBaseUrl}/${activeClass.id}`;
            }
        });
    }

    function canEditActive() {
        return !!(activeClass && activeClass.can_edit);
    }

    function initStores() {
        classesStore.forEach(cls => {
            classSchemes[cls.id] = cls.scheme || JSON.parse(JSON.stringify(defaultPresets.preset_cics));
            classStudentsStore[cls.id] = cls.students || [];
            classScores[cls.id] = cls.scores || {};
        });
    }

    // Replace a class with the server's fresh copy and redraw it
    function applyClassPayload(cls, rerender = true) {
        const idx = classesStore.findIndex(c => c.id === cls.id);
        if (idx >= 0) classesStore[idx] = cls; else classesStore.push(cls);
        classSchemes[cls.id] = cls.scheme;
        classStudentsStore[cls.id] = cls.students || [];
        classScores[cls.id] = cls.scores || {};
        if (activeClass && activeClass.id === cls.id) {
            activeClass = cls;
            if (rerender) openClassMatrix(cls.id);
        }
    }

    function sendMatrix(action, payload = {}, opts = {}) {
        if (!canEditActive()) { readOnlyNotice(); return Promise.resolve(null); }
        return fetch(`${matrixBaseUrl}/${activeClass.id}/matrix`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify(Object.assign({ action: action }, payload))
        })
            .then(r => r.json())
            .then(data => {
                if (data.class) applyClassPayload(data.class, opts.rerender !== false);
                if (!opts.quiet || data.status !== 'success') {
                    Swal.fire({ icon: data.status === 'success' ? 'success' : 'warning', text: data.message, confirmButtonColor: '#58111a' });
                }
                return data;
            })
            .catch(() => Swal.fire({ icon: 'error', text: 'Could not reach the server. Your change was not saved.' }));
    }

    function loadPresetScheme(templateId) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        workingScheme = JSON.parse(JSON.stringify(templateId && templatePresets[templateId] ? templatePresets[templateId] : classSchemes[activeClass.id]));
        document.getElementById('cfgPassingCutoff').value = Number(workingScheme.passingCutoff).toFixed(2);
        renderSchemeBuilder();
    }

    function renderSchemeBuilder() {
        const box = document.getElementById('schemeGroupsContainer');
        const editable = canEditActive();
        box.innerHTML = '';
        workingScheme.groups.forEach((g, gi) => {
            const card = document.createElement('div');
            card.className = 'bg-white border rounded p-3';
            // Attendance counts toward one non-exam component; the other boxes stay locked until it is unticked
            const attOwner = workingScheme.groups.find(o => o.hasAttendance);
            const attLocked = !g.hasAttendance && (!!attOwner || g.isExam);
            const attHint = g.hasAttendance ? 'Attendance dates count toward this component. Untick to choose another component.'
                : (attOwner ? `Attendance already counts toward ${attOwner.title}. Untick it there first.` : (g.isExam ? 'Exam components cannot record attendance.' : 'Count attendance dates toward this component (one component only).'));
            const examLocked = g.hasAttendance;
            const examHint = examLocked ? 'This component records attendance, so it cannot be an exam component.' : 'Exam components (Midterm, Finals) keep fixed columns in the class record.';
            const rows = g.items.map((it, ii) => `
                <tr>
                    <td><input class="form-control form-control-sm" data-g="${gi}" data-i="${ii}" data-f="code" value="${String(it.code).replace(/"/g, '&quot;')}" ${editable ? '' : 'disabled'}></td>
                    <td><input class="form-control form-control-sm" data-g="${gi}" data-i="${ii}" data-f="title" value="${String(it.title).replace(/"/g, '&quot;')}" ${editable ? '' : 'disabled'}></td>
                    <td style="width:110px"><input type="number" min="0.01" step="any" class="form-control form-control-sm" data-g="${gi}" data-i="${ii}" data-f="maxScore" value="${it.maxScore}" ${editable ? '' : 'disabled'}></td>
                    <td style="width:40px">${editable ? `<button type="button" class="btn btn-sm text-danger" data-remove-item="${gi}:${ii}"><i class="bi bi-x-circle"></i></button>` : ''}</td>
                </tr>`).join('');
            card.innerHTML = `
                <div class="d-flex gap-2 align-items-center mb-2">
                    <input class="form-control form-control-sm fw-bold" data-g="${gi}" data-f="title" value="${String(g.title).replace(/"/g, '&quot;')}" ${editable ? '' : 'disabled'}>
                    <div class="input-group input-group-sm" style="width:130px">
                        <input type="number" min="0" max="100" step="any" class="form-control" data-g="${gi}" data-f="weight" value="${g.weight}" ${editable ? '' : 'disabled'}>
                        <span class="input-group-text">%</span>
                    </div>
                    <div class="form-check text-nowrap small mb-0" title="${escAttr(attHint)}">
                        <input class="form-check-input" type="checkbox" data-g="${gi}" data-f="hasAttendance" ${g.hasAttendance ? 'checked' : ''} ${editable && !attLocked ? '' : 'disabled'}>
                        <label class="form-check-label">Attendance</label>
                    </div>
                    <div class="form-check text-nowrap small mb-0" title="${escAttr(examHint)}">
                        <input class="form-check-input" type="checkbox" data-g="${gi}" data-f="isExam" ${g.isExam ? 'checked' : ''} ${editable && !examLocked ? '' : 'disabled'}>
                        <label class="form-check-label">Exam (fixed)</label>
                    </div>
                    ${editable ? `<button type="button" class="btn btn-sm btn-outline-danger" data-remove-group="${gi}"><i class="bi bi-trash"></i></button>` : ''}
                </div>
                <table class="table table-sm mb-1"><thead><tr class="small text-muted"><th>Code</th><th>Title</th><th>Max Score</th><th></th></tr></thead><tbody>${rows}</tbody></table>
                ${editable ? `<button type="button" class="btn btn-sm btn-link p-0" data-add-item="${gi}"><i class="bi bi-plus"></i> Add assessment item</button>` : ''}`;
            box.appendChild(card);
        });
        if (editable) {
            const add = document.createElement('button');
            add.type = 'button';
            add.className = 'btn btn-sm btn-outline-secondary align-self-start';
            add.innerHTML = '<i class="bi bi-plus me-1"></i>Add component';
            add.onclick = () => { workingScheme.groups.push({ id: 'grp_' + Date.now(), title: 'NEW COMPONENT', weight: 0, hasAttendance: false, isExam: false, items: [] }); renderSchemeBuilder(); };
            box.appendChild(add);
        }
        box.querySelectorAll('[data-f]').forEach(inp => inp.addEventListener('input', () => {
            const g = workingScheme.groups[inp.dataset.g];
            const target = inp.dataset.i !== undefined ? g.items[inp.dataset.i] : g;
            const f = inp.dataset.f;
            target[f] = inp.type === 'checkbox' ? inp.checked : (inp.type === 'number' ? parseFloat(inp.value) || 0 : inp.value);
            // Redraw so the Attendance / Exam boxes of every component lock or unlock
            if (f === 'hasAttendance' || f === 'isExam') {
                renderSchemeBuilder();
                return;
            }
            updateWeightsBadge();
        }));
        box.querySelectorAll('[data-remove-item]').forEach(b => b.onclick = () => { const [gi, ii] = b.dataset.removeItem.split(':'); workingScheme.groups[gi].items.splice(ii, 1); renderSchemeBuilder(); });
        box.querySelectorAll('[data-remove-group]').forEach(b => b.onclick = () => { workingScheme.groups.splice(b.dataset.removeGroup, 1); renderSchemeBuilder(); });
        box.querySelectorAll('[data-add-item]').forEach(b => b.onclick = () => { workingScheme.groups[b.dataset.addItem].items.push({ code: 'T' + Date.now().toString().slice(-4), title: 'New Task', maxScore: 100 }); renderSchemeBuilder(); });
        updateWeightsBadge();
    }

    function updateWeightsBadge() {
        const total = workingScheme.groups.reduce((s, g) => s + (parseFloat(g.weight) || 0), 0);
        const badge = document.getElementById('weightsValidationBadge');
        const ok = Math.abs(total - 100) < 0.01;
        badge.className = 'badge px-3 py-2 fs-7 border ' + (ok ? 'bg-success-subtle text-success border-success' : 'bg-danger-subtle text-danger border-danger');
        badge.textContent = `Total: ${Math.round(total * 100) / 100}% (${ok ? 'Balanced' : 'Must equal 100%'})`;
    }

    function saveAndApplyScheme() {
        if (!canEditActive()) { readOnlyNotice(); return; }
        sendMatrix('scheme', { scheme: workingScheme, passing_cutoff: document.getElementById('cfgPassingCutoff').value }).then(data => {
            if (data && data.status === 'success') {
                bootstrap.Modal.getInstance(document.getElementById('customizeSchemeModal'))?.hide();
            }
        });
    }

    // =========================================================================
    // SMART ROSTER PULL ENGINE (REGISTRAR-ENROLLED STUDENTS OF THIS CLASS SECTION)
    // =========================================================================
    function pullStudentsFromSectionMasterlist() {
        if (!activeClass) return;
        sendMatrix('pull_section');
    }

    function handleCsvUpload(inputElem) {
        if (!activeClass) return;
        const file = inputElem.files[0];
        inputElem.value = '';
        if (!file) return;
        if (!canEditActive()) { readOnlyNotice(); return; }

        const reader = new FileReader();
        reader.onload = function (e) {
            const numbers = [];
            e.target.result.split(/\r\n|\n/).forEach((line, index) => {
                if (!line.trim() || index === 0 && (line.toLowerCase().includes('id') || line.toLowerCase().includes('name'))) return;
                const cols = line.includes('\t') ? line.split('\t') : line.split(',');
                const sId = (cols[0] || '').replace(/"/g, '').trim();
                if (sId) numbers.push(sId);
            });
            sendMatrix('csv', { student_numbers: numbers });
        };
        reader.readAsText(file);
    }

    function quickAddSingleStudent() {
        if (!activeClass) return;
        const idInput = document.getElementById('quickAddId');
        const sId = idInput.value.trim();
        if (!sId) { Swal.fire({ icon: 'warning', text: 'Please enter the Student ID.' }); return; }
        sendMatrix('add', { student_number: sId }).then(data => {
            if (data && data.status === 'success') {
                idInput.value = '';
                document.getElementById('quickAddName').value = '';
            }
        });
    }

    function removeStudentFromClass(sId) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        Swal.fire({ icon: 'question', text: 'Remove this student from roster?', showCancelButton: true, confirmButtonColor: '#58111a', confirmButtonText: 'Remove' })
            .then(r => { if (r.isConfirmed) sendMatrix('remove', { student_number: sId }); });
    }
    function renderClassesGrid() {
        const container = document.getElementById('classesContainer');
        container.innerHTML = '';

        if (!classesStore || classesStore.length === 0) {
            container.innerHTML = `
            <div class="col-12 text-center py-5 text-muted bg-white rounded border shadow-sm">
                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                <p class="mb-0 fw-semibold">No teaching classes found</p>
                <small>Click "Create New Class" above to set up your subjects.</small>
            </div>
        `;
            return;
        }

        classesStore.forEach(cls => {
            const studentCount = classStudentsStore[cls.id]?.length || 0;
            const col = document.createElement('div');
            col.className = 'col-md-4 col-sm-6';
            col.innerHTML = `
            <div class="card h-100 border shadow-sm class-card p-3" onclick="openClassMatrix('${cls.id}')">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge text-white px-2 py-1" style="background-color: #58111a;">${cls.course_code}</span>
                    <span class="badge bg-light text-secondary border">${cls.semester || '-'}</span>
                </div>
                <h6 class="fw-bold text-dark mb-1 text-truncate">${cls.course_title}</h6>
                <div class="text-muted small mb-3">
                    Section: <strong class="text-dark">${cls.section}</strong> • ${cls.school_year || '-'}
                </div>
                <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center small">
                    <span class="text-muted"><i class="bi bi-people me-1"></i>${studentCount} Students</span>
                    <span class="text-primary fw-semibold">Open Class Record →</span>
                </div>
            </div>
        `;
            container.appendChild(col);
        });
    }

    function openClassMatrix(classId) {
        activeClass = classesStore.find(c => c.id === classId);
        if (!activeClass) return;

        document.getElementById('viewMyClasses').classList.add('d-none');
        document.getElementById('viewClassMatrix').classList.remove('d-none');

        document.getElementById('lblCourse').innerText = `${activeClass.course_code} - ${activeClass.course_title}`;
        document.getElementById('lblSection').innerText = activeClass.section;
        document.getElementById('lblSchoolYear').innerText = [activeClass.school_year, activeClass.semester].filter(Boolean).join(' • ') || '-';
        document.getElementById('lblSchemeName').innerText = classSchemes[activeClass.id]?.name || 'Custom Scheme';
        document.getElementById('lblPassingCutoff').innerText = (classSchemes[activeClass.id]?.passingCutoff || 3.04).toFixed(2);
        const schemeBtn = document.querySelector('[data-bs-target="#customizeSchemeModal"]');
        if (schemeBtn) schemeBtn.style.display = activeClass.is_owner ? '' : 'none';
        document.getElementById('columnToolsButtons').classList.toggle('d-none', !activeClass.can_edit);
        document.getElementById('columnToolsReadOnly').classList.toggle('d-none', !!activeClass.can_edit);

        renderMatrix();
    }

    function closeClassMatrix() {
        activeClass = null;
        document.getElementById('viewClassMatrix').classList.add('d-none');
        document.getElementById('viewMyClasses').classList.remove('d-none');
        renderClassesGrid();
    }

    function submitCreateClass() {
        const code = document.getElementById('newCourseCode').value.trim();
        const sec = document.getElementById('newSection').value.trim();
        const tmpl = document.getElementById('newGradingTemplate').value;

        if (!canCreateClass) {
            if (canCreateOffering) {
                window.location.href = <?= json_encode(url('analytics/admin/classes/create')) ?>;
            } else {
                readOnlyNotice();
            }
            return;
        }
        if (!code || !sec || !tmpl) { Swal.fire({ icon: 'warning', text: 'Please complete required fields.' }); return; }

        fetch(createClassUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ subject_code: code, section_id: sec, template_id: tmpl })
        })
            .then(r => r.json())
            .then(data => {
                if (data.status !== 'success') {
                    Swal.fire({ icon: 'warning', text: data.message, confirmButtonColor: '#58111a' });
                    return;
                }
                applyClassPayload(data.class);
                bootstrap.Modal.getInstance(document.getElementById('createClassModal')).hide();
                renderClassesGrid();
                openClassMatrix(data.class.id);
                Swal.fire({ icon: 'success', text: data.message, confirmButtonColor: '#58111a' });
            })
            .catch(() => Swal.fire({ icon: 'error', text: 'Could not reach the server. The class was not created.' }));
    }
    function renderMatrix() {
        if (!activeClass) return;
        const scheme = classSchemes[activeClass.id] || defaultPresets.preset_cics;
        const students = classStudentsStore[activeClass.id] || [];

        document.getElementById('lblStudentCount').innerText = students.length;

        const groupRow = document.getElementById('matrixHeaderGroupRow');
        const subRow = document.getElementById('matrixHeaderSubRow');
        const tbody = document.getElementById('matrixTableBody');

        groupRow.innerHTML = '<th rowspan="2" class="marsu-table-header matrix-freeze-no">No.</th><th rowspan="2" class="marsu-table-header text-start ps-3 matrix-freeze-name">Student Name</th>';
        subRow.innerHTML = '';
        tbody.innerHTML = '';

        let totalCols = 2 + 3;

        scheme.groups.forEach(grp => {
            let colCount = (grp.items.length * 2);
            if (grp.hasAttendance) colCount += (grp.attendanceDates.length + 2);
            colCount += 1;
            totalCols += colCount;

            groupRow.innerHTML += `<th colspan="${colCount}" class="marsu-table-header text-uppercase py-2 border-start border-end"${grp.isExam ? ' title="Exam component: fixed columns"' : ''}>${grp.isExam ? '<i class="bi bi-lock-fill me-1"></i>' : ''}${grp.title} (${grp.weight}%)</th>`;

            grp.items.forEach(it => {
                subRow.innerHTML += `
                <th class="marsu-sub-header text-center" style="min-width: 64px;" title="${escAttr(it.title)}: raw score out of ${it.maxScore}">
                    <div class="fw-bold">${escAttr(it.code)}</div>
                    <div class="matrix-col-max">out of ${it.maxScore}</div>
                </th>
                <th class="marsu-sub-header text-center" style="min-width: 55px;" title="Grade of ${escAttr(it.code)} on the 1.00–5.00 scale: 5 − 4 × (score ÷ ${it.maxScore})">Grade</th>
            `;
            });

            if (grp.hasAttendance) {
                grp.attendanceDates.forEach(d => {
                    subRow.innerHTML += `<th class="marsu-sub-header text-center" style="min-width: 45px;" title="Attendance on ${d}">${d}</th>`;
                });
                subRow.innerHTML += `<th class="marsu-sub-header text-center" style="min-width: 62px;" title="Present and Excused count 1, Late counts ${formatCredit(attendanceCredit('L'))}, Absent counts 0. Out of the dates recorded for the student.">Days<br>Credited</th>`
                    + `<th class="marsu-sub-header text-center" style="min-width: 70px;" title="Attendance on the 1.00–5.00 scale: 5 − 4 × (days credited ÷ dates recorded)">Attendance<br>Grade</th>`;
            }

            subRow.innerHTML += `<th class="marsu-sub-header text-center bg-danger-subtle text-dark" style="min-width: 70px;" title="Average of the grades in this component × ${grp.weight}%">Weighted<br>(${grp.weight}%)</th>`;
        });

        groupRow.innerHTML += '<th rowspan="2" class="marsu-table-header" style="min-width: 80px;">FINAL GRADE</th><th rowspan="2" class="marsu-table-header" style="min-width: 90px;">REMARKS</th><th rowspan="2" class="marsu-table-header" style="width: 40px;"></th>';

        if (students.length === 0) {
            tbody.innerHTML = `
            <tr>
                <td colspan="${totalCols}" class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                    <p class="mb-0 fw-semibold">No students enrolled in this class record yet</p>
                    <small>Click "Pull Masterlist for this Section" or "Upload CSV Class List" in the intake bar above.</small>
                </td>
            </tr>
        `;
            return;
        }

        students.forEach((std, idx) => {
            const sId = std.student_id;
            const sName = std.full_name || 'Student';
            const sDept = std.department || activeClass.course_code;

            const row = document.createElement('tr');
            row.id = `row_${sId}`;
            row.className = "student-row align-middle";

            let html = `
            <td class="fw-bold text-muted matrix-freeze-no">${idx + 1}</td>
            <td class="text-start ps-3 matrix-freeze-name">
                <div class="fw-bold text-dark" style="font-size: 12.5px;">${sName}</div>
                <small class="text-muted" style="font-size: 10px;">${sId} • ${sDept}</small>
            </td>
        `;

            let overallFinalGrade = 0;

            scheme.groups.forEach(grp => {
                let groupComponentsTotalTrans = 0;
                let componentCount = 0;

                grp.items.forEach(it => {
                    const curVal = classScores[activeClass.id]?.[sId]?.rawScores[it.code] || 0;
                    let transmuted = computeTransmutation(curVal, it.maxScore);

                    html += `
                    <td><input type="number" step="any" min="0" max="${it.maxScore}" class="score-input-matrix" value="${curVal}" ${activeClass.can_edit ? `onchange="updateRawScore('${sId}', '${it.code}', ${it.maxScore}, this.value)"` : 'readonly onfocus="readOnlyNotice(); this.blur();"'}></td>
                    <td class="trans-grade-text" id="trans_${sId}_${it.code}">${transmuted.toFixed(2)}</td>
                `;
                    groupComponentsTotalTrans += transmuted;
                    componentCount++;
                });

                if (grp.hasAttendance) {
                    const att = attendanceSummary(sId, grp.attendanceDates);
                    grp.attendanceDates.forEach(d => {
                        const st = attendanceStatus(sId, d);
                        html += activeClass.can_edit
                            ? `<td><span class="${attendanceBadgeClass(st)}" title="${attendanceLabel(st)} (click to change)" onclick="toggleAttendance('${sId}', '${d}', this)">${st}</span></td>`
                            : `<td><span class="${attendanceBadgeClass(st)} att-locked" title="${attendanceLabel(st)}">${st}</span></td>`;
                    });
                    html += `<td class="fw-bold text-dark" id="att_count_${sId}_${grp.id}">${daysCreditedText(att)}</td><td class="trans-grade-text" id="att_trans_${sId}_${grp.id}">${att.trans === null ? '—' : att.trans.toFixed(2)}</td>`;
                    if (att.trans !== null) {
                        groupComponentsTotalTrans += att.trans;
                        componentCount++;
                    }
                }

                let avgTrans = componentCount > 0 ? (groupComponentsTotalTrans / componentCount) : 5.00;
                let share = avgTrans * (grp.weight / 100);
                overallFinalGrade += share;
                html += `<td class="comp-total-text" id="grp_total_${sId}_${grp.id}">${share.toFixed(2)}</td>`;
            });

            const postedEntry = classScores[activeClass.id]?.[sId]?.posted || null;
            const isPassed = postedEntry ? postedEntry.remarks === 'PASSED' : overallFinalGrade <= scheme.passingCutoff;
            const finalText = postedEntry ? postedEntry.final_grade : overallFinalGrade.toFixed(2);
            const remarksText = postedEntry ? postedEntry.remarks : (isPassed ? 'PASSED' : 'FAILED');
            row.dataset.finalGrade = finalText;
            row.dataset.status = isPassed ? 'passed' : 'failed';

            html += `
            <td class="fw-bold text-primary fs-6" id="final_grade_${sId}">${finalText}${postedEntry ? '' : '<div class="text-muted fw-normal" style="font-size:10px">Draft</div>'}</td>
            <td id="remarks_${sId}"><span class="badge ${isPassed ? 'bg-success' : (remarksText === 'INC' ? 'bg-warning text-dark' : 'bg-danger')}">${remarksText}</span></td>
            <td>
                <button type="button" class="btn btn-xs text-danger" title="Remove Student" onclick="removeStudentFromClass('${sId}')">
                    <i class="bi bi-x-circle"></i>
                </button>
            </td>
        `;

            row.innerHTML = html;
            tbody.appendChild(row);
        });

        if (window.matrixPaginator) {
            window.matrixPaginator.refresh();
        }
    }

    function computeTransmutation(score, maxScore) {
        if (!maxScore || maxScore <= 0) return 5.00;
        let ratio = Math.max(0, Math.min(1, score / maxScore));
        return parseFloat(((-4 * ratio) + 5.00).toFixed(2));
    }

    // P and E earn full credit, L earns the configured late weight, A earns none
    function attendanceCredit(st) {
        if (st === 'A') return 0;
        if (st === 'L') return Number(activeClass && activeClass.late_weight != null ? activeClass.late_weight : 1);
        return 1;
    }

    function attendanceBadgeClass(st) {
        return { P: 'badge-att-p', A: 'badge-att-a', E: 'badge-att-e', L: 'badge-att-l' }[st] || 'badge-att-none';
    }

    function attendanceLabel(st) {
        return { P: 'Present', A: 'Absent', E: 'Excused', L: 'Late' }[st] || 'Not recorded';
    }

    function attendanceStatus(sId, d) {
        const st = classScores[activeClass.id]?.[sId]?.attendance?.[d];
        return ['P', 'A', 'E', 'L'].includes(st) ? st : '–';
    }

    // Same rule as the server: only recorded dates count, so ATT = credit ÷ recorded sessions
    function attendanceSummary(sId, dates) {
        let credit = 0;
        let recorded = 0;
        dates.forEach(d => {
            const st = attendanceStatus(sId, d);
            if (st !== '–') {
                recorded++;
                credit += attendanceCredit(st);
            }
        });
        return { credit: credit, recorded: recorded, trans: recorded > 0 ? computeTransmutation(credit, recorded) : null };
    }

    function formatCredit(v) {
        return Number.isInteger(v) ? String(v) : v.toFixed(2);
    }

    // e.g. "1.75 / 2": days credited out of the dates recorded for the student
    function daysCreditedText(att) {
        return att.recorded > 0 ? `${formatCredit(att.credit)} / ${att.recorded}` : '—';
    }

    // =========================================================================
    // CLASS RECORD COLUMNS (MANAGE COLUMNS PANEL)
    // Columns and attendance dates are managed per component, so the panel follows
    // whatever scheme the faculty built. Every change is saved by the server and the
    // matrix is redrawn from its copy; the panel then reopens with the result.
    // =========================================================================
    const swalTheme = { confirmButtonColor: '#58111a', cancelButtonText: 'Back' };

    function escAttr(v) {
        return String(v).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;');
    }

    // Save typed scores first so the redraw after a column change does not hide them
    function afterPendingScores(fn) {
        clearTimeout(scoreTimer);
        flushScores().then(() => fn());
    }

    function activeGroups() {
        return classSchemes[activeClass.id].groups;
    }

    function findGroup(groupId) {
        return activeGroups().find(g => g.id === groupId) || null;
    }

    // Run a column action, then return to the panel showing the server's message
    function columnAction(action, payload) {
        afterPendingScores(() => sendMatrix(action, payload, { quiet: true }).then(data => {
            if (data && data.status === 'success') manageColumns(data.message);
        }));
    }

    function nextItemTitle(grp, code) {
        const last = grp.items.length ? String(grp.items[grp.items.length - 1].title) : '';
        const m = last.match(/^(.*?)(\d+)$/);
        return m ? m[1] + (parseInt(m[2], 10) + 1) : code;
    }

    function itemFields(code, title, max, codeEditable) {
        return `
            <div class="row g-2 text-start">
                <div class="col-4">
                    <label class="form-label small fw-semibold mb-1">Code</label>
                    <input id="swalItemCode" class="form-control form-control-sm" maxlength="32" value="${escAttr(code)}" ${codeEditable ? '' : 'disabled'}>
                </div>
                <div class="col-8">
                    <label class="form-label small fw-semibold mb-1">Title</label>
                    <input id="swalItemTitle" class="form-control form-control-sm" maxlength="100" value="${escAttr(title)}">
                </div>
                <div class="col-4">
                    <label class="form-label small fw-semibold mb-1">Max score</label>
                    <input id="swalItemMax" type="number" min="0.01" max="1000" step="any" class="form-control form-control-sm" value="${escAttr(max)}">
                </div>
            </div>`;
    }

    function readItemFields() {
        const code = document.getElementById('swalItemCode').value.trim();
        const max = parseFloat(document.getElementById('swalItemMax').value);
        if (!/^[A-Za-z0-9_\-]{1,32}$/.test(code)) { Swal.showValidationMessage('Code may only use letters, numbers, - and _.'); return false; }
        if (!(max > 0 && max <= 1000)) { Swal.showValidationMessage('Max score must be more than 0 and at most 1000.'); return false; }
        return { code: code, title: document.getElementById('swalItemTitle').value.trim(), max_score: max };
    }

    function componentLabel(grp) {
        return `<div class="small text-muted mb-2">${escAttr(grp.title)} (${grp.weight}%)</div>`;
    }

    // Cancel ("Back") in every sub-dialog returns to the panel
    function backOnCancel(r) {
        if (r.dismiss === Swal.DismissReason.cancel) manageColumns();
    }

    function addItemColumn(groupId) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        const grp = findGroup(groupId);
        if (!grp || grp.isExam) return;
        const code = grp.nextCode || '';
        const max = grp.items.length ? grp.items[grp.items.length - 1].maxScore : 100;
        Swal.fire(Object.assign({
            title: 'Add Column',
            width: 560,
            html: `${componentLabel(grp)}${itemFields(code, nextItemTitle(grp, code), max, true)}
                   <div class="small text-muted text-start mt-2"><i class="bi bi-info-circle me-1"></i>Added after the last column of this component. The component average is recomputed with it.</div>`,
            showCancelButton: true,
            confirmButtonText: 'Add column',
            preConfirm: readItemFields
        }, swalTheme)).then(r => {
            if (r.isConfirmed) columnAction('add_item', Object.assign({ group_id: groupId }, r.value)); else backOnCancel(r);
        });
    }

    function editItemColumn(groupId, code) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        const grp = findGroup(groupId);
        const it = grp ? grp.items.find(i => i.code === code) : null;
        if (!it || grp.isExam) return;
        Swal.fire(Object.assign({
            title: `Edit Column ${code}`,
            width: 560,
            html: `${componentLabel(grp)}${itemFields(code, it.title, it.maxScore, false)}`,
            showCancelButton: true,
            confirmButtonText: 'Save changes',
            preConfirm: readItemFields
        }, swalTheme)).then(r => {
            if (r.isConfirmed) columnAction('edit_item', { group_id: groupId, code: code, title: r.value.title, max_score: r.value.max_score }); else backOnCancel(r);
        });
    }

    function removeItemColumn(groupId, code) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        const grp = findGroup(groupId);
        if (!grp || grp.isExam) return;
        Swal.fire(Object.assign({
            icon: 'warning',
            title: `Remove Column ${code}?`,
            text: `The scores encoded in ${code} are deleted, and the ${grp.title} average is recomputed without it.`,
            showCancelButton: true,
            confirmButtonText: 'Remove column'
        }, swalTheme)).then(r => {
            if (r.isConfirmed) columnAction('remove_item', { group_id: groupId, code: code }); else backOnCancel(r);
        });
    }

    function addAttendanceDate() {
        if (!canEditActive()) { readOnlyNotice(); return; }
        const grp = activeGroups().find(g => g.hasAttendance);
        if (!grp) { manageColumns(); return; }
        const last = grp.attendanceDates.length ? grp.attendanceDates[grp.attendanceDates.length - 1] : null;
        Swal.fire(Object.assign({
            title: 'Add Attendance Date',
            width: 520,
            html: `
                ${componentLabel(grp)}
                <div class="text-start">
                    <label class="form-label small fw-semibold mb-1">Class meeting date</label>
                    <input type="date" id="swalAttDate" class="form-control form-control-sm mb-2" max="${todayIso}" value="${todayIso}">
                    <label class="form-label small fw-semibold mb-1">Starting mark for every student</label>
                    <select id="swalAttDefault" class="form-select form-select-sm">
                        <option value="P">Present (then mark the absent / late / excused)</option>
                        <option value="A">Absent (then mark those who attended)</option>
                    </select>
                    <div class="small text-muted mt-2"><i class="bi bi-info-circle me-1"></i>${last ? `Last date: ${escAttr(last)}. ` : ''}Click a student's mark in the table to cycle P → A → E → L.</div>
                </div>`,
            showCancelButton: true,
            confirmButtonText: 'Add date',
            preConfirm: () => {
                const date = document.getElementById('swalAttDate').value;
                if (!date) { Swal.showValidationMessage('Choose a date.'); return false; }
                if (date > todayIso) { Swal.showValidationMessage('Attendance cannot be recorded for a future date.'); return false; }
                return { date: date, status: document.getElementById('swalAttDefault').value };
            }
        }, swalTheme)).then(r => {
            if (r.isConfirmed) columnAction('add_session', r.value); else backOnCancel(r);
        });
    }

    function removeAttendanceDate(label) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        const date = (activeClass.date_map || {})[label];
        Swal.fire(Object.assign({
            icon: 'warning',
            title: `Remove ${label}?`,
            text: 'Every student\'s mark for that day is removed and the attendance share is recomputed from the remaining dates.',
            showCancelButton: true,
            confirmButtonText: 'Remove date'
        }, swalTheme)).then(r => {
            if (r.isConfirmed) columnAction('remove_session', { date: date }); else backOnCancel(r);
        });
    }

    function manageColumns(notice) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        const attGroup = activeGroups().find(g => g.hasAttendance) || null;
        const btn = (attrs, cls, icon, label) => `<button type="button" class="btn btn-sm ${cls} py-0" ${attrs}><i class="bi ${icon} me-1"></i>${label}</button>`;

        const cards = activeGroups().map(g => {
            const id = escAttr(g.id);
            const badges = [
                `<span class="badge bg-light text-dark border">${g.weight}%</span>`,
                g.isExam ? '<span class="badge bg-secondary"><i class="bi bi-lock-fill me-1"></i>Exam · fixed columns</span>' : '',
                g.hasAttendance ? '<span class="badge bg-primary-subtle text-primary border border-primary-subtle"><i class="bi bi-calendar-check me-1"></i>Attendance</span>' : ''
            ].join(' ');

            const rows = g.items.map(it => `
                <tr>
                    <td class="fw-bold">${escAttr(it.code)}</td>
                    <td>${escAttr(it.title)}</td>
                    <td class="text-center">${it.maxScore}</td>
                    <td class="text-end text-nowrap">${g.isExam
                        ? '<span class="text-muted small"><i class="bi bi-lock"></i> Fixed</span>'
                        : btn(`data-col-edit="${id}|${escAttr(it.code)}"`, 'btn-outline-secondary', 'bi-pencil', 'Edit') + ' '
                          + btn(`data-col-remove="${id}|${escAttr(it.code)}"`, 'btn-outline-danger', 'bi-trash', 'Remove')}
                    </td>
                </tr>`).join('');
            const columns = g.items.length
                ? `<table class="table table-sm small mb-2"><thead><tr class="text-muted"><th style="width:18%">Code</th><th>Title</th><th class="text-center" style="width:12%">Max</th><th style="width:30%"></th></tr></thead><tbody>${rows}</tbody></table>`
                : '<div class="text-muted small mb-2">No assessment columns yet.</div>';

            let attendance = '';
            if (g.hasAttendance) {
                attendance = `
                    <div class="border-top pt-2 mt-1">
                        <div class="small fw-semibold text-secondary mb-1"><i class="bi bi-calendar-check me-1"></i>Attendance dates (${g.attendanceDates.length})</div>
                        <div class="d-flex flex-wrap gap-1 mb-2">${g.attendanceDates.length ? g.attendanceDates.map(d => `
                            <span class="badge bg-white text-dark border d-inline-flex align-items-center gap-1 py-1">${escAttr(d)}
                                <button type="button" class="btn-close" style="font-size: 8px;" aria-label="Remove ${escAttr(d)}" title="Remove ${escAttr(d)}" data-date-remove="${escAttr(d)}"></button>
                            </span>`).join('') : '<span class="text-muted small">No dates yet.</span>'}
                        </div>
                        ${btn('data-date-add="1"', 'btn-outline-primary', 'bi-calendar-plus', 'Add attendance date')}
                    </div>`;
            }

            return `
                <div class="border rounded p-2 mb-2 text-start${g.hasAttendance ? ' border-primary-subtle' : ''}">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-2">
                        <span class="fw-bold small text-uppercase">${escAttr(g.title)}</span>
                        <span>${badges}</span>
                    </div>
                    ${columns}
                    ${!g.isExam ? btn(`data-col-add="${id}"`, 'btn-outline-success', 'bi-plus-square', 'Add column') : ''}
                    ${attendance}
                </div>`;
        }).join('');

        const summary = attGroup
            ? `<i class="bi bi-calendar-check me-1"></i>Attendance counts toward <strong>${escAttr(attGroup.title)}</strong>.`
            : '<i class="bi bi-exclamation-circle me-1"></i>No component records attendance. To add attendance dates, tick "Attendance" on one component in Customize Scheme.';

        Swal.fire(Object.assign({
            title: 'Manage Columns',
            width: 760,
            html: `
                ${notice ? `<div class="alert alert-success py-2 small text-start mb-2"><i class="bi bi-check-circle me-1"></i>${escAttr(notice)}</div>` : ''}
                <div class="small text-start mb-2 ${attGroup ? 'text-muted' : 'text-warning-emphasis'}">${summary}
                    Weights and components are changed in Customize Scheme.</div>
                <div style="max-height: 58vh; overflow-y: auto;">${cards}</div>`,
            showConfirmButton: false,
            showCloseButton: true,
            didOpen: popup => {
                const on = (sel, fn) => popup.querySelectorAll(sel).forEach(el => el.addEventListener('click', e => {
                    e.preventDefault();
                    Swal.close();
                    setTimeout(() => fn(el), 150);
                }));
                on('[data-col-add]', el => addItemColumn(el.dataset.colAdd));
                on('[data-col-edit]', el => editItemColumn(...el.dataset.colEdit.split('|')));
                on('[data-col-remove]', el => removeItemColumn(...el.dataset.colRemove.split('|')));
                on('[data-date-add]', () => addAttendanceDate());
                on('[data-date-remove]', el => removeAttendanceDate(el.dataset.dateRemove));
            }
        }, swalTheme));
    }

    function toggleAttendance(sId, date, elem) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        // Cycle: not recorded -> Present -> Absent -> Excused -> Late -> Present
        const cur = elem.innerText.trim();
        const nextSt = { P: 'A', A: 'E', E: 'L', L: 'P' }[cur] || 'P';
        elem.innerText = nextSt;
        elem.className = attendanceBadgeClass(nextSt);
        elem.title = attendanceLabel(nextSt);
        if (!classScores[activeClass.id][sId]) classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
        classScores[activeClass.id][sId].attendance[date] = nextSt;
        recalculateRow(sId);
        sendMatrix('attendance', { student_number: sId, date: (activeClass.date_map || {})[date], status: nextSt }, { quiet: true, rerender: false });
    }

    function updateRawScore(sId, code, maxScore, val) {
        if (!canEditActive()) { readOnlyNotice(); return; }
        if (!classScores[activeClass.id][sId]) classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
        classScores[activeClass.id][sId].rawScores[code] = parseFloat(val) || 0;
        recalculateRow(sId);
        pendingScores[sId + '|' + code] = { student_number: sId, item_code: code, score: val === '' ? null : parseFloat(val) };
        clearTimeout(scoreTimer);
        scoreTimer = setTimeout(flushScores, 800);
    }

    function flushScores() {
        const batch = Object.values(pendingScores);
        pendingScores = {};
        if (!batch.length) return Promise.resolve(null);
        return sendMatrix('scores', { scores: batch }, { quiet: true, rerender: false });
    }
    function recalculateRow(sId) {
        const scheme = classSchemes[activeClass.id];
        let overallFinalGrade = 0;

        scheme.groups.forEach(grp => {
            let groupComponentsTotalTrans = 0;
            let componentCount = 0;

            grp.items.forEach(it => {
                const curVal = classScores[activeClass.id]?.[sId]?.rawScores[it.code] || 0;
                let trans = computeTransmutation(curVal, it.maxScore);
                const el = document.getElementById(`trans_${sId}_${it.code}`);
                if (el) el.innerText = trans.toFixed(2);
                groupComponentsTotalTrans += trans;
                componentCount++;
            });

            if (grp.hasAttendance) {
                const att = attendanceSummary(sId, grp.attendanceDates);
                const cEl = document.getElementById(`att_count_${sId}_${grp.id}`);
                const tEl = document.getElementById(`att_trans_${sId}_${grp.id}`);
                if (cEl) cEl.innerText = daysCreditedText(att);
                if (tEl) tEl.innerText = att.trans === null ? '—' : att.trans.toFixed(2);
                if (att.trans !== null) {
                    groupComponentsTotalTrans += att.trans;
                    componentCount++;
                }
            }

            let avgTrans = componentCount > 0 ? (groupComponentsTotalTrans / componentCount) : 5.00;
            let share = avgTrans * (grp.weight / 100);
            overallFinalGrade += share;

            const totEl = document.getElementById(`grp_total_${sId}_${grp.id}`);
            if (totEl) totEl.innerText = share.toFixed(2);
        });

        const finEl = document.getElementById(`final_grade_${sId}`);
        const remEl = document.getElementById(`remarks_${sId}`);
        const isPassed = overallFinalGrade <= scheme.passingCutoff;

        if (finEl) finEl.innerText = overallFinalGrade.toFixed(2);
        if (remEl) remEl.innerHTML = `<span class="badge ${isPassed ? 'bg-success' : 'bg-danger'}">${isPassed ? 'PASSED' : 'FAILED'}</span>`;

        const r = document.getElementById(`row_${sId}`);
        if (r) {
            r.dataset.finalGrade = overallFinalGrade.toFixed(2);
            r.dataset.status = isPassed ? 'passed' : 'failed';
        }
    }

    function saveClassGrades() {
        if (!canEditActive()) { readOnlyNotice(); return; }
        clearTimeout(scoreTimer);
        const pending = Object.keys(pendingScores).length > 0;
        (pending ? flushScores() : Promise.resolve({ status: 'success' })).then(data => {
            if (data && data.status === 'success') {
                Swal.fire({ icon: 'success', text: 'All scores for ' + activeClass.course_code + ' (' + activeClass.section + ') are saved. Post final grades from Faculty Workspace when ready.', confirmButtonColor: '#58111a' });
            }
        });
    }

    let matrixStatusFilter = 'all';

    document.querySelectorAll('.filter-status-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter-status-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            matrixStatusFilter = this.dataset.filter;
            document.querySelectorAll('#matrixTableBody tr').forEach(row => {
                if (matrixStatusFilter === 'all' || row.dataset.status === matrixStatusFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('customizeSchemeModal').addEventListener('show.bs.modal', function () {
            if (!activeClass) return;
            document.getElementById('cfgCourseTitle').value = activeClass.course_code + ' - ' + activeClass.course_title;
            document.getElementById('cfgYearSection').value = activeClass.section;
            document.getElementById('cfgPresetSelector').value = '';
            document.getElementById('cfgPassingCutoff').value = Number(classSchemes[activeClass.id].passingCutoff).toFixed(2);
            workingScheme = JSON.parse(JSON.stringify(classSchemes[activeClass.id]));
            renderSchemeBuilder();
        });
        window.addEventListener('beforeunload', flushScores);
        initStores();
        renderClassesGrid();

        <?php if (!empty($selectedClassId)): ?>
            openClassMatrix("<?= htmlspecialchars($selectedClassId) ?>");
        <?php endif; ?>
    });
</script>
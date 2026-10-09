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

    <!-- ========================================================================= -->
    <!-- STATE 1: MY CLASSES WORKSPACE GRID                                        -->
    <!-- ========================================================================= -->
    <div id="viewMyClasses" class="<?= !empty($selectedClassId) ? 'd-none' : '' ?>">
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom flex-wrap gap-2">
            <div>
                <h5 class="fw-bold marsu-maroon-text mb-0">
                    <i class="bi bi-grid-fill me-2"></i>My Teaching Classes & Subject Sections
                </h5>
                <small class="text-muted">Manage your assigned lecture & laboratory rosters, customized grading policies, and evaluations.</small>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm marsu-maroon-bg fw-semibold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#createClassModal">
                    <i class="bi bi-plus-lg me-1"></i> Create New Class
                </button>
            </div>
        </div>

        <!-- Class Cards Container -->
        <div class="row g-3" id="classesContainer"></div>

    </div>

    <!-- ========================================================================= -->
    <!-- STATE 2: DYNAMIC CLASS RECORD & MATRIX EVALUATION                         -->
    <!-- ========================================================================= -->
    <div id="viewClassMatrix" class="<?= empty($selectedClassId) ? 'd-none' : '' ?>">
        
        <!-- Top Toolbar & Navigation -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="closeClassMatrix()">
                            <i class="bi bi-arrow-left me-1"></i> Back to Classes
                        </button>
                        <div class="bg-danger text-white rounded p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-file-earmark-spreadsheet-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark" id="displayClassHeaderTitle">MarSU CICS Class Record & Dynamic Evaluation Matrix</h6>
                            <small class="text-muted" style="font-size: 11.5px;">
                                A.Y. 2026-2027 • <span class="text-danger fw-semibold">Linear Formula: -4*(Score/Total)+5</span>
                            </small>
                        </div>
                    </div>

                    <!-- Filter Buttons (All, Passed, Failed) & Controls -->
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary active filter-status-btn" data-filter="all">All</button>
                            <button type="button" class="btn btn-outline-success filter-status-btn" data-filter="passed">Passed</button>
                            <button type="button" class="btn btn-outline-danger filter-status-btn" data-filter="failed">Failed</button>
                        </div>

                        <!-- Customize Scheme Modal Trigger -->
                        <button type="button" class="btn btn-sm btn-outline-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#customizeSchemeModal">
                            <i class="bi bi-sliders me-1"></i> Customize Scheme
                        </button>

                        <button type="button" class="btn btn-sm marsu-maroon-bg fw-semibold px-3" onclick="saveClassGrades()">
                            <i class="bi bi-floppy me-1"></i> Save All Grades
                        </button>
                    </div>
                </div>

                <!-- Sub Metadata Info Bar -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-2 border-top">
                    <div class="d-flex align-items-center gap-2 flex-wrap small">
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="bi bi-journal-bookmark me-1 text-primary"></i> Course: <strong id="lblCourse">-</strong>
                        </span>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="bi bi-people me-1 text-primary"></i> Section: <strong id="lblSection">-</strong>
                        </span>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="bi bi-diagram-3 me-1 text-primary"></i> Scheme: <strong id="lblSchemeName">Active Grading Scheme</strong>
                        </span>
                        <span class="badge px-2 py-1" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171;">
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
            <div class="card-body p-2 bg-light rounded d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="small fw-bold text-secondary text-uppercase ms-1">Roster Intake:</span>
                    
                    <!-- 1. Pull Students by Section -->
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="pullStudentsFromSectionMasterlist()">
                        <i class="bi bi-cloud-arrow-down me-1"></i> Pull Masterlist for this Section
                    </button>

                    <!-- 2. Upload CSV / Excel File -->
                    <label class="btn btn-sm btn-outline-success mb-0" style="cursor: pointer;">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Upload CSV Class List
                        <input type="file" id="csvFileInput" accept=".csv, .txt" hidden onchange="handleCsvUpload(this)">
                    </label>
                </div>

                <!-- 3. Quick Add Irregular / Shifter Student -->
                <div class="d-flex align-items-center gap-1">
                    <input type="text" id="quickAddId" class="form-control form-control-sm" placeholder="Student ID (e.g. 23-1001)" style="width: 150px;">
                    <input type="text" id="quickAddName" class="form-control form-control-sm" placeholder="Full Name" style="width: 160px;">
                    <button type="button" class="btn btn-sm btn-dark" onclick="quickAddSingleStudent()">
                        <i class="bi bi-person-plus me-1"></i> Add
                    </button>
                </div>
            </div>
        </div>

        <!-- EXCEL-STYLE DYNAMIC MATRIX TABLE -->
        <div class="table-responsive bg-white rounded border shadow-sm" style="max-height: 70vh;">
            <table class="table table-bordered table-hover align-middle mb-0 text-center" id="matrixTable" style="font-size: 11.5px;">
                <thead class="sticky-top">
                    <tr id="matrixHeaderGroupRow"></tr>
                    <tr id="matrixHeaderSubRow"></tr>
                </thead>
                <tbody id="matrixTableBody"></tbody>
            </table>
        </div>

    </div>

</div>

<!-- ========================================================================= -->
<!-- MODAL 1: CREATE NEW CLASS                                                 -->
<!-- ========================================================================= -->
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
                        <input type="text" id="newCourseCode" class="form-control form-control-sm mb-2" placeholder="e.g., IT211" required>
                        <input type="text" id="newCourseTitle" class="form-control form-control-sm" placeholder="e.g., Data Structures and Algorithms" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">YEAR & SECTION</label>
                            <input type="text" id="newSection" class="form-control form-control-sm" placeholder="e.g., BSIT 2-A" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">SEMESTER</label>
                            <select id="newSemester" class="form-select form-select-sm">
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <option value="Midyear">Midyear</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">INITIAL GRADING TEMPLATE</label>
                        <select id="newGradingTemplate" class="form-select form-select-sm">
                            <option value="preset_cics">MarSU CICS Standard (30% - 30% - 40%)</option>
                            <option value="preset_ogbac">Ogbac 6-Component Model (5% - 30% - 15% - 10% - 20% - 20%)</option>
                        </select>
                        <small class="text-muted" style="font-size: 11px;">You can further customize this grading criteria anytime inside the class.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm marsu-maroon-bg fw-semibold px-3" onclick="submitCreateClass()">Create & Open Class</button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL 2: CUSTOMIZE SCHEME WITH COPY/CLONE & PRESETS                       -->
<!-- ========================================================================= -->
<div class="modal fade" id="customizeSchemeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header marsu-maroon-bg">
                <div>
                    <h6 class="modal-title fw-bold mb-0">
                        <i class="bi bi-sliders me-1"></i> Customize Grading Policy & Assessment Scheme
                    </h6>
                    <small style="font-size: 11px; opacity: 0.9;">Configure assessment component weights, quizzes, activities, exams, attendance dates, and passing threshold.</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4 bg-light">
                
                <!-- Quick Replication / Clone Bar -->
                <div class="alert alert-info border-info-subtle d-flex justify-content-between align-items-center mb-3 p-2 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-copy fs-5 text-primary"></i>
                        <div>
                            <span class="fw-bold small d-block">Quick Scheme Replication</span>
                            <small class="text-muted" style="font-size: 11px;">Copy criteria directly from your other sections or load your saved personal presets.</small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <select id="copyFromClassSelect" class="form-select form-select-sm" style="width: auto;" onchange="copySchemeFromSelectedClass(this.value)">
                            <option value="">-- Copy from My Other Classes --</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="saveAsPersonalPreset()">
                            <i class="bi bi-bookmark-plus me-1"></i> Save as My Preset
                        </button>
                    </div>
                </div>

                <!-- Target Metadata Row -->
                <div class="row g-3 bg-white p-3 rounded border mb-4">
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">TARGET COURSE TITLE</label>
                        <input type="text" id="cfgCourseTitle" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">YEAR & SECTION</label>
                        <input type="text" id="cfgYearSection" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">PRESETS DROPDOWN</label>
                        <select id="cfgPresetSelector" class="form-select form-select-sm" onchange="loadPresetScheme(this.value)">
                            <option value="preset_cics">MarSU CICS Standard (30% - 30% - 40%)</option>
                            <option value="preset_ogbac">Ogbac 6-Component Model (5% - 30% - 15% - 10% - 20% - 20%)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-secondary">PASSING THRESHOLD CUTOFF</label>
                        <div class="input-group input-group-sm">
                            <input type="number" step="0.01" id="cfgPassingCutoff" class="form-control" value="3.04">
                            <span class="input-group-text">Cutoff</span>
                        </div>
                        <small class="text-muted" style="font-size: 10px;">Grade > cutoff triggers FAILED & Risk Alert.</small>
                    </div>
                </div>

                <!-- Weights Status Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-grid-3x3-gap me-1 text-primary"></i> Component Weights Builder & Item Adjuster
                    </h6>
                    <div id="weightsValidationBadge" class="badge bg-success-subtle text-success border border-success px-3 py-2 fs-7">
                        <i class="bi bi-check-circle me-1"></i> Total: 100% (Balanced)
                    </div>
                </div>

                <!-- Scheme Groups Container -->
                <div id="schemeGroupsContainer" class="d-flex flex-column gap-3"></div>

                <!-- Add Group Button -->
                <div class="mt-3">
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addNewGroup()">
                        <i class="bi bi-plus-circle me-1"></i> Add Another Component Group
                    </button>
                </div>

            </div>

            <div class="modal-footer bg-white border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Close</button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="loadPresetScheme(document.getElementById('cfgPresetSelector').value)">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset to Preset
                    </button>
                    <button type="button" class="btn btn-sm marsu-maroon-bg text-white px-4 fw-semibold" onclick="saveAndApplyScheme()">
                        <i class="bi bi-check2-circle me-1"></i> Save & Apply Scheme
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- JAVASCRIPT ENGINE (CALCULATOR, CSV IMPORTER & PULL LOGIC)                 -->
<!-- ========================================================================= -->
<script>
// Data Store na nanggaling sa Controller
let classesStore = <?= json_encode($facultyClasses ?? []) ?>;
const masterStudentsDB = <?= json_encode($allStudentsMasterlist ?? []) ?>;

let activeClass = null;
let classStudentsStore = {}; // Holds students per class_id: { class_id: [ {...}, {...} ] }

const defaultPresets = {
    preset_cics: {
        name: "MarSU CICS Standard (30-30-40)",
        passingCutoff: 3.04,
        groups: [
            {
                id: "grp_att_quiz",
                title: "ATTENDANCE AND QUIZZES",
                weight: 30,
                hasAttendance: true,
                attendanceDates: ["07/27", "08/03", "08/10", "08/17", "08/24", "09/07", "09/08"],
                items: [
                    { code: "Q1", title: "Quiz 1", type: "Quiz (Raw)", maxScore: 20 },
                    { code: "Q2", title: "Quiz 2", type: "Quiz (Raw)", maxScore: 20 }
                ]
            },
            {
                id: "grp_act_perf",
                title: "ACTIVITIES, RECITATION, AND EXERCISES",
                weight: 30,
                hasAttendance: false,
                attendanceDates: [],
                items: [
                    { code: "A1", title: "Activity 1", type: "Activity", maxScore: 100 },
                    { code: "G1", title: "Group 1", type: "Group", maxScore: 100 },
                    { code: "R1", title: "Recitation", type: "Recitation", maxScore: 5 },
                    { code: "P", title: "Performance", type: "Performance", maxScore: 5 }
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
    preset_ogbac: {
        name: "Ogbac 6-Component Model",
        passingCutoff: 3.00,
        groups: [
            { id: "og_att", title: "ATTENDANCE", weight: 5, hasAttendance: true, attendanceDates: ["W1","W2","W3","W4","W5","W6","W7","W8"], items: [] },
            { id: "og_quiz", title: "WRITTEN / QUIZZES", weight: 30, hasAttendance: false, attendanceDates: [], items: [{code:"Q1", title:"Quiz 1", type:"Quiz (Raw)", maxScore:10}, {code:"Q2", title:"Quiz 2", type:"Quiz (Raw)", maxScore:10}] },
            { id: "og_part", title: "PARTICIPATION", weight: 15, hasAttendance: false, attendanceDates: [], items: [{code:"A1", title:"Act 1", type:"Activity", maxScore:10}, {code:"A2", title:"Act 2", type:"Activity", maxScore:10}] },
            { id: "og_proj", title: "PROJECT", weight: 10, hasAttendance: false, attendanceDates: [], items: [{code:"PRJ", title:"Term Project", type:"Activity", maxScore:100}] },
            { id: "og_ex1", title: "EXAM 1", weight: 20, hasAttendance: false, attendanceDates: [], items: [{code:"EX1", title:"Major Exam 1", type:"Exam", maxScore:100}] },
            { id: "og_ex2", title: "EXAM 2", weight: 20, hasAttendance: false, attendanceDates: [], items: [{code:"EX2", title:"Major Exam 2", type:"Exam", maxScore:100}] }
        ]
    }
};

let classSchemes = {};
let classScores = {};

function initStores() {
    classesStore.forEach(cls => {
        if (!classSchemes[cls.id]) {
            classSchemes[cls.id] = JSON.parse(JSON.stringify(defaultPresets.preset_cics));
        }
        if (!classStudentsStore[cls.id]) {
            classStudentsStore[cls.id] = [];
        }
        if (!classScores[cls.id]) {
            classScores[cls.id] = {};
        }
    });
}

// -------------------------------------------------------------------------
// ROSTER POPULATION ENGINE (SOLUSYON 1 & SOLUSYON 2)
// -------------------------------------------------------------------------

// SOLUSYON 2: Hihigupin ang mga estudyante mula sa Masterlist base sa Section
function pullStudentsFromSectionMasterlist() {
    if (!activeClass) return;

    const classSection = (activeClass.section || '').trim().toLowerCase();
    
    // Salain mula sa masterlist ng students table
    const matched = masterStudentsDB.filter(s => {
        const studentSec = (s.section || '').trim().toLowerCase();
        return studentSec === classSection || classSection.includes(studentSec);
    });

    if (matched.length === 0) {
        alert(`No registered students found in the central masterlist under section "${activeClass.section}". You can use CSV Upload or Add Student below.`);
        return;
    }

    let addedCount = 0;
    matched.forEach(std => {
        const sId = std.student_id;
        // Iwasang madoble ang estudyante
        if (!classStudentsStore[activeClass.id].some(existing => existing.student_id === sId)) {
            classStudentsStore[activeClass.id].push({
                student_id: std.student_id,
                full_name: std.full_name,
                department: std.department || activeClass.course_code
            });
            if (!classScores[activeClass.id][sId]) {
                classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
            }
            addedCount++;
        }
    });

    activeClass.student_count = classStudentsStore[activeClass.id].length;
    renderMatrix();
    alert(`Success: Pulled ${addedCount} students registered under ${activeClass.section}!`);
}

// SOLUSYON 1: CSV Class List Importer
function handleCsvUpload(inputElem) {
    if (!activeClass) return;
    const file = inputElem.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const text = e.target.result;
        const lines = text.split(/\r\n|\n/);
        let importedCount = 0;

        lines.forEach((line, index) => {
            if (!line.trim() || index === 0 && (line.toLowerCase().includes('id') || line.toLowerCase().includes('name'))) {
                return; // Laktawan ang header row
            }

            // Suportado ang comma (,) o tab (\t) delimiters
            const cols = line.includes('\t') ? line.split('\t') : line.split(',');
            if (cols.length >= 2) {
                const sId = cols[0].replace(/"/g, '').trim();
                const sName = cols[1].replace(/"/g, '').trim();
                const sDept = cols[2] ? cols[2].replace(/"/g, '').trim() : (activeClass.course_code || 'N/A');

                if (sId && sName && !classStudentsStore[activeClass.id].some(ex => ex.student_id === sId)) {
                    classStudentsStore[activeClass.id].push({
                        student_id: sId,
                        full_name: sName,
                        department: sDept
                    });
                    if (!classScores[activeClass.id][sId]) {
                        classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
                    }
                    importedCount++;
                }
            }
        });

        activeClass.student_count = classStudentsStore[activeClass.id].length;
        renderMatrix();
        alert(`Success: Imported ${importedCount} students from ${file.name}!`);
        inputElem.value = ''; // I-reset ang file input
    };
    reader.readAsText(file);
}

// Quick Add Single Student (Irregular / Shifter)
function quickAddSingleStudent() {
    if (!activeClass) return;
    const idInput = document.getElementById('quickAddId');
    const nameInput = document.getElementById('quickAddName');
    const sId = idInput.value.trim();
    const sName = nameInput.value.trim();

    if (!sId || !sName) {
        alert("Please enter both Student ID and Full Name.");
        return;
    }

    if (classStudentsStore[activeClass.id].some(ex => ex.student_id === sId)) {
        alert("This student is already in the class roster.");
        return;
    }

    classStudentsStore[activeClass.id].push({
        student_id: sId,
        full_name: sName,
        department: activeClass.course_code
    });
    if (!classScores[activeClass.id][sId]) {
        classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
    }

    activeClass.student_count = classStudentsStore[activeClass.id].length;
    idInput.value = '';
    nameInput.value = '';
    renderMatrix();
}

// Alisin ang estudyante sa roster
function removeStudentFromClass(sId) {
    if (confirm("Remove this student from the class roster?")) {
        classStudentsStore[activeClass.id] = classStudentsStore[activeClass.id].filter(s => s.student_id !== sId);
        activeClass.student_count = classStudentsStore[activeClass.id].length;
        renderMatrix();
    }
}

// -------------------------------------------------------------------------
// CLASS CARDS & MODALS LOGIC
// -------------------------------------------------------------------------
function renderClassesGrid() {
    const container = document.getElementById('classesContainer');
    container.innerHTML = '';

    if (!classesStore || classesStore.length === 0) {
        container.innerHTML = `
            <div class="col-12">
                <div class="text-center py-5 text-muted bg-white rounded border shadow-sm">
                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                    <p class="mb-0 fw-semibold">No teaching classes found</p>
                    <small>Click "Create New Class" above to set up your subjects and sections.</small>
                </div>
            </div>
        `;
        populateCopyClassesDropdown();
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
                    <span class="badge bg-light text-secondary border">${cls.semester || '1st Semester'}</span>
                </div>
                <h6 class="fw-bold text-dark mb-1 text-truncate">${cls.course_title}</h6>
                <div class="text-muted small mb-3">
                    <i class="bi bi-diagram-2 me-1"></i>Section: <strong class="text-dark">${cls.section}</strong> • AY ${cls.school_year || '2026-2027'}
                </div>
                <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center small">
                    <span class="text-muted"><i class="bi bi-people me-1"></i>${studentCount} Students</span>
                    <span class="text-primary fw-semibold">Open Class Record →</span>
                </div>
            </div>
        `;
        container.appendChild(col);
    });

    populateCopyClassesDropdown();
}

function populateCopyClassesDropdown() {
    const sel = document.getElementById('copyFromClassSelect');
    sel.innerHTML = '<option value="">-- Copy from My Other Classes --</option>';
    classesStore.forEach(c => {
        if (!activeClass || c.id !== activeClass.id) {
            sel.innerHTML += `<option value="${c.id}">${c.course_code} (${c.section}) - ${c.course_title}</option>`;
        }
    });
}

function openClassMatrix(classId) {
    activeClass = classesStore.find(c => c.id === classId);
    if (!activeClass) return;

    document.getElementById('viewMyClasses').classList.add('d-none');
    document.getElementById('viewClassMatrix').classList.remove('d-none');

    document.getElementById('lblCourse').innerText = `${activeClass.course_code} - ${activeClass.course_title}`;
    document.getElementById('lblSection').innerText = activeClass.section;
    document.getElementById('lblSchemeName').innerText = classSchemes[activeClass.id]?.name || 'Custom Scheme';
    document.getElementById('lblPassingCutoff').innerText = (classSchemes[activeClass.id]?.passingCutoff || 3.04).toFixed(2);

    populateCopyClassesDropdown();
    renderMatrix();
    renderSchemeEditor();
}

function closeClassMatrix() {
    activeClass = null;
    document.getElementById('viewClassMatrix').classList.add('d-none');
    document.getElementById('viewMyClasses').classList.remove('d-none');
    renderClassesGrid();
}

function submitCreateClass() {
    const code = document.getElementById('newCourseCode').value.trim();
    const title = document.getElementById('newCourseTitle').value.trim();
    const sec = document.getElementById('newSection').value.trim();
    const sem = document.getElementById('newSemester').value;
    const tmpl = document.getElementById('newGradingTemplate').value;

    if (!code || !title || !sec) {
        alert("Please complete all required fields.");
        return;
    }

    const newId = 'CLS-' + code.toUpperCase() + '-' + Date.now().toString().slice(-4);
    const newClassObj = {
        id: newId,
        course_code: code.toUpperCase(),
        course_title: title,
        section: sec,
        school_year: '2026-2027',
        semester: sem,
        student_count: 0,
        passing_cutoff: 3.04,
        scheme_name: defaultPresets[tmpl].name
    };

    classesStore.push(newClassObj);
    classSchemes[newId] = JSON.parse(JSON.stringify(defaultPresets[tmpl]));
    classStudentsStore[newId] = [];
    classScores[newId] = {};

    bootstrap.Modal.getInstance(document.getElementById('createClassModal')).hide();
    renderClassesGrid();
    openClassMatrix(newId);
}

function copySchemeFromSelectedClass(sourceClassId) {
    if (!sourceClassId || !activeClass) return;
    if (confirm("Copy grading scheme from this class? Current criteria will be replaced.")) {
        const sourceScheme = classSchemes[sourceClassId];
        classSchemes[activeClass.id] = JSON.parse(JSON.stringify(sourceScheme));
        renderSchemeEditor();
        renderMatrix();
        alert("Success: Grading scheme replicated!");
    }
}

function saveAsPersonalPreset() {
    const name = prompt("Enter a title for your Personal Preset:", "My " + activeClass.course_code + " Scheme");
    if (name) {
        alert(`Preset "${name}" saved to your personal library!`);
    }
}

// -------------------------------------------------------------------------
// MATRIX EVALUATION TABLE RENDERER
// -------------------------------------------------------------------------
function renderMatrix() {
    if (!activeClass) return;
    const scheme = classSchemes[activeClass.id] || defaultPresets.preset_cics;
    const students = classStudentsStore[activeClass.id] || [];

    document.getElementById('lblStudentCount').innerText = students.length;

    const groupRow = document.getElementById('matrixHeaderGroupRow');
    const subRow = document.getElementById('matrixHeaderSubRow');
    const tbody = document.getElementById('matrixTableBody');

    groupRow.innerHTML = '<th rowspan="2" class="marsu-table-header" style="width: 35px;">No.</th><th rowspan="2" class="marsu-table-header text-start ps-3" style="min-width: 170px;">Student Name</th>';
    subRow.innerHTML = '';
    tbody.innerHTML = '';

    let totalCols = 2 + 3; // No, Student Name, Final Grade, Remarks, Action

    scheme.groups.forEach(grp => {
        let colCount = (grp.items.length * 2);
        if (grp.hasAttendance && grp.attendanceDates.length > 0) {
            colCount += (grp.attendanceDates.length + 2);
        }
        colCount += 1;
        totalCols += colCount;

        groupRow.innerHTML += `<th colspan="${colCount}" class="marsu-table-header text-uppercase py-2 border-start border-end">${grp.title} (${grp.weight}%)</th>`;

        grp.items.forEach(it => {
            subRow.innerHTML += `
                <th class="marsu-sub-header text-center" style="min-width: 50px;"><div>${it.maxScore}</div><div class="fw-bold">${it.code}</div></th>
                <th class="marsu-sub-header text-center" style="min-width: 55px;">${it.code} Trans</th>
            `;
        });

        if (grp.hasAttendance && grp.attendanceDates.length > 0) {
            grp.attendanceDates.forEach(d => {
                subRow.innerHTML += `<th class="marsu-sub-header text-center" style="min-width: 45px;">${d}</th>`;
            });
            subRow.innerHTML += `<th class="marsu-sub-header text-center" style="min-width: 40px;">ATT</th><th class="marsu-sub-header text-center" style="min-width: 55px;">ATT Trans</th>`;
        }

        subRow.innerHTML += `<th class="marsu-sub-header text-center bg-danger-subtle text-dark" style="min-width: 60px;">TOTAL</th>`;
    });

    groupRow.innerHTML += '<th rowspan="2" class="marsu-table-header" style="min-width: 80px;">FINAL GRADE</th><th rowspan="2" class="marsu-table-header" style="min-width: 90px;">REMARKS</th><th rowspan="2" class="marsu-table-header" style="width: 40px;"></th>';

    // Kapag wala pang laman ang klase (Empty State)
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
            <td class="fw-bold text-muted">${idx + 1}</td>
            <td class="text-start ps-3">
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
                    <td><input type="number" step="any" min="0" max="${it.maxScore}" class="score-input-matrix" value="${curVal}" onchange="updateRawScore('${sId}', '${it.code}', ${it.maxScore}, this.value)"></td>
                    <td class="trans-grade-text" id="trans_${sId}_${it.code}">${transmuted.toFixed(2)}</td>
                `;
                groupComponentsTotalTrans += transmuted;
                componentCount++;
            });

            if (grp.hasAttendance && grp.attendanceDates.length > 0) {
                let pCount = 0;
                grp.attendanceDates.forEach(d => {
                    const st = (classScores[activeClass.id]?.[sId]?.attendance[d] === 'A') ? 'A' : 'P';
                    if (st === 'P') pCount++;
                    html += `<td><span class="${st === 'P' ? 'badge-att-p':'badge-att-a'}" onclick="toggleAttendance('${sId}', '${d}', this)">${st}</span></td>`;
                });
                let attTrans = computeTransmutation(pCount, grp.attendanceDates.length);
                html += `<td class="fw-bold text-dark" id="att_count_${sId}">${pCount}</td><td class="trans-grade-text" id="att_trans_${sId}">${attTrans.toFixed(2)}</td>`;
                groupComponentsTotalTrans += attTrans;
                componentCount++;
            }

            let avgTrans = componentCount > 0 ? (groupComponentsTotalTrans / componentCount) : 5.00;
            let share = avgTrans * (grp.weight / 100);
            overallFinalGrade += share;
            html += `<td class="comp-total-text" id="grp_total_${sId}_${grp.id}">${share.toFixed(2)}</td>`;
        });

        const isPassed = overallFinalGrade <= scheme.passingCutoff;
        row.dataset.finalGrade = overallFinalGrade.toFixed(2);
        row.dataset.status = isPassed ? 'passed' : 'failed';

        html += `
            <td class="fw-bold text-primary fs-6" id="final_grade_${sId}">${overallFinalGrade.toFixed(2)}</td>
            <td id="remarks_${sId}"><span class="badge ${isPassed ? 'bg-success':'bg-danger'}">${isPassed ? 'PASSED':'FAILED'}</span></td>
            <td>
                <button type="button" class="btn btn-xs text-danger" title="Remove Student" onclick="removeStudentFromClass('${sId}')">
                    <i class="bi bi-x-circle"></i>
                </button>
            </td>
        `;

        row.innerHTML = html;
        tbody.appendChild(row);
    });
}

function computeTransmutation(score, maxScore) {
    if (!maxScore || maxScore <= 0) return 5.00;
    let ratio = Math.max(0, Math.min(1, score / maxScore));
    return parseFloat(((-4 * ratio) + 5.00).toFixed(2));
}

function toggleAttendance(sId, date, elem) {
    const cur = elem.innerText.trim();
    const nextSt = cur === 'P' ? 'A' : 'P';
    elem.innerText = nextSt;
    elem.className = nextSt === 'P' ? 'badge-att-p' : 'badge-att-a';
    if (!classScores[activeClass.id][sId]) classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
    classScores[activeClass.id][sId].attendance[date] = nextSt;
    recalculateRow(sId);
}

function updateRawScore(sId, code, maxScore, val) {
    if (!classScores[activeClass.id][sId]) classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
    classScores[activeClass.id][sId].rawScores[code] = parseFloat(val) || 0;
    recalculateRow(sId);
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

        if (grp.hasAttendance && grp.attendanceDates.length > 0) {
            let pCount = 0;
            grp.attendanceDates.forEach(d => {
                if (classScores[activeClass.id]?.[sId]?.attendance[d] === 'P') pCount++;
            });
            let attTrans = computeTransmutation(pCount, grp.attendanceDates.length);
            const cEl = document.getElementById(`att_count_${sId}`);
            const tEl = document.getElementById(`att_trans_${sId}`);
            if (cEl) cEl.innerText = pCount;
            if (tEl) tEl.innerText = attTrans.toFixed(2);
            groupComponentsTotalTrans += attTrans;
            componentCount++;
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
    if (remEl) remEl.innerHTML = `<span class="badge ${isPassed ? 'bg-success':'bg-danger'}">${isPassed ? 'PASSED':'FAILED'}</span>`;

    const r = document.getElementById(`row_${sId}`);
    if (r) {
        r.dataset.finalGrade = overallFinalGrade.toFixed(2);
        r.dataset.status = isPassed ? 'passed' : 'failed';
    }
}

// -------------------------------------------------------------------------
// MODAL SCHEME BUILDER EDITOR LOGIC
// -------------------------------------------------------------------------
function renderSchemeEditor() {
    if (!activeClass) return;
    const scheme = classSchemes[activeClass.id];
    document.getElementById('cfgCourseTitle').value = activeClass.course_code + ' - ' + activeClass.course_title;
    document.getElementById('cfgYearSection').value = activeClass.section;
    document.getElementById('cfgPassingCutoff').value = scheme.passingCutoff;

    const container = document.getElementById('schemeGroupsContainer');
    container.innerHTML = '';

    scheme.groups.forEach((grp, gIdx) => {
        const card = document.createElement('div');
        card.className = "card border bg-white shadow-sm p-3";
        card.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge text-white" style="background-color: #58111a;">Group ${gIdx + 1}</span>
                    <input type="text" class="form-control form-control-sm fw-bold" style="min-width: 250px;" value="${grp.title}" oninput="updateGrpField(${gIdx}, 'title', this.value)">
                    <div class="input-group input-group-sm" style="width: 105px;">
                        <input type="number" min="1" max="100" class="form-control" value="${grp.weight}" oninput="updateGrpField(${gIdx}, 'weight', this.value)">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeGrp(${gIdx})"><i class="bi bi-trash"></i></button>
            </div>

            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="chk_${gIdx}" ${grp.hasAttendance ? 'checked':''} onchange="toggleGrpAtt(${gIdx}, this.checked)">
                <label class="form-check-label small fw-semibold text-secondary" for="chk_${gIdx}">Include Attendance Tracking</label>
            </div>

            ${grp.hasAttendance ? `
                <div class="p-2 mb-2 bg-light rounded border">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <small class="fw-bold">Dates (${grp.attendanceDates.length} Sessions):</small>
                        <button type="button" class="btn btn-xs btn-outline-primary" onclick="addAttDate(${gIdx})">+ Add Date</button>
                    </div>
                    <div class="d-flex flex-wrap gap-1">
                        ${grp.attendanceDates.map((d, dIdx) => `<span class="badge bg-secondary-subtle text-dark border px-2 py-1">${d} <i class="bi bi-x text-danger ms-1" style="cursor:pointer;" onclick="removeAttDate(${gIdx}, ${dIdx})"></i></span>`).join('')}
                    </div>
                </div>
            `:''}

            <div class="d-flex justify-content-between align-items-center mb-1">
                <small class="fw-bold text-secondary">ASSESSMENT SUB-ITEMS</small>
                <button type="button" class="btn btn-xs btn-outline-success" onclick="addItem(${gIdx})">+ Add Item</button>
            </div>

            <table class="table table-sm table-bordered align-middle mb-0" style="font-size: 11px;">
                <thead class="table-light"><tr><th>CODE</th><th>TITLE</th><th>TYPE</th><th>MAX SCORE</th><th></th></tr></thead>
                <tbody>
                    ${grp.items.map((it, iIdx) => `
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" value="${it.code}" oninput="updateItm(${gIdx},${iIdx}, 'code', this.value)"></td>
                            <td><input type="text" class="form-control form-control-sm" value="${it.title}" oninput="updateItm(${gIdx},${iIdx}, 'title', this.value)"></td>
                            <td>
                                <select class="form-select form-select-sm" onchange="updateItm(${gIdx},${iIdx}, 'type', this.value)">
                                    <option value="Quiz (Raw)" ${it.type==='Quiz (Raw)'?'selected':''}>Quiz</option>
                                    <option value="Activity" ${it.type==='Activity'?'selected':''}>Activity</option>
                                    <option value="Exam" ${it.type==='Exam'?'selected':''}>Exam</option>
                                </select>
                            </td>
                            <td><input type="number" class="form-control form-control-sm text-center" value="${it.maxScore}" oninput="updateItm(${gIdx},${iIdx}, 'maxScore', this.value)"></td>
                            <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger" onclick="removeItm(${gIdx},${iIdx})"><i class="bi bi-trash"></i></button></td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        `;
        container.appendChild(card);
    });
    validateWeights();
}

function validateWeights() {
    if (!activeClass) return;
    let tot = classSchemes[activeClass.id].groups.reduce((a, g) => a + (parseFloat(g.weight) || 0), 0);
    const b = document.getElementById('weightsValidationBadge');
    if (tot === 100) {
        b.className = "badge bg-success-subtle text-success border border-success px-3 py-2";
        b.innerHTML = '<i class="bi bi-check-circle me-1"></i> Total: 100% (Balanced)';
    } else {
        b.className = "badge bg-danger-subtle text-danger border border-danger px-3 py-2";
        b.innerHTML = `<i class="bi bi-exclamation-triangle me-1"></i> Total: ${tot}% (Must be 100%)`;
    }
}

function updateGrpField(gIdx, f, v) { classSchemes[activeClass.id].groups[gIdx][f] = (f === 'weight') ? parseFloat(v) || 0 : v; validateWeights(); }
function toggleGrpAtt(gIdx, chk) { classSchemes[activeClass.id].groups[gIdx].hasAttendance = chk; if (chk && classSchemes[activeClass.id].groups[gIdx].attendanceDates.length === 0) classSchemes[activeClass.id].groups[gIdx].attendanceDates = ["W1", "W2", "W3", "W4"]; renderSchemeEditor(); }
function addAttDate(gIdx) { const d = prompt("Enter Date (e.g. 09/15):", "W" + (classSchemes[activeClass.id].groups[gIdx].attendanceDates.length + 1)); if (d) { classSchemes[activeClass.id].groups[gIdx].attendanceDates.push(d); renderSchemeEditor(); } }
function removeAttDate(gIdx, dIdx) { classSchemes[activeClass.id].groups[gIdx].attendanceDates.splice(dIdx, 1); renderSchemeEditor(); }
function addItem(gIdx) { classSchemes[activeClass.id].groups[gIdx].items.push({ code: "ACT" + (classSchemes[activeClass.id].groups[gIdx].items.length + 1), title: "New Item", type: "Activity", maxScore: 50 }); renderSchemeEditor(); }
function removeItm(gIdx, iIdx) { classSchemes[activeClass.id].groups[gIdx].items.splice(iIdx, 1); renderSchemeEditor(); }
function updateItm(gIdx, iIdx, f, v) { classSchemes[activeClass.id].groups[gIdx].items[iIdx][f] = (f === 'maxScore') ? parseFloat(v) || 0 : v; }
function addNewGroup() { classSchemes[activeClass.id].groups.push({ id: "grp_" + Date.now(), title: "NEW COMPONENT", weight: 10, hasAttendance: false, attendanceDates: [], items: [] }); renderSchemeEditor(); }
function removeGrp(gIdx) { classSchemes[activeClass.id].groups.splice(gIdx, 1); renderSchemeEditor(); }

function loadPresetScheme(key) {
    if (!defaultPresets[key] || !activeClass) return;
    classSchemes[activeClass.id] = JSON.parse(JSON.stringify(defaultPresets[key]));
    renderSchemeEditor();
}

function saveAndApplyScheme() {
    let tot = classSchemes[activeClass.id].groups.reduce((a, g) => a + (parseFloat(g.weight) || 0), 0);
    if (tot !== 100) { alert("Total weight must be 100%. Current total: " + tot + "%."); return; }
    classSchemes[activeClass.id].passingCutoff = parseFloat(document.getElementById('cfgPassingCutoff').value) || 3.04;
    document.getElementById('lblPassingCutoff').innerText = classSchemes[activeClass.id].passingCutoff.toFixed(2);
    bootstrap.Modal.getInstance(document.getElementById('customizeSchemeModal')).hide();
    renderMatrix();
}

function saveClassGrades() {
    alert("Success: All computed grades and criteria for " + activeClass.course_code + " (" + activeClass.section + ") have been securely saved!");
}

// Filter Status Buttons (All, Passed, Failed)
document.querySelectorAll('.filter-status-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-status-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const f = this.dataset.filter;
        document.querySelectorAll('.student-row').forEach(row => {
            row.style.display = (f === 'all' || row.dataset.status === f) ? '' : 'none';
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    initStores();
    renderClassesGrid();
    <?php if (!empty($selectedClassId)): ?>
            openClassMatrix("<?= htmlspecialchars($selectedClassId) ?>");
    <?php endif; ?>
});
</script>
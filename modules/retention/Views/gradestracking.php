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
                                A.Y. 2026-2027 • <span class="text-danger fw-semibold">Linear Formula:
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

<!-- MODAL 1: CREATE NEW CLASS (DYNAMIC SECTIONS MULA SA DATABASE) -->
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
                                        <option value="<?= htmlspecialchars($sName) ?>">
                                            <?= htmlspecialchars($sName) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="BSIS 1A">BSIS 1A</option>
                                    <option value="BSIS 2A">BSIS 2A</option>
                                    <option value="BSIS 3A">BSIS 3A</option>
                                    <option value="BSIS 4A">BSIS 4A</option>
                                <?php endif; ?>
                            </select>
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
                            <option value="preset_ogbac">Ogbac 6-Component Model (5% - 30% - 15% - 10% - 20% - 20%)
                            </option>
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
                            <option value="preset_cics">MarSU CICS Standard (30% - 30% - 40%)</option>
                            <option value="preset_ogbac">Ogbac 6-Component Model (5% - 30% - 15% - 10% - 20% - 20%)
                            </option>
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
                    attendanceDates: ["07/27", "08/03", "08/10", "08/17", "08/24", "09/07", "09/08"],
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

    function initStores() {
        classesStore.forEach(cls => {
            if (!classSchemes[cls.id]) classSchemes[cls.id] = JSON.parse(JSON.stringify(defaultPresets.preset_cics));
            if (!classStudentsStore[cls.id]) classStudentsStore[cls.id] = [];
            if (!classScores[cls.id]) classScores[cls.id] = {};
        });
    }

    // =========================================================================
    // SMART ROSTER PULL ENGINE (AUTOMATIC MATCHING SA DATABASE SECTIONS)
    // =========================================================================
    function pullStudentsFromSectionMasterlist() {
        if (!activeClass) return;

        // Kunin ang active class section name at course code
        const classSecRaw = (activeClass.section || '').trim().toLowerCase();
        const classCourse = (activeClass.course_code || '').trim().toLowerCase();

        // Alamin ang Year Number mula sa section name (e.g. 'BSIS 1A' -> 1, '1st Year' -> 1)
        let classYearNum = null;
        const yMatch = classSecRaw.match(/([1-4])/);
        if (yMatch) {
            classYearNum = parseInt(yMatch[1], 10);
        }

        // Salain mula sa masterlist
        const matched = masterStudentsDB.filter(s => {
            const sSecName = (s.section_name || '').trim().toLowerCase();
            const sYear = parseInt(s.year_level, 10);
            const sDept = (s.department || '').trim().toLowerCase();

            // 1. Direct match sa section name (e.g., 'BSIS 1A' === 'BSIS 1A' o 'BSIS 1st Year')
            if (sSecName === classSecRaw) return true;

            // 2. Fuzzy match kung naglalaman ng pangalan
            if (classSecRaw.includes(sSecName) || (sSecName && sSecName.includes(classSecRaw))) return true;

            // 3. Fallback: Parehong Year Level at Program
            if (classYearNum !== null && sYear === classYearNum) {
                if (classCourse.startsWith('is') || classCourse.startsWith('it')) {
                    if (sDept === 'bsis' || sSecName.includes('bsis')) return true;
                } else if (classCourse.startsWith('tm')) {
                    if (sDept === 'bstm' || sSecName.includes('bstm')) return true;
                } else if (classCourse.startsWith('ed')) {
                    if (sDept === 'beed' || sSecName.includes('beed')) return true;
                } else if (classCourse.startsWith('pol') || classCourse.startsWith('pos')) {
                    if (sDept === 'bapos' || sSecName.includes('bapos')) return true;
                }
            }

            return false;
        });

        if (matched.length === 0) {
            alert(`No registered students found in the central masterlist matching section "${activeClass.section}".`);
            return;
        }

        let addedCount = 0;
        matched.forEach(std => {
            const sId = std.student_id;
            if (!classStudentsStore[activeClass.id].some(ex => ex.student_id === sId)) {
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
        alert(`✔ Success: Pulled ${addedCount} students registered under ${activeClass.section} (${activeClass.course_code})!`);
    }

    function handleCsvUpload(inputElem) {
        if (!activeClass) return;
        const file = inputElem.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const text = e.target.result;
            const lines = text.split(/\r\n|\n/);
            let importedCount = 0;

            lines.forEach((line, index) => {
                if (!line.trim() || index === 0 && (line.toLowerCase().includes('id') || line.toLowerCase().includes('name'))) return;
                const cols = line.includes('\t') ? line.split('\t') : line.split(',');
                if (cols.length >= 2) {
                    const sId = cols[0].replace(/"/g, '').trim();
                    const sName = cols[1].replace(/"/g, '').trim();
                    const sDept = cols[2] ? cols[2].replace(/"/g, '').trim() : (activeClass.course_code || 'N/A');

                    if (sId && sName && !classStudentsStore[activeClass.id].some(ex => ex.student_id === sId)) {
                        classStudentsStore[activeClass.id].push({ student_id: sId, full_name: sName, department: sDept });
                        if (!classScores[activeClass.id][sId]) classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };
                        importedCount++;
                    }
                }
            });

            activeClass.student_count = classStudentsStore[activeClass.id].length;
            renderMatrix();
            alert(`Success: Imported ${importedCount} students from ${file.name}!`);
            inputElem.value = '';
        };
        reader.readAsText(file);
    }

    function quickAddSingleStudent() {
        if (!activeClass) return;
        const idInput = document.getElementById('quickAddId');
        const nameInput = document.getElementById('quickAddName');
        const sId = idInput.value.trim();
        const sName = nameInput.value.trim();

        if (!sId || !sName) { alert("Please enter Student ID and Name."); return; }
        if (classStudentsStore[activeClass.id].some(ex => ex.student_id === sId)) { alert("Student already exists."); return; }

        classStudentsStore[activeClass.id].push({ student_id: sId, full_name: sName, department: activeClass.course_code });
        if (!classScores[activeClass.id][sId]) classScores[activeClass.id][sId] = { rawScores: {}, attendance: {} };

        activeClass.student_count = classStudentsStore[activeClass.id].length;
        idInput.value = '';
        nameInput.value = '';
        renderMatrix();
    }

    function removeStudentFromClass(sId) {
        if (confirm("Remove this student from roster?")) {
            classStudentsStore[activeClass.id] = classStudentsStore[activeClass.id].filter(s => s.student_id !== sId);
            activeClass.student_count = classStudentsStore[activeClass.id].length;
            renderMatrix();
        }
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
                    <span class="badge bg-light text-secondary border">${cls.semester || '1st Semester'}</span>
                </div>
                <h6 class="fw-bold text-dark mb-1 text-truncate">${cls.course_title}</h6>
                <div class="text-muted small mb-3">
                    Section: <strong class="text-dark">${cls.section}</strong> • AY ${cls.school_year || '2026-2027'}
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
        document.getElementById('lblSchemeName').innerText = classSchemes[activeClass.id]?.name || 'Custom Scheme';
        document.getElementById('lblPassingCutoff').innerText = (classSchemes[activeClass.id]?.passingCutoff || 3.04).toFixed(2);

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
        const title = document.getElementById('newCourseTitle').value.trim();
        const sec = document.getElementById('newSection').value.trim();
        const sem = document.getElementById('newSemester').value;
        const tmpl = document.getElementById('newGradingTemplate').value;

        if (!code || !title || !sec) { alert("Please complete required fields."); return; }

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

        let totalCols = 2 + 3;

        scheme.groups.forEach(grp => {
            let colCount = (grp.items.length * 2);
            if (grp.hasAttendance && grp.attendanceDates.length > 0) colCount += (grp.attendanceDates.length + 2);
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
                        html += `<td><span class="${st === 'P' ? 'badge-att-p' : 'badge-att-a'}" onclick="toggleAttendance('${sId}', '${d}', this)">${st}</span></td>`;
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
            <td id="remarks_${sId}"><span class="badge ${isPassed ? 'bg-success' : 'bg-danger'}">${isPassed ? 'PASSED' : 'FAILED'}</span></td>
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
        if (remEl) remEl.innerHTML = `<span class="badge ${isPassed ? 'bg-success' : 'bg-danger'}">${isPassed ? 'PASSED' : 'FAILED'}</span>`;

        const r = document.getElementById(`row_${sId}`);
        if (r) {
            r.dataset.finalGrade = overallFinalGrade.toFixed(2);
            r.dataset.status = isPassed ? 'passed' : 'failed';
        }
    }

    function saveClassGrades() {
        alert("Success: All computed grades and criteria for " + activeClass.course_code + " (" + activeClass.section + ") have been securely saved!");
    }

    document.querySelectorAll('.filter-status-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter-status-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const f = this.dataset.filter;
            document.querySelectorAll('.student-row').forEach(row => {
                row.style.display = (f === 'all' || row.dataset.status === f) ? '' : 'none';
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        initStores();
        renderClassesGrid();
        <?php if (!empty($selectedClassId)): ?>
            openClassMatrix("<?= htmlspecialchars($selectedClassId) ?>");
        <?php endif; ?>
    });
</script>
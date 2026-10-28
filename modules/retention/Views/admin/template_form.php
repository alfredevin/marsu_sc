<?php
/**
 * ============================================================================
 * [SPAMS] Student Performance & Attendance Monitoring System
 * Scope: Module 2 - Academic Monitoring & Grading Schemes
 * View: Grading Template Editor Form (admin/template_form.php)
 * Managed by: SPAMS Research Group (Modules 1 to 3)
 * Note: Please do not modify if you are developing Modules 4 to 6.
 * ============================================================================
 */

$isEdit = !empty($template);
$actionUrl = $isEdit ? url("retention/admin/templates/{$template['id']}/update") : url("retention/admin/templates/store");
$schemeData = $isEdit ? (json_decode($template['scheme'], true) ?: []) : [
    'name' => '',
    'passingCutoff' => 3.04,
    'groups' => [
        [
            'id' => 'g1',
            'title' => 'Lecture / Quizzes & Classwork',
            'weight' => 30,
            'hasAttendance' => true,
            'attendanceDates' => [],
            'items' => [
                ['code' => 'Q1', 'title' => 'Quiz 1', 'type' => 'Quiz', 'maxScore' => 50],
                ['code' => 'Q2', 'title' => 'Quiz 2', 'type' => 'Quiz', 'maxScore' => 50],
            ]
        ],
        [
            'id' => 'g2',
            'title' => 'Laboratory & Practical Exercises',
            'weight' => 30,
            'hasAttendance' => false,
            'attendanceDates' => [],
            'items' => [
                ['code' => 'LAB1', 'title' => 'Laboratory 1', 'type' => 'Lab', 'maxScore' => 100],
            ]
        ],
        [
            'id' => 'g3',
            'title' => 'Major Examinations',
            'weight' => 40,
            'hasAttendance' => false,
            'attendanceDates' => [],
            'items' => [
                ['code' => 'MID', 'title' => 'Midterm Exam', 'type' => 'Exam', 'maxScore' => 100],
                ['code' => 'FIN', 'title' => 'Final Exam', 'type' => 'Exam', 'maxScore' => 100],
            ]
        ]
    ]
];
?>
<div class="container-fluid px-3 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <i class="bi bi-file-earmark-ruled me-2 text-marsu-burgundy"></i><?= $isEdit ? 'Edit Grading Template' : 'Create New Grading Template' ?>
            </h4>
            <p class="text-secondary small mb-0">Define category percentages and standard assessment items. Category weights must total exactly 100%.</p>
        </div>
        <a href="<?= url('retention/admin/templates') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back to Templates
        </a>
    </div>

    <form method="POST" action="<?= $actionUrl ?>" id="templateBuilderForm">
        <?= csrf_field() ?>
        <input type="hidden" name="scheme_json" id="schemeJsonInput">

        <div class="row g-4">
            <!-- Left: Metadata & Groups -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="fw-bold text-dark fs-6">1. Template Information</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="templateName" class="form-label fw-bold small text-dark">Template Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="templateName" name="name" 
                                    value="<?= e($template['name'] ?? '') ?>" required 
                                    placeholder="e.g. Standard Lecture-Laboratory Scheme (30-30-40)">
                            </div>
                            <div class="col-md-4">
                                <label for="passingCutoff" class="form-label fw-bold small text-dark">Passing Cutoff Grade <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="1.00" max="5.00" class="form-control form-control-sm" 
                                    id="passingCutoff" name="passing_cutoff" 
                                    value="<?= e($template['passing_cutoff'] ?? '3.04') ?>" required>
                                <small class="text-muted" style="font-size: 11px;">Philippine 1.00-5.00 scale (standard: 3.04)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assessment Groups Builder -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark fs-6">2. Assessment Category Groups</span>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addGroupBtn">
                            <i class="bi bi-plus-lg me-1"></i>Add Category
                        </button>
                    </div>
                    <div class="card-body p-3" id="groupsContainer">
                        <!-- Dynamic Group Cards Rendered via JS -->
                    </div>
                </div>

                <?php if ($isEdit): ?>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-3">
                            <label for="templateReason" class="form-label fw-bold small text-dark">
                                Reason for Modification <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="templateReason" name="reason" rows="2" required 
                                placeholder="Explain why this grading template definition is being modified..."></textarea>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right: Live Validation & Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm position-sticky" style="top: 20px;">
                    <div class="card-header bg-white border-bottom py-3">
                        <span class="fw-bold text-dark fs-6">
                            <i class="bi bi-pie-chart me-2 text-marsu-burgundy"></i>Weight Distribution
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-secondary">Total Weight:</span>
                            <span class="fs-5 fw-bold" id="totalWeightDisplay">0%</span>
                        </div>
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar" id="totalWeightBar" role="progressbar" style="width: 0%;"></div>
                        </div>

                        <div id="weightValidationAlert" class="alert alert-warning py-2 px-3 small mb-3">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>Total weight must equal exactly 100%.
                        </div>

                        <ul class="list-group list-group-flush mb-3" id="groupSummaryList">
                            <!-- Populated via JS -->
                        </ul>

                        <button type="submit" class="btn btn-marsu w-100" id="saveTemplateBtn" disabled>
                            <i class="bi bi-save me-1"></i>Save Template
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let scheme = <?= json_encode($schemeData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    if (!scheme.groups) scheme.groups = [];

    const container = document.getElementById('groupsContainer');
    const totalWeightDisplay = document.getElementById('totalWeightDisplay');
    const totalWeightBar = document.getElementById('totalWeightBar');
    const weightValidationAlert = document.getElementById('weightValidationAlert');
    const saveBtn = document.getElementById('saveTemplateBtn');
    const summaryList = document.getElementById('groupSummaryList');
    const schemeJsonInput = document.getElementById('schemeJsonInput');

    function render() {
        container.innerHTML = '';
        summaryList.innerHTML = '';
        let totalWeight = 0;

        scheme.groups.forEach((grp, gIdx) => {
            const grpWeight = parseFloat(grp.weight) || 0;
            totalWeight += grpWeight;

            // Summary Item
            const sItem = document.createElement('li');
            sItem.className = 'list-group-item d-flex justify-content-between align-items-center px-0 py-2 small';
            sItem.innerHTML = `
                <span>${escapeHtml(grp.title || 'Untitled')}</span>
                <span class="badge bg-light text-dark border">${grpWeight}%</span>
            `;
            summaryList.appendChild(sItem);

            // Group Card
            const card = document.createElement('div');
            card.className = 'card border border-light-subtle shadow-xs mb-3';
            card.innerHTML = `
                <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center">
                    <span class="fw-bold small text-dark"><i class="bi bi-folder2 me-1"></i>Category ${gIdx + 1}</span>
                    <button type="button" class="btn btn-xs text-danger" onclick="removeGroup(${gIdx})">
                        <i class="bi bi-trash"></i> Remove
                    </button>
                </div>
                <div class="card-body p-3">
                    <div class="row g-2 mb-3">
                        <div class="col-md-7">
                            <label class="form-label small fw-bold text-dark mb-1">Category Title</label>
                            <input type="text" class="form-control form-control-sm" value="${escapeHtml(grp.title)}" 
                                oninput="updateGroupField(${gIdx}, 'title', this.value)" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-dark mb-1">Weight (%)</label>
                            <input type="number" min="1" max="100" class="form-control form-control-sm" value="${grpWeight}" 
                                oninput="updateGroupField(${gIdx}, 'weight', parseFloat(this.value) || 0)" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" ${grp.hasAttendance ? 'checked' : ''} 
                                    onchange="updateGroupField(${gIdx}, 'hasAttendance', this.checked)">
                                <label class="form-check-label small" style="font-size: 11px;">Roll-Call</label>
                            </div>
                        </div>
                    </div>

                    <!-- Items Header -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-2 mb-2">
                        <span class="small fw-bold text-secondary">Assessment Items (${(grp.items || []).length})</span>
                        <button type="button" class="btn btn-outline-secondary btn-xs" onclick="addItem(${gIdx})">
                            <i class="bi bi-plus"></i> Add Item
                        </button>
                    </div>

                    <!-- Items List -->
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless align-middle mb-0" style="font-size: 12px;">
                            <thead class="text-muted">
                                <tr>
                                    <th style="width: 25%;">Code</th>
                                    <th style="width: 40%;">Title</th>
                                    <th style="width: 25%;">Max Score</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                ${(grp.items || []).map((it, iIdx) => `
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control form-control-sm py-0" style="font-size: 12px;" 
                                                value="${escapeHtml(it.code)}" 
                                                oninput="updateItemField(${gIdx}, ${iIdx}, 'code', this.value.toUpperCase())" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm py-0" style="font-size: 12px;" 
                                                value="${escapeHtml(it.title)}" 
                                                oninput="updateItemField(${gIdx}, ${iIdx}, 'title', this.value)" required>
                                        </td>
                                        <td>
                                            <input type="number" min="1" max="1000" class="form-control form-control-sm py-0" style="font-size: 12px;" 
                                                value="${it.maxScore || 100}" 
                                                oninput="updateItemField(${gIdx}, ${iIdx}, 'maxScore', parseFloat(this.value) || 100)" required>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-xs text-danger" onclick="removeItem(${gIdx}, ${iIdx})">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });

        // Update progress bar
        totalWeightDisplay.textContent = totalWeight + '%';
        totalWeightBar.style.width = Math.min(100, totalWeight) + '%';

        if (totalWeight === 100) {
            totalWeightBar.className = 'progress-bar bg-success';
            weightValidationAlert.className = 'alert alert-success py-2 px-3 small mb-3';
            weightValidationAlert.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i>Weight distribution is valid (100%).';
            saveBtn.disabled = false;
        } else {
            totalWeightBar.className = totalWeight > 100 ? 'progress-bar bg-danger' : 'progress-bar bg-warning';
            weightValidationAlert.className = 'alert alert-danger py-2 px-3 small mb-3';
            weightValidationAlert.innerHTML = `<i class="bi bi-exclamation-triangle-fill me-1"></i>Total weight is ${totalWeight}%. Must equal exactly 100%.`;
            saveBtn.disabled = true;
        }

        // Sync Scheme
        scheme.name = document.getElementById('templateName').value;
        scheme.passingCutoff = parseFloat(document.getElementById('passingCutoff').value) || 3.04;
        schemeJsonInput.value = JSON.stringify(scheme);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    window.updateGroupField = function(gIdx, field, val) {
        scheme.groups[gIdx][field] = val;
        render();
    };

    window.removeGroup = function(gIdx) {
        if (scheme.groups.length <= 1) {
            alert('A template must have at least one assessment group.');
            return;
        }
        scheme.groups.splice(gIdx, 1);
        render();
    };

    window.addItem = function(gIdx) {
        if (!scheme.groups[gIdx].items) scheme.groups[gIdx].items = [];
        const nextNum = scheme.groups[gIdx].items.length + 1;
        scheme.groups[gIdx].items.push({
            code: 'ITEM' + nextNum,
            title: 'Assessment ' + nextNum,
            type: 'Assessment',
            maxScore: 100
        });
        render();
    };

    window.updateItemField = function(gIdx, iIdx, field, val) {
        scheme.groups[gIdx].items[iIdx][field] = val;
        render();
    };

    window.removeItem = function(gIdx, iIdx) {
        scheme.groups[gIdx].items.splice(iIdx, 1);
        render();
    };

    document.getElementById('addGroupBtn').addEventListener('click', function() {
        const nextId = 'g' + (scheme.groups.length + 1);
        scheme.groups.push({
            id: nextId,
            title: 'New Assessment Category',
            weight: 0,
            hasAttendance: false,
            attendanceDates: [],
            items: [
                { code: 'ACT1', title: 'Activity 1', type: 'Activity', maxScore: 100 }
            ]
        });
        render();
    });

    document.getElementById('templateName').addEventListener('input', render);
    document.getElementById('passingCutoff').addEventListener('input', render);

    // Initial render
    render();
});
</script>

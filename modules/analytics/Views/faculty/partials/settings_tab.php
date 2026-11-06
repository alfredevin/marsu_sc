<?php
$schemeJson = json_encode($scheme, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-transparent fw-semibold">Class details</div>
            <form method="POST" action="<?= url($base . '/update') ?>" class="card-body small">
                <?= csrf_field() ?>
                <div class="mb-2"><label class="form-label mb-1">Schedule</label><input name="schedule" maxlength="128" value="<?= e($class['schedule'] ?? '') ?>" class="form-control form-control-sm" placeholder="e.g. MWF 9:00–10:00"></div>
                <div class="mb-2"><label class="form-label mb-1">Room</label>
                    <select name="room_id" class="form-select form-select-sm">
                        <option value="">No room assigned</option>
                        <?php foreach ($rooms ?? [] as $r): ?>
                            <option value="<?= (int) $r['id'] ?>" <?= (int) ($class['room_id'] ?? 0) === (int) $r['id'] ? 'selected' : '' ?>><?= e($r['room_number'] . ' — ' . $r['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-2"><label class="form-label mb-1">Description</label><textarea name="description" rows="3" maxlength="2000" class="form-control form-control-sm"><?= e($class['description'] ?? '') ?></textarea></div>
                <button class="btn btn-sm btn-marsu" type="submit">Save details</button>
            </form>
        </div>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-transparent fw-semibold">Student visibility</div>
            <div class="card-body small">
                <p class="mb-2">Task scores are currently <strong><?= $class['scores_visible'] ? 'visible' : 'hidden' ?></strong> to students. Students only ever see their own scores; final grades appear only after posting.</p>
                <form method="POST" action="<?= url($base . '/scores-visibility') ?>"><?= csrf_field() ?>
                    <button class="btn btn-sm btn-outline-secondary" type="submit"><?= $class['scores_visible'] ? 'Hide task scores' : 'Show task scores to students' ?></button>
                </form>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold">Correction requests</div>
            <div class="card-body small">
                <?php if (empty($correctionHistory)): ?><p class="text-secondary mb-0">None filed.</p><?php endif; ?>
                <?php foreach ($correctionHistory as $c): ?>
                    <div class="border-bottom pb-1 mb-1"><span class="badge bg-light text-dark border"><?= e($c['status']) ?></span> <?= e(date('M j, Y', strtotime($c['created_at']))) ?>
                        <div class="text-secondary"><?= e($c['reason']) ?></div>
                        <?php if ($c['review_note']): ?><div>Reviewer: <?= e($c['review_note']) ?></div><?php endif; ?></div>
                <?php endforeach; ?>
                <p class="text-secondary mt-2 mb-0">INC removal window: <?= $incWindowDays === null ? 'Not configured' : (int) $incWindowDays . ' days' ?>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-semibold d-flex justify-content-between">
                <span>Grading components and tasks</span>
                <span class="small text-secondary">Weights total: <span id="weightTotal">0</span>%</span>
            </div>
            <div class="card-body small">
                <?php if (!$isDraft): ?>
                    <p class="text-secondary">Grades are <?= e($class['grade_status']) ?>; the scheme is read-only.</p>
                <?php elseif (!$allowCustomWeights): ?>
                    <p class="text-secondary">Policy keeps component weights fixed to the template. You can still add, rename or remove tasks.</p>
                <?php endif; ?>
                <form method="POST" action="<?= url($base . '/scheme') ?>" id="schemeForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="scheme_json" id="schemeJson">
                    <div id="schemeGroups"></div>
                    <?php if ($isDraft): ?>
                        <div class="d-flex gap-2 mt-2">
                            <?php if ($allowCustomWeights): ?><button type="button" class="btn btn-sm btn-outline-secondary" id="addGroup"><i class="bi bi-plus me-1"></i>Component</button><?php endif; ?>
                            <button type="submit" class="btn btn-sm btn-marsu ms-auto">Save scheme</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var scheme = <?= $schemeJson ?>;
    var editable = <?= $isDraft ? 'true' : 'false' ?>;
    var weightsEditable = editable && <?= $allowCustomWeights ? 'true' : 'false' ?>;
    var wrap = document.getElementById('schemeGroups');

    function el(tag, attrs, children) {
        var n = document.createElement(tag);
        Object.keys(attrs || {}).forEach(function (k) {
            if (k === 'text') { n.textContent = attrs[k]; } else if (k === 'value') { n.value = attrs[k]; } else { n.setAttribute(k, attrs[k]); }
        });
        (children || []).forEach(function (c) { n.appendChild(c); });
        if (!editable && (tag === 'input' || tag === 'button')) { n.disabled = true; }
        return n;
    }

    function itemRow(g, it) {
        var tr = el('tr');
        [['code', 'text', 'Code'], ['title', 'text', 'Title'], ['maxScore', 'number', 'Max'], ['dueDate', 'date', 'Due']].forEach(function (f) {
            var input = el('input', { type: f[1], class: 'form-control form-control-sm', value: it[f[0]] == null ? '' : it[f[0]], 'aria-label': f[2] });
            if (f[1] === 'number') { input.min = '0.01'; input.step = 'any'; }
            input.addEventListener('input', function () { it[f[0]] = f[1] === 'number' ? parseFloat(input.value) : input.value; });
            tr.appendChild(el('td', {}, [input]));
        });
        var del = el('button', { type: 'button', class: 'btn btn-sm btn-outline-danger', title: 'Remove task' }, [el('i', { class: 'bi bi-x' })]);
        del.addEventListener('click', function () { g.items.splice(g.items.indexOf(it), 1); render(); });
        tr.appendChild(el('td', {}, [del]));
        return tr;
    }

    function render() {
        wrap.innerHTML = '';
        var total = 0;
        scheme.groups.forEach(function (g) {
            total += parseFloat(g.weight) || 0;
            var title = el('input', { type: 'text', class: 'form-control form-control-sm fw-semibold', value: g.title, 'aria-label': 'Component title' });
            title.addEventListener('input', function () { g.title = title.value; });
            var weight = el('input', { type: 'number', class: 'form-control form-control-sm', value: g.weight, min: '0', max: '100', step: 'any', style: 'width:90px', 'aria-label': 'Weight' });
            if (!weightsEditable) { weight.disabled = true; }
            weight.addEventListener('input', function () { g.weight = parseFloat(weight.value) || 0; updateTotal(); });
            var att = el('input', { type: 'checkbox', class: 'form-check-input', 'aria-label': 'Include attendance' });
            att.checked = !!g.hasAttendance;
            if (!weightsEditable) { att.disabled = true; }
            att.addEventListener('change', function () { g.hasAttendance = att.checked; });

            var head = el('div', { class: 'd-flex flex-wrap gap-2 align-items-center mb-2' }, [
                el('div', { class: 'flex-grow-1' }, [title]),
                el('div', { class: 'input-group input-group-sm', style: 'width:auto' }, [weight, el('span', { class: 'input-group-text', text: '%' })]),
                el('label', { class: 'form-check-label d-flex gap-1 align-items-center' }, [att, el('span', { text: 'Attendance' })])
            ]);
            if (weightsEditable) {
                var rm = el('button', { type: 'button', class: 'btn btn-sm btn-outline-danger', title: 'Remove component' }, [el('i', { class: 'bi bi-trash' })]);
                rm.addEventListener('click', function () { scheme.groups.splice(scheme.groups.indexOf(g), 1); render(); });
                head.appendChild(rm);
            }
            var tbody = el('tbody');
            g.items.forEach(function (it) { tbody.appendChild(itemRow(g, it)); });
            var table = el('table', { class: 'table table-sm mb-1' }, [
                el('thead', {}, [el('tr', {}, ['Code', 'Title', 'Max score', 'Due date', ''].map(function (h) { return el('th', { text: h, class: 'small text-secondary fw-normal' }); }))]),
                tbody
            ]);
            var box = el('div', { class: 'border rounded p-2 mb-2' }, [head, el('div', { class: 'table-responsive' }, [table])]);
            if (editable) {
                var add = el('button', { type: 'button', class: 'btn btn-sm btn-link p-0' }, [el('i', { class: 'bi bi-plus me-1' }), document.createTextNode('Add task')]);
                add.addEventListener('click', function () { g.items.push({ code: '', title: '', maxScore: 100, dueDate: '' }); render(); });
                box.appendChild(add);
            }
            wrap.appendChild(box);
        });
        updateTotal();
    }

    function updateTotal() {
        var t = scheme.groups.reduce(function (s, g) { return s + (parseFloat(g.weight) || 0); }, 0);
        var span = document.getElementById('weightTotal');
        span.textContent = Math.round(t * 100) / 100;
        span.className = Math.abs(t - 100) < 0.01 ? 'text-success fw-semibold' : 'text-danger fw-semibold';
    }

    var addGroup = document.getElementById('addGroup');
    if (addGroup) {
        addGroup.addEventListener('click', function () {
            scheme.groups.push({ id: 'grp_' + Date.now(), title: 'New component', weight: 0, hasAttendance: false, items: [] });
            render();
        });
    }
    document.getElementById('schemeForm').addEventListener('submit', function () {
        document.getElementById('schemeJson').value = JSON.stringify(scheme);
    });
    render();
});
</script>

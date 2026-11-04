<?php
/**
 * MarSU Shared DataTable Helper (Vanilla JS, walang jQuery / CDN)
 *
 * PAANO GAMITIN (sa kahit anong module view):
 *
 *   1. I-include ito ONCE sa view:
 *        <?php include dirname(__DIR__, 2) . '/_shared/datatable.php'; ?>
 *
 *   2. Lagyan ng `data-marsu-table` ang <table> mo (auto-init na):
 *        <table class="table" data-marsu-table data-per-page="10"> ... </table>
 *
 *      O tawagin manually sa sariling <script>:
 *        MarsuTable.init('myTableId', { perPage: 10, search: 'mySearchInputId' });
 *
 * OPTIONS (data-* attribute sa <table> o object sa MarsuTable.init):
 *   data-per-page="10"        Default rows per page (5, 10, 25, 50, 0 = All)
 *   data-search="inputId"     Gamitin ang existing search input (kung wala, gagawa ito ng sarili)
 *
 * SA <th> / <td>:
 *   <th data-no-sort>         Hindi ma-so-sort ang column (hal. Actions)
 *   <td data-order="...">     Value na gagamitin sa pag-sort (hal. timestamp ng date)
 */

if (defined('MARSU_DATATABLE_LOADED')) {
    return;
}
define('MARSU_DATATABLE_LOADED', true);
?>
<script>
window.MarsuTable = (function () {

    function cellValue(row, idx) {
        const cell = row.cells[idx];
        if (!cell) return '';
        return (cell.dataset.order ?? cell.textContent).trim();
    }

    function compare(a, b) {
        const na = Number(a.replace(/[,₱\s]/g, ''));
        const nb = Number(b.replace(/[,₱\s]/g, ''));
        if (a !== '' && b !== '' && !isNaN(na) && !isNaN(nb)) return na - nb;

        const da = Date.parse(a), db = Date.parse(b);
        if (!isNaN(da) && !isNaN(db)) return da - db;

        return a.localeCompare(b, undefined, { numeric: true, sensitivity: 'base' });
    }

    function init(tableOrId, options) {
        const table = typeof tableOrId === 'string' ? document.getElementById(tableOrId) : tableOrId;
        if (!table || table.dataset.marsuTableReady) return;
        table.dataset.marsuTableReady = '1';

        options = options || {};
        const perPage = parseInt(options.perPage ?? table.dataset.perPage ?? 10, 10);
        const searchId = options.search ?? table.dataset.search;

        const tbody   = table.tBodies[0];
        const headers = Array.from(table.tHead.rows[0].cells);
        // Data rows lang (hindi kasama yung "No records found" row na may colspan)
        const allRows = Array.from(tbody.rows).filter(r => !r.querySelector('td[colspan]'));
        if (!allRows.length) return;

        const wrapper = table.closest('.table-responsive') || table;
        let filtered = allRows.slice();
        let page = 1, sortCol = -1, sortDir = 1;

        // ---------- Toolbar (length + search) ----------
        const lengthOptions = [5, 10, 25, 50];
        if (perPage && !lengthOptions.includes(perPage)) lengthOptions.push(perPage);
        lengthOptions.sort((a, b) => a - b);

        const toolbar = document.createElement('div');
        toolbar.className = 'd-flex flex-wrap justify-content-between align-items-center gap-2 p-3 border-bottom';
        toolbar.innerHTML = `
            <div class="d-flex align-items-center gap-2 small text-muted">
                Show
                <select class="form-select form-select-sm w-auto" data-role="length">
                    ${lengthOptions.map(n => `<option value="${n}" ${n === perPage ? 'selected' : ''}>${n}</option>`).join('')}
                    <option value="0" ${perPage === 0 ? 'selected' : ''}>All</option>
                </select>
                entries
            </div>`;

        let search = searchId ? document.getElementById(searchId) : null;
        if (!search) {
            const box = document.createElement('div');
            box.className = 'input-group input-group-sm w-auto';
            box.innerHTML = `
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="search" class="form-control" placeholder="Search...">`;
            toolbar.appendChild(box);
            search = box.querySelector('input');
        }
        wrapper.before(toolbar);

        // ---------- Footer (info + pager) ----------
        const footer = document.createElement('div');
        footer.className = 'd-flex flex-wrap justify-content-between align-items-center gap-2 p-3 border-top';
        footer.innerHTML = `
            <div class="small text-muted" data-role="info"></div>
            <nav><ul class="pagination pagination-sm mb-0" data-role="pager"></ul></nav>`;
        wrapper.after(footer);

        const lengthSel = toolbar.querySelector('[data-role="length"]');
        const info      = footer.querySelector('[data-role="info"]');
        const pager     = footer.querySelector('[data-role="pager"]');

        // ---------- Sorting ----------
        headers.forEach((th, idx) => {
            if (th.hasAttribute('data-no-sort')) return;
            th.style.cursor = 'pointer';
            th.style.userSelect = 'none';
            const icon = document.createElement('i');
            icon.className = 'bi bi-arrow-down-up ms-1 opacity-50 small';
            icon.dataset.sortIcon = '1';
            th.appendChild(icon);

            th.addEventListener('click', () => {
                sortDir = (sortCol === idx) ? -sortDir : 1;
                sortCol = idx;
                headers.forEach(h => {
                    const i = h.querySelector('[data-sort-icon]');
                    if (i) i.className = 'bi bi-arrow-down-up ms-1 opacity-50 small';
                });
                icon.className = 'bi ' + (sortDir === 1 ? 'bi-sort-up' : 'bi-sort-down') + ' ms-1 small';
                applyFilter();
            });
        });

        // ---------- Filter + Sort ----------
        function applyFilter() {
            const q = search.value.toLowerCase().trim();
            filtered = allRows.filter(r => r.textContent.toLowerCase().includes(q));
            if (sortCol > -1) {
                filtered.sort((a, b) => compare(cellValue(a, sortCol), cellValue(b, sortCol)) * sortDir);
            }
            page = 1;
            render();
        }

        // ---------- Render ----------
        function render() {
            const len   = parseInt(lengthSel.value, 10);
            const total = filtered.length;
            const pages = len ? Math.max(1, Math.ceil(total / len)) : 1;
            if (page > pages) page = pages;

            const start = len ? (page - 1) * len : 0;
            const end   = len ? Math.min(start + len, total) : total;

            if (total) {
                tbody.replaceChildren(...filtered.slice(start, end));
            } else {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="${headers.length}" class="text-center py-4 text-muted">
                    <i class="bi bi-search fs-4 d-block mb-1"></i>No matching records found</td>`;
                tbody.replaceChildren(tr);
            }

            info.textContent = total
                ? `Showing ${start + 1} to ${end} of ${total} entries` +
                  (total !== allRows.length ? ` (filtered from ${allRows.length})` : '')
                : 'Showing 0 entries';

            const item = (p, label, disabled, active) =>
                `<li class="page-item ${disabled ? 'disabled' : ''} ${active ? 'active' : ''}">
                    <button type="button" class="page-link" data-page="${p}">${label}</button>
                 </li>`;

            let html = item(page - 1, '&laquo;', page === 1, false);
            let to = Math.min(pages, Math.max(1, page - 2) + 4);
            let from = Math.max(1, to - 4);
            for (let p = from; p <= to; p++) html += item(p, p, false, p === page);
            html += item(page + 1, '&raquo;', page === pages, false);
            pager.innerHTML = html;
        }

        pager.addEventListener('click', e => {
            const btn = e.target.closest('[data-page]');
            if (!btn || btn.parentElement.classList.contains('disabled')) return;
            page = parseInt(btn.dataset.page, 10);
            render();
        });
        lengthSel.addEventListener('change', () => { page = 1; render(); });
        search.addEventListener('input', applyFilter);

        render();
    }

    // Auto-init lahat ng <table data-marsu-table>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('table[data-marsu-table]').forEach(t => init(t));
    });

    return { init };
})();
</script>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h1 class="h3 font-weight-bold text-marsu-burgundy mb-1">MarSU UI Kit & Design System</h1>
        <p class="text-muted small mb-0">Official component library, color tokens, and styling standards for BSIS student developers.</p>
    </div>
    <div>
        <span class="badge badge-gold px-3 py-2 fs-6">Bootstrap 5.3 + Vanilla JS</span>
    </div>
</div>

<!-- 1. Brand Color Swatches -->
<div class="card mb-4">
    <div class="card-header card-header-accent">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-palette-fill me-2"></i>MarSU Color Tokens</h6>
    </div>
    <div class="card-body">
        <p class="small text-muted mb-3">All colors are defined as CSS custom variables in <code>public/assets/css/theme.css</code>. <strong>Never hardcode raw hex values in module views.</strong></p>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-white shadow-xs" style="background-color: var(--marsu-burgundy);">
                    <div class="fw-bold">--marsu-burgundy</div>
                    <div class="small opacity-75">#800020 (Primary Brand)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-white shadow-xs" style="background-color: var(--marsu-burgundy-dark);">
                    <div class="fw-bold">--marsu-burgundy-dark</div>
                    <div class="small opacity-75">#5C0016 (Sidebar & Headers)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-white shadow-xs" style="background-color: var(--marsu-burgundy-deep);">
                    <div class="fw-bold">--marsu-burgundy-deep</div>
                    <div class="small opacity-75">#3D000F (Dark Mode Deep)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-dark shadow-xs border" style="background-color: var(--marsu-burgundy-soft);">
                    <div class="fw-bold">--marsu-burgundy-soft</div>
                    <div class="small text-muted">#F8E9EC (Tints & Stripes)</div>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-dark shadow-xs font-weight-bold" style="background-color: var(--marsu-gold); color: #5C0016 !important;">
                    <div>--marsu-gold</div>
                    <div class="small opacity-75">#D4AF37 (Accent)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-white shadow-xs font-weight-bold" style="background-color: var(--marsu-gold-dark);">
                    <div>--marsu-gold-dark</div>
                    <div class="small opacity-75">#B8922A (Accent Hover)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-dark shadow-xs border" style="background-color: var(--marsu-gold-soft); color: #5C0016 !important;">
                    <div class="fw-bold">--marsu-gold-soft</div>
                    <div class="small text-muted">#FBF3D5 (Badges & Hover)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 rounded text-dark shadow-xs border" style="background-color: var(--marsu-bg);">
                    <div class="fw-bold">--marsu-bg</div>
                    <div class="small text-muted">#FAF7F7 (App Ivory BG)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Buttons Showcase -->
<div class="card mb-4">
    <div class="card-header card-header-accent">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-cursor-fill me-2"></i>Button Components</h6>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Primary Button</button>
            <button class="btn btn-accent"><i class="bi bi-star-fill me-1"></i>Gold Accent Button</button>
            <button class="btn btn-outline-primary"><i class="bi bi-arrow-right me-1"></i>Outline Burgundy</button>
            <button class="btn btn-outline-secondary">Outline Secondary</button>
            <button class="btn btn-danger"><i class="bi bi-trash me-1"></i>Destructive Action</button>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <button class="btn btn-primary btn-sm">Small Button (.btn-sm)</button>
            <button class="btn btn-accent btn-sm">Small Gold (.btn-sm)</button>
            <button class="btn btn-primary btn-lg">Large Action (.btn-lg)</button>
            <button class="btn btn-accent btn-lg">Large Gold (.btn-lg)</button>
        </div>
    </div>
</div>

<!-- 3. Cards & KPI Widgets -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header card-header-accent d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-marsu-burgundy">Standard Card with Header Accent</h6>
                <span class="badge badge-gold">Component</span>
            </div>
            <div class="card-body">
                <p class="small text-muted">Card headers feature a short 48px gold accent underline at the bottom left border. Cards have subtle hover elevation and 12px rounded corners.</p>
                <div class="alert alert-info small mb-0">
                    <i class="bi bi-info-circle-fill me-1"></i>Use <code>class="card"</code> and <code>class="card-header card-header-accent"</code>.
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row g-3">
            <div class="col-sm-6">
                <div class="card card-kpi p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Standard KPI</div>
                            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">1,482</div>
                        </div>
                        <div class="kpi-icon-badge">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-kpi border-gold p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small text-uppercase fw-bold">Gold Accent KPI</div>
                            <div class="h3 font-weight-bold mb-0 text-marsu-burgundy">₱245.8k</div>
                        </div>
                        <div class="kpi-icon-badge badge-gold">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-hero-kpi p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="kpi-label">Hero Metric Banner</div>
                            <div class="kpi-value">98.4%</div>
                        </div>
                        <div class="p-3 bg-white bg-opacity-10 rounded-3">
                            <i class="bi bi-trophy text-gold fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Tables Specification -->
<div class="card mb-4">
    <div class="card-header card-header-accent">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-table me-2"></i>Themed Table Component</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-marsu table-hover align-middle mb-0 small">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student / Record Name</th>
                        <th>Program</th>
                        <th>Academic Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong class="text-marsu-burgundy">Maria Santos</strong></td>
                        <td>BSIS 3A</td>
                        <td><span class="badge badge-soft-success">Regular</span></td>
                        <td class="text-end"><button class="btn btn-sm btn-outline-marsu py-0 px-2">Inspect</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong class="text-marsu-burgundy">Juan Dela Cruz</strong></td>
                        <td>BSCS 3B</td>
                        <td><span class="badge badge-gold">Scholar</span></td>
                        <td class="text-end"><button class="btn btn-sm btn-outline-marsu py-0 px-2">Inspect</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong class="text-marsu-burgundy">Elena Ramos</strong></td>
                        <td>BSIS 4A</td>
                        <td><span class="badge badge-soft-info">Dean's List</span></td>
                        <td class="text-end"><button class="btn btn-sm btn-outline-marsu py-0 px-2">Inspect</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 5. Interactive Alerts & Dialogs Showcase -->
<div class="card mb-4">
    <div class="card-header card-header-accent">
        <h6 class="m-0 font-weight-bold text-marsu-burgundy"><i class="bi bi-bell-fill me-2"></i>SweetAlert2 Interactive Toasts & Dialogs</h6>
    </div>
    <div class="card-body">
        <p class="small text-muted mb-3">Small offline SweetAlert2 v11 integration for confirmation modals and notification toasts.</p>
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-primary btn-sm" onclick="Swal.fire({icon: 'success', title: 'Action Succeeded', text: 'Record saved successfully.', confirmButtonColor: '#800020'})">
                Success Dialog
            </button>
            <button class="btn btn-danger btn-sm" onclick="Swal.fire({icon: 'error', title: 'Operation Failed', text: 'Required fields missing.', confirmButtonColor: '#800020'})">
                Error Dialog
            </button>
            <button class="btn btn-accent btn-sm font-weight-bold" onclick="Swal.fire({title: 'Confirm Operation', text: 'This action cannot be undone.', icon: 'warning', showCancelButton: true, confirmButtonColor: '#800020', confirmButtonText: 'Yes, proceed'})">
                Confirmation Dialog
            </button>
        </div>
    </div>
</div>

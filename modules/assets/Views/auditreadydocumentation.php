<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <div class="text-uppercase fw-bold text-gold small mb-1" style="font-size: 0.72rem; letter-spacing: 0.1em;">
                <i class="bi bi-patch-check-fill text-warning me-1"></i>REPORTS &amp; ANALYTICS &bull; SUB-MODULE 5
            </div>
            <h1 class="h3 fw-bold text-marsu-burgundy mb-1">
                Audit-Ready Documentation &amp; Compliance Dossier
            </h1>
            <p class="text-muted small mb-0">Commission on Audit (COA) Circular compliance package, inventory discrepancy reconciliations, and property turnover certification.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <button class="btn btn-warning text-dark btn-sm fw-bold shadow-sm px-3" onclick="window.print();" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028; border-radius: 6px;">
                <i class="bi bi-printer-fill me-1"></i>Print Audit Dossier
            </button>
        </div>
    </div>

    <!-- Audit Checklist Strip -->
    <div class="card shadow-sm border-0 p-4 mb-4 bg-white" style="border-radius: 8px;">
        <h5 class="fw-bold text-marsu-burgundy mb-3">
            <i class="bi bi-check2-all text-warning me-2"></i>COA Physical Count Audit Compliance Verification
        </h5>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="d-flex align-items-center p-2 rounded bg-light border">
                    <i class="bi bi-check-circle-fill text-success fs-2 me-3"></i>
                    <div>
                        <div class="fw-bold text-dark small">Appendix 73 (RPCPPE)</div>
                        <span class="small text-muted">Complete &amp; Signed</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center p-2 rounded bg-light border">
                    <i class="bi bi-check-circle-fill text-success fs-2 me-3"></i>
                    <div>
                        <div class="fw-bold text-dark small">Appendix 74 (RPCSP)</div>
                        <span class="small text-muted">Complete &amp; Signed</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center p-2 rounded bg-light border">
                    <i class="bi bi-check-circle-fill text-success fs-2 me-3"></i>
                    <div>
                        <div class="fw-bold text-dark small">Appendix 58 (Stock Cards)</div>
                        <span class="small text-muted">Reconciled Monthly</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center p-2 rounded bg-light border">
                    <i class="bi bi-check-circle-fill text-success fs-2 me-3"></i>
                    <div>
                        <div class="fw-bold text-dark small">Discrepancy Ledger</div>
                        <span class="small text-muted">Zero Unresolved Variances</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Printable Preview Card -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center border-bottom gap-2" style="background-color: #7B1E2B;">
            <div class="d-flex align-items-center">
                <i class="bi bi-award-fill text-warning me-3 fs-4"></i>
                <div>
                    <h6 class="fw-bold mb-0 text-white">COA Audit Verification Certificate Preview</h6>
                    <small class="text-warning">Republic of the Philippines &bull; Commission on Audit Compliance Dossier</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-light fw-bold shadow-sm" onclick="window.togglePaperFit('auditPaperViewport')" title="Toggle between standard A4 scale and responsive fit">
                    <i class="bi bi-arrows-fullscreen me-1"></i>Fit / 100%
                </button>
                <button type="button" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" onclick="printAuditReport()" style="background: linear-gradient(180deg, #f3e08a 0%, #d4af37 100%); border: 1px solid #c5a028;">
                    <i class="bi bi-printer-fill me-1"></i>Print Certificate / Save PDF
                </button>
            </div>
        </div>

        <!-- Report Content Area -->
        <div class="card-body p-3 p-md-4 bg-light" style="min-height: 500px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
            
            <!-- A4 Simulated Paper Container -->
            <div class="bg-white p-4 p-md-5 shadow-sm mx-auto position-relative text-dark" id="auditPaperViewport" style="max-width: 1000px; border-radius: 4px; border: 1px solid #dee2e6;">
                
                <!-- Report Header Inside Paper -->
                <div class="text-end text-muted small fw-bold mb-2">COA Audit Dossier</div>
                <div class="text-center mb-4">
                    <div class="small fw-bold text-uppercase text-secondary mb-1">Republic of the Philippines</div>
                    <h4 class="fw-bold mb-1" style="color: #7B1E2B; letter-spacing: 0.5px;">MARINDUQUE STATE UNIVERSITY</h4>
                    <div class="small fw-semibold text-dark mb-2">STA. CRUZ CAMPUS &bull; SUPPLY AND PROPERTY MANAGEMENT UNIT</div>
                    <h5 class="fw-bold text-dark text-uppercase mt-2" style="font-size: 1.05rem;">
                        CERTIFICATE OF PHYSICAL INVENTORY VERIFICATION &amp; RECONCILIATION
                    </h5>
                    <div class="small text-muted font-monospace mt-1">Supply and Property Management Unit (SPMU) &bull; Audit Period FY 2026</div>
                </div>

                <!-- Certification Body Text -->
                <div class="p-4 my-4 rounded border-start border-4 border-warning bg-light" style="line-height: 1.8; font-size: 0.95rem;">
                    <p class="mb-3 fw-bold text-uppercase text-marsu-burgundy" style="letter-spacing: 0.05em;">
                        TO THE COMMISSION ON AUDIT (COA) RESIDENT AUDITOR:
                    </p>
                    <p class="mb-0 text-justify text-dark">
                        This is to certify that an actual physical count of all institutional Property, Plant, and Equipment (PPE), Semi-Expendable Properties, and Supplies Inventory belonging to <strong>Marinduque State University - Sta. Cruz Campus</strong> was duly conducted by the Inventory Committee pursuant to COA Circular No. 2020-006 and the Government Accounting Manual (GAM). All items listed in the electronic registry totaling <strong>&#8369;10,742,000.00</strong> have been verified on-site, tagged with standardized QR Property Identification Numbers (PIN), and reconciled with the accounting records without material discrepancy.
                    </p>
                </div>

                <!-- Signatories Section -->
                <div class="row g-3 mt-5 pt-3 border-top">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Certified Correct by Inventory Committee:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">SANVER ANDREW H. MAPACPAC</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Property Custodian / SPMU Head</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Attested by Internal Audit:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">ENGR. RAFAEL MENDOZA</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Campus Inspection Officer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center h-100 d-flex flex-column justify-content-between">
                            <div class="small fw-bold text-uppercase text-secondary mb-3">Approved by Campus Leadership:</div>
                            <div class="mt-auto">
                                <div class="fw-bold text-dark border-bottom border-dark pb-1 mb-1">DR. RANDELL REGINIO</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Campus Director, Sta. Cruz Campus</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
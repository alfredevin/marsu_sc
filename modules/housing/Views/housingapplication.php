<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-marsu-burgundy mb-1">
            <i class="bi bi-file-earmark-person me-2 text-gold"></i>Housing Application
        </h1>
        <p class="text-muted mb-0">Review the information and documents needed to apply for student housing.</p>
    </div>
    <a href="<?= url('housing') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Overview
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h2 class="h5 text-marsu-burgundy mb-0">Application checklist</h2>
            </div>
            <div class="card-body">
                <p class="text-muted">Prepare the following details before starting an application:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0"><i class="bi bi-person-vcard text-marsu-burgundy me-2"></i>Current student identification and contact information</li>
                    <li class="list-group-item px-0"><i class="bi bi-building text-marsu-burgundy me-2"></i>Preferred accredited boarding house and room type</li>
                    <li class="list-group-item px-0"><i class="bi bi-calendar-event text-marsu-burgundy me-2"></i>Expected move-in date and requested length of stay</li>
                    <li class="list-group-item px-0"><i class="bi bi-telephone text-marsu-burgundy me-2"></i>Emergency contact information</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h2 class="h5 text-marsu-burgundy mb-0">Application process</h2>
            </div>
            <div class="card-body">
                <ol class="ps-3 mb-0">
                    <li class="mb-3">Choose a suitable accredited boarding house.</li>
                    <li class="mb-3">Submit the required student and housing details for review.</li>
                    <li>Check the approval workflow for application status and next steps.</li>
                </ol>
                <a href="<?= url('housing/approvalworkflow') ?>" class="btn btn-outline-secondary btn-sm mt-4">
                    View Approval Workflow<i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
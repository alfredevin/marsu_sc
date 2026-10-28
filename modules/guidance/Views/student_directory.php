<!-- ==================================================================== -->
<!--   GUIDANCE & COUNSELING SYSTEM: MODULE 1.1 STUDENT PROFILE           -->
<!-- ==================================================================== -->

<!-- BREADCRUMB & PAGE HEADER -->
<div class="mb-4">
    <!-- Breadcrumb Trail -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0" style="font-size: 15px; background: transparent; padding: 0; line-height: 1.5;">
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                    <i class="bi bi-house-door-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 500;">
                    Student Information Management
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">
                Student Profile
            </li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
        <div>
            <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                Student Profile Management
            </h4>
            <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                Manage student directory, academic backgrounds, health accommodations, and historical records.
            </p>
        </div>

    </div>
</div>


<!-- SEARCH & TWO-FILTER TOOLBAR (MINIMIZED TO EXACTLY TWO FILTERS) -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <!-- Search by ID, Name, or Email -->
            <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white"
                        style="border-color: #ced4da; font-size: 15px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="studentSearchInput" class="form-control border-start-0 shadow-none"
                        placeholder="Search by Student ID, Full Name, or Email..."
                        style="font-size: 15px; height: 40px; border-color: #ced4da;">
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                <select id="filterProgram" class="form-select shadow-none"
                    style="font-size: 15px; height: 40px; border-color: #ced4da;">
                    <option value="" selected>Programs</option>
                    <option value="BSIS">BS Information Systems</option>
                    <option value="BaPOS">BA Political Science</option>
                    <option value="BEED">Bachelor of Elementary Education</option>
                    <option value="BSTM">BS Tourism Management</option>
                </select>
            </div>
        </div>
    </div>
</div>


<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #E2E8F0 !important; border-radius: 8px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="studentMasterTable">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-4"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 120px; color: #2D3748; vertical-align: middle;">
                            Student ID
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 190px; color: #2D3748; vertical-align: middle;">
                            Full Name
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 200px; color: #2D3748; vertical-align: middle;">
                            Institutional Email
                        </th>
                        <th class="text-center"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; width: 90px; color: #2D3748; vertical-align: middle;">
                            Program
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 180px; color: #2D3748; vertical-align: middle;">
                            Department
                        </th>
                        <th class="text-center"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 110px; color: #2D3748; vertical-align: middle;">
                            Year Level
                        </th>
                        <th class="text-center"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 100px; color: #2D3748; vertical-align: middle;">
                            Section
                        </th>
                        <th class="text-center"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 110px; color: #2D3748; vertical-align: middle;">
                            Status
                        </th>
                        <th class="text-center pe-4"
                            style="font-size: 14px; font-weight: 600; padding: 14px 16px; min-width: 290px; color: #2D3748; vertical-align: middle;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px;" id="studentTableBody">
                    <tr class="student-row" data-program="BSIS" data-department="CICS" data-year="2nd Year"
                        data-status="Enrolled">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2023-01089
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">RAMOS, CARLOS M.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-semibold" style="font-size: 14px;">c.ramos@marsu.edu.ph</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BSIS</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            College of Information and Computing Sciences
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="fw-semibold text-dark">2nd Year</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge bg-light text-secondary border"
                                style="font-size: 13px; font-weight: 500;">Section A</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Enrolled</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 290px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-student-profile-1"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-student-profile-1"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Edit Permitted Details">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-archive-student-profile-1"
                                    style="border: 1px solid #dc3545; color: #dc3545; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Archive Record">
                                    <i class="bi bi-archive me-1"></i>Archive
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Student 2 -->
                    <tr class="student-row" data-program="BaPOS" data-department="CAS" data-year="2nd Year"
                        data-status="Enrolled">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2023-01042
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">SANTOS, MARIA C.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-semibold" style="font-size: 14px;">m.santos@marsu.edu.ph</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BaPOS</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            College of Arts and Sciences
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="fw-semibold text-dark">2nd Year</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge bg-light text-secondary border"
                                style="font-size: 13px; font-weight: 500;">Section B</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Enrolled</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 290px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-student-profile-2"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-student-profile-2"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Edit Permitted Details">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-archive-student-profile-2"
                                    style="border: 1px solid #dc3545; color: #dc3545; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Archive Record">
                                    <i class="bi bi-archive me-1"></i>Archive
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="student-row" data-program="BEED" data-department="CED" data-year="3rd Year"
                        data-status="Enrolled">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2022-00512
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">MENDOZA, JUAN B.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-semibold" style="font-size: 14px;">j.mendoza@marsu.edu.ph</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BEED</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            College of Education
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="fw-semibold text-dark">3rd Year</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge bg-light text-secondary border"
                                style="font-size: 13px; font-weight: 500;">Section A</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Enrolled</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 290px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-student-profile-3"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-student-profile-3"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Edit Permitted Details">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-archive-student-profile-3"
                                    style="border: 1px solid #dc3545; color: #dc3545; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Archive Record">
                                    <i class="bi bi-archive me-1"></i>Archive
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="student-row" data-program="BSTM" data-department="CBA" data-year="1st Year"
                        data-status="Enrolled">
                        <td class="ps-4 fw-semibold"
                            style="padding: 15px 18px; color: #800020; vertical-align: middle;">
                            2024-03115
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <div class="fw-bold text-dark" style="font-size: 15px;">DELA CRUZ, BEA L.</div>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;">
                            <span class="text-dark fw-semibold" style="font-size: 14px;">b.delacruz@marsu.edu.ph</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #dee2e6; background-color: #fff; color: #495057; border-radius: 4px; min-width: 65px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">BSTM</span>
                        </td>
                        <td style="padding: 15px 18px; vertical-align: middle;" class="fw-semibold text-dark">
                            College of Business and Accountancy
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="fw-semibold text-dark">1st Year</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge bg-light text-secondary border"
                                style="font-size: 13px; font-weight: 500;">Section C</span>
                        </td>
                        <td class="text-center" style="padding: 15px 18px; vertical-align: middle;">
                            <span class="badge"
                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 95px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px;">Enrolled</span>
                        </td>
                        <td class="text-center pe-4"
                            style="padding: 15px 18px; vertical-align: middle; min-width: 290px;">
                            <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-student-profile-4"
                                    style="border: 1px solid #800020; color: #800020; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="View Full Detailed Profile">
                                    <i class="bi bi-eye me-1"></i>View
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-student-profile-4"
                                    style="border: 1px solid #d4a017; color: #856404; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Edit Permitted Details">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                <button type="button"
                                    class="btn btn-sm shadow-none d-inline-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modal-archive-student-profile-4"
                                    style="border: 1px solid #dc3545; color: #dc3545; background-color: #fff; border-radius: 4px; font-size: 13.5px; font-weight: 500; height: 34px; width: 88px; min-width: 88px; padding: 0 12px;"
                                    title="Archive Record">
                                    <i class="bi bi-archive me-1"></i>Archive
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-4 border-top"
            style="border-top: 1px solid #E2E8F0 !important;">
            <div class="text-muted" id="studentPaginationInfo" style="font-size: 15px;">
                Showing 1 to 4 of 4 records
            </div>
            <nav aria-label="Student profile pagination">
                <ul class="pagination pagination-sm mb-0 gap-1" id="studentPaginationControls">
                    <li class="page-item disabled">
                        <button class="page-link shadow-none" aria-label="Previous">&laquo;</button>
                    </li>
                    <li class="page-item active">
                        <button class="page-link shadow-none"
                            style="background-color: #800020; border-color: #800020;">1</button>
                    </li>
                    <li class="page-item disabled">
                        <button class="page-link shadow-none" aria-label="Next">&raquo;</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-student-profile-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-badge-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Comprehensive Student Profile &bull; RAMOS, CARLOS M. (2023-01089)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">

                <div class="card border shadow-sm mb-4"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                                    style="width: 60px; height: 60px; min-width: 60px; background-color: #800020; font-size: 26px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 19px;">RAMOS, CARLOS M.</h5>
                                    <div class="text-muted" style="font-size: 14.5px;">
                                        Student ID: <strong class="text-dark">2023-01089</strong> &bull; Gender: <strong
                                            class="text-dark">Male</strong> &bull; BS Information Systems &bull; 2nd
                                        Year - Section A
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge"
                                    style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 6px 16px; font-weight: 600; font-size: 13px;">Enrolled
                                    (Regular)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-pills gap-2 mb-3 flex-wrap" id="dossierTabList1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-personal-1" data-bs-toggle="pill" data-bs-target="#dossier-personal-1" type="button"
                            role="tab"
                            style="border: 1px solid #800020; background-color: #800020; color: #ffffff; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-person-fill"></i>Personal Background
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-academic-1" data-bs-toggle="pill" data-bs-target="#dossier-academic-1" type="button"
                            role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-mortarboard-fill text-primary"></i>Academic Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5" id="tab-health-1"
                            data-bs-toggle="pill" data-bs-target="#dossier-health-1" type="button" role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-heart-pulse-fill text-danger"></i>Health Information
                        </button>
                    </li>
                </ul>


                <div class="tab-content" id="dossierTabContent1">


                    <div class="tab-pane fade show active" id="dossier-personal-1" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-person-lines-fill me-2"></i>Personal Background & Contact
                                    Information
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    <i class="bi bi-calendar3 me-1"></i>Enrolled: Aug 15, 2026
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Student Number / ID</label>
                                        <div class="fw-bold text-dark p-2 rounded bg-light border">2023-01089</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">First Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Carlos</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Middle Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Mendoza</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Last Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Ramos</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Suffix</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">None (N/A)</div>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Gender</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Male</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Date of Birth</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">October 14, 2004
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Age</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">22 years old
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Contact Phone Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0917-482-9102
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Institutional Email</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">
                                            c.ramos@marsu.edu.ph</div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Emergency Contact Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0928-314-9011
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Permanent Home Address</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Barangay
                                            Murallon, Boac, Marinduque</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Parent / Legal Guardian
                                            Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Juan Ramos</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Guardian Relationship</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Father</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Enrollment & Guidance Consent
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark d-flex align-items-center gap-2"
                                            style="font-size: 14.5px;">
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                            <span>Institutional Guidance Intake Consent signed and verified on August
                                                15, 2026. Student agreed to voluntary consultation protocols in
                                                adherence to RA 9258 and RA 10173.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: ACADEMIC INFORMATION -->
                    <div class="tab-pane fade" id="dossier-academic-1" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-mortarboard me-2"></i>Academic Profile & Standing
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    SY 2026-2027 &bull; 1st Semester
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Degree Program / Course</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Bachelor of
                                            Science in Information Systems (BSIS)</div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Collegiate Department</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">College of
                                            Information and Computing Sciences (CICS)</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Year Level</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">2nd Year</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Section</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Section A</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Current School Year</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">2026 - 2027</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Enrollment Status</label>
                                        <div class="p-2 rounded bg-light border">
                                            <span class="badge"
                                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 3px 12px; font-size: 12.5px;">Enrolled
                                                (Regular)</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Academic History Summary</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Graduated Senior High School from Marinduque National High School (STEM
                                            Strand, With Honors). Completed 1st Year BSIS with 1.65 GPA, meeting all
                                            prerequisite subject benchmarks.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Relevant Academic Concerns</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Self-reported midterm project deadlines and database laboratory scheduling
                                            load. Recommended for time allocation mentoring.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Authorized Academic Progress
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Cumulative GWA: <strong>1.68</strong> &bull; Total Units Passed: <strong>48
                                                Units</strong> &bull; Academic Deficiencies: <strong>None</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: HEALTH INFORMATION (USER EXPLICIT FIELDS) -->
                    <div class="tab-pane fade" id="dossier-health-1" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                        <i class="bi bi-shield-lock-fill text-danger me-2"></i>Student Health &
                                        Accommodation Records
                                    </h6>
                                </div>
                                <span class="badge"
                                    style="background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e; font-size: 12.5px;">
                                    <i class="bi bi-lock-fill me-1"></i>Confidential &bull; RA 10173 Protected
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-light border d-flex align-items-center gap-2 mb-3 py-2 px-3 text-muted"
                                    style="font-size: 14px;">
                                    <i class="bi bi-info-circle text-primary fs-5"></i>
                                    <span>Health data is stored separately from ordinary profile data. Access is
                                        strictly limited to authorized guidance personnel and school physicians.</span>
                                </div>
                                <div class="row g-3">
                                    <!-- Field 1: Name of the Student -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Name of the
                                            Student</label>
                                        <div class="fw-bold text-dark p-2.5 rounded bg-light border">Carlos M. Ramos
                                        </div>
                                    </div>
                                    <!-- Field: Gender -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Gender</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Male</div>
                                    </div>
                                    <!-- Field 2: Allergies -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Allergies</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">None reported
                                        </div>
                                    </div>
                                    <!-- Field 3: Medical Conditions -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Medical
                                            Conditions</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Occasional
                                            tension headaches during midterm examination periods</div>
                                    </div>
                                    <!-- Field 4: Current Medications -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Current
                                            Medications</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">None prescribed
                                            / Paracetamol taken as needed</div>
                                    </div>
                                    <!-- Field 5: Special Assistance Needs -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Special Assistance
                                            Needs</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Prefers
                                            well-lit front desk for note-taking</div>
                                    </div>
                                    <!-- Field 6: Updated -->
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Updated (Health Record
                                            Timestamp)</label>
                                        <div
                                            class="fw-semibold text-dark p-2.5 rounded bg-light border d-flex align-items-center justify-content-between">
                                            <span>September 15, 2026 &bull; Verified via MarSU Health Services Clinic
                                                Intake</span>
                                            <span class="badge bg-success" style="font-size: 12px;">Verified
                                                Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-3 shadow-none" data-bs-dismiss="modal"
                    style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 1.2: VIEW STUDENT PROFILE — MARIA C. SANTOS (2023-01042)     -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-student-profile-2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-badge-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Comprehensive Student Profile &bull; SANTOS, MARIA C. (2023-01042)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">

                <div class="card border shadow-sm mb-4"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                                    style="width: 60px; height: 60px; min-width: 60px; background-color: #800020; font-size: 26px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 19px;">SANTOS, MARIA C.</h5>
                                    <div class="text-muted" style="font-size: 14.5px;">
                                        Student ID: <strong class="text-dark">2023-01042</strong> &bull; Gender: <strong
                                            class="text-dark">Female</strong> &bull; BA Political Science &bull; 2nd
                                        Year - Section B
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge"
                                    style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 6px 16px; font-weight: 600; font-size: 13px;">Enrolled
                                    (Regular)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-pills gap-2 mb-3 flex-wrap" id="dossierTabList2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-personal-2" data-bs-toggle="pill" data-bs-target="#dossier-personal-2" type="button"
                            role="tab"
                            style="border: 1px solid #800020; background-color: #800020; color: #ffffff; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-person-fill"></i>Personal Background
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-academic-2" data-bs-toggle="pill" data-bs-target="#dossier-academic-2" type="button"
                            role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-mortarboard-fill text-primary"></i>Academic Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5" id="tab-health-2"
                            data-bs-toggle="pill" data-bs-target="#dossier-health-2" type="button" role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-heart-pulse-fill text-danger"></i>Health Information
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="dossierTabContent2">
                    <!-- TAB 1: PERSONAL BACKGROUND -->
                    <div class="tab-pane fade show active" id="dossier-personal-2" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-person-lines-fill me-2"></i>Personal Background & Contact
                                    Information
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    <i class="bi bi-calendar3 me-1"></i>Enrolled: Aug 18, 2026
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Student Number / ID</label>
                                        <div class="fw-bold text-dark p-2 rounded bg-light border">2023-01042</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">First Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Maria</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Middle Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Cruz</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Last Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Santos</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Suffix</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">None (N/A)</div>
                                    </div>
                                    <!-- GENDER FIELD -->
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Gender</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Female</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Date of Birth</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">July 22, 2004
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Age</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">22 years old
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Contact Phone Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0918-294-8103
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Institutional Email</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">
                                            m.santos@marsu.edu.ph</div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Emergency Contact Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0919-876-5432
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Permanent Home Address</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Barangay Tampus,
                                            Boac, Marinduque</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Parent / Legal Guardian
                                            Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Elena Santos
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Guardian Relationship</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Mother</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Enrollment & Guidance Consent
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark d-flex align-items-center gap-2"
                                            style="font-size: 14.5px;">
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                            <span>Institutional Guidance Intake Consent signed and verified on August
                                                18, 2026. Student agreed to voluntary consultation protocols in
                                                adherence to RA 9258 and RA 10173.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: ACADEMIC INFORMATION -->
                    <div class="tab-pane fade" id="dossier-academic-2" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-mortarboard me-2"></i>Academic Profile & Standing
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    SY 2026-2027 &bull; 1st Semester
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Degree Program / Course</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Bachelor of Arts
                                            in Political Science (BaPOS)</div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Collegiate Department</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">College of Arts
                                            and Sciences (CAS)</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Year Level</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">2nd Year</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Section</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Section B</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Current School Year</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">2026 - 2027</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Enrollment Status</label>
                                        <div class="p-2 rounded bg-light border">
                                            <span class="badge"
                                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 3px 12px; font-size: 12.5px;">Enrolled
                                                (Regular)</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Academic History Summary</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Graduated Senior High School from Marinduque Academy (HUMSS Strand).
                                            Consistently maintains high academic performance with current Dean's List
                                            standing.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Relevant Academic Concerns</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Interested in student leadership engagement balance and study schedule
                                            prioritization.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Authorized Academic Progress
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Cumulative GWA: <strong>1.54</strong> &bull; Total Units Passed: <strong>51
                                                Units</strong> &bull; Academic Deficiencies: <strong>None</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: HEALTH INFORMATION (USER EXPLICIT FIELDS) -->
                    <div class="tab-pane fade" id="dossier-health-2" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                        <i class="bi bi-shield-lock-fill text-danger me-2"></i>Student Health &
                                        Accommodation Records
                                    </h6>
                                </div>
                                <span class="badge"
                                    style="background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e; font-size: 12.5px;">
                                    <i class="bi bi-lock-fill me-1"></i>Confidential &bull; RA 10173 Protected
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-light border d-flex align-items-center gap-2 mb-3 py-2 px-3 text-muted"
                                    style="font-size: 14px;">
                                    <i class="bi bi-info-circle text-primary fs-5"></i>
                                    <span>Health data is stored separately from ordinary profile data. Access is
                                        strictly limited to authorized guidance personnel and school physicians.</span>
                                </div>
                                <div class="row g-3">
                                    <!-- Field 1: Name of the Student -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Name of the
                                            Student</label>
                                        <div class="fw-bold text-dark p-2.5 rounded bg-light border">Maria C. Santos
                                        </div>
                                    </div>
                                    <!-- Field: Gender -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Gender</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Female</div>
                                    </div>
                                    <!-- Field 2: Allergies -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Allergies</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Mild dust and
                                            pollen allergy</div>
                                    </div>
                                    <!-- Field 3: Medical Conditions -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Medical
                                            Conditions</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">None reported
                                        </div>
                                    </div>
                                    <!-- Field 4: Current Medications -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Current
                                            Medications</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Antihistamine
                                            (Cetirizine) as needed during allergy flare-ups</div>
                                    </div>
                                    <!-- Field 5: Special Assistance Needs -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Special Assistance
                                            Needs</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Seating away
                                            from open windows and chalkboards recommended</div>
                                    </div>
                                    <!-- Field 6: Updated -->
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Updated (Health Record
                                            Timestamp)</label>
                                        <div
                                            class="fw-semibold text-dark p-2.5 rounded bg-light border d-flex align-items-center justify-content-between">
                                            <span>August 28, 2026 &bull; Verified via MarSU Health Services Clinic
                                                Intake</span>
                                            <span class="badge bg-success" style="font-size: 12px;">Verified
                                                Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-3 shadow-none" data-bs-dismiss="modal"
                    style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 1.3: VIEW STUDENT PROFILE — JUAN B. MENDOZA (2022-00512)     -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-student-profile-3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-badge-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Comprehensive Student Profile &bull; MENDOZA, JUAN B. (2022-00512)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">

                <div class="card border shadow-sm mb-4"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                                    style="width: 60px; height: 60px; min-width: 60px; background-color: #800020; font-size: 26px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 19px;">MENDOZA, JUAN B.</h5>
                                    <div class="text-muted" style="font-size: 14.5px;">
                                        Student ID: <strong class="text-dark">2022-00512</strong> &bull; Gender: <strong
                                            class="text-dark">Male</strong> &bull; Bachelor of Elementary Education
                                        &bull; 3rd Year - Section A
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge"
                                    style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 6px 16px; font-weight: 600; font-size: 13px;">Enrolled
                                    (Regular)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-pills gap-2 mb-3 flex-wrap" id="dossierTabList3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-personal-3" data-bs-toggle="pill" data-bs-target="#dossier-personal-3" type="button"
                            role="tab"
                            style="border: 1px solid #800020; background-color: #800020; color: #ffffff; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-person-fill"></i>Personal Background
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-academic-3" data-bs-toggle="pill" data-bs-target="#dossier-academic-3" type="button"
                            role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-mortarboard-fill text-primary"></i>Academic Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5" id="tab-health-3"
                            data-bs-toggle="pill" data-bs-target="#dossier-health-3" type="button" role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-heart-pulse-fill text-danger"></i>Health Information
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="dossierTabContent3">
                    <!-- TAB 1: PERSONAL BACKGROUND -->
                    <div class="tab-pane fade show active" id="dossier-personal-3" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-person-lines-fill me-2"></i>Personal Background & Contact
                                    Information
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    <i class="bi bi-calendar3 me-1"></i>Enrolled: Aug 12, 2026
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Student Number / ID</label>
                                        <div class="fw-bold text-dark p-2 rounded bg-light border">2022-00512</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">First Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Juan</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Middle Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Bautista</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Last Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Mendoza</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Suffix</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Jr.</div>
                                    </div>
                                    <!-- GENDER FIELD -->
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Gender</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Male</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Date of Birth</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">March 05, 2003
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Age</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">23 years old
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Contact Phone Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0920-512-3498
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Institutional Email</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">
                                            j.mendoza@marsu.edu.ph</div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Emergency Contact Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0921-998-7712
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Permanent Home Address</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Barangay
                                            Bunganay, Boac, Marinduque</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Parent / Legal Guardian
                                            Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Juan Mendoza Sr.
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Guardian Relationship</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Father</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Enrollment & Guidance Consent
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark d-flex align-items-center gap-2"
                                            style="font-size: 14.5px;">
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                            <span>Institutional Guidance Intake Consent signed and verified on August
                                                12, 2026. Student agreed to voluntary consultation protocols in
                                                adherence to RA 9258 and RA 10173.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: ACADEMIC INFORMATION -->
                    <div class="tab-pane fade" id="dossier-academic-3" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-mortarboard me-2"></i>Academic Profile & Standing
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    SY 2026-2027 &bull; 1st Semester
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Degree Program / Course</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Bachelor of
                                            Elementary Education (BEED)</div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Collegiate Department</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">College of
                                            Education (CED)</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Year Level</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">3rd Year</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Section</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Section A</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Current School Year</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">2026 - 2027</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Enrollment Status</label>
                                        <div class="p-2 rounded bg-light border">
                                            <span class="badge"
                                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 3px 12px; font-size: 12.5px;">Enrolled
                                                (Regular)</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Academic History Summary</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Enrolled in Teacher Education curriculum. Completed teaching demonstration
                                            field requirements with positive supervisory evaluations.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Relevant Academic Concerns</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Field observation schedule coordination with off-campus partner elementary
                                            schools.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Authorized Academic Progress
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Cumulative GWA: <strong>1.72</strong> &bull; Total Units Passed: <strong>78
                                                Units</strong> &bull; Academic Deficiencies: <strong>None</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: HEALTH INFORMATION (USER EXPLICIT FIELDS) -->
                    <div class="tab-pane fade" id="dossier-health-3" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                        <i class="bi bi-shield-lock-fill text-danger me-2"></i>Student Health &
                                        Accommodation Records
                                    </h6>
                                </div>
                                <span class="badge"
                                    style="background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e; font-size: 12.5px;">
                                    <i class="bi bi-lock-fill me-1"></i>Confidential &bull; RA 10173 Protected
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-light border d-flex align-items-center gap-2 mb-3 py-2 px-3 text-muted"
                                    style="font-size: 14px;">
                                    <i class="bi bi-info-circle text-primary fs-5"></i>
                                    <span>Health data is stored separately from ordinary profile data. Access is
                                        strictly limited to authorized guidance personnel and school physicians.</span>
                                </div>
                                <div class="row g-3">
                                    <!-- Field 1: Name of the Student -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Name of the
                                            Student</label>
                                        <div class="fw-bold text-dark p-2.5 rounded bg-light border">Juan B. Mendoza
                                        </div>
                                    </div>
                                    <!-- Field: Gender -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Gender</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Male</div>
                                    </div>
                                    <!-- Field 2: Allergies -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Allergies</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Mild seafood
                                            allergy</div>
                                    </div>
                                    <!-- Field 3: Medical Conditions -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Medical
                                            Conditions</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Mild
                                            exercise-induced asthma</div>
                                    </div>
                                    <!-- Field 4: Current Medications -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Current
                                            Medications</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Inhaler
                                            (Salbutamol) carried for physical activity sessions</div>
                                    </div>
                                    <!-- Field 5: Special Assistance Needs -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Special Assistance
                                            Needs</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Requires
                                            well-ventilated counseling and exam environments</div>
                                    </div>
                                    <!-- Field 6: Updated -->
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Updated (Health Record
                                            Timestamp)</label>
                                        <div
                                            class="fw-semibold text-dark p-2.5 rounded bg-light border d-flex align-items-center justify-content-between">
                                            <span>September 02, 2026 &bull; Verified via MarSU Health Services Clinic
                                                Intake</span>
                                            <span class="badge bg-success" style="font-size: 12px;">Verified
                                                Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-3 shadow-none" data-bs-dismiss="modal"
                    style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 1.4: VIEW STUDENT PROFILE — BEA L. DELA CRUZ (2024-03115)    -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-view-student-profile-4" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-badge-fill text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Comprehensive Student Profile &bull; DELA CRUZ, BEA L. (2024-03115)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">

                <div class="card border shadow-sm mb-4"
                    style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                                    style="width: 60px; height: 60px; min-width: 60px; background-color: #800020; font-size: 26px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 19px;">DELA CRUZ, BEA L.</h5>
                                    <div class="text-muted" style="font-size: 14.5px;">
                                        Student ID: <strong class="text-dark">2024-03115</strong> &bull; Gender: <strong
                                            class="text-dark">Female</strong> &bull; BS Tourism Management &bull; 1st
                                        Year - Section C
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge"
                                    style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 6px 16px; font-weight: 600; font-size: 13px;">Enrolled
                                    (Regular)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-pills gap-2 mb-3 flex-wrap" id="dossierTabList4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-personal-4" data-bs-toggle="pill" data-bs-target="#dossier-personal-4" type="button"
                            role="tab"
                            style="border: 1px solid #800020; background-color: #800020; color: #ffffff; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-person-fill"></i>Personal Background
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5"
                            id="tab-academic-4" data-bs-toggle="pill" data-bs-target="#dossier-academic-4" type="button"
                            role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-mortarboard-fill text-primary"></i>Academic Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold d-inline-flex align-items-center gap-1.5" id="tab-health-4"
                            data-bs-toggle="pill" data-bs-target="#dossier-health-4" type="button" role="tab"
                            style="border: 1px solid #E2E8F0; background-color: #ffffff; color: #4A5568; border-radius: 6px; padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-heart-pulse-fill text-danger"></i>Health Information
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="dossierTabContent4">
                    <!-- TAB 1: PERSONAL BACKGROUND -->
                    <div class="tab-pane fade show active" id="dossier-personal-4" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-person-lines-fill me-2"></i>Personal Background & Contact
                                    Information
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    <i class="bi bi-calendar3 me-1"></i>Enrolled: Aug 25, 2026
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Student Number / ID</label>
                                        <div class="fw-bold text-dark p-2 rounded bg-light border">2024-03115</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">First Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Bea</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Middle Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Lopez</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Last Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Dela Cruz</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Suffix</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">None (N/A)</div>
                                    </div>
                                    <!-- GENDER FIELD -->
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Gender</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Female</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Date of Birth</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">November 19, 2005
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Age</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">20 years old
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Contact Phone Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0915-311-5820
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Institutional Email</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">
                                            b.delacruz@marsu.edu.ph</div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="text-muted d-block small mb-1">Emergency Contact Number</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">0917-882-1402
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Permanent Home Address</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Barangay Cawit,
                                            Boac, Marinduque</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Parent / Legal Guardian
                                            Name</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Teresa Dela Cruz
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Guardian Relationship</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Mother</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Enrollment & Guidance Consent
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark d-flex align-items-center gap-2"
                                            style="font-size: 14.5px;">
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                            <span>Institutional Guidance Intake Consent signed and verified on August
                                                25, 2026. Student agreed to voluntary consultation protocols in
                                                adherence to RA 9258 and RA 10173.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: ACADEMIC INFORMATION -->
                    <div class="tab-pane fade" id="dossier-academic-4" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                    <i class="bi bi-mortarboard me-2"></i>Academic Profile & Standing
                                </h6>
                                <span class="badge bg-light text-secondary border" style="font-size: 13px;">
                                    SY 2026-2027 &bull; 1st Semester
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Degree Program / Course</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Bachelor of
                                            Science in Tourism Management (BSTM)</div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Collegiate Department</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">College of
                                            Business and Accountancy (CBA)</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Year Level</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">1st Year</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Section</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">Section C</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Current School Year</label>
                                        <div class="fw-semibold text-dark p-2 rounded bg-light border">2026 - 2027</div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="text-muted d-block small mb-1">Enrollment Status</label>
                                        <div class="p-2 rounded bg-light border">
                                            <span class="badge"
                                                style="border: 1.5px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; padding: 3px 12px; font-size: 12.5px;">Enrolled
                                                (Regular)</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1">Academic History Summary</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Enrolled as 1st year university student from Saint Mary's College of
                                            Marinduque (ABM Strand). Actively participating in collegiate tourism
                                            orientation assemblies.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Relevant Academic Concerns</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            First semester adjustment support and peer mentoring for college study
                                            methods.
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1">Authorized Academic Progress
                                            Information</label>
                                        <div class="p-2.5 rounded bg-light border text-dark" style="font-size: 14.5px;">
                                            Cumulative GWA: <strong>1.62</strong> &bull; Total Units Passed: <strong>24
                                                Units</strong> &bull; Academic Deficiencies: <strong>None</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: HEALTH INFORMATION (USER EXPLICIT FIELDS) -->
                    <div class="tab-pane fade" id="dossier-health-4" role="tabpanel">
                        <div class="card border shadow-sm"
                            style="border-color: #E2E8F0 !important; border-radius: 10px; background-color: #ffffff;">
                            <div
                                class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0 fw-bold" style="color: #800020; font-size: 16px;">
                                        <i class="bi bi-shield-lock-fill text-danger me-2"></i>Student Health &
                                        Accommodation Records
                                    </h6>
                                </div>
                                <span class="badge"
                                    style="background-color: #fdfbe8; color: #856404; border: 1px solid #f6e05e; font-size: 12.5px;">
                                    <i class="bi bi-lock-fill me-1"></i>Confidential &bull; RA 10173 Protected
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-light border d-flex align-items-center gap-2 mb-3 py-2 px-3 text-muted"
                                    style="font-size: 14px;">
                                    <i class="bi bi-info-circle text-primary fs-5"></i>
                                    <span>Health data is stored separately from ordinary profile data. Access is
                                        strictly limited to authorized guidance personnel and school physicians.</span>
                                </div>
                                <div class="row g-3">
                                    <!-- Field 1: Name of the Student -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Name of the
                                            Student</label>
                                        <div class="fw-bold text-dark p-2.5 rounded bg-light border">Bea L. Dela Cruz
                                        </div>
                                    </div>
                                    <!-- Field: Gender -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Gender</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Female</div>
                                    </div>
                                    <!-- Field 2: Allergies -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Allergies</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Known
                                            Penicillin allergy</div>
                                    </div>
                                    <!-- Field 3: Medical Conditions -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Medical
                                            Conditions</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Chronic
                                            migraine triggered by excessive glare and screen fatigue</div>
                                    </div>
                                    <!-- Field 4: Current Medications -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Current
                                            Medications</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Prescribed
                                            migraine prophylactic medication</div>
                                    </div>
                                    <!-- Field 5: Special Assistance Needs -->
                                    <div class="col-md-6 col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Special Assistance
                                            Needs</label>
                                        <div class="fw-semibold text-dark p-2.5 rounded bg-light border">Low-glare
                                            environment during consultation and extended testing</div>
                                    </div>
                                    <!-- Field 6: Updated -->
                                    <div class="col-12">
                                        <label class="text-muted d-block small mb-1 fw-semibold">Updated (Health Record
                                            Timestamp)</label>
                                        <div
                                            class="fw-semibold text-dark p-2.5 rounded bg-light border d-flex align-items-center justify-content-between">
                                            <span>September 10, 2026 &bull; Verified via MarSU Health Services Clinic
                                                Intake</span>
                                            <span class="badge bg-success" style="font-size: 12px;">Verified
                                                Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-3 shadow-none" data-bs-dismiss="modal"
                    style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- ==================================================================== -->
<!--   MODAL 3.1: EDIT PROFILE — RAMOS, CARLOS M. (2023-01089)            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-edit-student-profile-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Edit Permitted Profile Details &bull; RAMOS, CARLOS M. (2023-01089)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="alert alert-light border text-muted d-flex align-items-center gap-2 mb-3"
                        style="font-size: 14px;">
                        <i class="bi bi-info-circle text-primary"></i>
                        <span>Student Number and Full Legal Name are synchronized with university records. Permitted
                            contact, gender, address, academic standing, and health accommodations may be updated
                            below.</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- GENDER FIELD ADDED IN EDIT -->
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Gender <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                                <option value="Non-Binary">Non-Binary</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Contact Phone Number <span
                                    class="text-danger">*</span></label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0917-482-9102"
                                required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Institutional Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm bg-white"
                                value="c.ramos@marsu.edu.ph" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Permanent Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Barangay Murallon, Boac, Marinduque" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Year Level <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year" selected>2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Section <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Section A" required
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Enrollment Status <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Enrolled" selected>Enrolled</option>
                                <option value="Leave of Absence">Leave of Absence</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Parent / Legal Guardian Name</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Juan Ramos"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Emergency Contact Number</label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0928-314-9011"
                                style="font-size: 14.5px;">
                        </div>
                        <!-- HEALTH INFORMATION FIELDS IN EDIT -->
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Allergies</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="None reported"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Medical Conditions</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Occasional tension headaches during midterm examination periods"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Current Medications</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="None prescribed / Paracetamol taken as needed" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Special Assistance Needs</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Prefers well-lit front desk for note-taking" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Reason for Profile Update <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                placeholder="Document reason for update (e.g. verified student information update)"
                                required style="font-size: 14.5px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; width: 110px; min-width: 110px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 3.2: EDIT PROFILE — SANTOS, MARIA C. (2023-01042)            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-edit-student-profile-2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Edit Permitted Profile Details &bull; SANTOS, MARIA C. (2023-01042)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="alert alert-light border text-muted d-flex align-items-center gap-2 mb-3"
                        style="font-size: 14px;">
                        <i class="bi bi-info-circle text-primary"></i>
                        <span>Student Number and Full Legal Name are synchronized with university records. Permitted
                            contact, gender, address, academic standing, and health accommodations may be updated
                            below.</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Gender <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Male">Male</option>
                                <option value="Female" selected>Female</option>
                                <option value="Non-Binary">Non-Binary</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Contact Phone Number <span
                                    class="text-danger">*</span></label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0918-294-8103"
                                required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Institutional Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm bg-white"
                                value="m.santos@marsu.edu.ph" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Permanent Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Barangay Tampus, Boac, Marinduque" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Year Level <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year" selected>2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Section <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Section B" required
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Enrollment Status <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Enrolled" selected>Enrolled</option>
                                <option value="Leave of Absence">Leave of Absence</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Parent / Legal Guardian Name</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Elena Santos"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Emergency Contact Number</label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0919-876-5432"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Allergies</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Mild dust and pollen allergy" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Medical Conditions</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="None reported"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Current Medications</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Antihistamine (Cetirizine) as needed" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Special Assistance Needs</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Seating away from open windows and chalkboards recommended"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Reason for Profile Update <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                placeholder="Document reason for update" required style="font-size: 14.5px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; width: 110px; min-width: 110px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 3.3: EDIT PROFILE — MENDOZA, JUAN B. (2022-00512)            -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-edit-student-profile-3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Edit Permitted Profile Details &bull; MENDOZA, JUAN B. (2022-00512)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="alert alert-light border text-muted d-flex align-items-center gap-2 mb-3"
                        style="font-size: 14px;">
                        <i class="bi bi-info-circle text-primary"></i>
                        <span>Student Number and Full Legal Name are synchronized with university records. Permitted
                            contact, gender, address, academic standing, and health accommodations may be updated
                            below.</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Gender <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                                <option value="Non-Binary">Non-Binary</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Contact Phone Number <span
                                    class="text-danger">*</span></label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0920-512-3498"
                                required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Institutional Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm bg-white"
                                value="j.mendoza@marsu.edu.ph" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Permanent Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Barangay Bunganay, Boac, Marinduque" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Year Level <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year" selected>3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Section <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Section A" required
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Enrollment Status <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Enrolled" selected>Enrolled</option>
                                <option value="Leave of Absence">Leave of Absence</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Parent / Legal Guardian Name</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Juan Mendoza Sr."
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Emergency Contact Number</label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0921-998-7712"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Allergies</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Mild seafood allergy" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Medical Conditions</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Mild exercise-induced asthma" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Current Medications</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Inhaler (Salbutamol) as needed" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Special Assistance Needs</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Requires well-ventilated counseling room" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Reason for Profile Update <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                placeholder="Document reason for update" required style="font-size: 14.5px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; width: 110px; min-width: 110px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 3.4: EDIT PROFILE — DELA CRUZ, BEA L. (2024-03115)           -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-edit-student-profile-4" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Edit Permitted Profile Details &bull; DELA CRUZ, BEA L. (2024-03115)
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="alert alert-light border text-muted d-flex align-items-center gap-2 mb-3"
                        style="font-size: 14px;">
                        <i class="bi bi-info-circle text-primary"></i>
                        <span>Student Number and Full Legal Name are synchronized with university records. Permitted
                            contact, gender, address, academic standing, and health accommodations may be updated
                            below.</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Gender <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Male">Male</option>
                                <option value="Female" selected>Female</option>
                                <option value="Non-Binary">Non-Binary</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Contact Phone Number <span
                                    class="text-danger">*</span></label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0915-311-5820"
                                required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Institutional Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm bg-white"
                                value="b.delacruz@marsu.edu.ph" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Permanent Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Barangay Cawit, Boac, Marinduque" required style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Year Level <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="1st Year" selected>1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Section <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Section C" required
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Enrollment Status <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                                <option value="Enrolled" selected>Enrolled</option>
                                <option value="Leave of Absence">Leave of Absence</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Parent / Legal Guardian Name</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Teresa Dela Cruz"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Emergency Contact Number</label>
                            <input type="tel" class="form-control form-control-sm bg-white" value="0917-882-1402"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Allergies</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Known Penicillin allergy" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Medical Conditions</label>
                            <input type="text" class="form-control form-control-sm bg-white" value="Chronic migraine"
                                style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Current Medications</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Prescribed migraine prophylactic" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted">Special Assistance Needs</label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                value="Low-glare environment during consultation" style="font-size: 14.5px;">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold text-muted">Reason for Profile Update <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm bg-white"
                                placeholder="Document reason for update" required style="font-size: 14.5px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; width: 110px; min-width: 110px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-save me-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 4.1: ARCHIVE RECORD — RAMOS, CARLOS M. (2023-01089)          -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-archive-student-profile-1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #dc3545;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-archive-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Archive Student Record &bull; 2023-01089
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="p-3 bg-white border rounded mb-3">
                        <div class="d-flex gap-2.5">
                            <i class="bi bi-shield-exclamation text-warning fs-4"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 14.5px;">Institutional Guidance
                                    Retention Policy</strong>
                                <span class="text-muted small">
                                    In adherence to the Guidance and Counseling Act (RA 9258), student profiles with
                                    past or active counseling history <strong>cannot be permanently deleted</strong>.
                                    Archiving safely stores the profile while strictly preserving all confidential case
                                    files for authorized reference.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- STUDENT CONFIRMATION SUMMARY WITH GENDER -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Student Record</label>
                        <div class="p-2.5 bg-light border rounded">
                            <div class="fw-bold text-dark" style="font-size: 15px;">RAMOS, CARLOS M. (2023-01089)</div>
                            <div class="text-muted mt-1" style="font-size: 14px;">
                                Gender: <strong class="text-dark">Male</strong> &bull; Program: <strong
                                    class="text-dark">BSIS (2nd Year)</strong> &bull; Status: <strong
                                    class="text-dark">Enrolled</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Reason for Archiving <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                            <option value="">Select Archiving Reason...</option>
                            <option value="Graduated">Student Successfully Graduated</option>
                            <option value="Transferred">Transferred to Another University</option>
                            <option value="Extended Leave">Prolonged Non-Enrollment / Extended LOA</option>
                            <option value="Record Consolidated">Duplicate Entry Consolidated</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted">Archiving Documentation Notes</label>
                        <textarea class="form-control form-control-sm bg-white" rows="2"
                            placeholder="Specify graduation clearance notes or transfer documentation..."
                            style="font-size: 14.5px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; font-weight: 500; height: 34px; width: 130px; min-width: 130px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-archive me-1"></i>Confirm Archive
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 4.2: ARCHIVE RECORD — SANTOS, MARIA C. (2023-01042)          -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-archive-student-profile-2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #dc3545;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-archive-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Archive Student Record &bull; 2023-01042
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="p-3 bg-white border rounded mb-3">
                        <div class="d-flex gap-2.5">
                            <i class="bi bi-shield-exclamation text-warning fs-4"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 14.5px;">Institutional Guidance
                                    Retention Policy</strong>
                                <span class="text-muted small">
                                    In adherence to the Guidance and Counseling Act (RA 9258), student profiles with
                                    past or active counseling history <strong>cannot be permanently deleted</strong>.
                                    Archiving safely stores the profile while strictly preserving all confidential case
                                    files for authorized reference.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- STUDENT CONFIRMATION SUMMARY WITH GENDER -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Student Record</label>
                        <div class="p-2.5 bg-light border rounded">
                            <div class="fw-bold text-dark" style="font-size: 15px;">SANTOS, MARIA C. (2023-01042)</div>
                            <div class="text-muted mt-1" style="font-size: 14px;">
                                Gender: <strong class="text-dark">Female</strong> &bull; Program: <strong
                                    class="text-dark">BaPOS (2nd Year)</strong> &bull; Status: <strong
                                    class="text-dark">Enrolled</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Reason for Archiving <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                            <option value="">Select Archiving Reason...</option>
                            <option value="Graduated">Student Successfully Graduated</option>
                            <option value="Transferred">Transferred to Another University</option>
                            <option value="Extended Leave">Prolonged Non-Enrollment / Extended LOA</option>
                            <option value="Record Consolidated">Duplicate Entry Consolidated</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted">Archiving Documentation Notes</label>
                        <textarea class="form-control form-control-sm bg-white" rows="2"
                            placeholder="Specify graduation clearance notes or transfer documentation..."
                            style="font-size: 14.5px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; font-weight: 500; height: 34px; width: 130px; min-width: 130px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-archive me-1"></i>Confirm Archive
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 4.3: ARCHIVE RECORD — MENDOZA, JUAN B. (2022-00512)          -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-archive-student-profile-3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #dc3545;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-archive-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Archive Student Record &bull; 2022-00512
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="p-3 bg-white border rounded mb-3">
                        <div class="d-flex gap-2.5">
                            <i class="bi bi-shield-exclamation text-warning fs-4"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 14.5px;">Institutional Guidance
                                    Retention Policy</strong>
                                <span class="text-muted small">
                                    In adherence to the Guidance and Counseling Act (RA 9258), student profiles with
                                    past or active counseling history <strong>cannot be permanently deleted</strong>.
                                    Archiving safely stores the profile while strictly preserving all confidential case
                                    files for authorized reference.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- STUDENT CONFIRMATION SUMMARY WITH GENDER -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Student Record</label>
                        <div class="p-2.5 bg-light border rounded">
                            <div class="fw-bold text-dark" style="font-size: 15px;">MENDOZA, JUAN B. (2022-00512)</div>
                            <div class="text-muted mt-1" style="font-size: 14px;">
                                Gender: <strong class="text-dark">Male</strong> &bull; Program: <strong
                                    class="text-dark">BEED (3rd Year)</strong> &bull; Status: <strong
                                    class="text-dark">Enrolled</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Reason for Archiving <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                            <option value="">Select Archiving Reason...</option>
                            <option value="Graduated">Student Successfully Graduated</option>
                            <option value="Transferred">Transferred to Another University</option>
                            <option value="Extended Leave">Prolonged Non-Enrollment / Extended LOA</option>
                            <option value="Record Consolidated">Duplicate Entry Consolidated</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted">Archiving Documentation Notes</label>
                        <textarea class="form-control form-control-sm bg-white" rows="2"
                            placeholder="Specify graduation clearance notes or transfer documentation..."
                            style="font-size: 14.5px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; font-weight: 500; height: 34px; width: 130px; min-width: 130px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-archive me-1"></i>Confirm Archive
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 4.4: ARCHIVE RECORD — DELA CRUZ, BEA L. (2024-03115)         -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-archive-student-profile-4" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #dc3545;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-archive-fill text-white fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Archive Student Record &bull; 2024-03115
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="p-3 bg-white border rounded mb-3">
                        <div class="d-flex gap-2.5">
                            <i class="bi bi-shield-exclamation text-warning fs-4"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 14.5px;">Institutional Guidance
                                    Retention Policy</strong>
                                <span class="text-muted small">
                                    In adherence to the Guidance and Counseling Act (RA 9258), student profiles with
                                    past or active counseling history <strong>cannot be permanently deleted</strong>.
                                    Archiving safely stores the profile while strictly preserving all confidential case
                                    files for authorized reference.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- STUDENT CONFIRMATION SUMMARY WITH GENDER -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Student Record</label>
                        <div class="p-2.5 bg-light border rounded">
                            <div class="fw-bold text-dark" style="font-size: 15px;">DELA CRUZ, BEA L. (2024-03115)</div>
                            <div class="text-muted mt-1" style="font-size: 14px;">
                                Gender: <strong class="text-dark">Female</strong> &bull; Program: <strong
                                    class="text-dark">BSTM (1st Year)</strong> &bull; Status: <strong
                                    class="text-dark">Enrolled</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Reason for Archiving <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm bg-white" required style="font-size: 14.5px;">
                            <option value="">Select Archiving Reason...</option>
                            <option value="Graduated">Student Successfully Graduated</option>
                            <option value="Transferred">Transferred to Another University</option>
                            <option value="Extended Leave">Prolonged Non-Enrollment / Extended LOA</option>
                            <option value="Record Consolidated">Duplicate Entry Consolidated</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted">Archiving Documentation Notes</label>
                        <textarea class="form-control form-control-sm bg-white" rows="2"
                            placeholder="Specify graduation clearance notes or transfer documentation..."
                            style="font-size: 14.5px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; font-weight: 500; height: 34px; width: 130px; min-width: 130px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-archive me-1"></i>Confirm Archive
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================================================== -->
<!--   MODAL 5: IMPORT STUDENTS CSV (VALIDATED TEMPLATE)                  -->
<!-- ==================================================================== -->
<div class="modal fade" id="modal-import-student-csv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header text-white px-4 py-3" style="background-color: #800020;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-spreadsheet text-warning fs-5"></i>
                    <h5 class="modal-title m-0 fw-semibold" style="font-size: 16px;">
                        Import Students from Validated CSV
                    </h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST" action="#">
                <?= csrf_field() ?>
                <div class="modal-body p-4" style="font-size: 15px; background-color: #f8f9fa;">
                    <div class="p-3 bg-white border rounded mb-3">
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 14.5px;">Validated CSV Template Structure
                        </h6>
                        <p class="text-muted small mb-2">
                            Please use the official MarSU Student Directory format:
                            <code>student_id, full_name, institutional_email, gender, program, department, year_level, section, status</code>.
                            Duplicate student IDs are validated upon upload.
                        </p>
                        <a href="#"
                            class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1 shadow-none"
                            style="font-size: 12.5px; height: 30px;">
                            <i class="bi bi-download"></i>Download Sample CSV Template
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Select CSV File <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control form-control-sm bg-white" accept=".csv" required
                            style="font-size: 14.5px;">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="validateDuplicates" checked>
                        <label class="form-check-label small text-muted" for="validateDuplicates">
                            Validate and prevent duplicate student ID numbers during import
                        </label>
                    </div>
                </div>
                <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="font-size: 13.5px; height: 34px; width: 88px; min-width: 88px; border-radius: 4px; padding: 0 12px;">Cancel</button>
                    <button type="button" class="btn text-white btn-sm px-3 shadow-none" data-bs-dismiss="modal"
                        style="background-color: #800020; border: 1px solid #800020; font-size: 13.5px; font-weight: 500; height: 34px; width: 140px; min-width: 140px; border-radius: 4px; padding: 0 12px;">
                        <i class="bi bi-upload me-1"></i>Upload & Validate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
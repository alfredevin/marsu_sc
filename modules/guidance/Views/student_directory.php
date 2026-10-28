<!-- ==================================================================== -->
<!--   MARSU GUIDANCE & COUNSELING SYSTEM: STUDENT DIRECTORY              -->
<!-- ==================================================================== -->

<!-- 1. STUDENT PROFILE MANAGEMENT HEADER -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <!-- Breadcrumb Trail -->
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb mb-0"
                style="font-size: 14.5px; background: transparent; padding: 0; line-height: 1.5;">
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance') ?>" style="color: #800020; text-decoration: none; font-weight: 600;">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= url('guidance/student_directory') ?>"
                        style="color: #800020; text-decoration: none; font-weight: 500;">
                        Student Information Management
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Student Directory
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-1">
            <div>
                <h4 class="fw-bold mb-1" style="color: #1A202C; font-size: 22px; letter-spacing: -0.2px;">
                    Student Directory
                </h4>
                <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.5;">
                    Manage student directory, academic backgrounds, health accommodations, and historical records.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. SEARCH & PROGRAM FILTER TOOLBAR -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-4">
        <div class="row g-3 align-items-center">
            <!-- Search Bar -->
            <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-muted bg-white ps-3"
                        style="border-color: #ced4da; font-size: 15px; height: 42px; border-radius: 8px 0 0 8px;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 shadow-none ps-2 bg-white"
                        placeholder="Search by Student ID, Full Name, or Email..."
                        oninput="const q=this.value.toLowerCase(); document.querySelectorAll('.student-row').forEach(r => r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none');"
                        style="border-color: #ced4da; font-size: 14.5px; height: 42px; border-radius: 0 8px 8px 0;">
                </div>
            </div>

            <!-- Program Filter Dropdown -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                <div class="dropdown">
                    <button
                        class="btn bg-white border d-flex align-items-center justify-content-between w-100 shadow-none text-dark"
                        type="button" id="programFilterBtn" data-bs-toggle="dropdown" aria-expanded="false"
                        onclick="const i=this.querySelector('#programFilterArrow'); setTimeout(() => { const o = this.getAttribute('aria-expanded')==='true'; if(i) i.className = o ? 'bi bi-chevron-up text-muted ms-2' : 'bi bi-chevron-down text-muted ms-2'; }, 10);"
                        onblur="setTimeout(() => { const i = document.getElementById('programFilterArrow'); if(i) i.className = 'bi bi-chevron-down text-muted ms-2'; }, 200);"
                        style="height: 42px; font-size: 14.5px; border-color: #ced4da; border-radius: 8px; padding: 0 16px;">
                        <span id="selectedProgramLabel">Programs</span>
                        <i class="bi bi-chevron-down text-muted ms-2" id="programFilterArrow"
                            style="font-size: 13px;"></i>
                    </button>
                    <ul class="dropdown-menu shadow-sm border w-100 py-1"
                        style="border-color: #E2E8F0; border-radius: 8px; font-size: 14.5px;">
                        <li><a class="dropdown-item py-2 fw-semibold" href="#"
                                onclick="document.getElementById('selectedProgramLabel').textContent='Programs'; const i=document.getElementById('programFilterArrow'); if(i) i.className='bi bi-chevron-down text-muted ms-2'; document.querySelectorAll('.student-row').forEach(r => r.style.display='');">All
                                Programs</a></li>
                        <li><a class="dropdown-item py-2" href="#"
                                onclick="document.getElementById('selectedProgramLabel').textContent=this.textContent.trim(); const i=document.getElementById('programFilterArrow'); if(i) i.className='bi bi-chevron-down text-muted ms-2'; document.querySelectorAll('.student-row').forEach(r => r.style.display = r.dataset.program === 'BSIS' ? '' : 'none');">BS
                                Information Systems</a></li>
                        <li><a class="dropdown-item py-2" href="#"
                                onclick="document.getElementById('selectedProgramLabel').textContent=this.textContent.trim(); const i=document.getElementById('programFilterArrow'); if(i) i.className='bi bi-chevron-down text-muted ms-2'; document.querySelectorAll('.student-row').forEach(r => r.style.display = r.dataset.program === 'BaPOS' ? '' : 'none');">BA
                                Political Science</a></li>
                        <li><a class="dropdown-item py-2" href="#"
                                onclick="document.getElementById('selectedProgramLabel').textContent=this.textContent.trim(); const i=document.getElementById('programFilterArrow'); if(i) i.className='bi bi-chevron-down text-muted ms-2'; document.querySelectorAll('.student-row').forEach(r => r.style.display = r.dataset.program === 'BEED' ? '' : 'none');">Bachelor
                                of Elementary Education</a></li>
                        <li><a class="dropdown-item py-2" href="#"
                                onclick="document.getElementById('selectedProgramLabel').textContent=this.textContent.trim(); const i=document.getElementById('programFilterArrow'); if(i) i.className='bi bi-chevron-down text-muted ms-2'; document.querySelectorAll('.student-row').forEach(r => r.style.display = r.dataset.program === 'BSTM' ? '' : 'none');">BS
                                Tourism Management</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 3. STUDENT DIRECTORY TABLE -->
<div class="card shadow-sm border-0 mb-4 bg-white" style="border: 1px solid #E2E8F0 !important; border-radius: 10px;">
    <div class="card-body p-0 bg-white">
        <div class="table-responsive bg-white">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="bg-white" style="border-bottom: 1px solid #E2E8F0 !important;">
                    <tr class="bg-white">
                        <th class="ps-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Student ID
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Full Name
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Email
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Program
                        </th>
                        <th class="text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Department
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Section
                        </th>
                        <th class="text-center text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Status
                        </th>
                        <th class="text-center pe-4 text-nowrap bg-white"
                            style="font-size: 13.5px; font-weight: 600; padding: 14px 18px; width: 90px; color: #2D3748; vertical-align: middle; border-bottom: 1px solid #E2E8F0 !important;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 14.5px;">
                    <!-- Student 1 -->
                    <tr class="student-row align-middle" data-program="BSIS">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2023-01089
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">RAMOS, CARLOS M.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">carlos.ramos@gmail.com</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BSIS
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Information and Computing Sciences</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                Section A
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 85px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Enrolled
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_view') ?>?id=2023-01089"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Student Profile" aria-label="View Student Profile"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Student 2 -->
                    <tr class="student-row align-middle" data-program="BaPOS">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2023-01042
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">SANTOS, MARIA C.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">maria.santos@gmail.com</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BaPOS
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Arts and Sciences</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                Section B
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 85px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Enrolled
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_view') ?>?id=2023-01042"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Student Profile" aria-label="View Student Profile"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Student 3 -->
                    <tr class="student-row align-middle" data-program="BEED">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2022-00512
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">MENDOZA, JUAN B.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">juan.mendoza@gmail.com</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BEED
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Education</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                Section A
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 85px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Enrolled
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_view') ?>?id=2022-00512"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Student Profile" aria-label="View Student Profile"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Student 4 -->
                    <tr class="student-row align-middle" data-program="BSTM">
                        <td class="ps-4 fw-bold text-nowrap"
                            style="padding: 16px 18px; color: #1A202C !important; vertical-align: middle;">
                            2024-03115
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="fw-bold text-dark">DELA CRUZ, BEA L.</span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">bea.delacruz@gmail.com</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #dee2e6; border-radius: 6px; min-width: 65px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 10px;">
                                BSTM
                            </span>
                        </td>
                        <td class="text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span class="text-dark">College of Business and Accountancy</span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center;">
                                Section C
                            </span>
                        </td>
                        <td class="text-center text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <span
                                style="border: 1px solid #28a745; background-color: #f4fbf6; color: #155724; border-radius: 50rem; min-width: 85px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 13px; padding: 2px 12px;">
                                Enrolled
                            </span>
                        </td>
                        <td class="text-center pe-4 text-nowrap" style="padding: 16px 18px; vertical-align: middle;">
                            <a href="<?= url('guidance/student_view') ?>?id=2024-03115"
                                class="btn btn-sm btn-outline-primary btn-outline-marsu shadow-none d-inline-flex align-items-center justify-content-center"
                                title="View Student Profile" aria-label="View Student Profile"
                                style="width: 36px; height: 36px; border-radius: 6px; font-size: 15px; padding: 0;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-4"
            style="border-top: 1px solid #E2E8F0 !important;">
            <div class="text-muted" style="font-size: 14px;">
                Showing 1 to 4 of 4 records
            </div>
            <nav aria-label="Student profile pagination">
                <ul class="pagination pagination-sm mb-0 gap-1">
                    <li class="page-item disabled">
                        <span class="page-link shadow-none" style="border-radius: 4px;">&laquo;</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link shadow-none"
                            style="background-color: #800020; border-color: #800020; border-radius: 4px;">1</span>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link shadow-none" style="border-radius: 4px;">&raquo;</span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
# Student Retention & Academic Risk Early Warning System (MarSU ERP · SPAMS)

**Module Slug**: `retention`  
**Database Table Prefix**: `ret_`  
**University Section**: Academic Analytics & Student Retention  
**Primary Icon**: `bi-graph-up-arrow`  
**Research Team**: SPAMS Research Group (Modules 1–3)  
**Standard Compliance**: Republic Act No. 10173 (Data Privacy Act of 2012), CHED Memorandum Orders on Academic Retention & 20% Maximum Cut Allowance

---

## 1. Architectural Overview: Three Role-Specific Portals

The Retention module implements a strict **tri-persona architecture** replacing legacy role-blind pages with dedicated, permission-fenced user experiences:

```
                                  [MarSU Centralized ERP]
                                             │
                                     /retention (Smart Router)
                                             │
             ┌───────────────────────────────┼───────────────────────────────┐
             │                               │                               │
             ▼                               ▼                               ▼
     [Student Portal]               [Faculty Workspace]              [Admin Workspace]
      /retention/my/*               /retention/faculty/*            /retention/admin/*
   ────────────────────            ─────────────────────           ───────────────────
   • Own records only              • Assigned classes only         • Term offerings & staffing
   • Read-only self-service        • Live score matrix encoding    • Institutional templates
   • Supportive advising tone      • Section pull & CSV roster     • Policy configurations
   • Masked draft marks            • GradeCalculator 1.00 - 5.00   • Grade correction review
   • CHED attendance meter         • Roll-call session attendance  • INC deadline extension
   • Confidential conduct          • Conduct incident reporting    • Attendance ledger voiding
   • RA 10173 statutory notice     • Task exceptions & drops       • Socio-academic profiling
```

---

## 2. Role-Based Access Control (RBAC) Permissions

Permissions are declared in [`module.json`](file:///c:/xampp/htdocs/marsu_sc/modules/retention/module.json) and seeded into the ERP database via [`000001_seed_retention_roles_and_permissions.php`](file:///c:/xampp/htdocs/marsu_sc/modules/retention/database/seeders/000001_seed_retention_roles_and_permissions.php):

| Permission Key | Description | Authorized Personas |
| :--- | :--- | :--- |
| `retention.student.portal` | Access personal academic snapshot, grades, attendance, and deficiencies | `student` |
| `retention.faculty.classes` | Manage assigned classes, encode live scores, and post official grades | `faculty`, `lead_retention` |
| `retention.faculty.attendance` | Conduct live roll-call attendance for assigned class offerings | `faculty`, `lead_retention` |
| `retention.faculty.behavior` | File student conduct and behavioral incident reports | `faculty`, `lead_retention` |
| `retention.admin.classes` | Create class offerings, assign faculty instructors, archive terms | `lead_retention`, `super_admin` |
| `retention.admin.settings` | Configure institutional grading weights, pass threshold, and templates | `lead_retention`, `super_admin` |
| `retention.admin.grades` | Review faculty grade correction requests and extend INC deadlines | `lead_retention`, `super_admin` |
| `retention.admin.attendance` | Review institution-wide roll-calls and void erroneous sessions | `lead_retention`, `super_admin` |
| `retention.admin.conduct` | Review conduct cases, update severity ratings, and manage case status | `lead_retention`, `super_admin` |
| `retention.admin.profiles` | Record and maintain supplementary socio-academic student profiles | `lead_retention`, `super_admin` |
| `retention.view` | Read-only oversight access to institutional cohorts and dossiers | `dean`, `vpaa`, `super_admin`, `lead_retention` |

---

## 3. Complete Application Route Map

All routes are declared in [`modules/retention/routes.php`](file:///c:/xampp/htdocs/marsu_sc/modules/retention/routes.php):

### A. Landing & Smart Dispatcher
- `GET /retention` $\rightarrow$ `HomeController::index`: Inspects user roles and dispatches automatically:
  - `student` $\rightarrow$ Redirects to `/retention/my`
  - `faculty` $\rightarrow$ Redirects to `/retention/faculty`
  - `lead_retention` / `super_admin` / `dean` $\rightarrow$ Displays executive retention oversight

### B. Student Portal (Self-Service Read-Only)
- `GET /retention/my` $\rightarrow$ `StudentPortalController::dashboard` (Academic snapshot, enrolled classes, GPA, attendance health)
- `GET /retention/my/profile` $\rightarrow$ `StudentPortalController::profile` (Official university master record + socio-academic attributes)
- `GET /retention/my/grades` $\rightarrow$ `StudentPortalController::grades` (Term mark sheets; draft marks masked as *"In Progress"*)
- `GET /retention/my/attendance` $\rightarrow$ `StudentPortalController::attendance` (CHED 20% cut allowance meter + session history)
- `GET /retention/my/deficiencies` $\rightarrow$ `StudentPortalController::deficiencies` (Active INCs with deadline countdown + removal guide)
- `GET /retention/my/progress` $\rightarrow$ `StudentPortalController::progress` (Completed academic credits and earned units)
- `GET /retention/my/conduct` $\rightarrow$ `StudentPortalController::conduct` (Date, type, severity, status only; zero leak of internal narratives)

### C. Faculty Workspace (Academic Encoding & Classroom Management)
- `GET /retention/faculty` $\rightarrow$ `FacultyController::dashboard` (Teaching load overview, pending grade submissions, quick tools)
- `GET /retention/faculty/classes` $\rightarrow$ `FacultyController::classes` (Assigned class offerings ledger)
- `GET /retention/faculty/classes/{id}` $\rightarrow$ `FacultyController::classRecord` (Live score matrix, scheme configuration, roster pull)
- `POST /retention/faculty/classes/{id}/scheme` $\rightarrow$ `FacultyController::saveScheme` (Save activity categories & component weights)
- `POST /retention/faculty/classes/{id}/roster/pull-section` $\rightarrow$ `FacultyController::pullSection` (Pull official section roster)
- `POST /retention/faculty/classes/{id}/roster/add` $\rightarrow$ `FacultyController::addStudent` (Enroll student by ID)
- `POST /retention/faculty/classes/{id}/roster/remove` $\rightarrow$ `FacultyController::removeStudent` (Drop/remove student from roster)
- `POST /retention/faculty/classes/{id}/scores` $\rightarrow$ `FacultyController::saveScores` (Real-time cell autosave for raw student scores)
- `POST /retention/faculty/classes/{id}/post` $\rightarrow$ `FacultyController::postGrades` (Calculate 1.00–5.00/INC/FAILED marks and post)
- `POST /retention/faculty/classes/{id}/inc/resolve` $\rightarrow$ `FacultyController::resolveInc` (Encode removal completion grade)
- `POST /retention/faculty/classes/{id}/task-exception` $\rightarrow$ `FacultyController::saveTaskException` (Exempt/excuse individual tasks)
- `POST /retention/faculty/classes/{id}/correction-request` $\rightarrow$ `FacultyController::requestCorrection` (Submit grade change justification)
- `GET /retention/faculty/attendance` $\rightarrow$ `FacultyController::attendance` (Roll-call attendance form for assigned classes)
- `POST /retention/faculty/attendance/store` $\rightarrow$ `FacultyController::storeAttendance` (Persist class session check-in)
- `GET /retention/faculty/conduct` $\rightarrow$ `FacultyController::conduct` (Behavioral incident reporting view)
- `POST /retention/faculty/conduct/store` $\rightarrow$ `FacultyController::storeConduct` (File conduct infraction report)
- `GET /retention/faculty/students` $\rightarrow$ `FacultyController::students` (Roster of students across own assigned classes)
- `GET /retention/faculty/students/{id}` $\rightarrow$ `FacultyController::studentView` (Academic performance dossier for enrolled student)

### D. Admin Governance & Oversight Workspace
- `GET /retention/admin/classes` $\rightarrow$ `AdminController::classes` (Master class offerings catalog)
- `GET /retention/admin/classes/create` $\rightarrow$ `AdminController::createClass` (Offer new course section)
- `POST /retention/admin/classes/store` $\rightarrow$ `AdminController::storeClass` (Persist course offering)
- `GET /retention/admin/classes/{id}` $\rightarrow$ `AdminController::classRecordView` (Read-only grade matrix inspector for oversight)
- `POST /retention/admin/classes/{id}/assign` $\rightarrow$ `AdminController::reassignClassFaculty` (Assign or reassign faculty instructor)
- `POST /retention/admin/classes/{id}/update` $\rightarrow$ `AdminController::updateClass` (Update room, schedule, units, section)
- `POST /retention/admin/classes/{id}/archive` $\rightarrow$ `AdminController::archiveClass` (Soft-delete/archive class)
- `POST /retention/admin/terms/{semesterId}/close` $\rightarrow$ `AdminController::closeTerm` (Lock all posted offerings in term)
- `GET /retention/admin/settings` $\rightarrow$ `AdminController::settings` (Institutional retention and grading policy settings)
- `POST /retention/admin/settings/update` $\rightarrow$ `AdminController::updateSettings` (Persist policy adjustments with audit logging)
- `GET /retention/admin/templates` $\rightarrow$ `AdminController::templates` (Institutional grading templates catalog)
- `GET /retention/admin/templates/create` $\rightarrow$ `AdminController::createTemplate` (Grading template builder)
- `POST /retention/admin/templates/store` $\rightarrow$ `AdminController::storeTemplate` (Persist grading template)
- `GET /retention/admin/templates/{id}/edit` $\rightarrow$ `AdminController::editTemplate` (Edit grading template)
- `POST /retention/admin/templates/{id}/update` $\rightarrow$ `AdminController::updateTemplate` (Update template components)
- `POST /retention/admin/templates/{id}/toggle-active` $\rightarrow$ `AdminController::toggleTemplateActive` (Toggle template status)
- `POST /retention/admin/templates/{id}/set-default` $\rightarrow$ `AdminController::setTemplateDefault` (Designate default university template)
- `GET /retention/admin/corrections` $\rightarrow$ `AdminController::correctionRequests` (Faculty grade correction request queue)
- `POST /retention/admin/corrections/{id}/approve` $\rightarrow$ `AdminController::approveCorrection` (Approve request and unlock class)
- `POST /retention/admin/corrections/{id}/reject` $\rightarrow$ `AdminController::rejectCorrection` (Reject request with rationale)
- `POST /retention/admin/grades/{id}/extend-inc` $\rightarrow$ `AdminController::extendInc` (Extend statutory 1-year INC deadline)
- `POST /retention/admin/attendance/{id}/void` $\rightarrow$ `AdminController::voidAttendance` (Void incorrect roll-call entry with reason)
- `POST /retention/admin/conduct/{id}/status` $\rightarrow$ `AdminController::updateConductStatus` (Update case status)
- `POST /retention/admin/conduct/{id}/severity` $\rightarrow$ `AdminController::updateConductSeverity` (Reclassify infraction severity)
- `GET /retention/admin/profiles/{studentId}` $\rightarrow$ `AdminController::editStudentProfile` (Supplementary retention profile editor)
- `POST /retention/admin/profiles/{studentId}` $\rightarrow$ `AdminController::updateStudentProfile` (Persist socio-academic attributes)
- `GET /retention/admin/preview-student/{studentId}` $\rightarrow$ `AdminController::previewStudent` (Diagnostic read-only student preview)
- `GET /retention/admin/change-log` $\rightarrow$ `AdminController::changeLog` (Filterable administrative audit trail)
- `POST /retention/admin/notes` $\rightarrow$ `AdminController::storeNote` (Post executive dashboard advisory note)
- `POST /retention/admin/notes/{id}/archive` $\rightarrow$ `AdminController::archiveNote` (Archive executive note)

---

## 4. Database Schema Reference (`ret_*` Tables)

Migrations are located in [`database/migrations/`](file:///c:/xampp/htdocs/marsu_sc/modules/retention/database/migrations/):

### 1. `ret_classes`
Maintains university course offerings per academic year and semester.
- `id`: INT AUTO_INCREMENT PRIMARY KEY
- `academic_year_id`: INT (FK `academic_years.id`)
- `semester_id`: INT (FK `semesters.id`)
- `subject_code`: VARCHAR(50)
- `subject_title`: VARCHAR(255)
- `units`: DECIMAL(3,1) DEFAULT 3.0
- `section_name`: VARCHAR(50)
- `faculty_user_id`: INT (FK `users.id`)
- `template_id`: INT NULL (FK `ret_grading_templates.id`)
- `allow_custom_scheme`: TINYINT(1) DEFAULT 0
- `grade_status`: ENUM('draft', 'submitted', 'posted', 'locked') DEFAULT 'draft'
- `submitted_at`, `posted_at`, `locked_at`: DATETIME NULL
- `submitted_by`, `posted_by`, `locked_by`: INT NULL

### 2. `ret_class_schemes` & `ret_class_tasks`
Defines activity components (Quizzes, Exams, Labs) and individual encoded tasks per class.
- Component weights must sum to 100%.
- Tasks track `task_name`, `max_score`, and `due_date`.

### 3. `ret_class_students` & `ret_class_scores`
- `ret_class_students`: Enrolled student roster per class with `status` ('enrolled', 'dropped', 'withdrawn', 'completed').
- `ret_class_scores`: Normalized cell scores per student and task with `submission_status` ('submitted', 'late', 'missing', 'excused').

### 4. `ret_class_grades`
Official calculated evaluations:
- `raw_percentage`: DECIMAL(5,2)
- `computed_grade`: DECIMAL(3,2) (1.00–3.00, 5.00)
- `final_grade`: VARCHAR(10) (1.00 to 5.00, INC, DRP)
- `remarks`: ENUM('PASSED', 'FAILED', 'INC', 'DRP')
- `inc_deadline`: DATE NULL (Statutory 1-year removal deadline)
- `inc_resolved_at`: DATETIME NULL

### 5. `ret_grading_templates`
Institutional grade weighting templates (e.g. Standard Lecture 40/30/30, Laboratory Course 40/40/20).

### 6. `ret_grade_correction_requests`
Two-person integrity workflow for post-lock grade adjustments:
- Faculty submits `reason_category`, `justification`, and `requested_changes`.
- Admin reviews, logs audit justification, and grants approval to unlock.

### 7. `ret_student_profiles`
Non-sensitive socio-academic attributes:
- `living_arrangement`: ENUM('with_parents', 'dormitory', 'boarding_house', 'relatives', 'independent')
- `commute_category`: ENUM('walking', 'short_commute', 'long_commute', 'island_cross')
- `working_student`, `scholarship_grantee`, `first_generation`: TINYINT(1)

### 8. `ret_settings` & `ret_change_logs`
Key-value administrative policies (e.g. passing threshold 75%, INC window 365 days) and tamper-evident change logs.

---

## 5. Security & Data Privacy Act of 2012 (RA 10173) Guarantees

1. **Student Personal Data Scoping**: Students can access **only** their own records through `RetentionAccess::currentStudent()`. Cross-student browsing is blocked at the SQL query and controller level.
2. **Draft Grade Secrecy**: Unposted grades remain hidden from students to prevent confusion while faculty are evaluating or adjusting curves.
3. **Conduct Incident Narrative Shielding**: Students see only the incident category, date, severity rating, and resolution status. Sensitive investigative notes and faculty narratives are strictly omitted from student views.
4. **Statutory Notices**: The statutory RA 10173 warning is visibly rendered on all intake, consultation, and portal views.

---

## 6. Zero-Core Technical Standards

- **Zero Core File Edits**: All code is strictly self-contained within `modules/retention/`.
- **Zero Framework Magic**: Handwritten Native PHP 8.x utilizing provided ERP core helpers (`e()`, `url()`, `can()`, `csrf_field()`, `Database::*`).
- **Zero External Dependencies**: Zero Composer packages, zero npm installs, zero CDN links. Pre-installed Bootstrap 5.3 and Bootstrap Icons used natively.
- **Zero jQuery**: All interactive elements (matrices, modals, score autosave) use modern Vanilla JavaScript (`document.querySelector`, `addEventListener`, `fetch`).
- **Zero Fake Mock Data (Rule B7)**: Real database calculations only. Zero random number generators (`rand()`, `crc32`).

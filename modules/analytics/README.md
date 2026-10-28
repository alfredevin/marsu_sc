# Student Analytics & Academic Risk Early Warning System (MarSU ERP · SPAMS)

**Module Slug**: `analytics`  
**Database Table Prefix**: `ana_`  
**University Section**: Academic Analytics & Student Analytics  
**Primary Icon**: `bi-graph-up-arrow`  
**Research Team**: SPAMS Research Group (Modules 1–3)  
**Standard Compliance**: Republic Act No. 10173 (Data Privacy Act of 2012), CHED Memorandum Orders on Academic Analytics & 20% Maximum Cut Allowance

---

## 1. Architectural Overview: Three Role-Specific Portals

The Analytics module implements a strict **tri-persona architecture** replacing legacy role-blind pages with dedicated, permission-fenced user experiences:

```
                                  [MarSU Centralized ERP]
                                             │
                                     /analytics (Smart Router)
                                             │
             ┌───────────────────────────────┼───────────────────────────────┐
             │                               │                               │
             ▼                               ▼                               ▼
     [Student Portal]               [Faculty Workspace]              [Admin Workspace]
      /analytics/my/*               /analytics/faculty/*            /analytics/admin/*
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

Permissions are declared in [`module.json`](file:///c:/xampp/htdocs/marsu_sc/modules/analytics/module.json) and seeded into the ERP database via [`000001_seed_analytics_roles_and_permissions.php`](file:///c:/xampp/htdocs/marsu_sc/modules/analytics/database/seeders/000001_seed_analytics_roles_and_permissions.php):

| Permission Key | Description | Authorized Personas |
| :--- | :--- | :--- |
| `analytics.student.portal` | Access personal academic snapshot, grades, attendance, and deficiencies | `student` |
| `analytics.faculty.classes` | Manage assigned classes, encode live scores, and post official grades | `faculty`, `lead_analytics` |
| `analytics.faculty.attendance` | Conduct live roll-call attendance for assigned class offerings | `faculty`, `lead_analytics` |
| `analytics.faculty.behavior` | File student conduct and behavioral incident reports | `faculty`, `lead_analytics` |
| `analytics.admin.classes` | Create class offerings, assign faculty instructors, archive terms | `lead_analytics`, `super_admin` |
| `analytics.admin.settings` | Configure institutional grading weights, pass threshold, and templates | `lead_analytics`, `super_admin` |
| `analytics.admin.grades` | Review faculty grade correction requests and extend INC deadlines | `lead_analytics`, `super_admin` |
| `analytics.admin.attendance` | Review institution-wide roll-calls and void erroneous sessions | `lead_analytics`, `super_admin` |
| `analytics.admin.conduct` | Review conduct cases, update severity ratings, and manage case status | `lead_analytics`, `super_admin` |
| `analytics.admin.profiles` | Record and maintain supplementary socio-academic student profiles | `lead_analytics`, `super_admin` |
| `analytics.view` | Read-only oversight access to institutional cohorts and dossiers | `dean`, `vpaa`, `super_admin`, `lead_analytics` |

---

## 3. Complete Application Route Map

All routes are declared in [`modules/analytics/routes.php`](file:///c:/xampp/htdocs/marsu_sc/modules/analytics/routes.php):

### A. Landing & Smart Dispatcher
- `GET /analytics` $\rightarrow$ `HomeController::index`: Inspects user roles and dispatches automatically:
  - `student` $\rightarrow$ Redirects to `/analytics/my`
  - `faculty` $\rightarrow$ Redirects to `/analytics/faculty`
  - `lead_analytics` / `super_admin` / `dean` $\rightarrow$ Displays executive analytics oversight

### B. Student Portal (Self-Service Read-Only)
- `GET /analytics/my` $\rightarrow$ `StudentPortalController::dashboard` (Academic snapshot, enrolled classes, GPA, attendance health)
- `GET /analytics/my/profile` $\rightarrow$ `StudentPortalController::profile` (Official university master record + socio-academic attributes)
- `GET /analytics/my/grades` $\rightarrow$ `StudentPortalController::grades` (Term mark sheets; draft marks masked as *"In Progress"*)
- `GET /analytics/my/attendance` $\rightarrow$ `StudentPortalController::attendance` (CHED 20% cut allowance meter + session history)
- `GET /analytics/my/deficiencies` $\rightarrow$ `StudentPortalController::deficiencies` (Active INCs with deadline countdown + removal guide)
- `GET /analytics/my/progress` $\rightarrow$ `StudentPortalController::progress` (Completed academic credits and earned units)
- `GET /analytics/my/conduct` $\rightarrow$ `StudentPortalController::conduct` (Date, type, severity, status only; zero leak of internal narratives)

### C. Faculty Workspace (Academic Encoding & Classroom Management)
- `GET /analytics/faculty` $\rightarrow$ `FacultyController::dashboard` (Teaching load overview, pending grade submissions, quick tools)
- `GET /analytics/faculty/classes` $\rightarrow$ `FacultyController::classes` (Assigned class offerings ledger)
- `GET /analytics/faculty/classes/{id}` $\rightarrow$ `FacultyController::classRecord` (Live score matrix, scheme configuration, roster pull)
- `POST /analytics/faculty/classes/{id}/scheme` $\rightarrow$ `FacultyController::saveScheme` (Save activity categories & component weights)
- `POST /analytics/faculty/classes/{id}/roster/pull-section` $\rightarrow$ `FacultyController::pullSection` (Pull official section roster)
- `POST /analytics/faculty/classes/{id}/roster/add` $\rightarrow$ `FacultyController::addStudent` (Enroll student by ID)
- `POST /analytics/faculty/classes/{id}/roster/remove` $\rightarrow$ `FacultyController::removeStudent` (Drop/remove student from roster)
- `POST /analytics/faculty/classes/{id}/scores` $\rightarrow$ `FacultyController::saveScores` (Real-time cell autosave for raw student scores)
- `POST /analytics/faculty/classes/{id}/post` $\rightarrow$ `FacultyController::postGrades` (Calculate 1.00–5.00/INC/FAILED marks and post)
- `POST /analytics/faculty/classes/{id}/inc/resolve` $\rightarrow$ `FacultyController::resolveInc` (Encode removal completion grade)
- `POST /analytics/faculty/classes/{id}/task-exception` $\rightarrow$ `FacultyController::saveTaskException` (Exempt/excuse individual tasks)
- `POST /analytics/faculty/classes/{id}/correction-request` $\rightarrow$ `FacultyController::requestCorrection` (Submit grade change justification)
- `GET /analytics/faculty/attendance` $\rightarrow$ `FacultyController::attendance` (Roll-call attendance form for assigned classes)
- `POST /analytics/faculty/attendance/store` $\rightarrow$ `FacultyController::storeAttendance` (Persist class session check-in)
- `GET /analytics/faculty/conduct` $\rightarrow$ `FacultyController::conduct` (Behavioral incident reporting view)
- `POST /analytics/faculty/conduct/store` $\rightarrow$ `FacultyController::storeConduct` (File conduct infraction report)
- `GET /analytics/faculty/students` $\rightarrow$ `FacultyController::students` (Roster of students across own assigned classes)
- `GET /analytics/faculty/students/{id}` $\rightarrow$ `FacultyController::studentView` (Academic performance dossier for enrolled student)

### D. Admin Governance & Oversight Workspace
- `GET /analytics/admin/classes` $\rightarrow$ `AdminController::classes` (Master class offerings catalog)
- `GET /analytics/admin/classes/create` $\rightarrow$ `AdminController::createClass` (Offer new course section)
- `POST /analytics/admin/classes/store` $\rightarrow$ `AdminController::storeClass` (Persist course offering)
- `GET /analytics/admin/classes/{id}` $\rightarrow$ `AdminController::classRecordView` (Read-only grade matrix inspector for oversight)
- `POST /analytics/admin/classes/{id}/assign` $\rightarrow$ `AdminController::reassignClassFaculty` (Assign or reassign faculty instructor)
- `POST /analytics/admin/classes/{id}/update` $\rightarrow$ `AdminController::updateClass` (Update room, schedule, units, section)
- `POST /analytics/admin/classes/{id}/archive` $\rightarrow$ `AdminController::archiveClass` (Soft-delete/archive class)
- `POST /analytics/admin/terms/{semesterId}/close` $\rightarrow$ `AdminController::closeTerm` (Lock all posted offerings in term)
- `GET /analytics/admin/settings` $\rightarrow$ `AdminController::settings` (Institutional analytics and grading policy settings)
- `POST /analytics/admin/settings/update` $\rightarrow$ `AdminController::updateSettings` (Persist policy adjustments with audit logging)
- `GET /analytics/admin/templates` $\rightarrow$ `AdminController::templates` (Institutional grading templates catalog)
- `GET /analytics/admin/templates/create` $\rightarrow$ `AdminController::createTemplate` (Grading template builder)
- `POST /analytics/admin/templates/store` $\rightarrow$ `AdminController::storeTemplate` (Persist grading template)
- `GET /analytics/admin/templates/{id}/edit` $\rightarrow$ `AdminController::editTemplate` (Edit grading template)
- `POST /analytics/admin/templates/{id}/update` $\rightarrow$ `AdminController::updateTemplate` (Update template components)
- `POST /analytics/admin/templates/{id}/toggle-active` $\rightarrow$ `AdminController::toggleTemplateActive` (Toggle template status)
- `POST /analytics/admin/templates/{id}/set-default` $\rightarrow$ `AdminController::setTemplateDefault` (Designate default university template)
- `GET /analytics/admin/corrections` $\rightarrow$ `AdminController::correctionRequests` (Faculty grade correction request queue)
- `POST /analytics/admin/corrections/{id}/approve` $\rightarrow$ `AdminController::approveCorrection` (Approve request and unlock class)
- `POST /analytics/admin/corrections/{id}/reject` $\rightarrow$ `AdminController::rejectCorrection` (Reject request with rationale)
- `POST /analytics/admin/grades/{id}/extend-inc` $\rightarrow$ `AdminController::extendInc` (Extend statutory 1-year INC deadline)
- `POST /analytics/admin/attendance/{id}/void` $\rightarrow$ `AdminController::voidAttendance` (Void incorrect roll-call entry with reason)
- `POST /analytics/admin/conduct/{id}/status` $\rightarrow$ `AdminController::updateConductStatus` (Update case status)
- `POST /analytics/admin/conduct/{id}/severity` $\rightarrow$ `AdminController::updateConductSeverity` (Reclassify infraction severity)
- `GET /analytics/admin/profiles/{studentId}` $\rightarrow$ `AdminController::editStudentProfile` (Supplementary analytics profile editor)
- `POST /analytics/admin/profiles/{studentId}` $\rightarrow$ `AdminController::updateStudentProfile` (Persist socio-academic attributes)
- `GET /analytics/admin/preview-student/{studentId}` $\rightarrow$ `AdminController::previewStudent` (Diagnostic read-only student preview)
- `GET /analytics/admin/change-log` $\rightarrow$ `AdminController::changeLog` (Filterable administrative audit trail)
- `POST /analytics/admin/notes` $\rightarrow$ `AdminController::storeNote` (Post executive dashboard advisory note)
- `POST /analytics/admin/notes/{id}/archive` $\rightarrow$ `AdminController::archiveNote` (Archive executive note)

---

## 4. Database Schema Reference (`ana_*` Tables)

Migrations are located in [`database/migrations/`](file:///c:/xampp/htdocs/marsu_sc/modules/analytics/database/migrations/):

### 1. `ana_classes`
Maintains university course offerings per academic year and semester.
- `id`: INT AUTO_INCREMENT PRIMARY KEY
- `academic_year_id`: INT (FK `academic_years.id`)
- `semester_id`: INT (FK `semesters.id`)
- `subject_code`: VARCHAR(50)
- `subject_title`: VARCHAR(255)
- `units`: DECIMAL(3,1) DEFAULT 3.0
- `section_name`: VARCHAR(50)
- `faculty_user_id`: INT (FK `users.id`)
- `template_id`: INT NULL (FK `ana_grading_templates.id`)
- `allow_custom_scheme`: TINYINT(1) DEFAULT 0
- `grade_status`: ENUM('draft', 'submitted', 'posted', 'locked') DEFAULT 'draft'
- `submitted_at`, `posted_at`, `locked_at`: DATETIME NULL
- `submitted_by`, `posted_by`, `locked_by`: INT NULL

### 2. `ana_class_schemes` & `ana_class_tasks`
Defines activity components (Quizzes, Exams, Labs) and individual encoded tasks per class.
- Component weights must sum to 100%.
- Tasks track `task_name`, `max_score`, and `due_date`.

### 3. `ana_class_students` & `ana_class_scores`
- `ana_class_students`: Enrolled student roster per class with `status` ('enrolled', 'dropped', 'withdrawn', 'completed').
- `ana_class_scores`: Normalized cell scores per student and task with `submission_status` ('submitted', 'late', 'missing', 'excused').

### 4. `ana_class_grades`
Official calculated evaluations:
- `raw_percentage`: DECIMAL(5,2)
- `computed_grade`: DECIMAL(3,2) (1.00–3.00, 5.00)
- `final_grade`: VARCHAR(10) (1.00 to 5.00, INC, DRP)
- `remarks`: ENUM('PASSED', 'FAILED', 'INC', 'DRP')
- `inc_deadline`: DATE NULL (Statutory 1-year removal deadline)
- `inc_resolved_at`: DATETIME NULL

### 5. `ana_grading_templates`
Institutional grade weighting templates (e.g. Standard Lecture 40/30/30, Laboratory Course 40/40/20).

### 6. `ana_grade_correction_requests`
Two-person integrity workflow for post-lock grade adjustments:
- Faculty submits `reason_category`, `justification`, and `requested_changes`.
- Admin reviews, logs audit justification, and grants approval to unlock.

### 7. `ana_student_profiles`
Non-sensitive socio-academic attributes:
- `living_arrangement`: ENUM('with_parents', 'dormitory', 'boarding_house', 'relatives', 'independent')
- `commute_category`: ENUM('walking', 'short_commute', 'long_commute', 'island_cross')
- `working_student`, `scholarship_grantee`, `first_generation`: TINYINT(1)

### 8. `ana_settings` & `ana_change_logs`
Key-value administrative policies (e.g. passing threshold 75%, INC window 365 days) and tamper-evident change logs.

---

## 5. Security & Data Privacy Act of 2012 (RA 10173) Guarantees

1. **Student Personal Data Scoping**: Students can access **only** their own records through `AnalyticsAccess::currentStudent()`. Cross-student browsing is blocked at the SQL query and controller level.
2. **Draft Grade Secrecy**: Unposted grades remain hidden from students to prevent confusion while faculty are evaluating or adjusting curves.
3. **Conduct Incident Narrative Shielding**: Students see only the incident category, date, severity rating, and resolution status. Sensitive investigative notes and faculty narratives are strictly omitted from student views.
4. **Statutory Notices**: The statutory RA 10173 warning is visibly rendered on all intake, consultation, and portal views.

---

## 6. Zero-Core Technical Standards

- **Zero Core File Edits**: All code is strictly self-contained within `modules/analytics/`.
- **Zero Framework Magic**: Handwritten Native PHP 8.x utilizing provided ERP core helpers (`e()`, `url()`, `can()`, `csrf_field()`, `Database::*`).
- **Zero External Dependencies**: Zero Composer packages, zero npm installs, zero CDN links. Pre-installed Bootstrap 5.3 and Bootstrap Icons used natively.
- **Zero jQuery**: All interactive elements (matrices, modals, score autosave) use modern Vanilla JavaScript (`document.querySelector`, `addEventListener`, `fetch`).
- **Zero Fake Mock Data (Rule B7)**: Real database calculations only. Zero random number generators (`rand()`, `crc32`).

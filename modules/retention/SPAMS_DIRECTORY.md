# [SPAMS] Student Performance & Attendance Monitoring System
### Module Sub-System Directory & Ownership Manifest (Modules 1 to 3)

> [!IMPORTANT]
> **NOTICE TO COLLABORATING DEVELOPMENT TEAMS:**  
> The files listed below are owned and maintained by the **SPAMS Research Team (Modules 1 to 3)**.  
> If your group is developing **Modules 4, 5, or 6** (Early Warning System, Intervention Management, Reports & Analytics), please create your own dedicated view files and routes. **Do not modify or overwrite the SPAMS files listed below.**

---

## 1. SPAMS Sub-Module Division & Architectural Boundary

| Sub-Module Group | Designated Scope | Primary Controllers & Workspaces |
| :--- | :--- | :--- |
| **Module 1: Student Information & Profiling** | Official master identity, degree curriculum, section enrollment, and supplementary socio-academic profiling. | `StudentPortalController.php`<br>`AdminController.php` (Profiles) |
| **Module 2: Academic Monitoring & Grading** | Class offerings, activity schemes, live matrix score encoding, GradeCalculator (1.00–5.00), INC resolution, and grade correction workflow. | `FacultyController.php`<br>`AdminController.php` (Grades/Classes)<br>`GradeCalculator.php` |
| **Module 3: Attendance & Behavioral Tracking** | Class-linked roll-call check-in, CHED 20% cut allowance meter, session voiding, and confidential student conduct notices. | `FacultyController.php` (Attendance/Conduct)<br>`AdminController.php` (Attendance/Conduct) |
| **Modules 4, 5, 6: External / Future Scope** | Automated ML predictive early warning risk algorithms, guidance counselor referral case tracking, and CHED cohort survival reporting. | Maintained independently by Modules 4–6 development team. |

---

## 2. Source Code & Class Manifest

### A. Controllers (`modules/retention/Controllers/`)
1. [HomeController.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Controllers/HomeController.php): Role-based smart landing router (`/retention`), legacy institutional oversight dossier views, and legacy logbook submission endpoint.
2. [AdminController.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Controllers/AdminController.php): Academic governance, class creation and faculty staffing, institutional grading templates, grade correction approval, INC extensions, attendance voiding, conduct case management, supplementary profiling, and diagnostic student preview.
3. [FacultyController.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Controllers/FacultyController.php): Faculty teaching workspace, assigned class offerings, live matrix score persistence, CSV/section roster import, grade posting (1.00–5.00), task exceptions, roll-call attendance, and behavioral incident reports.
4. [StudentPortalController.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Controllers/StudentPortalController.php): Read-only student self-service portal, academic snapshot, term grades (with draft grade protection), CHED attendance meter, INC deficiency guide, and confidential conduct notices.

### B. Domain & Support Services (`modules/retention/Support/`)
1. [RetentionAccess.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Support/RetentionAccess.php): Persona and scoping resolution (`currentStudent()`, `facultyUserId()`, `ownsClass()`, `facultyStudentIds()`, `canSeeStudent()`, `isOversightOnly()`).
2. [RetentionSettings.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Support/RetentionSettings.php): Centralized policy configuration resolver (`get()`, `set()`, `passingThreshold()`, `incDays()`).
3. [GradeCalculator.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Support/GradeCalculator.php): Official MarSU 1.00–5.00 grading scale converter, percentage weighting engine, and INC/DRP remark evaluator.
4. [ChangeLog.php](file:///c:/xampp/htdocs/marsu_sc/modules/retention/Support/ChangeLog.php): Tamper-evident audit trail service recording administrative and faculty state transitions into `ret_change_logs`.

---

## 3. View Inventory by Persona

### A. Student Self-Service Portal (`modules/retention/Views/student/`)
- `dashboard.php`: Student academic snapshot, active courses, GPA, and supportive advisory.
- `profile.php`: Official master registration details and supplementary socio-academic attributes.
- `grades.php`: Official mark sheets (draft marks masked as *"In Progress"*).
- `attendance.php`: CHED 20% maximum cut allowance meter and session history.
- `deficiencies.php`: Active INCs with remaining deadline countdown and interactive removal guide.
- `progress.php`: Completed academic credits and cumulative earned units.
- `conduct.php`: Disciplinary notices (date, type, severity, status only; zero leak of internal narratives).

### B. Faculty Teaching Workspace (`modules/retention/Views/faculty/`)
- `dashboard.php`: Faculty teaching load summary and pending grading actions.
- `classes.php`: Assigned class offerings ledger with grading status badges.
- `class_record.php`: Live matrix score sheet with real-time autosave, component weights, and posting modal.
- `attendance.php`: Class-linked roll-call check-in form.
- `conduct.php`: Behavioral incident reporting form with severity categorization.
- `students.php`: Roster of students enrolled across assigned classes.
- `student_view.php`: Comprehensive performance dossier for an enrolled student.

### C. Admin Governance & Oversight Workspace (`modules/retention/Views/admin/`)
- `classes.php`: Master class offerings catalog and staffing manager.
- `class_form.php`: Offering creation and assignment modal/form.
- `class_record_view.php`: Read-only grade matrix inspector for administrative oversight.
- `settings.php`: Retention policy configuration (passing threshold, INC window, custom scheme toggles).
- `templates.php`: Institutional grading templates catalog.
- `template_form.php`: Grading template builder and component editor.
- `correction_requests.php`: Faculty grade correction approval and rejection queue.
- `student_profile_form.php`: Supplementary socio-academic profile editor.
- `change_log.php`: Filterable administrative audit log.

### D. Shared Partials (`modules/retention/Views/partials/`)
- `privacy_notice.php`: Republic Act No. 10173 statutory data privacy advisory banner.
- `student_nav.php`: Responsive student sub-navigation tab bar with active state pills.
- `readonly_banner.php`: Non-interactive notification banner for oversight-only personas.
- `reason_modal.php`: Reusable audit justification modal for administrative state modifications.
- `empty_state.php`: Consistent empty state placeholder for tables and lists.

---

## 4. Capstone Defense & Oral Examination Talking Points

When presenting this system to the faculty defense panel, emphasize these key architectural decisions:

1. **Elimination of the Monolithic Vulnerability**:
   - *Legacy State*: The ERP gave a single role-blind view where any user with `retention.view` could see all student records and access faculty tools.
   - *Engineered State*: Strict tri-persona segregation. Students see only their own data; faculty see only their assigned classes; admins govern policies and offerings without the power to fabricate faculty scores.

2. **Data Privacy Act (RA 10173) by Design**:
   - Personal student identifying data is protected at the database query level.
   - Conduct reports provide students with due process notice (date, category, severity, status) while strictly shielding confidential faculty and counselor investigative notes.

3. **Separation of Duties & Anti-Tampering Workflows**:
   - Faculty own all initial academic encoding. Once posted, class records lock immediately.
   - Administrators cannot unilaterally alter or unlock grades without a formal faculty grade correction request containing a documented rationale and audit trail.

4. **Academic Retention & Supportive Student Experience**:
   - Uses encouraging, solution-oriented wording rather than punitive language.
   - Visualizes the CHED 20% cut allowance meter to warn students before they exceed permissible absences.
   - Provides a clear 1-year INC removal countdown and procedural steps to prevent automatic failure.

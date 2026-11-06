# Academic Analytics & Student Monitoring System (Group 8A · SPAMS)

**Slug** `analytics` · **Table prefix** `ana_` · Native PHP 8.2, PDO, Bootstrap 5.3, no frameworks.

Every number, list and chart in this module comes from a database query. When there is no data, pages show an empty state. Unset policy values show "Not configured"; the module never falls back to a guessed number.

## 1. Flow

1. **Registrar** enrolls existing students for a term with a subject load (`ana_enrollments`, `ana_enrollment_subjects`).
2. **Faculty** create a class (subject, section, active term, grading template). The class gets a unique code. Faculty add students the Registrar enrolled in that subject, or approve join requests made with the class code.
3. **Faculty** post announcements and materials, encode scores, take roll-call, mark INC/DRP, and post grades. Posting locks the record.
   In Grades Tracking, only the owning faculty sees Customize Scheme and can edit a draft record. The **Manage Columns** button above the table opens one panel listing every component. Each component has Add column / Edit / Remove for its items. The component that records attendance lists its dates, with Add attendance date and remove. Attendance counts toward exactly one non-exam component, chosen in Customize Scheme: once one component has Attendance ticked, the box is locked on the others until it is unticked. Exam components (`isExam`: Midterm / Finals) keep fixed columns and show a lock icon. Attendance counts only the sessions recorded for a student: (Present + Excused + Late × late weight) ÷ recorded sessions.
4. **Students** see their classes and stream. They see their own task scores only if the faculty enabled it, and only posted grades with their term GWA.
5. **Admin / Program Head** monitor read-only. Admin also governs: correction approvals, INC extensions, term closure, program-head mapping.

## 2. Personas and landing

`GET /analytics` (auth only) dispatches by persona: student → `/analytics/my`, faculty (not admin) → `/analytics/faculty`, registrar → `/analytics/registrar`, admin / program head → `/analytics/overview`. Users with several personas get a workspace switcher in the module header. Data scopes are never merged.

| Persona | Roles | Scope |
|---|---|---|
| Admin | `super_admin`, `lead_analytics`, `admin` | All programs |
| Program Head | `program_head` | Programs mapped in `ana_program_heads` |
| Registrar | `registrar` | All students; imports the official enrollment records (SPAMS is not an enrollment system) |
| Faculty | `faculty` | Own classes (`ana_classes.faculty_user_id`) and their rosters |
| Student | `student` | Own record (`students.user_id`) |

`Support/AnalyticsAccess.php` is the single source of truth for personas, program scope SQL, class ownership, the active term, and 404/403 responses.

## 3. Permissions (`module.json`)

| Key | Granted to |
|---|---|
| `analytics.view`, `analytics.export` | program_head, lead_analytics |
| `analytics.student.portal` | student |
| `analytics.registrar.enrollment`, `analytics.registrar.view` | registrar |
| `analytics.faculty.classes` (also covers the class stream), `.attendance`, `.behavior` | faculty |
| `analytics.admin.settings`, `.classes`, `.grades`, `.attendance`, `.conduct` | lead_analytics |

The registrar also gets the existing core keys `core.students.view/create/edit/import/export`, `core.programs.view`, `core.subjects.view`, `core.academics.view` and `core.dashboard.view`. Admins have **no** route that writes scores or grades. Correction approval only returns a class to draft so its faculty owner can edit and re-post.

## 4. Sidebar

The original menu groups are unchanged: Faculty Workspace, Student Information Management, Academic Monitoring, Attendance and Engagement Monitoring, Academic Administration. Additions: Create Class, Class Stream and Join Requests inside Faculty Workspace, plus two new groups at the end, **My Academics** and **Registrar**. The core ModuleLoader hides items by permission.

## 5. Data model

The module only stores what the core tables do not hold. Students, subjects, sections, programs,
semesters, rooms, users, settings and the audit trail are read from the core tables.

| Core table | Used for |
|---|---|
| `students` | The student record and profile (program, year level, section, contact, guardian) |
| `subjects`, `sections`, `programs`, `semesters`, `academic_years`, `rooms` | Names of a class's subject, section, term and room, read through joins |
| `users` | Faculty, registrar, program heads and who recorded what |
| `settings` | Analytics policy values (group `analytics`, keys `analytics.*`; labels and ranges in `Support/AnalyticsSettings.php`) |
| `audit_logs` | Analytics change history (actions `analytics.*`, details JSON with field / old / new / reason) |

| Module table | What it adds |
|---|---|
| `ana_enrollments`, `ana_enrollment_subjects` | Term enrollment and subject load (one per student per semester; program comes from `students`) |
| `ana_program_heads` | Program-head → program mapping |
| `ana_classes` | Class offering: faculty, `subject_id`, `section_id`, `semester_id`, `room_id`, class code, schedule, grading scheme snapshot |
| `ana_class_students` | Roster (`grade_mark` INC/DRP, `drop_reason`) |
| `ana_class_join_requests` | Class-code join requests |
| `ana_class_posts` | Stream announcements and materials (attachments in `storage/uploads`, served only through the controller) |
| `ana_class_scores` | Task scores and submission status |
| `ana_class_grades` | Posted grades, INC deadline / resolution |
| `ana_attendance_records` | Roll-call per class session (voided via `voided_at`; one live mark per student per session) |
| `ana_behavior_records` | Conduct reports |
| `ana_grade_change_requests` | Faculty grade-correction requests |
| `ana_grading_templates` | Grading templates |
| `ana_notifications` | In-app notifications (absence warnings, posted grades, join requests) |
| `ana_dashboard_notes` | Admin notes on the monitoring dashboard |

Creating a class therefore writes one `ana_classes` row with ids; the subject code, title, units,
section name, academic year and room name are always the current values from the core tables.

Migration `2026_11_05_000002_use_core_tables_instead_of_copies` moved the data of the former copies
(`ana_settings` → `settings`, `ana_change_log` → `audit_logs`, `ana_records` notes → `ana_dashboard_notes`)
and dropped them together with `ana_student_profiles` and the copied columns. `tools/verify.php`
section 7 fails if any of them comes back.

### Integrity rules

Migration `2026_11_05_000001_harden_analytics_integrity` adds the database-side guarantees, so bad input is refused even if a controller misses a check (the XAMPP server runs without strict SQL mode, which would otherwise silently turn bad values into `0` or `''`):

- Foreign keys from `ana_classes` to `semesters`, `rooms` and `ana_grading_templates`.
- A unique key on attendance `(class_id, student_id, session_date)` for non-voided marks (generated column `live_mark`).
- CHECK constraints: scores ≥ 0, computed grades 1.00–5.00, passing cutoffs 1.00–5.00, year level 1–6.
- Rows of one term always use the first `semesters` row of that academic year and semester code (`AnalyticsAccess::findTerm` / `terms()`), because re-running the core seeder repeats semester rows.

Grading schemes from the template form, the class scheme form and the Grades Tracking matrix all go through `GradeCalculator::validateScheme`.

## 6. Grades

`Support/GradeCalculator.php` is the only place grades are computed:

- Item grade = 5 − 4 × (score ÷ max).
- Component share = average of item grades (excused items left out) × weight. Attendance counts as a component only when sessions exist.
- PASSED when the final grade ≤ the class passing cutoff.
- Term GWA = Σ(grade × units) ÷ Σ units over numeric grades only.

`Support/ClassRecord.php` loads a class record and runs the calculator. The faculty, monitoring and student views all use it.

## 7. Commands

```powershell
php scripts/migrate.php analytics
php scripts/seed.php analytics
php modules/analytics/tools/verify.php   # exits 1 on any failure
```

The seeders insert only roles, permissions, grants, the `registrar` and `programhead` demo accounts (password `Password123!`), the BSIS program-head mapping, settings and grading templates. They never insert students, enrollments, scores, grades or attendance.

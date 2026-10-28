# PROMPT — Role-Based Portals for `modules/retention` (Student · Faculty · Admin)

> Run from the repo root `c:\xampp\htdocs\marsu_sc`, branch `feature/retention`.
> Every fact in §2 was verified against the code and the live `marsu_erp` database on 2026-10-26. Trust it and do not spend time re-deriving it.

---

## 0. Your Role and Mission

You are a senior PHP 8 engineer joining the **SPAMS Research Group (Modules 1–3)** of the MarSU Centralized ERP. The Retention module (`modules/retention/`) currently has one role-blind experience. Anyone with `retention.view` sees every student's personal data and every record, and the faculty-only tools (class record, roll-call, incident reporting) sit on admin pages.

Split the module into **three role-specific experiences** so every user sees exactly what their role should see, and nothing more:

| Experience | Who | Principle |
|---|---|---|
| **Student Portal** | `student` | Read-only. **Own records only.** |
| **Faculty Workspace** | `faculty` | **Owns data entry** (class records, grades, attendance, task exceptions, incident reports), **for their own classes only**. |
| **Admin / Oversight** | `lead_retention`, `super_admin`; `dean`, `vpaa` read-only | **Institution-wide view.** Faculty-owned data is **read-only** here, except for a few explicit, audited corrections (`retention.manage`). |

Work in the phases in §8. **At the end of each phase, stop, report in the format of §10, and wait for approval.**

---

## 1. Non-Negotiable Constraints

1. **Write only inside `modules/retention/`.** You may read anything else for reference, but never edit it: `core/`, `app/`, root `database/`, `public/assets/vendor/`, `scripts/`, `install.php`, `.htaccess`, `.env`, and every other module folder.
2. **Follow `AGENTS.md`** at the repo root: native PHP 8 (no framework, no Composer, no npm, no CDN), Bootstrap 5.3 `data-bs-*`, no jQuery, prepared statements only, `ret_` prefix on every table, `['auth', 'permission:<key>', 'csrf']` on every POST route, `<?= csrf_field() ?>` in every form.
3. Never `ALTER`, `DROP` or `TRUNCATE` core tables. Foreign keys to core tables use `ON DELETE SET NULL` or `ON DELETE CASCADE`.
4. **SPAMS scope fence.** Modules 4–6 (Early Warning, Intervention Management, Reports & Analytics) belong to partner groups. Do **not** build these routes: `atriskstudents`, `riskoverview`, `risklevelclassification`, `systemalerts`, `trendsovertime`, `advisingrecords`, `guidancereferrals`, `academicsupportprograms`. Do **not** create these tables: `ret_risk_logs`, `ret_advising_records`, `ret_guidance_referrals`, `ret_academic_support`. Leave the `advising`, `guidance`, `support` and `risk` branches of `HomeController::store()` in place, because they are the partner teams' contract.
5. **Never edit an already-run migration.** `2026_09_29_000001_create_retention_tables.php` is recorded in the `migrations` table. All schema changes go into new migration files.
6. Keep the SPAMS header comment block on every view you touch, and add the same header (with correct `Scope` / `View` lines) to every new view.
7. Match the existing idiom: `Database::fetchAll / fetchOne / fetchColumn / insert / update`, `View::render('retention/Views/...')`, `Session::flash()`, `redirect(url(...))`, `htmlspecialchars()` / `e()`, the private `buildPagination()` helper, and the MarSU colors (`#800020`, `#58111a`, `#D4AF37`). New pages use Bootstrap theme tokens so `data-bs-theme="dark"` stays legible.

---

## 2. Verified Facts About the Current System

### 2.1 Auth and RBAC mechanics (core, read-only)

- `Auth::user()` returns an **array** (`$user['id']`, `$user['role_slug']`, `$user['role']`), not an object. It joins `user_roles` with `LIMIT 1`, so for users with several roles `role_slug` is arbitrary (for example, `group8_lead` has both `faculty` and `lead_retention`). **Never branch on `role_slug`.** Branch on `can('<permission>')` plus identity linkage (§2.2).
- `Permission::can()`: `super_admin` **bypasses everything** (always `true`). Wildcards `module.*` and `module.resource.*` are honored.
- `PermissionMiddleware` takes **one** key per `permission:` entry, with no OR. A page shared by several roles needs a key that every one of those roles holds, with scoping done inside the controller.
- The sidebar (`ModuleLoader::getNavItems`) and executive widgets (`ModuleLoader::getWidgets`) filter **only by permission key**. Role-specific menus therefore require role-specific permission keys.
- Permissions are registered from `module.json` by `ModuleLoader::syncPermissions()`. Role grants live in `role_permissions`. The core seeder grants every `retention.*` key to `lead_retention` **only**. **`student`, `faculty`, `dean` and `vpaa` currently hold zero retention permissions**, so the "Default Roles" column in `README.md` §2 is wrong.
- The core dashboard redirects `student` users to `/portal` (`app/Controllers/DashboardController.php:20`). The `faculty` role has no `core.dashboard.view`.
- Router: the **first registered match wins**. `{param}` captures `[^/]+` and is passed to the handler as a **named argument**, so the method parameter name must equal the placeholder name, and the value is a string.
- CSRF: `Csrf::validate()` accepts `$_POST['_token']` or the `X-CSRF-TOKEN` header. Use `csrf_token()` to embed the token for `fetch()` calls. `json_response($data, $code)` exists.
- Auditing: `Logger::audit($action, $entity, $entityId, $details)`.
- Seeders: use `return new class { public function run(): void { ... } };` (see `core/Seeder.php`). Run with `php scripts/seed.php retention`. Run migrations with `php scripts/migrate.php retention`.
- Namespace `Modules\Retention\Support\X` autoloads from `modules/retention/Support/X.php`.
- Nested view paths work, for example `View::render('retention/Views/student/dashboard', ...)`.
- Database: MariaDB 10.4.32 (XAMPP).

### 2.2 Identity linkage

- **Student ↔ user:** `students.user_id = users.id` (the core portal uses the same rule). Demo account `student` (users.id 4) maps to students.id 4, student number `26S0227`.
- **Faculty ↔ user:** `employees.user_id = users.id AND employees.type = 'faculty'`. However, the demo `faculty` account (users.id 3) **has no `employees` row**. Linked faculty accounts include users 19 (`emp_2017_0283`) and 20 (`emp_2011_0158`). Therefore **faculty ownership keys on `users.id`** (`faculty_user_id`), and `employees` is used only for display name and department when a row exists.
- Volume: 866 students, 24 faculty employees, 80 subjects, 26 sections. `ret_attendance_records` and `ret_behavior_records` both have **0 rows**.
- **ID trap:** the legacy `ret_attendance_records.student_id` (VARCHAR) stores `students.student_number`. The legacy `ret_behavior_records.student_id` (VARCHAR) is joined ambiguously as `b.student_id = s.id OR b.student_id = s.student_number` (`HomeController.php:1842`).

### 2.3 What exists today (every page is role-blind)

Every route requires `permission:retention.view`. No view checks `can()` or `$user`.

| Route | View | Shows / does | Data source |
|---|---|---|---|
| `/retention` | `index.php` | Executive dashboard, KPIs, charts, quick links, "New Record" modal | Mostly hard-coded demo numbers |
| `/retention/profile` (and the `academichistory`, `enrollmentrecords`, `demographicinfo` redirects) | `profile.php` | Directory of **all** students (address, email, contact) plus a 360° profile (demographics including guardian, transcript, enrollment) | `students` is real; **transcript grades are fabricated with `crc32` (`HomeController.php:563`)** |
| `/retention/gradestracking` | `gradestracking.php` | Faculty class record: create class, pull roster, CSV import, weights builder, score matrix, per-date P/A attendance, computed grade | **Browser memory only. "Save" is an `alert()` (`gradestracking.php:874`) and data is lost on refresh.** Queries the non-existent table `faculty_classes` |
| `/retention/subjectperformance` | `subjectperformance.php` | Institution-wide passing rates, instructor names, bottlenecks | Fabricated by seed formula |
| `/retention/progressreports` | `progressreports.php` | Units earned vs. required, milestone status, target graduation year | Fabricated |
| `/retention/failedincompletemonitoring` | `failedincompletemonitoring.php` | Failed / INC / DRP watchlist | Fabricated |
| `/retention/attendancerecords` | `attendancerecords.php` | Per-student compliance (20% cuts rule) and a "Record Attendance" modal | Real (`ret_attendance_records`) |
| `/retention/participationtracking` | `participationtracking.php` | Task completion and a "Log Task Exception" modal | Fabricated; exceptions stored only as `ret_records` text |
| `/retention/studentengagement` | `studentengagement.php` | Engagement score, turnaround | Fabricated |
| `/retention/behaviorrecords` | `behaviorrecords.php` | Incident roster and a "New Incident" modal | Real (`ret_behavior_records`) |
| POST `/retention/create` | `store()` | One writer multiplexed by `type` | See D-1 and D-3 |

### 2.4 Known defects to fix as part of this work

| ID | Defect |
|---|---|
| **D-1** | `routes.php:11` requires `permission:retention.create`, which is **not declared** in `module.json`. Only `super_admin` can submit any form; `lead_retention` gets a 403. |
| **D-2** | `HomeController::gradestracking()` reads `$user->id` on an array (line 784), so the value always falls back to `1`. It also queries the non-existent table `faculty_classes` (line 793). |
| **D-3** | `store()` attributes writes to user 1 (`Auth::id() ?: 1`, line 240) and validates nothing (enum values, dates, student existence). |
| **D-4** | The class record has no persistence. Its per-date P/A attendance is a **second attendance system**, disconnected from `ret_attendance_records`. |
| **D-5** | `index.php` links to 8 non-existent Module 4–6 routes (lines 82, 237, 262, 373–409), which all return 404. |
| **D-6** | Reusing the current generators on student or faculty pages would show **fabricated grades as if they were real**. |
| **D-7** | `widgets.php` returns fake counts (`42`, `7`) on error, and its recent list prints `ret_records.title`, which embeds student numbers. |
| **D-8** | `show()` builds its title with single quotes (`'View Record #{$id}'`, line 227), so the braces print literally. |

---

## 3. Target Access Model

### 3.1 Personas

| Persona | Roles | Identity used for scoping |
|---|---|---|
| Student | `student` | `students.id` where `students.user_id = Auth::id()` |
| Faculty | `faculty` | `Auth::id()`, stored as `faculty_user_id` |
| Module Admin | `lead_retention`, `super_admin` | None (institution-wide) |
| Oversight (read-only) | `dean`, `vpaa` | None (institution-wide, no writes) |

### 3.2 Permission keys (`module.json` → `permissions`)

**Keep** these keys. The meaning of `retention.view` is narrowed:

| Key | Meaning after this change |
|---|---|
| `retention.view` | Institution-wide oversight pages. **Admin and oversight only; never granted to student or faculty.** |
| `retention.export` | Institution-wide exports |
| `retention.analyze`, `retention.intervene` | Modules 4–5. Leave untouched. |

**Add** these keys:

| Key | Description |
|---|---|
| `retention.manage` | Admin corrections: behavior case workflow, voiding attendance entries, unlocking posted grade sheets, dashboard notes |
| `retention.faculty.classes` | Faculty workspace: own classes, rosters, class record, grade posting, task exceptions |
| `retention.faculty.attendance` | Roll-call attendance for own classes |
| `retention.faculty.behavior` | Reporting conduct incidents for students on own rosters |
| `retention.student.portal` | Student self-service, own records only |

**Remove** every reference to `retention.create` (fixes D-1).

### 3.3 Grant matrix (applied by a module seeder)

| Role | `student.portal` | `faculty.classes` / `faculty.attendance` / `faculty.behavior` | `view` | `export` | `manage` | `analyze`, `intervene` |
|---|:-:|:-:|:-:|:-:|:-:|:-:|
| `student` | ✔ | | | | | |
| `faculty` | | ✔ | | | | |
| `dean`, `vpaa` | | | ✔ | ✔ | | |
| `lead_retention` | ✔ | ✔ | ✔ | ✔ | ✔ | ✔ (already granted) |
| `super_admin` | bypass | bypass | bypass | bypass | bypass | bypass |

Seeder file: `modules/retention/database/seeders/2026_10_26_000001_retention_role_permissions_seeder.php`. It must:

- call `\Core\ModuleLoader::syncPermissions()` first;
- look up role ids by slug and skip any role that is missing;
- use only `INSERT IGNORE INTO role_permissions`, so running it twice is a no-op;
- never `DELETE` or `UPDATE` core rows.

In your report, note that the same grants can be made through the core Roles & Permissions UI if the reviewer prefers that no module seeder writes to `role_permissions`.

### 3.4 Feature visibility matrix (this is the contract)

Legend: ✏️ create/edit · 👁 view · 🔒 own records only · 🎓 only students on this faculty member's own class rosters · — hidden (no menu item; a typed URL returns 403 or "not found")

| # | Feature | Student | Faculty | Admin (`lead`, `super`) | Oversight (`dean`, `vpaa`) |
|---|---|---|---|---|---|
| 1 | Module landing `/retention` | Redirect to My Snapshot | Redirect to Faculty Workspace | Executive dashboard | Executive dashboard, no write buttons |
| 2 | Student directory and search | — | 👁🎓 limited columns | 👁 all | 👁 all |
| 3 | Profile: identity and enrollment (program, year, section, status) | 👁🔒 | 👁🎓 | 👁 | 👁 |
| 4 | Profile: contact, address, guardian, living arrangement | 👁🔒 | — | 👁 | 👁 |
| 5 | Derived risk labels (commute risk, "Probation", "Critical / MRR Risk") | — (supportive wording only) | 👁🎓 | 👁 | 👁 |
| 6 | Full transcript (all terms) | 👁🔒 posted grades only | — (grades from own classes only) | 👁 | 👁 |
| 7 | Class record: create class, roster, weights, scores, post grades | — | ✏️ own classes | 👁 read-only, all classes; unlock with `manage` | 👁 read-only |
| 8 | My grades per class | 👁🔒 only after the faculty posts them | n/a | n/a | n/a |
| 9 | Subject performance (institution-wide, instructor comparison) | — | — (own-class stats appear in the workspace instead) | 👁 | 👁 |
| 10 | Progress reports (units, milestone, target graduation year) | 👁🔒 | — | 👁 | 👁 |
| 11 | Failed / INC / DRP | 👁🔒 with deadline and next steps | ✏️ resolve INC in own classes; 👁 own classes | 👁 all | 👁 all |
| 12 | Roll-call attendance logging | — | ✏️ own classes, roster-limited | 👁 all; void an entry with `manage` | 👁 |
| 13 | Attendance compliance (20% cuts rule) | 👁🔒 per subject, cuts remaining | 👁 own classes | 👁 all | 👁 |
| 14 | Task exceptions (late, missed, excused submissions) | 👁🔒 | ✏️ own classes | 👁 | 👁 |
| 15 | Engagement summary | 👁🔒 from real scores | 👁 own classes | 👁 | 👁 |
| 16 | Behavior incidents | 👁🔒 date, type, severity and status only (no description, no reporter, no resolution notes) | ✏️ report for 🎓; 👁 only incidents they reported | 👁 all; set status and resolution with `manage` | 👁 |
| 17 | Export and print | Print own records | Export own class record | ✔ (`retention.export`) | ✔ |
| 18 | Executive widgets (`widgets.php`) | — | — | ✔, with no student identifiers | ✔ |
| 19 | Dashboard "New Record" note | — | — | ✏️ with `manage` | — |

**The rule behind this matrix:** data entry belongs to faculty. Admins see faculty-owned data **read-only**. The only exceptions are the audited `retention.manage` corrections in rows 7, 12 and 16.

---

## 4. Data Model — New Migration

File: `modules/retention/database/migrations/2026_10_26_000001_create_retention_class_record_tables.php`, in the `AGENTS.md` §7 format.

Put this rule in a comment at the top of the file:

> **ID convention.** New tables: `student_id INT` = `students.id` (FK). Legacy tables `ret_attendance_records` and `ret_behavior_records`: `student_id VARCHAR` = `students.student_number`. Always write the student number into the legacy tables, and join them **only** on `s.student_number`. Remove the `OR s.id` join.

### 4.1 `ret_classes`: faculty-owned class offerings

| Column | Definition |
|---|---|
| `id` | INT AUTO_INCREMENT PK |
| `faculty_user_id` | INT NULL, FK `users(id)` ON DELETE SET NULL, indexed |
| `subject_id` | INT NULL, FK `subjects(id)` ON DELETE SET NULL |
| `subject_code` | VARCHAR(32) NOT NULL (snapshot) |
| `subject_title` | VARCHAR(191) NOT NULL (snapshot) |
| `units` | DECIMAL(4,1) NOT NULL DEFAULT 3.0 |
| `section_id` | INT NULL, FK `sections(id)` ON DELETE SET NULL, indexed |
| `section_name` | VARCHAR(64) NULL (snapshot) |
| `academic_year_id` | INT NULL |
| `semester_id` | INT NULL, indexed |
| `grading_scheme` | LONGTEXT NOT NULL (JSON in the same shape as `defaultPresets` in `gradestracking.php`) |
| `passing_cutoff` | DECIMAL(4,2) NOT NULL DEFAULT 3.04 (matches `preset_cics`) |
| `grade_status` | ENUM('draft','posted','locked') NOT NULL DEFAULT 'draft' |
| `posted_at` | DATETIME NULL |
| `posted_by` | INT NULL, FK `users(id)` ON DELETE SET NULL |
| `created_at`, `updated_at`, `deleted_at` | standard |

### 4.2 `ret_class_students`: rosters

| Column | Definition |
|---|---|
| `id` | INT AUTO_INCREMENT PK |
| `class_id` | INT NOT NULL, FK `ret_classes(id)` ON DELETE CASCADE |
| `student_id` | INT NOT NULL, FK `students(id)` ON DELETE CASCADE |
| `status` | ENUM('enrolled','dropped') NOT NULL DEFAULT 'enrolled' |
| `added_by` | INT NULL, FK `users(id)` ON DELETE SET NULL |
| `created_at`, `updated_at` | standard |
| | UNIQUE (`class_id`, `student_id`) |

### 4.3 `ret_class_scores`: raw scores and submission status

| Column | Definition |
|---|---|
| `id` | INT AUTO_INCREMENT PK |
| `class_id` | INT NOT NULL, FK `ret_classes(id)` ON DELETE CASCADE |
| `student_id` | INT NOT NULL, FK `students(id)` ON DELETE CASCADE |
| `item_code` | VARCHAR(32) NOT NULL (must exist in the class's `grading_scheme`) |
| `score` | DECIMAL(6,2) NULL |
| `submission_status` | ENUM('submitted','late','missing','excused') NOT NULL DEFAULT 'submitted' |
| `updated_by` | INT NULL, FK `users(id)` ON DELETE SET NULL |
| `created_at`, `updated_at` | standard |
| | UNIQUE (`class_id`, `student_id`, `item_code`) |

### 4.4 `ret_class_grades`: computed grades, written on posting

| Column | Definition |
|---|---|
| `id` | INT AUTO_INCREMENT PK |
| `class_id` | INT NOT NULL, FK `ret_classes(id)` ON DELETE CASCADE |
| `student_id` | INT NOT NULL, FK `students(id)` ON DELETE CASCADE |
| `computed_grade` | DECIMAL(4,2) NULL |
| `final_grade` | VARCHAR(8) NOT NULL (`'1.00'` to `'5.00'`, `'INC'`, `'DRP'`) |
| `remarks` | ENUM('PASSED','FAILED','INC','DRP') NOT NULL |
| `inc_deadline` | DATE NULL |
| `inc_resolved_at` | DATETIME NULL |
| `posted_at` | DATETIME NULL |
| `created_at`, `updated_at` | standard |
| | UNIQUE (`class_id`, `student_id`) |

### 4.5 Changes to the module's own legacy tables

These are allowed because the tables are ours. Guard each change with an `INFORMATION_SCHEMA` check or MariaDB's `ADD COLUMN IF NOT EXISTS`.

- `ret_attendance_records`: add `class_id INT NULL`, an index on it, and an FK to `ret_classes(id)` ON DELETE SET NULL.
- `ret_behavior_records`: add `class_id INT NULL`, `resolution_notes TEXT NULL`, `resolved_by INT NULL` (FK `users(id)` ON DELETE SET NULL), `resolved_at DATETIME NULL`, `deleted_at DATETIME NULL`.

`down()` drops the four new tables in reverse dependency order, then drops the added columns.

---

## 5. Code Architecture

```
modules/retention/
├── Controllers/
│   ├── HomeController.php            # Admin / oversight (existing; modify)
│   ├── StudentPortalController.php   # NEW
│   └── FacultyController.php         # NEW
├── Support/
│   ├── RetentionAccess.php           # NEW: identity and scope resolver
│   └── GradeCalculator.php           # NEW: PHP port of the JS grade formula
├── Views/
│   ├── *.php                         # Existing admin views (modify)
│   ├── student/                      # NEW: dashboard, profile, grades, attendance,
│   │                                 #      deficiencies, progress, conduct
│   ├── faculty/                      # NEW: dashboard, classes, class_record, attendance,
│   │                                 #      students, student_profile, conduct
│   └── partials/                     # NEW: privacy_notice.php, empty_state.php
├── database/migrations/              # + new migration (§4)
├── database/seeders/                 # + new seeder (§3.3)
├── module.json, routes.php, widgets.php
```

### 5.1 `Support/RetentionAccess.php`: the single source of truth for "who am I and what may I touch"

| Method | Behavior |
|---|---|
| `currentStudent(): ?array` | The `students` row where `user_id = Auth::id()`, cached per request |
| `facultyUserId(): ?int` | `Auth::id()` when `can('retention.faculty.classes')` |
| `facultyDisplayName(): string` | Name from the linked `employees` row if there is one, otherwise `users.first_name` and `last_name` |
| `ownsClass(int $classId): bool` | `ret_classes.faculty_user_id = Auth::id() AND deleted_at IS NULL` |
| `facultyStudentIds(): array` | Distinct `students.id` on the rosters of my non-deleted classes, `status = 'enrolled'` |
| `canSeeStudent(int $studentId): bool` | Admin or oversight: true. Faculty: in `facultyStudentIds()`. Student: own id only. |
| `findOwnClassOr404(string $id): array` | Validates that the id is numeric, loads the class and checks ownership. On failure: HTTP 404, flash a message and redirect. Never reveal whether the record exists. |
| `isOversightOnly(): bool` | `can('retention.view') && !can('retention.manage')` |

**Every controller method that accepts an id must go through these helpers.** Never run a raw `WHERE id = ?` against scoped data without the ownership predicate. Never take the student's own id from `$_GET` or `$_POST`.

### 5.2 `Support/GradeCalculator.php`

Port the formula exactly from `gradestracking.php:799–866`:

- Transmutation is `5 − 4 × clamp(score / maxScore, 0, 1)`, rounded to 2 decimals. A `maxScore` of 0 or less gives `5.00`.
- A group is the **mean** of its item transmutations, plus the attendance transmutation when `hasAttendance` is true.
- The final grade is the sum of each group mean × `weight / 100`.
- The result is `PASSED` if the final grade is ≤ `passing_cutoff`.

The server recomputes on every save and on posting. **Never trust a grade value sent by the browser.**

The attendance component reads the class's rows in `ret_attendance_records`, which become the single source of truth (fixes D-4). Use the same weights as `HomeController::attendancerecords()`: Present 1, Late 0.75, Excused 1, Absent 0.

### 5.3 Routes (`routes.php`)

Register static paths **before** `{id}` paths. Handler parameter names must equal the placeholder names. Every POST also gets `'csrf'`.

**Landing**

| Method | Path | Middleware | Behavior |
|---|---|---|---|
| GET | `/retention` | `['auth']` | Admin dashboard if `can('retention.view')`; else redirect to `/retention/faculty` if `can('retention.faculty.classes')`; else redirect to `/retention/my` if `can('retention.student.portal')`; else render `errors/403` |

**Student**: `['auth', 'permission:retention.student.portal']`, GET only, with no POST routes:

`/retention/my`, `/retention/my/profile`, `/retention/my/grades`, `/retention/my/attendance`, `/retention/my/deficiencies`, `/retention/my/progress`, `/retention/my/conduct`

**Faculty**: `['auth', 'permission:retention.faculty.classes']`

| Method | Path | Purpose |
|---|---|---|
| GET | `/retention/faculty` | Workspace dashboard |
| GET | `/retention/faculty/classes` | My classes |
| POST | `/retention/faculty/classes/create` | Create a class |
| GET | `/retention/faculty/classes/{id}` | Class record matrix |
| POST | `/retention/faculty/classes/{id}/scheme` | Save weights (must total 100) |
| POST | `/retention/faculty/classes/{id}/roster/add` | By section pull, by student number, or by CSV |
| POST | `/retention/faculty/classes/{id}/roster/remove` | Remove a student (sets `status` to `dropped`) |
| POST | `/retention/faculty/classes/{id}/scores` | `fetch()` + JSON with `X-CSRF-TOKEN`; debounced autosave |
| POST | `/retention/faculty/classes/{id}/post` | Finalize. The server recomputes, writes `ret_class_grades` and sets `grade_status = 'posted'`. |
| POST | `/retention/faculty/classes/{id}/inc/resolve` | Replace an INC with a final grade |
| POST | `/retention/faculty/classes/{id}/task-exception` | Set `submission_status` to late, missing or excused |
| GET | `/retention/faculty/students` | Union of my rosters |
| GET | `/retention/faculty/students/{id}` | Limited student view (§5.7) |

`['auth', 'permission:retention.faculty.attendance']`: GET `/retention/faculty/attendance`, POST `/retention/faculty/attendance/store`

`['auth', 'permission:retention.faculty.behavior']`: GET `/retention/faculty/conduct`, POST `/retention/faculty/conduct/store`

**Admin**

- Existing GET routes keep `permission:retention.view`.
- Change POST `/retention/create` to `permission:retention.manage`. This fixes D-1 and keeps the Module 4–6 branches reachable for their owners.
- `/retention/gradestracking` becomes a read-only **Class Records Oversight** page. It lists every row in `ret_classes`, filterable by faculty, subject, section and term, with a read-only matrix.
- Add these routes, all with `['auth', 'permission:retention.manage', 'csrf']`:
  - POST `/retention/admin/behavior/{id}/status`: set status and resolution notes
  - POST `/retention/admin/attendance/{id}/void`: soft delete, with a required reason
  - POST `/retention/admin/classes/{id}/unlock`: set `grade_status` back to `draft`

### 5.4 Menu (`module.json`)

Use three permission-gated groups in `menu.items`, so the sidebar adapts automatically:

1. **My Academic Record** (`bi-mortarboard`), permission `retention.student.portal`. Children: My Snapshot, My Profile, My Grades, My Attendance, Deficiencies, Academic Progress, Conduct Notices.
2. **Faculty Workspace** (`bi-person-workspace`), permission `retention.faculty.classes`. Children: Dashboard, My Classes & Class Records, Roll-Call Attendance (permission `retention.faculty.attendance`), My Students, Conduct Reports (permission `retention.faculty.behavior`).
3. **The existing three groups** (Student Information Management, Academic Monitoring, Attendance and Engagement Monitoring) keep `retention.view`. Rename "Grades Tracking (Class Record)" to "Class Records Oversight".

`super_admin` and `lead_retention` will see all three groups. Student and faculty pages must therefore show a clean empty state when the account has no linked student row or no classes, for example: *"This account is not linked to a student record."* They must never show a PHP warning or another person's data.

**Optional, useful for the capstone defense:** a read-only "Preview as student" picker on `/retention/my?preview_student_id=…`. It is honored **only** when `can('retention.view')`, and the page shows an "Admin preview" banner. For any other user, the parameter is ignored.

### 5.5 Admin views: modify the existing pages

- **Remove faculty-only write UI** from the admin pages:
  - "Record Attendance" (`attendancerecords.php:50`)
  - "Log Task Exception" (`participationtracking.php:36`)
  - "New Incident" (`behaviorrecords.php:43`)
  - "Create Class" and the editable matrix (`gradestracking.php:122`)

  The data tables and analytics stay.
- **Add `retention.manage` controls:** a behavior status dropdown with resolution notes, voiding an attendance entry (reason required, soft delete plus `Logger::audit`), and unlocking a posted class.
- Wrap every write control in `<?php if (can('retention.manage')): ?>`. Hiding a button is cosmetic; **the route middleware is the real gate.**
- Oversight users (`dean`, `vpaa`) see the same pages with no write controls (`isOversightOnly()`).
- `index.php`: render the 8 Module 4–6 links (D-5) as disabled buttons with the tooltip *"Module 4–6, provided by partner team"* instead of links that return 404. The "New Record" modal requires `can('retention.manage')`.
- Fabricated analytics (D-6): when the new tables have rows, use real data. Derive failed/INC and subject performance from `ret_class_grades`, and participation from `ret_class_scores`. Otherwise keep the current demo fallback, but show a small **"Sample data"** badge.
- `widgets.php`: keep `retention.view`. On an exception, return `0` or `[]` instead of fake numbers. The recent list must not show student numbers (D-7).
- Fix D-8 (use double quotes or concatenation).

### 5.6 Student pages: read-only, own data only

- Use **real tables only**: `students`, `programs`, `sections`, `ret_class_grades` (only where `ret_classes.grade_status IN ('posted','locked')`), `ret_attendance_records` (matched by `student_number`), `ret_class_scores` and `ret_behavior_records`. **Never call the fabricated generators in `HomeController`.** When there is no data, show an empty state instead of numbers.
- **Dashboard:** GWA from posted grades, units earned and required, attendance rate this term, number of open deficiencies, upcoming INC deadlines, and a "Need help?" card that points to the adviser or guidance office. Do not link to Module 4–6 routes.
- **Supportive wording:** never show "Critical / MRR Risk", "Probation", risk tiers or numeric risk scores. Use wording such as *"Needs attention — please talk to your adviser."*
- **Attendance:** per subject, show sessions, absences and cuts remaining under the 20% rule, using the same math as `attendancerecords()`.
- **Conduct:** show the student's own incidents with date, type, severity and status only.
- Show the **Data Privacy Act (RA 10173) notice** (`partials/privacy_notice.php`) on the profile and conduct pages.
- Every query is scoped by the id from `RetentionAccess::currentStudent()`.

### 5.7 Faculty pages: own classes only

- **Workspace dashboard:** my classes this term, total students on my rosters, attendance alerts in my classes (students at or past the allowable cuts), failing and INC students in my classes, and classes whose grades are not yet posted.
- **Class record:** rebuild the UI of `gradestracking.php` under `Views/faculty/class_record.php`. Keep the look and feel, the weights builder, CSV import and section pull, but back them with the new endpoints.
  - The class list comes from `ret_classes WHERE faculty_user_id = Auth::id()`.
  - Section pull becomes a server query on `students.section_id = ret_classes.section_id`, replacing the fuzzy JS matcher.
  - Scores autosave through `fetch()`, debounced, with `X-CSRF-TOKEN`.
  - "Post grades" opens a confirmation modal. The server recomputes and posts. Once posted, the sheet is **locked** until an admin unlocks it.
  - The weights must total 100, validated on the server.
- **Roll-call attendance:** pick one of my classes and a date. A roster grid offers Present, Absent, Late and Excused, then bulk-saves to `ret_attendance_records` with `class_id`, `subject_code`, the student number, and the academic year and semester ids taken from the class.
  - Reject future dates.
  - Reject students who are not on the roster.
  - Upsert per (`class_id`, student, `session_date`).
- **My Students:** the union of my rosters, with columns for student number, name, program, year, section and email. The per-student page shows only that student's grades, attendance and task exceptions **in my classes**. It does **not** show address, guardian or contact number.
- **Conduct:** the student picker is limited to my rosters. Inserts set `reported_by = Auth::id()` and `class_id`. The list shows only rows where `reported_by = Auth::id()`.
- **Task exceptions:** set `ret_class_scores.submission_status`, and write a `ret_records` audit line whose title does **not** contain the student number.

---

## 6. Security and Privacy Checklist (every item must pass)

- [ ] Every POST route has `['auth', 'permission:<key>', 'csrf']`, server-side validation (enum whitelists, dates via `DateTime::createFromFormat`, numeric ranges, string lengths) and an ownership check.
- [ ] **IDOR:** changing any id in a URL, form or JSON body to someone else's returns "not found" or a redirect, never data.
- [ ] There are no `Auth::id() ?: 1` fallbacks; middleware already guarantees authentication.
- [ ] All output is escaped (`e()` / `htmlspecialchars`). JSON embedded in `<script>` uses `json_encode(..., JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)`.
- [ ] Prepared statements only. `LIMIT` and `OFFSET` values are cast to int.
- [ ] `Logger::audit` is called for posting grades, unlocking a class, voiding attendance and changing a behavior status.
- [ ] RA 10173 data minimization follows §3.4. The privacy notice appears on the student profile, the faculty student page and every conduct page.
- [ ] No student identifiers appear in `widgets.php` output.

---

## 7. Test Accounts

All seeded accounts use the password `Password123!`.

| Username | Role(s) | Notes |
|---|---|---|
| `admin` | `super_admin` | Bypasses every check |
| `group8_lead` | `lead_retention` + `faculty` | Module admin |
| `dean` | `dean` | Read-only oversight |
| `faculty` | `faculty` | users.id 3. **No `employees` row**, but must still work as faculty. |
| `emp_2017_0283`, `emp_2011_0158` | `faculty` | Linked faculty. Use both to test isolation between faculty members. |
| `student` | `student` | users.id 4 → `26S0227` |

---

## 8. Implementation Phases (stop after each one, report, and wait)

| Phase | Scope | Acceptance criteria |
|---|---|---|
| **0 — Confirm** | Read the files referenced in §2. Present §11 to the user and confirm or change the defaults. **No code.** | The user has confirmed the decisions. |
| **1 — Foundation** | `module.json` permissions and menus, the migration, the seeder, `RetentionAccess`, `GradeCalculator`, the route skeleton and landing router. Fix D-1, D-2, D-3 and D-8. | Migration runs. Seeder runs **twice** without error. Each demo account sees only its own menu group(s). Typing another role's URL returns 403. |
| **2 — Faculty Workspace** | Class record persistence first, then roll-call, My Students, conduct and task exceptions. | Create a class, pull the roster, enter scores, **refresh: the scores are still there**, post the grades, and rows appear in `ret_class_grades`. Attendance rows carry `class_id`. Faculty B cannot open faculty A's class by id, by GET or POST. |
| **3 — Student Portal** | Every page in §5.6. | `student` (26S0227) sees only their own posted grades, attendance and conduct. Draft grades are invisible. Tampering with an id in any URL reveals nothing about anyone else. |
| **4 — Admin / Oversight Refit** | Everything in §5.5. | No faculty write buttons remain on admin pages. Every `manage` action works and is audited. `dean` sees everything read-only. The dashboard has no links that return 404. |
| **5 — Docs** | Update the permission table in `README.md` §2, and `SPAMS_DIRECTORY.md` (new views, tables, controllers). | The docs match the code. |

---

## 9. Manual Test Script

1. Log in as each account in §7. The sidebar must match §3.4.
2. As `student`, open `/retention/profile`, `/retention/gradestracking` and `/retention/faculty`. Each returns **403**.
3. As `faculty`, open `/retention/my` and `/retention/subjectperformance`. Each returns **403**.
4. As faculty B, GET `/retention/faculty/classes/{A's id}`. Result: not found. POST scores to A's class. Result: rejected.
5. As faculty, POST attendance for a student who is not on the roster. Result: rejected with a flash error.
6. As `student`, confirm that draft grades are hidden and posted grades are visible.
7. As `dean`, confirm there is no write button anywhere. A POST to any `retention.manage` route returns **403**.
8. Any POST without `_token` is rejected. The core sends the user back with a "Page expired or invalid CSRF security token" flash, and nothing is written to the database.
9. Run `php -l` on every changed PHP file.
10. Toggle `data-bs-theme="dark"`. Every new page stays legible.

---

## 10. Reporting Format (end of every phase)

1. **Files created / modified**, with paths
2. **Migrations / seeders run**, with their output
3. **§9 tests executed:** pass or fail, with evidence
4. **Deviations** from this prompt, and why
5. **Open questions**

---

## 11. Open Decisions (confirm in Phase 0; the defaults apply unless the user changes them)

| # | Decision | Default |
|---|---|---|
| Q1 | Access for `dean` and `vpaa` | Read-only oversight: `retention.view` + `retention.export` |
| Q2 | Can students see their own behavior incidents? | Yes, but only date, type, severity and status |
| Q3 | Can faculty see student contact and guardian details? | No |
| Q4 | Can faculty see a student's full transcript? | No, only grades from their own classes |
| Q5 | When do students see grades? | Only after the faculty member posts them |
| Q6 | Can an admin unlock posted grades? | Yes, with `retention.manage`, audited |
| Q7 | Fabricated analytics on admin pages | Keep as a fallback with a "Sample data" badge until real data exists |
| Q8 | Admin "Preview as student" | Include it (read-only, admin only) |
| Q9 | How risk is shown to students | Supportive wording only; no scores or risk tiers |

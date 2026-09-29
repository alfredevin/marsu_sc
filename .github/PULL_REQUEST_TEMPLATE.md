## Student Development Group Pull Request

### 1. Group & Module Identification
- **Student Group Number**: [e.g. Group 1]
- **Module Slug**: `modules/<slug>`
- **Module Display Name**: [e.g. 4Ps Beneficiary Expenses Monitoring]
- **Lead Developer**: [Full Name & Student ID]
- **Team Members**: [List names]

---

### 2. Summary of Changes
Provide a concise overview of what features, tables, or views are being introduced or updated:
- 

---

### 3. Architecture & Conflict-Free Compliance Checklist
*You MUST check all boxes before this Pull Request will be merged by the repository maintainer.*

#### Core Code Isolation (ZERO MERGE CONFLICT GUARANTEE)
- [ ] **ZERO CORE EDITS**: I verify that **NO files** inside `core/`, `app/`, `database/migrations/` (core), or root `.htaccess` have been modified or deleted.
- [ ] All code, views, controllers, migrations, and seeders live exclusively inside `modules/<slug>/`.
- [ ] All table names created by this module strictly use our assigned prefix (e.g., `exp_`, `hsg_`, `gdc_`).

#### Database & Migrations
- [ ] Migrations are placed in `modules/<slug>/database/migrations/` using timestamp filenames (`YYYY_MM_DD_NNNNNN_create_<table>_tables.php`).
- [ ] Tested migration execution cleanly via CLI: `php scripts/migrate.php <slug>`.
- [ ] Tested seeder execution cleanly via CLI: `php scripts/seed.php <slug>`.
- [ ] All queries use **PDO prepared statements** (`Database::fetchOne`, `Database::fetchAll`, `Database::insert`, etc.). No variable concatenation in SQL strings.

#### Security & RBAC Protection
- [ ] All routes defined in `modules/<slug>/routes.php` are guarded with `auth` and specific `permission:<slug>.<action>` middleware.
- [ ] All permissions used are declared in `modules/<slug>/module.json`.
- [ ] All POST/PUT/DELETE forms contain `<?= csrf_field() ?>`.
- [ ] All user inputs output to the browser are sanitized using `<?= e($variable) ?>`.
- [ ] If handling sensitive/health/welfare/counseling records: Confirmed compliance with the **Data Privacy Act of 2012 (RA 10173)** and restricted access to authorized personnel only.

#### UI & Frontend Standards
- [ ] Responsive UI styled with **Bootstrap 5.3** attributes (`data-bs-toggle`, `data-bs-target`, `data-bs-dismiss`).
- [ ] Uses vanilla JavaScript (ES6+). Zero jQuery used.
- [ ] Follows MarSU institutional brand tokens (`theme.css`: Burgundy `#800020`, Gold `#D4AF37`, etc.).
- [ ] Executive Dashboard telemetry widget verified in `modules/<slug>/widgets.php` and renders without errors on `/dashboard`.

---

### 4. How to Test
Provide exact step-by-step instructions for the reviewer:
1. Run migration: `php scripts/migrate.php <slug>`
2. Run seeder: `php scripts/seed.php <slug>`
3. Log in as: `groupX_lead` / `Password123!` or `admin` / `Password123!`
4. Navigate to: `http://localhost/marsu-erp/<slug>`
5. Observe: [What to expect]

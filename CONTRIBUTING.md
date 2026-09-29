# Contributing to MarSU Centralized ERP

Welcome, student software engineers of the **College of Information and Computing Sciences (CICS)**, Marinduque State University!

This repository serves as the unified codebase for the **MarSU Centralized ERP & Executive Dashboard**. Eleven (11) student project groups will concurrently build their specialized modules on top of this core platform through a single GitHub repository.

To ensure **zero merge collisions**, enterprise stability, and high architectural quality, all contributors must strictly adhere to the standards outlined below.

---

## 1. The Cardinal Rule: Zero Core Edits

> [!CAUTION]
> **DO NOT MODIFY OR DELETE ANY FILES OUTSIDE YOUR ASSIGNED MODULE DIRECTORY!**  
> Pull requests that touch `core/`, `app/`, `database/migrations/` (core), `scripts/`, `install.php`, or root configuration files will be **automatically rejected**.

All student work must reside exclusively in your designated module folder:
```
modules/<your-module-slug>/
├── module.json                       # Module metadata, permissions & menu
├── routes.php                        # Route registrations
├── widgets.php                       # Executive Dashboard telemetry widgets
├── README.md                         # Group module documentation
├── Controllers/                      # PSR-4 Controllers
│   └── HomeController.php
├── Models/                           # Database query models
├── Views/                            # Bootstrap 5 view templates
│   └── index.php
└── database/
    ├── migrations/                   # Module-namespaced migrations
    └── seeders/                      # Domain demo seeders
```

---

## 2. Technology Stack & Coding Standards

1. **Native PHP 8.2+ ONLY**:
   - Zero external frameworks (No Laravel, Symfony, or CodeIgniter).
   - Zero Composer dependencies (No `composer require`).
   - Zero Node.js / npm build steps (No Webpack, Vite, or Tailwind build).
2. **Database & Queries**:
   - MySQL / MariaDB (InnoDB, UTF-8mb4 unicode).
   - **PDO Prepared Statements Only**: Never concatenate variables into SQL strings.
   - Use the core database wrapper: `Database::fetchOne()`, `Database::fetchAll()`, `Database::insert()`, `Database::update()`.
3. **Frontend & Styling**:
   - **Bootstrap 5.3 Native**: Use `data-bs-*` attributes (`data-bs-toggle`, `data-bs-target`, `data-bs-dismiss`).
   - **Zero jQuery**: Write modern Vanilla ES6+ JavaScript.
   - **MarSU Institutional Tokens**: Use CSS variables from `public/assets/css/theme.css` (`var(--marsu-burgundy)`, `var(--marsu-gold)`, etc.).
   - **Offline Assets**: All vendor libraries (Bootstrap, Bootstrap Icons, SweetAlert2, Chart.js) are bundled locally in `public/assets/vendor/`. No CDN links.

---

## 3. Database Isolation & Table Prefixes

To prevent database collisions between groups, **each group is assigned a mandatory table prefix**:

| Group | Module Slug | Table Prefix | Module Domain |
|---|---|---|---|
| **Group 1** | `expense4ps` | `exp_` | 4Ps Beneficiary Student Expenses Monitoring |
| **Group 2** | `irimkms` | `kmp_` | Institutional Repository & Knowledge Management System |
| **Group 3** | `workload` | `wkl_` | Faculty Teaching Workload Management |
| **Group 4** | `health` | `hth_` | Medical & Dental Clinic System (*Confidential*) |
| **Group 5** | `orgfinance` | `orf_` | Student Organizations Collection & Financial Management |
| **Group 6** | `orgleadership` | `sld_` | Student Leadership Accreditation & Officer Evaluation |
| **Group 7** | `housing` | `hsg_` | Accredited Boarding House Management & Directory |
| **Group 8** | `retention` | `ret_` | Student Retention Predictor & Academic Risk System |
| **Group 9** | `assets` | `ast_` | University Equipment & IT Asset Management |
| **Group 10** | `welfare` | `wlf_` | Student Welfare Services & Grants Management (*Confidential*) |
| **Group 11** | `guidance` | `gdc_` | Guidance & Counseling Records System (*Strict Confidential*) |

### Migration Rules
- Place migration files in `modules/<slug>/database/migrations/`.
- Use timestamp format: `YYYY_MM_DD_NNNNNN_create_<slug>_tables.php`.
- Tables must start with your prefix (e.g. `exp_expenses`, `hsg_boarding_houses`).
- You may reference core tables (`users`, `students`, `employees`) via foreign keys using `ON DELETE SET NULL` or `ON DELETE CASCADE`.
- Never run `ALTER TABLE` or `DROP TABLE` on core tables.
- Run migrations for your module:
  ```bash
  php scripts/migrate.php <your_slug>
  ```

### Seeder Rules
- Place seeders in `modules/<slug>/database/seeders/`.
- Use timestamp format: `YYYY_MM_DD_NNNNNN_<slug>_seeder.php`.
- Run seeders for your module:
  ```bash
  php scripts/seed.php <your_slug>
  ```

---

## 4. Security & RBAC Guardrails

1. **Deny-by-Default Architecture**:
   Every route must be guarded with `auth` and an explicit permission:
   ```php
   $router->get('/housing', [HomeController::class, 'index'], ['auth', 'permission:housing.view']);
   $router->post('/housing/create', [HomeController::class, 'store'], ['auth', 'permission:housing.create', 'csrf']);
   ```
2. **Declare Permissions in `module.json`**:
   All permissions used in routes or views must be declared in your `module.json`. The core autoloader registers them into the database automatically:
   ```json
   "permissions": {
       "housing.view": "View Accredited Boarding Houses",
       "housing.create": "Register New Boarding House",
       "housing.edit": "Modify Boarding House Information"
   }
   ```
3. **CSRF Protection on All POST Forms**:
   ```html
   <form method="POST" action="<?= url('housing/create') ?>">
       <?= csrf_field() ?>
       <!-- form inputs -->
   </form>
   ```
4. **XSS Sanitization**:
   Always sanitize dynamic output using `e()`:
   ```html
   <td><?= e($row['title']) ?></td>
   ```
5. **Data Privacy Act (RA 10173) & Health/Counseling Confidentiality**:
   Modules handling sensitive student data (`health`, `welfare`, `guidance`) must:
   - Guard clinical case notes and financial indigency records behind confidential-level permissions.
   - Display the standard Data Privacy notice in views.
   - Ensure student numbers and sensitive diagnoses are anonymized in public or executive telemetry.

---

## 5. Executive Dashboard Widget Contract

University executives look at the main dashboard (`/dashboard`) for real-time institutional metrics. Each module exports telemetry through `modules/<slug>/widgets.php`:

```php
<?php
use Core\Database;

return [
    [
        'id'          => 'housing_kpi_vacancies',
        'type'        => 'kpi',                      // 'kpi', 'list', 'chart', 'table'
        'title'       => 'Available Bed Spaces',
        'icon'        => 'bi-house-heart-fill',
        'permission'  => 'housing.view',
        'data'        => function () {
            return (int)Database::fetchColumn("SELECT SUM(vacant_beds) FROM hsg_rooms WHERE status = 'available'");
        }
    ]
];
```

Supported widget types:
- `kpi`: Stat card with title, icon, and count/value.
- `list`: Card with recent 5 records (`primary_text`, `badge`, `sub_text`).
- `chart`: Mini chart definition (doughnut, bar).
- `table`: Responsive table of top 5 rows.

---

## 6. Git Workflow & Pull Request Process

### Branch Naming Convention
```bash
# Good examples:
git checkout -b feature/housing-room-reservation
git checkout -b feature/health-triage-modal
git checkout -b fix/expense4ps-stipend-calculation
```

### Commit Message Convention
```
feat(housing): add room reservation modal and validation
fix(health): resolve null pointer on emergency contact
docs(workload): update table schema in README
```

### Pull Request Steps
1. Make sure your module migration and seeders run cleanly from CLI:
   ```bash
   php scripts/migrate.php <your_slug>
   php scripts/seed.php <your_slug>
   ```
2. Verify that `git status` shows **NO modified files outside `modules/<your_slug>/`**.
3. Push your feature branch to GitHub.
4. Open a Pull Request against `main`. Fill out the Pull Request checklist completely.
5. The maintainer will verify that no core files are touched and merge your PR.

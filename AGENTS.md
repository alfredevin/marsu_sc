# AI Assistant & Copilot Instruction Set: MarSU ERP Architecture

> [!IMPORTANT]
> **TO ALL AI CODING AGENTS (Cursor, Copilot, Antigravity, Claude, ChatGPT):**  
> You are helping a student develop a specialized sub-module on top of the **MarSU Centralized ERP** platform. You MUST strictly adhere to the constraints below. Violating these rules will break the platform and cause merge rejections.

---

## 1. Zero Core Modification Rule (CRITICAL)

- **NEVER** edit, create, or delete files inside:
  - `core/`
  - `app/`
  - `database/migrations/` (Core migrations)
  - `database/seeders/` (Core seeders)
  - `public/assets/vendor/`
  - `scripts/`
  - `install.php`
  - Root `.htaccess` or `.env`
- **ALL YOUR CODE** must live exclusively inside your assigned module directory:
  ```
  modules/<module_slug>/
  ```

---

## 2. Mandatory Database Table Prefix

Every database table created for your module **MUST** start with the module's designated prefix:

- `expense4ps` $\rightarrow$ `exp_` (e.g. `exp_beneficiaries`, `exp_expenses`)
- `irimkms` $\rightarrow$ `kmp_` (e.g. `kmp_publications`, `kmp_categories`)
- `workload` $\rightarrow$ `wkl_` (e.g. `wkl_assignments`, `wkl_schedules`)
- `health` $\rightarrow$ `hth_` (e.g. `hth_consultations`, `hth_prescriptions`)
- `orgfinance` $\rightarrow$ `orf_` (e.g. `orf_dues`, `orf_disbursements`)
- `orgleadership` $\rightarrow$ `sld_` (e.g. `sld_officers`, `sld_evaluations`)
- `housing` $\rightarrow$ `hsg_` (e.g. `hsg_boarding_houses`, `hsg_rooms`)
- `retention` $\rightarrow$ `ret_` (e.g. `ret_risk_logs`, `ret_interventions`)
- `assets` $\rightarrow$ `ast_` (e.g. `ast_items`, `ast_maintenance`)
- `welfare` $\rightarrow$ `wlf_` (e.g. `wlf_grantees`, `wlf_applications`)
- `guidance` $\rightarrow$ `gdc_` (e.g. `gdc_appointments`, `gdc_case_notes`)

**NEVER** run `ALTER TABLE`, `DROP TABLE`, or `TRUNCATE` on core reference tables (`users`, `students`, `employees`, `roles`, `departments`, `programs`, `sections`, `subjects`, `buildings`, `rooms`). You may create Foreign Keys referencing them using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 3. Strict Native PHP 8.x Tech Stack

- **NO Frameworks**: Do not suggest or write Laravel, Symfony, or CodeIgniter code (no `Route::get`, `Eloquent`, `dd()`, `view()`, `config()`).
- **NO Composer**: Do not instruct the user to run `composer require` or add external packages.
- **NO npm / Node.js**: Do not require Tailwind CSS, Webpack, Vite, or npm installs.
- Use the provided handwritten Core helpers:
  - `e($string)`: HTML sanitization
  - `url('path')`: Generate application URL
  - `asset('path')`: Generate public asset URL
  - `can('permission.key')`: Check RBAC permission
  - `auth()`: Current authenticated user array
  - `csrf_field()`: Hidden CSRF token input
  - `flash('key', 'message')`: Flash message helper
  - `Database::fetchOne($sql, $params)`
  - `Database::fetchAll($sql, $params)`
  - `Database::insert($table, $data)`
  - `Database::update($table, $data, $where, $params)`

---

## 4. Database Security: Prepared Statements ONLY

- **NEVER** interpolate variables directly into SQL queries:
  ```php
  // ❌ FORBIDDEN (Vulnerable to SQL Injection):
  $res = Database::query("SELECT * FROM exp_expenses WHERE student_id = " . $_GET['id']);
  
  // ✔ REQUIRED (Prepared statement):
  $res = Database::fetchOne("SELECT * FROM exp_expenses WHERE student_id = :id", ['id' => $id]);
  ```

---

## 5. Frontend & UI Standards

- **Bootstrap 5.3 Native**: Use `data-bs-*` attributes. Do **NOT** write Bootstrap 4 syntax (`data-toggle`, `data-target`, `data-dismiss`).
- **Zero jQuery**: Do **NOT** use `$` or jQuery. Write standard modern JavaScript (`document.querySelector`, `addEventListener`, `fetch`).
- **Offline Assets**: All libraries are pre-installed in `public/assets/vendor/`. Do not insert `<script src="https://cdn...">`.
- **MarSU Brand Identity**:
  - Primary Burgundy: `#800020` (CSS class: `.text-marsu-burgundy`, `.btn-marsu`, `.table-marsu`)
  - Accent Gold: `#D4AF37` (CSS class: `.badge-gold`, `.btn-accent`)
  - Dark Mode: Support `data-bs-theme="dark"` automatically via standard Bootstrap 5 and theme tokens.

---

## 6. Security & Data Privacy Act of 2012 (RA 10173)

- Protect all POST routes with `['auth', 'permission:<slug>.<action>', 'csrf']`.
- Output `<?= csrf_field() ?>` inside all forms.
- For `health`, `welfare`, and `guidance`:
  - Enforce confidential-level role checking.
  - Anonymize student identifying information when publishing telemetry to `widgets.php`.
  - Display the statutory Data Privacy Act warning on all intake and consultation views.

---

## 7. Migration & Seeder Format

Migrations in `modules/<slug>/database/migrations/YYYY_MM_DD_NNNNNN_create_<table>_tables.php` must follow:

```php
<?php
use Core\Database;

return new class {
    public function up(): void {
        $db = Database::pdo();
        $db->exec("CREATE TABLE IF NOT EXISTS `prefix_table` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            -- columns ...
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(): void {
        $db = Database::pdo();
        $db->exec("DROP TABLE IF EXISTS `prefix_table`;");
    }
};
```

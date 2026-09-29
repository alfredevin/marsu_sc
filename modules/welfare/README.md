# Student Welfare Services & Financial Grants Management

**Module Slug**: `welfare`  
**Database Table Prefix**: `wlf_`  
**University Section**: Student Affairs (OSAS)  
**Primary Icon**: `bi-shield-check`  

---

## 1. Module Overview & Scope
Manages university scholarship grants, emergency loans, food pantry assistance, and student welfare applications with confidential income data protection.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `welfare.view` | View Welfare Programs & Beneficiary Rosters | `super_admin`, `dean`, `student` |
| `welfare.evaluate` | Screen Aid Applications & Income Documents | `super_admin`, `dean`, `student` |
| `welfare.grant` | Award Scholarship Grants & Emergency Relief | `super_admin`, `dean`, `student` |
| `welfare.confidential` | Access Protected Indigency Records (RA 10173) | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `wlf_` (e.g., `wlf_records`, `wlf_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php welfare
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php welfare
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/welfare/`. Submit Pull Requests targeting the `main` branch.

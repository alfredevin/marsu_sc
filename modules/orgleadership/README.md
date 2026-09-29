# Student Leadership Accreditation & Officer Evaluation

**Module Slug**: `orgleadership`  
**Database Table Prefix**: `sld_`  
**University Section**: Student Affairs (OSAS)  
**Primary Icon**: `bi-award-fill`  

---

## 1. Module Overview & Scope
Coordinates student council elections, officer term accreditation, leadership performance scorecards, and institutional awards.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `orgleadership.view` | View Student Leaders Directory & Officers | `super_admin`, `dean`, `student` |
| `orgleadership.accredit` | Accredit Organization Executive Officers | `super_admin`, `dean`, `student` |
| `orgleadership.evaluate` | Submit Leadership Performance Evaluations | `super_admin`, `dean`, `student` |
| `orgleadership.export` | Export Leadership Merit Certifications | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `sld_` (e.g., `sld_records`, `sld_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php orgleadership
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php orgleadership
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/orgleadership/`. Submit Pull Requests targeting the `main` branch.

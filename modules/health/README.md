# University Health & Medical Consultation Clinic

**Module Slug**: `health`  
**Database Table Prefix**: `hth_`  
**University Section**: Student Welfare & Clinic  
**Primary Icon**: `bi-heart-pulse-fill`  

---

## 1. Module Overview & Scope
Campus clinic consultations, medical checkups, dental triage, and electronic health records strictly protected under the Data Privacy Act of 2012 (RA 10173).

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `health.view` | Access Clinic Patient Consultation Logs | `super_admin`, `dean`, `student` |
| `health.consult` | Record Medical & Dental Examination Notes | `super_admin`, `dean`, `student` |
| `health.confidential` | View Sensitive Health History (Clinic Staff Only) | `super_admin`, `dean`, `student` |
| `health.audit` | Review Medical Privacy Access Trail | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `hth_` (e.g., `hth_records`, `hth_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php health
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php health
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/health/`. Submit Pull Requests targeting the `main` branch.

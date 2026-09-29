# Student Retention & Academic Risk Early Warning System

**Module Slug**: `retention`  
**Database Table Prefix**: `ret_`  
**University Section**: Academic Analytics  
**Primary Icon**: `bi-graph-up-arrow`  

---

## 1. Module Overview & Scope
Predictive analytics tracking attendance drops, failing prelim grades, prerequisite bottlenecks, and timely guidance interventions.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `retention.view` | View Academic Risk Dashboards & Cohort Trends | `super_admin`, `dean`, `student` |
| `retention.analyze` | Run Risk Identification Models | `super_admin`, `dean`, `student` |
| `retention.intervene` | Log Academic Remediation & Counseling Referrals | `super_admin`, `dean`, `student` |
| `retention.export` | Export CHED Cohort Survival Analytics | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `ret_` (e.g., `ret_records`, `ret_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php retention
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php retention
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/retention/`. Submit Pull Requests targeting the `main` branch.

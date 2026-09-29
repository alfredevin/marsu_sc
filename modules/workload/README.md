# Faculty Teaching Workload Management

**Module Slug**: `workload`  
**Database Table Prefix**: `wkl_`  
**University Section**: Academic Affairs  
**Primary Icon**: `bi-briefcase-fill`  

---

## 1. Module Overview & Scope
Calculates faculty teaching units, preparation credits, administrative designations, and overload compensations.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `workload.view` | View Faculty Workload Distribution | `super_admin`, `dean`, `student` |
| `workload.assign` | Assign Teaching Loads and Subject Units | `super_admin`, `dean`, `student` |
| `workload.approve` | Deans Endorsement & VPAA Approval | `super_admin`, `dean`, `student` |
| `workload.export` | Export CHED Workload Summary Matrix | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `wkl_` (e.g., `wkl_records`, `wkl_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php workload
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php workload
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/workload/`. Submit Pull Requests targeting the `main` branch.

# Accredited Boarding House Management & Directory

**Module Slug**: `housing`  
**Database Table Prefix**: `hsg_`  
**University Section**: Student Services  
**Primary Icon**: `bi-house-check-fill`  

---

## 1. Module Overview & Scope
University-accredited off-campus boarding house directory, landlord profiles, occupancy rates, and safety inspection ratings.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `housing.view` | Search Boarding Houses & Bed Space Vacancies | `super_admin`, `dean`, `student` |
| `housing.register` | Register and Update Boarding House Properties | `super_admin`, `dean`, `student` |
| `housing.inspect` | Conduct Safety, Fire & Sanitation Inspections | `super_admin`, `dean`, `student` |
| `housing.export` | Export Accreditation Inspection Reports | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `hsg_` (e.g., `hsg_records`, `hsg_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php housing
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php housing
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/housing/`. Submit Pull Requests targeting the `main` branch.

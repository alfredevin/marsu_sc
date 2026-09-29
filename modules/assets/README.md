# University Equipment & IT Asset Management

**Module Slug**: `assets`  
**Database Table Prefix**: `ast_`  
**University Section**: Campus Operations  
**Primary Icon**: `bi-pc-display-horizontal`  

---

## 1. Module Overview & Scope
Property plant and equipment registry, computer lab maintenance logs, barcode inventory, and transfer receipts.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `assets.view` | Search Fixed Assets & Hardware Inventory | `super_admin`, `dean`, `student` |
| `assets.create` | Tag New Lab Equipment & Serial Numbers | `super_admin`, `dean`, `student` |
| `assets.transfer` | Process Asset Transfer & Custodianship Receipts | `super_admin`, `dean`, `student` |
| `assets.maintain` | Log Preventive Maintenance & Service Repairs | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `ast_` (e.g., `ast_records`, `ast_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php assets
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php assets
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/assets/`. Submit Pull Requests targeting the `main` branch.

# 4Ps Beneficiary Expenses Monitoring

**Module Slug**: `expense4ps`  
**Database Table Prefix**: `exp_`  
**University Section**: Student Services  
**Primary Icon**: `bi-cash-coin`  

---

## 1. Module Overview & Scope
Tracks higher education allowance disbursements, living expenses, and academic compliance for 4Ps beneficiary students.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `expense4ps.view` | View 4Ps Beneficiary & Expense Records | `super_admin`, `dean`, `student` |
| `expense4ps.create` | Log Expense Claims & Stipend Receipts | `super_admin`, `dean`, `student` |
| `expense4ps.edit` | Modify Expense Entries | `super_admin`, `dean`, `student` |
| `expense4ps.export` | Export Financial Expense Summary (CSV/Excel) | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `exp_` (e.g., `exp_records`, `exp_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php expense4ps
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php expense4ps
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/expense4ps/`. Submit Pull Requests targeting the `main` branch.

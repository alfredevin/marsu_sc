# Guidance & Counseling Intake Records System

**Module Slug**: `guidance`  
**Database Table Prefix**: `gdc_`  
**University Section**: Guidance Center  
**Primary Icon**: `bi-person-heart`  

---

## 1. Module Overview & Scope
Intake consultations, routine interviews, psychological counseling, and case notes strictly protected by the Guidance and Counseling Act of 2004 (RA 9258) and Data Privacy Act (RA 10173).

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `guidance.view` | Access Counseling Schedules & Appointment Bookings | `super_admin`, `dean`, `student` |
| `guidance.counsel` | Conduct Intake Interviews & Routine Assessments | `super_admin`, `dean`, `student` |
| `guidance.confidential` | Access Restricted Clinical Case Notes (Counselors Only) | `super_admin`, `dean`, `student` |
| `guidance.refer` | Endorse Students for Academic/Medical Referrals | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `gdc_` (e.g., `gdc_records`, `gdc_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php guidance
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php guidance
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/guidance/`. Submit Pull Requests targeting the `main` branch.

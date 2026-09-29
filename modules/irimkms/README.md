# Institutional Repository & Knowledge Management (IRIMKMS)

**Module Slug**: `irimkms`  
**Database Table Prefix**: `kmp_`  
**University Section**: Research & Innovation  
**Primary Icon**: `bi-journal-bookmark-fill`  

---

## 1. Module Overview & Scope
University intellectual capital repository, faculty capstone papers, peer-reviewed journals, and dataset citations.

This module is maintained by the designated BSIS student development group. It integrates into the **MarSU Centralized ERP** platform seamlessly without altering any core files.

---

## 2. Security & RBAC Permissions
The following permissions are defined in `module.json` and registered into the system:

| Permission Key | Description | Default Roles |
|---|---|---|
| `irimkms.view` | Browse Published Research Repository | `super_admin`, `dean`, `student` |
| `irimkms.upload` | Submit Research Papers & Datasets | `super_admin`, `dean`, `student` |
| `irimkms.review` | Peer Review and Accredit Manuscripts | `super_admin`, `dean`, `student` |
| `irimkms.export` | Export Bibliographic Metadata | `super_admin`, `dean`, `student` |

---

## 3. Database Isolation Rules
- **Mandatory Table Prefix**: All tables created for this module MUST begin with `kmp_` (e.g., `kmp_records`, `kmp_logs`).
- **Never Modify Core Tables**: Do NOT execute `ALTER TABLE` or `DROP TABLE` on core tables (`users`, `students`, `roles`, etc.).
- **Foreign Keys**: You may create Foreign Keys referencing `users(id)` or `students(id)` using `ON DELETE SET NULL` or `ON DELETE CASCADE`.

---

## 4. How to Develop & Test
1. **Migrations**:
   Add new migration files in `database/migrations/` using timestamp format: `YYYY_MM_DD_NNNNNN_create_your_table.php`.
   Run:
   ```bash
   php scripts/migrate.php irimkms
   ```
2. **Seeders**:
   Add seeders in `database/seeders/` and run:
   ```bash
   php scripts/seed.php irimkms
   ```
3. **Routes & Controllers**:
   Define new routes in `routes.php` and controller methods in `Controllers/`.
4. **Widgets for Executive Dashboard**:
   Export telemetry in `widgets.php`. Core will automatically render them on the Executive Dashboard.
5. **Git Workflow**:
   Develop exclusively within your module directory: `modules/irimkms/`. Submit Pull Requests targeting the `main` branch.

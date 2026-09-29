# MarSU Centralized ERP & Executive Dashboard
### Marinduque State University • College of Information and Computing Sciences (CICS)

![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)
![Architecture](https://img.shields.io/badge/Architecture-Native%20Modular%20PSR--4-burgundy?color=800020)
![Database](https://img.shields.io/badge/Database-MySQL%20%2F%20MariaDB%20InnoDB-gold?color=D4AF37)
![Frontend](https://img.shields.io/badge/Frontend-Bootstrap%205.3%20Offline-darkred)
![Zero Dependencies](https://img.shields.io/badge/Build%20Step-Zero%20(No%20Composer%2C%20No%20npm)-success)

---

## 1. Executive Summary

The **MarSU Centralized ERP & Executive Dashboard** is an enterprise-grade academic management system designed for **Marinduque State University**. It establishes a high-performance, secure, and unified core foundation upon which **eleven (11) BSIS student capstone development groups** build their specialized sub-modules concurrently in a single shared GitHub repository with **guaranteed zero merge conflicts**.

### Core Architecture Highlights
- **100% Native PHP 8.2+**: Zero external framework bloat. Fast execution, easy debugging, and runs directly on standard Windows XAMPP.
- **Strict PDO Security**: Prepared statements with native data types, CSRF tokens on all state-altering requests, rate-limited login throttling, and bcrypt password hashing.
- **Deny-by-Default RBAC Engine**: Granular permissions (`module.resource.action`) with wildcard inheritance and dynamic module permission discovery.
- **Multi-Module Discovery Engine**: Automatically detects sub-modules in `modules/<slug>/` via `module.json`, auto-registers routes, injects menu items, and aggregates widgets onto the Executive Dashboard.
- **MarSU Brand Identity & Offline Assets**: Tailored CSS tokens (`#800020` Burgundy, `#D4AF37` Gold), full Dark Mode support, print stylesheets, and 100% offline local vendor bundles (Bootstrap 5.3, Bootstrap Icons, SweetAlert2, Chart.js).

---

## 2. System Architecture

```
                          ┌──────────────────────────────────────┐
                          │     Browser / Client Application     │
                          └───────────────────┬──────────────────┘
                                              │ (HTTP / Pretty URL)
                                              ▼
                        ┌──────────────────────────────────────────┐
                        │      public/index.php (Front Controller) │
                        └───────┬──────────────────────────┬───────┘
                                │                          │
                     ┌──────────┴────────┐        ┌────────┴──────────┐
                     │ Core/Router.php   │        │ Core/Session.php  │
                     │ Middleware Stack  │        │ Core/Csrf.php     │
                     └──────────┬────────┘        └───────────────────┘
                                │
          ┌─────────────────────┴───────────────────────┐
          │                                             │
          ▼ (Core Routes)                               ▼ (Dynamic Module Loader)
┌───────────────────────────────┐             ┌───────────────────────────────────┐
│ app/Controllers/              │             │ modules/<slug>/                   │
│  - DashboardController        │             │  - module.json (metadata & perms) │
│  - RoleController (RBAC)      │             │  - routes.php (isolated routes)   │
│  - UserController             │             │  - widgets.php (dashboard KPIs)   │
│  - StudentController          │             │  - Controllers/ (module logic)    │
│  - EmployeeController         │             │  - Views/ (Bootstrap 5 UI)        │
│  - DepartmentController       │             │  - database/migrations/ (prefix_) │
│  - FacilityController         │             │  - database/seeders/              │
│  - SettingController          │             └─────────────────┬─────────────────┘
└──────────────┬────────────────┘                               │
               │                                                │
               ▼                                                ▼
┌─────────────────────────────────────────────────────────────────────────────────┐
│                         Core/Database.php (PDO Singleton)                       │
│                        MySQL / MariaDB (marsu_erp)                              │
│                                                                                 │
│   [Core Reference Tables]                       [Isolated Module Tables]        │
│   users, roles, permissions,                    exp_beneficiaries, exp_expenses │
│   students, employees, departments,             hsg_boarding_houses, hsg_rooms  │
│   programs, academic_years, sections...         gdc_appointments, ast_inventory │
└─────────────────────────────────────────────────────────────────────────────────┘
```

---

## 3. Student Group Module Directory & Ownership

Each group has exclusive write permissions over their assigned directory in `modules/<slug>/` and is assigned a unique database table prefix:

| Group | Module Slug | Module Title | Table Prefix | Lead Demo Account |
|---|---|---|---|---|
| **Group 1** | `expense4ps` | 4Ps Beneficiary Student Expenses Monitoring | `exp_` | `group1_lead` |
| **Group 2** | `irimkms` | Institutional Repository & Knowledge Management System | `kmp_` | `group2_lead` |
| **Group 3** | `workload` | Faculty Teaching Workload Management | `wkl_` | `group3_lead` |
| **Group 4** | `health` | University Health & Medical Clinic (*Confidential*) | `hth_` | `group4_lead` |
| **Group 5** | `orgfinance` | Student Organizations Collection & Finance | `orf_` | `group5_lead` |
| **Group 6** | `orgleadership` | Student Leadership Accreditation & Evaluation | `sld_` | `group6_lead` |
| **Group 7** | `housing` | Accredited Boarding House Management & Directory | `hsg_` | `group7_lead` |
| **Group 8** | `retention` | Student Retention & Academic Risk Predictor | `ret_` | `group8_lead` |
| **Group 9** | `assets` | University Equipment & IT Asset Management | `ast_` | `group9_lead` |
| **Group 10** | `welfare` | Student Welfare Services & Grants (*Confidential*) | `wlf_` | `group10_lead` |
| **Group 11** | `guidance` | Guidance & Counseling Records System (*Strict Privacy*) | `gdc_` | `group11_lead` |

---

## 4. Prerequisites

To run this application locally, ensure you have:
1. **Windows OS** with [XAMPP](https://www.apachefriends.org/) (Apache + MySQL/MariaDB).
2. **PHP 8.2 or higher** (Included with modern XAMPP).
   - Extensions required: `pdo_mysql`, `mbstring`, `gd` (standard in XAMPP).
3. **Apache `mod_rewrite` enabled** (Enabled by default in XAMPP).

---

## 5. Quick Start Installation

### Step 1: Clone or Place in XAMPP `htdocs`
Place the repository inside your XAMPP web root:
```
C:\xampp\htdocs\marsu-erp\
```
*(If cloned as `marsu_sc`, create a directory junction via Administrator Command Prompt: `mklink /J "C:\xampp\htdocs\marsu-erp" "C:\xampp\htdocs\marsu_sc"`).*

### Step 2: Start Apache and MySQL
Open the **XAMPP Control Panel** and click **Start** for both **Apache** and **MySQL**.

### Step 3: Run Database Migrations & Seeders
Open a terminal (PowerShell or Command Prompt) inside `c:\xampp\htdocs\marsu-erp` and execute:

```bash
# Option A: Instant Complete Setup with 500+ Realistic Filipino Records
php scripts/reset-demo.php

# Option B: Standard migration and seed
php scripts/migrate.php
php scripts/seed.php
```

### Step 4: Open in Your Browser
Navigate to:
- **Primary Pretty URL**: [`http://localhost/marsu-erp/`](http://localhost/marsu-erp/)
- **Fallback URL**: [`http://localhost/marsu_sc/`](http://localhost/marsu_sc/)

---

## 6. Pre-Created Demo Credentials

All demo accounts share the password: **`Password123!`**

| Username | Role | Permissions Scope | Primary Purpose |
|---|---|---|---|
| `admin` | Super Administrator | Universal (`*.*`) | Master data, RBAC matrix, audit log, module manager |
| `dean` | College Dean (CICS) | `core.dashboard.view`, `core.students.view`, `workload.*`, `irimkms.*` | College overview, faculty workload approvals |
| `faculty` | Faculty Member | `core.dashboard.view`, `core.students.view`, `workload.view` | Class schedules, consultation hours |
| `student` | University Student | `core.students.view`, org leadership, housing search | Student self-service portal |
| `group1_lead` | 4Ps Lead Developer | `expense4ps.*` + Student | Development & testing of Group 1 |
| `group2_lead` to `group11_lead` | Group Lead Developers | Assigned module permissions + Role | Development & testing of Groups 2 through 11 |

---

## 7. Directory Structure

```
marsu-erp/
├── app/                              # Core Application Layer
│   ├── Controllers/                  # Auth, Dashboard, RBAC, Master Data Controllers
│   ├── Models/                       # Student, Employee, Department, Program Models
│   └── Views/                        # Core views & layout partials (header, sidebar, etc.)
├── core/                             # Zero-Framework Core Engine
│   ├── Autoloader.php                # Handwritten PSR-4 Autoloader
│   ├── helpers.php                   # Global helpers: url(), e(), asset(), can(), auth()
│   ├── Database.php                  # PDO singleton with UTF-8mb4
│   ├── Auth.php                      # Authentication, bcrypt, login rate limiter
│   ├── Permission.php                # Deny-by-default RBAC engine
│   ├── Router.php                    # Dual-mode HTTP router (pretty + ?r=)
│   ├── ModuleLoader.php              # Multi-module dynamic auto-discovery
│   ├── Migration.php                 # Namespaced migration runner
│   └── View.php                      # Buffer renderer with layout wrapper
├── database/                         # Core database migrations and baseline seeders
├── modules/                          # 11 Student Group Module Directories
│   ├── expense4ps/
│   ├── irimkms/
│   ├── workload/
│   ├── health/
│   ├── orgfinance/
│   ├── orgleadership/
│   ├── housing/
│   ├── retention/
│   ├── assets/
│   ├── welfare/
│   └── guidance/
├── public/                           # Web document root
│   ├── assets/
│   │   ├── css/theme.css             # MarSU Brand System & Dark Mode tokens
│   │   ├── js/app.js                 # Vanilla client logic & toast handlers
│   │   ├── img/                      # Optimized seals, logos, and vector assets
│   │   └── vendor/                   # 100% Local Bootstrap 5, SweetAlert2, Chart.js
│   ├── index.php                     # Front controller
│   └── .htaccess                     # Apache rewrite engine
├── scripts/                          # CLI automation tools
│   ├── migrate.php                   # Runs pending core & module migrations
│   ├── seed.php                      # Runs database seeders
│   ├── reset-demo.php                # Clean reset generating 500+ realistic records
│   ├── make-module.php               # Student module generator
│   └── verify_phase2.php             # Automated testing suite
├── storage/                          # Logs, sessions, and uploads (git-ignored)
├── docs/                             # Architecture decisions & developer guides
│   ├── DECISIONS.md                  # Architectural decision record
│   ├── TEMPLATE_ANALYSIS.md          # Audit of SB Admin 2 to Bootstrap 5 migration
│   └── MODULE_GUIDE.md               # Step-by-step tutorial for student groups
├── .env                              # Environment variables (DB credentials)
├── .gitignore                        # XAMPP & OS-safe Git exclusion rules
├── CONTRIBUTING.md                   # Collaboration rules for 11 student groups
└── README.md                         # This file
```

---

## 8. For Student Developers

Read [`docs/MODULE_GUIDE.md`](docs/MODULE_GUIDE.md) and [`CONTRIBUTING.md`](CONTRIBUTING.md) before writing your first line of code!

- **Never edit files in `core/` or `app/`**.
- **Always use your assigned table prefix** (e.g. `hsg_` for Housing).
- **Run migrations**: `php scripts/migrate.php <slug>`.
- **Register widgets**: Return your telemetry array in `modules/<slug>/widgets.php`.
- **Follow Data Privacy (RA 10173)**: Protect student and health data with confidential permissions.

---

## 9. License & University Attribution

Developed for the **College of Information and Computing Sciences (CICS)**,  
**Marinduque State University (MarSU)**, Boac, Marinduque, Philippines.  
All rights reserved © 2026.

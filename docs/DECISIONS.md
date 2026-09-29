# Architectural & Technical Decision Log (ADR)
**Project:** MarSU Centralized ERP & Executive Dashboard (`marsu-erp`)  
**Scope:** Core Platform & Multi-Module Architecture  

---

## Decision 001: Template Base & Modernization to Bootstrap 5
- **Context:** The workspace contains Start Bootstrap SB Admin 2 v4.1.3 based on Bootstrap 4.6.0 with jQuery dependencies. The project specification mandates native Bootstrap 5 with vanilla JavaScript and zero CDN dependency.
- **Decision:** Modernize the template to Bootstrap 5.3+ HTML semantics and utilities (`data-bs-*`, `me-*`/`ms-*`, `form-select`, etc.). Eliminate jQuery in favor of clean vanilla ES6 JavaScript in `public/assets/js/app.js`.
- **Consequences:** The system is lightweight, fast, modern, and does not carry legacy jQuery baggage while preserving the clean SB Admin layout.

## Decision 002: Base URL & Path Portability (`marsu-erp` vs `marsu_sc`)
- **Context:** The active workspace folder is `c:\xampp\htdocs\marsu_sc`, but the prompt references `http://localhost/marsu-erp/` and XAMPP root.
- **Decision:** 
  1. Created a Windows directory junction `c:\xampp\htdocs\marsu-erp` pointing to `c:\xampp\htdocs\marsu_sc`.
  2. Implement dynamic base URL detection in `core/helpers.php` and `core/Router.php`: detects the script subfolder automatically (e.g., `/marsu-erp/`, `/marsu_sc/`, or root `/`).
  3. Support dual-routing: Pretty URLs via `.htaccess` mod_rewrite (`/students/create`) and query parameter fallback (`index.php?r=students/create`).
- **Consequences:** The application works seamlessly out-of-the-box whether opened at `http://localhost/marsu-erp/`, `http://localhost/marsu_sc/`, or with mod_rewrite disabled.

## Decision 003: Asset Optimization & Offline Bundling
- **Context:** The workspace contained an uncompressed 8.5 MB `marsu.png` and external CDN font links.
- **Decision:** 
  1. Optimize `marsu.png` into web-optimized standard resolutions (128x128, 256x256, 512x512) and SVG placeholder in `public/assets/img/`.
  2. Store all vendor libraries locally in `public/assets/vendor/` (Bootstrap 5, Bootstrap Icons, SweetAlert2, Chart.js).
  3. Avoid external Google Fonts and CDN calls; use a modern system font stack (`system-ui, -apple-system, Segoe UI, Roboto`) with zero external network requests.
- **Consequences:** 100% offline-capable on local XAMPP without internet connection. Page load times drop from seconds to milliseconds.

## Decision 004: Multi-Module Autodiscovery Contract
- **Context:** 11 student groups will work on modules in parallel in one Git repository. Any conflict in core files will break builds.
- **Decision:** 
  1. Core `ModuleLoader` discovers modules strictly from `modules/*/module.json`.
  2. Modules register their routes, permissions, menu items, migrations, and dashboard widgets declaratively in `module.json` and local files.
  3. Core never hardcodes module names or table references. Modules use strict table prefixes (`hsg_`, `wlm_`, etc.).
  4. Core tables (`users`, `students`, `employees`, `departments`, etc.) serve as read-only master data for modules.
- **Consequences:** Student groups work in complete isolation within their respective `modules/<slug>/` folder without ever modifying `core/` or `app/`.

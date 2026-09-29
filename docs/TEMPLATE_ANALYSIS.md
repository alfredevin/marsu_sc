# Template Analysis & Migration Specification
**Target Project:** MarSU CICS Centralized ERP & Executive Dashboard (`marsu-erp`)  
**Base Template:** Start Bootstrap — SB Admin 2 v4.1.3  
**Analysis Date:** September 2026  
**Lead Architect:** Senior Full-Stack Engineer & Core Architect  

---

## 1. Executive Summary & Findings

The existing template in the workspace root is **Start Bootstrap - SB Admin 2 (v4.1.3)**.  
While SB Admin 2 provides a solid, classic dashboard layout structure (collapsible sidebar, fixed topbar, utility cards, and responsive container wrapper), the current codebase has significant architectural gaps and technical debt that must be resolved to meet our core platform requirements:

1. **Outdated Bootstrap Version (v4.6.0)**: The template is built on Bootstrap 4 with jQuery dependencies, deprecated data attributes (`data-toggle`, `data-target`, `data-dismiss`), and legacy grid/flex classes. It must be migrated to **Bootstrap 5.3+** with **Vanilla JavaScript** (zero jQuery dependency).
2. **Missing Dark Mode**: SB Admin 2 has no built-in dark theme. Colors are hardcoded in CSS. We must introduce CSS variable tokens and a user-persisted dark mode system using MarSU burgundy-deep tones.
3. **External CDN Dependencies**: The template loads Google Fonts (`fonts.googleapis.com`) and dead Unsplash links (`source.unsplash.com`). The requirement mandates **100% offline capability** with all vendor assets stored locally under `public/assets/vendor/`.
4. **Massive Image Assets**: The root `marsu.png` is **8.5 MB** (8,499,035 bytes) and `bg.jpg` is **648 KB**. Loading an 8.5 MB image directly on web pages degrades performance severely. We must optimize this into lightweight web-ready assets (SVG/compressed PNG) while retaining the crisp seal details.
5. **No Breadcrumbs or Component System**: The static pages lack a unified breadcrumb mechanism, modern modal handling, and PHP-driven partial rendering.
6. **Hardcoded Corporate Blue Theme**: Primary blue (`#4e73df`) is hardcoded across 11,000+ lines of CSS. This must be entirely replaced by the **MarSU Brand Identity** (Burgundy `#800020`, Gold `#D4AF37`, White `#FFFFFF`, and neutral tones) driven by CSS variables in `theme.css`.

---

## 2. Technical Stack Audit

| Dimension | Existing Template (SB Admin 2 v4.1.3) | Target ERP Platform (Core Standard) | Migration Action Required |
| :--- | :--- | :--- | :--- |
| **Framework Version** | Bootstrap 4.6.0 (Legacy) | **Bootstrap 5.3+** | Upgrade markup to BS5 syntax; drop jQuery; modernize utilities |
| **Scripting Layer** | jQuery 3.6.0 + jQuery Easing 1.4.1 | **Vanilla JavaScript (ES6+)** | Rewrite sidebar toggle, scroll-to-top, and accordions to native JS |
| **Iconography** | FontAwesome 5.15.3 (Webfonts + SVGs, ~3MB) | **Bootstrap Icons 1.11+ / Local FontAwesome** | Store local SVGs/fonts in `public/assets/vendor/` (offline ready) |
| **Charts** | Chart.js 2.9.4 | **Chart.js 4.x / Modern Local Bundle** | Localize in vendor folder; apply custom MarSU color palette plugin |
| **Notifications** | Basic BS alerts / None | **SweetAlert2 (v11 local)** + Bootstrap Toasts | Localize SweetAlert2; standard modal & toast event dispatchers |
| **Theme / Tokens** | SCSS with hardcoded hexes (`#4e73df`) | **CSS3 Custom Properties (`theme.css`)** | Override `--bs-primary`, `--marsu-*` variables dynamically |
| **Dark Mode** | Not supported | **Supported via `data-bs-theme="dark"`** | Implemented with `--marsu-burgundy-deep` and saved in local state |
| **Font Family** | Google Fonts Nunito (online CDN) | **Local System UI / Inter / Roboto / Bundled Font** | Clean fallback typography without external requests |

---

## 3. Template Folder Structure Breakdown

```
marsu_sc/ (Current Workspace)
├── 404.html                     [Static BS4 error page]
├── blank.html                   [Blank starter layout]
├── buttons.html                 [Button component showcase]
├── cards.html                   [Cards & KPI widgets showcase]
├── charts.html                  [Chart.js 2.9 canvas samples]
├── forgot-password.html         [Split authentication view]
├── index.html                   [Main executive dashboard demo]
├── login.html                   [User login view with Unsplash bg]
├── register.html                [Registration form]
├── tables.html                  [DataTables BS4 demo table]
├── utilities-*.html             [Animations, borders, colors, other]
├── marsu.png                    [CRITICAL: 8.5MB raw logo file]
├── bg.jpg                       [648KB background image]
├── css/
│   ├── sb-admin-2.css           [Compiled BS4 stylesheet (211 KB)]
│   └── sb-admin-2.min.css       [Minified stylesheet (170 KB)]
├── js/
│   ├── sb-admin-2.js            [Sidebar & scroll jQuery handlers (1.7 KB)]
│   └── demo/                    [Chart & DataTable mock demo scripts]
├── scss/                        [Sass source files with BS4 variables]
└── vendor/
    ├── bootstrap/               [BS 4.6.0 JS & SCSS]
    ├── chart.js/                [Chart.js 2.9.4]
    ├── datatables/              [DataTables 1.10.24 BS4]
    ├── fontawesome-free/        [FontAwesome 5.15.3]
    ├── jquery/                  [jQuery 3.6.0]
    └── jquery-easing/           [jQuery Easing 1.4.1]
```

### Unused & Non-Compliant Files for Deletion / Archival:
- `package.json`, `package-lock.json`, `gulpfile.js`, `.browserslistrc`, `.travis.yml`: **No Node/npm/Gulp allowed** in runtime.
- `PRO_UPGRADE.txt`: Outdated commercial upsell document.
- `vendor/jquery/` & `vendor/jquery-easing/`: To be superseded by vanilla JS.

---

## 4. Layout Parts & Architecture

### 4.1. Sidebar (`#accordionSidebar`, `.sidebar`, `.sidebar-dark`)
- **Structure**: Collapsible navigation rail with brand header, divider rules, section headers (`.sidebar-heading`), and nav items (`.nav-item`).
- **Interactive State**: Toggleable between expanded (`14rem` / 224px) and icon-only collapsed (`6.5rem` / 104px) via `#sidebarToggle` (desktop) and `#sidebarToggleTop` (mobile).
- **BS5 Migration Issues**:
  - Uses `data-toggle="collapse"` and `data-target="#id"` (BS4). Needs `data-bs-toggle="collapse"` and `data-bs-target="#id"`.
  - Nested collapse menus use jQuery animation. Needs BS5 native collapse.
- **MarSU Styling**:
  - Background: Change from linear blue gradient to `--marsu-burgundy-dark` (`#5C0016`).
  - Active Link: 4px solid left border in `--marsu-gold` (`#D4AF37`) with `--marsu-gold-soft` tint (`#FBF3D5`).
  - Heading Labels: Uppercase text in `--marsu-gold` (`#D4AF37`) with letter spacing.
  - Brand Seal: Replace smiling emoji with crisp MarSU official seal and "MarSU ERP" title.

### 4.2. Topbar (`.topbar`, `.navbar`)
- **Structure**: Sticky/static top horizontal navigation bar with search bar, notification center, message badges, user profile dropdown, and mobile menu toggler.
- **BS5 Migration Issues**:
  - Replaces `mr-auto`, `ml-auto`, `mr-3` with BS5 `me-auto`, `ms-auto`, `me-3`.
  - Replaces `data-toggle="dropdown"` with `data-bs-toggle="dropdown"`.
  - Dropdowns require BS5 Popper integration for correct positioning without clipping.
- **MarSU Styling**:
  - Background: Solid `--marsu-white` (`#FFFFFF`).
  - Border Accent: Thin bottom border in `--marsu-gold` (`#D4AF37`, 1px).
  - Avatar Profile: Gold outline ring (`2px solid var(--marsu-gold)`).
  - Theme Switcher: Dark/Light mode toggle switch embedded directly beside user menu.
  - Active Academic Session: Prominent pill badge displaying active AY (e.g., `AY 2026-2027 • 1st Sem`).

### 4.3. Breadcrumbs
- **Current State**: Absent from original SB Admin 2. Only raw `<h1>` page titles exist.
- **New Architecture**: Reusable breadcrumb component dynamically rendered above the page title:
  ```html
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent p-0 small">
      <li class="breadcrumb-item"><a href="index.php?r=dashboard" class="text-marsu-burgundy">Home</a></li>
      <li class="breadcrumb-item"><a href="index.php?r=students" class="text-marsu-burgundy">Students</a></li>
      <li class="breadcrumb-item active" aria-current="page">Master List</li>
    </ol>
  </nav>
  ```

### 4.4. Footer (`footer.sticky-footer`)
- **Structure**: Bottom container anchored to bottom of content wrapper.
- **MarSU Styling**:
  - Text: *"Marinduque State University | College of Information and Computing Sciences"*
  - Subtle gold divider accent bar above copyright notice.
  - Subtext: *"Center of Excellence in Information Technology Education"*

---

## 5. Reusable Components & Migration Plan

### 5.1. Executive KPI Cards
- Current: Uses `.border-left-primary`, `.border-left-success`, `.border-left-info`, `.border-left-warning`.
- Enhancement:
  - Hero KPI row: Burgundy-to-deep gradient background (`linear-gradient(135deg, #800020 0%, #5C0016 100%)`) with white text and gold numerical values.
  - Standard KPI cards: White background, left accent border (4px) in Burgundy or Gold, subtle hover elevation (`translateY(-2px)`), circular icon badge in Burgundy-soft (`#F8E9EC`).

### 5.2. Data Tables & Filters
- Current: Uses DataTables BS4 (`dataTables.bootstrap4.min.css` / `.js`) with jQuery.
- Enhancement:
  - Clean BS5 table styling: `.table.table-hover.align-middle`.
  - Table Header: `--marsu-burgundy` background with `--marsu-white` text.
  - Striped Rows: Subtle `--marsu-burgundy-soft` alternating rows.
  - Hover Rows: `--marsu-gold-soft` highlight.
  - Vanilla JS AJAX filtering, sorting, pagination, search input, and export buttons (CSV, Print).

### 5.3. Forms & Inline Validation
- Current: `.form-control-user` (heavy border radius, BS4 custom checkboxes).
- Enhancement:
  - BS5 `.form-control` and `.form-select` with gold focus ring:
    ```css
    .form-control:focus, .form-select:focus {
      border-color: var(--marsu-gold);
      box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
    }
    ```
  - Standardized `.invalid-feedback` and `.is-invalid` validation states for form submission.
  - CSRF hidden inputs generated automatically via `<?= Csrf::field() ?>`.

### 5.4. Modals
- Current: BS4 `.modal` with `data-dismiss="modal"`.
- Enhancement:
  - BS5 `.modal` with `data-bs-backdrop="static"` and `.btn-close`.
  - Accessible keyboard focus trapping and SweetAlert2 confirmation integration.

### 5.5. Charts (Chart.js)
- Current: Chart.js 2.9.4 with hardcoded blue lines and gray fills.
- Enhancement:
  - Updated Chart.js configuration with MarSU brand palette tokens:
    1. Primary: Burgundy (`#800020`)
    2. Accent: Gold (`#D4AF37`)
    3. Rose Tint: (`#C45A72`)
    4. Dark Gold: (`#B8922A`)
    5. Warm Gray: (`#6E5A5E`)
  - No default blue or green lines. High contrast tooltips and responsive canvas sizing.

---

## 6. Color System & Theme Tokens Specification

### MarSU Palette Tokens (Defined in `public/assets/css/theme.css`)

```css
:root {
  /* Brand Tokens */
  --marsu-burgundy:        #800020; /* Primary brand */
  --marsu-burgundy-dark:   #5C0016; /* Sidebar, headers, hover */
  --marsu-burgundy-deep:   #3D000F; /* Dark mode surface deep */
  --marsu-burgundy-soft:   #F8E9EC; /* Tints, striped rows */
  
  --marsu-gold:            #D4AF37; /* Accent */
  --marsu-gold-dark:       #B8922A; /* Accent hover, borders */
  --marsu-gold-soft:       #FBF3D5; /* Badge backgrounds, highlights */
  
  --marsu-white:           #FFFFFF;
  --marsu-bg:              #FAF7F7; /* App background (warm ivory) */
  --marsu-text:            #2B1A1D; /* High contrast body text */
  --marsu-text-muted:      #6E5A5E; /* Muted captions */
  
  /* Status Colors (Desaturated for harmony) */
  --marsu-success:         #2E7D32;
  --marsu-warning:         #E65100;
  --marsu-danger:          #C62828;
  --marsu-info:            #0277BD;
  
  /* Bootstrap Overrides */
  --bs-primary:            var(--marsu-burgundy);
  --bs-primary-rgb:        128, 0, 32;
  --bs-link-color:         var(--marsu-burgundy);
  --bs-link-hover-color:   var(--marsu-burgundy-dark);
  --bs-body-bg:            var(--marsu-bg);
  --bs-body-color:         var(--marsu-text);
  --bs-border-color:       #EAD9DC;
}

/* Dark Mode Tokens */
[data-bs-theme="dark"] {
  --marsu-bg:              var(--marsu-burgundy-deep);
  --bs-body-bg:            #220008;
  --bs-body-color:         #F5EFF0;
  --marsu-text:            #F5EFF0;
  --marsu-text-muted:      #C9B8BB;
  --bs-card-bg:            #2E000C;
  --bs-border-color:       #4D0A1B;
  --marsu-burgundy-soft:   #3D0512;
  --marsu-gold-soft:       #42320A;
}
```

### Complete Re-Theming Inventory:
1. **Sidebar Background**: `.bg-gradient-primary` $\to$ Solid `--marsu-burgundy-dark` with subtle gradient.
2. **Sidebar Active Item**: Gold left border (`border-left: 4px solid var(--marsu-gold)`), text white, soft gold background tint.
3. **Sidebar Section Headings**: Changed to uppercase `--marsu-gold`.
4. **Topbar**: White surface, 1px bottom border in `--marsu-gold`.
5. **Primary Buttons (`.btn-primary`)**: Background `--marsu-burgundy`, border `--marsu-burgundy`, text white. Hover `--marsu-burgundy-dark`.
6. **Gold Accent Buttons (`.btn-accent`)**: Background `--marsu-gold`, text `--marsu-burgundy-dark`. Hover `--marsu-gold-dark`.
7. **Cards**: White surface, card header with 24px wide, 3px high gold underline indicator.
8. **Tables**: Header `--marsu-burgundy` with white text. Hover rows `--marsu-gold-soft`.
9. **Badges**: Burgundy and gold tint badges (`.badge-burgundy`, `.badge-gold`).
10. **Focus Outlines**: All interactive elements display a gold focus ring.
11. **Login Split Screen**: Left 50% solid Burgundy with MarSU seal, university title, and gold motto; Right 50% white authentication card.
12. **Print Stylesheet**: Clean white background, burgundy headers, official MarSU Boac campus header and footer.

---

## 7. Plan for Conversion into Reusable PHP Layout Partials

We will structure the layout system under `app/Views/layouts/` to provide a clean, zero-friction developer experience for student groups:

```
app/Views/layouts/
├── main.php             # Master layout template (assembles all partials)
├── auth.php             # Clean split layout for Login, Forgot Password, Installer
├── header.php           # HTML <head>, meta tags, CSS variables, vendor styles
├── sidebar.php          # Dynamic sidebar (auto-rendered from ModuleLoader)
├── topbar.php           # Sticky topbar with user dropdown, alerts, theme switch
├── breadcrumbs.php      # Hierarchical breadcrumb navigation
├── footer.php           # Standard MarSU & CICS footer
└── scripts.php          # Local vendor JS (Bootstrap 5, Chart.js, SweetAlert2, app.js)
```

### Partial Rendering Pipeline (`core/View.php`):
When any controller executes:
```php
View::render('students/index', [
    'title'    => 'Student Registry',
    'students' => $studentList,
    'crumbs'   => ['Students' => 'index.php?r=students', 'Directory' => '']
]);
```
The view engine wraps the view buffer inside `layouts/main.php`, automatically injecting breadcrumbs, active menu highlights, CSRF tokens, flash messages, and user context.

---

## 8. Defect & Remediation Matrix

| Defect / Problem in Template | Severity | Impact | Remediation Strategy |
| :--- | :--- | :--- | :--- |
| **8.5 MB `marsu.png`** | High | Massive bandwidth waste; slow initial page load | Resample to optimized 256x256 and 512x512 PNG + SVG logo; store in `public/assets/img/` (<60 KB). Keep raw image in storage. |
| **Broken Unsplash URLs** | Medium | `source.unsplash.com` returns 404 / connection timeouts | Replace with clean local vector illustrations and stylized gradient split cards. |
| **jQuery & Easing Plugin** | Medium | Redundant 90KB payload; conflicts with BS5 | Eliminate jQuery. Write 45 lines of clean Vanilla JS in `public/assets/js/app.js`. |
| **Outdated BS4 Attributes** | High | Modals and dropdowns break under Bootstrap 5 | Migrate all attributes: `data-toggle` $\to$ `data-bs-toggle`, `data-target` $\to$ `data-bs-target`, `data-dismiss` $\to$ `data-bs-dismiss`. |
| **Google Fonts CDN Request** | Medium | System fails on closed intranet / offline XAMPP | Provide system font stack (`system-ui, -apple-system, "Segoe UI", Roboto`) with bundled offline font fallback. |
| **Hardcoded Blue Theme** | High | Incompatible with MarSU university branding | Define tokens in `public/assets/css/theme.css` and enforce strict utility variable usage. |

---

## 9. Conclusion

The existing SB Admin 2 template provides the aesthetic shell needed, but requires complete upgrading to Bootstrap 5, removal of jQuery, offline vendorization, and thorough re-theming with the MarSU Burgundy and Gold color tokens.

Upon user confirmation of this analysis and implementation plan, we will proceed immediately to **Phase 1 (Architecture & Core Engine)**.

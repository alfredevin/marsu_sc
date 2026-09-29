# GitHub Copilot Instructions for MarSU Centralized ERP

- Work exclusively inside assigned module directories: `modules/<module_slug>/`.
- Never modify core directories: `core/`, `app/`, `database/migrations/` (core), `scripts/`.
- Every database table must use the designated table prefix (`exp_`, `kmp_`, `wkl_`, `hth_`, `orf_`, `sld_`, `hsg_`, `ret_`, `ast_`, `wlf_`, `gdc_`).
- Strict Native PHP 8.2+ without frameworks, Composer, or npm build steps.
- Use PDO prepared statements with `Core\Database` wrapper functions.
- Use Bootstrap 5.3 markup (`data-bs-*`) and vanilla JS. Never use jQuery.
- Apply CSRF protection (`<?= csrf_field() ?>`) and HTML escaping (`<?= e($var) ?>`).
- Enforce Data Privacy Act of 2012 (RA 10173) for health, welfare, and guidance modules.

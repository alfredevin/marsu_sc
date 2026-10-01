/**
 * MarSU Centralized ERP - Core Vanilla JavaScript Client Engine
 * Zero jQuery dependency - Pure modern ES6+
 */

(function () {
  'use strict';

  // 1. Theme (Dark / Light) Initializer & Toggle
  const THEME_KEY = 'marsu_erp_theme';
  
  function applyTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
    const themeIcon = document.getElementById('theme-icon') || document.getElementById('themeIcon');
    if (themeIcon) {
      themeIcon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
      themeIcon.style.color = theme === 'dark' ? '#FFD700' : 'var(--marsu-burgundy)';
    }
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    if (themeToggleBtn) {
      themeToggleBtn.setAttribute('title', theme === 'dark' ? 'Switch to Light Theme' : 'Switch to Dark Theme');
    }
  }

  const savedTheme = localStorage.getItem(THEME_KEY) || 'light';
  applyTheme(savedTheme);

  document.addEventListener('DOMContentLoaded', function () {
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
        localStorage.setItem(THEME_KEY, nextTheme);
        applyTheme(nextTheme);
      });
    }

    // 2. Sidebar Toggle & Persistence
    const SIDEBAR_KEY = 'marsu_sidebar_collapsed';
    const isCollapsed = localStorage.getItem(SIDEBAR_KEY) === 'true';
    if (isCollapsed && window.innerWidth >= 992) {
      document.body.classList.add('sidebar-toggled');
    }

    const sidebarToggles = document.querySelectorAll('#sidebarToggle, #sidebarToggleTop');
    sidebarToggles.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        document.body.classList.toggle('sidebar-toggled');
        const collapsedNow = document.body.classList.contains('sidebar-toggled');
        localStorage.setItem(SIDEBAR_KEY, collapsedNow);
      });
    });

    // Close sidebar on mobile resize
    window.addEventListener('resize', function () {
      if (window.innerWidth < 768) {
        document.body.classList.add('sidebar-toggled');
      }
    });

    // 3. Scroll to Top Button
    const scrollTopBtn = document.getElementById('scrollToTopBtn');
    if (scrollTopBtn) {
      window.addEventListener('scroll', function () {
        if (window.pageYOffset > 250) {
          scrollTopBtn.style.display = 'flex';
        } else {
          scrollTopBtn.style.display = 'none';
        }
      });

      scrollTopBtn.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    // 4. Global SweetAlert2 Confirmation for Deletes & Sensitive Actions
    document.addEventListener('click', function (e) {
      const deleteBtn = e.target.closest('[data-confirm-delete]');
      if (deleteBtn) {
        e.preventDefault();
        const form = deleteBtn.closest('form');
        const customMessage = deleteBtn.getAttribute('data-confirm-delete') || 'This action cannot be undone.';
        
        if (window.Swal) {
          Swal.fire({
            title: 'Are you sure?',
            text: customMessage,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#800020',
            cancelButtonColor: '#6E5A5E',
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              if (form) {
                form.submit();
              } else if (deleteBtn.getAttribute('href')) {
                window.location.href = deleteBtn.getAttribute('href');
              }
            }
          });
        } else {
          if (confirm(customMessage)) {
            if (form) form.submit();
            else if (deleteBtn.getAttribute('href')) window.location.href = deleteBtn.getAttribute('href');
          }
        }
      }
    });

    // 5. Flash Message Auto-Display (SweetAlert2 Toast)
    const flashSuccess = document.querySelector('[data-flash-success]');
    const flashError = document.querySelector('[data-flash-error]');
    const flashInfo = document.querySelector('[data-flash-info]');

    if (window.Swal) {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer);
          toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
      });

      if (flashSuccess && flashSuccess.dataset.flashSuccess) {
        Toast.fire({ icon: 'success', title: flashSuccess.dataset.flashSuccess });
      }
      if (flashError && flashError.dataset.flashError) {
        Toast.fire({ icon: 'error', title: flashError.dataset.flashError });
      }
      if (flashInfo && flashInfo.dataset.flashInfo) {
        Toast.fire({ icon: 'info', title: flashInfo.dataset.flashInfo });
      }
    }

    // 6. Generic AJAX Table Search & Client Filter
    const liveSearchInputs = document.querySelectorAll('[data-table-search]');
    liveSearchInputs.forEach(input => {
      const targetTableId = input.getAttribute('data-table-search');
      const table = document.getElementById(targetTableId);
      if (!table) return;

      input.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(query) ? '' : 'none';
        });
      });
    });

    // 7. Auto-dismiss alerts after 5 seconds
    const autoAlerts = document.querySelectorAll('.alert-auto-dismiss');
    autoAlerts.forEach(alert => {
      setTimeout(() => {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
        if (bsAlert) bsAlert.close();
      }, 5000);
    });

    // 8. Global Keyboard Focus for Search (/ key)
    document.addEventListener('keydown', function (e) {
      if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
        const globalSearch = document.querySelector('input[name="q"]');
        if (globalSearch) {
          e.preventDefault();
          globalSearch.focus();
          globalSearch.select();
        }
      }
    });

  });

  // 9. Global MarSU Chart.js Defaults & Palette Order
  if (window.Chart) {
    Chart.defaults.font.family = 'system-ui, -apple-system, Segoe UI, Roboto, sans-serif';
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#6E5A5E';
    
    // Strict MarSU Palette Order: Burgundy, Gold, Rose Tint, Dark Gold, Warm Gray
    window.MarsuPalette = [
      '#800020', // Burgundy
      '#D4AF37', // Gold
      '#C45A72', // Rose Tint
      '#B8922A', // Dark Gold
      '#6E5A5E', // Warm Gray
      '#5C0016', // Burgundy Dark
      '#FBF3D5'  // Gold Soft
    ];
  }

})();

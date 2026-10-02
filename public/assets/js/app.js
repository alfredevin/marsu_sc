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

    // 5. MarSU Executive HUD Notifications & Session Transitions
    const flashSuccess = document.querySelector('[data-flash-success]');
    const flashError = document.querySelector('[data-flash-error]');
    const flashInfo = document.querySelector('[data-flash-info]');

    function escapeHtml(str) {
      if (!str) return '';
      return String(str).replace(/[&<>"']/g, function (m) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[m];
      });
    }

    function showMarsuWelcomeHud(msg) {
      let name = 'Executive';
      const match = msg.match(/Welcome back,\s*([^!]+)!?/i);
      if (match && match[1]) {
        name = match[1].trim();
      }

      const hud = document.createElement('div');
      hud.className = 'marsu-hud-banner';
      hud.innerHTML = `
        <div class="d-flex align-items-center gap-3">
          <div class="marsu-hud-icon-wrap">
            <i class="bi bi-shield-check"></i>
            <div class="marsu-hud-pulse"></div>
          </div>
          <div class="flex-grow-1 min-w-0">
            <div class="d-flex align-items-center gap-2 mb-1">
              <span class="badge bg-warning text-dark fw-bold px-2 py-0" style="font-size: 0.65rem; letter-spacing: 0.04em;">
                <i class="bi bi-cpu-fill me-1"></i> MARSU ERP CORE
              </span>
              <span class="badge bg-secondary bg-opacity-50 text-white-50 px-2 py-0" style="font-size: 0.65rem;">
                AUTHENTICATED
              </span>
            </div>
            <h6 class="text-white fw-bold mb-0" style="letter-spacing: -0.01em;">Welcome back, ${escapeHtml(name)}!</h6>
            <p class="text-white-50 small mb-0" style="font-size: 0.76rem;">
              <i class="bi bi-geo-alt-fill text-warning me-1"></i>Santa Cruz Campus &bull; Executive BI Session Active
            </p>
          </div>
          <button type="button" class="btn-close btn-close-white btn-sm ms-2" aria-label="Close"></button>
        </div>
        <div class="marsu-hud-bar animate"></div>
      `;
      document.body.appendChild(hud);

      requestAnimationFrame(() => {
        setTimeout(() => hud.classList.add('active'), 120);
      });

      const dismiss = () => {
        hud.classList.remove('active');
        setTimeout(() => hud.remove(), 600);
      };

      hud.querySelector('.btn-close').addEventListener('click', dismiss);
      setTimeout(dismiss, 4500);
    }

    function showMarsuNotification(type, msg) {
      const isErr = type === 'error';
      const icon = isErr ? 'bi-exclamation-triangle-fill text-danger' : 'bi-check-circle-fill text-success';
      const borderCol = isErr ? 'rgba(239, 68, 68, 0.65)' : 'rgba(212, 175, 55, 0.65)';
      
      const toast = document.createElement('div');
      toast.className = 'marsu-hud-banner';
      toast.style.borderColor = borderCol;
      toast.innerHTML = `
        <div class="d-flex align-items-center gap-3">
          <div class="marsu-hud-icon-wrap" style="border-color: ${borderCol};">
            <i class="bi ${icon}"></i>
          </div>
          <div class="flex-grow-1 min-w-0">
            <div class="badge bg-secondary bg-opacity-25 text-warning px-2 py-0 mb-1" style="font-size: 0.65rem;">
              MARSU SYSTEM NOTICE
            </div>
            <div class="text-white small fw-semibold">${escapeHtml(msg)}</div>
          </div>
          <button type="button" class="btn-close btn-close-white btn-sm ms-2" aria-label="Close"></button>
        </div>
        <div class="marsu-hud-bar animate"></div>
      `;
      document.body.appendChild(toast);

      requestAnimationFrame(() => {
        setTimeout(() => toast.classList.add('active'), 120);
      });

      const dismiss = () => {
        toast.classList.remove('active');
        setTimeout(() => toast.remove(), 600);
      };

      toast.querySelector('.btn-close').addEventListener('click', dismiss);
      setTimeout(dismiss, 4200);
    }

    if (flashSuccess && flashSuccess.dataset.flashSuccess) {
      const sMsg = flashSuccess.dataset.flashSuccess;
      if (sMsg.toLowerCase().includes('welcome back')) {
        showMarsuWelcomeHud(sMsg);
      } else {
        showMarsuNotification('success', sMsg);
      }
    }
    if (flashError && flashError.dataset.flashError) {
      showMarsuNotification('error', flashError.dataset.flashError);
    }
    if (flashInfo && flashInfo.dataset.flashInfo) {
      showMarsuNotification('info', flashInfo.dataset.flashInfo);
    }

    // 5.1 Interactive MarSU Security Gate Transitions (Logout & Login)
    window.showMarsuSecurityOverlay = function (title, subtitle) {
      let overlay = document.getElementById('marsuSecurityOverlay');
      if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'marsuSecurityOverlay';
        overlay.className = 'marsu-security-overlay';
        overlay.innerHTML = `
          <div class="marsu-orbit-spinner">
            <div class="marsu-orbit-ring-outer"></div>
            <div class="marsu-orbit-ring-inner"></div>
            <div class="marsu-orbit-center-logo">
              <i class="bi bi-shield-lock-fill text-warning fs-3"></i>
            </div>
          </div>
          <h5 class="fw-bold text-white mb-2" id="marsuOverlayTitle" style="letter-spacing: 0.02em;">Authenticating...</h5>
          <p class="text-white-50 small mb-0 text-center px-3" id="marsuOverlaySub" style="max-width: 440px;">
            Please wait while the system secures your session.
          </p>
        `;
        document.body.appendChild(overlay);
      }

      document.getElementById('marsuOverlayTitle').textContent = title;
      document.getElementById('marsuOverlaySub').textContent = subtitle;

      requestAnimationFrame(() => {
        overlay.classList.add('active');
      });
    };

    // Logout Transition
    document.querySelectorAll('form[action*="logout"]').forEach(form => {
      form.addEventListener('submit', function (e) {
        if (this.dataset.animating) return;
        e.preventDefault();
        this.dataset.animating = 'true';

        window.showMarsuSecurityOverlay('Securing MarSU Session...', 'Encrypting audit trail and safely terminating session...');

        setTimeout(() => {
          this.submit();
        }, 750);
      });
    });

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

<style>
    .sidebar-heading {
        display: none !important;
    }
</style>
<script>
(function enhanceSidebarIcons() {
    function applyIcons() {
        document.querySelectorAll('.sidebar-heading').forEach(el => {
            if (el.textContent.trim().toUpperCase().includes('STUDENT MODULES')) {
                el.style.setProperty('display', 'none', 'important');
            }
        });

        const iconMap = {
            'proposalsandapprovals': 'bi-file-earmark-check',
            'researchprofiles': 'bi-person-badge',
            'researchprojects': 'bi-journal-code',
            'fundingandresources': 'bi-cash-coin',
            'projectmilestone': 'bi-flag',
            'implementationprogress': 'bi-hourglass-split',
            'evaluationforms': 'bi-clipboard-data',
            'performanceindicators': 'bi-graph-up-arrow',
            'completionreporting': 'bi-award',
            'researchstorage': 'bi-hdd-network',
            'filemanagement': 'bi-folder-symlink',
            'knowledgemanagement': 'bi-book-half',
            'searchableresearch': 'bi-search'
        };

        const sidebarLinks = document.querySelectorAll('.sidebar-nested-submenu a.nav-link, .sidebar-submenu a.nav-link, #sidebar a.nav-link, nav a.nav-link');
        sidebarLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            for (const [slug, iconClass] of Object.entries(iconMap)) {
                if (href.indexOf('irimkms/' + slug) !== -1) {
                    const iconEl = link.querySelector('i');
                    if (iconEl) {
                        iconEl.className = 'bi ' + iconClass + ' me-2';
                    } else {
                        const newIcon = document.createElement('i');
                        newIcon.className = 'bi ' + iconClass + ' me-2';
                        link.insertBefore(newIcon, link.firstChild);
                    }
                    break;
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applyIcons);
    } else {
        applyIcons();
    }
    setTimeout(applyIcons, 300);
    setTimeout(applyIcons, 1000);
})();
</script>

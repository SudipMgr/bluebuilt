// ================================
// SIDEBAR MOBILE MENU
// ================================
(function () {
  function initSidebar() {
    const hamburger = document.getElementById('navHamburger');
    const sidebar   = document.getElementById('navSidebar');
    const overlay   = document.getElementById('sidebarOverlay');
    const closeBtn  = document.getElementById('sidebarClose');

    if (!hamburger || !sidebar) return;

    function openSidebar() {
      sidebar.classList.add('open');
      sidebar.setAttribute('aria-hidden', 'false');
      overlay && overlay.classList.add('open');
      hamburger.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
      sidebar.classList.remove('open');
      sidebar.setAttribute('aria-hidden', 'true');
      overlay && overlay.classList.remove('open');
      hamburger.classList.remove('is-open');
      document.body.style.overflow = '';
    }

    hamburger.addEventListener('click', () => {
      sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    closeBtn  && closeBtn.addEventListener('click', closeSidebar);
    overlay   && overlay.addEventListener('click', closeSidebar);

    // Close when a nav link is clicked
    sidebar.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', closeSidebar);
    });

    // Close on Escape
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeSidebar();
    });

    // Highlight the active page
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    sidebar.querySelectorAll('a').forEach(a => {
      const href = a.getAttribute('href');
      if (href === currentPage || (currentPage === '' && href === 'index.html')) {
        a.classList.add('active');
      }
    });
  }

  // For index.html: sections loaded asynchronously via fetch — retry after DOM settles
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSidebar);
  } else {
    initSidebar();
    if (!document.getElementById('navSidebar')) {
      setTimeout(initSidebar, 400);
    }
  }
})();

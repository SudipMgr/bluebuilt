// ================================
// GALLERY — Lightbox + Filters
// ================================
(function () {

  let currentIndex = 0;
  let galleryItems = [];

  // ---- BUILD LIGHTBOX DOM (once) -------------------------
  function buildLightbox() {
    if (document.getElementById('site-lightbox')) return;
    const lb = document.createElement('div');
    lb.id = 'site-lightbox';
    lb.className = 'lightbox';
    lb.setAttribute('role', 'dialog');
    lb.setAttribute('aria-modal', 'true');
    lb.innerHTML = `
      <div class="lightbox-inner">
        <button class="lightbox-close" id="lb-close" aria-label="Close">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M1 1l12 12M13 1L1 13"/>
          </svg>
        </button>
        <button class="lightbox-arrow prev" id="lb-prev" aria-label="Previous">
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M11 4L6 9l5 5"/>
          </svg>
        </button>
        <button class="lightbox-arrow next" id="lb-next" aria-label="Next">
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M7 4l5 5-5 5"/>
          </svg>
        </button>
        <div class="lightbox-img-wrap" id="lb-img-wrap"></div>
        <div class="lightbox-counter" id="lb-counter"></div>
      </div>`;
    document.body.appendChild(lb);

    document.getElementById('lb-close').addEventListener('click', closeLightbox);
    document.getElementById('lb-prev').addEventListener('click', () => navigate(-1));
    document.getElementById('lb-next').addEventListener('click', () => navigate(1));
    lb.addEventListener('click', e => { if (e.target === lb) closeLightbox(); });
    document.addEventListener('keydown', e => {
      if (!document.getElementById('site-lightbox').classList.contains('open')) return;
      if (e.key === 'Escape')      closeLightbox();
      if (e.key === 'ArrowLeft')   navigate(-1);
      if (e.key === 'ArrowRight')  navigate(1);
    });
  }

  function openLightbox(items, index) {
    galleryItems = items;
    currentIndex = index;
    buildLightbox();
    render();
    document.getElementById('site-lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    document.getElementById('site-lightbox').classList.remove('open');
    document.body.style.overflow = '';
  }

  function navigate(dir) {
    currentIndex = (currentIndex + dir + galleryItems.length) % galleryItems.length;
    render();
  }

  function render() {
    const item = galleryItems[currentIndex];
    if (!item) return;
    const wrap = document.getElementById('lb-img-wrap');
    // Use real img tag
    wrap.innerHTML = `<img src="${item.src}" alt="${item.alt || ''}" style="width:100%;height:auto;max-height:78vh;display:block;object-fit:contain;">`;
    document.getElementById('lb-counter').textContent = (currentIndex + 1) + ' / ' + galleryItems.length;
    // Hide arrows if single image
    const hide = galleryItems.length <= 1;
    document.getElementById('lb-prev').style.display = hide ? 'none' : '';
    document.getElementById('lb-next').style.display = hide ? 'none' : '';
  }

  // ---- INIT GALLERY ITEMS --------------------------------
  function initGallery() {
    const els = document.querySelectorAll('[data-gallery-item]');
    if (!els.length) return;

    els.forEach((el, i) => {
      el.addEventListener('click', () => {
        // Build visible items array at click time (respects active filter)
        const visible = Array.from(document.querySelectorAll('[data-gallery-item]:not(.hidden)'));
        const idx     = visible.indexOf(el);
        const items   = visible.map(v => ({
          src: v.dataset.src || (v.querySelector('img') ? v.querySelector('img').src : ''),
          alt: v.dataset.alt || ''
        }));
        openLightbox(items, Math.max(idx, 0));
      });
    });

    initFilters(els);
  }

  // ---- FILTER TABS ---------------------------------------
  function initFilters(els) {
    const btns = document.querySelectorAll('.gallery-filter-btn');
    if (!btns.length) return;
    btns.forEach(btn => {
      btn.addEventListener('click', function () {
        const filter = this.dataset.filter || 'all';
        btns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        els.forEach(el => {
          const match = filter === 'all' || el.dataset.filter === filter;
          el.classList.toggle('hidden', !match);
        });
      });
    });
  }

  // ---- BOOT ----------------------------------------------
  function boot() { initGallery(); }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    setTimeout(boot, 300);
  }

})();

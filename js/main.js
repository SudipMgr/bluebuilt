// ================================
// Scroll Progress Bar
// ================================
const scrollProgress = document.getElementById('scrollProgress');
window.addEventListener('scroll', () => {
  const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
  scrollProgress.style.height = pct + '%';
});

// ================================
// Scroll Reveal
// ================================
const reveals = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });
reveals.forEach(el => revealObserver.observe(el));

// ================================
// Process Nav Active State
// ================================
const processSteps = document.querySelectorAll('.process-step');
const navItems = document.querySelectorAll('.process-nav-item');
if (processSteps.length && navItems.length) {
  const stepObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const idx = Array.from(processSteps).indexOf(entry.target);
        navItems.forEach((n, i) => n.classList.toggle('active', i === idx));
      }
    });
  }, { threshold: 0.5 });
  processSteps.forEach(s => stepObserver.observe(s));
}

// ================================
// Smooth Scroll for Anchor Links
// ================================
document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', e => {
    const target = document.querySelector(link.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

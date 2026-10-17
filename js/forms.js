// ============================================================
//  forms.js — Elwood Blues Construction
//  Handles form submission for Home page and Contact page.
//  POSTs to send-mail.php using fetch() — no 3rd party needed.
// ============================================================

// ---- HELPERS -----------------------------------------------

function getVal(id) {
  const el = document.getElementById(id);
  return el ? el.value.trim() : '';
}

function setFieldError(id, hasError) {
  const el = document.getElementById(id);
  if (!el) return;
  el.style.borderColor = hasError
    ? '#E24B4A'
    : 'rgba(184,115,51,0.2)';
}

function setBtn(btn, state) {
  if (!btn) return;
  const idle = btn.dataset.idleLabel || btn.textContent;
  btn.dataset.idleLabel = idle;

  const map = {
    idle:    idle,
    loading: 'Sending…',
    error:   'Failed — Try Again',
  };
  btn.textContent = map[state] || idle;
  btn.disabled    = state === 'loading';
  btn.style.opacity    = state === 'loading' ? '0.65' : '1';
  btn.style.background = state === 'error'   ? '#8B3020' : '';
}

function showSuccess(containerId, successId) {
  const container = document.getElementById(containerId);
  const success   = document.getElementById(successId);
  if (!container || !success) return;

  container.style.transition = 'opacity 0.4s';
  container.style.opacity    = '0';
  setTimeout(() => {
    container.style.display  = 'none';
    success.style.display    = 'block';
    success.style.opacity    = '0';
    success.style.transition = 'opacity 0.4s';
    requestAnimationFrame(() => { success.style.opacity = '1'; });
  }, 400);
}

function showInlineError(msg) {
  let el = document.getElementById('form-error-msg');
  if (!el) {
    el = document.createElement('p');
    el.id = 'form-error-msg';
    el.style.cssText = [
      'color:#E87070',
      'font-size:0.83rem',
      'margin-top:0.75rem',
      'text-align:center',
      'line-height:1.5',
    ].join(';');
    const btn = document.getElementById('submitBtn');
    if (btn && btn.parentNode) btn.parentNode.appendChild(el);
  }
  el.textContent = msg;
}

// ---- SUBMIT HANDLER ----------------------------------------

async function handleSubmit(formSource) {
  const btn = document.getElementById('submitBtn');

  // Collect fields
  const firstName = getVal('firstName');
  const lastName  = getVal('lastName');
  const email     = getVal('email');
  const phone     = getVal('phone');
  const address   = getVal('address');
  const service   = getVal('service');
  const budget    = getVal('budget');
  const timeline  = getVal('timeline');
  const message   = getVal('message');

  // Validate
  const firstOk = firstName.length > 0;
  const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  setFieldError('firstName', !firstOk);
  setFieldError('email',     !emailOk);
  if (!firstOk || !emailOk) return;

  // Build form data
  const data = new FormData();
  data.append('firstName',   firstName);
  data.append('lastName',    lastName);
  data.append('email',       email);
  data.append('phone',       phone       || 'Not provided');
  data.append('address',     address     || 'Not provided');
  data.append('service',     service     || 'Not specified');
  data.append('budget',      budget      || 'Not specified');
  data.append('timeline',    timeline    || 'Not specified');
  data.append('message',     message     || 'No message provided');
  data.append('form_source', formSource);
  data.append('website',     getVal('website'));   // honeypot — real bots fill this in

  setBtn(btn, 'loading');

  try {
    const res  = await fetch('send-mail.php', { method: 'POST', body: data });
    const json = await res.json();

    if (json.success) {
      showSuccess('form-container', 'form-success');
    } else {
      setBtn(btn, 'error');
      showInlineError(json.message || 'Something went wrong. Please try again or call us directly.');
      setTimeout(() => setBtn(btn, 'idle'), 4000);
    }
  } catch (err) {
    setBtn(btn, 'error');
    showInlineError('Could not connect. Please check your internet connection or call (623) 262-6579.');
    setTimeout(() => setBtn(btn, 'idle'), 4000);
  }
}

// ---- BOOT --------------------------------------------------

function bootForms() {
  const btn = document.getElementById('submitBtn');
  if (!btn) return;

  // Detect which page we're on by checking for contact-page-only fields
  const isContactPage = !!(
    document.getElementById('address') ||
    document.getElementById('timeline')
  );

  const source = isContactPage ? 'Contact Page' : 'Home Page — Contact Form';

  btn.addEventListener('click', () => handleSubmit(source));
}

// On the Contact page, forms.js loads normally with the page, so
// DOMContentLoaded hasn't fired yet when this runs.
// On the Home page, forms.js is injected dynamically AFTER all
// sections are fetched in — by which point DOMContentLoaded has
// already fired once and will never fire again. So: run immediately
// if the document is already ready, otherwise wait for the event.
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', bootForms);
} else {
  bootForms();
}

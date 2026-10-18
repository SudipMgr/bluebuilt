<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact — Elwood Blues Construction</title>
  <meta name="description" content="Get in touch with Harris Lyons at Elwood Blues Construction. Request a consultation for your Phoenix remodeling or construction project.">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/gallery.css">
  <link rel="stylesheet" href="css/footer.css">
  <style>
    /* PAGE HERO */
    .page-hero {
      min-height: 46vh;
      display: flex; flex-direction: column; justify-content: flex-end;
      padding: 10rem 3rem 5rem;
      position: relative; overflow: hidden; background: #fff;
    }
    .page-hero-bg {
      position: absolute; inset: 0;
      background:
      radial-gradient(ellipse 60% 80% at 80% 40%, rgba(2,32,244,0.07) 0%, transparent 70%),
      radial-gradient(ellipse 40% 50% at 10% 80%, rgba(2,32,244,0.04) 0%, transparent 60%);
    }
    .page-hero-grid {
      position: absolute; inset: 0; opacity: 0.03;
      background-image:
      repeating-linear-gradient(0deg, var(--copper) 0px, transparent 1px, transparent 80px, var(--copper) 80px),
      repeating-linear-gradient(90deg, var(--copper) 0px, transparent 1px, transparent 80px, var(--copper) 80px);
    }
    .page-hero-content { position: relative; z-index: 1;}
    .page-breadcrumb {
      display: flex; align-items: center; gap: 0.6rem;
      font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase;
      color: var(--text-muted); margin-bottom: 2rem;
      opacity: 0; animation: fadeUp 0.6s 0.1s forwards;
    }
    .page-breadcrumb a { color: var(--copper); text-decoration: none; }
    .page-breadcrumb a:hover { color: var(--copper-light); }
    .page-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(3rem, 6vw, 5rem);
      font-weight: 300; line-height: 1.05; letter-spacing: -0.02em;
      margin-bottom: 1.5rem; opacity: 0; animation: fadeUp 0.7s 0.2s forwards;
    }
    .page-title em { font-style: italic; color: var(--copper-light); }
    .page-lead {
      font-size: 1rem; line-height: 1.8; color: var(--text-muted);
      opacity: 0; animation: fadeUp 0.7s 0.35s forwards;
    }
    .page-hero-rule {
      position: absolute; bottom: 0; left: 3rem; right: 3rem;
      height: 1px; background: linear-gradient(to right, var(--copper), transparent); opacity: 0.3;
    }

    /* CONTACT LAYOUT */
    .contact-main {
      background: #D9DEF9;
      display: grid; grid-template-columns: 1fr 1.4fr;
      gap: 0; min-height: 80vh;
    }
    .contact-sidebar {
      background: #efefef;
      padding: 5rem 4rem;
      border-right: 1px solid rgba(2,32,244,0.12);
      display: flex; flex-direction: column;
    }
    .contact-sidebar .section-eyebrow { margin-bottom: 1rem; }
    .sidebar-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem; font-weight: 300;
      color: #0220f4; line-height: 1.1; margin-bottom: 1.5rem;
    }
    .sidebar-intro { font-size: 0.9rem; line-height: 1.8; color: var(--text-muted); margin-bottom: 3rem; }
    .contact-methods { display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 3rem; }
    .contact-method {
      display: flex; gap: 1rem; align-items: flex-start;
      padding: 1.25rem; border: 1px solid rgba(2,32,244,0.15);
      transition: border-color 0.3s;
      background: #d9def9;
    }
    .contact-method:hover { border-color: rgba(2,32,244,0.4); }
    .cm-icon {
      width: 38px; height: 38px; flex-shrink: 0;
      background: rgba(2,32,244,0.1);
      display: flex; align-items: center; justify-content: center; color: var(--copper);
    }
    .cm-label { font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; }
    .cm-value {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.15rem; color: #000;
      text-decoration: none; transition: color 0.3s;
    }
    .cm-value:hover { color: var(--copper-light); }
    .cm-note { font-size: 0.75rem; color: #5769df; margin-top: 0.2rem; }
    .bbb-block {
      margin-top: auto;
      padding: 1.5rem; border: 1px solid rgba(2,32,244,0.2);
    }
    .bbb-block-title {
      font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase;
      color: var(--copper); margin-bottom: 0.6rem;
    }
    .bbb-block-text { font-size: 0.83rem; color: var(--text-muted); line-height: 1.65; }
    .bbb-block-text a { color: var(--copper-light); text-decoration: none; }

    /* FORM */
    .contact-form-wrap { padding: 5rem 4rem; }
    .form-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem; font-weight: 300;
      color: #000; margin-bottom: 0.5rem;
    }
    .form-subtitle { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 2.5rem; line-height: 1.65; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
    .form-group-full { margin-bottom: 1rem; display: flex; flex-direction: column; gap: 0.4rem; }
    .form-label { font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted); }
    .form-input, .form-select, .form-textarea {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(2,32,244,0.2);
      padding: 0.85rem 1rem;
      color: #7b87dc;
      font-family: 'DM Sans', sans-serif; font-size: 0.9rem;
      outline: none; transition: border-color 0.3s, background 0.3s;
      width: 100%; appearance: none; -webkit-appearance: none;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
      border-color: var(--copper); background: rgba(2,32,244,0.05);
    }
    .form-input::placeholder, .form-textarea::placeholder { color: #7b87dc; }
    .form-select option { background: var(--charcoal-mid); }
    .form-textarea { resize: vertical; min-height: 130px; }
    .form-checkboxes { margin: 1.25rem 0; display: flex; flex-direction: column; gap: 0.6rem; }
    .form-check {
      display: flex; align-items: center; gap: 0.75rem;
      font-size: 0.83rem; color: var(--text-muted); cursor: pointer;
    }
    .form-check input[type="checkbox"] {
      width: 16px; height: 16px; accent-color: var(--copper); cursor: pointer;
    }
    .form-submit {
      margin-top: 1.5rem; width: 100%; padding: 1rem;
      background: var(--copper); color: #fff;
      font-family: 'DM Sans', sans-serif; font-size: 0.8rem;
      font-weight: 500; letter-spacing: 0.15em; text-transform: uppercase;
      border: none; cursor: pointer; transition: all 0.3s;
    }
    .form-submit:hover { background: var(--copper-light); transform: translateY(-2px); }
    .form-note { font-size: 0.75rem; color: var(--text-muted); margin-top: 0.75rem; text-align: center; }
    #form-success {
      display: none; text-align: center; padding: 4rem 1rem;
    }
    .success-icon { margin-bottom: 1.5rem; color: var(--copper); }
    .success-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem; font-weight: 300; margin-bottom: 1rem;
    }
    .success-text { font-size: 0.9rem; color: var(--text-muted); line-height: 1.75; max-width: 360px; margin: 0 auto; }

    /* SERVICE AREA */
    .service-area { background: #fff; padding: 5rem 3rem; }
    .area-grid {
      display: grid; grid-template-columns: 1fr 2fr; gap: 5rem;
      align-items: start; margin-top: 3rem;
    }
    .area-note { font-size: 0.9rem; line-height: 1.8; color: var(--text-muted); margin-top: 1rem; }
    .area-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 2rem; }
    .area-tag {
      font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;
      padding: 0.4rem 1rem;
      border: 1px solid rgba(2,32,244,0.25);
      color: #0220f4;
      background: #D9DEF9;
    }

    @media (max-width: 900px) {
      .page-hero { padding: 8rem 1.5rem 4rem; }
      .contact-main { grid-template-columns: 1fr; }
      .contact-sidebar { padding: 3rem 1.5rem; }
      .contact-form-wrap { padding: 3rem 1.5rem; }
      .form-row { grid-template-columns: 1fr; }
      .service-area { padding: 4rem 1.5rem; }
      .area-grid { grid-template-columns: 1fr; gap: 2rem; }
    }
  </style>
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
</head>
<body>

  <div class="scroll-progress" id="scrollProgress"></div>

  <nav>
    <a href="index.html" class="nav-logo"><img src="images/logo.png" alt="Elwood Blues Construction" class="nav-logo-img"></a>
    <ul class="nav-links">
      <li><a href="services.html">Services</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="process.html">Process</a></li>
      <li><a href="gallery.html">Gallery</a></li>
      <li><a href="contact.php" style="color:#f7c81a;">Contact</a></li>
    </ul>
    <a href="contact.php" class="nav-cta">Start a Project</a>
    <button class="nav-hamburger" id="navHamburger" aria-label="Open menu"><span></span><span></span><span></span></button>
  </nav>

  <!-- Mobile Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Mobile Sidebar -->
  <aside class="nav-sidebar" id="navSidebar" aria-hidden="true">
    <div class="sidebar-header">
      <a href="index.html" class="sidebar-logo">
        <img src="images/logo.png" alt="Elwood Blues Construction" class="sidebar-logo-img">
      </a>
      <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <line x1="2" y1="2" x2="18" y2="18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          <line x1="18" y1="2" x2="2" y2="18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
      </button>
    </div>
    <div class="sidebar-divider"></div>
    <nav class="sidebar-nav" aria-label="Mobile navigation">
      <a href="index.html" class="sidebar-link"><span class="sidebar-link-num">01</span><span class="sidebar-link-text">Home</span><svg class="sidebar-link-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7H11M11 7L7.5 3.5M11 7L7.5 10.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      <a href="services.html" class="sidebar-link"><span class="sidebar-link-num">02</span><span class="sidebar-link-text">Services</span><svg class="sidebar-link-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7H11M11 7L7.5 3.5M11 7L7.5 10.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      <a href="about.html" class="sidebar-link"><span class="sidebar-link-num">03</span><span class="sidebar-link-text">About</span><svg class="sidebar-link-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7H11M11 7L7.5 3.5M11 7L7.5 10.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>  </svg></a>
      <a href="process.html" class="sidebar-link"><span class="sidebar-link-num">04</span><span class="sidebar-link-text">Process</span><svg class="sidebar-link-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7H11M11 7L7.5 3.5M11 7L7.5 10.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      <a href="gallery.html" class="sidebar-link"><span class="sidebar-link-num">05</span><span class="sidebar-link-text">Gallery</span><svg class="sidebar-link-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7H11M11 7L7.5 3.5M11 7L7.5 10.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      <a href="contact.php" class="sidebar-link active"><span class="sidebar-link-num">06</span><span class="sidebar-link-text">Contact</span><svg class="sidebar-link-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7H11M11 7L7.5 3.5M11 7L7.5 10.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </nav>
    <div class="sidebar-footer">
      <a href="contact.php" class="sidebar-cta">Start a Project</a>
      <p class="sidebar-tagline">Precision craftsmanship.<br>Phoenix, AZ.</p>
    </div>
  </aside>

  <!-- PAGE HERO -->
  <div class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
      <div class="page-breadcrumb">
        <a href="index.html">Home</a>
        <span>›</span>
        <span>Contact</span>
      </div>
      <h1 class="page-title">Let's <em>Talk</em></h1>
      <p class="page-lead">Every project starts with a conversation. Tell us what you're building and Harris will get back to you personally — usually within the same business day.</p>
    </div>
    <div class="page-hero-rule"></div>
  </div>

  <!-- CONTACT MAIN -->
  <div class="contact-main">

    <div class="contact-sidebar reveal">
      <div class="section-eyebrow"><span>Get in Touch</span></div>
      <h2 class="sidebar-title">Reach Harris directly.</h2>
      <p class="sidebar-intro">No contact forms that go to a call center. No robo-responses. When you reach out to Elwood Blues Construction, you're reaching the person who will build your project.</p>

      <div class="contact-methods">
        <div class="contact-method">
          <div class="cm-icon">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M15 10.5l-2.3-2.3a1 1 0 00-1.4 0l-.9.9a9.5 9.5 0 01-3.5-3.5l.9-.9a1 1 0 000-1.4L5.5 1C4.8.3 3.5.6 3 1.5 1.8 4 2.5 8 6 11.5s7.5 4.2 10 3c.9-.5 1.2-1.8.5-2.5L15 10.5z"/>
            </svg>
          </div>
          <div>
            <div class="cm-label">Phone</div>
            <a href="tel:6232626579" class="cm-value">(623) 262-6579</a>
            <div class="cm-note">Fastest reply · Mon–Fri 7am–6pm</div>
          </div>
        </div>
        <div class="contact-method">
          <div class="cm-icon">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="2" y="4" width="14" height="11" rx="1"/>
              <path d="M2 7l7 4.5L16 7"/>
            </svg>
          </div>
          <div>
            <div class="cm-label">Email</div>
            <a href="mailto:elwoodbluesco@gmail.com" class="cm-value">Elwoodbluesco@gmail.com</a>
            <div class="cm-note">Response within 1 business day</div>
          </div>
        </div>
        <div class="contact-method">
          <div class="cm-icon">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
              <circle cx="9" cy="8" r="3"/>
              <path d="M9 2C5.7 2 3 4.7 3 8c0 4 6 10 6 10s6-6 6-10c0-3.3-2.7-6-6-6z"/>
            </svg>
          </div>
          <div>
            <div class="cm-label">Location</div>
            <span class="cm-value" style="font-size:1rem; cursor:default;">Phoenix, AZ 85022</span>
            <div class="cm-note">Serving the greater Phoenix metro</div>
          </div>
        </div>
      </div>

      <div class="bbb-block">
        <div class="bbb-block-title">BBB Accredited Business</div>
        <p class="bbb-block-text">Elwood Blues Construction LLC holds an A+ rating with the Better Business Bureau. Arizona ROC licensed, fully bonded and insured. <a href="#">Verify credentials →</a></p>
      </div>
    </div>

    <div class="contact-form-wrap reveal">
      <div id="form-container">
        <h3 class="form-title">Request a Consultation</h3>
        <p class="form-subtitle">Fill in the details below and Harris will reach out to schedule your on-site visit. Most consultations happen within the week.</p>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="firstName">First Name *</label>
            <input class="form-input" type="text" id="firstName" placeholder="Michael">
          </div>
          <div class="form-group">
            <label class="form-label" for="lastName">Last Name</label>
            <input class="form-input" type="text" id="lastName" placeholder="Chen">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="email">Email *</label>
            <input class="form-input" type="email" id="email" placeholder="you@example.com">
          </div>
          <div class="form-group">
            <label class="form-label" for="phone">Phone</label>
            <input class="form-input" type="tel" id="phone" placeholder="(602) 555-0000">
          </div>
        </div>
        <div class="form-group-full">
          <label class="form-label" for="address">Property Address</label>
          <input class="form-input" type="text" id="address" placeholder="123 N Desert Bloom Dr, Phoenix, AZ 85022">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="service">Service Type</label>
            <select class="form-select" id="service">
              <option value="" disabled selected>Select a service...</option>
              <option>Home Remodeling</option>
              <option>Home Addition</option>
              <option>New Construction</option>
              <option>Renovation &amp; Restoration</option>
              <option>Not Sure — Need Guidance</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="budget">Budget Range</label>
            <select class="form-select" id="budget">
              <option value="" disabled selected>Select a range...</option>
              <option>$25,000 – $75,000</option>
              <option>$75,000 – $150,000</option>
              <option>$150,000 – $300,000</option>
              <option>$300,000+</option>
              <option>Not Sure Yet</option>
            </select>
          </div>
        </div>
        <div class="form-group-full">
          <label class="form-label" for="timeline">Ideal Start Timeline</label>
          <select class="form-select" id="timeline">
            <option value="" disabled selected>When are you hoping to start?</option>
            <option>As soon as possible</option>
            <option>Within 1–3 months</option>
            <option>3–6 months from now</option>
            <option>6–12 months from now</option>
            <option>Still planning — no rush</option>
          </select>
        </div>
        <div class="form-group-full">
          <label class="form-label" for="message">Tell Us About Your Project</label>
          <textarea class="form-textarea" id="message" placeholder="Describe your vision, what you're hoping to achieve, any constraints we should know about..."></textarea>
        </div>
        <div class="form-checkboxes">
          <label class="form-check">
            <input type="checkbox" checked>
            I'm the homeowner or authorized to make decisions about this property
          </label>
          <label class="form-check">
            <input type="checkbox">
            I'd like to receive occasional updates about Elwood Blues Construction
          </label>
        </div>
        <button class="form-submit" id="submitBtn">Send Request →</button>
        <!-- Honeypot: hidden from humans, bots fill it in -->
        <input type="text" name="website" id="website" style="display:none;" tabindex="-1" autocomplete="off">
        <p class="form-note">By submitting, you agree to be contacted by Elwood Blues Construction regarding your project. We never share your information.</p>
      </div>

      <div id="form-success">
        <div class="success-icon">
          <svg width="56" height="56" viewBox="0 0 56 56" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="28" cy="28" r="24"/>
            <path d="M18 28l8 8 14-16"/>
          </svg>
        </div>
        <div class="success-title">Request Received</div>
        <p class="success-text">Harris will review your project details and reach out within one business day to schedule your on-site consultation. We look forward to building something great together.</p>
      </div>
    </div>
  </div>

  <!-- SERVICE AREA -->
  <div class="service-area">
    <div class="reveal">
      <div class="section-eyebrow"><span>Service Area</span></div>
      <h2 class="section-title">Phoenix &amp; surrounding<br>communities.</h2>
    </div>
    <div class="area-grid">
      <div class="reveal">
        <p class="area-note">We're based in north Phoenix (85022) and serve the greater Phoenix metropolitan area. Not sure if we cover your neighborhood? Just call — we'll give you a straight answer.</p>
        <a href="tel:6232626579" class="btn-primary" style="margin-top:2rem; display:inline-block;">(623) 262-6579</a>
      </div>
      <div class="area-tags reveal">
        <span class="area-tag">Phoenix</span>
        <span class="area-tag">Scottsdale</span>
        <span class="area-tag">Chandler</span>
        <span class="area-tag">Gilbert</span>
        <span class="area-tag">Tempe</span>
        <span class="area-tag">Mesa</span>
        <span class="area-tag">Glendale</span>
        <span class="area-tag">Peoria</span>
        <span class="area-tag">Surprise</span>
        <span class="area-tag">Goodyear</span>
        <span class="area-tag">Paradise Valley</span>
        <span class="area-tag">Ahwatukee</span>
        <span class="area-tag">North Phoenix</span>
        <span class="area-tag">Anthem</span>
        <span class="area-tag">Cave Creek</span>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="index.html" class="nav-logo">
          <img src="images/logo.png" alt="Elwood Blues Construction" class="nav-logo-img" style="height:44px;">
        </a>
        <p class="footer-tagline" style="margin-top:1rem;">"Built to be heirloom.<br>Engineered for Phoenix."</p>
        <div style="font-size:1rem; color:#fff; margin-top:1rem;">
          Phoenix, AZ 85022<br>
          <a href="tel:6232626579" style="color:#000; text-decoration:none;">(623) 262-6579</a>
        </div>
      </div>
      <div>
        <div class="footer-col-title">Company</div>
        <ul class="footer-links">
          <li><a href="about.html">About Harris</a></li>
          <li><a href="process.html">Our Process</a></li>
          <li><a href="gallery.html">Gallery</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Legal</div>
        <ul class="footer-links">
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="https://www.bbb.org/us/az/phoenix/profile/residential-general-contractor/elwood-blues-construction-llc-1126-1000164015" target="_blank">BBB Profile</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-legal">© 2026 Elwood Blues Construction LLC · All rights reserved · Phoenix, AZ · Designed &amp; Developed By: <a href="https://infowaveitsolutions.com/" target="_blank" style="text-decoration:none; color:#000;"> Infowave IT Solutions</a></div>
      <div class="footer-bbb">
        <a href="https://www.bbb.org/us/az/phoenix/profile/residential-general-contractor/elwood-blues-construction-llc-1126-1000164015" target="_blank" class="bbb-badge" style="text-decoration:none;">BBB Accredited · A+</a>
        <span>| ROC# 348242 |</span>
        <span>Licensed · Bonded · Insured</span>
        <a href="https://www.facebook.com/profile.php?id=61590894736763" target="_blank" class="footer-instagram" aria-label="Follow us on Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          <span>facebook</span>
        </a>
      </div>
    </div>
  </footer>

  <script src="js/main.js"></script>
  <script src="js/sidebar.js"></script>
  <script src="js/gallery.js"></script>
  <script src="js/forms.js"></script>
</body>
</html>

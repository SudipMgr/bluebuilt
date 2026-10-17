# PHP Mail Setup Guide
## Elwood Blues Construction — Built-in Email (No 3rd Party)

This setup uses your hosting server's built-in mail system.
No accounts to create. No API keys. Just one line to change.

---

## STEP 1 — Open send-mail.php

At the top of the file, find this line:

    $recipient = 'harris@elwoodblues.com';

Change it to the real email address where you want to receive
form inquiries:

    $recipient = 'your-real-email@gmail.com';

Save the file.

---

## STEP 2 — Upload your site

Upload ALL files to your hosting root folder (usually public_html).
The structure should look like this on your server:

    public_html/
    ├── index.html
    ├── contact.php       ← Contact page (PHP)
    ├── send-mail.php     ← PHP mail handler
    ├── about.html
    ├── services.html
    ├── process.html
    ├── vercel.json
    ├── css/
    ├── js/
    └── sections/

---

## STEP 3 — Test it live

1. Visit your live domain and go to the Contact page
2. Fill in the form with your own name and email
3. Click Send — the button should show "Sending…" then disappear
4. Check your inbox — the email arrives within seconds
5. You'll also get an auto-reply confirmation sent to the email
   you typed in the form (showing it to your customer)

---

## STEP 4 — Test the Home page form too

1. Go to your home page and scroll to the Contact section
2. Fill in the form and submit
3. Check inbox again — both forms use the same send-mail.php

---

## What each form submission looks like in your inbox

Subject: New Project Inquiry from Michael Chen — Elwood Blues Construction

    You have received a new consultation request from your website.
    ------------------------------------------------------------

    SOURCE:           Contact Page
    NAME:             Michael Chen
    EMAIL:            michael@example.com
    PHONE:            (602) 555-1234
    PROPERTY ADDRESS: 456 N Desert View Dr, Scottsdale, AZ 85254

    SERVICE:          Home Remodeling
    BUDGET:           $75,000 – $150,000
    TIMELINE:         Within 1–3 months

    ------------------------------------------------------------
    MESSAGE:

    Looking to remodel our master bathroom and kitchen...

    ------------------------------------------------------------
    Reply directly to this email to respond to Michael.

Hitting Reply in Gmail goes straight back to the customer's email.

---

## The customer also gets an auto-reply

Subject: We received your inquiry — Elwood Blues Construction

    Hi Michael,

    Thank you for reaching out to Elwood Blues Construction.

    Harris has received your inquiry and will get back to you
    personally within one business day.

    Here's a summary of what you submitted:

    Service:  Home Remodeling
    Budget:   $75,000 – $150,000
    Timeline: Within 1–3 months

    If you need to reach us sooner, call directly:
    (623) 262-6579 · Mon–Fri 7am–6pm

    — Harris Lyons
    Elwood Blues Construction
    Phoenix, AZ 85022

---

## Troubleshooting

PROBLEM: Form submits but no email arrives
FIX: Check your spam folder. Some hosts route mail() to spam
     initially. Mark it as "Not Spam" and it should be fine
     going forward. Alternatively, set up a professional email
     through your host's cPanel (e.g. harris@yourdomain.com)
     and use that as the $recipient.

PROBLEM: "Failed — Try Again" error on the button
FIX: Your hosting plan may have mail() disabled. Contact your
     host and ask: "Is PHP mail() enabled on my account?"
     Almost all shared hosts (Hostinger, Bluehost, GoDaddy,
     SiteGround) enable it by default.

PROBLEM: Works locally but not on live site
FIX: mail() only works on a real server, not on your local
     computer. Always test on the live domain.

PROBLEM: Emails arrive but sender shows "no-reply@yourdomain"
FIX: That's correct and expected. The Reply-To is set to the
     customer's email so hitting Reply goes to them.

---

## Files changed in this version

| File              | What it does                                    |
|-------------------|-------------------------------------------------|
| send-mail.php     | NEW — PHP mailer, handles both forms            |
| contact.php       | Contact page (renamed from contact.html)        |
| js/forms.js       | NEW — fetch() handler, POSTs to send-mail.php   |
| js/main.js        | Removed old fake submit handler                 |
| index.html        | Now loads js/forms.js (not emailjs)             |
| sections/contact  | Added honeypot hidden field                     |

EmailJS files (emailjs-forms.js) can be deleted from your server.

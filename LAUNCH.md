# DataPeaks Solutions — Launch Guide & Go-Live Checklist

Everything needed to take the WordPress site live on GoDaddy at **datapeakssolutions.com**,
with nothing left to surprise you afterward. Work top to bottom.

Deliverables referenced here:
- **Theme:** `wp-theme/datapeaks/` (packaged as `datapeaks-theme-v1.zip`)
- **Plugin:** `wp-plugin/datapeaks-core/` (package as `datapeaks-core.zip`)
- **Static fallback:** `prototype/` (can go live immediately while WordPress is set up)

---

## 0. What you need

- GoDaddy hosting plan with WordPress (or cPanel + MySQL) — you have this.
- The domain datapeakssolutions.com pointed at that hosting.
- A mailbox `info@datapeakssolutions.com` (you have GoDaddy mailboxes).
- Admin access to WordPress (`/wp-admin`).

---

## 1. Install WordPress

If WordPress isn't installed yet: in GoDaddy's dashboard use **one-click WordPress install**
for datapeakssolutions.com. Set a strong admin username (not "admin") and password. Note the
admin URL, username, and password.

If you already have WordPress, skip to step 2.

---

## 2. Install the DataPeaks plugin, then the theme

Order matters — plugin first so it owns the content, then the theme for the design.

1. **Plugins → Add New → Upload Plugin** → `datapeaks-core.zip` → Install → **Activate**.
   (On activation it creates the 6 courses, 12 weekly projects, the pages, the menu, and sets
   the front page.)
2. **Appearance → Themes → Add New → Upload Theme** → `datapeaks-theme-v1.zip` → Install → **Activate**.
3. **Settings → Permalinks** → click **Save Changes** once (flushes pretty URLs so
   `/courses/`, `/course/cda/`, `/weekly-log/` work).

> The site also works with **theme only** (no plugin) — the theme registers the same content
> itself. The plugin is recommended so your data survives future theme changes.

Visit the site — it should match the prototype: home, courses, course detail, weekly log,
about, contact, privacy, terms.

---

## 3. Make the contact form actually send email  (required)

WordPress's built-in mail is unreliable on shared hosting. Set up SMTP so enquiries reach
`info@datapeakssolutions.com`:

1. **Plugins → Add New** → install **FluentSMTP** (free) → Activate.
2. In FluentSMTP, add a connection using your GoDaddy mailbox:
   - From email: `info@datapeakssolutions.com`
   - SMTP host / port / username / password: from GoDaddy's **Email → Server settings**
     (typically host `smtpout.secureserver.net`, port `465` SSL or `587` TLS).
3. Send a **test email** from FluentSMTP to yourself — confirm it arrives.
4. Submit the website contact form once — confirm the enquiry email arrives.

---

## 4. SSL / HTTPS and canonical domain

1. In GoDaddy, ensure the **SSL certificate** is active for the domain (most plans include one).
2. In **Settings → General**, set both **WordPress Address** and **Site Address** to
   `https://datapeakssolutions.com` (pick www or non-www and stay consistent).
3. Install **Really Simple SSL** (free) if any "mixed content" warnings appear — it forces HTTPS.

---

## 5. Performance

1. Install a caching plugin — **LiteSpeed Cache** (if your GoDaddy plan uses LiteSpeed) or
   **W3 Total Cache**. Enable page cache + Gzip + browser caching.
2. Install an image optimizer — **Smush** or **ShortPixel** — and run a bulk optimize.
3. Target: Core Web Vitals all "Good" (test at pagespeed.web.dev).

---

## 6. Security & backups

1. **Wordfence** (free) → run the setup wizard, enable the firewall and login protection.
2. Limit login attempts (Wordfence covers this) and use a strong admin password + 2FA.
3. **UpdraftPlus** (free) → schedule automatic backups (files + database) to Google Drive/Dropbox.
4. Keep WordPress core, theme, and plugins updated.

---

## 7. SEO & analytics

1. **Rank Math** or **Yoast** (optional — the theme already outputs Open Graph, Twitter cards
   and JSON-LD). If you install one, let it generate the XML sitemap.
2. Create **Google Search Console** and **Google Analytics 4** properties for the domain.
   Add the GA4 tag via Rank Math/Yoast or a simple header snippet plugin.
3. Submit your sitemap (`/sitemap_index.xml` from Rank Math, or the static `/sitemap.xml`) to
   Search Console.
4. Set up your **Google Business Profile** (Hyderabad) for local SEO.

---

## 8. Content review

- **Courses**: open each course in wp-admin, confirm code/colour/tagline/tools/outcomes and the
  Levels curriculum read correctly.
- **Weekly Log**: confirm the 12 projects and dates; edit as your real schedule firms up.
- **Pages**: review Privacy and Terms (they're editable) and add any real policy specifics.
- **Menus** (Appearance → Menus): confirm the Primary menu; add/remove items as needed.
- **Social links**: verify YouTube, Instagram, Facebook, WhatsApp all open the right profiles.

---

## 9. Pre-launch QA checklist

Tick every box before announcing:

- [ ] Plugin + theme activated; permalinks saved.
- [ ] Home, Courses, each Course detail, Weekly Log, About, Contact, Privacy, Terms all load.
- [ ] Course level tabs work with mouse **and** keyboard (Tab + arrow keys).
- [ ] Weekly-log track filter works.
- [ ] Contact form: validation works, submits, and the email **arrives** at info@… (test done).
- [ ] WhatsApp / email / phone / Maps links all work.
- [ ] Mobile layout checked (360px), tablet (768px), desktop.
- [ ] No broken images; logo + favicon show; social share preview shows the OG image
      (test at opengraph.xyz or by pasting a link in WhatsApp).
- [ ] HTTPS everywhere; no mixed-content warnings; www/non-www redirect consistent.
- [ ] 404 page shows the branded design.
- [ ] Lighthouse: Performance ≥ 90, Accessibility ~100, Best Practices, SEO all green.
- [ ] Backup ran successfully at least once.
- [ ] Analytics receiving pageviews; sitemap submitted.

---

## 10. Fast fallback (optional, go live in minutes)

If you want *something* live immediately while finishing WordPress:
1. In GoDaddy **cPanel → File Manager**, open `public_html`.
2. Upload the **contents of `prototype/`** (not the folder itself) so `index.html` sits at the root.
3. Visit datapeakssolutions.com — the static site is live. Replace with WordPress when ready.

---

## 11. After launch

- Watch the first enquiries land in the mailbox; reply fast.
- Publish the weekly project each week (Weekly Log → add Project + a linked post/video).
- Phase 6 (see `plan.md`): add the LMS for paid Level 2/3 when that content is ready.

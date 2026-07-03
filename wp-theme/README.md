# DataPeaks Solutions — WordPress theme

A custom WordPress theme (`datapeaks`) built from the approved static prototype. Dark,
accessible (WCAG 2.1 AA), project-first. It ships with content built in: activating the
theme seeds the 6 courses, the 12-week project log, and all pages/menu — so the site looks
like the prototype immediately, then everything is editable in wp-admin.

## What's inside

```
datapeaks/
  style.css              theme header (metadata)
  functions.php          setup, asset enqueue, includes
  header.php footer.php   chrome (announcement bar, nav, footer)
  front-page.php          home
  archive-course.php      /courses/  (all six tracks)
  single-course.php       course detail (level tabs, curriculum, outcomes)
  page-weekly-log.php      weekly project log (track filter)
  page-about.php page-contact.php
  page.php index.php 404.php
  inc/
    data.php     default courses / projects / faqs / social / contact
    cpt.php      Course + Project (Weekly Log) custom post types
    meta.php     admin meta boxes for editing courses & projects
    seed.php     one-time content + pages + menu seeder (on activation)
    helpers.php  colours, badges, fetchers, social rendering
    seo.php      Open Graph / Twitter / JSON-LD / favicons
    contact.php  enquiry form handler (emails info@datapeakssolutions.com)
  assets/css/styles.css   design system (same as the prototype)
  assets/js/theme.js      interactions (nav, tabs, accordion, filter, form)
  assets/img/*            logo, favicons, OG image
```

## Requirements

WordPress 6.0+, PHP 8.0+ (GoDaddy plan is fine).

## Install (fastest — upload the ZIP)

1. In WordPress admin go to **Appearance → Themes → Add New → Upload Theme**.
2. Choose `datapeaks-theme.zip` and click **Install Now**, then **Activate**.
3. On activation the theme auto-creates: the six courses, twelve weekly projects, the pages
   (Home, Weekly Log, About, Contact, Privacy, Terms), the primary menu, and sets Home as the
   front page. Visit the site — it matches the prototype.
4. Go to **Settings → Permalinks** and click **Save** once (flushes pretty URLs).

## Install (manual / GoDaddy cPanel)

1. Unzip so you have a `datapeaks/` folder.
2. Upload it to `wp-content/themes/datapeaks/` via cPanel File Manager or SFTP.
3. **Appearance → Themes → Activate** DataPeaks Solutions.
4. **Settings → Permalinks → Save**.

## Editing content (no code)

- **Courses → edit any course**: change the name, code, badge colour, tagline, summary, tools,
  outcomes, and the Levels curriculum (a JSON field — Beginner / Intermediate / Advanced).
- **Weekly Log → add/edit Project**: set week #, date, course, level and tools.
- **Appearance → Menus**: the "Primary" menu is created for you; edit freely.
- **Pages**: Home / About / Contact use custom templates; Privacy & Terms are normal editable pages.

## Contact form email (important)

The enquiry form sends with WordPress `wp_mail()`. On shared hosting, PHP mail is unreliable and
often lands in spam. For dependable delivery, install a free SMTP plugin (e.g. **FluentSMTP** or
**WP Mail SMTP**) and connect it to your GoDaddy mailbox `info@datapeakssolutions.com`. Enquiries
are emailed to that address; the form also has a honeypot for spam.

## Recommended plugins (optional)

- **FluentSMTP / WP Mail SMTP** — reliable email for the enquiry form.
- **Rank Math / Yoast** — extra SEO controls (basic OG/JSON-LD already ship in the theme).
- **A caching + image optimization plugin** — performance on GoDaddy.
- **Wordfence** — security.

## Notes

- The theme's design source of truth remains `/prototype`. If you change the design there,
  re-copy `assets/css/styles.css` (and any images) into the theme.
- Colours, fonts, and accessibility features match the prototype exactly.

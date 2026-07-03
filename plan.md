# DataPeaks Solutions — Delivery Plan

> The "how" and "when". Pairs with `strategy.md` (the "why/what") and `progress.md` (the log).
> Delivery in **6 phases**. Design-first: HTML prototype → approved → WordPress theme → launch.

Last updated: 2026-07-02 · Owner: mshanawazsoftech

---

## 0. Repository & Environments

- **Repo:** `github.com/mshanawazsoftech/DataPeaks-Solutions` (main = protected).
- **Prototype code:** `/prototype` (static HTML/CSS/JS, framework-free).
- **WordPress theme (later):** `/wp-theme/datapeaks` (built from the approved prototype).
- **Docs:** `strategy.md`, `plan.md`, `progress.md`, `CLAUDE.md` at repo root.

**Environments**
1. **Local** — open `/prototype` files directly; PHP local (Local WP / MAMP) for WordPress.
2. **Staging** — GoDaddy subdomain `staging.datapeakssolutions.com` (or a temp URL).
3. **Production** — `datapeakssolutions.com` (GoDaddy plan: MySQL 10 GB, mailboxes).

---

## 1. Git Workflow, Branch Naming & Epic Pattern

**Trunk-based with short-lived branches.** `main` is always deployable. No direct commits to `main`; everything via PR.

### Branch naming convention

```
<type>/<epic>-<short-slug>
```

- **type** — one of: `feat`, `fix`, `chore`, `docs`, `design`, `refactor`, `content`, `release`, `hotfix`.
- **epic** — the epic code (see below), e.g. `E1`, `E2` …
- **short-slug** — kebab-case, ≤ 4 words.

Examples:
```
feat/E2-hero-section
design/E2-course-cards
content/E3-cda-level1-week1
fix/E4-contact-form-validation
chore/E1-repo-scaffold
release/E4-v1.0.0
hotfix/E4-nav-mobile-overlap
```

### Epics (stable IDs, cross-phase)

| Epic | Name | Scope |
|---|---|---|
| **E1** | Foundation & Docs | repo scaffold, docs, design tokens, conventions |
| **E2** | Prototype UI | static multi-page site, components, responsive, a11y |
| **E3** | Content & Course Model | course data, weekly log, Level-1 project pages |
| **E4** | WordPress Build | theme from prototype, CMS, forms, SEO, deploy |
| **E5** | Launch & Ops | GoDaddy go-live, analytics, security, backups |
| **E6** | LMS & Growth (future) | Level 2/3 LMS, payments, memberships, blog engine |

### Commit convention (Conventional Commits)

```
<type>(<epic-or-scope>): <summary>

feat(E2): add responsive course card grid
docs(E1): add branch naming to plan.md
fix(E4): correct enquiry form nonce check
```

### PR rules
- Small, focused PRs mapped to one epic.
- Title: `[E2] Hero section`. Link the phase/epic.
- Checklist: responsive ✓, a11y ✓, no console errors ✓, screenshots attached.
- Squash-merge into `main`. Delete branch after merge.

### Tags / releases
- Semantic version tags on `main`: `v0.1.0` (prototype), `v1.0.0` (public launch).

---

## 2. Definition of Done (applies to every phase)

- Responsive at 360 / 768 / 1024 / 1440 px.
- WCAG AA contrast; keyboard-navigable; visible focus; alt text.
- No console errors; valid HTML; Lighthouse Perf ≥ 90 on the prototype.
- Cross-linked and reachable from the nav.
- `progress.md` updated; PR merged; branch deleted.

---

## 3. Phases

### Phase 1 — Foundation & Docs  (Epic E1)  ✅ in progress
**Goal:** project scaffolding, strategy, plan, conventions, design tokens.
- [x] `strategy.md`, `plan.md`, `progress.md`, `CLAUDE.md`
- [x] Prototype folder structure + design tokens (CSS variables)
- [ ] README refresh with quick-start + links
- **Branches:** `chore/E1-repo-scaffold`, `docs/E1-planning`
- **Exit:** docs merged; design system defined; prototype skeleton runs.

### Phase 2 — Prototype UI  (Epic E2)
**Goal:** full, clickable, static multi-page site (100% page coverage).
- Pages: Home, Courses, Course detail (template), Weekly Log, About, Contact/Enroll.
- Components: header/nav (mobile), hero, course cards, level tabs, feature grid,
  stats, testimonials placeholder, weekly-log table, FAQ accordion, footer, contact form.
- Interactions: mobile menu, level tabs, FAQ accordion, form validation, scroll reveal.
- **Branches:** `design/E2-*`, `feat/E2-*`
- **Exit:** all pages built, responsive, a11y pass, stakeholder review → tag `v0.1.0`.

### Phase 3 — Content & Course Model  (Epic E3)
**Goal:** real content and the weekly project system.
- Course data model (6 tracks × 3 levels) in `data/courses.*`.
- Level-1 project pages (≥ one per track) with tools, dataset, steps, repo link.
- Weekly Log seeded (Week 1: CDA-L1 Python #1 — pandas, numpy).
- Copywriting pass (SEO titles/meta, alt text).
- **Branches:** `content/E3-*`
- **Exit:** ≥ 6 Level-1 pages live in prototype; weekly log populated.

### Phase 4 — WordPress Build  (Epic E4)
**Goal:** convert approved prototype into a maintainable WordPress site.
- Local WP install (latest), custom theme `datapeaks` from prototype markup/CSS/JS.
- Custom post types: `course`, `project` (+ taxonomies: track, level, week, tool).
- Templates wired; menus, widgets, reusable blocks.
- Forms plugin (Fluent/WPForms) → email + DB; spam protection.
- SEO plugin (Rank Math), schema, sitemap; caching + image optimization.
- **Branches:** `feat/E4-*`, `fix/E4-*`
- **Exit:** feature-parity with prototype on staging; content editable in WP.

### Phase 5 — Launch & Ops  (Epic E5)
**Goal:** go live on GoDaddy at datapeakssolutions.com.
- Point domain / DNS; SSL (HTTPS) enforced; www + non-www canonical.
- Migrate staging → production; smoke test all pages/forms.
- Mailboxes wired for enquiries; SMTP for transactional email.
- GA4 + Search Console + Meta Pixel; submit sitemap.
- Wordfence, least-privilege admins, automated backups, update policy.
- **Branches:** `release/E5-*`, `hotfix/E5-*`; tag `v1.0.0`.
- **Exit:** public site live, monitored, backed up, analytics flowing.

### Phase 6 — LMS & Growth  (Epic E6, future)
**Goal:** monetize Levels 2/3 and scale content.

**LMS platform choice.** Recommend **Tutor LMS** (free core, generous features, Indian-market
friendly) or **LearnDash** (premium, most mature). Both integrate with WordPress and WooCommerce.
Decision driver: Tutor LMS to start lean; migrate to LearnDash only if advanced quizzing/reporting
is needed.

**How it fits our existing content model.**
- Level 1 stays free and public, rendered by our `course`/`project` model (no LMS needed).
- Levels 2 & 3 become **LMS courses** (lessons, topics, quizzes, assignments) gated behind purchase.
- The public course page links "Enquire/Enroll" → the paid LMS course checkout.

**Commerce & access.**
- **WooCommerce** for the store + **Razorpay** (primary, INR/India) and **Stripe/PayPal**
  (international) payment gateways.
- **Memberships/subscriptions** (Tutor LMS Pro / Paid Memberships Pro) for cohort or all-access plans.
- **Student dashboard**: progress, certificates, invoices (LMS provides this).
- **Certificates** on completion; **drip content** to release weekly.

**Data & privacy.** Paid materials and student PII live only inside the LMS (never in the public
repo/site). Keep the "open datasets only" rule for anything public.

**Growth loop.**
- Blog/resources engine (WordPress posts) + editorial calendar; weekly project → YouTube + IG + WhatsApp.
- Email nurture (e.g. FluentCRM) from Level-1 signups → Level-2 offers.
- International cohort landing pages (UAE/UK/AU/USA/SG) with geo-relevant CTAs.
- A/B test hero + CTA copy.

**Build steps (when Levels 2/3 content is ready).**
1. Install WooCommerce + Tutor LMS; connect Razorpay (+ Stripe/PayPal).
2. Recreate Levels 2/3 as LMS courses with lessons/quizzes; set prices; enable certificates.
3. Add student dashboard + login/registration; wire enroll CTAs from our course pages.
4. Add FluentCRM for email nurture; tag Level-1 leads.
5. Test a full purchase → access → completion → certificate flow in staging.

- **Branches:** `feat/E6-lms`, `feat/E6-payments`, `content/E6-level2-*`
- **Exit:** first paid enrollment processed online; student completes a course; growth loop running.

---

## 4. GoDaddy Deployment Notes

- Plan in hand: MySQL DB (10 GB) + multiple mailboxes → supports WordPress (PHP 8.x/MySQL).
- **Fast path (static fallback):** upload `/prototype` via cPanel File Manager / SFTP to
  `public_html` to get *something live immediately* while WordPress is built.
- **WordPress path:** one-click WP install (or manual), install custom theme, import content,
  set permalinks, enable caching + SSL, connect mailboxes via SMTP plugin.
- Always work on **staging** first; back up DB + files before each production change.

---

## 5. Immediate Next Actions

1. Review the prototype (Phase 2 output) and confirm brand/direction.
2. Approve → I convert it to the WordPress theme (Phase 4).
3. In parallel: optionally push `/prototype` to GoDaddy as a temporary live placeholder.
4. Decide LMS timing (Phase 6) once Levels 2/3 content is ready.

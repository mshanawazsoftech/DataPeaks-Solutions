# Branches & Pull Requests

The work is organized into four branches off `main`, each touching a **disjoint** set of
files so they can be reviewed and merged independently (no conflicts). Naming follows
`plan.md` conventions: `<type>/<epic>-<slug>`.

> Fastest path: run `./scripts/setup-branches.sh` from inside the repo. It creates all
> branches, pushes them, and opens the PRs (via GitHub CLI `gh` if installed; otherwise it
> prints ready-to-click compare links). Everything below documents what that script does.

| # | Branch | Epic | PR title | Files |
|---|--------|------|----------|-------|
| 1 | `docs/E1-planning` | E1 | `[E1] Foundation & docs` | strategy.md, plan.md, progress.md, CLAUDE.md, README.md, .gitignore |
| 2 | `feat/E2-prototype-ui` | E2 | `[E2] Prototype UI` | 6 core HTML pages, assets/css/styles.css, assets/js/{data,main}.js |
| 3 | `design/E2-logo-branding` | E2 | `[E2] Logo & brand assets` | assets/img/{logo-mark,logo-full,favicon,og-image}.svg + PNG icons |
| 4 | `content/E3-content-seo` | E3 | `[E3] Content, legal & SEO` | privacy.html, terms.html, 404.html, robots.txt, sitemap.xml |

Suggested review/merge order: **E1 → E2 → E2 (logo) → E3**.

---

## First, clear the stale git lock (one time)

A background process left a lock file. On your Mac, from the repo root:

```bash
rm -f .git/index.lock
git checkout main
git branch -D _write_test 2>/dev/null || true
```

## Option A — run the script

```bash
chmod +x scripts/setup-branches.sh
./scripts/setup-branches.sh
```

## Option B — do it manually

```bash
# 1) E1 — docs
git checkout main && git checkout -b docs/E1-planning
git add CLAUDE.md plan.md progress.md strategy.md README.md .gitignore
git commit -m "docs(E1): add strategy, plan, conventions and progress log"
git push -u origin docs/E1-planning

# 2) E2 — prototype UI
git checkout main && git checkout -b feat/E2-prototype-ui
git add prototype/index.html prototype/courses.html prototype/course.html \
        prototype/weekly-log.html prototype/about.html prototype/contact.html \
        prototype/assets/css/styles.css prototype/assets/js/data.js prototype/assets/js/main.js
git commit -m "feat(E2): add responsive, accessible multi-page prototype (UI + data)"
git push -u origin feat/E2-prototype-ui

# 3) E2 — logo & brand assets
git checkout main && git checkout -b design/E2-logo-branding
git add prototype/assets/img/logo-mark.svg prototype/assets/img/logo-full.svg \
        prototype/assets/img/favicon.svg prototype/assets/img/favicon-32.png \
        prototype/assets/img/apple-touch-icon.png \
        prototype/assets/img/og-image.svg prototype/assets/img/og-image.png
git commit -m "design(E2): add logo, favicon and Open Graph brand assets"
git push -u origin design/E2-logo-branding

# 4) E3 — content, legal & SEO
git checkout main && git checkout -b content/E3-content-seo
git add prototype/privacy.html prototype/terms.html prototype/404.html \
        prototype/robots.txt prototype/sitemap.xml
git commit -m "content(E3): add legal pages, 404, robots and sitemap"
git push -u origin content/E3-content-seo

git checkout main
```

Then open PRs (compare links):

- https://github.com/mshanawazsoftech/DataPeaks-Solutions/compare/main...docs/E1-planning?expand=1
- https://github.com/mshanawazsoftech/DataPeaks-Solutions/compare/main...feat/E2-prototype-ui?expand=1
- https://github.com/mshanawazsoftech/DataPeaks-Solutions/compare/main...design/E2-logo-branding?expand=1
- https://github.com/mshanawazsoftech/DataPeaks-Solutions/compare/main...content/E3-content-seo?expand=1

---

## PR descriptions

### [E1] Foundation & docs
Project scaffolding and documentation: strategy (positioning, WordPress-on-GoDaddy decision,
SEO, monetization), the 6-phase delivery plan with epics and branch/commit conventions,
contributor context (CLAUDE.md), the progress log, README, and .gitignore.

### [E2] Prototype UI
Framework-free, responsive, accessible multi-page prototype — the design source of truth for
the WordPress theme. Home, Courses, data-driven Course detail (6 tracks), Weekly Log, About,
Contact/Enroll. Dark premium design system, per-course colour accents, announcement bar,
full-name social links (top + bottom). WCAG 2.1 AA: skip link, landmarks, `aria-current`,
keyboard-accessible tabs, form aria states, focus rings, reduced-motion, AA contrast.

### [E2] Logo & brand assets
Custom brand mark — ascending peaks (data bars + mountain "pinnacles") with a gold summit in
the cyan/blue/emerald palette. Includes the icon, horizontal lockup, favicons, apple-touch
icon, and a 1200×630 Open Graph share card.

### [E3] Content, legal & SEO
Completes the site for launch: Privacy Policy, Terms of Use, a branded 404 page, robots.txt,
and sitemap.xml. (Open Graph / Twitter / canonical meta and JSON-LD ship inside the E2 pages.)

---

## Notes
- The four branches touch disjoint files, so they merge cleanly in any order; the suggested
  order just keeps history readable.
- `prototype/node_modules/`, `*.zip`, and preview PNGs are git-ignored.
- After all four merge, `main` will contain the complete site under `/prototype`.

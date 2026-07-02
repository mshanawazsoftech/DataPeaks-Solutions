# CLAUDE.md — Project Context for AI Agents

Context for any AI agent (or new contributor) working in this repo. Read this first,
then `strategy.md` (why/what) and `plan.md` (how/when). Log work in `progress.md`.

## What this is

**DataPeaks Solutions** — a data & AI education institution (HQ Hyderabad). We're building a
formal website + public project hub. Six tracks (CDA, CDS, MLE, DE, GAI, AAI), each with 3
levels; Level 1 is free. Delivery is design-first: **static HTML prototype → approved →
WordPress theme → GoDaddy launch.**

## Tech stack (committed)

- **Prototype:** vanilla HTML5 + CSS (custom properties, no framework) + minimal JS. No build step.
- **Production CMS:** WordPress 6.x (latest), PHP 8.x, MySQL — hosted on GoDaddy (10 GB DB, mailboxes).
- **Prototype is the source of truth for design**; the WordPress theme is derived from it.

## Repo layout

```
/                 strategy.md, plan.md, progress.md, CLAUDE.md, README.md, LICENSE
/prototype        static site
  index.html, courses.html, course.html, weekly-log.html, about.html, contact.html
  /assets/css/styles.css
  /assets/js/{data.js, main.js}
/wp-theme         (Phase 4) custom WordPress theme built from the prototype
```

## Conventions

- **Branches:** `<type>/<epic>-<slug>` e.g. `feat/E2-hero-section`. Types: feat, fix, chore,
  docs, design, refactor, content, release, hotfix. Epics E1–E6 (see `plan.md`).
- **Commits:** Conventional Commits — `feat(E2): add course card grid`.
- **PRs:** small, one epic each, title `[E2] ...`, squash-merge, delete branch.
- `main` is protected and always deployable. Tag releases: `v0.1.0` prototype, `v1.0.0` launch.

## Design system (from the logo)

- Background `#0A0F1E`, surface `#111834`. Accents: cyan `#22D3EE`, blue `#3B82F6`,
  gold `#F5B301`, emerald `#34D399`. Text `#E8ECF6` / muted `#9AA6C4`.
- Headings: Space Grotesk / Sora; body: Inter (system fallback). Dark-first, high contrast,
  WCAG AA, responsive (360/768/1024/1440), motion sparing.
- Course badge colors: CDA=cyan, CDS=emerald, MLE=blue, DE=gold, GAI=violet, AAI=pink.

## Definition of Done

Responsive · WCAG AA · keyboard-navigable · no console errors · valid HTML ·
Lighthouse Perf ≥ 90 · linked in nav · `progress.md` updated.

## Guardrails

- Public repo/site uses **only open-source/public datasets**. Never publish proprietary
  student data or paid Level 2/3 materials.
- Keep the prototype framework-free and dependency-light (fonts via CDN or self-hosted only).
- Don't introduce a build step in `/prototype`. Heavy tooling belongs in `/wp-theme` if needed.
- Accessibility and performance are acceptance criteria, not nice-to-haves.

## Handy references

- Live channels: YouTube @datapeakssolutions · Instagram @datapeaks_solutions ·
  Facebook DatapeaksSolutions · WhatsApp channel `0029Vb8WGoL0gcfBsEi1in3z`.
- Domain: datapeakssolutions.com (GoDaddy).

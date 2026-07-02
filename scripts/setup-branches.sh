#!/usr/bin/env bash
# =====================================================================
# DataPeaks Solutions — create epic branches + open PRs
# Run this on your own machine (macOS/Linux) from anywhere inside the repo.
# It creates 4 branches off `main` with disjoint file sets, pushes them,
# and opens a PR for each (using GitHub CLI `gh` if installed).
#
#   chmod +x scripts/setup-branches.sh
#   ./scripts/setup-branches.sh
#
# Requirements: git, and push access to origin. Optional: gh (GitHub CLI).
# =====================================================================
set -euo pipefail

cd "$(git rev-parse --show-toplevel)"
REPO_URL="https://github.com/mshanawazsoftech/DataPeaks-Solutions"

echo "==> Cleaning any stale git state"
rm -f .git/index.lock .git/refs/heads/_write_test.lock .git/packed-refs.lock 2>/dev/null || true
git checkout main
git branch -D _write_test 2>/dev/null || true
git pull --ff-only origin main || true

# make_branch <branch> <commit-msg> <file> [file...]
make_branch () {
  local branch="$1"; shift
  local msg="$1"; shift
  echo ""
  echo "==> $branch"
  git checkout main
  git checkout -B "$branch"
  git add -- "$@"
  git commit -m "$msg"
  git push -u --force-with-lease origin "$branch"
}

# open_pr <branch> <title> <body>
open_pr () {
  local branch="$1" title="$2" body="$3"
  if command -v gh >/dev/null 2>&1; then
    gh pr create --base main --head "$branch" --title "$title" --body "$body" || \
      echo "   (PR may already exist for $branch)"
  else
    echo "   Open PR: ${REPO_URL}/compare/main...${branch}?expand=1"
  fi
}

# ---------------------------------------------------------------------
# E1 — Foundation & docs
# ---------------------------------------------------------------------
make_branch "docs/E1-planning" \
  "docs(E1): add strategy, plan, conventions, progress log and PR tooling" \
  CLAUDE.md plan.md progress.md strategy.md README.md .gitignore \
  PULL_REQUESTS.md scripts/setup-branches.sh
open_pr "docs/E1-planning" "[E1] Foundation & docs" \
"Project scaffolding and documentation.

- strategy.md — vision, positioning, WordPress-on-GoDaddy decision, SEO, monetization
- plan.md — 6-phase delivery plan, epics E1-E6, branch naming and git workflow
- CLAUDE.md — conventions and context for contributors
- progress.md — living progress log
- README.md — quick start
- .gitignore

Definition of Done: docs reviewed, conventions agreed."

# ---------------------------------------------------------------------
# E2 — Prototype UI (pages, styles, behaviour, data)
# ---------------------------------------------------------------------
make_branch "feat/E2-prototype-ui" \
  "feat(E2): add responsive, accessible multi-page prototype (UI + data)" \
  prototype/index.html prototype/courses.html prototype/course.html \
  prototype/weekly-log.html prototype/about.html prototype/contact.html \
  prototype/assets/css/styles.css prototype/assets/js/data.js prototype/assets/js/main.js
open_pr "feat/E2-prototype-ui" "[E2] Prototype UI" \
"Framework-free, responsive, accessible multi-page prototype — design source of truth for the WordPress theme.

Pages: Home, Courses, Course detail (data-driven, 6 tracks), Weekly Log, About, Contact/Enroll.
UI: dark premium design system, per-course colour accents, announcement bar, full-name social links (top + bottom).
A11y (WCAG 2.1 AA): skip link, landmarks, aria-current nav, keyboard-accessible tabs, form aria states, focus rings, reduced-motion, AA contrast.

DoD: responsive, keyboard-navigable, no console errors."

# ---------------------------------------------------------------------
# E2 (design) — Logo & brand assets
# ---------------------------------------------------------------------
make_branch "design/E2-logo-branding" \
  "design(E2): add logo, favicon and Open Graph brand assets" \
  prototype/assets/img/logo-mark.svg prototype/assets/img/logo-full.svg \
  prototype/assets/img/favicon.svg prototype/assets/img/favicon-32.png \
  prototype/assets/img/apple-touch-icon.png \
  prototype/assets/img/og-image.svg prototype/assets/img/og-image.png
open_pr "design/E2-logo-branding" "[E2] Logo & brand assets" \
"Custom brand mark: ascending peaks (data bars + mountain 'pinnacles') with a gold summit, in the cyan-blue-emerald palette.

- logo-mark.svg — icon / nav / favicon source
- logo-full.svg — horizontal lockup
- favicon.svg, favicon-32.png, apple-touch-icon.png
- og-image.svg / og-image.png — 1200x630 social share card"

# ---------------------------------------------------------------------
# E3 — Content, legal & SEO
# ---------------------------------------------------------------------
make_branch "content/E3-content-seo" \
  "content(E3): add legal pages, 404, robots and sitemap" \
  prototype/privacy.html prototype/terms.html prototype/404.html \
  prototype/robots.txt prototype/sitemap.xml
open_pr "content/E3-content-seo" "[E3] Content, legal & SEO" \
"Completes the site for launch.

- privacy.html, terms.html — legal pages
- 404.html — branded not-found page
- robots.txt + sitemap.xml
(Open Graph / Twitter / canonical meta and JSON-LD ship inside the E2 pages.)

Suggested merge order: E1 -> E2 -> design/E2 -> E3."

git checkout main
echo ""
echo "==> Done. Branches pushed and PRs opened (or compare links printed above)."
echo "    Review order: [E1] -> [E2] -> [E2 logo] -> [E3]."

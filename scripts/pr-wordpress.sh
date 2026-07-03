#!/usr/bin/env bash
# =====================================================================
# DataPeaks — create the WordPress theme PR  [E4]
# Branches from the up-to-date origin/main and adds wp-theme/, then
# pushes and opens the PR. Safe to re-run.
#
#   chmod +x scripts/pr-wordpress.sh
#   ./scripts/pr-wordpress.sh
# =====================================================================
set -uo pipefail

cd "$(git rev-parse --show-toplevel)"
REPO_URL="https://github.com/mshanawazsoftech/DataPeaks-Solutions"
BRANCH="feat/E4-wordpress-theme"

echo "==> Fetching latest"
rm -f .git/index.lock 2>/dev/null || true
git fetch origin

echo "==> Creating $BRANCH from origin/main"
# -f overwrites the untracked prototype/ copies with origin's tracked versions
# (identical content); the untracked wp-theme/ folder is preserved.
git checkout -f -B "$BRANCH" origin/main

echo "==> Staging the theme"
git add wp-theme

if git diff --cached --quiet; then
	echo "   nothing to commit — wp-theme already on origin/main?"
else
	git commit -m "feat(E4): add custom WordPress theme built from the prototype"
fi

echo "==> Pushing"
if git push -u origin "$BRANCH"; then
	echo "==> Opening PR"
	if command -v gh >/dev/null 2>&1; then
		gh auth setup-git >/dev/null 2>&1 || true
		gh pr create --base main --head "$BRANCH" \
			--title "[E4] WordPress theme" \
			--body "Custom WordPress theme (\`datapeaks\`) built from the approved prototype.

- Custom post types: Course + Project (Weekly Log) with admin meta boxes
- One-time content seeder on activation (6 courses, 12 weekly projects, pages, menu, front page)
- Templates: front page, courses archive, course detail (accessible level tabs), weekly log (filter), about, contact (enquiry form -> wp_mail), page, 404
- SEO: Open Graph / Twitter / JSON-LD / favicons
- Same design system + WCAG 2.1 AA as the prototype

See wp-theme/README.md for install + GoDaddy + SMTP notes." \
			|| echo "   Open PR manually: ${REPO_URL}/compare/main...${BRANCH}?expand=1"
	else
		echo "   Open PR: ${REPO_URL}/compare/main...${BRANCH}?expand=1"
	fi
else
	cat <<'NOTE'
Push failed — set up GitHub auth, then re-run this script:
  gh auth login        # GitHub.com -> HTTPS -> browser
  gh auth setup-git
NOTE
fi

echo ""
echo "Done. Review order overall: [E1] -> [E2] -> [E2 logo] -> [E3] -> [E4 WordPress]."

#!/usr/bin/env bash
# =====================================================================
# DataPeaks — PR for the Core plugin + launch guide  [E4/E5]
# Commits the new/changed files (plugin, LAUNCH.md, plan.md phase-6,
# progress.md, the theme's plugin-hook edit), pushes a branch, opens a PR.
# Safe to re-run.
#
#   chmod +x scripts/pr-plugin.sh
#   ./scripts/pr-plugin.sh
# =====================================================================
set -uo pipefail

cd "$(git rev-parse --show-toplevel)"
REPO_URL="https://github.com/mshanawazsoftech/DataPeaks-Solutions"
BR="feat/E4-core-plugin"

echo "==> Fetching latest"
rm -f .git/index.lock 2>/dev/null || true
git fetch origin

echo "==> Staging changes (plugin, docs, theme hook)"
git add -A

if git diff --cached --quiet; then
	echo "   nothing new to commit"
else
	git commit -m "feat(E4): DataPeaks Core plugin, launch guide, phase-6 plan, theme plugin hook"
fi

echo "==> Creating branch $BR"
git branch -f "$BR"
git checkout "$BR"

echo "==> Pushing"
if git push -u origin "$BR"; then
	echo "==> Opening PR"
	if command -v gh >/dev/null 2>&1; then
		gh auth setup-git >/dev/null 2>&1 || true
		gh pr create --base main --head "$BR" \
			--title "[E4] Core plugin + launch guide" \
			--body "Companion plugin and launch docs.

**DataPeaks Core plugin** (\`wp-plugin/datapeaks-core\`)
- Moves the Course + Project (Weekly Log) CPTs, admin meta boxes, default data and content seeder into a plugin, so course/log data is independent of the active theme.
- Theme now defers to the plugin when active (single source of truth) and still works standalone if it isn't.

**Docs**
- \`LAUNCH.md\` — full GoDaddy go-live guide (install order, required SMTP, SSL, caching, security, backups, SEO/analytics) + pre-launch QA checklist.
- \`plan.md\` — expanded Phase 6 (LMS): Tutor LMS/LearnDash + WooCommerce + Razorpay/Stripe, memberships, certificates, email nurture.

All PHP lint-clean." \
			|| echo "   Open PR manually: ${REPO_URL}/compare/main...${BR}?expand=1"
	else
		echo "   Open PR: ${REPO_URL}/compare/main...${BR}?expand=1"
	fi
else
	cat <<'NOTE'
Push failed — set up GitHub auth, then re-run:
  gh auth login && gh auth setup-git
NOTE
fi

echo ""
echo "Done. After this merges, follow LAUNCH.md to deploy on GoDaddy."

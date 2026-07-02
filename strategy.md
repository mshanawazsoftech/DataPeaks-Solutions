# DataPeaks Solutions — Strategy

> Data & AI education institution based in Hyderabad. Placement-focused, project-based
> learning across six tracks, taught through real pipelines students can run themselves.
> This document is the "why" and "what". `plan.md` is the "how" and "when".

Last updated: 2026-07-02 · Owner: mshanawazsoftech

---

## 1. Vision & Mission

**Vision.** Become a globally recognized, placement-focused data & AI training institution
serving learners across India, UAE, UK, Australia, USA, and Singapore.

**Mission.** Take a learner from zero to FAANG-ready through weekly, project-based drops —
every concept in every course taught via real, runnable pipelines on open datasets.

**One-line promise.** *Weekly project-based learning, from zero to FAANG-ready.*

---

## 2. Positioning

| Dimension | Choice |
|---|---|
| Category | Data & AI vocational education / upskilling |
| Differentiator | 100% project-based; one runnable project per week; every tool in the stack |
| Proof | Public GitHub project hub; Level 1 of every course fully free |
| Tone | Technical, credible, ambitious, no fluff |
| Geography | HQ Hyderabad; target diaspora + global online learners |

**Free-to-paid ladder (access model).**
- **Level 1 (Beginner)** — fully free for every course. All concepts, all tools, no paywall.
- **Level 2 (Intermediate) & Level 3 (Advanced)** — paid DataPeaks programs, deeper + placement prep.
- Public repo uses only open-source / public datasets. Proprietary student datasets and
  paid-course materials are never published.

---

## 3. Audience & Segments

1. **Career-switchers** entering data/AI — need structure, projects, placement help.
2. **Students / fresh grads** — want portfolio projects and FAANG-level prep.
3. **Working professionals** upskilling into ML / DE / GenAI / Agentic AI.
4. **Diaspora / international learners** (UAE, UK, AU, USA, SG) — online cohorts.

Primary conversion goal: **enrollment enquiry / demo booking**. Secondary: **YouTube subscribe**,
newsletter signup, and repo stars.

---

## 4. The Six Tracks

| Code | Course | Focus |
|---|---|---|
| CDA | Certified Data Analyst | pandas, numpy, SQL, Excel, Power BI, storytelling |
| CDS | Certified Data Scientist | stats, ML modeling, experimentation |
| MLE | ML Engineering | training, serving, MLOps, pipelines |
| DE | Data Engineering | ingestion, warehousing, orchestration, streaming |
| GAI | Generative AI | LLMs, RAG, embeddings, fine-tuning |
| AAI | Agentic AI | agents, tool-use, orchestration, evaluation |

Each track has **3 levels** (Beginner / Intermediate / Advanced) and **one project per week**.

---

## 5. Digital Presence

| Channel | Handle / URL |
|---|---|
| Website | datapeakssolutions.com |
| YouTube | @datapeakssolutions |
| Instagram | @datapeaks_solutions |
| Facebook | DatapeaksSolutions |
| WhatsApp | Channel 0029Vb8WGoL0gcfBsEi1in3z |
| GitHub | github.com/mshanawazsoftech/DataPeaks-Solutions |

The website is the hub: it converts visitors to enquiries and routes them to social + repo.

---

## 6. Technology Strategy

**Decision: WordPress (latest, 6.x) on GoDaddy, PHP 8.x + MySQL.**

Rationale over Drupal: faster to launch, far larger plugin/theme ecosystem, first-class
GoDaddy support (managed WordPress + one-click install), easiest for non-developers to
maintain content (courses, weekly log, blog), and mature LMS options.

**Design-first workflow.** We build a **static HTML/CSS/JS prototype first** to lock the
brand, layout, and content, then convert the approved prototype into a **custom WordPress
theme**. This de-risks design, keeps markup clean, and gives us a fast fallback (the static
site can ship as-is if WordPress setup slips).

**Proposed stack**
- CMS: WordPress 6.x (Full Site Editing capable, but we ship a classic custom theme built from the prototype)
- Host: GoDaddy (existing plan) — MySQL DB (10 GB), multiple mailboxes
- LMS (Level 2/3, later phase): Tutor LMS or LearnDash (evaluate; start with Tutor LMS free)
- Forms & leads: Fluent Forms or WPForms → email + DB; optional CRM webhook
- SEO: Rank Math or Yoast; sitemap, schema.org (Course, Organization, FAQ)
- Performance: caching (LiteSpeed/W3 Total Cache), image optimization, lazy-load
- Security: Wordfence/limit-login, least-privilege admin, updates policy
- Analytics: Google Analytics 4 + Search Console; Meta Pixel for social ads
- Email: transactional via GoDaddy mailboxes / SMTP plugin (e.g. FluentSMTP)

**Alternative kept on the table.** If a heavier, more structured content model is ever
required, Drupal 10/11 remains an option — but WordPress is the committed primary path.

---

## 7. Design System (brand)

Derived from the DataPeaks logo (dark circuit-board hero, glowing bar-graph, neon accents).

- **Palette:** deep navy/near-black background `#0A0F1E`; surfaces `#111834`;
  cyan `#22D3EE`, electric blue `#3B82F6`, gold `#F5B301`, emerald `#34D399`.
- **Type:** display/heading — a bold geometric sans (e.g. "Sora"/"Space Grotesk");
  body — "Inter". System-font fallback stack for performance.
- **Motifs:** circuit lines, glow, gradient bar-graph, course badges (CDA/CDS/MLE/DE/GAI/AAI).
- **Principles:** dark-first, high contrast, generous spacing, motion used sparingly,
  WCAG AA contrast, fully responsive, fast.

---

## 8. Site Map (100% scope)

```
Home
Courses (overview of all 6 tracks)
  └─ Course detail (template, one per track: CDA/CDS/MLE/DE/GAI/AAI)
Project Hub / Weekly Log (tracks × levels, weekly drops)
About (institution, geos, team)
Contact / Enroll (enquiry + demo booking form)
Legal (Privacy, Terms)  — later phase
Blog / Resources — later phase
```

---

## 9. SEO & Growth

- Target keywords: "data analyst course Hyderabad", "data science placement training",
  "learn data engineering projects", "generative AI course", "agentic AI course", etc.
- On-page: semantic HTML, schema (Course, Organization, BreadcrumbList, FAQ), fast LCP.
- Content engine: weekly project post → cross-post to YouTube + Instagram + WhatsApp channel.
- Free Level 1 as top-of-funnel; enquiry form + demo as conversion; email nurture.
- Local SEO: Google Business Profile (Hyderabad), reviews, NAP consistency.

---

## 10. Monetization

- **Free:** Level 1 of all six courses (lead magnet).
- **Paid:** Level 2 & 3 cohort/self-paced programs; placement track; corporate/upskilling.
- **Future:** certifications, mentorship, international online cohorts, B2B training.

---

## 11. Success Metrics (first 90 days)

| Metric | Target |
|---|---|
| Site live on datapeakssolutions.com | Phase 4 |
| Enquiry form submissions / month | baseline → grow |
| YouTube subscribers | grow from launch |
| Level-1 project pages published | ≥ 6 (one per track) |
| Core Web Vitals | all "Good" (LCP < 2.5s) |
| SEO indexed pages | all primary pages + weekly posts |

---

## 12. Risks & Mitigations

| Risk | Mitigation |
|---|---|
| GoDaddy shared-host limits (PHP/memory) | Keep theme lean; caching; static fallback ready |
| Scope creep (LMS too early) | LMS deferred to a later phase; brochure + hub first |
| Content bottleneck (weekly cadence) | Templates + editorial calendar in repo; batch content |
| Brand inconsistency | Design system + component library from the prototype |
| Security on WP | Wordfence, updates policy, least-privilege, backups |

/* DataPeaks Solutions — interactions + light rendering (prototype) */
(function () {
  "use strict";
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const DP = window.DP || {};
  const COLORHEX = { cyan:"var(--cyan)", emerald:"var(--emerald)", mle:"var(--blue)", de:"var(--gold)", violet:"var(--violet)", pink:"var(--pink)" };
  const badgeClass = { CDA:"badge--cda", CDS:"badge--cds", MLE:"badge--mle", DE:"badge--de", GAI:"badge--gai", AAI:"badge--aai" };

  /* ---- Mobile nav ---- */
  const toggle = $(".nav-toggle");
  if (toggle) {
    toggle.addEventListener("click", () => {
      const open = document.body.classList.toggle("nav-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    $$(".nav-links a").forEach(a => a.addEventListener("click", () => document.body.classList.remove("nav-open")));
  }

  /* ---- Active nav link by path ---- */
  const path = location.pathname.split("/").pop() || "index.html";
  $$(".nav-links a").forEach(a => {
    const href = a.getAttribute("href");
    if (href === path || (path === "" && href === "index.html")) {
      a.classList.add("active");
      a.setAttribute("aria-current", "page");
    }
  });

  /* ---- Reveal on scroll ---- */
  const io = "IntersectionObserver" in window
    ? new IntersectionObserver((es) => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add("in"); io.unobserve(e.target); } }), { threshold: .12 })
    : null;
  $$(".reveal").forEach(el => io ? io.observe(el) : el.classList.add("in"));

  /* ---- Footer year ---- */
  $$("[data-year]").forEach(el => el.textContent = new Date().getFullYear());

  /* ---- Social links (full names, top + bottom) ---- */
  if (DP.social) {
    const items = DP.social.map(s =>
      `<a href="${s.url}" target="_blank" rel="noopener" aria-label="${s.name} (opens in a new tab)">` +
      `<span class="si">${s.svg}</span><span class="sn">${s.name}</span></a>`).join("");
    $$("[data-social], [data-social-top]").forEach(el => el.innerHTML = items);
  }

  /* ---- Render course grid (home + courses page) ---- */
  const grid = $("[data-course-grid]");
  if (grid && DP.courses) {
    grid.innerHTML = DP.courses.map(c => `
      <a class="card course-card reveal" style="--accent:${COLORHEX[c.color]}" href="course.html?c=${c.slug}" aria-label="${c.name} — Level 1 free">
        <div class="cc-top">
          <div class="course-icon" style="background:${COLORHEX[c.color]}">${c.code}</div>
          <span class="badge badge--free"><span class="dot"></span>Level 1 free</span>
        </div>
        <div>
          <h3>${c.name}</h3>
          <p style="margin-top:.4rem">${c.tagline}</p>
        </div>
        <div class="cc-tools">${c.tools.slice(0,5).map(t => `<span class="tag">${t}</span>`).join("")}</div>
        <div class="cc-foot">
          <span class="badge ${badgeClass[c.code]}"><span class="dot"></span>${c.code}</span>
          <span class="arrow" aria-hidden="true">Explore →</span>
        </div>
      </a>`).join("");
    $$(".reveal", grid).forEach(el => io ? io.observe(el) : el.classList.add("in"));
  }

  /* ---- Course detail page ---- */
  const detail = $("[data-course-detail]");
  if (detail && DP.courses) {
    const slug = new URLSearchParams(location.search).get("c") || "cda";
    const c = DP.courses.find(x => x.slug === slug) || DP.courses[0];
    document.title = `${c.name} — DataPeaks Solutions`;
    $("[data-cd-code]").textContent = c.code;
    $("[data-cd-code]").style.background = COLORHEX[c.color];
    $$("[data-cd-name]").forEach(el => el.textContent = c.name);
    $("[data-cd-tagline]").textContent = c.tagline;
    $("[data-cd-summary]").textContent = c.summary;
    $("[data-cd-badge]").className = "badge " + badgeClass[c.code];
    $("[data-cd-badge]").innerHTML = `<span class="dot"></span>${c.code}`;
    $("[data-cd-tools]").innerHTML = c.tools.map(t => `<span class="tag">${t}</span>`).join("");
    $("[data-cd-outcomes]").innerHTML = c.outcomes.map(o => `<li>${o}</li>`).join("");

    // level tabs
    const levels = Object.keys(c.levels);
    const tabsEl = $("[data-cd-tabs]");
    const panel = $("[data-cd-panel]");
    const renderLevel = (lvl, i) => {
      const items = c.levels[lvl] || [];
      const isFree = i === 0;
      panel.innerHTML = `
        <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:1rem">
          <strong style="font-family:var(--font-head)">${lvl}</strong>
          ${isFree ? '<span class="badge badge--free"><span class="dot"></span>Free</span>' : '<span class="badge">Paid program</span>'}
        </div>
        <div class="level-list">
          ${items.map(it => `
            <div class="level-row">
              <span class="wk">${it.wk}</span>
              <div>
                <h4>${it.title}</h4>
                <p>${it.desc}</p>
                <div style="margin-top:.5rem">${it.tools.map(t=>`<span class="tag">${t}</span>`).join("")}</div>
              </div>
            </div>`).join("")}
        </div>`;
    };
    tabsEl.innerHTML = levels.map((l, i) => `<button class="tab ${i===0?'active':''}" role="tab" id="tab-${i}" aria-selected="${i===0}" tabindex="${i===0?0:-1}" data-lvl="${l}" data-i="${i}">${l}</button>`).join("");
    panel.setAttribute("role", "tabpanel");
    panel.setAttribute("aria-labelledby", "tab-0");
    renderLevel(levels[0], 0);
    const selectTab = (b) => {
      $$(".tab", tabsEl).forEach(t => { t.classList.remove("active"); t.setAttribute("aria-selected","false"); t.tabIndex = -1; });
      b.classList.add("active"); b.setAttribute("aria-selected","true"); b.tabIndex = 0;
      panel.setAttribute("aria-labelledby", b.id);
      renderLevel(b.dataset.lvl, +b.dataset.i);
    };
    tabsEl.addEventListener("click", (e) => { const b = e.target.closest(".tab"); if (b) selectTab(b); });
    tabsEl.addEventListener("keydown", (e) => {
      const tabs = $$(".tab", tabsEl);
      const i = tabs.indexOf(document.activeElement);
      if (i < 0) return;
      let n = null;
      if (e.key === "ArrowRight" || e.key === "ArrowDown") n = (i + 1) % tabs.length;
      else if (e.key === "ArrowLeft" || e.key === "ArrowUp") n = (i - 1 + tabs.length) % tabs.length;
      else if (e.key === "Home") n = 0; else if (e.key === "End") n = tabs.length - 1;
      if (n !== null) { e.preventDefault(); tabs[n].focus(); selectTab(tabs[n]); }
    });

    // other courses
    const others = $("[data-cd-others]");
    if (others) others.innerHTML = DP.courses.filter(x => x.slug !== c.slug).map(x => `
      <a class="card course-card reveal in" href="course.html?c=${x.slug}">
        <div class="cc-top"><div class="course-icon" style="background:${COLORHEX[x.color]}">${x.code}</div></div>
        <h3 style="font-size:1.1rem">${x.name}</h3>
        <span class="arrow">Explore →</span>
      </a>`).join("");
  }

  /* ---- Weekly log render + filter ---- */
  const logBody = $("[data-log-body]");
  if (logBody && DP.weeklyLog) {
    const render = (rows) => {
      logBody.innerHTML = rows.length ? rows.map(r => `
        <tr>
          <td><strong>W${r.week}</strong></td>
          <td>${r.date}</td>
          <td><span class="badge ${badgeClass[r.course]}"><span class="dot"></span>${r.course}</span> <span class="tag">${r.level}</span></td>
          <td>${r.project}</td>
          <td>${r.tools.map(t=>`<span class="tag">${t}</span>`).join("")}</td>
        </tr>`).join("")
        : `<tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No projects for this filter yet — new drops weekly.</td></tr>`;
    };
    render(DP.weeklyLog);
    const fb = $("[data-log-filter]");
    if (fb) fb.addEventListener("click", (e) => {
      const chip = e.target.closest(".filter-chip"); if (!chip) return;
      $$(".filter-chip", fb).forEach(c => c.classList.remove("active"));
      chip.classList.add("active");
      const f = chip.dataset.filter;
      render(f === "all" ? DP.weeklyLog : DP.weeklyLog.filter(r => r.course === f));
    });
  }

  /* ---- FAQ accordion ---- */
  const acc = $("[data-accordion]");
  if (acc && DP.faqs) {
    acc.innerHTML = DP.faqs.map((f, i) => `
      <div class="acc-item">
        <button class="acc-btn" aria-expanded="false" aria-controls="faq-${i}">
          <span>${f.q}</span><span class="ic" aria-hidden="true">+</span>
        </button>
        <div class="acc-panel" id="faq-${i}"><div>${f.a}</div></div>
      </div>`).join("");
    acc.addEventListener("click", (e) => {
      const btn = e.target.closest(".acc-btn"); if (!btn) return;
      const item = btn.parentElement;
      const panel = item.querySelector(".acc-panel");
      const open = item.classList.toggle("open");
      btn.setAttribute("aria-expanded", open ? "true" : "false");
      panel.style.maxHeight = open ? panel.scrollHeight + "px" : null;
    });
  }

  /* ---- Contact form validation ---- */
  const form = $("[data-contact-form]");
  if (form) {
    // populate course select
    const sel = form.querySelector("select[name=course]");
    if (sel && DP.courses) sel.insertAdjacentHTML("beforeend", DP.courses.map(c => `<option value="${c.code}">${c.name} (${c.code})</option>`).join(""));

    const setErr = (field, msg) => {
      const wrap = field.closest(".field");
      wrap.classList.toggle("invalid", !!msg);
      field.setAttribute("aria-invalid", msg ? "true" : "false");
      const e = wrap.querySelector(".err");
      if (e) { e.textContent = msg || ""; e.setAttribute("aria-live", "polite"); }
    };
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      let ok = true;
      const name = form.name, email = form.email, msg = form.message;
      if (!name.value.trim()) { setErr(name, "Please enter your name."); ok = false; } else setErr(name, "");
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email.value)) { setErr(email, "Enter a valid email."); ok = false; } else setErr(email, "");
      if (msg && !msg.value.trim()) { setErr(msg, "Tell us a little about your goal."); ok = false; } else if (msg) setErr(msg, "");
      if (ok) {
        form.reset();
        const s = $("[data-form-success]");
        if (s) { s.style.display = "block"; s.setAttribute("tabindex", "-1"); s.scrollIntoView({ behavior: "smooth", block: "center" }); s.focus(); }
      }
    });
  }
})();

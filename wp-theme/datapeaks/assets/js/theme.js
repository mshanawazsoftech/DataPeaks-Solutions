/* DataPeaks WordPress theme — interactions for server-rendered markup */
(function () {
  "use strict";
  var $ = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* Mobile nav */
  var toggle = $(".nav-toggle");
  if (toggle) {
    toggle.addEventListener("click", function () {
      var open = document.body.classList.toggle("nav-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    $$(".nav-links a").forEach(function (a) {
      a.addEventListener("click", function () { document.body.classList.remove("nav-open"); });
    });
  }

  /* Active nav by path */
  var here = location.pathname.replace(/\/+$/, "");
  $$(".nav-links a").forEach(function (a) {
    try {
      var p = new URL(a.href, location.origin).pathname.replace(/\/+$/, "");
      if (p === here && p !== "") { a.classList.add("active"); a.setAttribute("aria-current", "page"); }
    } catch (e) {}
  });

  /* Reveal on scroll */
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add("in"); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    $$(".reveal").forEach(function (el) { io.observe(el); });
  } else {
    $$(".reveal").forEach(function (el) { el.classList.add("in"); });
  }

  /* FAQ accordion */
  var acc = $("[data-accordion]");
  if (acc) {
    acc.addEventListener("click", function (e) {
      var btn = e.target.closest(".acc-btn"); if (!btn) return;
      var item = btn.parentElement;
      var panel = item.querySelector(".acc-panel");
      var open = item.classList.toggle("open");
      btn.setAttribute("aria-expanded", open ? "true" : "false");
      panel.style.maxHeight = open ? panel.scrollHeight + "px" : null;
    });
  }

  /* Course level tabs */
  var tablist = $(".tabs[role=tablist]");
  if (tablist) {
    var panels = $$('.tab-panel');
    var select = function (btn) {
      $$(".tab", tablist).forEach(function (t) { t.classList.remove("active"); t.setAttribute("aria-selected", "false"); t.tabIndex = -1; });
      btn.classList.add("active"); btn.setAttribute("aria-selected", "true"); btn.tabIndex = 0;
      var i = btn.getAttribute("data-i");
      panels.forEach(function (p) { p.hidden = p.getAttribute("data-i") !== i; });
    };
    tablist.addEventListener("click", function (e) { var b = e.target.closest(".tab"); if (b) select(b); });
    tablist.addEventListener("keydown", function (e) {
      var tabs = $$(".tab", tablist);
      var idx = tabs.indexOf(document.activeElement);
      if (idx < 0) return;
      var n = null;
      if (e.key === "ArrowRight" || e.key === "ArrowDown") n = (idx + 1) % tabs.length;
      else if (e.key === "ArrowLeft" || e.key === "ArrowUp") n = (idx - 1 + tabs.length) % tabs.length;
      else if (e.key === "Home") n = 0;
      else if (e.key === "End") n = tabs.length - 1;
      if (n !== null) { e.preventDefault(); tabs[n].focus(); select(tabs[n]); }
    });
  }

  /* Weekly-log filter */
  var fb = $("[data-log-filter]");
  if (fb) {
    fb.addEventListener("click", function (e) {
      var chip = e.target.closest(".filter-chip"); if (!chip) return;
      $$(".filter-chip", fb).forEach(function (c) { c.classList.remove("active"); });
      chip.classList.add("active");
      var f = chip.getAttribute("data-filter");
      $$("[data-log-body] tr").forEach(function (tr) {
        tr.style.display = (f === "all" || tr.getAttribute("data-course") === f) ? "" : "none";
      });
    });
  }

  /* Contact form — light client-side validation (server validates too) */
  var form = $("[data-contact-form]");
  if (form) {
    form.addEventListener("submit", function (e) {
      var ok = true;
      var setErr = function (field, msg) {
        var wrap = field.closest(".field");
        wrap.classList.toggle("invalid", !!msg);
        field.setAttribute("aria-invalid", msg ? "true" : "false");
        var el = wrap.querySelector(".err"); if (el) { el.textContent = msg || ""; el.setAttribute("aria-live", "polite"); }
      };
      if (!form.name.value.trim()) { setErr(form.name, "Please enter your name."); ok = false; } else setErr(form.name, "");
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(form.email.value)) { setErr(form.email, "Enter a valid email."); ok = false; } else setErr(form.email, "");
      if (!ok) { e.preventDefault(); }
    });
  }
})();

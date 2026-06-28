(function () {
  'use strict';

  /* ── ヘッダー縮小 + パラックス ── */
  function onScroll() {
    var y = window.scrollY || window.pageYOffset || 0;
    var hdr = document.getElementById('siteHeader');
    var inner = document.getElementById('siteHeaderInner');
    if (hdr) {
      hdr.style.boxShadow = y > 16 ? '0 6px 22px rgba(52,64,47,.10)' : 'none';
      hdr.style.background = y > 16 ? 'rgba(247,243,234,.97)' : 'rgba(247,243,234,.9)';
    }
    if (inner) {
      var pad = y > 16 ? '6px' : '11px';
      inner.style.paddingTop = pad;
      inner.style.paddingBottom = pad;
    }
    var heroBg = document.getElementById('heroBg');
    if (heroBg) heroBg.style.transform = 'translateY(' + (y * 0.22) + 'px)';
    updateHeroCurve();
    runReveal();
  }

  /* ── Ivory パネル拡張アニメーション ── */
  function updateHeroCurve() {
    var wrap = document.getElementById('heroWrap');
    var path = document.getElementById('heroCurve');
    if (!wrap || !path) return;
    var sec = document.getElementById('heroSection');
    var scrollable = wrap.offsetHeight - ((sec && sec.offsetHeight) || window.innerHeight || 700);
    var scrolled = Math.min(Math.max(-wrap.getBoundingClientRect().top, 0), Math.max(scrollable, 1));
    var p = scrollable > 0 ? scrolled / scrollable : 0;
    p = Math.max(0, Math.min(1, p));
    var e = 1 - Math.pow(1 - p, 2);
    var x1 = (42 + 104 * e).toFixed(1);
    var cx = (58 + 118 * e).toFixed(1);
    var x2 = (30 + 126 * e).toFixed(1);
    path.setAttribute('d', 'M0,0 L' + x1 + ',0 Q' + cx + ',50 ' + x2 + ',100 L0,100 Z');
    var pt = document.getElementById('heroPhotoText');
    if (pt) pt.style.opacity = String(Math.max(0, 1 - Math.max(0, (p - 0.3)) / 0.35));
    var cue = document.getElementById('scrollCue');
    if (cue) cue.style.opacity = String(Math.max(0, 1 - p / 0.35));
  }

  /* ── スクロール Reveal ── */
  function runReveal() {
    var vh = window.innerHeight || 800;
    var trigger = vh * 0.9;
    function handle(el, delay) {
      if (!el) return;
      var st = el.getAttribute('data-reveal-state');
      if (st === 'done') return;
      if (st !== 'pending') {
        var dist = el.getAttribute('data-reveal-dist') || '26';
        var dur  = el.getAttribute('data-reveal-dur')  || '0.7';
        el.setAttribute('data-reveal-state', 'pending');
        el.style.opacity    = '0';
        el.style.transform  = 'translateY(' + dist + 'px)';
        el.style.transition = 'opacity ' + dur + 's cubic-bezier(.22,.61,.36,1), transform ' + dur + 's cubic-bezier(.22,.61,.36,1)';
        el.style.transitionDelay = delay + 's';
      }
      if (el.getBoundingClientRect().top < trigger) {
        el.setAttribute('data-reveal-state', 'done');
        el.style.opacity   = '1';
        el.style.transform = 'none';
      }
    }
    document.querySelectorAll('[data-stagger]').forEach(function (c) {
      Array.from(c.children).forEach(function (ch, i) { handle(ch, Math.min(i, 6) * 0.09); });
    });
    document.querySelectorAll('[data-reveal]').forEach(function (el) { handle(el, 0); });

    var chiiki = document.getElementById('chiikiSection');
    var cta    = document.getElementById('floatingCta');
    if (chiiki && cta && cta.getAttribute('data-cta-shown') !== '1') {
      if (chiiki.getBoundingClientRect().top < trigger) {
        cta.style.opacity       = '1';
        cta.style.pointerEvents = 'auto';
        cta.setAttribute('data-cta-shown', '1');
      }
    }
  }

  /* ── ハンバーガーメニュー ── */
  function initMenu() {
    var toggle  = document.getElementById('menuToggle');
    var closeBtn = document.getElementById('menuClose');
    var menu    = document.getElementById('mobileMenu');
    var overlay = document.getElementById('menuOverlay');
    if (!toggle || !menu) return;

    function open() {
      menu.classList.remove('hidden');
      menu.setAttribute('aria-hidden', 'false');
      toggle.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    }
    function close() {
      menu.classList.add('hidden');
      menu.setAttribute('aria-hidden', 'true');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
    toggle.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (overlay)  overlay.addEventListener('click', close);
  }

  /* ── ヘッダー高さを CSS 変数にセット ── */
  function setHeaderHeight() {
    var hdr = document.getElementById('siteHeader');
    if (hdr) {
      document.documentElement.style.setProperty('--hdr-h', hdr.offsetHeight + 'px');
    }
  }

  /* ── 初期化 ── */
  var rafPending = false;
  window.addEventListener('scroll', function () {
    if (!rafPending) {
      rafPending = true;
      requestAnimationFrame(function () {
        rafPending = false;
        onScroll();
      });
    }
  }, { passive: true });
  window.addEventListener('resize', setHeaderHeight, { passive: true });
  document.addEventListener('DOMContentLoaded', function () {
    setHeaderHeight();
    initMenu();
    onScroll();
    updateHeroCurve();
    runReveal();
  });
})();

/* ============================================================
   WATCHTIME.AH — PREMIUM INTERACTIONS
   ============================================================ */

/* ---- Navbar scroll state ---- */
(function () {
  const nav = document.querySelector('nav.lux-nav');
  if (!nav) return;
  const onScroll = () => {
    if (window.scrollY > 40) nav.classList.add('scrolled');
    else nav.classList.remove('scrolled');
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
})();

/* ---- 3D Tilt on watch cards ---- */
(function () {
  const cards = document.querySelectorAll('.watch-card');
  if (!cards.length) return;

  // Skip heavy tilt on touch / small screens
  const isTouch = window.matchMedia('(hover: none)').matches;

  cards.forEach(card => {
    if (isTouch) return;
    const media = card.querySelector('.card-media img');

    card.addEventListener('mousemove', (e) => {
      const r = card.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width;
      const py = (e.clientY - r.top) / r.height;
      const rotY = (px - 0.5) * 14;
      const rotX = (0.5 - py) * 12;
      card.style.transform = `rotateY(${rotY}deg) rotateX(${rotX}deg) translateZ(0)`;
      card.style.setProperty('--mx', (px * 100) + '%');
      card.style.setProperty('--my', (py * 100) + '%');
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'rotateY(0) rotateX(0)';
    });
  });
})();

/* ---- Scroll reveal ---- */
(function () {
  const els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach(en => {
      if (en.isIntersecting) {
        en.target.classList.add('visible');
        io.unobserve(en.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
  els.forEach(el => io.observe(el));
})();

/* ---- Hero parallax ---- */
(function () {
  const watch = document.querySelector('.hero-watch');
  const content = document.querySelector('.hero-content');
  if (!watch && !content) return;
  const isTouch = window.matchMedia('(hover: none)').matches;

  if (!isTouch) {
    document.addEventListener('mousemove', (e) => {
      const x = (e.clientX / window.innerWidth - 0.5);
      const y = (e.clientY / window.innerHeight - 0.5);
      if (watch) watch.style.transform = `translate(${x * 30}px, ${y * 30}px)`;
      if (content) content.style.transform = `translate(${x * -10}px, ${y * -8}px)`;
    });
  }

  // Scroll parallax
  window.addEventListener('scroll', () => {
    const sc = window.scrollY;
    if (watch && sc < window.innerHeight) watch.style.opacity = Math.max(0, 0.13 - sc / 2500);
  }, { passive: true });
})();

/* ---- Animated counters ---- */
(function () {
  const counters = document.querySelectorAll('[data-count]');
  if (!counters.length) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach(en => {
      if (!en.isIntersecting) return;
      const el = en.target;
      const target = parseInt(el.dataset.count, 10);
      const suffix = el.dataset.suffix || '';
      const dur = 1600;
      const start = performance.now();
      const tick = (now) => {
        const p = Math.min((now - start) / dur, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.floor(eased * target).toLocaleString() + suffix;
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
      io.unobserve(el);
    });
  }, { threshold: 0.5 });
  counters.forEach(c => io.observe(c));
})();

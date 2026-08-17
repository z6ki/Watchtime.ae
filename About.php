<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About — WatchTime.AH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo.png" type="image/png">
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- ===== ABOUT HERO ===== -->
<section class="hero" style="min-height:78vh;">
  <div class="hero-grain"></div>
  <div class="hero-content">
    <p class="eyebrow reveal">Est. A Legacy of Time</p>
    <h1 class="reveal reveal-delay-1" style="font-size:clamp(2.6rem,6vw,5rem);">A Story Built on <span class="accent">Precision</span><br>&amp; Passion</h1>
    <p class="lead reveal reveal-delay-2" style="max-width:620px;">Two generations. One devotion to craftsmanship. From the diamond houses of Bangkok to the world's finest timepieces — this is the story behind WatchTime.AH.</p>
    <div class="hero-actions reveal reveal-delay-3">
      <a href="watches.php" class="btn-lux btn-lux-filled"><span>Explore the Collection</span></a>
    </div>
  </div>
  <div class="hero-scroll reveal reveal-delay-4">
    <span>The Story</span>
    <div class="mouse"></div>
  </div>
</section>

<!-- ===== TIMELINE / JOURNEY ===== -->
<section class="lux-section">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Our Journey</p>
      <h2>From Bangkok to the Wrist</h2>
      <hr class="gold-line center">
      <p>A family legacy spanning decades — rooted in gemstones, refined through horology.</p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-4 reveal">
        <div class="value-card">
          <div class="vc-icon">&#9826;</div>
          <div class="text-gold mb-2" style="font-size:0.78rem;letter-spacing:0.25em;text-transform:uppercase;">The Beginning</div>
          <h4>Bangkok, Thailand</h4>
          <p>Our story begins with Jaffer Noohu, a diamond merchant in the heart of Bangkok — a man whose eye for precision and quality set the foundation for everything that followed.</p>
        </div>
      </div>
      <div class="col-md-4 reveal reveal-delay-1">
        <div class="value-card">
          <div class="vc-icon">&#8986;</div>
          <div class="text-gold mb-2" style="font-size:0.78rem;letter-spacing:0.25em;text-transform:uppercase;">The Craft</div>
          <h4>15 Years in Horology</h4>
          <p>Carrying forward that same dedication, Abdul Halid has spent over fifteen years in the watch business — building relationships with collectors, maisons, and enthusiasts across the globe.</p>
        </div>
      </div>
      <div class="col-md-4 reveal reveal-delay-2">
        <div class="value-card">
          <div class="vc-icon">&#10022;</div>
          <div class="text-gold mb-2" style="font-size:0.78rem;letter-spacing:0.25em;text-transform:uppercase;">Today</div>
          <h4>WatchTime.AH</h4>
          <p>That heritage now lives in every timepiece we curate — a platform where authenticity, trust, and a love for the craft come together for the next generation of collectors.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FOUNDER SECTION ===== -->
<section class="lux-section" style="background:var(--ink-2);padding:7rem 0;">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5 reveal">
        <!-- OWNER PICTURE — replace the src below with your photo -->
        <div class="founder-frame">
          <div class="founder-frame-inner">
            <img src="Assets/WatchTime.AH.jpg" alt="Abdul Halid — Founder" onerror="this.style.display='none'">
            <div class="founder-placeholder">
              <span>Your Photo Here</span>
              <small>Drop image into Assets/ &amp; update About.php</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 reveal reveal-delay-1">
        <p class="eyebrow">The Founder</p>
        <h2 class="mb-3" style="font-size:clamp(2rem,4vw,3rem);">Abdul Halid</h2>
        <div class="founder-role mb-4">Watch Merchant &middot; 15 Years of Expertise</div>
        <hr class="gold-line">
        <p class="founder-text">For the past fifteen years, Abdul Halid has dedicated himself to the world of fine timepieces. What began as an admiration cultivated in his father's shadow grew into a deep, hands-on expertise in the luxury watch trade.</p>
        <p class="founder-text">From sourcing rare references to authenticating grail pieces, his approach has always been guided by one principle: treat every watch — and every client — with the respect the craft deserves.</p>
        <p class="founder-text">WatchTime.AH is the culmination of that journey: a place where buyers, sellers, and collectors can meet with confidence, backed by genuine knowledge and a family name built on trust.</p>

        <div class="row g-3 mt-4">
          <div class="col-4">
            <div class="stat-block">
              <div class="stat-num"><span data-count="15">0</span><span class="text-gold">+</span></div>
              <div class="stat-label">Years Experience</div>
            </div>
          </div>
          <div class="col-4">
            <div class="stat-block">
              <div class="stat-num"><span data-count="100">0</span><span class="text-gold">%</span></div>
              <div class="stat-label">Authenticity</div>
            </div>
          </div>
          <div class="col-4">
            <div class="stat-block">
              <div class="stat-num"><span data-count="2">0</span></div>
              <div class="stat-label">Generations</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FATHER TRIBUTE SECTION ===== -->
<section class="lux-section tribute-section">
  <div class="tribute-overlay"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="row g-5 align-items-center">
      <div class="col-lg-7 reveal order-2 order-lg-1">
        <p class="eyebrow">In Loving Memory</p>
        <h2 class="mb-3" style="font-size:clamp(2rem,4vw,3rem);">Jaffer Noohu</h2>
        <div class="founder-role mb-2">May 4, 1954 &mdash; In Eternal Memory</div>
        <div class="founder-role mb-4">Diamond Merchant &middot; Bangkok, Thailand</div>
        <hr class="gold-line">
        <p class="founder-text">Born on the 4th of May, 1954, Jaffer Noohu built his name in the diamond trade of Bangkok, Thailand — a world where every carat told a story and precision was not a skill, but a way of life.</p>
        <p class="founder-text">He was more than a merchant; he was a guardian of quality, a man whose handshake carried the weight of his word. The values he lived by — integrity, patience, and an unwavering eye for excellence — became the cornerstone of our family's legacy.</p>
        <p class="founder-text">Though he has passed, his spirit endures in every timepiece we handle. The same standard he held for diamonds, we hold for watches: nothing less than exceptional.</p>
        <p class="tribute-sign">Forever remembered &mdash; the foundation on which WatchTime.AH stands.</p>
      </div>
      <div class="col-lg-5 reveal reveal-delay-1 order-1 order-lg-2">
        <!-- FATHER PICTURE — replace the src below with his photo -->
        <div class="founder-frame tribute-frame">
          <div class="founder-frame-inner">
            <img src="Assets/WatchTime.AH.jpg" alt="Jaffer Noohu — In Loving Memory" onerror="this.style.display='none'">
            <div class="founder-placeholder">
              <span>His Photo Here</span>
              <small>Drop image into Assets/ &amp; update About.php</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== VALUES ===== -->
<section class="lux-section" style="background:var(--ink-2);">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">What We Stand For</p>
      <h2>Our Values</h2>
      <hr class="gold-line center">
    </div>
    <div class="row g-4">
      <div class="col-md-4 reveal">
        <div class="value-card">
          <div class="vc-icon">&#10022;</div>
          <h4>Authenticity</h4>
          <p>Every piece is verified — no compromises, no shortcuts. The same standard a diamond merchant would demand.</p>
        </div>
      </div>
      <div class="col-md-4 reveal reveal-delay-1">
        <div class="value-card">
          <div class="vc-icon">&#9825;</div>
          <h4>Heritage</h4>
          <p>Two generations of trust. We honour the legacy we carry by treating every watch and client with genuine care.</p>
        </div>
      </div>
      <div class="col-md-4 reveal reveal-delay-2">
        <div class="value-card">
          <div class="vc-icon">&#9851;</div>
          <h4>Accessibility</h4>
          <p>Luxury should be within reach. We connect collectors of every level with timepieces that tell their story.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="lux-section text-center">
  <div class="container reveal">
    <p class="eyebrow">Continue the Journey</p>
    <h2 class="mb-3">Discover a Timepiece Worth Passing On</h2>
    <hr class="gold-line center">
    <div class="hero-actions">
      <a href="watches.php" class="btn-lux btn-lux-filled"><span>Browse the Collection</span></a>
      <a href="sell.php" class="btn-lux"><span>Sell Your Watch</span></a>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<style>
/* ===== About page custom styles ===== */
.founder-role {
  font-family: var(--font-sans);
  font-size: 0.85rem;
  font-weight: 400;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--gold);
}
.founder-text {
  font-size: 1.05rem;
  line-height: 1.85;
  color: var(--cream-dim);
  margin-bottom: 1.2rem;
  font-weight: 300;
}

/* Founder image frame — gold border, glow, portrait crop */
.founder-frame {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 1px solid rgba(197,162,83,0.25);
  box-shadow: var(--shadow-float), 0 0 50px rgba(197,162,83,0.1);
  transition: transform 0.5s ease, box-shadow 0.5s ease;
  background: var(--ink-3);
}
.founder-frame:hover {
  transform: translateY(-6px);
  box-shadow: var(--shadow-float), 0 0 70px rgba(197,162,83,0.2);
}
.founder-frame-inner {
  position: relative;
  aspect-ratio: 4 / 5;
  overflow: hidden;
  background: radial-gradient(ellipse at 50% 30%, #1f1a14, var(--ink-3));
}
.founder-frame-inner img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
/* Placeholder shown when no real image is set */
.founder-placeholder {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 1.5rem;
  gap: 0.4rem;
  pointer-events: none;
}
.founder-frame-inner img:not([style*="display:none"]) ~ .founder-placeholder,
.founder-frame-inner img[src]:not([onerror*="this.style.display='none'"]) ~ .founder-placeholder {
  display: none;
}
.founder-placeholder span {
  font-family: var(--font-serif);
  font-size: 1.3rem;
  color: var(--gold);
  font-style: italic;
}
.founder-placeholder small {
  font-size: 0.72rem;
  color: var(--text-dim);
  letter-spacing: 0.05em;
}
/* Gold corner accents on the frame */
.founder-frame::before,
.founder-frame::after {
  content: '';
  position: absolute;
  width: 32px; height: 32px;
  border: 2px solid var(--gold);
  pointer-events: none;
  z-index: 3;
}
.founder-frame::before { top: 12px; left: 12px; border-right: none; border-bottom: none; }
.founder-frame::after  { bottom: 12px; right: 12px; border-left: none; border-top: none; }

/* Tribute section — deeper, more reverent */
.tribute-section {
  position: relative;
  background: linear-gradient(180deg, var(--ink) 0%, #0d0b08 50%, var(--ink) 100%);
  padding: 7rem 0;
  overflow: hidden;
}
.tribute-overlay {
  position: absolute; inset: 0;
  background: radial-gradient(ellipse at 50% 50%, rgba(197,162,83,0.06) 0%, transparent 60%);
  pointer-events: none;
}
.tribute-frame { border-color: rgba(197,162,83,0.4); }
.tribute-frame::before, .tribute-frame::after { border-color: var(--gold-light); }
.tribute-sign {
  font-family: var(--font-serif);
  font-style: italic;
  font-size: 1.15rem;
  color: var(--gold);
  margin-top: 1.5rem;
  letter-spacing: 0.02em;
}

@media (max-width: 768px) {
  .founder-frame-inner { aspect-ratio: 1 / 1.15; }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="premium.js"></script>
</body>
</html>

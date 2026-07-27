<?php
session_start();
include 'db_connect.php';

// Fetch featured watches (latest 8)
$featured = [];
$featQuery = "SELECT id, brand, model, `condition`, image, case_material, mm FROM watches ORDER BY id DESC LIMIT 8";
$featRes = $conn->query($featQuery);
if ($featRes) {
  while ($row = $featRes->fetch_assoc()) $featured[] = $row;
}

// Stats
$stats = ['watches' => 0, 'brands' => 0];
$cw = $conn->query("SELECT COUNT(*) AS c FROM watches");
if ($cw) $stats['watches'] = (int)$cw->fetch_assoc()['c'];
$cb = $conn->query("SELECT COUNT(DISTINCT brand) AS c FROM watches");
if ($cb) $stats['brands'] = (int)$cb->fetch_assoc()['c'];

// Pick a hero watch image
$heroImg = 'images/rolex-oyster-perpetual-submariner-date-m126610ln-0001-800x1304.jpg-6c39a630-544a-4afc-90a1-a18d1de67809.png';
if (!empty($featured)) {
  $heroImg = 'images/' . rawurlencode($featured[0]['image']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WatchTime.AH — Luxury Timepieces</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo.png" type="image/png">
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- ===== HERO ===== -->
<section class="hero">
  <div class="hero-grain"></div>
  <div class="hero-watch"><img src="<?= htmlspecialchars($heroImg) ?>" alt="Featured luxury watch"></div>
  <div class="hero-content">
    <p class="eyebrow reveal">Buy · Sell · Collect</p>
    <h1 class="reveal reveal-delay-1">Timeless <span class="accent">Elegance</span><br>on Your Wrist</h1>
    <p class="lead reveal reveal-delay-2">Discover an curated collection of authentic luxury and pre-owned timepieces from the world's most prestigious maisons.</p>
    <div class="hero-actions reveal reveal-delay-3">
      <a href="watches.php" class="btn-lux btn-lux-filled"><span>Browse Collection</span></a>
      <a href="sell.php" class="btn-lux"><span>Sell Your Watch</span></a>
    </div>
  </div>
  <div class="hero-scroll reveal reveal-delay-4">
    <span>Scroll</span>
    <div class="mouse"></div>
  </div>
</section>

<!-- ===== BRAND BELT ===== -->
<div class="brand-belt-section">
  <div class="brand-belt">
    <img src="Assets/Brands/Rolex_resized.png" alt="Rolex">
    <img src="Assets/Brands/Omega_logo_resized.png" alt="Omega">
    <img src="Assets/Brands/Cartier_Logo_resized.png" alt="Cartier">
    <img src="Assets/Brands/Patek_Philippe_resized.png" alt="Patek Philippe">
    <img src="Assets/Brands/jaeger_lecoultre_logo_resized.png" alt="Jaeger-LeCoultre">
    <img src="Assets/Brands/audemars_piguet_resized.png" alt="Audemars Piguet">
    <img src="Assets/Brands/Rolex_resized.png" alt="Rolex">
    <img src="Assets/Brands/Omega_logo_resized.png" alt="Omega">
    <img src="Assets/Brands/Cartier_Logo_resized.png" alt="Cartier">
    <img src="Assets/Brands/Patek_Philippe_resized.png" alt="Patek Philippe">
    <img src="Assets/Brands/jaeger_lecoultre_logo_resized.png" alt="Jaeger-LeCoultre">
    <img src="Assets/Brands/audemars_piguet_resized.png" alt="Audemars Piguet">
  </div>
</div>

<!-- ===== STATS ===== -->
<section class="lux-section tight">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-6 col-md-3 reveal">
        <div class="stat-block">
          <div class="stat-num"><span data-count="<?= $stats['watches'] ?>">0</span></div>
          <div class="stat-label">Timepieces</div>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal reveal-delay-1">
        <div class="stat-block">
          <div class="stat-num"><span data-count="<?= $stats['brands'] ?>">0</span></div>
          <div class="stat-label">Maisons</div>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal reveal-delay-2">
        <div class="stat-block">
          <div class="stat-num"><span data-count="100" suffix="%">0%</span></div>
          <div class="stat-label">Authentic</div>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal reveal-delay-3">
        <div class="stat-block">
          <div class="stat-num"><span data-count="15" suffix="+">0</span></div>
          <div class="stat-label">Years Trusted</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FEATURED WATCHES ===== -->
<section class="lux-section" style="padding-top:2rem;">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Curated Selection</p>
      <h2>Featured Timepieces</h2>
      <hr class="gold-line center">
      <p>A glimpse of our latest arrivals — each piece authenticated and ready for its next chapter.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($featured as $w): ?>
        <div class="col-6 col-md-4 col-lg-3 reveal">
          <div class="watch-card-wrap">
            <a href="watch-details.php?id=<?= $w['id'] ?>" style="text-decoration:none;color:inherit;">
              <div class="watch-card">
                <div class="card-glow"></div>
                <?php if (!empty($w['condition'])): ?>
                  <span class="cond-badge"><?= htmlspecialchars(trim($w['condition'])) ?></span>
                <?php endif; ?>
                <div class="card-media">
                  <img src="images/<?= rawurlencode($w['image']) ?>" alt="<?= htmlspecialchars($w['brand'].' '.$w['model']) ?>" loading="lazy">
                </div>
                <div class="card-body">
                  <div class="card-brand"><?= htmlspecialchars($w['brand']) ?></div>
                  <div class="card-title"><?= htmlspecialchars($w['model']) ?></div>
                  <div class="card-specs">
                    <?php if (!empty($w['mm']) && $w['mm'] != 'N/A'): ?><span><?= htmlspecialchars($w['mm']) ?>mm</span><?php endif; ?>
                    <?php if (!empty($w['case_material']) && $w['case_material'] != 'N/A'): ?><span><?= htmlspecialchars($w['case_material']) ?></span><?php endif; ?>
                  </div>
                  <div class="card-footer-row">
                    <span class="btn-ghost">View Details</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-5 reveal">
      <a href="watches.php" class="btn-lux"><span>View Full Collection</span></a>
    </div>
  </div>
</section>

<!-- ===== VALUE PROPS ===== -->
<section class="lux-section" style="background:var(--ink-2);">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">Why WatchTime.AH</p>
      <h2>A New Standard in Pre-Owned Luxury</h2>
      <hr class="gold-line center">
    </div>
    <div class="row g-4">
      <div class="col-md-4 reveal">
        <div class="value-card">
          <div class="vc-icon">&#10022;</div>
          <h4>100% Authentic</h4>
          <p>Every timepiece is verified by our certified watchmakers before it reaches our collection.</p>
        </div>
      </div>
      <div class="col-md-4 reveal reveal-delay-1">
        <div class="value-card">
          <div class="vc-icon">&#9851;</div>
          <h4>Seamless Selling</h4>
          <p>Submit your watch in minutes. Our team handles valuation, authentication, and the buyer.</p>
        </div>
      </div>
      <div class="col-md-4 reveal reveal-delay-2">
        <div class="value-card">
          <div class="vc-icon">&#9825;</div>
          <h4>Personal Wishlist</h4>
          <p>Save the pieces that speak to you and revisit them anytime, on any device.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="lux-section text-center">
  <div class="container reveal">
    <p class="eyebrow">Begin Your Journey</p>
    <h2 class="mb-3">Find the Watch That Tells Your Story</h2>
    <hr class="gold-line center">
    <p class="mb-4" style="max-width:520px;margin:0 auto 2rem;">Whether you're searching for a grail piece or parting with one, we make the experience effortless.</p>
    <div class="hero-actions">
      <a href="watches.php" class="btn-lux btn-lux-filled"><span>Explore Watches</span></a>
      <a href="sell.php" class="btn-lux"><span>List Your Watch</span></a>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="premium.js"></script>
</body>
</html>

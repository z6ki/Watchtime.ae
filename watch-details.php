<?php
session_start();
include 'db_connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$watch = null;
$related = [];

if ($id > 0) {
  $stmt = $conn->prepare("SELECT id, brand, model, `condition`, image, case_material, mm FROM watches WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res) $watch = $res->fetch_assoc();
  $stmt->close();
}

if (!$watch) {
  // Fallback: first watch
  $r = $conn->query("SELECT id, brand, model, `condition`, image, case_material, mm FROM watches ORDER BY id DESC LIMIT 1");
  if ($r) $watch = $r->fetch_assoc();
}

// Related (same brand, excluding current)
if ($watch) {
  $stmt2 = $conn->prepare("SELECT id, brand, model, `condition`, image, case_material, mm FROM watches WHERE brand = ? AND id != ? ORDER BY id DESC LIMIT 4");
  $stmt2->bind_param("si", $watch['brand'], $watch['id']);
  $stmt2->execute();
  $res2 = $stmt2->get_result();
  if ($res2) { while ($row = $res2->fetch_assoc()) $related[] = $row; }
  $stmt2->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $watch ? htmlspecialchars($watch['brand'].' '.$watch['model']) : 'Watch Details' ?> — WatchTime.AH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo.png" type="image/png">
</head>
<body>

<?php include 'navbar.php'; ?>

<?php if ($watch): ?>

<!-- Details hero -->
<section class="details-hero">
  <div class="container">
    <div class="row g-5 align-items-center">
      <!-- Image stage -->
      <div class="col-lg-7 reveal">
        <div class="details-stage">
          <img src="images/<?= rawurlencode($watch['image']) ?>" alt="<?= htmlspecialchars($watch['brand'].' '.$watch['model']) ?>">
        </div>
      </div>

      <!-- Info -->
      <div class="col-lg-5 reveal reveal-delay-1">
        <div class="details-info">
          <p class="eyebrow"><?= htmlspecialchars($watch['brand']) ?></p>
          <h1><?= htmlspecialchars($watch['model']) ?></h1>
          <hr class="gold-line">

          <div class="spec-grid">
            <div class="spec-item">
              <div class="spec-label">Condition</div>
              <div class="spec-value"><?= htmlspecialchars(trim($watch['condition'] ?: 'Excellent')) ?></div>
            </div>
            <div class="spec-item">
              <div class="spec-label">Case Size</div>
              <div class="spec-value"><?= ($watch['mm'] && $watch['mm'] != 'N/A') ? htmlspecialchars($watch['mm']).'mm' : 'N/A' ?></div>
            </div>
            <div class="spec-item">
              <div class="spec-label">Case Material</div>
              <div class="spec-value"><?= ($watch['case_material'] && $watch['case_material'] != 'N/A') ? htmlspecialchars($watch['case_material']) : 'Stainless Steel' ?></div>
            </div>
            <div class="spec-item">
              <div class="spec-label">Authenticity</div>
              <div class="spec-value text-gold">Verified</div>
            </div>
          </div>

          <div class="details-sticky">
            <p style="font-size:0.88rem;margin-bottom:1.2rem;">Interested in this timepiece? Reach out to our team for pricing and availability.</p>
            <div class="d-flex gap-2 flex-wrap">
              <a href="https://wa.me/?text=<?= urlencode('I\'m interested in the '.$watch['brand'].' '.$watch['model']) ?>" target="_blank" class="btn-lux btn-lux-filled"><span>Enquire Now</span></a>
              <button class="btn-lux" onclick="saveWishlist(<?= (int)$watch['id'] ?>)"><span>&#9825; Save</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Related -->
<?php if (!empty($related)): ?>
<section class="lux-section" style="background:var(--ink-2);">
  <div class="container">
    <div class="section-head reveal">
      <p class="eyebrow">More from <?= htmlspecialchars($watch['brand']) ?></p>
      <h2>You May Also Like</h2>
      <hr class="gold-line center">
    </div>
    <div class="row g-4">
      <?php foreach ($related as $w): ?>
        <div class="col-6 col-md-3 reveal">
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
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php else: ?>
<section class="lux-section text-center">
  <div class="container">
    <div class="empty-state">
      <div class="es-icon">&#8986;</div>
      <h2>Watch not found</h2>
      <p class="mb-4">This timepiece may have been sold or removed.</p>
      <a href="watches.php" class="btn-lux"><span>Browse Collection</span></a>
    </div>
  </div>
</section>
<?php endif; ?>

<?php include 'footer.php'; ?>

<script>
function saveWishlist(id) {
  const watch = <?= json_encode($watch) ?>;
  let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
  if (!wishlist.some(w => w.id == id)) {
    wishlist.push(watch);
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
  }
  alert('Added to your wishlist');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="premium.js"></script>
</body>
</html>

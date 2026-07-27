<?php
session_start();
include 'db_connect.php';

$query = "SELECT id, brand, model, `condition`, image, case_material, mm FROM watches ORDER BY id DESC";
$result = $conn->query($query);
$watches = [];
if ($result) {
  while ($row = $result->fetch_assoc()) $watches[] = $row;
}
$watches = $watches ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Browse Watches — WatchTime.AH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo.png" type="image/png">
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- Page header -->
<section class="lux-section tight" style="padding-bottom:1.5rem;">
  <div class="container text-center reveal">
    <p class="eyebrow">The Collection</p>
    <h2>Browse Timepieces</h2>
    <hr class="gold-line center">
    <p>Filter by brand, condition, or keyword to find the piece that's right for you.</p>
  </div>
</section>

<div class="container pb-5">
  <!-- Filters -->
  <div class="filter-bar reveal">
    <div class="row g-3 align-items-center">
      <div class="col-md-4">
        <input id="searchText" type="text" placeholder="Search by brand or model..." class="form-control">
      </div>
      <div class="col-md-3">
        <input id="filterBrand" type="text" placeholder="Brand" class="form-control">
      </div>
      <div class="col-md-3">
        <select id="filterCondition" class="form-select">
          <option value="">Any Condition</option>
          <option>Excellent</option>
          <option>Excelent</option>
          <option>Good</option>
          <option>Used</option>
          <option>Discontinued</option>
        </select>
      </div>
      <div class="col-md-2">
        <span id="resultCount" class="text-dim" style="font-size:0.8rem;"></span>
      </div>
    </div>
  </div>

  <!-- Grid -->
  <div id="watchList" class="row g-4"></div>

  <div id="emptyState" class="empty-state d-none">
    <div class="es-icon">&#8986;</div>
    <h4>No watches found</h4>
    <p>Try adjusting your filters.</p>
  </div>
</div>

<script>
const watches = <?= json_encode($watches) ?>;

function renderWatches(data) {
  const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
  const container = document.getElementById("watchList");
  const empty = document.getElementById("emptyState");
  const countEl = document.getElementById("resultCount");
  container.innerHTML = "";

  countEl.textContent = data.length + " piece" + (data.length === 1 ? "" : "s");

  if (data.length === 0) {
    empty.classList.remove("d-none");
    return;
  }
  empty.classList.add("d-none");

  data.forEach((watch, i) => {
    const isSaved = wishlist.some(w => w.id == watch.id);
    const img = watch.image ? 'images/' + encodeURIComponent(watch.image) : '';
    const mm = (watch.mm && watch.mm != 'N/A') ? watch.mm + 'mm' : '';
    const mat = (watch.case_material && watch.case_material != 'N/A') ? watch.case_material : '';
    const specs = [mm, mat].filter(Boolean).join(' &middot; ');

    const col = document.createElement("div");
    col.className = "col-6 col-md-4 col-lg-3 reveal";
    col.style.transitionDelay = (i % 8 * 0.05) + 's';
    col.innerHTML = `
      <div class="watch-card-wrap">
        <div class="watch-card">
          <div class="card-glow"></div>
          <div class="wish-btn ${isSaved ? 'saved' : ''}" onclick="toggleWishlist(${watch.id}, event)" title="Save to wishlist">
            ${isSaved ? '&#10084;' : '&#9825;'}
          </div>
          ${watch.condition ? `<span class="cond-badge">${watch.condition.trim()}</span>` : ''}
          <a href="watch-details.php?id=${watch.id}" style="display:block;text-decoration:none;color:inherit;">
            <div class="card-media">
              ${img ? `<img src="${img}" alt="${watch.brand} ${watch.model}" loading="lazy">` : ''}
            </div>
            <div class="card-body">
              <div class="card-brand">${watch.brand || ''}</div>
              <div class="card-title">${watch.model || ''}</div>
              <div class="card-specs">${specs}</div>
              <div class="card-footer-row">
                <span class="btn-ghost">View Details</span>
              </div>
            </div>
          </a>
        </div>
      </div>
    `;
    container.appendChild(col);
  });

  // Re-run reveal + tilt for new cards
  initReveals();
  initTilt();
}

function applyFilters() {
  const brand = document.getElementById("filterBrand").value.toLowerCase();
  const condition = document.getElementById("filterCondition").value;
  const keyword = document.getElementById("searchText").value.toLowerCase();

  const filtered = watches.filter(w =>
    (brand === "" || (w.brand && w.brand.toLowerCase().includes(brand))) &&
    (condition === "" || (w.condition && w.condition.trim() === condition)) &&
    (keyword === "" || (`${w.brand || ''} ${w.model || ''}`).toLowerCase().includes(keyword))
  );
  renderWatches(filtered);
}

function toggleWishlist(watchId, e) {
  if (e) e.preventDefault();
  const watch = watches.find(w => w.id == watchId);
  let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
  const index = wishlist.findIndex(w => w.id == watchId);
  if (index >= 0) wishlist.splice(index, 1);
  else wishlist.push(watch);
  localStorage.setItem("wishlist", JSON.stringify(wishlist));
  applyFilters();
}

document.getElementById("filterBrand").addEventListener("input", applyFilters);
document.getElementById("filterCondition").addEventListener("input", applyFilters);
document.getElementById("searchText").addEventListener("input", applyFilters);

// Helpers re-exposed for dynamic content
function initReveals() {
  const els = document.querySelectorAll('.reveal:not(.visible)');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(en => {
      if (en.isIntersecting) { en.target.classList.add('visible'); io.unobserve(en.target); }
    });
  }, { threshold: 0.1 });
  els.forEach(el => io.observe(el));
}
function initTilt() {
  if (window.matchMedia('(hover: none)').matches) return;
  document.querySelectorAll('.watch-card:not([data-tilt])').forEach(card => {
    card.setAttribute('data-tilt', '1');
    card.addEventListener('mousemove', (e) => {
      const r = card.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width;
      const py = (e.clientY - r.top) / r.height;
      card.style.transform = `rotateY(${(px-0.5)*14}deg) rotateX(${(0.5-py)*12}deg)`;
      card.style.setProperty('--mx', (px*100)+'%');
      card.style.setProperty('--my', (py*100)+'%');
    });
    card.addEventListener('mouseleave', () => { card.style.transform = 'rotateY(0) rotateX(0)'; });
  });
}

renderWatches(watches);
</script>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="premium.js"></script>
</body>
</html>

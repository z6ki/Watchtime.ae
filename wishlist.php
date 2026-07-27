<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Wishlist — WatchTime.AH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo.png" type="image/png">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="lux-section tight" style="padding-bottom:1.5rem;">
  <div class="container text-center reveal">
    <p class="eyebrow">Saved For Later</p>
    <h2>Your Wishlist</h2>
    <hr class="gold-line center">
    <p>The timepieces you've fallen for, all in one place.</p>
  </div>
</section>

<div class="container pb-5">
  <div id="wishlistContainer" class="row g-4"></div>
  <div id="emptyMessage" class="empty-state d-none">
    <div class="es-icon">&#9825;</div>
    <h4>Your wishlist is empty</h4>
    <p class="mb-4">Start saving the pieces that catch your eye.</p>
    <a href="watches.php" class="btn-lux btn-lux-filled"><span>Browse Watches</span></a>
  </div>
</div>

<script>
const wishlistContainer = document.getElementById("wishlistContainer");
const emptyMessage = document.getElementById("emptyMessage");
let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

function renderWishlist() {
  wishlistContainer.innerHTML = "";
  if (wishlist.length === 0) {
    emptyMessage.classList.remove("d-none");
    return;
  }
  emptyMessage.classList.add("d-none");

  wishlist.forEach((watch, i) => {
    const img = watch.image ? 'images/' + encodeURIComponent(watch.image) : '';
    const mm = (watch.mm && watch.mm != 'N/A') ? watch.mm + 'mm' : '';

    const col = document.createElement("div");
    col.className = "col-6 col-md-4 col-lg-3 reveal";
    col.style.transitionDelay = (i % 8 * 0.05) + 's';
    col.innerHTML = `
      <div class="watch-card-wrap">
        <div class="watch-card">
          <div class="card-glow"></div>
          <div class="wish-btn saved" onclick="removeFromWishlist(${watch.id})" title="Remove from wishlist">&#10084;</div>
          ${watch.condition ? `<span class="cond-badge">${watch.condition.trim()}</span>` : ''}
          <a href="watch-details.php?id=${watch.id}" style="display:block;text-decoration:none;color:inherit;">
            <div class="card-media">
              ${img ? `<img src="${img}" alt="${watch.brand || ''} ${watch.model || ''}" loading="lazy">` : ''}
            </div>
            <div class="card-body">
              <div class="card-brand">${watch.brand || ''}</div>
              <div class="card-title">${watch.model || ''}</div>
              ${mm ? `<div class="card-specs"><span>${mm}</span></div>` : ''}
              <div class="card-footer-row">
                <span class="btn-ghost">View Details</span>
              </div>
            </div>
          </a>
        </div>
      </div>
    `;
    wishlistContainer.appendChild(col);
  });

  initReveals();
  initTilt();
}

function removeFromWishlist(id) {
  wishlist = wishlist.filter(w => w.id != id);
  localStorage.setItem("wishlist", JSON.stringify(wishlist));
  renderWishlist();
}

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

renderWishlist();
</script>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="premium.js"></script>
</body>
</html>

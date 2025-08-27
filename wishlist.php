<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Wishlist</title>

  <!-- ✅ Bootstrap CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

<!-- 💖 Wishlist Section -->
<div class="container py-5">
  <h2 class="mb-4 text-center">Your Wishlist 💖</h2>
  <div id="wishlistContainer" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
    <!-- Cards will appear here -->
  </div>
  <div id="emptyMessage" class="text-center text-muted mt-4 d-none">
    No watches saved yet.
  </div>
</div>

<!-- 💡 Wishlist JS -->
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

    wishlist.forEach(watch => {
      const col = document.createElement("div");
      col.className = "col";
      col.innerHTML = `
        <div class="card h-100 shadow-sm position-relative">
          <button class="btn-close position-absolute top-0 end-0 m-2" aria-label="Remove" onclick="removeFromWishlist(${watch.id})"></button>
          <img src="${watch.image}" class="card-img-top" alt="${watch.brand} ${watch.model}">
          <div class="card-body">
            <h5 class="card-title">${watch.brand} ${watch.model}</h5>
            <p class="card-text">Condition: ${watch.condition}</p>
            <p class="text-success fw-bold">$${watch.price.toLocaleString()}</p>
            <a href="watch-details.php" class="btn btn-outline-primary w-100">View Details</a>
          </div>
        </div>
      `;
      wishlistContainer.appendChild(col);
    });
  }

  function removeFromWishlist(id) {
    wishlist = wishlist.filter(w => w.id !== id);
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
    renderWishlist();
  }

  renderWishlist();
</script>

<!-- Include Footer -->
<div id="footer"></div>
<script>
  fetch("footer.php")
    .then(res => res.text())
    .then(data => document.getElementById("footer").innerHTML = data);
</script>

</body>
</html>

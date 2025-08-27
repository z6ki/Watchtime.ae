<?php
session_start();
include 'db_connect.php';

// Fetch watches from DB
$query = "SELECT id, brand, model, `condition`, image, case_material, mm FROM watches ORDER BY id DESC";
$result = $conn->query($query);
$watches = [];

if ($result === false) {
    // Show useful error and stop script during development
    die("Database Query Failed: " . $conn->error . "<br>Query: " . htmlspecialchars($query));
}

while ($row = $result->fetch_assoc()) {
    $watches[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Browse Watches</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container py-5">
  <h2 class="mb-4">Available Watches</h2>
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <input id="filterBrand" type="text" placeholder="Brand" class="form-control">
    </div>
    <div class="col-md-3">
      <select id="filterCondition" class="form-select">
        <option value="">Any Condition</option>
        <option>New</option>
        <option>Excellent</option>
        <option>Very Good</option>
        <option>Used</option>
      </select>
    </div>
    <div class="col-md-3">
      <input id="searchText" type="text" placeholder="Search by model or keyword..." class="form-control">
    </div>
  </div>

  <div id="watchList" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4"></div>
</div>

<script>
  const watches = <?= json_encode($watches); ?>;

  function renderWatches(data) {
    const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const container = document.getElementById("watchList");
    container.innerHTML = "";

    data.forEach(watch => {
      const isSaved = wishlist.some(w => w.id == watch.id);
      const heart = isSaved ? "❤️" : "🤍";

      const card = document.createElement("div");
      card.className = "col";
      card.innerHTML = `
        <div class="card h-100 shadow-sm position-relative">
          <button class="btn position-absolute top-0 end-0 m-2" onclick="toggleWishlist(${watch.id})" title="Toggle Wishlist">${heart}</button>
          <img src="images/${watch.image}" class="card-img-top" alt="${watch.brand} ${watch.model}">
          <div class="card-body">
            <h5 class="card-title">${watch.brand} ${watch.model}</h5>
            <p class="card-text">Condition: ${watch.condition}</p>
            <p class="card-text">Material: ${watch.case_material || 'N/A'}</p>
            <p class="card-text">Size: ${watch.mm || 'N/A'} mm</p>
            <a href="watch-details.php?id=${watch.id}" class="btn btn-outline-primary w-100">View Details</a>
          </div>
        </div>
      `;
      container.appendChild(card);
    });
  }

  function applyFilters() {
    const brand = document.getElementById("filterBrand").value.toLowerCase();
    const condition = document.getElementById("filterCondition").value;
    const keyword = document.getElementById("searchText").value.toLowerCase();

    const filtered = watches.filter(watch => 
      (brand === "" || (watch.brand && watch.brand.toLowerCase().includes(brand))) &&
      (condition === "" || watch.condition === condition) &&
      (keyword === "" || (`${watch.brand || ''} ${watch.model || ''}`.toLowerCase().includes(keyword)))
    );

    renderWatches(filtered);
  }

  function toggleWishlist(watchId) {
    const watch = watches.find(w => w.id == watchId);
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const index = wishlist.findIndex(w => w.id == watchId);

    if (index >= 0) {
      wishlist.splice(index, 1);
    } else {
      wishlist.push(watch);
    }

    localStorage.setItem("wishlist", JSON.stringify(wishlist));
    applyFilters();
  }

  // Event listeners
  ["filterBrand", "filterCondition", "searchText"].forEach(id =>
    document.getElementById(id).addEventListener("input", applyFilters)
  );

  renderWatches(watches);
</script>

<!-- Footer -->
<div id="footer"></div>
<script>
  fetch("footer.php")
    .then(res => res.text())
    .then(data => document.getElementById("footer").innerHTML = data);
</script>

</body>
</html>

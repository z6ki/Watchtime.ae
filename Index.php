<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Watch Store</title>

  <!-- ✅ Bootstrap CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

  <!-- Optional inline style for compact spacing -->
  <style>
    .brand-bar-container {
      overflow: hidden;
      background-color:rgb(182, 182, 182);
      border-top: 1px solid #333;
      border-bottom: 1px solid #333;
      padding: 10px 0;
      margin-top: 40px;
    }

    .brand-belt-wrapper {
      width: 100%;
      overflow: hidden;
    }

    .brand-belt {
      display: flex;
      animation: scrollBelt 40s linear infinite;
      gap: 60px;
      align-items: center;
    }

    .brand-belt img {
      height: 80px;
      object-fit: contain;
      opacity: 0.9;
      transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .brand-belt img:hover {
      transform: scale(1.05);
      opacity: 1;
    }

    @keyframes scrollBelt {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
  </style>
</nav>

<!-- 🎯 Hero Section -->
<section class="bg-dark text-white text-center py-5">
  <div class="container">
    <h1 class="display-4 fw-bold mb-3">Buy & Sell Premium Watches</h1>
    <p class="lead mb-4">Luxury, Pre-Owned, and Rare Timepieces</p>
    <a href="watches.php" class="btn btn-light btn-lg">Browse Watches</a>
  </div>
</section>
<!-- 🚚 Conveyor Belt Brand Bar -->
<div class="brand-bar-container">
  <div class="brand-belt">
    <img src="Assets/Brands/Rolex_resized.png" alt="Rolex">
    <img src="Assets/Brands/Omega_logo_resized.png" alt="Omega">
    <img src="Assets/Brands/Cartier_Logo_resized.png" alt="Cartier">
    <img src="Assets/Brands/Patek_Philippe_resized.png" alt="Patek Philippe">
    <img src="Assets/Brands/jaeger_lecoultre_logo_resized.png" alt="Jaeger-LeCoultre">
    <img src="Assets/Brands/audemars_piguet_resized.png" alt="Audemars Piguet">

    <!-- Duplicate for smooth infinite scroll -->
    <img src="Assets/Brands/Rolex_resized.png" alt="Rolex">
    <img src="Assets/Brands/Omega_logo_resized.png" alt="Omega">
    <img src="Assets/Brands/Cartier_Logo_resized.png" alt="Cartier">
    <img src="Assets/Brands/Patek_Philippe_resized.png" alt="Patek Philippe">
    <img src="Assets/Brands/jaeger_lecoultre_logo_resized.png" alt="Jaeger-LeCoultre">
    <img src="Assets/Brands/audemars_piguet_resized.png" alt="Audemars Piguet">
  </div>
</div>

<!-- Inject Footer -->
<div id="footer"></div>
<script>
  fetch("footer.php")
    .then(res => res.text())
    .then(data => document.getElementById("footer").innerHTML = data);
</script>

</body>
</html>

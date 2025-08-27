<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Watch Details</title>

  <!-- ✅ Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

  <!-- 🕵️ Watch Details Section -->
  <div class="container py-5">
    <div class="row g-4 align-items-center">
      <!-- Watch Image -->
      <div class="col-lg-6">
        <img src="https://via.placeholder.com/600x400?text=Watch+Image" class="img-fluid rounded shadow-sm" alt="Watch Image">
      </div>

      <!-- Watch Info -->
      <div class="col-lg-6">
        <h2 class="fw-bold mb-3">Rolex Submariner</h2>
        <p class="text-muted">Condition: <strong>Excellent</strong></p>
        <p class="h4 text-success mb-4">$10,000</p>
        <p>
          The Rolex Submariner is one of the most iconic dive watches ever made.
          Known for its durability, classic design, and prestige — it remains a favorite among collectors worldwide.
        </p>
        <!-- WhatsApp Contact -->
        <a href="https://wa.me/YOURNUMBER?text=I'm%20interested%20in%20the%20Rolex%20Submariner" target="_blank" class="btn btn-success btn-lg mt-3">
          Contact Seller on WhatsApp
        </a>
      </div>
    </div>
  </div>
  <!-- Include Footer -->
  <div id="footer"></div>
  <script>
  fetch("footer.php")
      .then(res => res.text())
      .then(data => document.getElementById("footer").innerHTML = data);
  </script>
</body>
</html>

<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Watch Store</title>

  <!-- ✅ Bootstrap CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

  <!-- 📄 About Content -->
  <div class="container py-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold">About Watch Store</h1>
      <p class="text-muted">Your trusted destination for buying and selling luxury watches.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <p>
          At Watch Store, we believe that time is more than just numbers on a dial — it’s about style, history, and the stories our watches tell.
        </p>
        <p>
          Whether you're a collector, enthusiast, or first-time buyer, we provide a platform that connects people with authentic, high-quality watches. 
          Our curated listings feature a range of luxury and enthusiast brands — from Rolex to Seiko — making premium timepieces more accessible than ever.
        </p>
        <p>
          Each listing is reviewed manually to ensure quality, and our platform is built with a strong focus on trust, transparency, and customer support.
        </p>
      </div>
    </div>

    <!-- Optional Team/Founder Section -->
    <div class="row mt-5 justify-content-center">
      <div class="col-md-6 text-center">
        <img src="https://via.placeholder.com/150" class="rounded-circle shadow-sm mb-3" alt="Founder">
        <h5 class="fw-bold">Your Name</h5>
        <p class="text-muted">Founder & Watch Enthusiast</p>
        <p>“This site was built with love for horology and a mission to connect buyers and sellers who share the same passion.”</p>
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

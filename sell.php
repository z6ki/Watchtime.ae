<?php
session_start();
include 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "sell_uploads/";
        $filename = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . time() . "_" . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $image = $targetFilePath;
        } else {
            $message = "<div class='alert alert-danger text-center'>Image upload failed.</div>";
        }
    }

    $stmt = $conn->prepare("INSERT INTO sell_requests (brand, model, `condition`, expected_price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $brand, $model, $condition, $price, $image);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success text-center'>Watch submitted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Something went wrong. Please try again.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell Your Watch</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background: radial-gradient(circle, #121212, #000);
      color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-section {
      position: relative;
      z-index: 1;
    }

    .gear-layer {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
    }

    .gear {
      position: absolute;
      width: 180px;
      opacity: 0.12;
      animation: spin 60s linear infinite;
      will-change: transform;
    }

    .gear-1 { top: 20px; left: 5%; }
    .gear-2 { top: 120px; right: 5%; animation-duration: 40s; }
    .gear-3 { top: 220px; left: 50%; transform: translateX(-50%); animation-duration: 50s; }
    .gear-4 { top: 320px; left: 15%; animation-duration: 70s; }
    .gear-5 { top: 420px; right: 10%; animation-duration: 55s; }
    .gear-6 { top: 520px; left: 35%; animation-direction: reverse; animation-duration: 60s; }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .form-container {
      background: rgba(20, 20, 20, 0.85);
      border: 1px solid #ffc107;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(255, 193, 7, 0.1);
      padding: 30px;
      position: relative;
      z-index: 2;
    }

    .form-label { color: #ffc107; font-weight: 500; }
    .form-control, .form-select {
      background: #1e1e1e;
      color: #fff;
      border: 1px solid #333;
    }

    .form-control:focus, .form-select:focus {
      border-color: #ffc107;
      box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .btn-primary {
      background-color: #ffc107;
      border: none;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #e0a800;
    }

    .navbar-nav .nav-link {
      font-size: 0.95rem;
      color: #f8f9fa;
      transition: 0.2s;
    }

    .navbar-nav .nav-link:hover { color: #ffc107; }
    .navbar-brand img:hover { transform: scale(1.05); transition: 0.3s; }
  </style>
</head>
<body>

<!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

<!-- Sell Form Section -->
<div class="container py-5 form-section">
  <!-- Gear Background Inside the Form Only -->
  <div class="gear-layer">
    <img src="Assets/Yellow.png" class="gear gear-1">
    <img src="Assets/Blue.png" class="gear gear-2">
    <img src="Assets/Purple.png" class="gear gear-3">
    <img src="Assets/Yellow.png" class="gear gear-4">
    <img src="Assets/Blue.png" class="gear gear-5">
    <img src="Assets/Purple.png" class="gear gear-6">
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="form-container">
        <h2 class="card-title text-center mb-4">Sell Your Watch</h2>
        <?= $message ?>
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" name="brand" id="brand" required>
          </div>
          <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" name="model" id="model" required>
          </div>
          <div class="mb-3">
            <label for="condition" class="form-label">Condition</label>
            <select class="form-select" name="condition" id="condition" required>
              <option value="">-- Select Condition --</option>
              <option value="Excellent">Excellent</option>
              <option value="Good">Good</option>
              <option value="Average">Average</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Expected Price ($)</label>
            <input type="number" class="form-control" name="price" id="price" required>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Upload Watch Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light border border-warning shadow-lg">
              <div class="modal-header border-bottom border-warning">
                <h5 class="modal-title text-warning">Submission Successful</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                ✅ Thank you! Our team will review your watch shortly.
              </div>
              <div class="modal-footer border-top border-warning">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                <a href="watches.php" class="btn btn-warning">Browse Watches</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Image Preview -->
<script>
  const imageInput = document.getElementById('image');
  const preview = document.createElement('img');
  preview.style.maxWidth = '100%';
  preview.style.marginTop = '10px';
  imageInput.parentNode.appendChild(preview);
  imageInput.addEventListener('change', function () {
    const file = imageInput.files[0];
    preview.src = file && file.type.startsWith('image/') ? URL.createObjectURL(file) : '';
  });
</script>

<!-- Modal Logic -->
<?php if (strpos($message, 'success') !== false): ?>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    new bootstrap.Modal(document.getElementById('successModal')).show();
  });
</script>
<?php endif; ?>

<!-- Gear Parallax Script -->
<script>
  document.addEventListener("mousemove", function(e) {
    const gears = document.querySelectorAll(".gear");
    const x = (e.clientX - window.innerWidth / 2) / 80;
    const y = (e.clientY - window.innerHeight / 2) / 80;
    gears.forEach(gear => {
      gear.style.transform = `translate(${x}px, ${y}px) rotate(0deg)`;
    });
  });
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

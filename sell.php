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
  <title>Sell Your Watch — WatchTime.AH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo.png" type="image/png">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="lux-section tight" style="padding-bottom:1.5rem;">
  <div class="container text-center reveal">
    <p class="eyebrow">Parting With a Piece?</p>
    <h2>Sell Your Watch</h2>
    <hr class="gold-line center">
    <p>Submit your timepiece details below and our team will handle valuation and the rest.</p>
  </div>
</section>

<div class="container pb-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 reveal">
      <div class="form-lux">
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
          <div class="mb-4">
            <label for="image" class="form-label">Upload Watch Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
          </div>
          <button type="submit" class="btn-lux btn-lux-filled w-100"><span>Submit For Review</span></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--ink-2);border:1px solid rgba(197,162,83,0.3);border-radius:var(--radius-lg);">
      <div class="modal-header" style="border-bottom:1px solid rgba(197,162,83,0.15);">
        <h5 class="modal-title text-gold fw-serif">Submission Successful</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center py-4">
        <div style="font-size:2.5rem;color:var(--gold);margin-bottom:1rem;">&#10003;</div>
        <p class="text-cream mb-0">Thank you! Our team will review your watch shortly.</p>
      </div>
      <div class="modal-footer" style="border-top:1px solid rgba(197,162,83,0.15);">
        <button type="button" class="btn-lux" data-bs-dismiss="modal"><span>Close</span></button>
        <a href="watches.php" class="btn-lux btn-lux-filled"><span>Browse Watches</span></a>
      </div>
    </div>
  </div>
</div>

<script>
  const imageInput = document.getElementById('image');
  const preview = document.createElement('img');
  preview.style.maxWidth = '100%';
  preview.style.marginTop = '10px';
  preview.style.borderRadius = '10px';
  imageInput.parentNode.appendChild(preview);
  imageInput.addEventListener('change', function () {
    const file = imageInput.files[0];
    preview.src = file && file.type.startsWith('image/') ? URL.createObjectURL(file) : '';
  });
</script>

<?php if (strpos($message, 'success') !== false): ?>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    new bootstrap.Modal(document.getElementById('successModal')).show();
  });
</script>
<?php endif; ?>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="premium.js"></script>
</body>
</html>

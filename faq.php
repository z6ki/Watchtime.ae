<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ - Watch Store</title>

  <!-- ✅ Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

<!-- ❓ FAQ Section -->
<div class="container py-5">
  <h2 class="text-center mb-4">Frequently Asked Questions</h2>

  <div class="accordion" id="faqAccordion">

    <!-- Q1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
          🛒 How do I buy a watch?
        </button>
      </h2>
      <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Browse available watches on our <a href="watches.php" class="text-decoration-underline">Browse</a> page.
          Click on any watch to see more details and contact the seller directly via WhatsApp.
        </div>
      </div>
    </div>

    <!-- Q2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq2">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
          📤 How do I sell my watch?
        </button>
      </h2>
      <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Go to our <a href="sell.php" class="text-decoration-underline">Sell Your Watch</a> page and fill out the form.
          We’ll contact you shortly with the next steps.
        </div>
      </div>
    </div>

    <!-- Q3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq3">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
          🧾 Are the listings verified?
        </button>
      </h2>
      <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          All listings are reviewed manually before being displayed. We aim to ensure all watches are genuine and accurately described.
        </div>
      </div>
    </div>

    <!-- Q4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq4">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
          💳 How do I pay?
        </button>
      </h2>
      <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Currently, purchases are made directly with the seller. We recommend secure payment methods like bank transfer, PayPal, or in-person exchange.
        </div>
      </div>
    </div>

    <!-- Q5 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faq5">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
          🌍 Do you ship internationally?
        </button>
      </h2>
      <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Shipping is arranged between the buyer and seller. Many sellers do offer international shipping — contact them directly for details.
        </div>
      </div>
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

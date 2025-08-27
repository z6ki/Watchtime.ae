<!-- 💎 Optimised Luxury Footer with Logo (Reduced Height) -->
<footer class="footer-custom mt-5 pt-4 pb-3 text-light">
  <div class="container">
    <div class="row text-center text-md-start align-items-start">

      <!-- Column 1: Logo Only -->
      <div class="col-md-4 mb-4">
        <img src="logo.png" alt="WatchTime.AH Logo" width="140" class="mb-2">
      </div>

      <!-- Column 2: Quick Links -->
      <div class="col-md-4 mb-4">
        <h6 class="footer-title">Explore</h6>
        <ul class="list-unstyled">
          <li><a href="index.php">🏠 Home</a></li>
          <li><a href="watches.php">🛍 Browse</a></li>
          <li><a href="sell.php">📤 Sell</a></li>
          <li><a href="wishlist.php">💖 Wishlist</a></li>
          <li><a href="faq.php">❓ FAQ</a></li>
          <li><a href="contact.php">📬 Contact</a></li>
        </ul>
      </div>

      <!-- Column 3: Contact + Socials -->
      <div class="col-md-4 mb-4">
        <h6 class="footer-title">Connect</h6>
        <p class="footer-text mb-1">Email: <a href="mailto:support@watchtime.ah" class="footer-link">support@watchtime.ah</a></p>
        <div class="d-flex justify-content-center justify-content-md-start gap-3 mt-2">
          <a href="#" class="social-icon"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" /></a>
          <a href="#" class="social-icon"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram" /></a>
          <a href="#" class="social-icon"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" /></a>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center footer-text mt-3 border-top pt-2 small" style="font-family: monospace;">
      &copy; <?= date('Y') ?> WatchTime.AH — Precision in Every Second.
    </div>
  </div>

  <!-- Footer CSS -->
  <style>
    .footer-custom {
      background: #0e0e0e;
      border-top: 2px solid #ffc107;
    }

    .footer-title {
      font-weight: bold;
      color: #ffc107;
      text-transform: uppercase;
      margin-bottom: 0.75rem;
      letter-spacing: 1px;
      font-size: 1rem;
    }

    .footer-custom a {
      text-decoration: none;
      display: block;
      margin-bottom: 6px;
      font-size: 0.92rem;
      transition: all 0.2s;
    }

    .footer-link {
      color: #f8f9fa;
    }

    .footer-link:hover,
    .footer-custom a:hover {
      color: #ffc107;
      transform: translateX(4px);
    }

    .footer-text {
      color: #ccc;
      font-size: 0.9rem;
    }

    .social-icon img {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      padding: 5px;
      background: #222;
      transition: 0.3s;
    }

    .social-icon img:hover {
      background: #ffc107;
      transform: scale(1.1);
    }

    @media (max-width: 767px) {
      .footer-title {
        text-align: center;
      }

      .social-icon {
        margin: 0 auto;
      }
    }
  </style>
</footer>

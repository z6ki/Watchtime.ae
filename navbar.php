<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$currentPage = strtolower(basename($_SERVER['PHP_SELF']));
?>
<link rel="stylesheet" href="style.css">
<nav class="navbar navbar-expand-lg lux-nav fixed-top">
  <div class="container-fluid px-3 px-lg-5">
    <a class="navbar-brand" href="index.php">
      <img src="logo.png" alt="WatchTime.AH">
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'watches.php' ? 'active' : '' ?>" href="watches.php">Browse</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'sell.php' ? 'active' : '' ?>" href="sell.php">Sell</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'wishlist.php' ? 'active' : '' ?>" href="wishlist.php">Wishlist</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'faq.php' ? 'active' : '' ?>" href="faq.php">FAQ</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>" href="About.php">About</a></li>
        <li class="nav-item"><a class="nav-link <?= $currentPage == 'contact.php' ? 'active' : '' ?>" href="Contact.php">Contact</a></li>
      </ul>
      <div class="d-flex gap-2 ms-lg-3">
        <?php if (isset($_SESSION['user_id'])): ?>
          <span class="align-self-center me-2 small text-cream">Welcome, <?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['email']) ?></span>
          <a href="logout.php" class="btn-lux"><span>Logout</span></a>
        <?php else: ?>
          <a href="login.php" class="btn-lux"><span>Login</span></a>
          <a href="register.php" class="btn-lux btn-lux-filled"><span>Register</span></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<div style="height:72px;"></div>

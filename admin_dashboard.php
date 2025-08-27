<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /login.php");
    exit();
}

include 'db_connect.php';

$total_watches = $conn->query("SELECT COUNT(*) AS total FROM watches")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - WatchTime.AH</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a2e0fc6c3b.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: rgba(0, 0, 0, 0.85);
      backdrop-filter: blur(8px);
      color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 15px;
      position: relative;
      overflow-x: hidden;
    }
    h1 {
      font-size: 3rem;
      font-weight: 700;
      text-align: center;
      background: linear-gradient(90deg, #ffc107, #ff5722);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 40px;
      user-select: none;
      position: relative;
      z-index: 2;
    }
    .dashboard-container {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      max-width: 900px;
      width: 100%;
      margin-bottom: 50px;
      position: relative;
      z-index: 2;
    }
    .dashboard-card {
      background-color: #1a1a1a;
      border-radius: 12px;
      width: 280px;
      padding: 2rem 1.5rem;
      box-shadow: 0 0 15px rgba(255, 193, 7, 0.2);
      transition: transform 0.25s ease;
      text-align: center;
      cursor: default;
      user-select: none;
    }
    .dashboard-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 25px rgba(255, 193, 7, 0.4);
    }
    .dashboard-card i {
      font-size: 3.5rem;
      color: #ffc107;
      margin-bottom: 1rem;
    }
    .dashboard-card h2 {
      font-size: 1.4rem;
      margin-bottom: 1rem;
      letter-spacing: 0.04em;
      color: #ffc107;
    }
    .dashboard-card p {
      font-size: 2.5rem;
      font-weight: 700;
      color: #fff;
      margin: 0;
    }
    .action-buttons {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
      max-width: 900px;
      width: 100%;
      position: relative;
      z-index: 2;
    }
    .btn-custom {
      padding: 12px 24px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: background-color 0.25s ease;
      min-width: 160px;
      text-align: center;
      user-select: none;
    }
    .btn-upload {
      background-color: #28a745;
      color: #fff;
    }
    .btn-upload:hover {
      background-color: #218838;
      color: #fff;
    }
    .btn-single-post {
      background-color: #17a2b8;
      color: #fff;
    }
    .btn-single-post:hover {
      background-color: #117a8b;
      color: #fff;
    }
    .btn-manage {
      background-color: #007bff;
      color: #fff;
    }
    .btn-manage:hover {
      background-color: #0056b3;
      color: #fff;
    }
    .btn-logout {
      background-color: transparent;
      border: 2px solid #dc3545;
      color: #dc3545;
    }
    .btn-logout:hover {
      background-color: #dc3545;
      color: white;
    }
    @media (max-width: 576px) {
      .dashboard-card {
        width: 90vw;
      }
      .action-buttons {
        flex-direction: column;
        align-items: center;
      }
      .btn-custom {
        min-width: 90vw;
      }
    }
    /* ==== GEAR BACKGROUND (20 gears, evenly spaced grid) ==== */
    .gear-layer {
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
      user-select: none;
    }
    .gear {
      position: absolute;
      width: 70px;
      opacity: 0.16;
      animation: spin 60s linear infinite;
      will-change: transform;
      user-select: none;
      touch-action: none;
      filter: drop-shadow(0 0 8px #0007);
    }
    /* Gear grid (5 rows, 4 cols for 20 gears), add some speed/dir variety */
    <?php
    $rows = 5;
    $cols = 4;
    $gear = 1;
    for ($row = 0; $row < $rows; $row++) {
        for ($col = 0; $col < $cols; $col++) {
            $top = 2 + ($row * 24);       // 2%, 26%, 50%, 74%, 98%
            $left = 3 + ($col * 23);      // 3%, 26%, 49%, 72%
            $speed = 40 + (($gear*7)%35); // Vary speed between 40s-75s
            $rev = ($gear % 2 == 0) ? 'animation-direction: reverse;' : '';
            echo ".gear-$gear { top: {$top}vh; left: {$left}vw; animation-duration: {$speed}s; $rev}\n";
            $gear++;
        }
    }
    ?>
    @keyframes spin { 0% { transform: rotate(0deg);} 100% { transform: rotate(360deg);} }
  </style>
</head>
<body>
  <div class="gear-layer" aria-hidden="true">
    <!-- PHP to cycle through Yellow, Blue, Purple images -->
    <?php
      $gearImgs = ["Yellow.png", "Blue.png", "Purple.png"];
      for ($i=1; $i<=20; $i++) {
        $img = $gearImgs[($i-1)%3];
        echo "<img src=\"Assets/$img\" class=\"gear gear-$i\" draggable=\"false\" alt=\"\">";
      }
    ?>
  </div>
  <h1>Welcome, Admin</h1>
  <div class="dashboard-container">
    <div class="dashboard-card">
      <i class="fas fa-clock"></i>
      <h2>Total Watches</h2>
      <p><?= htmlspecialchars($total_watches) ?></p>
    </div>
    <div class="dashboard-card">
      <i class="fas fa-users"></i>
      <h2>Total Users</h2>
      <p><?= htmlspecialchars($total_users) ?></p>
    </div>
  </div>
  <div class="action-buttons">
    <a href="admin_upload.php" class="btn-custom btn-upload"         title="Upload Products via CSV">Upload Products (CSV)</a>
    <a href="admin_create_watch.php" class="btn-custom btn-single-post" title="Create Single Watch Post">Create Single Watch</a>
    <a href="manage_users.php" class="btn-custom btn-manage"         title="Manage Users">Manage Users</a>
    <a href="logout.php" class="btn-custom btn-logout"               title="Logout">Logout</a>
  </div>
  <script>
    // Parallax motion for all gears
    document.addEventListener("mousemove", function(e) {
      const gears = document.querySelectorAll(".gear");
      const x = (e.clientX - window.innerWidth / 2) / 80;
      const y = (e.clientY - window.innerHeight / 2) / 80;
      gears.forEach((gear, i) => {
        // Gentle shift per gear (unchanged)
        gear.style.transform = `translate(${x * (1 + (i % 3)/4)}px, ${y * (1 + (i % 4)/5)}px) rotate(0deg)`;
      });
    });
  </script>
</body>
</html>

<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logging Out - WatchTime.AH</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    body {
      background: radial-gradient(circle, #121212, #000);
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }

    .logout-card {
      background-color: rgba(25,25,25,0.95);
      border-radius: 12px;
      padding: 40px;
      border: 1px solid #ffc107;
      box-shadow: 0 0 20px rgba(255,193,7,0.2);
      opacity: 0;
      animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    .logout-icon {
      font-size: 3rem;
      color: #ffc107;
      margin-bottom: 15px;
    }

    .redirect-msg {
      font-size: 0.9rem;
      color: #bbb;
    }

    .redirect-msg span {
      color: #ffc107;
    }
  </style>
</head>
<body>

<div class="logout-card">
  <div class="logout-icon">🔐</div>
  <h3 class="mb-3">You've Successfully Logged Out</h3>
  <p class="redirect-msg">Redirecting you to the <span>Login Page</span> in <span id="countdown">5</span> seconds...</p>
</div>

<!-- Auto Redirect Script -->
<script>
  let countdown = 5;
  const timer = document.getElementById('countdown');

  setInterval(() => {
    if (countdown > 1) {
      countdown--;
      timer.textContent = countdown;
    } else {
      window.location.href = 'login.php';
    }
  }, 1000);
</script>

</body>
</html>

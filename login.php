<?php
session_start();
include 'db_connect.php';

$message = "";

// Handle login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id, name, email, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("<div class='alert alert-danger text-center'>SQL Error: (" . $conn->errno . ") " . $conn->error . "</div>");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $email_db, $hashed_password, $role);
        $stmt->fetch();

        if ($password === $hashed_password) {
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email_db;
            $_SESSION['role'] = $role;

            // Redirect based on user type
            if (strtolower(trim($role)) === 'admin') {
                  header("Location: admin_dashboard.php");
                  exit;                  
              } else {          
                header("Location: index.php");
                exit;
            }
        } else {
            $message = "<div class='alert alert-danger text-center'>Incorrect password.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger text-center'>Account not found.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - WatchTime.AH</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg, #000000, #1a1a1a);
      color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      max-width: 420px;
      margin: 80px auto;
      background: rgba(20, 20, 20, 0.9);
      padding: 30px;
      border-radius: 10px;
      border: 1px solid #ffc107;
      box-shadow: 0 0 20px rgba(255, 193, 7, 0.2);
      animation: slideIn 0.6s ease;
    }

    @keyframes slideIn {
      from { transform: translateY(50px); opacity: 0; }
      to   { transform: translateY(0); opacity: 1; }
    }

    .form-control,
    .form-control:focus {
      background-color: #1f1f1f;
      border-color: #333;
      color: white;
    }

    .btn-warning {
      font-weight: bold;
      width: 100%;
    }

    .back-link,
    .register-link {
      color: #ccc;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .back-link:hover,
    .register-link:hover {
      color: #ffc107;
      text-decoration: underline;
    }

    .logo {
      display: block;
      margin: 0 auto 20px;
      width: 100px;
    }

    .small-note {
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="login-container">
  <a href="index.php"><img src="logo.png" alt="Logo" class="logo"></a>
  <h3 class="text-center mb-4">Login to Your Account</h3>

  <?= $message ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label for="email" class="form-label text-warning">Email address</label>
      <input type="email" class="form-control" name="email" id="email" required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label text-warning">Password</label>
      <input type="password" class="form-control" name="password" id="password" required />
    </div>
    <button type="submit" class="btn btn-warning">Login</button>
  </form>

  <div class="small-note mt-3">
    <a href="index.php" class="back-link">&larr; Back to Home</a>
    <br>
    <span>Don't have an account? <a href="register.php" class="register-link">Register here</a></span>
  </div>
</div>

</body>
</html>

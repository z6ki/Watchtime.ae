<?php
session_start();
include 'db_connect.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Registration Successful! <a href='login.php'>Login Now</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Registration Failed. Email may already exist.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - WatchTime.AH</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: radial-gradient(circle, #121212, #000);
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }

    .register-card {
      background-color: rgba(25,25,25,0.9);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid #ffc107;
      box-shadow: 0 0 20px rgba(255,193,7,0.2);
      opacity: 0;
      transform: scale(0.9);
      animation: fadeInScale 0.7s ease forwards;
    }

    @keyframes fadeInScale {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    .form-control {
      background-color: #222;
      color: #fff;
      border: 1px solid #444;
    }
    .form-control:focus {
      border-color: #ffc107;
      box-shadow: none;
    }
    .btn-primary {
      background-color: #ffc107;
      color: #121212;
      font-weight: bold;
      border: none;
    }
    .btn-primary:hover {
      background-color: #e0a800;
    }
    .login-link {
      font-size: 0.9rem;
      color: #bbb;
      text-decoration: none;
    }
    .login-link:hover {
      color: #ffc107;
    }
    .back-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      color: #fff;
      text-decoration: none;
      transition: color 0.3s;
    }
    .back-btn:hover {
      color: #ffc107;
    }
  </style>
</head>
<body>

<a href="javascript:history.back()" class="back-btn">
  &larr; Go Back
</a>

<div class="container py-5">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-5">
      <div class="register-card">
        <div class="text-center mb-4">
          <img src="logo.png" alt="WatchTime.AH" width="120">
          <h3 class="mt-2 text-warning">Create an Account</h3>
        </div>

        <?= $message ?>

        <form method="POST">
          <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
          </div>

          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
          </div>

          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>

          <div class="text-center mt-3">
            Already have an account? <a href="login.php" class="login-link">Login here</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>

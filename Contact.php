<?php
session_start();
include 'db_connect.php';

$name = '';
$email = '';

// Pre-fill name and email if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($name, $email);
    $stmt->fetch();
    $stmt->close();
}

// Handle contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_input = $_POST['name'];
    $email_input = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name_input, $email_input, $message);

    if ($stmt->execute()) {
        $feedback = "<div class='alert alert-success text-center'>Thank you! Your message has been sent successfully.</div>";
    } else {
        $feedback = "<div class='alert alert-danger text-center'>Oops! Something went wrong. Please try again later.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Watch Store</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- 🧭 Navbar -->
<?php include 'navbar.php'; ?>

<!-- 📬 Contact Section -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Contact Us</h2>

          <?= $feedback ?? '' ?>

          <form action="contact.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="<?= htmlspecialchars($name) ?>" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($email) ?>" required>
            </div>

            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Message</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Footer -->
<?php include 'footer.php'; ?>

</body>
</html>

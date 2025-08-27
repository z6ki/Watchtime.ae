<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

// Handle delete user request
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteId = $_GET['delete'];

    // Prevent admin from deleting themselves
    if ($_SESSION['user_id'] != $deleteId) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $message = "User deleted successfully.";
    } else {
        $message = "You cannot delete your own account.";
    }
}

// Fetch users
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Admin</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .table th, .table td { vertical-align: middle; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4 text-center">Manage Users</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-info text-center"><?= $message ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th style="width: 120px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= ucfirst($user['role']) ?></td>
                    <td>
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <a href="?delete=<?= $user['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        <?php else: ?>
                            <span class="text-muted">Your Account</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php" class="btn btn-secondary mt-3">← Back to Dashboard</a>
</div>
</body>
</html>

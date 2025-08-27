<?php
session_start();
include 'db_connect.php';

$message = "";
$successCount = 0;
$failCount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, "r")) !== FALSE) {
        $header = fgetcsv($handle); // Skip header

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) < 6) {
                $message .= "<div class='alert alert-warning'>Invalid row format. Skipped.</div>";
                $failCount++;
                continue;
            }

            $brand = trim($data[0]);
            $model = trim($data[1]);
            $condition = trim($data[2]);
            $case_material = trim($data[3]);
            $mm = trim($data[4]);
            $image = pathinfo(trim($data[5]), PATHINFO_FILENAME) . '.png'; // Force .png extension

            if (empty($brand) || empty($model) || empty($condition)) {
                $message .= "<div class='alert alert-warning'>Missing data for <strong>$brand $model</strong>. Skipped.</div>";
                $failCount++;
                continue;
            }

            $check = $conn->prepare("SELECT id FROM watches WHERE brand = ? AND model = ?");
            if ($check) {
                $check->bind_param("ss", $brand, $model);
                $check->execute();
                $check->store_result();

                if ($check->num_rows > 0) {
                    $message .= "<div class='alert alert-secondary'>Duplicate: <strong>$brand $model</strong>. Skipped.</div>";
                    $check->close();
                    $failCount++;
                    continue;
                }
                $check->close();
            } else {
                $message .= "<div class='alert alert-danger'>Check query failed.</div>";
                $failCount++;
                continue;
            }

            $stmt = $conn->prepare("INSERT INTO watches (brand, model, `condition`, case_material, mm, image) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssssss", $brand, $model, $condition, $case_material, $mm, $image);
                $stmt->execute();
                $successCount++;
            } else {
                $message .= "<div class='alert alert-danger'>Insert failed for <strong>$brand $model</strong>.</div>";
                $failCount++;
            }
        }

        fclose($handle);
        $message .= "<div class='alert alert-success mt-4'><strong>Upload Summary:</strong> $successCount inserted, $failCount failed/skipped.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Could not open the uploaded file.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Rolex CSV</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Upload Rolex Watches CSV</h2>

    <?= $message ?>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Select CSV File:</label>
            <input type="file" name="csv_file" accept=".csv" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Upload</button>
    </form>

    <a href="admin_dashboard.php" class="btn btn-link mt-3">← Back to Admin Panel</a>
</div>
</body>
</html>

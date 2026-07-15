<?php
session_start();
require 'db.php';

// Only logged-in users can view this
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}

$stmt = $pdo->query("SELECT * FROM bookings ORDER BY created_at DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Bookings</title>
    <style>
        body { font-family: sans-serif; background: #111; color: white; padding: 40px; }
        h1 { color: #f5c542; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #333; text-align: left; }
        th { color: #f5c542; }
        a { color: #f5c542; }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <p><a href="logout.php">Logout</a></p>

    <table>
        <tr>
            <th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th>
        </tr>
        <?php foreach ($bookings as $b): ?>
        <tr>
            <td><?= htmlspecialchars($b['name']) ?></td>
            <td><?= htmlspecialchars($b['email']) ?></td>
            <td><?= htmlspecialchars($b['phone']) ?></td>
            <td><?= htmlspecialchars($b['message']) ?></td>
            <td><?= $b['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
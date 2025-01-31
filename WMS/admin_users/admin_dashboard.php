<?php
session_start();

// Controleer of de admin is ingelogd
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Verwijs naar de admin login als de admin niet is ingelogd
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<h1>Welkom, Admin!</h1>
<p>Kies een optie uit het menu hieronder:</p>
<ul>
    <li><a href="create_po.php">Create PO</a></li>
    <li><a href="create_users.php">Create Users</a></li>
    <li><a href="create_locations.php">Create Locations</a></li>
    <li><a href="po_list.php">PO List</a></li>
    <li><a href="recieve.php">Receive</a></li>
    <li><a href="create_buffer.php">Create Buffer</a></li>
    <li><a href="count.php">Count</a></li>
    <li><a href="add_to_buffer.php">Add to Buffer</a></li>
    <li><a href="stock_info.php">Stock Info</a></li>
    <li><a href="logout.php">Uitloggen</a></li>
</ul>
</body>
</html>

<?php
include 'db.php'; // Databaseverbinding


session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Verwijs naar de inlogpagina
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buffer_name = $_POST['buffer_name'];
    $description = $_POST['description'];

    try {
        $sql = "INSERT INTO buffer_locations (name, description) VALUES (:name, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $buffer_name);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            echo "Bufferlocatie succesvol aangemaakt: " . htmlspecialchars($buffer_name);
        } else {
            echo "Fout bij het aanmaken van de bufferlocatie.";
        }
    } catch (Exception $e) {
        echo "Er ging iets mis: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bufferlocatie Aanmaken</title>
</head>
<body>
<h1>Bufferlocatie Aanmaken</h1>
<form method="POST" action="create_buffer.php">
    <label for="buffer_name">Bufferlocatienaam:</label>
    <input type="text" id="buffer_name" name="buffer_name" required><br><br>
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description"></textarea><br><br>
    <button type="submit">Aanmaken</button>
</form>
</body>
</html>

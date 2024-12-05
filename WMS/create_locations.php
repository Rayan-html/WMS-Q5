<?php
// Include databaseverbinding
include 'db.php';

session_start();

// Controleer of de gebruiker ingelogd is als admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php'); // Verwijs naar de admin loginpagina
    exit;
}

// Variabelen voor fout- of succesmeldingen
$error = '';
$success = '';

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim en valideer invoer
    $location_name = trim($_POST['location_name']);

    if (empty($location_name)) {
        $error = "Locatienaam is verplicht.";
    } else {
        try {
            // Bereid SQL-query voor om de locatie toe te voegen
            $sql = "INSERT INTO locations (name) VALUES (:name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $location_name);

            // Voer de query uit
            if ($stmt->execute()) {
                $success = "Locatie succesvol aangemaakt: " . htmlspecialchars($location_name);
            } else {
                $error = "Fout bij het aanmaken van de locatie.";
            }
        } catch (PDOException $e) {
            $error = "Er ging iets mis: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locatie Aanmaken</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
<h1>Locatie Aanmaken</h1>

<!-- Fout- of succesmeldingen -->
<?php if (!empty($error)): ?>
    <div class="message error"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="message success"><?php echo $success; ?></div>
<?php endif; ?>

<!-- Formulier -->
<form method="POST" action="create_locations.php">
    <label for="location_name">Locatienaam:</label>
    <input type="text" id="location_name" name="location_name" required>

    <button type="submit">Aanmaken</button>
</form>
</body>
</html>

<?php
session_start();
include 'db.php'; // Verbind met je database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Zoek gebruiker in de database
    $query = "SELECT * FROM users WHERE username = :username AND role = 'user'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleer wachtwoord
    if ($user && hash('sha256', $password) === $user['password']) {
        $_SESSION['user_logged_in'] = true; // Markeer als ingelogd
        header('Location: user_dashboard.php'); // Redirect naar gebruikers-dashboard
        exit;
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normale Gebruiker Login</title>
</head>
<body>
<h1>Login voor Normale Gebruiker</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="POST">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Wachtwoord:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Inloggen</button>
</form>
</body>
</html>

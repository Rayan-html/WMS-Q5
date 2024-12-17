<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Versleutel wachtwoord

    if (!empty($username) && !empty($email) && !empty($password)) {
        try {
            $sql = "INSERT INTO clientusers (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                echo "Registratie succesvol! U kunt nu inloggen.";
            } else {
                echo "Er ging iets mis tijdens het registreren.";
            }
        } catch (PDOException $e) {
            echo "Fout: " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Alle velden zijn verplicht.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>
<h1>Registreren</h1>
<form method="POST" action="client_register.php">
    <label>Gebruikersnaam:</label>
    <input type="text" name="username" required>
    <label>E-mail:</label>
    <input type="email" name="email" required>
    <label>Wachtwoord:</label>
    <input type="password" name="password" required>
    <button type="submit">Registreren</button>
</form>
</body>
</html>

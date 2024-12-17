<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        try {
            $sql = "SELECT * FROM clientusers WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: order.php'); // Verwijs naar de bestelpagina
                exit;
            } else {
                echo "Ongeldige inloggegevens.";
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
    <title>Inloggen</title>
</head>
<body>
<h1>Inloggen</h1>
<form method="POST" action="client_login.php">
    <label>E-mail:</label>
    <input type="email" name="email" required>
    <label>Wachtwoord:</label>
    <input type="password" name="password" required>
    <button type="submit">Inloggen</button>
</form>
</body>
</html>

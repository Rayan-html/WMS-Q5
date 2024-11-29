<?php
include 'db.php'; // Zorg dat je db.php juist is ingesteld voor de databaseverbinding

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verkrijg gegevens van het formulier
    $po_number = $_POST['po_number'];
    $po_quantity = intval($_POST['po_quantity']); // Verkrijg de hoeveelheid

    try {
        // Zoek naar beschikbare locaties (geen bufferlocaties in de database)
        $location_query = "SELECT * FROM locations";
        $location_stmt = $conn->prepare($location_query);
        $location_stmt->execute();
        $locations = $location_stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($locations) {
            // Selecteer willekeurig een locatie
            $selected_location = $locations[array_rand($locations)]['name'];

            // Voeg de nieuwe PO toe aan de database met de hoeveelheid
            $po_sql = "INSERT INTO purchase_orders (po_number, location, quantity, created_at, status) 
                       VALUES (:po_number, :location, :quantity, NOW(), 'closed')";
            $po_stmt = $conn->prepare($po_sql);
            $po_stmt->bindParam(':po_number', $po_number);
            $po_stmt->bindParam(':location', $selected_location);
            $po_stmt->bindParam(':quantity', $po_quantity);

            if ($po_stmt->execute()) {
                echo "PO succesvol aangemaakt! Locatie toegewezen: " . htmlspecialchars($selected_location) . " | Hoeveelheid: " . htmlspecialchars($po_quantity);
            } else {
                echo "Er is een fout opgetreden bij het aanmaken van de PO.";
            }
        } else {
            echo "Geen locaties beschikbaar in de database. Voeg locaties toe en probeer opnieuw.";
        }
    } catch (Exception $ex) {
        echo 'Er ging iets fout bij het aanmaken van de PO: ' . htmlspecialchars($ex->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe PO Aanmaken</title>
</head>
<body>
<h1>Nieuwe Purchase Order Aanmaken</h1>
<form method="POST" action="create_po.php">
    <label for="po_number">PO Nummer:</label>
    <input type="text" id="po_number" name="po_number" required><br><br>
    <label for="po_quantity">Aantal producten:</label>
    <input type="number" id="po_quantity" name="po_quantity" min="1" required><br><br>
    <button type="submit">Aanmaken</button>
</form>
</body>
</html>

<?php
include 'db.php'; // Zorg voor databaseverbinding

$searchResult = [];
$searchType = '';
$searchTerm = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search_type']) && isset($_GET['search_term'])) {
    $searchType = $_GET['search_type'];
    $searchTerm = trim($_GET['search_term']);

    try {
        if ($searchType === 'location') {
            $query = "SELECT product_name, quantity, location FROM stock WHERE location = :search_term";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':search_term', $searchTerm);
        } elseif ($searchType === 'product') {
            $query = "SELECT DISTINCT location, quantity FROM stock WHERE product_name = :search_term";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':search_term', $searchTerm);
        }
        $stmt->execute();
        $searchResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "Er ging iets fout: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Informatie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stock-info.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">WMS Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Stock-Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Notifications</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-4">
    <h1 class="text-center mb-4">Stock Informatie</h1>
    <form method="GET" action="stock_info.php" class="text-center mb-4">
        <label for="search_type" class="form-label">Selecteer een zoekoptie:</label>
        <select name="search_type" id="search_type" class="form-select d-inline-block w-auto ms-2 me-2" required>
            <option value="location" <?= $searchType === 'location' ? 'selected' : '' ?>>Zoeken op Locatie</option>
            <option value="product" <?= $searchType === 'product' ? 'selected' : '' ?>>Zoeken op Product</option>
        </select>
        <input type="text" name="search_term" class="form-control d-inline-block w-50 ms-2" placeholder="Voer een zoekterm in" value="<?= htmlspecialchars($searchTerm) ?>" required>
        <button type="submit" class="btn btn-primary ms-2">Zoeken</button>
    </form>

    <?php if (!empty($searchResult)): ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <?php if ($searchType === 'location'): ?>
                    <th>Product</th>
                    <th>Hoeveelheid</th>
                    <th>Locatie</th>
                <?php elseif ($searchType === 'product'): ?>
                    <th>Locatie</th>
                    <th>Hoeveelheid</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($searchResult as $row): ?>
                <tr>
                    <?php if ($searchType === 'location'): ?>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                    <?php elseif ($searchType === 'product'): ?>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($searchTerm)): ?>
            <p class="text-center text-danger">Geen resultaten gevonden voor "<?= htmlspecialchars($searchTerm) ?>".</p>
        <?php endif; ?>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

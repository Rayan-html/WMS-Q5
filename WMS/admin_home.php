<?php

include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMS Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
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
                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Stock-Info</a>
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
    <div class="row">
        <div class="col-md-8">
            <div class="content-section">
                <h2>Important Updates</h2>
                <ul class="updates-list">
                    <li>
                        <span class="update-date">2023-11-15</span> - New feature added: Inventory forecasting.
                    </li>
                    <li>
                        <span class="update-date">2023-11-12</span> - System maintenance scheduled for this weekend.
                    </li>
                    <li>
                        <span class="update-date">2023-11-10</span> - Resolved issue with order processing delays.
                    </li>
                </ul>
            </div>
            <div class="content-section">
                <h2>Daily News</h2>
                <div class="news-item">
                    <h5 class="news-title">Article Title 1</h5>
                    <p class="news-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed feugiat
                        semper libero, id hendrerit odio efficitur at.</p>
                    <a href="#" class="news-link">Read More</a>
                </div>
                <div class="news-item">
                    <h5 class="news-title">Article Title 2</h5>
                    <p class="news-summary">Nulla facilisi. Vivamus ac ex ac elit eleifend tristique id vel diam.</p>
                    <a href="#" class="news-link">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="image-section">
                <img src="placeholder.jpg" alt="Placeholder Image" class="img-fluid">
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse 3D</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script>
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Geen scrollbalken */
        }
        canvas {
            display: block;
        }
        #info {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            z-index: 10;
        }
    </style>
</head>
<body>
<div id="info">
    <h2>Warehouse 3D</h2>
    <p>Gebruik je muis en toetsenbord om rond te kijken</p>
</div>
<!-- Three.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script>
<!-- Custom JavaScript -->
<script src="warehouse.js"></script>
</body>
</html>

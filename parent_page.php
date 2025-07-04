<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>parentpage</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>#map { height: 400px; width: 100%; margin-top: 20px; }</style>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bodyparent">
    
    <header class="parentheader">
        <div class="main">
            <div class="logo">
                <img src="images/lokos.jpg">
            </div>
            <ul>
                
                <li><a href="about.html"><i class="fa fa-question-circle"></i> Aboutus</a></li>
                <li><a href="contact.html"><i class="fa fa-volume-control-phone"></i> Contact</a></li>
                <li><a href="track.html"><i class="fa fa-map-marker"></i> Trackstudent</a></li>
                <?php if (isset($_SESSION['email'])): ?>
    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
<?php else: ?>
    <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
<?php endif; ?>
            </ul>
        </div>

    </header>
        <div class="parent-content">
            <h1>Welcome</h1>
            <div id="map"></div>
         </div>
         <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
let map = L.map('map').setView([0, 0], 15);
let marker = L.marker([0, 0]).addTo(map);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data © OpenStreetMap contributors'
}).addTo(map);

function updateMap() {
    fetch('get_driver_location.php')
        .then(res => res.json())
        .then(data => {
            marker.setLatLng([data.latitude, data.longitude]);
            map.setView([data.latitude, data.longitude]);
        });
}

setInterval(updateMap, 10000); // update every 10 seconds
</script>

</body>
</html>
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
    <title>Driverpage</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <body class="bodydriver">
    <header class="driverheader">
        <div class="main">
            <div class="logo">
                <img src="images/lokos.jpg">
            </div>
            <ul>
                
                <li><a href="about.html"><i class="fa fa-question-circle"></i> Aboutus</a></li>
                <li><a href="contact.php"><i class="fa fa-volume-control-phone"></i> Contact</a></li>
                <li><a href="track.html"><i class="fa fa-map-marker"></i> Trackstudent</a></li>
                <?php if (isset($_SESSION['email'])): ?>
    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
<?php else: ?>
    <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
<?php endif; ?>
            </ul>
        </div>

    </header>
        <div class="driver-content">
            <h1>Welcome, ></h1>
             <p>This is the <span>Driver</span> page</p>
         </div>
         <script>
function sendLocation(position) {
    const data = new FormData();
    data.append("latitude", position.coords.latitude);
    data.append("longitude", position.coords.longitude);

    fetch("update_location.php", {
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then(response => console.log("Location sent:", response))
    .catch(error => console.error("Error sending location:", error));
}

function handleLocationError(error) {
    console.warn("Geolocation error:", error.message);
}

function updateDriverLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            sendLocation,
            handleLocationError,
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 10000
            }
        );
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

// Send every 10 seconds
setInterval(updateDriverLocation, 10000);

// Send immediately on page load
updateDriverLocation();
</script>

</body>
</html>
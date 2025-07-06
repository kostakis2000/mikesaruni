<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$host = "localhost";
$user = "root";        // UPDATE if needed
$pass = "";
$dbname = "users_db";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adminpage</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="admin.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body class="bodyadmin">
  <header class="parentheader">
    <div class="main">
      <div class="logo"><img src="images/lokos.jpg" alt="Logo"></div>
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

    <div class="contact-messages">
      <h2>📬 Messages from Contact Form</h2>
      <table>
        <thead>
          <tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Submitted At</th></tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM contact_messages ORDER BY submitted_at DESC";
          $res = $conn->query($sql);
          if ($res && $res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
              echo "<tr>
                <td>{$row['id']}</td>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".htmlspecialchars($row['subject'])."</td>
                <td>".nl2br(htmlspecialchars($row['message']))."</td>
                <td>{$row['submitted_at']}</td>
              </tr>";
            }
          } else {
            echo "<tr><td colspan='6'>No messages found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    let map = L.map('map').setView([0,0], 15);
    L.marker([0,0]).addTo(map);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data © OpenStreetMap contributors'
    }).addTo(map);

    function updateMap() {
      fetch('get_driver_location.php')
        .then(r => r.json())
        .then(d => {
          map.setView([d.latitude, d.longitude]);
          L.marker([d.latitude, d.longitude]).addTo(map);
        });
    }
    setInterval(updateMap, 10000);
  </script>
</body>
</html>

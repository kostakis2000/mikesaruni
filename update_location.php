<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Not logged in";
    exit;
}

$driver_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // your actual DB credentials
    $conn = new mysqli("localhost", "root", "", "users_db");
    if ($conn->connect_error) {
        die("DB Error: " . $conn->connect_error);
    }

    // check if this driver already has a location entry
    $check = $conn->prepare("SELECT id FROM driver_location WHERE driver_email = ?");
    $check->bind_param("s", $driver_email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE driver_location SET latitude=?, longitude=? WHERE driver_email=?");
        $stmt->bind_param("dds", $latitude, $longitude, $driver_email);
    } else {
        $stmt = $conn->prepare("INSERT INTO driver_location (driver_email, latitude, longitude) VALUES (?, ?, ?)");
        $stmt->bind_param("sdd", $driver_email, $latitude, $longitude);
    }

    $stmt->execute();
    echo "Location updated";
}
?>


<?php
// using your actual DB connection values
$conn = new mysqli("localhost", "root", "", "users_db");

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}

$sql = "SELECT latitude, longitude FROM driver_location ORDER BY updated_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "latitude" => $row['latitude'],
        "longitude" => $row['longitude']
    ]);
} else {
    echo json_encode(["latitude" => 0, "longitude" => 0]);
}
?>

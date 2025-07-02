<?php 

$host = "localhost"; /*stores database server address indicating database server is on same machine as our project*/
$user = "root";
$password = "";
$database = "users_db";

$conn = new mysqli($host, $user, $password, $database);/*stores connection object */

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

?>
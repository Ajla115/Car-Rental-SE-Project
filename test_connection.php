<?php
require_once('../Car-Rental-SE-Project/rest/config.php'); // Ensure this file path is correct
$conn = new mysqli(Config::DB_HOST(), Config::DB_USERNAME(), Config::DB_PASSWORD(), Config::DB_SCHEME(), Config::DB_PORT());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
$conn->close();
?>

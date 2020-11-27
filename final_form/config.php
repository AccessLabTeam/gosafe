<?php
$host = "db24.grserver.gr:3306";
$userName = "konst_accesslab";
$password = "kiousisp1991";
$dbName = "konstant672599_accesslab";

// Create database connection
$conn = new mysqli($host, $userName, $password, $dbName);
print_r($conn);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$dbuser = "root";
$dbpass = "Pigu123456@$"; // Your actual database password
$host = "localhost";
$db = "hotelmanagementsystem"; // Your database name
$mysqli = new mysqli($host, $dbuser, $dbpass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

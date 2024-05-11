<?php
$servername = "localhost";
$username = ""; // Your MySQL username
$password = ""; // Your MySQL password
$database = "HIVEWEB"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
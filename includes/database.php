<?php 
    $hostname = "localhost";
    $username = "root";
    $pword = "";
    $dbname = "hive_db";

    $conn = new mysqli($hostname, $username, $pword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
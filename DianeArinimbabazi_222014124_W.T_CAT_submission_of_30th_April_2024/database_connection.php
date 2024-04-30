<?php
// Connection details
$host = "localhost"; // Hostname of the database server
$user = "Diane ARINIMBABAZI"; // Username to connect to the database
$pass = "222014124"; // Password to connect to the database
$database = "pharmacy_mgt_system"; // Name of the database

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    // If connection failed, print an error message and terminate the script
    die("Connection failed: " . $connection->connect_error);
}
?>

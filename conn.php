<?php
// Database credentials
$servername = "localhost";
$username = "root";  // Adjust if you have a different username
$password = "";      // Adjust if your MySQL has a password
$dbname = "project"; // The database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
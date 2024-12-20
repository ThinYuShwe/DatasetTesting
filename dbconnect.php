<?php
$host = "localhost";
$user = "root";
$password = ""; // Update if your root user has a password
$dbname = "clothing_shirtstesting"; // Ensure this database exists

try {
    $conn = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $user, $password);
    // Set error mode to exceptions for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}

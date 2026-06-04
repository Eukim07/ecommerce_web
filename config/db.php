<?php
// Database configuration credentials
$host     = "localhost";
$username = "root";
$password = "";          // Change this if you set a password in phpMyAdmin
$dbname   = "ecommerce_db"; // Replace with your actual database name
$port     = 3307;        // Default MySQL port. Change to 3307 if XAMPP is configured differently

// Enable MySQLi error reporting for easier debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create a new connection instance
    $conn = new mysqli($host, $username, $password, $dbname, $port);
    
    // Set charset to utf8mb4 for proper data encoding (handles emojis/special characters)
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    // Catch any connection errors and display a clean message
    die("Database Connection Failed: " . $e->getMessage());
}
?>
<?php
$host = 'localhost';  // or '127.0.0.1'
$dbname = 'bmi_app';
$user = 'root';  // use your MySQL username
$pass = 'root';      // use your MySQL password, leave empty if no password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!";  // Add this line for testing
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

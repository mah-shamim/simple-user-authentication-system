<?php
include 'config.php';

// Database configuration
$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Create a new PDO instance
try {

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {

    echo 'Connection failed: ' . $e->getMessage(); // Display error message if connection fails
}
?>

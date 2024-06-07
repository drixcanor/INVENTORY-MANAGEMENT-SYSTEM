<?php
// Database configuration
$db_host = 'localhost';
$db_name = 'sql12657302';
$db_user = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->query('SELECT accreditation_name FROM tbl_accreditations'); // Use the correct table name
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set response headers
    header('Content-Type: application/json');

    // Output the data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle any database connection errors here
    echo 'Error: ' . $e->getMessage();
}

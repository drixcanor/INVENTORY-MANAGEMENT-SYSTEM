<?php
// Database configuration
$db_host = 'sql12.freesqldatabase.com';
$db_name = 'sql12708861';
$db_user = 'sql12708861';
$db_password = '7KWwzP86iK';



try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->query('SELECT Name FROM acre'); // Use the correct table name
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set response headers
    header('Content-Type: application/json');

    // Output the data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle any database connection errors here
    echo 'Error: ' . $e->getMessage();
}

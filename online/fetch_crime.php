<?php
$db_host = 'sql6.freesqldatabase.com';
$db_name = 'sql6704900';
$db_user = 'sql6704900';
$db_password = 'lkV5hrU6gq';


try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->query('SELECT * FROM tbl_crime'); // Use the correct table name
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set response headers
    header('Content-Type: application/json');

    // Output the data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle any database connection errors here
    echo 'Error: ' . $e->getMessage();
}

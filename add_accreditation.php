<?php
// Database configuration
$db_host = 'sql12.freesqldatabase.com';
$db_name = 'sql12657302';
$db_user = 'sql12657302';
$db_password = 'fccsdFclad';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the data from the POST request
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $president = $_POST['President'];
    $contact = $_POST['Contact'];
    $sex = $_POST['Sex'];

    // Insert the data into the 'acrceditations' table
    $stmt = $pdo->prepare('INSERT INTO acrceditations (Name, address, president, contact, sex) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$name, $address, $president, $contact, $sex]);

    // Respond with a success message
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

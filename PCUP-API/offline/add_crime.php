<?php
$db_host = 'localhost';
$db_name = 'sql12657302';
$db_user = 'root';
$db_password = '';


try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from the POST request
    $crimeViolation = $_POST['crime_violation'];
    $crimeDate = $_POST['crime_date'];
    $crimeVictim = $_POST['crime_victim'];
    $crimeViolator = $_POST['crime_perpetrator'];
    $crimeBarangay = $_POST['crime_barangay'];


    // Create a prepared statement
    $stmt = $pdo->prepare("INSERT INTO tbl_crime(crime_violation, crime_date, crime_victim, crime_perpetrator, crime_barangay) VALUES (?,?,?,?,?)");
    $stmt->execute([$crimeViolation, $crimeDate, $crimeVictim, $crimeViolator, $crimeBarangay]);
    // Respond with a success message as JSON
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

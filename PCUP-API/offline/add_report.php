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
    $programName = $_POST['report_name'];
    $facilitator = $_POST['report_facilitator'];
    $date = $_POST['report_date'];
    $barangay = $_POST['report_barangay'];
    $description = $_POST['report_objective'];


    // Create a prepared statement
    $stmt = $pdo->prepare("INSERT INTO tbl_reports(report_name, report_facilitator, report_date, report_barangay, report_objective) VALUES (?,?,?,?,?)");
    $stmt->execute([$programName, $facilitator, $date, $barangay, $description]);
    // Respond with a success message as JSON
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

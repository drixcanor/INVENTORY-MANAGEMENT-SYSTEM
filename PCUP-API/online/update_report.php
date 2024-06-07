<?php
$db_host = 'sql12.freesqldatabase.com';
$db_name = 'sql12708861';
$db_user = 'sql12708861';
$db_password = '7KWwzP86iK';


try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from the POST request
    $reportId = $_POST['report_id'];
    $programName = $_POST['report_name'];
    $facilitator = $_POST['report_facilitator'];
    $date = $_POST['report_date'];
    $barangay = $_POST['report_barangay'];
    $description = $_POST['report_objective'];

    // Create a prepared statement for UPDATE
    $stmt = $pdo->prepare("UPDATE tbl_reports 
                        SET report_name = ?, 
                            report_facilitator = ?, 
                            report_date = ?, 
                            report_barangay = ?, 
                            report_objective = ? 
                        WHERE report_id = ?");
    $stmt->execute([$programName, $facilitator, $date, $barangay, $description, $reportId]);

    // Respond with a success message as JSON
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

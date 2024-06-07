<?php
$db_host = 'localhost';
$db_name = 'sql12657302';
$db_user = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update variable names to match Dart keys
    $accreditation_name = $_POST['accreditation_name'];
    $accreditation_barangay = $_POST['accreditation_barangay'];
    $accreditation_address = $_POST['accreditation_address'];
    $accreditation_contactperson = $_POST['accreditation_contactperson'];
    $accreditation_issued = $_POST['accreditation_issued'];
    $accreditation_expired = $_POST['accreditation_expired'];
    $accreditation_number = $_POST['accreditation_number'];
    $accreditation_phone = $_POST['accreditation_phone'];
    $accreditation_president = $_POST['accreditation_president'];
    $accreditation_area = $_POST['accreditation_area'];
    $accreditation_class = $_POST['accreditation_class'];
    $accreditation_programs = $_POST['accreditation_programs'];
    $accreditation_problems = $_POST['accreditation_problems'];
    $accreditation_coordinator = $_POST['accreditation_coordinator'];
    $accreditation_remarks = $_POST['accreditation_remarks'];

    // Insert the data into the 'acrceditations' table
    $stmt = $pdo->prepare("INSERT INTO tbl_accreditations(accreditation_name, accreditation_barangay, accreditation_address, accreditation_contactperson, accreditation_issued, accreditation_expired, accreditation_number, accreditation_phone, accreditation_president, accreditation_area, accreditation_class, accreditation_programs, accreditation_problems, accreditation_coordinator, accreditation_remarks) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([$accreditation_name, $accreditation_barangay, $accreditation_address, $accreditation_contactperson, $accreditation_issued, $accreditation_expired, $accreditation_number, $accreditation_phone, $accreditation_president, $accreditation_area, $accreditation_class, $accreditation_programs, $accreditation_problems, $accreditation_coordinator, $accreditation_remarks]);

    // Respond with a success message
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

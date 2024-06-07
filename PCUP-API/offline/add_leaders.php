<?php
$db_host = 'localhost';
$db_name = 'sql12657302';
$db_user = 'root';
$db_password = '';


try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from the POST request
    $leaderName = $_POST['leader_name'];
    $leaderPosition = $_POST['leader_position'];
    $leaderSex = $_POST['leader_sex'];
    $leaderAge = $_POST['leader_age'];
    $leaderBarangay = $_POST['leader_barangay'];
    $leaderCivilStatus = $_POST['leader_civilstatus'];
    $leaderNumFamilyMembers = $_POST['leader_num_family_members'];
    $leaderTotalMale = $_POST['leader_total_male'];
    $leaderTotalFemale = $_POST['leader_total_female'];
    $leaderTotalPWDFemale = $_POST['leader_totalpwd_physical_female'];
    $leaderTotalPWDPhysicalMale = $_POST['leader_totalpwd_physical_male'];
    $leaderSeniorMale = $_POST['leader_senior_male'];
    $leaderSeniorFemale = $_POST['leader_senior_female'];
    $leaderBelow18Male = $_POST['leader_below_18_male'];
    $leaderBelow18Female = $_POST['leader_below_18_female'];
    $leaderRemarks = $_POST['leader_remarks'];

    // Insert the data into the 'tbl_leaders' table
    $stmt = $pdo->prepare("INSERT INTO tbl_leaders (leader_name, leader_position, leader_sex, leader_age, leader_barangay, leader_civilstatus, leader_num_family_members, leader_total_male, leader_total_female, leader_totalpwd_physical_female, leader_totalpwd_physical_male, leader_senior_male, leader_senior_female, leader_below_18_male, leader_below_18_female, leader_remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$leaderName, $leaderPosition, $leaderSex, $leaderAge, $leaderBarangay, $leaderCivilStatus, $leaderNumFamilyMembers, $leaderTotalMale, $leaderTotalFemale, $leaderTotalPWDFemale, $leaderTotalPWDPhysicalMale, $leaderSeniorMale, $leaderSeniorFemale, $leaderBelow18Male, $leaderBelow18Female, $leaderRemarks]);

    // Respond with a success message as JSON
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

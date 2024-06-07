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
    $householdLastName = $_POST['household_lastname'];
    $householdFirstName = $_POST['household_firstname'];
    $householdMiddleName = $_POST['household_middlename'];
    $householdSuffix = $_POST['household_suffix'];
    $householdBirthdate = $_POST['household_birthdate'];
    $householdAge = $_POST['household_age'];
    $householdSex = $_POST['household_sex'];
    $pregnant = $_POST['pregnant'];
    $lastPregnant = $_POST['last_preg'];
    $noChildren = $_POST['children'];
    $barangay = $_POST['household_barangay'];
    $educAttainment = $_POST['household_education'];
    $schoolGraduated = $_POST['household_school'];
    $incomeSource = $_POST['source'];
    $employment = $_POST['employment'];
    $householdLeader = $_POST['household_leader'];
    $leaderRelation = $_POST['household_relation'];
    $remarks = $_POST['household_remarks'];

    // Create a prepared statement
    $stmt = $pdo->prepare("INSERT INTO tbl_households(household_lastname, household_firstname, household_middlename, household_suffix, household_birthdate, household_age, household_sex, pregnant, last_preg, children, household_barangay, household_education, household_school, source, employment, household_leader, household_relation, household_remarks) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([$householdLastName, $householdFirstName, $householdMiddleName, $householdSuffix, $householdBirthdate, $householdAge, $householdSex, $pregnant, $lastPregnant, $noChildren, $barangay, $educAttainment, $schoolGraduated, $incomeSource, $employment, $householdLeader, $leaderRelation, $remarks]);
    // Respond with a success message as JSON
    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

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
    $crimeId = $_POST['crime_id'];
    $crimeViolation = $_POST['crime_violation'];
    $crimeDate = $_POST['crime_date'];
    $crimeVictim = $_POST['crime_victim'];
    $crimeViolator = $_POST['crime_perpetrator'];
    $crimeBarangay = $_POST['crime_barangay'];

    // Create a prepared statement for UPDATE
    $stmt = $pdo->prepare("UPDATE tbl_crime 
                        SET crime_violation = ?, 
                            crime_date = ?, 
                            crime_victim = ?, 
                            crime_perpetrator = ?, 
                            crime_barangay = ? 
                        WHERE crime_id = ?");
    $stmt->execute([$crimeViolation, $crimeDate, $crimeVictim, $crimeViolator, $crimeBarangay, $crimeId]);

    $response = array('message' => 'Data inserted successfully');
    echo json_encode($response);
} catch (PDOException $e) {
    // Handle any database connection errors here
    $response = array('message' => 'Failed to insert data: ' . $e->getMessage());
    echo json_encode($response);
}

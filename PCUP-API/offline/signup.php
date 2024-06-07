<?php
// Remove any HTML content or warnings
ob_clean();

$db_host = 'localhost';
$db_name = 'sql12657302';
$db_user = 'root';
$db_password = '';


try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get input data from the POST request
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_phone = $_POST['user_phone'];
        $user_fullname = $_POST['user_fullname'];

        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT COUNT(*) FROM tbl_users WHERE user_email = :user_email";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->execute();
        $emailCount = $stmt->fetchColumn();

        // Check if the username already exists in the database
        $checkUsernameQuery = "SELECT COUNT(*) FROM tbl_users WHERE user_name = :user_name";
        $stmt = $conn->prepare($checkUsernameQuery);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();
        $usernameCount = $stmt->fetchColumn();

        if ($emailCount == 0 && $usernameCount == 0) {
            // Email and username don't exist, insert a new record
            $insertQuery = "INSERT INTO tbl_users (user_name, user_password, user_fullname, user_email, user_phone, user_type, user_remarks) VALUES (:user_name, :user_password, :user_fullname, :user_email, :user_phone, 'CLIENT', 'NEW')";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_password', $user_password);
            $stmt->bindParam(':user_fullname', $user_fullname);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_phone', $user_phone);
            $stmt->execute();

            // Respond with a success message
            $response = array('status' => 'success', 'message' => 'User registered successfully');
        } else {
            // Email or username already exists, respond with an error message
            $response = array('status' => 'error', 'message' => 'Email or username already exists');
        }
    } else {
        // Invalid request method
        $response = array('status' => 'error', 'message' => 'Invalid request method');
    }
} catch (Exception $e) {
    $response = array('status' => 'error', 'message' => $e->getMessage());
}

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);

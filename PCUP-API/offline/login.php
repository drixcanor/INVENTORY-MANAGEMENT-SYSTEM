<?php
// Database connection details
$db_host = 'localhost';
$db_name = 'sql12657302';
$db_user = 'root';
$db_password = '';

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the user input
        $data = json_decode(file_get_contents("php://input"));

        // Check if both username and password are provided
        if (!isset($data->user_name) || !isset($data->user_password)) {
            http_response_code(400); // Bad Request
            echo json_encode(array("error" => "Both username and password are required."));
        } else {
            // Sanitize and validate the input (you should perform more rigorous validation)
            $user_name = $data->user_name;
            $user_password = $data->user_password;

            // Prepare and execute the SQL query
            $query = "SELECT user_id, user_name, user_email, user_phone, user_type, user_remarks FROM tbl_users WHERE user_name = :user_name AND user_password = :user_password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_password', $user_password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $userRemarks = $row['user_remarks'];

                if ($userRemarks === 'APPROVED') {
                    // User is approved; return user information
                    http_response_code(200);
                    echo json_encode($row);
                } else {
                    // User is not approved
                    http_response_code(401); // Unauthorized
                    echo json_encode(array("error" => "Login failed. User not approved."));
                }
            } else {
                // User not found
                http_response_code(401); // Unauthorized
                echo json_encode(array("error" => "Login failed. Invalid credentials."));
            }
        }
    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("error" => "Method not allowed."));
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(array("error" => "Database connection error: " . $e->getMessage()));
}

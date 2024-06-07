<?php
include_once "../config/dbconnect.php";

$userID = $_POST['user_id'];

$sql = "SELECT * FROM users_details_tbl WHERE user_id = $userID";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    echo "<h3>User Details:</h3>";
    echo "User ID: " . $user['user_id'] . "<br>";
    echo "Full Name: " . $user['full_name'] . "<br>";
    echo "Address: " . $user['address'] . "<br>";
    echo "Phone Number: " . $user['phone_number'] . "<br>";
} else {
    echo "User not found.";
}
?>

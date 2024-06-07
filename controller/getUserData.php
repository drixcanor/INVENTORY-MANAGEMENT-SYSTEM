<?php
    include_once "../config/dbconnect.php";

    $userID = $_POST['id'];

    $sql = "SELECT * FROM tbl_member WHERE id = $userID";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {

        echo '<input type="hidden" class="form-control" id="user_id" name="user_id" value="'.$user['id'].'" >';

        echo '<div class="form-group">
              <label for="full_name">Full Name:</label>
              <input type="text" class="form-control" id="full_name" name="full_name" value="'.$user['full_name'].'" required>
            </div>';
        echo '<div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" id="address" name="address" value="'.$user['address'].'" required>
            </div>';

        echo '<div class="form-group">
              <label for="phone_number">Phone Number:</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" value="'.$user['phone_number'].'" required>
            </div>';



    } else {
        echo "User not found.";
    }  
?>
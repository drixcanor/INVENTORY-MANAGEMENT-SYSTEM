<?php
   session_start();
   include_once "./config/dbconnect.php";
   if(!isset($_SESSION['user'])){
        header('Location:'.'./index.php');
    }
?>
<!doctype html>
<html>
<head>
  <title>User Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
 <style>
  /* CSS styles */
  .grid {
    display: grid;
    justify-content: center;
    padding: 10px;
  }

  .item {
    border: 1px solid #ccc;
    box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
    padding: 100px;
    margin: 100px;
/*    text-align: center;*/
  }

  .item h3 {
    margin-top: 10px;
  }

  .item p {
    margin-bottom: 10px;
  }

  .item a.details-button {
    position: relative;
    background: transparent;
    border: 1px solid black;
    color: gray;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    padding: 5px 10px;
    z-index: 1; /* Ensure the text is above the pseudo-element */
  }

  .item a.details-button::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 1px solid transparent;
    z-index: -1;
  }
  </style>
</head>
<body>
  <?php
    
    include "./userHeeader.php";
    include "./userSidebar.php";
    include_once "./config/dbconnect.php";
    
  ?>
  
  <main class="grid">
    <?php
    $server = "localhost";
    $user = "kenkarlo_test";
    $password = "yV8PKw#lt@Ya";
    $db = "kenkarlo_swiss_collection";
     
    
    // Create connection
    $conn = new mysqli($server, $user, $password, $db);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tbl_member WHERE username = '{$_SESSION['username']}'";

    $result = $conn->query($sql);
    if ($result) {
      while ($row = $result->fetch_assoc()) { 
        ?>
        <div class="item">
          <h3>Profile</h3>
          <p>NAME: <?= $row["full_name"] ?></p>
          <p>ADDRESS: <?= $row["address"] ?></p>
          <p>PHONE NUMBER: <?= $row["phone_number"] ?></p>

        </div>
        
        <?php
        }
        }
    // Close the database connection
    $conn->close();
    ?>

    <!-- <?php
      if (isset($_GET['category']) && $_GET['category'] == "success") {
        echo '<script> alert("Category Successfully Added")</script>';
      } else if (isset($_GET['category']) && $_GET['category'] == "error") {
        echo '<script> alert("Adding Unsuccess")</script>';
      }
      if (isset($_GET['size']) && $_GET['size'] == "success") {
        echo '<script> alert("Size Successfully Added")</script>';
      } else if (isset($_GET['size']) && $_GET['size'] == "error") {
        echo '<script> alert("Adding Unsuccess")</script>';
      }
      if (isset($_GET['variation']) && $_GET['variation'] == "success") {
        echo '<script> alert("Variation Successfully Added")</script>';
      } else if (isset($_GET['variation']) && $_GET['variation'] == "error") {
        echo '<script> alert("Adding Unsuccess")</script>';
      }
    ?> -->

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  function editProfile(userId) {
    // Redirect to the edit profile page with the user ID
    window.location.href = "edit-profile.php?user_id=" + userId;
  }
</script>
    <script>
      function viewDetails() {
        // Add your logic for the onclick function here
        console.log("View Details clicked");
      }
    </script>
  </main>
</body>
</html>

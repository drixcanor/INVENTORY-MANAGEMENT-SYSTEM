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
  <link rel="stylesheet" href="./assets/css/style.css"></link>
  <style>
  /* CSS styles */
  .grid {
    display: grid;
    height: center;
    grid-template-columns: 300px 300px 300px;
    justify-content: space-evenly;
    grid-gap: 100px;
    align-self: center;
    align-content: space-evenly;
    padding: 10px;
    align-items: stretch;
    justify-content: center;
  }

  .item {
    border: 1px solid #ccc;
    box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
    padding: 20px;
    margin: 10p;
    align-items: center;
    text-align: center;
    transition: transform 0.3s ease-in-out;
  }

  .item:hover {
    transform: scale(1.05);
  }

  .item img {
    max-width: 100%;
    width: 200px;
    height: 200px;
    margin-left: auto;
    margin-right: auto;
  }

  .item h3 {
    margin-top: 10px;
  }

  .item p {
    margin-bottom: 10px;
  }

  .item button {
    background: gray;
    border: 0;
    color: white;
    padding: 10px;
    width: 100%;
  }

  .item button:hover {
    background: white;
  }

  .item .details-button {
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

  .item .details-button:hover {
    background: white;
    color: black;
  }

  .item .details-button::before {
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

    $sql = "SELECT * FROM product, category WHERE product.category_id = category.category_id";
    $result = $conn->query($sql);
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        ?>
        <div class="item">
          <img class="center" src="<?=$row['product_image']?>" alt="Sample photo">
          <h3><?=$row['product_name']?></h3>
          <p>₱<?= $row["price"] ?></p>
          <a class="details-button" href="product-details.php?product_id=<?=$row['product_id']?>">View Details</a>
        </div>
        <?php
      }
    } else {
      echo "Error executing the SQL query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    ?>
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "102831229501755");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v17.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
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
      function viewDetails() {
        // Add your logic for the onclick function here
        console.log("View Details clicked");
      }
    </script>
  </main>
</body>
</html>

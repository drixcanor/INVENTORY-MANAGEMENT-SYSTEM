<!doctype html>
<html>
<head>
  <title>Product Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/style.css"></link>
  <style>
  /* CSS styles */
  .grid {
    display: grid;
    grid-template-columns: 1fr; /* Updated */
    justify-content: center; /* Updated */
    align-items: center; /* Updated */
    padding: 10px;
  }

  .item {
    border: 1px solid #ccc;
    box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
    padding: 20px;
    margin: 10p;
    align-items: center;
    text-align: center;
    transition: transform 0.3s ease-in-out;
    max-width: 500px; /* Added */
    margin-left: auto; /* Added */
    margin-right: auto; /* Added */
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
    color: black;
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
  
  // Retrieve the product ID from the URL parameter
  $product_id = $_GET['product_id'];

  // Create connection
  $conn = new mysqli($server, $user, $password, $db);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement with a placeholder for the product ID
  $sql = "SELECT * FROM product, category WHERE product.category_id = category.category_id AND product.product_id = ?";
  $stmt = $conn->prepare($sql);

  // Bind the product ID to the SQL statement
  $stmt->bind_param("i", $product_id);

  // Execute the query
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <div class="grid">
  <div class="item">
    <img class="center" src="<?= $row['product_image'] ?>" alt="Sample photo">
    <h3><?= $row['product_name'] ?></h3>
    <p>₱<?= $row["price"] ?></p>
    <p><?= $row["product_desc"] ?></p>
    <button class="order-button openPopup" data-toggle="modal" data-target="#orderModal" data-href="onfig/ordernow.php?product_id=<?= $row['product_id'] ?>">Order Now</button>
  </div>
</div>

<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="orderModalLabel">Process Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype='multipart/form-data' onsubmit="addItems()" method="POST">
          <div class="grid">
            <img class="item" src="<?= $row['product_image'] ?>" alt="Sample photo">
          </div>
          <div class="item">
            <label for="name">Product Name:</label>
            <h3><?= $row['product_name'] ?></h3>
          </div>
          <div class="item">
            <label for="price">Price:</label>
            <p>₱<?= $row["price"] ?></p>
          </div>
          <div class="item">
            <label for="variation">Stock Quantity:</label>
            <p>20</p>
          </div>
          <div class="item">
            <label for="product">Description:</label>
            <p><?= $row["product_desc"] ?></p>
          </div>
          <div class="item">
            <label>Color:</label>
            <?php
              $sql = "SELECT * FROM sizes";
              $result = $conn->query($sql);
              $count = 1;
              if ($result->num_rows > 0) {
                while ($sizeRow = $result->fetch_assoc()) {
            ?>
            <label>
              <input type="radio" name="size" value="<?= $sizeRow['size_id'] ?>">
              <?= $sizeRow["size_name"] ?>
            </label>
            <?php
                $count = $count + 1;
                }
              }
            ?>
          </div>
          <div class="item">
    <button type="submit" class="order-button openPopup" id="upload" style="height: 40px" onclick="openGoogleFormsInNewTab()">Proceed Now</button>
  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
      </div>
    </div>
  </div>
</div>

    <?php

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

  <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
  <script type="text/javascript" src="./assets/js/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
    $('.openPopup').on('click',function(){
      var dataURL = $(this).attr('data-href');
      $('#viewModal .modal-body').load(dataURL,function(){
        $('#viewModal').modal({show:true});
      });
    });

    $('.confirm-button').on('click', function() {
      var url = $(this).attr('data-href');
      window.location.href = url;
    });
  });
</script>
<script>
    function openGoogleFormsInNewTab() {
      window.open("https://docs.google.com/forms/d/1Ereh6fEdGkWWpcbSL8tp28YgY9RtgKQm5Fp96lZ9Ydw", "_blank");
    }
  </script>

</body>
</html>

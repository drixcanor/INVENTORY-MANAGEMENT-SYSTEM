<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['user_id']))
    {
        $user_id = $_POST['user_id'];
        $delivered_to = $_POST['full_name'];
        $phone_no = $_POST['phone_number'];
        $deliver_address = $_POST['address'];
        $pay_method = $_POST['p_method'];
        $pay_status = 0;
        $order_status = 0;
        $order_date = date('Y-m-d');

         $insert = mysqli_query($conn,"INSERT INTO order_tbl
         (user_id,delivered_to,phone_no, deliver_address, pay_method, pay_status,order_status, order_date) VALUES ('$user_id','$delivered_to','$phone_no','$deliver_address', '$pay_method', '$pay_status', '$order_status',' $order_date')");
 
         
         // if(!$insert)
         // {
         //     echo mysqli_error($conn);
         // }
         // else
         // {
         //     echo "Records added successfully.";
         // }
         if(!$insert)
         {
             header("Location: ../admin_dashboard.php?order=error");
         }
         else
         {
             header("Location: ../admin_dashboard.php?order=success");
         }
     
    }
    else{
        echo 'error';
    }
        
?>
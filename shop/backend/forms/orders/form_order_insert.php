
<?php ?>
<?php
//      // Connection with the server 
//     // MySQLie(Procedural) or PDO(Object Oriented)
//         // Server_domain, User, Password
//     $server_name = 'localhost';
//     echo $server_name;
//     $user_name = 'root';
//     $password = '';
//     $db_name = 'online_shop';

//     $conn = mysqli_connect($server_name,$user_name,$password,$db_name);
//     // Check Connection
//     if (!$conn){
//         echo 'Connection error:' . mysqli_connect_error();
//     }
?>
<!-- Connection -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php'); ?>

<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
     <h1>form_order_insert</h1>
    <form action="/student022/shop/backend/forms/db/order/db_order_insert.php" method="post">
       <label for="id_order">id order: 
            <input type="number" id="id_order" name="id_order">
       </label>
       <label for="id_order_line">id order line: 
            <input type="number" id="id_order_line" name="id_order_line">
       </label>
       <label for="id_order">id customer: 
            <input type="number" id="id_order" name="id_order">
       </label>
       <label for="id_payment_method">id payment method: 
            <input type="number" id="id_payment_method" name="id_payment_method">
       </label>
       <label for="id_address">Customer forename: 
            <input type="text" id="id_address" name="id_address">
       </label>
       <label for="discount_rate">Discount rate: 
            <input type="number" id="discount_rate" name="discount_rate">
       </label>
        <label for="total">Total: 
            <input type="number" id="total" name="total">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

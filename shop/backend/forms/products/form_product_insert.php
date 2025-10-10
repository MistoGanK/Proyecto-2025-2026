
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
     <h1>form_product_insert</h1>
    <form action="/student022/shop/backend/forms/db/product/db_product_insert.php" method="post">
       <label for="product_name">Product Name: 
            <input type="text" id="product_name" name="product_name">
       </label>
       <label for="product_price">Product Price:
            <input type="number" id="product_price" name="product_price">
       </label>
       <label for="product_qty">Product qty:
            <input type="nubmer" id="product_qty" name="product_qty">
       </label>
       <label for="product_description">Product description:
            <input type="text" id="product_description" name="product_description">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

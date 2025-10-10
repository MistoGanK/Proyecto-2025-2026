
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
     <h1>form_customer_insert</h1>
    <form action="/student022/shop/backend/forms/db/customer/db_customer_insert.php" method="post">
       <label for="customer_username">Customer username: 
            <input type="text" id="customer_username" name="customer_username">
       </label>
       <label for="customer_passwor">Customer password: 
            <input type="text" id="customer_passwor" name="customer_passwor">
       </label>
       <label for="customer_dni">Customer dni: 
            <input type="text" id="customer_dni" name="customer_dni">
       </label>
       <label for="customer_email">Customer email: 
            <input type="text" id="customer_email" name="customer_email">
       </label>
       <label for="customer_forename">Customer forename: 
            <input type="text" id="customer_forename" name="customer_forename">
       </label>
       <label for="customer_surname">Customer surname: 
            <input type="text" id="customer_surname" name="customer_surname">
       </label>
        <label for="customer_birth_date">Customer birth date: 
            <input type="date" id="customer_birth_date" name="customer_birth_date">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

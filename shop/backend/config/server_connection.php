<?php 
// SERVER

      // Connection with the server 
    // MySQLie(Procedural) or PDO(Object Oriented)
        // Server_domain, User, Password
    $server_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $db_name = 'online_shop';

    $conn = mysqli_connect($server_name,$user_name,$password,$db_name);
    // Check Connection
    if (!$conn){
        echo 'Connection error:' . mysqli_connect_error();
    }
?>
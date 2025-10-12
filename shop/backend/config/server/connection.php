<?php 
// remotehost.es
      // Connection with the server 
    // MySQLie(Procedural) or PDO(Object Oriented)
        // Server_domain, User, Password
    $server_name = 'dwes';
    $user_name = 'dwess1234';
    $password = 'Usertest1234..';
    $db_name = 'online_shop';

    $conn = mysqli_connect($server_name,$user_name,$password,$db_name);
    // Check Connection
    if (!$conn){
        echo 'Connection error:' . mysqli_connect_error();
    }
?>
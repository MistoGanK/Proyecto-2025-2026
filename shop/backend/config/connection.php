<?php
// LOCALHOST
// Connection with the server 
// MySQLie(Procedural) or PDO(Object Oriented)
// Server_domain, User, Password


$server_name = 'localhost';
$user_name = 'root';
$password = '';
$db_name = 'online_shop';

$conn = mysqli_connect($server_name, $user_name, $password, $db_name);
// Check Connection
if (!$conn) {
    echo 'Connection error:' . mysqli_connect_error();
}
// Actula charset
mysqli_character_set_name($conn);

// Change character set to utf8
mysqli_set_charset($conn, "utf8");

// Modyfied charset
mysqli_character_set_name($conn);



// Enrique SERVER

// Connection with the server 
// MySQLie(Procedural) or PDO(Object Oriented)

/*

$server_name = 'remotehost.es';
$user_name = 'dwess1234';
$password = 'Usertest1234.';
$db_name = 'dwesdatabase';

$conn = mysqli_connect($server_name, $user_name, $password, $db_name);

// Check Connection
if (!$conn) {
    echo 'Connection error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error();
}

// Actula charset
mysqli_character_set_name($conn);

// Change character set to utf8
mysqli_set_charset($conn,"utf8");

// Modyfied charset
mysqli_character_set_name($conn);

*/

/*

// noobhostadventurer-endinahosting-com.espacioseguro.com
// Connection with the server 
// MySQLie(Procedural) or PDO(Object Oriented)


$server_name = 'noobhostadventurer.endinahosting.com';
$user_name = 'noobhAdmin';
$password = 'B-BaRr0N2077!';
$db_name = 'noobh';

$conn = mysqli_connect($server_name, $user_name, $password, $db_name);

// Check Connection
if (!$conn) {
    echo 'Connection error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error();
}

// Actula charset
mysqli_character_set_name($conn);

// Change character set to utf8
mysqli_set_charset($conn,"utf8");

// Modyfied charset
mysqli_character_set_name($conn);

*/

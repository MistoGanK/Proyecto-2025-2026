<?php 
   // Abrimos la sesión 
    session_start();

    // Guardamo credenciales antes de logout
    $timeLogout = date("c",time());
    $routeFile = $_SERVER['DOCUMENT_ROOT'].'/student022/backend/logs/userLogs.txt';
    $file = fopen($routeFile,"a+");
    $txt = $username . ',' . $_SESSION['id_customer'] . ',' . $_SESSION['role'] . ',' . $timeLogout.','."Logout".',';
    fwrite($file,$txt);
    fclose($file);

    // Limpiamos las variables de la sesión
    session_unset();
    // Terminamos la sesión
    session_destroy();
    // Redirigimos a login.php
    header('Location: /student022/backend/autentification/login.php');
    // Cerramos
    exit();
?>
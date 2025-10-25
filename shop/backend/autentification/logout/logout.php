<?php 
    // Abrimos la sesión 
    session_start();
    // Limpiamos las variables de la sesión
    session_unset();
    // Terminamos la sesión
    session_destroy();
    // Redirigimos a login.php
    header('Location: /student022/shop/backend/autentification/login.php');
    // Cerramos
    exit();
?>
<!DOCTYPE html>
<html lang="en">

<?php
// Check is therere is a user logged 
session_start();
if (isset($_SESSION['username'])) {
    // --- Debug ----
    // $user = isset($_SESSION["username"]) ? 'Usuario logeado: '.$_SESSION['username'] : "No hay usuario";
    // echo $user;

    //  Si devuelve TRUE lo redirigimos al admin panel
    header('Location: /student022/shop/backend/admin_panel.php');
    die();
} else {
    // Si es false, procedemos a hacer el resto del cogio PHP

    // Comprovamos que el usuario haya hecho el submit al form

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Guardamos sus variables del login asegurando primero las entradas
        $username = isset($_POST['customer_username']) ? $_POST['customer_username'] : '';
        $password = isset($_POST['customer_user_password']) ? $_POST['customer_user_password'] : '';

        // Preparamos la query
        $query = "
                SELECT 
                    *
                FROM 
                    `022_customers`
                WHERE 
                    username = '$username'
                    AND
                    user_password = '$password'
            ;";
        // Abrimos la conexion 
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
        // Comprovamos si la query ha sido ejecutada  correctamente+
        if (!mysqli_query($conn, $query)) {
            // Guardamos y presentamos el error en pantalla
            print_r(mysqli_error($conn));
        } else {

            // Comrprovamos si los datos de usuario coinciden en nuestra base de datos
            $queryResult = mysqli_query($conn, $query);
            if (mysqli_num_rows($queryResult) !== 1) {
                echo 'Incorrecto Usuario o Contraseña';
                $_SESSION['role'] = 'Guest';
            } else {
                // Guardamos la autentificación del usuario en nuestra superglobal season
                $assocResult = mysqli_fetch_assoc($queryResult);

                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['id_customer'] = $assocResult['id_customer'];
                $_SESSION['role'] = $assocResult['role'];

                // Redirigimos a adminPanel
                header('Location: /student022/shop/backend/admin_panel.php');
                exit();
            }
        }
    }
}
?>

<head>
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
</head>

<body class="flex flex-row min-h-screen w-full p-10 justify-center items-center
bg-[#FEFFFE] text-[#0A090C] antialiased">

    <main class="flex flex-col w-full max-w-xl h-fit p-8 items-center gap-5
    bg-white shadow-xl rounded-lg border border-gray-200">
        <h1 class="w-fit text-3xl font-extrabold mb-5">Login</h1>
        <form class="flex flex-col w-full h-fit gap-2 p-2" method="POST" action="#">

            <label for="customer_username" class="w-fit text-xl font-bold">Username</label>
            <input id="customer_username" type="text" name="customer_username" placeholder="Type your username"
                class="w-full h-11 p-2 mb-5
            shadow-lg border border-gray-300/30 rounded-lg
            text-gray-500/80">

            <label for="customer_user_password" class="w-fit text-xl font-bold">Password</label>
            <input id="customer_user_password" type="password" name="customer_user_password" placeholder="Type your password"
                class="w-full h-11 p-2 mb-5
            shadow-lg border border-gray-300/30 rounded-lg
            text-gray-500/80">

            <input type="submit" value="Login"
                class="h-full w-full p-3
            bg-[#0A090C] text-[#FEFFFE] rounded-xl font-bold text-lg
            hover:cursor-pointer
            hover:bg-[#2c2732]">

            <div class="flex gap-2 w-full justify-center mt-3">
                <p class="w-fit">Don't have an account?</p>
                <a class="w-fit font-bold" href="/student022/shop/backend/autentification/register.php">Sign Up</a>
            </div>

        </form>
        <div>

        </div>
    </main>
</body>

</html>
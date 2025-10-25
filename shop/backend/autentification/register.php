<?php
// Iniciamos la sesión
session_start();
// Primero comprovamos si ya esta logeado el usuario
if (isset($_SESSION['username'])) {
    // Si es TRUE redirigimos a admin_panel
    header('Location: /student022/shop/backend/admin_panel');
    exit();
} else {
    // Si es FALSE procedemos al resto del codigo PHP

    // Comprovamos que se haya enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Comprovamos con la función boleana iset si se ha insertado correctamente
        $username = isset($_POST['customer_username']) ? $_POST['customer_username'] : '';
        $password = isset($_POST['customer_user_password']) ? $_POST['customer_user_password'] : '';
        $email = isset($_POST['customer_email']) ? $_POST['customer_email'] : '';

        // Cramos la query de comprovación
        $query  =
            "
        SELECT 
            username,
            user_password
        FROM 
            `022_customers`
        WHERE
            username = '$username'
            OR
            email = '$email'
        ;";

        // Abrimos la conexión
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

        // Ejecutamos la query

        if (!mysqli_query($conn, $query)) {
            printf(mysqli_error($conn));
        } else {
            $queryResult = mysqli_query($conn, $query);
            // Comprovamos si ha encontrado credenciales existentes
            if (mysqli_num_rows($queryResult) > 0) {
                // Mostramos el error
                echo 'error, credenciales existentes';
            } else {
                // Insertamos nuestro neuvo cliente y guardamos sus credenciales para el session
                $queryInsert = "
            INSERT INTO `022_customers` (username,user_password,email)
            VALUES ('$username','$password','$email')
            ;";

                $queryResulInsert = mysqli_query($conn, $queryInsert);

                // Finished all the querys whe close the connection with the db
                mysqli_close($conn);

                // We save the username and user password with session super global
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_SESSION["email"] = $email;

                // Debug
                // print_r($_SESSION);

                // Redirect to admin panel afther registered 
                header('Location: /student022/shop/backend/admin_panel.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
</head>

<body class="flex flex-row min-h-screen w-full p-10 justify-center items-center
bg-[#FEFFFE] text-[#0A090C] antialiased">

    <main class="flex flex-col w-full max-w-xl h-fit p-8 items-center gap-5
    bg-white shadow-xl rounded-lg border border-gray-200">
        <h1 class="w-fit text-3xl font-extrabold mb-5">Register</h1>
        <form class="flex flex-col w-full h-fit gap-2 p-2" method="POST" action="/student022/shop/backend/autentification/register.php">

            <label for="customer_email" class="w-fit text-xl font-bold">Email</label>
            <input id="customer_email" type="email" name="customer_email" placeholder="Type your email"
                class="w-full h-11 p-2 mb-5
            shadow-lg border border-gray-300/30 rounded-lg
            text-gray-500/80">

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

            <label for="rePassword" class="w-fit text-xl font-bold">Confirm Password</label>
            <input id="rePassword" type="password" name="rePassword" placeholder="Retype your password"
                class="w-full h-11 p-2 mb-5
            shadow-lg border border-gray-300/30 rounded-lg
            text-gray-500/80">

            <input type="submit" value="Sign Up"
                class="h-full w-full p-3
            bg-[#0A090C] text-[#FEFFFE] rounded-xl font-bold text-lg
            hover:cursor-pointer
            hover:bg-[#2c2732]">

            <div class="flex gap-2 w-full justify-center mt-3">
                <p class="w-fit">Already have an account?</p>
                <a class="w-fit font-bold" href="/student022/shop/backend/autentification/login.php">Sign In</a>
            </div>

        </form>
        <div>

        </div>
    </main>
</body>

</html>
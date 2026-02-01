<?php session_start();
$role = $_SESSION['role'] ?? 'Guest';
$username = $_SESSION['username'] ?? 'Guest';
$root = $_SERVER['DOCUMENT_ROOT'];
?>
<script>
    function closeAndRedirectLogin() {
        window.location.href = "/student022/backend/autentification/logout/logout.php";
    };

    function redirectLogin() {
        window.location.href = "/student022/backend/autentification/login.php";
    };
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="charts.css">
    <link rel="icon" href="/student022/backend/assets/icons/faviconBlack.png" type="image/png">
</head>

<body class="flex flex-row min-h-screen w-full bg-[#FEFFFE] text-[#0A090C] antialiased">
    <header class="flex flex-col h-screen w-60 shrink-0 bg-[#0A090C]">
        <nav class="flex flex-col w-full h-full text-[#FEFFFE]">
            <div class="flex flex-row w-full h-20 border-b border-gray-600/50">
                <div class="flex w-30 h-full">
                    <a class="flex justify-center items-center p-2 cursor-pointer" href="/student022/backend/admin_panel.php">
                        <img class="h-15" src="/student022/backend/assets/icons/brand2BlackWhite.png">
                    </a>
                </div>
                <div class="flex w-full h-full justify-start items-center">
                    <h1 class="font-sans font-bold text-xl antialiased">Admin Panel</h1>
                </div>
            </div>

            <div class="flex fle-col p-3 pt-10">
                <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                    <a href="/student022/backend/stadistics/stadistic.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Charts</a>
                </div>
            </div>

            <div class="flex fle-col p-3 pt-10">
                <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                    <a href="/student022/backend/products/products.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Products</a>
                </div>
            </div>

            <?php
            // Customer Sidebar
            if ($role == 'Admin') {
                echo '
                    <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                        <a href="/student022/backend/customers/customers.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Customers</a>
                    </div>';
            }

            // Orders Sidebar
            if ($role !== 'Guest') {
                echo '
                    <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                        <a href="/student022/backend/orders/orders.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Orders</a>
                    </div>';
            }
            ?>
            </div>

            <form  action="/student022/backend/language/set_language.php" method="POST" class="p-3">
                <div class="flex w-full justify-center items-center">
                    <?php
                    $languages = ['es' => 'Español', 'en' => 'English', 'fr' => 'Français', 'zh' => '中国'];
                    $current_lang = $_COOKIE['user_lang'] ?? 'en';
                    ?>
                    <select name="language" onchange="this.form.submit()" class="w-full h-10 p-2 rounded bg-white text-gray-800 text-sm font-medium hover:cursor-pointer">
                        <?php
                        foreach ($languages as $code => $name) {
                            $selected = ($code === $current_lang) ? 'selected' : '';
                            echo "<option value=\"{$code}\" {$selected}>{$name}</option>";
                        }
                        ?>
                    </select>
                </div>
            </form>
        </nav>
    </header>

    <main class="flex flex-col flex-grow overflow-y-auto">
        <nav class="flex w-full h-19 shadow-md items-center px-6">
            <form action="#" method="GET" class="flex items-center w-110">
                <input type="search" placeholder="Search..." class="w-full h-10 p-3 text-gray-500 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-black/20">
            </form>

            <div class="flex flex-row w-full items-center justify-end gap-4">
                <p class="font-semibold">Welcome: <?php echo $username; ?> | Role: <?php echo $role; ?></p>

                <?php
                // Iconos Login/Logout con rutas corregidas
                if (isset($_SESSION['username'])) {
                    echo '<img src="/student022/backend/assets/icons/door_open_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png" 
                          onclick="closeAndRedirectLogin()" class="h-10 p-2 shadow-sm rounded-full hover:bg-gray-100 cursor-pointer" title="Logout">';
                } else {
                    echo '<img src="/student022/backend/assets/icons/account_circle_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png" 
                          onclick="redirectLogin()" class="h-10 p-2 shadow-sm rounded-full hover:bg-gray-100 cursor-pointer" title="Login">';
                }
                ?>

                <a href="/student022/backend/shopping_cart/shopping_cart.php">
                    <img src="/student022/backend/assets/icons/shopping_cart_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png"
                        class="h-10 p-2 shadow-sm rounded-full hover:bg-gray-100 cursor-pointer" title="Cart">
                </a>
            </div>
        </nav>
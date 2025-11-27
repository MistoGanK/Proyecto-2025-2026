<?php session_start();
$role = $_SESSION['role'] ??  $_SESSION['role'] = 'Guest';
$username = $_SESSION['username'] ?? $_SESSION['username'] = 'Guest';
$root = $_SERVER['DOCUMENT_ROOT'];
?>
<script>
    function closeAndRedirectLogin() {
        // Redirect en del logoutf
        window.location.href = "/student022/shop/backend/autentification/logout/logout.php";
    };

    function redirectLogin() {
        window.location.href = "/student022/shop/backend/autentification/login.php";
    };
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
</head>

<body class="flex flex-row min-h-screen w-full bg-[#FEFFFE] text-[#0A090C] antialiased">
    <header class="flex flex-col h-100% w-60 shrink-0 bg-[#0A090C]">
        <nav class="flex flex-col w-full h-full text-[#FEFFFE]">
            <div class="flex flex-row w-full h-20 border-b border-gray-600/50">
                <div class="flex w-30 h-full">
                    <a class="flex justify-center items-center 
                    p-2 cursor-pointer" href="/student022/shop/backend/index.php"><img class="h-15" src="/student022/shop/backend/assets/icons/brand2BlackWhite.png"></a>
                </div>
                <div class="flex w-full h-full justify-start items-center">
                    <h1 class="font-sans font-bold text-xl  antialiased ">Admin Panel</h1>
                </div>
            </div>
            <div class="flex flex-col w-full h-full p-3 pt-10">
                <?php
                // Product Sidebar
                echo '
                <div class="flex flex-col w-full h-full p-3 pt-10">
                <div class="flex justify-start items-center w-full h-10 mb-3
                    hover:text-[#ffffff]
                    hover:rounded-md
                    hover:bg-gray-800/40
                    cursor-pointer">
                    <a href="/student022/shop/backend/products/products.php"
                        class="flex justify-start items-center w-full h-full p-3
                        font-sans font-semibold">Products</a>
                </div>

                ';
                // Customer Sidebar
                if ($_SESSION['role'] =='Admin') {
                    echo '
                        <div class="flex justify-start items-center w-full h-10 mb-3
                            hover:text-[#ffffff]
                            hover:rounded-md
                            hover:bg-gray-800/40
                            cursor-pointer">
                    
                        <a href="/student022/shop/backend/customers/customers.php"
                            class="flex justify-start items-center w-full h-full p-3
                        font-sans font-semibold">Customers</a>
                        </div> ';
                };
                // Orders Sidebar
                if ($_SESSION['role']!=='Guest' || !isset($_SESSION['role'])){
                    echo '
                        <div class="flex justify-start items-center w-full h-10 mb-3
                            hover:text-[#ffffff]
                            hover:rounded-md
                            hover:bg-gray-800/40
                        cursor-pointer">
                        <a href="/student022/shop/backend/orders/orders.php"
                            class="flex justify-start items-center w-full h-full p-3
                        font-sans font-semibold">Orders</a>
                    </div>';
                }
                ?>
            </div>
            </div>
        </nav>
    </header>
    </nav>
    <main class="flex flex-col flex-grow overflow-y-auto">
        <nav class="flex w-full h-19 shadow-md">
            <form action="#" method="GET" class="flex justify-center items-center p-3 w-110 min-w-50">
                <input type="search"
                    id="input_search"
                    class="w-full h-10 p-3
                    text-gray-500/80
                    border 
                    border-gray-500/40 
                    rounded-xl
                    focus:outline-none
                    focus:border-[#0A090C] 
                    focus:ring 
                    focus:ring-[#0A090C]/50" onkeyup="searchProduct(this.value)">
            </form>
            <div class="flex flex-row w-full h-full items-center justify-end">
                <div class="flex w-fit h-full justify-end items-center gap-3">
                    <p class="flex justfity-center items-center
                    text-[#0A090C]
                    font-semibold
                    font-sans
                    ">Welcome: <?php print_r($username); ?> Role: <?php print_r($_SESSION['role']); ?></p>
                    <?php
                    // --- Icono Log in / Log out
                    // Si hay usuario logeado
                    if (isset($_SESSION['username'])) {
                        echo '
                    <img src="/student022/shop/backend/assets/icons/door_open_500dp_0A090C_FILL0_wght400_GRAD0_opsz48" alt="logout" title="logout"
                    class="h-13
                    p-2
                    shadow-sm
                    rounded-3xl
                    hover:cursor-pointer
                    hover:opacity-70
                    "
                    onclick="closeAndRedirectLogin()"
                    >';
                    } else {
                        // Si no hay usuario logeado
                        echo '
                    <img src="/student022/shop/backend/assets/icons/account_circle_500dp_0A090C_FILL0_wght400_GRAD0_opsz48" alt="log_in" title="Log in"
                    class="h-13
                    p-2
                    shadow-sm
                    rounded-3xl
                    hover:cursor-pointer
                    hover:opacity-70
                    "
                    onclick="redirectLogin()"
                    >';
                    }
                    ?>
                </div>
                <?php
                // Show shopping cart only to guest & customers
                if (isset($_SESSION['role']) || $_SESSION['role'] == 'Customer' || $_SESSION['role'] == 'guest') {
                    echo '
                    <a href="/student022/shop/backend/shopping_cart/shopping_cart.php">
                        <div class="flex w-fit h-full justify-end items-center gap-3">
                        <img src="/student022/shop/backend/assets/icons/shopping_cart_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png" alt="shopping_cart" title="shopping cart"
                        class="h-13
                        p-2
                        shadow-sm
                        rounded-3xl
                        hover:cursor-pointer
                        hover:opacity-70
                        ">
                    </div>
                    </a>
                    ';
                }
                ?>
            </div>
        </nav>
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
            <div class="flex flex-row w-full h-20 border-b border-gray-600/50 shrink-0">
                <div class="flex w-30 h-full">
                    <a class="flex justify-center items-center p-2 cursor-pointer" href="/student022/backend/admin_panel.php">
                        <img class="h-15" src="/student022/assets/icons/brand2WhiteBlackMark.png">
                    </a>
                </div>
                <div class="flex w-full h-full justify-start items-center">
                    <h1 class="font-sans font-bold text-xl antialiased">Admin Panel</h1>
                </div>
            </div>

            <div class="flex flex-col flex-grow overflow-y-auto">
                <div class="flex flex-col p-3 pt-10">
                    <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                        <a href="/student022/backend/stadistics/stadistic.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Charts</a>
                    </div>
                </div>

                <div class="flex flex-col p-3">
                    <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                        <a href="/student022/backend/products/products.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Products</a>
                    </div>
                </div>

                <?php
                if ($role == 'Admin') {
                    echo '
                    <div class="flex flex-col p-3">
                        <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                            <a href="/student022/backend/customers/customers.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Customers</a>
                        </div>
                    </div>';
                }

                if ($role !== 'Guest') {
                    echo '
                    <div class="flex flex-col p-3">
                        <div class="flex justify-start items-center w-full h-10 mb-3 hover:text-white hover:rounded-md hover:bg-gray-800/40 cursor-pointer">
                            <a href="/student022/backend/orders/orders.php" class="flex justify-start items-center w-full h-full p-3 font-sans font-semibold">Orders</a>
                        </div>
                    </div>';
                }
                ?>
            </div>

            <form action="/student022/backend/language/set_language.php" method="POST" class="p-3 mt-auto shrink-0 border-t border-gray-600/30">
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
        <nav class="sticky top-0 z-10 bg-[#FEFFFE] flex w-full h-24 shadow-md items-center px-6 shrink-0 gap-8">
    <form id="formFilter" action="#" method="GET" class="flex items-center w-3/4 gap-4">
        
        <div class="relative flex-1">
            <input type="search" placeholder="Search products..." 
                class="w-full h-10 pl-4 pr-3 text-sm text-gray-500 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-black/10 transition-all">
        </div>

        <div class="flex items-center gap-3">
            <label for="filterDateIn" class="text-[11px] uppercase tracking-tighter text-gray-400 font-bold flex flex-col">
                Date In
                <input id="filterDateIn" type="date" class="border border-gray-200 rounded-lg p-1 text-xs font-normal text-gray-600 focus:ring-1 focus:ring-black">
            </label>

            <label for="filterDateOut" class="text-[11px] uppercase tracking-tighter text-gray-400 font-bold flex flex-col">
                Date Out
                <input id="filterDateOut" type="date" class="border border-gray-200 rounded-lg p-1 text-xs font-normal text-gray-600 focus:ring-1 focus:ring-black">
            </label>
        </div>

        <label for="filterOrder" class="text-[11px] uppercase tracking-tighter text-gray-400 font-bold flex flex-col">
            Order By
            <select id="filterOrder" name="orderBy" class="bg-transparent border-none text-xs font-bold text-gray-800 cursor-pointer focus:ring-0">
                <option selected value="ASC">Newer</option>
                <option value="DESC">Older</option>
            </select>
        </label>

        <input type="submit" value="Filter"
            class="h-10 px-6 font-bold text-xs uppercase tracking-widest text-white bg-black rounded-full cursor-pointer hover:bg-gray-800 transition-colors shadow-lg shadow-black/10">
    </form>

    <div class="flex flex-row w-1/4 items-center justify-end gap-4 border-l border-gray-100 pl-4">
        <div class="text-right hidden lg:block">
            <p class="text-[10px] text-gray-400 uppercase font-bold leading-none">Logged in as</p>
            <p class="text-sm font-semibold text-gray-800"><?php echo $username; ?></p>
        </div>

        <div class="flex gap-2">
            <?php
            if (isset($_SESSION['username'])) {
                echo '<img src="/student022/assets/icons/door_open_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png" 
                  onclick="closeAndRedirectLogin()" class="h-9 w-9 p-2 border border-gray-100 rounded-full hover:bg-red-50 hover:border-red-100 transition-all cursor-pointer" title="Logout">';
            } else {
                echo '<img src="/student022/assets/icons/account_circle_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png" 
                  onclick="redirectLogin()" class="h-9 w-9 p-2 border border-gray-100 rounded-full hover:bg-gray-100 cursor-pointer" title="Login">';
            }
            ?>

            <a href="/student022/backend/shopping_cart/shopping_cart.php" class="relative">
                <img src="/student022/assets/icons/shopping_cart_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.png"
                    class="h-9 w-9 p-2 border border-gray-100 rounded-full hover:bg-gray-100 transition-all cursor-pointer" title="Cart">
                <span class="absolute -top-1 -right-1 bg-black text-white text-[9px] w-4 h-4 flex items-center justify-center rounded-full">0</span>
            </a>
        </div>
    </div>
</nav>
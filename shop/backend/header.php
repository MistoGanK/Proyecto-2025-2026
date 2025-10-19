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
                <div class="flex justify-start items-center w-full h-10 mb-3
                    hover:text-[#ffffff]
                    hover:rounded-md
                    hover:bg-gray-800/40
                    cursor-pointer">
                    <a href="/student022/shop/backend/products/products.php"
                        class="flex justify-start items-center w-full h-full p-3
                         font-sans font-semibold">Products</a>
                </div>
                 <div class="flex justify-start items-center w-full h-10 mb-3
                    hover:text-[#ffffff]
                    hover:rounded-md
                    hover:bg-gray-800/40
                    cursor-pointer">
                    <a href="/student022/shop/backend/products/db/db_products_select.php"
                        class="flex justify-start items-center w-full h-full p-3
                         font-sans font-semibold">Customers</a>
                </div>
                 <div class="flex justify-start items-center w-full h-10 mb-3
                    hover:text-[#ffffff]
                    hover:rounded-md
                    hover:bg-gray-800/40
                    cursor-pointer">
                    <a href="/student022/shop/backend/products/db/db_products_select.php"
                        class="flex justify-start items-center w-full h-full p-3
                         font-sans font-semibold">Orders</a>
                </div>
            </div>
        </nav>
    </header>
    </nav>    
    <main class="flex flex-col flex-grow overflow-y-auto">
        <nav class="flex w-full h-19
            shadow-md">
            <form action="#" method="GET"
                class="flex justify-center items-center p-3 w-110 min-w-50">
                <input type="search" id="input_search" value="search..."
                    class="w-full h-10 p-3
                    text-gray-500/80
                    border border-gray-500/40 rounded-xl
                    focus:outline-none">
            </form>
        </nav>
      

  
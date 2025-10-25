<!-- Landing page Backend -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
</head>

<body class="flex flex-col w-screen h-screen bg-[#FEFFFE] p-10">
    <main class="flex flex-col justify-center items-center p-3 
        h-full w-full">
        <section class="flex gap-10 flex-col justify-center items-center p-10 
            shadow-xl border border-gray-400/20 rounded-xl h-fit w-xl">
            <header class=" p-5 rounded-xl ">
                <h1 class=" font-bold flex text-3xl">Admin Panel</h1>
            </header>
            <div class="items-center w-full text-white p-3
                bg-[#0A090C]
                rounded-2xl
                hover:cursor-pointer
                hover:bg-[#2c2732]
                ">
                <a class="flex text-xl font-bold  p-1.5 w-full justify-center  items-center"
                    href="/student022/shop/backend/autentification/login.php" title="Go to Backend">Login</a>
            </div>
            <div class="items-center w-full text-white p-3
                bg-[#0A090C]
                rounded-2xl
                hover:cursor-pointer
                hover:bg-[#2c2732]
                ">
                <a class="flex text-xl font-bold  p-1.5 w-full justify-center  items-center"
                    href="/student022/shop/backend/autentification/register.php" title="Go to frontend">Register</a>
            </div>
    </main>
    </section>
</body>
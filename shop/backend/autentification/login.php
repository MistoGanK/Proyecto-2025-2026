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
        <h1 class="w-fit text-3xl font-extrabold mb-5">Login</h1>
        <form class="flex flex-col w-full h-fit gap-2 p-2" method="GET" action="#">

            <label for="username" class="w-fit text-xl font-bold">Username</label>
            <input id="username" type="text" name="username" placeholder="Type your username"
            class="w-full h-11 p-2 mb-5
            shadow-lg border border-gray-300/30 rounded-lg
            text-gray-500/80">

            <label for="password" class="w-fit text-xl font-bold">Password</label>
            <input id="password" type="password" name="password" placeholder="Type your password"
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
                <a class="w-fit font-bold" href="/student022/shop/backend/index.php">Sign Up</a>
            </div>

        </form>
        <div>

        </div>
    </main>
</body>

</html>
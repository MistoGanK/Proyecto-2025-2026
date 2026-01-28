<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 h-fit">
    
    <div class="w-full h-fit max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Insert New Customer</h1>
        
        <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/customer/db_customer_insert.php" method="post">

            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_username">
                Customer username: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="customer_username" 
                    name="customer_username">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_user_password">
                Customer password: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="password" 
                    id="customer_user_password" 
                    name="customer_user_password">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_dni">
                Customer DNI: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="customer_dni" 
                    name="customer_dni">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_email">
                Customer email: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="email" 
                    id="customer_email" 
                    name="customer_email">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_forename">
                Customer forename: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="customer_forename" 
                    name="customer_forename">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_surname">
                Customer surname: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="customer_surname" 
                    name="customer_surname">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_birth_date">
                Customer birth date: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="date" 
                    id="customer_birth_date" 
                    name="customer_birth_date">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_registered">
                Is Registered? (1=Yes, 0=No): 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="customer_registered" 
                    name="customer_registered" 
                    value="1" min="0" max="1">
            </label>

            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_active">
                Is Active? (1=Yes, 0=No): 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="customer_active" 
                    name="customer_active" 
                    value="1" min="0" max="1">
            </label>

            <input type="hidden" name="customer_creation_date" value="">
            <input type="hidden" name="customer_updated_date" value="">
            
            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit:
                <input class="p-3 bg-[#0A090C] mt-3 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150" 
                    type="submit" 
                    id="send" 
                    name="send"
                    value="Insert Customer">
            </label>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
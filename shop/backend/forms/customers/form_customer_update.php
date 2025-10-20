<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8  min-h-screen">
    
    <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Update Customer Information</h1>
        
        <?php
        // Variables definition that we will capture later
        $customer_username = "";
        $customer_password = "";
        $customer_dni = "";
        $customer_email = "";
        $customer_forename = "";
        $customer_surname = "";
        $customer_birth_date = "";
        $customer_registered = 0;
        $customer_active = 1;
        $id_customer = null; 
        $update_output = "";
        
        if (!isset($_POST['id_customer']) || empty($_POST['id_customer'])) {
            $update_output = "ERROR: id_customer is missing";
        } else {
            // Open connection
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

            // Escape input to avoid SQL injection
            $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
            
            // Query 
            $query = "SELECT * FROM customers WHERE id_customer = $id_customer;";
            
            // Execute and save the query
            $query_result = mysqli_query($conn,$query);

            // Check if the query is correct
            if($query_result){
                // Check if the id_customer returns any rows
                if (mysqli_num_rows($query_result)>0){
                    // Save the query result to the variables
                    $row = mysqli_fetch_assoc($query_result);
                    $customer_username = $row['username'];
                    $customer_password = $row['user_password'];
                    $customer_dni = $row['dni'];
                    $customer_email = $row['email'];
                    $customer_forename = $row['forename'];
                    $customer_surname = $row['surname'];
                    $customer_birth_date = $row['birth_date'];
                    $customer_registered = $row['registered'];
                    $customer_active = $row['active'];

                }else{
                    $update_output = "ERROR: id_customer not found on the database";
                }
            }else{
                $update_output = "Error: Database error " . mysqli_error($conn);
            }
            mysqli_close($conn);
        }

        // Mostrar errores de consulta o ID faltante
        if (!empty($update_output) && strpos($update_output, 'ERROR') !== false) {
             echo "<p class='text-red-500 font-bold mb-4'>" . $update_output . "</p>";
        }
        ?>

        <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/customer/db_customer_update.php" method="post">
            
            <input type="hidden" id="id_customer" name="id_customer" value="<?php echo $id_customer ?>">
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_username">
                Username:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       id="customer_username" 
                       name="customer_username" 
                       value="<?php echo $customer_username ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_password">
                Password (Do Not Change Unless Needed):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="password" 
                       id="customer_password" 
                       name="customer_user_password" 
                       value="<?php echo $customer_password ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_dni">
                National ID (DNI/Passport):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       id="customer_dni" 
                       name="customer_dni" 
                       value="<?php echo $customer_dni ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_email">
                Email Address:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="email" 
                       id="customer_email" 
                       name="customer_email" 
                       value="<?php echo $customer_email ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_forename">
                First Name:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       id="customer_forename" 
                       name="customer_forename" 
                       value="<?php echo $customer_forename ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_surname">
                Last Name:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       id="customer_surname" 
                       name="customer_surname" 
                       value="<?php echo $customer_surname ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_birth_date">
                Birth Date (YYYY-MM-DD):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="date" 
                       id="customer_birth_date" 
                       name="customer_birth_date" 
                       value="<?php echo $customer_birth_date?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_registered">
                Is Registered (1=Yes, 0=No):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       name="customer_registered" 
                       min="0" max="1" 
                       value="<?php echo $customer_registered?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="customer_active">
                Is Active (1=Yes, 0=No):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       name="customer_active" 
                       min="0" max="1" 
                       value="<?php echo $customer_active?>">
            </label>

            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit Changes:
                <input class="p-3 bg-[#0A090C] mt-3 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150" 
                       type="submit" 
                       id="send" 
                       name="send" 
                       value="Update Customer">
            </label>
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
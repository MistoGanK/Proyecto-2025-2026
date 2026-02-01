<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Customer Update Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // 1. Inicialización de variables de estado con valores de ERROR por defecto
        $id_customer = null;
        $update_output = "ERROR: id_customer is missing or data not submitted correctly."; 
        $message_class = "bg-red-100 border-red-500 text-red-700"; 
        
        // Check if POST its retrieved and if it has content 
        if (isset($_POST['id_customer']) && !empty($_POST['id_customer'])) {
            
            // Open connection
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
            
            // Save the variables and escape input
            $id_customer = mysqli_escape_string($conn, $_POST['id_customer']);
            $customer_username = mysqli_escape_string($conn,$_POST['customer_username']);
            $customer_user_password = mysqli_escape_string($conn,$_POST['customer_user_password']);
            $customer_dni = mysqli_escape_string($conn,$_POST['customer_dni']);
            $customer_email = mysqli_escape_string($conn,$_POST['customer_email']);
            $customer_forename = mysqli_escape_string($conn,$_POST['customer_forename']);
            $customer_surname = mysqli_escape_string($conn,$_POST['customer_surname']);
            $customer_birth_date = mysqli_escape_string($conn,$_POST['customer_birth_date']);
            $customer_registered = mysqli_escape_string($conn,$_POST['customer_registered']);
            $customer_active = mysqli_escape_string($conn,$_POST['customer_active']);
            
            // Query
            $sql = 
            "UPDATE `022_customers`
            SET
                username = '$customer_username',
                user_password = '$customer_user_password',
                dni = '$customer_dni',
                email = '$customer_email',
                forename = '$customer_forename',
                surname = '$customer_surname',
                updated_date = CURRENT_TIMESTAMP(),
                birth_date = '$customer_birth_date',
                registered = '$customer_registered',
                active = $customer_active
                
            WHERE id_customer = $id_customer
            ;";
        
            // Execute the query 
            $query_result = mysqli_query($conn, $sql);
            
            if ($query_result) {
                // Mensaje de éxito
                $update_output = "Records Successfully updated for Customer ID: " . $id_customer;
                $message_class = "bg-green-100 border-green-500 text-green-700";
            } else {
                // Mensaje de error de Base de Datos
                $update_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }
            
            // Close the connection
            mysqli_close($conn);
        }

        // 2. Mostrar el resultado con el estilo correspondiente (éxito o error)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4'>" . 
               "<p class='font-bold'>%s</p>" . 
               "</div>", $message_class, $update_output);
        
        // 3. Mensaje final con el ID, solo si se procesó un ID
        if ($id_customer) {
            echo "<p class='mt-6 text-sm text-gray-500'>Attempted to process customer with ID: <span class='font-bold text-[#0A090C]'>" . $id_customer . "</span></p>";
        }
        
        ?>

        <div class="mt-8">
             <a href="/student022/backend/customers/customers.php" 
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                 View Customers
             </a>
        </div>
        
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
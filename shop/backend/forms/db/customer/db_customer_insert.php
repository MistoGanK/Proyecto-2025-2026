<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen bg-gray-50">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Customer Insertion Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // 1. Inicialización de variables para el resultado
        $insert_output = "ERROR: Customer data is missing or incomplete."; 
        $message_class = "bg-red-100 border-red-500 text-red-700";
        $success = false;
        
        // Variables (capturadas de POST) y saneamiento inicial para la visualización
        $customer_username = isset($_POST['customer_username']) ? $_POST['customer_username'] : 'N/A';
        $customer_user_password = isset($_POST['customer_user_password']) ? $_POST['customer_user_password'] : 'N/A';
        $customer_dni = isset($_POST['customer_dni']) ? $_POST['customer_dni'] : 'N/A';
        $customer_email = isset($_POST['customer_email']) ? $_POST['customer_email'] : 'N/A'; 
        $customer_forename = isset($_POST['customer_forename']) ? $_POST['customer_forename'] : 'N/A';
        $customer_surname = isset($_POST['customer_surname']) ? $_POST['customer_surname'] : 'N/A';
        $customer_birth_date = isset($_POST['customer_birth_date']) ? $_POST['customer_birth_date'] : 'N/A';
        $customer_registered = isset($_POST['customer_registered']) ? $_POST['customer_registered'] : 'N/A';
        $customer_active = isset($_POST['customer_active']) ? $_POST['customer_active'] : 'N/A';

        // 2. Lógica de Inserción (solo si se recibe el campo de envío)
        if (isset($_POST['send'])) {
            
            // Connection 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

            // Escape input (usando las variables capturadas para el escape)
            $safe_customer_username = mysqli_escape_string($conn, $customer_username);
            $safe_customer_user_password = mysqli_escape_string($conn, $customer_user_password);
            $safe_customer_dni = mysqli_escape_string($conn, $customer_dni);
            $safe_customer_email = mysqli_escape_string($conn, $customer_email); 
            $safe_customer_forename = mysqli_escape_string($conn, $customer_forename);
            $safe_customer_surname = mysqli_escape_string($conn, $customer_surname);
            $safe_customer_birth_date = mysqli_escape_string($conn, $customer_birth_date);
            $safe_customer_registered = mysqli_escape_string($conn, $customer_registered);
            $safe_customer_active = mysqli_escape_string($conn, $customer_active);
            
            // SQL INSERT 
            $sql = "
            INSERT INTO customers (username, user_password, dni, email, forename, surname, birth_date, registered, active)
            VALUES (
            '$safe_customer_username',
            '$safe_customer_user_password',
            '$safe_customer_dni',
            '$safe_customer_email',
            '$safe_customer_forename',
            '$safe_customer_surname',
            '$safe_customer_birth_date',
            '$safe_customer_registered',
            '$safe_customer_active'
            );";

            // mysqli_query
            if (mysqli_query($conn, $sql)) {
                $insert_output = "Customer **'$customer_forename $customer_surname'** successfully inserted with ID: " . mysqli_insert_id($conn);
                $message_class = "bg-green-100 border-green-500 text-green-700";
                $success = true;
            } else {
                $insert_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }
            
            // Close the connection
            mysqli_close($conn);
        }
        
        // 3. Mostrar el resultado (Caja de estado)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4 text-left'>" . 
               "<p class='font-bold'>%s</p>" . 
               "</div>", $message_class, $insert_output);
        
        // 4. Mostrar detalles del cliente si la inserción fue exitosa
        if ($success) {
            echo "<p class='text-lg font-semibold text-gray-700 mt-6 mb-2'>Inserted Data Summary:</p>";
            echo "<ul class='text-sm text-gray-600 space-y-1 text-left mx-auto max-w-sm'>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Username:</span> <span class='font-medium text-[#0A090C]'>$customer_username</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Name:</span> <span class='font-medium text-[#0A090C]'>$customer_forename $customer_surname</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Email:</span> <span class='font-medium text-[#0A090C]'>$customer_email</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>DNI:</span> <span class='font-medium text-[#0A090C]'>$customer_dni</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Birth Date:</span> <span class='font-medium text-[#0A090C]'>$customer_birth_date</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Active:</span> <span class='font-medium text-[#0A090C]'>" . ($customer_active ? 'Yes' : 'No') . "</span></li>";
            echo "</ul>";
            
            // Nota: La contraseña no se muestra por seguridad.
        }
        
        ?>

        <div class="mt-8">
             <a href="/student022/shop/backend/customers/customers.php" 
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                 View Customers
             </a>
        </div>
        
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>    
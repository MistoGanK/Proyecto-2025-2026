<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Product Update Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // 1. Inicialización de variables de estado con valores de ERROR por defecto
        $update_output = "ERROR: id_product is missing or data not submitted correctly."; 
        $message_class = "bg-red-100 border-red-500 text-red-700"; 
        $id_product = null;
        
        // 2. Lógica principal: Solo procede si id_product está presente
        if (isset($_POST['id_product']) && !empty($_POST['id_product'])) {
            // Open connection
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
            
            // Save the variables and escape input
            $id_product = mysqli_escape_string($conn, $_POST['id_product']);
            $product_name = mysqli_escape_string($conn,$_POST['product_name']);
            $product_price = mysqli_escape_string($conn,$_POST['product_price']);
            $product_stock = mysqli_escape_string($conn,$_POST['product_stock']);
            $product_description = mysqli_escape_string($conn,$_POST['product_description']);
            $product_launch_date = mysqli_escape_string($conn,$_POST['product_launch_date']);
            $product_availability = mysqli_escape_string($conn,$_POST['product_availability']);
            $product_active = mysqli_escape_string($conn,$_POST['product_active']);
            
            // Query
            $sql = 
            "UPDATE `022_products`
            SET
                product_name = '$product_name',
                price = $product_price,
                stock = $product_stock,
                description = '$product_description',
                updated_date = CURRENT_TIMESTAMP(),
                launch_date = '$product_launch_date',
                availability = '$product_availability',
                active = $product_active
                
            WHERE id_product = $id_product
            ;";
        
            // Save the query 
            $query_result = mysqli_query($conn, $sql);
            
            if ($query_result) {
                // Mensaje de éxito: Sobrescribe las variables de error
                $update_output = "Records Successfully updated for Product : " . $product_name;
                $message_class = "bg-green-100 border-green-500 text-green-700";
            } else {
                // Mensaje de error de Base de Datos: Sobrescribe las variables de error (si no fuera por el init)
                $update_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }
            
            // Close the connection
            mysqli_close($conn);
        }
        
        // 3. Mostrar el resultado: Se usa el valor final de las variables
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4'>" . 
               "<p class='font-bold'>%s</p>" . 
               "</div>", $message_class, $update_output);
        ?>

        <div class="mt-8">
             <a href="/student022/backend/products /products.php" 
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                 View Products
             </a>
        </div>
        
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
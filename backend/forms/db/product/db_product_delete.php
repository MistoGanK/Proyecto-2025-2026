<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 50 min-h-screen">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Product Deletion Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // 1. Inicialización de variables de estado con valores de ERROR por defecto
        $id_product = null;
        $delete_output = "ERROR: id_product is missing or data not submitted correctly."; 
        $message_class = "bg-red-100 border-red-500 text-red-700"; 
        
        // Check if POST its retrieved and if it has content 
        if (isset($_POST['id_product']) && !empty($_POST['id_product'])) {
            
            // Open connection
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
            
            // Save the variable and escape input
            $id_product = mysqli_escape_string($conn, $_POST['id_product']);
        
            // Query
            $sql = "DELETE FROM `022_products` WHERE id_product = '$id_product';";
        
            // Execute the query 
            $query_result = mysqli_query($conn, $sql);
            
            if ($query_result) {
                // Mensaje de éxito
                $delete_output = "Record Successfully deleted for Product ID: " . $id_product;
                $message_class = "bg-green-100 border-green-500 text-green-700";
            } else {
                // Mensaje de error de Base de Datos
                $delete_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }
            
            // Close the connection
            mysqli_close($conn);
        }

        // 2. Mostrar el resultado con el estilo correspondiente (éxito o error)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4'>" . 
               "<p class='font-bold'>%s</p>" . 
               "</div>", $message_class, $delete_output);
        
        // 3. Mensaje final con el ID, solo si se procesó un ID
        if ($id_product) {
            echo "<p class='mt-6 text-sm text-gray-500'>Attempted to process product with ID: <span class='font-bold text-[#0A090C]'>" . $id_product . "</span></p>";
        }
        
        ?>

        <div class="mt-8">
             <a href="/student022/shop/backend/products/products.php" 
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                 View Products
             </a>
        </div>
        
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
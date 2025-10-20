<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen bg-gray-50">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Product Insertion Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // 1. Inicialización de variables para el resultado
        $insert_output = "ERROR: Product data is missing or incomplete."; 
        $message_class = "bg-red-100 border-red-500 text-red-700";
        $success = false;
        
        // Variables (capturadas de POST)
        // Se asume que todas las variables POST están presentes, si no, se usará el error inicial.
        $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : 'N/A';
        $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : 'N/A';
        $product_stock = isset($_POST['product_stock']) ? $_POST['product_stock'] : 'N/A';
        $product_description = isset($_POST['product_description']) ? $_POST['product_description'] : 'N/A'; 
        $product_launch_date = isset($_POST['product_launch_date']) ? $_POST['product_launch_date'] : 'N/A';
        $product_availability = isset($_POST['product_availability']) ? $_POST['product_availability'] : 'N/A';
        $product_active = isset($_POST['product_active']) ? $_POST['product_active'] : 'N/A';

        // 2. Lógica de Inserción (solo si se recibe el campo de envío)
        if (isset($_POST['send'])) {
            
            // Connection 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

            // Escape input
            $safe_product_name = mysqli_escape_string($conn, $product_name);
            $safe_product_price = mysqli_escape_string($conn, $product_price);
            $safe_product_stock = mysqli_escape_string($conn, $product_stock);
            $safe_product_description = mysqli_escape_string($conn, $product_description); 
            $safe_product_launch_date = mysqli_escape_string($conn, $product_launch_date);
            $safe_product_availability = mysqli_escape_string($conn, $product_availability);
            $safe_product_active = mysqli_escape_string($conn, $product_active);
            
            // SQL INSERT 
            $sql = "
            INSERT INTO `022_products` (product_name, price, stock, description, launch_date, availability, active)
            VALUES ('$safe_product_name', '$safe_product_price', '$safe_product_stock', '$safe_product_description', '$safe_product_launch_date', '$safe_product_availability', '$safe_product_active')
            ;";

            // mysqli_query
            if (mysqli_query($conn, $sql)) {
                $insert_output = "Product **'$product_name'** successfully inserted with ID: " . mysqli_insert_id($conn);
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
        
        // 4. Mostrar detalles del producto si la inserción fue exitosa
        if ($success) {
            echo "<p class='text-lg font-semibold text-gray-700 mt-6 mb-2'>Inserted Data Summary:</p>";
            echo "<ul class='text-sm text-gray-600 space-y-1 text-left mx-auto max-w-sm'>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Name:</span> <span class='font-medium text-[#0A090C]'>$product_name</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Price:</span> <span class='font-medium text-[#0A090C]'>$product_price</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Stock:</span> <span class='font-medium text-[#0A090C]'>$product_stock</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Launch Date:</span> <span class='font-medium text-[#0A090C]'>$product_launch_date</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Active:</span> <span class='font-medium text-[#0A090C]'>$product_active</span></li>";
            echo "</ul>";
            
            // Mostrar descripción en un bloque aparte
            echo "<p class='text-xs text-gray-400 mt-4'>Description: $product_description</p>";
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
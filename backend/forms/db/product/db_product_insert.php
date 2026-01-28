<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); 

// La carpeta de destino donde se guardarán las imágenes.
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/assets/images/';
$target_dir = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $target_dir);
$img_src = '';
$upload_success = true;
$upload_message = "";

// Subida de archivos
if (isset($_FILES['product_img']) && $_FILES['product_img']['error'] == UPLOAD_ERR_OK) {
    
    $file_tmp_name = $_FILES['product_img']['tmp_name'];
    $file_original_name = $_FILES['product_img']['name'];
    $file_size = $_FILES['product_img']['size'];

    // GENERAR NOMBRE ÚNICO
    $file_extension = strtolower(pathinfo($file_original_name, PATHINFO_EXTENSION));
    $new_file_name = uniqid('prod_', true) . '.' . $file_extension;
    $target_file = $target_dir . $new_file_name; // RUTA FÍSICA DE DESTINO EN EL SERVIDOR

    // VALIDACIÓN DE TIPO DE ARCHIVO Y TAMAÑO
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif','webp'];
    $max_size = 5 * 1024 * 1024; // 5 MB

    if (!in_array($file_extension, $allowed_types)) {
        $upload_message = "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $upload_success = false;
    } else if ($file_size > $max_size) {
        $upload_message = "Error: File size exceeds the 5MB limit.";
        $upload_success = false;
    } else {
        // MOVER EL ARCHIVO PERMANENTEMENTE
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            // Definimos la ruta relativa (URL) para la base de datos
            $img_src = '/student022/shop/backend/assets/images/' . $new_file_name; 
        } else {
            // Mostrar la ruta de destino para confirmar que existe en el servidor.
            $upload_message = "Error al mover el archivo. Posibles causas: 
                <ol class='list-decimal list-inside ml-4 mt-2'>
                    <li>Permisos de escritura ('images' folder) incorrectos (CHMOD).</li>
                    <li>La ruta de destino no existe.</li>
                </ol>
                Ruta de destino intentada: <strong>" . $target_file . "</strong>";
            
            // Intentar obtener el último error de PH.
            if ($error = error_get_last()) {
                $upload_message .= "<br>Último error PHP: <strong>" . $error['message'] . "</strong>";
            }
            $upload_success = false;
        }
    }

} else if (isset($_FILES['product_img']) && $_FILES['product_img']['error'] != UPLOAD_ERR_NO_FILE) {
    // Manejar errores
    $upload_message = "File upload error: Error code " . $_FILES['product_img']['error'];
    $upload_success = false;
} else {
    // No se subió ningún archivo, asignar imagen por defecto
    $img_src = '/student022/shop/backend/assets/images/default.png'; 
}
?>

<section class="flex justify-center p-8 min-h-screen bg-gray-50">
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Product Insertion Result</h1>
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        $insert_output = ""; 
        $message_class = "";
        $success = false;
        
        // Se han mandado los datos a POST
        if (isset($_POST['send']) && $upload_success) {
            
            // Connection 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

            // Captura y Saneamiento de variables
            $product_name = $_POST['product_name'] ?? '';
            $product_price = $_POST['product_price'] ?? 0;
            $product_stock = $_POST['product_stock'] ?? 0;
            $product_description = $_POST['product_description'] ?? '';
            $product_launch_date = $_POST['product_launch_date'] ?? date('Y-m-d');
            $product_availability = $_POST['product_availability'] ?? 'on_stock';
            $product_active = $_POST['product_active'] ?? 1;

            // Saneamiento con mysqli_escape_string
            $safe_name = mysqli_real_escape_string($conn, $product_name);
            $safe_price = mysqli_real_escape_string($conn, $product_price);
            $safe_stock = mysqli_real_escape_string($conn, $product_stock);
            $safe_description = mysqli_real_escape_string($conn, $product_description);
            $safe_launch_date = mysqli_real_escape_string($conn, $product_launch_date);
            $safe_availability = mysqli_real_escape_string($conn, $product_availability);
            $safe_active = mysqli_real_escape_string($conn, $product_active);
            $safe_img_src = mysqli_real_escape_string($conn, $img_src);

            // Query SQL INSERT
            $sql = "
            INSERT INTO `022_products` 
                (product_name, price, stock, description, launch_date, availability, active, img_src)
            VALUES (
                '$safe_name',
                '$safe_price',
                '$safe_stock',
                '$safe_description',
                '$safe_launch_date',
                '$safe_availability',
                '$safe_active',
                '$safe_img_src'
            );";

            // Ejecutar y manejar el resultado
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                $insert_output = "Product **'$product_name'** (ID: $last_id) inserted successfully.";
                $message_class = "bg-green-100 border-green-500 text-green-700";
                $success = true;
            } else {
                $insert_output = "Database Error on INSERT: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }

            // Close connection
            mysqli_close($conn);

        } else if (!$upload_success) {
            // Manejar error de subida de archivos (AQUÍ SE MUESTRA EL DIAGNÓSTICO)
            $insert_output = "Product insertion failed due to file upload error: <br>**" . $upload_message . "**";
            $message_class = "bg-red-100 border-red-500 text-red-700";
        } else {
            // Manejar error de datos POST faltantes (si no hay 'send')
            $insert_output = "ERROR: Product data is missing or incomplete (Did not receive POST data)."; 
            $message_class = "bg-red-100 border-red-500 text-red-700";
        }
        
        // Mostrar el resultado
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4 text-left'>" . 
            "<p class='font-bold'>%s</p>" . 
            "</div>", $message_class, $insert_output);
        
        // Mostrar detalles del producto si la inserción fue exitosa
        if ($success) {
            echo "<p class='text-lg font-semibold text-gray-700 mt-6 mb-2'>Product Summary:</p>";
            echo "<ul class='text-sm text-gray-600 space-y-1 text-left mx-auto max-w-sm'>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Name:</span> <span class='font-medium text-[#0A090C]'>$product_name</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Price:</span> <span class='font-medium text-[#0A090C]'>$product_price</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Stock:</span> <span class='font-medium text-[#0A090C]'>$product_stock</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Image Path:</span> <span class='font-medium text-[#0A090C]'>$safe_img_src</span></li>";
            echo "</ul>";
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
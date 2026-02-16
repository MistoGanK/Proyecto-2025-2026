<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); 

// Configuración de rutas de imagen
$target_dir = $_SERVER['DOCUMENT_ROOT'] . '/student022/backend/assets/images/';
$target_dir = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $target_dir);
$img_src = '';
$upload_success = true;
$upload_message = "";

// Lógica de subida de archivos
if (isset($_FILES['product_img']) && $_FILES['product_img']['error'] == UPLOAD_ERR_OK) {
    $file_tmp_name = $_FILES['product_img']['tmp_name'];
    $file_original_name = $_FILES['product_img']['name'];
    $file_size = $_FILES['product_img']['size'];
    $file_extension = strtolower(pathinfo($file_original_name, PATHINFO_EXTENSION));
    
    $new_file_name = uniqid('prod_', true) . '.' . $file_extension;
    $target_file = $target_dir . $new_file_name;

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif','webp'];
    $max_size = 5 * 1024 * 1024; // 5 MB

    if (!in_array($file_extension, $allowed_types)) {
        $upload_message = "Invalid format. Use JPG, PNG, GIF or WEBP.";
        $upload_success = false;
    } else if ($file_size > $max_size) {
        $upload_message = "File too large. Max limit is 5MB.";
        $upload_success = false;
    } else {
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            $img_src = '/student022/backend/assets/images/' . $new_file_name; 
        } else {
            $upload_message = "Server Permission Error. Check 'images' folder CHMOD.";
            $upload_success = false;
        }
    }
} else if (isset($_FILES['product_img']) && $_FILES['product_img']['error'] != UPLOAD_ERR_NO_FILE) {
    $upload_message = "System Upload Error: Code " . $_FILES['product_img']['error'];
    $upload_success = false;
} else {
    $img_src = '/student022/backend/assets/images/default.png'; 
}
?>

<section class="flex justify-center items-start p-8 min-h-screen bg-gray-50/50">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2rem] border border-gray-100 overflow-hidden h-fit">
        
        <div class="bg-black p-10 text-center">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter italic">
                Entry <span class="font-light not-italic opacity-70">Log</span>
            </h1>
        </div>

        <div class="p-10 text-center">
            <?php
            $insert_output = ""; 
            $message_class = "bg-red-50 text-red-600 border-red-100";
            $success = false;
            
            if (isset($_POST['send']) && $upload_success) {
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

                $safe_name = mysqli_real_escape_string($conn, $_POST['product_name']);
                $safe_price = mysqli_real_escape_string($conn, $_POST['product_price']);
                $safe_stock = mysqli_real_escape_string($conn, $_POST['product_stock']);
                $safe_description = mysqli_real_escape_string($conn, $_POST['product_description']);
                $safe_launch_date = mysqli_real_escape_string($conn, $_POST['product_launch_date']);
                $safe_availability = mysqli_real_escape_string($conn, $_POST['product_availability']);
                $safe_active = mysqli_real_escape_string($conn, $_POST['product_active']);
                $safe_img_src = mysqli_real_escape_string($conn, $img_src);

                $sql = "INSERT INTO `022_products` (product_name, price, stock, description, launch_date, availability, active, img_src)
                        VALUES ('$safe_name', '$safe_price', '$safe_stock', '$safe_description', '$safe_launch_date', '$safe_availability', '$safe_active', '$safe_img_src');";

                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    $insert_output = "SKU-$last_id Registered Successfully";
                    $message_class = "bg-green-50 text-green-600 border-green-100";
                    $success = true;
                } else {
                    $insert_output = "Database System Fault: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            } else if (!$upload_success) {
                $insert_output = "Media Asset Error: " . $upload_message;
            } else {
                $insert_output = "No Data Received. Access Denied."; 
            }

            // Status Badge
            printf("<div class='mb-8 p-4 rounded-2xl border %s font-black text-xs uppercase tracking-widest'>%s</div>", $message_class, $insert_output);
            
            if ($success) { ?>
                <div class="flex flex-col md:flex-row gap-8 items-center text-left bg-gray-50 p-6 rounded-[1.5rem] mb-8">
                    <div class="w-32 h-32 rounded-[1rem] overflow-hidden shadow-lg bg-white flex-shrink-0">
                        <img src="<?php echo $img_src; ?>" alt="Preview" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Product Entity</p>
                        <h2 class="text-2xl font-black text-gray-900 uppercase italic tracking-tighter mb-2"><?php echo $_POST['product_name']; ?></h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase">Price Point</p>
                                <p class="font-bold text-gray-900"><?php echo $_POST['product_price']; ?>€</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase">Initial Stock</p>
                                <p class="font-bold text-gray-900"><?php echo $_POST['product_stock']; ?> Units</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 mb-10">
                    <div class="flex justify-between text-[11px] border-b border-gray-100 pb-2">
                        <span class="font-black text-gray-400 uppercase">Availability</span>
                        <span class="font-bold text-gray-900 uppercase"><?php echo str_replace('_', ' ', $_POST['product_availability']); ?></span>
                    </div>
                    <div class="flex justify-between text-[11px] border-b border-gray-100 pb-2">
                        <span class="font-black text-gray-400 uppercase">Launch Schedule</span>
                        <span class="font-bold text-gray-900"><?php echo $_POST['product_launch_date']; ?></span>
                    </div>
                </div>
            <?php } ?>

            <div class="flex flex-col gap-3">
                <a href="/student022/backend/products/products.php" 
                    class="w-full py-5 bg-black text-white rounded-[1.2rem] font-black text-[10px] uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Return to Inventory
                </a>
                <a href="/student022/backend/forms/products/form_product_insert.php" 
                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-black transition-colors pt-4">
                    Add another product
                </a>
            </div>
        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
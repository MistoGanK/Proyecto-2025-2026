<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center items-start p-8 min-h-screen bg-gray-50/50">
    
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2rem] border border-gray-100 overflow-hidden h-fit">
        
        <div class="bg-black p-10 text-center">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter italic">
                Update <span class="font-light not-italic opacity-70">Confirmation</span>
            </h1>
        </div>

        <div class="p-10 text-center">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">System Operation Status</p>

            <?php
            // Inicialización de variables
            $update_output = "ERROR: System failed to capture Product ID or POST data."; 
            $message_class = "bg-red-50 text-red-600 border-red-100"; 
            $success = false;
            $id_product = null;

            if (isset($_POST['id_product']) && !empty($_POST['id_product'])) {
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
                
                // Saneamiento de variables
                $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
                $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
                $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
                $product_stock = mysqli_real_escape_string($conn, $_POST['product_stock']);
                $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
                $product_launch_date = mysqli_real_escape_string($conn, $_POST['product_launch_date']);
                $product_availability = mysqli_real_escape_string($conn, $_POST['product_availability']);
                $product_active = mysqli_real_escape_string($conn, $_POST['product_active']);
                
                // Query de Actualización
                $sql = "UPDATE `022_products` SET
                            product_name = '$product_name',
                            price = $product_price,
                            stock = $product_stock,
                            description = '$product_description',
                            updated_date = CURRENT_TIMESTAMP(),
                            launch_date = '$product_launch_date',
                            availability = '$product_availability',
                            active = $product_active
                        WHERE id_product = $id_product;";
            
                if (mysqli_query($conn, $sql)) {
                    $update_output = "Entity SKU-$id_product successfully synchronized";
                    $message_class = "bg-green-50 text-green-600 border-green-100";
                    $success = true;
                } else {
                    $update_output = "Database Kernel Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            }

            // Status Badge
            printf("<div class='mb-8 p-4 rounded-2xl border %s font-black text-xs uppercase tracking-widest'>%s</div>", $message_class, $update_output);
            
            if ($success) { ?>
                <div class="text-left bg-gray-50 p-8 rounded-[1.5rem] mb-10 border border-gray-100">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 border-b border-gray-200 pb-2">Last Modified Values</p>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="text-[9px] font-black text-gray-400 uppercase block">Product Identity</span>
                            <span class="text-xl font-black text-gray-900 uppercase italic italic tracking-tighter"><?php echo $product_name; ?></span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div>
                                <span class="text-[9px] font-black text-gray-400 uppercase block">New Price</span>
                                <span class="font-bold text-gray-900"><?php echo $product_price; ?>€</span>
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-gray-400 uppercase block">New Stock</span>
                                <span class="font-bold text-gray-900"><?php echo $product_stock; ?> Units</span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <span class="text-[9px] font-black text-gray-400 uppercase block">Status</span>
                            <span class="inline-block px-3 py-1 bg-black text-white text-[9px] font-black uppercase rounded-full mt-1">
                                <?php echo str_replace('_', ' ', $product_availability); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="space-y-4">
                <a href="/student022/backend/products/products.php" 
                    class="w-full inline-block py-5 bg-black text-white rounded-[1.2rem] font-black text-[10px] uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Return to Products
                </a>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    Changes take effect immediately on the storefront.
                </p>
            </div>
            
        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
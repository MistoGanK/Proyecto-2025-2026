<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center items-start p-8 min-h-screen bg-gray-50/50">
    
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2rem] border border-gray-100 overflow-hidden h-fit">
        
        <?php
        // Lógica de recuperación de datos
        $product_name = ""; $product_price = 0; $product_stock = 0; $product_description = "";
        $product_launch_date = ""; $product_availability = ""; $product_active = 1;
        $id_product = null; $update_output = ""; $message_class = "hidden";

        if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
           $update_output = "System Error: Missing Product ID Entity.";
           $message_class = "bg-red-50 text-red-600 border-red-100 block";
        } else {
           include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
           $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
           $query = "SELECT * FROM `022_products` WHERE id_product = '$id_product';";
           $query_result = mysqli_query($conn, $query);
        
           if($query_result && mysqli_num_rows($query_result) > 0){
               $row = mysqli_fetch_assoc($query_result);
               $product_name = $row['product_name'];
               $product_price = $row['price'];
               $product_stock = $row['stock'];
               $product_description = $row['description'];
               $product_launch_date = $row['launch_date'];
               $product_availability = $row['availability'];
               $product_active = $row['active'];
           } else {
              $update_output = "Entity Not Found: The requested ID does not exist.";
              $message_class = "bg-red-50 text-red-600 border-red-100 block";
           }
           mysqli_close($conn);
        }
        ?>

        <div class="bg-black p-10 text-center">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter italic">
                Update <span class="font-light not-italic opacity-70">Entity</span>
            </h1>
            <p class="text-[10px] font-bold text-white/50 uppercase tracking-[0.4em] mt-2">Internal SKU: <?php echo $id_product; ?></p>
        </div>

        <div class="p-10">
            <div class="mb-8 p-4 rounded-2xl border <?php echo $message_class; ?> font-black text-xs uppercase tracking-widest text-center">
                <?php echo $update_output; ?>
            </div>

            <form class="flex flex-col gap-8" action="/student022/backend/forms/db/product/db_product_update.php" method="post">
                <input type="hidden" name="id_product" value="<?php echo $id_product ?>">

                <fieldset class="space-y-6">
                    <legend class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Product Core Data</legend>

                    <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_name">
                        Product Title
                        <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all" 
                               type="text" id="product_name" name="product_name" value="<?php echo $product_name ?>">
                    </label>

                    <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_description">
                        Detailed Description
                        <textarea class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-medium text-gray-700 focus:ring-2 focus:ring-black transition-all" 
                                  id="product_description" name="product_description" rows="3"><?php echo $product_description ?></textarea>
                    </label>
                </fieldset>

                <fieldset class="space-y-6">
                    <legend class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Market & Logistics</legend>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_price">
                            Unit Price (€)
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-black text-gray-900 focus:ring-2 focus:ring-black transition-all" 
                                   type="number" step="0.01" id="product_price" name="product_price" value="<?php echo $product_price ?>">
                        </label>

                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_stock">
                            Available Stock
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-black text-gray-900 focus:ring-2 focus:ring-black transition-all" 
                                   type="number" id="product_stock" name="product_stock" min="0" value="<?php echo $product_stock ?>">
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_launch_date">
                            Launch Schedule
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all" 
                                   type="date" id="product_launch_date" name="product_launch_date" value="<?php echo $product_launch_date ?>">
                        </label>

                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_active">
                            Active Status
                            <select class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all cursor-pointer appearance-none" 
                                    name="product_active">
                                <option value="1" <?php echo ($product_active == 1) ? 'selected' : ''; ?>>Yes (Visible)</option>
                                <option value="0" <?php echo ($product_active == 0) ? 'selected' : ''; ?>>No (Hidden)</option>
                            </select>
                        </label>
                    </div>

                    <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_availability">
                        Inventory Status
                        <select class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all cursor-pointer appearance-none" 
                                name="product_availability">
                            <?php 
                            $options = ['on_stock', 'out_of_stock', 'coming_soon', 'discontinued'];
                            foreach($options as $opt) {
                                $selected = ($product_availability == $opt) ? 'selected' : '';
                                $label = str_replace('_', ' ', ucfirst($opt));
                                echo "<option value='$opt' $selected>$label</option>";
                            }
                            ?>
                        </select>
                    </label>
                </fieldset>

                <div class="pt-6">
                    <button type="submit" name="send" id="send" 
                        class="w-full py-5 bg-black text-white rounded-[1.2rem] font-black text-[10px] uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                        Commit Entity Changes
                    </button>
                    <a href="/student022/backend/products/products.php" class="block text-center mt-6 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-black transition-colors">
                        Discard and Return
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
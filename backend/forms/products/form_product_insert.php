<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 h-fit"> 
    
    <div class="w-full max-w-2xl p-8 bg-white shadow-2xl rounded-xl border border-gray-100"> 
        
        <h1 class="text-3xl font-extrabold text-[#0A090C] mb-8 text-center">
            Insert New Product
        </h1>
        
        <form class="flex flex-col gap-6" action="/student022/shop/backend/forms/db/product/db_product_insert.php" method="post" enctype="multipart/form-data">
            
            <fieldset class="pt-4">
                <legend class="text-xl font-semibold text-gray-800 mb-4">
                    Basic Details
                </legend>

                <label class="flex flex-col text-sm font-medium text-gray-700 mb-4" for="product_name">
                    Product Name:
                    <input class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150" 
                        type="text" id="product_name" name="product_name" required>
                </label>

                <label class="flex flex-col text-sm font-medium text-gray-700 mb-4" for="product_description">
                    Product Description:
                    <textarea class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150" 
                        id="product_description" name="product_description" rows="4" required></textarea>
                </label>
            </fieldset>

            <fieldset class="pt-4">
                <legend class="text-xl font-semibold text-gray-800 mb-4">
                    Inventory and Price
                </legend>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <label class="flex flex-col text-sm font-medium text-gray-700" for="product_price">
                        Product Price (€):
                        <input class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150" 
                            type="number" id="product_price" name="product_price" step="0.01" min="0" required>
                    </label>

                    <label class="flex flex-col text-sm font-medium text-gray-700" for="product_stock">
                        Stock Quantity:
                        <input class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150" 
                            type="number" id="product_stock" name="product_stock" min="0" required>
                    </label>

                </div>

                <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="product_availability">
                    Availability Status:
                    <select class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150 bg-white" 
                        id="product_availability" name="product_availability" required>
                        <option value="on_stock">On Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                        <option value="coming_soon">Comming Soon</option>
                        <option value="discontinued">Discontinued</option>
                    </select>
                </label>
            </fieldset>

            <fieldset class="pt-4">
                <legend class="text-xl font-semibold text-gray-800 mb-4">
                    Image and Publication
                </legend>

                <label class="flex flex-col text-sm font-medium text-gray-700 mb-4" for="product_img">
                    Product Image Upload:
                    <input class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150" 
                        type="file" id="product_img" name="product_img" accept=".jpg, .png, .webp">
                    <p class="text-xs text-gray-500 mt-1">
                        Formats accepted: JPG, PNG, GIF, WEBP. Max size: 5MB.
                    </p>
                </label>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <label class="flex flex-col text-sm font-medium text-gray-700" for="product_launch_date">
                        Launch Date:
                        <input class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150 bg-white" 
                            type="date" id="product_launch_date" name="product_launch_date" value="<?php echo date('Y-m-d'); ?>" required>
                    </label>

                    <label class="flex flex-col text-sm font-medium text-gray-700" for="product_active">
                        Product Active:
                        <select class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50 transition duration-150 bg-white" 
                            id="product_active" name="product_active" required>
                            <option value="1">Yes (Active)</option>
                            <option value="0">No (Inactive)</option>
                        </select>
                    </label>
                    
                </div>
            </fieldset>


            <label class="flex flex-col text-sm font-medium text-gray-700 mt-6" for="send">
                <input class="p-4 bg-[#0A090C] text-[#FEFFFE] rounded-lg hover:cursor-pointer hover:bg-[#2c2732] font-extrabold text-lg transition duration-200 shadow-md" 
                    type="submit" 
                    id="send" 
                    name="send"
                    value="+ Add New Product">
            </label>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
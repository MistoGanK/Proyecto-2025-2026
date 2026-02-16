<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center items-start p-8 min-h-screen bg-gray-50/50"> 
    
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2rem] border border-gray-100 overflow-hidden h-fit"> 
        
        <div class="bg-black p-10 text-center">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter italic">
                Inventory <span class="font-light not-italic opacity-70">Control</span>
            </h1>
        </div>
        
        <div class="p-10">
            <form class="flex flex-col gap-8" action="/student022/backend/forms/db/product/db_product_insert.php" method="post" enctype="multipart/form-data">
                
                <fieldset class="space-y-6">
                    <legend class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Basic Information</legend>

                    <div class="space-y-4">
                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_name">
                            Product Name
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-black transition-all" 
                                type="text" id="product_name" name="product_name" placeholder="e.g. Premium Leather Jacket" required>
                        </label>

                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_description">
                            Product Description
                            <textarea class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-medium text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-black transition-all" 
                                id="product_description" name="product_description" rows="4" placeholder="Describe the product details..." required></textarea>
                        </label>
                    </div>
                </fieldset>

                <fieldset class="space-y-6">
                    <legend class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Pricing & Stock</legend>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_price">
                            Price (€)
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-black text-gray-900 focus:ring-2 focus:ring-black transition-all" 
                                type="number" id="product_price" name="product_price" step="0.01" min="0" placeholder="0.00" required>
                        </label>

                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_stock">
                            Initial Stock
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-black text-gray-900 focus:ring-2 focus:ring-black transition-all" 
                                type="number" id="product_stock" name="product_stock" min="0" placeholder="0" required>
                        </label>
                    </div>

                    <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_availability">
                        Availability Status
                        <select class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all appearance-none cursor-pointer" 
                            id="product_availability" name="product_availability" required>
                            <option value="on_stock">On Stock</option>
                            <option value="out_of_stock">Out of Stock</option>
                            <option value="coming_soon">Coming Soon</option>
                            <option value="discontinued">Discontinued</option>
                        </select>
                    </label>
                </fieldset>

                <fieldset class="space-y-6">
                    <legend class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Media & Visibility</legend>

                    <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_img">
                        Product Assets (Image)
                        <div class="mt-2 flex items-center justify-center w-full">
                            <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-200 rounded-[1rem] hover:bg-gray-50 hover:border-black transition-all group cursor-pointer">
                                <div class="flex flex-col items-center justify-center pt-7">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="pt-1 text-xs text-gray-400 font-bold uppercase tracking-tighter group-hover:text-black">Click to upload image</p>
                                </div>
                                <input type="file" class="hidden" id="product_img" name="product_img" accept=".jpg, .png, .webp" />
                            </label>
                        </div>
                    </label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_launch_date">
                            Launch Date
                            <input class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all cursor-pointer" 
                                type="date" id="product_launch_date" name="product_launch_date" value="<?php echo date('Y-m-d'); ?>" required>
                        </label>

                        <label class="block text-[11px] font-black text-gray-900 uppercase tracking-widest" for="product_active">
                            Active Status
                            <select class="mt-2 w-full p-4 bg-gray-50 border-none rounded-[1rem] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-black transition-all appearance-none cursor-pointer" 
                                id="product_active" name="product_active" required>
                                <option value="1">Yes (Live)</option>
                                <option value="0">No (Draft)</option>
                            </select>
                        </label>
                    </div>
                </fieldset>

                <div class="pt-6">
                    <button type="submit" name="send" id="send" 
                        class="w-full py-5 bg-black text-white rounded-[1.2rem] font-black text-[10px] uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                        + Initialize Product
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen">
    
    <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Insert New Product</h1>
        
        <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/product/db_product_insert.php" method="post">
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_name">
                Product Name: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="product_name" 
                    name="product_name">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_price">
                Product Price (€):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="product_price" 
                    name="product_price">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_stock">
                Stock:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="product_stock" 
                    name="product_stock" 
                    min="0">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_description">
                Product description:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="product_description" 
                    name="product_description">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_launch_date">
                Launch date:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="date" 
                    id="product_launch_date" 
                    name="product_launch_date">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_availability">
                Availability Status (on_stock, out_of_stock, etc.):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="text" 
                    id="product_availability" 
                    name="product_availability">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_active">
                Product Active (1=Yes, 0=No):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="product_active" 
                    name="product_active" 
                    min="0" max="1" 
                    value="1"> </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit:
                <input class="p-3 bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold mt-3 transition duration-150" 
                    type="submit" 
                    id="send" 
                    name="send"
                    value="Insert Product">
            </label>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
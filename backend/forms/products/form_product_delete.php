<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8  min-h-screen">
    
    <div class="w-full max-w-md h-fit p-8
        bg-white
        shadow-xl 
        rounded-lg 
        border 
        border-gray-200 
        text-center">
        
        <h1 class="text-2xl font-bold text-red-700 mb-6 border-b border-gray-200 pb-2">Proceed to delete the product?</h1>
        
        <p class="text-sm text-gray-600 mb-6">
            This action is permanent and cannot be undone. Please confirm the Product ID.
        </p>

        <form class="flex flex-col gap-4" 
              action="/student022/shop/backend/forms/db/product/db_product_delete.php" 
              method="post">
            
            <label class="flex flex-col text-sm font-medium text-gray-700 text-left" for="id_product">
                Product ID to Delete: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" 
                       type="number" 
                       id="id_product" 
                       name="id_product" 
                       value="<?php echo $_POST['id_product']?>"
                       readonly>
            </label>

                <input class="p-3 mt-3 bg-red-600 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-red-700 font-semibold transition duration-150" 
                       type="submit" 
                       id="send" 
                       name="send"
                       value="Confirm DELETE">

            <a href="/student022/shop/backend/products/products.php" 
               class="p-3
                        text-white  
                        font-semibold
                        bg-[#000001]
                        hover:bg-[#2c2732]
                        cursor-pointer
                        text-sm">
                Cancel and Go Back
            </a>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
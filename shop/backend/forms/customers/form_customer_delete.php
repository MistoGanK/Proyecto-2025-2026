<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 bg-gray-50 min-h-screen">
    
    <div class="w-full max-w-sm h-fit p-8
        bg-white
        shadow-xl 
        rounded-lg 
        border 
        border-gray-200 
        text-center">
        
        <h1 class="text-2xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">
            Delete Customer
        </h1>
        
        <p class="text-sm text-gray-600 mb-6">
            Enter the ID of the customer you wish to permanently delete.
        </p>

        <form class="flex flex-col gap-4" 
              action="/student022/shop/backend/forms/db/customer/db_customer_delete.php" 
              method="post">
            
            <label class="flex flex-col text-sm font-medium text-gray-700 text-left" for="id_customer">
                Customer ID: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" 
                       type="number" 
                       id="id_customer" 
                       name="id_customer"
                       value="<?php echo $_POST['id_customer'] ?>"
                       readonly
                       required>
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                
                <input class="p-3 bg-red-600 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-red-700 font-semibold transition duration-150" 
                       type="submit" 
                       id="send" 
                       name="send"
                       value="Proceed to Delete">
            </label>
            
            <a href="/student022/shop/backend/customers/customers.php" 
               class="p-3 text-sm
                      text-white
                      font-semibold
                      bg-[#0A090C]
                      rounded-md
                      hover:bg-[#2c2732]
                      cursor-pointer
                      transition duration-150">
                Cancel and Go Back
            </a>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen ">
    
    <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Insert New Order Details</h1>
        
        <form class="flex flex-col gap-4" action="/student022/backend/forms/db/order/db_order_insert.php" method="post">
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="id_order">
                Order ID (Manual Entry):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="id_order" 
                    name="id_order">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_id_customer">
                Customer ID: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="order_id_customer" 
                    name="order_id_customer">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_id_product">
                Product ID: 
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="order_id_product" 
                    name="order_id_product">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_id_payment_method">
                Payment method ID:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="order_id_payment_method" 
                    name="order_id_payment_method">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_qty">
                Order Quantity (qty):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="order_qty" 
                    name="order_qty" 
                    min="1" value="1">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_discount_rate">
                Discount rate (%):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                    type="number" 
                    id="order_discount_rate" 
                    name="order_discount_rate"
                    min="0" max="100" value="0">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit:
                <input class="p-3 bg-[#0A090C] mt-3 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150" 
                    type="submit" 
                    id="send" 
                    name="send" 
                    value="Insert Order">
            </label>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
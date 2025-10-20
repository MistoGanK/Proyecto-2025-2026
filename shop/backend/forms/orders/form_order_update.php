<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8  min-h-screen">
    
    <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Update Order Information</h1>
        
        <?php
        // Variables definition that we will capture later
        $id_order = "";
        $order_id_customer = "";
        $order_id_product = "";
        $order_id_payment_method = "";
        $order_qty = 0;
        $oder_unit_price = 0;
        $order_discount_rate = 0; // Esta variable no se usa en el formulario, pero se mantiene la inicialización
        $order_total = 0;
        $order_date = "";
        $order_canceled = 0;
        $update_output = ""; // Inicializar la salida de error
        
        if (!isset($_POST['id_order']) || empty($_POST['id_order'])) {
           $update_output = "ERROR: id_order is missing";
        } else {
           // Open connectoin
           include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
           
           // Escape input to avoid SQL injection
           $id_order = mysqli_escape_string($conn,$_POST['id_order']);
           
           // Query 
           $query = "SELECT * FROM `022_orders` WHERE id_order = '$id_order';";
           
           // Execute and save the query
           $query_result = mysqli_query($conn,$query);

           // Check if the query is correct
           if($query_result){
               // Check if the order_id_order returns any rows
           if (mysqli_num_rows($query_result)>0){
               // Save the query result to the variables
             $row = mysqli_fetch_assoc($query_result);
             $order_id_order = $row['id_order'];
             $order_id_customer = $row['id_customer'];
             $order_id_product = $row['id_product'];
             $order_id_payment_method = $row['id_payment_method'];
             $order_qty = $row['qty'];
             $oder_unit_price = $row['unit_price'];
             // $order_discount_rate = $row['discount']; 
             $order_total = $row['total'];
             // Formatear la fecha a `datetime-local` (YYYY-MM-DDTHH:MM)
             $order_date = str_replace(' ', 'T', substr($row['order_date'], 0, 16));
             $order_canceled = $row['canceled'];

           }else{
             $update_output = "ERROR: order_id_order not found on the database";
           }
           }else{
             $update_output = "Error: Database error " . mysqli_error($conn);
           }
           mysqli_close($conn);
        }
        
        // Mostrar errores de consulta o ID faltante
        if (!empty($update_output) && strpos($update_output, 'ERROR') !== false) {
             echo "<p class='text-red-500 font-bold mb-4'>" . $update_output . "</p>";
        }
        ?>

        <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/order/db_order_update.php" method="post">
            
            <input type="hidden" name="id_order" value="<?php echo $id_order ?>">
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_id_customer">
                Customer ID:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="order_id_customer" 
                       name="order_id_customer" 
                       min="1"
                       value="<?php echo $order_id_customer ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_id_product">
                Product ID:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="order_id_product" 
                       name="order_id_product" 
                       min="1"
                       value="<?php echo $order_id_product ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_id_payment_method">
                Payment Method ID:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="order_id_payment_method" 
                       name="order_id_payment_method" 
                       min="0" 
                       value="<?php echo $order_id_payment_method?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_qty">
                Order Quantity:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="order_qty" 
                       name="order_qty" 
                       min="0" 
                       value="<?php echo $order_qty ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="oder_unit_price">
                Order Unit Price (€):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       step="0.01" 
                       id="oder_unit_price" 
                       name="oder_unit_price" 
                       min="0" 
                       value="<?php echo $oder_unit_price?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_total">
                Order Total (€):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       step="0.01"
                       name="order_total" 
                       value="<?php echo $order_total?>">
            </label>

            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_date">
                Order Date:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="datetime-local" 
                       id="order_date" 
                       name="order_date" 
                       value="<?php echo $order_date?>">
            </label>

            <label class="flex flex-col text-sm font-medium text-gray-700" for="order_canceled">
                Order Canceled (1=Yes, 0=No):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="order_canceled" 
                       name="order_canceled" 
                       min="0" max="1" 
                       value="<?php echo $order_canceled?>">
            </label> 

            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit Changes:
                <input class="p-3 bg-[#0A090C] mt-3 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150" 
                       type="submit" 
                       id="send" 
                       name="send" 
                       value="Update Order">
            </label>

        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
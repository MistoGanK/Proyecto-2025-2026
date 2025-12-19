<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8  min-h-screen">
    
    <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Update Product</h1>
        
        <?php
        // Código PHP de lógica (movido aquí para mantenerlo fuera del HTML)
        
        // Debug
        // print_r($_POST); 
        
        // Variables definition that we will capture later
        $product_name = "";
        $product_price = 0;
        $product_stock = 0;
        $product_description = "";
        $product_inserted_date = "";
        $product_updated_date = "";
        $product_launch_date = "";
        $product_availability = "";
        $product_active = 1;
        $id_product = null;
        $update_output = "";
        
        if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
           $update_output = "ERROR: id_product is missing";
        } else {
           // Open connectoin
           include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
           // Escpa input to avoid SQL injection
           $id_product = mysqli_escape_string($conn,$_POST['id_product']);
           // Query 
           $query = "SELECT * FROM `022_products` WHERE id_product = '$id_product';";
           // Execute and save the query
           $query_result = mysqli_query($conn,$query);
        
           // Check if the query is correct
           if($query_result){
               // Check if the id_product returns any rows
               if (mysqli_num_rows($query_result)>0){
                   // Save the query result to the variables
                   $row = mysqli_fetch_assoc($query_result);
                   $product_name = $row['product_name'];
                   $product_price = $row['price'];
                   $product_stock = $row['stock'];
                   $product_description = $row['description'];
                   $product_inserted_date = $row['inserted_date'];
                   $product_launch_date = $row['launch_date'];
                   $product_availability = $row['availability'];
                   $product_active = $row['active'];
        
                   // Formateo de las fechas (Mantengo tu código comentado)
        
                   // $datetime_insert_object = new DateTime($product_inserted_date);
                   // $product_inserted_date = $datetime_insert_object ->format('Y-m-d\TH:i');
        
                   // $datetime_launch_object = new DateTime($product_launch_date);
                   // $product_launch_date = $datetime_launch_object ->format('Y-m-d\TH:i');
        
               }else{
                  $update_output = "ERROR: id_product not foun on the database";
               }
           }else{
              $update_output = "Error: Database error " . mysqli_error($conn);
           }
           mysqli_close($conn);
        }

        // Si hay un error, lo mostramos
        if (!empty($update_output)) {
            echo "<p class='text-red-500 font-bold mb-4'>" . $update_output . "</p>";
        }
        ?>

        <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/product/db_product_update.php" method="post">
            
            <input type="hidden" name="id_product" value="<?php echo $id_product ?>">
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_name">
                Product Name:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       id="product_name" 
                       name="product_name" 
                       value="<?php echo $product_name ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_price">
                Unit Price (€):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="product_price" 
                       name="product_price" 
                       value="<?php echo $product_price ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_stock">
                Available Stock:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       id="product_stock" 
                       name="product_stock" 
                       min="0" 
                       value="<?php echo $product_stock?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_description">
                Detailed Description:
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       id="product_description" 
                       name="product_description" 
                       value="<?php echo $product_description ?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_launch_date">
                Launch Date (YYYY-MM-DD):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="date" 
                       id="product_launch_date" 
                       name="product_launch_date" 
                       value="<?php echo $product_launch_date?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_availability">
                Availability Status (on_stock,out_of_stock,coming_soon,discontinued):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="text" 
                       name="product_availability" 
                       value="<?php echo $product_availability?>">
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700" for="product_active">
                Product Active (1=Yes, 0=No):
                <input class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50" 
                       type="number" 
                       name="product_active" 
                       maxlength="1" 
                       value="<?php echo $product_active?>">
            </label>

            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit Changes:
                <input class="p-3 bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold mt-3" 
                       type="submit" 
                       id="send" 
                       name="send" 
                       value="Update product">
            </label>
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
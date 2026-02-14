<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center p-8 bg-gray-50 min-h-screen">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Order Update Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // 1. Inicialización de variables de estado con valores de ERROR por defecto
        $id_order = null;
        $update_output = "ERROR: id_order is missing or data not submitted correctly."; 
        $message_class = "bg-red-100 border-red-500 text-red-700"; 
        
        // Check if POST its retrieved and if if has content 
        if (!isset($_POST['id_order']) || empty($_POST['id_order'])) {
            // El error inicial ya está seteado, no se hace nada más en este bloque
        } else {
            // Open connection
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
            
            // Save the variables y escape input
            $id_order = mysqli_escape_string($conn, $_POST['id_order']);
    
            // Aquí se corrige la variable POST según el formulario que incluiste
            $order_id_customer = mysqli_escape_string($conn,$_POST['id_order']); // ¡Cuidado con la inconsistencia de nombres de POST!
            $order_id_product = mysqli_escape_string($conn,$_POST['order_id_product']);
            $order_id_payment_method = mysqli_escape_string($conn,$_POST['order_id_payment_method']);
            $order_qty = mysqli_escape_string($conn,$_POST['order_qty']);
            $oder_unit_price = mysqli_escape_string($conn,$_POST['oder_unit_price']);
            $order_total = mysqli_escape_string($conn,$_POST['order_total']);
            $order_date = mysqli_escape_string($conn,$_POST['order_date']);
            $order_canceled = mysqli_escape_string($conn,$_POST['order_canceled']);

            $sql = 
            "UPDATE `022_orders`
            SET
                id_customer = $order_id_customer,
                id_product = $order_id_product,
                id_payment_method = $order_id_payment_method,
                qty = $order_qty,
                unit_price = '$oder_unit_price',
                total = '$order_total',
                canceled = $order_canceled,
                order_updated_date = CURRENT_TIMESTAMP()
                
            WHERE id_order = $id_order
            ;";

            // Execute the query 
            $query_result = mysqli_query($conn, $sql);
            
            if ($query_result) {
                // Mensaje de éxito
                $update_output = "Records Successfully updated for Order ID: " . $id_order;
                $message_class = "bg-green-100 border-green-500 text-green-700";
            } else {
                // Mensaje de error de Base de Datos
                $update_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }
            
            // Close the connection
            mysqli_close($conn);
        }

        // 2. Mostrar el resultado con el estilo correspondiente (éxito o error)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4'>" . 
               "<p class='font-bold'>%s</p>" . 
               "</div>", $message_class, $update_output);
        ?>

        <div class="mt-8">
             <a href="/student022/backend/orders/orders.php" 
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                 View Orders
             </a>
        </div>
        
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
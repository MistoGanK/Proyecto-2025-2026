<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen bg-gray-50">
    
    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Order Insertion Result</h1>
        
        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php
        
        // Inicialización de variables de estado
        $insert_output = "ERROR: Order data is missing or incomplete."; 
        $message_class = "bg-red-100 border-red-500 text-red-700";
        $success = false;
        
        // Variables (capturadas de POST y con valores por defecto para visualización en caso de error)
        $id_order = isset($_POST['id_order']) ? $_POST['id_order'] : 'N/A';
        $order_id_customer = isset($_POST['order_id_customer']) ? $_POST['order_id_customer'] : 'N/A';
        $order_id_product = isset($_POST['order_id_product']) ? $_POST['order_id_product'] : 'N/A';
        $order_id_payment_method = isset($_POST['order_id_payment_method']) ? $_POST['order_id_payment_method'] : 'N/A';
        $order_qty = isset($_POST['order_qty']) ? $_POST['order_qty'] : 0;
        $order_discount_rate_raw = isset($_POST['order_discount_rate']) ? $_POST['order_discount_rate'] : 0; // Tasa sin convertir
        $order_discount_rate = $order_discount_rate_raw / 100; // Tasa convertida
        
        $order_unit_price = 0;
        $order_total = 0;
        
        // Conexión y Lógica
        if ($id_order != 'N/A' && $order_id_product != 'N/A') {

            // Connection 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

            // Esto asegura que estén definidas para la consulta INSERT, incluso si la búsqueda de precio falla.
            $safe_id_order = mysqli_escape_string($conn, $id_order);
            $safe_id_customer = mysqli_escape_string($conn, $order_id_customer);
            // ESTA ES LA CLAVE: $safe_order_id_product debe estar definida aquí
            $safe_order_id_product = mysqli_escape_string($conn, $order_id_product); 
            $safe_id_payment_method = mysqli_escape_string($conn, $order_id_payment_method);
            $safe_qty = mysqli_escape_string($conn, $order_qty);
            // $safe_unit_price, $safe_total, y $safe_discount_rate se definirán más abajo.
            
            // --- A. Query the unit price (usando la versión saneada del ID) ---
            $order_unit_price_query = "SELECT price FROM `022_products` WHERE id_product = '$safe_order_id_product';";
            $order_unit_price_query_result = mysqli_query($conn, $order_unit_price_query);

            if($order_unit_price_query_result && mysqli_num_rows($order_unit_price_query_result) > 0){
                
                $row = mysqli_fetch_assoc($order_unit_price_query_result);
                $order_unit_price = $row['price'];

                // Calculate total
                $order_total = ($order_qty * $order_unit_price) * (1 - $order_discount_rate);
                
                // SQL INSERT INTO order
                // Sanitize las variables calculadas AHORA que ya tenemos sus valores
                $safe_unit_price = mysqli_escape_string($conn, $order_unit_price);
                $safe_total = mysqli_escape_string($conn, $order_total);
                $safe_discount_rate = mysqli_escape_string($conn, $order_discount_rate);

                $sql = "
                INSERT INTO `022_orders` (id_order, id_customer, id_product, id_payment_method, qty, unit_price, total, discount)
                VALUES (
                    '$safe_id_order',
                    '$safe_id_customer',
                    '$safe_order_id_product',
                    '$safe_id_payment_method',
                    '$safe_qty',
                    '$safe_unit_price',
                    '$safe_total',
                    '$safe_discount_rate'
                );";

                // Execute INSERT query
                if (mysqli_query($conn, $sql)) {
                    $insert_output = "Order **#$id_order** inserted successfully.";
                    $message_class = "bg-green-100 border-green-500 text-green-700";
                    $success = true;
                } else {
                    $insert_output = "Database Error on INSERT: " . mysqli_error($conn);
                    $message_class = "bg-red-100 border-red-500 text-red-700";
                }

            } else {
                // Error: Product not found or price query failed
                $insert_output = "Error: Product with ID **$order_id_product** not found or price query failed: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }

            // Close connection
            mysqli_close($conn);
        }
        
        // 3. Mostrar el resultado (Caja de estado)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4 text-left'>" . 
            "<p class='font-bold'>%s</p>" . 
            "</div>", $message_class, $insert_output);
        
        // 4. Mostrar detalles del pedido si la inserción fue exitosa
        if ($success) {
            echo "<p class='text-lg font-semibold text-gray-700 mt-6 mb-2'>Order Summary:</p>";
            echo "<ul class='text-sm text-gray-600 space-y-1 text-left mx-auto max-w-sm'>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Order ID:</span> <span class='font-medium text-[#0A090C]'>$id_order</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Customer ID:</span> <span class='font-medium text-[#0A090C]'>$order_id_customer</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Product ID:</span> <span class='font-medium text-[#0A090C]'>$order_id_product</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Quantity:</span> <span class='font-medium text-[#0A090C]'>$order_qty</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Unit Price:</span> <span class='font-medium text-[#0A090C]'>$$order_unit_price</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1'><span>Discount Rate:</span> <span class='font-medium text-[#0A090C]'>$order_discount_rate_raw%</span></li>";
            echo "<li class='flex justify-between border-b border-gray-100 py-1 font-bold'><span>Total:</span> <span class='text-xl text-green-600'>$$order_total</span></li>";
            echo "</ul>";
        }
        
        ?>

        <div class="mt-8">
            <a href="/student022/shop/backend/orders/orders.php" 
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                View Orders
            </a>
        </div>
        
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
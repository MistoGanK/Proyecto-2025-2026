<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex flex-col items-center justify-center p-12 min-h-screen bg-[#F8F9FA]">

    <div class="w-full max-w-2xl h-fit bg-white shadow-2xl rounded-[2.5rem] border border-gray-100">

        <div class="bg-[#0A090C] p-10 flex flex-col items-center justify-center relative">
            <div class="w-12 h-12 bg-blue-500/10 rounded-full flex items-center justify-center border border-blue-500/20 mb-4 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h1 class="text-2xl font-black tracking-tighter text-white italic uppercase text-center">
                Order <span class="text-gray-400 not-italic font-light">Transaction Report</span>
            </h1>
        </div>

        <div class="p-10 text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-4">System Transaction Log</p>

            <?php
            $insert_output = "ERROR: Order data is missing or incomplete.";
            $message_class = "bg-red-50 border-red-500 text-red-700";
            $success = false;

            $id_order = isset($_POST['id_order']) ? $_POST['id_order'] : 'N/A';
            $order_id_customer = isset($_POST['order_id_customer']) ? $_POST['order_id_customer'] : 'N/A';
            $order_id_product = isset($_POST['order_id_product']) ? $_POST['order_id_product'] : 'N/A';
            $order_id_payment_method = isset($_POST['order_id_payment_method']) ? $_POST['order_id_payment_method'] : 'N/A';
            $order_qty = isset($_POST['order_qty']) ? $_POST['order_qty'] : 0;
            $order_discount_rate_raw = isset($_POST['order_discount_rate']) ? $_POST['order_discount_rate'] : 0;
            $order_discount_rate = $order_discount_rate_raw / 100;

            $order_unit_price = 0;
            $order_total = 0;

            if ($id_order != 'N/A' && $order_id_product != 'N/A') {
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

                $safe_id_order = mysqli_escape_string($conn, $id_order);
                $safe_id_customer = mysqli_escape_string($conn, $order_id_customer);
                $safe_order_id_product = mysqli_escape_string($conn, $order_id_product);
                $safe_id_payment_method = mysqli_escape_string($conn, $order_id_payment_method);
                $safe_qty = mysqli_escape_string($conn, $order_qty);

                $order_unit_price_query = "SELECT price FROM `022_products` WHERE id_product = '$safe_order_id_product';";
                $order_unit_price_query_result = mysqli_query($conn, $order_unit_price_query);

                if ($order_unit_price_query_result && mysqli_num_rows($order_unit_price_query_result) > 0) {
                    $row = mysqli_fetch_assoc($order_unit_price_query_result);
                    $order_unit_price = $row['price'];
                    $order_total = ($order_qty * $order_unit_price) * (1 - $order_discount_rate);

                    $safe_unit_price = mysqli_escape_string($conn, $order_unit_price);
                    $safe_total = mysqli_escape_string($conn, $order_total);
                    $safe_discount_rate = mysqli_escape_string($conn, $order_discount_rate);

                    $sql = "INSERT INTO `022_orders` (id_order, id_customer, id_product, id_payment_method, qty, unit_price, total, discount)
                            VALUES ('$safe_id_order', '$safe_id_customer', '$safe_order_id_product', '$safe_id_payment_method', '$safe_qty', '$safe_unit_price', '$safe_total', '$safe_discount_rate');";

                    if (mysqli_query($conn, $sql)) {
                        $insert_output = "SUCCESS: Order #$id_order has been successfully processed and committed.";
                        $message_class = "bg-green-50 border-green-500 text-green-700";
                        $success = true;
                    } else {
                        $insert_output = "Database Error: " . mysqli_error($conn);
                        $message_class = "bg-red-50 border-red-500 text-red-700";
                    }
                } else {
                    $insert_output = "Critical Error: Product ID $order_id_product not found.";
                    $message_class = "bg-red-50 border-red-500 text-red-700";
                }
                mysqli_close($conn);
            }

            // Status Box Style 
            printf("<div class='p-6 border-l-4 %s rounded-2xl mt-4 text-left shadow-sm transition-all'>" .
                "<p class='font-black uppercase text-[10px] tracking-widest mb-1 opacity-70'>Transaction Status</p>" .
                "<p class='text-sm font-bold'>%s</p>" .
                "</div>", $message_class, $insert_output);

            // Result if success
            if ($success) {
                echo "<div class='mt-10 bg-gray-50 p-8 rounded-[2rem] border border-gray-100'>";
                echo "<p class='text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6'>Order Details Summary</p>";
                echo "<div class='grid grid-cols-1 gap-3'>";
                
                $order_data = [
                    'Order Identifier' => "#".$id_order,
                    'Customer Ref' => $order_id_customer,
                    'Product Ref' => $order_id_product,
                    'Quantity' => $order_qty . " Units",
                    'Unit Price' => "€" . number_format($order_unit_price, 2),
                    'Discount Applied' => $order_discount_rate_raw . "%"
                ];

                foreach ($order_data as $label => $value) {
                    echo "<div class='flex justify-between items-center py-2 border-b border-gray-200/50'>";
                    echo "<span class='text-[10px] font-black uppercase text-gray-400 tracking-tighter'>$label</span>";
                    echo "<span class='text-sm font-bold text-gray-900'>$value</span>";
                    echo "</div>";
                }

                echo "<div class='flex justify-between items-center pt-6 mt-2'>";
                echo "<span class='text-xs font-black uppercase text-gray-900'>Total Amount</span>";
                echo "<span class='text-2xl font-black text-blue-600 tracking-tighter'>€" . number_format($order_total, 2) . "</span>";
                echo "</div>";
                
                echo "</div></div>";
            }
            ?>

            <div class="mt-10">
                <a href="/student022/backend/orders/orders.php"
                    class="w-full p-5 bg-[#0A090C] text-white rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl hover:bg-gray-800 transition-all block">
                    Return to Order Management
                </a>
            </div>

        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>
<?php include(__DIR__ . "/../../../functions/access/userAuth.php"); ?>

<section class="flex justify-center items-start p-8 min-h-screen bg-gray-50/50">

    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2rem] border border-gray-100 overflow-hidden h-fit">
        
        <div class="bg-black p-10 text-center">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter italic">
                Checkout <span class="font-light not-italic opacity-70">Result</span>
            </h1>
        </div>

        <div class="p-10 text-center">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Operation Status</p>

            <?php
            $id_customer = $_SESSION['id_customer'];
            $checkout_output = "ERROR: shopping cart data is missing or incomplete.";
            $message_class = "bg-red-50 text-red-600 border-red-100";
            $success = false;

            if (isset($_POST['send'])) {
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

                // Obtain new id
                $sqlGetNewIdOrder = "SELECT COALESCE((SELECT id_order FROM `022_orders` ORDER BY id_order DESC LIMIT 1)+1,0) AS new_id_order;";
                $sqlGetNewIdOrderResult = mysqli_query($conn, $sqlGetNewIdOrder);
                $fetchNewIdOrder = mysqli_fetch_all($sqlGetNewIdOrderResult, MYSQLI_ASSOC);
                $newIdOrder = $fetchNewIdOrder[0]['new_id_order'];

                $sqlCartCheckout = "CALL cartCheckout($id_customer,$newIdOrder)";
                $sqlCleanCart = "DELETE FROM `022_shopping_cart` WHERE id_customer = $id_customer";
                $sqlOrder = "SELECT * FROM `022_view_orders` WHERE id_customer = $id_customer AND id_order = (SELECT id_order FROM `022_view_orders` WHERE id_customer = $id_customer ORDER BY id_order DESC LIMIT 1)";

                if ($sqlCartCheckoutResult = mysqli_query($conn, $sqlCartCheckout)) {
                    $checkout_output = "Checkout successful";
                    $message_class = "bg-green-50 text-green-600 border-green-100";
                    $success = true;

                    if ($sqlOrderResult = mysqli_query($conn, $sqlOrder)) {
                        mysqli_query($conn, $sqlCleanCart);
                        // Query logic
                        $sqlCheckSupplierProduct = 
                            "SELECT 
                                id_supplier,
                                id_order,
                                supplier_product_code as product_code,
                                qty as product_quantity,
                                order_date,
                                IFNULL(forename, 'noForename') as customer_forename,
                                IFNULL(surname, 'noSurname') as customer_surname,
                                IFNULL(dni, 'noNif') as customer_nif,
                                IFNULL(email, 'noEmail') as customer_email,
                                IFNULL(phone_number, 'noPhoneNumber') as customer_phone,
                                'noAddress' as customer_address,
                                IFNULL(location, 'noLocation') as customer_location,
                                IFNULL(country, 'noCountry') as customer_country,
                                IFNULL(zip_code, 'noZipCode') as customer_zip
                            FROM `022_view_orders`
                            WHERE id_order = $newIdOrder 
                            AND id_supplier IS NOT NULL;";
                        
                        $resultCheckSupllierProduct = mysqli_query($conn, $sqlCheckSupplierProduct);

                        if (mysqli_num_rows($resultCheckSupllierProduct) >= 1) {
                            $orderItems = mysqli_fetch_all($resultCheckSupllierProduct, MYSQLI_ASSOC);
                            $orderApi = [];
                            foreach ($orderItems as $item) { 
                                $orderApi[$item['id_supplier']][] = $item; 
                            }

                            $sqlSuppliers = "SELECT * FROM `022_view_suppliers_endpoints`";
                            $suppliersResult = mysqli_query($conn, $sqlSuppliers);
                            $suppliersInfo = mysqli_fetch_all($suppliersResult, MYSQLI_ASSOC);

                            foreach ($suppliersInfo as $supplierInfo) {
                                $sid = $supplierInfo['id_supplier'];
                                // Only iterate id_suppliers that exist on the customer shopping cart
                                if (isset($orderApi[$sid])) {
                                    $supplierApyKey = $supplierInfo['api_key'];
                                    $supplierEndpoint = $supplierInfo['api_endpoint_orders'];
                                    $supplierOrder = json_encode($orderApi[$sid], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                                    
                                    $supplierUrl = $supplierEndpoint . $supplierApyKey . "&orders_json=" . urlencode($supplierOrder);
                                    // printr_($supplierUrl);
                                    // print_r(" ----------------------- ");
       
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, trim($supplierUrl));
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                    curl_setopt($ch, CURLOPT_HTTPGET, true);
                                    $response = curl_exec($ch);
                                    curl_close($ch);

                                    print_r($supplierUrl);
                                }
                            }
                        }
                    }
                } else {
                    $checkout_output = "Database Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            }

            // Status Badge
            printf("<div class='mb-8 p-4 rounded-2xl border %s font-black text-xs uppercase tracking-widest'>%s</div>", $message_class, $checkout_output);

            if ($success) {
                $orderFetch = mysqli_fetch_all($sqlOrderResult, MYSQLI_ASSOC);
                $total = 0;
                $payment_method = $orderFetch[0]['payment_method_name'];
                $order_date = $orderFetch[0]['order_date'];
            ?>
                <div class="text-left mb-8">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Receipt Reference</p>
                    <p class="text-4xl font-black tracking-tighter text-gray-900 uppercase italic">#ORD-<?php echo $orderFetch[0]['id_order']; ?></p>
                </div>

                <div class="space-y-4 mb-10 text-left">
                    <p class="text-[11px] font-black text-gray-900 uppercase tracking-[0.2em] border-b border-gray-100 pb-2">Items Summary</p>
                    <div class="divide-y divide-gray-50">
                        <?php foreach ($orderFetch as $orderLine): ?>
                            <div class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-black text-gray-900 uppercase italic tracking-tight"><?php echo $orderLine['product_name']; ?></p>
                                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Qty: <?php echo $orderLine['qty']; ?> | Unit: <?php echo $orderLine['unit_price']; ?>€</p>
                                </div>
                                <span class="font-bold text-gray-900 text-lg"><?php echo number_format($orderLine['total'], 2); ?>€</span>
                            </div>
                            <?php $total += $orderLine['total']; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-[1.5rem] p-8 space-y-4 mb-10">
                    <div class="flex justify-between text-sm">
                        <span class="font-bold text-gray-400 uppercase text-[10px] tracking-widest">Method</span>
                        <span class="font-black text-gray-900 uppercase italic"><?php echo $payment_method; ?></span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="font-black text-gray-900 uppercase text-sm">Total Paid</span>
                        <span class="text-4xl font-black text-black tracking-tighter"><?php echo number_format($total, 2); ?>€</span>
                    </div>
                </div>

            <?php
                // Protection mail sending
                try {
                    $mailPath = __DIR__ . '/../../../scripts/mail/orderMail.php';
                    if (file_exists($mailPath)) {
                        include_once($mailPath);
                        if (function_exists('sendOrderMail')) {
                            sendOrderMail($orderFetch);
                        }
                    }
                } catch (Exception $e) {
                }
            }
            ?>

            <div class="mt-8">
                <a href="/student022/backend/orders/orders.php"
                    class="w-full inline-block py-5 bg-black text-white rounded-[1.2rem] font-black text-[10px] uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    View My Orders
                </a>
            </div>

        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
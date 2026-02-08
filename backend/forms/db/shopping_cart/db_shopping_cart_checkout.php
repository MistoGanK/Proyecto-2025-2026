<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen">

    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">

        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Checkout Result</h1>

        <p class="text-lg font-semibold text-gray-700 mb-4">Operation Status:</p>

        <?php

        $id_customer = $_SESSION['id_customer'];
        $checkout_output = "ERROR: shopping cart data is missing or incomplete.";
        $message_class = "bg-red-100 border-red-500 text-red-700";
        $success = false;

        if (isset($_POST['send'])) {

            // Connection 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

            // Get the new id
            $sqlGetNewIdOrder = "SELECT COALESCE((SELECT id_order FROM `022_orders` ORDER BY id_order DESC LIMIT 1)+1,0) AS new_id_order;";
            $sqlGetNewIdOrderResult = mysqli_query($conn, $sqlGetNewIdOrder);
            $fetchNewIdOrder = mysqli_fetch_all($sqlGetNewIdOrderResult, MYSQLI_ASSOC);
            $newIdOrder = $fetchNewIdOrder[0]['new_id_order'];

            // SQL CHECKOUT INSERT 
            $sqlCartCheckout = "CALL cartCheckout($id_customer,$newIdOrder)";
            $sqlCleanCart = "DELETE FROM `022_shopping_cart` WHERE id_customer = $id_customer";
            $sqlOrder = "SELECT * FROM `022_view_orders` WHERE id_customer = $id_customer AND id_order = (SELECT id_order FROM `022_view_orders` WHERE id_customer = $id_customer ORDER BY id_order DESC LIMIT 1)";

            // mysqli_query
            $sqlCartCheckoutResult;
            $sqlOrderResult;

            if ($sqlCartCheckoutResult = mysqli_query($conn, $sqlCartCheckout)) {
                $checkout_output = "Checkout successful";
                $message_class = "bg-green-100 border-green-500 text-green-700";
                $success = true;

                if ($sqlOrderResult = mysqli_query($conn, $sqlOrder)) {
                    // Clean the cart
                    $sqlCleanCartResutl = mysqli_query($conn, $sqlCleanCart);

                    // Check if was suppliers product
                    $sqlCheckSupplierProduct = 
                    "SELECT 
                        id_supplier AS id_supplier,
                        id_order AS order_number,
                        supplier_product_code AS product_code,
                        qty AS product_quantity,
                        order_date AS order_placed_on,
                        IFNULL(forename, 'noForename') AS customer_forename,
                        IFNULL(surname, 'noSurname') AS customer_surname,
                        IFNULL(dni, 'noNif') AS customer_nif,
                        IFNULL(email, 'noEmail') AS customer_email,
                        IFNULL(phone_number, 'noPhoneNumber') AS customer_phone,
                        'noAddress' AS customer_address,
                        IFNULL(location, 'noLocation') AS customer_location,
                        IFNULL(country, 'noCountry') AS customer_country,
                        IFNULL(zip_code, 'noZipCode') AS customer_zip

                    FROM `022_view_orders`
                    WHERE id_order = $newIdOrder AND id_supplier IS NOT NULL;";

                    $resultCheckSupllierProduct = mysqli_query($conn, $sqlCheckSupplierProduct);

                    if (mysqli_num_rows($resultCheckSupllierProduct) >= 1) {
                        $orderItems = mysqli_fetch_all($resultCheckSupllierProduct, MYSQLI_ASSOC);

                        $orderApi = [];
                        foreach ($orderItems as $orderItem) {
                            $orderApi[$orderItem['id_supplier']][] = $orderItem;
                        }

                        $id_suppliers = array_keys($orderApi);
                        print_r($orderApi);

                        echo "<hr>";
                        print_r($id_suppliers);

                        // Getting API + ORDER ENDPOINT
                        $sqlSuppliers = "SELECT * FROM `022_view_suppliers_endpoints`";
                        $suppliersResult = mysqli_query($conn, $sqlSuppliers);
                        $suppliersInfo = mysqli_fetch_all($suppliersResult, MYSQLI_ASSOC);

                        // The complete JSON order
                        echo "-------------- FOREACH ------------------";
                        foreach ($id_suppliers as $id_supplier) {

                            $supplie_order = ($orderApi[$id_supplier]);
                        }
                        // ! NOT SECURE, SHOULDNT BE DEPENDABLE TO ID_SUPPLIER
                        foreach ($suppliersInfo as $supplierInfo) {
                            // Suppliers Endpoints Credentials
                            $supplierApyKey = $supplierInfo['api_key'];
                            $supplierEndpoint = $supplierInfo['api_endpoint_orders'];

                            // JSON supplier order
                            // $supplierOrder = json_encode($orderApi[$supplierInfo['id_supplier']]);
                            $supplierOrder = json_encode($orderApi[$supplierInfo['id_supplier']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

                            // Call endpoint
                            $supplierUrl = $supplierEndpoint . $supplierApyKey . "&orders_json=" . urlencode($supplierOrder);

                            $ch = curl_init();

                            $headers = array(
                                "Content-Type: application/json"
                            );

                            // URL configuration
                            curl_setopt($ch, CURLOPT_URL, trim($supplierUrl));
                            // Pass headers
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            // Response as a string
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            // SSL bypass
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            // Host name bypass
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                            // Sending protocol explicit
                            curl_setopt($ch, CURLOPT_HTTPGET, true);

                            $response = curl_exec($ch);
                            // Debugging
                            echo "<br>";
                            print_r($supplierUrl);
                            echo "<br>";
                            print_r($supplierOrder);
                            echo "<br>";

                            if (curl_errno($ch)) {
                                echo 'Error de cURL ' . curl_error($ch);
                            } else {
                                echo 'Response arrived ' . $response;
                            }
                            curl_close($ch);
                        }

                        // $result = json_encode($resultCheckSupllierProduct);

                    }
                } else {
                    echo "Error on saving the order: ", mysqli_error($conn);
                }
            } else {
                $checkout_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
                $success = false;
            }
            // Close the connection
            mysqli_close($conn);
        }
        $payment_method;
        $order_date;
        $total = 0;
        // 3. Mostrar el resultado (Caja de estado)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4 text-left'>" .
            "<p class='font-bold'>%s</p>" .
            "</div>", $message_class, $checkout_output);
        // Show order result if succesfully
        if ($success) {
            $orderFetch = mysqli_fetch_all($sqlOrderResult, MYSQLI_ASSOC);
            echo "<p class='text-3xl font-bold mt-4'>" . "ID Order:" . $orderFetch[0]['id_order'] . "</p>";
            echo "<p class='text-lg font-semibold text-gray-700 mt-6 mb-2'>Order Summary:</p>";
            echo "<ul class='text-sm text-gray-600 space-y-1 text-left mx-auto max-w-sm'>";
            foreach ($sqlOrderResult as $orderLine) {
                echo "<li class='text-2xl font-bold'>" . $orderLine['product_name'] . "</li>";
                echo "<li>" . "<span class='text-lg font-semibold'>Quantity: </span>" . $orderLine['qty'] . "</li>";
                echo "<li>" . "<span class='text-lg font-semibold'>Unit Price: </span>" . $orderLine['unit_price'] . "€" . "</li>";
                echo "<li>" . "<span class='text-lg font-semibold'>Discount: </span>" . $orderLine['discount'] . "%" . "</li>";
                echo "<li>" . "<span class='text-lg font-semibold'>subtotal: </span>" . $orderLine['total'] . "€" . "</li>";
                $payment_method = $orderLine['payment_method_name'];
                $order_date = $orderLine['order_date'];
                $total += $orderLine['qty'] * $orderLine['unit_price'];
            }
            echo "<div class='flex flex-col mt-6'>";
            echo "<li class='text-lg'>" . "<span class='text-lg font-semibold'>Payment method: </span>" . $payment_method . "</li>";
            echo "<li class='text-lg'>" . "<span class='text-lg font-semibold'>Order date: </span>" . $order_date . "</li>";
            echo "<li class='flex justify-between text-3xl font-bold mt-6'>" . "<span class='text-2xl font-semibold'>Total </span>" . $total . "€" . "</li>";
            echo "</div>";
            echo "</ul>";

            // Send the email
            // Get the function orderMail.php
            include(__DIR__ . '/student022/backend/scripts/mail/orderMail.php');
            /* 
                SUBJECT > ticket order number
                BODY > TICKET
                altBody > indentificar
                */
            $body = "
                <h1>Ticket del Orden: $newIdOrder</h1>
                <p></p>
                ";
        }
        ?>

        <!-- Redirigir  -->
        <div class="mt-8">
            <a href="/student022/backend/orders/orders.php"
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                Mi Orders
            </a>
        </div>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
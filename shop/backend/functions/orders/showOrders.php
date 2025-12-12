<?php
function showOrders($query_result, $conn)
{
    // 1. Verificar si la consulta inicial tuvo éxito
    if ($query_result) {
        // 2. Verificar si se devolvió alguna fila (pedidos)
        if (mysqli_num_rows($query_result) > 0) {
            
            $orders = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

            // BUCLE EXTERNO: Itera sobre cada pedido principal (Order ID)
            foreach ($orders as $order) {
                // Reiniciar el total para cada nuevo pedido
                $total = 0; 

                $id_order = $order['id_order'];

                $queryGroupOrders = "SELECT * FROM `022_view_orders` WHERE id_order = $id_order";
                
                $resultGroupOrders = mysqli_query($conn, $queryGroupOrders);
                $fetchGroupOrders = mysqli_fetch_all($resultGroupOrders, MYSQLI_ASSOC);

                echo "<article class='w-full h-fit border border-gray-700/20 p-4 mb-4 rounded-lg shaSdow-xl bg-white'>";
                echo "<h2 class='text-xl font-bold'>Order ID: $id_order</h2>";
                echo '<div class="order-lines-container my-3 space-y-2">';

                foreach ($fetchGroupOrders as $currentOrder) {
                    
                    $canceled_style = '';
                    $canceled_text = '';
                    // Values that we save for the review call
                    $currendIdOrder = $currentOrder['id_order'];
                    $currendIdProduct = $currentOrder['id_product'];
                    $currendProductName = $currentOrder['product_name'];

                    // Show all lines of current order
                    echo "<div class='border-b border-gray-100 pb-2 bg-gray-100/50 border-2 rounded-2xl p-4'>";
                    echo "<p class='text-gray-500'><span class='text-black text-lg font-semibold'>Product: </span>" . $currentOrder['product_name'] . "</p>";
                    echo "<p class='text-gray-500'><span class='text-black font-semibold'>Qty: </span>" . $currentOrder['qty'] . "</p>";
                    echo "<p class='text-gray-500'><span class='text-black font-semibold'>Price: </span>" . $currentOrder['unit_price'] . "€</p>";
                    echo "<p class='text-gray-500'><span class='text-black font-semibold'>Discount: </span>" . $currentOrder['discount'] . "%</p>";
                    echo "<p class='text-gray-500'><span class='text-black font-semibold'>Total Line: </span>" . $currentOrder['total'] . "€</p>";
                    echo "<div class='p-1 flex items-center justify-center'>";
                    // If never reviwed, access to review button
                    echo "<div class='p-1 flex items-center justify-center p-3 mb-2 mt-2 rounded-xl w-full
                                    text-[#ffffff]
                                    bg-[#000001]
                                    hover:bg-gray-950/90
                                    cursor-pointer
                                    '>";
                    if ($currentOrder['is_reviewd'] == 0){
                        include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_review_call.php');
                    // If reviewd edit the comment
                    }else{
                        include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_edit_review_call.php');
                    }
                    echo "</div>";
                    echo "</div>";
                    // Determinar el estilo de cancelación
                    if ($currentOrder['canceled'] == 1) {
                        $canceled_style = 'text-red-600 font-bold';
                        $canceled_text = 'Yes (Canceled)';
                    } else {
                        $canceled_style = 'text-green-600 font-regular';
                        $canceled_text = 'No';
                    }
                    echo "<p class='$canceled_style'>Canceled: " . $canceled_text . "</p>";
                    echo "</div>";
                    $total += $currentOrder['total'];
                };

                echo '</div>';

                // Footer del pedido
                echo '<footer>';
                echo "<p class='font-bold text-lg'>Total Order: " . number_format($total, 2) . "€</p>"; // Formateado el total
                
                echo "<p class='text-sm text-gray-500'>Payment Method: " . ($currentOrder['payment_method_name'] ?? 'N/A') . "</p>"; 
                echo '</footer>';
                
                // Form Buttons container
                echo ("<div class='flex justify-evenly items-end h-full mt-4 pt-3 border-t border-gray-200'>");
                
                // Botones de Admin
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                    // Delete Button Container
                    echo "<div class='p-1
                                    hover:cursor-pointer
                                    hover:text-white
                                    hover:bg-red-600
                                    hover:rounded-md
                                    '>";
                    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/orders/form_order_delete_call.php');
                    echo "</div>";
                    
                    // Update Button Container
                    echo "<div class='p-1
                                    hover:text-[#ffffff]
                                    hover:rounded-md
                                    hover:bg-[#000001]
                                    cursor-pointer
                                    '>";
                    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/orders/form_order_update_call.php');
                    echo "</div>";
                }
                // Select Button Container (para todos los roles)
                echo "<div class='p-1
                                hover:text-[#ffffff]
                                hover:rounded-md
                                hover:bg-[#000001]
                                cursor-pointer
                                '>";
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/orders/form_order_select.php');
                echo "</div>";

                echo ("</div>");

                echo "</article>"; 
            }
        
        } else {
            // No se encontraron filas
            $order_output = "No orders found.";
            echo "<p class='text-red-500 font-bold mt-5'>" . $order_output . "</p>";
        }
    } else {
        // Error de ejecución
        $order_output = "Database Error: " . mysqli_error($conn);
        echo "<p class='text-red-500 font-bold mt-5'>" . $order_output . "</p>";
    }

    // Liberar el resultado
    if (isset($query_result) && is_object($query_result)) {
        mysqli_free_result($query_result);
    }
};

?>
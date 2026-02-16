<?php
/**
 * Displays a list of orders with their details and action buttons.
 * @param mysqli_result $query_result Result of the initial order query.
 * @param mysqli $conn Database connection.
 */
function showOrders($query_result, $conn)
{
    // Base class
    $dynamic_button_base = "p-2 rounded-lg transition-colors duration-200 cursor-pointer flex-1 text-center text-sm font-semibold uppercase tracking-wide flex-shrink-0";
    
    // Class for Admin/Select buttons
    $black_button_classes = $dynamic_button_base . " bg-black text-white hover:bg-gray-800";
    $delete_button_classes = $dynamic_button_base . " bg-black text-white hover:bg-red-600";

    if ($query_result) {
        if (mysqli_num_rows($query_result) > 0) {
            
            $orders = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

            foreach ($orders as $order) {
                
                $total = 0; 
                $id_order = $order['id_order'];

                $queryGroupOrders = "SELECT * FROM `022_view_orders` WHERE id_order = $id_order";
                $resultGroupOrders = mysqli_query($conn, $queryGroupOrders);
                $fetchGroupOrders = mysqli_fetch_all($resultGroupOrders, MYSQLI_ASSOC);

                echo "<article class='w-full h-fit border border-gray-100 p-6 mb-8 rounded-xl shadow-2xl bg-white transform hover:scale-[1.005] transition duration-300'>";
                
                echo "<header class='pb-4 mb-4 border-b-2 border-gray-300 flex justify-between items-center'>";
                    echo "<div>";
                        echo "<h2 class='text-3xl font-extrabold text-[#0A090C] tracking-wide'>Order #$id_order</h2>";
                        echo "<p class='text-sm text-gray-500 mt-1'>Date: " . ($fetchGroupOrders[0]['order_date'] ?? 'N/A') . "</p>";
                    echo "</div>";
                echo '</header>';
                
                echo '<div class="order-lines-container my-4 space-y-6">';

                foreach ($fetchGroupOrders as $currentOrder) {
                    
                    $currendIdOrder = $currentOrder['id_order'];
                    $currendIdProduct = $currentOrder['id_product'];
                    $currendProductName = $currentOrder['product_name'];
                    
                    $product_img_src = $currentOrder['img_src'] ?? '/student022/backend/assets/images/placeholder.png'; 

                    if ($currentOrder['canceled'] == 1) {
                        $canceled_style = 'bg-red-50 text-red-700 border-red-300';
                        $canceled_tag = '<span class="text-xs font-bold ml-2">(CANCELED)</span>';
                    } else {
                        $canceled_style = 'bg-white border-gray-100';
                        $canceled_tag = '';
                    }

                    echo "<div class='p-4 border-l-4 border-[#0A090C] $canceled_style rounded-r-lg transition-all flex items-start space-x-4'>";

                        echo "<div class='w-16 h-16 flex-shrink-0 rounded-md overflow-hidden border border-gray-200 bg-white'>";
                            echo "<img class='w-full h-full object-contain' src='" . $product_img_src . "' alt='Product thumbnail'>";
                        echo "</div>";

                        echo "<div class='flex-grow'>";
                        
                            echo "<div class='flex justify-between items-center mb-2'>";
                                echo "<p class='text-lg font-bold text-gray-800 flex-grow'>" . $currendProductName . $canceled_tag . "</p>";
                                
                                if ($currentOrder['discount'] > 0) {
                                    echo "<span class='text-sm font-medium text-purple-600'>-" . $currentOrder['discount'] . "%</span>";
                                }
                            echo "</div>";

                            echo "<div class='grid grid-cols-3 gap-x-4 text-sm text-gray-600 mt-1'>";
                                echo "<div><span class='font-medium'>Qty:</span> " . $currentOrder['qty'] . "</div>";
                                echo "<div><span class='font-medium'>Price:</span> " . number_format($currentOrder['unit_price'], 2) . "€</div>";
                                echo "<div class='text-right font-extrabold text-base text-[#0A090C]'>". number_format($currentOrder['total'], 2) . "€</div>";
                            echo "</div>";
                            
                            echo "<div class='mt-4 flex justify-end'>"; 

                                $review_button_base = "p-1.5 px-4 rounded-lg w-fit text-sm font-semibold transition-colors duration-200 cursor-pointer text-center";

                                if ($currentOrder['is_reviewd'] == 0) {
                                    $button_style = "bg-black text-white hover:bg-gray-800";
                                } else {
                                    $button_style = "bg-transparent text-gray-700 border border-gray-400 hover:bg-gray-100";
                                }
                                
                                echo "<div class='$review_button_base $button_style'>";
                                
                                if ($currentOrder['is_reviewd'] == 0){
                                    include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/products/form_product_review_call.php');
                                } else {
                                    include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/products/form_product_edit_review_call.php');
                                }
                                echo "</div>";
                            echo "</div>"; 
                        
                        echo "</div>"; 

                    echo "</div>"; 
                    
                    $total += $currentOrder['total'];
                };

                echo '</div>'; 

                echo "<footer class='pt-4 mt-4 border-t border-gray-300 flex justify-between items-center'>";
                    echo "<p class='font-extrabold text-2xl text-[#0A090C]'>Order Total: " . number_format($total, 2) . "€</p>"; 
                    echo "<div class='text-right'>";
                        echo "<p class='text-sm text-gray-500'>Payment Method:</p>";
                        echo "<p class='font-semibold text-gray-700'>" . ($currentOrder['payment_method_name'] ?? 'N/A') . "</p>"; 
                    echo "</div>";
                echo '</footer>';
                
                echo ("<div class='flex w-full space-x-3 items-stretch mt-4 pt-3 border-t border-gray-100'>");
                
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                    echo "<div class='$delete_button_classes'>";
                        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/orders/form_order_delete_call.php');
                    echo "</div>"; 
                    
                    echo "<div class='$black_button_classes'>";
                        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/orders/form_order_update_call.php');
                    echo "</div>"; 
                }
                
                $select_class = (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') ? $black_button_classes : $dynamic_button_base . " bg-black text-white hover:bg-gray-800";
                
                echo "<div class='$select_class'>";
                    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/orders/form_order_select.php');
                echo "</div>";

                echo ("</div>"); 

                echo "</article>"; 
            }
        
        } else {
            $order_output = "No orders found.";
            echo "<p class='text-red-500 font-bold mt-5'>" . $order_output . "</p>";
        }
    } else {
        $order_output = "Database Error: " . mysqli_error($conn);
        echo "<p class='text-red-500 font-bold mt-5'>" . $order_output . "</p>";
    }

    if (isset($query_result) && is_object($query_result)) {
        mysqli_free_result($query_result);
    }
};
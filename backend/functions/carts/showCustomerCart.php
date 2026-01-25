<?php
/**
 * Displays customer cart items in a clean, row-based format optimized for manageability.
 * @param mysqli_result $queryResult The result of the SQL query containing cart items.
 */
function showCustomerCart($queryResult) {
    while ($row = mysqli_fetch_assoc($queryResult)) {
        $id_product = $row['id_product'];
        // Calculation of the subtotal per item
        $item_subtotal = $row['price'] * $row['qty']; 

        // Base class: Horizontal row that separates each section
        $cart_item_classes = "flex flex-wrap items-center p-4 shadow-lg rounded-xl bg-white 
                            border border-gray-200 hover:shadow-xl transition-shadow duration-300";
        
        // --- Main Item Container---
        echo "<div class='$cart_item_classes'>";
            
            // 1. IMAGE CONTAINER (Fixed, small square on the left)
            echo "<div class='flex-shrink-0 w-20 h-20 overflow-hidden rounded-md mr-4 bg-gray-100'>";
                echo "<img class='w-full h-full object-cover' src='" . $row['img_src'] . "' alt='Product Image'>";
            echo "</div>";

            // 2. PRODUCT DETAILS (Grows to occupy the central space)
            echo "<div class='flex flex-col flex-grow min-w-0 mr-4'>";
                echo "<h2 class='text-lg font-bold truncate text-gray-900'>" . $row['product_name'] . "</h2>";
            echo "</div>";
            
            // 3. UNIT PRICE (Aligned)
            echo "<div class='flex-shrink-0 w-20 text-right mr-4 hidden sm:block'>";
                echo "<p class='text-sm text-gray-500'>Price</p>";
                echo "<p class='font-semibold text-lg'>" . $row['price'] . "€" . "</p>";
            echo "</div>";

            // 4. QUANTITY CONTROL (+/-)
            echo "<div class='flex items-center justify-evenly flex-shrink-0 w-28 border border-gray-300 rounded-lg h-9 mr-4'>";
                
                // Subtract Button
                echo "<button class='btn_sub_qty hover:scale-130 cursor-pointer px-2 text-xl text-gray-600 hover:text-black transition-colors' id='" . $id_product . "'>-</button>";
                
                // Current Quantity 
                echo "<p id='qty_" . $id_product . "' class='font-medium text-lg w-8 text-center border-l border-r border-gray-300'>" . $row['qty'] . "</p>";
                
                // Add Button
                echo "<button class='btn_add_qty hover:scale-130 cursor-pointer px-2 text-xl text-gray-600 hover:text-black transition-colors' id='" . $id_product . "'>+</button>";
            
            echo "</div>";
            
            // 5. SUBTOTAL PER ITEM
            echo "<div class='flex-shrink-0 w-24 text-right ml-4'>";
              echo "<p class='text-sm text-gray-500'>Subtotal</p>";
              echo "<p id='subtotal_item_" . $id_product . "' class='font-extrabold text-xl text-black'>" . number_format($item_subtotal, 2) . "€" . "</p>";
            echo "</div>";

            // 6. DELETE BUTTON
            echo "<div class='flex-shrink-0 h-10 bg-black rounded text-white h-4 ml-4 p-2 transition-colors duration-200 
                              text-gray-500 hover:bg-red-600'>";
                // RUTA CORREGIDA: Eliminado /shop/
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/shopping_cart/form_delete_product_cart.php');
            echo "</div>";

        echo "</div>"; // Closes Main Item Container
    }
    mysqli_free_result($queryResult);
}
?>
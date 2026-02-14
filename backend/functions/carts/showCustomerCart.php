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

        // Clase base: Fila horizontal con bordes muy redondeados y sombra suave
        $cart_item_classes = "flex flex-wrap items-center p-6 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 mb-4";
        
        // --- Main Item Container---
        echo "<div class='$cart_item_classes'>";
            
            // 1. IMAGE CONTAINER (Fondo gris suave y redondeado)
            echo "<div class='flex-shrink-0 w-24 h-24 overflow-hidden rounded-2xl mr-6 bg-gray-50 p-2 flex items-center justify-center border border-gray-50'>";
                echo "<img class='max-w-full max-h-full object-contain' src='" . $row['img_src'] . "' alt='Product Image'>";
            echo "</div>";

            // 2. PRODUCT DETAILS (Ocupa el espacio central)
            echo "<div class='flex flex-col flex-grow min-w-[150px] mr-4'>";
                echo "<h2 class='text-xl font-black tracking-tighter text-gray-900 uppercase italic truncate'>" . $row['product_name'] . "</h2>";
                echo "<p class='text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1'>ID: #PROD-" . $id_product . "</p>";
            echo "</div>";
            
            // 3. UNIT PRICE
            echo "<div class='flex-shrink-0 w-24 text-right mr-8 hidden md:block'>";
                echo "<p class='text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1'>Price</p>";
                echo "<p class='font-bold text-lg text-gray-900'>" . number_format($row['price'], 2) . "€" . "</p>";
            echo "</div>";

            // 4. QUANTITY CONTROL (Botones rellenos y estructura de píldora)
            echo "<div class='flex items-center bg-gray-100 rounded-xl h-10 px-1 border border-transparent mr-8'>";
                
                // Subtract Button: Relleno blanco, se vuelve negro al hover
                echo "<button class='btn_sub_qty w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm hover:bg-black hover:text-white cursor-pointer text-gray-900 transition-all font-black' id='" . $id_product . "'>-</button>";
                
                // Current Quantity 
                echo "<p id='qty_" . $id_product . "' class='font-black text-sm w-10 text-center text-gray-900'>" . $row['qty'] . "</p>";
                
                // Add Button: Relleno blanco, se vuelve negro al hover
                echo "<button class='btn_add_qty w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm hover:bg-black hover:text-white cursor-pointer text-gray-900 transition-all font-black' id='" . $id_product . "'>+</button>";
            
            echo "</div>";
            
            // 5. SUBTOTAL PER ITEM
            echo "<div class='flex-shrink-0 w-28 text-right'>";
              echo "<p class='text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1'>Subtotal</p>";
              echo "<p id='subtotal_item_" . $id_product . "' class='font-black text-2xl text-black tracking-tighter'>" . number_format($item_subtotal, 2) . "€" . "</p>";
            echo "</div>";

            // 6. DELETE BUTTON (Botón relleno rojo sólido)
            echo "<div class='flex-shrink-0 ml-6'>";
                echo "<div class='w-14 h-10 flex items-center justify-center rounded-xl bg-red-500 text-white hover:bg-red-700 transition-all duration-300 shadow-md cursor-pointer'>";
                    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/shopping_cart/form_delete_product_cart.php');
                echo "</div>";
            echo "</div>";

        echo "</div>"; // Closes Main Item Container
    }
    mysqli_free_result($queryResult);
}
?>
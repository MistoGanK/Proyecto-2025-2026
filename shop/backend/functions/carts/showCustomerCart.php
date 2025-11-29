<?php
function showCustomerCart($queryResult) {
      while ($row = mysqli_fetch_assoc($queryResult)) {
        // Parent container of product
        $id_product = $row['id_product'];
        echo "<div class='flex flex-col h-fit max-h-110 flex-shrink-0 w-full
                    shadow-xl p-4
                    rounded-lg
                    bg-white
                    border
                    border-gray-700/20
                    '>";
        // Product Container
        echo "<div class='flex flex-col w-full h-full font-sans'>";
        echo "<h2 class='flex justify-start items-center mb-5 text-2xl font-bold'>" . $row['product_name'] . "</h2>";
        // Price + qty container
        echo "<div class='flex justify-between items-center w-full mb-5'>";
        echo "<p class='font-extrabold text-2xl'>" . $row['price'] . "€" . "</p>";
        echo
        "<div class='flex items-center justify-end w-full mr-2'>
                        " . "<button class='btn_add_qty flex items-center p-3 text-2xl hover:scale-150 cursor-pointer' id=" . $row['id_product'] . ">+</button>" . "
                        " . "<button class='btn_sub_qty flex items-center p-3 text-2xl hover:scale-150 cursor-pointer' id=" . $row['id_product'] . ">-</button>" . "
                    </div>";
        echo "<p id='stock_field' class='font-normal w-30 text-sm'>qty: </p>";
        echo "<p class='font-normal w-30 text-sm'>" . $row['qty'] . "</p>";
        echo "</div>";
        // Product Info container
        echo "<div class=' flex flex-col gap-2 text-xs text-gray-600'>";
        echo "</div>";
        // Form Buttons container
        echo ("<div class='flex justify-evenly items-end h-full'>");
        // Delete Button Container
        echo "<div class='p-1
                            hover:cursor-pointer
                            hover:text-white
                            hover:bg-red-600
                            hover:rounded-md
                            '>";
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/shopping_cart/form_delete_product_cart.php');
        echo "</div>";
        echo ("</div>");
        echo ("</div>");
        echo ("</div>");
      }
      mysqli_free_result($queryResult);
};
?>

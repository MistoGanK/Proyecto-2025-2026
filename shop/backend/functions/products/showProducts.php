<?php 
  session_start();
  function showProducts ($products){
     foreach ($products as $product) {
        $availability_style = "";
        if ($product['availability'] == 'on_stock') {
            $availability_style = 'text-green-600 font-regular';
        } else {
            $availability_style = 'text-red-600 font-regular';
        }
        // Parent container of product
        echo "<div class='flex flex-col h-full max-h-110 flex-shrink-0 basis-[calc(33.33%-1.25rem)] 
                    shadow-xl p-4
                    rounded-lg
                    bg-white
                    border
                    border-gray-700/20
                    '>";
        // Product Container
        echo "<div class='flex flex-col w-full h-full font-sans'>";
        echo "<h2 class='flex justify-start items-center mb-5 text-xl font-semibold'>" . $product['product_name'] . "</h2>";
        // Price + qty container
        echo "<div class='flex justify-between w-full mb-5'>";
        echo "<p class='font-extrabold text-2xl'>" . $product['price'] . "€" . "</p>";
        echo "<p class='font-normal text-sm'>" . "stock: " . $product['stock'] . "</p>";
        echo "</div>";
        // Product description
        echo "<p class='font-normal text-sm pb-3 mb-5 border-b border-gray-600/50'>" . $product['description'] . "</p>";
        // Product Info container
        echo "<div class=' flex flex-col gap-2 text-xs text-gray-600'>";
        echo "<p>" . "ID: " . $product['id_product'] . "</p>";
        echo "<p>" . "Inserted_date: " . $product['inserted_date'] . "</p>";
        echo "<p>" . "Updated date: " . $product['updated_date'] . "</p>";
        echo "<p>" . "Launch date: " . $product['launch_date'] . "</p>";
        echo "<p>" . "Availability: " . "<span class='$availability_style'>" . $product['availability'] . "</span></p>";
        echo "<p>" . "Active: " . $product['active'] . "</p>";
        echo "</div>";
        // Form Buttons container
        echo ("<div class='flex justify-evenly items-end h-full'>");

        // Delete Button Container of No Admin user
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
        } else {
            echo "<div class='p-1
                                hover:cursor-pointer
                                hover:text-white
                                hover:bg-red-600
                                hover:rounded-md
                                '>";
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_delete_call.php');
            echo "</div>";

            // Update Button Container
            echo "<div class='p-1
                                hover:text-[#ffffff]
                                hover:rounded-md
                                hover:bg-[#000001]
                                cursor-pointer
                                '>";
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_update_call.php');
            echo "</div>";
        }
        // Only customer is able to add to cart
        if ($_SESSION['role'] == 'Customer'){
             // Add to cart button
            echo "<div class='p-1
                            hover:text-[#ffffff]
                            hover:rounded-md
                            hover:bg-[#000001]
                            cursor-pointer
                            '>";
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/shopping_cart/form_add_product_cart.php');
            echo "</div>";
        }

          // Select Button Container
            echo "<div class='p-1
                        hover:text-[#ffffff]
                        hover:rounded-md
                        hover:bg-[#000001]
                        cursor-pointer
                            '>";
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_select.php');
            echo "</div>";

        echo ("</div>");
        echo ("</div>");
        echo ("</div>");
    }
  };  
?>
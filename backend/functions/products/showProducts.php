<?php
/**
 * Displays a list of products in a card format using Tailwind CSS styles.
 * @param mysqli_result $products The result of the SQL query for the products.
 */
function showProducts($products)
{
  $productsFetch = mysqli_fetch_all($products, MYSQLI_ASSOC); 
  
  // Base class for the dynamic functionality (flex-1 distribution)
  $dynamic_button_base = "p-2 rounded-md transition-colors duration-200 cursor-pointer flex-1 text-center text-xs font-semibold uppercase tracking-wider flex-shrink-0";
  
  // Class for normal buttons (gray/black)
  $normal_button_classes = $dynamic_button_base . " text-gray-700 hover:text-white hover:bg-black/80"; 

  // Base class for the card
  $base_container_classes = "flex flex-col h-full shadow-xl rounded-lg bg-white border border-gray-700/20 transition-all duration-300 hover:shadow-2xl overflow-hidden";
  
  foreach ($productsFetch as $product) {
    $id_product = $product['id_product'];
    $availability_style = "";

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
      $availability_style = ($product['availability'] == 'on_stock') 
                          ? 'text-green-600 font-medium' 
                          : 'text-red-600 font-medium';
    }

    // Logic for size and maximum height
    $product_container_classes = $base_container_classes;
    $img_container_size_classes = "w-full";

    if (count($productsFetch) == 1) {
      // Single product view
      $size_classes = 'w-full';
      $product_container_classes .= ' max-h-[55rem]'; // Large maximum height
      $img_container_size_classes = "w-full max-w-3xl mx-auto"; // Limit width and center
    } else {
      // Grid view (multiple products)
      $size_classes = 'flex-shrink-0 w-[30rem]'; 
      $product_container_classes .= ' max-h-[40rem]'; // Maximum height
    }
    
    // --- Main Product Container (Card) ---
    echo "<div class='$product_container_classes $size_classes'>";
    
      // Inner Container (where padding is applied)
      echo "<div class='flex flex-col w-full h-full font-sans gap-4 p-4'>"; 
        
        // Title (Fixed)
        echo "<h2 class='text-xl font-semibold'>" . $product['product_name'] . "</h2>";
        
        // Price + Qty container (Fixed)
        echo "<div class='flex justify-between w-full'>";
          echo "<p class='font-extrabold text-2xl text-gray-800'>" . $product['price'] . "€" . "</p>";
          echo "<p class='font-normal text-sm text-gray-600'>" . "stock: " . $product['stock'] . "</p>";
        echo "</div>";
        
        // Product description (Fixed)
        echo "<p class='font-normal text-sm pb-3 border-b border-gray-600/50 min-h-16'>" . $product['description'] . "</p>";

        // Product Info container (Fixed)
        echo "<div class='flex flex-col gap-2 text-xs text-gray-600'>";
          if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
            echo "<p>" . "ID: " . $product['id_product'] . "</p>";
            echo "<p>" . "Inserted_date: " . $product['inserted_date'] . "</p>";
            echo "<p>" . "Updated date: " . $product['updated_date'] . "</p>";
            echo "<p>" . "Availability: " . "<span class='$availability_style'>" . $product['availability'] . "</span></p>";
            echo "<p>" . "Active: " . $product['active'] . "</p>";
          }
          echo "<p>" . "Launch date: " . $product['launch_date'] . "</p>";
        echo "</div>"; 

        // --- Image Container (Flexible) ---
        echo "<div class='flex $img_container_size_classes mt-4 flex-grow overflow-hidden rounded-lg bg-gray-100 min-h-0'>";
          // Using object-scale-down (your choice) to prevent stretching if the image is smaller than the container.
          echo "<img class='w-full h-full object-scale-down' src='" . $product['img_src'] . "' alt='Product img'>";
        echo "</div>";
        
        // Form Buttons container: KEY: 'gap-4' separates, 'flex-1' distributes space proportionally.
        echo "<div class='flex w-full gap-4 justify-evenly items-center mt-auto pt-4 border-t border-gray-200'>"; 

        // Delete Button (Admin only)
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
          $delete_button_classes = $dynamic_button_base . " text-gray-700 hover:text-white hover:bg-red-600";
          
          echo "<div class='$delete_button_classes'>";
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_delete_call.php');
          echo "</div>";

          // Update Button (Admin only)
          echo "<div class='$normal_button_classes'>";
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_update_call.php');
          echo "</div>";
        }
        
        // Add to cart button (Only if stock is available)
        if ($product['stock'] > 0){
          $cart_button_classes = $dynamic_button_base . " bg-black text-white hover:bg-gray-800";
          echo "<div class='$cart_button_classes'>"; 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/shopping_cart/form_add_product_cart.php');
          echo "</div>";
        }

        // Select Button
        echo "<div class='$normal_button_classes'>";
          include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_select.php');
        echo "</div>";

        // Review Button
        echo "<div class='$normal_button_classes'>";
          include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_select_reviews_call.php');
        echo "</div>";
        
        echo "</div>"; // Closes Form Buttons container
      
      echo "</div>"; // Closes Product Inner Container
      
    echo "</div>"; // Closes Main Container
  }
}
?>
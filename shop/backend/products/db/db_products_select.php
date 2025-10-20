<!-- Header -->
    <section class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
    <div class="w-full mb-6 border-b border-gray-200 pb-2">
        <h1 class="text-3xl font-bold  text-[#0A090C] ">PRODUCTS</h1>
            <div class="flex w-full justify-center items-center">
                <div class="flex w-fit justify-center items-center p-3 
                bg-[#0A090C] 
                text-[#FEFFFE] 
                font-semibold
                rounded-md 
                hover:cursor-pointer 
                hover:bg-[#2c2732]">
                    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_insert_call.php'); ?> 
                </div> 
            </div>
    </div>
        
<!-- Logical fragment -->
<?php
// Debug 
// print_r($_POST); 
// Variables
$product_output = "No product selected or found";

// Before starting the query, check If the variable was sended and that the variabel is not empty

if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
    $id_product = null;
}
// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
// escape the string to avoid mysql injection
// $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
// Initialize variable that will save the designed query
$sql;
if ($id_product != null) {
    // Query
    $sql = "SELECT * FROM products WHERE id_product = '$id_product'";
} else {
    // Query
    $sql = "SELECT * FROM products;";
}
// Execute the query
$query_result = mysqli_query($conn, $sql);

// Check if the query exists and if there was rows affected
if ($query_result) {
    // Check if any row where returned
    if (mysqli_num_rows($query_result) > 0) {
        // Loop and return formatted result
        while ($row = mysqli_fetch_assoc($query_result)) {
            $id_product = $row['id_product'];
            // Aplicar estilado de stock si tiene stock 
            $availability_style;
            if ($row['availability']=='on_stock'){
                $availability_style= 'text-green-600 font-regular';
            }else{
                $availability_style= 'text-red-600 font-regular';
            }
            // Parent container of product
            echo"<div class='flex flex-col h-full max-h-110 flex-shrink-0 basis-[calc(33.33%-1.25rem)] 
                     shadow-xl p-4
                     rounded-lg
                     bg-white
                     border
                     border-gray-700/20
                     '>";
                     // Product Container
                echo"<div class='flex flex-col w-full h-full font-sans'>";
                    echo"<h2 class='flex justify-start items-center mb-5 text-xl font-semibold'>".$row['product_name'] . "</h2>";
                    // Price + qty container
                    echo"<div class='flex justify-between w-full mb-5'>";
                        echo"<p class='font-extrabold text-2xl'>" . $row['price'] . "€" . "</p>";
                        echo"<p class='font-normal text-sm'>" . "stock: " . $row['stock'] . "</p>";
                    echo"</div>";
                    // Product description
                    echo"<p class='font-normal text-sm pb-3 mb-5 border-b border-gray-600/50'>" . $row['description'] . "</p>";
                    // Product Info container
                    echo"<div class=' flex flex-col gap-2 text-xs text-gray-600'>";
                        echo"<p>" . "ID: " . $row['id_product'] . "</p>";
                        echo"<p>" . "Inserted_date: " . $row['inserted_date'] . "</p>";
                        echo"<p>" . "Updated date: " . $row['updated_date'] . "</p>";
                        echo"<p>" . "Launch date: " . $row['launch_date'] . "</p>";
                        echo "<p>" . "Availability: " . "<span class='$availability_style'>" . $row['availability'] . "</span></p>";
                        echo"<p>" . "Active: " . $row['active'] . "</p>";
                    echo"</div>";
                    // Form Buttons container
                        echo("<div class='flex justify-evenly items-end h-full'>");
                            // Delete Button Container
                            echo"<div class='p-1
                            hover:cursor-pointer
                            hover:text-white
                            hover:bg-red-600
                            hover:rounded-md
                            '>";
                                include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_delete_call.php');
                            echo"</div>";
                            // Select Button Container
                            echo"<div class='p-1
                           hover:text-[#ffffff]
                           hover:rounded-md
                           hover:bg-[#000001]
                           cursor-pointer
                            '>";
                                include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_select.php');
                            echo"</div>";
                            // Update Button Container
                            echo"<div class='p-1
                            hover:text-[#ffffff]
                            hover:rounded-md
                            hover:bg-[#000001]
                            cursor-pointer
                            '>";
                                include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_update_call.php');
                            echo"</div>";
                        echo("</div>");
                echo("</div>");
            echo("</div>");
        }
    } else {
        $product_output = "Product with ID $id_product not found.";
    }
} else {
    // Error on query execution
    $product_output = "Database Error: " . mysqli_error($conn);
}

// Free the result
mysqli_free_result($query_result);
// Close connection
mysqli_close($conn);
?>
<?php

?>
</section>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>


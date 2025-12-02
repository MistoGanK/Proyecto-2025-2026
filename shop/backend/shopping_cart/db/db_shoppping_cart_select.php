
<!-- Get globally the query to use it -->
<?php 
    // We get the $query_result
    $subtotal = 0;
    include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/functions/carts/selectCustomerCart.php');
    while ($row = mysqli_fetch_assoc($query_result)) {
        $subtotal += $row['price'] * $row['qty'];
    };
    // Resets de pointer 
    mysqli_data_seek($query_result, 0);
?>

<section class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
    <div class="w-full mb-6 border-b border-gray-200 pb-2 flex flex-col gap-4">
        <h1 class="text-3xl font-bold  text-[#0A090C] ">Shopping Cart</h1>
        <div class="flex w-full flex-col justify-between items-center ">
            <!-- Se convertira en el boton de comprar -->
            <?php 
            echo '<div class="flex w-full justify-center items-center p-6 
                bg-[#0A090C] 
                text-[#FEFFFE] 
                font-semibold
                rounded-md 
                hover:cursor-pointer 
                hover:bg-[#2c2732]">
                ',include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/shopping_cart/form_insert_products_call.php'),'
                </div>';
            echo
            '<div class="flex w-fit h-fit justify-center items-center pt-4 gap-4">
                <p class="flex text-2xl font-bold">Cart Total </p>
                <p id="p_subtotal" class="flex text-4xl w-fit h-fit justify-center items-center p-2 text-[#0A090C] font-bold ">
                ',$subtotal,'
                </p>
                <p class="font-bold text-3xl">€</p>
            </div>';
            ?>
        </div>
    </div>

    <?php
    // Maquetate and show the products
    include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/functions/carts/showCustomerCart.php');
    showCustomerCart($query_result);
    ?>

</section>
<!-- Footer -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
<script src="/student022/shop/backend/scripts/shopping_cart/add_sub_qty.js"></script>
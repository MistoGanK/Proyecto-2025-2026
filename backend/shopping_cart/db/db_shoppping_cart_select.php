<?php
// We get the $query_result
$subtotal = 0;
// --- DATA RETRIEVAL INCLUDE ---
// RUTA CORREGIDA: Eliminado /shop/
include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/carts/selectCustomerCart.php');

while ($row = mysqli_fetch_assoc($query_result)) {
    $subtotal += $row['price'] * $row['qty'];
};
// Resets the pointer 
mysqli_data_seek($query_result, 0);

// Check if there are items in the cart to display the total
$has_items = mysqli_num_rows($query_result) > 0;
?>

<section class="p-8 max-w-7xl mx-auto">
    <h1 class="text-4xl font-extrabold tracking-tight uppercase text-gray-900 pb-3 mb-8 border-b-2 border-black/10 inline-block">
        My Shopping Cart
    </h1>

    <?php if (!$has_items): ?>
        <div class="text-center py-20 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-2xl font-semibold text-gray-700">Your cart is empty.</p>
            <p class="text-lg text-gray-500 mt-2">Check out our products!</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 flex flex-col gap-5">
                <?php
                // RUTA CORREGIDA: Eliminado /shop/
                include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/carts/showCustomerCart.php');
                showCustomerCart($query_result);
                ?>
            </div>

            <div class="lg:col-span-1 flex flex-col h-fit sticky top-8 p-6 
                        shadow-xl rounded-lg bg-white border border-gray-900/10">

                <h2 class="text-2xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-300">Order Summary</h2>

                <div class="flex justify-between items-center py-2">
                    <p class="text-md text-gray-700">Subtotal:</p>
                    <p id='pre_p_subtotal' class="text-xl font-semibold text-gray-900"><?php echo number_format($subtotal, 2); ?> €</p>
                </div>

                <div class="flex justify-between items-center py-2 border-b border-gray-300">
                    <p class="text-md text-gray-700">Estimated Shipping:</p>
                    <p class="text-md font-semibold text-gray-900">Calculated at Checkout</p>
                </div>

                <div class="flex justify-between items-center pt-4 mb-6">
                    <p class="text-2xl font-extrabold">Total:</p>
                    <p id="p_subtotal" class="text-4xl font-extrabold text-black">
                        <?php echo number_format($subtotal, 2); ?> €
                    </p>
                </div>

                <div class="flex w-full justify-center items-center p-4 
                            bg-black text-white font-semibold rounded-lg 
                            hover:cursor-pointer hover:bg-gray-800 transition-colors duration-200">
                    <?php
                    // RUTA CORREGIDA: Eliminado /shop/
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/shopping_cart/form_insert_products_call.php');
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php 
// RUTA CORREGIDA: Eliminado /shop/
include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); 
?>

<script src="/student022/backend/scripts/shopping_cart/add_sub_qty.js"></script>
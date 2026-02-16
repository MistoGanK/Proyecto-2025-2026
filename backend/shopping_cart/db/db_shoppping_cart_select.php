<?php
// We get the $query_result
$subtotal = 0;
// --- DATA RETRIEVAL INCLUDE ---
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
    <div class="mb-8">
        <h1 class="text-4xl font-black tracking-tighter uppercase italic text-gray-900">
            My Shopping <span class="text-gray-400 not-italic font-light">Cart</span>
        </h1>
        <p class="text-gray-500 font-bold text-xs uppercase tracking-[0.2em] mt-2">Review your items before proceeding</p>
    </div>

    <hr class="border-gray-200 mb-10">

    <?php if (!$has_items): ?>
        <div class="text-center py-32 bg-white rounded-[2rem] border-2 border-dashed border-gray-100 shadow-sm">
            <p class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">Your cart is empty.</p>
            <p class="text-gray-400 font-medium mt-2 mb-8">Check out our products and find your next favorite item!</p>
            <a href="/student022/backend/views/products_view.php" class="bg-black text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-800 transition-all shadow-xl">
                Start Shopping
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            <div class="lg:col-span-2 flex flex-col gap-5">
                <?php
                include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/carts/showCustomerCart.php');
                showCustomerCart($query_result);
                ?>
            </div>

            <div class="lg:col-span-1 flex flex-col h-fit sticky top-8 p-8 
                        shadow-2xl rounded-[2rem] bg-white border border-gray-100">

                <h2 class="text-xl font-black text-gray-900 mb-8 uppercase tracking-tighter italic border-b border-gray-50 pb-4">Order Summary</h2>

                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Subtotal</p>
                        <p id='pre_p_subtotal' class="text-xl font-bold text-gray-900 tracking-tight"><?php echo number_format($subtotal, 2); ?> €</p>
                    </div>

                    <div class="flex justify-between items-center pb-6 border-b border-dashed border-gray-200">
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Shipping</p>
                        <p class="text-[10px] font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg">FREE</p>
                    </div>

                    <div class="pt-4 mb-8">
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-1">Total</p>
                        <div class="flex justify-between items-end">
                            <p id="p_subtotal" class="text-5xl font-black text-black tracking-tighter">
                                <?php echo number_format($subtotal, 2); ?>
                            </p>
                            <span class="text-2xl font-black mb-1 ml-1">€</span>
                        </div>
                    </div>
                </div>

                <div class="relative group mt-4">
                    <div class="absolute -inset-0.5 bg-black rounded-2xl blur opacity-10 group-hover:opacity-20 transition duration-300"></div>
                    <div class="relative flex w-full justify-center items-center p-5 
                                bg-black text-white font-black text-[12px] uppercase tracking-[0.3em] rounded-2xl 
                                hover:cursor-pointer hover:bg-gray-800 transition-all duration-300 shadow-xl active:scale-95">
                        <?php
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/shopping_cart/form_insert_products_call.php');
                        ?>
                    </div>
                </div>
                
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest text-center mt-6">
                    Secure checkout • Free returns within 30 days
                </p>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); 
?>

<script src="/student022/backend/scripts/shopping_cart/add_sub_qty.js"></script>
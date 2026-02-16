<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex flex-col items-center justify-center p-12 min-h-screen bg-[#F8F9FA]">
    
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2.5rem] overflow-hidden border border-gray-100">
        
        <div class="bg-[#0A090C] p-12 flex flex-col items-center justify-center relative">
            <div class="w-14 h-14 bg-white/10 rounded-full flex items-center justify-center border border-white/20 mb-4 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <h1 class="text-3xl font-black tracking-tighter text-white italic uppercase">
                Order <span class="text-gray-400 not-italic font-light">Provisioning</span>
            </h1>
        </div>

        <form class="p-10 flex flex-col gap-10" action="/student022/backend/forms/db/order/db_order_insert.php" method="post">

            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 border-b border-gray-100 pb-2">Reference Mapping</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col gap-2" for="id_order">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Order ID (Manual)</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="number" id="id_order" name="id_order" placeholder="0000">
                    </label>
                    <label class="flex flex-col gap-2" for="order_id_customer">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Customer ID</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="number" id="order_id_customer" name="order_id_customer" placeholder="ID-Ref">
                    </label>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 border-b border-gray-100 pb-2">Transaction Details</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col gap-2" for="order_id_product">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Product ID</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="number" id="order_id_product" name="order_id_product">
                    </label>
                    <label class="flex flex-col gap-2" for="order_id_payment_method">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Payment Method ID</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="number" id="order_id_payment_method" name="order_id_payment_method">
                    </label>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 border-b border-gray-100 pb-2">Volume & Adjustment</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col gap-2" for="order_qty">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Quantity (Units)</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-bold text-gray-700" 
                            type="number" id="order_qty" name="order_qty" min="1" value="1">
                    </label>
                    <label class="flex flex-col gap-2" for="order_discount_rate">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Discount Rate (%)</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-bold text-gray-700" 
                            type="number" id="order_discount_rate" name="order_discount_rate" min="0" max="100" value="0">
                    </label>
                </div>
            </div>

            <div class="pt-6">
                <input class="w-full p-5 bg-[#0A090C] text-white rounded-2xl font-black uppercase tracking-[0.2em] text-xs hover:bg-gray-800 transition-all shadow-xl active:scale-[0.98] hover:cursor-pointer" 
                    type="submit" 
                    id="send" 
                    name="send" 
                    value="Authorize & Insert Order">
            </div>
            
        </form>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
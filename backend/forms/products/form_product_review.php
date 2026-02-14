<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<?php
// $currentDate = date('Y-m-d h:i:s',time()); 
$productName = $_POST['product_name'];
$id_order = $_POST['id_order'];
$id_product = $_POST['id_product'];
?>

<script>
  function redirectOrder(){
    window.location = '/student022/backend/orders/orders.php';
  };
</script>

<section class="flex flex-col items-center justify-center p-12 min-h-screen bg-[#F8F9FA]">

  <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2.5rem] overflow-hidden border border-gray-100">

    <div class="bg-[#0A090C] p-12 flex flex-col items-center justify-center relative">
      <div class="w-14 h-14 bg-white/10 rounded-full flex items-center justify-center border border-white/20 mb-4 backdrop-blur-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
        </svg>
      </div>
      <h1 class="text-3xl font-black tracking-tighter text-white italic uppercase text-center leading-none">
        Product <span class="text-gray-400 not-italic font-light">Experience Review</span>
      </h1>
      <p class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.4em] mt-4">Order ID: #<?php echo $id_order; ?></p>
    </div>

    <div class="p-10">
        
        <div class="mb-10 text-center">
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight italic"><?php echo $productName; ?></h2>
            <div class="h-1 w-20 bg-gray-100 mx-auto mt-2"></div>
        </div>

        <form class="flex flex-col gap-8" action="/student022/backend/forms/db/product/db_product_review.php" method="post">
          
          <input id='id_product' name='id_product' type='number' value="<?php echo $id_product;?>" hidden>
          <input type="number" id="id_order" name="id_order" value="<?php echo $id_order ?>" hidden="true">

          <div class="flex flex-col gap-2">
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100 pb-2 mb-2">Performance Score</span>
            <select class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-bold text-gray-700 appearance-none text-center cursor-pointer"
              id="score"
              name="score">
              <option value="1">★ (Poor)</option>
              <option value="2">★★ (Fair)</option>
              <option value="3">★★★ (Average)</option>
              <option value="4">★★★★ (Good)</option>
              <option value="5">★★★★★ (Excellent)</option>
            </select>
          </div>

          <div class="flex flex-col gap-2">
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100 pb-2 mb-2">Review Narrative</span>
            <textarea class="p-5 bg-[#F3F4F6] border-none rounded-3xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600 min-h-[150px] text-sm"
              id="body_review"
              name="body_review"
              maxlength="1000"
              placeholder="Share your detailed experience with the product..."></textarea>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex flex-col gap-2">
                <span class="text-[10px] font-black uppercase tracking-widest text-green-500 border-b border-green-50 pb-2 mb-2 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Pros
                </span>
                <textarea class="p-4 bg-green-50/50 border-none rounded-2xl focus:ring-2 focus:ring-green-500 outline-none transition-all font-medium text-gray-600 text-xs min-h-[100px]"
                  id="positive_features"
                  name="positive_features"
                  maxlength="500"
                  placeholder="What did you love?"></textarea>
              </div>

              <div class="flex flex-col gap-2">
                <span class="text-[10px] font-black uppercase tracking-widest text-red-500 border-b border-red-50 pb-2 mb-2 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Cons
                </span>
                <textarea class="p-4 bg-red-50/50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none transition-all font-medium text-gray-600 text-xs min-h-[100px]"
                  id="negative_features"
                  name="negative_features"
                  placeholder="What could be improved?"></textarea>
              </div>
          </div>

          <div class="pt-4 flex flex-col gap-3">
              <input class="w-full p-5 bg-[#0A090C] text-white rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] hover:bg-gray-800 transition-all shadow-xl hover:cursor-pointer active:scale-[0.98]"
                type="submit"
                id="send"
                name="send"
                value="Publish Review">
              
              <button type="button" class="w-full p-4 bg-white text-red-500 border-2 border-red-50 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] hover:bg-red-50 transition-all"
                onclick="redirectOrder()">
                Abort & Cancel
              </button>
          </div>
        </form>
    </div>
  </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
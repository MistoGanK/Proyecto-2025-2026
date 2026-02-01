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

<section class="flex justify-center p-8 min-h-screen h-fit">

  <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200 h-fit">

    <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Review</h1>
    <h2 class="text-2xl font-bold text-[#0A090C] mb-6 "><?php echo $productName; ?></h2>

    <form class="flex flex-col gap-4" action="/student022/backend/forms/db/product/db_product_review.php" method="post">
      <input id='id_product' name='id_product' type='number' value="<?php echo $id_product;?>" hidden>
      <input type="number" id="id_order" name="id_order" value="<?php echo $id_order ?>" hidden="true">
      <label class="flex flex-col text-sm font-medium text-gray-700">
        Score:
        <select class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          id="score"
          name="score">
          <option value="1">★</option>
          <option value="2">★★</option>
          <option value="3">★★★</option>
          <option value="4">★★★★</option>
          <option value="5">★★★★★</option>
        </select>
      </label>

      <label class="flex flex-col text-sm font-medium text-gray-700">
        Review:
        <textarea class="mt-1 p-2 h-50 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          type="number"
          id="body_review"
          name="body_review"
          maxlength="1000">
                  Maximum lenght 1000...
                </textarea>
      </label>

      <label class="flex flex-col text-sm font-medium text-gray-700">
        Positive features:
        <textarea class="mt-1 h-30 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          id="positive_features"
          name="positive_features"
          maxlength="500">
                    Maximum lenght 500...
                </textarea>
      </label>

      <label class="flex flex-col text-sm font-medium text-gray-700">
        Negative Features:
        <textarea class="mt-1 h-30 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          type="text"
          id="negative_features"
          name="negative_features">
                  Maximum lenght 500...
                </textarea>
      </label>

      <input class="p-3 bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold mt-3 transition duration-150"
        type="submit"
        id="send"
        name="send"
        value="Review">
    </form>

    <button class="p-3 w-full bg-red-600 mt-2 hover:bg-red-500 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold  transition duration-150"
        onclick="redirectOrder()">
        Cancel
    </button>

  </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
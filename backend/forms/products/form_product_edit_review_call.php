<link rel="icon" href="/student022/backend/assets/icons/faviconBlack.png" type="image/png">
<form action="/student022/backend/forms/products/form_product_edit_review.php" method="post">
  <input id='id_product' name='id_product' type='number' value="<?php echo $currendIdProduct;?>" hidden>
  <input id='id_order' name='id_order' type='number' value="<?php echo $currendIdOrder;?>" hidden>
  <input id='product_name' name='product_name' type='text' value="<?php echo $currendProductName;?>" hidden>
  <input class="w-full h-full cursor-pointer" type='submit' value='Edit Review'>
</form>
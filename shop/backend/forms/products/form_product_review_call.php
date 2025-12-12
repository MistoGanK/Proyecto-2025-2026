<form action="/student022/shop/backend/forms/products/form_product_review.php" method="post">
  <input id='id_product' name='id_product' type='number' value="<?php echo $currendIdProduct;?>" hidden>
  <input id='id_order' name='id_order' type='number' value="<?php echo $currendIdOrder;?>" hidden>
  <input id='product_name' name='product_name' type='text' value="<?php echo $currendProductName;?>" hidden>
  <input type='submit' value='Make a review'>
</form>
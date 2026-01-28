<link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
<form action="/student022/shop/backend/forms/db/shopping_cart/db_shopping_cart_add.php" method="post">
  <input type="number" id="id_product" name="id_product" hidden="true" value="<?php echo $id_product; ?>">
  <input class="w-full h-full cursor-pointer" type="submit" id="send" name="send" value="Add to cart">
</form>
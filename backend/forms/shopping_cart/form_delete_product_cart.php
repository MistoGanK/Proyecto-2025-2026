<link rel="icon" href="/student022/backend/assets/icons/faviconBlack.png" type="image/png">
<form action="/student022/backend/forms/db/shopping_cart/db_shopping_cart_delete.php" method="post">
  <input type="number" id="id_product" name="id_product" hidden="true" value="<?php echo $id_product; ?>">
  <input class="w-full h-full cursor-pointer" id="cartDeleteSubmit" type="submit" id="send" name="send" value="Delete">
</form>
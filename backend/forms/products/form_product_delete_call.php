<link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
<form action="/student022/shop/backend/forms/products/form_product_delete.php" method="post">
  <input type="number" id="id_product" name="id_product" hidden="true" value="<?php echo $id_product; ?>">
  <input class="w-full h-full cursor-pointer" type="submit" id="send" name="send" value="Delete">
</form>

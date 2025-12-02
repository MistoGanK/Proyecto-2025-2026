<form action="/student022/shop/backend/forms/db/shopping_cart/db_shopping_cart_checkout.php" method="post">
  <input type="number" id="id_customer" name="id_customer" value="<?php echo $_SESSION['id_customer']?>" hidden="true">
  <input type="submit" id="send" name="send" value="Checkout">
</form>
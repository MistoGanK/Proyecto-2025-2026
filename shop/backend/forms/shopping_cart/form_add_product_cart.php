<!-- Header -->
<?php //include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
    <form action="/student022/shop/backend/forms/db/shopping_cart/db_shopping_cart_add.php" method="post">
      <input type="number" id="id_product" name="id_product" hidden="true" value="<?php echo $id_product; ?>">
      <input type="submit" id="send" name="send" value="Add to cart">
    </form>
     <!-- Footer -->
    <?php // include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

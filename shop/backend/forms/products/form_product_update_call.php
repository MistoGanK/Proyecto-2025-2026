<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<form action="/student022/shop/backend/forms/products/form_product_update.php" method="post">
   <input type="number" id="id_product" hidden="true" name="id_product" value="<?php echo($id_product) ?>">
   <input type="submit" id="send" name="send" value="Update">
</form>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
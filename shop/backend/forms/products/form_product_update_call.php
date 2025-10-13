<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<h1>Form_product_update_call</h1>
<form action="/student022/shop/backend/forms/products/form_product_update.php" method="post">
   <label for="id_product">Product id:
      <input type="number" id="id_product" name="id_product">
   </label>
   <label for="send">Submit:
      <input type="submit" id="send" name="send">
   </label>
</form>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
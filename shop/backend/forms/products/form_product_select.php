<!-- Header -->
<?php // include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
    <form action="/student022/shop/backend/forms/db/product/db_product_select.php" method="post">
            <input type="number" id="id_product" name="id_product" hidden="true" value="<?php echo($id_product) ?>">
       </label>
          <input height="100%" width="100%" type="submit" id="send" value="Select">
    </form>
     <!-- Footer -->
    <?php // include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

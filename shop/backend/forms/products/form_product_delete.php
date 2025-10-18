<!-- Header -->
   <h1>Proceed do detele the product?</h1>
    <form action="/student022/shop/backend/forms/db/product/db_product_delete.php" method="post">
       <label for="id_product">Product id: 
            <input type="number" id="id_product" name="id_product" value="<?php echo($_POST['id_product'])?>">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->

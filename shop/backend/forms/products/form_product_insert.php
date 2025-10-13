<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
     <h1>form_product_insert</h1>
    <form action="/student022/shop/backend/forms/db/product/db_product_insert.php" method="post">
       <label for="product_name">Product Name: 
            <input type="text" id="product_name" name="product_name">
       </label>
       <label for="product_price">Product Price:
            <input type="number" id="product_price" name="product_price">
       </label>
       <label for="product_stock">Stock:
            <input type="nubmer" id="product_stock" name="product_stock">
       </label>
       <label for="product_description">Product description:
            <input type="text" id="product_description" name="product_description">
       </label>
       <label for="product_launch_date">Launch date:
          <input type="date" id="product_launch_date" name="product_launch_date">
       </label>
       <label for="product_availability">Product availability
          <input type="text" id="product_availability" name="product_availability">
       </label>
       <label for="product_active">Product active:
          <input type="number" id="product_active" name="product_active"  min="0" max="1">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

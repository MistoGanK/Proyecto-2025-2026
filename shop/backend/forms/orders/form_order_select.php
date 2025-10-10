<?php ?>
<?php
?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
    <h1>Form_order_select</h1>
    <form action="/student022/shop/backend/forms/db/order/db_order_select.php" method="post">
       <label for="id_order">Order id: 
            <input type="number" id="id_order" name="id_order">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

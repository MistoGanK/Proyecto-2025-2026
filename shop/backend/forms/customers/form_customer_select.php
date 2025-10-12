"<?php ?>
<?php
?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
    <h1>Form_customer_select</h1>
    <form action="/student022/shop/backend/forms/db/customer/db_customer_select.php" method="post">
       <label for="id_customer">Customer ID: 
            <input type="number" id="id_customer" name="id_customer">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>
     <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
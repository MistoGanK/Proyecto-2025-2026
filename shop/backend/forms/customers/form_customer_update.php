<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
<!-- GET THE INFO FROM POST -->
<? 
print_r($_POST); // Debug 
?>
<h1>Form_customer_update</h1>
    <form action="/student022/shop/backend/forms/db/customer/db_customer_update.php" method="post">
       <label for="id_customer">Product id: 
            <input type="number" id="id_customer" name="id_customer">
       </label>
       <label for="send">Submit:
          <input type="submit" id="send" name="send">
       </label>
    </form>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

<?php ?>
<?php
?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<h1>form_order_insert</h1>
<form action="/student022/shop/backend/forms/db/order/db_order_insert.php" method="post">
     <label for="order_id_order">Order ID:
          <input type="number" id="order_id_order" name="order_id_order">
     </label>
     <label for="order_id_customer">Customer ID:
          <input type="number" id="order_id_customer" name="order_id_customer">
     </label>
     <label for="order_id_product">Product ID:
          <input type="number" id="order_id_product" name="order_id_product">
     </label>
     <label for="order_id_payment_method">Payment method ID:
          <input type="number" id="order_id_payment_method" name="order_id_payment_method">
     </label>
     <label for="order_qty">Order qty:
          <input type="number" id="order_qty" name="order_qty" min="0">
     </label>
     <label for="order_discount_rate">Discount rate (%):
          <input type="number" id="order_discount_rate" name="order_discount_rate">
     </label>
     <label for="send">Submit:
          <input type="submit" id="send" name="send" value="Insert">
     </label>
</form>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
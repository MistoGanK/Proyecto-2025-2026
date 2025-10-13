<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<?
print_r($_POST); // Debug 
?>
<?php
// Variables definition that we will capture later

$order_id_order = "";
$order_id_customer = "";
$order_id_product = "";
$order_id_payment_method = "";
$order_qty = 0;
$oder_unit_price = 0;
$order_discount_rate = 0;
$order_total = 0;
$order_date = "";
$order_canceled = 0;

if (!isset($_POST['order_id_order']) || empty($_POST['order_id_order'])) {
   $update_output = "ERROR: order_id_order is missing";
} else {
   // Open connectoin
   include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
   // Escpa input to avoid SQL injection
   $order_id_order = mysqli_escape_string($conn,$_POST['order_id_order']);
   // Query 
   $query = "SELECT * FROM orders WHERE id_order = '$order_id_order';";
   // Execute and save the query
   $query_result = mysqli_query($conn,$query);

   // Check if the query is correct
   if($query_result){
       // Check if the order_id_order returns any rows
   if (mysqli_num_rows($query_result)>0){
       // Save the query result to the variables
     $row = mysqli_fetch_assoc($query_result);
     $order_id_order = $row['id_order'];
     $order_id_customer = $row['id_customer'];
     $order_id_product = $row['id_product'];
     $order_id_payment_method = $row['id_payment_method'];
     $order_qty = $row['qty'];
     $oder_unit_price = $row['unit_price'];
    //  $order_discount_rate = $row['discount'];
     $order_total = $row['total'];
     $order_date = $row['order_date'];
     $order_canceled = $row['canceled'];

   }else{
     $update_output = "ERROR: order_id_order not foun on the database";
   }
   }else{
     $update_output = "Error: Database error " . mysqli_error($conn);
   }
   mysqli_close($conn);
?>
<?php
}
?>

<h1>Form_order_update</h1>
<form action="/student022/shop/backend/forms/db/order/db_order_update.php" method="post">
    <input type="hidden" name="order_id_order" value="<?php echo $order_id_order ?>">
   
   <label for="order_id_customer">Customer ID:
     <input type="number" id="order_id_customer" name="order_id_customer" value="<?php echo $order_id_customer ?>">
   </label>
   
   <label for="order_id_product">Product ID:
     <input type="number" id="order_id_product" name="order_id_product" value="<?php echo $order_id_product ?>">
   </label>
   
   <label for="order_id_payment_method">Payment Method ID:
     <input type="number" id="order_id_payment_method" name="order_id_payment_method" min="0" value="<?php echo $order_id_payment_method?>">
   </label>
   
   <label for="order_qty">Order qty:
     <input type="number" id="order_qty" name="order_qty" min="0" value="<?php echo $order_qty ?>">
   </label>
   
   <label for="oder_unit_price">Order Unit Price (€):
     <input type="number" id="oder_unit_price" name="oder_unit_price" min="0" value="<?php echo $oder_unit_price?>">
   </label>
   
   <!-- <label for="order_discount_rate">Order Discount Rate (%):
     <input type="number" name="order_discount_rate" min="0" hidden="true" value="<?php echo $order_discount_rate?>">
   </label>
    -->
   <label for="order_total">Order Total (€):
     <input type="number" name="order_total" maxlength="1" value="<?php echo $order_total?>">
   </label>

   <label for="order_date">Order Date:
     <input type="datetime-local" id="order_date" name="order_date" value="<?php echo $order_date?>">
   </label>

  <label for="order_canceled">Order Canceled (0/Y, 1/N):
     <input type="number" id="order_canceled" name="order_canceled" min="0" max="1" value="<?php echo $order_canceled?>">
   </label> 

   <label for="send">Submit Changes:
     <input type="submit" id="send" name="send" value="Update order">
   </label>

</form>

<?php
// Debug secction
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>

<?php ?>
<?php
?>
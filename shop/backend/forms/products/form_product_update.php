<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<!-- GET THE INFO FROM POST -->
<?
print_r($_POST); // Debug 
?>
<?php
// Variables definition that we will capture later

$product_name = "aaaaaaaaa";
$product_price = 0;
$product_stock = 0;
$product_description = "";
$product_inserted_date = "";
$product_updated_date = "";
$product_launch_date = "";
$product_availability = "";
$product_active = 1;

if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
   $update_output = "ERROR: id_product is missing";
} else {
   // Open connectoin
   include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
   // Escpa input to avoid SQL injection
   $id_product = mysqli_escape_string($conn,$_POST['id_product']);
   // Query 
   $query = "SELECT * FROM products WHERE id_product = '$id_product';";
   // Execute and save the query
   $query_result = mysqli_query($conn,$query);

   // Check if the query is correct
   if($query_result){
       // Check if the id_product returns any rows
   if (mysqli_num_rows($query_result)>0){
       // Save the query result to the variables
      $row = mysqli_fetch_assoc($query_result);
      $product_name = $row['product_name'];
      $product_price = $row['price'];
      $product_stock = $row['stock'];
      $product_description = $row['description'];
      $product_inserted_date = $row['inserted_date'];
      $product_launch_date = $row['launch_date'];
      $product_availability = $row['availability'];
      $product_active = $row['active'];

   }else{
      $update_output = "ERROR: id_product not foun on the database";
   }
   }else{
     $update_output = "Error: Database error " . mysqli_error($conn);
   }
?>
<?php
}
?>
<h1>Form_product_update</h1>
<form action="/student022/shop/backend/forms/db/product/db_product_update.php" method="post">
   <label for="product_name">Product name:
      <input type="text" id="product_name" name="product_name" value="<?php echo $product_name ?>">
   </label>
   <laber for="product_price">Price:
      <input type="number" id="product_price" name="product_price" value="<?php echo $product_price ?>">
   </laber>
   <label for="product_stock">Stock:
      <input type="product_stock" id="product_stock" name="product_stock" value="<?php echo $product_stock?>">
   </label>
   <label for="product_description">Product Description:
      <input type="text" id="product_description" name="product_description" value="<?php echo $product_description ?>">
   </label>
   <label for="product_inserted_date">Product inserted date:
      <input type="date" id="product_inserted_date" name="product_inserted_date" value="<? echo $product_inserted_date?>">
   </label>
   <label for="product_launch_date">Product launch date:
      <input type="date" id="product_launch_date" name="product_launch_date" value="<? echo $product_updated_date?>">
   </label>
   <label for="product_availability">Product availability:
      <input type="text" name="product_availability" value="<?php echo $product_availability?>">
   </label>
   <label for="product_active">Product active:
      <input type="number" name="product_active" maxlength="1" value="<?php echo $product_active?>">
   </label>

   <label for="send">Submit:
      <input type="submit" id="send" name="send">
   </label>
</form>

<?php echo $product_name?>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>

<?php ?>
<?php
?>
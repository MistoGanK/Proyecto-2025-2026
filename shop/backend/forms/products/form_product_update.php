<?
print_r($_POST); // Debug 
?>
<?php
// Variables definition that we will capture later

$product_name = "";
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

     // Formateo de las fechas

     // $datetime_insert_object = new DateTime($product_inserted_date);
     // $product_inserted_date = $datetime_insert_object ->format('Y-m-d\TH:i');

     // $datetime_launch_object = new DateTime($product_launch_date);
     // $product_launch_date = $datetime_launch_object ->format('Y-m-d\TH:i');

   }else{
     $update_output = "ERROR: id_product not foun on the database";
   }
   }else{
     $update_output = "Error: Database error " . mysqli_error($conn);
   }
   mysqli_close($conn);
?>
<?php
}
?>

<h1>Update Product</h1>
<form action="/student022/shop/backend/forms/db/product/db_product_update.php" method="post">
    <input type="hidden" name="id_product" value="<?php echo $id_product ?>">
   
   <label for="product_name">Product Name:
     <input type="text" id="product_name" name="product_name" value="<?php echo $product_name ?>">
   </label>
   
   <label for="product_price">Unit Price (€):
     <input type="number" id="product_price" name="product_price" value="<?php echo $product_price ?>">
   </label>
   
   <label for="product_stock">Available Stock:
     <input type="number" id="product_stock" name="product_stock" min="0" value="<?php echo $product_stock?>">
   </label>
   
   <label for="product_description">Detailed Description:
     <input type="text" id="product_description" name="product_description" value="<?php echo $product_description ?>">
   </label>
   
   <label for="product_launch_date">Launch Date (YYYY-MM-DD):
     <input type="date" id="product_launch_date" name="product_launch_date" value="<?php echo $product_launch_date?>">
   </label>
   
   <label for="product_availability">Availability Status (on_stock,out_of_stock,coming_soon,discontinued):
     <input type="text" name="product_availability" value="<?php echo $product_availability?>">
   </label>
   
   <label for="product_active">Product Active (1=Yes, 0=No):
     <input type="number" name="product_active" maxlength="1" value="<?php echo $product_active?>">
   </label>

   <label for="send">Submit Changes:
     <input type="submit" id="send" name="send" value="Update product">
   </label>
</form>

<?php
// Debug secction
?>

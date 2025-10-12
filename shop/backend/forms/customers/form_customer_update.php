<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<?
print_r($_POST); // Debug 
?>
<?php
// Variables definition that we will capture later
$customer_username = "";
$customer_password = "";
$customer_dni = "";
$customer_email = "";
$customer_forename = "";
$customer_surname = "";
$customer_birth_date = "";
$customer_registered = "";
$customer_active = 1;
$id_customer = ""; 

if (!isset($_POST['id_customer']) || empty($_POST['id_customer'])) {
    $update_output = "ERROR: id_customer is missing";
} else {
    // Open connectoin
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

    // Escape input to avoid SQL injection
    $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
    
    // Query 
    $query = "SELECT * FROM customers WHERE id_customer = $id_customer;";
    
    // Execute and save the query
    $query_result = mysqli_query($conn,$query);

    // Check if the query is correct
    if($query_result){
        // Check if the id_customer returns any rows
    if (mysqli_num_rows($query_result)>0){
        // Save the query result to the variables
      $row = mysqli_fetch_assoc($query_result);
      $customer_username = $row['username'];
      $customer_password = $row['user_password'];
      $customer_dni = $row['dni'];
      $customer_email = $row['email'];
      $customer_forename = $row['forename'];
      $customer_surname = $row['surname'];
      $customer_birth_date = $row['birth_date'];
      $customer_registered = $row['registered'];
      $customer_active = $row['active'];

    }else{
      $update_output = "ERROR: id_customer not foun on the database";
    }
    }else{
      $update_output = "Error: Database error " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>
<?php
}
?>

<h1>Formulario de Actualización de Clientes</h1>
<form action="/student022/shop/backend/forms/db/customer/db_customer_update.php" method="post">
    
    <input type="hidden" id="id_customer" name="id_customer" value="<?php echo $id_customer ?>">
    
    <label for="customer_username">Nombre de Usuario:</label>
    <input type="text" id="customer_username" name="customer_username" value="<?php echo $customer_username ?>">
    
    <label for="customer_password">Contraseña (NO EDITAR SI NO ES NECESARIO):</label>
    <input type="password" id="customer_password" name="customer_user_password" value="<?php echo $customer_password ?>">
    
    <label for="customer_dni">DNI:</label>
    <input type="text" id="customer_dni" name="customer_dni" value="<?php echo $customer_dni ?>">
    
    <label for="customer_email">Email:</label>
    <input type="email" id="customer_email" name="customer_email" value="<?php echo $customer_email ?>">
    
    <label for="customer_forename">Nombre de Pila:</label>
    <input type="text" id="customer_forename" name="customer_forename" value="<?php echo $customer_forename ?>">
    
    <label for="customer_surname">Apellido:</label>
    <input type="text" id="customer_surname" name="customer_surname" value="<?php echo $customer_surname ?>">
    
    <label for="customer_birth_date">Fecha de Nacimiento:</label>
    <input type="date" id="customer_birth_date" name="customer_birth_date" value="<?php echo $customer_birth_date?>">
    
    <label for="customer_registered">Registrado (1/0):</label>
    <input type="number" name="customer_registered" min="0" max="1" value="<?php echo $customer_registered?>">
    
    <label for="customer_active">Activo (1/0):</label>
    <input type="number" name="customer_active" min="0" max="1" value="<?php echo $customer_active?>">

    <label for="send">Submit:</label>
    <input type="submit" id="send" name="send">
</form>

<?php
// Debug section
if (isset($update_output)) {
    echo "<p>$update_output</p>";
}
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
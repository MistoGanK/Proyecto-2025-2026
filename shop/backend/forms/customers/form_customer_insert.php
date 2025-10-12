<?php ?>
<?php
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
    <h1>form_customer_insert</h1>
    <form action="/student022/shop/backend/forms/db/customer/db_customer_insert.php" method="post">

        <label for="customer_username">Customer username: 
            <input type="text" id="customer_username" name="customer_username">
        </label>
        
        <label for="customer_user_password">Customer password: 
            <input type="password" id="customer_user_password" name="customer_user_password">
        </label>
        
        <label for="customer_dni">Customer dni: 
            <input type="text" id="customer_dni" name="customer_dni">
        </label>
        
        <label for="customer_email">Customer email: 
            <input type="email" id="customer_email" name="customer_email">
        </label>
        
        <label for="customer_forename">Customer forename: 
            <input type="text" id="customer_forename" name="customer_forename">
        </label>
        
        <label for="customer_surname">Customer surname: 
            <input type="text" id="customer_surname" name="customer_surname">
        </label>
        
         <label for="customer_birth_date">Customer birth date: 
            <input type="date" id="customer_birth_date" name="customer_birth_date">
        </label>
        
        <label for="customer_registered">Is Registered? (1/0): 
            <input type="number" id="customer_registered" name="customer_registered" value="1" min="0" max="1">
        </label>

        <label for="customer_active">Is Active? (1/0): 
            <input type="number" id="customer_active" name="customer_active" value="1" min="0" max="1">
        </label>

        <input type="hidden" name="customer_creation_date" value="">
        <input type="hidden" name="customer_updated_date" value="">
        
        <label for="send">Submit:
            <input type="submit" id="send" name="send">
        </label>
        
    </form>
      <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
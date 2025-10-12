<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<h1>db_customer_update</h1>
<p>You Updated: </p>
<?php
// Test
// print_r($_POST); // Debug 
$update_output = "id_customer Not found";
// Check if POST its retrieved and if if has content 
if (!isset($_POST['id_customer']) || empty($_POST['id_customer'])) {
    $update_output = "ERROR: id_customer is missing";
} else {
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
    // Save the variables
    $id_customer = mysqli_escape_string($conn, $_POST['id_customer']);
    $customer_username = mysqli_escape_string($conn,$_POST['customer_username']);
    $customer_user_password = mysqli_escape_string($conn,$_POST['customer_user_password']);
    $customer_dni = mysqli_escape_string($conn,$_POST['customer_dni']);
    $customer_email = mysqli_escape_string($conn,$_POST['customer_email']);
    $customer_forename = mysqli_escape_string($conn,$_POST['customer_forename']);
    $customer_surname = mysqli_escape_string($conn,$_POST['customer_surname']);
    $customer_birth_date = mysqli_escape_string($conn,$_POST['customer_birth_date']);
    $customer_registered = mysqli_escape_string($conn,$_POST['customer_registered']);
    $customer_active = mysqli_escape_string($conn,$_POST['customer_active']);
    
    $update_date;
    //Query
    $sql = 
    "UPDATE customers
    SET
        username = '$customer_username',
        user_password = '$customer_user_password',
        dni = '$customer_dni',
        email = '$customer_email',
        forename = '$customer_forename',
        surname = '$customer_surname',
        updated_date = CURRENT_TIMESTAMP(),
        birth_date = '$customer_birth_date',
        registered = '$customer_registered',
        active = $customer_active
        
    WHERE id_customer = $id_customer
    ;";

    // Save the query 
    $query_result = mysqli_query($conn, $sql);
    if ($query_result) {
        $update_output = "Records Successfully updated";
    } else {
        // Error from connection
        $update_output = "Database Error:" . mysqli_error($conn);
    }
    // Show the result
    printf("<p>" . $update_output . "</p>");
    // Close the connection
    mysqli_close($conn);
}

?>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
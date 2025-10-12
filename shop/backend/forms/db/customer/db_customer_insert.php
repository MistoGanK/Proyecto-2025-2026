<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<!-- HTML -->
<h1>db_customer_insert</h1>
<p>You Inserted: </p>

<?php
// Test
//print_r($_POST); // Debug 

// Variables
$customer_username = $_POST['customer_username'];
$customer_user_password = $_POST['customer_user_password'];
$customer_dni = $_POST['customer_dni'];
$customer_email = $_POST['customer_email']; 
$customer_forename = $_POST['customer_forename'];
$customer_surname = $_POST['customer_surname'];
$customer_birth_date = $_POST['customer_birth_date'];
$customer_registered = $_POST['customer_registered'];
$customer_active = $_POST['customer_active'];
// Save the key on an associative array

$customer_variables = [
    'customer_username' => $customer_username,
    'customer_user_password' => $customer_user_password,
    'customer_dni' => $customer_dni,
    'customer_email' => $customer_email,
    'customer_forename' => $customer_forename,
    'customer_surname' => $customer_surname,
    'customer_birth_date' => $customer_birth_date,
    'customer_registered' => $customer_registered,
    'customer_active' => $customer_active
];

// SQL INSERT 

$sql = "
INSERT INTO customers (username,user_password,dni,email,forename,surname,birth_date,registered,active)
VALUES (
'$customer_username',
'$customer_user_password',
'$customer_dni',
'$customer_email',
'$customer_forename',
'$customer_surname',
'$customer_birth_date',
'$customer_registered',
'$customer_active'
);";

// Connection 
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

//mysqli_query
if (mysqli_query($conn, $sql)) {
    echo "<p>Customer insertado con extio:</p>";
    echo
    "<ul>
    <li>Username: $customer_username</li>
    <li>Password: $customer_user_password</li>
    <li>Quantity: $customer_dni</li>
    <li>DNI: $customer_email</li> 
    <li>Forename Date: $customer_forename</li> 
    <li>Surname: $customer_surname</li> 
    <li>Birth Date: $customer_birth_date</li>
    <li>Is Registered: $customer_registered</li> 
    <li>Is Active: $customer_active</li> 
</ul>";
} else {
    echo "<p>Error al insertar el customer: " . mysqli_error($conn) . "</p>";
}

// Send confirmation
?>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
<h1>db_customer_select</h1>
<p>You selected: </p>

<!-- Logical fragment -->
<?php 
// Debug 
// print_r($_POST); 
// Variables
$customer_output = "No Customer selected or found";

// Before starting the query, check If the variable was sended and that the variabel is not empty

if (!isset($_POST['id_customer']) || empty($_POST['id_customer'])){
    $id_customer = null;
}
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php');
    // escape the string to avoid mysql injection
    $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
    // Initialize variable that will save the designed query
    $sql;
    if ($id_customer!=null){
        // Query
        $sql = "SELECT * FROM customers WHERE id_customer = '$id_customer'";
    }else{
        // Query
        $sql = "SELECT * FROM customers;";
    }
    // Execute the query
    $query_result = mysqli_query($conn,$sql);

    // Check if the query exists and if there was rows affected
    if ($query_result){
        // Check if any row where returned
        if (mysqli_num_rows($query_result)>0){
            // Loop and return formatted result
            while ($row = mysqli_fetch_assoc($query_result)){
                // Format the output
                printf("<p>"."Customer ID: ".$row['id_customer']."<p>");
                printf("<p>"."Customer Username: ".$row['username']."<p>");
                printf("<p>"."Customer DNI: ".$row['dni']."<p>");
                printf("<p>"."Customer Email: ".$row['email']."</p>");
                printf("<p>"."Customer Forename: ".$row['forename']."</p>");
                printf("<p>"."Customer Surname date: ".$row['surname']."</p>");
                printf("<p>"."Customer Birth Date: ".$row['birth_date']."</p>");
                printf("<p>"."Customer Creation Date: ".$row['creation_date']."</p>");
                printf("<p>"."Customer Updated Date: ".$row['updated_date']."</p>");
                printf("<p>"."Customer Registered: ".$row['registered']."</p>");
                printf("<p>"."Customer Active: ".$row['active']."</p>");
            }
        }else{
            $customer_output = "Customer with ID $id_customer not found.";
        }
    }else{
        // Error on query execution
        $customer_output = "Database Error: " . mysqli_error($conn);
    }
    // Free the result
    mysqli_free_result($query_result);
    // Close connection
    mysqli_close($conn);
?>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>

<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); 
?>
<?php
    // 1. Inicialización de variables de estado con valores de ERROR por defecto
    $id_product = null;
    $delete_output = "ERROR: id_product is missing or data not submitted correctly.";
    $message_class = "bg-red-100 border-red-500 text-red-700";

    // Check if POST its retrieved and if it has content 
    if (isset($_POST['id_product']) && !empty($_POST['id_product'])) {

        // Open connection
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

        // Save the variable and escape input
        $id_product = mysqli_escape_string($conn, $_POST['id_product']);

        $id_customer =  $_SESSION['id_customer'];
        // Query
        $sql = " DELETE FROM `022_shopping_cart` WHERE id_customer = '$id_customer' AND id_product = '$id_product'
        ;";

        // Execute the query 
        $query_result = mysqli_query($conn, $sql);

        if ($query_result) {
            // Mensaje de éxito
            $delete_output = "Record Successfully Deleted for Product ID: " . $id_product;
            $message_class = "bg-green-100 border-green-500 text-green-700";

        } else {
            
            // Mensaje de error de Base de Datos
            $delete_output = "Database Error: " . mysqli_error($conn);
            $message_class = "bg-red-100 border-red-500 text-red-700";
        }

        // Close the connection
        mysqli_close($conn);
    }

    // 2. Mostrar el resultado con el estilo correspondiente (éxito o error)
    printf("<div class='p-4 border-l-4 %s rounded-md mt-4'>" .
        "<p class='font-bold'>%s</p>" .
        "</div>", $message_class, $delete_output);

    // 3. Mensaje final con el ID, solo si se procesó un ID
    if ($id_product) {
        echo "<p class='mt-6 text-sm text-gray-500'>Attempted to process product with ID: <span class='font-bold text-[#0A090C]'>" . $id_product . "</span></p>";
    }

    ?>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/footer.php'); 
?>

<script>
    // Redirect to shopping cart
    setTimeout(() =>{
        window.location ="/student022/backend/shopping_cart/shopping_cart.php";
    },3000);
</script>
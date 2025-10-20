
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<section class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
        
<?php 
// Variables
$order_output = "No order selected or found";
$id_order = null; 

// Antes de iniciar la consulta, verificar si se envió la variable
if (isset($_POST['id_order']) && !empty($_POST['id_order'])){
    $id_order = $_POST['id_order']; // Se maneja el escape más abajo
}

// Open connection
include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php');

// Inicializar variable de consulta y escapar si es necesario
$sql;
$id_for_query = $id_order ? mysqli_real_escape_string($conn, $id_order) : null;

if ($id_for_query != null){
    // Query para un pedido específico
    $sql = "SELECT * FROM `022_orders` WHERE id_order = '$id_for_query'";
}else{
    // Query para todos los pedidos
    $sql = "SELECT * FROM `022_orders`;";
}

// Execute the query
$query_result = mysqli_query($conn,$sql);

// Check if the query exists and if there was rows affected
if ($query_result){
    // Check if any row where returned
    if (mysqli_num_rows($query_result)>0){
        // Loop and return formatted result
        while ($row = mysqli_fetch_assoc($query_result)){
            
            $id_order = $row['id_order']; // Usado para los formularios
            
            // Determinar el estilo de cancelación
            $canceled_style;
            $canceled_text;
            if ($row['canceled'] == 1){
                $canceled_style = 'text-red-600 font-bold';
                $canceled_text = 'Yes (Canceled)';
            }else{
                $canceled_style = 'text-green-600 font-regular';
                $canceled_text = 'No';
            }
            
            // Parent container of order (misma estructura que el producto)
            echo"<div class='flex flex-col h-full min-m-90 w-full flex-shrink-0
                         shadow-xl p-4
                         rounded-lg
                         bg-white
                         border
                         border-gray-700/20
                         '>";
                        // Order Container
                        echo"<div class='flex flex-col w-full h-full font-sans'>";
                            // Título de la Orden
                            echo"<h2 class='flex justify-start items-center mb-5 text-xl font-semibold'>Order ID: " . $row['id_order'] . "</h2>";
                            
                            // Total + Qty container
                            echo"<div class='flex justify-between w-full mb-5'>";
                                echo"<p class='font-extrabold text-2xl text-green-700'>" . $row['total'] . "€" . "</p>";
                                echo"<p class='font-normal text-sm'>" . "Qty: " . $row['qty'] . "</p>";
                            echo"</div>";
                            
                            // Product description
                            echo"<p class='font-normal text-sm pb-3 mb-5 border-b border-gray-600/50'>" . "Product ID: " . $row['id_product'] . " | Unit Price: " . $row['unit_price'] . "€</p>";
                            
                            // Order Info container
                            echo"<div class=' flex flex-col gap-2 text-sm text-gray-600'>";
                                echo"<p>" . "Customer ID: " . $row['id_customer'] . "</p>";
                                echo"<p>" . "Payment ID: " . $row['id_payment_method'] . "</p>";
                                echo"<p>" . "Order Date: " . $row['order_date'] . "</p>";
                                echo"<p>" . "Discount: " . $row['discount'] . "</p>";
                                echo "<p>" . "Canceled: " . "<span class='$canceled_style'>" . $canceled_text . "</span></p>";
                            echo"</div>";

                            // Form Buttons container
                            echo("<div class='flex justify-evenly items-end h-full mt-4 pt-3 border-t border-gray-200'>");
                                
                                // Delete Button Container
                                echo"<div class='p-1
                                    hover:cursor-pointer
                                    hover:text-white
                                    hover:bg-red-600
                                    hover:rounded-md
                                    '>";
                                    include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/orders/form_order_delete_call.php');
                                echo"</div>";
                                
                                // Update Button Container
                                echo"<div class='p-1
                                    hover:text-[#ffffff]
                                    hover:rounded-md
                                    hover:bg-[#000001]
                                    cursor-pointer
                                    '>";
                                    include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/orders/form_order_update_call.php');
                                echo"</div>";
                            echo("</div>");
                        echo("</div>");
            echo("</div>");
        }
    }else{
        $order_output = "Order with ID " . ($id_order ?? 'null') . " not found.";
         echo "<p class='text-red-500 font-bold mt-5'>" . $order_output . "</p>";
    }
}else{
    // Error on query execution
    $order_output = "Database Error: " . mysqli_error($conn);
    echo "<p class='text-red-500 font-bold mt-5'>" . $order_output . "</p>";
}

// Free the result
if (isset($query_result) && is_object($query_result)) {
    mysqli_free_result($query_result);
}

// Close connection
mysqli_close($conn);
?>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
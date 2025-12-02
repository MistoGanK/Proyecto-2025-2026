<?php
// Redirect if a Guest is trying to enter on orders
if ($_SESSION['role'] == 'Guest' && !isset($_session['role'])) {
    echo '<script>window.location.href = "/student022/shop/backend/autentification/login.php"</script>';
    die();
}
?>
<section class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
    <div class="w-full mb-6 border-b border-gray-200 pb-2">
        <h1 class="text-3xl font-bold text-[#0A090C] ">ORDERS</h1>
    <?php  
        if(isset($_SESSION['role']) && $_SESSION['role']=='Admin'){
            echo '<div class="flex w-full justify-center items-center">
            <div class="flex w-fit justify-center items-center p-3 
                bg-[#0A090C] 
                text-white
                cursor-pointer
                font-semibold
                rounded-md 
                hover:cursor-pointer 
                hover:bg-[#2c2732]">
                ',include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/orders/form_order_insert_call.php'),'
            </div>
        </div>';
        }
    ?>
    </div>

    <?php
    // Variables
    $order_output = "No order selected or found";
    $id_customer = $_SESSION['id_customer'] ?? null;

    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

    // Inicializar variable de consulta y escapar si es necesario
    $sql;

    if ($_SESSION['role'] == 'Admin') {
        // Mostrar todos los orders al admin
        $sql = "SELECT DISTINCT (`022_orders`.`id_order`) FROM `022_orders`;";
    } else {
        // Mostrar SOLO los pedidos del usuario
        $sql = "SELECT DISTINCT (`022_orders`.`id_order`) FROM `022_orders` WHERE id_customer = $id_customer;";
    };

    // Execute the query
    $query_result = mysqli_query($conn, $sql);
    // Importamos nuestra función
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/functions/orders/showOrders.php');
    showOrders($query_result,$conn);
    
    // Close connection
    mysqli_close($conn);

    ?>
</section>
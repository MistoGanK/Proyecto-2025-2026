<?php
// --- CORRECCIÓN DE SEGURIDAD ---
// Tenías !isset($_session['role']) en minúscula, PHP es case-sensitive para superglobales.
// Además, si no está seteado el rol, por defecto debería ir al login.
if (!isset($_SESSION['role']) || $_SESSION['role'] == 'Guest') {
    echo '<script>window.location.href = "/student022/backend/autentification/login.php"</script>';
    die();
}
?>
<section class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
    <div class="w-full mb-6 border-b border-gray-200 pb-2">
        <div class="w-full flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold tracking-tight uppercase text-gray-900 pb-3 inline-block">
            My Orders
            </h1>
            <?php  
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'){
                echo '<div class="flex w-fit justify-center items-center p-3 bg-[#0A090C] text-white cursor-pointer font-semibold rounded-md hover:bg-[#2c2732]">';
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/orders/form_order_insert_call.php');
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <?php
    // Variables
    $order_output = "No order selected or found";
    $id_customer = $_SESSION['id_customer'] ?? null;

    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

    // Inicializar variable de consulta
    $sql = "";

    if ($_SESSION['role'] == 'Admin') {
        // Mostrar todos los orders al admin
        $sql = "SELECT DISTINCT (`022_orders`.`id_order`) FROM `022_orders`;";
    } else {
        // Mostrar SOLO los pedidos del usuario
        // APRENDIZAJE: Siempre asegúrate de que $id_customer existe antes de la query
        $sql = "SELECT DISTINCT (`022_orders`.`id_order`) FROM `022_orders` WHERE id_customer = $id_customer;";
    };

    // Execute the query
    $query_result = mysqli_query($conn, $sql);

    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/orders/showOrders.php');
    
    // Ejecutamos la función para mostrar pedidos
    showOrders($query_result, $conn);
    
    // Close connection
    mysqli_close($conn);
    ?>
</section>
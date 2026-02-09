<?php
// --- CONTROL DE ACCESO ---
if (!isset($_SESSION['role']) || $_SESSION['role'] == 'Guest') {
    echo '<script>window.location.href = "/student022/backend/autentification/login.php"</script>';
    die();
}
?>

<section class="max-w-7xl mx-auto p-6 min-h-screen bg-white">
    <div class="w-full mb-10 border-b-2 border-black pb-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <h1 class="text-5xl font-black tracking-tighter uppercase italic text-gray-900">
                My <span class="text-gray-400 not-italic font-light">Orders</span>
            </h1>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mt-2">
                Displaying the latest activity from the fulfillment logs
            </p>
        </div>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'): ?>
            <div class="flex items-center p-4 bg-black text-white cursor-pointer font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-gray-800 transition-all shadow-lg active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/orders/form_order_insert_call.php'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <?php
        $id_customer = $_SESSION['id_customer'] ?? null;
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

        // LÓGICA DE OPTIMIZACIÓN: Limitamos a 50 y ordenamos por ID descendente
        if ($_SESSION['role'] == 'Admin') {
            $sql = "SELECT DISTINCT id_order FROM `022_orders` ORDER BY id_order DESC LIMIT 50;";
        } else {
            // Importante: Si no hay id_customer (raro si está logueado), evitamos que la query falle
            $id_customer_clean = mysqli_real_escape_string($conn, $id_customer);
            $sql = "SELECT DISTINCT id_order FROM `022_orders` WHERE id_customer = '$id_customer_clean' ORDER BY id_order DESC LIMIT 50;";
        }

        $query_result = mysqli_query($conn, $sql);

        // Importamos la función de visualización
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/orders/showOrders.php');
        
        // Renderizamos
        showOrders($query_result, $conn);
        
        mysqli_close($conn);
        ?>
    </div>

    <div class="mt-12 text-center border-t border-gray-100 pt-6">
        <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest">
            End of visible records. Database contains +10,000 entries. On working progress.
        </p>
    </div>
</section>
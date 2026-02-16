<section class="p-8 w-full max-w-7xl mx-auto bg-gray-50/30 min-h-screen">
    <div class="w-full mb-10 pb-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-4xl font-black tracking-tight text-gray-900 italic uppercase">
                Customers <span class="text-gray-400 font-light">Management</span>
            </h1>
            <p class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mt-3">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Live Customer Management
                </p>
        </div>

        <div class="group relative">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-gray-600 to-black rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative px-6 py-3 bg-black text-white text-sm font-bold rounded-lg hover:bg-gray-900 transition-all flex items-center shadow-xl cursor-pointer">
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/customers/form_customer_insert_call.php'); ?>
            </div>
        </div>
    </div>

    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

    $id_customer = null;
    if (isset($_POST['id_customer']) && !empty($_POST['id_customer'])) {
        $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
    }

    $sql = "SELECT * FROM `022_customers` WHERE id_customer NOT IN (151,152) ORDER BY creation_date DESC;";
    if ($id_customer != null) {
        $sql = "SELECT * FROM `022_customers` WHERE id_customer = '$id_customer'";
        $grid_class = "grid-cols-1";
    } else {
        $grid_class = "grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4";
    }
    ?>

    <div class="grid <?php echo $grid_class; ?> gap-8">

        <?php
        $query_result = mysqli_query($conn, $sql);

        if ($query_result && mysqli_num_rows($query_result) > 0) {
            while ($row = mysqli_fetch_assoc($query_result)) {
                $id_customer = $row['id_customer'];

                // Estilo de Badge para el Status
                $status_badge = ($row['active'] == 1)
                    ? '<span class="bg-green-100 text-green-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase border border-green-200">Active</span>'
                    : '<span class="bg-red-100 text-red-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase border border-red-200">Inactive</span>';

                echo "<div class='group flex flex-col h-[480px] w-full bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden'>";

                // --- TOP SECTION (Visual) ---
                echo "<div class='relative flex flex-col items-center p-6 bg-gradient-to-b from-gray-50 to-white border-b border-gray-100'>";

                // ID Badge flotante
                echo "<span class='absolute top-4 right-4 text-[10px] font-mono text-gray-400 bg-white px-2 py-1 rounded border border-gray-100'>#{$id_customer}</span>";

                $avatar_src = !empty($row['avatar_src']) ? $row['avatar_src'] : 'https://ui-avatars.com/api/?name=' . urlencode($row['forename']) . '&background=random';

                echo "<div class='relative group-hover:scale-110 transition-transform duration-500'>";
                echo "<div class='absolute inset-0 bg-black rounded-full blur-md opacity-0 group-hover:opacity-10 transition-opacity'></div>";
                echo "<img class='w-24 h-24 rounded-full object-cover border-4 border-white shadow-md' src='$avatar_src' alt='Avatar'>";
                echo "</div>";

                echo "<h2 class='mt-4 text-xl font-bold text-gray-900 truncate w-full text-center'>" . $row['forename'] . " " . $row['surname'] . "</h2>";
                echo "<div class='mt-2'>$status_badge</div>";
                echo "</div>";

                // --- INFO SECTION (Contenido fijo) ---
                echo "<div class='flex-grow p-6 space-y-4 overflow-hidden'>";

                // Bloque de Contacto
                echo "<div class='space-y-2'>";
                echo "<div class='flex items-center text-gray-600 group/item cursor-default'>";
                echo "<span class='text-[11px] font-bold text-gray-400 uppercase w-20'>Username</span>";
                echo "<span class='text-sm font-semibold text-gray-700 truncate'>" . $row['username'] . "</span>";
                echo "</div>";
                echo "<div class='flex items-center text-gray-600 group/item cursor-default'>";
                echo "<span class='text-[11px] font-bold text-gray-400 uppercase w-20'>Email</span>";
                echo "<span class='text-sm font-medium text-blue-600 truncate underline decoration-blue-200'>" . $row['email'] . "</span>";
                echo "</div>";
                echo "</div>";

                // Bloque de Detalles (DNI / Fecha)
                echo "<div class='pt-4 border-t border-dashed border-gray-200 grid grid-cols-2 gap-4'>";
                echo "<div>";
                echo "<p class='text-[10px] font-bold text-gray-400 uppercase tracking-tighter'>Document ID</p>";
                echo "<p class='text-xs font-mono text-gray-700'>" . $row['dni'] . "</p>";
                echo "</div>";
                echo "<div>";
                echo "<p class='text-[10px] font-bold text-gray-400 uppercase tracking-tighter'>Member Since</p>";
                echo "<p class='text-xs font-medium text-gray-700'>" . date('M Y', strtotime($row['creation_date'])) . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // --- ACTION BUTTONS (Footer) ---
                echo "<div class='p-4 bg-gray-50 flex items-center justify-between gap-2 border-t border-gray-100'>";

                // Delete (Rojo)
                echo "<div class='flex-1 h-10 flex items-center justify-center rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors group/del' title='Eliminar'>";
                echo "<div class='scale-90 group-hover/del:scale-100 transition-transform'>";
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/customers/form_customer_delete_call.php');
                echo "</div>";
                echo "</div>";

                // Separador
                echo "<div class='w-px h-6 bg-gray-200'></div>";

                // Select & Update (Negro)
                echo "<div class='flex-1 h-10 flex items-center justify-center rounded-lg hover:bg-gray-200 transition-colors' title='Ver Detalles'>";
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/customers/form_customer_select.php');
                echo "</div>";

                echo "<div class='flex-1 h-10 flex items-center justify-center rounded-lg hover:bg-gray-200 transition-colors' title='Editar'>";
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/customers/form_customer_update_call.php');
                echo "</div>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<div class='col-span-full py-20 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200'>";
            echo "<p class='text-gray-400 font-medium text-lg'>No se encontraron clientes que coincidan.</p>";
            echo "</div>";
        }
        mysqli_close($conn);
        ?>
    </div>
</section>
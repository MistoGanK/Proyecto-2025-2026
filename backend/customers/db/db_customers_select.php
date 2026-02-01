<section class="p-8 w-full mx-auto">
    <div class="w-full mb-8 pb-4 border-b-2 border-gray-200 flex justify-between items-center">
        <h1 class="text-3xl font-extrabold tracking-tight uppercase text-gray-900">
            Customers Management
        </h1>
        <div class="p-3 bg-black text-white font-semibold rounded-lg 
                    hover:cursor-pointer hover:bg-gray-800 transition-colors">
            <?php include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/customers/form_customer_insert_call.php'); ?> 
        </div> 
    </div>

<?php 
// Variables
$customer_output = "No Customer selected or found";
$id_customer = null;

// Open connection
include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/config/connection.php');

// ... (Lógica de obtención de $id_customer) ...
if (isset($_POST['id_customer']) && !empty($_POST['id_customer'])){
    $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
}

// Initialize variable that will save the designed query
$sql = "SELECT * FROM `022_customers`;"; 

if ($id_customer != null){
    // Query para un solo cliente
    $sql = "SELECT * FROM `022_customers` WHERE id_customer = '$id_customer'";
    
    // CLAVE: Si se busca un cliente específico, usamos una sola columna ancha
    $grid_class = "grid-cols-1";
    $card_width_class = "w-full"; // Asegura que la tarjeta use todo el ancho de la columna 
} else {
    // CLAVE: Si se muestran todos, usamos el grid responsivo
    $grid_class = "grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4";
    $card_width_class = ""; // No se necesita ancho fijo en grid, ya se adapta
}

?>
    <div class="grid <?php echo $grid_class; ?> gap-6">

<?php 
// Execute the query
$query_result = mysqli_query($conn, $sql);

// Check if the query exists and if there was rows affected
if ($query_result){
    if (mysqli_num_rows($query_result)>0){
        // Loop and return formatted result
        while ($row = mysqli_fetch_assoc($query_result)){
            $id_customer = $row['id_customer'];
            $active_style = ($row['active'] == 1) 
                        ? 'text-green-600 font-bold' 
                        : 'text-red-600 font-bold';
            
            // --- Customer Card Start ---
            echo"<div class='flex flex-col h-full $card_width_class
                        shadow-lg p-5 rounded-xl bg-white 
                        border border-gray-200 hover:shadow-xl transition-shadow duration-300
                        '>"; 
                // --- TOP SECTION: AVATAR, NAME & STATUS ---
                echo "<div class='flex flex-col items-center text-center w-full mb-4 pb-4 border-b border-gray-200'>";
                    // 1. AVATAR CONTAINER (Photo de Perfil)
                    $avatar_src = isset($row['avatar_src']) && !empty($row['avatar_src']) 
                                ? $row['avatar_src'] 
                                : 'https://via.placeholder.com/80?text=👤';
                    
                    echo "<div class='w-20 h-20 rounded-full overflow-hidden mb-3 bg-gray-100 border-2 border-gray-300'>";
                        echo "<img class='w-full h-full object-cover' src='" . $avatar_src . "' alt='Customer Avatar'>";
                    echo "</div>";

                    // 2. Título principal (Nombre + Apellido)
                    echo "<h2 class='text-2xl font-extrabold text-gray-900'>".$row['forename'] . " " . $row['surname'] . "</h2>";
                    
                    // 3. Status Activo
                    echo "<p class='text-sm mt-1'>" . "Status: " . "<span class='$active_style'>Active: " . $row['active'] . "</span></p>";
                echo "</div>"; // Cierre TOP SECTION

                // --- MIDDLE SECTION: Key Info (Username/Email) ---
                echo "<div class='flex flex-col w-full mb-4 gap-1 text-sm text-gray-700'>";
                    echo "<p class='font-semibold'>Username: <span class='font-normal text-gray-600'>" . $row['username'] . "</span></p>";
                    echo "<p class='font-semibold'>Email: <span class='font-normal text-gray-600'>" . $row['email'] . "</span></p>";
                echo "</div>";
                
                // --- BOTTOM SECTION: All Details (Smaller text) ---
                echo "<div class='flex flex-col gap-1 text-xs text-gray-500 border-t pt-3'>";
                    echo "<p><span class='font-medium'>ID:</span> " . $row['id_customer'] . "</p>";
                    echo "<p><span class='font-medium'>DNI:</span> " . $row['dni'] . "</p>";
                    echo "<p><span class='font-medium'>Birth:</span> " . $row['birth_date'] . "</p>";
                    echo "<p><span class='font-medium'>Registered:</span> " . $row['creation_date'] . "</p>";
                echo "</div>";
                
                // --- ACTION BUTTONS CONTAINER (MODIFICADO) ---
                // Usamos 'flex w-full space-x-2' para distribución y 'flex-grow' en los hijos
                echo("<div class='flex w-full space-x-2 items-end mt-4 pt-3 border-t border-gray-100'>");
                    
                    // Delete Button - Añadimos flex-1 y text-center, ajustamos padding
                    echo "<div class='flex-1 p-2 transition-colors duration-200 rounded-md text-center
                                    hover:bg-red-600 hover:text-white cursor-pointer'
                                    title='Delete Customer'>";
                        include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/customers/form_customer_delete_call.php');
                    echo "</div>";
                    
                    // Select Button - Añadimos flex-1 y text-center, ajustamos padding
                    echo "<div class='flex-1 p-2 transition-colors duration-200 rounded-md text-center
                                    hover:bg-black hover:text-white cursor-pointer'
                                    title='Select Customer'>";
                        include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/customers/form_customer_select.php');
                    echo "</div>";
                    
                    // Update Button - Añadimos flex-1 y text-center, ajustamos padding
                    echo "<div class='flex-1 p-2 transition-colors duration-200 rounded-md text-center
                                    hover:bg-black hover:text-white cursor-pointer'
                                    title='Update Customer'>";
                        include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/customers/form_customer_update_call.php');
                    echo "</div>";
                echo "</div>";
                
            echo "</div>"; // Cierre Tarjeta Cliente
        }
    } else {
        echo "<p class='text-lg text-gray-500 col-span-full'>Customer with ID $id_customer not found.</p>";
    }
} else {
    echo "<p class='text-lg text-red-500 col-span-full'>Database Error: " . mysqli_error($conn) . "</p>";
}

// Clean up
if ($query_result) {
    mysqli_free_result($query_result);
}
mysqli_close($conn);
?>
    </div>
</section>
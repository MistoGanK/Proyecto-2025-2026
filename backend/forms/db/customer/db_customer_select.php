<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/header.php'); ?>

<section class="flex flex-row flex-wrap h-full p-5 gap-5 items-center justify-center">

    <div class="flex flex-row h-full flex-wrap w-full gap-5 items-start justify-start">

<?php 
// Debug 
// print_r($_POST); 
// Variables
$customer_output = "No Customer selected or found";
$id_customer = null;

// Open connection
include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/config/connection.php');

// Before starting the query, check If the variable was sended and that the variabel is not empty
if (isset($_POST['id_customer']) && !empty($_POST['id_customer'])){
    // escape the string to avoid mysql injection
    $id_customer = mysqli_real_escape_string($conn, $_POST['id_customer']);
}

// Initialize variable that will save the designed query
$sql = "SELECT * FROM customers;"; 

if ($id_customer != null){
    // Query
    $sql = "SELECT * FROM `022_customers` WHERE id_customer = '$id_customer'";
}

// Execute the query
$query_result = mysqli_query($conn, $sql);

// Check if the query exists and if there was rows affected
if ($query_result){
    // Check if any row where returned
    if (mysqli_num_rows($query_result)>0){
        // Loop and return formatted result
        while ($row = mysqli_fetch_assoc($query_result)){
            $id_customer = $row['id_customer'];
            
            // Aplicar estilado de active ~
            $active_style;
            if ($row['active'] == 1){
                $active_style = 'text-green-600 font-regular';
            } else {
                $active_style = 'text-red-600 font-regular';
            }

            // Parent container of customer
            echo "<div class='flex flex-col h-fit flex-shrink-0 w-full p-5
                    shadow-xl p-4
                    rounded-lg
                    bg-white
                    border
                    border-gray-700/20
                    '>";
                // Customer Container
                echo "<div class='flex flex-col w-full h-full font-sans'>";
                    
                    // Título principal (Nombre + Apellido)
                    echo "<h2 class='flex justify-start items-center mb-2 text-xl font-semibold'>".$row['forename'] . " " . $row['surname'] . "</h2>";
                    
                    // Información destacada: Username y Email
                    echo "<div class='flex justify-between w-full mb-5 pb-3 border-b border-gray-600/50'>";
                        echo "<p class='font-extrabold text-lg'>" . $row['username'] . "</p>";
                        echo "<p class='font-normal text-sm'>" . $row['email'] . "</p>";
                    echo "</div>";
                    
                    // Customer Info container (Todos los detalles)
                    echo "<div class=' flex flex-col gap-2 text-sm text-gray-600'>";
                        echo "<p>" . "ID: " . $row['id_customer'] . "</p>";
                        echo "<p>" . "DNI: " . $row['dni'] . "</p>";
                        echo "<p>" . "Birth Date: " . $row['birth_date'] . "</p>";
                        echo "<p>" . "Creation Date: " . $row['creation_date'] . "</p>";
                        echo "<p>" . "Updated Date: " . $row['updated_date'] . "</p>";
                        echo "<p>" . "Registered: " . $row['registered'] . "</p>";
                        echo "<p>" . "Active: " . "<span class='$active_style'>" . $row['active'] . "</span></p>";
                        echo "<p>" . "Password: " . $row['user_password'] . "</p>";
                    echo "</div>";
                    
                    // Form Buttons container
                        echo("<div class='flex justify-evenly items-end h-full'>");
                        
                        // Delete Button Container
                        echo "<div class='p-1 
                            hover:cursor-pointer
                            hover:text-white
                            hover:bg-red-600
                            hover:rounded-md
                            '>";
                            include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/customers/form_customer_delete_call.php');
                        echo "</div>";
                         
                        // Update Button Container
                        echo "<div class='p-1 
                            hover:text-[#ffffff]
                            hover:rounded-md
                            hover:bg-[#0A090C]
                            cursor-pointer
                            '>";
                            include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/forms/customers/form_customer_update_call.php');
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    }else{
        $customer_output = "Customer with ID $id_customer not found.";
    }
} else {
    // Error on query execution
    $customer_output = "Database Error: " . mysqli_error($conn);
}

// Free the result
if ($query_result) {
    mysqli_free_result($query_result);
}
// Close connection
mysqli_close($conn);
?>
</div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/backend/footer.php'); ?>
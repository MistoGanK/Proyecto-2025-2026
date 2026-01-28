<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen">

  <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">

    <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Edit Review Result</h1>

    <?php

    // 1. Inicialización de variables de estado con valores de ERROR por defecto
    $update_output = "ERROR: id_review is missing or data not submitted correctly.";
    $message_class = "bg-red-100 border-red-500 text-red-700";

    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

    // Save the variables and escape input
    $id_order = isset($_POST['id_order']) ? htmlspecialchars($_POST['id_order']) : 'N/A';
    $id_product = isset($_POST['id_product']) ? htmlspecialchars($_POST['id_product']) : 'N/A';
    $id_customer = $_SESSION['id_customer'];
    $score = isset($_POST['score']) ? (int)htmlspecialchars($_POST['score']) : 'N/A';
    $body_review = isset($_POST['body_review']) ? htmlspecialchars($_POST['body_review']) : 'N/A';
    $positive_features = isset($_POST['positive_features']) ? htmlspecialchars($_POST['positive_features']) : 'N/A';
    $negative_features = isset($_POST['negative_features']) ? htmlspecialchars($_POST['negative_features']) : 'N/A';

    // Query
    $sql =
      "UPDATE `022_product_reviews`
            SET
                points = $score,
                body_review = '$body_review',
                positive_features = '$positive_features',
                negattive_features = '$negative_features',
                review_date = CURRENT_TIMESTAMP()                
            WHERE id_customer = $id_customer AND id_product = $id_product;
            ;";

    // Save the query 
    $query_result = mysqli_query($conn, $sql);

    if ($query_result) {
      // Mensaje de éxito: Sobrescribe las variables de error
      $update_output = "Review Successfully updated for Product : " . $id_order;
      $message_class = "bg-green-100 border-green-500 text-green-700";
    } else {
      // Mensaje de error de Base de Datos: Sobrescribe las variables de error (si no fuera por el init)
      $update_output = "Database Error: " . mysqli_error($conn);
      $message_class = "bg-red-100 border-red-500 text-red-700";
    }

    // Close the connection
    mysqli_close($conn);

    // 3. Mostrar el resultado: Se usa el valor final de las variables
    printf("<div class='p-4 border-l-4 %s rounded-md mt-4'>" .
      "<p class='font-bold'>%s</p>" .
      "</div>", $message_class, $update_output);
    ?>

  </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
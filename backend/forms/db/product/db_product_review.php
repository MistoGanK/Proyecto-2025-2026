<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<section class="flex justify-center p-8 min-h-screen bg-gray-50">

    <div class="w-full max-w-xl h-fit p-8 bg-white shadow-xl rounded-lg border border-gray-200 text-center">

        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Review Result</h1>

        <?php

        // 1. Inicialización de variables para el resultado
        $review_output = "ERROR: Review data is missing or incomplete.";
        $message_class = "bg-red-100 border-red-500 text-red-700";
        $success = false;

        // Variables (capturadas de POST)
        // Se asume que todas las variables POST están presentes, si no, se usará el error inicial.
        $score = isset($_POST['score']) ? (int)htmlspecialchars($_POST['score']) : 'N/A';
        $body_review = isset($_POST['body_review']) ? htmlspecialchars($_POST['body_review']) : 'N/A';
        $positive_features = isset($_POST['positive_features']) ? htmlspecialchars($_POST['positive_features']) : 'N/A';
        $negative_features = isset($_POST['negative_features']) ? htmlspecialchars($_POST['negative_features']) : 'N/A';
        $id_customer = $_SESSION['id_customer'];
        $id_product = isset($_POST['id_product']) ? htmlspecialchars($_POST['id_product']) : 'N/A';
        $id_order = isset($_POST['id_order']) ? htmlspecialchars($_POST['id_order']) : 'N/A';

        // 2. Lógica de Inserción (solo si se recibe el campo de envío)
        if (isset($_POST['send'])) {

            // Connection 
            include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

            // Escape input
            $safeScore = mysqli_escape_string($conn, $score);
            $safeBody_review = mysqli_escape_string($conn, $body_review);
            $safePositive_features = mysqli_escape_string($conn, $positive_features);
            $safeNegative_features = mysqli_escape_string($conn, $negative_features);

            // SQL INSERT 
            $sql = "
            INSERT INTO `022_product_reviews` (id_customer, id_product,	points, body_review,positive_features, negattive_features)
            VALUES ('$id_customer','$id_product','$safeScore','$safeBody_review','$safePositive_features','$safeNegative_features')
            ;";
            
            // Mark as reviewd on orders
            $sqlReviwed = " UPDATE `022_orders` SET is_reviewd = 1 WHERE id_order = $id_order AND id_product = $id_product;";

            // mysqli_query
            if (mysqli_query($conn, $sql) && mysqli_query($conn,$sqlReviwed)) {
                $review_output = "Review successfully inserted";
                $message_class = "bg-green-100 border-green-500 text-green-700";
                $success = true;
            } else {
                $review_output = "Database Error: " . mysqli_error($conn);
                $message_class = "bg-red-100 border-red-500 text-red-700";
            }

            // Close the connection
            mysqli_close($conn);
        }

        // 3. Mostrar el resultado (Caja de estado)
        printf("<div class='p-4 border-l-4 %s rounded-md mt-4 text-left'>" .
            "<p class='font-bold'>%s</p>" .
            "</div>", $message_class, $review_output);

        //  Redirect to reviews the review
        
        ?>

        <div class="mt-8">
            <a href="/student022/shop/backend/products/products.php"
                class="p-3 inline-block bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150">
                View Reviews
            </a>
        </div>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
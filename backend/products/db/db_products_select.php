<!-- Header -->
<section id="productSection" class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
    <div class="w-full mb-2 border-b border-gray-200 pb-2">
        <div class="w-full mb-2 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight items-center justify-between uppercase text-gray-900">
                All Products
            </h1>
        <?php
        // Insert product button only admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
        } else {
            echo "
                        <div class='flex w-fit justify-center items-center p-3 
                        bg-[#0A090C] 
                        text-[#FEFFFE] 
                        font-semibold
                        rounded-md 
                        hover:cursor-pointer 
                        hover:bg-[#2c2732]'>
                        ", include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/forms/products/form_product_insert_call.php'), "
                </div>
                ";
        }
        ?>
        </div>
    </div>
    <div id="searchEndPointResult">

    </div>
    <?php
    $product_output = "No product selected or found";

    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

    // Before starting the query, check If the variable was sended and that the variabel is not empty

    if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
        $id_product = null;
    } else {
        $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
    }

    $sqlQuery;

    if ($id_product != null) {
        // Query
        if ($_SESSION['role'] == 'Admin') {
            // Shows all product info
            $sqlQuery = "SELECT * FROM `022_products` WHERE id_product = '$id_product'";
        } else {
            // Shows only limited info
            $sqlQuery =
                "SELECT 
                id_product,
                product_name,
                price,
                stock,
                description,
                launch_date,
                img_src
            FROM `022_products`
            WHERE id_product = '$id_product' 
            AND active = 1
            AND availability != 'discontinued' ";
        };
    } else {
        if ($_SESSION['role'] == 'Admin') {
            // Query
            $sqlQuery = "SELECT * FROM `022_products`;";
        } else {
            // Shows only limited info
            $sqlQuery =
                "SELECT 
                id_product,
                product_name,
                price,
                stock,
                description,
                launch_date,
                img_src
            FROM `022_products`
            WHERE active = 1
            AND availability != 'discontinued' ";
        };
    };

    // Execute the query

    $result = mysqli_query($conn, $sqlQuery);

    // Get function showProducts()
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/functions/products/showProducts.php');
    showProducts($result);

    // Cleaning the result 
    mysqli_free_result($result);
    ?>

</section>
<!-- Footer -->
<script src="/student022/shop/backend/functions/products/searchForProduct.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
<section id="productSection" class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center bg-white">
    <div class="w-full mb-8 border-b-2 border-black pb-6">
        <div class="w-full flex justify-between items-end">
            <div>
                <h1 class="text-5xl font-black tracking-tighter uppercase italic text-gray-900 leading-none">
                    Products
                </h1>
                <p class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mt-3">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Live Inventory Management
                </p>
            </div>

            <?php
            // Admin buttons
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                echo "<div class='flex w-fit justify-center items-center px-6 py-3 bg-[#0A090C] text-[#FEFFFE] text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-[#2c2732] transition-all shadow-lg active:scale-95 cursor-pointer'>";
                    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/products/form_product_insert_call.php');
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <div id="products_container" class="w-full h-full mb-2 flex-wrap flex gap-8 justify-center">
        <?php
        $id_customer = $_SESSION['id_customer'] ?? null;
        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

        if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
            $id_product = null;
        } else {
            $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
        }

        // Query Logic
        if ($id_product != null) {
            if ($_SESSION['role'] == 'Admin') {
                $sqlQuery = "SELECT * FROM `022_products` WHERE id_product = '$id_product'";
            } else {
                $sqlQuery = "SELECT id_product, product_name, price, stock, description, launch_date, img_src 
                             FROM `022_products` 
                             WHERE id_product = '$id_product' AND active = 1 AND availability != 'discontinued' ";
            }
        } else {
            if ($_SESSION['role'] == 'Admin') {
                // !--- Work around ----! Needs real limit control
                $sqlQuery = "SELECT * FROM `022_products` ORDER BY id_product DESC LIMIT 50;";
            } else {
                $sqlQuery = "SELECT id_product, product_name, price, stock, description, launch_date, img_src 
                             FROM `022_products` 
                             WHERE active = 1 AND availability != 'discontinued' 
                             ORDER BY id_product DESC LIMIT 50;";
            }
        }

        $result = mysqli_query($conn, $sqlQuery);

        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/products/showProducts.php');
        showProducts($result);

        mysqli_free_result($result);
        ?>
    </div>
</section>

<script src="/student022/backend/functions/products/searchForProduct.js"></script>
<script src="/student022/backend/functions/products/insertToShoppingCarth.js"></script>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
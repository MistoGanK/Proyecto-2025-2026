<?php
/**
 * Displays a list of products in a card format matching Customer Management style.
 */
function showProducts($products)
{
    $productsFetch = mysqli_fetch_all($products, MYSQLI_ASSOC);

    foreach ($productsFetch as $product) {
        $id_product = $product['id_product'];

        // Control de fechas y error strtotime
        $display_updated = !empty($product['updated_date']) ? date('d/m/y', strtotime($product['updated_date'])) : 'Never';

        // Imagen por defecto
        $img_src = !empty($product['img_src']) ? $product['img_src'] : '/student022/assets/icons/placeholder_product.png';

        // Estilo de Status Badge
        $status_badge = "";
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
            $status_badge = ($product['availability'] == 'on_stock')
                ? '<span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-lg uppercase border border-green-200 tracking-tighter">On Stock</span>'
                : '<span class="bg-red-100 text-red-700 text-[10px] font-black px-3 py-1 rounded-lg uppercase border border-red-200 tracking-tighter">Out of Stock</span>';
        }

        $card_height = "h-[650px]";
        $size_classes = (count($productsFetch) == 1) ? 'w-full max-w-4xl' : 'w-[24rem] flex-shrink-0';

        echo "<div class='group flex flex-col $card_height $size_classes bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden mb-4'>";

            // --- TOP: IMAGEN (Con el degradado de tu diseño) ---
            echo "<div class='relative h-64 w-full bg-gradient-to-b from-gray-50 to-white p-8 overflow-hidden'>";
                echo "<span class='absolute top-6 left-6 text-[10px] font-black text-gray-400 bg-white/80 backdrop-blur-sm px-2 py-1 rounded-lg border border-gray-100 z-10 uppercase tracking-widest'>#ID-{$id_product}</span>";
                
                echo "<div class='w-full h-full flex justify-center items-center group-hover:scale-110 transition-transform duration-700 ease-out'>";
                    echo "<img class='max-w-full max-h-full object-contain drop-shadow-2xl' src='$img_src' alt='Product img'>";
                echo "</div>";
            echo "</div>";

            // --- MID: INFO ---
            echo "<div class='flex flex-col flex-grow p-8'>";
                
                echo "<div class='flex justify-between items-start mb-4 gap-4'>";
                    echo "<h2 class='text-2xl font-black text-gray-900 tracking-tighter leading-tight truncate flex-1' title='" . $product['product_name'] . "'>" . $product['product_name'] . "</h2>";
                    echo "<div>" . $status_badge . "</div>";
                echo "</div>";

                echo "<div class='flex items-center gap-3 mb-4'>";
                    echo "<p class='font-black text-3xl text-gray-900 tracking-tighter'>" . $product['price'] . "€</p>";
                    echo "<span class='h-4 w-px bg-gray-200'></span>";
                    echo "<p class='text-[11px] font-bold text-gray-400 uppercase tracking-widest'>Stock: " . $product['stock'] . "</p>";
                echo "</div>";

                echo "<p class='text-sm text-gray-500 line-clamp-3 h-12 leading-relaxed mb-6 font-medium italic'>" . $product['description'] . "</p>";

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                    echo "<div class='grid grid-cols-2 gap-4 text-[10px] text-gray-400 uppercase font-black border-t border-dashed border-gray-100 pt-6'>";
                        echo "<div class='flex flex-col'><span>Updated</span><span class='text-gray-900 font-bold'>".$display_updated."</span></div>";
                        echo "<div class='flex flex-col text-right'><span>Active</span><span class='text-gray-900 font-bold'>".$product['active']."</span></div>";
                    echo "</div>";
                }
            echo "</div>";

            // --- BOTTOM: BOTONES (Sólidos y rellenos como pediste) ---
            echo "<div class='p-6 bg-gray-50/50 flex flex-wrap items-center justify-center gap-3 border-t border-gray-100'>";

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                    echo "<div class='flex-1 min-w-[70px] h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm font-black text-[10px] uppercase tracking-tighter cursor-pointer group/btn'>";
                        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/products/form_product_delete_call.php');
                    echo "</div>";

                    echo "<div class='flex-1 min-w-[70px] h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-black hover:text-white transition-all shadow-sm font-black text-[10px] uppercase tracking-tighter cursor-pointer'>";
                        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/products/form_product_update_call.php');
                    echo "</div>";
                }

                if ($product['stock'] > 0) {
                    echo "<div class='flex-[1.5] min-w-[110px] h-10 flex items-center justify-center rounded-xl bg-black text-white hover:bg-gray-800 transition-all shadow-xl transform hover:scale-105 cursor-pointer font-black text-[10px] uppercase tracking-widest'>";
                        include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/shopping_cart/form_add_product_cart.php');
                    echo "</div>";
                }

                echo "<div class='flex-1 min-w-[70px] h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-100 transition-all font-black text-[10px] uppercase tracking-tighter cursor-pointer'>";
                    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/forms/products/form_product_select.php');
                echo "</div>";

            echo "</div>";
        echo "</div>";
    }
}
?>
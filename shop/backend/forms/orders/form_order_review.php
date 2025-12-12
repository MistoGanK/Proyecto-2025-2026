<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<?php 
    $id_order = $_POST['id_order'];
?>
<section class="flex justify-center p-8 min-h-screen ">
    
    <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200">
        
        <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Review Product</h1>
        
        <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/product/db_product_review.php" method="post">
            <!-- ID Order  -->
        <input type="number" id="id_order" name="id_order" value="<?php echo $id_order ?>" hidden="true">
    
            <label class="flex flex-col text-sm font-medium text-gray-700">
                General Review:
            <select id="general_review">
                <option value="1">Very Bad</option>
                <option value="2">Bad</option>
                <option value="3">Good</option>
                <option value="4">Very Good</option>
                <option value="5">Excellent</option>
            </select>
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700">
                Review: 
                <textarea name="body_review" id="body_review" maxlength="1000" minlength="50" placeholder="review..."></textarea>
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700">
                Postive features:
                <textarea name="positive_features" id="positive_features" minlength="10" maxlength="500" placeholder="positive features..."></textarea>
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700">
                Negative features:
                <textarea name="negative_features" id="negative_features" minlength="10" maxlength="500" placeholder="positive features..."></textarea>
            </label>
            
            <label class="flex flex-col text-sm font-medium text-gray-700 mt-4" for="send">
                Submit:
                <input class="p-3 bg-[#0A090C] mt-3 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold transition duration-150" 
                    type="submit" 
                    id="send" 
                    name="send" 
                    value="Insert Order">
            </label>
            
        </form>

    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
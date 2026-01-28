<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<?php
// POST && SESSION VARIABLES
// $currentDate = date('Y-m-d h:i:s',time()); 
$productName = htmlspecialchars($_POST['product_name']);
$id_order = htmlspecialchars($_POST['id_order']);
$id_product = htmlspecialchars($_POST['id_product']);
$id_customer = $_SESSION['id_customer'];
?>
<script>
  function redirectOrder() {
    window.location = '/student022/shop/backend/orders/orders.php';
  };
</script>
<?php
// Inicializacion de las variables que se ingresaran en values
$score;
$bodyReview;
$positiveFeatures;
$negativeFeatures;
// Obtenemos primero la información de la review
$queryReviews  = "SELECT * FROM `022_view_product_reviews` WHERE id_customer = $id_customer AND id_product = $id_product;";
// Open conn
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
if ($queryReviewsResult = mysqli_query($conn, $queryReviews)) {
  // Fetch the result 
  $reviewsData = mysqli_fetch_assoc($queryReviewsResult);
  $score = $reviewsData['points'];
  $bodyReview = $reviewsData['body_review'];
  $positiveFeatures = $reviewsData['positive_features'];
  $negativeFeatures = $reviewsData['negattive_features'];
} else {
  print_r("Error on the db connection: " . $conn);
}
?>
<section class="flex justify-center p-8 min-h-screen h-fit">

  <div class="w-full max-w-xl p-8 bg-white shadow-xl rounded-lg border border-gray-200 h-fit">

    <h1 class="text-3xl font-bold text-[#0A090C] mb-6 border-b border-gray-200 pb-2">Review</h1>
    <h2 class="text-2xl font-bold text-[#0A090C] mb-6 "><?php echo $productName; ?></h2>

    <form class="flex flex-col gap-4" action="/student022/shop/backend/forms/db/product/db_product_edit_review.php" method="post">
      <input id='id_product' name='id_product' type='number' value="<?php echo $id_product; ?>" hidden>
      <input id='id_order' name='id_order' type='number' value="<?php echo $id_order; ?>" hidden>
      <label class="flex flex-col text-sm font-medium text-gray-700">
        Score:
        <select class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          id="score"
          name="score">
          <option value="1">★</option>
          <option value="2">★★</option>
          <option value="3">★★★</option>
          <option value="4">★★★★</option>
          <option value="5">★★★★★</option>
        </select>
      </label>

      <label class="flex flex-col text-sm font-medium text-gray-700">
        Review:
        <textarea class="text-left mt-1 p-2 h-50 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          type="number"
          id="body_review"
          name="body_review"
          maxlength="1000">
          <?php echo $bodyReview; ?>
          </textarea>
      </label>

      <label class="text-left flex flex-col text-sm font-medium text-gray-700">
        Positive features:
        <textarea class="mt-1 h-30 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          id="positive_features"
          name="positive_features"
          maxlength="500">
          <?php echo $positiveFeatures; ?>
        </textarea>
      </label>

      <label class="flex flex-col text-sm font-medium text-gray-700">
        Negative Features:
        <textarea class="text-left mt-1 h-30 p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#0A090C] focus:ring focus:ring-[#0A090C]/50"
          type="text"
          id="negative_features"
          name="negative_features"
          >
          <?php echo $negativeFeatures; ?>
        </textarea>
      </label>

      <input class="p-3 bg-[#0A090C] text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold mt-3 transition duration-150"
        type="submit"
        id="send"
        name="send"
        value="Review">
    </form>

    <button class="p-3 w-full bg-red-600 mt-2 hover:bg-red-500 text-[#FEFFFE] rounded-md hover:cursor-pointer hover:bg-[#2c2732] font-semibold  transition duration-150"
      onclick="redirectOrder()">
      Cancel
    </button>

  </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
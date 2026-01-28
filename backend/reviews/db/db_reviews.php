<!-- Header -->
<section id="productSection" class="flex flex-row flex-wrap h-fit p-5 gap-5 items-center justify-center">
  <div class="w-full mb-6 border-b border-gray-200 pb-2">
    <h1 class="text-3xl font-extrabold tracking-tight uppercase text-gray-900 pb-3 mb-8 inline-block">
      OPINIONS AND RATINGS
    </h1>
  </div>
  <?php
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
    $sqlQuery =
      "SELECT * FROM `022_view_product_reviews` WHERE id_product = $id_product;";
  } else {
    // Query
    $sqlQuery = "SELECT * FROM `022_view_product_reviews`;";
  };

  // Execute the query

  $result = mysqli_query($conn, $sqlQuery);

  // Get function showProducts()
  include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/functions/reviews/showReviews.php');
  showReviews($result);

  // Cleaning the result 
  mysqli_free_result($result);
  ?>

</section>
<!-- Footer -->
<script src="/student022/shop/backend/functions/products/searchForProduct.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>
<section id="productSection" class="max-w-7xl mx-auto p-8 min-h-screen bg-white">
  <div class="w-full mb-12 border-b-4 border-black pb-6 flex flex-col md:flex-row justify-between items-end gap-4">
    <div>
      <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-2">Public Ledger</p>
      <h1 class="text-5xl font-black tracking-tighter uppercase italic text-gray-900">
        Opinions <span class="text-gray-300 not-italic font-light">& Ratings</span>
      </h1>
    </div>
    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-l-2 border-gray-100 pl-4">
      Verified Customer <br> Feedback System
    </div>
  </div>

  <div class="flex flex-row flex-wrap justify-center gap-8">
  <?php
  // Open connection
  include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

  if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
    $id_product = null;
  } else {
    $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
  }

  if ($id_product != null) {
    $sqlQuery = "SELECT * FROM `022_view_product_reviews` WHERE id_product = $id_product ORDER BY review_date DESC;";
  } else {
    $sqlQuery = "SELECT * FROM `022_view_product_reviews` ORDER BY review_date DESC;";
  };

  $result = mysqli_query($conn, $sqlQuery);

  // Get function showReviews()
  include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/reviews/showReviews.php');
  
  showReviews($result);

  mysqli_free_result($result);
  ?>
  </div>
</section>
<script src="/student022/backend/functions/products/searchForProduct.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>
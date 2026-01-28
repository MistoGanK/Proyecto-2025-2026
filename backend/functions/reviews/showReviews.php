<?php
/**
 * Displays a list of product reviews with a spacious, minimalist design (Black and White).
 * @param mysqli_result $reviewResult The result of the SQL query for the reviews.
 */
function showReviews($reviewResult)
{
  $reviewsFetch = mysqli_fetch_all($reviewResult, MYSQLI_ASSOC);
  
  // Base class for the spacious review card.
  $review_card_classes = "flex flex-col p-8 shadow-xl rounded-xl bg-white border border-gray-900/10";

  // Class for the features container (Pros and Cons)
  $features_container_classes = "flex flex-col gap-4 mt-6 pt-6 border-t border-gray-300 text-gray-700";

  foreach ($reviewsFetch as $review) {
    $id_product = $review['id_product']; 

    // --- Main Review Container (Spacious and centered) ---
    echo "<div class='$review_card_classes w-full max-w-6xl mx-auto mb-8'>"; 

      // 1. Review Header (Product Name and Score)
      echo "<div class='grid grid-cols-3 gap-8 pb-4 border-b border-gray-300 items-start'>";
        
        // Column 1: Product Name
        echo "<h2 class='text-2xl font-bold text-gray-900'>" . $review['product_name'] . "</h2>";
        
        // Column 2: Score
        echo "<p class='text-5xl font-extrabold text-black text-center'>";
          echo $review['points'] . "<span class='text-2xl font-semibold text-gray-600'>/5</span>"; 
        echo "</p>";
        
        // Column 3: User details
        echo "<div class='text-right text-base'>";
          echo "<p class='font-bold text-gray-900'>" . $review['username'] . "</p>";
          echo "<p class='text-gray-600'>" . "Fecha: " . $review['review_date'] . "</p>";
        echo "</div>";

      echo "</div>";

      // 2. Review Body (Main Text)
      echo "<div class='mt-6'>";
        echo "<p class='font-bold text-xl mb-3 text-gray-900'>Review:</p>";
        echo "<p class='text-lg text-gray-700'>" . $review['body_review'] . "</p>";
      echo "</div>";
      
      // 3. Positive and Negative Features (Pros and Cons)
      echo "<div class='$features_container_classes'>";

        // Positive Features (Using bold text and titles)
        echo "<div>";
          echo "<p class='font-extrabold text-lg text-gray-900 mb-1'>Advantages:</p>";
          echo "<p class='text-base text-gray-600'>" . $review['positive_features'] . "</p>";
        echo "</div>";

        // Negative Features (Using bold text and titles)
        if (!empty($review['negattive_features'])) {
          echo "<div>";
            echo "<p class='font-extrabold text-lg text-gray-900 mb-1'>Disadvantages:</p>";
            echo "<p class='text-base text-gray-600'>" . $review['negattive_features'] . "</p>";
          echo "</div>";
        }
        
      echo "</div>"; // Closes Features container
        
      // 4. Administration Block (if needed)
      if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
        // Administration buttons (e.g., edit/delete review) would go here.
      }

    echo "</div>"; // Closes Main Container
  }
}
?>
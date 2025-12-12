<?php
function showReviews($reviewResult)
{
  $reviewsFetch = mysqli_fetch_all($reviewResult, MYSQLI_ASSOC);
  foreach ($reviewsFetch as $review) {
    // id_product saved for the forms of the inputs
    $id_product = $review['id_product'];

    // Parent container of review
    // If the query returns only one review: 
    if (count($reviewsFetch) == 1) {
      echo "<div class='flex flex-col h-full max-h-110 flex-shrink-0 w-full 
                    shadow-xl p-4
                    rounded-lg
                    bg-white
                    border
                    border-gray-700/20
                    '>";
    } else {
      echo "<div class='flex flex-col h-fit p-10 max-h-110 flex-shrink-0 w-1/1 
                    shadow-xl p-4
                    rounded-lg
                    bg-white
                    border
                    border-gray-700/20
                    '>";
    }
    // Review Container
    echo "<div class='flex flex-col w-full h-full font-sans'>";
      echo "<div class='flex flex-row justify-between items-center'>";
        echo "<h2 class='flex justify-start items-center text-xl font-bold'>" . $review['product_name'] . "</h2>";
        echo "<div>";
          echo "<h2 class='flex justify-start items-center text-xl font-bold'>" . $review['username'] . "</h2>";
          echo "<p class='text-lg text-gray-700'>" . "Review Date: " . $review['review_date'] . "</p>";
        echo "</div>";
      echo "</div>";
    // Price + qty container

      echo "<div class='flex justify-between w-full mb-5'>";
        echo "<p class='font-extrabold text-2xl'>Score: " . $review['points'] . "</p>";
      echo "</div>";

    // Review Container
      echo "<div class=' flex flex-col gap-2 text-xs text-gray-600'>";

        echo "<p class='font-normal flex flex-col text-2xl'>" ."<span class='font-bold'>Review:</span><span class='text-xl'>" . $review['body_review'] . "</span></p>";
        echo "<p class='font-normal flex flex-col text-xl'>" ."<span class='font-bold'>Positive Features:</span><span class='flex flex-col text-lg'>" . $review['positive_features'] . "</span></p>";
    // Fields only shown to admin
    if ($_SESSION['role'] == 'Admin') {
    };
    echo "<p class='font-normal flex flex-col text-xl'>" ."<span class='font-bold'>Negative Features:</span><span class='flex flex-col text-lg'>" . $review['negattive_features'] . "</span></p>";
    echo "</div>";
    // Form Buttons container
    echo ("<div class='flex justify-evenly items-end h-full'>");

    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
};

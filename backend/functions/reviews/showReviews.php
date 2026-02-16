<?php
/**
 * Renderiza las reseñas con el estilo visual de las Product Cards.
 * @param mysqli_result $reviewResult Resultado de la consulta SQL.
 */
function showReviews($reviewResult)
{
  if (!$reviewResult || mysqli_num_rows($reviewResult) === 0) {
    echo "
    <div class='w-full max-w-4xl mx-auto py-20 text-center border border-gray-100 rounded-[2rem] shadow-sm'>
        <p class='text-gray-400 uppercase tracking-widest text-xs font-bold'>No reviews yet</p>
    </div>";
    return;
  }

  $reviewsFetch = mysqli_fetch_all($reviewResult, MYSQLI_ASSOC);
  
  foreach ($reviewsFetch as $review) {
    // Main container
    echo "<article class='w-full max-w-4xl mx-auto mb-12 bg-white rounded-[3rem] shadow-lg border border-gray-50 overflow-hidden flex flex-col p-10'>"; 

      // Header
      echo "<div class='flex justify-between items-start mb-8'>";
        echo "<div>";
          // ID
          echo "<span class='bg-gray-100 text-gray-500 text-[10px] font-bold px-3 py-1 rounded-full uppercase mb-3 inline-block'>Review Log</span>";
          echo "<h2 class='text-3xl font-black text-[#0A090C] tracking-tight'>" . $review['product_name'] . "</h2>";
          echo "<p class='text-sm font-medium text-gray-400 mt-1'>" . $review['username'] . " • " . $review['review_date'] . "</p>";
        echo "</div>";
        
        // Score
        echo "<div class='text-right'>";
          echo "<span class='text-4xl font-black text-[#0A090C]'>" . $review['points'] . "</span>";
          echo "<span class='text-gray-300 text-xl font-bold'>/5</span>";
        echo "</div>";
      echo "</div>";

      // Body review
      echo "<div class='mb-10'>";
        echo "<p class='text-lg text-gray-500 italic leading-relaxed'>" . $review['body_review'] . "</p>";
      echo "</div>";
      
      // Advantages && Disadvantages
      echo "<div class='flex flex-row flex-wrap justify-center gap-6'>";

        // Advantages
        echo "<div class='p-6 rounded-[2rem] border border-gray-100 bg-gray-50/30'>";
          echo "<h4 class='text-[11px] font-black uppercase tracking-[0.2em] text-[#0A090C] mb-3'>Advantages</h4>";
          echo "<p class='text-sm text-gray-600 font-medium'>" . $review['positive_features'] . "</p>";
        echo "</div>";

        // Disadvantages
        if (!empty($review['negattive_features'])) {
          echo "<div class='p-6 rounded-[2rem] border border-gray-100 bg-gray-50/10'>";
            echo "<h4 class='text-[11px] font-black uppercase tracking-[0.2em] text-gray-400 mb-3'>Disadvantages</h4>";
            echo "<p class='text-sm text-gray-400 font-medium'>" . $review['negattive_features'] . "</p>";
          echo "</div>";
        }
        
      echo "</div>";

      // Review Footer
      if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
          echo "<div class='mt-10 pt-8 border-t border-gray-50 flex justify-end gap-3'>";
            echo "<button class='px-6 py-2 bg-black text-white text-[10px] font-bold uppercase rounded-xl hover:bg-gray-800 transition-all'>Moderate</button>";
            echo "<button class='px-6 py-2 border border-gray-200 text-gray-400 text-[10px] font-bold uppercase rounded-xl hover:bg-gray-50 transition-all'>Hide</button>";
          echo "</div>";
      }

    echo "</article>"; 
  }
}
?>
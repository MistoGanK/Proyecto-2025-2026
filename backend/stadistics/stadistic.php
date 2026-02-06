<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); 
?>

<div class="grid grid-cols-2 grid-rows-2 gap-4 w-full h-[800px] p-5">
  <div class="relative w-full h-full">
    <canvas id="myChart"></canvas>
  </div>
  <div class="relative w-full h-full">
    <canvas id="pieGlobalShareChart"></canvas>
  </div>
  <div class="relative w-full h-full">
    <canvas id="chart3"></canvas>
  </div>
  <div class="relative w-full h-full">
    <canvas id="chart4"></canvas>
  </div>
</div>

<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); 
?>
<script src="../scripts/charts/barChart.js"></script>
<script src="../scripts/charts/pieChart.js"></script>
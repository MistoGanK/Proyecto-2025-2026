<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); 
?>

<div class="flex-grow bg-white p-8 overflow-y-auto">
    
    <div class="mb-10 flex flex-col gap-1">
        <h2 class="text-4xl font-black text-gray-900 tracking-tight italic uppercase">
            Business <span class="text-gray-400 not-italic font-light">Analytics</span>
        </h2>
        <div class="flex items-center gap-2">
            <span class="flex h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-widest">Real-time performance metrics</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full">
        
        <?php
        $charts = [
            ['id' => 'myChart', 'title' => 'Monthly Income', 'badge' => 'Live Update'],
            ['id' => 'pieGlobalShareChart', 'title' => 'Market Share', 'badge' => 'By Region'],
            ['id' => 'chart3', 'title' => 'Customer Retention', 'badge' => 'Analysis'],
            ['id' => 'chart4', 'title' => 'Product Performance', 'badge' => 'Sales']
        ];

        foreach ($charts as $chart): 
        ?>
        <div class="group bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500">
            <div class="flex items-start justify-between mb-8">
                <div>
                    <h3 class="font-black text-xl text-gray-900 tracking-tight mb-1"><?php echo $chart['title']; ?></h3>
                    <div class="h-1 w-12 bg-black rounded-full group-hover:w-20 transition-all duration-500"></div>
                </div>
                <span class="text-[10px] font-black px-3 py-1 bg-gray-100 text-gray-500 rounded-lg uppercase tracking-tighter border border-gray-200 group-hover:bg-black group-hover:text-white transition-colors">
                    <?php echo $chart['badge']; ?>
                </span>
            </div>
            
            <div class="h-[380px] w-full flex justify-center items-center">
                <canvas id="<?php echo $chart['id']; ?>"></canvas>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); 
?>

<script src="../scripts/charts/barChart.js"></script>
<script src="../scripts/charts/pieChart.js"></script>

<script>
    Chart.defaults.global.defaultFontFamily = "'Plus Jakarta Sans', 'Inter', sans-serif";
    Chart.defaults.global.defaultFontSize = 11;
    Chart.defaults.global.defaultFontColor = '#64748b'; 
    
    Chart.defaults.scale.gridLines.color = "rgba(0, 0, 0, 0.03)";
    Chart.defaults.scale.gridLines.zeroLineColor = "rgba(0, 0, 0, 0.05)";
</script>
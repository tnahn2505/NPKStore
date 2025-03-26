<?php

if (isset($_GET['limit_day'])) {
    $limit_day = $_GET['limit_day'];
} else {
    $limit_day = 10;
}

if(isset($_GET['type_chart'])) {
    $_SESSION['type_chart'] = htmlspecialchars($_GET['type_chart'], ENT_QUOTES, 'UTF-8');
}else {
    if(empty($_SESSION['type_chart'])) {
        $_SESSION['type_chart'] = 'bar';
    }
}

$statistics_orders = $OrderModel->get_order_sold_by_day($limit_day);

// Mảng chứa mã màu nền
$backgroundColorArray = [
    'rgba(255, 99, 132, 0.2)',
    'rgba(255, 159, 64, 0.2)',
    'rgba(255, 205, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(201, 203, 207, 0.2)',
    'rgba(128, 0, 0, 0.2)',
    'rgba(0, 128, 0, 0.2)',
    'rgba(0, 0, 128, 0.2)',
    'rgba(255, 0, 0, 0.2)',
    'rgba(0, 255, 0, 0.2)',
    'rgba(0, 0, 255, 0.2)',
    'rgba(255, 255, 0, 0.2)',
    'rgba(255, 0, 255, 0.2)',
    'rgba(0, 255, 255, 0.2)',
    'rgba(128, 128, 0, 0.2)',
    'rgba(128, 0, 128, 0.2)',
    'rgba(0, 128, 128, 0.2)'
];

// Mảng chứa mã màu border
$boderColorArray = [
    'rgb(255, 99, 132)',
    'rgb(255, 159, 64)',
    'rgb(255, 205, 86)',
    'rgb(75, 192, 192)',
    'rgb(54, 162, 235)',
    'rgb(153, 102, 255)',
    'rgb(201, 203, 207)',
    'rgb(128, 0, 0)',
    'rgb(0, 128, 0)',
    'rgb(0, 0, 128)',
    'rgb(255, 0, 0)',
    'rgb(0, 255, 0)',
    'rgb(0, 0, 255)',
    'rgb(255, 255, 0)',
    'rgb(255, 0, 255)',
    'rgb(0, 255, 255)',
    'rgb(128, 128, 0)',
    'rgb(128, 0, 128)',
    'rgb(0, 128, 128)'
];

// Tên sản phẩm
foreach ($statistics_orders as $value) {

    $ten_san_pham[] = $value['order_date'];
}

// Lượt bán
foreach ($statistics_orders as $value) {

    $luot_ban[] = $value['total_sold_quantity'];
}

?>

<div class="mt-5">
    <h5 class="text-center">Sản phẩm đã bán trong <?=$limit_day?> ngày gần đây</h5>
    
    <div class="d-flex">
        <div class="dropdown" style="margin-right: 15px;">
            <a class="btn btn-custom dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Biểu đồ
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                    <a href="luot-ban-theo-ngay&type_chart=bar" class="dropdown-item">Bar Chart</a>
                </li>
                <li>
                    <a href="luot-ban-theo-ngay&type_chart=line" class="dropdown-item">Line Chart</a>
                </li>
                <li>
                    <a href="luot-ban-theo-ngay&type_chart=doughnut" class="dropdown-item">Doughnut</a>
                </li>
                
            </ul>
        </div>

        <div class="dropdown">
            <a class="btn btn-custom dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Thời gian
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                    <a href="luot-ban-theo-ngay&limit_day=100" class="dropdown-item">Xem tất cả</a>
                </li>
                <li>
                    <a href="luot-ban-theo-ngay&limit_day=7" class="dropdown-item">7 ngày</a>
                </li>
                <li>
                    <a href="luot-ban-theo-ngay&limit_day=14" class="dropdown-item">14 ngày</a>
                </li>
                <li>
                    <a href="luot-ban-theo-ngay&limit_day=21" class="dropdown-item">21 ngày</a>
                </li>
                <li>
                    <a href="luot-ban-theo-ngay&limit_day=30" class="dropdown-item">30 ngày</a>
                </li>
            </ul>
        </div>
    </div>
    <canvas class="mt-2" style="max-height: 500px; margin-right: 20px;" id="chart_order_by_date"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx_date = document.getElementById('chart_order_by_date');

    new Chart(ctx_date, {
        type: '<?php echo htmlspecialchars($_SESSION['type_chart'], ENT_QUOTES, 'UTF-8'); ?>',
        data: {
            labels: <?php echo json_encode($ten_san_pham); ?>,
            datasets: [{
                label: 'Đã bán',

                data: <?php echo json_encode($luot_ban); ?>,

                backgroundColor: <?php echo json_encode($backgroundColorArray); ?>,

                borderColor: <?php echo json_encode($boderColorArray); ?>,

                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
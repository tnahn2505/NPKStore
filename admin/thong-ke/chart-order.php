<?php
$statistics_orders = $OrderModel->get_order_product_statistics();

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

    $ten_san_pham[] = $value['product_name'];
}

// Lượt bán
foreach ($statistics_orders as $value) {

    $luot_ban[] = $value['total_sold_quantity'];
}

?>

<div class="mt-5">
    <h5>Top sản phẩm bán chạy</h5>
    <div class="dropdown">
        <a class="btn btn-custom dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Top bán chạy
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li> 
                <a href="top-luot-ban&top=100" class="dropdown-item">Xem tất cả</a>
            </li>
            <li> 
                <a href="top-luot-ban&top=5" class="dropdown-item">Top 5</a>
            </li>
            <li> 
                <a href="top-luot-ban&top=10" class="dropdown-item">Top 10</a>
            </li>
            <li> 
                <a href="top-luot-ban&top=15" class="dropdown-item">Top 15</a>
            </li>
            <li> 
                <a href="top-luot-ban&top=30" class="dropdown-item">Top 30</a>
            </li>
        </ul>
    </div>

    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($ten_san_pham); ?>,
            datasets: [{
                label: 'Số lượng đã bán',

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
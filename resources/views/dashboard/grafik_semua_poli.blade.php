<canvas id="chart2"></canvas>
<script>
    var ctx2 = document.getElementById('chart2');
    var unit = {!! json_encode($unit) !!};
    var total = {!! json_encode($total) !!};
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: unit,
            datasets: [{
                label: '# Data Penggunaan',
                data: total,
                borderWidth: 1,
                backgroundColor: '#9932CC',
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

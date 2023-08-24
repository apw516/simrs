<canvas id="chart3"></canvas>
<script>
    var ctx4 = document.getElementById('chart3');
    var unit = {!! json_encode($tgl) !!};
    var total = {!! json_encode($jml) !!};
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: unit,
            datasets: [{
                label: '# Data Penggunaan',
                data: total,
                borderWidth: 1,
                backgroundColor: '#008B8B',
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

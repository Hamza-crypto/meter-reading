<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Consumption Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="electricityChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('electricityChart').getContext('2d');
        var electricityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($meter1Data, 'date')) ?>,
                datasets: [{
                    label: 'Meter 1',
                    data: <?= json_encode(array_column($meter1Data, 'reading')) ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }, {
                    label: 'Meter 2',
                    data: <?= json_encode(array_column($meter2Data, 'reading')) ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'MMM D'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Cumulative Reading'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>

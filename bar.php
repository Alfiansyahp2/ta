<!DOCTYPE html>
<html>

<head>
    <title>Contoh Penggunaan BarsGraph</title>
    <style type="text/css">
        BODY {
            height: 100%;
            width: 100%;
            margin: 0 auto;
        }

        #chart-container {
            width: 80%;
            height: 400px;
            margin: 20px auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            showGraph();
        });

        function showGraph() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "bar_encode.php", true);
            xhr.setRequestHeader("Content-type", "application/json");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);

                    var allMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                    var labels = [];
                    var values = [];

                    var monthData = {};

                    for (var i in data) {
                        var month = data[i].bulan;
                        monthData[month] = data[i].jumlah_id;
                    }

                    for (var i = 1; i <= 12; i++) {
                        labels.push(allMonths[i - 1]);
                        values.push(monthData[i] || 0);
                    }

                    var chartdata = {
                        labels: labels,
                        datasets: [{
                            label: 'id_pesanan',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: values
                        }]
                    };

                    var graphTarget = document.getElementById('graphCanvas');

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                } else {
                    console.error("Error: " + xhr.statusText);
                }
            };

            xhr.onerror = function () {
                console.error("Network error");
            };

            xhr.send();
        }
    </script>
</body>

</html>

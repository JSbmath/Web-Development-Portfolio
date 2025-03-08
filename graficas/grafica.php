<?php
include("conexion.php");
$con=conectar();
$sql = "Select Name, Population FROM city ORDER By Population DESC LIMIT 10";
$res = $con->query($sql);
?>
<html>
  <head>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Name', 'Population'],

            <?php
while ($fila = $res->fetch_assoc()) {
    echo "['".$fila["Name"]."',".$fila["Population"]."],";
}
             ?>

          ]);

                  var options = {
                    title: 'Top 10 ciudades más pobladas del mundo',
                    is3D: true
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

                  chart.draw(data, options);
                }
              </script>
  </head>

  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>

</html>

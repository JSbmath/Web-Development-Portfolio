<!DOCTYPE html>
<?php
include("conexion.php");
$con=conectar();
$sql = "Select Name, LifeExpectancy FROM country ORDER By LifeExpectancy DESC LIMIT 11";
$res = $con->query($sql);
?>

<html>
<head>
  <meta charset="utf-8">

  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,600,200italic,600italic&subset=latin,vietnamese' rel='stylesheet' type='text/css'>

  <script src="http://phuonghuynh.github.io/js/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/d3/d3.min.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/d3-transform/src/d3-transform.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/cafej/src/extarray.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/cafej/src/misc.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/cafej/src/micro-observer.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/microplugin/src/microplugin.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/bubble-chart/src/bubble-chart.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/bubble-chart/src/plugins/central-click/central-click.js"></script>
  <script src="http://phuonghuynh.github.io/js/bower_components/bubble-chart/src/plugins/lines/lines.js"></script>
  <script src="index.js"></script>
  <style>
    .bubbleChart {
      min-width: 100px;
      max-width: 1200px;
      height: 700px;
      margin: 0 auto;
    }
    .bubbleChart svg{
      background: #000000;
    }
  </style>

<script>
$(document).ready(function () {
var bubbleChart = new d3.svg.BubbleChart({
  supportResponsive: true,
  size: 150,
  innerRadius: 150 / 3.5,
  radiusMin: 10,
  data: {
    items: [
      <?php
while ($fila = $res->fetch_assoc()) {
echo '{text: "'.$fila["Name"].'", count: "'.$fila["LifeExpectancy"].'"},';
}
		 ?>
             //{text: "Something", count: "170"},
    ],
    eval: function (item) {return item.count;},
    classed: function (item) {return item.text.split(" ").join("");}
  },
  plugins: [
    {
      name: "lines",
      options: {
        format: [
          {// Line #0
            textField: "count",
            classed: {count: true},
            style: {
              "font-size": "10px",
              "font-family": "Source Sans Pro, sans-serif",
              "text-anchor": "middle",
              fill: "white"
            },
            attr: {
              dy: "0px",
              x: function (d) {return d.cx;},
              y: function (d) {return d.cy;}
            }
          },
          {// Line #1
            textField: "text",
            classed: {text: true},
            style: {
              "font-size": "5px",
              "font-family": "Source Sans Pro, sans-serif",
              "text-anchor": "middle",
              fill: "white"
            },
            attr: {
              dy: "5px",
              x: function (d) {return d.cx;},
              y: function (d) {return d.cy;}
            }
          }
        ],
        centralFormat: [
          {// Line #0
            style: {"font-size": "15px"},
            attr: {}
          },
          {// Line #1
            style: {"font-size": "10px"},
            attr: {dy: "10px"}
          }
        ]
      }
    }]
});
});
</script>


</head>
<body style="background: #000000">
<div class="bubbleChart" height="100%" width="100%"/>
</body>
</html>

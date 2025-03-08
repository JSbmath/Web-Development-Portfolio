

<!DOCTYPE HTML>

<?php
include("conexion.php");
$con=conectar();
$sql = "Select Name, SurfaceArea FROM country ORDER By SurfaceArea DESC LIMIT 10";
$res = $con->query($sql);
?>

<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContaine", {
	animationEnabled: true,

	title:{
		text:"Países con mayor territorio"
	},
	axisX:{
		interval: 1
	},
	axisY2:{
		interlacedColor: "rgba(1,77,101,.2)",
		gridColor: "rgba(1,77,101,.1)",
		title: "Territorio en Km"
	},
	data: [{
		type: "bar",
		name: "companies",
		axisYType: "secondary",
		color: "#014D65",
		dataPoints: [
			<?php
while ($fila = $res->fetch_assoc()) {
echo "{ y: ".$fila["SurfaceArea"].', label: "'.$fila["Name"].'" },';
}
		 ?>
		 //{ y: 3, label: "Sweden" },
		]
	}]
});
chart.render();

}
</script>

</head>

<body>
<div id="chartContaine" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

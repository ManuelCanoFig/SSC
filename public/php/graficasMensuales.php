<script type="text/javascript" src="../js/Chart.js" ></script>
<canvas id="chartsemanal" width="400" height="200"></canvas>
<style type="text/css">
	canvas#chartsemanal{
    width: 100%;
    max-width:  700px;
    max-height: 350px;
    position: absolute;

  }
</style>
<?php
//Fechas
//31,28,31,30,31,30,31,31,30,31,30,31
//inicio_fin_semana($fecha);

include 'conecDB.php';
$mes = $_GET["mes"];

$ano = date("Y");


$fecha = $ano."-".$mes."-1";
$timestamp = strtotime( $fecha );
$diasdelmes = date( "t", $timestamp );

$tipo = $_GET["type"];
?>
<script type="text/javascript">
	
	var ctx = document.getElementById("chartsemanal").getContext('2d');
var myChart = new Chart(ctx, {
    type: '<?php echo $tipo ?>',
    data: {
        labels: [
        <?php 
        for($i=1;$i<= $diasdelmes;$i++){
        	echo '"'.$i.'",';
        }
        ?>
        ],
        datasets: [{
            label: 'Alumnos',
            data: [
            <?php 
	        for($i=1;$i<= $diasdelmes;$i++){
	        	$fechaf = $ano."-".$mes."-".$i;
	        	$consulta = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fechaf'");
	        	echo mysqli_num_rows($consulta).",";
	        }
	        ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>
<script type="text/javascript" src="../js/jquery.min.js" ></script>
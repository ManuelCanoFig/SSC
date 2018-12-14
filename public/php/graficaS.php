<script type="text/javascript" src="../js/Chart.js" ></script>
<canvas id="chartsemanal" width="400" height="200"></canvas>
<style type="text/css">
	 canvas#chartsemanal{
    width: 100%;
    max-width:  500px;
    max-height: 400px;
  }
</style>
<?php
//Fechas
//31,28,31,30,31,30,31,31,30,31,30,31
//inicio_fin_semana($fecha);
include 'conecDB.php';
$nuevaFecha = mktime(0,0,0,date("m"),date("d"),date("Y")); 
$diaDeLaSemana = date("w", $nuevaFecha);
$nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
$fecha1=date ("Y-m-d",$nuevaFecha);
$fecha2=date ("Y-m-d",($nuevaFecha+1*24*3600));
$fecha3=date ("Y-m-d",($nuevaFecha+2*24*3600));
$fecha4=date ("Y-m-d",($nuevaFecha+3*24*3600));
$fecha5=date ("Y-m-d",($nuevaFecha+4*24*3600));
$fecha6=date ("Y-m-d",($nuevaFecha+5*24*3600));
$fecha7=date ("Y-m-d",($nuevaFecha+6*24*3600));

//consultas
$consulta0 = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha2'");//lunes
$consulta1 = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha3'");//martes
$consulta2 = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha4'");//miercoles
$consulta3 = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha5'");//jueves
$consulta4 = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha6'");//viernes

echo mysqli_num_rows($historial);

$tipo = $_GET["type"];

?>
<script type="text/javascript">
	
	var ctx = document.getElementById("chartsemanal").getContext('2d');
var myChart = new Chart(ctx, {
    type: '<?php echo $tipo ?>',
    data: {
        labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"],
        datasets: [{
            label: 'Alumnos',
            data: [
            <?php echo mysqli_num_rows($consulta0); ?>,
            <?php echo mysqli_num_rows($consulta1); ?>, 
            <?php echo mysqli_num_rows($consulta2); ?>, 
            <?php echo mysqli_num_rows($consulta3); ?>, 
            <?php echo mysqli_num_rows($consulta4); ?>],
            backgroundColor: [
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
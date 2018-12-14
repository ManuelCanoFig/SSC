<?php
include 'conecDB.php';

$fecha = $_GET['fecha'];

$historial = mysqli_query($conex,"SELECT * FROM historial WHERE fecha = '$fecha' ORDER BY `id` DESC");

if(mysqli_num_rows($historial)>0){
	
   while($rows = mysqli_fetch_array($historial)){
   	   $id = $rows['id_alumno'];
   	   $nombre = mysqli_query($conex,"SELECT * FROM Alumno WHERE id='$id'"); 
   	   $filas = mysqli_fetch_array($nombre);
   	   echo '<tr>';
   	   echo '<td>'.$filas['nombre'].' '.$filas['apellidos'].'</td>';
   	   echo '<td>'.$rows['c_horas'].'</td>';
   	   echo '<td>'.$rows['fecha'].'</td>';
   	   echo '<td>'.$rows['hora'].'</td>';
   	   echo '</tr>';
   }
}

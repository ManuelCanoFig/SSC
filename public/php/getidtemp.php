<?php 
include 'conecDB.php';

 $getid = mysqli_query($conex,"SELECT * FROM Conexion");
  if(mysqli_num_rows($getid)>0){
  	 $row = mysqli_fetch_array($getid);
  	 $id_tarjeta = $row['id_tarjeta'];
  	  $getid2 = mysqli_query($conex,"SELECT * FROM Alumno where id_tarjeta = '$id_tarjeta'");
  	   if(mysqli_num_rows($getid2)>0){
  	   	$rows = mysqli_fetch_array($getid2);
  	   	$id_unico = $rows['id'];
  	   	echo '<input type="text" style="display:none;"  id="idActual" value="'.$id_unico.'" name="" disabled> ';
  	   }
  }
?>
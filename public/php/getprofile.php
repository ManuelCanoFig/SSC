<?php
include 'conecDB.php';
//CODE of profile
$trueconexion = mysqli_query($conex,"SELECT * FROM Conexion");
  if(mysqli_num_rows($trueconexion)>0){
  	 $row = mysqli_fetch_array($trueconexion);
  	 $id_tarjeta = $row['id_tarjeta'];
  	 
     $isexist = mysqli_query($conex,"SELECT * FROM Alumno WHERE id_tarjeta = '$id_tarjeta' ");
     if(mysqli_num_rows($isexist)>0){
     	//codigo para mostrar el usuario
     	$row = mysqli_fetch_array($isexist);
     	echo '<script>  updateUser(); </script>';
     	echo '<p>Alumno:</p>';
     	echo '<p>'.$row['nombre'].' '.$row['apellidos'].'</p>';
     	$gg = $row['gradogrupo'];
     	$id_carrera = $row['carrera'];
       	$carrera = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera='$id_carrera'"); 
		   $rowc = mysqli_fetch_array($carrera);
		   echo '<p>Carrera: </p>';
		   echo '<p>'.$rowc['carrera'].'</p>';

		  
		   $gradog = mysqli_query($conex,"SELECT * FROM gradogrupo WHERE id='$gg'"); 
		   $rowg = mysqli_fetch_array($gradog);
		   echo '<p>No. Cuenta: '.$row['no_cuenta'].'</p>';
		   echo '<p>Grado/Grupo: '.$rowg['grado/grupo'].'</p>';
     	//$conex->query("DELETE FROM Conexion");
     }else{
     	//codigo para registrar el usuario
     	echo '<script>  setID(); </script>';
     }
  }else{
  	//No existe ningun usuario
  	echo '<p>Esperando Tarjeta...<p>';
  }



/*

$idtarjeta = $_GET['id'];

$comprobacion = mysqli_query($conex,"SELECT * FROM Alumno WHERE id_tarjeta='$idtarjeta'");
if(mysqli_num_rows($comprobacion)>0){ //DATOS DEL ALUMNOS

   $row = mysqli_fetch_array($comprobacion);
   echo '<p>Nombre:</p>';
   echo '<p>'.$row['nombre'].' '.$row['apellidos'].'</p>';
   echo '<p>No. Cuenta:'.$row['no_cuenta'].'</p>';
   echo '<p>Carrera:</p>';
   $gg = $row['gradogrupo'];
   $id_carrera = $row['carrera'];
   $carrera = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera='$id_carrera'"); 
   $rowc = mysqli_fetch_array($carrera);
   echo '<p>'.$rowc['carrera'].'</p>';

  
   $gradog = mysqli_query($conex,"SELECT * FROM gradogrupo WHERE id='$gg'"); 
   $rowg = mysqli_fetch_array($gradog);
   echo '<p>Grado/Grupo: '.$rowg['grado/grupo'].'</p>';
}*/

?>
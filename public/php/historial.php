<?php 
include 'conecDB.php';
if(isset($_GET["noall"])){
//Todos los filtros
	$fecha = $_GET['fecha'];
	$carrera = $_GET['carrera'];
	$grado = $_GET['gradog'];
	
	if($grado == "All" && $carrera == "All"){//solo tomar a consideracion la fecha
          $historial = mysqli_query($conex,"SELECT * FROM historial INNER JOIN Alumno ON historial.id_alumno=Alumno.id WHERE historial.fecha='$fecha'");
	}else{
		
		if($grado == "All"){//Ignorar grado
			$historial = mysqli_query($conex,"SELECT * FROM historial INNER JOIN Alumno ON historial.id_alumno=Alumno.id WHERE historial.fecha='$fecha' AND Alumno.carrera='$carrera'");
		}else{if($carrera == "All"){//Ignorar carrera
			$historial = mysqli_query($conex,"SELECT * FROM historial INNER JOIN Alumno ON historial.id_alumno=Alumno.id WHERE historial.fecha='$fecha' AND Alumno.gradogrupo='$grado'");
			
		}else{//tomar en cuenta todo
			$historial = mysqli_query($conex,"SELECT * FROM historial INNER JOIN Alumno ON historial.id_alumno=Alumno.id WHERE historial.fecha='$fecha' AND Alumno.gradogrupo='$grado' AND Alumno.carrera='$carrera' ");
		}}
	}

//Definimos la conexion de historal correcta
if(mysqli_num_rows($historial)>0){

	while($rows = mysqli_fetch_array($historial)){
		 echo "<tr>";
		       echo "<td>".$rows['no_cuenta']."</td>";
		       echo "<td>".$rows['nombre']." ".$rows['apellidos']."</td>";
		       $ids2 = $rows['carrera'];
		   	   $carrera = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera='$ids2'");
			   $row2 = mysqli_fetch_array($carrera);
			   echo '<td>'.$row2['carrera'].'</td>';
		   	   $ids = $rows['gradogrupo'];
		   	   $grupo = mysqli_query($conex,"SELECT * FROM gradogrupo WHERE id='$ids'");
               $row = mysqli_fetch_array($grupo);
               echo '<td>'.$row['grado/grupo'].'</td>';
		       echo "<td>".$rows['fecha']."</td>";
		       
		       $horasf = $rows['hora'];
		       $idpersonal = $rows['id'];
		       $C_horas = $rows['c_horas'];
		       $f_echa = $rows['fecha'];
		       $getid = mysqli_query($conex,"SELECT * FROM historial WHERE id_alumno='$idpersonal' AND hora='$horasf' AND fecha='$f_echa' AND c_horas='$C_horas'");
		       while($row2 = mysqli_fetch_array($getid)){
		       	 echo '<td><button onclick="DeleteH('.$row2['id'].')" id="delete-button" >Eliminar</button></td>';
		       }
		       
		       
		       //echo '<td><button onclick="DeleteH('.$rows['id'].')" id="delete-button" >Eliminar</button></td>';
		 echo "</tr>";

	}
}else{
	echo "<p>No se encontró ningún resultado</p>";
}

}else{
$historial = mysqli_query($conex,"SELECT * FROM historial ORDER BY `id` DESC");
		if(mysqli_num_rows($historial)>0){
			
		   while($rows = mysqli_fetch_array($historial)){
		   	   $id = $rows['id_alumno'];
		   	   $nombre = mysqli_query($conex,"SELECT * FROM Alumno WHERE id='$id'"); 
		   	   $filas = mysqli_fetch_array($nombre);
		   	   echo '<tr>';
		   	   echo '<td>'.$filas['no_cuenta'].'</td>';
		   	   echo '<td>'.$filas['nombre'].' '.$filas['apellidos'].'</td>';
		   	   $ids2 = $filas['carrera'];
		   	   $carrera = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera='$ids2'");
			   $row2 = mysqli_fetch_array($carrera);
			   echo '<td>'.$row2['carrera'].'</td>';
		   	   $ids = $filas['gradogrupo'];
		   	   $grupo = mysqli_query($conex,"SELECT * FROM gradogrupo WHERE id='$ids'");
               $row = mysqli_fetch_array($grupo);
               echo '<td>'.$row['grado/grupo'].'</td>';
		   	   echo '<td>'.$rows['fecha'].'</td>';
		   	   echo '<td><button onclick="DeleteH('.$rows['id'].')" id="delete-button" >Eliminar</button></td>';
		   	   echo '</tr>';
		   }
		}
}

function getcarreras($id_carrera){
	$carrera = mysqli_query($conex,"SELECT * FROM carreras WHERE id_carrera='$id_carrera'");
	$row = mysqli_fetch_array($carrera);
	$name = $row['carrera'];
	echo '<td>'.$name.'</td>';
}

function getgrupos($id_grupo){
	echo $id_grupo;
    $grupo = mysqli_query($conex,"SELECT * FROM gradogrupo WHERE id='$id_grupo'");
    $row = mysqli_fetch_array($grupo);
    $nameg = $row['grado/grupo'];
    echo '<td>'.$nameg.'</td>';
}

function getAlumno($id_A){
    $alumno = mysqli_query($conex,"SELECT * FROM Alumno WHERE id='$id_A'");
    $row = mysqli_fetch_array($alumno);
    return $row;
}
?>
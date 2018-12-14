<?php 
//Accion puede ser 0 = buscar, 1 es igual a editar, 2 = borrar
include 'conecDB.php';

if(isset($_GET['accion'])){

	$metodo = $_GET['accion'];

	switch ($metodo) {
		case 0: //Search
			$no_cuenta = $_GET['nocuenta'];
			$carrera = $_GET['carrera'];
			$grado = $_GET['grado'];

			if($no_cuenta == ""){

				if($carrera == "All" && $grado == "All"){//no tomar en cuenta ninguno
				        $consulta = mysqli_query($conex,"SELECT * FROM Alumno ");
				}else{if($carrera == "All"){//solo tomar carrera
						$consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE gradogrupo='$grado'");
					}else{if($grado == "All"){ //solo tomar carrera
						
						$consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE carrera='$carrera'");
					}else{//TODOS
						
						$consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE carrera='$carrera' AND gradogrupo ='$grado' ");
						
					}

					}
	 
				    }
			}else{
				if($carrera == "All" && $grado == "All"){//no tomar en cuenta ninguno
				        $consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE no_cuenta='$no_cuenta'");
				}else{if($carrera == "All"){//solo tomar carrera
						$consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE no_cuenta='$no_cuenta' AND gradogrupo='$grado'");
					}else{if($grado == "All"){//solo tomar carrera
						$consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE no_cuenta='$no_cuenta' AND carrera='$carrera'");
					}else{//TODOS
						$consulta = mysqli_query($conex,"SELECT * FROM Alumno WHERE no_cuenta='$no_cuenta' AND carrera='$carrera' AND gradogrupo='$grado'");
					}

					}
	 
				    }
			}

			if(mysqli_num_rows($consulta)>0){
				while($rows = mysqli_fetch_array($consulta)){
					echo '<tr>';
					echo '<td>'.$rows['id_tarjeta'].'</td>';
					echo '<td>'.$rows['no_cuenta'].'</td>';
					echo '<td>'.$rows['nombre'].' '.$rows['apellidos'].'</td>';
					echo '<td><button id="edit-button" onclick="viewUpdateRegister(\''.$rows['id_tarjeta'].'\',\''.$rows['no_cuenta'].'\',\''.$rows['nombre'].' '.$rows['apellidos'].'\','.$rows['carrera'].','.$rows['gradogrupo'].','.$rows['id'].')" >Editar</button></td>';
					echo '<td><button onclick="editAlumnos(2,'.$rows['id'].')" id="delete-button" >Eliminar</button></td>';
					echo '</tr>';
				}
			}else{
				echo "No se encontró ningún resultado";
			}

			break;
		case 1: //Edit

			$nombre = $_GET['nombre'];
			$no_cuenta = $_GET['nocuenta'];
			$carrera = $_GET['carrera'];
			$gradoG = $_GET['grupo'];
			$id = $_GET['id'];

			$conex->query("UPDATE Alumno set no_cuenta='$no_cuenta',nombre='$nombre',carrera='$carrera',gradogrupo='$gradoG' where id='$id'"); 
			
			break;
		case 2: //Delete
			$id = $_GET['id'];
			$conex->query("DELETE FROM Alumno where id='$id'");
			break;
		default: //Uknow
			
			break;
	}

}



?>
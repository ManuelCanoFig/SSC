<?php
include 'conecDB.php';

$carreras = mysqli_query($conex,"SELECT * FROM carreras");
$grupos = mysqli_query($conex,"SELECT * FROM gradogrupo");
    echo '<p>Carrera:</p>';
    echo '<select id="carrerasS" >';
while ($row=mysqli_fetch_array($carreras)) {
	echo '<option value="'.$row['id_carrera'].'" >'.$row['carrera'].'</option>';
}
	echo '</select>';
    echo '<p>Grado/Grupo:</p>';
    echo '<select id="gradosS" >';
while($rows = mysqli_fetch_array($grupos)){
	echo '<option value="'.$rows['id'].'" >'.$rows['grado/grupo'].'</option>';
}
	echo '</select>';
?>
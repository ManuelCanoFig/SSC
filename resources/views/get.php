<?php
//codigo para recibir los valores de la targeta
include '../public/php/conecDB.php';

if(isset($_GET['id'])){
	$conex->query("DELETE FROM Conexion");
	$idtarjeta = $_GET['id'];
	mysqli_query($conex,"INSERT INTO Conexion set id_tarjeta='$idtarjeta'");
}

?>
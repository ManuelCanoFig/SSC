<?php 
include 'conecDB.php';
$idAlumno = $_GET['id'];
$horas = $_GET['horas'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];

mysqli_query($conex,"INSERT INTO historial set id_alumno='$idAlumno', c_horas='$horas', fecha='$fecha',hora='$hora'");



?>
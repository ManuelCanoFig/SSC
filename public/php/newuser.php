<?php
include 'conecDB.php';
$alumno = $_GET['alumno'];
$id = $_GET['id'];
$nocuenta = $_GET['nocuenta'];
$carrera = $_GET['carrera'];
$grupo = $_GET['grupo'];

//Procedemos a intentar insertar los datos en la Base de datos
mysqli_query($conex,"INSERT INTO Alumno set id_tarjeta='$id', no_cuenta='$nocuenta', nombre='$alumno',carrera='$carrera',gradogrupo='$grupo'");
echo '<script>alert("Datos inserados")</script>';
echo '<p>Datos insertados con exito</p>';
?>
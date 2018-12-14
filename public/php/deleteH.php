<?php 
include 'conecDB.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$conex->query("DELETE FROM historial where id='$id'");
}
?>
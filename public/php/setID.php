<?php
include 'conecDB.php';

 $getid = mysqli_query($conex,"SELECT * FROM Conexion");
  if(mysqli_num_rows($getid)>0){
  	 $row = mysqli_fetch_array($getid);
  	 $id_tarjeta = $row['id_tarjeta'];
  	 echo '<p>Id de Tarjeta:</p><input type="text"  id="idtarjetadate" value="'.$id_tarjeta.'" name="" disabled> ';

  }

 ?>
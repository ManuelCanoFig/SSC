<?php 
$conex = new mysqli("127.0.0.1", "root", "", "SSC");
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

/* cambiar el conjunto de caracteres a utf8 */
if (!$conex->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conex->error);
    exit();
} else {

}
?>
<!DOCTYPE html>
<html>
<head>
	 <title>SSC Administrador</title>
	 <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/> 
    <link rel="stylesheet" type="text/css" href="{{asset('css/icon.css')}}"/>  
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}" ></script> 
    <script type="text/javascript" src="{{asset('js/Chart.js')}}" ></script>
</head>
<body>
<header>
  <nav>
    <ul><img id="img-logo" src="{{asset('img/fie.png')}}"></ul>
    <ul><a href="/" >SSC</a></ul>
    <ul><a href="/SSC" >Modo Administrador</a></ul>
    <ul><img src="{{asset('img/men.png')}}" id="perfil" ></ul>
    <ul><img src="{{asset('img/woman.png')}}" id="perfil" ></ul>
  </nav>
</header>

<section id="main" class="main-pdfs" >
	<article id="bienvenida" >
		<h1>PDF</h1>
	</article>
	<article id="graficas" >
		 <div id="title" >
	      <div id="triangulo1" ></div>
	      <div id="tringulo2" ></div>
	      <p id="titulo" >Generar Reporte en PDF</p>

	      <input type="radio" onchange="pdfType()" name="pdf" value="1">Semanal
	      <input type="radio" onchange="pdfType()" name="pdf" value="2"> Mensual
	      <input type="radio" onchange="pdfType()" name="pdf" value="3"> Anual

	      <input style="display: none;" onchange="pdfChange(1)" type="date" id="date-pdf" value="<?php echo date("Y").'-'.date("m").'-'.date("d"); ?>" name="">

	      <select style="display: none;" id="pdf-meses"  onchange="pdfChange(2);" >
	    	<?php 
	    	$arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	    	for($i = 1;$i <= sizeof($arrayMeses);$i++ ){
	    		if(date("m") == $i){
	    			echo '<option value="'.$i.'" selected>'.$arrayMeses[$i - 1].'</option>';
	    		}else{
	    		echo '<option value="'.$i.'" >'.$arrayMeses[$i - 1].'</option>';
	    		}
	    	}
	    	?>
	    </select>



	    </div>
	    <iframe id="pdf-generate" style="margin-top: 10px;"  src="{{asset('pdf/pdf.php')}}" ></iframe>
	    <style type="text/css">

	    	iframe#pdf-generate{

	    		width: calc(100% + 15px);
	    		max-width: calc(100% + 40px);
	    		max-height: 800px;
	    		border: none;
	    		margin-left: -6px;
	    		height: 550px;
	    	}
	    </style>
	</article>
</section>

<section id="main" class="main-graficas" >
	<article id="bienvenida" >
		<h1>Grafícas</h1>
	</article>
	<article id="graficas" >
		 <div id="title" >
	      <div id="triangulo1" ></div>
	      <div id="tringulo2" ></div>
	      <p id="titulo" >Grafíca Semanal</p>
	    </div><br>
	    <select id="type-grafica-s" onchange="changeGraficas()" >
	    	<option>bar</option>
	    	<option>line</option>
	    	<option>radar</option>
	    </select>
	    <iframe id="iframe-graficas-s" width="100%" height="360px" style="border: none;" src="{{asset('php/graficaS.php?type=bar')}}" ></iframe>
	    <div id="title" >
	      <div id="triangulo1" ></div>
	      <div id="tringulo2" ></div>
	      <p id="titulo" >Grafíca Mensual</p>
	    </div><br>
	    <select id="type-grafica-m" onchange="changeGrafica()" >
	    	<option>bar</option>
	    	<option>line</option>
	    	<option>radar</option>
	    </select>

	    <select id="type-meses"  onchange="changeGrafica()" >
	    	<?php 
	    	$arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	    	for($i = 1;$i <= sizeof($arrayMeses);$i++ ){
	    		if(date("m") == $i){
	    			echo '<option value="'.$i.'" selected>'.$arrayMeses[$i - 1].'</option>';
	    		}else{
	    		echo '<option value="'.$i.'" >'.$arrayMeses[$i - 1].'</option>';
	    		}
	    	}
	    	?>
	    </select>
	    
	    <iframe id="iframe-graficas-m" width="100%" height="360px" style="border: none;" src="{{asset('php/graficasMensuales.php?type=bar')}}" ></iframe>
	</article>
</section>

<section id="main" class="main-alumnos" >
	<article id="bienvenida" >
		<h1>Alumnos (a)</h1>
	</article>
	<article id="graficas" >
		 <div id="title" >
	      <div id="triangulo1" ></div>
	      <div id="tringulo2" ></div>
	      <p id="titulo" >Editor de Alumnos (a)</p>
	    </div>
	</article>
	<br>
	<div id="filtros-part">
		<p>Numero de cuenta</p>
	    <input id="nocuentainput" type="text" style="width: 150px;" name="">
	</div>
	 <div id="filtro-part100">
    <p>Grupo</p>
    <select id="filtro-grupos-A" >
    	<?php
    	$grupos = mysqli_query($conex,"SELECT * FROM gradogrupo");
    	echo '<option>All</option>';
    	while($rows = mysqli_fetch_array($grupos)){
		echo '<option value="'.$rows['id'].'" >'.$rows['grado/grupo'].'</option>';
		}	
    	?>	
    </select>
</div>
	<div id="filtros-part">
    <p>Carrera</p>
    <select id="filtro-carreras-A" >
    	<?php 
    	$carreras = mysqli_query($conex,"SELECT * FROM carreras");
    	echo '<option>All</option>';
    	while ($row=mysqli_fetch_array($carreras)) {
		echo '<option value="'.$row['id_carrera'].'" >'.$row['carrera'].'</option>';
		}
    	?>
    </select>
    </div>
	<br>
	<button id="general-button" onclick="editAlumnos(0,0)" >Buscar</button>
	<br><br>
	<article id="tabla-historial" >
		<table>
		<thead>
			<tr>
				<th>ID de tarjeta</th>
				<th>No. Cuenta</th>
				<th>Alumno</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody id="info-alumnosss" >
			
		</tbody>
		</table>
	</article>
</section>

<section id="main" class="main-historial" >
	<article id="bienvenida" >
		<h1>Historial</h1>
	</article>
	<article id="hystory" >
    <br>
    <div id="title" >
      <div id="triangulo1" ></div>
      <div id="tringulo2" ></div>
      <p id="titulo" >Filtros</p>
    </div>
    <div id="filtros" >
    	<div id="filtros-part">
    <p>Fecha: </p>
    <input type="date" id="filtro-fecha" value="<?php echo date("Y").'-'.date("m").'-'.date("d"); ?>" name="">
        </div>
        <div id="filtro-part100">
    <p>Grupo</p>
    <select id="filtro-grupos" >
    	<?php
    	$grupos = mysqli_query($conex,"SELECT * FROM gradogrupo");
    	echo '<option>All</option>';
    	while($rows = mysqli_fetch_array($grupos)){
		echo '<option value="'.$rows['id'].'" >'.$rows['grado/grupo'].'</option>';
		}	
    	?>	
    </select>
</div>
<div id="filtros-part">
    <p>Carrera</p>
    <select id="filtro-carreras" >
    	<?php 
    	$carreras = mysqli_query($conex,"SELECT * FROM carreras");
    	echo '<option>All</option>';
    	while ($row=mysqli_fetch_array($carreras)) {
		echo '<option value="'.$row['id_carrera'].'" >'.$row['carrera'].'</option>';
		}
    	?>
    </select>
</div>
    </div>
    <br>
    <button id="general-button" onclick="historial()" >Filtrar</button>
    <button id="general-button" onclick="historialall()" >Ver todo</button>
	</article>
	<br>
	<article id="tabla-historial" >
		<table>
		<thead>
			<tr>
				<th>No. Cuenta</th>
				<th>Alumno</th>
				<th>Carrera</th>
				<th>Grupo</th>
				<th>Fecha</th>
				<th>Accion</th>
			</tr>
		</thead>
		<tbody id="tabla-historialb" >
			
		</tbody>
		</table>
	</article>
	<style type="text/css">
	     table thead{
	     	background: #f0f0f0;
	     	border:1px solid #cacaca;
	     	color:#575761;
	     }
	     table thead tr th{
	     	border:1px solid #c5c5c5;
	     }
	     table tbody tr td{
	     	border:1px solid #c5c5c5;
	     }
	     table{
	     	border-collapse: collapse;
	     }


	    div#filtros{
	    	display: table;
	    }
	    div#filtros-part{
	    	width: 200px;
	    	display: table-cell;
	    }
	    div#filtro-part100{
	    	width: 80px;
	    	display: table-cell;
	    }
		article#tabla-historial{
			width: calc(100% + 12px);
			height: 400px;
			background: #fff;
			border: 1px solid #cacaca;
			overflow-y: scroll;
			padding:0px;
			margin-left: -6px;
		}
		button#general-button{
			 cursor: pointer;
			background: #67b6b7;
			border:0px;
			border-radius: 5px;
			color: #fff;
			font-family: 'Oswald', sans-serif;
			font-size: 15px;
			padding:5px;
			width: 80px;
			position: relative;
			border-bottom: 5px solid #4f8b8c;
		}
		button#general-button:hover{
			background: #2ab1b3;
		}
		button#general-button:active{
			border-bottom: 5px solid #2ab1b3;
			top: 2px;
		}
		button#delete-button{
			 cursor: pointer;
			background: #d03f3f;
			border:0px;
			border-radius: 5px;
			color: #fff;
			font-family: 'Oswald', sans-serif;
			font-size: 15px;
			padding:2px;
			width: 60px;
			position: relative;
			border-bottom: 5px solid #a01f1f;
		}
		button#delete-button:hover{
			background: #d02a2a;
		}
		button#delete-button:active{
			border-bottom: 5px solid #d02a2a;
			top: 2px;
		}
		button#edit-button{
			 cursor: pointer;
			background: #408fbd;
			border:0px;
			border-radius: 5px;
			color: #fff;
			font-family: 'Oswald', sans-serif;
			font-size: 15px;
			padding:2px;
			width: 60px;
			position: relative;
			border-bottom: 5px solid #0576b7;
		}
		button#edit-button:hover{
			background: #1f80b8;
		}
		button#edit-button:active{
			border-bottom: 5px solid #408fbd;
			top: 2px;
		}
		button:focus{
			outline:0px;
		}
	</style>
 <br>
</section>
<section id="user" >

	<div id="user-foto" >
		<img id="img-user" src="{{asset('img/administrador.png')}}">
	</div>
	<div id="button-panel" onclick="Btnhistorial()" >
		<img src="{{asset('img/reloj.png')}}" >
		<p>Historial</p>
	</div>
	<div id="button-panel" onclick="Btngraficas()" >
		<img src="{{asset('img/graficas.png')}}" >
		<p>Gráficas</p>
	</div>
	<div id="button-panel" onclick="Btnpdf()" >
		<img src="{{asset('img/pdf.png')}}" >
		<p>PDF</p>
	</div>
	<div id="button-panel" onclick="Btnalumnos()" >
		<img src="{{asset('img/edit.png')}}" >
		<p>Alumnos</p>
	</div>
	

</section>

<!--Estilos-->
<style type="text/css">
	div#button-panel{
     background-color: #272729;
     border:0px;
     height: 53px;
     cursor: pointer;
     border-bottom: 1px solid #101416;
	}
	select{
    padding:3px;
    font-family: 'Oswald', sans-serif;
    font-size: 15px;
  }
	div#button-panel:hover{
		background-color: #4a4a4e;
	}
	div#button-panel p{
		font-size: 18px;
		position: relative;
		top: 14px;
		left: 15px;
	}
	div#button-panel img{
		width: 40px;
		position: relative;
		top: 5px;
		left: 5px;
		float: left;
	}
	input[type="date"]{
    padding: 5px;
    border-radius: 5px;
    border:1px solid #cacaca;
  }
  input[type="text"]{
    padding: 5px;
    border-radius: 5px;
    border:1px solid #cacaca;
  }
	 input[type="button"]#registrob{
    background-color: #4a97b7;
    box-shadow: 0px 3px 0px 0px rgba(2,118,184,1);
    border-radius: 5px;
    color: #fff;
    font-size: 18px;
    position: relative;
    top: 10px;
    left: 150px;
    font-family: 'Oswald', sans-serif;
    border:0px solid #cacaca;
    padding: 5px;
  }
  section#register{

    position: fixed;
  width: 100%;
  font-size: 50px;
  height:100%;
  z-index: 2000;
  background-color: rgba(0,0,0,0.5);
  color: #fff;
  text-align: center;
   }
   section#register article p{
    position: relative;
    text-align: left;
    left: 100px;
   }
   section#register article{
    position: absolute;

    border-radius: 5px;
    border:2px solid #cacaca;
    left: calc(50% - 250px);
    top:calc(50% - 200px);
    width: 500px;
    height: 400px;
    background-color: #fff;
    color: #000;
    font-size: 20px;
    /*overflow-y: scroll;*/ 
    overflow-x: hidden;
   }
   div#closeR{

    color: #fff;
    background-color: #669933;

  }
  span.icon-close-outline{
    position: absolute;
    top: 5px;
    right: 5px;
  }
</style>

<section id="register" >

  <article>

    <div id="closeR" >
      <b>Actualizar información</b> <span onclick="$('#register').hide();" class="icon-close-outline" ></span>
    </div>
    <div id="setidtarjeta" >
     <p>Id de Tarjeta:</p><input id="tarjetaid" type="text" name="" disabled> 
    </div>
    
    <p>Nombre:</p><input type="text" id="alumnodate" name="">
    <p>No. Cuenta:</p><input type="text" id="nocuenta"  name="">
    <div id="precargados" >
    
    </div>
    <br>
    <div id="mensajeregistro" >
      
    </div>
     <div id="buttonupdate">
    	<input onclick="" type="button" id="registrob"   name="1 Hrs" value="no" >
    </div>
    <br><br>
  </article>
</section>
 <script type="text/javascript" src="{{asset('js/historial.js')}}" ></script>
</body>
</html>
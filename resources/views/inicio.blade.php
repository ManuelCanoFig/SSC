<!DOCTYPE html>
<html>
<head>
	<title>SSC</title>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/> 
   <link rel="stylesheet" type="text/css" href="{{asset('css/icon.css')}}"/>  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
   <script type="text/javascript" src="{{asset('js/Chart.js')}}" ></script>
</head>
<body>

<!--Barra superior-->
<header>
  <nav>
    <ul><img id="img-logo" src="{{asset('img/fie.png')}}"></ul>
    <ul><a href="/" >SSC</a></ul>
    <ul><a href="/SSC" >Modo Administrador</a></ul>
    <ul><img src="{{asset('img/men.png')}}" id="perfil" ></ul>
    <ul><img src="{{asset('img/woman.png')}}" id="perfil" ></ul>
  </nav>
</header>
<!-- Acontinuación la informacion de   -->

<section id="main" >
	<article id="bienvenida" >
		<h1>Sistema SSC</h1>
	</article>
	<article id="botones" >
    <br>
    <div id="title" >
      <div id="triangulo1" ></div>
      <div id="tringulo2" ></div>
      <p id="titulo" >Cantidad de horas a usar</p>
    </div>
    
		<input type="button" id="button" onclick="showuser(1)" name="1 Hrs" value="1 Hrs" >
		<input type="button" id="button" onclick="showuser(2)" name="2 Hrs" value="2 Hrs" >
		<input type="button" id="button" onclick="showuser(3)" name="3 Hrs" value="3 Hrs" >
	</article>
 <br>
 <article>
   <div id="title" >
      <div id="triangulo1" ></div>
      <div id="tringulo2" ></div>
      <p id="titulo" >Uso semanal del centro de computo</p>
    </div>
    <article id="graficas" >
    <div id="G2" >
    <iframe id="FrameID" src="{{asset('php/graficaS.php?type=bar')}}"></iframe>
    </div>
    </article>
 </article>
	<article>
   <div id="title" >
      <div id="triangulo1" ></div>
      <div id="tringulo2" ></div>
      <p id="titulo" >Historial del dia</p>
    </div>
   <article id="history" >
    <table>
     <thead>
      <tr>
       <th>Alumno</th>
       <th>Horas/uso</th>
       <th>Fecha</th>
       <th>Hora de entrada</th>
     </tr>
     </thead>
     <tbody id="historialtabla" >
       <tr>
         <td>x</td>
         <td>x</td>
         <td>x</td>
         <td>x</td>
       </tr>
     </tbody>
     </table>
   </article>
  </article>
<!--footer de la app web-->
<div id="idActualDIv" >
   
</div>

<footer>
  <article>
    <b>Desarroladores:</b>
    <p>Ricardo Cervantes Garcia</p>
    <p>Juan Manuel Cano Figueroa</p>
  </article>
  <article>
    <p>Desarroladores:</p>
    <p>Universidad de Colima
Facultad de Ingeneria Electromecánica
© Ingenieria en Sistemas Computacionales</p>
  </article>
  <article>
    <p>Desarroladores:</p>
    <p>Ricardo Cervantes Garcia</p>
  </article>
</footer>	
</section>

<section id="user" >

	<div id="user-foto" >
		<img id="img-user" src="{{asset('img/user_default.jpg')}}">
	</div>
	<div id="user-dates" >
		<p>Nombre:</p>
		<p>Numero de cuenta:</p>
		<p>Carrera:</p>
		<p>Grado:</p>
		<p>Grupo:</p>
	</div>

</section>

<!--Mensajes para el usuario-->
<div id="bienvenido" > 
  <h3>Bienvenido</h3>
</div>
<!-- Registro de nuevo en nuevo usuario -->
<section id="register" >

  <article>

    <div id="closeR" >
      <b>Registro</b> <span onclick="closeRegistroS()" class="icon-close-outline" ></span>
    </div>
    <div id="setidtarjeta" >
     <p>Id de Tarjeta:</p><input type="text" name="" disabled> 
    </div>
    
    <p>Nombre:</p><input type="text" id="alumnodate" name="">
    <p>No. Cuenta:</p><input type="text" id="nocuenta"  name="">
    <div id="precargados" >
    
    </div>
    <br>
    <div id="mensajeregistro" >
      
    </div>
    <input onclick="insertUser()" type="button" id="registrob"   name="1 Hrs" value="Registrar" >
    <br><br>
  </article>

</section>


<style type="text/css">
div#G2{
  
  width: 100%;
}
div#G2 iframe{
  width: 100%;
  height: 300px;
  border:0px;
}
  canvas#chartmensual{
    width: 100%;
    max-width: 100% ;
    max-height: 400px;
  }
  input[type="text"]{
    width: 60%;
    padding: 5px;
    border-radius: 5px;
    border:1px solid #cacaca;
  }
  select{
    padding:5px;
    font-family: 'Oswald', sans-serif;
    font-size: 15px;
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
  div#closeR{

    color: #fff;
    background-color: #669933;

  }
  span.icon-close-outline{
    position: absolute;
    top: 5px;
    right: 5px;
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
  div#bienvenido{
    text-align: center;
    font-size: 50px;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 1000;
    background-color: rgba(0,0,0,0.5);
    color: #fff;

  }
  div#bienvenido h3{
    margin-top: 15%;
  }

</style>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('js/ssc.js')}}" ></script>

</body>
</html>
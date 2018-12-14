var user = false;
//Ocultar botones
carrerasGrupos();
getHistory();
//setTimeout ("carrerasGrupos()", 3000); 
$(document).ready(function () {
     
      $('#botones').hide();
      $('#bienvenido').hide();
      $('#register').hide();

});

function update(){
	
     if(user == false){
     	dataUser();

     }	
    
     console.log(user);

}

function updateUser(){
	user = true;
    $('#botones').show(100);
    $.ajax({
		type: "GET",
		url:"../php/getidtemp.php",
		success:function(r){
			$('#idActualDIv').html(r);	
		}
	});
    
	//setTimeout ("showuser()", 5000); 

}
function getHistory(){

	var d = new Date();
	var mes = parseInt(d.getMonth()) + 1;
    var fecha = d.getFullYear() + "-" + mes + "-" + d.getDate(); 
    var historial = {};
	historial['fecha'] = fecha;

	$.ajax({
		type: "GET",
		url:"../php/gethistorial.php",
		data: historial,
		success:function(r){
			$('#historialtabla').html(r);	

		}

	});
}
function showuser(horas){
	user = false;
	insertuser(horas);
}

function insertuser(horas){
    $('#botones').hide(100);
    $('#bienvenido').show(100);
    setTimeout ("$('#bienvenido').hide();", 1000); 
    
    //codigo AJAX para insertar datos en historial
    $.ajax({
		type: "GET",
		url:"../php/removeall.php",
		success:function(r){
			$('#setidtarjeta').html(r);	
		}
	});
    var d = new Date();
    var mes = parseInt(d.getMonth()) + 1;
    
    var fecha = d.getFullYear() + "-" + mes + "-" + d.getDate(); 
    var horaA= d.getHours() + ":" + d.getMinutes();
    var ids = document.querySelector("#idActual").value;
	var history = {};
	history['id'] = ids;
	history['horas'] = horas;
	history['fecha'] = fecha;
	history['hora'] =  horaA;
    console.log(history);
	$.ajax({
		type: "GET",
		url:"../php/insertHistory.php",
		data: history,
		success:function(r){
			
		}
	});
	setTimeout ("getHistory()", 1000);
	setTimeout ("document.getElementById('FrameID').contentWindow.location.reload(true)", 2000);
}

var d = new Date();
var mes = parseInt(d.getMonth()) + 1;
var fecha = d.getFullYear() + "-" + mes + "-" + d.getDate(); 

if(fecha == "2018-9-15"){
  console.log("¡Viva México!");
}

function setID(){
	$('#register').show(100);
	var info = {};
	info["id"] = "345trwe3" ;

	$.ajax({
		type: "GET",
		url:"../php/setID.php",
		data: info,
		success:function(r){
			$('#setidtarjeta').html(r);	
		}
	});
	console.log("se ejecuto setid");
}

function dataUser(){

	var info = {};
	info["id"] = "345trwe3" ;

	$.ajax({
		type: "GET",
		url:"../php/getprofile.php",
		data: info,
		success:function(r){
			$('#user-dates').html(r);	
		}
	});


}
function carrerasGrupos(){
	var info = {};
	info["x"] = "x" ;

	$.ajax({
		type: "GET",
		url:"../php/getC.php",
		data: info,
		success:function(r){
			$('#precargados').html(r);	
		}
	});
	
}

function insertUser(){
	var name = document.querySelector("#alumnodate").value;
	var nocuenta = document.querySelector("#nocuenta").value;
	var id = document.querySelector("#idtarjetadate").value;
	var carrera = document.querySelector("#carrerasS").value;
	var grupo = document.querySelector("#gradosS").value;

	var info = {};
	info["alumno"] = name ;
	info["id"] = id ;
	info["nocuenta"] = nocuenta ;
	info["carrera"] = carrera ;
	info["grupo"] = grupo ;

	$.ajax({
		type: "GET",
		url:"../php/newuser.php",
		data: info,
		success:function(r){
			$('#mensajeregistro').html(r);	
		}
	});
    closeRegistro();
}

function closeRegistro(){
	$('#register').hide();
	document.querySelector("#alumnodate").value = "";
	document.querySelector("#nocuenta").value = "";
	document.querySelector("#idtarjetadate").value = "";
}

function closeRegistroS(){
	$('#register').hide();
	document.querySelector("#alumnodate").value = "";
	document.querySelector("#nocuenta").value = "";
	document.querySelector("#idtarjetadate").value = "";
	 $.ajax({
		type: "GET",
		url:"../php/removeall.php",
		success:function(r){
			$('#setidtarjeta').html(r);	
		}
	});
}

setInterval("update()", 2000);
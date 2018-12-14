
var allhistory = true;
historial();
carrerasGrupos();

changeGrafica();

function pdfType(){
	 var genderS =  $('input[name="pdf"]:checked').val();
	 var date = document.querySelector("#date-pdf");
	 var mes = document.querySelector("#pdf-meses");
     switch(genderS){
     	case "1":
     	mes.setAttribute("style","display:none;");
     	date.setAttribute("style","display:inline; margin-left: 10px;");
     	pdfChange(1);
     	break;
     	case "2":
     	mes.setAttribute("style","display:inline; margin-left: 10px;");
     	date.setAttribute("style","display:none;");
     	pdfChange(2);
     	break;
     	case "3":
     	mes.setAttribute("style","display:none;");
     	date.setAttribute("style","display:none;");
     	break;
     }
}

function pdfChange(tipo){
	var areaPdf = document.querySelector("#pdf-generate");
	
	switch(tipo){
		case 1://semanal
		var date = document.querySelector("#date-pdf").value;
		//separamos la fecha
		var array = date.split("-", 3);
		areaPdf.setAttribute("src","pdf/pdf.php?type=Sem&mes="+array[1]+"&dia="+array[2]+"&ano="+array[0]);
		break;
		case 2://mensual
		var mes = document.querySelector("#pdf-meses").value;
		areaPdf.setAttribute("src","pdf/pdf.php?type=Men&mes="+mes);
		break;
		case 3://Anual

		break;
	}

}


function changeGrafica(){
	var iframe = document.querySelector("#iframe-graficas-m");
	var type = document.querySelector("#type-grafica-m").value;
	var mes =  document.querySelector("#type-meses").value;

	iframe.setAttribute("src","php/graficasMensuales.php?type="+type+"&mes="+mes+"");
}

function changeGraficas(){
	var iframe = document.querySelector("#iframe-graficas-s");
	var type = document.querySelector("#type-grafica-s").value;

	iframe.setAttribute("src","php/graficaS.php?type="+type+"");
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

function historial() {
	
	if(allhistory){
		$.ajax({
		type: "GET",
		url:"../php/historial.php",
		success:function(r){
			$('#tabla-historialb').html(r);	
		}
	    });

	    allhistory = false;
	}else{

		var info = {};
	    info["noall"] = "true" ;
	    info["fecha"] = document.querySelector("#filtro-fecha").value ;
	    info["carrera"] = document.querySelector("#filtro-carreras").value ;
	    info["gradog"] = document.querySelector("#filtro-grupos").value ;
	    console.log(info["fecha"]);
	    console.log(info["carrera"]);
	    console.log(info["gradog"]);
		$.ajax({
		type: "GET",
		url:"../php/historial.php",
		data: info,
		success:function(r){
			$('#tabla-historialb').html(r);	
		}
	    });
	}
}

function DeleteH(id){
	var r = confirm("Seguro(a) que deseas borrar el registro");
		if (r == true) {
		    var info = {};
			    info["id"] = id ;
				$.ajax({
				type: "GET",
				url:"../php/deleteH.php",
				data: info,
				success:function(r){
					historial();	
				}
			    });
		} else {
		    txt = "You pressed Cancel!";
		}
 	
}

function editAlumnos(Accion,id){
	var grado = document.querySelector("#filtro-grupos-A").value;
	var carrera = document.querySelector("#filtro-carreras-A").value;
	var no_cuenta = document.querySelector("#nocuentainput").value;
	switch(Accion){
		case 0:
		
		 var info = {};
			    info["nocuenta"] = no_cuenta ;
			    info["carrera"] = carrera ;
			    info["grado"] = grado ;
			    info["accion"] = 0;

				$.ajax({
				type: "GET",
				url:"../php/getandeditAlumnos.php",
				data: info,
				success:function(r){
					$('#info-alumnosss').html(r);	
				}
			    });
		break;
		case 1:
		//informacion a actualizar
		var datos = {}
		datos["nombre"] = document.querySelector("#alumnodate").value;
		datos["nocuenta"] = document.querySelector("#nocuenta").value;
		datos["carrera"] = parseInt(document.querySelector("#carrerasS").value);
		datos["grupo"] = parseInt(document.querySelector("#gradosS").value);
		datos["id"] = id;
		datos["accion"] = 1;

		console.log(datos);
   
		$.ajax({
				type: "GET",
				url:"../php/getandeditAlumnos.php",
				data: datos,
				success:function(r){
					
					$('#register').hide();
					editAlumnos(0,0);	
				}
			    });


		break;
		case 2:
		var r = confirm("Seguro(a) que deseas borrar el registro");
		if (r == true) {
			var info = {};
			    info["id"] = id ;
			    info["accion"] = 2;

				$.ajax({
				type: "GET",
				url:"../php/getandeditAlumnos.php",
				data: info,
				success:function(r){
					editAlumnos(0,0);	
				}
			    });
			}
		break;
		default:
		break;
	}

}

function viewUpdateRegister(idT,noC,nombre,carrera,grupo,idA){
	$('#register').slideDown(50);
	document.querySelector("#tarjetaid").value = idT;
	document.querySelector("#nocuenta").value = noC;
	document.querySelector("#alumnodate").value = nombre;
	document.querySelector("#carrerasS").value = carrera;
	document.querySelector("#gradosS").value = grupo;

	var boton = document.querySelector("#buttonupdate");
	document.querySelector("#buttonupdate").innerHTML = "";

	var input = document.createElement("input");
	input.setAttribute("id","registrob"); type="button"
	input.setAttribute("type","button");
	input.setAttribute("value","Actualizar");
	input.setAttribute("onclick","editAlumnos(1," + idA + ")");
	boton.appendChild(input);

}

function historialall(){
	allhistory = true;
	historial();
}

//Control del menu derecho
inicial();
function inicial(){
	$('.main-pdfs').hide();
	$('.main-graficas').hide();
	$('.main-alumnos').hide();
	$('#register').hide();

}
function Btnhistorial(){
	$('.main-graficas').hide();
	$('.main-alumnos').hide();
	$('.main-pdfs').hide();
	$('.main-historial').slideDown(50);
}
function Btngraficas(){
	$('.main-alumnos').hide();
	$('.main-pdfs').hide();
	$('.main-historial').hide();
	$('.main-graficas').slideDown(50);
}
function Btnpdf(){
	$('.main-graficas').hide();
	$('.main-historial').hide();
	$('.main-alumnos').hide();
	$('.main-pdfs').slideDown(50);
}
function Btnalumnos(){
	$('.main-graficas').hide();
	$('.main-historial').hide();
	$('.main-pdfs').hide();
	$('.main-alumnos').slideDown(50);
}
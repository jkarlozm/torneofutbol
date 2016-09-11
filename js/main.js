$(document).ready(mostrarJornada());
function mostrarJornada(){
	$.ajax({
		type: "POST",
		url: "librerias/libjornada.php",
		data: {type: 1},
		success: function(response){
			$("#jornada").html(response);
		}
	})
};

$(function seleccionaJorndas(){
	$.ajax({
		type: "POST",
		url: "librerias/libjornada.php",
		data: {type: 2},
		success: function(response){			
			$("#elijeJor").html(response);
		}
	})
});

/*Muetra calendario segun jornada seleccionada*/
$("#elijeJor").change(function(){	
	if($("#elijeJor").val() != 0){
		$.ajax({
			type: "POST",
			url: "librerias/libjornada.php",
			data: {"ej": $("#elijeJor").val(), type: 3},
			success: function(response){
				$("#jornada").html(response);
			}
		})
	}
	else{
		mostrarJornada();
	}
});

/* ==========================================================================
   Resultados
   ========================================================================== */
$(function(){
	$.ajax({
		type: 'POST',
		url: 'librerias/libresultados.php',
		data: {type: 1},
		success: function(response){
			$("#resultados").html(response);
		}
	})
});

/* ==========================================================================
   Muestra equipos en el select
   ========================================================================== */
$(muestraJornada());

function muestraJornada(){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 10},
		success: function(response){
			//alert(response);
			$("#idJornada").html(response);
		}
	})
}

$("#idJornada").change(function(){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 1, idj: $("#idJornada").val()},
		success: function(response){
			//alert(response);
			$("#equipoLocal").html(response);
			//$("#equipoVisitante").html(response);
		}
	})
});

/*Equipo Local*/
$("#equipoLocal").change(function(){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		dataType: 'json',
		data: {type: 2, equipo: $("#equipoLocal").val()},		
		success: function(response){
			//console.log(response);
			$("#equipoVisitante2").val(response.ev);
			$("#equipoVisitante").val(response.id);
			$("#jtaLocal").html(response.jl);
			$("#jtrLocal").html(response.jl);
			$("#jgLocal").html(response.jl);
			muestraJugadoresVisitantes();
		}
	})
});

$("#jtrLocal").change(function(){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 3, jtrl: $("#jtrLocal").val(), ide: $("#equipoLocal").val(), idj: $("#idJornada").val()},
		success: function(response){
			//alert(response);
			if(response == 1){
				muestraJugadortrl($("#idJornada").val(), $("#equipoLocal").val());
			}
			if (response == 3){
				$("#alertamtr").html("El jugador ya resivio una tarjeta roja");
			}
		}
	})
});

function muestraJugadortrl(parametroA, parametroB){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 4, idj: parametroA, ide: parametroB},
		success: function(response){
			$("#jtrl").html(response);
		}
	})
};

function eliminarjtr(paramatroC){
	//console.log(paramatroC);
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 14, idjtr : paramatroC},
		success: function(response){
			if (response == 1) {
				muestraJugadortrl($("#idJornada").val(), $("#equipoLocal").val());
				$("#alertamtr").html("Registro Eliminado");
			}
			
			if(response == 2){
				$("#alertamtr").html("¡Error! al eliminar el registro");				
			}
		}
	})
};

$("#jtaLocal").change(function(){
	if($("#ntal").val().length > 0 ){
		if(($("#ntal").val() > 2) || ($("#ntal").val() < 1)){
			$("#alertam").html("Ingresa 1 o 2 en el campo # tarjetas");
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'librerias/librestpart.php',
				data: {type: 5, jtal: $("#jtaLocal").val(), ntal: $("#ntal").val(), ide: $("#equipoLocal").val(), idj: $("#idJornada").val()},
				success: function(response){
					//alert(response);
					if (response == 1) {
						muestraJugadortal($("#idJornada").val(), $("#equipoLocal").val());
						$("#ntal").val("");
						$("#jtaLocal option[value='0']").attr("selected", "selected");
					}
				}
			})			
		}
	}
	else{
		$("#alertam").html("El campo de # tarjetas esta vacio");
		$("#jtaLocal option[value='0']").attr("selected", "selected");
	}
});

function muestraJugadortal(parametroA, parametroB){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 6, idj: parametroA, ide: parametroB},
		success: function(response){
			$("#jtal").html(response);			
		}
	})
};

function eliminarjta(paramatroC){
	//console.log(paramatroC);
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 13, idjta : paramatroC},
		success: function(response){
			if (response == 1) {
				muestraJugadortal($("#idJornada").val(), $("#equipoLocal").val());
				$("#alertam").html("Registro Eliminado");
			}
			
			if(response == 2){
				$("#alertam").html("¡Error! al eliminar el registro");				
			}
		}
	})
};

$("#jgLocal").change(function(){
	if(($("#golesLocal").val().length == 0) || ($("#gml").val().length == 0)){
		$("#alertamg").html("Debe de llenar ambos campos");
	}
	else{
		if($("#golesLocal").val() > 2 || $("#golesLocal").val() < 1){
			$("#alertamg").html("El campo goles solo recive valores del 1 - 2");
		}
		else{
			if($("#gml").val() > 95 || $("#gml").val() < 1){
				$("#alertamg").html("El campo min solo recive valores del 1-95");				
			}
			else{
				$.ajax({
					type: 'POST',
					url: 'librerias/librestpart.php',
					data: {type: 7, jgl: $("#jgLocal").val(), gcl: $("#golesLocal").val(), gml: $("#gml").val(), ide: $("#equipoLocal").val(), idj: $("#idJornada").val()},
					success: function(response){
						//alert(response);
						if (response == 1) {
							muestraJugadorgl($("#idJornada").val(), $("#equipoLocal").val());
							$("#golesLocal").val(" ");
							$("#gml").val(" ");
						}
					}
				})
			}			
		}		
	}	
});

function muestraJugadorgl(parametroA, parametroB){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 8, idj: parametroA, ide: parametroB},
		success: function(response){
			$("#jgl").html(response);
		}
	})
};

function eliminarJg(paramatroC){
	//console.log(paramatroC);
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 12, idg: paramatroC},
		success: function(response){
			if (response == 1) {
				$("#alertamg").html("Registro eliminado");
				muestraJugadorgl($("#idJornada").val(), $("#equipoLocal").val());
			}
			if (response == 2) {
				$("#alertamg").html("¡Error! al eliminar el registro");
			}
		}
	})
}

/*Equipo Visitante*/
function muestraJugadoresVisitantes(){
	if($("#equipoVisitante").val() > 0){		
		$.ajax({
			type: 'POST',
			url: 'librerias/librestpart.php',
			data: {type: 11, eqvj: $("#equipoVisitante").val()},
			success: function(response){
				//console.log(response);
				$("#jtaVisitante").html(response);
				$("#jtrVisitante").html(response);
				$("#jgVisitante").html(response);
			}
		})
	}
	else{
		$("#jtaVisitante").html("");
		$("#jtrVisitante").html("");
		$("#jgVisitante").html("");
	}
};

$("#jtrVisitante").change(function(){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 3, jtrl: $("#jtrVisitante").val(), ide: $("#equipoVisitante").val(), idj: $("#idJornada").val()},
		success: function(response){
			//alert(response);
			if(response == 1){
				muestraJugadortrv($("#idJornada").val(), $("#equipoVisitante").val());
			}
			if (response == 3){
				$("#alertamtrv").html("El jugador ya resivio una tarjeta roja");
			}
		}
	})
});

function muestraJugadortrv(parametroA, parametroB){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 4, idj: parametroA, ide: parametroB},
		success: function(response){
			$("#jtrv").html(response);
		}
	})
};

$("#jtaVisitante").change(function(){
	if($("#ntav").val().length > 0 ){
		if(($("#ntav").val() > 2) || ($("#ntav").val() < 1)){
			$("#alertamtav").html("Ingresa 1 o 2 en el campo # tarjetas");
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'librerias/librestpart.php',
				data: {type: 5, jtal: $("#jtaVisitante").val(), ntal: $("#ntav").val(), ide: $("#equipoVisitante").val(), idj: $("#idJornada").val()},
				success: function(response){
					//alert(response);
					if (response == 1) {
						muestraJugadortav($("#idJornada").val(), $("#equipoVisitante").val());
					}
				}
			})
		}
	}
	else{
		console.log("aqui");
		$("#alertamtav").html("El campo de # tarjetas esta vacio");		
	}
});

function muestraJugadortav(parametroA, parametroB){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 6, idj: parametroA, ide: parametroB},
		success: function(response){
			$("#jtav").html(response);
		}
	})
};

$("#jgVisitante").change(function(){
	if(($("#golesVisitante").val().length == 0) || ($("#gmv").val().length == 0)){
		$("#alertamgv").html("Debe de llenar ambos campos");
	}
	else{
		if($("#golesVisitante").val() > 2 || $("#golesVisitante").val() < 1){
			$("#alertamgv").html("El campo goles solo recive valores del 1 - 2");
		}
		else{
			if($("#gmv").val() > 95 || $("#gmv").val() < 1){
				$("#alertamgv").html("El campo min solo recive valores del 1-95");				
			}
			else{
				$.ajax({
					type: 'POST',
					url: 'librerias/librestpart.php',
					data: {type: 7, jgl: $("#jgVisitante").val(), gcl: $("#golesVisitante").val(), gml: $("#gmv").val(), ide: $("#equipoVisitante").val(), idj: $("#idJornada").val()},
					success: function(response){
						alert(response);
						if (response == 1) {
							muestraJugadorgv($("#idJornada").val(), $("#equipoVisitante").val());
							$("#golesVisitante").val(" ");
							$("#gmv").val(" ");
						}
					}
				})
			}			
		}		
	}
});

function muestraJugadorgv(parametroA, parametroB){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 8, idj: parametroA, ide: parametroB},
		success: function(response){
			alert(response);
			$("#jgv").html(response);
		}
	})
};

$("#rResultadosp").click(function(){
	$.ajax({
		type: 'POST',
		url: 'librerias/librestpart.php',
		data: {type: 9, idj: $("#idJornada").val(), idel: $("#equipoLocal").val(), idev: $("#equipoVisitante").val(), ml: $("#marcadorLocal").val(), mv: $("#marcadorVisitante").val(), in: $("#insidente").val() },
		success: function(response){

		}
	})
});
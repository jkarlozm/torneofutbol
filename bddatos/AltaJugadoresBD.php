<?php
//validación de sesión
	session_start();
	include_once('../conn.php');

		$empleado_nombre		=	$_POST["nombre_empleado"];
		$apaterno_empleado		=	$_POST["apaterno_empleado"];
		$amaterno_empleado		=	$_POST["amaterno_empleado"];
		$edad_empleado		=	$_POST["edad_empleado"];
		$equipo_empleado		=	$_POST["equipo_empleado"];
		$camiseta_empleado		=	$_POST["camiseta_empleado"];
		$tr_empleado		=	$_POST["tr_empleado2"];
		$ta_empleado		=	$_POST["ta_empleado2"];
		$goles_empleado		=	$_POST["goles_empleado2"];
		$autogoles_empleado		=	$_POST["autogoles_empleado2"];
		$posicion_empleado		=	$_POST["posicion_empleado2"];

		$rSQLjugadorv = mysql_query("select nombreJugador, ap_jugador, am_jugador from jugadores where nombreJugador = '$empleado_nombre' and ap_jugador = '$apaterno_empleado' and am_jugador = '$amaterno_empleado'");
		if(mysql_num_rows($rSQLjugadorv) > 0){
			$_SESSION["alerta"] = "El jugador ".$empleado_nombre." ".$apaterno_empleado." ".$amaterno_empleado."ya esta registrado";
		}
		else{
			if($_FILES['foto_empleado']['type'] == 'image/jpeg' || $_FILES['foto_empleado']['type'] == 'image/png' || $_FILES['foto_empleado']['type'] == 'image/jpg'){
				$imagen = date("H:i:s").$_FILES['foto_empleado']['name'];
				$ruta = "../jugadoresimagenes/".$imagen;

				if(move_uploaded_file($_FILES["foto_empleado"]["tmp_name"], $ruta)){
					if (mysql_query("insert into jugadores values('','$empleado_nombre','$apaterno_empleado','$amaterno_empleado', 1, '$edad_empleado', '$equipo_empleado', '$camiseta_empleado', '$tr_empleado', '$ta_empleado', '$goles_empleado', '$autogoles_empleado', '$posicion_empleado', '$imagen')")) {
						$_SESSION["alerta"] = "Jugador Registrado";
					}
					else{
						$_SESSION["alerta"] = "Error al registar los datos";
					}
				}
				else {
					$_SESSION["alerta"] = "Error al subir la imagen";
				}
			}
			else{
				$_SESSION["alerta"] = "Solo puedes subir archivos en formato JPG, JPEG o PNG";
			}

		}
		
		header('Location:../rjugadores.php');
?> 
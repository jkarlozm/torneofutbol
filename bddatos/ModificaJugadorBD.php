<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$id_empleado			=	$_POST["id_empleado"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$apaterno_empleado		=	$_POST["apaterno_empleado"];
		$amaterno_empleado		=	$_POST["amaterno_empleado"];
		$edad_empleado		=	$_POST["edad_empleado"];
		$equipo_empleado		=	$_POST["equipo_empleado"];
		$camiseta_empleado		=	$_POST["camiseta_empleado"];
		$tr_empleado		=	$_POST["tr_empleado"];
		$ta_empleado		=	$_POST["ta_empleado"];
		$goles_empleado		=	$_POST["goles_empleado"];
		$autogoles_empleado		=	$_POST["autogoles_empleado"];
		$posicion_empleado = $_POST["posicion_empleado"];
		$edo			=	$_POST["estado_empleado"];
		
		if(mysql_query("update jugadores set nombreJugador='$empleado_nombre', ap_jugador='$apaterno_empleado', am_jugador = '$amaterno_empleado', estado = '$edo', edad = '$edad_empleado', idEquipoJugador = '$equipo_empleado', playera='$camiseta_empleado', tarjeta_roja='$tr_empleado', tarjeta_amarilla = '$ta_empleado', goles = '$goles_empleado', autogoles = '$autogoles_empleado', posicionJugador = '$posicion_empleado' where idJugador=$id_empleado"))			
		{			
			$_SESSION["alerta"]="Jugador modificado exitosamente.";
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando el jugador.";
			header("Location: ../modificar_jugadores.php");
			exit();
		}
		
		header('Location:../rjugadores.php');		
?> 
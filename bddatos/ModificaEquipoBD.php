<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$id_empleado			=	$_POST["id_empleado"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$campo = $_POST["campo"];
		$edo			=	$_POST["estado_empleado"];		
		
		if(mysql_query("update equipos set nombreEquipo='$empleado_nombre', idCampoEquipo = '$campo', estado = '$edo' where idEquipo=$id_empleado"))
		{			
			$_SESSION["alerta"]="Equipo modificado exitosamente.";
			header("Location: ../requipo.php");
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando el equipo.";			
		}
		
		header('Location:../requipo.php');		
?> 
<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$id_empleado			=	$_POST["id_empleado"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$latitud		=	$_POST["latitud"];
		$longitud		=	$_POST["longitud"];		
		$edo			=	$_POST["estado_empleado"];
		$direccion = $_POST["direccion"];
		
		if(mysql_query("update campos set nombreCampo='$empleado_nombre', direccionCampo = '$direccion', latitud='$latitud', longitud = '$longitud', estado = '$edo' where idCampo=$id_empleado"))			
		{			
			$_SESSION["alerta"]="Campo modificado exitosamente.";
			header("Location: ../rcampos.php");
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando el campo.";			
		}
		
		
		header('Location:../modificar_campo.php?id='.$id_empleado);
		
?> 
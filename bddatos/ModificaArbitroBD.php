<?php
//validación de sesión
	session_start();
	include_once('../conn.php');

		$id_empleado			=	$_POST["id_empleado"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$apaterno_empleado		=	$_POST["apaterno_empleado"];
		$amaterno_empleado		=	$_POST["amaterno_empleado"];
		$rol_empleado		=	$_POST["rol_empleado"];		
		$edo			=	$_POST["estado_empleado"];

		
		if(mysql_query("update arbitros set nombreArbitro='$empleado_nombre', ap_arbitro='$apaterno_empleado', am_arbitro = '$amaterno_empleado', rol = '$rol_empleado', estado = '$edo' where idArbitro=$id_empleado"))			
		{			
			$_SESSION["alerta"]="Arbitro modificado exitosamente.";
			header('Location:../rarbitros.php');
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando el arbitro.";			
		}
		header('Location:../modificar_arbitro.php?id='.$id_empleado);
?> 
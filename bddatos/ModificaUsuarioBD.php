<?php
//validación de sesión
	session_start();
	include_once('../conn.php');	
		
		$id_empleado			=	$_POST["id_empleado"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$usuario_empleado		=	$_POST["usuario_empleado"];
		$equipo_empleado		=	$_POST["equipo_empleado"];		
		$privilegio_empleado		=	$_POST["privilegio_empleado"];
		
		
		if(mysql_query("update usuarios set nombre='$empleado_nombre', usuario ='$usuario_empleado', equipo = '$equipo_empleado', privilegio = '$privilegio_empleado' where idUsuario= '$id_empleado'"))
		{			
			$_SESSION["alerta"]="Usuario modificado exitosamente.";
			header('Location: ../rusuarios.php');
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando al usuario.";			
		}

		header('Location: ../modificar_usuario.php?id='.$id_empleado);
?> 
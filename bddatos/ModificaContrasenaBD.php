<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		
		$id_empleado			=	$_POST["id_empleado"];
		$contrasena = $_POST["contrasena_empleado"];
		$contrasena2 = $_POST["contrasena_empleado2"];

		$encriptada = md5($contrasena);
		
		if($contrasena == $contrasena2){
			if(mysql_query("update usuarios set contrasena = '$encriptada' where idUsuario = '$id_empleado'")){
				$_SESSION["alerta"] = "La contraseña a sido cambiado correctamente";
				header("Location: ../rusuarios.php");
				exit();
			}
			else{
				$_SESSION["alerta"] = "Error la contraseña no puedo ser actualizada";
			}
		}
		else{
			$_SESSION["alerta"] = "Las contraseñas no son iguales";			
		}
		header("Location: ../modificar_contrasena.php?id=".$id_empleado);
		
?> 
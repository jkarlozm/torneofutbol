<?php
//validación de sesión
	session_start();
	include_once('../conn.php');

		$empleado_nombre		=	$_POST["nombre_empleado"];
		$usuarios = $_POST["usuario_empleado"];
		$equipo = $_POST["equipo_empleado"];
		$contrasena = $_POST["contrasena_empleado"];
		$rcontrasena = $_POST["contrasena_empleado2"];
		$privilegios = $_POST["privilegios_empleados"];

		if($contrasena == $rcontrasena){
			if($privilegios != 0){
				if(mysql_query("INSERT INTO usuarios VALUES ('', '$empleado_nombre', '$usuarios', '$equipo', md5('$contrasena'), '$privilegios')")){
					$_SESSION["alerta"] = "Usuario registrasdo correctamente";
					header("Location: ../rusuarios.php");
					exit();
				}
				else{
					$_SESSION["alerta"] = "Error al registarar al usuario";
				}
			}
			else{
				$_SESSION["alerta"] = "Selecciona un privilegio";
			}			
		}
		else{
			$_SESSION["alerta"] = "Las contraseñas no son iguales";
		}

		header('Location:../form_usuarios.php');
?> 
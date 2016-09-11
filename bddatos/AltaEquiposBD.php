<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
	$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$empleado_nombre		=	$_POST["nombre_empleado"];
		$campo		=	$_POST["campo"];
		
		$rSQLequipov = mysql_query("SELECT nombreEquipo FROM equipos WHERE nombreEquipo = '$empleado_nombre'");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "El equipo ".$empleado_nombre." ya esta registrado";
		}
		else{
			if($_FILES['foto_empleado']['type'] == 'image/jpeg' || $_FILES['foto_empleado']['type'] == 'image/png' || $_FILES['foto_empleado']['type'] == 'image/jpg'){
				$imagen = date("H:i:s").$_FILES['foto_empleado']['name'];
				$ruta = "../equiposimagenes/".$imagen;

				if(move_uploaded_file($_FILES["foto_empleado"]["tmp_name"], $ruta)){
					if (mysql_query("insert into equipos values('','$empleado_nombre', '$imagen', '$campo', '', 1)")) {
						$_SESSION["alerta"] = "Equipo Registrado";
						header('Location: ../requipo.php');
						exit();
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
		
		header('Location:../form_equipos.php');
?> 
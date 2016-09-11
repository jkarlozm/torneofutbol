<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
	$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$empleado_nombre		=	$_POST["nombre_empleado"];
		$apaterno_empleado		=	$_POST["apaterno_empleado"];
		$amaterno_empleado		=	$_POST["amaterno_empleado"];
		$rol_empleado		=	$_POST["rol_empleado"];
		
		$rSQLarbitrov = mysql_query("SELECT nombreArbitro, ap_arbitro, am_arbitro FROM arbitros WHERE nombreArbitro = '$empleado_nombre' AND ap_arbitro = '$apaterno_empleado' AND am_arbitro = '$amaterno_empleado'");
		if(mysql_num_rows($rSQLarbitrov) > 0){
			$_SESSION["alerta"] = "Ya esta registrado el arbitro ".$empleado_nombre." ".$apaterno_empleado." ".$amaterno_empleado;
			header("Location: ../form_arbitros.php");
			exit();
		}
		else{
			if($_FILES['foto_empleado']['type'] == 'image/jpeg' || $_FILES['foto_empleado']['type'] == 'image/png' || $_FILES['foto_empleado']['type'] == 'image/jpg'){
				$imagen = date("H:i:s").$_FILES['foto_empleado']['name'];
				$ruta = "../arbitrosimagenes/".$imagen;

				if(move_uploaded_file($_FILES["foto_empleado"]["tmp_name"], $ruta)){
					if (mysql_query("insert into arbitros values('','$empleado_nombre','$apaterno_empleado','$amaterno_empleado', '$rol_empleado', '$imagen', 1)")) {
						$_SESSION["alerta"] = "Arbitro Registrado";
						header('Location:../rarbitros.php');
						exit();
					}
					else{
						$_SESSION["alerta"] = "Error al registar los datos";
					}
				}
				else {
					$_SESSION["alerta"] = "Error al subir la imagen".$ruta;
				}
			}
			else{
				$_SESSION["alerta"] = "Solo puedes subir archivos en formato JPG, JPEG o PNG";
			}
		}		
		header('Location:../form_arbitros.php');		
?> 
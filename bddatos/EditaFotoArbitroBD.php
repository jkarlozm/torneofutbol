<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$id						=	$_POST["id"];		

		if($_FILES['foto_empleado']['type'] == 'image/jpeg' || $_FILES['foto_empleado']['type'] == 'image/png' || $_FILES['foto_empleado']['type'] == 'image/jpg'){
			$imagen = date("H:i:s").$_FILES['foto_empleado']['name'];
			$ruta = "../arbitrosimagenes/".$imagen;

			if(move_uploaded_file($_FILES["foto_empleado"]["tmp_name"], $ruta)){
				if (mysql_query("update arbitros set fotoArbitro = '$imagen' where idArbitro = $id")) {
					$_SESSION["alerta"] = "Imagen actualizada";
				}
				else{
					$_SESSION["alerta"] = "Error al actualizar la imagen";
				}
			}
			else {
				$_SESSION["alerta"] = "Error al subir la imagen";
			}

		}
		else{
			$_SESSION["alerta"] = "Solo puedes subir archivos en formato JPG, JPEG o PNG";
		}		
		
		header('Location:../edita_fotos_arbitro.php?id='.$id);
		
?> 
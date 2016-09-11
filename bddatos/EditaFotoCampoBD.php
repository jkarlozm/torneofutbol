<?php
//validación de sesión
	session_start();
	include_once('../conn.php');

		$id	=$_POST["id"];		

		if($_FILES['foto_empleado']['type'] == 'image/jpeg' || $_FILES['foto_empleado']['type'] == 'image/png' || $_FILES['foto_empleado']['type'] == 'image/jpg'){
			$imagen = date("H:i:s").$_FILES['foto_empleado']['name'];
			$ruta = "../campoimagenes/".$imagen;

			if(move_uploaded_file($_FILES["foto_empleado"]["tmp_name"], $ruta)){
				if (mysql_query("update campos set fotoCampo = '$imagen' where idCampo	 = $id")) {
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
		
		header('Location:../edita_fotos_campo.php?id='.$id);
		
?> 
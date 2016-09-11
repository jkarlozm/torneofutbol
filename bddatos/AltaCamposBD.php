<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
	$fechaMovimiento = date("Y-m-d");
	$horaMovimiento = date("H:i:s");

	$empleado_nombre		=	$_POST["nombre_empleado"];
	$latitud		=	$_POST["latitud"];
	$longitud		=	$_POST["longitud"];
	$direccion = $_POST["direccion"];
	
	$rSQLCampov = mysql_query("SELECT nombreCampo FROM campos WHERE nombreCampo = '$empleado_nombre'");
	if(mysql_num_rows($rSQLCampov) > 0){
		$_SESSION["alerta"] = "El nombre del campo ".$empleado_nombre." ya existe";
	}
	else{
		if($_FILES['foto_empleado']['type'] == 'image/jpeg' || $_FILES['foto_empleado']['type'] == 'image/png' || $_FILES['foto_empleado']['type'] == 'image/jpg'){
			$imagen = date("H:i:s").$_FILES['foto_empleado']['name'];
			$ruta = "../campoimagenes/".$imagen;

			if(move_uploaded_file($_FILES["foto_empleado"]["tmp_name"], $ruta)){
				if (mysql_query("insert into campos values('','$empleado_nombre', '$direccion','$latitud', '$longitud','$imagen', 1)")) {
					$_SESSION["alerta"] = "Campo Registrado";
					header('Location:../rcampos.php');
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

	header('Location:../form_campos.php');

?> 
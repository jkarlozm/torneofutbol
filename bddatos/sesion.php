<?php
	include_once("../conn.php");
	session_start();
	$user = $_POST["txt_usuario"];
	$pass = md5($_POST["txt_contrasena"]);

	$rSQLsesion = mysql_query("SELECT * FROM usuarios WHERE usuario = '$user' and contrasena = '$pass'");	
	if(mysql_num_rows($rSQLsesion) > 0){
		while ($filasesion = mysql_fetch_array($rSQLsesion)) {
			$_SESSION['nombre'] = $filasesion["nombre"];
			$_SESSION['equipo'] = $filasesion["equipo"];
			$_SESSION['privilegio'] = $filasesion["privilegio"];
		}
		if($_SESSION["privilegio"] == 3){
			header("Location: ../rresultadosp.php");
		}
		else{
			header("Location: ../rjugadores.php");
		}		
	}
	else{
		$_SESSION["alerta"] = "El usuario o contraseña no existen";
		header("Location: ../sesion.php");
	}
?>
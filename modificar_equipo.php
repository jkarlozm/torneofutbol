<?php
	session_start();	
	if (!isset($_SESSION["nombre"])) {
		header("Location: sesion.php");
	}
	include_once('conn.php');
	
	if(!isset($_GET["id"]))
		header("Location: requipo.php");
	else
		$id=$_GET["id"];
	$eamq=mysql_query("select * from equipos where idEquipo=$id");
	if (mysql_num_rows($eamq)>0)
		$eamf=mysql_fetch_assoc($eamq);
	else
		header("Location: requipo.php");	
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/main.css">
        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php include_once("menu.php") ?>


		<!-- slider de fotos -->
		<div id="page">
			<div id="content-other">
				<div class="datagrid">
					<form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaEquipoBD.php" enctype="multipart/form-data">

	                    <span class="section">
							<?php
								if (isset($_SESSION["alerta"])) { ?>
									<label class="alerta"><?php echo $_SESSION["alerta"];?></label>
									<?php unset($_SESSION["alerta"]);
								}
							?>
						</span>

						<div class="item form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Nombre <span class="required">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input id="nombre_empleado" class="form-control col-md-7 col-xs-12"  value="<?php echo $eamf["nombreEquipo"];?>" name="nombre_empleado" required="required" type="text">
	                        </div>
	                    </div>
											
	                    <div class="item form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Campo <span class="required">*</span>
	                        </label>	                        
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                        	<select name="campo" id="campo" class="form-control">
		                        	<option value="0">seleciona un campo</option>
		                        	<?php
		                        		$rSQLcampo = mysql_query("SELECT * FROM campos");
		                        		if(mysql_num_rows($rSQLcampo) > 0){
		                        			while($filacampo = mysql_fetch_array($rSQLcampo)){ ?>
		                        				<option value="<?php echo $filacampo["idCampo"] ?>" <?php if($eamf["idCampoEquipo"] == $filacampo["idCampo"]){ echo "selected"; } ?>>
		                        					<?php echo $filacampo["nombreCampo"] ?>
		                        				</option>
		                        			<?php }
		                        		}
		                        	?>
		                        </select>	                            
	                        </div>
	                    </div>

						<div class="item form-group">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado_empleado">Estado <span class="required">*</span>
		                    </label>
		                    <div class="col-md-6 col-sm-6 col-xs-12">
		                        <select id="estado_empleado" class="form-control col-md-7 col-xs-12" name="estado_empleado">
								<option value='1' <?php if($eamf["estado"]== 1){ echo "selected"; } ?>>Activo</option>
								<option value='2' <?php if($eamf["estado"]== 2){ echo "selected"; } ?>>Inactivo</option>
								</select>
		                    </div>
		                </div>				

						<input type="hidden" value="<?php echo $id ?>" id="id_empleado" name="id_empleado">
		
	                                        
	                    <div class="form-group">
	                        <div class="col-md-6 col-md-offset-3">
	                            <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
	                            <button id="send" type="submit" class="btn btn-danger">Modifica</button>
	                        </div>
	                    </div>
	                </form>	
				</div>
            </div>
        </div>

      	<div id="footer">
		  <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
		</div>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

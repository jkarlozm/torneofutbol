<?php
	session_start();
    if(!isset($_SESSION["nombre"])){
        header("Location: sesion.php");
    }
	include_once('conn.php');
	if(!isset($_GET["id"]))
		header("Location: rcampos.php");
	else
		$id=$_GET["id"];
	$producto_a_modificarq=mysql_query("select * from campos where idCampo=$id");
	if (mysql_num_rows($producto_a_modificarq)>0)
		$aamf=mysql_fetch_assoc($producto_a_modificarq);
	else
		header("Location: rcampos.php");
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

		<!-- Formulario para cambiar la foto del estadio -->
		<div id="page">
			<div id="content-other">	
				<div class="datagrid">
                    <h3 class="text-center text-capitalize">modificar foto del campo</h3>
                    <hr>
					<form method='post' class="form-horizontal form-label-left" novalidate action="bddatos/EditaFotoCampoBD.php" enctype="multipart/form-data">

                        <span class="section">
							<?php
								if (isset($_SESSION["alerta"])) { ?>
									<label class="alerta"><?php echo $_SESSION["alerta"];?></label>
								<?php unset($_SESSION["alerta"]);
								}
							?>
						</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_producto">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="nombre_producto" class="form-control col-md-7 col-xs-12" name="nombre_producto" placeholder="" required="required" type="text" value="<?php echo $aamf['nombreCampo']?>" disabled>
                            </div>
                        </div>

						<input type='hidden' name='id' value='<?php echo $id;?>'>

									
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="foto_empleado" class="form-control col-md-7 col-xs-12"   name="foto_empleado"   type="file">
							</div>
                        </div>	
									
						<?php 
                        	$ruta = "campoimagenes/".$aamf["fotoCampo"];
                        	if (file_exists($ruta)) { ?>
                        		<div class="item form-group">
                            		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="actual">Foto actual <span class="required">*</span>
                            		</label>
	                                <div class="col-md-6 col-sm-6 col-xs-12">
	                                    <img class="img-responsive" src="<?php echo "campoimagenes/".$aamf["fotoCampo"]?>">
									</div>
                        		</div>											
                       		<?php }
							else { ?>
								No hay foto asignada al jugador.
							<?php }
					   	?>
                                    
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
								<div style="display:none" id='input_ft'></div>
                                <button  type="submit"  class="btn btn-success">Actualizar</button>
                            </div>
                        </div>
                    </form>	
				</div>
			</div>
        </div>

      	<!--Pie de pagina-->
      	<div id="footer">
		  <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
		</div>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

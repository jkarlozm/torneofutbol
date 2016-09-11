<?php
	session_start();

    if(!isset($_SESSION["nombre"])){
        header("Location: sesion.php");
    }
	include_once('conn.php');
	
	if(!isset($_GET["id"]))
		header("Location: rjugadores.php");
	else
		$id=$_GET["id"];
	$eamq=mysql_query("select * from jugadores where idJugador=$id");
	if (mysql_num_rows($eamq)>0)
		$eamf=mysql_fetch_assoc($eamq);
	else
		header("Location: rjugadores.php");
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

	    <!-- Formulario Para modificar datos del jugador -->
	    <div id="page">
	        <div id="content-other">
                <h3 id="otro" align="center">Modificar Jugador</h3>
                <hr>

	            <div class="datagrid">                    
		            <form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaJugadorBD.php" enctype="multipart/form-data">
                        <span class="section">
						    <?php
						        if (isset($_SESSION["alerta"])) { ?>
						          <label class="alerta"><?php echo $_SESSION["alerta"];?></label>
						          <?php unset($_SESSION["alerta"]);
						        }
						    ?>
                        </span>

						<div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Nombre(s) <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="nombre_empleado" class="form-control col-md-7 col-xs-12"  value="<?php echo $eamf["nombreJugador"];?>" name="nombre_empleado" required="required" type="text">
                            </div>
                        </div>
										
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Apellido paterno <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="apaterno_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["ap_jugador"];?>" name="apaterno_empleado" placeholder="" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Apellido materno <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="amaterno_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["am_jugador"];?>" name="amaterno_empleado" placeholder="" required="required" type="text">
                            </div>
                        </div>
										
						<div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion_empleado">Edad <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  id="edad_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["edad"];?>" name="edad_empleado" placeholder="" required="required" type="number">
                            </div>
                        </div>
                                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Equipo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="equipo_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["idEquipoJugador"];?>" name="equipo_empleado" placeholder=""  type="number">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Camiseta <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="camiseta_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["playera"];?>" name="camiseta_empleado" placeholder=""  type="number">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Trajetas Rojas <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="tr_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["tarjeta_roja"];?>" name="tr_empleado" placeholder=""  type="number">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Trajeta Amarilla <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="ta_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["tarjeta_amarilla"];?>" name="ta_empleado" placeholder=""  type="number">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Goles <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="goles_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["goles"];?>" name="goles_empleado" placeholder=""  type="number">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Autogoles <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="autogoles_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["autogoles"];?>" name="autogoles_empleado" placeholder=""  type="number">
                            </div>
                        </div>

                        <input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $id ?>">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text_empleado">Posicion <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="posicion_empleado" class="form-control col-md-7 col-xs-12" value="<?php echo $eamf["posicionJugador"];?>" name="posicion_empleado" placeholder=""  type="text">
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
										
                        <div class="ln_solid"></div>
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
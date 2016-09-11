<?php
    session_start();
    include_once('conn.php');
    
    if(!isset($_GET["id"]))
        header("Location: rusuarios.php");
    else
        $id=$_GET["id"];
    $eamq=mysql_query("select * from usuarios where idUsuario=$id");
    if (mysql_num_rows($eamq)>0)
        $eamf=mysql_fetch_assoc($eamq);
    else
        header("Location: rusuarios.php");  
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
                <h3 id="otro" align="center">Modificar Usuario</h3>
                <hr>
			    <div class="datagrid">
				    <form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaUsuarioBD.php" enctype="multipart/form-data">
                        <span class="section">
						    <?php
						        if (isset($_SESSION["alerta"])) { ?>
						            <label class="alerta"><?php echo $_SESSION["alerta"];?></label>
						            <?php unset($_SESSION["alerta"]);
						        } ?>
						</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Nombre Completo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="nombre_empleado" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="nombre_empleado" placeholder="" required="required" type="text" value="<?php echo $eamf["nombre"] ?>">
                            </div>
                        </div>
										
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Usuario <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="usuario_empleado" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="usuario_empleado" placeholder="" required="required" type="text" value="<?php echo $eamf["usuario"] ?>">
                            </div>
                        </div>

                        <input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $id ?>">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Equipo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="equipo_empleado" id="equipo_empleado" class="form-control">
                                    <option value="0">Selecciona un equipo</option>
                                    <?php
                                        $rSQL = mysql_query("SELECT idEquipo, nombreEquipo FROM equipos");
                                        if (mysql_num_rows($rSQL) > 0) {
                                            while($filaEquipo = mysql_fetch_array($rSQL)){ ?>
                                                <option value="<?php echo $filaEquipo["idEquipo"] ?>" <?php if($filaEquipo["idEquipo"] == $eamf["equipo"]){ echo "selected"; } ?>><?php echo $filaEquipo["nombreEquipo"] ?></option>
                                            <?php }
                                        }
                                        else{ ?>
                                            <option value="0">No hay equipos</option>
                                        <?php }
                                    ?>

                                </select>                                
                            </div>
                        </div>                        

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Privilegio <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="privilegio_empleado" id="privilegio_empleado" required="required" class="form-control">
                                    <option value="0">Seleccione una opcion</option>
                                    <option value="1" <?php if($eamf["privilegio"] == 1){ echo "selected"; } ?>>Administrador</option>
                                    <option value="2" <?php if($eamf["privilegio"] == 2){ echo "selected"; } ?>>Usuario</option>
                                    <option value="3" <?php if($eamf["privilegio"] == 3){ echo "selected"; } ?>>Arbitro</option>
                                </select>                                
                            </div>
                        </div>
                                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
                                <button id="send" type="submit" class="btn btn-success">Modificar</button>
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

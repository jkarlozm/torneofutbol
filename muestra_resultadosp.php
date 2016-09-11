<?php
	session_start();
    if(!isset($_SESSION["nombre"])){
        header("Location: sesion.php");
    }
	include_once('conn.php');
	if(!isset($_GET["id"]))
		header("Location: rresultadosp.php");
	else
		$id=$_GET["id"];
	$eamq=mysql_query("select * from resultadoPartido where idResultadosp=$id");
	if (mysql_num_rows($eamq)>0)
		$eamf=mysql_fetch_assoc($eamq);
	else
		header("Location: rresultadosp.php");
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
				<div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-responsive" src="equiposimagenes/<?php echo get_campo("logotipoEquipo", "equipos", "idEquipo", $eamf["equipoLocal"]); ?>" alt="">
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-center text-capitalize"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $eamf["equipoLocal"]) ?></h3>
                            </div>
                            <div class="col-md-2">
                                <h1 class="text-center"><?php echo $eamf["marcadorLocal"] ?></h1>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php
                                $rSQLtarp = mysql_query("SELECT cantidad, numeroJugador FROM tarjetasAmarillas WHERE idEquipo = ".$eamf["equipoLocal"]."  AND jornada = ".$eamf["jornada"]);
                                if(mysql_num_rows($rSQLtarp) > 0){
                                    while ($filatarp = mysql_fetch_array($rSQLtarp)) { ?>
                                        <div class="col-md-2 text-center"><span class="glyphicon glyphicon-file tamarilla"></span></div>
                                        <div class="col-md-2"><?php echo $filatarp["cantidad"] ?></div>
                                        <div class="col-md-8"><?php echo $filatarp["numeroJugador"]." ".get_campo("nombreJugador", "jugadores", "playera", $filatarp["numeroJugador"])." ".get_campo("ap_jugador", "jugadores", "playera", $filatarp["numeroJugador"]) ?></div>
                                    <?php }
                                }
                                else{
                                    echo "No hubo tarjetas amarillas";
                                }                        
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <?php                        
                                $rSQLtrrp = mysql_query("SELECT numeroJugador FROM tarjetasRojas WHERE idEquipo = ".$eamf["equipoLocal"]."  AND jornada = ".$eamf["jornada"]);
                                if(mysql_num_rows($rSQLtrrp) > 0){
                                    while ($filatrrp = mysql_fetch_array($rSQLtrrp)) { ?>
                                        <div class="col-md-2 text-center"><span class="glyphicon glyphicon-file troja"></span></div>
                                        <div class="col-md-8"><?php echo $filatrrp["numeroJugador"]." ".get_campo("nombreJugador", "jugadores", "playera", $filatrrp["numeroJugador"])." ".get_campo("ap_jugador", "jugadores", "playera", $filatrrp["numeroJugador"]) ?></div>
                                    <?php }
                                }
                                else{
                                    echo "No hubo tarjetas amarillas";
                                }                                
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <?php                        
                                $rSQLgrp = mysql_query("SELECT cantidadGoles, numeroJugador, minuto FROM goles WHERE idEquipo = ".$eamf["equipoLocal"]."  AND jornada = ".$eamf["jornada"]);
                                if(mysql_num_rows($rSQLgrp) > 0){
                                    while ($filagrp = mysql_fetch_array($rSQLgrp)) { ?>
                                        <div class="col-md-2 text-center"><span class="fa fa-futbol-o"></span></div>
                                        <div class="col-md-2"><span class="glyphicon glyphicon-time"></span> <?php echo $filagrp["minuto"] ?> </div>                               
                                        <div class="col-md-8"><?php echo $filagrp["numeroJugador"]." ".get_campo("nombreJugador", "jugadores", "playera", $filagrp["numeroJugador"])." ".get_campo("ap_jugador", "jugadores", "playera", $filagrp["numeroJugador"]) ?></div>
                                    <?php }
                                }
                                else{
                                    echo "No hubo tarjetas amarillas";
                                }                                
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-2">
                                <h1 class="text-center"><?php echo $eamf["marcadorVisitante"] ?></h1>
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-center text-capitalize"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $eamf["equipoVisitante"]) ?></h3>
                            </div>
                            <div class="col-md-4">
                                <img class="img-responsive" src="equiposimagenes/<?php echo get_campo("logotipoEquipo", "equipos", "idEquipo", $eamf["equipoVisitante"]); ?>" alt="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php
                                $rSQLtarp = mysql_query("SELECT cantidad, numeroJugador FROM tarjetasAmarillas WHERE idEquipo = ".$eamf["equipoVisitante"]."  AND jornada = ".$eamf["jornada"]);
                                if(mysql_num_rows($rSQLtarp) > 0){
                                    while ($filatarp = mysql_fetch_array($rSQLtarp)) { ?>                          
                                        <div class="col-md-8 text-center"><?php echo $filatarp["numeroJugador"]." ".get_campo("nombreJugador", "jugadores", "playera", $filatarp["numeroJugador"])." ".get_campo("ap_jugador", "jugadores", "playera", $filatarp["numeroJugador"]) ?>
                                        </div>
                                        <div class="col-md-2"><?php echo $filatarp["cantidad"] ?></div>
                                        <div class="col-md-2 text-center"><span class="glyphicon glyphicon-file tamarilla"></span></div>
                                    <?php }
                                }
                                else{
                                    echo "No hubo tarjetas amarillas";
                                }                        
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <?php                        
                                $rSQLtrrp = mysql_query("SELECT numeroJugador FROM tarjetasRojas WHERE idEquipo = ".$eamf["equipoVisitante"]."  AND jornada = ".$eamf["jornada"]);
                                if(mysql_num_rows($rSQLtrrp) > 0){
                                    while ($filatrrp = mysql_fetch_array($rSQLtrrp)) { ?>                                        
                                        <div class="col-md-8 col-md-offset-2 text-center"><?php echo $filatrrp["numeroJugador"]." ".get_campo("nombreJugador", "jugadores", "playera", $filatrrp["numeroJugador"])." ".get_campo("ap_jugador", "jugadores", "playera", $filatrrp["numeroJugador"]) ?>
                                        </div>
                                        <div class="col-md-2 text-center"><span class="glyphicon glyphicon-file troja"></span></div>
                                    <?php }
                                }
                                else{
                                    echo "No hubo tarjetas amarillas";
                                }                                
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <?php                        
                                $rSQLgrp = mysql_query("SELECT cantidadGoles, numeroJugador, minuto FROM goles WHERE idEquipo = ".$eamf["equipoVisitante"]."  AND jornada = ".$eamf["jornada"]);
                                if(mysql_num_rows($rSQLgrp) > 0){
                                    while ($filagrp = mysql_fetch_array($rSQLgrp)) { ?>
                                        <div class="col-md-8 text-center"><?php echo $filagrp["numeroJugador"]." ".get_campo("nombreJugador", "jugadores", "playera", $filagrp["numeroJugador"])." ".get_campo("ap_jugador", "jugadores", "playera", $filagrp["numeroJugador"]) ?>
                                        </div>
                                        <div class="col-md-2"><span class="glyphicon glyphicon-time"></span> <?php echo $filagrp["minuto"] ?> </div>
                                        <div class="col-md-2 text-center"><span class="fa fa-futbol-o"></span></div>
                                    <?php }
                                }
                                else{
                                    echo "No hubo tarjetas amarillas";
                                }                                
                            ?>
                        </div>
                    </div>
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

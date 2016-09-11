<?php
	session_start();
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
        
	<div id="page">        
	    <div id="content-other">
	       <div class="datagrid">
		        <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="thumbnail">
                      <img class="img-thumbnail" src="jugadoresimagenes/<?php echo $eamf['fotoJugador'] ?>" alt="...">
                      <div class="caption">
                        <h3 class="text-center text-capitalize"><?php echo $eamf["nombreJugador"]." ".$eamf["ap_jugador"]." ".$eamf["am_jugador"] ?></h3>
                        <p>
                            <div class="row">
                                <div class="col-md-4 text-center text-capitalize"><strong>Edad:</strong> <br><?php echo $eamf["edad"] ?></div>
                                <div class="col-md-4 text-center text-capitalize"><strong>Camisa:</strong> <br><?php echo $eamf["playera"] ?> </div>
                                <div class="col-md-4 text-center text-capitalize"><strong>Posicion:</strong> <br><?php echo $eamf["posicionJugador"] ?> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <table class="table">
                                    <thead class="text-center">
                                        <th>Tarjetas Rojas</th>
                                        <th>Tarjetas Amarillas</th>
                                        <th>Goles</th>
                                        <th>Autogoles</th>
                                    </thead>
                                    <tbody>
                                        <td class="text-center"><?php echo $eamf["tarjeta_roja"] ?></td>
                                        <td class="text-center"><?php echo $eamf["tarjeta_amarilla"] ?></td>
                                        <td class="text-center"><?php echo $eamf["goles"] ?></td>
                                        <td class="text-center"><?php echo $eamf["autogoles"] ?></td>
                                    </tbody>                                    
                                </table>
                            </div>
                        </p>                        
                      </div>
                    </div>
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

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
	$eamq=mysql_query("select * from campos where idCampo=$id");
	if (mysql_num_rows($eamq)>0)
		$eamf=mysql_fetch_assoc($eamq);
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

        <!--mapa google maps-->
        <script type="text/javascript" src="https://maps.google.com/maps/api/js"></script> 
        <script>
         function mostrarGoogleMaps(x,y)
         {
            //Creamos el punto a partir de las coordenadas:
            var punto = new google.maps.LatLng( x, y);

            //Configuramos las opciones indicando Zoom, punto(el que hemos creado) y tipo de mapa
           
          
            myOptions = {
            zoom: 15, center: punto, mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            //Creamos el mapa e indicamos en qué caja queremos que se muestre
            var map = new google.maps.Map(document.getElementById("mapaMuestra"),  myOptions);

            //Opcionalmente podemos mostrar el marcador en el punto que hemos creado.
            var marker = new google.maps.Marker({
            position:punto,
            map: map,
            title:"Título del mapa"});
          }
        </script>


    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php include_once("menu.php") ?>

		<!-- Muestra datos del campo de juego -->
		<div id="page">
			<div id="content-other">
				<div class="datagrid">
					<div class="row">
                      <div class="col-md-8 col-md-offset-2">
                        <div class="thumbnail">
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-responsive" src="campoimagenes/<?php echo $eamf["fotoCampo"] ?>" alt="<?php echo $eamf["fotoCampo"] ?>">
                                </div>
                                <div class="col-md-6">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <div class="embed-responsive-item" id="mapaMuestra"></div>
                                    </div>
                                    <script>mostrarGoogleMaps(<?php echo $eamf["latitud"];?>,<?php echo $eamf["longitud"];?>);</script>
                                </div>
                            </div>
                          
                          <div class="caption">
                            <h3 class="text-center text-capitalize"><?php echo $eamf["nombreCampo"] ?></h3>
                            <p class="text-center"> <?php echo $eamf["direccionCampo"] ?> </p>                           
                          </div>
                        </div>
                      </div>
                    </div>			
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

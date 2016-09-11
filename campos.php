<?php
	include_once("conn.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="https://developers.google.com/maps/web/"></script>
		<script type="text/javascript" src="https://maps.google.com/maps/api/js"></script> 

	   <script>
	     function mostrarGoogleMaps(x,y,id)
	     {
	        //Creamos el punto a partir de las coordenadas:
	        var punto = new google.maps.LatLng( x, y);

	        //Configuramos las opciones indicando Zoom, punto(el que hemos creado) y tipo de mapa
	       
	      
	        myOptions = {
	        zoom: 15, center: punto, mapTypeId: google.maps.MapTypeId.ROADMAP
	        };

	        //Creamos el mapa e indicamos en qué caja queremos que se muestre
	        var map = new google.maps.Map(document.getElementById("mapaMuestra"+id),  myOptions);

	        //Opcionalmente podemos mostrar el marcador en el punto que hemos creado.
	        var marker = new google.maps.Marker({
	        position:punto,
	        map: map,
	        title:"Título del mapa"});
	      }
	   </script>
		
		<!-- titulo de la pestaña -->
		<title>Liga de Futbol</title>
		<!-- scripots y csss -->
		<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<!-- CUERPO DE LA PAGINA -->
	<body onload="mostrarGoogleMaps()" >
		<!-- div principal de toda la pagina -->

		<?php include_once("menu2.html") ?>

		<!-- slider de fotos -->
		<div id="page">
			<div id="content-other">
				<h3 class="text-center text-capitalize">campos </h3>
				<hr>
				<?php
					$rSQLcampo = mysql_query("SELECT * FROM campos WHERE estado = 1");				
					if (mysql_num_rows($rSQLcampo) > 0) {
						while($filacampo = mysql_fetch_array($rSQLcampo)){ ?>
							<div class="contenidomaps">
								<div class="thumbnail">
									<div class="row">
										<div class="col-md-6">
											<img src="campoimagenes/<?php echo $filacampo["fotoCampo"] ?>" alt="<?php echo $filacampo["fotoCampo"] ?>" class="img-responsive">
										</div>
										<div class="col-md-6">
											<div class="embed-responsive embed-responsive-16by9">
												<div class="embed-responsive-item" id="mapaMuestra<?php echo $filacampo['idCampo'] ?>"></div>
											</div>
											<script>mostrarGoogleMaps(<?php echo $filacampo["latitud"];?>,<?php echo $filacampo["longitud"];?>,<?php echo $filacampo['idCampo']; ?>);</script>
										</div>
									</div>
							      
							      <div class="caption">
							        <h3 class="text-center text-capitalize"><?php echo $filacampo["nombreCampo"] ?></h3>
							        <p class="text-center"><?php echo $filacampo["direccionCampo"] ?></p>
							      </div>
							    </div>
						    </div>
						<?php }
					}
					else{ ?>
						<p class="text-center">No hay campos para mostrar</p>
					<?php }
				?>
			</div>
		</div>

		<!-- pie de pagina -->
		<div id="footer">
			<p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
		</div>
		<!-- FIN DEL PIE -->
	</body>
</html>
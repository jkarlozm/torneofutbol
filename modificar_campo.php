<?php
	session_start();
	include_once('conn.php');

  if(!isset($_SESSION["nombre"])){
    header("Location: sesion.php");
  }
	
	if(!isset($_GET["id"]))
		header("Location: rcampos.php");
	else
		$id=$_GET["id"];
	$eamq=mysql_query("select * from campos where idCampo=$id");
	if (mysql_num_rows($eamq)>0)
		$eamf=mysql_fetch_assoc($eamq);
	else
		header("Location: rcampos.php");

	//Mapa
	// INICIALIZO LAS VARIABLES 
  $latitud = $eamf["latitud"];	    
  $longitud = $eamf["longitud"];
  $zoom= "17";
  $tipo_mapa = "ROADMAP";	    
  $direccion = $eamf["direccionCampo"];

  if (isset($_GET["direccion"])) $direccion=  urldecode ($_GET["direccion"]);
  else $direccion="";

  // LONGITUD Y LATITUD SI ESTAN COMO PARAMETROS LOS COJO
  if (isset($_GET["dir"])) $direccion = $_GET["dir"];
  if (strlen ($direccion) <= 8) $direccion =""; // SI LA DIRECCION ES MENOR QUE 8 NO LA PROCESO

  // LONGITUD Y LATITUD SI ESTAN COMO PARAMETROS LOS COJO
  if (isset($_GET["lon"])) $longitud= $_GET["lon"];
  if (isset($_GET["lat"])) $latitud= $_GET["lat"];

  // ZOOM ENTRE 0 y 19
  if (isset($_GET["zoom"])) $zoom= $_GET["zoom"];
  if (($zoom<=0) || ($zoom>=20)){ $zoom= "17";}

  // TIPO DE MAPA
  if (isset($_GET["tipo"])) $tipo_mapa= strtoupper($_GET["tipo"]);

  // COMPRUEBO QUE EL TIPO ES UNO DE LOS QUE ACEPTA GOOGLE
  if ($tipo_mapa == "SATELLITE") $error=0;
  else
    if ($tipo_mapa == "ROADMAP") $error=0;
    else  
      if ($tipo_mapa == "TERRAIN")$error=0;
      else $tipo_mapa = "HYBRID";		
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

        <!-- API google maps -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>

        <script type="text/javascript">

            // VARIABLES GLOBALES JAVASCRIPT
            var geocoder;
            var marker;
            var latLng;
            var latLng2;
            var map;

            // INICiALIZACION DE MAPA
            function initialize() {
              geocoder = new google.maps.Geocoder();    
              latLng = new google.maps.LatLng(<?echo $latitud;?> ,<?echo $longitud;?>);
              map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom:<?echo $zoom;?>,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.<?echo $tipo_mapa;?>
                });
            // CREACION DEL MARCADOR  
                marker = new google.maps.Marker({
                position: latLng,
                title: 'Arrastra el marcador si quieres moverlo',
                map: map,
                draggable: true
              });
             
            // Escucho el CLICK sobre el mama y si se produce actualizo la posicion del marcador 
                 google.maps.event.addListener(map, 'click', function(event) {
                 updateMarker(event.latLng);
               });
              
              // Inicializo los datos del marcador
              // updateMarkerPosition(latLng);

                  geocodePosition(latLng);
             
              // Permito los eventos drag/drop sobre el marcador
              google.maps.event.addListener(marker, 'dragstart', function() {
                updateMarkerAddress('Arrastrando...');
              });
             
              google.maps.event.addListener(marker, 'drag', function() {
                updateMarkerStatus('Arrastrando...');
                updateMarkerPosition(marker.getPosition());
              });
             
              google.maps.event.addListener(marker, 'dragend', function() {
                updateMarkerStatus('Arrastre finalizado');
                geocodePosition(marker.getPosition());
              });
             
            }

            // Permito la gesti¢n de los eventos DOM
            google.maps.event.addDomListener(window, 'load', initialize);

            // ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
            function geocodePosition(pos) {
              geocoder.geocode({
                latLng: pos
              }, function(responses) {
                if (responses && responses.length > 0) {
                  updateMarkerAddress(responses[0].formatted_address);
                } else {
                  updateMarkerAddress('No puedo encontrar esta direccion.');
                }
              });
            }

            // OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
            function codeLatLon() { 
              str= document.form_mapa.longitud.value+" , "+document.form_mapa.latitud.value;
              latLng2 = new google.maps.LatLng(document.form_mapa.latitud.value ,document.form_mapa.longitud.value);
              marker.setPosition(latLng2);
              map.setCenter(latLng2);
              geocodePosition (latLng2);
              // document.form_mapa.direccion.value = str+" OK";
            }

            // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
            function codeAddress() {
                    var address = document.form_mapa.direccion.value;
                      geocoder.geocode( { 'address': address}, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                         updateMarkerPosition(results[0].geometry.location);
                         marker.setPosition(results[0].geometry.location);
                         map.setCenter(results[0].geometry.location);
                       } else {
                        alert('ERROR : ' + status);
                      }
                    });
                  }

            // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
            function codeAddress2 (address) {
                      
                      geocoder.geocode( { 'address': address}, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                         updateMarkerPosition(results[0].geometry.location);
                         marker.setPosition(results[0].geometry.location);
                         map.setCenter(results[0].geometry.location);
                         document.form_mapa.direccion.value = address;
                       } else {
                        alert('ERROR : ' + status);
                      }
                    });
                  }

            function updateMarkerStatus(str) {
              document.form_mapa.direccion.value = str;
            }

            // RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
            function updateMarkerPosition (latLng) {
              document.form_mapa.longitud.value =latLng.lng();
              document.form_mapa.latitud.value = latLng.lat();
            }

            function updateMarkerAddress(str) {
              document.form_mapa.direccion.value = str;
            }

            // ACTUALIZO LA POSICION DEL MARCADOR
            function updateMarker(location) {
                    marker.setPosition(location);
                    updateMarkerPosition(location);
                    geocodePosition(location);
                  }
        </script>        
    </head>

    <body <? if ($direccion != "") { ?> onload=" codeAddress2('<? echo $direccion; ?>')" <? } ?>>    
      <!--[if lt IE 8]>
          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
      
      <?php include_once("menu.php") ?>

	    <!-- Formulario para modificar el campo de juego -->
	    <div id="page">
	      <div id="content-other">
	        <div class="datagrid">
            <h3 class="text-center text-capitalize">modificar campo</h3>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <form method='post' name="form_mapa" class="form-horizontal form-label-left" action="bddatos/ModificaCampoBD.php" enctype="multipart/form-data">                                        
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
                          <input id="nombre_empleado" class="form-control col-md-7 col-xs-12"  value="<?php echo $eamf["nombreCampo"];?>" name="nombre_empleado" required="required" type="text">
                      </div>
                  </div>                                        
           
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Dirección <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="direccion" class="form-control col-md-7 col-xs-12" value="<?php echo $direccion?>" name="direccion" placeholder="" required="required" type="text"><input type="button" class="btn btn-success" value="Dirección" onclick="codeAddress()">
                    </div>
                  </div>      
                  
                  <div class="item form-group">                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="latitud" class="form-control col-md-7 col-xs-12" value="<?php echo $latitud?>" name="latitud" placeholder="" required="required" type="hidden">
                    </div>
                  </div>

                  <div class="item form-group">                      
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="longtud" class="form-control col-md-7 col-xs-12" value="<?php echo $longitud?>" name="longitud" placeholder="" required="required" type="hidden">
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
              <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                  <div id="mapCanvas" class="embed-responsive-item"></div>
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

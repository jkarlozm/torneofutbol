<?
// ------------------------------------------------------------------------
// *** GRABA ESTE FICHERO CAMBIANDO LA EXTENSION .txt POR .PHP  y LISTO
// ------------------------------------------------------------------------
//
// mapas_marker.php: CALCULO/POSICIONAMIENTO DE UN MARCADOR EN UN MAPA DE GOOGLE
// USA LA V3 DEL API DE GOOGLE 
//
// EL MARCADOR SE PUEDE CAMBIAR DE POSICION DE ALGUNA DE ESTAS FORMAS
//
// 	- Arrastrando el marcador que hay en el mapa
//	- Haciendo click en cualquier parte del mapa
//	- Introduciendo LON/LAT y pulsando al bot¢n IR/GO 
//	- Introduciendo una direcci¢n y pulsando el bot¢n IR/GO
//  
// EL BOTON PROCESAR LLAMA A LA RUTINA mapas_marker_procesa
//
// PARAMETROS DE ENTRADA (E_GET)/
//
// lon:  	LONGITUD DONDE POSICIONAR EL MARCADOR INICALMENTE
// lat:   	LATITUD DONDE POSICIONAR EL MARCADOR INICALMENTE
// zoom:      	ZOOM ( Por defecto 9)
// tipo:        TIPO de mapa: ROADMAP, SATELLITE, HYBRID o TERRAIN  (Defecto HYBRID)
// dir: 	DIRECCION DEL MARCADOR INICiAL CON URL ENCODE(si esta dir entonces lat/ no se tiene en cuenta)
//
// SALIDA ($_POST) AL PULSAR EL BOTON  PROCESA se llama a mapas_maracador_procesa
//  
// POR DEFECTO EL MARCADOR SE POSICIONA EN QUINTO (longitud="-0.49647219999997105", latitud= "41.4235091", Zoom= 17)
//
// AUTOR:      MPS MULT Modif Sept. 2012
// 	   	 
// ------------------------------------------------------------------------

// INICIALIZO LAS VARIABLES 
$latitud= "41.4235091";
$longitud="-0.49647219999997105";
$zoom= "17";
$tipo_mapa = "HYBRID";
$direccion = "";

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

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js">
</script>
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
  //    updateMarkerPosition(latLng);
     
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
<body  <? if ($direccion != "") { ?> onload=" codeAddress2('<? echo $direccion; ?>')" <? } ?> >
 
 

<style type="text/css">
  html { height: 100% }
  body { height: 80%; margin: 10px; padding: 0px }
  #mapCanvas { height: 100% }
</style> 


<div id="formulario">
  <center>
  <p style="border: 1px solid #CCC;background-color: #EEE;color: #999; width:450px; font-family: verdana; font-size:12px"><a href="http://www.telegolf.org"><font color="#006600">
    Powered by www.teleGOLF.org
  </font></a></p>
  
  <form name="form_mapa" method="POST" enctype="multipart/form-data">
       <table>
        <tr>
        <td><p style="font-size: 10px;font-family: verdana;font-weight: bold;">
  	   Dir:&nbsp;<input type="text" name="direccion" id="direccion" value="<?echo $direccion;?>" style="width: 250px;font-size: 10px;font-family: verdana;font-weight: bold;" />
  	   &nbsp;&nbsp;<input type="button" value="Geo->Dir" onclick="codeAddress()">
  	</p>
  	</td>
	<td><p style="font-size: 10px;font-family: verdana;font-weight: bold;">
	    &nbsp;&nbsp;||&nbsp;&nbsp;Lat:&nbsp;<input type="text" name="latitud" value="<?echo $latitud;?>" style="width: 100px;font-size: 10px;font-family: verdana;font-weight: bold;" />	    
	</p>
	</td>
	<td> <p style="font-size: 10px;font-family: verdana;font-weight: bold;">
	   Lon:&nbsp; <input type="text" name="longitud" value="<?echo $longitud;?>" style="width: 100px;font-size: 10px;font-family: verdana;font-weight: bold;" />	
	   &nbsp;&nbsp;<input type="button" value="Geo->LatLon" onclick="codeLatLon()"> 
	</p>
	</td>
	<td>	   
	  &nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="Procesar" onclick = "this.form.action = 'mapas_marcador_procesa.php'" value="Procesar" />	   
	</td>	
	</tr>
     </table> 
     </form>
   </center>       
</div> 
 
<div id="mapCanvas"></div>

</body>
</html>
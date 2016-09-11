<?php
  include_once("conn.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<meta name="keywords" content="" />
  	<meta name="description" content="" />
  	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- titulo de la pestaña -->
  	<title>Liga de Futbol</title>
    <!-- scripots y csss -->
  	<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
  	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  	<script type="text/javascript" src="jquery.slidertron-1.0.js"></script>
  </head>
<!-- CUERPO DE LA PAGINA -->
<body>
<!-- div principal de toda la pagina -->
<div id="wrapper">
	<!-- cabecera de la pagina -->
	<?php include_once("menu2.html") ?>

	<!-- slider de fotos -->
	<div id="page">
		<div id="content-other">
			<h3 id="otro"align="center">Equipos</h3>
      <hr>
			<?php
          $rSQLequipo = mysql_query("SELECT * FROM equipos WHERE estado = 1");
          if(mysql_num_rows($rSQLequipo) > 0){
            while($filaequipo = mysql_fetch_array($rSQLequipo)){ ?>              
              <div class="contenedorEquipo">
                <div class="thumbnail">
                  <figure class="tamano">
                    <img class="img-responsive img-circle" src="equiposimagenes/<?php echo $filaequipo["logotipoEquipo"] ?>" alt="<?php echo $filaequipo["logotipoEquipo"] ?>">
                  </figure>
                  <div class="caption">
                    <h3 class="text-center text-capitalize"><?php echo $filaequipo["nombreEquipo"] ?></h3>
                    <p>
                      <div class="row">
                        <div class="col-md-6 text-capitalize text-center">
                          <strong>campo:</strong> <?php echo get_campo('nombreCampo', 'campos', 'idCampo', $filaequipo["idCampoEquipo"]) ?>
                        </div>
                        <div class="col-md-6 text-capitalize text-center">
                          <strong>Grupo:</strong> <?php echo get_campo('nombreGrupo', 'grupos', 'idGrupo', $filaequipo["idGrupo"]) ?>
                        </div>
                      </div>
                    </p>
                    <p class="text-right"><a href="jugadores.php?id=<?php echo $filaequipo['idEquipo'] ?>" class="btn btn-primary" role="button">Ver</a></p>
                  </div>
                </div>
              </div>
            <?php }
          }
          else{ ?>
            <p class="text-center">No hay equipos para mostrar</p>
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

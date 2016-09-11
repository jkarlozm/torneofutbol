<?php
  session_start();
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
			<h3 id="otro"align="center">Bienvenido</h3>
      <hr>
			<div class="row">
        <span class="section">
          <?php
            if (isset($_SESSION["alerta"])) { ?>
              <label class="alerta"><?php echo $_SESSION["alerta"];?></label>
              <?php unset($_SESSION["alerta"]);
            }
          ?>
        </span>
        <form class="col-md-6 col-md-offset-3" method="POST" action="bddatos/sesion.php">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Usuario" id="txt_usuario" name="txt_usuario">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña" id="txt_contrasena" name="txt_contrasena">
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Ingresar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    <!-- pie de pagina -->
    <div id="footer">
    	<p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
    </div>
    <!-- FIN DEL PIE -->
  </body>
</html>

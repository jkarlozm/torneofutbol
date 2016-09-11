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
	
	<body>
		
		<?php include_once("menu2.html") ?>
		
		<div id="page">
			<div id="content-other">
				<h3 class="text-center text-capitalize">Arbitros</h3>
				<hr>
				<div class="datagrid">
	  				<?php
			          $rSQLarbitros = mysql_query("SELECT * FROM arbitros");
			          if(mysql_num_rows($rSQLarbitros)>0){
			            while ($filajugadores = mysql_fetch_array($rSQLarbitros)) { ?>
			              <div class="jugadorest">
			                <div class="thumbnail">
			                  <img class="img-circle" src="arbitrosimagenes/<?php echo $filajugadores["fotoArbitro"] ?>" alt="...">
			                  <div class="caption">
			                    <h3 class="text-center text-capitalize"><?php echo $filajugadores ["nombreArbitro"]." ".$filajugadores["ap_arbitro"]." ".$filajugadores["am_arbitro"] ?></h3>
			                    <p class="text-center text-center">
			                    	<strong>Rol: </strong> <?php echo $filajugadores["rol"] ?>
			                    </p>                  
			                  </div>
			                </div>
			              </div>
			            <?php }
			          }
			          else{ ?>
			            <p>No hay jugadores en este equipio</p>
			          <?php }
			        ?>    
				</div> 
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

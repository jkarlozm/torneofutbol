<?php
  include_once("conn.php");  

  if(!isset($_GET["id"]))
   header("Location: equipos.php");
  else
   $id=$_GET["id"]; 
?>
<!DOCTYPE html>
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
        <?php
          $rSQLjugadores = mysql_query("SELECT * FROM jugadores WHERE idEquipoJugador = $id AND estado = 1");
          if(mysql_num_rows($rSQLjugadores)>0){
            while ($filajugadores = mysql_fetch_array($rSQLjugadores)) { ?>
              <div class="jugadorest">
                <div class="thumbnail">
                  <img class="img-circle" src="jugadoresimagenes/<?php echo $filajugadores["fotoJugador"] ?>" alt="...">
                  <div class="caption">
                    <h3 class="text-center text-capitalize"><?php echo $filajugadores ["nombreJugador"]." ".$filajugadores["ap_jugador"]." ".$filajugadores["am_jugador"] ?></h3>
                    <p>
                      <div class="row">
                        <div class="col-md-6 text-center text-capitalize"><strong>Camisa: <br></strong> <?php echo $filajugadores["playera"] ?></div>
                        <div class="col-md-6 text-center text-capitalize"><strong>Posicion: <br></strong> <?php echo $filajugadores["posicionJugador"] ?></div>                      
                      </div>                    
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

    
      
    <div id="footer">
      <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
    </div>
  </body>
</html>
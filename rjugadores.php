<?php
	session_start();
	if (!isset($_SESSION['nombre'])) {
		header("Location: sesion.php");
	}
	include_once('conn.php');	
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

        <script>
			function opciones(val)
			{
				var opcion=document.getElementById("opciones"+val).value;
				if(opcion==1)
				{
					window.location= "muestra_jugador.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_jugadores.php?id="+val;
				}
				else if (opcion==3)
				{
					window.location= "d_edita_permisos.php?id="+val;
				}
				else if (opcion==4)
				{
					window.location= "edita_fotos_jugador.php?id="+val;
				}
				//window.location= "d_productos.php?b="+document.getElementById(val).value;		
			}
		</script>        
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        
    	<!--Encabezado y menu-->
		<?php include_once ("menu.php") ?>

		<!-- Tabla contendio Jugadores -->
		<div id="page">
			<div id="content-other">
				<div>					
					<p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>					
					<?php
						if($_SESSION["privilegio"] == 2){ ?>
							<h2 class="text-center text-capitalize"><?php echo  get_campo("nombreEquipo", "equipos", "idEquipo", $_SESSION['equipo']) ?></h2>
							<hr>
						<?php }
					?>
					
				</div>
				<div class="text-right">
					<?php if($_SESSION['privilegio'] == 2) {?>
						<a href="form_jugadores.php" class="btn btn-primary">Agregar jugador</a>
					<?php } ?>
				</div>					
				
				<!--Alertas-->	
				<?php
					if (isset($_SESSION["alerta"]))	{ ?>
						<label class="alerta"><?php echo $_SESSION["alerta"];?></label>
					<?php unset($_SESSION["alerta"]);
					} 
				?>

				<div class="datagrid">
					<table class="table">
		                <thead>
		                    <tr class="headings">                        
		                        <th class="column-title">Foto </th>
		                        <th class="column-title">Nombre </th>
		                        <th class="column-title">Edad </th>
		                        <th class="column-title">Equipo </th>
		                        <th class="column-title">Playera </th>
		                        <th class="column-title">Trajetas Rojas </th>
		                        <th class="column-title">Tarjetas Amarillas </th>
		                        <th class="column-title">Goles </th>
		                        <th class="column-title">Autogoles </th>
		                        <th>Posicion</th>
		                        <th>Acciones</th>		                        
							</tr>
						</thead>
	                    <tbody>
							<?php
								if($_SESSION["privilegio"] == 1){
									$productosq=mysql_query("select * from jugadores");
								}
								else{
									$productosq=mysql_query("select * from jugadores where idEquipoJugador =".$_SESSION['equipo']);
								}								
							
								if(mysql_num_rows($productosq)>0){
									while($productosf=mysql_fetch_assoc($productosq)) {
							?>
	                        			<tr>
	                            			<td class=" ">									
												<?php 
													if (file_exists("jugadoresimagenes/".$productosf['fotoJugador'])==1) { ?>
	                                     				<img width="120px" height="100px" src="<?php echo "jugadoresimagenes/".$productosf['fotoJugador']?>">
													<?php
													}
													else
													{ ?>
			                                             <img class="img-responsive" src="images/0.jpg">
													<?php } ?>
											</td>
	                            			<td class=" ">
	                            				<?php echo $productosf['nombreJugador'];?> <?php echo $productosf['ap_jugador'];?> <?php echo $productosf['am_jugador'];?>
	                            			</td>
	                            			<td><?php echo $productosf['edad'];?></td>
	                            			<td><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $productosf['idEquipoJugador'])?></td>
	                            			<td><?php echo $productosf['playera'];?></td>
	                            			<td><?php echo $productosf['tarjeta_roja'];?></td>
	                            			<td><?php echo $productosf['tarjeta_amarilla'];?></td>
	                            			<td><?php echo $productosf['goles'];?></td>
	                            			<td class=" "><?php echo $productosf['autogoles'];?> </td>
	                            			<td><?php echo $productosf['posicionJugador'];?> </td>
	                            			<td>
												<select onchange="opciones(<?php echo $productosf['idJugador'];?>)" id="opciones<?php echo $productosf['idJugador'];?>" class="form-control">
													<option value="">Selecciona...</option>
													<option value="1">Ver</option>
													<?php														
				                                    	if($_SESSION["privilegio"] == 2){ ?>
				                                    		<option value="2">Modificar</option>
															<!--<option value="3">Edita permisos</option>-->
															<option value="4">Edita foto</option>
				                                    	<?php } ?>													
												</select>
											</td>                               
	                        			</tr>									
								<?php }
								}
								else { ?>
	                                <tr>
										<td colspan="11" class="text-center">No hay jugadores agregados en este equipo.</td>
									</tr>	
								<?php } ?>          
	                    </tbody>
	                </table>
	            </div>
	        </div>
		</div>		

      	<!--Pie Pagina-->
      	<div id="footer">
		  <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
		</div>		

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
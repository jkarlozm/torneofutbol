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
					window.location= "muestra_resultadosp.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_jugadores.php?id="+val;
				}				
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
				</div>
				<div class="text-right">
					<?php if($_SESSION['privilegio'] == 3) {?>
						<a href="form_rresultadosp.php" class="btn btn-primary">Agregar Resultados</a>
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
		                        <th class="text-center text-capitalize">local </th>
		                        <th class="text-center text-capitalize">visitante </th>
		                        <th class="text-center text-capitalize">marcador </th>
		                        <th class="text-center text-capitalize">rojas </th>
		                        <th class="text-center text-capitalize">amarillas </th>
		                        <th class="text-center text-capitalize">incidentes </th>
		                        <th class="text-center text-capitalize">Jornada </th>
		                        <th class="text-center">Acciones</th>		                        
							</tr>
						</thead>
	                    <tbody>
							<?php								
								
								$productosq=mysql_query("select * from resultadoPartido");
							
								if(mysql_num_rows($productosq)>0){
									while($productosf=mysql_fetch_assoc($productosq)) {
							?>
	                        			<tr>
	                            			<td class="text-center">									
												<?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $productosf['equipoLocal']) ?>
											</td>
	                            			<td class="text-center">
	                            				<?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $productosf['equipoVisitante']) ?>
	                            			</td>
	                            			<td class="text-center"><?php echo $productosf['marcadorLocal']." - ".$productosf['marcadorVisitante'] ?></td>
	                            			<td class="text-center"><?php echo $productosf['tarjetaAmarilla'] ?></td>
	                            			<td class="text-center"><?php echo $productosf['tarjetaRoja'];?></td>
	                            			<td class="text-center"><?php echo $productosf['insidente'];?></td>
	                            			<td class="text-center"><?php echo $productosf['jornada'];?></td>
	                            			<td>
												<select onchange="opciones(<?php echo $productosf['idResultadosp'];?>)" id="opciones<?php echo $productosf['idResultadosp'];?>" class="form-control">
													<option value="">Selecciona...</option>
													<option value="1">Ver</option>
			                                    	<option value="2">Modificar</option>													
												</select>
											</td>                               
	                        			</tr>									
								<?php }
								}
								else { ?>
	                                <tr>
										<td colspan="11" class="text-center">No hay resultados publicados aun.</td>
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
<!--bootstrap-->
<link rel="stylesheet" href="css/bootstrap.css">

<!--Font awesome-->
<link rel="stylesheet" href="css/font-awesome.min.css">

<div id="header">
	<div id="logo">
		<div id="header">
			<table>
				<th><img src="images/LU1.png" width="100" height="100"></th>
				<th>	<h1><a href="index.html">Liga de Futbol Ultravision 2016</a></h1>
					<p>Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a></p>
				</th>
			</table>
		</div>
	</div>
</div>
		
<!-- menu de las opciones -->
<div id="menu">
	<ul>
		<?php
			if($_SESSION["privilegio"] == 3 OR $_SESSION["privilegio"] == 1){ ?>
				<li><a href="rresultadosp.php">Resultados partido</a></li>
			<?php }
		?>
		<?php
			if($_SESSION["privilegio"] == 2 OR $_SESSION["privilegio"] == 1){ ?>
				<li><a href="rjugadores.php">Jugadores</a></li>
			<?php }
		?>		
		<?php
			if($_SESSION["privilegio"] == 1){?>
				<li><a href="rcampos.php">Campos</a></li>
				<li><a href="rarbitros.php">Arbitros</a></li>
				<li><a href="requipo.php">Equipos</a></li>
				<li><a href="rusuarios.php">Usuarios</a></li>
			<?php }
		?>
		<li><a href="librerias/csesion.php">Cerrar Sesion</a></li>		
	</ul>
</div>
<!-- fin del menu -->
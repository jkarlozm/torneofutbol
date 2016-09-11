<?php
	
	require_once("../conn.php");

	switch ($_POST["type"]) {
		case 1:
			$rSQLequipo = mysql_query("SELECT equipo_local FROM tb_lf_calendario WHERE jornada = ".$_POST["idj"]);
			if (mysql_num_rows($rSQLequipo) > 0) { ?>
				<option value="0">Selecciona un equipo</option>
				<?php while($filaEquipo = mysql_fetch_array($rSQLequipo)){ ?>
					<option value="<?php echo $filaEquipo["equipo_local"] ?>"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $filaEquipo["equipo_local"]) ?></option>
				<?php }
			}
			else{ ?>
				<option value="0">No hay equipos en esta jornada</option>
			<?php }
			break;
		case 2:
			$rSQLevm = mysql_query("SELECT equipo_visitante FROM tb_lf_calendario WHERE equipo_local = ".$_POST["equipo"]);
			if(mysql_num_rows($rSQLevm) > 0){
				while ($filaevm = mysql_fetch_array($rSQLevm)) {
					$idev = $filaevm["equipo_visitante"];
					$equipoVisitante = get_campo("nombreEquipo", "equipos", "idEquipo", $filaevm["equipo_visitante"]);
				}				
			}
			else{
				$idev = 0;
				$equipoVisitante = "No hay equipo Visitante";
			}

			$rSQLjugadores = mysql_query("SELECT playera, nombreJugador, ap_jugador, am_jugador FROM jugadores WHERE idEquipoJugador =".$_POST["equipo"]);
			if(mysql_num_rows($rSQLjugadores) > 0){ 
				$jugadorLocal = "<option value='0'>Elije un jugador</option>";				
				 while ($filaJugadores = mysql_fetch_array($rSQLjugadores)) {
				 	$playera = $filaJugadores["playera"];
				 	$nombre = $filaJugadores["nombreJugador"];
				 	$ap = $filaJugadores["ap_jugador"];
				 	$am = $filaJugadores["am_jugador"];
					$jugadorLocal .= "<option value='$playera'>$nombre $ap $am</option>";
				}
			}
			else{ 
				$jugadorLocal = "<option value='0'>No hay jugadores</option>";
			}			

			$informacion = array('ev' => $equipoVisitante, 'id' => $idev, 'jl' => $jugadorLocal);

			echo json_encode($informacion);

			break;
		case 3:
			if(mysql_num_rows(mysql_query("SELECT numeroJugador FROM tarjetasRojas WHERE numeroJugador = ".$_POST["jtrl"]." AND idEquipo = ".$_POST["ide"]." AND jornada = ".$_POST["idj"])) > 0){
				echo 3;
			}
			else{
				if(mysql_query("INSERT INTO tarjetasRojas VALUES('', '".$_POST["jtrl"]."', '".$_POST["ide"]."', '".$_POST["idj"]."')")){
					echo 1;
				}
				else{
					echo 2;
				}
			}			
			break;
		case 4:
			$jornada = $_POST["idj"];
			$equipo = $_POST["ide"];
			$rSQLmj = mysql_query("SELECT idTarjetaroja, numeroJugador FROM tarjetasRojas WHERE jornada = $jornada AND idEquipo = $equipo");
			if (mysql_num_rows($rSQLmj) > 0) {
				while ($fmjtr = mysql_fetch_array($rSQLmj)) { ?>					
					<div class="col-md-10 text-center"> <?php echo $fmjtr["numeroJugador"]." ".get_campoj("nombrejugador", "jugadores", "playera", $fmjtr["numeroJugador"], "idEquipoJugador", $equipo)." ".get_campoj("ap_jugador", "jugadores", "playera", $fmjtr["numeroJugador"], "idEquipoJugador", $equipo) ?> </div>
					<div class="col-md-2 text-center"> <span class="glyphicon glyphicon-remove-circle" id="<?php echo $fmjtr["idTarjetaroja"] ?>" onclick = "eliminarjtr(this.id)" ></span> </div>					
				<?php }
			}
			break;
		case 5:
			if(mysql_query("INSERT INTO tarjetasAmarillas VALUES ('', '".$_POST["ntal"]."', '".$_POST["jtal"]."', '".$_POST["ide"]."', '".$_POST["idj"]."')")){
				echo 1;
			}
			else{
				echo 2;
			}
			break;
		case 6:
			$jornada = $_POST["idj"];
			$equipo = $_POST["ide"];
			$rSQLmj = mysql_query("SELECT idTarjetaamarilla, cantidad, numeroJugador FROM tarjetasAmarillas WHERE jornada = $jornada AND idEquipo = $equipo");
			if (mysql_num_rows($rSQLmj) > 0) {
				while ($fmjtr = mysql_fetch_array($rSQLmj)) { ?>
					<div class="row">
						<div class="col-md-3 text-center"> <?php echo $fmjtr["cantidad"] ?> </div>					
						<div class="col-md-5 text-center"> <?php echo $fmjtr["numeroJugador"]." ".get_campoj("nombrejugador", "jugadores", "playera", $fmjtr["numeroJugador"], "idEquipoJugador", $equipo)." ".get_campo("ap_jugador", "jugadores", "playera", $fmjtr["numeroJugador"], "idEquipoJugador", $equipo) ?> </div>
						<div class="col-md-4 text-center"> <span class="glyphicon glyphicon-remove-circle" id="<?php echo $fmjtr["idTarjetaamarilla"] ?>" onclick = "eliminarjta(this.id)" ></span> </div>
					</div>
				<?php }
			}
			break;
		case 7:
			if(mysql_query("INSERT INTO goles VALUES ('', '".$_POST["gcl"]."', '".$_POST["jgl"]."', '".$_POST["ide"]."', '".$_POST["gml"]."', '".$_POST["idj"]."')")){
				echo 1;
			}
			else{
				echo 2;
			}
			break;
		case 8:
			$jornada = $_POST["idj"];
			$equipo = $_POST["ide"];
			$rSQLmj = mysql_query("SELECT idGoles, cantidadGoles, numeroJugador, minuto FROM goles WHERE jornada = $jornada AND idEquipo = $equipo");
			if (mysql_num_rows($rSQLmj) > 0) {
				while ($fmjtr = mysql_fetch_array($rSQLmj)) { ?>
					<div class="row">
						<div class="col-md-3 text-center"> <?php echo $fmjtr["cantidadGoles"] ?> </div>
						<div class="col-md-3 text-center"> <?php echo $fmjtr["minuto"] ?> </div>					
						<div class="col-md-4 text-center"> <?php echo $fmjtr["numeroJugador"]." ".get_campoj("nombrejugador", "jugadores", "playera", $fmjtr["numeroJugador"], "idEquipoJugador", $equipo)." ".get_campo("ap_jugador", "jugadores", "playera", $fmjtr["numeroJugador"], "idEquipoJugador", $equipo) ?> </div>
						<div class="col-md-2 text-center"> <span class="glyphicon glyphicon-remove-circle" id="<?php echo $fmjtr["idGoles"] ?>" onclick = "eliminarJg(this.id)" ></span> </div>
					</div>					
				<?php }
			}
			break;
		case 9:
			$tarjetasRojas = mysql_num_rows(mysql_query("SELECT idTarjetaRoja FROM tarjetasRojas WHERE jornada = ".$_POST["idj"]));
			
			$tarjetasAmarillas = mysql_num_rows(mysql_query("SELECT idTarjetaRoja FROM tarjetasAmarillas WHERE jornada =".$_POST["idj"]));

			if(mysql_query("INSERT INTO resultadoPartido VALUES ('', '".$_POST["idel"]."', '".$_POST["idev"]."', '".$_POST["ml"]."', '".$_POST["mv"]."', '$tarjetasAmarillas', '$tarjetasRojas', '".$_POST["in"]."', '".$_POST["idj"]."')")){
				echo 1;
			}
			else{
				echo 2;
			}
			break;
		case 10:
			$rSQLmja = mysql_query("SELECT jornada FROM tb_lf_calendario");
			if(mysql_num_rows($rSQLmja) > 0){ ?>
				<option value="0">Selecciona una jornada</option>
				<?php while($filajma = mysql_fetch_array($rSQLmja)){ ?>
					<option value="<?php echo $filajma["jornada"] ?>">Jornada <?php echo $filajma["jornada"]  ?></option>
				<?php }
			}
			else{ ?>
				<option value="0">No hay jornadas</option>
			<?php }
			break;
		case 11:
			$rSQLjugadores = mysql_query("SELECT playera, nombreJugador, ap_jugador, am_jugador FROM jugadores WHERE idEquipoJugador =".$_POST["eqvj"]);
			if(mysql_num_rows($rSQLjugadores) > 0){ ?>
				<option value='0'>Elije un jugador</option>
				<?php while ($filaJugadores = mysql_fetch_array($rSQLjugadores)) { ?>				 	
					<option value="<?php echo $filaJugadores["playera"] ?>"><?php echo $filaJugadores["playera"].". ".$filaJugadores["nombreJugador"]." ".$filaJugadores["ap_jugador"]." ".$filaJugadores["am_jugador"] ?></option>
				<?php }
			}
			else{ ?>
				<option value="0">No hay jugadores</option>
			<?php }
			break;
		case 12:
			if(mysql_query("DELETE FROM goles WHERE idGoles = ".$_POST["idg"])){
				echo 1;
			}
			else{
				echo 2;
			}
			break;
		case 13:
			if(mysql_query("DELETE FROM tarjetasAmarillas WHERE idTarjetaamarilla = ".$_POST["idjta"])){
				echo 1;
			}
			else{
				echo 2;
			}
			break;
		case 14:
			if(mysql_query("DELETE FROM tarjetasRojas WHERE idTarjetaroja = ".$_POST["idjtr"])){
				echo 1;
			}
			else{
				echo 2;
			}
			break;
	}

?>
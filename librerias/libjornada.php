<?php
	require_once("../conn.php");

	switch ($_POST["type"]) {
		case 1:			
			$rSQLj = mysql_query("SELECT * FROM tb_lf_calendario");
			if(mysql_num_rows($rSQLj) > 0){ 
				while ($fj = mysql_fetch_array($rSQLj)) { ?>
				<tr>
					<td style="align: center;"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $fj["equipo_local"]) ?></td>
					<td style="align: center;"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $fj["equipo_visitante"]) ?></td>
					<td style="align: center;"><?php echo get_campo("nombreCampo", "campos", "idCampo", $fj["campo"]) ?></td>
					<td style="align: center;"><?php echo $fj["fecha"] ?></td>
					<td style="align: center;"><?php echo $fj["hora"] ?></td>
					<td style="align: center;"><?php echo get_campo("jornada", "tb_lf_jornada", "id_jornada", $fj["jornada"]) ?></td>
					<td style="align: center;"><?php echo get_campo("nombreArbitro", "arbitros", "idArbitro", $fj["arbitro"]) ?></td>
				</tr>
			<?php 
				}
			}
			else{ ?>
				<tr>
					<td colspan="7">No hay información</td>
				</tr>
			<?php }
			break;
		case 2:
			$rSQLmj = mysql_query("SELECT * FROM tb_lf_jornada");			
			if(mysql_num_rows($rSQLmj) > 0){ ?> 
				<option value="0">Elija una jornada</option>
				<?php while($fmj = mysql_fetch_array($rSQLmj)){?>
					<option value="<?php echo $fmj["id_jornada"] ?>"><?php echo $fmj["jornada"] ?></option>
			<?php }
			}
			else{ ?>
				<option value="">No hay Jornadas</option>
			<?php }
			break;
		case 3:
			$ej = $_POST["ej"];
			$rSQLj = mysql_query("SELECT * FROM tb_lf_calendario WHERE jornada = $ej");
			if(mysql_num_rows($rSQLj) > 0){ 
				while ($fj = mysql_fetch_array($rSQLj)) { ?>
				<tr>
					<td class="text-center"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $fj["equipo_local"]) ?></td>
					<td class="text-center"><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $fj["equipo_visitante"]) ?></td>
					<td class="text-center"><?php echo get_campo("nombreCampo", "campos", "idCampo", $fj["campo"]) ?></td>
					<td class="text-center"><?php echo $fj["fecha"] ?></td>
					<td class="text-center"><?php echo $fj["hora"] ?></td>
					<td class="text-center"><?php echo get_campo("jornada", "tb_lf_jornada", "id_jornada", $fj["jornada"]) ?></td>
					<td class="text-center"><?php echo get_campo("nombreArbitro", "arbitros", "idArbitro", $fj["arbitro"]) ?></td>
				</tr>
			<?php 
				}
			}
			else{ ?>
				<tr>
					<td colspan="7">No hay información</td>
				</tr>
			<?php }			
			break;
	}
?>
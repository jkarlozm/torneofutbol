<?php
	require_once("../conn.php");

	switch ($_POST["type"]) {
		case 1:
			$rSQLmr = mysql_query("SELECT * FROM tb_lf_resultados ORDER BY pts DESC");
			if(mysql_num_rows($rSQLmr) > 0){
				while($fmr = mysql_fetch_array($rSQLmr)){ ?>
					<tr>
						<td><?php echo get_campo("nombreEquipo", "equipos", "idEquipo", $fmr["equipo"]) ?></td>
						<td><?php echo $fmr["pj"] ?></td>
						<td><?php echo $fmr["g"] ?></td>
						<td><?php echo $fmr["p"] ?></td>
						<td><?php echo $fmr["e"] ?></td>
						<td><?php echo $fmr["gf"] ?></td>
						<td><?php echo $fmr["gc"] ?></td>
						<td><?php echo $fmr["gd"] ?></td>
						<td><?php echo $fmr["pts"] ?></td>
					</tr>
				<?php }
			}
			break;
	}
?>
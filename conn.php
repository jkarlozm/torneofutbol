<?php
$db_host="localhost";
$db_usuario="root";
$db_password="";
$db_nombre="ligaf";

$conexion = @mysql_connect($db_host, $db_usuario, $db_password) or die(mysql_error());
$db = @mysql_select_db($db_nombre, $conexion) or die(mys());

function get_campo($c,$t,$cb,$i) {
	$q=mysql_query("select $c from $t where $cb=$i");
	if(mysql_num_rows($q)==0)
		return "";
	else
	{
		$f=mysql_fetch_assoc($q);
		return $f[$c];
	}
}

function get_campoj($c,$t,$cb,$i,$ce,$e) {
	$q=mysql_query("select $c from $t where $cb=$i and $ce=$e");
	if(mysql_num_rows($q)==0)
		return "";
	else
	{
		$f=mysql_fetch_assoc($q);
		return $f[$c];
	}
}

mysql_query("SET NAMES 'utf8'");
?>

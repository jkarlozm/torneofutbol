<?php
	session_start();
    if (!isset($_SESSION["nombre"])) {
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
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php include_once("menu.php") ?>
	       
        <!-- slider de fotos -->
	    <div id="page">
		    <div id="content-other">
                <h3 class="text-center text-capitalize">alta resultados partidos</h3>
                <hr>
			    <div class="datagrid">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <select name="idJornada" id="idJornada" class="form-control">                                
                            </select>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">                                
                                <select name="equipoLocal" id="equipoLocal" class="form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Marcador" id="marcadorLocal" name="marcadorLocal">
                            </div>
                            <div class="form-group">
                                <label>tarjetas amarillas</label>
                                <div id="alertam"></div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="number" min="1" max="2" maxlength="1" class="form-control" placeholder="# Tarjetas" name="ntal" id="ntal">
                                    </div>
                                    <div class="col-md-7">
                                        <select name="jtaLocal" id="jtaLocal" class="form-control"></select>
                                    </div>
                                </div>
                                <div id="jtal"></div>
                            </div>
                            <div class="form-group">
                                <label>tarjetas rojas</label>
                                <div id="alertamtr"></div>
                                <select name="jtrLocal" id="jtrLocal" class="form-control">
                                </select>
                                <div id="jtrl"></div>
                            </div>
                            <div class="form-group">
                                <label>Goles</label>
                                <div id="alertamg"></div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="number" max="2" min="1" placeholder="Goles" class="form-control" id="golesLocal" name="golesLocal" >
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" max="90" min="1" placeholder="minuto" class="form-control" id="gml" name="gml">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="jgLocal" id="jgLocal" class="form-control">
                                        </select>
                                    </div>                                    
                                </div>
                                <div id="jgl"></div>                         
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="equipoVisitante2" id="equipoVisitante2" class="form-control" readonly="readonly">
                                <input type="hidden" name="equipoVisitante" id="equipoVisitante">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Marcador" id="marcadorVisitante" name="marcadorVisitante">
                            </div>                            
                            <div class="form-group">
                                <label>tarjetas amarillas</label>
                                <div id="alertamtav"></div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="number" max="2" min="1" placeholder="# tarjetas" class="form-control" id="ntav" name="ntav">
                                    </div>
                                    <div class="col-md-7">
                                        <select name="jtaVisitante" id="jtaVisitante" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div id="jtav"></div>                                
                            </div>
                            <div class="form-group">
                                <label>tarjetas rojas</label>
                                <div id="alertamtrv"></div>
                                <select name="jtrVisitante" id="jtrVisitante" class="form-control">
                                </select>
                                <div class="row" id="jtrv"></div>
                            </div>
                            <div class="form-group">
                                <label>goles</label>
                                <div id="alertamgv"></div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" placeholder="Goles" id="golesVisitante" name="golesVisitante" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="munuto" id="gmv" name="gmv" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="jgVisitante" id="jgVisitante" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="jgv"></div>                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <textarea name="insidente" id="insidente" class="form-control" placeholder="Insidentes"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-right">
                            <button type="button" id="rResultadosp" name="rResultadosp" class="btn btn-primary">registrar partido</button>
                        </div>                        
                    </div>
		        </div>
	        </div>
        </div>

      	<div id="footer">
		  <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
		</div>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

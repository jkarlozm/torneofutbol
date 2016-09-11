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
        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
      <!--[if lt IE 8]>
          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->

      <?php include_once("menu2.html") ?>      

      <div id="page">
        <div id="content-other">
          <h3 class="text-center text-capitalize">Calendario</h3>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <select id="elijeJor" class="form-control">
              </select>
            </div>
          </div>              
                                        
          <table class="table">
            <thead>
              <tr>
                <th style="align: center">Equipo local</th>
                <th style="align: center">Equipo visitante</th>
                <th style="align: center">Campo</th>
                <th style="align: center">Fecha</th>
                <th style="align: center">Hora</th>
                <th style="align: center">Jornada</th>
                <th style="align: center">Arbitro</th>
              </tr>
            </thead>
            <tbody id="jornada">
              
            </tbody>
          </table>
        </div>
      </div>

      <div id="footer">
        <p>2016. All rights reserved. Design by <a href="http://detecsa-consultores.com" rel="nofollow">DETECSA</a>.</p>
      </div>              

      <script src="js/vendor/jquery-1.11.2.min.js"></script>
      <script src="js/main.js"></script>
    </body>
</html>

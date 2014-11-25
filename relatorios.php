<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hidrosys</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php   
    	include("header.php");
  	?>

    <div style="min-height: 410px; max-height: 410px; margin: 2% auto auto; width: 500px;">
      <div class="col-xs-4" style="min-height: 410px; max-height: 410px; margin: 2% auto auto; float: left; width: 250px;">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Relatório de funcionários</h3>
          </div>
          <div class="panel-body">
            <form role="form" method="post" action="relfuncionarios.php">
              <div class="form-group">
                <label>Ano:</label>
                <input type="text" class="form-control" name="ano" placeholder="Ano" required>
              </div>
              <div class="form-group">
                <label>Mês:</label>
                <input type="text" class="form-control" name="mes" placeholder="Mês" required>
              </div>
              <button type="submit" class="btn btn-primary">Consulta</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xs-4" style="min-height: 410px; max-height: 410px; margin: 2% auto auto; float: right; width: 250px;">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Relatório de serviços</h3>
          </div>
          <div class="panel-body">
            <form role="form" method="post" action="relservicos.php">
              <div class="form-group">
                <label>Ano:</label>
                <input type="text" class="form-control" name="ano" placeholder="Ano" required>
              </div>
              <button type="submit" class="btn btn-primary">Consulta</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
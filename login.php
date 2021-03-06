<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Hidrosys</title>

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
      include("seguranca.php");
      if(isset($_GET["logoff"]) == true)
      {
        if($_GET["logoff"] == true)
        {
          encerraSessao();
        }
      }
    ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">

          <div class="col-xs-2"><h3>HIDROSYS</h3></div>
        </div>
      </div>
    </div>

    <div class="col-xs-4" style="margin: 8% auto auto; float: none; width: 440px;">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Efetuar login</h3>
        </div>
        <div class="panel-body">
          
          <form role="form" method="post" action="requisicao.php">
            <div class="form-group">
              <label>Login</label>
              <input type="login" class="form-control" name="login" placeholder="Login" required>
            </div>
            <div class="form-group">
              <label>Senha</label>
              <input type="password" class="form-control" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
          </form>

        </div>
      </div>    
    </div>

    <?php
      if(isset($_GET["loginerro"]) && $_GET["loginerro"] == true)
        echo '<div class="alert alert-danger" role="alert" style="margin-left: auto; margin-right: auto; float: none; width: 420px;">O login e/ou senha estão incorretos</div>';
      if(isset($_GET["sessaoEncerrada"]) && $_GET["sessaoEncerrada"] == true)
        echo '<div class="alert alert-warning" role="alert" style="margin-left: auto; margin-right: auto; float: none; width: 420px;">Sessão encerrada!</div>';
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
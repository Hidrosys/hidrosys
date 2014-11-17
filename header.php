<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hidrosys</title> -->

    <!-- Bootstrap
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

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
      verificaSessao();
    ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row-fluid">

          <div class="col-xs-2"><h3>HIDROSYS</h3></div>

          <div class="col-xs-8" style="padding-top:12px">
            <ul class="nav nav-pills">
              <?php 
              $from = basename($_SERVER['REQUEST_URI'], ".php");
              $from = strtok($from, '.');
              echo
              '<li '. 
                ($from=="index"? 'class="active"><a href="#">Principal</a></li>': '><a href="index.php">Principal</a></li>').
              '<li '. 
                ($from=="clientes"? 'class="active"><a href="#">Clientes</a></li>': '><a href="clientes.php">Clientes</a></li>').
              '<li '.
                ($from=="servicos"? 'class="active"><a href="#">Serviços</a></li>': '><a href="#">Serviços</a></li>').
              '<li '. 
                ($from=="funcionarios"? 'class="active"><a href="#">Funcionários</a></li>': '><a href="funcionarios.php">Funcionários</a></li>').
              '<li '. 
                ($from=="ferramentas"? 'class="active"><a href="#">Ferramentas</a></li>': '><a href="#">Ferramentas</a></li>').
              '<li '.
                ($from=="pecas"? 'class="active"><a href="#">Peças</a></li>': '><a href="#">Peças</a></li>').
              '<li '.
                ($from=="relatorios"? 'class="active"><a href="#">Relatórios</a></li>': '><a href="#">Relatórios</a></li>').
              '<li '.
                ($from=="usuarios"? 'class="active"><a href="#">Usuários</a></li>': '><a href="usuarios.php">Usuários</a></li>')
              ?>
            </ul>
          </div>

          <div class="col-xs-2" style="padding-top:12px;">
            <ul class="nav nav-pills">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <?php echo getLogin(); ?> <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <li class="item">
                    <a href="login.php?logoff=true">Logoff</a>
                  </li>
                </ul>
              </li>      
            </ul>      
          </div>

        </div>
      </div>
    </div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
  </body>
</html>
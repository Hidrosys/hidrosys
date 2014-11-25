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
	<div class="col-xs-4" style="min-height: 32px; max-height: 32px; margin: 2% auto auto; float: none; width: 950px;">
      <div class="panel panel-default">
        <div style="height: 32px;">
		<label> Serviços Pendentes </label>
		</div>
	  </div>
	</div>

    <div class="col-xs-4" style="min-height: 410px; max-height: 410px; margin: 2% auto auto; float: none; width: 950px;">
      <div class="panel panel-default">
        <div style="height: 35px;">
          <table class="table table-striped">
            <thead>
              <tr class="info">
                <td style="width: 6.5%">
                  ID
                </td>
                <td style="width: 45%">
                  ID Cliente
                </td>
                <td style="width: 15%">
                  Data
                </td>
                <td style="width: 16%">
                  Valor
                </td>
              </tr>
            </thead>
          </table>
        </div>
        <div style="min-height: 360px; max-height: 360px; overflow-y: scroll; width: 100%">
        <table class="table header-fixed" data-single-select="true">
          <body>
            <?php
              $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
              $query = "SELECT * FROM servicos WHERE deleted = 0 ";

              if(isset($_GET["tipo"]))
              {
                if($_GET["tipo"] == "id" && isset($_GET["busca"]))
                {
                  $query = $query . " AND id LIKE ". $_GET["busca"];
                }
                else
                {
                  $query = $query . " AND " . $_GET["tipo"] . " LIKE '". $_GET["busca"] ."%'";
                }
              }

              $query = $query . " ORDER BY id";

              $result = mysqli_query($conexao, $query);

              if($result)
              while($consulta = mysqli_fetch_array($result))
              {
                echo
                '<tr id="r' . $consulta["id"] . '" onclick="selectRow('.$consulta["id"].');" >
                  <td
                  <td style="width: 6%">
                    '.$consulta["id"].
                  '</td>
                  <td style="width: 42%">
                    '.$consulta["id_cliente"].
                  '</td>
                  <td style="width: 14%">
                    '.$consulta["dia"]. "/" . $consulta["mes"] . "/" . $consulta["ano"] .
                  '</td>
                  <td style="width: 14%">
                    '.$consulta["valor"].
                  '</td>
                </tr>';
              }
            ?>
          </tbody>
        </table>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
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

    <div class="col-xs-4" style="margin: 4% auto auto; float: none; width: 950px; min-height: 435px">
      <div class="panel panel-default">
        <div style="height: 35px;">
          <table class="table table-striped">
            <thead>
              <tr class="info">
                <td style="width: 9.5%">
                  ID
                </td>
                <td style="width: 36%">
                  Nome
                </td>
                <td style="width: 13%">
                  Login
                </td>
                <td style="width: 30%">
                  Email
                </td>
                <td style="width: 17%">
                  Telefone
                </td>
              </tr>
            </thead>
          </table>
        </div>
        <div style="height: 400px; overflow-y: scroll; width: 100%">
        <table class="table table-striped header-fixed" data-single-select="true">
          <body>
            <?php
              $conexao = mysql_connect("localhost", "root", "123456");
              mysql_select_db("hidrosys", $conexao);

              $query = "SELECT * FROM usuarios";
              $result = mysql_query($query);
              while($consulta = mysql_fetch_array($result))
              {
                echo
                '<tr>
                  <td
                  <td style="width: 10%">
                    '.$consulta["id"].
                  '</td>
                  <td style="width: 40%">
                    '.$consulta["nome"].
                  '</td>
                  <td style="width: 14%">
                    '.$consulta["login"].
                  '</td>
                  <td style="width: 32%">
                    '.$consulta["email"].
                  '</td>
                  <td style="width: 14%">
                    '.$consulta["telefone"].
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
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

    <div class="col-xs-4" style="margin: 4% auto auto; float: none; width: 950px;">
      <div class="panel panel-default">
        <div style="height: 35px">
          <table class="table table-striped">
            <thead>
              <tr class="info">
                <td style="width: 9%">
                  ID
                </td>
                <td style="width: 35%">
                  Nome
                </td>
                <td style="width: 18%">
                  Login
                </td>
                <td style="width: 26.5%">
                  Email
                </td>
                <td style="width: 14%">
                  Telefone
                </td>
              </tr>
            </thead>
          </table>
        </div>
        <div style="max-height: 400px; overflow: auto; width: 100%">
        <table class="table table-striped header-fixed">          
          <body>
            <tr>
              <td class="col-xs-1">
                1
              </td>
              <td class="col-xs-4">
                Thiago
              </td>
              <td class="col-xs-2">
                thiago
              </td>
              <td class="col-xs-3">
                thiago.carvp@gmail.com
              </td>
              <td class="col-xs-1">
              9999-9999
              </td>
            </tr>

            <tr>
              <td>
                2
              </td>
              <td>
                Renan
              </td>
              <td>
                renan
              </td>
              <td>
                renansd@hotmail.com
              </td>
              <td>
              9999-9999
              </td>
            </tr>

            <?php
              $i = 0;
              while($i < 20)
              {
                echo '
                  <tr>
              <td>
                2
              </td>
              <td>
                Renan
              </td>
              <td>
                renan
              </td>
              <td>
                renansd@hotmail.com
              </td>
              <td>
              9999-9999
              </td>
            </tr>
                ';
                $i += 1;
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
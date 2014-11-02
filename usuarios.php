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

    <script type="text/javascript">
      var selected_row = -1;

      function selectRow(row)
      {
        document.getElementById("input_row").value = row;

        if(selected_row != -1)
        {
          document.getElementById("r"+selected_row).style.background="#FFFFFF";
        }
        document.getElementById("r"+row).style.background="#DDDDDD";

        selected_row = row;
      }
    </script>

    <form method="POST" action="altusuario.php" name="alt">

      <input type="hidden" id="input_row" name="selected_row" value="0">
	  <input type="hidden" id="opt" name="opt">
      <!-- <input type="submit" value="OK"> -->

    </form>

    <div class="col-xs-4" style="margin: 0 auto auto; float: none; width: 950px; height: 20px;">
      <input type="login" class="form-control" id="inputSearch" placeholder="Pesquisa" style="float: left; width: 80%">
      <select class="form-control" style="width: 14%; float: left; margin-left: 8px">
        <option>Nome</option>
        <option>Login</option>
        <option>ID</option>
        <option>Email</option>
        <option>Telefone</option>
      </select>
      <button type="button" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-search"></span></button>
    </div>

    <div class="col-xs-4" style="min-height: 410px; max-height: 410px; margin: 2% auto auto; float: none; width: 950px;">
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
        <div style="min-height: 360px; max-height: 360px; overflow-y: scroll; width: 100%">
        <table class="table header-fixed" data-single-select="true">
          <body>
            <?php
              $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");              

              $query = "SELECT * FROM usuarios";
              $result = mysqli_query($conexao, $query);
              while($consulta = mysqli_fetch_array($result))
              {
                echo
                '<tr id="r' . $consulta["id"] . '" onclick="selectRow('.$consulta["id"].');" >
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

    <div class="panel panel-default col-xs-4" style="margin-left: auto; margin-right: auto; float: none; width: 921px; min-height: 50px">
      <div class="panel-body">
        <button type="button" class="btn btn-primary" onclick='adicionar()' id='1' style="width: 150px; float: left; margin-right: 85px;"><span class="glyphicon glyphicon-plus" style="padding-right: 10px"></span>Adicionar</button>
        <button type="button" class="btn btn-primary" onclick='vizu()' id='2' style="width: 150px; float: left; margin-right: 85px;"><span class="glyphicon glyphicon-eye-open" style="padding-right: 10px"></span>Visualizar</button>
        <button type="button" class="btn btn-primary" onclick='alterar()' id='3' style="width: 150px; float: left; margin-right: 85px;"><span class="glyphicon glyphicon-pencil" style="padding-right: 10px"></span>Alterar</button>
        <button type="button" class="btn btn-primary" onclick='removerr()' id='Botao4' style="width: 150px; float: left;"><span class="glyphicon glyphicon-minus" style="padding-right: 10px"></span>Remover</button>
      </div>
    </div>
	<script type="text/javascript">
	function adicionar(){
		document.getElementById("opt").value="1";
		document.alt.submit();
	}    
	function vizu(){
		document.getElementById("opt").value="2";
		if(document.getElementById("input_row").value==0)
		{
			alert("Nenhum usuário selecionado!");
		}
		else
		{
			document.alt.submit();
		}		
	}
	function alterar(){
	  document.getElementById("opt").value="3";
    if(document.getElementById("input_row").value==0)
    {
      alert("Nenhum usuário selecionado!");
    }
    else
    {
      document.alt.submit();
    } 
	}
	
		
	function removerr(){
		if(document.getElementById("input_row").value==0)
		{
			alert("Nenhum usuário selecionado!");
		}
		else if(confirm("Deseja excluir o usuário selecionado?"))
		{
			$.ajax({
			  type: "POST",
			  url: "classeusuario.php",
			  data: { opt:"4", id: document.getElementById("input_row").value  }
			}).done(function( msg ) {
			  window.location.replace("/hidrosys/usuarios.php");
			});
		}
	}
	</script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
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
	<form method="POST" action="altservicos.php" name="vai" id="vai">
		<input type="hidden" name="opt" value="1">
	</form>
	<?php		
	if($_POST["opt"]=="1")
	{	echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inserir Serviço</h3>
		</div>
		<div class="panel-body">
			<form role="form" method="post" action="classeservico.php">
			<input type="hidden" id="opt" name="opt" value="1">
			<div style="padding-bottom:15px">
			<label>Cliente</label>
			<select id="id_cliente" name="id_cliente">';
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM clientes WHERE deleted = 0";
			$result = mysqli_query($conexao, $query);
			while($consulta = mysqli_fetch_array($result))
			{
				echo "<option value='" . $consulta["id"] . "' title = '" . $consulta["id"] . "'>" . $consulta["nome"] . "</option>";
			}			
			echo '
			</select>
			</div>			
			 <div class="form-group">			  
			  <label>Descriçao do serviço</label>
              <input class="form-control" id="descricao" name="descricao" placeholder="Entre com uma descricao para o serviço">
			</div>
			<div class="form-group">			  
			  <label>Data</label>
              <input class="form-control" id="dia" name="dia" placeholder="Entre com o dia do serviço">
			  <input class="form-control" id="mes" name="mes" placeholder="Entre com o mes do serviço">
			  <input class="form-control" id="ano" name="ano" placeholder="Entre com o ano do serviço">
			
			<div class="form-group">			  
			  <label>Horário de início</label>
              <input class="form-control" id="hora_inicio" name="hora_inicio" placeholder="Entre com o horário de início">
			</div>
			<div class="form-group">			  
			  <label>Horário de término</label>
              <input class="form-control" id="hora_fim" name="hora_fim" placeholder="Entre com o horário de término">
			</div>
			<div class="form-group">			  
			  <label>Orçamento</label>
              <input class="form-control" id="valor" name="valor" placeholder="Entre com a estimativa do custo do serviço">
			</div>
			<button type="submit" id="id1" class="btn btn-default">Inserir</button>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
			</form>
		</div>
		<label>Os campos marcados com * são obrigatórios<label/>
	</div>';
	}
	if($_POST["opt"] == '2')
	{	
	$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
	$query = "SELECT * FROM servicos WHERE id = ".$_POST["selected_row"];
	$result = mysqli_query($conexao, $query);
	$consulta = mysqli_fetch_array($result);
	$conexao2 = mysqli_connect("localhost", "root", "123456", "hidrosys");
	$query2 = "SELECT * FROM clientes WHERE id = ". $consulta["id_cliente"];
	$result2 = mysqli_query($conexao2, $query2);
	$consulta2 = mysqli_fetch_array($result2);		
	echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Visualizar Serviço</h3>
		</div>
		<div class="panel-body">
			<form role="form">
			  <div class="form-group">
				<label>ID</label>
				'.$_POST["selected_row"].'
			  </div>
			  <div class="form-group">
				<label>Cliente</label>
				'.$consulta2["nome"].'
			  </div>
			  <div class="form-group">
				<label>Data</label>
				'.$consulta["dia"]. "/" . $consulta["mes"] . "/" . $consulta["ano"] .'
			  </div>
			  <div class="form-group">
				<label>Horario de Início</label>
				'.$consulta["hora_inicio"].'
			  </div>
			  <div class="form-group">
				<label>Horario de Termino</label>
				'.$consulta["hora_fim"].'
			  </div>
			  <div class="form-group">
				<label>Descricao</label>
				'.$consulta["descricao"].'
			  </div>
			  			  
			</form>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
		</div>
	</div>';	
	mysqli_close($conexao);
	mysqli_close($conexao2);
	}
	if($_POST["opt"] == '5')
	{
		echo '<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Inserir Serviço</h3>
			</div>
			<div class="panel-body">
				<form role="form" method="post" action="classeservico.php">
				<input type="hidden" id="opt" name="opt" value="5">
				<input type="hidden" id="id" name="id" value="'.$_POST["selected_row"] .'">
				<div style="padding-bottom:15px">
				<label>Funcionário</label>
				<select id="id_func" name="id_func">';
				$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
				$query = "SELECT * FROM funcionarios WHERE deleted = 0 AND status = 0";
				$result = mysqli_query($conexao, $query);
				while($consulta = mysqli_fetch_array($result))
				{
					echo "<option value='" . $consulta["id"] . "' title = '" . $consulta["id"] . "'>" . $consulta["nome"] . "</option>";
				}			
				echo '
				</select>
				</div>
				<div class="form-group">			  
					<label>Valor da Hora</label>
					<input class="form-control" id="valor" name="valor" placeholder="Entre com o valor da hora">
				</div>				
				<button type="submit" id="id1" class="btn btn-default">Inserir</button>
				<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
				</form>
			</div>
			<label>Os campos marcados com * são obrigatórios<label/>
		</div>';
	}
	if($_POST["opt"] == '6')
	{
		echo '<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Inserir Serviço</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="classeservico.php">
					<input type="hidden" id="opt" name="opt" value="6">
					<input type="hidden" id="id" name="id" value="'.$_POST["selected_row"] .'">
					<div style="padding-bottom:15px">
					<label>Ferramenta</label>
					<select id="id_fer" name="id_fer">';
					$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
					$query = "SELECT * FROM ferramentas WHERE deleted = 0";
					$result = mysqli_query($conexao, $query);
					while($consulta = mysqli_fetch_array($result))
					{
						echo "<option value='" . $consulta["id"] . "' title = '" . $consulta["id"] . "'>" . $consulta["tipo"] . "</option>";
					}			
					echo '
					</select>
					</div>
					<div class="form-group">			  
					  <label>Quantidade</label>
					  <input class="form-control" id="qtd" name="qtd" placeholder="Entre com a quantidade da ferramenta selecionada">
					</div>
					<button type="submit" id="id1" class="btn btn-default">Inserir</button>
					<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
					</form>
				</div>
				<label>Os campos marcados com * são obrigatórios<label/>
			</div>';
	}
	if($_POST["opt"] == '7')
	{
		echo '<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Inserir Serviço</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="classeservico.php">
					<input type="hidden" id="opt" name="opt" value="7">
					<input type="hidden" id="id" name="id" value="'.$_POST["selected_row"] .'">
					<div style="padding-bottom:15px">
					<label>Ferramenta</label>
					<select id="id_peca" name="id_peca">';
					$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
					$query = "SELECT * FROM pecas WHERE deleted = 0";
					$result = mysqli_query($conexao, $query);
					while($consulta = mysqli_fetch_array($result))
					{
						echo "<option value='" . $consulta["id"] . "' title = '" . $consulta["id"] . "'>" . $consulta["tipo"] . "</option>";
					}			
					echo '
					</select>
					</div>
					<div class="form-group">			  
					  <label>Quantidade</label>
					  <input class="form-control" id="qtd" name="qtd" placeholder="Entre com a quantidade da ferramenta selecionada">
					</div>
					<button type="submit" id="id1" class="btn btn-default">Inserir</button>
					<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
					</form>
				</div>
				<label>Os campos marcados com * são obrigatórios<label/>
			</div>';
	}
	?>
	<script type="text/javascript">
	//var op= $_POST["opt"];
	function manda(){
	$.ajax({
	  type: "POST",
	  url: "classeservico.php",
	  data: {opt: "1", id_cliente: document.getElementById("id_cliente").value, hora_inicio: document.getElementById("hora_inicio").value, hora_fim: document.getElementById("hora_fim").value, descricao: document.getElementById("descricao").value, dia: document.getElementById("dia").value, mes: document.getElementById("mes").value, ano: document.getElementById("ano").value, valor: document.getElementById("valor").value}
	}).done(function() {		
		document.vai.submit();	
	  });		
	}
	function volta()
	{
		window.location.replace("/hidrosys/servicos.php");
	}
	function salva()
	{
	$.ajax({
	  type: "POST",
	  url: "classeservico.php",
	  data: {opt: "3", id: document.getElementById("id").value, qtd: document.getElementById("qtd").value}
	}).done(function() {		
		window.location.replace("/hidrosys/servicos.php");
	  });
	}
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
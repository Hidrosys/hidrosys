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
	<form method="POST" action="altcliente.php" name="vai" id="vai">
		<input type="hidden" name="opt" value="1">
	</form>
	<?php		
	if($_POST["opt"]=="1") echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inserir Cliente</h3>
		</div>
		<div class="panel-body">
			<form role="form">
				<input type="hidden" id="opt" name=opt>
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" id="nome" placeholder="Entre com o nome">
			  </div>
			  <div class="form-group">
				<label>Endereço</label>
				<input type="form-control" class="form-control" id="endereco" placeholder="Entre com o endereco">
			  </div>
			  <div class="form-group">
				<label>CEP</label>
				<input class="form-control" id="cep" placeholder="Entre com o CEP">
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input class="form-control" id="email" placeholder="default@default.com">
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" id="telefone" placeholder="Entre com o seu telefone">
			  </div>
			  <div class="form-group">
				<label>CPF</label>
				<input class="form-control" id="cpf" placeholder="Entre com o CPF/CNPJ">
			  </div>
			</form>
			<button onclick="manda()" id="id1" class="btn btn-default">Inserir</button>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
		</div>
	</div>';
	if($_POST["opt"] == '2')
	{	
	$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
	$query = "SELECT * FROM clientes WHERE id = ".$_POST["selected_row"];
	$result = mysqli_query($conexao, $query);
	$consulta = mysqli_fetch_array($result);	
	echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Visualizar Cliente</h3>
		</div>
		<div class="panel-body">
			<form role="form">
			  <div class="form-group">
				<label>ID</label>
				'.$_POST["selected_row"].'
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				'.$consulta["nome"].'
			  </div>
			  <div class="form-group">
				<label>Endereco</label>
				'.$consulta["endereco"].'
			  </div>
			  <div class="form-group">
				<label>Email</label>
				'.$consulta["email"].'
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				'.$consulta["telefone"].'
			  </div>
			  <div class="form-group">
				<label>CPF</label>
				'.$consulta["cpf"].'
			  </div>
			  
			</form>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
		</div>
	</div>';	
	mysqli_close($conexao);
	}

	if($_POST["opt"]=="3")
	{		
		unset($_POST["opt"]);
		include("classecliente.php");
		$_POST["opt"]="3";
		$usuario = consultaBD($_POST["selected_row"]);
		echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Alterar Cliente</h3>
		</div>
		<div class="panel-body">
			<form role="form">
				<input type="hidden" id="opt" name=opt>
				<input type="hidden" id="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" id="nome" placeholder="Entre com o nome" value="'. $usuario->getNome() .'">
			  </div>
			  <div class="form-group">
				<label>Endereco</label>
				<input class="form-control" id="endereco" placeholder="Entre com o endereco" value="'. $usuario->getEndereco() .'">
			  </div>
			  <div class="form-group">
				<label>CEP</label>
				<input class="form-control" id="cep" placeholder="Entre com o CEP" value="'. $usuario->getCEP() .'">
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input class="form-control" id="email" placeholder="default@default.com" value="'. $usuario->getEmail() .'">
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" id="telefone" placeholder="Entre com o telefone" value="'. $usuario->getTelefone() .'">
			  </div>
			  <div class="form-group">
				<label>CPF</label>
				<input class="form-control" id="cpf" placeholder="Entre com o CPF/CNPJ" value="'. $usuario->getCPF() .'">
			  </div>
			</form>
			<button onclick="salva()" id="id1" class="btn btn-default">Salvar</button>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
		</div>
		</div>';
	}

	?>
	<script type="text/javascript">
	//var op= $_POST["opt"];
	function manda(){
	$.ajax({
	  type: "POST",
	  url: "classecliente.php",
	  data: {opt: "1", nome: document.getElementById("nome").value, endereco: document.getElementById("endereco").value, cep: document.getElementById("cep").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value, cpf: document.getElementById("cpf").value}
	}).done(function() {		
		document.vai.submit();	
	  });		
	}
	function volta()
	{
		window.location.replace("/hidrosys/clientes.php");
	}
	function salva()
	{
	$.ajax({
	  type: "POST",
	  url: "classecliente.php",
	  data: {opt: "3", id: document.getElementById("id").value, nome: document.getElementById("nome").value, endereco: document.getElementById("endereco").value, cep: document.getElementById("cep").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value, cpf: document.getElementById("cpf").value}
	}).done(function() {		
		window.location.replace("/hidrosys/clientes.php");
	  });
	}
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
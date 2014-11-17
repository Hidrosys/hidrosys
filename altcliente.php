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
			<form role="form" method="post" action="classecliente.php">
				<input type="hidden" id="opt" name="opt" value="1">
			  <div class="form-group">
				<label>Nome *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o nome\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="nome" name="nome" placeholder="Entre com o nome" pattern="[A-Za-z çÇãâáéóúÁÉÓÚ]{1,50}" required>
			  </div>
			  <div class="form-group">
				<label>Endereço *</label>
				<input type="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o endereço\')" onchange="try{setCustomValidity(\'\')}catch(e){}" class="form-control" id="endereco" name="endereco" placeholder="Entre com o endereço" pattern="[A-Za-z çÇãâáéóúÁÉÓÚ,.]{1,50}" required>
			  </div>
			  <div class="form-group">
				<label>CEP *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o CEP no formato xxxxx-xxx\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="cep" name="cep" pattern="[0-9]{5,5}-[0-9]{3,3}" placeholder="Entre com o CEP" required>
			  </div>
			  <div class="form-group">
				<label>Email *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o email corretamente no formato exemplo@servidor.com\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="email" name="email" placeholder="default@default.com" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$" required>
			  </div>
			  <div class="form-group">
				<label>Telefone *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o telefone corretamente no formato (99) 9999-9999\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="telefone" name="telefone" placeholder="(99) 9999-9999" pattern=".((10)|([0-9][0-9]).)\\s?9?[0-9][0-9]{3}-[0-9]{4}" required>
			  </div>
			  <div class="form-group">
				<label>CPF *</label>
				<input class="form-control"  oninvalid="setCustomValidity(\'Por favor, preencha o CPF no formato xxx.xxx.xxx-xx\')" onchange="try{setCustomValidity(\'\')}catch(e){}" name="cpf" id="cpf" placeholder="Entre com o CPF" pattern="[0-9]{3,3}.[0-9]{3,3}.[0-9]{3,3}-[0-9]{2,2}" required>
			  </div>
			  <button type="submit" id="id1" class="btn btn-default">Inserir</button>
			  <button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
			</form>
		</div>
		<label>Os campos marcados com * são obrigatórios<label/>
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
			<form role="form" method="post" action="classecliente.php">
				<input type="hidden" id="opt" name="opt" value="3">
				<input type="hidden" id="id" name="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Nome *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o nome\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="nome" name="nome" placeholder="Entre com o nome" pattern="[A-Za-z çÇãâáéóúÁÉÓÚ]{1,50}" required value="'. $usuario->getNome() .'">
			  </div>
			  <div class="form-group">
				<label>Endereço *</label>
				<input type="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o endereço\')" onchange="try{setCustomValidity(\'\')}catch(e){}" class="form-control" id="endereco" name="endereco" placeholder="Entre com o endereço" pattern="[A-Za-z çÇãâáéóúÁÉÓÚ,.]{1,50}" required value="'. $usuario->getEndereco() .'">
			  </div>
			  <div class="form-group">
				<label>CEP *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o CEP no formato xxxxx-xxx\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="cep" name="cep" pattern="[0-9]{5,5}-[0-9]{3,3}" placeholder="Entre com o CEP" required value="'. $usuario->getCEP() .'">
			  </div>
			  <div class="form-group">
				<label>Email *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o email corretamente no formato exemplo@servidor.com\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="email" name="email" placeholder="default@default.com" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$" required value="'. $usuario->getEmail() .'">
			  </div>
			  <div class="form-group">
				<label>Telefone *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o telefone corretamente no formato (99) 9999-9999\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="telefone" name="telefone" placeholder="(99) 9999-9999" pattern=".((10)|([0-9][0-9]).)\\s?9?[0-9][0-9]{3}-[0-9]{4}" required value="'. $usuario->getTelefone() .'">
			  </div>
			  <div class="form-group">
				<label>CPF *</label>
				<input class="form-control"  oninvalid="setCustomValidity(\'Por favor, preencha o CPF no formato xxx.xxx.xxx-xx\')" onchange="try{setCustomValidity(\'\')}catch(e){}" name="cpf" id="cpf" placeholder="Entre com o CPF" pattern="[0-9]{3,3}.[0-9]{3,3}.[0-9]{3,3}-[0-9]{2,2}" required value="'. $usuario->getCPF() .'">
			  </div>
			  <button type="submit" id="id1" class="btn btn-default">Salvar</button>
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
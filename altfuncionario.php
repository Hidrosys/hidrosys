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
	<form method="POST" action="altfuncionario.php" name="vai" id="vai">
		<input type="hidden" id="opt" name="opt" value="1">
	</form>
	<?php		
	if($_POST["opt"]=="1") echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inserir Funcionario</h3>
		</div>
		<div class="panel-body">
			<form role="form">
				<input type="hidden" id="opt" name="opt">
				<input type="hidden" id="status" name="status" value="0">
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" id="nome" name="nome" placeholder="Entre com o nome">
			  </div>
			  <div class="form-group">
				<label>Data de nascimento</label>
				<input class="form-control" id="nasce" placeholder="Entre com a data de nascimento">
			  </div>
			  <div class="form-group">
				<label>RG</label>
				<input class="form-control" id="rg" placeholder="Entre com o RG">
			  </div>
			  <div class="form-group">
				<label>CPF</label>
				<input class="form-control" id="cpf" placeholder="Entre com o CPF">
			  </div>
			  <div class="form-group">
				<label>Endereco</label>
				<input class="form-control" id="endereco" placeholder="Entre com o endereco">
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" id="telefone" placeholder="Entre com o telefone">
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input class="form-control" id="email" placeholder="default@default.com">
			  </div>
			  <div style="padding-bottom:15px">
					<label>Ocupacao</label>
					<select id="ocupacao" name="ocupacao">
					<option value="Gerente" title="Gerente">Gerente</option>
					<option value="Tecnico(a)" title="Tecnico">Tecnico(a)</option>
					<option value="Secretario(a)" title="Secretario">secretario(a)</option>
					</select>
			  </div>
			  <div class="form-group">
				<label>Salario base</label>
				<input class="form-control" id="salario" placeholder="Entre com o salario base">
			  </div>
			  <div class="form-group">
				<label>Preco da hora trabalhada</label>
				<input class="form-control" id="prehora" placeholder="Entre com o valor da hora">
			  </div>			  
			</form>
			<button onclick="manda()" id="id1" class="btn btn-default">Inserir</button>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
		</div>
	</div>';
	if($_POST["opt"] == '2')
	{	
	$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
	$query = "SELECT * FROM funcionarios WHERE id = ".$_POST["selected_row"];
	$result = mysqli_query($conexao, $query);
	$consulta = mysqli_fetch_array($result);	
	echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Visualizar Funcionario</h3>
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
				<label>Data de nascimento</label>
				'.$consulta["datanasc"].'
			  </div>
			  <div class="form-group">
				<label>RG</label>
				'.$consulta["rg"].'
			  </div>
			  <div class="form-group">
				<label>CPF</label>
				'.$consulta["cpf"].'
			  </div>
			  <div class="form-group">
				<label>Endereco</label>
				'.$consulta["endereco"].'
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				'.$consulta["telefone"].'
			  </div>
			  <div class="form-group">
				<label>Email</label>
				'.$consulta["email"].'
			  </div>
			  <div class="form-group">
				<label>ocupacao</label>
				'.$consulta["ocupacao"].'
			  </div>
			  <div class="form-group">
				<label>Salario base</label>
				'.$consulta["salario"].'
			  </div>
			  <div class="form-group">
				<label>Preco da hora trabalhada</label>
				'.$consulta["prehora"].'
			  </div>
			  <div class="form-group">
				<label>Status</label>
				'.$consulta["status"].'
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
		include("classefun.php");
		$_POST["opt"]="3";
		$usuario = consultaBD($_POST["selected_row"]);
		echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Alterar Funcionario</h3>
		</div>
		<div class="panel-body">
			<form role="form" id="formulario" method="post" action="classefun.php">
				<input type="hidden" id="opt" name="opt" value="3">
				<input type="hidden" id="id" name="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Nome *</label>
				<input class="form-control" id="nome" name="nome" placeholder="Entre com o login" value="'. $usuario->getNome() .'">
			  </div>
			  <div class="form-group">
				<label>Endreco *</label>
				<input class="form-control" id="endereco" name="endereco" placeholder="Entre com o endereco" value="'. $usuario->getEndereco() .'">
			  </div>
			  <div class="form-group">
				<label>RG</label>
				<input class="form-control"  id="rg" name="rg" placeholder="Entre com o RG" value="'. $usuario->getRG() .'">
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="default@default.com" value="'. $usuario->getEmail() .'">
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="'. $usuario->getTelefone() .'">
			  </div>			  
			  <button type="submit" id="id1" class="btn btn-default">Salvar</button>
			</form>
			
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
		</div>
		</div>';
	}

	?>
	<script type="text/javascript">
	function manda(){
	$.ajax({
	  type: "POST",
	  url: "classefun.php",
	  data: {opt: "1", nome: document.getElementById("nome").value, datanasc: document.getElementById("nasce").value, rg: document.getElementById("rg").value, cpf: document.getElementById("cpf").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value, endereco: document.getElementById("endereco").value, ocupacao: document.getElementById("ocupacao").value, salario: document.getElementById("salario").value, prehora: document.getElementById("prehora").value, status: document.getElementById("status").value}
	}).done(function() {		
		document.vai.submit();	
	  });		
	}
	function volta()
	{
		window.location.replace("/hidrosys/funcionarios.php");
	}
	function salva()
	{
	$.ajax({
	  type: "POST",
	  url: "classefun.php",
	  data: {opt: "3", id: document.getElementById("id").value, nome: document.getElementById("nome").value, endereco: document.getElementById("endereco").value, rg: document.getElementById("RG").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value}
	}).done(function() {		
		window.location.replace("/hidrosys/funcionarios.php");
	  });
	}
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
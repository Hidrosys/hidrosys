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
	<form method="POST" action="altusuario.php" name="vai" id="vai">
		<input type="hidden" name="opt" value="1">
	</form>
	<?php		
	if($_POST["opt"]=="1") echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inserir Usuário</h3>
		</div>
		<div class="panel-body">
			<form role="form">
				<input type="hidden" id="opt" name=opt>
			  <div class="form-group">
				<label>Nome</label>
				<input type="text" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o nome\')" id="nome" name="nome" placeholder="Entre com o nome"/>
			  </div>
			  <div class="form-group">
				<label>Data de nascimento</label>
				<input type="form-control" class="form-control" id="nasce" placeholder="Entre com a data de nascimento">
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
			  <input type="hidden" id="status" name=status value="0">
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
			<h3 class="panel-title">Visualizar Usuário</h3>
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
		include("classfuncionario.php");
		$_POST["opt"]="3";
		$usuario = consultaBD($_POST["selected_row"]);
		echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Alterar Usuário</h3>
		</div>
		<div class="panel-body">
			<form role="form" id="formulario" method="post" action="classefuncionario.php">
				<input type="hidden" id="opt" name="opt" value="3">
				<input type="hidden" id="id" name="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Login *</label>
				<input type="text" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o login\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="login" name="login" placeholder="Entre com o login" value="'. $usuario->getLogin() .'" pattern="[A-Za-z0-9]{3,30}" required/>
			  </div>
			  <div class="form-group">
				<label>Senha *</label>
				<input type="password" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha a senha\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="senha" name="senha" placeholder="Entre com a senha" value="'. $usuario->getSenha() .'" required/>
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o nome\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="nome" name="nome" placeholder="Entre com o seu nome" value="'. $usuario->getNome() .'" pattern="[A-Za-zçÇãâáéóúÁÉÓÚ]{1,50}" required/>
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o email corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="email" name="email" placeholder="default@default.com" value="'. $usuario->getEmail() .'" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$" />
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o telefone corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="'. $usuario->getTelefone() .'" pattern=".((10)|([1-9][1-9]).)\\s9?[6-9][0-9]{3}-[0-9]{4}" />
			  </div>
			  <div class="form-group">
				<label>Tipo</label>
				<input class="form-control" id="tipo" name="tipo" placeholder="Entre com o nivel de acesso" value="'. $usuario->getTipo() .'">
			  </div>
			  <button type="submit" id="id1" class="btn btn-default">Salvar</button>
			</form>
			
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
	  url: "classeusuario.php",
	  data: {opt: "1", login: document.getElementById("login").value, senha: document.getElementById("senha").value, nome: document.getElementById("nome").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value, tipo: document.getElementById("tipo").value}
	}).done(function() {		
		document.vai.submit();	
	  });		
	}
	function volta()
	{
		window.location.replace("/hidrosys/usuarios.php");
	}
	function salva()
	{		
	$.ajax({
	  type: "POST",
	  url: "classeusuario.php",
	  data: {opt: "3", id: document.getElementById("id").value, login: document.getElementById("login").value, senha: document.getElementById("senha").value, nome: document.getElementById("nome").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value, tipo: document.getElementById("tipo").value}
	}).done(function() {		
		window.location.replace("/hidrosys/usuarios.php");
	  });
	}


	function valida()
	{
		var val;
		val = document.getElementById("login").validity.valid;
		val = val && document.getElementById("email").validity.valid;
		return val;
	}
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
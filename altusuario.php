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
			<form role="form" id="formulario" method="post" action="classeusuario.php">
				<input type="hidden" id="opt" name="opt" value="1"/>
			  <div class="form-group">
				<label>Login *</label>
				<input type="text" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o login corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="login" name="login" placeholder="Entre com o login" pattern="[A-Za-z0-9]{3,30}" required/>
			  </div>
			  <div class="form-group">
				<label>Senha *</label>
				<input type="password" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha a senha\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="senha" name="senha" placeholder="Entre com a senha" required/>
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o nome\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="nome" name="nome" placeholder="Entre com o seu nome" pattern="[A-Za-z çÇãâáéóúÁÉÓÚ]{1,50}" required/>
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o email corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="email" name="email" placeholder="default@default.com" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$" />
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o telefone corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="telefone" name="telefone" placeholder="(99) 9999-9999" pattern=".((10)|([0-9][0-9]).)\\s9?[0-9][0-9]{3}-[0-9]{4}" />
			  </div>
			  <div class="form-group">
				<label>Tipo *</label>
				<input class="form-control" id="tipo" name="tipo" placeholder="Entre com o nivel de acesso" required>
			  </div>
			  <button type="submit" id="id1" class="btn btn-default">Inserir</button>
			  <button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
			</form>
		</div>
	</div>';
	if($_POST["opt"] == '2')
	{	
	$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
	$query = "SELECT * FROM usuarios WHERE id = ".$_POST["selected_row"];
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
				<label>Login</label>
				'.$consulta["login"].'
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				'.$consulta["nome"].'
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
				<label>Tipo</label>
				'.$consulta["tipo"].'
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
		include("classeusuario.php");
		$_POST["opt"]="3";
		$usuario = consultaBD($_POST["selected_row"]);
		echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Alterar Usuário</h3>
		</div>
		<div class="panel-body">
			<form role="form" id="formulario" method="post" action="classeusuario.php">
				<input type="hidden" id="opt" name="opt" value="3">
				<input type="hidden" id="id" name="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Login *</label>
				<input type="text" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o login corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="login" name="login" placeholder="Entre com o login" value="'. $usuario->getLogin() .'" pattern="[A-Za-z0-9]{3,30}" required/>
			  </div>
			  <div class="form-group">
				<label>Senha *</label>
				<input type="password" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha a senha\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="senha" name="senha" placeholder="Entre com a senha" value="'. $usuario->getSenha() .'" required/>
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o nome\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="nome" name="nome" placeholder="Entre com o seu nome" value="'. $usuario->getNome() .'" pattern="[A-Za-z çÇãâáéóúÁÉÓÚ]{1,50}" required/>
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o email corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="email" name="email" placeholder="default@default.com" value="'. $usuario->getEmail() .'" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$" />
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o telefone corretamente\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="'. $usuario->getTelefone() .'" pattern=".((10)|([0-9][0-9]).)\\s9?[0-9][0-9]{3}-[0-9]{4}" />
			  </div>
			  <div class="form-group">
				<label>Tipo *</label>
				<input class="form-control" id="tipo" name="tipo" placeholder="Entre com o nivel de acesso" value="'. $usuario->getTipo() .'" required>
			  </div>
			  <button type="submit" id="id1" class="btn btn-default">Salvar</button>
			  <button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
			</form>
		</div>
		</div>';
	}

	?>
	<label>Os campos marcados com * são obrigatórios<label/>
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
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
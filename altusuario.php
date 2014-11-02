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
				<label>Login</label>
				<input class="form-control" id="login" placeholder="Entre com o login">
			  </div>
			  <div class="form-group">
				<label>Senha</label>
				<input type="password" class="form-control" id="senha" placeholder="Entre com a senha">
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" id="nome" placeholder="Entre com o seu nome">
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
				<label>Tipo</label>
				<input class="form-control" id="tipo" placeholder="Entre com o nivel de acesso">
			  </div>
			</form>
			<button onclick="manda()" id="id1" class="btn btn-default">Inserir</button>
			<button onclick="volta()" id="id2" class="btn btn-default">Voltar</button>
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
			<form role="form">
				<input type="hidden" id="opt" name=opt>
				<input type="hidden" id="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Login</label>
				<input class="form-control" id="login" placeholder="Entre com o login" value="'. $usuario->getLogin() .'">
			  </div>
			  <div class="form-group">
				<label>Senha</label>
				<input type="password" class="form-control" id="senha" placeholder="Entre com a senha" value="'. $usuario->getSenha() .'">
			  </div>
			  <div class="form-group">
				<label>Nome</label>
				<input class="form-control" id="nome" placeholder="Entre com o seu nome" value="'. $usuario->getNome() .'">
			  </div>
			  <div class="form-group">
				<label>Email</label>
				<input class="form-control" id="email" placeholder="default@default.com" value="'. $usuario->getEmail() .'">
			  </div>
			  <div class="form-group">
				<label>Telefone</label>
				<input class="form-control" id="telefone" placeholder="Entre com o seu telefone" value="'. $usuario->getTelefone() .'">
			  </div>
			  <div class="form-group">
				<label>Tipo</label>
				<input class="form-control" id="tipo" placeholder="Entre com o nivel de acesso" value="'. $usuario->getTipo() .'">
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
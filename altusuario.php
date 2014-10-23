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
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inserir Usuário</h3>
		</div>
		<div class="panel-body">
			<form role="form">
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
			  <button onclick='manda()' id='id1' class="btn btn-default">Concluir</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	var op=$_POST["op"];
	function manda(){
	$.ajax({
	  type: "POST",
	  url: "classeusuario.php",
	  data: {opt: "1", login: document.getElementById("login").value, senha: document.getElementById("senha").value, nome: document.getElementById("nome").value, email: document.getElementById("email").value, telefone: document.getElementById("telefone").value, tipo: document.getElementById("tipo").value}
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
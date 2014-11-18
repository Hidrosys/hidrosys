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
	<form method="POST" action="altferramentas.php" name="vai" id="vai">
		<input type="hidden" name="opt" value="1">
	</form>
	<?php		
	if($_POST["opt"]=="1") echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inserir Ferramenta</h3>
		</div>
		<div class="panel-body">
			<form role="form" method="post" action="classeferramenta.php">
				<input type="hidden" id="opt" name="opt" value="1">
			  <div class="form-group">
				<label>Tipo *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o tipo de ferramenta\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="tipo" name="tipo" placeholder="Entre com o tipo" required>
			  </div>
			  <div class="form-group">
				<label>Descrição *</label>
				<input type="form-control" oninvalid="setCustomValidity(\'Por favor, preencha a descrição da ferramenta\')" onchange="try{setCustomValidity(\'\')}catch(e){}" class="form-control" id="descricao" name="descricao" placeholder="Entre com uma descrição" required>
			  </div>
			  <div class="form-group">
				<label>Quantidade *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha a quantidade com um valor inteiro\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="qtd" name="qtd" placeholder="Entre com a quantidade inicial" pattern="[0-9]{1,8}" required>
			  </div>
			  <div class="form-group">
				<label>Fabricante *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha o fabricante\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="fabricante" name="fabricante" placeholder="Entre com o fabricante" required>
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
	$query = "SELECT * FROM ferramentas WHERE id = ".$_POST["selected_row"];
	$result = mysqli_query($conexao, $query);
	$consulta = mysqli_fetch_array($result);	
	echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Visualizar Ferramenta</h3>
		</div>
		<div class="panel-body">
			<form role="form">
			  <div class="form-group">
				<label>ID</label>
				'.$_POST["selected_row"].'
			  </div>
			  <div class="form-group">
				<label>Tipo</label>
				'.$consulta["tipo"].'
			  </div>
			  <div class="form-group">
				<label>Descricao</label>
				'.$consulta["descricao"].'
			  </div>
			  <div class="form-group">
				<label>Quantidade</label>
				'.$consulta["quantidade"].'
			  </div>
			  <div class="form-group">
				<label>Fabricante</label>
				'.$consulta["fabricante"].'
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
		include("classeferramenta.php");
		$_POST["opt"]="3";
		$usuario = consultaBD($_POST["selected_row"]);
		echo '<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Alterar Ferramenta</h3>
		</div>
		<div class="panel-body">
			<form role="form" method="post" action="classeferramenta.php">
				<input type="hidden" id="opt" name="opt" value="3">
				<input type="hidden" id="id" name="id" value="'. $_POST["selected_row"] .'">
			  <div class="form-group">
				<label>Quantidade *</label>
				<input class="form-control" oninvalid="setCustomValidity(\'Por favor, preencha a quantidade com um valor inteiro\')" onchange="try{setCustomValidity(\'\')}catch(e){}" id="qtd" name="qtd" placeholder="Entre com a quantidade" value="'. $usuario->getQuantidade() .'" pattern="[0-9]{1,8}" required>
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
	  url: "classeferramenta.php",
	  data: {opt: "1", tipo: document.getElementById("tipo").value, descricao: document.getElementById("descricao").value, qtd: document.getElementById("qtd").value, fabricante: document.getElementById("fabricante").value}
	}).done(function() {		
		document.vai.submit();	
	  });		
	}
	function volta()
	{
		window.location.replace("/hidrosys/ferramentas.php");
	}
	function salva()
	{
	$.ajax({
	  type: "POST",
	  url: "classeferramenta.php",
	  data: {opt: "3", id: document.getElementById("id").value, qtd: document.getElementById("qtd").value}
	}).done(function() {		
		window.location.replace("/hidrosys/ferramentas.php");
	  });
	}
	</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
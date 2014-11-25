<?php
	include("seguranca.php");
	class Servico
	{
		private $id_cliente;
		private $descricao;
		private $hora_inicio;
		private $hora_fim;		
		private $valor;
		private $dia;
		private $mes;
		private $ano;
		
		public function __construct($id_cliente, $descricao, $hora_inicio, $hora_fim, $valor, $dia, $mes, $ano, $id)
		{
			$this->id_cliente = $id_cliente;			
			$this->descricao = $descricao;
			$this->hora_inicio = $hora_inicio;
			$this->hora_fim = $hora_fim;
			$this->valor = $valor;
			$this->dia = $dia;
			$this->mes = $mes;
			$this->ano = $ano;
			$this->id = $id;	
		}
		
		public function bdupdate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "UPDATE servicos SET id_cliente = " . $this->id_cliente . ", descricao = '" . $this->descricao . "', hora_inicio = '" . $this->hora_inicio . "', hora_fim = '" . $this->hora_fim . "', valor = " . $this->valor . ", dia = " . $this->dia . ", mes = " . $this->mes . ", ano = " . $this->ano . " WHERE id = " . $this->id;
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function bdcreate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "INSERT INTO servicos (id_cliente, descricao, hora_inicio, hora_fim, valor, dia, mes, ano) VALUES(".$this->id_cliente . ",'" . $this->descricao . "','" . $this->hora_inicio . "','" . $this->hora_fim . "'," . $this->valor . "," . $this->dia . "," . $this->mes . "," . $this->ano . ")";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function getCliente()
		{
			return $this->id_cliente;
		}
		public function getDescricao()
		{
			return $this->descricao;
		}
		public function getHoraini()
		{
			return $this->hora_inicio;
		} //Necessário?
		public function getHorafim()
		{
			return $this->hora_fim;
		}
		public function getValor()
		{
			return $this->valor;
		}			
		public function getID()
		{
			return $this->id;
		}
		public function modValor($quantidade)
		{
			$this->valor = $quantidade;
		}		
	}
	function consultaBD($id_entra)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "SELECT * FROM servicos WHERE id = ".$id_entra;
		$result = mysqli_query($conexao, $query);
		$consulta = mysqli_fetch_array($result);
		$insta = new Servico($consulta["id_cliente"], $consulta["descricao"], $consulta["hora_inicio"], $consulta["hora_fim"], $consulta["valor"], $consulta["dia"], $consulta["mes"], $consulta["ano"], $consulta["id"]);
		mysqli_close($conexao);
		return $insta;
	}
	function deletaBD($id)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "UPDATE servicos SET deleted = 1, deleted_date = '" . date("m/d/y G.i:s<br>", time()) . "' WHERE id = ". $id;
		$result = mysqli_query($conexao, $query);
		mysqli_close($conexao);		
	}	
	function criaBD($id_cliente, $descricao, $hora_inicio, $hora_fim, $valor, $dia, $mes, $ano)
	{
		$novo = new Servico($id_cliente, $descricao, $hora_inicio, $hora_fim, $valor, $dia, $mes, $ano, 0);
		$novo->bdcreate();		
	}
	function editaBD($id_cliente, $descricao, $hora_inicio, $hora_fim, $valor, $dia, $mes, $ano, $id)
	{
		$edita = new Servico($id_cliente, $descricao, $hora_inicio, $hora_fim, $valor, $dia, $mes, $ano, $id);
		$edita->bdupdate();
	}
	if(isset($_POST["opt"]))
	{
		if($_POST["opt"]=="1")
		{
			criaBD($_POST["id_cliente"], $_POST["descricao"], $_POST["hora_inicio"], $_POST["hora_fim"], $_POST["valor"], $_POST["dia"], $_POST["mes"], $_POST["ano"]);
			date_default_timezone_set("America/Brasilia");			
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logservicos.txt','a');
			//fwrite($arquivo, $formated_date . $_POST["id_cliente"] . $_POST["descricao"] . $_POST["hora_inicio"] . $_POST["hora_fim"] . $_POST["valor"] . $_POST["dia"] . $_POST["mes"] . $_POST["ano"]);
			fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["descricao"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			header("Location: servicos.php");
		}
		if($_POST["opt"]=="3")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM servicos WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);			
			editaBD($consulta["tipo"], $consulta["descricao"], $_POST["qtd"], $consulta["fabricante"], $consulta["id"]);			
			//criaBD($_POST["login"], $_POST["senha"], $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["tipo"]);
			mysqli_close($conexao);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM ferramentas WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logferramentas.txt','a');
			fwrite($arquivo, $formated_date . "--Alteration of " . $consulta["tipo"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);	
			header("Location: ferramentas.php");
		}
		if($_POST["opt"]=="4")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM servicos WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logservicos.txt','a');
			fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["descricao"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);		
			deletaBD($_POST["id"]);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM servicos_funcionarios WHERE id_servico = ".$_POST["id"];			
			$result = mysqli_query($conexao, $query);
			while($consulta = mysqli_fetch_array($result))
			{
				$conexao2 = mysqli_connect("localhost", "root", "123456", "hidrosys");
				$query2 = "UPDATE funcionarios SET status = 0 WHERE id = ". $consulta["id_funcionario"];
				$result2 = mysqli_query($conexao2, $query2);
				mysqli_close($conexao2);
			}			
			mysqli_close($conexao);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM servicos_ferramentas WHERE id_servico = ".$_POST["id"];			
			$result = mysqli_query($conexao, $query);
			while($consulta = mysqli_fetch_array($result))
			{
				
				$conexao2 = mysqli_connect("localhost", "root", "123456", "hidrosys");
				$quantidades = $consulta["quantidade"];
				$query2 = "UPDATE ferramentas SET quantidade = quantidade+" . $quantidades . " WHERE id = ". $consulta["id_ferramenta"];
				$result2 = mysqli_query($conexao2, $query2);
				mysqli_close($conexao2);
			}			
			mysqli_close($conexao);				
		}
		if($_POST["opt"]=="5")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "INSERT INTO servicos_funcionarios (id_servico, id_funcionario, valor) VALUES(".$_POST["id"] . "," . $_POST["id_func"] . "," . $_POST["valor"] . ")";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "UPDATE funcionarios SET status = 1 WHERE id = ". $_POST["id_func"];
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
			header("Location: servicos.php");			
		}
		if($_POST["opt"]=="6")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "INSERT INTO servicos_ferramentas (id_servico, id_ferramenta, quantidade) VALUES(".$_POST["id"] . "," . $_POST["id_fer"] . "," . $_POST["qtd"] . ")";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM ferramentas WHERE id = ".$_POST["id_fer"];			
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$quantidades = $consulta["quantidade"];
			mysqli_close($conexao);
			$quantidades = $quantidades-$_POST["qtd"];
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");			
			$query = "UPDATE ferramentas SET quantidade = " . $quantidades . " WHERE id = ". $_POST["id_fer"];
			$result = mysqli_query($conexao, $query);			
			mysqli_close($conexao);
			header("Location: servicos.php");			
		}
		if($_POST["opt"]=="7")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "INSERT INTO servicos_pecas (id_servico, id_peca, quantidade) VALUES(".$_POST["id"] . "," . $_POST["id_peca"] . "," . $_POST["qtd"] . ")";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM pecas WHERE id = ".$_POST["id_peca"];			
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$quantidades = $consulta["quantidade"];
			mysqli_close($conexao);
			$quantidades = $quantidades-$_POST["qtd"];
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");			
			$query = "UPDATE pecas SET quantidade = " . $quantidades . " WHERE id = ". $_POST["id_peca"];
			$result = mysqli_query($conexao, $query);			
			mysqli_close($conexao);
			header("Location: servicos.php");			
		}
	}	
?>
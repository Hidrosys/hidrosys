<?php
	include("seguranca.php");
	class Ferramenta
	{
		private $tipo;
		private $descricao;
		private $qtd;
		private $fabricante;		
		private $id;		
		
		public function __construct($tipo, $descricao, $qtd, $fabricante, $id)
		{
			$this->tipo = $tipo;			
			$this->descricao = $descricao;
			$this->qtd = $qtd;
			$this->fabricante = $fabricante;
			$this->id = $id;	
		}
		
		public function bdupdate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "UPDATE ferramentas SET tipo = '" . $this->tipo . "', descricao = '" . $this->descricao . "', quantidade = " . $this->qtd . ", fabricante = '" . $this->fabricante . "' WHERE id = " . $this->id;
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function bdcreate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "INSERT INTO ferramentas (tipo, descricao, quantidade, fabricante) VALUES('".$this->tipo . "','" . $this->descricao . "'," . $this->qtd . ",'" . $this->fabricante . "')";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getDescricao()
		{
			return $this->descricao;
		}
		public function getQuantidade()
		{
			return $this->qtd;
		} //Necessário?
		public function getFabricante()
		{
			return $this->fabricante;
		}		
		public function getID()
		{
			return $this->id;
		}
		public function modQuantidade($quantidade)
		{
			$this->quantidade = $quantidade;
		}		
	}
	function consultaBD($id_entra)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "SELECT * FROM ferramentas WHERE id = ".$id_entra;
		$result = mysqli_query($conexao, $query);
		$consulta = mysqli_fetch_array($result);
		$insta = new Ferramenta($consulta["tipo"], $consulta["descricao"], $consulta["quantidade"], $consulta["fabricante"], $consulta["id"]);
		mysqli_close($conexao);
		return $insta;
	}
	function deletaBD($id)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "UPDATE ferramentas SET deleted = 1, deleted_date = '" . date("m/d/y G.i:s<br>", time()) . "' WHERE id = ". $id;
		$result = mysqli_query($conexao, $query);
		mysqli_close($conexao);		
	}	
	function criaBD($tipo, $descricao, $qtd, $fabricante)
	{
		$novo = new Ferramenta($tipo, $descricao, $qtd, $fabricante, 0);
		$novo->bdcreate();		
	}
	function editaBD($tipo, $descricao, $qtd, $fabricante, $id)
	{
		$edita = new Ferramenta($tipo, $descricao, $qtd, $fabricante, $id);
		$edita->bdupdate();
	}
	if(isset($_POST["opt"]))
	{
		if($_POST["opt"]=="1")
		{
			criaBD($_POST["tipo"], $_POST["descricao"], $_POST["qtd"], $_POST["fabricante"]);
			date_default_timezone_set("America/Brasilia");			
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logferramentas.txt','a');
			fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["tipo"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			header("Location: ferramentas.php");
		}
		if($_POST["opt"]=="3")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM ferramentas WHERE id = ". $_POST["id"];
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
			$query = "SELECT * FROM ferramentas WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logferramentas.txt','a');
			fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["tipo"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);		
			deletaBD($_POST["id"]);			
		}
	}	
?>
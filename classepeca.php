<?php
	include("seguranca.php");
	class Peca
	{
		private $tipo;
		private $descricao;
		private $qtd;
		private $fabricante;	
		private $precoun;
		private $id;		
		
		public function __construct($tipo, $descricao, $qtd, $fabricante, $precoun, $id)
		{
			$this->tipo = $tipo;			
			$this->descricao = $descricao;
			$this->qtd = $qtd;
			$this->fabricante = $fabricante;
			$this->precoun = $precoun;
			$this->id = $id;	
		}
		
		public function bdupdate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "UPDATE pecas SET tipo = '" . $this->tipo . "', descricao = '" . $this->descricao . "', quantidade = " . $this->qtd . ", fabricante = '" . $this->fabricante . "', precoun = " . $this->precoun . " WHERE id = " . $this->id;
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function bdcreate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");						
			$query = "INSERT INTO pecas (tipo, descricao, quantidade, fabricante, precoun) VALUES('".$this->tipo . "','" . $this->descricao . "'," . $this->qtd . ",'" . $this->fabricante . "'," . $this->precoun . ")";
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
		public function getPrecoun()
		{
			return $this->precoun;
		}
		public function modQuantidade($quantidade)
		{
			$this->qtd = $qtd;
		}
	public function modPrecoun($precoun)
		{
			$this->precoun = $precoun;
		}		
	}
	function consultaBD($id_entra)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "SELECT * FROM pecas WHERE id = ".$id_entra;
		$result = mysqli_query($conexao, $query);
		$consulta = mysqli_fetch_array($result);
		$insta = new Peca($consulta["tipo"], $consulta["descricao"], $consulta["quantidade"], $consulta["fabricante"], $consulta["precoun"], $consulta["id"]);
		mysqli_close($conexao);
		return $insta;
	}
	function deletaBD($id)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "UPDATE pecas SET deleted = 1, deleted_date = '" . date("m/d/y G.i:s<br>", time()) . "' WHERE id = ". $id;
		$result = mysqli_query($conexao, $query);
		mysqli_close($conexao);		
	}	
	function criaBD($tipo, $descricao, $qtd, $fabricante, $precoun)
	{
		$novo = new Peca($tipo, $descricao, $qtd, $fabricante, $precoun, 0);
		$novo->bdcreate();		
	}
	function editaBD($tipo, $descricao, $qtd, $fabricante, $precoun, $id)
	{
		$edita = new Peca($tipo, $descricao, $qtd, $fabricante, $precoun, $id);
		$edita->bdupdate();
	}
	if(isset($_POST["opt"]))
	{
		if($_POST["opt"]=="1")
		{
			criaBD($_POST["tipo"], $_POST["descricao"], $_POST["qtd"], $_POST["fabricante"], str_replace(",", ".", $_POST["precoun"]));
			date_default_timezone_set("America/Brasilia");			
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logpecas.txt','a');
			fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["tipo"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			header("Location: pecas.php");
		}
		if($_POST["opt"]=="3")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM pecas WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);			
			editaBD($consulta["tipo"], $consulta["descricao"], $_POST["qtd"], $consulta["fabricante"], str_replace(",", ".", $_POST["precoun"]), $consulta["id"]);			
			//criaBD($_POST["login"], $_POST["senha"], $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["tipo"]);
			mysqli_close($conexao);
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM pecas WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logpecas.txt','a');
			fwrite($arquivo, $formated_date . "--Alteration of " . $consulta["tipo"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);	
			header("Location: pecas.php");
		}
		if($_POST["opt"]=="4")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM pecas WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logpecas.txt','a');
			fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["tipo"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);		
			deletaBD($_POST["id"]);			
		}
	}	
?>
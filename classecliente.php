<?php
	include("seguranca.php");
	class Cliente
	{
		private $nome;
		private $cep;
		private $endereco;
		private $email = "default@default.com";
		private $telefone;
		private $cpf;
		private $id;		
		
		public function __construct($nome, $cep, $endereco, $email, $telefone, $cpf, $id)
		{
			$this->nome = $nome;			
			$this->cep = $cep;
			$this->endereco = $endereco;
			$this->email = $email;
			$this->telefone = $telefone;
			$this->cpf = $cpf;
			$this->id = $id;	
		}
		
		public function bdupdate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
						
			$query = "UPDATE clientes SET nome = '" . $this->nome . "', cep = '" . $this->cep . "', endereco = '" . $this->endereco . "', email = '" . $this->email . "', telefone = '". $this->telefone . "', cpf = '" . $this->cpf . "' WHERE id = " . $this->id;
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function bdcreate()
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
						
			$query = "INSERT INTO clientes (nome, cep, endereco, email, telefone, cpf) VALUES ('".$this->nome . "','" . $this->cep . "','" . $this->endereco . "','" . $this->email . "','". $this->telefone . "','" . $this->cpf . "')";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function getNome()
		{
			return $this->nome;
		}
		public function getEndereco()
		{
			return $this->endereco;
		}
		public function getCEP()
		{
			return $this->cep;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getTelefone()
		{
			return $this->telefone;
		}
		public function getCPF()
		{
			return $this->cpf;
		}
		public function getID()
		{
			return $this->id;
		}
		public function modTelefone($telefone)
		{
			$this->telefone = $telefone;
		}
		public function modEmail($email)
		{
			$this->email = $email;
		}		
		public function modNome($nome)
		{
			$this->nome = $nome;
		}
		public function modCEP($cep)
		{
			$this->cep = $cep;
		}
		public function modCPF($cpf)
		{
			$this->cpf = $cpf;
		}
		
	}
	function consultaBD($id_entra)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "SELECT * FROM clientes WHERE id = ".$id_entra;
		$result = mysqli_query($conexao, $query);
		$consulta = mysqli_fetch_array($result);
		$insta = new Cliente($consulta["nome"], $consulta["cep"], $consulta["endereco"], $consulta["email"], $consulta["telefone"], $consulta["cpf"], $consulta["id"]);
		mysqli_close($conexao);
		return $insta;
	}
	function deletaBD($id)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "DELETE FROM clientes WHERE id = ". $id;
		$result = mysqli_query($conexao, $query);
		mysqli_close($conexao);		
	}	
	function criaBD($nome, $cep, $endereco, $email, $telefone, $cpf)
	{
		$novo = new Cliente($nome, $cep, $endereco, $email, $telefone, $cpf, 0);
		$novo->bdcreate();		
	}
	function editaBD($id, $nome, $cep, $endereco, $email, $telefone, $cpf)
	{
		$edita = new Cliente($nome, $cep, $endereco, $email, $telefone, $cpf, $id);
		$edita->bdupdate();
	}
	if(isset($_POST["opt"]))
	{
		if($_POST["opt"]=="1")
		{
			criaBD($_POST["nome"], $_POST["cep"], $_POST["endereco"], $_POST["email"], $_POST["telefone"], $_POST["cpf"]);
			date_default_timezone_set("America/Brasilia");			
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('clientelog.txt','a');
			fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["nome"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
		}
		if($_POST["opt"]=="3")
		{
			editaBD($_POST["id"], $_POST["nome"], $_POST["cep"], $_POST["endereco"], $_POST["email"], $_POST["telefone"], $_POST["cpf"]);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('clientelog.txt','a');
			fwrite($arquivo, $formated_date . "--Alteration of " . $_POST["nome"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
		}
		if($_POST["opt"]=="4")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM clientes WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('clientelog.txt','a');
			fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["nome"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);		
			deletaBD($_POST["id"]);			
		}
	}	
?>
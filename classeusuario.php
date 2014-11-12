<?php
	include("seguranca.php");
	class Usuario
	{
		private $login;
		private $senha;
		private $nome;
		private $email = "default@default.com";
		private $telefone;
		private $tipo;
		private $id;
		
		private function cript()
		{
			$criptografada = $this->senha;
			$criptografada = base64_encode($criptografada);
			return $criptografada;
		}
		
		public function __construct($login, $senha, $nome, $email, $telefone, $tipo, $id)
		{
			$this->login = $login;			
			$this->senha = $senha;
			$this->nome = $nome;
			$this->email = $email;
			$this->telefone = $telefone;
			$this->tipo = $tipo;
			$this->id = $id;	
		}
		
		public function bdupdate()
		{
			$sencrip = $this->cript();
			
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
						
			$query = "UPDATE usuarios SET login = '" . $this->login . "', senha = '" . $sencrip . "', email = '" . $this->email . "', nome = '" . $this->nome . "', telefone = '". $this->telefone . "', tipo = " . $this->tipo . " WHERE id = " . $this->id;
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function bdcreate()
		{
			$sencrip = $this->cript();		
			
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
						
			$query = "INSERT INTO usuarios (login, senha, email, nome, telefone, tipo) VALUES('".$this->login . "','" . $sencrip . "','" . $this->email . "','" . $this->nome . "','". $this->telefone . "'," . $this->tipo . ")";
			$result = mysqli_query($conexao, $query);
			mysqli_close($conexao);
		}
		public function getLogin()
		{
			return $this->login;
		}
		public function getNome()
		{
			return $this->nome;
		}
		public function getSenha()
		{
			return $this->senha;
		} //Necessário?
		public function getEmail()
		{
			return $this->email;
		}
		public function getTelefone()
		{
			return $this->telefone;
		}
		public function getTipo()
		{
			return $this->tipo;
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
		public function modSenha($senha)
		{
			$this->senha = $senha;						
		}
		public function modLogin($login)
		{
			$this->login = $login;
		}
		public function modNome($nome)
		{
			$this->nome = $nome;
		}
		
		
	}
	function consultaBD($id_entra)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "SELECT * FROM usuarios WHERE id = ".$id_entra;
		$result = mysqli_query($conexao, $query);
		$consulta = mysqli_fetch_array($result);
		$insta = new Usuario($consulta["login"], base64_decode($consulta["senha"]), $consulta["nome"], $consulta["email"], $consulta["telefone"], $consulta["tipo"], $consulta["id"]);
		mysqli_close($conexao);
		return $insta;
	}
	function deletaBD($id)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "UPDATE usuarios SET deleted = 1, deleted_date = SYSDATE() WHERE id = " . $id;
		$result = mysqli_query($conexao, $query);
		mysqli_close($conexao);		
	}	
	function criaBD($login, $senha, $nome, $email, $telefone, $tipo)
	{
		$novo = new Usuario($login, $senha, $nome, $email, $telefone, $tipo, 0);
		$novo->bdcreate();		
	}
	function editaBD($id, $login, $senha, $nome, $email, $telefone, $tipo)
	{
		$edita = new Usuario($login, $senha, $nome, $email, $telefone, $tipo, $id);
		$edita->bdupdate();
	}
	if(isset($_POST["opt"]))
	{
		if($_POST["opt"]=="1")
		{
			criaBD($_POST["login"], $_POST["senha"], $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["tipo"]);
			date_default_timezone_set("America/Brasilia");			
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logusuario.txt','a');
			fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["login"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			header("Location: usuarios.php");
		}
		if($_POST["opt"]=="3")
		{
			editaBD($_POST["id"], $_POST["login"], $_POST["senha"], $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["tipo"]);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logusuario.txt','a');
			fwrite($arquivo, $formated_date . "--Alteration of " . $_POST["login"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			header("Location: usuarios.php");
		}
		if($_POST["opt"]=="4")
		{
			$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
			$query = "SELECT * FROM usuarios WHERE id = ". $_POST["id"];
			$result = mysqli_query($conexao, $query);
			$consulta = mysqli_fetch_array($result);
			$formated_date  = date("m/d/y G.i:s<br>", time());	
			$arquivo = fopen('logusuario.txt','a');
			fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["login"] . " by " . getLogin() . "!\r\n");
			fclose($arquivo);
			mysqli_close($conexao);		
			deletaBD($_POST["id"]);			
		}
	}	
?>
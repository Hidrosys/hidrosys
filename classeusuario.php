<?php
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
	function consultaBD($login_entra)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "SELECT * FROM usuarios WHERE login = '".$login_entra."'";
		$result = mysqli_query($conexao, $query);
		$consulta = mysqli_fetch_array($result);
		$insta = new Usuario($login_entra, base64_decode($consulta["senha"]), $consulta["nome"], $consulta["email"], $consulta["telefone"], $consulta["tipo"], $consulta["id"]);
		mysqli_close($conexao);
		return $insta;
	}
	function deletaBD($id)
	{
		$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
		$query = "DELETE FROM usuarios WHERE id = ". $id;
		$result = mysqli_query($conexao, $query);
		mysqli_close($conexao);		
	}	
	function criaBD($login, $senha, $nome, $email, $telefone, $tipo)
	{
		$novo = new Usuario($login, $senha, $nome, $email, $telefone, $tipo, 0);
		$novo->bdcreate();
	}	
	if($_POST["opt"]=="1")
	{
		criaBD($_POST["login"], $_POST["senha"], $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["tipo"]);		
	}
	if($_POST["opt"]=="4")
	{
		deletaBD($_POST["id"]);		
	}	
?>
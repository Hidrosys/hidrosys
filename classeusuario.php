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
		
		public function __construct($login, $senha, $nome, $email, $telefone, $tipo)
		{
			$this->login = $login;			
			$this->senha = $senha;
			$this->nome = $nome;
			$this->email = $email;
			$this->telefone = $telefone;
			$this->tipo = $tipo;			
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
		
	}
$usuario_ativo = new Usuario("lupus", "homem tuarao", "Fabiano Coelho Junior", "fabianocoelho06@gmail.com", "36626777", 1);
$usuario_ativo->bdupdate();
echo "Sucesso!<br>";
?>
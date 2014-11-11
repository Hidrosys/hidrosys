<?php
  include("seguranca.php");
  class funcionario
  {
    private $nome;
    private $datanasc;
    private $rg;
    private $cpf;
    private $endereco;
    private $email = "default@default.com";
    private $ocupacao;
    private $salario;
    private $hrtrabalho;
    private $telefone;
	private $status;
	private $id;
    
    public function __construct($nome, $datanasc, $rg, $cpf, $endereco, $email, $ocupacao, $salario, $hrtrabalho, $telefone, $status, $id)
    {
      $this->nome = $nome;
      $this->datanasc = $datanasc;
      $this->rg = $rg;
      $this->cpf = $cpf;
      $this->endereco = $endereco;
      $this->email = $email;
      $this->ocupacao = $ocupacao;
      $this->salario = $salario;
      $this->hrtrabalho = $hrtrabalho;
      $this->telefone = $telefone;
	  $this->status = $status;
	  $this->id = $id;
    }
    
    public function bdupdate()
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");            
      $query = "UPDATE funcionarios SET nome = '" . $this->nome . "', datanasc = '" . $this->datanasc . "', rg = '" . $this->rg . "', cpf = '" . $this->cpf . "', endereco = '" . $this->endereco . "', email = '" . $this->email . "', ocupacao = '" . $this->ocupacao . "', salario = " . $this->salario . ", prehora = " . $this->hrtrabalho . ", telefone = '". $this->telefone . "', status = " . $this->status . " WHERE id = " . $this->id;
      $result = mysqli_query($conexao, $query);
      mysqli_close($conexao);
    }
    public function bdcreate()
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");            
      $query = "INSERT INTO funcionarios (nome, datanasc, rg, cpf, endereco, email, ocupacao, salario, prehora, telefone, status) VALUES('".$this->nome . "','" . $this->datanasc . "','" . $this->rg . "','" . $this->cpf . "','" . $this->endereco . "','" . $this->email . "','" . $this->ocupacao . "'," . $this->salario . "," . $this->hrtrabalho . ",'" . $this->telefone . "'," . 0 . ")";
      $result = mysqli_query($conexao, $query);
      mysqli_close($conexao);
    }
    public function getNome()
    {
      return $this->nome;
    }
    public function getRG()
    {
      return $this->rg;
    }
    public function getCPF()
    {
      return $this->cpf;
    }
    public function getEndereco()
    {
      return $this->endereco;
    }
    public function getEmail()
    {
      return $this->email;
    }
    public function getOcupacao()
    {
      return $this->ocupacao;
    }
    public function getSalario()
    {
      return $this->salario;
    }
    public function getHoraTrabalho()
    {
      return $this->hrtrabalho;
    }
    public function getTelefone()
    {
      return $this->telefone;
    }
    public function modTelefone($telefone)
    {
      $this->telefone = $telefone;
    }
    public function modEmail($email)
    {
      $this->email = $email;
    }   
    public function modOcupacao($ocupacao)
    {
      $this->ocupacao = $ocupacao;
    }
    public function modEndereco($endereco)
    {
      $this->endereco = $endereco;
    }
    public function modSalario($salario)
    {
      $this->salario = $salario;
    }
    public function modHoraTrabalho($hrtrabalho)
    {
      $this->hrtrabalho = $hrtrabalho;
    }

  }
  function consultaBD($id_entra)
  {
    $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
    $query = "SELECT * FROM funcionarios WHERE id = ".$id_entra;
    $result = mysqli_query($conexao, $query);
    $consulta = mysqli_fetch_array($result);
    $insta = new funcionario($consulta["nome"], $consulta["datanasc"], $consulta["rg"], $consulta["cpf"], $consulta["endereco"], $consulta["email"], $consulta["ocupacao"], $consulta["salario"], $consulta["prehora"], $consulta["telefone"], $consulta["status"], $consulta["id"]);
    mysqli_close($conexao);
    return $insta;
  }
  function deletaBD($id)
  {
    $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
    $query = "DELETE FROM funcionarios WHERE id = ". $id;
    $result = mysqli_query($conexao, $query);
    mysqli_close($conexao);   
  } 
  function criaBD($nome, $datanasc, $rg, $cpf, $endereco, $email, $ocupacao, $salario, $hrtrabalho, $telefone)
  {
    $novo = new funcionario($nome, $datanasc, $rg, $cpf, $endereco, $email, $ocupacao, $salario, $hrtrabalho, $telefone, 0, 0);
    $novo->bdcreate();    
  }
  function editaBD($nome, $datanasc, $rg, $cpf, $endereco, $email, $ocupacao, $salario, $hrtrabalho, $telefone, $status, $id)
  {
    $edita = new funcionario($nome, $datanasc, $rg, $cpf, $endereco, $email, $ocupacao, $salario, $hrtrabalho, $telefone, $status, $id);
    $edita->bdupdate();
  }  
  if(isset($_POST["opt"]))
  {
    if($_POST["opt"]=="1")
    {
      criaBD($_POST["nome"], $_POST["datanasc"], $_POST["rg"], $_POST["cpf"], $_POST["endereco"], $_POST["email"], $_POST["ocupacao"], $_POST["salario"], $_POST["prehora"], $_POST["telefone"]);
      date_default_timezone_set("America/Brasilia");      
      $formated_date  = date("m/d/y G.i:s<br>", time());  
      $arquivo = fopen('funlog.txt','a');
      fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["nome"] . " by " . getLogin() . "!\r\n");
      fclose($arquivo);
    }
    if($_POST["opt"]=="3")
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
      $query = "SELECT * FROM funcionarios WHERE id = ". $_POST["id"];
      $result = mysqli_query($conexao, $query);
      $consulta = mysqli_fetch_array($result);
	  editaBD($_POST["nome"], $consulta["datanasc"], $_POST["rg"], $consulta["cpf"], $_POST["endereco"], $_POST["email"], $consulta["ocupacao"], $consulta["salario"], $consulta["prehora"], $_POST["telefone"], $consulta["status"], $_POST["id"]);
      //criaBD($_POST["nome"], $_POST["cep"], $_POST["endereco"], $_POST["email"], $_POST["telefone"], $_POST["cpf"]);
      $formated_date  = date("m/d/y G.i:s<br>", time());  
      $arquivo = fopen('funlog.txt','a');
      fwrite($arquivo, $formated_date . "--Alteration of " . $_POST["nome"] . " by " . getLogin() . "!\r\n");
      fclose($arquivo);
	  mysqli_close($conexao);
	  header("Location: funcionarios.php");
    }
    if($_POST["opt"]=="4")
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
      $query = "SELECT * FROM funcionarios WHERE id = ". $_POST["id"];
      $result = mysqli_query($conexao, $query);
      $consulta = mysqli_fetch_array($result);
      $formated_date  = date("m/d/y G.i:s<br>", time());  
      $arquivo = fopen('funlog.txt','a');
      fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["nome"] . " by " . getLogin() . "!\r\n");
      fclose($arquivo);
      mysqli_close($conexao);
	  deletaBD($_POST["id"]);	  
    }
  } 
?>
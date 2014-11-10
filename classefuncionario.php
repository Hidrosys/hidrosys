<?php
  include("seguranca.php");
  class Funcionario
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
    
    public function __construct($nome, $datanasc, $rg, $cpf, $endereco, $email, $salario, $hrtrabalho, $telefone)
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
    }
    
    public function bdupdate()
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
            
      $query = "UPDATE funcionarios SET nome = '" . $this->nome . "', dataNasc = '" . $this->datanasc . "', rg = '" . $this->rg . "', cpf = '" . $this->cpf . "', endereco = '" . $this->endereco . "', email = '" . $this->email . "', ocupacao = '" . $this->ocupacao . "', salariobase = '" . $this->salario . "', prehora = '" . $this->hrtrabalho . "', telefone = '". $this->telefone;
      $result = mysqli_query($conexao, $query);
      mysqli_close($conexao);
    }
    public function bdcreate()
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
            
      $query = "INSERT INTO funcionarios (nome, datanasc, rg, cpf, endereco, email, ocupacao, salario, prehora, telefone) VALUES('".$this->nome . "','" . $this->datanasc . "','" . $this->rg . "','" . $this->cpf . "','" . $this->endereco . "','" . $this->email . "','" . $this->ocupacao . "'," . $this->salario . "," . $this->hrtrabalho . ",'" . $this->telefone . "')"
       . "','" . $this->hrtrabalho . "','". $this->telefone . ")";
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
    $insta = new Funcionario($consulta["nome"], $consulta["rg"], $consulta["cpf"], $consulta["endereco"], $consulta["email"], $consulta["ocupacao"], $consulta["salario"], $consulta["prehora"], $consulta["telefone"]);
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
  function criaBD($nome, $datanasc, $rg, $cpf, $endereco, $email, $salario, $hrtrabalho, $telefone)
  {
    $novo = new Funcionario($nome, $datanasc, $rg, $cpf, $endereco, $email, $salario, $hrtrabalho, $telefone)
    $novo->bdcreate();    
  }
  function editaBD($nome, $datanasc, $rg, $cpf, $endereco, $email, $salario, $hrtrabalho, $telefone)
  {
    $edita = new Funcionario($nome, $datanasc, $rg, $cpf, $endereco, $email, $salario, $hrtrabalho, $telefone)
    $edita->bdupdate();
  }
  if(isset($_POST["opt"]))
  {
    if($_POST["opt"]=="1")
    {
      criaBD($_POST["nome"], $_POST["rg"], $_POST["cpf"], $_POST["endereco"], $_POST["email"], $_POST["ocupacao"], $_POST["salario"], $_POST["prehora"], $_POST["telefone"]);
      date_default_timezone_set("America/Brasilia");      
      $formated_date  = date("m/d/y G.i:s<br>", time());  
      $arquivo = fopen('funcionariolog.txt','a');
      fwrite($arquivo, $formated_date . "--Insertion of " . $_POST["nome"] . " by " . getLogin() . "!\r\n");
      fclose($arquivo);
    }
    if($_POST["opt"]=="3")
    {
      editaBD($_POST["nome"], $_POST["rg"], $_POST["cpf"], $_POST["endereco"], $_POST["email"], $_POST["ocupacao"], $_POST["salario"], $_POST["prehora"], $_POST["telefone"]);
      //criaBD($_POST["nome"], $_POST["cep"], $_POST["endereco"], $_POST["email"], $_POST["telefone"], $_POST["cpf"]);
      $formated_date  = date("m/d/y G.i:s<br>", time());  
      $arquivo = fopen('funcionariolog.txt','a');
      fwrite($arquivo, $formated_date . "--Alteration of " . $_POST["nome"] . " by " . getLogin() . "!\r\n");
      fclose($arquivo);
    }
    if($_POST["opt"]=="4")
    {
      $conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
      $query = "SELECT * FROM funcionarios WHERE id = ". $_POST["id"];
      $result = mysqli_query($conexao, $query);
      $consulta = mysqli_fetch_array($result);
      $formated_date  = date("m/d/y G.i:s<br>", time());  
      $arquivo = fopen('funcionariolog.txt','a');
      fwrite($arquivo, $formated_date . "--Deletion of " . $consulta["nome"] . " by " . getLogin() . "!\r\n");
      fclose($arquivo);
      mysqli_close($conexao);     
    }
  } 
?>
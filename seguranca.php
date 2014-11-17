<?php

session_start();

if (!isset($_SESSION['start_time'])) $_SESSION['start_time']=time();

if( (time()- $_SESSION['start_time']) > 100*60) {
	encerraSessao();
} 

function verificaSessao()
{
	if($_SESSION["sessaoAtiva"] == false)
		header("Location: login.php");
}

function validaLogin($login, $senha)
{
	$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
	
	$query = "SELECT * FROM usuarios WHERE login = '".$login."' AND deleted = 0";
	$result = mysqli_query($conexao, $query);
	$consulta = mysqli_fetch_array($result);

	if($consulta["login"] == $login AND $consulta["senha"] == base64_encode($senha))
	{
		iniciaSessao($login, $senha);
		return true;
	}
	else
	{
		encerraSessao();
		return false;
	}

	mysqli_free_result($result);
	mysqli_close($conexao);
}

function iniciaSessao($login, $senha)
{
	$_SESSION["sessaoAtiva"] = true;
	$_SESSION["login"] = $login;
}

function encerraSessao()
{
	header("Location: login.php?sessaoEncerrada=true");
	session_destroy();
}

function getLogin()
{
	return $_SESSION["login"];
}

function getNome()
{
	return $_SESSION["nome"];
}

?>
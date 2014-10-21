<?php

session_start();

if (!isset($_SESSION['start_time'])) $_SESSION['start_time']=time();

if( (time()- $_SESSION['start_time']) > 30*60) {
	encerraSessao();
} 

function verificaSessao()
{
	if($_SESSION["sessaoAtiva"] == false)
		header("Location: login.php");
}

function validaLogin($login, $senha)
{
	$conexao = mysql_connect("localhost", "root", "123456");
	mysql_select_db("hidrosys", $conexao);

	$query = "SELECT * FROM usuarios WHERE login = '".$login."'";
	$result = mysql_query($query);
	$consulta = mysql_fetch_array($result);

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

	mysql_free_result($result);
	mysql_close($conecta);
}

function iniciaSessao($login, $senha)
{
	$_SESSION["sessaoAtiva"] = true;
	$_SESSION["login"] = $login;
}

function encerraSessao()
{
	header("Location: login.php");
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
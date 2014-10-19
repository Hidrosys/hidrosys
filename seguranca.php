<?php

session_start();

$_SESSION["sessaoAtiva"] = false;
$_SESSION["login"] = "thiago";

function verificaSessao()
{
	//return true;
	//global $_SESSION["sessaoAtiva"];
	return $_SESSION["sessaoAtiva"];
}

function validaLogin($login, $senha)
{
	//global $sessaoAtiva;
	if(strcmp($login, "thiago") == 0 AND strcmp($senha, "123") == 0)
	{
		iniciaSessao($login, $senha);
		return true;
	}
	else
	{
		encerraSessao();
		return false;
	}
}

function iniciaSessao($login, $senha)
{
	//global $_SESSION["sessaoAtiva"];
	$_SESSION["sessaoAtiva"] = true;
}

function encerraSessao()
{
	//global $_SESSION["sessaoAtiva"];
	$_SESSION["sessaoAtiva"] = false;
	session_destroy();
	//header("Location: login.php");
}

function getLogin()
{
	//global $_SESSION["login"];
	return $_SESSION["login"];
}

?>
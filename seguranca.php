<?php

session_start();

function verificaSessao()
{
	if($_SESSION["sessaoAtiva"] == false)
		header("Location: login.php");
}

function validaLogin($login, $senha)
{
	if(($login == "thiago" AND $senha == "123") OR ($login == "renan" AND $senha == "123"))
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
	$_SESSION["sessaoAtiva"] = true;
	$_SESSION["login"] = $login;
}

function encerraSessao()
{
	session_destroy();
}

function getLogin()
{
	return $_SESSION["login"];
}

?>
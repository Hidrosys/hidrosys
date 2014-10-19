<?php

session_start();

function verificaSessao()
{
	return $_SESSION["sessaoAtiva"];
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
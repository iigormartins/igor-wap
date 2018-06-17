<?php
	
	set_include_path('/conexao/');
	set_include_path('/class/');
	include_once '/class/conexao.php';
	

	## DEFINE O LIMITE DE TEMPO DA SESSAO EM 5 MINUTOS
	session_cache_expire(5);

	## INICIA SESSÃO
	session_start();

	if(!isset($_SESSION['logado'])){
		$_SESSION['logado'] = false;
	}

	## VARIAVEL PARA CONTROLE DE ERRO DE LOGIN
	$_SESSION['login_erro'] = false;

?>

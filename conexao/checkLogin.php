<?php
	include_once '../class/conexao.php';
	session_start();
	
	## ENCONTRA A INFORMAÇÃO
	$dados_usuario['email'] = $_POST['email'];
	$dados_usuario['senha'] = $_POST['senha'];
	$logado = null;

	## VERIRICA SE OS CAMPOS USUARIO E SENHA EXISTE, VAMOS VERIFICAR O DADOS INSERIDOS
	if(isset($dados_usuario['email']) && isset($dados_usuario['senha']) && !empty($dados_usuario['email']) && !empty($dados_usuario['senha'])){
		$conexao = new conexao();

		## CONSULTA OS DADOS A PARTIR DO USUARIO
		$where = array();
		$where['T1001_Email'] = $dados_usuario['email'];
		$consulta = $conexao->pesquisar('tab01001',null,$where);
		$consulta = $consulta[0];

		## VERIFICA SE A SENHA INFORMADA ESTA CORRETA
		if($dados_usuario['senha'] == $consulta['T1001_Senha']){
			## INFORMA QUE O USUARIO ESTA LOGADO
			$_SESSION['logado'] = true;
			$_SESSION['nome_usuario'] = $consulta['T1001_Nome_Usuario'];
			$_SESSION['usuario'] = $consulta['T1001_Usuario'];
			$_SESSION['cod_usuario'] = $consulta['T1001_Cod_Usuario'];

			$logado = true;
		}else{
			## NÃO LOGOU
			$_SESSION['logado'] = false;
			$_SESSION['login_erro'] = "Email ou senha inválidos";

			$logado = false;
		}
	}

	echo json_encode($logado);

?>
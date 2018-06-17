<?php

	## ENCONTRA A INFORMAÇÃO
	if(isset($_POST) && !empty($_POST)){
		$dados_usuario = $_POST;
	}else{
		$dados_usuario = $_SESSION;
	}

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
		}else{
			## NÃO LOGOU
			$_SESSION['logado'] = false;
			$_SESSION['login_erro'] = "Email ou senha inválidos";
		}
	}

?>
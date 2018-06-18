<?php

	ini_set('max_execution_time','-1');
	include_once '../class/importarPlanilha.php';

	$_UPLOAD = array();
	
	## DEFINE A PASTA A ONDE O ARQUIVO SERA SALVO
	$_UPLOAD['dir'] = '../temp/';

	## DEFINE O TAMANHO MAXIMO DO ARQUIVO EM BYTES(2 MB)
	$_UPLOAD['tamanho'] = 1024 * 1024 * 2;

	## DEFINO AS EXTENSOES PERMITIDAS (ARQUIVOS EXCEL)
	$_UPLOAD['extensoes'] = array('xlsx','xls');

	## POSSIVEIS ERROS
	$_UPLOAD['erros'][0] = 'Não houve erro';
	$_UPLOAD['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UPLOAD['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UPLOAD['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UPLOAD['erros'][4] = 'Não foi feito o upload do arquivo';

	## VALIDA SE HOUVE ERROS
	if ($_FILES['arquivo']['error'] != 0) {
	 	die("Não foi possível fazer o upload, erro:" . $_UPLOAD['erros'][$_FILES['arquivo']['error']]);
		exit; 
	}

	###########################
	## VALIDA A EXTENSAO
	$nomeArquivo = explode('.', $_FILES['arquivo']['name']);
	$extensao = strtolower(end($nomeArquivo));
	if (array_search($extensao, $_UPLOAD['extensoes']) === false) {
	  echo "Por favor, envie arquivos com as seguintes extensões: xlsx ou xls";
	  exit;
	}

	## VALIDA O TAMANHO DO ARQUIVO
	if ($_UPLOAD['tamanho'] < $_FILES['arquivo']['size']) {
	  	echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	  	exit;
	}

	## VALIDA SE O ARQUIVO FOI MOVIDO
	$caminho = $_UPLOAD['dir'] . $_FILES['arquivo']['name'];
	if (move_uploaded_file($_FILES['arquivo']['tmp_name'],$caminho)) {
	  	$planilha = new importarPlanilha($caminho);

		$linhasImportadas = $planilha->insertDados();

		if($linhasImportadas === false || $linhasImportadas == "#erro"){
			echo "Não foi possível importar o arquivo, tente novamente!";
		}else{
			echo "Arquivo Importado com sucesso!";
		}
	} else {
	  echo "Não foi possível enviar o arquivo, tente novamente";
	}	
?>
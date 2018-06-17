<?php

	ini_set('max_execution_time','-1');
	include_once '../class/importarPlanilha.php';

	$planilha = new importarPlanilha('../Planilha1.xlsx');

	$linhasImportadas = $planilha->insertDados();

	if($linhasImportadas === false){
		echo json_encode(false);
	}else{
		echo json_encode(true);
	}
?>
<?php 

	include_once '../class/conexao.php';

	$conexao = new conexao();
	$retorno = null;
	$ean = $_POST['Ean'];

	$where = array();
	$where['T1002_Ean'] = $ean;
	$delete = $conexao->remover('tab01002',$where);	

	if($delete == true) $retorno = true;

	echo json_encode($retorno);

?>
<?php 

	include_once '../class/conexao.php';

	$conexao = new conexao();
	$retorno = null;

	$consulta = $conexao->pesquisar('tab01002',null,null);

	if(!empty($consulta)){
		$retorno = array();
		foreach ($consulta as $key => $value) {
			if($value['T1002_Data_Fabricacao'] != "" && $value['T1002_Data_Fabricacao'] != '0000-00-00' ){
				$data = new DateTime($value['T1002_Data_Fabricacao']);
				$data = $data->format('d/m/Y');
			}
			else $data = '';
			$dado = $value['T1002_Ean']."|".$value['T1002_Nome_Produto'].'|'.number_format($value['T1002_Preco'], 2, ',', '.').'|'.$value['T1002_Estoque'].'|'.$data;

			$retorno[] = $dado;
		}
	}

	echo json_encode($retorno);

?>